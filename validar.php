<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 26/07/14
 * Time: 13.29
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
if ($_POST['user'] == null || $_POST['pass'] == null)
{
    echo '<span>Por favor completa todos los campos.</span>';
}
else
{
    $user = mysqli_real_escape_string($con, $_POST['user']);
    $pass = md5(mysqli_real_escape_string($con, $_POST['pass']));
    $consulta = mysqli_query($con, "SELECT alias, password FROM Usuarios WHERE alias = '$user' AND password = '$pass'");
    if (mysqli_num_rows($consulta) > 0)
    {
        $_SESSION["alias"] = $user;
        echo '<script>location.href = "welcome.php"</script>';
    }
    else
    {
        echo '<span>El usuario y/o clave son incorrectas, vuelva a intentarlo.</span>';
    }
}
?>

