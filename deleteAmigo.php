<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 16/08/14
 * Time: 12.47
 */
session_start();

$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}

$usuario= mysqli_real_escape_string($con,$_SESSION['usuario_id']);
$amigo_id= mysqli_real_escape_string($con,$_POST['iduser']);

$eliminar=mysqli_query($con,"DELETE FROM Grupos WHERE usuario_id='$usuario' and amigo_id='$amigo_id'");

if($eliminar){
    echo '<span class="txt-color-green">El usuario se ha eliminado de tu lista de amigos </span> ';
    echo '<script>location.href="editUser.php"</script>';
}
else{
   echo '<span class="txt-color-red">El usuario no se ha podido eliminar de tu lista de amigos </span> ';
}

mysql_close($con);
