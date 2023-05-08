CREATE DATABASE catastro;

USE catastro;

CREATE TABLE meta_servicios_alcaldia(
    id_servicio_alcaldia varchar(12) PRIMARY KEY,
    cod1 int(1) NOT NULL,
    cod2 int(2)ZEROFILL NOT NULL,
    cod3 int(2)ZEROFILL NOT NULL,
    cod4 int(3)ZEROFILL NOT NULL,
    descripcion_servicio varchar(100) NOT NULL,
    descripcion_servicio_abreviado varchar(20) NULL,
    unidad_medida varchar(15) NULL,
    tarifa_actual decimal(8,2) NOT NULL,
    tarifa_anterior decimal(8,2) NOT NULL,
    periodo_vigencia_tarifa int NOT NULL,
    tipo_concepto varchar(1) NOT NULL,
    tipo_cobro varchar(1) NOT NULL,
    estado_servicios tinyint NOT NULL,
    INDEX(cod1),
    INDEX(cod2),
    INDEX(cod3),
    INDEX(cod4)
);

CREATE TABLE meta_sector_estado (
    cod_sector varchar(2) PRIMARY KEY,
    sector_estado varchar(25),
    estado_sector tinyint NOT NULL
);

CREATE TABLE meta_departamento(
    cod_departamento int(2) PRIMARY KEY AUTO_INCREMENT,
    departamento varchar(15)
);

CREATE TABLE meta_municipio(
    cod_municipio varchar(4) PRIMARY KEY, 
    municipio varchar(25),
    cod_departamento int(2),
    INDEX(cod_departamento),
    FOREIGN KEY (cod_departamento) REFERENCES meta_departamento(cod_departamento)
);

CREATE TABLE meta_zona_inmueble(
    cod_zona int(2) ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    zona_inmueble varchar(50)
);

CREATE TABLE meta_dimension_inmueble(
    id_dimension int PRIMARY KEY AUTO_INCREMENT,
    norte_longitud int NOT NULL,
    este_longitud int NOT NULL,
    oeste_longitud int NOT NULL,
    sur_longitud int NOT NULL
);

CREATE TABLE meta_unidad_medida(
    id_unidad_medida int(2) PRIMARY KEY AUTO_INCREMENT,
    unidad_medida varchar(15),
    u_m_abreviado varchar(4)
);

CREATE TABLE contribuyente(
    correlativo int(4) ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    id_contribuyente varchar(6),
    nombre_contribuyente varchar(30) NOT NULL,
    apellido_contribuyente varchar(30) NOT NULL,
    direccion_contribuyente varchar(125) NOT NULL,
    dui_contribuyente varchar(10) NOT NULL,
    telefono_contribuyente varchar(9) NOT NULL,
    estado_contribuyente tinyint NOT NULL,
    INDEX (id_contribuyente)
);

CREATE TABLE inmueble(
    id_inmueble int(3) ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    cod_zona int(2) UNSIGNED ZEROFILL NOT NULL,
    direccion_inmueble varchar(210) NOT NULL,
    cod_sector varchar(2) NOT NULL,
    id_dimension int NOT NULL,
    correlativo int(4) UNSIGNED ZEROFILL NOT NULL,
    estado_inmueble tinyint NOT NULL,
    FOREIGN KEY (cod_zona) REFERENCES meta_zona_inmueble(cod_zona),
    FOREIGN KEY (cod_sector) REFERENCES meta_sector_estado(cod_sector),
    FOREIGN KEY (id_dimension) REFERENCES meta_dimension_inmueble(id_dimension),
    FOREIGN KEY (correlativo) REFERENCES contribuyente(correlativo)
);

CREATE TABLE servicio_contribuyente(
    id_servicio_contribuyente int(10) ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    correlativo int(4) UNSIGNED ZEROFILL,
    id_inmueble int(3) UNSIGNED ZEROFILL,
    id_servicio_alcaldia varchar(12),
    norte_servicio int NULL,
    este_servicio int NULL,
    oeste_servicio int NULL,
    sur_servicio int NULL,
    total_pago_servicio decimal(9,2) NOT NULL,
    estado_servicio_contribuyente tinyint NOT NULL,
    FOREIGN KEY (correlativo) REFERENCES contribuyente(correlativo),
    FOREIGN KEY (id_inmueble) REFERENCES inmueble(id_inmueble),
    FOREIGN KEY (id_servicio_alcaldia) REFERENCES meta_servicios_alcaldia(id_servicio_alcaldia)
);

DELIMITER $$
CREATE TRIGGER nuevo_id_servicio_alcaldia
BEFORE INSERT ON meta_servicios_alcaldia
FOR EACH ROW
BEGIN
    SET NEW.id_servicio_alcaldia = CONCAT(NEW.cod1, '-', NEW.cod2, '-', NEW.cod3, '-', NEW.cod4);
    SET NEW.estado_servicios = 1;
END;$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER actualizar_id_servicio_alcaldia
BEFORE UPDATE ON meta_servicios_alcaldia
FOR EACH ROW
BEGIN
    SET NEW.id_servicio_alcaldia = CONCAT(NEW.cod1, '-', NEW.cod2, '-', NEW.cod3, '-', NEW.cod4);
END;$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER nuevo_id_contribuyente
BEFORE INSERT ON contribuyente
FOR EACH ROW
BEGIN
	SET NEW.id_contribuyente=CONCAT(SUBSTRING(NEW.nombre_contribuyente,1,1),SUBSTRING(NEW.apellido_contribuyente,1,1));
	SET NEW.estado_contribuyente = 1;
END;$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER actualizar_id_contribuyente
BEFORE UPDATE ON contribuyente
FOR EACH ROW
BEGIN
	SET NEW.id_contribuyente=CONCAT(SUBSTRING(NEW.nombre_contribuyente,1,1),SUBSTRING(NEW.apellido_contribuyente,1,1));
END;$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER nuevo_inmueble
BEFORE INSERT ON inmueble
FOR EACH ROW
BEGIN
	SET NEW.estado_inmueble = 1;
END;$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER nuevo_servicio_alcaldia
BEFORE INSERT ON meta_servicios_alcaldia
FOR EACH ROW
BEGIN
	SET NEW.estado_servicios = 1;
END;$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER nuevo_servicio_contribuyente
BEFORE INSERT ON servicio_contribuyente
FOR EACH ROW
BEGIN
	SET NEW.estado_servicio_contribuyente = 1;
END;$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER nuevo_sector_alcaldia
BEFORE INSERT ON meta_sector_estado
FOR EACH ROW
BEGIN
	SET NEW.estado_sector = 1;
END;$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `eliminar_contribuyente`(IN id_contri varchar(4), IN correlativo_contribuyente int(4))
BEGIN
	UPDATE contribuyente SET estado_contribuyente = 0 WHERE id_contribuyente = id_contri AND correlativo = correlativo_contribuyente;
END;$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `eliminar_servicio_alcaldia`(IN codi1 int(1), IN codi2 int(2), IN codi3 int(2), IN codi4 int(3))
BEGIN
	UPDATE meta_servicios_alcaldia SET estado_servicios = 0 WHERE cod1 = codi1 AND cod2 = codi2 AND cod3 = codi3 AND cod4 = codi4;
END;$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `eliminar_inmueble`(IN cod_inmueble int(3))
BEGIN
	UPDATE inmueble SET estado_inmueble = 0 WHERE id_inmueble = cod_inmueble;
END;$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `eliminar_sector`(IN id_sector varchar(2))
BEGIN
	UPDATE meta_sector_estado SET estado_sector = 0 WHERE cod_sector = id_sector;
END;$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `eliminar_servicio_contribuyente`(IN cod_servicio_contribuyente int(10))
BEGIN
	UPDATE servicio_contribuyente SET estado_servicio_contribuyente = 0 WHERE id_servicio_contribuyente = cod_servicio_contribuyente;
END;$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insertar_dimension(IN norte int, IN este int, IN oeste int, IN sur int)
BEGIN
INSERT INTO meta_dimension_inmueble (`norte_longitud`, `este_longitud`, `oeste_longitud`, `sur_longitud`) VALUES (norte, este, oeste, sur);
END$$
DELIMITER ;