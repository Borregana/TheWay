<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 24/07/14
 * Time: 18.22
 */
?>

<!DOCTYPE html>
<html>
<head>

    <title>Drawing tools</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">


    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>


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
            <a href="misRutas.php" title="Private"><i class="btn btn-info">Mis Rutas</i></a>
            <a href="display.php" title="Private"><i class="btn btn-success">Creador</i></a>
            <a href="logout.php" title="logout"><i class="btn btn-danger">Desconectar</i></a>
        </div>
    </div>
</header>
<div>
    <!-- NEW WIDGET START -->
    <article class="col-md-3">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-0" data-widget-fullscreenbutton="true">

            <header>
                <h2><strong>Buscador</strong></h2>
            </header>

            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body">

                    <form  id="smart-form-search" action="Buscador.php" class="smart-form client-form" method="post">
                        <fieldset>
                            <div class="col-md-12">
                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="usuario_id" placeholder="Usuario">
                                        <b class="tooltip tooltip-bottom-right">Que usuario creo la ruta?</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="nombre" placeholder="Nombre">
                                        <b class="tooltip tooltip-bottom-right">Nombre de la ruta</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                        <input type="text" name="ciudad" placeholder="Ciudad">
                                        <b class="tooltip tooltip-bottom-right">Ciudad buscada</b> </label>
                                </section>
                            </div>
                            <div class="col-md-12">
                                <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="time" name="tiempo" placeholder="Tiempo de recorrido">
                                        <b class="tooltip tooltip-bottom-right">De cuanto tiempo dispones?</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="text" name="vehiculo" placeholder="Vehiculo">
                                        <b class="tooltip tooltip-bottom-right">De que modo quieres moverte por la ciudad?</b> </label>
                                </section>
                                <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="text" name="fecha_publicacion" placeholder="Fecha de publicacion">
                                        <b class="tooltip tooltip-bottom-right">Que dia publicaron la ruta?</b> </label>
                                </section>
                            </div>
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                Buscar
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

    <!-- NEW WIDGET START -->
    <article class="col-md-4 col-lg-9">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-1" data-widget-fullscreenbutton="true">

            <header>
                <h2><strong>Rutas</strong></h2>
            </header>

            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body">
                    <?php
                    /*if(isset($rutas)){ ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach( $rutas as $ruta){ ?>
                                <tr>
                                    <td><?= $ruta['nombre']; ?></td>
                                    <td><?= $ruta['ciudad']; ?></td>
                                    <td><?= $ruta['tiempo']; ?></td>
                                    <td><?= $ruta['vehiculo']; ?></td>
                                    <td><?= $ruta['fecha_publicacion']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php
                    }
                    else{
                        echo 'Busca las rutas que mejor te vengan...';
                    }*/?>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->
    </article>
</div>

</body>
</html>