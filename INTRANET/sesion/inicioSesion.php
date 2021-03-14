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
    <h1>Solidaridad Esperanza</h1>
    <h2>INICIA SESIÓN</h2>
    <!-- DAMOS LA OPCION PARA REGISTRARSE -->
    <span>o<a href="registro.php"> Registrarse </a></span>
    <p></p>

    <!-- FORMULARIO PARA INICIAR SESION -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="usuario">Nombre de Usuario: </label>
        <input type="text" name="identificador" placeholder="Usuario" value="<?php if (isset($_COOKIE["identificador"])) {
                                                                                    //OBTENEMOS LA COOKIE SI EXISTE
                                                                                    echo $_COOKIE["identificador"];
                                                                                } ?>">
        <p></p>
        <label for="contrasenna">Contraseña: </label>
        <input type="password" name="contrasenna" placeholder="Contraseña" value="<?php if (isset($_COOKIE["contrasenna"])) {
                                                                                        //OBTENEMOS LA COOKIE SI EXISTE
                                                                                        echo $_COOKIE["contrasenna"];
                                                                                    } ?>">
        <p></p>
        <label><b>Recuérdame</b></label>
        <input type="checkbox" name="recuerdame" <?php if (isset($_COOKIE["identificador"])) { //VERIFICAMOS SI ESTA CHECKEADO O NO CON LAS COOKIES 
                                                    ?>checked<?php } ?>><br />
        <input type="submit" value="Iniciar Sesión">
    </form>

    <?php if (!empty($mnsj)) : ?>
        <!-- EN CASO DE QUE NO COINCIDA MUESTRA ESTE MENSAJE -->
        <p style="color:red"><?= $mnsj ?></p>
    <?php endif; ?>
</body>

</html>