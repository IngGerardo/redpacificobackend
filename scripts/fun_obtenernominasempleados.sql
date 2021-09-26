CREATE OR REPLACE FUNCTION fun_obtenernominasempleados(numeroemp INTEGER, anio INTEGER, mes INTEGER) 
 RETURNS TABLE (sueldomes FLOAT, nombremes TEXT) 
AS $BODY$
DECLARE 
	nomina RECORD;
	empleado RECORD;
	movimientos RECORD;
	sueldomensual FLOAT = 0;
	sueldodiario INTEGER = 0;
	sueldoadicional INTEGER = 0;
	bonos INTEGER = 0;
	bonocubrio INTEGER = 0;
	saldoretenido FLOAT = 0;
	meses TEXT[] := ARRAY['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
BEGIN
	SELECT basehora, jornadalaboral, adicional, valesdespensa, sueldosobrepasar, isr, isradicional FROM ctl_sueldos WHERE anioactual = anio INTO nomina;
	SELECT numeroempleado, rol, tipo, bonohora FROM cat_empleados INNER JOIN cat_roles AS r ON rol = r.id WHERE numeroempleado = numeroemp INTO empleado;
	
	FOR movimientos IN SELECT numeroempleado, cubrioturno, empleadocubrio, cantidadentregas from cat_movimientos 
	WHERE numeroempleado = numeroemp AND date_part('month', fechamovimiento) = mes AND date_part('year', fechamovimiento) = anio
	LOOP
		sueldodiario = sueldodiario + (nomina.basehora * nomina.jornadalaboral);
		bonos = bonos + (empleado.bonohora * nomina.jornadalaboral);
		sueldoadicional = sueldoadicional + (movimientos.cantidadentregas*nomina.adicional);
		
		IF (movimientos.cubrioturno) THEN
			SELECT bonohora INTO bonocubrio FROM cat_empleados INNER JOIN cat_roles AS r ON rol = r.id WHERE numeroempleado = movimientos.empleadocubrio;
			bonos = bonos + (bonocubrio * nomina.jornadalaboral);
		END IF;
	END LOOP;
	sueldomensual = sueldodiario + bonos + sueldoadicional;
	IF (empleado.tipo = 1) THEN 
		sueldomensual = sueldomensual * (1 + (nomina.valesdespensa::FLOAT / 100));
	END IF;
	IF (sueldomensual > nomina.sueldosobrepasar) THEN
		saldoretenido = ((nomina.isr + nomina.isradicional)::FLOAT / 100) * sueldomensual;
		sueldomensual = sueldomensual - saldoretenido;
	ELSE
		saldoretenido = (nomina.isr::FLOAT / 100) * sueldomensual;
		sueldomensual = sueldomensual - saldoretenido;
	END IF;
	
	RETURN QUERY SELECT sueldomensual, meses[mes];
END; 
$BODY$
LANGUAGE 'plpgsql' VOLATILE SECURITY DEFINER;
COMMENT ON FUNCTION fun_obtenernominasempleados(INTEGER, INTEGER) IS 'CONSULTA LAS NOMINAS DE LOS EMPLEADOS';
