var usu_id = $('#usu_idx').val();

function init(){
    $("#evaluacion_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#evaluacion_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/evaluacion.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#evaluacion_data').DataTable().ajax.reload();
            $('#modalcrearEvaluacion').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#prof_id').select2({
        dropdownParent: $("#modalcrearEvaluacion")
    });

    select_profesor();

    $('#evaluacion_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/evaluacion.php?opc=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });

});

function nuevo(){
    $('#titulo_modal').html('Nueva Evaluación');
    $('#evaluacion_form')[0].reset();
    //select_profesor();
    $('#modalcrearEvaluacion').modal('show');
}

function editar(eva_id){
    $.post("/ISUM/controller/evaluacion.php?opc=mostrar",{eva_id:eva_id},function (data){
        data = JSON.parse(data);
        console.log(data);
        $('#eva_id').val(data.eva_id);
        $('#prof_id').val(data.prof_id).trigger('change');
        $('#eva_fecha').val(data.eva_fecha);
        $('#eva_nota').val(data.eva_nota);
        $('#eva_est').val(data.eva_est);
    });
    $('#titulo_modal').html('Editar Evaluación');
    $('#modalcrearEvaluacion').modal('show');
}

function eliminar(eva_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/evaluacion.php?opc=eliminar",{eva_id:eva_id},function (data){
                $('#evaluacion_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }); 
        }
    });

}

function select_profesor(){
    $.post("/ISUM/controller/profesor.php?opc=combo",function (data){
        $('#prof_id').html(data);
    });
}

init();