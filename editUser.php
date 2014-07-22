<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 22/07/14
 * Time: 18.37
 */

$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}
$ses_alias= mysqli_real_escape_string($con,$_SESSION['alias']);

$result= mysqli_query($con, "SELECT * FROM Usuarios WHERE alias=$ses_alias");

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

    <!-- MAIN CONTENT -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- register button -->
        <div id="edit" class="pull-right">
            <span><a href="display.php" title="volver"><i class="btn btn-warning">Volver</i></a> </span>
        </div>
        <!-- end register button -->
    </div>
    <div id="content" class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="well no-padding">

                    <form  id="smart-form-register" action="editUser.php" class="smart-form client-form" method="post">
                        <header>
                            Información de usuario
                        </header>

                        <fieldset>
                            <section>
                                <label class="input"> <i class="icon-append fa fa-user-md"></i>
                                    <input type="text" name="nombre" placeholder="Nombre" value=<?= $row['nombre']?>>
                                    <b class="tooltip tooltip-bottom-right">Tu nombre real</b> </label>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-user-md"></i>
                                    <input type="text" name="apellidos" placeholder="Apellidos" value=<?= $row['apellidos']?>>
                                    <b class="tooltip tooltip-bottom-right">Tus apellidos reales</b> </label>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="alias" placeholder="Alias" value=<?= $row['alias']?>>
                                    <b class="tooltip tooltip-bottom-right">Tu nombre de usuario para acceder</b> </label>
                            </section>

                            <section>
                                <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                    <input type="email" name="mail" placeholder="Direccion de Email" value=<?= $row['mail']?>>
                                    <b class="tooltip tooltip-bottom-right">Lo necesitamos para estar en contacto</b> </label>
                            </section>


                            <section>
                                <label class="input"> <i class="icon-append fa fa-home"></i>
                                    <input type="text" name="direccion" placeholder="Dirección" value=<?= $row['direccion']?>>
                                    <b class="tooltip tooltip-bottom-right">La dirección donde vives</b> </label>
                            </section>

                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                Guardar cambios
                            </button>
                        </footer>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php

if($_POST!=""){
    $con=mysqli_connect("localhost","root","root","Rutas");

    if(mysqli_connect_errno()){
        echo "No se pudo conectar con la base de datos".mysqli_connect_error();
    }

    $nombre= mysqli_real_escape_string($con,$_POST['nombre']);
    $apellidos= mysqli_real_escape_string($con,$_POST['apellidos']);
    $alias= mysqli_real_escape_string($con,$_POST['alias']);
    $mail= mysqli_real_escape_string($con,$_POST['mail']);
    $direccion= mysqli_real_escape_string($con,$_POST['direccion']);
    $ses_alias=mysqli_real_escape_string($con,$row['alias']);

    if($result= mysqli_query($con, "UPDATE Usuarios SET $nombre and $apellidos and $alias and $mail and $direccion
    WHERE alias=$ses_alias")){
        echo "Los datos se han modificado satisfactoriamente";
    }


    mysqli_close($con);

}