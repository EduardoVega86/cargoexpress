	<form id="">
		<div class="modal fade" id="stock_ad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<input type="hidden" id="id_producto" name="id_producto">
					<!--h3 class="text-center text-muted">Estas seguro?</h3-->
					<p class="lead text-muted text-center" style="display: block;margin:9px">Ingrese fecha de caducidad y stock para agregar un nuevo lote.</p>
                                        <div style="padding: 5px" class="row">
                                        <div class="col-md-6">
    <input type="date" class="form-control" id="fecha_vence_lote" name="fecha_vence_lote">
    </div>
    <div class="col-md-4">
      <input type="number" class="form-control" id="stock_lote" name="stock_lote">
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