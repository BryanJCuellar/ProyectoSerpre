CREATE PROCEDURE SP_PUBLICAR_SERVICIO(
					IN pcUsername VARCHAR(45),
					IN pnIdCategoria INT,
					IN pcNombreServicio VARCHAR(90),
					IN plbImagen LONGBLOB,
					IN pcDescripcion VARCHAR(1000),
					IN pnPrecio FLOAT,
					IN pcMoneda VARCHAR(10),
					OUT pnCodigoMensaje INT,
					OUT pcMensaje VARCHAR(1000)
				)
SP: BEGIN
	DECLARE vnIdUsuarioPublicar,vnIdServicio,vnConteoIDServicio,vnConteoTemp INT;
	DECLARE vcResumenDescripcion VARCHAR(120);
	DECLARE vcDisponible CHAR(1);
	SET pnCodigoMensaje = 1;
	SET pcMensaje = "";
	SET vcDisponible = 'V';
	/*Obtener el ID_Usuario*/
	SELECT ID_Usuario INTO vnIdUsuarioPublicar FROM Usuarios_Registrados
	WHERE Nombre_Usuario = pcUsername;
	/*Obtener el ID_Servicio*/
	SELECT COUNT(*) INTO vnConteoIDServicio FROM Servicios_Publicados;
	
	IF vnConteoIDServicio > 0 THEN
		SELECT MAX(ID_Servicio) + 1 INTO vnIdServicio FROM Servicios_Publicados;
	ELSE
		SET vnIdServicio = 1;
	END IF;
	
	/*Campo Resumen_Descripcion*/
	SELECT SUBSTRING(pcDescripcion,1,120) INTO vcResumenDescripcion FROM Servicios_Publicados;
	
	/*Evitar que el usuario pueda repetir la informacion debido al form resubmission*/
	/*Que no se repita un servicio con mismo nombre,categoria,usuario y descripcion*/
	SELECT COUNT(*) INTO vnConteoTemp FROM Servicios_Publicados
	WHERE Nombre_Servicio = pcNombreServicio AND ID_Categoria_Servicio = pnIdCategoria AND ID_Usuario_Publicador = vnIdUsuarioPublicar
	AND Detalle_Descripcion = pcDescripcion;
	
	IF vnConteoTemp > 0 THEN
		SET pcMensaje = "Ya ha publicado este servicio";
		LEAVE SP;
	END IF;
	
	/*Todo esta bien para insertar en este punto*/
	INSERT INTO `Servicios_Publicados`(`ID_Servicio`,`Imagen`,`Nombre_Servicio`,`Fecha_Publicacion`,`Hora_Publicacion`,`Resumen_Descripcion`,`Detalle_Descripcion`,`Precio`,`Moneda`,`Disponible`,`ID_Usuario_Publicador`,`ID_Categoria_Servicio`) 
	VALUES(vnIdServicio,plbImagen,pcNombreServicio,CURRENT_DATE(),CURRENT_TIME(),vcResumenDescripcion,pcDescripcion,pnPrecio,pcMoneda,vcDisponible,vnIdUsuarioPublicar,pnIdCategoria);
	SET pnCodigoMensaje = 0;
	SET pcMensaje = "Servicio publicado con exito";
END$$