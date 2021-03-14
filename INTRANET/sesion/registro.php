<?php
require_once "../com/DAO.php";
require_once "../com/varios.php";


$mnsj = "";
$exito = "";
//COMPROBAMOS QUE LOS CAMPOS NO ESTAN VACIOS
if (!empty($_POST['identificador']) && !empty($_POST['contrasenna']) && !empty($_POST['email'])) {
    $identificador = $_POST['identificador'];
    $confirmar_contrasenna = $_POST['confirmar_contrasenna'];
    $email = $_POST['email'];
    // SI ESTA MARCADO ALMACENAMOS 1 (ADMINISTRADOR) SI NO 0 (USAURIO)
    $tipo = (isset($_POST["tipo"])) ? '1' : '0';
    //COMPROBAMOS QUE COINCIDAN LAS COTRASENNAS
    if ($_POST['contrasenna'] == $confirmar_contrasenna) {
        // sI COINCIDE LA HASHEAMOS 
        $contrasenna = password_hash($_POST['contrasenna'], PASSWORD_BCRYPT);
        // UNA VEZ HASHEADO CREAMOS EL USUARIO
        DAO::usuarioCrear($identificador, $email, $contrasenna, $tipo);
        // UNA VEZ CREADO LE REDIRIGIMOS AL INICIO SESION
        redireccionar("inicioSesion.php");
    } else {
        //ERROR EN LA CONTRASEÑA
        $mnsj = "La contraseña ha fallado";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
<title>Sign IN</title>
</head>

<body>
    <h1>Solidaridad Esperanza</h1>
    <h2>REGISTRO</h2>
    <!-- DAMOS LA OPCION A INICIAR SESION -->
    <span>o<a href="inicioSesion.php"> Iniciar Sesión</a></span>
    <p></p>
    <!-- FORMULARIO PARA REGISTRARTE -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="usuario">Nombre de Usuario: </label>
        <input type="text" name="identificador" placeholder="Usuario" required>
        <p></p>
        <label for="email">Email: </label>
        <input type="email" name="email" placeholder="Email" required>
        <p></p>
        <label for="contrasenna">Contraseña: </label>
        <input type="password" name="contrasenna" placeholder="Contraseña" required>
        <p></p>
        <label for="confirmar_contrasenna">Repetir Contraseña: </label>
        <input type="password" name="confirmar_contrasenna" placeholder="Repite la contraseña" required>
        <p></p>
        <label for="admin">¿Eres un Administrador?</label>
        <input type="checkbox" name="tipo" value="administrador">
        <p></p>
        <input type="submit" value="Registrarse">
    </form>
    <!-- EN CASO DE QUE NO COINCIDA MUESTRA ESTE MENSAJE -->
    <?php if (!empty($mnsj)) : ?>
        <p style="color:red"><?= $mnsj ?></p>
    <?php endif; ?>
</body>

</html>