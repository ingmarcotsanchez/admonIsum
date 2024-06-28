var usu_id = $('#usu_idx').val();

function init(){
    $("#subcategoria_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#subcategoria_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/subcategoria.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#subcategoria_data').DataTable().ajax.reload();
            $('#modalcrearSubcategoria').modal('hide');

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
    $('#cat_id').select2({
        dropdownParent: $('#modalcrearSubcategoria')
    });

    combo_categorias();

    $('#subcategoria_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/subcategoria.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Sub Categoria');
    $('#subcategoria_form')[0].reset();
    $('#modalcrearSubcategoria').modal('show');
}

function editar(cats_id){
    $.post("/ISUM/controller/subcategoria.php?opc=mostrar",{cats_id:cats_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#cat_id').val(data.cat_id).trigger('change');
        $('#cats_id').val(data.cats_id);
        $('#cats_nom').val(data.cats_nom);
        
    });
    $('#titulo_modal').html('Editar Sub Categoria');
    $('#modalcrearSubcategoria').modal('show');
}

function eliminar(cats_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/subcategoria.php?opc=eliminar",{cats_id:cats_id},function (data){
                $('#subcategoria_data').DataTable().ajax.reload();
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

function combo_categorias(){
    $.post("/ISUM/controller/categoria.php?opc=combo", function (data) {
        $('#cat_id').html(data);
    });
}


init();