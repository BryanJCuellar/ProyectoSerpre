<?php
    include("../conexionBD/conexion.php");
    //Seguridad Sesion
    session_start(); 
    $inactivo = 3600;
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

    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/estilos.css">
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
        <div class="container-fluid background-container-greenmint py-5 px-5">
            <div class="row">
                <!--Parte Izquierda-->
                <div class="box-left py-5">
                    <div id="imagen-perfil-misservicios" class="mx-auto img-fluid" style="background-image: url(../images/Anonymous.png);"></div>
                    <!--<img id="imagen-perfil-misservicios" class="mx-auto img-fluid" src="../images/Anonymous.png" alt="Imagen Perfil">-->
                    <?php
                        echo '<div class="mt-3 mb-5" align="center"><h4 class="color-black"><b>Usuario: '.$_SESSION['user'].'</b></h4></div>';
                    ?>
                    <div class="mb-5" align="center"><a class="anchor-custom font-s-20" onclick="" ><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Publicar Servicio</a></div>
                </div>
                <!--Parte Derecha-->
                <div class="box-right px-1 py-5">
                    <div align="center" class="pb-5"><h2 class="color-black"><b>Mis Servicios</b></h2></div>
                    <div class="row mx-auto" id="misServicios">
                        <div class="col-xl-6 col-sm-12 mb-5">
                            <!--<div class="encabezado-imagen" style="background-image: url(../images/cursoPrueba.png);"></div>-->
                            <img src="../images/cursoPrueba.png" class="encabezado-imagen img-fluid" alt="Imagen-servicio">
                            <div class="contenido-informacion px-3 py-2">
                                <div class="titulo-servicio my-1">Nombre de Servicio 1</div>
                                <div class="resumen-servicio">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eius sed placeat quia iste vero doloribus delectus...</div>
                                <div class="detalle-servicio"></div>
                                <div class="likes-comentarios"></div>
                                <div class="ver-mas"><a>Ver más</a> | <a>Eliminar</a></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12 mb-5">
                            <!--<div class="encabezado-imagen" style="background-image: url(../images/cursoPrueba.png);"></div>-->
                            <img src="../images/cursoPrueba.png" class="encabezado-imagen img-fluid" alt="Imagen-servicio">
                            <div class="contenido-informacion px-3 py-2">
                                <div class="titulo-servicio my-1">Nombre de Servicio 2</div>
                                <div class="resumen-servicio">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eius sed placeat quia iste vero doloribus delectus...</div>
                                <div class="detalle-servicio"></div>
                                <div class="likes-comentarios"></div>
                                <div class="ver-mas"><a>Ver más</a> | <a>Eliminar</a></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12 mb-5">
                            <!--<div class="encabezado-imagen" style="background-image: url(../images/cursoPrueba.png);"></div>-->
                            <img src="../images/cursoPrueba.png" class="encabezado-imagen img-fluid" alt="Imagen-servicio">
                            <div class="contenido-informacion px-3 py-2">
                                <div class="titulo-servicio my-1">Nombre de Servicio 3</div>
                                <div class="resumen-servicio">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia eius sed placeat quia iste vero doloribus delectus...</div>
                                <div class="detalle-servicio"></div>
                                <div class="likes-comentarios"></div>
                                <div class="ver-mas"><a>Ver más</a> | <a>Eliminar</a></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div></div>
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
            </div>`
        </div>
    </div>
    <script src="../js/jquery.js"></script>
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
</body>
</html>