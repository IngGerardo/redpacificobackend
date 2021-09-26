CREATE DATABASE redpacifico
WITH OWNER = postgres
ENCODING = 'UTF8'
TABLESPACE = pg_default
LC_COLLATE = 'Spanish_Mexico.1252'
LC_CTYPE = 'Spanish_Mexico.1252'
CONNECTION LIMIT = -1;

CREATE SEQUENCE numero_cliente_sequence
START WITH 90000000
INCREMENT BY 1
maxvalue 99999999
minvalue 90000000;

CREATE SEQUENCE numero_producto_sequence
START WITH 20000000
INCREMENT BY 1
maxvalue 29999999
minvalue 20000000;

CREATE TABLE cat_clientes (
    idu_cliente INTEGER PRIMARY KEY DEFAULT NEXTVAL('numero_cliente_sequence'),
    nom_cliente VARCHAR(50) NOT NULL,
    des_apellidopaterno VARCHAR(50) NOT NULL,
    des_apellidomaterno VARCHAR(50) NOT NULL,
    des_rfc VARCHAR(13) NOT NULL,
    fec_registro DATE NOT NULL DEFAULT CURRENT_DATE
);

CREATE TABLE cat_productos (
    idu_producto INTEGER PRIMARY KEY DEFAULT NEXTVAL('numero_producto_sequence'),
    des_producto VARCHAR(50) NOT NULL,
    des_modelo VARCHAR(50) NOT NULL,
    num_precio INTEGER NOT NULL DEFAULT 0,
	num_existencia INTEGER NOT NULL DEFAULT 0,
    fec_registro DATE NOT NULL DEFAULT CURRENT_DATE
);
/*
CREATE TABLE cat_roles (
    id SERIAL PRIMARY KEY,
    nombrerol VARCHAR(50) NOT NULL,
	bonohora INTEGER NOT NULL DEFAULT 0,
    fecharegistro DATE NOT NULL DEFAULT CURRENT_DATE
);
INSERT INTO cat_roles (nombrerol, bonohora) VALUES ('Chofer', 10);
INSERT INTO cat_roles (nombrerol, bonohora) VALUES ('Cargador', 5);
INSERT INTO cat_roles (nombrerol, bonohora) VALUES ('Auxiliar', 0);

CREATE TABLE cat_tipos (
    id SERIAL PRIMARY KEY,
    nombretipo VARCHAR(50) NOT NULL,
    fecharegistro DATE NOT NULL DEFAULT CURRENT_DATE
);
INSERT INTO cat_tipos (nombretipo) VALUES ('Interno');
INSERT INTO cat_tipos (nombretipo) VALUES ('Externo');

CREATE TABLE ctl_sueldos (
    id SERIAL PRIMARY KEY,
    basehora INTEGER NOT NULL,
    jornadalaboral INTEGER NOT NULL,
	adicional INTEGER NOT NULL,
	valesdespensa INTEGER NOT NULL,
	sueldosobrepasar INTEGER NOT NULL,
	anioactual INTEGER NOT NULL DEFAULT date_part('year', CURRENT_DATE),
    isr INTEGER NOT NULL,
    isradicional INTEGER NOT NULL
);
INSERT INTO ctl_sueldos (basehora, jornadalaboral, adicional, valesdespensa, sueldosobrepasar, isr, isradicional) VALUES (30, 8, 5, 4, 16000, 9, 3);
*/
