var usu_id = $('#usu_idx').val();

function init(){
    $("#autoevaluacion_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#autoevaluacion_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/autoevaluacion.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#autoevaluacion_data').DataTable().ajax.reload();
            $('#modalcrearAutoevaluacion').modal('hide');

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

    $('#fac_id').select2({
        dropdownParent: $('#modalcrearAutoevaluacion')
    });

    combo_factor();

    $('#autoevaluacion_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/autoevaluacion.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Autoevaluación');
    $('#autoevaluacion_form')[0].reset();
    $('#modalcrearAutoevaluacion').modal('show');
}

function editar(aut_id){
    $.post("/ISUM/controller/autoevaluacion.php?opc=mostrar",{aut_id:aut_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#aut_id').val(data.aut_id);
        $('#aut_factor').val(data.aut_factor);
        $('#aut_ponderacion').val(data.aut_ponderacion);
        $('#aut_califica').val(data.aut_califica);
        $('#aut_cumple').val(data.aut_cumple);
        $('#aut_anno').val(data.aut_anno);
    });
    $('#titulo_modal').html('Editar Autoevaluación');
    $('#modalcrearAutoevaluación').modal('show');
}

function eliminar(aut_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/autoevaluacion.php?opc=eliminar",{aut_id:aut_id},function (data){
                $('#autoevaluacion_data').DataTable().ajax.reload();
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

function combo_factor(){
    $.post("/ISUM/controller/factor.php?opc=combo", function (data) {
        $('#fac_id').html(data);
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalAutoevaluacion').modal('show');
});

var ExcelToJSON = function() {
    this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            //TODO: Recorrido a todas las pestañas
            workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                AutoevaluacionList = JSON.parse(json_object);

                console.log(AutoevaluacionList)
                for (i = 0; i < AutoevaluacionList.length; i++) {

                    var columns = Object.values(AutoevaluacionList[i])

                    $.post("/ISUM/controller/autoevaluacion.php?opc=guardar_desde_excel",{
                        aut_factor : columns[0],
                        prof_ponderacion : columns[1],
                        prof_califica : columns[2],
                        prof_cumple : columns[3],
                        prof_anno : columns[4]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#autoevaluacion_data').DataTable().ajax.reload();
                $('#modalAutoevaluacion').modal('hide');
            })
        };
        reader.onerror = function(ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);

init();