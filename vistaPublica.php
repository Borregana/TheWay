
<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 24/07/14
 * Time: 18.23
 */
session_start();
if(isset($_SESSION['alias']))
{
    ?>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9IemfslK-z4Wyuht0lka_Z2AqVbNfVXQ&sensor=false&libraries=drawing">
    </script>

    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>

    <?php

    $con=mysqli_connect('localhost','root','root','Rutas');
    if(isset($_POST['idruta'])){
        $_SESSION['idruta']=mysqli_real_escape_string($con,$_POST['idruta']);
    }
    $idruta=$_SESSION['idruta'];

    $consulta="SELECT * FROM Rutas WHERE id='$idruta'";
    $resultado=mysqli_query($con,$consulta);

    if($resultado){

//Regcogemos la informacion de la ruta
        $infor=array(
            'nombre'=>"",
            'ciudad'=>"",
            'tiempo'=>"",
            'vehiculo'=>"",
            'puntuacion'=>"",
            'usuario'=>"",
            'fecha'=>"",
            'recorrido'=>""
        );
        while($col=mysqli_fetch_array($resultado)){
            $infor['nombre']=$col['nombre'];
            $infor['ciudad']=$col['ciudad'];
            $infor['tiempo']=$col['tiempo'];
            $infor['vehiculo']=$col['vehiculo'];
            $infor['puntuacion']=$col['puntuacion_media'];
            $userid=$col['usuario_id'];
            //Buscamos el alias del usuario creador de la ruta
            $username="SELECT alias FROM Usuarios WHERE id='$userid'";
            $resulname=mysqli_query($con,$username);
            $infor['usuario']=mysqli_fetch_array($resulname)['alias'];
            $infor['fecha']=$col['fecha_publicacion'];
            $infor['recorrido']=$col['recorrido'];

        };
//Recogemos los datos del recorrido
        $line=explode("),",$infor['recorrido']);
        $tam=count($line);
        for($i=0;$i<$tam-1;$i++){
            $line[$i]=$line[$i].')';
        }

//Recogemos los datos de los marcadores
        $marcadores=array(array(
            'nombre'=>"",
            'texto'=>"",
            'punto_exacto'=>""
        ));
        $cons_puntos="SELECT * FROM Puntos WHERE ruta_id='$idruta'";
        $res_puntos=mysqli_query($con,$cons_puntos);
        if($res_puntos){
            $i=0;
            while($row=mysqli_fetch_array($res_puntos)){
                $marcadores[$i]['nombre']=$row['nombre'];
                $marcadores[$i]['texto']=$row['texto'];
                $marcadores[$i]['punto_exacto']=$row['punto_exacto'];
                $i++;
            }
        }
//Recogemos los comentarios
        $comentarios=array(array(
            'comentario'=>"",
            'puntuacion'=>"",
            'usuario'=>""
        ));
        $nocomment=false;
        $cons_comentarios="SELECT * FROM Comentarios WHERE ruta_id='$idruta'";
        $res_coment=mysqli_query($con,$cons_comentarios);
        if(mysqli_num_rows($res_coment)>0){
            $cont=0;
            while($rcom=mysqli_fetch_array($res_coment)){
                $comentarios[$cont]['comentario']=$rcom['comentario'];
                $comentarios[$cont]['puntuacion']=$rcom['puntuacion'];
                //buscamos el nombre del usuario que ha escrito en comentario
                $alias_com=mysqli_real_escape_string($con,$rcom['usuario_id']);
                $alias_cons="SELECT alias FROM Usuarios WHERE id='$alias_com'";
                $res_alias_com=mysqli_query($con,$alias_cons);
                $comentarios[$cont]['usuario']=mysqli_fetch_array($res_alias_com)['alias'];
                $cont++;
            }
        }
        else{
            $nocomment=true;
        }
        ?>

        <!DOCTYPE html>
        <html>
        <head>

            <title>The Way is here...</title>
            <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
            <meta charset="utf-8">
            <style>
                html, body, #map-canvas {
                    height: 90%;
                    margin: 0px;
                    padding: 0px
                }

            </style>

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
            <div class="col-md-8">
                <div class="btn-group">
                    <a href="display.php" title="Private"><i class="btn btn-info">Creador</i></a>
                    <a href="misRutas.php" title="Private"><i class="btn btn-warning">Mis Rutas</i></a>
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
                            <h2 class="txt-color-red login-header-big"><strong><?= $infor['nombre'] ?></strong></h2>
                        </header>
                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body">
                                <ul>
                                    <li>Usuario: <b><i><?=$infor['usuario']?></i></b></li>
                                    <li>Ciudad: <b><i><?=$infor['ciudad']?></i></b></li>
                                    <li>Tiempo: <b><i><?=$infor['tiempo']?></i></b></li>
                                    <li>Vehiculo: <b><i><?=$infor['vehiculo']?></i></b></li>
                                    <li>Fecha: <b><i><?=$infor['fecha']?></i></b></li>
                                    <li>Puntuacion:
                                        <?for($i=0;$i<$infor['puntuacion'];$i++){?>
                                            <i class="icon-append fa fa-star"></i>
                                        <?php } ?></li>
                                </ul>
                                <div id="res"></div>
                                <div class="pull-right">
                                    <a  class="btn btn-success" onclick="copiar();">Copiar Ruta</a>
                                </div>
                                <script>
                                    function copiar()
                                    {
                                        var parametros={
                                            "idruta":<?= $idruta ?>
                                        };
                                        $.ajax({
                                            url: "copiaRoute.php",
                                            type: "POST",
                                            data: parametros,
                                            success: function(resp){
                                                $('#res').html(resp)
                                            }
                                        });
                                    }
                                </script>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
                </article>
                <article class="col-md-12">
                    <div>
                        <!-- widget div-->
                        <div>

                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <div id="resultado"></div>
                                <form id="review-form" class="smart-form">
                                    <header>
                                        <h3 class="txt-color-green header-big"><strong>Opiniones</strong></h3>
                                    </header>
                                    <div style="overflow: auto;height:180px;">
                                        <?php
                                        for($com=0;$com<count($comentarios);$com++){
                                            if(!$nocomment){
                                                ?>
                                                <fieldset>
                                                    <section class="widget-body">
                                                        <ul>
                                                            <li class="fa fa-user">
                                                                <?= $comentarios[$com]['usuario'];?>
                                                            </li>
                                                            <br>
                                                            <li class="fa fa-comment">
                                                                <?= $comentarios[$com]['comentario'];?>
                                                            </li>
                                                        </ul>
                                                    </section>

                                                    <section>
                                                        <div class="rating">
                                                            Puntuacion:
                                                            <?php
                                                            for($s=0;$s<$comentarios[$com]['puntuacion'];$s++){
                                                                ?>
                                                                <i class="fa fa-star"></i>
                                                            <? }?>
                                                        </div>
                                                    </section>
                                                </fieldset>

                                            <?php
                                            }
                                            else{?>
                                                <fieldset>
                                                    <section class="col-md-12">
                                                        <h2>No hay comentarios...</h2>
                                                    </section>
                                                </fieldset>
                                            <?php }?>
                                        <? } ?>
                                    </div>
                                    <fieldset>
                                        <header>
                                            <H2>TU OPINION</H2>
                                            <section>
                                                <label class="label"></label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" name="comentario" id="comentario" placeholder="Tu Comentario"></textarea>
                                                </label>
                                            </section>
                                            <section>
                                                <div>
                                                    Puntuación:
                                                    <label class="bigboxnumber">
                                                        <input type="number" id="puntuacion" name="puntuacion" placeholder="1-5" min="1" max="5">
                                                        <i class="fa fa-star"></i>
                                                    </label>
                                                </div>

                                            </section>
                                    </fieldset>
                                    <footer>
                                        <button class="btn btn-primary" onclick="comentar(document.getElementById('comentario').value, document.getElementById('puntuacion').value)">
                                            Guardar
                                        </button>
                                    </footer>
                                </form>
                                <script>
                                    function comentar(comentario,puntuacion)
                                    {
                                        var parametros={
                                            "idruta": <?= $idruta?>,
                                            "comentario": comentario,
                                            "puntuacion": puntuacion
                                        };
                                        $.ajax({
                                            url: "saveComentario.php",
                                            type: "POST",
                                            data: parametros,
                                            success: function(resp){
                                            }
                                        });
                                    }
                                </script>
                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
            </div>
        </div>
        <div class="col-md-9" id="map-canvas"></div>

        </body>
        </html>
        <script>
            var route=[];
            <?php
            //Rellenamos route con las coordenadas de los punto que delimitan las lineas
            for( $j= 0;$j<=$tam;$j++){
            ?>
            route[<?=$j;?>]=new google.maps.LatLng<?= $line[$j] ?>;
            <?php }
        ?>
            function initialize() {
                var mapOptions = {
                    center: new google.maps.LatLng(39.8867882,-0.0867385,15),
                    zoom: 16
                };

                var map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);

                var polylineOptions= {
                    path: route,
                    strokeColor: "#8000FF"
                };

                var polyline= new google.maps.Polyline(polylineOptions);
                polyline.setMap(map);

                google.maps.event.addListenerOnce(map, 'idle', function() {
                    <?php
                    for($i=0;$i<=count($marcadores);$i++){
                    ?>
                    point= new google.maps.LatLng(<?= $marcadores[$i]['punto_exacto'] ?>);

                    var contentString =
                        '<div>'+
                            '<fieldset>'+
                            '<section>'+
                            '<div><?= $marcadores[$i]['nombre']?></div>'+
                            '</section>'+
                            '<section>' +
                            '<label class="label"></label>'+
                            '<label class="textarea"><i class="icon-append fa fa-comment-o"></i>'+
                            '<div><?= $marcadores[$i]['texto']?></div>'+
                            '</section>'+
                            '</fieldset>'+
                            '</div>';


                    var infoWindow = new google.maps.InfoWindow({
                        maxwidth: "60px",
                        content: contentString
                    });

                    var marker= new google.maps.Marker({
                        position: point,
                        content: contentString
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infoWindow.setContent(this.content);
                        infoWindow.open(map, this);
                    });
                    marker.setMap(map);
                    <?php
                         }
                        ?>
                })
            }
            google.maps.event.addDomListener(window, 'load', initialize);

        </script>
    <?php
    }
}
else{
    echo '<script>location.href = "index.php";</script>';

}