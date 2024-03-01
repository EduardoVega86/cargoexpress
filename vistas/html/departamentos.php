<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$id_edificio = $_GET['id'];
echo $id_edificio;
$modulo = "Categorias";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title     = "Categorias";
$pacientes = 1;
?>

<?php require 'includes/header_start.php';?>

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
				<div class="col-lg-12">
					<div class="portlet">
						<div class="portlet-heading bg-primary">
							<h3 class="portlet-title">
								Gestionar Departamentos
							</h3>
							<div class="portlet-widgets">
								<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
								<span class="divider"></span>
								<a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
								<span class="divider"></span>
								<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
							</div>
							<div class="clearfix"></div>
						</div>
						<div id="bg-primary" class="panel-collapse collapse show">
							<div class="portlet-body">

<?php
if ($permisos_editar == 1) {
        include '../modal/registro_departamento.php';
        include "../modal/editar_departamento.php";
        include "../modal/eliminar_linea.php";
        include "../modal/contactos.php";
    }
    ?>

								<form class="form-horizontal" role="form" id="datos_cotizacion">
                                                                     <div class="form-group row">
										<div class="col-md-12">
											<div class="input-group">
                                                                                            <input type="hidden"  id="id_edificio" name="id_edificio" value="<?php echo  $id_edificio; ?>">
                                                                                            <img width="45px" src="../../img/ico2.png" alt=""/>
													<?php
                                                                                                        echo '<h2>'. get_row('edificio', 'nombre', 'id_edificio', $id_edificio).'</h2>';
                                                                                                        ?>
												</div>
											</div>
											
											

										</div>
									<div class="form-group row">
										<div class="col-md-6">
											<div class="input-group">
												<input type="text" class="form-control" id="q" placeholder="Buscar por Nombre" onkeyup='load(1);'>
												<span class="input-group-btn">
													<button type="button" class="btn btn-info waves-effect waves-light" onclick='load(1);'>
														<span class="fa fa-search" ></span> Buscar</button>
													</span>
												</div>
											</div>
											<div class="col-md-3">
												<span id="loader"></span>
											</div>
											<div class="col-md-3">
												<div class="btn-group pull-right">
												<button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#nuevaLinea"><i class="fa fa-plus"></i> Nueva</button>
												</div>

											</div>

										</div>
									</form>
									<div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
									<div class='outer_div'></div><!-- Carga los datos ajax -->



								</div>
							</div>
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
	<!-- Todo el codigo js aqui -->
	<!-- ============================================================== -->
	<script type="text/javascript" src="../../js/departamento.js"></script>
	<script>
       $(document).ready( function () {
        $(".UpperCase").on("keypress", function () {
         $input=$(this);
         setTimeout(function () {
          $input.val($input.val().toUpperCase());
         },50);
        })
       })
       
         function departamento_id(id){
           // alert(id)
               $('#id_departamento').val(id);
                $.ajax({
		        url: '../ajax/buscar_contacto_departamento.php?action=ajax&id_producto=' + id,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $("#stock_lista").html(data);
		            $('#loader').html('');
		        }
		    })
        }
        
        function agrega_st(){
        
           id=$('#id_departamento').val()
           //alert(id)
           nombre=$('#nombre_contacto').val()
           telefono=$('#telefono').val()
           //stock_lote=$('#stock_lote').val()
              $.ajax({
		        url: '../ajax/buscar_contacto_departamento.php?action=agrega&id_producto=' + id+'&nombre='+nombre+'&telefono='+telefono,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $("#stock_lista").html(data);
		            $('#loader').html('');
		        }
		    })  
             
        }
        
        function eliminar_contacto(id){
        
          //alert(id)
          id_dep=$('#id_departamento').val()
              $.ajax({
		        url: '../ajax/buscar_contacto_departamento.php?action=elimina&id=' + id+'&id_producto='+id_dep,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $("#stock_lista").html(data);
		            $('#loader').html('');
		        }
		    })  
             
        }
      </script>
	<?php require 'includes/footer_end.php'
?>


