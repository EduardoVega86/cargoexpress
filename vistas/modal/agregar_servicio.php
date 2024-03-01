	<form id="">
		<div class="modal fade" id="stock_ad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<input type="hidden" id="id_producto" name="id_producto">
					<!--h3 class="text-center text-muted">Estas seguro?</h3-->
					<p class="lead text-muted text-center" style="display: block;margin:9px">Ingrese servicio</p>
                                        <div style="padding: 5px" class="row">
                                        <div class="col-md-8">
    <select class='form-control' name='servicio' id='servicio' required>
												<option value="">-- Selecciona --</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from servicios order by nombre_servicio;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_servicio']; ?>"><?php echo $rw['nombre_servicio']; ?></option>
													<?php
}
    ?>
											</select>
                                            
    </div>
   
                                             <div class="col-md-2">
                                                 <?php ?>
                                                 <button type="button" class="btn btn-primary waves-effect waves-light" onclick="agrega_st()" id="stock_lote" name="stock_lote">+</button>
    </div>
                                            </div>
                                        <div style="padding: 5px" id="stock_lista" class="row">
                              
                                            </div>
  
                                        
                                        
                                        <div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger waves-effect waves-light">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
	</form>