<?php
  include("conexionBD/conexion.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SerPre HN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap" id="inicio">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body">
      </div>
    </div>
   
    <div class="container d-none d-lg-block">
      <div class="row">
        <div class="col-12 text-center mb-4 mt-5">
          <img src="images/NewLogoSerpre.png" alt="LogoImage" class="img-logo-nav img-fluid">
            <!--<h1 class="mb-0 site-logo"><a href="index.php" class="text-black h2 mb-0">SerPre HN<span class="text-primary">.</span> </a></h1>-->
        </div>
      </div>
    </div>
    <header class="site-navbar py-md-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-md-6 col-xl-2  d-block d-lg-none">
            <h1 class="mb-0 site-logo"><a href="index.php" class="text-black h2 mb-0">SerPre HN<span class="text-primary">.</span> </a></h1>
          </div>

          <div class="col-12 col-md-10 main-menu">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#inicio" class="nav-link">Inicio</a></li>
                <li><a href="#servicios" class="nav-link">Servicios</a></li>
                <li><a href="#sobre-nosotros" class="nav-link">Sobre Nosotros</a></li>
                <li><a href="#formulario-de-contacto" class="nav-link">Contáctanos</a></li>
              </ul>
            </nav>
          </div>


          <div class="col-6 col-md-6 d-inline-block d-lg-none ml-md-0" ><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>
    

    <div class="site-blocks-cover">
      <div class="container">
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" style="position: relative;" data-aos="fade-up">
            
            <!--<img src="images/LogoSerpre.png" alt="Image" class="img-logo img-absolute img-fluid">-->

            <div class="row mb-4"><!--mb-4-->
              <div class="col-lg-6 mr-auto">
                <h2 id="ToStarted">Servicios Presenciales de Honduras</h2>
                <h4>"Servicios a tu alcance"</h4>
                <p class="mb-5">
                  .</p>
                <div>
                  <?php 
                    $inactivo = 900;
                    if (isset($_SESSION['user']) && $_SESSION["autentificado"] == "SI" && isset($_SESSION['tiempo'])){
                            $vida_session = time() - $_SESSION['tiempo'];
                            if($vida_session > $inactivo){
                                foreach($_SESSION as $key => $value) {
                                    $_SESSION[$key] = NULL;
                                }
                                session_destroy();
                                echo '<a id="getStarted" class="btn btn-primary mr-2 mb-2" href = "login.php">Empecemos</a>'; 
                            }else{
                                  $_SESSION['tiempo'] = time();
                                  echo '<a id="getStarted" class="btn btn-primary mr-2 mb-2" href = "MenuPrincipal.php">De vuelta a mi sesión</a>';
                            }
                    }else{
                      echo '<a id="getStarted" class="btn btn-primary mr-2 mb-2" href = "login.php">Empecemos</a>'; 
                    }
                  ?>
                  <!--<a id="getStarted" class="btn btn-primary mr-2 mb-2" href = "login.php">Empecemos</a>-->
                </div>
              </div>
              <div class="col-lg-6 mr-auto">
                <img src="images/NewLogo.png" alt="LogoImage" class="img-logo img-fluid">
              </div>
              
              
            </div>

          </div>
        </div>
      </div>
    </div>  


    <div class="site-section bg-light" id="servicios">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Servicios</h2>
          </div>
        </div>
        <div class="row align-items-stretch">
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            
            <div class="unit-4 d-block">
              <a href="#ToStarted" style="color:gray" >
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-certificate"></span></span>
              </div>
              <div>
                <h3>Cursos</h3>
                <p>
                    Si quieres aprender más por tu cuenta, mira los cursos especializados que tenemos para ofrecerte
                    con profesionales que te ayudaran en el desarrollo de tu conocimiento.
                </p>
                <!--<p><a href="#"></a></p>-->
              </div>
              </a>
            </div>

          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            
            <div class="unit-4 d-block">
              <a href="#ToStarted" style="color:gray" >
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-autorenew"></span></span>
              </div>
              <div>
                <h3>Tutorias</h3>
                <p>Si necesitas apoyo en alguna clase de la Universidad nosotros tenemos a los profesionales con los
                  conocimientos y la didactica para que sea de gran ayuda.
                </p>
                <!--<p><a href="#"></a></p>-->
              </div>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            
            <div class="unit-4 d-block">
              <a href="#ToStarted" style="color:gray" >
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-shop"></span></span>
              </div>
              <div>
                <h3>Articulos de Segunda Mano</h3>
                <p>
                    Sección donde puedes comprar articulos usados que no han perdido su calidad a precios accesibles.
                    Si estas interesado, nosotros te ponemos en contacto con la persona indicada.
                </p>
                <!--<p><a href="#"></a></p>-->
              </div>
              </a>
            </div>

          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">

 
            
            <div class="unit-4 d-block">
              <a href="#ToStarted" style="color:gray" >
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-sentiment_satisfied"></span></span>
              </div>
              <div>
                <h3>Eventos</h3>
                <p>
                Bodas, Graduaciones, comuniones etc. 
                Si necesitas algo semejante, no dudes de ponerte en contacto, 
                porque crearemos el evento que tanto esperas.
                </p>
                <!--<p><a href="#"></a></p>-->
              </div>
              </a>
            </div>

          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">


               
            <div class="unit-4 d-block">
              <a href="#ToStarted" style="color:gray" >
              <div class="unit-4-icon mb-3">
                <span class="icon-wrap"><span class="text-primary icon-power"></span></span>
              </div>
              <div>
                <h3>Reparaciones</h3>
                <p>
                Tecnicos pueden ser de gran ayuda en cualquier objeto dañado
                plomeria, carpinteria, cerrajeria, etc. Contamos con profesionales 
                que te pueden ayudar al momento.
                </p>
                <!--<p><a href="#"></a></p>-->
              </div>
              </a>
            </div>

          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
          </div>
          
          
          </div>

        </div>
      </div>
    </div>
    
    


    <div class="site-section bg-light" id="sobre-nosotros">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Sobre Nosotros</h2>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-6">
            <h2 class="text-black mb-4">Mision</h2>
            <p class="mb-4">Proporcionar a las personas u empresas una plataforma donde puedan publicar y encontrar 
            una extensa variedad de servicios organizados en diferentes categorias, siendo estos de manera 
            presencial, brindando una mayor facilidad a los usuarios de encontrar servicios que esten a su alcance 
            en cuanto a ubicacion y que les pueda garantizar una experiencia innovadora, unica y de gran calidad.</p>
          </div>
          <div class="col-lg-5 ml-auto pl-lg-5">
            
            <h2 class="text-black mb-4">Vision</h2>
            <p class="mb-4">Ser la empresa anunciante de servicios preferida del pais por su calidad e innovacion,
            ofreciendo una experiencia de comodidad y bienestar tanto para los usuarios como para las personas 
            u entidades que ofrecen sus servicios.</p>

            <br><br>
            <!--<p><a href="#" class="btn btn-primary">Leer más</a></p>-->
          </div>
        </div>
        
      </div>
    </div>


   

    <div class="site-section bg-light" id="formulario-de-contacto">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Contáctanos</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-7 mb-5">

            

            <form  class="p-5 bg-white">
              
              <h2 class="h4 text-black mb-5">Formulario de Contacto</h2> 

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Nombre </label>
                  <input type="text" id="nombre" name="nombre" class="form-control rounded-0" required="">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Apellido </label>
                  <input type="text" id="apellido" name="apellido" class="form-control rounded-0" required="">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Correo Electronico</label> 
                  <input type="email" id="email" name="email" class="form-control rounded-0" placeholder="tu@correo.com" required="">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Asunto</label> 
                  <input type="subject" id="asunto" name="asunto" class="form-control rounded-0" required="" >
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Mensaje</label> 
                  <textarea id="mensaje" name="mensaje" cols="30" rows="7" class="form-control rounded-0" 
                  placeholder="" required="" ></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  
                  <input id="enviarDatos" type="submit" name="enviar" value="Enviar Mensaje" class="btn btn-primary mr-2 mb-2">
                  
                </div>
                <div id="cargando" class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <!-- MODAL CONFIRMACION ENVIO DE CORREO-->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-dialog modal-sm" role="document">
      

        <div class="modal-content" align='center'>
        <h3>ESTADO DEL MENSAJE:</h3>
        <!--<img id="icono" src="icon/checkCircle.svg" alt="" width="42" height="42" title="Listo">-->
        <p id="mensajeMostrado">MENSAJE ENVIADO</p>   
        
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

  
     
    
  </div> <!-- .site-wrap -->

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