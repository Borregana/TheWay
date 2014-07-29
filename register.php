<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 22/07/14
 * Time: 17.40
 */

$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}

//validar variables
$alias= mysqli_real_escape_string($con,$_POST['alias']);
$mail= mysqli_real_escape_string($con,$_POST['mail']);
$password= md5(mysqli_real_escape_string($con,$_POST['password']));

$consulta=mysqli_query($con,"SELECT * FROM Usuarios WHERE alias='$alias'");

if(mysqli_num_rows($consulta)>0){
    echo '<span class="txt-color-redLight login-header-big">El alias ya esta en uso</span>';
}
else{
    $sql="INSERT INTO Usuarios (alias, mail, password) VALUES ('$alias','$mail','$password')";

    if(!mysqli_query($con, $sql)){
        die('Error'. mysqli_error($con));
    }
    else{
        echo '<span class="txt-color-green login-header-big">Usuario registrado con exito</span>';
        echo '<script>location.href = "index.php";</script>';
    }
}
mysqli_close($con);

