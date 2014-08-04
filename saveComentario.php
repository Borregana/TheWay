<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 01/08/14
 * Time: 17.32
 */
session_start();

$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}

$usuario= mysqli_real_escape_string($con,$_SESSION['usuario_id']);
$comentario= mysqli_real_escape_string($con,$_POST['comentario']);
$puntuacion= mysqli_real_escape_string($con,$_POST['puntuacion']);
$idruta= mysqli_real_escape_string($con,$_POST['idruta']);

$insert="INSERT INTO Comentarios (ruta_id,usuario_id,comentario,puntuacion)
        VALUES ('$idruta','$usuario','$comentario','$puntuacion')";

$resultado=mysqli_query($con,$insert);
if($resultado){
    $consulta="SELECT puntuacion FROM Comentarios WHERE ruta_id='$idruta'";
    $rescoment=mysqli_query($con,$consulta);
    $media=0;
    $cont=0;
    while($row=mysqli_fetch_array($rescoment)){
        $media=$media+$row['puntuacion'];
        $cont++;
    }
    $media_final=round($media/$cont);
    $update="UPDATE Rutas SET puntuacion_media='$media_final' WHERE id='$idruta'";
    $respunt=mysqli_query($con,$update);

    $_SESSION['idruta']=$idruta;

    echo "<span>El comentario ha sido registrado</span>";
}
else{
    echo"<span>No se ha podido registrar el comentario</span>";
}