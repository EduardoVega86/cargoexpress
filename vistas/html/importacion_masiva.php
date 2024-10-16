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
$modulo = "Productos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos

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
				<?php if ($permisos_ver == 1) { ?>
					<div class="col-lg-12">
						<div class="portlet">
							<div class="portlet-heading bg-primary">
								<h3 class="portlet-title">Improtacion Masiva</h3>
								<div class="clearfix"></div>
							</div>
							<div id="bg-primary" class="panel-collapse collapse show">
								<div class="portlet-body">

									<!-- Input de tipo file con diseño de Bootstrap -->
									<form enctype="multipart/form-data" method="post" id="fileForm">
    <input type="file" name="archivo_pedidos" id="archivo_pedidos" />
    <button type="button" id="agregarBtn" class="btn btn-primary">Agregar</button>
</form>

								</div>
							</div>
						</div>
					</div>
                                  <div class="row">
                            <div class="col-lg-12">
                            <!-- Tabla donde se mostrarán los datos -->
<table id="tabla_pedidos" class="table">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Latitud Origen</th>
            <th>Longitud Origen</th>
            <th>Latitud Destino</th>
            <th>Longitud Destino</th>
            <th>Distancia</th>
            <th>Valor</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
                            </div>
                                      </div>
				<?php } else { ?>
					<section class="content">
						<div class="alert alert-danger" align="center">
							<h3>Acceso denegado!</h3>
							<p>No cuentas con los permisos necesario para acceder a este módulo.</p>
						</div>
					</section>
				<?php } ?>
			</div>
		</div>

		<?php require 'includes/pie.php';?>

	</div>
</div>

<?php require 'includes/footer_start.php';?>
<!-- ============================================================== -->
<!-- Todo el codigo js aqui -->
<!-- ============================================================== -->
<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
<script>
    // Función para leer y procesar el archivo cuando se haga clic en el botón "Agregar"
    $("#agregarBtn").on('click', function(e) {
        var formData = new FormData($('#fileForm')[0]);
        
        // Enviar el archivo al servidor
        $.ajax({
            url: '../ajax/procesar_archivo.php', // Archivo PHP para procesar el archivo
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Aquí se procesan los datos y se muestran en la tabla
                $('#tabla_pedidos tbody').html(response);
            }
        });
    });

    // Función para calcular la distancia en cada fila
    function calcular_distancia(row) {
        var origen_lat = $(row).find("#latitud_remitente").val();
        var origen_lon = $(row).find("#longitud_remitente").val();
        var destino_lat = $(row).find("#latitud_destinatario").val();
        var destino_lon = $(row).find("#longitud_destinatario").val();
        var cliente = $(row).find("#cliente").val();

        // Lógica de Google Maps API o cualquier otra para calcular la distancia
        if (origen_lat && origen_lon && destino_lat && destino_lon) {
            // Aquí deberías llamar a la API de Google Maps para calcular la distancia
            console.log("Calculando distancia para el cliente:", cliente);
        } else {
            alert('Por favor, completa las coordenadas de origen y destino.');
        }
    }
</script>

<?php require 'includes/footer_end.php';?>
