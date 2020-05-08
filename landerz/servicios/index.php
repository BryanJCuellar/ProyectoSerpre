<?php
    include("../conexionBD/conexion.php");
    //Seguridad Sesion
    session_start(); 
    $inactivo = 900;
    if (!isset($_SESSION['user'])){
        header("Location: ../login.php");
    }else{
        if(isset($_SESSION['tiempo']) ) {
            $vida_session = time() - $_SESSION['tiempo'];
                if($vida_session > $inactivo)
                {
                    foreach($_SESSION as $key => $value) {
                        $_SESSION[$key] = NULL;
                     }
                    session_destroy();
                    header("Location: ../login.php"); 
                }
        }        
        $_SESSION['tiempo'] = time();
    }
    $usuario = $_SESSION['user'];
    // Obtener idUsuario
    $pdo = getPDO();
    if($pdo){
        $consulta = $pdo->query('SELECT ID_Usuario FROM Usuarios_Registrados WHERE Nombre_Usuario = "'.$usuario.'"')->fetch(PDO::FETCH_ASSOC);
        $idUsuario = $consulta['ID_Usuario'];
    }else{
        echo "Hubo un problema con la conexion";
    }
    // Formulario publicar servicio submit
    // Definimos las variables
    //echo '<script language="javascript">alert("Afuera del request");</script>';
    $categoriaErr = $nombreErr = $archivoErr = $descripcionErr = $precioErr = "";
    $idCategoria = $nombre = $cargarArchivo = $descripcion = $precio = $moneda = "";
    $anexarCampos = "";
    $maxsize = 1536; //1.5 MB
    //Condicion para el form de method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["categoria-servicio"]) && isset($_POST["nombre-servicio"]) && 
        file_exists($_FILES['imagen-servicio']['tmp_name']) && isset($_POST["descripcion-servicio"]) && 
        isset($_POST["precio-servicio"]) && isset($_POST["tipo-moneda"])){
            $idCategoria = $_POST["categoria-servicio"];
            $nombre = $_POST["nombre-servicio"];
            $cargarArchivo = $_FILES['imagen-servicio']['tmp_name'];
            $archivo = fopen($cargarArchivo,'rb'); // Leer como binario
            $descripcion = $_POST["descripcion-servicio"];
            $precio = $_POST["precio-servicio"];
            $moneda = $_POST["tipo-moneda"];
            $tipoImagen = exif_imagetype($cargarArchivo);

            $conexion = getPDO();
            if(is_numeric($precio) && ($tipoImagen == IMAGETYPE_JPEG || $tipoImagen == IMAGETYPE_PNG) && $_FILES["imagen-servicio"]["size"] < 1024 * $maxsize){
                $precio = number_format($precio, 2, '.', '');
                $precio = (float)$precio;
                if($conexion){
                    // Llamada a procedimiento almacenado
                    $procedimientoPublicar = 'CALL SP_PUBLICAR_SERVICIO(:pcUsername,:pnIdCategoria,:pcNombreServicio,:plbImagen,:pcDescripcion,:pnPrecio,:pcMoneda,@codigoMensaje,@mensaje)';
                    $insertarServicio = $conexion->prepare($procedimientoPublicar);
                    $insertarServicio->bindParam(':pcUsername', $usuario, PDO::PARAM_STR, 45);
                    $insertarServicio->bindParam(':pnIdCategoria', $idCategoria, PDO::PARAM_INT);
                    $insertarServicio->bindParam(':pcNombreServicio', $nombre, PDO::PARAM_STR, 90);
                    $insertarServicio->bindParam(':plbImagen', $archivo, PDO::PARAM_LOB);
                    $insertarServicio->bindParam(':pcDescripcion', $descripcion, PDO::PARAM_STR, 1000);
                    $insertarServicio->bindParam(':pnPrecio', $precio, PDO::PARAM_STR);
                    $insertarServicio->bindParam(':pcMoneda', $moneda, PDO::PARAM_STR,10);
                    $insertarServicio->execute();

                    $insertarServicio->closeCursor(); //permite limpiar y ejecutar la segunda query
                    $salidaSP = '';
                    $salidaSP = $conexion->query("SELECT @codigoMensaje AS pnCodigoMensaje,@mensaje AS pcMensaje")->fetch(PDO::FETCH_ASSOC);
                    if($salidaSP['pnCodigoMensaje']==0 || $salidaSP['pnCodigoMensaje']==2){
                        echo '<script language="javascript">alert("'.$salidaSP['pcMensaje'].'")</script>';
                    }else{
                        echo '<script language="javascript">alert("Ocurrio un error: "'.$salidaSP['pcMensaje'].'")</script>';
                    }
                }else{
                    echo '<script language="javascript">alert("Hubo un problema con la conexión a la BD")</script>';
                }

                //echo '<script language="javascript">alert("Datos correctos '.$tipoImagen.'")</script>';
                
            }else if(!is_numeric($precio)){
                echo '<script language="javascript">alert("Ingresar valor numérico en campo Precio: '.$precio.' no es numérico");</script>';
                $precioErr = "Se requiere valor numérico";
            }else if($_FILES["imagen-servicio"]["size"] >= 1024 * $maxsize){
                echo '<script language="javascript">alert("La imagen debe ser menor a 1.5 MB");</script>';
            }else if($tipoImagen != IMAGETYPE_JPEG && $tipoImagen != IMAGETYPE_PNG){
                echo '<script language="javascript">alert("Formato de imagen no valido");</script>';
            }else{
                echo '<script language="javascript">alert("Error desconocido: Intente de nuevo");</script>';
            }
        }else{
            if (empty($_POST["categoria-servicio"])) {
                $categoriaErr = "Campo Requerido";
                $anexarCampos = $anexarCampos . '\nCategoria';
            }
            if (empty($_POST["nombre-servicio"])) {
                $nombreErr = "Campo Requerido";
                $anexarCampos = $anexarCampos . '\nNombre';
            }
            if (!file_exists($_FILES['imagen-servicio']['tmp_name'])) {
                $archivoErr = "Campo Requerido";
                $anexarCampos = $anexarCampos . '\nImagen';
            }
            if (empty($_POST["descripcion-servicio"])) {
                $descripcionErr = "Campo Requerido";
                $anexarCampos = $anexarCampos . '\nDescripcion';
            }
            if (empty($_POST["precio-servicio"])) {
                $precioErr = "Campo Requerido";
                $anexarCampos = $anexarCampos . '\nPrecio';
            }
            echo '<script language="javascript">alert("No se llenaron los campos requeridos:'.$anexarCampos.'");</script>';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SerPre HN: Mis Servicios</title>

    <link rel="icon" href="../icon/NewLogo.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/estilos.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163223137-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-163223137-1');
    </script>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body">
            <ul>
                <li style="list-style:none !important;"><a href="#" class="font-16-weight nav-link enlace-cursor-color">[Mi Perfil]</a></li>
                <li style="list-style:none !important;"><a href="../MenuPrincipal.php" class="font-16-weight nav-link enlace-cursor-color">[Menú Principal]</a></li>
                <li style="list-style:none !important;"><a href="../" class="font-16-weight nav-link enlace-cursor-color">[Página Principal]</a></li>
                <li style="list-style:none !important;"><a href="sesion/salir.php" class="font-16-weight nav-link enlace-cursor-color">[Cerrar Sesión]</a></li>
            </ul>
        </div>
        </div>
    
        <div class="container d-none d-lg-block">
        <div class="row">
            <div class="col-12 text-center mb-4 mt-5">
                <h1 class="mb-0 site-logo"><a href="../" class="text-black h2 mb-0">
                    <img src="../images/NewLogoSerpre.png" alt="LogoImage" class="img-logo-nav img-fluid">
                </a></h1>
            </div>
        </div>
        </div>
        <header class="site-navbar py-md-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center">
                
                <div class="col-6 col-md-6 col-xl-2  d-block d-lg-none">
                    <h1 class="mb-0 site-logo"><a href="../" class="text-black h2 mb-0">SerPre HN<span class="text-primary">.</span> </a></h1>
                </div>
                <div>

                </div>
                <div class="col-12 col-md-12 main-menu">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu mr-auto d-none d-lg-block">
                            <li><a href="#" class="font-16-weight nav-link enlace-cursor-color">[Mi Perfil]</a></li>
                            <li><a href="../MenuPrincipal.php" class="font-16-weight nav-link enlace-cursor-color">[Menú Principal]</a></li>
                            <li><a href="../" class="font-16-weight nav-link enlace-cursor-color">[Página Principal]</a></li>
                            <li><a href="../sesion/salir.php" class="font-16-weight nav-link enlace-cursor-color">[Cerrar Sesión]</a></li>
                        </ul>
                    </nav>
                </div>


                <div class="col-6 col-md-6 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>
      
        </header><br><br><br>
        <div class="container-fluid background-container-greenmint py-5">
            <div class="row px-2">
                <!--Parte Izquierda-->
                <div class="box-left py-5">
                    <div id="imagen-perfil-misservicios" class="mx-auto img-fluid" style="background-image: url(../images/Anonymous.png);"></div>
                    <!--<img id="imagen-perfil-misservicios" class="mx-auto img-fluid" src="../images/Anonymous.png" alt="Imagen Perfil">-->
                    <?php
                        echo '<div class="mt-3 mb-5" align="center"><h4 class="color-black"><b>Usuario: '.$usuario.'</b></h4></div>';
                    ?>
                    <div id="div-link-publish" class="mb-2" align="center"><a class="anchor-custom font-s-20" onclick="mostrarFormularioPublicarServicio();" ><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Publicar un nuevo servicio</a></div>
                    <!--Formulario de publicar servicio-->
                    <form id="id-form-publish" class="form-publish my-5" style="display:none;" onSubmit="return confirm('Seguro que desea publicar el servicio?')" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                        <div align="center" class="color-black mb-5"><h2><b>Publicar servicio</b></h2></div>
                        <div class="form-inner-publish">
                            <label for="categoria-servicio" class="color-black ml-1"><b>Seleccione la Categoría:</b></label>
                            <div class="error-form mb-1"><?php echo $categoriaErr; ?></div>
                            <select name="categoria-servicio" class="form-control mb-3">
                                <option value="">Seleccionar</option>
                                <!--Consulta para obtener categorias de servicio-->
                                <?php
                                    $conexion = getPDO();
                                    if($conexion){
                                        $listcategoria = $conexion->query("SELECT ID_Categoria_Servicio,Nombre_Categoria FROM Categoria_Servicio");
                                        while($filaCategoria=$listcategoria->fetch(PDO::FETCH_ASSOC)){
                                            echo '<option value="'.$filaCategoria['ID_Categoria_Servicio'].'">'.$filaCategoria['Nombre_Categoria'].'</option>';
                                        }

                                    } else {
                                        echo '<option value="">Hubo un problema con la conexión a la BD</option>';
                                    }
                                ?>
                            </select>
                            <label for="nombre-servicio" class="color-black ml-1"><b>Nombre del Servicio:</b></label>
                            <div class="error-form mb-1"><?php echo $nombreErr; ?></div>
                            <input name="nombre-servicio" type="text" class="form-control mb-3" placeholder="Nombre" maxlength="90">
                            <label for="imagen-servicio" class="color-black ml-1"><b>Subir Imagen del Servicio: (Formato PNG o JPG)</b></label>
                            <div class="error-form mb-1"><?php echo $archivoErr; ?></div>
                            <input name="imagen-servicio" type="file" class="form-control mb-3" accept="image/*">
                            <label for="descripcion-servicio" class="color-black ml-1"><b>Descripción del Servicio: (Máx. 500 caracteres)</b></label>
                            <div class="error-form mb-1"><?php echo $descripcionErr; ?></div>
                            <textarea name="descripcion-servicio" class="form-control mb-3" rows="5" maxlength="500"></textarea>
                            <label for="precio-servicio" class="color-black ml-1"><b>Precio:</b>
                            <div class="error-form mb-1"><?php echo $precioErr; ?></div>
                            <input name="precio-servicio" type="text" class="form-control mb-3" placeholder="Precio"></label>
                            <label for="tipo-moneda" class="color-black ml-1"><b>Moneda:</b><select name="tipo-moneda" class="form-control"><option value="Lps.">Lempira</option><option value="$">Dólar</option><option value="€">Euro</option></select></label>
                            <!--<label for="disponibilidad" class="color-black ml-1"><b>Disponibilidad:</b></label><br>
                            <div id="div-error-disponibilidad" class="error mb-1">*Campo Requerido</div>
                            <input id="available" class="mx-1" type="radio" name="disponibilidad" value="V">Disponible
                            <input id="no-available" class="mx-1" type="radio" name="disponibilidad" value="F">No Disponible-->
                            <div align="center" class="my-5">
                                <button name="btn-publish" class="btn btn-lg btn-primary boton-login" type="submit">Publicar Servicio</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--Parte Derecha-->
                <div class="box-right px-1 py-5">
                    <div align="center" class="pb-5"><h2 class="color-black"><b>Mis Servicios</b></h2></div>
                    <?php
                        //Conteo servicios
                        $conexion = getPDO();
                        $cadenaResumen = '';
                        $contadorCaracteres = 0;
                        if($conexion){
                            $cantidadServicios = $conexion->query("SELECT COUNT(*) AS Cantidad FROM Servicios_Publicados 
                            WHERE ID_Usuario_Publicador = $idUsuario")->fetch(PDO::FETCH_ASSOC);
                            if($cantidadServicios['Cantidad']>0){
                                //Cursos
                                $cantidadCursos = $conexion->query("SELECT COUNT(*) AS Cantidad FROM Servicios_Publicados 
                                WHERE ID_Categoria_Servicio = 1 AND ID_Usuario_Publicador = $idUsuario")->fetch(PDO::FETCH_ASSOC);
                                if($cantidadCursos['Cantidad']>0){
                                    echo '<div id="div-link-cursos" class="mb-4 ml-5" align="left"><a onclick="mostrarCursos();" class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;<b>Cursos</b></a></div>
                                        <div id="div-cursos" class="row misServicios mx-auto" style="display:none;">
                                        ';
                                    $listCursos = $conexion->query("SELECT * FROM Servicios_Publicados 
                                    WHERE ID_Categoria_Servicio = 1 AND ID_Usuario_Publicador = $idUsuario
                                    ORDER BY Fecha_Publicacion,Hora_Publicacion");
                                    while($filaCurso=$listCursos->fetch(PDO::FETCH_ASSOC)){
                                        echo '
                                        <div class="col-xl-6 col-sm-12 mb-5">
                                            <div><img src="data:image/png;base64, '.base64_encode($filaCurso['Imagen']).'" class="encabezado-imagen img-fluid" alt="Imagen-servicio"><span class="span-disponibilidad">'.$filaCurso['Disponibilidad'].'</span></div>
                                            <div class="contenido-informacion px-3 py-2">
                                                <div class="titulo-servicio my-1">'.$filaCurso['Nombre_Servicio'].'</div>';
                                        $contadorCaracteres = strlen($filaCurso['Detalle_Descripcion']);
                                        if($contadorCaracteres>120){
                                            $cadenaResumen = substr($filaCurso['Detalle_Descripcion'],0,120)." ...";
                                            echo '<div id="desc'.$filaCurso['ID_Servicio'].'">
                                                    <div class="descripcion-servicio">'.$cadenaResumen.'</div>
                                                    <div class="ver-mas"><a onclick="verMas('.$filaCurso['ID_Servicio'].');">Ver más</a></div>
                                                </div>';
                                        }else{
                                            echo '<div class="descripcion-servicio">'.$filaCurso['Detalle_Descripcion'].'</div>';      
                                        }
                                        if($filaCurso['Moneda'] == "$"){
                                            echo '<div class="precio font-s-24 my-1">'.$filaCurso['Moneda']." ".$filaCurso['Precio'].'</div>';
                                        }else{
                                            echo '<div class="precio font-s-24 my-1">'.$filaCurso['Precio']." ".$filaCurso['Moneda'].'</div>';
                                        }
                                            echo '<div class="font-s-14 mb-1">Publicado el '.$filaCurso['Fecha_Publicacion'].'</div>
                                                <div><a onclick="unavailable();" class="editar-eliminar">Editar</a> | <a onclick="unavailable();" class="editar-eliminar">Eliminar</a></div>
                                            </div>
                                        </div>';
                                    }
                                    echo '</div>';
                                }//Fin Cursos
                                //Tutorias
                                $cantidadTutorias = $conexion->query("SELECT COUNT(*) AS Cantidad FROM Servicios_Publicados 
                                WHERE ID_Categoria_Servicio = 2 AND ID_Usuario_Publicador = $idUsuario")->fetch(PDO::FETCH_ASSOC);
                                if($cantidadTutorias['Cantidad']>0){
                                    echo '<div id="div-link-tutorias" class="mb-4 ml-5" align="left"><a onclick="mostrarTutorias();" class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;<b>Tutorias</b></a></div>
                                        <div id="div-tutorias" class="row misServicios mx-auto" style="display:none;">
                                        ';
                                    $listTutorias = $conexion->query("SELECT * FROM Servicios_Publicados 
                                    WHERE ID_Categoria_Servicio = 2 AND ID_Usuario_Publicador = $idUsuario 
                                    ORDER BY Fecha_Publicacion,Hora_Publicacion");
                                    while($filaTutoria=$listTutorias->fetch(PDO::FETCH_ASSOC)){
                                        echo '
                                        <div class="col-xl-6 col-sm-12 mb-5">
                                            <div><img src="data:image/png;base64, '.base64_encode($filaTutoria['Imagen']).'" class="encabezado-imagen img-fluid" alt="Imagen-servicio"><span class="span-disponibilidad">'.$filaTutoria['Disponibilidad'].'</span></div>
                                            <div class="contenido-informacion px-3 py-2">
                                                <div class="titulo-servicio my-1">'.$filaTutoria['Nombre_Servicio'].'</div>';
                                        $contadorCaracteres = strlen($filaTutoria['Detalle_Descripcion']);
                                        if($contadorCaracteres>120){
                                            $cadenaResumen = substr($filaTutoria['Detalle_Descripcion'],0,120)." ...";
                                            echo '<div id="desc'.$filaTutoria['ID_Servicio'].'">
                                                    <div class="descripcion-servicio">'.$cadenaResumen.'</div>
                                                    <div class="ver-mas"><a onclick="verMas('.$filaTutoria['ID_Servicio'].');">Ver más</a></div>
                                                </div>';
                                        }else{
                                            echo '<div class="descripcion-servicio">'.$filaTutoria['Detalle_Descripcion'].'</div>';      
                                        }
                                        if($filaTutoria['Moneda'] == "$"){
                                            echo '<div class="precio font-s-24 my-1">'.$filaTutoria['Moneda']." ".$filaTutoria['Precio'].'</div>';
                                        }else{
                                            echo '<div class="precio font-s-24 my-1">'.$filaTutoria['Precio']." ".$filaTutoria['Moneda'].'</div>';
                                        }
                                            echo '<div class="font-s-14 mb-1">Publicado el '.$filaTutoria['Fecha_Publicacion'].'</div>
                                                <div><a onclick="unavailable();" class="editar-eliminar">Editar</a> | <a onclick="unavailable();" class="editar-eliminar">Eliminar</a></div>
                                            </div>
                                        </div>';
                                    }
                                    echo '</div>';
                                    
                                }//Fin Tutorias
                                //Articulos de segunda mano
                                $cantidadArticulos = $conexion->query("SELECT COUNT(*) AS Cantidad FROM Servicios_Publicados 
                                WHERE ID_Categoria_Servicio = 3 AND ID_Usuario_Publicador = $idUsuario")->fetch(PDO::FETCH_ASSOC);
                                if($cantidadArticulos['Cantidad']>0){
                                    echo '<div id="div-link-articulos" class="mb-4 ml-5" align="left"><a onclick="mostrarArticulos();" class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;<b>Articulos de segunda mano</b></a></div>
                                        <div id="div-articulos" class="row misServicios mx-auto" style="display:none;">
                                        ';
                                    $listArticulos = $conexion->query("SELECT * FROM Servicios_Publicados 
                                    WHERE ID_Categoria_Servicio = 3 AND ID_Usuario_Publicador = $idUsuario 
                                    ORDER BY Fecha_Publicacion,Hora_Publicacion");
                                    while($filaArticulo=$listArticulos->fetch(PDO::FETCH_ASSOC)){
                                        echo '
                                        <div class="col-xl-6 col-sm-12 mb-5">
                                            <div><img src="data:image/png;base64, '.base64_encode($filaArticulo['Imagen']).'" class="encabezado-imagen img-fluid" alt="Imagen-servicio"><span class="span-disponibilidad">'.$filaArticulo['Disponibilidad'].'</span></div>
                                            <div class="contenido-informacion px-3 py-2">
                                                <div class="titulo-servicio my-1">'.$filaArticulo['Nombre_Servicio'].'</div>';
                                        $contadorCaracteres = strlen($filaArticulo['Detalle_Descripcion']);
                                        if($contadorCaracteres>120){
                                            $cadenaResumen = substr($filaArticulo['Detalle_Descripcion'],0,120)." ...";
                                            echo '<div id="desc'.$filaArticulo['ID_Servicio'].'">
                                                    <div class="descripcion-servicio">'.$cadenaResumen.'</div>
                                                    <div class="ver-mas"><a onclick="verMas('.$filaArticulo['ID_Servicio'].');">Ver más</a></div>
                                                </div>';
                                        }else{
                                            echo '<div class="descripcion-servicio">'.$filaArticulo['Detalle_Descripcion'].'</div>';      
                                        }
                                        if($filaArticulo['Moneda'] == "$"){
                                            echo '<div class="precio font-s-24 my-1">'.$filaArticulo['Moneda']." ".$filaArticulo['Precio'].'</div>';
                                        }else{
                                            echo '<div class="precio font-s-24 my-1">'.$filaArticulo['Precio']." ".$filaArticulo['Moneda'].'</div>';
                                        }
                                            echo '<div class="font-s-14 mb-1">Publicado el '.$filaArticulo['Fecha_Publicacion'].'</div>
                                                <div><a onclick="unavailable();" class="editar-eliminar">Editar</a> | <a onclick="unavailable();" class="editar-eliminar">Eliminar</a></div>
                                            </div>
                                        </div>';
                                    }
                                    echo '</div>';
                                    
                                }//Fin Articulos de segunda mano
                                //Eventos
                                $cantidadEventos = $conexion->query("SELECT COUNT(*) AS Cantidad FROM Servicios_Publicados 
                                WHERE ID_Categoria_Servicio = 4 AND ID_Usuario_Publicador = $idUsuario")->fetch(PDO::FETCH_ASSOC);
                                if($cantidadEventos['Cantidad']>0){
                                    echo '<div id="div-link-eventos" class="mb-4 ml-5" align="left"><a onclick="mostrarEventos();" class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;<b>Eventos</b></a></div>
                                        <div id="div-eventos" class="row misServicios mx-auto" style="display:none;">
                                        ';
                                    $listEventos = $conexion->query("SELECT * FROM Servicios_Publicados 
                                    WHERE ID_Categoria_Servicio = 4 AND ID_Usuario_Publicador = $idUsuario 
                                    ORDER BY Fecha_Publicacion,Hora_Publicacion");
                                    while($filaEvento=$listEventos->fetch(PDO::FETCH_ASSOC)){
                                        echo '
                                        <div class="col-xl-6 col-sm-12 mb-5">
                                            <div><img src="data:image/png;base64, '.base64_encode($filaEvento['Imagen']).'" class="encabezado-imagen img-fluid" alt="Imagen-servicio"><span class="span-disponibilidad">'.$filaEvento['Disponibilidad'].'</span></div>
                                            <div class="contenido-informacion px-3 py-2">
                                                <div class="titulo-servicio my-1">'.$filaEvento['Nombre_Servicio'].'</div>';
                                        $contadorCaracteres = strlen($filaEvento['Detalle_Descripcion']);
                                        if($contadorCaracteres>120){
                                            $cadenaResumen = substr($filaEvento['Detalle_Descripcion'],0,120)." ...";
                                            echo '<div id="desc'.$filaEvento['ID_Servicio'].'">
                                                    <div class="descripcion-servicio">'.$cadenaResumen.'</div>
                                                    <div class="ver-mas"><a onclick="verMas('.$filaEvento['ID_Servicio'].');">Ver más</a></div>
                                                </div>';
                                        }else{
                                            echo '<div class="descripcion-servicio">'.$filaEvento['Detalle_Descripcion'].'</div>';      
                                        }
                                        if($filaEvento['Moneda'] == "$"){
                                            echo '<div class="precio font-s-24 my-1">'.$filaEvento['Moneda']." ".$filaEvento['Precio'].'</div>';
                                        }else{
                                            echo '<div class="precio font-s-24 my-1">'.$filaEvento['Precio']." ".$filaEvento['Moneda'].'</div>';
                                        }
                                            echo '<div class="font-s-14 mb-1">Publicado el '.$filaEvento['Fecha_Publicacion'].'</div>
                                                <div><a onclick="unavailable();" class="editar-eliminar">Editar</a> | <a onclick="unavailable();" class="editar-eliminar">Eliminar</a></div>
                                            </div>
                                        </div>';
                                    }
                                    echo '</div>';
                                    
                                }// Fin Eventos
                                //Reparaciones
                                //$pdo = getPDO();
                                $cantidadReparaciones = $conexion->query("SELECT COUNT(*) AS Cantidad FROM Servicios_Publicados 
                                WHERE ID_Categoria_Servicio = 5 AND ID_Usuario_Publicador = $idUsuario")->fetch(PDO::FETCH_ASSOC);
                                if($cantidadReparaciones['Cantidad']>0){
                                    echo '<div id="div-link-reparaciones" class="mb-4 ml-5" align="left"><a onclick="mostrarReparaciones();" class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;<b>Reparaciones</b></a></div>
                                        <div id="div-reparaciones" class="row misServicios mx-auto" style="display:none;">
                                        ';
                                    $listReparaciones = $conexion->query("SELECT * FROM Servicios_Publicados 
                                    WHERE ID_Categoria_Servicio = 5 AND ID_Usuario_Publicador = $idUsuario 
                                    ORDER BY Fecha_Publicacion,Hora_Publicacion");
                                    while($filaReparacion=$listReparaciones->fetch(PDO::FETCH_ASSOC)){
                                        echo '
                                        <div class="col-xl-6 col-sm-12 mb-5">
                                            <div><img src="data:image/png;base64, '.base64_encode($filaReparacion['Imagen']).'" class="encabezado-imagen img-fluid" alt="Imagen-servicio"><span class="span-disponibilidad">'.$filaReparacion['Disponibilidad'].'</span></div>
                                            <div class="contenido-informacion px-3 py-2">
                                                <div class="titulo-servicio my-1">'.$filaReparacion['Nombre_Servicio'].'</div>';
                                        $contadorCaracteres = strlen($filaReparacion['Detalle_Descripcion']);
                                        if($contadorCaracteres>120){
                                            $cadenaResumen = substr($filaReparacion['Detalle_Descripcion'],0,120)." ...";
                                            echo '<div id="desc'.$filaReparacion['ID_Servicio'].'">
                                                    <div class="descripcion-servicio">'.$cadenaResumen.'</div>
                                                    <div class="ver-mas"><a onclick="verMas('.$filaReparacion['ID_Servicio'].');">Ver más</a></div>
                                                </div>';
                                        }else{
                                            echo '<div class="descripcion-servicio">'.$filaReparacion['Detalle_Descripcion'].'</div>';      
                                        }
                                        if($filaReparacion['Moneda'] == "$"){
                                            echo '<div class="precio font-s-24 my-1">'.$filaReparacion['Moneda']." ".$filaReparacion['Precio'].'</div>';
                                        }else{
                                            echo '<div class="precio font-s-24 my-1">'.$filaReparacion['Precio']." ".$filaReparacion['Moneda'].'</div>';
                                        }
                                            echo '<div class="font-s-14 mb-1">Publicado el '.$filaReparacion['Fecha_Publicacion'].'</div>
                                                <div><a onclick="unavailable();" class="editar-eliminar">Editar</a> | <a onclick="unavailable();" class="editar-eliminar">Eliminar</a></div>
                                            </div>
                                        </div>';
                                    }
                                    echo '</div>';
                                    
                                }//Fin Reparaciones
                            }else{
                                echo '<div align="center" class="pb-5 color-black"><h5>No tiene servicios publicados</h5></div>';
                            }

                        }else{
                            echo '<div align="center" class="pb-5"><h4>No se pudo conectar a la BD</h4></div>';
                        }
                    ?>
                <!--<div id="div-link-Cursos" class="mb-4 ml-5" align="left"><a class="anchor-custom font-s-24" onclick="mostrarCategoria('Cursos');" ><i class="fas fa-caret-right"></i>&nbsp;&nbsp;<b>Cursos</b></a></div>
                    <div id="div-Cursos" class="row misServicios mx-auto" style="display:none;">
                        <div class="col-xl-6 col-sm-12 mb-5">
                            <div><img src="../images/cursoPrueba.png" class="encabezado-imagen img-fluid" alt="Imagen-servicio"><span class="span-disponibilidad">Disponible</span></div>
                            <div class="contenido-informacion px-3 py-2">
                                <div class="titulo-servicio my-1">Nombre de Servicio 1</div>
                                <div class="descripcion-servicio">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eius sed placeat quia iste vero doloribus delectus...</div>
                                <div class="ver-mas"><a onclick="verMas();">Ver más</a></div>
                                <div class="precio font-s-24 my-1">120.99 Lps.</div>
                                <div class="font-s-14 mb-1">Publicado el 20-03-2020</div>
                                <div><a class="editar-eliminar">Editar</a> | <a class="editar-eliminar">Eliminar</a></div>
                            </div>
                        </div>
                    </div>-->
                    
                </div>
            </div>
        </div>
        <div class="footer py-5 border-top text-center">
            <div class="container">
                <div class="row mb-5">
                <div class="col-12">
                    <p class="mb-0">
                    <a href="#" class="p-3 a-color"><span class="icon-facebook"></span></a>
                    <a href="#" class="p-3 a-color"><span class="icon-twitter"></span></a>
                    <a href="#" class="p-3 a-color"><span class="icon-instagram"></span></a>
                    </p>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <p class="mb-0 a-color">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>  <i class="" aria-hidden="true"></i> <a href="" target="_blank" ></a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sendEmail.js"></script>
    <script src="../js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/jquery.countdown.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/controladorServicio.js"></script>
</body>
</html>