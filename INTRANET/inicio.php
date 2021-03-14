<?php
require_once "com/DAO.php";
require_once "com/varios.php";

// UNA VEZ INICIES SESION TE REDIRGIRÁ A ESTE PHP

// LA MISMA FUNCION COMENTADA EN EL INDEX
if (isset($_SESSION["id_Usuario"])) {
    $id = $_SESSION["id_Usuario"];
    $resultado = DAO::ObtenerSesionIniciada($id);

    $usuario = null;
    if (count($resultado) > 0) {
        $usuario = $resultado;
    }
}

//SI NO TIENES LOS PERMISOS DE ADMINISTRADOR , NO TE DEJA HACER EL SORTEO
if (isset($_REQUEST["noPermisos"])) {
    echo "No tienes permisos para realizar un sorteo.<br>";
}
//SI NO EXITEN ÁRBITROS Y/O EQUIPOS NO SE PUEDE REALIZAR EL SORTEO
if (isset($_REQUEST["noDatos"])) {
    echo "No se puede realizar el sorteo si no hay árbitros y equipos registrados.<br>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <title>inicio</title>
</head>

<body>
    <nav class="navbar navbar-inverse bg-primary">
        <div class="container-fluid">
            <ul class="nav navbar-nav m-4">
                <img src="img/logo_asociacion.jpg" height="70" width="70">
            </ul>
            <div class="navbar-header">
                <a class="navbar-brand" href="<?PHP $_SERVER["PHP_SELF"] ?>">Intranet ASE</a>
                <h3 class=" navbar-brand text-muted">Asociación Solidaridad Esperanza</a>
            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href="sesion/cerrarSesion.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- SALUDAMOS AL USUARIO  -->
        <h4 class="blockquote-footer text-success">Bienvenido: <em><?= $usuario[1] ?></h4>

    </div>


</body>

</html>