<div class="modal fade" id="modalcrearAutoevaluacion" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="autoevaluacion_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="aut_id" id="aut_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="fac_id">Factor</label>
                                <select class="form-control select2" style="width:100%" name="fac_id" id="fac_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="aut_ponderacion">Ponderación</label>
                                <input type="number" class="form-control" name="aut_ponderacion" id="aut_ponderacion" placeholder="Ingrese la ponderación">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="aut_califica">Calificación</label>
                                <input type="number" min="0" max="100" class="form-control" name="aut_califica" id="aut_califica" placeholder="Ingrese la calificación obtenida">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="aut_cumple">Cumplimiento</label>
                                <select class="form-control select2" style="width:100%" name="aut_cumple" id="aut_cumple" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="P">Se cumple plenamente</option>
                                    <option value="G">Se cumple en alto grado</option>
                                    <option value="A">Se cumple aceptablemente</option>
                                    <option value="I">Se cumple insatisfactoriamente</option>
                                    <option value="N">No se cumple</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="aut_anno">Año</label>
                                <input type="number" min="2017" class="form-control" name="aut_anno" id="aut_anno" placeholder="Ingrese el año">
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