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
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>BIENVENIDO</title>
    </head>
    <body>
    <div class="col-md-12">
        <h1>BIENVENIDO : <?php echo $_SESSION['alias']; ?></h1><hr>
        <img src="img/logo-TheWay.png" alt="" width="4707">
        <p>Aquí te toca poner todo lo que que solo tus usuario registrados pueden ver. :)</p>
        <p><a href="logout.php">CERRAR SESIÓN</a></p>
    </div>
    </body>
    </html>
<?php
}
else
{
    echo '<script>location.href = "index.php";</script>';
}
?>