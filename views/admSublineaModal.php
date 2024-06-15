<div class="modal fade" id="modalcrearSubLinea" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="sublinea_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="sublinea_id" id="sublinea_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sublinea_nom">Sub Línea de Investigación</label>
                                <input type="text" class="form-control" name="sublinea_nom" id="sublinea_nom" placeholder="Ingrese el nombre de la sub línea de investigación">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sublinea_est">Estado</label>
                                <select class="form-control select2" style="width:100%" name="sublinea_est" id="sublinea_est" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value=1>Activo</option>
                                    <option value=0>Inactivo</option>
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