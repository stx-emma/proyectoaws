<?php


function acceso($mail){  ?>
        
    <script type="text/javascript"> 
        try {
          mail = "<?php echo $mail; ?>";  
            //http://148.215.1.195:32772/ldap/api/v2/autenticar?access_token=   pruebas       
            //https://wsauth.uaemex.mx/ldap/api/v2/autenticar?access_token=     productivo
            urlAcceso = "http://148.215.1.195:32772/ldap/api/v2/autenticar?access_token=";  // ingresar dato productivo y token de acuerdo a
            //tokenAcceso = "&correo="; //produc
            tokenAcceso = "e2dc07fd-6c43-475f-bf64-bd017d619bdc-5a46ad30848d5b4222005edfaf11bacc&correo="; //pruebas
            //tokenAcceso = "&correo="; //produc
            urlFnlAcceso = urlAcceso+tokenAcceso+mail;
            window.location.href=urlFnlAcceso;
            //alert(urlFnlAcceso);

        } catch (err) {

          Swal.fire({
            icon: "error",
            title: "Error",
            text: err,
            
          }).then(() => {
            window.location.replace("index.php");  
          });

        }          
    </script> 
<?php
}

/*function admin($mail) {
  include("config.php");
    $query = $conexion->query("SELECT administrador.correo AS mail_admin FROM administrador WHERE administrador.correo = '$mail' AND administrador.banreavir = 1");
    if($row_admin = mysqli_num_rows($query) == 0) {
      echo "registramos";
    }
    
    $rowGlTip = mysqli_fetch_array($query);
    $idTipAcc = $rowGlTip['tipo_Acceso']; 
}*/


?>




