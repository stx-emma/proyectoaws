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
  <title>Reporte Graficas - Emisión <?php echo $hoyhora; ?>
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

  <style type="text/css">
    .chart{
      width: 100%;
      min-height: 400px;
    }
  
  </style>
</head>
<body>
    <!--<div class="loader-page"><i class="fas fa-chart-bar fa-lg" style="color: #4c6ef5"></i> </div>-->
    
    <?php include("menu.php"); ?>
    <br>
<?php
// Inicio Querys Reportes ----------------------------------------------
#reporte Total de asistentes
$queryTtl = $conexion->query("SELECT COUNT(usuarios.id) AS conteoTtl FROM usuarios");
$infoTtl = array();
$row_ttl = mysqli_fetch_array($queryTtl);
$totalaccesos = $row_ttl['conteoTtl'];
$nom_conttl = "Total asistentes";
$infoTtl = array('value' => $totalaccesos, 'name' => $nom_conttl);

$jsonTtl = json_encode($infoTtl);


/*-----------------------------------------------------------------------------------------------------------*/
#reporte por grado
$query_grado = $conexion->query("SELECT usuarios.grado AS nomgrado, COUNT(usuarios.grado) AS conteogrado FROM usuarios GROUP BY usuarios.grado");
$infoGrado = array();

while($row_g = mysqli_fetch_array($query_grado)){
  $congrado = $row_g['conteogrado'];
  $nomgrtado = $row_g['nomgrado'];
  //echo "$idEspUni  -- $conEspUni ----- $nomEspUni"."<br>";
  $infoGrado[] = array('value' => $congrado, 'name' => $nomgrtado);
  
}
$jsonG = json_encode($infoGrado);

/*-----------------------------------------------------------------------------------------------------------*/
#reporte por escolaridad

$query_escola = $conexion->query("SELECT usuarios.escolaridad AS nomescolaridad, COUNT(usuarios.escolaridad) AS conteoescolaridad FROM usuarios GROUP BY usuarios.escolaridad");
$infoEscolari = array();

while($row_e = mysqli_fetch_array($query_escola)){
  $conEscola = $row_e['conteoescolaridad'];
  $nomEscola = $row_e['nomescolaridad'];
  //echo "$idEspUni  -- $conEspUni ----- $nomEspUni"."<br>";
  $infoEscolari[] = array('value' => $conEscola, 'name' => $nomEscola);
  
}
$jsonE = json_encode($infoEscolari);

/*-----------------------------------------------------------------------------------------------------------*/
#reporte por tipo de registro
$query_regis = $conexion->query("SELECT usuarios.tipo AS nomtipo, COUNT(usuarios.tipo) AS conteotipo FROM usuarios GROUP BY usuarios.tipo");
$infoTipo = array();

while($row_reg = mysqli_fetch_array($query_regis)){
  $conTipo = $row_reg['conteotipo'];
  $nomTipo = $row_reg['nomtipo'];
  //echo "$idEspUni  -- $conEspUni ----- $nomEspUni"."<br>";
  $infoTipo[] = array('value' => $conTipo, 'name' => $nomTipo);
  
}
$jsonT = json_encode($infoTipo);

// ------------------------------------ fin reportes


?>


  <form name="reporte-asistentes" id="reporte-asistentes" method="" action="" autocomplete="off"> 
    <center><div class="row" style="border-bottom: 4px solid #868356; width:75%;">
        <!--<div class="col-md-1"></div>-->
          <div class="col-md-12">
            <h4 align="center" style="color: #878387;"><b>Gráficas</b></h4>
          </div>  
        <!--<div class="col-md-1"></div>-->
    </div></center>
    <div class="row" style="padding-top: 5px;" >
        <div class="col-md-6" align="right"><label style="color: #9c8412;"><b>Emitido <?php echo $hoyhora; ?></b></label></div>
        <div class="col-md-6" align="center">
            <button type="button" class="btn btn-outline-dark btn-sm" onclick="location.reload()" title="Actualizar indicadores"><i class="fas fa-sync-alt fa-lg"></i> Actualizar Gráficas</button> 
        </div>   
        
        
    </div>
  </form>

    <script type="text/javascript">
            //convierto json a un arreglo javascript 
      function crearCadenaLineal(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for(var x in parsed){
          arr.push(parsed[x]);
        }
        return arr;
      }
    </script>

    <script type="text/javascript">
      datototal = crearCadenaLineal('<?php echo $jsonTtl; ?>');
      datotipo = crearCadenaLineal('<?php echo $jsonT; ?>');
      datoescolaridad = crearCadenaLineal('<?php echo $jsonE; ?>');
      datogrado = crearCadenaLineal('<?php echo $jsonG; ?>');
    

      const getOptionChart1=()=> {
        return {
          title: {
            text: 'Reporte Total de asistentes',
            left: 'center'
          },
          toolbox: {
            show: true,
            feature: {
              mark: { show: true },
              dataView: { show: true, readOnly: false },
              saveAsImage: { show: true }
            }
          },
          tooltip: {
            trigger: 'item'
          },
          legend: {
            top: '5%',
            left: 'center',
            // doesn't perfectly work with our tricks, disable it
            selectedMode: false
          },
          series: [
            {
              name: 'Total de asistentes',
              type: 'pie',
              radius: ['40%', '70%'],
              center: ['50%', '70%'],
              // adjust the start angle
              startAngle: 180,
              label: {
                show: true,
                formatter(param) {
                  // correct the percentage
                  return param.name + ' (' + param.percent * 2 + '%)';
                }
              },
              data: [
                datototal,
                {
                  // make an record to fill the bottom 50%
                  value: datototal,
                  itemStyle: {
                    // stop the chart from rendering this piece
                    color: 'none',
                    decal: {
                      symbol: 'none'
                    }
                  },
                  label: {
                    show: false
                  }
                }
              ]
            }
          ]
        };
      }


      const getOptionChart2=()=> {   
          
        return {
          title: {
            text: 'Reportes',
            subtext: 'Tipo de registro',
            left: 'center'
          },
            tooltip: {
              trigger: 'item'
            },
            toolbox: {
              show: true,
              feature: {
                mark: { show: true },
                dataView: { show: true, readOnly: false },
                saveAsImage: { show: true }
              }
            },
            series: [
              {
                name: 'Consulta por tipo de Registro',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                  borderRadius: 10,
                  borderColor: '#fff',
                  borderWidth: 2
                },
                label: {
                  show: false,
                  position: 'center'
                },
                emphasis: {
                  focus: 'self',
                  label: {
                    show: true,
                    fontSize: 25,
                    fontWeight: 'bold'
                  }
                },
                labelLine: {
                  show: false
                },
                data: 
                  datotipo
              }
            ]
          };

      };

      const getOptionChart3=()=> {
       
        return {
          title: {
            text: 'Reporte',
            subtext: 'Tipo de escolaridad',
            left: 'center'
          },
          tooltip: {
            trigger: 'item'
          },
          
          toolbox: {
            show: true,
            feature: {
              mark: { show: true },
              dataView: { show: true, readOnly: false },
              saveAsImage: { show: true }
            }
          },
          series: [
            {
              name: 'Escolaridad',
              type: 'pie',
              radius: [25, 150],
              center: ['50%', '50%'],
              roseType: 'area',
              itemStyle: {
                borderRadius: 8
              },
              emphasis: {
                  focus: 'self',
                  label: {
                    show: true,
                    fontSize: 10,
                    fontWeight: 'bold'
                  }
              },
              data: 
                datoescolaridad
            }

          ]
          };
        
      };

      
      const getOptionChart4=()=> {
        return {
          title: {
            text: 'Reporte',
            subtext: 'Grado Acádemico',
            left: 'center'
          },
            tooltip: {
              trigger: 'item'
            },
            toolbox: {
              show: true,
              feature: {
                mark: { show: true },
                dataView: { show: true, readOnly: false },
                saveAsImage: { show: true }
              }
            },
            series: [
              {
                name: 'Reporte Grado Acádemico',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                  borderRadius: 10,
                  borderColor: '#fff',
                  borderWidth: 2
                },
                label: {
                  show: false,
                  position: 'center'
                },
                emphasis: {
                  focus: 'self',
                  label: {
                    show: true,
                    fontSize: 18,
                    fontWeight: 'bold'
                  }
                },
                labelLine: {
                  show: false
                },
                data: 
                  datogrado
              }
            ]
          };
      }


    

      const initCharts=()=> {
        const chart1=echarts.init(document.getElementById("chart1"));
        const chart2=echarts.init(document.getElementById("chart2"));
        const chart3=echarts.init(document.getElementById("chart3"));
        const chart4=echarts.init(document.getElementById("chart4"));
        

        chart1.setOption(getOptionChart1());
        chart2.setOption(getOptionChart2());
        chart3.setOption(getOptionChart3());
        chart4.setOption(getOptionChart4());
        
        

      };

      addEventListener("load", () => {
        initCharts();
      });


    </script>  



    
    <br>
    <div class="container-fluid">
      <div class="" style="" id="graficas">
        <div class="row">
          <div class="col-lg-6">
            <div id="chart1" class="chart"></div>
          </div>
          <div class="col-lg-6">
            <div id="chart2" class="chart"></div>
          </div>
        </div>
        <br/>
        <div class="row">
          <div class="col-lg-6">
            <div id="chart3" class="chart"></div>
          </div>
          <div class="col-lg-6">
            <div id="chart4" class="chart"></div>
          </div>
        </div>
      </div>

    </div>
  
</body>
</html>