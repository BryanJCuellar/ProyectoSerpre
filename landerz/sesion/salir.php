<?php
   session_start();
   foreach($_SESSION as $key => $value) {
      $_SESSION[$key] = NULL;
   }
   session_unset();
   session_destroy();
   header("Location:../login.php#inicio-sesion");
?>