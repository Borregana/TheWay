<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 28/07/14
 * Time: 16.11
 */
?>
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
            <a href="display.php" title="Private"><i class="btn btn-info">Creador</i></a>
            <a href="Buscador.php" title="Publica"><i class="btn btn-success">Buscador</i></a>
            <a href="editUser.php" title="Perfil"><i class="btn btn-warning">Perfil</i></a>
            <a href="logout.php" title="logout"><i class="btn btn-danger">Desconectar</i></a>
        </div>
    </div>
</header>
<?php
session_start();
if(isset($_SESSION['usuario_id']))
{
    $con=mysqli_connect("localhost","root","root","Rutas");

    if(mysqli_connect_errno()){
        echo "No se pudo conectar con la base de datos".mysqli_connect_error();
    }

    $usuario=mysqli_real_escape_string($con, $_SESSION['usuario_id']);

    $consulta=mysqli_query($con,"SELECT * FROM Rutas WHERE usuario_id='$usuario'");

    if(mysqli_num_rows($consulta) > 0){
        ?>
        <div>
            <div id="content" class="container">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="well no-padding">
                            <header>
                                <h1 class="txt-color-red login-header-big">MIS RUTAS</h1>
                            </header>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Ciudad</th>
                                    <th>tiempo</th>
                                    <th>Vehiculo</th>
                                    <th>Fecha de publicación</th>
                                    <th>Publica</th>
                                    <th>Ver y editar</th>
                                </tr>
                                </thead>
                                <?php
                                while($row=mysqli_fetch_array($consulta)){
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $row['nombre']; ?>
                                        </td>
                                        <td>
                                            <?= $row['ciudad']; ?>
                                        </td>
                                        <td>
                                            <?= $row['tiempo']; ?>
                                        </td>
                                        <td>
                                            <?= $row['vehiculo']; ?>
                                        </td>
                                        <td>
                                            <?= $row['fecha_publicacion']; ?>
                                        </td>
                                        <td>
                                            <?php if($row['publica']==0){
                                                echo 'NO';
                                            }
                                            else{
                                                echo 'SI';
                                            }?>
                                        </td>
                                        <td>
                                            <button class="btn btn-success" onclick=""><i class="icon-append fa fa-globe"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php
    }
    else
    {
        ?>
        <div id="content" class="container">
            <div class="row">
                <div class="col-xs-9 col-sm-9 col-md-3 col-lg-3">
                    <h1 class="txt-color-red login-header-big"></h1>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="well no-padding">
                        <header>
                            <h1 class="txt-color-red login-header-big">MIS RUTAS</h1>
                        </header>
                        Todavia no has creado ninguna ruta...
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    mysqli_close($con);

}
else
{
    echo '<script>location.href = "index.php";</script>';
}

?>
</body>
</html>
