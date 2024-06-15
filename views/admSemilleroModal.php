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
                                <label for="sem_nom">Nombre del Semillero</label>
                                <input type="text" class="form-control" name="sem_nom" id="sem_nom" placeholder="Ingrese el nombre del Semillero">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="sem_anno">Año de creación</label>
                                <input type="text" class="form-control" name="sem_anno" id="sem_anno" placeholder="Ingrese el Año de creación">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="prof_id">Líder</label>
                                <select class="form-control select2" style="width:100%" name="prof_id" id="prof_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="grup_id">Grupo de Investigación</label>
                                <select class="form-control select2" style="width:100%" name="grup_id" id="grup_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="linea_id">Línea de Investigación</label>
                                <select class="form-control select2" style="width:100%" name="linea_id" id="linea_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sublinea_id">Línea de Investigación</label>
                                <select class="form-control select2" style="width:100%" name="sublinea_id" id="sublinea_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sem_mision">Misión</label>
                                <input type="text" class="form-control" name="sem_mision" id="sem_mision" placeholder="Ingrese la misión del semillero">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sem_vision">Visión</label>
                                <input type="text" class="form-control" name="sem_vision" id="sem_vision" placeholder="Ingrese la visión del semillero">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sem_objetivo">Objetivo General</label>
                                <input type="text" class="form-control" name="sem_objetivo" id="sem_objetivo" placeholder="Ingrese el Objetivo General del semillero">
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