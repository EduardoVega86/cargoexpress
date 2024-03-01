<?php
if (isset($conexion)) {
    ?>
	<div id="nuevoProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Edificio</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
						<div id="resultados_ajax"></div>

						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a href="#info" data-toggle="tab" aria-expanded="false" class="nav-link active">
									Datos Básicos
								</a>
							</li>
							
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="info">

								<div class="row">
						
									<div class="col-md-12">
										<div class="form-group">
											<label for="nombre" class="control-label">Nombre Edificio:</label>
											<input type="text" class="form-control UpperCase" id="nombre" name="nombre" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="descripcion" class="control-label">Direccion</label>
											<textarea class="form-control UpperCase"  id="direccion" name="direccion" maxlength="255" autocomplete="off"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									   
										<div class="form-group">
										    
											<label for="linea" class="control-label">Fecha Contrato:</label>
                                                                                        <input type="date" class="form-control" id="fecha_contrato" name="fecha_contrato"    >
											
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="proveedor" class="control-label">Telefono:</label>
											<input type="text" class="form-control" id="telefono" name="telefono"    >
										</div>
									</div>
								</div>
								

							</div>
							
<div class="tab-pane fade" id="img">

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="image" class="col-sm-2 control-label">Imagen</label>
											<div class="col-sm-10">
												<input type="file" class='form-control' name="imagefile" id="imagefile" onchange="upload_image(<?php echo $product_id; ?>);">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-sm-6 col-lg-8 col-md-4 webdesign illustrator">
										<div class="gal-detail thumb">
											<div id="load_img">
												<img src="../../img/productos/default.jpg" class="thumb-img" width="200" alt="Bussines profile picture">
											</div>
										</div>
									</div>
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