CREATE TABLE IF NOT EXISTS `mydb`.`Imagens` (
  `idImagens` INT NOT NULL AUTO_INCREMENT,
  `idImovel` INT NOT NULL,
  `Titulo` VARCHAR(48) NULL,
  `Descricao` TEXT NULL,
  `LinkImagem` VARCHAR(255) NULL,
  PRIMARY KEY (`idImagens`),
  INDEX `fk_Imagens_Imovel_idx` (`idImovel` ASC) VISIBLE,
  CONSTRAINT `fk_Imagens_Imovel`
    FOREIGN KEY (`idImovel`)
    REFERENCES `mydb`.`Imovel` (`idImovel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;