<?php 
$dev="pruebas";
if($dev=="pruebas"){
    $conexion = mysqli_connect("dbregmex:3306", "root", "ema", "dbregmex");  
}
else{
    $conexion = mysqli_connect("", "", "", "");  
}    
if (mysqli_connect_errno() ){
  echo "Error al conectar con la base: " . mysqli_connect_error();
}
$conexion-> set_charset("utf8");
?>
