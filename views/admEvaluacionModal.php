<div class="modal fade" id="modalcrearEvaluacion" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="evaluacion_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="eva_id" id="eva_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_id">Profesor</label>
                                <select class="form-control select2" style="width:100%" name="prof_id" id="prof_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="eva_fecha">Semestre</label>
                                <input type="text" class="form-control" name="eva_fecha" id="eva_fecha" placeholder="Ingrese el semestre en que se realizo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="eva_nota">Calificación</label>
                                <input type="text" class="form-control" name="eva_nota" id="eva_nota" placeholder="Ingrese la calificación obtenida">
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