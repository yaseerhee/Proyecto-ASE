<?php
require_once "../../com/DAO.php";
require_once "../../com/varios.php";

// UNA VEZ INICIES SESION TE REDIRGIRÁ A ESTE PHP

// LA MISMA FUNCION COMENTADA EN EL INDEX
if (isset($_SESSION["id_Usuario"])) {
    $id = $_SESSION["id_Usuario"];
    $resultado = DAO::ObtenerSesionIniciada($id);
    $familias = DAO::familiaObtenerTodas();

    $usuario = null;
    if (count($resultado) > 0) {
        $usuario = $resultado;
    }
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
                <img src="../../img/logo_asociacion.jpg" height="70" width="70">
            </ul>
            <div class="navbar-header">
                <a class="navbar-brand" href="<?PHP $_SERVER["PHP_SELF"] ?>">Intranet ASE</a>
                <h3 class=" navbar-brand text-muted">Asociación Solidaridad Esperanza</a>
            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href="../../sesion/cerrarSesion.php">Cerrar Sesión</a>
            </div>
            <!-- <nav id="nav" class="nav1"> -->
            <!-- <nav class="navbar navbar-inverse bg-primary"> -->
            <div class="container-fluid">
                <div class="row justify-content-center" id="enlaces">
                    <button class="btn btn-primary btn-header"><a href="<?php $_SERVER["PHP_SELF"] ?>" id="enlace-aboutUs">Familias</a></button>
                    <button class="btn btn-primary btn-header"><a href="beneficiarios.php" id="enlace-trabajo">Beneficiarios</a></button>
                    <button class="btn btn-primary btn-header"><a href="voluntarios.php" id="enlace-contacto">Voluntarios</a></button>
                </div>
            </div>
            <!-- </nav> -->
            <!-- </nav> -->
        </div>
    </nav>
    <div class="container">
        <!-- SALUDAMOS AL USUARIO  -->
        <header>
            <h4 class="blockquote-footer text-success">Bienvenido: <em><?= $usuario[1] ?></h4>
        </header>


        <div id="familias">
            <h3>Listado de Familias</h3>
            <table class="table table-hover">
                <tr class="">
                    <th class="">Número</th>
                    <th>Dirección</th>
                    <th>Representante</th>
                    <?php if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] == 1) { //Aqui comprobamos si tiene permisos de administrador 
                    ?>
                        <th>Eliminar</th>
                    <?php } ?>
                </tr>
                <?php foreach ($familias as $familia) { ?>
                    <tr>
                        <?php if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] == 1) { //Aqui comprobamos si tiene permisos de administrador 
                        ?>
                            <td><a href='familiaFicha.php?id=<?= $familia->getId() ?>'> <?= $familia->getNumero() ?> </a></td>
                            <td><a href='familiaFicha.php?id=<?= $familia->getId() ?>'> <?= $familia->getDireccion() ?> </td>
                            <td><a href='familiaFicha.php?id=<?= $familia->getId() ?>'> <?= $familia->getRepresentante() ?> </td>
                            <td><a href='familiaEliminar.php?id=<?= $familia->getId() ?>'> <img src="../../img/icons/papelera.png" width="25" height="25" alt="eliminar"> </a></td>
                        <?php } else { ?>
                            <td> <?= $familia->getNumero() ?> </td>
                            <td> <?= $familia->getDireccion() ?> </td>
                            <td> <?= $familia->getRepresentante() ?> </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table><br>
            <button class="btn btn-primary btn-header"><a href="familiaFicha.php?id=<?= -1 ?>" id="enlace-aboutUs">Crear Familia</a></button>
        </div>

    </div>


</body>

</html>