var usu_id = $('#usu_idx').val();

function init(){
    $("#calificaciones_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#calificaciones_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/calificaciones.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);//#asignatura_data
            $('#detalle_data').DataTable().ajax.reload();
            $('#modalagregarCalificacion').modal('hide');

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
    $('#est_id').select2();
    
    combo_estudiante();

    $('#asig_id').select2({
        dropdownParent: $("#modalagregarCalificacion")
    });
    select_asignatura();

    /* Obtener Id de combo estudiante */
    $('#est_id').change(function(){
        $("#est_id option:selected").each(function (){
            est_id = $(this).val();
            //console.log(est_id);

            $('#detalle_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax":{
                    url:"/ISUM/controller/calificaciones.php?opc=listar",
                    type:"post",
                    data:{est_id:est_id},
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
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
    });

});

function agregar(){
    if ($('#est_id').val()==''){
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar Estudiante',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    }else{
        var est_id = $('#est_id').val();
        listar_asignaturas(est_id);
        $('#modalmantenimiento').modal('show');
    }
}

function listar_asignaturas(est_id){
    $('#asignatura_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/asignatura.php?opc=listar_asignaturas",
            type:"post",
            data:{est_id:est_id}
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
}

function eliminar(asigxest_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar la calificación?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("/ISUM/controller/calificaciones.php?opc=eliminar_estudiante_asignatura",{asigxest_id : asigxest_id}, function (data) {
                $('#detalle_data').DataTable().ajax.reload();

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

$('#est_id').change(function () {
    var est_id = $(this).val();

    if (est_id) {
        $.ajax({
            url: "/ISUM/controller/calificaciones.php?opc=obtener_creditos_aprobados",
            type: "POST",
            data: { est_id: est_id },
            dataType: "json",
            success: function (data) {
                if (data.error) {
                    console.error("Error al obtener créditos: " + data.error);
                } else {
                    // Procesar la respuesta JSON normalmente
                    var totalCreditos = 159; // Puedes ajustar esto según tus necesidades
                    var creditosAprobados = data.total_creditos || 0;
                    var porcentaje = (creditosAprobados / totalCreditos) * 100;

                    // Actualizar la barra de progreso y el número de créditos aprobados
                    $("#barraProgreso").css("width", porcentaje + "%");
                    $("#creditosAprobados").text(creditosAprobados);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("Error al obtener créditos: " + errorThrown);
            }
        });
    }
});



function registrarasignatura(){
    table = $('#asignatura_data').DataTable();
    var asig_id =[];

    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
        cell1 = table.cell({ row: rowIdx, column: 0 }).node();
        if ($('input', cell1).prop("checked") == true) {
            id = $('input', cell1).val();
            asig_id.push([id]);
        }
    });

    if (asig_id == 0){
        Swal.fire({
            title: 'Error!',
            text: 'Debe Seleccionar por lo menos una Asignatura',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    }else{
        /* Creando formulario */
        const formData = new FormData($("#form_detalle")[0]);
        formData.append('est_id',est_id);
        formData.append('asig_id',asig_id);

        $.ajax({
            url: "/ISUM/controller/estudiante.php?opc=insert_estudiante_asignatura",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            
        });

        $('#detalle_data').DataTable().ajax.reload();

        $('#asignatura_data').DataTable().ajax.reload();
       
        $('#modalmantenimiento').modal('hide');

    }
}

function editar(asigxest_id){
    $.post("/ISUM/controller/calificaciones.php?opc=mostrar",{asigxest_id:asigxest_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#asigxest_id').val(data.asigxest_id);
        $('#asig_id').val(data.asig_id).trigger('change');
        $('#est_id').val(data.est_id);
        $('#asigxest_nota').val(data.asigxest_nota);
        $('#asigxest_est').val(data.asigxest_est);
    });
    $('#titulo_modal').html('Editar Calificación');
    $('#modalagregarCalificacion').modal('show');
}

function combo_estudiante(){
    $.post("/ISUM/controller/estudiante.php?opc=combo", function (data) {
        $('#est_id').html(data);
    });
}

function select_asignatura(){
    $.post("/ISUM/controller/asignatura.php?opc=combo",function (data){
        $('#asig_id').html(data);
    });
}

init();