<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 24/07/14
 * Time: 18.23
 */
?>
<script>
function initialize() {

var mapOptions = {
center: new google.maps.LatLng(39.8867882,-0.0867385,15),
zoom: 14
};

var map = new google.maps.Map(document.getElementById('map-canvas'),
mapOptions);

var contentString = '<div>';

    var infoWindow = new google.maps.InfoWindow({
    content: contentString
    });

    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!DOCTYPE html>
<html>
<head>

    <title>The Way is coming...</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        html, body, #map-canvas {
            height: 100%;
            margin: 0px;
            padding: 0px
        }

    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9IemfslK-z4Wyuht0lka_Z2AqVbNfVXQ&sensor=false&libraries=drawing">
    </script>

    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="js/rutaPublica.js"></script>


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
<header id="header">
    <div id="logo-group" class="col-md-2">
        <span id="logo"> <img src="img/logo-TheWay.png" alt="TheWay"> </span>
    </div>
    <div class="col-md-10">
        <div class="btn-group">
            <a href="display.php" title="Private"><i class="btn btn-info">Creador</i></a>
            <a href="Buscador.php" title="Publica"><i class="btn btn-success">Buscador</i></a>
            <a href="logout.php" title="logout"><i class="btn btn-danger">Desconectar</i></a>
        </div>
    </div>
</header>
<div class="col-md-3">
    <div>
        <!-- NEW WIDGET START -->
        <article class="col-md-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-fullscreenbutton="true">
                <header>
                    <h2 class="txt-color-red login-header-big"><strong>NOMBRE DE LA RUTA</strong></h2>
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body">

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
    </div>
    <article class="col-md-12">
        <div>
            <!-- widget div-->
            <div>

                <!-- widget content -->
                <div class="widget-body no-padding">

                    <form id="review-form" class="smart-form">
                        <header>
                        <h2 class="txt-color-green login-header-big"><strong>COMENTARIOS Y PUNTUACION</strong></h2>
                        </header>
                            <?php //Aci va un for per a colocar tots els comentaris de la ruta?>
                        <fieldset>
                            <section class="Box">
                                Usuario y Comentario
                                <?php //Usuari y Comentari?>
                            </section>

                            <section>
                                <div class="rating">
                                    <input type="radio" name="quality" id="puntos-5">
                                    <label for="puntos-5"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-4">
                                    <label for="puntos-4"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-3">
                                    <label for="puntos-3"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-2">
                                    <label for="puntos-2"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-1">
                                    <label for="puntos-1"><i class="fa fa-star"></i></label>
                                    Puntuación
                                </div>

                            </section>
                        </fieldset>
                        <? // final del for ?>
                        <fieldset>
                            <header>
                                <H2>TU OPINION</H2>
                            <section>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="name" id="name" placeholder="Tu nombre">
                                </label>
                            </section>
                            <section>
                                <label class="label"></label>
                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="3" name="review" id="review" placeholder="Tu Comentario"></textarea>
                                </label>
                            </section>

                            <section>
                                <div class="rating">
                                    <input type="radio" name="quality" id="puntos-5">
                                    <label for="puntos-5"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-4">
                                    <label for="puntos-4"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-3">
                                    <label for="puntos-3"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-2">
                                    <label for="puntos-2"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="puntos" id="puntos-1">
                                    <label for="puntos-1"><i class="fa fa-star"></i></label>
                                    Puntuación
                                </div>

                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">
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

</div>
<div class="col-md-9" id="map-canvas"></div>

</body>
</html>
