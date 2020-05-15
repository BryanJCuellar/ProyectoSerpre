<?php
    include("../conexionBD/conexion.php");
    switch($_GET["accion"]){
        case "listar":
            $data = array();
            $idServicio = $_POST["idServicio"];
            $conexion = getPDO();
            if($conexion){
                $consulta = $conexion->query("SELECT ID_Servicio,Nombre_Servicio,Detalle_Descripcion,Precio,Moneda,Disponibilidad,ID_Categoria_Servicio FROM Servicios_Publicados WHERE ID_Servicio=$idServicio");
                if($consulta->rowCount() > 0){
                    $datosServicio = $consulta->fetch(PDO::FETCH_ASSOC);
                    $data['result'] = $datosServicio;
                    //Retorna datos en formato JSON
                    echo json_encode($data);
                }else{
                    echo "No se trajo informacion";
                }
            }else{
                echo "Hubo un problema con la conexión a la BD";
            }
            break;
        case "editar":
            $error = FALSE;
            $anexarCampos="";
            $idServicio = $idCategoria = $nombreServicio = $descripcion = $precio = $moneda = "";
            $disponibilidad = "Disponible";
            $maxsize = 1536; //1.5 MB
            if(!(empty($_POST["modal-categoria"]) || empty($_POST["modal-servicio"]) || empty($_POST["modal-descripcion"])
            || empty($_POST["modal-precio"]) || empty($_POST["modal-moneda"]) || !is_numeric($_POST["modal-precio"]) )){
                if(!isset($_POST['chk-disponible'])){
                    $disponibilidad = "No Disponible";
                }
                $idServicio = $_POST["IDservicio"];
                $idCategoria = $_POST["modal-categoria"];
                $nombreServicio = $_POST["modal-servicio"];
                $descripcion = $_POST["modal-descripcion"];
                $precio = $_POST["modal-precio"];
                $precio = number_format($precio, 2, '.', '');
                $precio = (float)$precio;
                $moneda = $_POST["modal-moneda"];
                $conexion = getPDO();
                if($conexion){
                    if(file_exists($_FILES['modal-imagen']['tmp_name'])){
                        $cargarArchivo = $_FILES['modal-imagen']['tmp_name'];
                        $imagen = fopen($cargarArchivo,'rb'); // Leer como binario
                        $tipoImagen = exif_imagetype($cargarArchivo);
                        if(($tipoImagen == IMAGETYPE_JPEG || $tipoImagen == IMAGETYPE_PNG) && $_FILES["modal-imagen"]["size"] < 1024 * $maxsize){
                            $query = "UPDATE `Servicios_Publicados` SET `Imagen` = :imagen WHERE `ID_Servicio` = :id";
                            $sql = $conexion->prepare($query);
                            $sql->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
                            $sql->bindParam(':id', $idServicio, PDO::PARAM_INT);
                            $sql->execute();
                            $sql->closeCursor(); //permite limpiar y ejecutar la segunda query
                        }else{
                            $error = TRUE;
                            echo '<script language="javascript">alert("Ocurrio un error con la imagen:Formato no valido o la imagen es mayor a 1.5 MB");</script>';   
                        }
                    }
                    if($error == FALSE){
                        $query2 = "UPDATE `Servicios_Publicados` SET `ID_Categoria_Servicio` = :idcategoria,
                        `Nombre_Servicio` = :nombreservicio, `Detalle_Descripcion` = :descripcion, `Precio` = :precio,
                        `Moneda` = :moneda, `Disponibilidad` = :disponibilidad WHERE `ID_Servicio` = :id";
                        $sql2 = $conexion->prepare($query2);
                        $sql2->bindParam(':idcategoria', $idCategoria, PDO::PARAM_INT);
                        $sql2->bindParam(':nombreservicio', $nombreServicio, PDO::PARAM_STR, 90);
                        $sql2->bindParam(':descripcion', $descripcion, PDO::PARAM_STR, 1000);
                        $sql2->bindParam(':precio', $precio, PDO::PARAM_STR);
                        $sql2->bindParam(':moneda', $moneda, PDO::PARAM_STR, 20);
                        $sql2->bindParam(':disponibilidad', $disponibilidad, PDO::PARAM_STR, 20);
                        $sql2->bindParam(':id', $idServicio, PDO::PARAM_INT);
                        $sql2->execute();
                        //En este punto todo debe estar bien
                        header("location:../servicios/index.php");
                    }
                } 
            }else if(!is_numeric($_POST["modal-precio"]) && !empty($_POST["modal-precio"])){
                echo '<script language="javascript">alert("Ingresar valor numérico en campo Precio")</script>';
            }else{
                if(empty($_POST["modal-servicio"])){
                    $anexarCampos = $anexarCampos . 'Nombre de Servicio ';
                }
                if(empty($_POST["modal-descripcion"])){
                    $anexarCampos = $anexarCampos . 'Descripcion ';
                }
                if(empty($_POST["modal-precio"])){
                    $anexarCampos = $anexarCampos . 'Precio ';
                }
                echo '<script language="javascript">alert("No es permitido enviar vacio los siguientes campos: '.$anexarCampos.'")</script>';
            }
            echo '<h2><a href="../servicios/index.php">Volver a Mis Servicios</a></h2>';
            break;
        case "eliminar":
            $idServicio = $_POST["idServicio"];
            $conexion = getPDO();
            if($conexion){
                $sql = $conexion->query("DELETE FROM Servicios_Publicados WHERE ID_Servicio=$idServicio");
                echo "Servicio Eliminado con Exito";
            }else{
                echo "Hubo un problema con la conexión a la BD";
            }
            break;
        default:
            echo "Acción inválida";
            break;
    }
?>