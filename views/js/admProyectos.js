var usu_id = $('#usu_idx').val();

function init(){
    $("#proyectos_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#proyectos_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/proyecto.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#proyectos_data').DataTable().ajax.reload();
            $('#modalcrearProyecto').modal('hide');

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
        dropdownParent: $("#modalcrearProyecto")
    });

    $('#grup_id').select2({
        dropdownParent: $("#modalcrearProyecto")
    });

    $('#linea_id').select2({
        dropdownParent: $("#modalcrearProyecto")
    });

    select_profesor();
    select_grupo();
    select_linea();

    $('#proyectos_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/proyecto.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Proyecto');
    $('#proyectos_form')[0].reset();
    $('#modalcrearProyecto').modal('show');
}

function editar(pro_id){
    $.post("/ISUM/controller/proyecto.php?opc=mostrar",{pro_id:pro_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#pro_id').val(data.pro_id);
        $('#pro_nom').val(data.pro_nom);
        $('#grup_id').val(data.grup_id).trigger('change');
        $('#linea_id').val(data.linea_id).trigger('change');
        $('#pro_anno').val(data.pro_anno);
        $('#prof_id').val(data.prof_id).trigger('change');
        $('#pro_pre').val(data.pro_pre);
        $('#pro_prog1').val(data.pro_prog1);
        $('#pro_prog2').val(data.pro_prog2);
        $('#pro_prog3').val(data.pro_prog3);
    });
    $('#titulo_modal').html('Editar Proyecto');
    $('#modalcrearProyecto').modal('show');
}

function eliminar(pro_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/proyecto.php?opc=eliminar",{pro_id:pro_id},function (data){
                $('#proyectos_data').DataTable().ajax.reload();
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

function select_grupo(){
    $.post("/ISUM/controller/grupo.php?opc=combo",function (data){
        $('#grup_id').html(data);
    });
}

function select_linea(){
    $.post("/ISUM/controller/linea.php?opc=combo",function (data){
        $('#linea_id').html(data);
    });
}
init();