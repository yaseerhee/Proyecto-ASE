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
        <form class="row d-flex p-2">
            <input class="col-7 form-control mr-sm-2" type="text" placeholder="Busca a la familia... ">
            <button class="col-4 btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </nav>
    <div class="container">
        <!-- SALUDAMOS AL USUARIO  -->
        <h4 class="blockquote-footer text-success">Bienvenido: <em><?= $usuario[1] ?></h4>
        <header>
            <nav id="nav" class="nav1">
                <nav class="navbar navbar-inverse bg-primary">
                    <div class="container-fluid">
                        <div class="row" id="enlaces">
                            <button class="btn btn-primary btn-header"><a href="tables/familias/familiaListado.php" id="enlace-aboutUs">Familias</a></button>
                            <button class="btn btn-primary btn-header"><a href="tables/beneficiarios/beneficiariosListado.php" id="enlace-trabajo">Beneficiarios</a></button>
                            <button class="btn btn-primary btn-header"><a href="tables/voluntarios/voluntariosListado.php" id="enlace-contacto">Voluntarios</a></button>
                        </div>
                    </div>
                </nav>
            </nav>
        </header>
    </div>


</body>

</html>