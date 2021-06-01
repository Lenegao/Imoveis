CREATE TABLE IF NOT EXISTS `mydb`.`Caracteristicas` (
  `idCaracteristicas` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(24) NULL,
  `Conteudo` VARCHAR(72) NULL,
  `Tipo` ENUM('Inteiro', 'Decimal', 'Texto') NULL,
  PRIMARY KEY (`idCaracteristicas`))
ENGINE = InnoDB;
