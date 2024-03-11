<?php
if (isset($conexion)) {
    ?>
	<div id="editarUsers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Editar Usuario</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
						<div id="resultados_ajax2"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname2" class="control-label">Nombres:</label>
									<input type="text" class="form-control UpperCase" id="firstname2" name="firstname2" required>
									<input type="hidden" id="mod_id" name="mod_id">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname2" class="control-label">Apellidos:</label>
									<input type="text" class="form-control UpperCase" id="lastname2" name="lastname2" required>
								</div>
							</div>
						</div>

						<div class="row"><div class="col-md-6">
								<div class="form-group">
									<label for="user_email" class="control-label">Email:</label>
									<input type="email" class="form-control" id="user_email2" name="user_email2">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="user_email" class="control-label">Cédula:</label>
									<input type="text" class="form-control" id="identificacion2" name="identificacion2">
								</div>
							</div>
    
   
							
						</div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Genero</label>
                                                                         <select class="form-control" name="genero2" id="genero2" required="">
	<option value="">Seleccione...</option>
											<option value="Sr">Masculino</option>
                                                                                        <option value="Sra">Femenido</option>

									</select>
								</div>
							</div>
							
    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Etado Civil</label>
                                                                         <select class="form-control" name="estadocivil2" id="estadocivil2" required="">
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
                                                                         <input type="text" class="form-control UpperCase" id="telefono2" name="telefono2" required>
								</div>
							</div>
                                                    
                                                    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Asesor</label>
                                                                         <select class='form-control' name='asesor2' id='asesor2' required>
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
                                                                         <input type="text" class="form-control UpperCase" id="direccion2" name="direccion2" required>
								</div>
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