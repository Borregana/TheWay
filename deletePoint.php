<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 30/07/14
 * Time: 18.35
 */

error_reporting(0);
session_start();
$con = new mysqli("localhost", "root", "root", "Rutas");
if ($con->connect_errno)
{
    echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
    exit();
}

$id=mysqli_real_escape_string($con,$_POST['id']);

$delete="DELETE FROM Puntos WHERE id='$id'";

if(mysqli_query($con,$delete)){
    echo 1;
}
else{
    echo 0;
}