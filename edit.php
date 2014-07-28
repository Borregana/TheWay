<?php
session_start();
$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}

$nombre= mysqli_real_escape_string($con,$_POST['nombre']);
$apellidos= mysqli_real_escape_string($con,$_POST['apellidos']);
$alias= mysqli_real_escape_string($con,$_POST['alias']);
$mail= mysqli_real_escape_string($con,$_POST['mail']);
$direccion= mysqli_real_escape_string($con,$_POST['direccion']);
$usuario= mysqli_real_escape_string($con,$_SESSION['usuario_id']);


$result= mysqli_query($con, "UPDATE Usuarios SET nombre='$nombre', apellidos='$apellidos',
alias='$alias', mail='$mail', direccion='$direccion' WHERE id='$usuario'");

if($result)
{
    $_SESSION['alias']=$alias;
    echo "<spanclass='txt-color-green login-header-big'> Los datos se han modificado satisfactoriamente</span>";
}

mysqli_close($con);