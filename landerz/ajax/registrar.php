<?php
    include("../conexionBD/conexion.php");

    $nombre=$_POST["nNombre"];
    $apellido=$_POST["nApellido"];
    $telefono = "";
    if($_POST["nTelefono"] != ''){
        $telefono = $_POST["nTelefono"];
    }
    $fechaNacimiento = $_POST["nFechaNacimiento"];
    $genero = $_POST["nGenero"];
    $username = $_POST["nUsername"];
    $email=$_POST["nEmail"];
    $password=$_POST["nPassword"];

    $pdo = getPDO();
    if($pdo){
        // Llamada a procedimiento almacenado
        $sql = 'CALL SP_REGISTRAR_USUARIO(:pcNombre,:pcApellido,:pcTelefono,:pdFechaNacimiento,:pcGenero,:pcUsername,:pcEmail,:pcPassword,@codigoMensaje,@mensaje)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':pcNombre', $nombre, PDO::PARAM_STR, 45);
        $stmt->bindParam(':pcApellido', $apellido, PDO::PARAM_STR, 45);
        $stmt->bindParam(':pcTelefono', $telefono, PDO::PARAM_STR, 45);
        /*$stmt->bindParam(':pdFechaNacimiento', $fechaNacimiento, PDO::PARAM_STR, 10);*/
        $stmt->bindParam(':pdFechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':pcGenero', $genero, PDO::PARAM_STR, 15);
        $stmt->bindParam(':pcUsername', $username, PDO::PARAM_STR, 45);
        $stmt->bindParam(':pcEmail', $email, PDO::PARAM_STR, 45);
        $stmt->bindParam(':pcPassword', $password, PDO::PARAM_STR, 45);
        $stmt->execute();

        $stmt->closeCursor(); //permite limpiar y ejecutar la segunda query
        $resultado = '';
        $resultado = $pdo->query("SELECT @codigoMensaje AS pnCodigoMensaje,@mensaje AS pcMensaje")->fetch(PDO::FETCH_ASSOC);
        //$array=$resultado->fetch(PDO::FETCH_ASSOC);

        if($resultado['pnCodigoMensaje']==0){
            echo $resultado['pcMensaje'];
            /*header("location: ../login.php");*/
        }else{
            echo "Ocurrio un error: ".$resultado['pcMensaje'];

        }
    } else {
        echo "Hubo un problema con la conexión";
    }




?>