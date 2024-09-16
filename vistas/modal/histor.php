<?php
if (isset($conexion)) {
    ?>
	<div id="nuevaLinea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Asignar Mensajero</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_linea" name="guardar_linea">
						<div id="resultados_ajax"></div>
                                                <input id="id_pedido" type="hidden" name="id_pedido">
						<select class='form-control' name='mensajero' id='mensajero' required>
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
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="asignar_mensajero()">Asignar</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /.modal -->
	<?php
}
?>