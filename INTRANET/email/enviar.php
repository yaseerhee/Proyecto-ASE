<?php
require_once "../com/varios.php";

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$tlf = $_POST["telefono"];
$mail = $_POST["email"];
$empresa = $_POST["mensaje"];


$header = 'From: ' . $mail . "\r\n";
$header .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $nombre . " " . $apellidos . ", \r\n";
$mensaje .= "Su correo de contacto es: " . $mail . "\r\n";
$mensaje .= "Mensaje: " . $_POST["mensaje"] . "\r\n";
$mensaje .= "Enviado el  " . date('d/m/Y', time());


$para = 'mohamedyaserhaddad@gmail.com';
$asunto = 'Mensaje de contacto desde Solidaridad Esperanza';

mail($para, $asunto, utf8_decode($mensaje), $header);

redireccionar("../index.php");
