<style>
    .hidden {display: none;}
</style>
<div class="modal fade" id="modalcrearEstudiante" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="estudiante_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="est_id" id="est_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_dni">ID</label>
                                <input type="text" class="form-control" name="est_dni" id="est_dni" placeholder="Ingrese su ID">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_fecnac">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="est_fecnac" id="est_fecnac" placeholder="Ingrese su ID">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_tipo">Tipo Identificación</label>
                                <select class="form-control select2" name="est_tipo" id="est_tipo" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option value="CC">Cédula de Ciudadania</option>
                                    <option value="CE">Cédula de Extranjeria</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_cedula">Número Identificación</label>
                                <input type="text" class="form-control" name="est_cedula" id="est_cedula" placeholder="Ingrese su Número de identificación">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="est_nom">Nombre</label>
                                <input type="text" class="form-control" name="est_nom" id="est_nom" placeholder="Ingrese sus Nombres">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_apep">Apellido Paterno</label>
                                <input type="text" class="form-control" name="est_apep" id="est_apep" placeholder="Ingrese su Primer apellido">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_apem">Apellido Materno</label>
                                <input type="text" class="form-control" name="est_apem" id="est_apem" placeholder="Ingrese su Segundo apellido">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_correo">Correo Electrónico</label>
                                <input type="email" class="form-control" name="est_correo" id="est_correo" placeholder="Ingrese su Correo Instituciónal">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_sex">Sexo</label>
                                <select class="form-control select2" name="est_sex" id="est_sex" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_telf">Teléfono</label>
                                <input type="text" class="form-control" name="est_telf" id="est_telf" placeholder="Ingrese su Teléfono">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_seme">Semestre de Ingreso</label>
                                <input type="text" class="form-control" name="est_seme" id="est_seme" placeholder="Ingrese su Semestre de ingreso">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_egre">Estado</label>
                                <select class="form-control select2" name="est_egre" id="est_egre" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value=1>Activo</option>
                                    <option value=2>Ausente</option>
                                    <option value=3>Egresado</option>
                                    <option value=4>Egresado No Graduado</option>
                                    <option value=5>Desertor</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-6 hidden" id="campoOculto">
                            <div class="form-group">
                                <label for="est_grado">Semestre de Graduación</label>
                                <input type="text" class="form-control" name="est_grado" id="est_grado" placeholder="Si no ha terminado los estudios escribir pendiente">
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

<script>
    document.getElementById('estudiante_form').addEventListener('change', function(event) {
            var opcionesValue = document.getElementById('est_egre').value.trim();
            if (opcionesValue == 3) {
                document.getElementById('campoOculto').classList.remove('hidden');
            }
        });
</script>
