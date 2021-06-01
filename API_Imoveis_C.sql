-- MySQL Workbench Synchronization
-- Generated: 2021-05-31 17:52
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: suporte

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER SCHEMA `temporario`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `temporario`.`Imovel` (
  `idImovel` INT(11) NOT NULL AUTO_INCREMENT,
  `Titulo` VARCHAR(45) NULL DEFAULT NULL,
  `Descricao` TEXT NULL DEFAULT NULL,
  `Observacoes` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idImovel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `temporario`.`Endereco` (
  `idEndereco` INT(11) NOT NULL,
  `idImovel` INT(11) NOT NULL,
  `CEP` BIGINT(20) NULL DEFAULT NULL,
  `Numero` INT(11) NULL DEFAULT NULL,
  `Complemento` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`idEndereco`),
  INDEX `fk_Endereco_Imovel1_idx` (`idImovel` ASC) VISIBLE,
  CONSTRAINT `fk_Endereco_Imovel1`
    FOREIGN KEY (`idImovel`)
    REFERENCES `temporario`.`Imovel` (`idImovel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `temporario`.`Imagens` (
  `idImagens` INT(11) NOT NULL AUTO_INCREMENT,
  `idImovel` INT(11) NOT NULL,
  `Titulo` VARCHAR(48) NULL DEFAULT NULL,
  `Descricao` TEXT NULL DEFAULT NULL,
  `LinkImagem` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`idImagens`),
  INDEX `fk_Imagens_Imovel_idx` (`idImovel` ASC) VISIBLE,
  CONSTRAINT `fk_Imagens_Imovel`
    FOREIGN KEY (`idImovel`)
    REFERENCES `temporario`.`Imovel` (`idImovel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `temporario`.`Caracteristicas` (
  `idCaracteristicas` INT(11) NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(24) NULL DEFAULT NULL,
  `Conteudo` VARCHAR(72) NULL DEFAULT NULL,
  `Tipo` ENUM('Inteiro', 'Decimal', 'Texto') NULL DEFAULT NULL,
  PRIMARY KEY (`idCaracteristicas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `temporario`.`Caracteristicas_Imovel` (
  `idCaracteristicas` INT(11) NOT NULL,
  `idImovel` INT(11) NOT NULL,
  `ValorI` INT(11) NULL DEFAULT NULL,
  `ValorD` DECIMAL(9,3) NULL DEFAULT NULL,
  `ValorT` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idCaracteristicas`, `idImovel`),
  INDEX `fk_Caracteristicas_has_Imovel_Imovel1_idx` (`idImovel` ASC) VISIBLE,
  INDEX `fk_Caracteristicas_has_Imovel_Caracteristicas1_idx` (`idCaracteristicas` ASC) VISIBLE,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
