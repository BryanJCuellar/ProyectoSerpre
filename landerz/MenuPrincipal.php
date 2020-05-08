<?php
    include("conexionBD/conexion.php");
    include("sesion/seguridadsesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SerPre HN: Menú Principal</title>

    <link rel="icon" href="icon/NewLogo.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="css/estilos.css?v=<?php echo time(); ?>">
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
                <li style="list-style:none !important;"><a href="servicios/index.php" class="font-16-weight nav-link enlace-cursor-color">[Mis Servicios]</a></li>
                <li style="list-style:none !important;"><a href="../" class="font-16-weight nav-link enlace-cursor-color">[Página Principal]</a></li>
                <li style="list-style:none !important;"><a href="sesion/salir.php" class="font-16-weight nav-link enlace-cursor-color">[Cerrar Sesión]</a></li>
            </ul>
        </div>
        </div>
    
        <div class="container d-none d-lg-block">
        <div class="row">
            <div class="col-12 text-center mb-4 mt-5">
                <h1 class="mb-0 site-logo"><a href="../landerz/" class="text-black h2 mb-0">
                    <img src="images/NewLogoSerpre.png" alt="LogoImage" class="img-logo-nav img-fluid">
                </a></h1>
            </div>
        </div>
        </div>
        <header class="site-navbar py-md-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center">
                
                <div class="col-6 col-md-6 col-xl-2  d-block d-lg-none">
                    <h1 class="mb-0 site-logo"><a href="../landerz/" class="text-black h2 mb-0">SerPre HN<span class="text-primary">.</span> </a></h1>
                </div>
                <div>

                </div>
                <div class="col-12 col-md-12 main-menu">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu mr-auto d-none d-lg-block">
                            <li><a href="#" class="font-16-weight nav-link enlace-cursor-color">[Mi Perfil]</a></li>
                            <li><a href="servicios/index.php" class="font-16-weight nav-link enlace-cursor-color">[Mis Servicios]</a></li>
                            <li><a href="../" class="font-16-weight nav-link enlace-cursor-color">[Página Principal]</a></li>
                            <li><a href="sesion/salir.php" class="font-16-weight nav-link enlace-cursor-color">[Cerrar Sesión]</a></li>
                        </ul>
                    </nav>
                </div>


                <div class="col-6 col-md-6 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>
      
        </header><br><br><br>
        <div class="container-fluid background-container-menu">
            <div class="div-contenido-servicios">
                <?php
                    echo '<div><h5 class="color-w">Bienvenid@: <b>'.$_SESSION['user'].'</b> a nuestro menú de servicios</h5></div>';
                ?>
                <!--<div class="color-w font-s-20 my-5" align="right">-->
                    <!--<a id="publicarServicio" class="btn btn-info mr-2 mb-2" href = "#">Publica tu Servicio</a>-->
                <!--</div>-->
                <form class="color-w font-s-20 my-5 mr-3" align="right" action="" method ="">
                        <input type="text" name="nombre" placeholder="Buscar" class="search"><span><a href="#" class="color-w enlace-cursor-color ml-2"><i class="fas fa-search"></i></a></span>
                </form>
                <div align="center"><h2 class="color-w">SERVICIOS: CATEGORIAS</h2></div>
                <hr class="background-color-w"><br><br><br>
                <h4 class="color-w">Cursos</h4>
                <hr class="background-color-w"><br><br>
                <div></div>
                <h4 class="color-w">Tutorias</h4>
                <hr class="background-color-w"><br><br>
                <h4 class="color-w">Articulos de segunda mano</h4>
                <hr class="background-color-w"><br><br>
                <h4 class="color-w">Eventos</h4>
                <hr class="background-color-w"><br><br>
                <h4 class="color-w">Reparaciones</h4>
                <hr class="background-color-w"><br><br>


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
            </div>`
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sendEmail.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
</body>
</html>