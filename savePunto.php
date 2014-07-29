<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 21/07/14
 * Time: 18.52
 */

error_reporting(0);
session_start();
$con = new mysqli("localhost", "root", "root", "Rutas");
if ($con->connect_errno)
{
    echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
    exit();
}
@mysqli_query($con, "SET NAMES 'utf8'");

$nombre = mysqli_real_escape_string($con, $_POST['nombre']);
$texto= mysqli_real_escape_string($con, $_POST['texto']);
$punto = mysqli_real_escape_string($con, $_POST['punto']);
$usuario_id = mysqli_real_escape_string($con, $_SESSION['usuario_id']);
$ruta_id = mysqli_real_escape_string($con, $_POST['ruta_id']);

$insert = mysqli_query($con, "INSERT INTO Puntos (ruta_id,usuario_id,nombre,punto_exacto,texto)
VALUES ('$ruta_id','$usuario_id','$nombre','$punto', '$texto')");

if ($insert)
{
    echo'<span class="txt-color-green login-header-big">El punto ha sido guardado con exito</span>';
}
else
{
    echo '<span class="txt-color-redLight login-header-big">El punto no ha sido guardado correctamente.</span>';
}
mysqli_close($con);

?>