<div class="modal fade" id="modalcrearProfesor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="profesor_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="prof_id" id="prof_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_image">Foto</label>
                                <input type="file" class="prof_image" name="prof_image">
                                <p class="help-block">Peso máximo de la imagen 2MB y <strong>Formato PNG</strong></p>
                                <img src="views/image/profesor/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_dni">ID</label>
                                <input type="text" class="form-control" name="prof_dni" id="prof_dni" placeholder="Ingrese un ID">
                                <div id="respuesta"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_nom">Nombre</label>
                                <input type="text" class="form-control" name="prof_nom" id="prof_nom" placeholder="Ingrese un Nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_apep">Apellido Paterno</label>
                                <input type="text" class="form-control" name="prof_apep" id="prof_apep" placeholder="Ingrese Primer Apellido ">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_apem">Apellido Materno</label>
                                <input type="text" class="form-control" name="prof_apem" id="prof_apem" placeholder="Ingrese Segundo Apellido">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_correo">Correo Electrónico Administrativo</label>
                                <input type="email" class="form-control" name="prof_correo" id="prof_correo" placeholder="Ingrese un Correo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_correo2">Correo Electrónico Académico</label>
                                <input type="email" class="form-control" name="prof_correo2" id="prof_correo2" placeholder="Ingrese un Correo">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="prof_niv">Último Nivel de Estudio</label>
                                <select class="form-control select2" style="width:100%" name="prof_niv" id="prof_niv" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="P">Pregrado</option>
                                    <option value="E">Especialización</option>
                                    <option value="M">Maestria</option>
                                    <option value="D">Doctorado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="prof_sex">Sexo</label>
                                <select class="form-control select2" style="width:100%" name="prof_sex" id="prof_sex" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="prof_telf">Celular</label>
                                <input type="text" class="form-control" name="prof_telf" id="prof_telf" placeholder="Ingrese Segundo Apellido">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="rol_id">Rol</label>
                                <select class="form-control select2" style="width:100%" name="rol_id" id="rol_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="esc_id">Escalafón</label>
                                <select class="form-control select2" style="width:100%" name="esc_id" id="esc_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_fecini">Fecha de ingreso</label>
                                <input type="date" class="form-control" name="prof_fecini" id="prof_fecini" placeholder="Seleccione una fecha">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_fecfin">Fecha de retiro</label>
                                <input type="date" class="form-control" name="prof_fecfin" id="prof_fecfin" placeholder="Seleccione una fecha">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_cvlac">Link de CVLAC</label>
                                <input type="text" class="form-control" name="prof_cvlac" id="prof_cvlac" placeholder="Ingrese un link">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_orcid">Link de ORCID</label>
                                <input type="text" class="form-control" name="prof_orcid" id="prof_orcid" placeholder="Ingrese un link">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_google">Link de GOOGLE SHOLAR</label>
                                <input type="text" class="form-control" name="prof_google" id="prof_google" placeholder="Ingrese un link">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prof_est">Estado</label>
                                <select class="form-control select2" style="width:100%" name="prof_est" id="prof_est" data-placeholder="Seleccione">
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

