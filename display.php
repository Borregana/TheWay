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
    <div id="logo-group">
        <span id="logo"> <img src="img/logo.png" alt="SmartAdmin"> </span>
    </div>
    <div id="private" class="col-md-2">
        <span> Mis Rutas <a href="view.html" title="Private"><i class="btn btn-info">Acceder</i></a> </span>
    </div>
    <div id="public" class="col-md-2">
        <span> Vista Publica <a href="publicRuta.html" title="Publica"><i class="btn btn-success">Rutas</i></a> </span>
    </div>
    <div id="edit" class="col-md-2">
        <span> Perfil <a href="editUser.php" title="Perfil"><i class="btn btn-warning">Configuración</i></a> </span>
    </div>
    <div id="logout" class="col-md-2">
        <span> Logout <a href="logout.php" title="logout"><i class="btn btn-info">Salir</i></a> </span>
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
                <form  id="smart-form-register"  class="smart-form client-form" method="post">
                    <header>
                    </header>
                    <fieldset>
                        <section>
                            <label class="input"> <i class="icon-append fa fa-suitcase"></i>
                                <input type="text" name="nombre" placeholder="Nombre">
                                <b class="tooltip tooltip-bottom-right">Nombre de la ruta</b> </label>
                        </section>

                        <section>
                            <label class="input"> <i class="icon-append fa fa-home"></i>
                                <input type="text" name="ciudad" placeholder="Ciudad">
                                <b class="tooltip tooltip-bottom-right">Ciudad recorrida</b> </label>
                        </section>

                        <section>
                            <label class="input"> <i class="icon-append fa fa-clock-o"></i>
                                <input type="time" name="tiempo" placeholder="Tiempo de recorrido">
                                <b class="tooltip tooltip-bottom-right">Cuanto tiempo tardaste?</b> </label>
                        </section>

                        <section>
                            <label class="input"> <i class="icon-append fa fa-truck"></i>
                                <input type="text" name="vehiculo" placeholder="Vehiculo">
                                <b class="tooltip tooltip-bottom-right">De que modo te moviste por la ciudad?</b> </label>
                        </section>
                    </fieldset>
                    <footer>
                        <button type="submit" class="btn btn-primary" onclick="submitRoute()">
                            Crear
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