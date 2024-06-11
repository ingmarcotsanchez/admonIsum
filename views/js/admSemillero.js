var usu_id = $('#usu_idx').val();

function init(){
    $("#semillero_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#semillero_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/semillero.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#semillero_data').DataTable().ajax.reload();
            $('#modalcrearSemillero').modal('hide');

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
        dropdownParent: $("#modalcrearSemillero")
    });

    select_profesor();

    $('#semillero_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/semillero.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Semillero');
    $('#semillero_form')[0].reset();
    //select_profesor();
    $('#modalcrearSemillero').modal('show');
}

function editar(sem_id){
    $.post("/ISUM/controller/semillero.php?opc=mostrar",{sem_id:sem_id},function (data){
        data = JSON.parse(data);
        console.log(data);
        $('#sem_id').val(data.sem_id);
        $('#sem_nom').val(data.sem_nom);
        $('#sem_anno').val(data.sem_anno);
        $('#prof_id').val(data.prof_id).trigger('change');
        $('#sem_linea').val(data.sem_linea);
    });
    $('#titulo_modal').html('Editar Semillero');
    $('#modalcrearSemillero').modal('show');
}

function eliminar(sem_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/semillero.php?opc=eliminar",{sem_id:sem_id},function (data){
                $('#semillero_data').DataTable().ajax.reload();
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