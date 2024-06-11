var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("/ISUM/controller/info.php?opc=mostrar", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#info_nombre').val(data.info_nombre);
        $('#info_snies').val(data.info_snies);
        $('#info_resolucion').val(data.info_resolucion);
        $('#info_creditos').val(data.info_creditos);
        $('#info_semestres').val(data.info_semestres);
        $('#info_metodologia').val(data.info_metodologia).trigger("change");
        $('#info_nivel').val(data.info_nivel).trigger("change");
    });
});

$(document).on("click","#btnactualizar", function(){

    $.post("/ISUM/controller/info.php?opc=update_perfil", { 
        //info_id : info_id,
        info_nombre : $('#info_nombre').val(),
        info_snies : $('#info_snies').val(),
        info_resolucion : $('#info_resolucion').val(),
        info_creditos : $('#info_creditos').val(),
        info_semestres : $('#info_semestres').val(),
        info_metodologia : $('#info_metodologia').val(),
        info_nivel : $('#info_nivel').val()
     }, function (data) {
    });
    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })


});

