<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 22/07/14
 * Time: 18.37
 */
session_start();
if(isset($_SESSION['alias'])){

    $con=mysqli_connect("localhost","root","root","Rutas");

    if(mysqli_connect_errno()){
        echo "No se pudo conectar con la base de datos".mysqli_connect_error();
    }

    $usuario=mysqli_real_escape_string($con,$_SESSION['usuario_id']);
    $result= mysqli_query($con, "SELECT * FROM Usuarios WHERE id='$usuario'");

    $row = mysqli_fetch_array($result);

    mysqli_close($con);

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>The Way is coming...</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <script type="text/javascript" src="js/jquery-1.11.1.js"></script>

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
    <body id="login" class="animated fadeInDown">

    <div id="main">
        <!-- HEADER -->
        <header id="header">
            <div id="logo-group" class="col-md-2">
                <span id="logo"> <img src="img/logo-TheWay.png" alt="TheWay"> </span>
            </div>
            <div class="col-md-8">
                <div class="btn-group">
                    <a href="misRutas.php" title="Private"><i class="btn btn-info">Mis Rutas</i></a>
                    <a href="display.php" title="Creador"><i class="btn btn-success">Creador</i></a>
                    <a href="Buscador.php" title="Buscador"><i class="btn btn-warning">Buscador</i></a>
                    <a href="logout.php" title="logout"><i class="btn btn-danger">Desconectar</i></a>
                </div>
            </div>
        </header>

        <div id="content" class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="well no-padding">

                        <form  id="smart-form-register" action="return false" onsubmit="return false" class="smart-form client-form" method="post" enctype="multipart/form-data">
                            <header>
                                Información de usuario
                            </header>

                            <fieldset>
                            <div id="resultado"></div>
                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user-md"></i>
                                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value=<?= $row['nombre']?>>
                                        <b class="tooltip tooltip-bottom-right">Tu nombre real</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user-md"></i>
                                        <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" value=<?= $row['apellidos']?>>
                                        <b class="tooltip tooltip-bottom-right">Tus apellidos reales</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" id="alias" name="alias" placeholder="Alias" value=<?= $row['alias']?>>
                                        <b class="tooltip tooltip-bottom-right">Tu nombre de usuario para acceder</b> </label>
                                </section>

                                <section>
                                    <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" id="mail" name="mail" placeholder="Direccion de Email" value=<?= $row['mail']?>>
                                        <b class="tooltip tooltip-bottom-right">Lo necesitamos para estar en contacto</b> </label>
                                </section>


                                <section>
                                    <label class="input"> <i class="icon-append fa fa-home"></i>
                                        <input type="text" id="direccion" name="direccion" placeholder="Dirección" value=<?= $row['direccion']?>>
                                        <b class="tooltip tooltip-bottom-right">La dirección donde vives</b> </label>
                                </section>
                                <section>
                                    <label class="input"> <i class="icon-append fa fa-picture-o"></i>
                                        <input type="file" id="imagen" name="imagen" placeholder="Tu avatar">
                                        <b class="tooltip tooltip-bottom-right">Tu imagen de usuario favorita</b> </label>
                                </section>

                            </fieldset>

                            <footer>
                                <button class="btn btn-primary" onclick="Editar(document.getElementById('nombre').value,
                                 document.getElementById('apellidos').value,
                                 document.getElementById('alias').value,
                                 document.getElementById('mail').value,
                                 document.getElementById('direccion').value),
                                 document.getElementById('imagen').value);" >
                                    Guardar cambios
                                </button>
                            </footer>
                        </form>
                        <script>
                            function Editar(nombre,apellidos,alias,mail,direccion,imagen)
                            {
                                var parametros= {
                                    "nombre": nombre,
                                    "apellidos": apellidos,
                                    "alias": alias,
                                    "mail": mail,
                                    "direccion": direccion,
                                    "imagen": imagen
                                }
                                $.ajax({
                                    url: "edit.php",
                                    type: "POST",
                                    data: parametros,
                                    success: function(resp){
                                        $('#resultado').html(resp)
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
}
else
{
    echo '<script>location.href = "index.php";</script>';
}
