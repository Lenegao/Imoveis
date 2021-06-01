-- MySQL Script generated by MySQL Workbench
-- Mon May 31 18:32:45 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema temporario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema temporario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `temporario` DEFAULT CHARACTER SET utf8 ;
USE `temporario` ;

-- -----------------------------------------------------
-- Table `temporario`.`Imovel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `temporario`.`Imovel` (
  `idImovel` INT NOT NULL AUTO_INCREMENT,
  `Titulo` VARCHAR(45) NULL,
  `Descricao` TEXT NULL,
  `Observacoes` TEXT NULL,
  PRIMARY KEY (`idImovel`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `temporario`.`Endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `temporario`.`Endereco` (
  `idEndereco` INT NOT NULL AUTO_INCREMENT,
  `idImovel` INT NOT NULL,
  `CEP` BIGINT NULL,
  `Numero` INT NULL,
  `Complemento` VARCHAR(20) NULL,
  PRIMARY KEY (`idEndereco`),
  INDEX `fk_Endereco_Imovel1_idx` (`idImovel` ASC) ,
  CONSTRAINT `fk_Endereco_Imovel1`
    FOREIGN KEY (`idImovel`)
    REFERENCES `temporario`.`Imovel` (`idImovel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `temporario`.`Imagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `temporario`.`Imagens` (
  `idImagens` INT NOT NULL AUTO_INCREMENT,
  `idImovel` INT NOT NULL,
  `Titulo` VARCHAR(48) NULL,
  `Descricao` TEXT NULL,
  `LinkImagem` VARCHAR(255) NULL,
  PRIMARY KEY (`idImagens`),
  INDEX `fk_Imagens_Imovel_idx` (`idImovel` ASC) ,
  CONSTRAINT `fk_Imagens_Imovel`
    FOREIGN KEY (`idImovel`)
    REFERENCES `temporario`.`Imovel` (`idImovel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `temporario`.`Caracteristicas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `temporario`.`Caracteristicas` (
  `idCaracteristicas` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(24) NULL,
  `Conteudo` VARCHAR(72) NULL,
  `Tipo` ENUM('Inteiro', 'Decimal', 'Texto') NULL,
  PRIMARY KEY (`idCaracteristicas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `temporario`.`Caracteristicas_Imovel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `temporario`.`Caracteristicas_Imovel` (
  `idCaracteristicas` INT NOT NULL,
  `idImovel` INT NOT NULL,
  `ValorI` INT NULL,
  `ValorD` DECIMAL(9,3) NULL,
  `ValorT` TEXT NULL,
  PRIMARY KEY (`idCaracteristicas`, `idImovel`),
  INDEX `fk_Caracteristicas_has_Imovel_Imovel1_idx` (`idImovel` ASC) ,
  INDEX `fk_Caracteristicas_has_Imovel_Caracteristicas1_idx` (`idCaracteristicas` ASC) ,
  CONSTRAINT `fk_Caracteristicas_has_Imovel_Caracteristicas1`
    FOREIGN KEY (`idCaracteristicas`)
    REFERENCES `temporario`.`Caracteristicas` (`idCaracteristicas`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Caracteristicas_has_Imovel_Imovel1`
    FOREIGN KEY (`idImovel`)
    REFERENCES `temporario`.`Imovel` (`idImovel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;