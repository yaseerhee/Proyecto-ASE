<?php

if (isset($_POST['email'])) {
    $emailA = "mohamedyaserhaddad@gmail.com";
    $emailAsunto = "Contacto desde la Web";

    if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["email"]) || !isset($_POST["telefono"]) || !isset($_POST["mensaje"])) {
        echo "<script>alert('Error. Rellene todos los campos');</script>";
        echo "Por favor, vuelva atrás";
        die();
    }

    $emailMensaje = "Detalles del formulario de contacto: \n\n";
    $emailMensaje .= "Nombre: " . $_POST["nombre"] . "\n";
    $emailMensaje .= "Apellidos: " . $_POST["apellido"] .  "\n";
    $emailMensaje .= "E-mail: " . $_POST["email"] .  "\n";
    $emailMensaje .= "Telefono: " . $_POST["telefono"] .  "\n";
    $emailMensaje .= "Mensaje: " . $_POST["mensaje"] .  "\n";

    $headers = 'From: ' . $emailDesde . "\r\n" . 'RespondeA: ' . $emailDesde . "\r\n" . "X-Mailer: PHP/" . phpversion();
    @mail($emailA, $emailAsunto, $emailMensaje, $headers);

    echo "<script> alert('El formulario se envío con éxito');</script>";
}
