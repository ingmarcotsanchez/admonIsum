<div class="modal fade" id="modalcrearAsignatura" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="asignatura_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="asig_id" id="asig_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asig_nom">Asignatura</label>
                                <input type="text" class="form-control" name="asig_nom" id="asig_nom" placeholder="Ingrese el Peso">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asig_alfa">Alfanumerico</label>
                                <input type="text" class="form-control" name="asig_alfa" id="asig_alfa" placeholder="Ingrese el Alfanumerico">
                                <div id="respuesta"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asig_nrc">NRC</label>
                                <input type="text" class="form-control" name="asig_nrc" id="asig_nrc" placeholder="Ingrese el NRC">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asig_cred">Créditos</label>
                                <input type="text" class="form-control" name="asig_cred" id="asig_cred" placeholder="Ingrese el Número de Crédito">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asig_horas">Horas</label>
                                <input type="text" class="form-control" name="asig_horas" id="asig_horas" placeholder="Ingrese la cantidad de Horas">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="seme_id">Semestre</label>
                                <select class="form-control select2" style="width:100%" name="seme_id" id="seme_id" data-placeholder="Seleccione">
                                
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
