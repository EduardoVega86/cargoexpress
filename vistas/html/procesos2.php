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
$id_proceso = $_GET['id'];
$modulo = "Productos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$count      = mysqli_query($conexion, "select MAX(codigo_producto) as codigo from productos");
$rw         = mysqli_fetch_array($count);
$product_id =  intval($rw['codigo']) + 1;
//consulta para elegir el impuesto en la modal
$query    = $conexion->query("select * from impuestos");
$impuesto = array();
while ($r = $query->fetch_object()) {$impuesto[] = $r;}
?>

<?php require 'includes/header_start.php';?>

<?php require 'includes/header_end.php';?>

<!-- Begin page -->
<div id="wrapper" class="forced enlarged"> <!-- DESACTIVA EL MENU -->

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
									Subproceso
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
        include '../modal/registro_proceso2.php';
        include "../modal/editar_edificio.php";
        @include "../modal/eliminar_edificio.php";
         include "../modal/agregar_servicio.php";
    }
    ?>

									<form class="form-horizontal" role="form" id="datos_cotizacion">
										<div class="form-group row">
                                                                                    	<div class="col-md-12">
											<div class="input-group">
                                                                                            <input type="hidden"  id="id_proceso" name="id_proceso" value="<?php echo  $id_proceso; ?>">
                                                                                            <img width="45px" src="<?php
                                                                                                        echo get_row('proceso', 'url_image', 'id_proceso', $id_proceso);
                                                                                                        ?>" alt=""/>
													<?php
                                                                                                        echo '<h2>'. get_row('proceso', 'nombre', 'id_proceso', $id_proceso).'</h2>';
                                                                                                        ?>
												</div>
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<input type="text" class="form-control" id="q" placeholder="Código o Nombre" onkeyup='load(1);'>
													</div>
												</div>
												<div class="col-md-3">
												<div class="input-group">
						
													
												</div>
												</div>
												<div class="col-md-2">
													<span id="loader"></span>
												</div>

												<div class="col-md-2">
													<div class="btn-group pull-right">
														<button type="button" class="btn btn-success btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#nuevoProducto"><i class="fa fa-plus"></i> Agregar</button>
													</div>

												</div>
													<div class="col-md-2">
													<div class="btn-group pull-right">
														<?php if ($permisos_editar == 1) {?>
														<div class="btn-group dropup">
															<button aria-expanded="false" class="btn btn-outline-default btn-rounded waves-effect waves-light" data-toggle="dropdown" type="button">
																<i class='fa fa-file-text'></i> Reporte
																<span class="caret">
																</span>
															</button>
															<div class="dropdown-menu">
																<a class="dropdown-item" href="#" onclick="reporte();">
																	<i class='fa fa-file-pdf-o'></i> PDF
																</a>
																<a class="dropdown-item" href="#" onclick="reporte_excel();">
																	<i class='fa fa-file-excel-o'></i> Excel
																</a>
															</div>
														</div>
														<?php }?>
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
	<script type="text/javascript" src="../../js/procesos2.js"></script>
	<script>
		function precio_venta(){
			var profit = $("#utilidad").val();
			var buying_price = $("#costo").val();

			var parametros = {"utilidad":profit,"costo":buying_price};
			$.ajax({
				dataType: "json",
				type:"POST",
				url:'../ajax/precio.php',
				data: parametros,
				success:function(data){
          //$("#datos").html(data).fadeIn('slow');
          $.each(data, function(index, element) {
          	var precio= element.precio;
          	$("#precio").val(precio);
          });


      }
  })
		}
		function precio_venta_edit(){
			var profit = $("#mod_utilidad").val();
			var buying_price = $("#mod_costo").val();

			var parametros = {"mod_utilidad":profit,"mod_costo":buying_price};
			$.ajax({
				dataType: "json",
				type:"POST",
				url:'../ajax/precio.php',
				data: parametros,
				success:function(data){
          //$("#datos").html(data).fadeIn('slow');
          $.each(data, function(index, element) {
          	var mod_precio= element.mod_precio;
          	$("#mod_precio").val(mod_precio);
          });


      }
  })
		}

	</script>
	<script>
		$(document).ready( function () {
			$(".UpperCase").on("keypress", function () {
				$input=$(this);
				setTimeout(function () {
					$input.val($input.val().toUpperCase());
				},50);
			})
		})
	</script>
	<script>
		function upload_image(product_id){
			$("#load_img").text('Cargando...');
			var inputFileImage = document.getElementById("imagefile");
			var file = inputFileImage.files[0];
			var data = new FormData();
			data.append('imagefile',file);



			$.ajax({
					url: "../ajax/imagen_edificio.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$("#load_img").html(data);

					}
				});

		}
		function upload_image_mod(id_producto){
			$("#load_img_mod").text('Cargando...');
			var inputFileImage = document.getElementById("imagefile_mod");
			var file = inputFileImage.files[0];
			var data = new FormData();
			data.append('imagefile_mod',file);
			data.append('id_producto',id_producto);



			$.ajax({
					url: "../ajax/imagen_edificio.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$("#load_img_mod").html(data);

					}
				});

		}
	</script>
	<script>
		function carga_img(id_producto) {
			$(".outer_img").load("../ajax/img.php?id_producto=" + id_producto);
		}
		function reporte_excel(){
			var q=$("#q").val();
			window.location.replace("../excel/rep_productos.php?q="+q);
    //VentanaCentrada('../excel/rep_gastos.php?daterange='+daterange+"&employee_id="+employee_id,'Reporte','','500','25','true');+"&tipo="+tipo
}
function reporte(){
		var daterange=$("#range").val();
		var categoria=$("#categoria").val();
		VentanaCentrada('../pdf/documentos/rep_productos.php?daterange='+daterange+"&categoria="+categoria,'Reporte','','800','600','true');
	}
        
        function servicio_id(id){
          //  alert(id)
               $('#id_producto').val(id);
                $.ajax({
		        url: '../ajax/buscar_servicio_edificio.php?action=ajax&id_producto=' + id,
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
        
           id=$('#id_producto').val()
           
           
           servicio=$('#servicio').val()
         //  alert(servicio);
              $.ajax({
		        url: '../ajax/buscar_servicio_edificio.php?action=agrega&id_producto=' + id+'&servicio='+servicio,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $("#stock_lista").html(data);
		            $('#loader').html('');
		        }
		    })  
             
        }
        function eliminar_stock(id_stock){
        
          //alert(id)
          id=$('#id_producto').val()
              $.ajax({
		        url: '../ajax/buscar_servicio_edificio.php?action=elimina&id_stock=' + id_stock+'&id_producto='+id,
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

