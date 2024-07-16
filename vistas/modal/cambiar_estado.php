<?php
if (isset($conexion)) {
    ?>
	<div id="nuevaLinea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Cambiar Estado</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_linea" name="guardar_linea" enctype="multipart/form-data">
						<div id="resultados_ajax"></div>
                                                <div class="col-md-12">
								<div class="form-group">
									 <input id="id_pedido" type="hidden" name="id_pedido">
						<select class='form-control' name='estado' id='estado' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from estados ");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_estado']; ?>"><?php echo $rw['estado']; ?></option>
													<?php
}
    ?>
											</select>
								</div>
							</div>
                                               
                                                <div class="col-md-12">
								<div class="form-group">
                                                                    <label for="mod_nombre" class="control-label">Observacion</label>
                                                <input id="observacion" type="text" name="observacion" class="form-control">
                                                </div>
							</div>
                                                
                                                <div class="col-md-12">
								<div class="form-group">
                                                                    <label for="mod_nombre" class="control-label">Imagen Evidencia</label>
                                                <input id="imagen" type="file" name="imagen" class="form-control">
                                                </div>
							</div>
                                                
                                                <div class="col-md-12">
								<div id="historial" class="form-group">
                                                
                                                </div>
							</div>
</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                  <button type="button" class="btn btn-primary waves-effect waves-light" onclick="cambiar_estado()">Asignar</button>
					</div>
				
			</div>
		</div>
	</div><!-- /.modal -->
	<?php
}
?>