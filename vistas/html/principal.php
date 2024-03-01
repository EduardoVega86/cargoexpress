<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}

/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Inicio";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title  = "Inicio";
$Inicio = 1;
//Archivo de funciones PHP
require_once "../funciones.php";
$usu            = $_SESSION['id_users'];
$users_users    = get_row('users', 'usuario_users', 'id_users', $usu);
$cargo_users    = get_row('users', 'cargo_users', 'id_users', $usu);
$nombre_users   = get_row('users', 'nombre_users', 'id_users', $usu);
$apellido_users = get_row('users', 'apellido_users', 'id_users', $usu);
$email_users    = get_row('users', 'email_users', 'id_users', $usu);
?>
<?php require 'includes/header_start.php';?>
<!-- grafico -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>

<?php require 'includes/header_end.php';?>

<!-- Begin page -->
<div id="wrapper">

  <?php require 'includes/menu.php';?>




  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
      <div class="container">
        <?php if ($permisos_ver == 1) {
    ?>
          <div class="row">

            <div class="col-lg-6 col-xl-3">
             <a href="edificios.php">
              <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-success pull-left">
                  <i class="ti-vector text-success"></i>
                </div>
                <div class="text-right">
                  <h5 class="text-dark text-center"><b class="counter text-success"><?php total_cxp();?></b></h5>
                  <p class="text-muted mb-0">Procesos Activos</p>
                </div>
                <div class="clearfix"></div>
              </div>
              </a>
            </div>
              <div class="col-lg-6 col-xl-3">
             <a href="edificios.php">
              <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-success pull-left">
                  <i class="ti-vector text-success"></i>
                </div>
                <div class="text-right">
                  <h5 class="text-dark text-center"><b class="counter text-success"><?php total_cxp();?></b></h5>
                  <p class="text-muted mb-0">Procesos Finalizados</p>
                </div>
                <div class="clearfix"></div>
              </div>
              </a>
            </div>


            <div class="col-lg-6 col-xl-3">
            <a href="bitacora_compras.php">
              <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-danger pull-left">
                  <i class="ti-user text-pink"></i>
                </div>
                <div class="text-right">
                  <h5 class="text-dark text-center"><b class="counter text-pink"><?php total_egresos();?></b></h5>
                  <p class="text-muted mb-0">Clientes</p>
                </div>
                <div class="clearfix"></div>
              </div>
              </a>
            </div>

            
              

            <!--div class="col-lg-6 col-xl-3">
             <a href="bitacora_ventas.php">
              <div class="widget-bg-color-icon card-box fadeInDown animated">
                <div class="bg-icon bg-icon-primary pull-left">
                  <i class=" ti-money text-info"></i>
                </div>
                <div class="text-right">
                  <h5 class="text-dark"><b class="counter text-info"><?php total_ingresos();?></b></h5>
                  <p class="text-muted mb-0">Total Ventas</p>
                </div>
                <div class="clearfix"></div>
              </div>
              </a>
            </div-->

          </div>
          <!-- end row -->

          <div class="row">


            <div class="col-lg-8">
              

            </div>
            

          </div>






          <?php
} else {
    ?>
          <section class="content">
            <div class="alert alert-danger" align="center">
              <h3>Acceso denegado! </h3>
              <p>No cuentas con los permisos necesario para acceder a este módulo.</p>
            </div>
          </section>
          <?php
}
?>
      </div>
      <!-- end container -->
    </div>
    <!-- end content -->

    <?php require 'includes/pie.php';?>

  </div>
  <!-- ============================================================== -->
  <!-- End Right content here -->
  <!-- ============================================================== -->

</div>
<!-- END wrapper -->


<?php require 'includes/footer_start.php'
?>
<!-- ============================================================== -->
<!-- Todo el codigo js aqui-->
<!-- ============================================================== -->
<script>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawVisualization);

  function errorHandler(errorMessage) {
            //curisosity, check out the error in the console
            console.log(errorMessage);
            //simply remove the error, the user never see it
            google.visualization.errors.removeError(errorMessage.id);
          }

          function drawVisualization() {
        // Some raw data (not necessarily accurate)
    var periodo=$("#periodo").val();//Datos que enviaremos para generar una consulta en la base de datos
    var jsonData= $.ajax({
      url: 'chart.php',
      data: {'periodo':periodo,'action':'ajax'},
      dataType: 'json',
      async: false
    }).responseText;

    var obj = jQuery.parseJSON(jsonData);
    var data = google.visualization.arrayToDataTable(obj);



    var options = {
      title : 'VENTAS VS COMPRAS'+periodo,
      vAxis: {title: 'Monto'},
      hAxis: {title: 'Meses'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    google.visualization.events.addListener(chart, 'error', errorHandler);
    chart.draw(data, options);
  }

  // Haciendo los graficos responsivos
  jQuery(document).ready(function(){
    jQuery(window).resize(function(){
     drawVisualization();
   });
  });

</script>

<?php require 'includes/footer_end.php'
?>