
-- -----------------------------------------------------
-- Schema id12846177_serprehn
-- -----------------------------------------------------
CREATE SCHEMA  `id12846177_serprehn` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `id12846177_serprehn` ;

-- -----------------------------------------------------
-- Table `id12846177_serprehn`.`Usuarios_Registrados`
-- -----------------------------------------------------
CREATE TABLE `id12846177_serprehn`.`Usuarios_Registrados` (
  `ID_Usuario` INT NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Apellido` VARCHAR(45) NOT NULL,
  `Numero_Telefono` VARCHAR(45) NULL,
  `Fecha_Nacimiento` DATE NOT NULL,
  `Fecha_Suscripcion` DATE NOT NULL,
  `Genero` VARCHAR(5) NOT NULL,
  `Nombre_Usuario` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  CONSTRAINT `PK_Usuarios_Registrados` PRIMARY KEY (`ID_Usuario`),
  CONSTRAINT `CHK_GENERO` CHECK(`Genero` IN('M','F','N/A'))
 )

-- -----------------------------------------------------
-- Table `id12846177_serprehn`.`Categoria_Servicio`
-- -----------------------------------------------------
CREATE TABLE `id12846177_serprehn`.`Categoria_Servicio` (
	`ID_Categoria_Servicio` INT NOT NULL,
	`Nombre_Categoria` VARCHAR(90) NOT NULL,
	CONSTRAINT `PK_Categoria_Servicio` PRIMARY KEY (`ID_Categoria_Servicio`)
)

-- -----------------------------------------------------
-- Table `id12846177_serprehn`.`Servicios_Publicados`
-- -----------------------------------------------------
CREATE TABLE `id12846177_serprehn`.`Servicios_Publicados` (
  `ID_Servicio` INT NOT NULL,
  `Imagen` BLOB NULL,
  `Nombre_Servicio` VARCHAR(45) NOT NULL,
  `Fecha_Publicacion` DATE NOT NULL,
  `Hora_Publicacion` TIME NOT NULL,
  `Resumen_Descripcion` VARCHAR(45) NULL,
  `Detalle_Descripcion` VARCHAR(100) NULL,
  `Precio` FLOAT NULL,
  `Moneda` VARCHAR(20) NULL,
  `ID_Usuario_Publicador` INT NOT NULL,
  `ID_Categoria_Servicio` INT NOT NULL,
  CONSTRAINT `PK_Servicios_Publicados` PRIMARY KEY (`ID_Servicio`),
  CONSTRAINT `CHK_MONEDA` CHECK(`Moneda` IN('Lempira','Dolar','Euro')),
  INDEX `fk_Servicios_Publicados_Usuarios_Registrados1_idx` (`ID_Usuario_Publicador` ASC),
  INDEX `fk_Servicios_Publicados_Categoria_Servicio1_idx` (`ID_Categoria_Servicio` ASC),
  CONSTRAINT `fk_Servicios_Publicados_Usuarios_Registrados1`
    FOREIGN KEY (`ID_Usuario_Publicador`)
    REFERENCES `id12846177_serprehn`.`Usuarios_Registrados` (`ID_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicios_Publicados_Categoria_Servicio1`
    FOREIGN KEY (`ID_Categoria_Servicio`)
    REFERENCES `id12846177_serprehn`.`Categoria_Servicio` (`ID_Categoria_Servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)


-- -----------------------------------------------------
-- Table `id12846177_serprehn`.`Chat`
-- -----------------------------------------------------
CREATE TABLE  `id12846177_serprehn`.`Chat` (
  `ID_Chat` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Mensaje` TEXT NOT NULL,
  `Fecha` DATE NOT NULL,
  `Hora` TIME NOT NULL,
  `ID_Usuario_Remitente` INT NOT NULL,
  `ID_Usuario_Destinatario` INT NOT NULL,
  `ID_Servicio_Solicitado` INT NOT NULL,
  PRIMARY KEY (`ID_Chat`),
  INDEX `fk_Chat_Usuarios_Registrados1_idx` (`ID_Usuario_Remitente` ASC),
  INDEX `fk_Chat_Usuarios_Registrados2_idx` (`ID_Usuario_Destinatario` ASC),
  INDEX `fk_Chat_Servicios_Publicados1_idx` (`ID_Servicio_Solicitado` ASC),
  CONSTRAINT `fk_Chat_Usuarios_Registrados1`
    FOREIGN KEY (`ID_Usuario_Remitente`)
    REFERENCES `id12846177_serprehn`.`Usuarios_Registrados` (`ID_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Chat_Usuarios_Registrados2`
    FOREIGN KEY (`ID_Usuario_Destinatario`)
    REFERENCES `id12846177_serprehn`.`Usuarios_Registrados` (`ID_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Chat_Servicios_Publicados1`
    FOREIGN KEY (`ID_Servicio_Solicitado`)
    REFERENCES `id12846177_serprehn`.`Servicios_Publicados` (`ID_Servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

