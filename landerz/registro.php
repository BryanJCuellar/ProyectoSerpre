<?php
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SerPre HN: Registro</title>

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
                        <li style="list-style:none !important;"><a href="login.php#inicio-sesion" class="font-16-weight nav-link enlace-cursor-color">[Iniciar Sesión]</a></li>
                        <li style="list-style:none !important;"><a href="../landerz/" class="font-16-weight nav-link enlace-cursor-color">[Página Principal]</a></li>
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

                <div class="col-12 col-md-12 main-menu">
                    <nav class="site-navigation position-relative text-right" role="navigation">

                    <ul class="site-menu main-menu mr-auto d-none d-lg-block">
                        <li><a href="login.php#inicio-sesion" class="font-16-weight nav-link enlace-cursor-color">[Iniciar Sesión]</a></li>
                        <li><a href="../landerz/" class="font-16-weight nav-link enlace-cursor-color">[Página Principal]</a></li>
                    </ul>
                    </nav>
                </div>


                <div class="col-6 col-md-6 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>
      
        </header><br><br><br>
        <div class="container-fluid background-container-green">
            <div id="registro" class="login-registro">
                <div align="center">
                    <img src="images/NewLogo.png" alt="Image" class="logo-registro img-fluid">
                </div><br>
                <h3 class="text-center">Regístrate</h3><br>
                <div class="div-form-login-registro">
                    <label for="Nombre">Ingresar Nombre:</label>
                    <div id="div-error-Nombre" class="error">*Campo Requerido</div><br>
                    <input id="Nombre" type="text" class="input-login-registro" placeholder="Nombre" onkeypress="pulsar(event);"><br><br>
                    <label for="Apellido">Ingresar Apellido:</label>
                    <div id="div-error-Apellido" class="error">*Campo Requerido</div><br>
                    <input id="Apellido" type="text" class="input-login-registro" placeholder="Apellido" onkeypress="pulsar(event);"><br><br>
                    <label for="Telefono">Ingresar Numero Telefono: (Opcional)</label><br>
                    <input id="Telefono" type="tel" class="input-login-registro" pattern="\([0-9]{3}\) [0-9]{4}[ -][0-9]{4}" placeholder="Número Telefono" onkeypress="pulsar(event);"><br><br>
                    <label for="FechaNacimiento">Ingresar Fecha Nacimiento:</label>
                    <div id="div-error-FechaNacimiento" class="error">*Campo Requerido</div><br>
                    <input id="FechaNacimiento" type="date" class="input-login-registro" onkeypress="pulsar(event);"><br><br>
                    <label for="gender">Seleccione Género:</label>
                    <div id="div-error-Genero" class="error">*Campo Requerido</div><br>
                    <input id="Male" type="radio" name="gender" value="Masculino">&nbsp;Masculino <br>
                    <input id="Female" type="radio" name="gender" value="Femenino">&nbsp;Femenino <br>
                    <input id="None" type="radio" name="gender" value="N/A">&nbsp;&nbsp;No Especificar <br>
                    <br>
                    <label for="Username">Nombre de Usuario:</label>
                    <div id="div-error-Username" class="error">*Campo Requerido</div><br>
                    <input id="Username" type="text" class="input-login-registro" placeholder="Username" onkeypress="pulsar(event);"><br><br>
                    <label for="Email">Ingresar Correo:</label>
                    <div id="div-error-Email" class="error">*Campo Requerido</div><br>
                    <input id="Email" type="email" class="input-login-registro" placeholder="Email" onkeypress="pulsar(event);"><br><br>
                    <label for="Password">Ingresar Contraseña:</label>
                    <div id="div-error-Password" class="error">*Campo Requerido</div><br>
                    <input id="Password" type="password" class="input-login-registro" placeholder="Password" onkeypress="pulsar(event);"><br>
                    <input id="chk-Password" type="checkbox" onclick="mostrarContrasena('Password');">&nbsp;Show Password
                    <br><br><br>
                    <div align="center">
                        <button id="btn-registro" class="btn btn-lg btn-primary boton-login" type="button" onclick="CamposRequeridosRegistro();">Regístrate</button>
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
    <!--<script src="js/sendEmail.js"></script>-->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!--<script src="js/popper.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>-->
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
    <script src="js/controladorRegistro.js?v=<?php echo time(); ?>"></script>
</body>
</html>