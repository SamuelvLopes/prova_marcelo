SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

DROP SCHEMA IF EXISTS `testePHP` ;
CREATE SCHEMA IF NOT EXISTS `testePHP` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `testePHP` ;

-- -----------------------------------------------------
-- Table `medico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `medico` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `medico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `crm` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `especialidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `especialidade` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `especialidade` (
  `id` INT NOT NULL,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
