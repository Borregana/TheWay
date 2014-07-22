<?php
/**
 * Created by PhpStorm.
 * User: Borregana
 * Date: 22/07/14
 * Time: 13.23
 */

// datos para la coneccion a mysql
define('DB_SERVER','localhost');
define('DB_NAME','Rutas');
define('DB_USER','root');
define('DB_PASS','root');

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

?>