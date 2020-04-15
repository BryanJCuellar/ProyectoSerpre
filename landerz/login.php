<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SerPre HN: Login</title>

    <link rel="icon" href="icon/NewLogo.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
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
                <li style="list-style:none !important;"><a href="index.php" class="font-16-weight nav-link">[Página Principal]</a></li>
            </ul>
        </div>
        </div>
    
        <div class="container d-none d-lg-block">
        <div class="row">
            <div class="col-12 text-center mb-4 mt-5">
                <h1 class="mb-0 site-logo"><a href="index.php" class="text-black h2 mb-0">
                    <img src="images/NewLogoSerpre.png" alt="LogoImage" class="img-logo-nav img-fluid">
                </a></h1>
            </div>
        </div>
        </div>
        <header class="site-navbar py-md-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center">
                
                <div class="col-6 col-md-6 col-xl-2  d-block d-lg-none">
                    <h1 class="mb-0 site-logo"><a href="index.php" class="text-black h2 mb-0">SerPre HN<span class="text-primary">.</span> </a></h1>
                </div>
                <div class="col-12 col-md-12 main-menu">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu mr-auto d-none d-lg-block">
                            <li><a href="index.php" class="font-16-weight nav-link">[Página Principal]</a></li>
                        </ul>
                    </nav>
                </div>


                <div class="col-6 col-md-6 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>
      
        </header><br><br><br>
        <div class="container-fluid background-container-green">
            <div id="inicio-sesion" class="login-registro">
                <div align="center">
                    <img src="images/NewLogo.png" alt="Image" class="logo-registro img-fluid">
                </div><br>
                <h3 class="text-center">Inicio de Sesión</h3><br>
                <div class="div-form-login-registro">
                    <input id="email-username" type="email" class="input-login-registro" placeholder="Email or Username">
                    <div id="Error-Login-email-username" class="error">Este campo es obligatorio</div>
                    <br><br>
                    <input id="password" type="password" class="input-login-registro" placeholder="Password">
                    <div id="Error-Login-password" class="error">Este campo es obligatorio</div>
                    <input id="chk-password" type="checkbox" onclick="mostrarContrasena('password');">&nbsp;Show Password
                    <br><br><br>
                    <div align="center">
                        <button id="btn-login" class="btn btn-lg btn-primary boton-login" type="button" onclick="CamposRequeridosLogin();">Iniciar Sesión</button>
                        <br><br>
                        <h6>Nuevo en Serpre?</h6>
                        <a href="registro.php#registro"><input type="button" class="btn btn-lg btn-dark boton-login" value="Regístrate"></a>
                    </div>
                </div>
                <br>
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
    <script src="js/controladorLogin.js"></script>

</body>
</html>