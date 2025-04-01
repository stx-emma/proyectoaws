<?php

//$conexion = mysqli_connect("bases.dis.uaemex.mx", "davaldesa", "davaldesa", "dbsibidi");
$conexion = mysqli_connect("dbregmex:3306", "root", "ema", "dbregmex");      
if (mysqli_connect_errno() ){
  echo "No se puede conectar a la base: " . mysqli_connect_error();
}
$conexion-> set_charset("utf8");
?>
