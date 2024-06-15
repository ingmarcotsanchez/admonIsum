var usu_id = $('#usu_idx').val();

function init(){
    $("#sublinea_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#sublinea_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/sublinea.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#sublinea_data').DataTable().ajax.reload();
            $('#modalcrearSubLinea').modal('hide');

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
    
    $('#sublinea_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/sublinea.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Sub Línea de Investigación');
    $('#sublinea_form')[0].reset();
    $('#modalcrearSubLinea').modal('show');
}

function editar(sublinea_id){
    $.post("/ISUM/controller/sublinea.php?opc=mostrar",{sublinea_id:sublinea_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#sublinea_id').val(data.sublinea_id);
        $('#sublinea_nom').val(data.sublinea_nom);
        $('#sublinea_est').val(data.sublinea_est);
    });
    $('#titulo_modal').html('Editar Sub Línea de Investigación');
    $('#modalcrearSubLinea').modal('show');
}

function sublinea_act(sublinea_id){
    $.post("/ISUM/controller/sublinea.php?opc=activo",{sublinea_id:sublinea_id},function (data){
        $('#sublinea_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function sublinea_ina(sublinea_id){
    $.post("/ISUM/controller/sublinea.php?opc=inactivo",{sublinea_id:sublinea_id},function (data){
        $('#sublinea_data').DataTable().ajax.reload();
    });
}


function eliminar(sublinea_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/sublinea.php?opc=eliminar",{sublinea_id:sublinea_id},function (data){
                $('#sublinea_data').DataTable().ajax.reload();
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