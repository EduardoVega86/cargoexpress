<?php
if (isset($conexion)) {
    ?>
	<div id="editarProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Editar Edificio</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
						<div id="resultados_ajax2"></div>

						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a href="#mod_info" data-toggle="tab" aria-expanded="false" class="nav-link active">
									Datos Básicos
								</a>
							</li>
							
							<li class="nav-item">
								<a href="#img2" data-toggle="tab" aria-expanded="true" class="nav-link">
									Imagen
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="mod_info">

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="mod_codigo" class="control-label">Nombre:</label>
											<input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  autocomplete="off" required>
											<input id="mod_id" name="mod_id" type='hidden'>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="mod_direccion" class="control-label">Direccion</label>
											<textarea class="form-control UpperCase"  id="mod_direccion" name="mod_direccion" maxlength="255"  autocomplete="off"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="mod_fecha" class="control-label">Fecha contrato:</label>
											<input type="text" class="form-control" id="mod_fecha" name="mod_fecha"    >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="mod_telefono" class="control-label">Telefono:</label>
											<input type="text" class="form-control" id="mod_telefono" name="mod_telefono"    >
										</div>
									</div>
								</div>
								

							</div>
							
							<div class="tab-pane fade" id="img2">

								<div class="outer_img"></div>


							</div>

						</div>



					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" id="actualizar_datos">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /.modal -->
	<?php
}
?>