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
$modulo = "Verificacion de socios";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title    = "Verificacion de socios";
$Usuarios = 1;

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
									socios
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
        include "../modal/registro_solicitud.php";
        include "../modal/registro_camion.php";
        include "../modal/editar_solicitud.php";
        include "../modal/editar_camion.php";
        include "../modal/cambiar_password.php";
        include "../modal/eliminar_usuario.php";
    }
    ?>

									<form class="form-horizontal" role="form" id="datos_cotizacion">
										<div class="form-group row">
											<div class="col-md-6">
												<div class="input-group">
													<input type="text" class="form-control" id="q" placeholder="Buscar por Nombre" onkeyup='load(1);'>
                                                                                                        <input type="hidden"  id="usuarioseleccionado" >
                                                                                                        <input type="hidden"  id="camionseleccionado" >
													<span class="input-group-btn">
														<button type="button" class="btn btn-info waves-effect waves-light" onclick='load(1);'>
															<span class="fa fa-search" ></span> Buscar</button>
														</span>
													</div>
												</div>
												<div class="col-md-3">
													<div class="resultados_ajax3"></div>
													<span id="loader"></span>
												</div>
												<div class="col-md-3">
													<div class="btn-group pull-right">
														<button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#nuevoUsers"><i class="fa fa-plus"></i> Nuevo</button>
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
                            <div class="row">
                            <div class="col-lg-8">
                                
                                	<div class="portlet">
							<div class="portlet-heading bg-primary">
								<h3 class="portlet-title">
									CAMIONES
								</h3>
								<div class="portlet-widgets">
									<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
									<span class="divider"></span>
									<a data-toggle="collapse" data-parent="#accordion2" href="#bg-primary"><i class="ion-minus-round"></i></a>
									<span class="divider"></span>
									<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div id="bg-primary" class="panel-collapse collapse show">
								<div class="portlet-body">
                                                               <form class="form-horizontal" role="form" id="">
										<div class="form-group row">
											<div class="col-md-6">
												
												</div>
												<div class="col-md-3">
													<div class="resultados_ajax3"></div>
													<span id="loader"></span>
												</div>
												

											</div>
										</form>
										<div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
										<div class='outer_div2'></div>     
                                                                    
                            </div>
                                                            </div>
                                            </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="portlet">
							<div class="portlet-heading bg-primary">
								<h3 class="portlet-title">
									HABILITAR
								</h3>
								<div class="portlet-widgets">
									<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
									<span class="divider"></span>
									<a data-toggle="collapse" data-parent="#accordion3" href="#bg-primary"><i class="ion-minus-round"></i></a>
									<span class="divider"></span>
									<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div id="bg-primary" class="panel-collapse collapse show">
								<div class="portlet-body">
                                                               <form class="form-horizontal" role="form" id="">
										<div class="form-group row">
											<div class="col-md-6">
												<div class="input-group">
													
													</div>
												</div>
												<div class="col-md-3">
													
												</div>
												<div class="col-md-3">
													

												</div>

											</div>
										</form>
										<div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
										<div class='outer_div3'></div>     
                                                                                
                            </div>
                                                            </div>
                                            </div>
                                </div></div>
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
	<!-- Todo el codigo js aqui
	<!-- ============================================================== -->
	<script type="text/javascript" src="../../js/verificacion_socios.js"></script>
	<script>
                
		function editar_pw(user_id) {
			$(".outer_div3").load("../modal/password.php?user_id=" + user_id);
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
        function upload_image(id, id_usuario){
			//$("#load_img").text('Cargando...');
                        input="imagefile"+id
                       
			var inputFileImage = document.getElementById(input);
                         
			var file = inputFileImage.files[0];
                        alert(file);
			var data = new FormData();
			data.append('imagefile',file);
                        data.append('id',id);
                         data.append('id_usuario',id_usuario);



			$.ajax({
					url: "../ajax/cargar_docu_socio.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						
camion(id_usuario);
					}
				});

		}
                
                function activarchofer() {
                    id_usuario=$("#usuarioseleccionado").val();
                    //alert(id_usuario);
                      var parametros = $(this).serialize();
		$.ajax({
    url: "../ajax/activar_chofer.php",
    type: "POST",
    data: { id_usuario: id_usuario },
    success: function(response) {
           if (response === "ok") {
              // alert();
                  Swal.fire({
                    title: "¡Activación de usuario exitosa!",
                    icon: "success",
                    confirmButtonText: "¡Aceptar!",
                  }).then(() => {
                    window.location.reload();
                  });
                }
    },
    error: function(xhr, status, error) {
        console.error("Error en la solicitud: " + error);
    }
});
                }
                function activarcamion() {
                    id_usuario=$("#usuarioseleccionado").val();
                    //alert(id_usuario);
                      var parametros = $(this).serialize();
		$.ajax({
    url: "../ajax/activar_camion.php",
    type: "POST",
    data: { id_usuario: id_usuario },
    success: function(response) {
           if (response === "ok") {
              // alert();
                  Swal.fire({
                    title: "¡Activación de usuario exitosa!",
                    icon: "success",
                    confirmButtonText: "¡Aceptar!",
                  }).then(() => {
                    window.location.reload();
                  });
                }
    },
    error: function(xhr, status, error) {
        console.error("Error en la solicitud: " + error);
    }
});
                }
	</script>
	<?php require 'includes/footer_end.php'
?>

