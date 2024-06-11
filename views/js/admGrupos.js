var usu_id = $('#usu_idx').val();

function init(){
    $("#grupo_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#grupo_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/grupo.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#grupo_data').DataTable().ajax.reload();
            $('#modalcrearGrupo').modal('hide');

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
    
    $('#grupo_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/grupo.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Grupo de Investigación');
    $('#grupo_form')[0].reset();
    $('#modalcrearGrupo').modal('show');
}

function editar(grup_id){
    $.post("/ISUM/controller/grupo.php?opc=mostrar",{grup_id:grup_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#grup_id').val(data.grup_id);
        $('#grup_nom').val(data.grup_nom);
        $('#grup_est').val(data.grup_est);
    });
    $('#titulo_modal').html('Editar Grupo de Investigación');
    $('#modalcrearGrupo').modal('show');
}

function grupo_act(grup_id){
    $.post("/ISUM/controller/grupo.php?opc=activo",{grup_id:grup_id},function (data){
        $('#grupo_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function grupo_ina(grup_id){
    $.post("/ISUM/controller/grupo.php?opc=inactivo",{grup_id:grup_id},function (data){
        $('#grupo_data').DataTable().ajax.reload();
    });
}


function eliminar(grup_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/grupo.php?opc=eliminar",{grup_id:grup_id},function (data){
                $('#grupo_data').DataTable().ajax.reload();
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

init();