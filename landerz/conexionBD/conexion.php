<?php
function getPDO(){
    $servername = "localhost";
    $username = "id12846177_orlin";
    $password = "William$1000";

    try {
            $pdo = new PDO("mysql:host=$servername;dbname=id12846177_serprehn", $username, $password);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conectado exitosamente";
            return $pdo;
        }
    catch(PDOException $e)
        {
            echo "Conexión fallida: " . $e->getMessage();
            return null;
        }
}
?>