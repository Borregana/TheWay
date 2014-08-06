<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 06/08/14
 * Time: 17.48
 */


session_start();
$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}

//primero guardamos la imagen
if(isset($_POST))
{
    if(isset($_POST['img_punto'])){

        $Destination = 'img/img_markers/';

        if(!isset($_FILES['img_punto']) || !is_uploaded_file($_FILES['img_punto']['tmp_name']))
        {
            die('Algo ha ido mal con la imagen!');
        }

        $RandomNum   = rand(0, 9999999999);

        $ImageName      = str_replace(' ','-',strtolower($_FILES['img_punto']['name']));
        $ImageType      = $_FILES['img_punto']['type']; //"image/png", image/jpeg etc.

        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.','',$ImageExt);

        $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

        //Create new image name (with random number added).
        $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;

        move_uploaded_file($_FILES['img_punto']['tmp_name'], "$Destination/$NewImageName");

        $img=$Destination.'/'.$NewImageName;

        $id=mysqli_real_escape_string($con,'106');
        $imagen=mysqli_real_escape_string($con,$img);

        $result= mysqli_query($con, "UPDATE Puntos SET imagen='$imagen' WHERE id='$id'");

        if($result)
        {
            echo '<script>location.href = "display2.php";</script>';
        }
    }
}
mysqli_close($con);


