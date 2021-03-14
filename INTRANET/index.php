<?php
require_once "com/DAO.php";
require_once "com/varios.php";


//ESTE PHP ES EL PRIMER PHP CON EL QUE TIENE EL USAURIO CONTACTO.

//AQUI COMPROBAMOSSI HAY UNA SESION INICIADA.
if (isset($_SESSION["id_Usuario"])) {
    //EN EL CASO DE QUE ESTE INICIADA, RECOGEMOS EL ID Y OBTENEMOS AL USAURIO CON EL METODO QUE HAY ACONTINUACIÓN.
    $id = $_SESSION["id_Usuario"];
    $resultado = DAO::ObtenerSesionIniciada($id);
    $usuario = null;
    //EN EL CASO DE QUE OBTENGAMOS UN RESULTADO, LO ALMACENAMOS EN USAURIO
    if (count($resultado) > 0) {
        $usuario = $resultado;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Solidaridad Esperanza</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <nav class="navbar navbar-inverse bg-primary">
        <div class="container-fluid">
            <ul class="nav navbar-nav m-4">
                <img src="img/logo_asociacion.jpg" height="70" width="70">
            </ul>
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php $_SERVER["PHP_SELF"] ?>">Intranet ASE</a>
                <h3 class="navbar-brand text-muted">Asociación Solidaridad Esperanza</a>
            </div>
            <div class="navbar-header">
                <?php if (!empty($usuario)) : ?>
                    <!-- LE DAMOS LA OPCION DE CONTINUAR O DE CERRAR LA SESION -->
                    <p class="text-success">¿Desea continuar como <strong><?= $usuario[1] ?></strong>? <a class="btn btn-outline-info m-2" href="inicio.php">Continuar</a>¿Desea cerrar sesión? <a class="btn btn-outline-danger m-2" href="sesion/cerrarSesion.php">Cerrar Sesion</a> </p>

                <?php else : ?>
                    <!-- EN EL CASO DE QUE NO HAYA SESION LE DAMOS LA OPCION DE REGISTRARSE O INICIAR DE SESION -->
                    <button class="btn btn-outline-success"><a href="sesion/inicioSesion.php">Iniciar Sesión</a></button>
                    <button class="btn btn-outline-success"><a href="sesion/registro.php">Registrarse</a></button>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container p-3">
        <!-- EN EL CASO DE QUE LA VARIABLE USAURIO NO ESTE VACÍA, SIGNIFICA QUE TENEMOS UNA SESION INICIADA, ASÍ QUE VA A DEVOLVER ESTO  -->
        <?php if (!empty($usuario)) { ?>
            <h4 class="blockquote-footer text-success">Bienvenido: <em><?= $usuario[1] ?></h4>
        <?php } ?>

        
    </div>
</body>

</html>