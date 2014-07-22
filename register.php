<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 22/07/14
 * Time: 17.40
 */

if($_POST['password']==$_POST['comfirmar_password']){
    $con=mysqli_connect("localhost","root","root","Rutas");

    if(mysqli_connect_errno()){
        echo "No se pudo conectar con la base de datos".mysqli_connect_error();
    }

    //validar variables
    $alias= mysqli_real_escape_string($con,$_POST['alias']);
    $mail= mysqli_real_escape_string($con,$_POST['mail']);
    $password= md5(mysqli_real_escape_string($con,$_POST['password']));

    $sql="INSERT INTO Usuarios (alias, mail, password)
     VALUES ('$alias','$mail','$password')";

    if(!mysqli_query($con, $sql)){
        die('Error'. mysqli_error($con));
    }
    echo 'El usuario ha sido registrado';
    ?>
    <div id="login" class="col-md-3">
    <span>Ahora debes Logearte para acceder
        <a href="index.php" title="Private"><i class="btn btn-info">Volver</i></a>
    </span>
    </div>
    <?php
    header('Location: index.php');
    mysqli_close($con);
}
else{
    echo 'Los passwords no coinciden, vuelva a insertar los datos';
    header('Location: register.html');
}