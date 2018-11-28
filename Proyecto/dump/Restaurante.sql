-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema RestauranteTests
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema RestauranteTests
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `RestauranteTests` DEFAULT CHARACTER SET utf8 ;
USE `RestauranteTests` ;

-- -----------------------------------------------------
-- Table `RestauranteTests`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RestauranteTests`.`Empleado` (
  `idEmpleado` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreCompleto` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `sueldo` DOUBLE NOT NULL,
  `estado` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEmpleado`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `RestauranteTests`.`Mesa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RestauranteTests`.`Mesa` (
  `idMesa` INT(11) NOT NULL AUTO_INCREMENT,
  `capacidad` INT(11) NOT NULL DEFAULT '2',
  `estado` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idMesa`),
  UNIQUE INDEX `idMesa_UNIQUE` (`idMesa` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `RestauranteTests`.`Cuenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RestauranteTests`.`Cuenta` (
  `idCuenta` INT(11) NOT NULL AUTO_INCREMENT,
  `total` DOUBLE NOT NULL DEFAULT '0',
  `Mesa_idMesa` INT(11) NOT NULL,
  `nombreDelCliente` VARCHAR(45) NOT NULL,
  `estado` INT(11) NOT NULL DEFAULT '0',
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Empleado_idEmpleado` INT(11) NOT NULL,
  PRIMARY KEY (`idCuenta`, `Mesa_idMesa`),
  UNIQUE INDEX `idCuenta_UNIQUE` (`idCuenta` ASC) ,
  INDEX `fk_Cuenta_Mesa1_idx` (`Mesa_idMesa` ASC) ,
  INDEX `fk_Cuenta_Empleado1_idx` (`Empleado_idEmpleado` ASC) ,
  CONSTRAINT `fk_Cuenta_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `RestauranteTests`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cuenta_Mesa1`
    FOREIGN KEY (`Mesa_idMesa`)
    REFERENCES `RestauranteTests`.`Mesa` (`idMesa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `RestauranteTests`.`Ingreso/Egreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RestauranteTests`.`Ingreso/Egreso` (
  `idIngresoEgreso` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` VARCHAR(20) NOT NULL,
  `monto` DOUBLE NOT NULL,
  `concepto` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`idIngresoEgreso`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `RestauranteTests`.`Productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RestauranteTests`.`Productos` (
  `idProductos` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `costo` DOUBLE NOT NULL,
  `precio` DOUBLE NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idProductos`),
  UNIQUE INDEX `idProductos_UNIQUE` (`idProductos` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `RestauranteTests`.`Orden`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `RestauranteTests`.`Orden` (
  `idOrden` INT(11) NOT NULL AUTO_INCREMENT,
  `Productos_idProductos` INT(11) NOT NULL,
  `Cuenta_Mesa_idMesa` INT(11) NOT NULL,
  `Cuenta_idCuenta` INT(11) NOT NULL,
  `estado` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idOrden`, `Productos_idProductos`, `Cuenta_Mesa_idMesa`, `Cuenta_idCuenta`),
  INDEX `fk_Orden_Productos1_idx` (`Productos_idProductos` ASC) ,
  INDEX `fk_Orden_Cuenta1_idx` (`Cuenta_idCuenta` ASC, `Cuenta_Mesa_idMesa` ASC) ,
  CONSTRAINT `fk_Orden_Cuenta1`
    FOREIGN KEY (`Cuenta_idCuenta` , `Cuenta_Mesa_idMesa`)
    REFERENCES `RestauranteTests`.`Cuenta` (`idCuenta` , `Mesa_idMesa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Orden_Productos1`
    FOREIGN KEY (`Productos_idProductos`)
    REFERENCES `RestauranteTests`.`Productos` (`idProductos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
