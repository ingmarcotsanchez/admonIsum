var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("/ISUM/controller/usuario.php?opc=mostrar", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_rol').val(data.usu_rol);
        //$('#info_metodologia').val(data.info_metodologia).trigger("change");
        //$('#info_nivel').val(data.info_nivel).trigger("change");
    });
});

$(document).on("click","#btnactualizar", function(){

    $.post("/ISUM/controller/usuario.php?opc=editPerfil", { 
        //info_id : info_id,
        usu_nom : $('#usu_nom').val(),
        usu_apep : $('#usu_apep').val(),
        usu_apem : $('#usu_apem').val(),
        usu_correo : $('#usu_correo').val(),
        usu_pass : $('#usu_pass').val(),
        usu_rol : $('#usu_rol').val()
     }, function (data) {
    });
    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })


});