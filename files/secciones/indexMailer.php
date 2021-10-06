<?php
$nombre = $_POST["consultaNombre"];
$correo = $_POST["consultaCorreo"];
$mensaje = $_POST["consultaMensaje"];

$body = "Nombre: ". $nombre . "<br>Correo: ".$correo .  "<br>Mensaje: ".$mensaje;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../lib/PHPMailer/Exception.php';
require '../../lib/PHPMailer/PHPMailer.php';
require '../../lib/PHPMailer/SMTP.php';
require '../index.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'tls://smtp.gmail.com:587';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'correo@gmail.com';                     // SMTP username
    $mail->Password   = 'pass';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    $mail->CharSet = "utf-8";
    
    //Recipients
    $mail->setFrom($correo, $nombre);
    $mail->addAddress('correo@gmail.com', 'Arte Independiente');     // Add a recipient
    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Consulta Arte Independiente';
    $mail->Body    = $body;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->SMTPOptions = array(
   'ssl' => array(
     'verify_peer' => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true
    )
    );
    
    $mail->send();
    
    
    echo '<script>
    
            swal("¡Mensaje Enviado!", "Te responderemos a la brevedad", "success").then(function(){
            window.history.go(-1);})
    </script>';
    
    
} catch (Exception $e) {
    
    echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
    
}

?>