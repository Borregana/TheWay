<?php
session_start();
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
    $usuario= mysqli_real_escape_string($con,$_SESSION['usuario_id']);
    $idruta=mysqli_real_escape_string($con,$_POST['ruta_id']);

    if($idruta==""){

        $sql="INSERT INTO Rutas (nombre,ciudad,marcadores,recorrido,tiempo,vehiculo,usuario_id)
     VALUES ('$name','$city', '$markers','$lines','$time','$vehicle','$usuario')";


        if(!mysqli_query($con, $sql)){
            die('Error'. mysqli_error($con));
        }
        else{
            $consulta=mysqli_query($con, "SELECT * FROM Rutas WHERE nombre='$name'");

            if($consulta)
            {
                $ruta_id=mysqli_fetch_array($consulta)['id'];
                ?>

                <script> idRuta = <?= $ruta_id ?></script>

                <?php
                echo '<span class="txt-color-green login-header-big">La Ruta ha sido creada con exito</span>';
            }
        }
    }
    else{
        $sql="UPDATE Rutas SET nombre='$name',ciudad='$city',marcadores='$markers',recorrido='$lines', tiempo='$time',vehiculo='$vehicle'
              WHERE id='$idruta'";

        if(!mysqli_query($con, $sql)){
            die('Error'. mysqli_error($con));
        }
        else{
            echo '<span class="txt-color-green login-header-big">La Ruta ha sido modificada con exito</span>';
        }
    }
    mysqli_close($con);

}
