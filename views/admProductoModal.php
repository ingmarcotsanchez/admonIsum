<div class="modal fade" id="modalcrearProducto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="productos_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="prod_id" id="prod_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prod_nom">Título del Producto</label>
                                <input type="text" class="form-control" name="prod_nom" id="prod_nom" placeholder="Ingrese el título del producto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prod_anno">Año</label>
                                <input type="text" class="form-control" name="prod_anno" id="prod_anno" placeholder="Ingrese el Año de elaboración">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prod_tipo">Tipo</label>
                                <select class="form-control select2" name="prod_tipo" id="prod_tipo" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="AD">Artículo Divulgativo</option>
                                    <option value="AS">Artículo Scopus</option>
                                    <option value="DS">Desarrollo de Software</option>
                                    <option value="PI">Ponencia Interna</option>
                                    <option value="PE">Ponencia Externa</option>
                                    <option value="CL">Capitulo de libro</option>
                                    <option value="OT">Otros</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sem_id">Semillero</label>
                                <select class="form-control select2" style="width:100%" name="sem_id" id="sem_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>