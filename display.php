<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 26/07/14
 * Time: 13.32
 */

session_start();
if (isset($_SESSION['alias']))
{
?>
<!DOCTYPE html>
<html>

<head>

    <title>The Way is coming...</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        html, body, #map-canvas {
            height: 90%;
            margin: 0px;
            padding: 0px
        }

    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9IemfslK-z4Wyuht0lka_Z2AqVbNfVXQ&sensor=false&libraries=drawing">
    </script>

    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="js/drawing.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

    <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.css">


    <!-- FAVICONS -->
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

</head>

<body>

<!-- HEADER -->
<header id="header">
    <div id="logo-group" class="col-md-2">
        <span id="logo"> <img src="img/logo-TheWay.png" alt="TheWay"> </span>
    </div>
    <div class="col-md-8">
        <div class="btn-group">
            <a href="misRutas.php" title="Private"><i class="btn btn-info">Mis Rutas</i></a>
            <a href="Buscador.php" title="Publica"><i class="btn btn-success">Buscador</i></a>
            <a href="editUser.php" title="Perfil"><i class="btn btn-warning">Perfil</i></a>
            <a href="logout.php" title="logout"><i class="btn btn-danger">Desconectar</i></a>
        </div>
    </div>
</header>

<div class="col-md-9" id="map-canvas"></div>

<!-- NEW WIDGET START -->
<article class="col-md-3">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-0" data-widget-fullscreenbutton="true">
        <header>
            <h2><strong>Información </strong> <i>Ruta</i></h2>
        </header>
        <!-- widget div-->
        <div>
            <!-- widget content -->
            <div class="widget-body">
                <form  id="registro-ruta"  action="return false" onsubmit="return false" class="smart-form client-form" method="post">
                    <header>
                    </header>
                    <div id="result"></div>
                    <fieldset>
                        <section>
                            <label class="input"> <i class="icon-append fa fa-suitcase"></i>
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required="required">
                                <b class="tooltip tooltip-bottom-right">Nombre de la ruta</b> </label>
                        </section>

                        <section>
                            <label class="input"> <i class="icon-append fa fa-home"></i>
                                <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad">
                                <b class="tooltip tooltip-bottom-right">Ciudad recorrida</b> </label>
                        </section>

                        <section>
                            <label class="input"> <i class="icon-append fa fa-clock-o"></i>
                                <input type="time" id="tiempo" name="tiempo" placeholder="Tiempo de recorrido">
                                <b class="tooltip tooltip-bottom-right">Cuanto tiempo tardaste?</b> </label>
                        </section>

                        <section>
                            <label class="input"> <i class="icon-append fa fa-truck"></i>
                                <input type="text" id="vehiculo" name="vehiculo" placeholder="Vehiculo">
                                <b class="tooltip tooltip-bottom-right">De que modo te moviste por la ciudad?</b> </label>
                        </section>
                        <section>
                                <input type="radio" id="publica" name="publica"> Quieres que la ruta sea publica?
                        </section>
                    </fieldset>
                    <footer>
                        <button class="btn btn-primary" onclick="submitRoute(
                        document.getElementById('nombre').value,
                        document.getElementById('ciudad').value,
                        document.getElementById('tiempo').value,
                        document.getElementById('vehiculo').value,
                        document.getElementById('publica').value)">

                            Guardar
                        </button>
                    </footer>
                </form>
            </div>
            <!-- end widget content -->
        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>

</body>

</html>
<?php
}
else
{
    echo '<script>location.href = "index.php";</script>';
}
?>