CREATE PROCEDURE SP_REGISTRAR_USUARIO(
					IN pcNombre VARCHAR(45),
					IN pcApellido VARCHAR(45),
					IN pcTelefono VARCHAR(45),
					IN pdFechaNacimiento DATE,
					IN pcGenero VARCHAR(15),
					IN pcUsername VARCHAR(45),
					IN pcEmail VARCHAR(45),
					IN pcPassword VARCHAR(45),
					OUT pnCodigoMensaje INT,
					OUT pcMensaje VARCHAR(1000)
					
				)
SP: BEGIN
	DECLARE vnIdUsuario,vnConteoIDUsuario,vnConteoEmail,vnConteoUsername INT;
	DECLARE vcGenero VARCHAR(5);
	/*DECLARE vcFechaNacimiento DATE;*/
	SET pnCodigoMensaje = 1;
	SET pcMensaje = "";
	
	SELECT COUNT(*) INTO vnConteoIDUsuario FROM Usuarios_Registrados;
	
	IF vnConteoIDUsuario = 0 THEN
		SET vnIdUsuario = 1;
	ELSE
		SELECT MAX(ID_Usuario) + 1 INTO vnIdUsuario FROM Usuarios_Registrados;
	END IF;
	
	IF pcGenero = 'Masculino' THEN
		SET vcGenero = 'M';
	ELSEIF pcGenero = 'Femenino' THEN
		SET vcGenero = 'F';
	ELSE
		SET vcGenero = 'N/A';
	END IF;
	
	SELECT COUNT(*) INTO vnConteoEmail FROM Usuarios_Registrados
	WHERE Email = pcEmail;
	
	IF vnConteoEmail > 0 THEN
		SET pcMensaje = "El correo ya esta registrado, ingrese otro correo u inicie sesion con el correo ingresado";
		LEAVE SP;
	END IF;
	
	SELECT COUNT(*) INTO vnConteoUsername FROM Usuarios_Registrados
	WHERE Nombre_Usuario = pcUsername;
	
	IF vnConteoUsername > 0 THEN
		SET pcMensaje = "El nombre de usuario ya esta registrado, ingrese otro nombre de usuario u inicie sesion con el usuario ingresado";
		LEAVE SP;
	END IF;
	
	/*SELECT STR_TO_DATE(pdFechaNacimiento,'%Y-%m-%d') INTO vcFechaNacimiento FROM Usuarios_Registrados;*/
	/*SELECT STR_TO_DATE(pdFechaNacimiento,'%Y-%m-%d') INTO vcFechaNacimiento;*/
	
	IF pcTelefono <> '' THEN
		INSERT INTO `Usuarios_Registrados`(`ID_Usuario`,`Nombre`,`Apellido`,`Numero_Telefono`,`Fecha_Nacimiento`,`Fecha_Suscripcion`,`Genero`,`Nombre_Usuario`,`Email`,`Password`,`Foto_Perfil`)
		VALUES (vnIdUsuario,pcNombre,pcApellido,pcTelefono,pdFechaNacimiento,CURRENT_DATE(),vcGenero,pcUsername,pcEmail,pcPassword,NULL);
		SET pnCodigoMensaje = 0;
		SET pcMensaje = "Registro realizado con exito";
	ELSE
		INSERT INTO `Usuarios_Registrados`(`ID_Usuario`,`Nombre`,`Apellido`,`Numero_Telefono`,`Fecha_Nacimiento`,`Fecha_Suscripcion`,`Genero`,`Nombre_Usuario`,`Email`,`Password`,`Foto_Perfil`)
		VALUES (vnIdUsuario,pcNombre,pcApellido,NULL,pdFechaNacimiento,CURRENT_DATE(),vcGenero,pcUsername,pcEmail,pcPassword,NULL);
		SET pnCodigoMensaje = 0;
		SET pcMensaje = "Registro realizado con exito";
	END IF;
END$$
	
	