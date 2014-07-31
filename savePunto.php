<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 21/07/14
 * Time: 18.52
 */

error_reporting(0);
session_start();
$con = new mysqli("localhost", "root", "root", "Rutas");
if ($con->connect_errno)
{
    echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
    exit();
}
@mysqli_query($con, "SET NAMES 'utf8'");

$nombre = mysqli_real_escape_string($con, $_POST['nombre']);
$texto= mysqli_real_escape_string($con, $_POST['texto']);
$punto = mysqli_real_escape_string($con, $_POST['punto']);
$usuario_id = mysqli_real_escape_string($con, $_SESSION['usuario_id']);
$ruta_id = mysqli_real_escape_string($con, $_POST['ruta_id']);
$pos=$_POST['posicion'];

$comprobar="SELECT * FROM Puntos WHERE punto_exacto='$punto'";
$res_comp=mysqli_query($con,$comprobar);
if(mysqli_num_rows($res_comp)==0){
    $insert = mysqli_query($con, "INSERT INTO Puntos (ruta_id,usuario_id,nombre,punto_exacto,texto)
                                  VALUES ('$ruta_id','$usuario_id','$nombre','$punto', '$texto')");

    if ($insert)
    {
        $consulta="SELECT * FROM Puntos WHERE usuario_id='$usuario_id' and nombre='$nombre' and texto='$texto'";
        $result=mysqli_query($con,$consulta);

        if(mysqli_num_rows($result)>0){
            $sol=mysqli_fetch_array($result)['id'];
            ?>
            <script> arrayMarkerId[<?= $pos ?>] = <?= $sol ?> </script>
        <?php
        }
        echo'<span class="txt-color-green login-header-big">El punto ha sido guardado con exito</span>';
    }
    else
    {
        echo '<span class="txt-color-redLight login-header-big">El punto no ha sido guardado correctamente.</span>';
    }
}
else{
    $update = mysqli_query($con, "UPDATE Puntos SET nombre='$nombre', texto='$texto'
                                    WHERE punto_exacto='$punto' and ruta_id='$ruta_id'");
    if($update){
        echo'<span class="txt-color-green login-header-big">El punto ha sido modificado con exito</span>';
    }
    else{
        echo'<span class="txt-color-green login-header-big">El punto no ha podido ser modificado con exito</span>';
    }
}
    mysqli_close($con);
?>