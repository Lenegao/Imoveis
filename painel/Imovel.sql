CREATE TABLE IF NOT EXISTS `mydb`.`Imovel` (
 `idImovel` INT NOT NULL AUTO_INCREMENT,
 `Titulo` VARCHAR(45) NULL,
 `Descricao` TEXT NULL,
 `Observacoes` TEXT NULL,
 PRIMARY KEY (`idImovel`))
ENGINE = InnoDB;