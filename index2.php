<?php
session_start();
include_once "conexion.php";

function verificar_login($user,$password,&$result)
{
    $sql = "SELECT * FROM Usuarios WHERE alias = '$user' and password = '$password'";

        $rec = mysql_query($sql);
        $count = 0;
        while($row = mysql_fetch_object($rec))
        {
            $count++;
            $result = $row;
        }
        if($count == 1)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }


if(!isset($_SESSION['id']))
{
    if(isset($_POST['login']))
    {
        if(verificar_login($_POST['alias'],$_POST['password'],$result) == 1)
        {
            $_SESSION['id'] = $result->id;
            header("location:display.php");
        }
        else
        {
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
        }
    }
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
        <script type="text/javascript" src="js/jquery.gomap-1.3.2.min.js"></script>
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
    <body id="login" class="animated fadeInDown">

    <div id="main" role="main">

        <!-- MAIN CONTENT -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- register button -->
            <div id="register" class="pull-right">
                <span> No tienes cuenta? <a href="register.html" title="Registro"><i class="btn btn-danger">Registrarse</i></a> </span>
            </div>
            <!-- end register button -->
        </div>
        <div id="content" class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <div class="well no-padding">
                        <form id="login-form" action="" class="smart-form" novalidate="novalidate" method="get">
                            <header>
                                Login
                            </header>
                            <fieldset>
                                <section>
                                    <label class="label">Alias</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input  name="alias">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Introduce tu alias</b></label>
                                </section>
                                <section>
                                    <label class="label">Password</label>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Introduce tu password</b> </label>
                                </section>
                                <section>
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" checked="">
                                        <i></i>Manten mi cuenta</label>
                                </section>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Sign in
                                </button>
                            </footer>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                    <h1 class="txt-color-red login-header-big">Rutes</h1>
                    <div class="hero">
                    </div>
                </div>
            </div>
        </div>

    </div>

    </body>
    </html>
<?php
}
?>