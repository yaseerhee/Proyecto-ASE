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

$id = (int)$_REQUEST["id"];
$nuevaEntrada = $id;
$fam = DAO::familiaFicha($id);

if (isset($_REQUEST["modificacionCorrecta"])) //Si hay modificación del equipo correcta lo indicamos
    echo "<p>Familia actualizado correctamente</p>";
else if (isset($_REQUEST["modificacionErronea"])) //Y si hay modificación erronea lo indicamos también
    echo "<p>Error al actualizar</p>";

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <title>Ficha Familia</title>
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
                    <button class="btn btn-primary btn-header"><a href="familiaListado.php" id="enlace-aboutUs">Familias</a></button>
                    <button class="btn btn-primary btn-header"><a href="../beneficiarios/beneficiariosListado.php" id="enlace-trabajo">Beneficiarios</a></button>
                    <button class="btn btn-primary btn-header"><a href="../voluntarios/voluntariosListado.php" id="enlace-contacto">Voluntarios</a></button>
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

        <?php if ($nuevaEntrada == -1) { ?>
            <h2>Nueva ficha de Familia</h2>
        <?php } else { ?>
            <h2>Ficha de Familia</h2>
        <?php } ?>
        <form method='post' action='familiaGuardar.php' enctype="multipart/form-data">

            <input type='hidden' name='id' value='<?= $id ?>' />

            <label for='numero'>Numero</label>
            <?php if ($nuevaEntrada == -1) { ?>
                <input type='number' name='numero' />
                <br />
                <label for='Direccion'>Dirección</label>
                <input type='text' name='direccion' />
                <br />
                <label for='representante'>Representante</label>
                <input type='text' name='representante' />
                <br />
            <?php } else { ?>
                <input type='number' name='numero' value='<?= $fam->getNumero() ?>' />
                <br />
                <label for='Direccion'>Dirección</label>
                <input type='text' name='direccion' value='<?= $fam->getDireccion() ?>' />
                <br />
                <label for='representante'>Representante</label>
                <input type='text' name='representante' value='<?= $fam->getRepresentante() ?>' />
                <br />
            <?php } ?>
            <?php if ($nuevaEntrada == -1) { //si es nueva entrada ponemos boton de crear sino de guardar 
            ?>
                <input type='submit' name='crear' value='Crear Familia' />
            <?php } else { ?>
                <input type='submit' name='guardar' value='Guardar cambios' />
            <?php } ?>

        </form>

        <?php if ($nuevaEntrada != -1) { ?>
            <a href='familiaEliminar.php?id=<?= $id ?>'>Eliminar Familia</a>
        <?php } ?>



    </div>
</body>

</html>