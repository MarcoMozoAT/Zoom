<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';


// Crea una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP de Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'marcoantoniomozo10@gmail.com'; 
    $mail->Password = 'oouxjggjhteczhcm'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configuración del correo
    $mail->setFrom('marcoantoniomozo10@gmail.com', 'ICO');
   

    if(isset($_GET['nombre'])) {
        $nombre = $_GET['nombre'];
        $hora = $_GET['hora'];
        $dia = $_GET['dia'];
        $url = $_GET['url'];
        $contrasena = $_GET['password'];
        $correo = $_GET['correo'];
    }
    $mail->addAddress($correo, 'Cr7'); //Destinatario
    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Zoom';
    $mail->Body = '
    <html>
    <head>
        <style>
            .tittle{
                background-color:#0A59A8;
                color: white;
                border-radius: 4px;
                padding: 10px;
                text-align: center;
        
            }
            h1 {
                color: #333333;
                font-family: Arial, sans-serif;
            }
            h2 {
                color: #555555;
                font-family: Verdana, sans-serif;
            }
            hr{
                width: 48%;
                margin: 0;
                background-color:#0A59A8;
                color: #0A59A8;
            }
        </style>
    </head>
    <body>
    <h1 class="tittle">Instituto de Compuinglés de Oriente</h1>
    <br>
        <h1>Datos de la Reunión de Zoom</h1>
        <hr>
        <br>
        <h2>Nombre: '.$nombre.'</h2>
        <h2>Hora: '.$hora.'</h2>
        <h2>Día: '.$dia.'</h2>
        <h2>Contraseña: '.$contrasena.'</h2>
        <h2>link: '.$url.'</h2>
    </body>
    </html>';

    // Envía el correo
    $mail->send();
    header('location: inicio.php?exito=true');
} catch (Exception $e) {
    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
}
?>