	<form id="">
		<div class="modal fade" id="stock_ad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<input type="hidden" id="id_subproceso" name="id_subproceso">
					<!--h3 class="text-center text-muted">Estas seguro?</h3-->
					<p class="lead text-muted text-center" style="display: block;margin:9px">Ingrese actividades para el subproceso.</p>
                                        <div style="padding: 5px" class="row">
                                        <div class="col-md-5">
                                            <label for="nombre" class="control-label">Cliente:</label>
                                            <input type="text" class="form-control" id="actividad" placeholder="Actividad" name="actividad">
    </div>
    <div class="col-md-5">
        <label for="nombre" class="control-label">Fecha limite:</label>
        <input type="date" class="form-control" id="fecha_limite" placeholder="Telf." name="fecha_limite">
        <span class="help-block">Ingrese unicamente si se requiere</span>
    </div>
                                             <div class="col-md-2">
                                                 <?php ?>
                                                 <button type="button" class="btn btn-primary waves-effect waves-light" onclick="agrega_st()" id="stock_lote" name="stock_lote">+</button>
    </div>
                                            </div>
                                        <div style="padding: 5px" id="stock_lista" class="row">
                              
                                            </div>
  
                                        
                                        
                                        <div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal">Aceptar</button>
						
					</div>
				</div>
			</div>
		</div>
	</form>