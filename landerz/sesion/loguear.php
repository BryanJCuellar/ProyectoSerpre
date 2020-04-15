<?php
    include("../conexionBD/conexion.php");
    session_start();

    $emailuser = $_POST['nEmailUsername'];
    $password = $_POST['nPassword'];

    $pdo=getPDO();
    if($pdo){
        $sql = "SELECT ur.Email,ur.Nombre_Usuario,ur.Password,COUNT(*) AS Conteo FROM Usuarios_Registrados ur 
        WHERE (ur.Email='$emailuser' OR ur.Nombre_Usuario='$emailuser') AND ur.Password='$password'
        GROUP BY ur.Email,ur.Nombre_Usuario,ur.Password;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetch(PDO::FETCH_ASSOC);
        if($array['Conteo']>0){
            $_SESSION['name'] = $array['Nombre_Usuario'];
            $_SESSION['user'] = $array['Nombre_Usuario'];
            $_SESSION["autentificado"]= "SI";
            $_SESSION['tiempo'] = time();
            echo "Registro encontrado";
        }else{
            echo "Acceso Denegado: Usuario/Email incorrecto u Contraseña incorrecta";
        };
    } else {
        echo "Hubo un problema con la conexión";
    }
?>
