<?php
if (isset($conexion)) {
    ?>
	<div id="nuevaLinea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Departamento</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_personal" name="guardar_dep">
						<div id="resultados_ajax"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre" class="control-label">Usuario</label>
									<select class='form-control' name='usuario' id='usuario' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from users where cargo_users=3");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_users']; ?>"><?php echo $rw['nombre_users'].' '.$rw['apellido_users']; ?></option>
													<?php
}
    ?>
											</select>
								</div>
							</div>
                                                    <div class="col-md-6">
								<div class="form-group">
									<label for="nombre" class="control-label">Servicio</label>
                                                                        <?php //echo "select * from servicios, servicio_edificio where servicio_edificio.id_servicio=servicios.id_servicio order by nombre_servicio where id_edificio=$id_edificio";?>
									<select class='form-control' name='servicio' id='servicio' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from servicios, servicios_edificio where servicios_edificio.id_servicio=servicios.id_servicio and id_edificio=$id_edificio order by nombre_servicio ;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_servicio']; ?>"><?php echo $rw['nombre_servicio']; ?></option>
													<?php
}
    ?>
											</select>
                                                                          <input type="hidden"  id="id_edificio_ingresar" name="id_edificio_ingresar" value="<?php echo  $id_edificio; ?>">
								</div>
							</div>
						</div>

						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="estado" class="control-label">Estado:</label>
									<select class="form-control" id="estado" name="estado" required>
										<option value="">-- Selecciona --</option>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
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