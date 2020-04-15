<?php
    session_start(); 
    $inactivo = 900;
    if (!isset($_SESSION['user'])){
        header("Location: login.php");
    }else{
        if(isset($_SESSION['tiempo']) ) {
            $vida_session = time() - $_SESSION['tiempo'];
                if($vida_session > $inactivo)
                {
                    foreach($_SESSION as $key => $value) {
                        $_SESSION[$key] = NULL;
                     }
                    session_destroy();
                    header("Location: login.php"); 
                }
        }        
        $_SESSION['tiempo'] = time();
    }
    /*if ($_SESSION["autentificado"] != "SI") {
        //si no está logueado lo envío a la página de autentificación
        header("Location: login.php");
    } */
?>