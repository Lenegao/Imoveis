CREATE TABLE IF NOT EXISTS `temporario`.`Endereco` (
  `idEndereco` INT NOT NULL AUTO_INCREMENT,
  `idImovel` INT NOT NULL,
  `CEP` BIGINT NULL,
  `Numero` INT NULL,
  `Complemento` VARCHAR(20) NULL,
  PRIMARY KEY (`idEndereco`),
  INDEX `fk_Endereco_Imovel1_idx` (`idImovel` ASC) VISIBLE,
  CONSTRAINT `fk_Endereco_Imovel1`
    FOREIGN KEY (`idImovel`)
    REFERENCES `temporario`.`Imovel` (`idImovel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB