CREATE TABLE IF NOT EXISTS `mydb`.`Caracteristicas_Imovel` (
 `idCaracteristicas` INT NOT NULL,
 `idImovel` INT NOT NULL,
 `ValorI` INT NULL,
 `ValorD` DECIMAL(9,3) NULL,
 `ValorT` TEXT NULL,
 PRIMARY KEY (`idCaracteristicas`, `idImovel`),
 INDEX `fk_Caracteristicas_has_Imovel_Imovel1_idx` (`idImovel` ASC) VISIBLE,
 INDEX `fk_Caracteristicas_has_Imovel_Caracteristicas1_idx` (`idCaracteristicas` ASC) VISIBLE,
 CONSTRAINT `fk_Caracteristicas_has_Imovel_Caracteristicas1`
  FOREIGN KEY (`idCaracteristicas`)
  REFERENCES `mydb`.`Caracteristicas` (`idCaracteristicas`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE,
 CONSTRAINT `fk_Caracteristicas_has_Imovel_Imovel1`
  FOREIGN KEY (`idImovel`)
  REFERENCES `mydb`.`Imovel` (`idImovel`)
  ON DELETE CASCADE
  ON UPDATE CASCADE)
ENGINE = InnoDB;