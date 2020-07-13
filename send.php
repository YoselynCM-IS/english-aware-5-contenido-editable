<?php

/***librerias phpmailer**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';
/**********/

$imagen = $_POST["imagen"];
$ea5_regGP = $_POST["ea5_regGP"];
$ea5_regCA = $_POST["ea5_regCA"];
$ea5_regND = $_POST["ea5_regND"];
$ea5_regCD = $_POST["ea5_regCD"];
$ea5_regNA = $_POST["ea5_regNA"];

$imagen = preg_replace('#^data:image/[^;]+;base64,#', '', $imagen); 
$mensaje = '<b>English Aware 5</b><br><b>Student name: </b>'.$ea5_regNA.'<br><b>Group: </b> '.$ea5_regGP.'<br><b>Teacher: </b>'.$ea5_regND;

$para = $ea5_regCD;
$para2 = $ea5_regCA;
$asunto = 'English Aware 5: Activity';				
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
//Agregar la imagen
$decode = base64_decode($imagen);
$mail->addStringAttachment($decode, "Activity.png", "base64", "image/png");
$mensaje .= '<br><img src="https://majesticeducacion.com.mx/nuevo/wp-content/uploads/2018/08/logo-header-majesticeducacion.png">';
 
//Configuracion servidor mail
$mail->From = "ebook@majesticeducationdigital.com"; //remitente
$mail->FromName = "Majestic Education";//nombre remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //seguridad
$mail->Host = "mail.majesticeducationdigital.com"; // servidor smtp
$mail->Port = 465; //puerto
$mail->Username ='ebook@majesticeducationdigital.com'; //nombre usuario
$mail->Password = '[;$&0?H_zuq#'; //contraseña

 
//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para2);
$mail->Subject = $asunto;
$mail->IsHTML(true);
$mail->Body = $mensaje;


 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Sent correctly");
		   window.history.back();
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("Not sent, try again");
        </script>';
}
?>