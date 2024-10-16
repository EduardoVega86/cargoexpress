<?php
if (isset($conexion)) {
    ?>
	<div id="nuevaLinea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Documento</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_linea" name="guardar_linea">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Nombre:</label>
									<input type="text" class="form-control UpperCase" id="nombre" name="nombre"  autocomplete="off" required>
								</div>
							</div>
                                                    
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre" class="control-label">Subir documento:</label>
									<select class="form-control" id="upload" name="upload" required>
										<option value="">-- Selecciona --</option>
										<option value="1" selected>SI</option>
										<option value="0">NO</option>
									</select>
								</div>
							</div>
                                                    <div class="col-md-6">
								<div class="form-group">
									<label for="nombre" class="control-label">Tiene Vigencia:</label>
									<select class="form-control" id="vigencia" name="vigencia" required>
										<option value="">-- Selecciona --</option>
										<option value="1" selected>SI</option>
										<option value="0">NO</option>
									</select>
								</div>
							</div>
						</div>
						

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" id="guardar_datos">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /.modal -->
	<?php
}
?>