<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 28/07/14
 * Time: 16.11
 */
$con=mysqli_connect("localhost","root","root","Rutas");

if(mysqli_connect_errno()){
    echo "No se pudo conectar con la base de datos".mysqli_connect_error();
}