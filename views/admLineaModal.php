<div class="modal fade" id="modalcrearLinea" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="linea_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="linea_id" id="linea_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="linea_nom">Línea de Investigación</label>
                                <input type="text" class="form-control" name="linea_nom" id="linea_nom" placeholder="Ingrese el nombre de la línea de investigación">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="linea_est">Estado</label>
                                <select class="form-control select2" style="width:100%" name="linea_est" id="linea_est" data-placeholder="Seleccione">
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