<?php 
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
include("config.php");
//include('inc/httpful.phar');
//include("anti_inyeccion.php");
include("main.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Datos Admin
  </title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="script-src * 'unsafe-inline' 'unsafe-eval'; style-src * 'unsafe-inline'; connect-src * 'unsafe-inline'; child-src *;">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  
  

  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>

</head>
<body>

  <form name="consultando" id="consultando" method="" action="" autocomplete="off"> 
  </form>


<?php

date_default_timezone_set("America/Mexico_City"); 
$hoy = date("Y-m-d");

if(empty($_POST['correo']) && empty($_GET['data'])){ ?>
  <script>
      Swal.fire({
        position: "bottom-end",
        icon: "error",
        title: "Ingresa correo electrónico",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  exit();
}
if(!empty($_POST['correo']) && empty($_GET['data']) ){  //es necesario iniciar sesión
  $correo = $_POST['correo'];
  $sanitized_correo = filter_var($correo, FILTER_SANITIZE_EMAIL); // ojo con los caracteres especiales
  if(filter_var($sanitized_correo, FILTER_VALIDATE_EMAIL)) {
    
    //echo "pasa";
    acceso($sanitized_correo);
  
  }  
  else{ ?>
    <script>
    Swal.fire({
      position: "bottom-end",
      icon: "warning",
      title: "Correo electrónico no válido, verifica por favor.",
      showConfirmButton: false,
      timer: 2500
    });
    </script>
<?php
    exit();
  }
}


/********************************************************************************************************************/


//datos respuesta validación
if(!empty($_GET['data'])){
  $data = $_GET['data'];
  
  //$id = $_SESSION['id'];
  //echo "Datos: ".$data;

  //header("refresh:5; url=search-recurso.php?recurso=$id");
  $dataUsu = base64_decode($data);  
  $obj = json_decode($dataUsu);
  $error = $obj->error;

  //echo $nombreEmpleado;
  if($error != 0){  //error validación saicu 1
    $msj = $obj->mensaje; 
    
?>
    <script type="text/javascript"> 
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "<?php echo $msj; ?>",
        
      }).then(() => {
        window.location.replace("index.php");  
      });
    </script>

<?php
    session_destroy();
    exit();
  }

  
  $correoUaem = $obj->empleado->correo; //correo en la nube always
  $nombreUaem = $obj->empleado->nombre; //nombre del admin
  $query = $conexion->query("SELECT * FROM administrador WHERE administrador.correo = '$correoUaem'");
    if($row_admin = mysqli_num_rows($query) == 0) {
      //echo "registramos";
      $conexion->query("INSERT INTO administrador (nombre,correo) values ('$nombreUaem', '$correoUaem')");
  }
  $_SESSION['insesion'] = "validado"; ?>
  <script type="text/javascript">
      Swal.fire({
        icon: "success",
        title: "Bienvenido(a)",
        text: "<?php echo $nombreUaem; ?>",
        timer: 2500,
      }).then(() => {  
        window.location.replace("index.php");
      });
    </script>
<?php  
} //fin data 
else{  //error data ?>
  <!--<script type="text/javascript"> 
      swal("Error", "No existió respuesta para los datos del usuario", "error")
        .then(() => {
        window.location.replace("search-recurso.php");
      });
    </script>-->  
<?php 
    //session_destroy();   
} ?>
<!--prendemos sesión de url-->
<!--<script type="text/javascript">
  var urlInSesion = sessionStorage.getItem("urlSession"); 
</script>-->

</body>
</html>
