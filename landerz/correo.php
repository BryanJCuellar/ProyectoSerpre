
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$nombre=$_POST["nombre"];
$apellido=$_POST["apellido"];
$email=$_POST["email"];
$asunto=$_POST["asunto"];
$mensaje=$_POST["mensaje"];
//contraseña gmail.com=Serprehn20/
//server pass thqVwpgY(g&A(wdEHv*o

if(isset($nombre) && isset($mensaje) && isset($email)&&isset($apellido)&&isset($asunto)){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'serprehn@gmail.com';                     // SMTP username
        $mail->Password   = 'Serprehn20';                               // SMTP password
        $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        

        //Recipients
        $mail->setFrom('serprehn@gmail.com', 'SerpreHN');
        $mail->addAddress($email, $nombre);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $mensaje."<br>".$nombre." ".$apellido;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        sleep(0.3);
        echo "1";
        
        

    } catch (Exception $e) {
        
        echo "2";
        
        
    }

    }

else{
    echo 2;
}

?>
