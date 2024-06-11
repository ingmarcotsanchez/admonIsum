<div class="modal fade" id="modalcrearSemillero" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="semillero_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="sem_id" id="sem_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sem_nom">Semillero</label>
                                <input type="text" class="form-control" name="sem_nom" id="sem_nom" placeholder="Ingrese el nombre del Semillero">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sem_anno">Año</label>
                                <input type="text" class="form-control" name="sem_anno" id="sem_anno" placeholder="Ingrese el Año de creación">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sem_linea">Línea</label>
                                <select class="form-control select2" name="sem_linea" id="sem_linea" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="A">Arquitectura de Datos</option>
                                    <option value="I">Ingeniería de Software</option>
                                    <option value="O">Organizaciones y Tics</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sem_prof">Líder</label>
                                <select class="form-control select2" style="width:100%" name="prof_id" id="prof_id" data-placeholder="Seleccione">
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