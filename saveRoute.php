<?php
if(isset($_POST)){

    $con=mysqli_connect("localhost","root","root","Rutas");

    if(mysqli_connect_errno()){
        echo "No se pudo conectar con la base de datos".mysqli_connect_error();
    }

    $lines= mysqli_real_escape_string($con,$_POST['lines']);
    $markers= mysqli_real_escape_string($con,$_POST['puntos']);
    $name= mysqli_real_escape_string($con,$_POST['nombre']);
    $city= mysqli_real_escape_string($con,$_POST['ciudad']);
    $time= mysqli_real_escape_string($con,$_POST['tiempo']);
    $vehicle= mysqli_real_escape_string($con,$_POST['vehiculo']);

    $sql="INSERT INTO Rutas (nombre,ciudad,marcadores, recorrido, tiempo, vehiculo)
     VALUES ('$name','$city','$lines', '$markers','$time','$vehicle')";

    if(!mysqli_query($con, $sql)){
        die('Error'. mysqli_error($con));
    }
    echo 'La Ruta ha sido guardada';
}