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
    <div class=" p-2 bg-primary">
        <h1 class="text-center text-muted">Solidaridad Esperanza</h1>
        <!-- DAMOS LA OPCION A INICIAR SESION -->
        <span>
            <h3 class="text-center text-muted">REGISTRO o<a href="inicioSesion.php"> Iniciar Sesión</a></h3>
        </span>
        <p></p>
    </div>
    <div class="container">
        <!-- FORMULARIO PARA REGISTRARTE -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="row form-group p-3">
                <div class="col-6 col-sm-5 pt-2">
                    <label for="usuario">
                        <h5>Nombre de Usuario: </h5>
                    </label>
                    <input class="form-control" type="text" name="identificador" placeholder="Usuario" required>
                </div>
                <div class="col-6 col-sm-5 pt-2">
                    <label for="email">
                        <h5>Email: </h5>
                    </label>
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                </div>
                <div class="col-6 col-sm-5 pt-2">
                    <label for="contrasenna">
                        <h5>Contraseña: </h5>
                    </label>
                    <input class="form-control" type="password" name="contrasenna" placeholder="Contraseña" required>
                </div>
                <div class="col-6 col-sm-5 pt-2">
                    <label for="confirmar_contrasenna">
                        <h5>Repetir Contraseña: </h5>
                    </label>
                    <input class="form-control" type="password" name="confirmar_contrasenna" placeholder="Repite la contraseña" required>
                </div>
            </div>
            <input class="btn btn-outline-success" type="submit" value="Registrarse">
        </form>
        <!-- EN CASO DE QUE NO COINCIDA MUESTRA ESTE MENSAJE -->
        <?php if (!empty($mnsj)) : ?>
            <p style="color:red"><?= $mnsj ?></p>
        <?php endif; ?>
    </div>
</body>

</html>