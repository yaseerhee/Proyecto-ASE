<?php
require_once "../com/DAO.php";
require_once "../com/varios.php";

//sI HAY UNA SESION REDIRIGIMOS AL PHP INICIO
if (isset($_SESSION["id_Usuario"])) {
    redireccionar("inicio.php");
}

$mnsj = "";

//COMPROBAMOS QUE LOS CAMPOS NO ESTAN VACIOS
if (!empty($_POST['identificador']) && !empty($_POST['contrasenna'])) {
    $identificador = $_POST['identificador'];
    $password = $_POST['contrasenna'];
    // ALMACENAMOS LOS INPUT EN VARIABLES E INICIAMOS LA SESION CON LA SIGUIENTE FUNCION
    $resultado = DAO::iniciarSesionUsuario($identificador);
    //SI NOS DEVUELVE UN RESULTADO Y LA CONTRASEÑA ES LA CORRECTA
    if (count($resultado) > 0 && password_verify($password, $resultado[3])) {
        // REVISAMOS QUE SI EL RECUERDAME ESTA RELLENO
        if (!empty($_POST["recuerdame"])) {
            // EN CASO DE QUE SI, CREAMOS LAS COOKIES E INICIAMOS LA SESION
            setcookie("identificador", $identificador, time() + (10 * 365 * 24 * 60 * 60)); //ESTA COOKIE DURA 10 AÑOS
            setcookie("contrasenna", $password, time() + (10 * 365 * 24 * 60 * 60)); //ESTA COOKIE DURA 10 AÑOS
            $_SESSION['id_Usuario'] = $resultado[0]; //ALMACENAMOS LA SESION
        } else {
            // EN CASO DE QUE NO ESTE MARCADO
            if (isset($_COOKIE["identificador"])) {
                // COMPROBAMOS QUE EXISTA UNA COOKIE EN identificador
                // SI ES ASÍ LA BORRAMOS
                setcookie("identificador", "");
                $_SESSION['id_Usuario'] = $resultado[0]; //ALMACENAMOS LA SESION
            }
            if (isset($_COOKIE["contrasenna"])) {
                // COMPROBAMOS QUE EXISTA UNA COOKIE EN CONTRASEÑA
                // SI ES ASÍ LA BORRAMOS
                setcookie("contrasenna", "");
                $_SESSION['id_Usuario'] = $resultado[0]; //ALMACENAMOS LA SESION
            }
        }
        // UNA VEZ COMPROBADO LO REDIRIGIMOS AL INICIO
        redireccionar("../inicio.php");
    } else if (!$resultado) { //COMPROBAR SI EL USUAIRO EXISTE
        $mnsj = "Error en el inicio de Sesion, el usuario no existe";
    } else {
        // EN CASO CONTRARIO LAS CREDENCIALES NO COINCIDEN
        $mnsj = "Error en el inicio de Sesion, estas credenciales no coinciden";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <title>Log IN</title>
</head>

<body>
    <div class=" p-2 bg-primary">
        <h1 class="text-center text-muted">Solidaridad Esperanza</h1>
        <!-- DAMOS LA OPCION A INICIAR SESION -->
        <span>
            <h3 class="text-center text-muted">INICIA SESIÓN o<a href="registro.php"> Registrarse</a></h3>
        </span>
        <p></p>
    </div>
    <div class="container">
        <!-- FORMULARIO PARA REGISTRARTE -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group p-3">
                <div class="col-6 col-sm-5 pt-2">
                    <label for="usuario">
                        <h5>Nombre de Usuario: </h5>
                    </label>
                    <input class="form-control" type="text" name="identificador" placeholder="Usuario" required>
                </div>
                <div class="col-6 col-sm-5 pt-2">
                    <label for="contrasenna">
                        <h5>Contraseña: </h5>
                    </label>
                    <input class="form-control" type="password" name="contrasenna" placeholder="Contraseña" required>
                </div>
                <div class="col-3 col-sm-3 pt-2">
                    <label>
                        <h5>Recuérdame</h5>
                    </label>
                    <input type="checkbox" name="recuerdame" <?php if (isset($_COOKIE["identificador"])) { //VERIFICAMOS SI ESTA CHECKEADO O NO CON LAS COOKIES 
                                                                ?>checked<?php } ?>><br />
                </div>

                <input class="btn btn-outline-success" type="submit" value="Iniciar Sesión">
            </div>
        </form>

        <?php if (!empty($mnsj)) : ?>
            <!-- EN CASO DE QUE NO COINCIDA MUESTRA ESTE MENSAJE -->
            <p style="color:red"><?= $mnsj ?></p>
        <?php endif; ?>
    </div>

</body>

</html>