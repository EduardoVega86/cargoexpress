<?php
if (isset($conexion)) {
    ?>
	<div id="editarCamion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Actualizar Camion</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_camion" name="editar_camion">
						<div id="resultados_actualiza_camion"></div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname" class="control-label">Estado:</label>
                                                                        
                                                                        <input type="hidden" id="mod_id_camion" name="mod_id_camion">
                                                                        <select class='form-control' name='estadocamion2' id='estadocamion2' required>
												<option value="">-- Selecciona --</option>
			
													<option value="1">Nuevo</option>
                                                                                                        <option value="2">Seminuevo</option>
											</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname" class="control-label">Placa:</label>
                                                                        <input type="text" class="form-control UpperCase" id="placa2" name="placa2" placeholder="Ingrese Placa" required>
								</div>
							</div>
						</div>
                <div class="row"><div class="col-md-6">
								<div class="form-group">
									<label for="user_email" class="control-label">Tipo:</label>
									<select class='form-control' name='vantype2' id='vantype2' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from vantype;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id']; ?>"><?php echo $rw['name']; ?></option>
													<?php
}
    ?>
											</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Marca</label>
                                                                         <select class='form-control' name='brand2' id='brand2' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from brand;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id']; ?>"><?php echo $rw['name']; ?></option>
													<?php
}
    ?>
											</select>
								</div>
							</div>
    
   
							
						</div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
							<div class="form-group">
									<label for="user_email" class="control-label">Tonelaje:</label>
									<select class='form-control' name='weight2' id='weight2' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from weight;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id']; ?>"><?php echo $rw['name'].' TONELADAS'; ?></option>
													<?php
}
    ?>
											</select>
								</div>	
                                                        
							</div>
							
    <div class="col-md-6">
								<div class="form-group">
									 <label for="user_group_id" class="control-label">Año</label>
                                                                         <?php
// Año actual
$anioActual = date("Y");

echo '<select class="form-control " id="anio2" name="anio2" required>';

// Bucle para los últimos 5 años
for ($i = -1; $i < 5; $i++) {
    // Año a mostrar
    $anio = $anioActual - $i;
    
    // Crear la opción para el año
    echo "<option value=\"$anio\">$anio</option>";
}

echo '</select>';
?>
                                                                      
								</div>
							</div>
   
							
						</div>
                                                <div class="row">
                                                    <div class="col-md-12">
							<div class="form-group">
									<label for="user_email" class="control-label">Chasis:</label>
								<input type="text" class="form-control UpperCase" id="chasis2" name="chasis2" placeholder="Ingrese Chasis" required>	
								</div>	
                                                        
							</div>
							
    
   
							
						</div>
						

						

						


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" id="editar_datos_camion">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- /.modal -->
	<?php
}
?>