	<form id="">
		<div class="modal fade" id="stock_ad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<input type="hidden" id="id_departamento" name="id_departamento">
					<!--h3 class="text-center text-muted">Estas seguro?</h3-->
					<p class="lead text-muted text-center" style="display: block;margin:9px">Ingrese nombre y telefono del contacto.</p>
                                        <div style="padding: 5px" class="row">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" id="nombre_contacto" placeholder="Nombre" name="nombre_contacto">
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" id="telefono" placeholder="Telf." name="telefono">
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