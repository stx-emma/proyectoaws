<?php 
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
session_start();  
include("config.php");
//include("anti_inyeccion.php");
//header("X-Frame-Options: SAMEORIGIN");
//header('X-Content-Type-Options: nosniff');

//sesion vengo de y otras.. OJO ACA CON LAS MAS VALIDACIONES
/*if (isset($_SESSION['insesion'])  ) {
   
}
else{
  echo "Algo anda mal, redireccionando...";
  header( "refresh:4; url=index.php" );
  session_destroy();
  exit();
}*/
  

date_default_timezone_set("America/Mexico_City");
$hoyhora = date("Y-m-d H:i:s");
$hoy = date("Y-m-d");

//echo "$tipo -- $dominio";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Panel de asistentes registro universal - Emisión <?php echo $hoyhora; ?>
  </title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="script-src * 'unsafe-inline' 'unsafe-eval'; style-src * 'unsafe-inline'; connect-src * 'unsafe-inline'; child-src *;">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="fontawesome-5.9.0/css/all.min.css" rel="stylesheet"> <!-- fontlocal-->  
 
 
  <script src="js/bootstrap.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css"/> 
  <link rel="stylesheet" type="text/css" href="css/buttons.bootstrap4.min.css"/>    
  <link rel="stylesheet" type="text/css" href="css/select.bootstrap4.min.css"/>     
  <!--<script src="../js/plotly-latest.min.js"></script>-->
  <script src="js/jquery-3.7.1.min.js"></script>                                     
  <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>          
  <script type="text/javascript" src="js/jszip.min.js"></script>
 
  <script type="text/javascript" src="js/vfs_fonts.js"></script>
  <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="js/buttons.bootstrap4.min.js"></script>
  <script type="text/javascript" src="js/buttons.html5.min.js"></script>
  
  <script type="text/javascript" src="js/dataTables.select.min.js"></script>

  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  <script src="js/echarts.min.js"></script>

  <!--<script>
    $(document).ready(function(){
     $("#muestragraficas").click(function(){
        
        $("#graficas").toggle(1000, 'linear');

     });
    });
  </script>-->

  <script type="text/javascript">
      $(document).ready(function() {
          var table = $('#myTable').dataTable( {
              "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
              },
              ordering: false,
              "lengthMenu": [[25], [25]],
              dom: 'Bfrtip',
              buttons: [
                  'excel'
              ],
              //"columnDefs": [  
                //{ "searchable": false, "targets": 0 },  //que no busque en alguna columna en especifico
                /*{
                  "targets": [ 6,7 ],   // hidden tipo de alumno, área de conocimiento y tipo de recurso
                  "visible": false,
                    
                },*/
                //{
                //  render: function (data, type, row) {  /* incluyo El tipo de alumno [5] en la columna de correo electronico [1] */
                //      return data + ' (' + row[5] + ')';
                //  },
                //  targets: 1,
                //},
              //],

              /* filtros datatable */
              initComplete: function () {  
                    
                    
                    this.api().columns(8).every( function () {
                        var column = this;
                        var select = $("<select><option value='' title='Todos los tipos'> Todos </option></select>")
                       
                            .appendTo( $(column.header()).empty() )
                            .on( "change", function () {

                                var val = $.fn.dataTable.util.escapeRegex(

                                    $(this).val()

                                );
                                if (val == ""){
                                    
                                    Swal.fire({
                                      icon: "info",
                                      title: "Consultando",
                                      text: "Todos los tipos",
                                    }).then(() => {});
                                }
                                if (val != ""){
                                  
                                  Swal.fire({
                                      icon: "info",
                                      title: "Consultando",
                                      text: "Tipo " +val,
                                    }).then(() => {});
                                } 
                                column
                                    .search( val ? "^"+val+"$" : "", true, false )
                                    .draw();
                            } );
         
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( "<option value='"+d+"'>" +d+ "</option>" )
                            
                        } );
                    } )
                    this.api().columns(9).every( function () {
                        var column = this;
                        var select = $("<select><option value='' title='Estatus'> Todos </option></select>")
                       
                            .appendTo( $(column.header()).empty() )
                            .on( "change", function () {

                                var val = $.fn.dataTable.util.escapeRegex(

                                    $(this).val()

                                );
                                if (val == ""){
                                    
                                    Swal.fire({
                                      icon: "info",
                                      title: "Consultando",
                                      text: "Todos los estatus",
                                    }).then(() => {});
                                }
                                if (val != ""){
                                  
                                  Swal.fire({
                                      icon: "info",
                                      title: "Consultando",
                                      text: "Estatus " +val,
                                    }).then(() => {});
                                } 
                                column
                                    .search( val ? "^"+val+"$" : "", true, false )
                                    .draw();
                            } );
         
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( "<option value='"+d+"'>" +d+ "</option>" )
                            
                        } );
                    } )
              },
              processing: true,
              fixedColumns: true,
              responsive: true
          } );
          new $.fn.dataTable.FixedHeader( table );
          new $.fn.dataTable.FixedColumns( table );
      } );
  </script>

  <script> //  visita a url
    $(document).off("click", ".editar").on("click", ".editar", function () {
        var id = this.id;
        var idUsu = id;
        window.location.href = 'modificaciones.php?id=' + idUsu;
        // alert(idUsu);
        

       
        // AJAX request
         $.ajax({
          url: 'modificaciones.php',
          type: 'post',
          //data: {datos: parametros},
          data: {datos:idUsu},
          
          success: function(response){ 
            


          },
          error: function() {
           console.log("Error");
      }
        });
        
    }); 
  </script> 

 

  <style type="text/css">
    
    .table {
      font-size: 14px;
    }  
    .table .thead-dark th {
      color: #bea52a;
      font-weight: bold;
      /*background-color: #61806c;*/
    }  

    .page-item.active .page-link {
        z-index: 0 !important;
        background-color:#61806c !important;
        border-color:#61806c !important;
      }
      div.dataTables_wrapper div.dataTables_paginate ul.pagination {
          justify-content: flex-end !important;  
      }
      select {
         background: transparent;
         border: none;
         font-size: 13px;
         font-weight: bold;
         color: #838783;
         /*height: 40px;
         padding: 1px;
         width: 150px;*/
         border-bottom: solid #bea52a 3px;
      }

      .form-control-sm {
        
        width: 250px !important;
        
      }

  </style>
</head>
<body>
    <!--<div class="loader-page"><i class="fas fa-chart-bar fa-lg" style="color: #4c6ef5"></i> </div>-->
    
    <?php include("menu.php"); ?>
    <br>

  <form name="datos-asistentes" id="datos-asistentes" method="" action="" autocomplete="off"> 
    <center><div class="row" style="border-bottom: 4px solid #868356; width:75%;">
        <!--<div class="col-md-1"></div>-->
          <div class="col-md-12">
            <h4 align="center" style="color: #878387;"><b>Asistentes</b></h4>
          </div>  
        <!--<div class="col-md-1"></div>-->
    </div></center>
    <div class="row" style="padding-top: 5px;" >
        <div class="col-md-4" align="right"><label style="color: #9c8412;"><b>Emitido <?php echo $hoyhora; ?></b></label></div>
        <div class="col-md-4" align="center">
            <button type="button" class="btn btn-outline-dark btn-sm" onclick="location.reload()" title="Actualizar indicadores"><i class="fas fa-sync-alt fa-lg"></i> Actualizar reporte</button> 
        </div>   
        
        
    </div>
  </form>

  

    <div class="container-fluid">
      <div class="row justify-content-md-center" style="" id="">
        <div class="col-sm-auto" id="myDiv">
          <!--Inicia data tables-->
          <div class="table-responsive-sm">
              
              <!--inicio de data tables-->
              <table class="table table-hover table-stripe table-condensed " id="myTable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="text-center">ID</th>
                  <th scope="col" class="text-center">QR</th>
                  <th scope="col" class="text-center">Nombre</th>
                  <th scope="col" class="text-center">Apellido Paterno</th>
                  <th scope="col" class="text-center">Apellido Materno</th>
                  <th scope="col" class="text-center">Grado académico</th>
                  <th scope="col" class="text-center">Escolaridad</th>
                  <th scope="col" class="text-center">Correo</th>
                  <th scope="col" class="text-center">Fecha de asistencia</th>
                  <th scope="col" class="text-center">Tipo</th>
                  <th scope="col" class="text-center">Estatus</th>
                  <th scope="col" class="text-center">Editar</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                   
                      $query = $conexion->query("SELECT * FROM usuarios");

                      while($row = mysqli_fetch_array($query)){
                        //saco conteo por iddedescuelas  
                        $idUsu = $row['id'];
                        $nombreUsu = $row['nombre'];
                        $apUsu = $row['apellido_p'];  
                        $amUsu = $row['apellido_m'];
                        $gradoUsu = $row['grado'];
                        $escUsu = $row['escolaridad'];
                        $mailUsu = $row['email'];
                        $fechaUsu = $row['fecha_asistencia'];
                        $fechaTipo = $row['tipo'];
                        $bndUsu = $row['bandera_asistencia'];
                      
                   ?>
                <tr>
                  <th scope="" class="text-center"><?php echo $idUsu; ?></th>
                  <th scope="" class="text-center"><i class="fas fa-qrcode fa-2x" style="color: #385A60;"></i></th>
                  <th scope="" class="text-center"><?php echo $nombreUsu; ?></th>
                  <th scope="" class="text-center"><?php echo $apUsu; ?></th>
                  <th scope="" class="text-center"><?php echo $amUsu; ?></th>
                  <th scope="" class="text-center"><?php echo $gradoUsu; ?></th>
                  <th scope="" class="text-center"><?php echo $escUsu; ?></th>
                  <th scope="" class="text-center"><?php echo $mailUsu; ?></th>
                  <th scope="" class="text-center"><?php echo $fechaUsu; ?></th>
                  <th scope="" class="text-center"><?php echo $fechaTipo; ?></th>
                  <th scope="" class="text-center"><?php 
                    switch ($bndUsu) {
                        case '0':
                            $status = "Registrado";
                            break;
                        case '1':
                            $status = "En evento";
                            break;
                        default:
                            // code...
                            break;
                    }

                  echo $status; ?>
                  </th>
                  <th scope="" class="text-center"><button type="button" id="<?php echo $idUsu; ?>" class="btn btn-outline-dark editar" title="Editar información"><i class="fas fa-pen fa-sm"></i></button></th>
                <?php } mysqli_close($conexion); ?>
                </tr>

              </tbody>
            </table>
            <!--fin de data tables-->      
          </div>
        </div>
      </div>
      <br>

     

    </div>
	
</body>
</html>