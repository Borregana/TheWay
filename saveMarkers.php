<?php

if(isset($_POST)){
    echo $_POST['puntos'];
}

$con = mysqli_connect("localhost", "root", "root", "Rutas");

if (mysqli_connect_error()) {
    echo "Imposible conectarse a la base de datos: " . mysqli_connect_error();
}
$ident= "SELECT p.id FROM Puntos as p WHERE p.id=".$_POST['id'];
if(!$con->query($ident)){
    $insert="INSERT INTO Puntos (usuario_id,ruta_id,nombre,direccion,texto,foto,video) ".
    "VALUES( '{$_POST['usuario_id']}','{$_POST['ruta_id']}','{$_POST['nombre']}',".
        "'{$_POST['direccion']}','{$_POST['texto']}','{$_POST['foto']}','{$_POST['video']}')";
    $con->query($insert);
}
$punto = "SELECT * FROM Puntos WHERE p.id=".$_POST['id'];

$respuesta = $con->query($punto);


while ($row = $respuesta->fetch_array()){
    echo $row['nombre'];
    echo $row['direccion'];
    echo $row['foto'];
    echo $row['texto'];
    echo $row['video'];
}
?>
