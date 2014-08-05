<?php
session_start();
$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}
//primero guardamos la imagen

if ($_FILES["imagen"]["error"] > 0){
    echo "ha ocurrido un error con la imagen";
}
else {

    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");

    if (in_array($_FILES['imagen']['type'], $permitidos)){

        $ruta = "img/img_markers/" . $_FILES['imagen']['name'];

        if (!file_exists($ruta)){

            $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
            if ($resultado){
                echo "El archivo ha sido movido satisfactoriamente";
            } else {
                echo "El archivo no se ha podido mover";
            }
        } else {
            echo $_FILES['imagen']['name'] . ", este archivo existe";
        }
        $nombre= mysqli_real_escape_string($con,$_POST['nombre']);
        $apellidos= mysqli_real_escape_string($con,$_POST['apellidos']);
        $alias= mysqli_real_escape_string($con,$_POST['alias']);
        $mail= mysqli_real_escape_string($con,$_POST['mail']);
        $direccion= mysqli_real_escape_string($con,$_POST['direccion']);
        $imagen=mysqli_real_escape_string($con,$ruta);
        $usuario= mysqli_real_escape_string($con,$_SESSION['usuario_id']);


        $result= mysqli_query($con, "UPDATE Usuarios SET nombre='$nombre', apellidos='$apellidos',
        alias='$alias', mail='$mail', direccion='$direccion' , imagen='$imagen' WHERE id='$usuario'");

        if($result)
        {
            $_SESSION['alias']=$alias;
            echo "<span class='txt-color-green login-header-big'> Los datos se han modificado satisfactoriamente</span>";
        }
    }
    else {
        print_r($_POST['imagen']);
        echo "<span class='txt-color-redLight login-header-big'>archivo no permitido, es un tipo de archivo prohibido</span>";
    }
}
mysqli_close($con);