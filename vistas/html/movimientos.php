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
				<?php if ($permisos_ver == 1) {
    ?>
					<div class="col-lg-12">
						<div class="portlet">
							<div class="portlet-heading bg-primary">
								<h3 class="portlet-title">
									Edificio
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
       
    }
    ?>

									<form class="form-horizontal" role="form" id="datos_cotizacion">
										<div class="form-group row">
                                                                                    <div class="col-md-2">
                                                 
                                                 <select class='form-control' name='estado' id='estado' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from estados");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_estado']; ?>"><?php echo $rw['estado']; ?></option>
													<?php
}
    ?>
											</select>												    
												</div>
											<div class="col-md-2">
												<div class="input-group">
													<input type="text" class="form-control" id="q" placeholder="Código" >
													</div>
												</div>
												<div class="col-md-1">
												<div class="btn-group pull-left">
                                                                                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light" onclick="agregar()"><i class="fa fa-plus"></i> Agregar</button>
													</div>
												</div>
                                                                                      <div class="col-md-2">
                                                 
                                                 <select class='form-control' name='estado_cambiar' id='estado_cambiar' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from estados");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_estado']; ?>"><?php echo $rw['estado']; ?></option>
													<?php
}
    ?>
											</select>												    
												</div>
                                                                                    
                                                                                    <div class="col-md-2">
                                                 
                                                 <select class='form-control' name='mensajero' id='mensajero'>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from users where cargo_users=6");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_users']; ?>"><?php echo $rw['nombre_users'].' '.$rw['apellido_users']; ?></option>
													<?php
}
    ?>
											</select>												    
												</div>
                                                                                    
												

												<div class="col-md-3">
													<div class="btn-group pull-right">
                                                                                                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light" onclick="generar_movimiento()"><i class="fa fa-plus"></i> GENERAR MOVIMIENTO</button>
													</div>

												</div>
													

											</div>
										</form>
										<div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
										<table class="table table-striped" id="tabla-codigos">
    <thead>
        <tr>
            <th>Código</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="listado-codigos">
        <!-- Aquí se agregarán las guías -->
    </tbody>
</table>



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
	<script type="text/javascript" src="../../js/edificios.js"></script>
	<script>
        function agregar() {
    var q = $('#q').val();        // Obtener valor del input q
    var estado = $('#estado').val();  // Obtener valor del input estado

    if(q === "" || estado === "") {
        Swal.fire({
            icon: 'error',
            title: 'Campos vacíos',
            text: 'Debe completar ambos campos'
        });
        return;
    }

    // Verificar si el código ya existe en el listado
    if ($('#item-' + q).length > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Guía ya ingresada',
            text: 'El código de esta guía ya fue ingresado'
        });
        return;
    }

    // Realizar la solicitud AJAX
    $.ajax({
        url: '../ajax/buscar_pedido.php',
        type: 'POST',
        data: { q: q, estado: estado },
        success: function(response) {
            if (response == 0) {
                // Mostrar alerta si no se encuentra guía
                Swal.fire({
                    icon: 'error',
                    title: 'Guía no encontrada',
                    text: 'No se encontró un pedido con ese código y estado'
                });
            } else {
                // Si se encuentra la guía, agregar una nueva fila a la tabla
                var codigoHTML = `
                    <tr class="codigo-item" id="item-${q}">
                        <td>${q}</td>
                        <td>${estado}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="eliminarCodigo('${q}')">Eliminar</button>
                        </td>
                    </tr>`;
                
                $('#listado-codigos').append(codigoHTML);
                
                // Mostrar alerta de éxito
                Swal.fire({
                    icon: 'success',
                    title: 'Guía agregada',
                    text: 'La guía se agregó al listado correctamente'
                });
            }
        }
    });
}
function eliminarCodigo(codigo) {
    // Remover el div correspondiente al código
    $('#item-' + codigo).remove();
}


function generar_movimiento() {
    // Obtener el valor del nuevo estado
    var estado_cambiar = $('#estado_cambiar').val();
    var mensajero = $('#mensajero').val();
    
    var mensajero = $('#mensajero').val().trim(); // Utiliza .trim() para eliminar espacios en blanco

  if (estado_cambiar === "2" && (mensajero === "" || mensajero === null)) {
    Swal.fire({
        icon: 'error',
        title: 'Campos vacíos',
        text: 'Debe seleccionar un mensajero para poner las guías en tránsito'
    });
    return;
}

    // Inicializar un arreglo para los IDs de los pedidos
    var lista_pedidos = [];

    // Recorrer el listado para obtener los IDs de los pedidos
    $('#listado-codigos .codigo-item').each(function() {
        // Obtener el ID del pedido (en este caso, 'q' corresponde al id_pedido)
        var id_pedido = $(this).attr('id').split('-')[1];  // ID viene en el formato 'item-{id}'
        lista_pedidos.push(id_pedido);  // Agregar el ID al arreglo
    });

    // Verificar si hay al menos un pedido seleccionado
    if (lista_pedidos.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'No hay pedidos',
            text: 'Debe agregar al menos un pedido para cambiar su estado.'
        });
        return;
    }

    // Realizar la solicitud AJAX para actualizar el estado de los pedidos
    $.ajax({
        url: '../ajax/cambiar_estado_pedidos.php',
        type: 'POST',
        data: {
            estado_cambiar: estado_cambiar,
            lista_pedidos: lista_pedidos,
             mensajero: mensajero
        },
        success: function(response) {
            console.log(response); // Esto nos ayudará a ver la respuesta que recibimos en consola

            // Intentar convertir la respuesta a JSON si es que no se hizo automáticamente
            var jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;

            // Revisar si la respuesta indica éxito
            if (jsonResponse.success) {
                // Mostrar alerta de éxito
                Swal.fire({
                    icon: 'success',
                    title: 'Estado cambiado',
                    text: 'El estado de los pedidos ha sido cambiado exitosamente.'
                });
                // Opcional: limpiar el listado
                $('#listado-codigos').empty();
            } else {
                // Mostrar alerta de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al cambiar el estado de los pedidos.'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(error); // Mostrar el error en la consola
            Swal.fire({
                icon: 'error',
                title: 'Error en la solicitud',
                text: 'No se pudo conectar con el servidor.'
            });
        }
    });
}



        </script>
	
	
<?php require 'includes/footer_end.php'
?>

