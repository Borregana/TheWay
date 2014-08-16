<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 10/08/14
 * Time: 18.44
 */
session_start();

$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}

$usuario= mysqli_real_escape_string($con,$_SESSION['usuario_id']);
$amigo= mysqli_real_escape_string($con,$_POST['amigo']);

$busca_amigo=mysqli_query($con,"SELECT * FROM Usuarios WHERE alias='$amigo'");

if(mysqli_num_rows($busca_amigo)>0){
    $amigo_id=mysqli_fetch_array($busca_amigo)['id'];
    $insert=mysqli_query($con,"INSERT INTO Grupos(usuario_id,amigo_id,amigo_nombre) VALUES ('$usuario','$amigo_id','$amigo')");
    if($insert){
        echo '<span class="txt-color-green">El usuario se ha agregado a tu lista de amigos </span> ';
        echo '<script>location.href="editUser.php"</script>';
    }
    else{
        echo '<span class="txt-color-red">El usuario no se ha podido agregar a tu lista de amigos </span> ';

    }
}
else{
    echo '<span class="txt-color-redLight">El usuario no existe </span> ';

}
mysql_close($con);