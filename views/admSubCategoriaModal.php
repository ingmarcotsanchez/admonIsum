<div class="modal fade" id="modalcrearSubcategoria" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="subcategoria_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="cats_id" id="cats_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cat_id">Categoria</label>
                                <select class="form-control select2" style="width:100%" name="cat_id" id="cat_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cats_nom">Sub Categoria</label>
                                <input type="text" class="form-control" name="cats_nom" id="cats_nom" placeholder="Ingrese la Sub Categoria">
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
