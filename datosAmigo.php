<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 10/08/14
 * Time: 20.09
 */
session_start();

$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}

$amigo= mysqli_real_escape_string($con,$_POST['iduser']);

$consulta=mysqli_query($con,"SELECT * FROM Usuarios WHERE id='$amigo'");

if($consulta){
    $row=mysqli_fetch_array($consulta);
    $alias= $row['alias'];
    $nombre= $row['nombre'].' '.$row['apellidos'];
    $email= $row['mail'];
    $dir= $row['direccion'];
    $imagen= $row['imagen'];
    $fecha= $row['fecha_alta'];

    echo'<b>Alias: </b> '.$alias;
    echo'<br>';
    echo'<b>Nombre: </b>'.$nombre;
    echo'<br>';
    echo'<b>Email: </b>'.$email;
    echo'<br>';
    echo'<b>Dirección: </b>'.$dir;
    echo'<br>';
    echo'<b>Imagen: </b>';
    if($imagen!=""){
    echo '<img width="50px" src="'.$imagen.'">';
    }
    else{
        echo '-No hay imagen-';
    }
    echo'<br>';
    echo '<b>Fecha de alta: </b>'.$fecha;
}
else{
    echo'el usuario ya no existe';
}