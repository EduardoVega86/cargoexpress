<?php
if (isset($conexion)) {
    ?>
	<div id="editarUsers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Usuario</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname" class="control-label">Nombres Empresa:</label>
									<input type="text" class="form-control UpperCase" id="firstname2" name="firstname2" required>
                                                                        <input type="hidden" id="mod_id" name="mod_id">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname" class="control-label">Razon Social:</label>
									<input type="text" class="form-control UpperCase" id="lastname2" name="lastname2" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="user_name" class="control-label">Usuario:</label>
									<input type="text" class="form-control" id="user_name2" name="user_name2" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="user_email" class="control-label">Email:</label>
									<input type="email" class="form-control" id="user_email2" name="user_email2">
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