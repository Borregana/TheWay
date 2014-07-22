<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 22/07/14
 * Time: 11.42
 */
if (!$_SESSION['auth']) {
    $con=mysqli_connect("localhost", "root", "root", "Rutas");

    if(mysqli_connect_errno()){
        echo "No se ha podido conectar con la base de datos: ".mysqli_connect_error();
    }

    if ($usuario=mysql_real_escape_string($alias=$_GET['alias'])) {
        //$password=md5($_GET['password']);
        $password=$_GET['password'];

        $us=mysql_fetch_assoc(mysql_query(
            "select * form Usuarios where alias = '$usuario' and password = '$password'"));

        if ($us) {
            echo "entro en us\n";
            $_SESSION['auth']=true;
            $_SESSION['alias']=$us['alias'];

            header('Location: display.php');
            die();
        }
    }
}
if (!$_SESSION['auth']){
    ?>
    <!DOCTYPE html>
    <html>

    <head>

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
