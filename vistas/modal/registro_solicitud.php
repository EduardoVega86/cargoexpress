<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoUsers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nueva Solicitud</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname" class="control-label">Nombres:</label>
									<input type="text" class="form-control UpperCase" id="firstname" name="firstname" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname" class="control-label">Apellidos:</label>
									<input type="text" class="form-control UpperCase" id="lastname" name="lastname" required>
								</div>
							</div>
						</div>
<div class="row"><div class="col-md-6">
								<div class="form-group">
									<label for="user_email" class="control-label">Email:</label>
									<input type="email" class="form-control" id="user_email" name="user_email">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="user_email" class="control-label">Cédula:</label>
									<input type="text" class="form-control" id="identificacion" name="identificacion">
								</div>
							</div>
    
   
							
						</div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Genero</label>
                                                                         <select class="form-control" name="genero" id="genero" required="">
	<option value="">Seleccione...</option>
											<option value="Sr">Masculino</option>
                                                                                        <option value="Sra">Femenido</option>

									</select>
								</div>
							</div>
							
    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Etado Civil</label>
                                                                         <select class="form-control" name="estadocivil" id="estadocivil" required="">
	<option value="">Seleccione...</option>
											<option value="Soltero">Soltero</option>
                                                                                        <option value="Casado">Casado</option>
                                                                                        <option value="Divorsiado">Divorsiado</option>
                                                                                        <option value="Viudo">Viudo</option>

									</select>
								</div>
							</div>
   
							
						</div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Teléfono</label>
                                                                         <input type="text" class="form-control UpperCase" id="telefono" name="telefono" required>
								</div>
							</div>
                                                    
                                                    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Asesor</label>
                                                                         <select class='form-control' name='asesor' id='asesor' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from users where cargo_users=4;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_users']; ?>"><?php echo $rw['nombre_users'].' '.$rw['apellido_users']; ?></option>
													<?php
}
    ?>
											</select>
								</div>
							</div>
							
    
   
							
						</div>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Dirección</label>
                                                                         <input type="text" class="form-control UpperCase" id="direccion" name="direccion" required>
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