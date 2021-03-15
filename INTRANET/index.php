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
    <link rel="stylesheet" href="css/estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!------------------------ MENU PRINCIPAL ------------------------------->
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

    <!-------------------------------------- cuerpo --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="container p-3">
        <!-- EN EL CASO DE QUE LA VARIABLE USAURIO NO ESTE VACÍA, SIGNIFICA QUE TENEMOS UNA SESION INICIADA, ASÍ QUE VA A DEVOLVER ESTO  -->
        <?php if (!empty($usuario)) { ?>
            <h4 class="blockquote-footer text-success">Bienvenido: <em><?= $usuario[1] ?></h4>
        <?php } ?>
        <!------------------------------- Menu secundario ------------------------------------------------------------------->
        <header>
            <nav id="nav" class="nav1">
                <nav class="navbar navbar-inverse bg-primary">
                    <div class="container-fluid">
                        <div class="enlaces" id="enlaces">
                            <button class="btn btn-primary btn-header"><a href="#" id="enlace-inicio">inicio</a></button>
                            <button class="btn btn-primary btn-header"><a href="#" id="enlace-aboutUs">¿Quiénes somos?</a></button>
                            <button class="btn btn-primary btn-header"><a href="#" id="enlace-trabajo">¿Qué hacemos?</a></button>
                            <button class="btn btn-primary btn-header"><a href="#" id="enlace-contacto">Contacto</a></button>
                        </div>
                    </div>
                </nav>
            </nav>
        </header>

        <!------------------ Cuepo pagina web ------------------------------------------------------------------>
        <main class="m-2">
            <!-------------------- SLIDER -------------------------------------------------------->
            <div id="slider">
                <div class="slide-contenedor">
                    <div class="miSlider fade">
                        <img src="img/slider/img-1-slider.jpg">
                    </div>
                    <div class="miSlider fade">
                        <img src="img/slider/img-2-slider-1.jpg">
                    </div>
                    <div class="miSlider fade">
                        <img src="img/slider/img-3-slider.jpg">
                    </div>
                    <div class="direcciones">
                        <a href="" class="anterior" onclick="avanzaSlide(-1)">&#10094;</a>
                        <a href="" class="siguiente" onclick="avanzaSlide(1)">&#10095;</a>
                    </div>
                    <div class="barras">
                        <span class="barra active" onclick="posicionSlide(1)"></span>
                        <span class="barra" onclick="posicionSlide(2)"></span>
                        <span class="barra" onclick="posicionSlide(3)"></span>
                    </div>
                </div>
            </div>
            <!-------------------- QUIENES SOMOS -------------------------------------------------------->
            <section class="team contenedor" id="aboutUs">
                <h2 class="text-primary">¿Quiénes somos?</h2>
                <hr>
                <p class="after"><strong>Asociación Solidaridad Esperanza - Organización no gubernamental (ONG) </strong></p>

                <article>
                    Somos una asociación sin ánimo de lucro fundada el 21 de junio de 2014,
                    dirigida por personas voluntarias conscientes de la realidad de las
                    personas más vulnerables del municipio de Getafe.
                </article>
                <br>
                <h4 class="text-primary">MISIÓN</h4>
                <article>
                    Nuestra misión es la atención directa e inmediata a las familias y personas que nos solicitan ayuda para mejorar su situación personal y con ello mejorar la convivencia de la comunidad getafense.
                    Buscamos soluciones eficaces para las diversas problemáticas que se derivan de las situaciones de exclusión. A la vez queremos generar procesos de inclusión, creando redes que fomenten la convivencia y la solidaridad entre las distintas comunidades culturales, las asociaciones, las entidades públicas y las empresas, con el objetivo
                    de dar respuesta también a las necesidades a medio y largo plazo.
                </article>
                <br>
                <h4 class="text-primary">HISTORIA</h4>
                <article>
                    La asociación nació con el objetivo de establecer proyectos y actividades que fomentaran la convivencia y la solidaridad intercultural.
                    Sin embargo, la situación socioeconómica de un buen número de familias de este, nuestro pueblo, hizo que la asociación replanteara su objetivo principal, creando así una red de distribución y cooperación con diferentes bancos de alimentos para cubrir la urgente necesidad de alimentación. En la actualidad este es nuestro principal proyecto ya que el acceso a recursos
                    alimenticios sigue siendo algo prohibitivo para muchas personas.
                </article>
                <br>
                <h4 class="text-primary">VALORES</h4>
                <article>
                    Las personas voluntarias de la asociación compartimos valores como la solidaridad, el respeto, la igualdad y la transparencia. Estos son los principios que nos guían en la práctica y nos ayudan a permanecer como una unidad sin fisuras, nuestra diversidad de perfiles profesionales y nacionalidades nos enriquece y fortalece.
                </article>
            </section>
            <!-------------------------- QUE HACEMOS ------------------------------------------------>
            <br>
            <section class="work contenedor" id="trabajo">
                <h2 class="text-primary">¿Qué hacemos?</h2>
                <hr>
                <p class="after">Hacemos de algo simple algo extraordinario</p>
                <div class="botones-work">
                    <nav class="navbar navbar-inverse bg-primary">
                        <div class="container-fluid">
                            <ul>
                                <button class="btn btn-primary">
                                    <a class="filter active" data-nombre='todos'>Todos</a>
                                </button>
                                <button class="btn btn-primary">
                                    <a class="filter" data-nombre='intervencion'>Intervención</a>
                                </button>
                                <button class="btn btn-primary">
                                    <a class="filter" data-nombre='interculturalidad'>Interculturalidad</a>
                                </button>
                                <button class="btn btn-primary">
                                    <a class="filter" data-nombre='infancia'>Infancia</a>
                                </button>
                                <button class="btn btn-primary">
                                    <a class="filter" data-nombre='refugiados'>Refugiados</a>
                                </button>
                                <button class="btn btn-primary">
                                    <a class="filter" data-nombre='acompanamiento'>Acompañamiento</a>
                                </button>
                                <button class="btn btn-primary">
                                    <a class="filter" data-nombre='asocia'>Redes Asociativas</a>
                                </button>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="galeria-work m-3">
                    <br>
                    <div class="row">
                        <div class="cont-work intervencion col-5 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Distribución de alimentos</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid" src="img/que-hacemos/img-que-hacemos-comida-2.jpeg" width="400" height="600">
                            </div>
                        </div>
                        <div class="cont-work intervencion col-5 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Colaboración Banco de alimentos</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid" src="img/que-hacemos/img-q-hacemos.jpeg" width="400" height="500">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cont-work interculturalidad col-5 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Actos Culturales</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid" src="img/que-hacemos/img-q-hacemos-actoCultural.jpg" width="400">
                            </div>
                        </div>
                        <div class="cont-work interculturalidad col-5 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Fiesta del cordero</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid" src="img/que-hacemos/cordero.jpg" width="400">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="cont-work infancia col-4 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Distribución de Juguetes</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid" src="img/que-hacemos/juguetes.jpg" width="400">
                            </div>
                        </div>
                        <div class="cont-work infancia col-4 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Talleres Lúdicos</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid" src="img/que-hacemos/img-q-hacemos-talleres.jpg" width="400">
                            </div>
                        </div>
                        <div class="cont-work infancia col-4 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Apoyo Escolar</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid" src="img/que-hacemos/img-q-hacemos-apoyo.jpg" width="400">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="cont-work refugiados col-6 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Cena Solidaria</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid img-responsive" src="img/que-hacemos/cenaRefugiados.jpg" width="400">
                            </div>
                        </div>
                        <div class="cont-work refugiados col-6 p-2">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Envíos de alimentos a refugiados en Grecia</h4>
                            </div>
                            <div class="img-work">
                                <img class="img-fluid img-responsive" src="img/que-hacemos/refugiados.jpg" width="400">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="cont-work acompanamiento col-12">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Acompañamiento de casos</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Citas médicas u acompañamiento en el hospital</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Gestiones administrativas</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Asesoramiento jurídico</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Entidades (Instituto de la mujer, CAID, etc.)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="cont-work asocia col-12">
                            <div class="textos-work">
                                <h4 class="text-center text-primary">Redes Asociativas</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Protección Civil</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Cáritas</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Plataforma Alimentaria</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Mesa de convivencia</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">SOS Alhóndiga</li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Colaboración con el equipo de paliativos de Getafe</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="work contenedor" id="contacto">
                <h3 class="text-center header">Contáctanos</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm">
                            <form class="form-horizontal" action="email/email.php" method="post">
                                <fieldset>
                                    <div class="form-group align-items-center">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-12">
                                            <input id="fname" name="name" type="text" placeholder="First Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-12">
                                            <input id="lname" name="name" type="text" placeholder="Last Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                        <div class="col-md-12">
                                            <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                        <div class="col-md-12">
                                            <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                                        <div class="col-md-12">
                                            <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>
        <footer>
            <div class="footer">
                <div class="marca-logo">
                    <img src="img/logo_asociacion.jpg" width="25px" height="25px">
                </div>
                <div class="iconos">
                    <i class="fab "></i>
                    <i class="fab "></i>
                    <i class="fab "></i>
                </div>
            </div>
        </footer>
        <script src="js/jquery.js"></script>
        <script src="js/slider.js"></script>
        <script src="js/main.js"></script>
        <script src="js/filtro.js"></script>


        </main>

    </div>
</body>

</html>