
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function enviarMail($numero_peticion){

    if(isset($_POST['registrar-ayuda-submit'])){
        require '..\static\PHPMailer\src\Exception.php';
        require '..\static\PHPMailer\src\PHPMailer.php';
        require '..\static\PHPMailer\src\SMTP.php';

        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        /* Username (email address). */
        $mail->Username = 'cuenta';

        /* Google account password. */
        $mail->Password = 'password';

        //Set who the message is to be sent from
        $mail->setFrom('cuenta', 'SIVCM-FACMED bot');

        //Set who the message is to be sent to
        $mail->addAddress('cuenta', 'Usuario');

        /* Set the subject. */
        $mail->Subject = 'Solicitud de ayuda No: '.$numero_peticion;

        /* Set the mail message body. */
        $mail->Body = "Se ha ingresado el formulario de ayuda con número: ".$numero_peticion." al SIVCM-FACMED
        
        
        
        Este es un mensaje generado automáticamente.";

        /* Finally send the mail. */
        if (!$mail->send()){
        /* PHPMailer error. */
        echo $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
            exit();
        }
    }else{
        header("Location ../dashboard.php");
        exit();
    }
}