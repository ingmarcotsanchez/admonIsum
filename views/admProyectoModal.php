<div class="modal fade" id="modalcrearProyecto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="proyectos_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="pro_id" id="pro_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pro_nom">Título del Proyecto</label>
                                <input type="text" class="form-control" name="pro_nom" id="pro_nom" placeholder="Ingrese el título del proyecto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pro_anno">Año</label>
                                <input type="text" class="form-control" name="pro_anno" id="pro_anno" placeholder="Ingrese el Año de ejecución">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pro_pre">Presupuesto</label>
                                <input type="text" class="form-control" name="pro_pre" id="pro_pre" placeholder="Ingrese el valor del presupuesto">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_id">Investigador</label>
                                <select class="form-control select2" style="width:100%" name="prof_id" id="prof_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="grup_id">Grupo de Investigación</label>
                                <select class="form-control select2" style="width:100%" name="grup_id" id="grup_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="linea_id">Línea de Investigación</label>
                                <select class="form-control select2" style="width:100%" name="linea_id" id="linea_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pro_prog1">Programa # 1</label>
                                <input type="text" class="form-control" name="pro_prog1" id="pro_prog1" placeholder="Ingrese el nombre del programa Investigador">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pro_prog2">Programa # 2</label>
                                <input type="text" class="form-control" name="pro_prog2" id="pro_prog2" placeholder="Ingrese el nombre del programa Co-Investigador">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pro_prog3">Programa # 3</label>
                                <input type="text" class="form-control" name="pro_prog3" id="pro_prog3" placeholder="Ingrese el nombre del programa Co-Investigador">
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