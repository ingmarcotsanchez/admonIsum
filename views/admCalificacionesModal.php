<div class="modal fade" id="modalagregarCalificacion" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="calificaciones_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="asigxest_id" id="asigxest_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="asig_id">Asignatura</label>
                                <select class="form-control select2" style="width:100%" name="asig_id" id="asig_id" data-placeholder="Seleccione" disabled>
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asigxest_nota">Calificación</label>
                                <input type="text" class="form-control" name="asigxest_nota" id="asigxest_nota" placeholder="Ingrese una calificación">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asigxest_est">Estado</label>
                                <select class="form-control select2" name="asigxest_est" id="asigxest_est" data-placeholder="Seleccione" readonly>
                                    <option label="Seleccione"></option>
                                    <option value=1>Aprobada</option>
                                    <option value=0>Reprobada</option>
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
