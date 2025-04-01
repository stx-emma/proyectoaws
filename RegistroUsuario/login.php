<html lang="en">
<head>
	<title>Acceso Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href=""/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<meta name="robots" content="noindex, follow">
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/uaem.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5">

					<div class="wrap-input100" >
						<input class="input100" type="text" name="correo" id="correo" placeholder="Correo electrónico">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
          

					<div class="container-login100-form-btn m-t-32 ">
						<!--<button class="login100-form-btn ingresar">
							Ingresar
						</button>-->
						<button type="button" class="login100-form-btn" name="ingresar" id="ingresar">Ingresar</button>
					</div>
					<div id="resp"></div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="js/jquery-3.7.1.min.js"></script>
<!--===============================================================================================-->
	<script src="js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/moment.min.js"></script>
	<script src="js/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="js/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<script src="js/sweetalert2.all.min.js"></script>

	<script type="text/javascript">
        $(document).off("click", "#ingresar").on("click", "#ingresar", function () {
            let correo;
            correo = $('#correo').val();
           
            // AJAX request
             $.ajax({
                url:"acceso.php",
                method:"POST",
                data: {correo: correo},
                success: function(mail){ 

                  $('#resp').html(mail);
                  
                },
                error: function() {
                 console.log("Error");
                }
            }); 
            
        }); 
    </script> 
	
	
</body>
</html>

