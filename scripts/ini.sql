SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `events` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `events` ;

-- -----------------------------------------------------
-- Table `events`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`usuario` (
  `idusuario` INT(7) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` CHAR(20) NOT NULL ,
  `apellidoPaterno` CHAR(30) NOT NULL ,
  `apellidoMaterno` CHAR(30) NOT NULL ,
  `sexo` ENUM('Masculino', 'Femenino') NULL ,
  `fechaNacimiento` DATE NULL ,
  `tipoDocumento` ENUM('DNI', 'RUC', 'PASAPORTE') NULL ,
  `nroDocumento` VARCHAR(40) NULL ,
  `idDepartamento` INT(2) NULL ,
  `idProvincia` INT(4) NULL ,
  `idDistrito` INT(5) NULL ,
  `email` VARCHAR(60) NOT NULL ,
  `clave` VARCHAR(100) NOT NULL ,
  `direccion` VARCHAR(200) NULL ,
  `tipoUsuario` TINYINT(1) NULL DEFAULT 1 COMMENT '1: Usuario Portada\n2: Admin \n3: Super Admin' ,
  `estado` TINYINT(1) NULL DEFAULT 1 COMMENT '1: Activo\n2: Pendiente Activaciòn\n3: Eliminado' ,
  `fechaRegistro` DATETIME NULL ,
  `fechaUltimoAcceso` DATETIME NULL ,
  `telefono` CHAR(12) NULL ,
  `celular` CHAR(9) NULL ,
  PRIMARY KEY (`idusuario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `events`.`categoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`categoria` (
  `idcategoria` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `categoriaPadre` INT(3) UNSIGNED NULL COMMENT 'Este campo hace referencia a la categoria padre' ,
  `descripcion` VARCHAR(60) NOT NULL ,
  `estado` BIT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idcategoria`) )
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `events`.`proveedor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`proveedor` (
  `idproveedor` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tipoDocumento` ENUM('DNI', 'RUC', 'PASAPORTE', 'OTROS') NULL ,
  `numeroDocumento` CHAR(15) NULL ,
  `razonSocial` VARCHAR(100) NULL ,
  `telefono` CHAR(12) NULL ,
  `celular` CHAR(12) NULL ,
  `observaciones` VARCHAR(100) NULL ,
  `estado` BIT NULL ,
  `fechaRegistro` DATETIME NULL ,
  PRIMARY KEY (`idproveedor`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `events`.`servicio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`servicio` (
  `idservicio` INT(2) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombreServicio` VARCHAR(50) NOT NULL ,
  `estado` BIT NULL ,
  PRIMARY KEY (`idservicio`) )
ENGINE = InnoDB
COMMENT = '																				\n\n';


-- -----------------------------------------------------
-- Table `events`.`producto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`producto` (
  `idproducto` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombreProducto` VARCHAR(100) NOT NULL ,
  `idservicio` INT(2) UNSIGNED NOT NULL ,
  `idcategoria` INT(3) UNSIGNED NULL ,
  `idproveedor` INT(4) UNSIGNED NULL ,
  `descripcionCorta` VARCHAR(150) NULL ,
  `descripcionLarga` TEXT NULL ,
  `fechaRegistro` DATETIME NULL ,
  `fechaInicio` DATETIME NULL ,
  `fechaFin` DATETIME NULL ,
  `precio` DECIMAL(10,2) NULL ,
  `stock` INT(4) NULL ,
  `slug` VARCHAR(100) NULL ,
  `idUsuarioRegistro` INT(7) NULL ,
  PRIMARY KEY (`idproducto`) ,
  INDEX `slug` (`slug` ASC) ,
  INDEX `idcategoria_idx` (`idcategoria` ASC) ,
  INDEX `idproveedor_idx` (`idproveedor` ASC) ,
  INDEX `idservicio_idx` (`idservicio` ASC) ,
  CONSTRAINT `idcategoria`
    FOREIGN KEY (`idcategoria` )
    REFERENCES `events`.`categoria` (`idcategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idproveedor`
    FOREIGN KEY (`idproveedor` )
    REFERENCES `events`.`proveedor` (`idproveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idservicio`
    FOREIGN KEY (`idservicio` )
    REFERENCES `events`.`servicio` (`idservicio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `events`.`productoFoto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`productoFoto` (
  `idproductoFoto` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idproducto` INT(10) UNSIGNED NOT NULL ,
  `foto` CHAR(10) NULL ,
  PRIMARY KEY (`idproductoFoto`) ,
  INDEX `idproducto_idx` (`idproducto` ASC) ,
  CONSTRAINT `idproducto`
    FOREIGN KEY (`idproducto` )
    REFERENCES `events`.`producto` (`idproducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '				';


-- -----------------------------------------------------
-- Table `events`.`oferta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`oferta` (
  `idoferta` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idproducto` INT(10) UNSIGNED NOT NULL ,
  `fechaInicio` DATETIME NULL ,
  `fechaFin` DATETIME NULL ,
  `precioOferta` DECIMAL(10,2) NULL ,
  `usuarioRegistro` INT(10) UNSIGNED NULL ,
  PRIMARY KEY (`idoferta`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `events`.`cotizacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`cotizacion` (
  `idcotizacion` INT(7) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idusuario` INT(10) UNSIGNED NOT NULL ,
  `total` DECIMAL(10,2) NOT NULL ,
  `fechaEntrega` DATETIME NULL ,
  `fechaRegistro` DATETIME NULL ,
  `idUsuarioRegistro` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`idcotizacion`) ,
  INDEX `idusuario_idx` (`idusuario` ASC) ,
  CONSTRAINT `idusuario`
    FOREIGN KEY (`idusuario` )
    REFERENCES `events`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `events`.`detalleCotizacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `events`.`detalleCotizacion` (
  `iddetalleCotizacion` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idcotizacion` INT(7) UNSIGNED NOT NULL ,
  `idproducto` INT(10) UNSIGNED NOT NULL ,
  `precio` DECIMAL(10,2) NULL ,
  `cantidad` INT(4) UNSIGNED NULL ,
  PRIMARY KEY (`iddetalleCotizacion`) )
ENGINE = InnoDB;

USE `events` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
