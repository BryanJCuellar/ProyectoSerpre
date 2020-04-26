<?php
    include("../conexionBD/conexion.php");

    $idServicio = $_POST["nIdServicio"];
    $estado = $_POST["nEstado"];
    $cadenaResumen = '';
    $conexion = getPDO();
    if($conexion){
        $consulta=$conexion->query("SELECT Detalle_Descripcion FROM Servicios_Publicados WHERE ID_Servicio=$idServicio")->fetch(PDO::FETCH_ASSOC);
        if($estado == "verMas"){
            echo $consulta['Detalle_Descripcion'];
        }else if($estado == "verMenos"){
            $cadenaResumen = substr($consulta['Detalle_Descripcion'],0,120)." ...";
            echo $cadenaResumen;
        }else{
            echo "Ocurrio un error con el estado del parametro de la peticion asincrona";
        }
    }else{
        echo "Hubo un problema con la conexión a la BD";
    }
?>