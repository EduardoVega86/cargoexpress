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
$modulo = "Bodegas Empresa";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
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
								Órdenes
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
        include '../modal/registro_cliente.php';
        include "../modal/editar_cliente.php";
        include "../modal/eliminar_cliente.php";
    }
    ?>

								<form class="form-horizontal" role="form" id="datos_cotizacion">
										<div class="form-group row">
											<div class="col-md-2">
											<div class="input-group">
												<input type="text" class="form-control" id="q" placeholder="Mensajero" onkeyup='load(1);' autocomplete="off">
												<span class="input-group-btn">
													<button type="button" class="btn btn-outline-info btn-rounded waves-effect waves-light" onclick='load(1);'>
														<span class="fa fa-search" ></span></button>
													</span>
												</div>											    
												</div>
												<div class="col-md-1">
                                                 </select>
                                                 <select class="form-control" id="estado-pedido" name="estado-pedido">
                                                 <option value="">--Estado--</option>                                                                    
                                                 <option value="">Todos</option>
                                                 <option value="">Creado</option>
                                                 <option value="">En Tránsito</option>
                                                 <option value="">Recolectado</option>
                                                 <option value="">No Efectivo</option>
                                                 <option value="">Cancelado</option>
                                                 <option value="">Rezagado</option>
                                                 <option value="">Entregado</option>
                                                 <option value="">Completado</option>
                                                                </select>												    
												</div>	
												<div class="col-md-1">
                                                 </select>
                                                 <select class="form-control" id="tipo-servicio" name="tipo-servicio">
                                                 <option value="">--Tipo de Servicio--</option>                                                                    
                                                 <option value="">Xpress</option>
                                                 <option value="">Limitado</option>
                                                 <option value="">Básico</option>
                                                 <option value="">Delivery</option>
                                                                </select>												    
												</div>												
												<div class="col-md-1">
                                                 </select>
                                                 <select class="form-control" id="gestion" name="gestion">
                                                 <option value="">--Gestión--</option>                                                                    
                                                 <option value="">Envío</option>
                                                 <option value="">Retiro</option>
                                                 <option value="">Ingreso Manual</option>
                                                                </select>												    
												</div>	
												<div class="col-md-2">												
                                                <input id="fecha-desde" name="fecha-desde" class="form-control " type="date" placeholder="Fecha desde">
                                                </div>
												<div class="col-md-2">												
                                                <input id="fecha-hasta" name="fecha-hasta" class="form-control " type="date" placeholder="Fecha hasta">
                                                </div>                                                
												<div class="col-md-1">
													<div class="resultados_ajax3"></div>
													<span id="loader"></span>												    
												</div>
												<div class="col-md-1">
													<div class="btn-group pull-right">
														<button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#nuevoUsers"><i class="fa fa-print"></i> Imprimir</button>
													</div>
											</div>				
												<div class="col-md-1">
													<div class="btn-group pull-right">
														<button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#nuevoUsers"><i class="fa fa-plus"></i> Nueva</button>
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
	<!-- Todo el codigo js aqui-->
	<!-- ============================================================== -->
	<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="../../js/bodegas.js"></script>
<script>
       $(document).ready( function () {
        $(".UpperCase").on("keypress", function () {
         $input=$(this);
         setTimeout(function () {
          $input.val($input.val().toUpperCase());
         },50);
        })
       })
       function reporte_excel(){
			var q=$("#q").val();
			window.location.replace("../excel/rep_clientes.php?q="+q);
    //VentanaCentrada('../excel/rep_gastos.php?daterange='+daterange+"&employee_id="+employee_id,'Reporte','','500','25','true');+"&tipo="+tipo
}

      </script>
      <script type="text/javascript">
      	function reporte(){
		var q=$("#q").val();
		VentanaCentrada('../pdf/documentos/rep_clientes.php?q='+q,'Reporte','','800','600','true');
	}
      </script>

	<?php require 'includes/footer_end.php'
?>
