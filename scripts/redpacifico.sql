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

CREATE TABLE ctl_configuracion (
    idu_configuracion SERIAL PRIMARY KEY,
    num_tasa REAL NOT NULL DEFAULT 0,
    num_enganche INTEGER NOT NULL DEFAULT 0,
	num_plazo INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE ctl_ventas (
    idu_venta SERIAL PRIMARY KEY,
    idu_producto INTEGER NOT NULL DEFAULT 0,
    idu_cliente INTEGER NOT NULL DEFAULT 0,
	num_cantidad INTEGER NOT NULL DEFAULT 0,
	fec_registro DATE NOT NULL DEFAULT CURRENT_DATE
);
