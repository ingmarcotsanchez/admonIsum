var usu_id = $('#usu_idx').val();

function init(){
    $("#estudiante_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#estudiante_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/estudiante.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#estudiante_data').DataTable().ajax.reload();
            $('#modalcrearEstudiante').modal('hide');

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

    $('input#est_dni').keypress(function (event) {
        if (event.which < 48 || event.which > 57 || this.value.length === 10) {
          return false;
        }
    });

    $("#est_dni").on("keyup", function() {
        var est_dni = $("#est_dni").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
        var longitudCedula = $("#est_dni").val().length; //CUENTO LONGITUD
      
      //Valido la longitud 
        if(longitudCedula >= 8){
            var dataString = 'est_dni=' + est_dni;
      
            $.ajax({
                url: '/ISUM/views/js/verificarEstudiante.php',
                type: "GET",
                data: dataString,
                dataType: "JSON",
      
                success: function(datos){
      
                    if( datos.success == 1){
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',true);
                        $("select").attr('disabled',true);
                        $("input#est_dni").attr('disabled',false);
                        $("button").attr('disabled',true);
      
                    }else{
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',false);
                        $("select").attr('disabled',false);
                        $("button").attr('disabled',false);
      
                    }
                }
            });
        }
    });


    $('#estudiante_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/estudiante.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Estudiante');
    $('#estudiante_form')[0].reset();
    $('#modalcrearEstudiante').modal('show');
}

function editar(est_id){
    $.post("/ISUM/controller/estudiante.php?opc=mostrar",{est_id:est_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#est_id').val(data.est_id);
        $('#est_dni').val(data.est_dni);
        $('#est_tipo').val(data.est_tipo);
        $('#est_cedula').val(data.est_cedula);
        $('#est_nom').val(data.est_nom);
        $('#est_apep').val(data.est_apep);
        $('#est_apem').val(data.est_apem);
        $('#est_fecnac').val(data.est_fecnac);
        $('#est_correo').val(data.est_correo);
        $('#est_sex').val(data.est_sex);
        $('#est_telf').val(data.est_telf);
        $('#est_seme').val(data.est_seme);
        $('#est_egre').val(data.est_egre);
        $('#est_grado').val(data.est_grado);
    });
    $('#titulo_modal').html('Editar Estudiante');
    $('#modalcrearEstudiante').modal('show');
}

function eliminar(est_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/estudiante.php?opc=eliminar",{est_id:est_id},function (data){
                $('#estudiante_data').DataTable().ajax.reload();
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

$(document).on("click", "#btnplantilla", function () {
    $('#modalEstudiante').modal('show');
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
                EstudianteList = JSON.parse(json_object);

                console.log(EstudianteList)
                for (i = 0; i < EstudianteList.length; i++) {

                    var columns = Object.values(EstudianteList[i])

                    $.post("/ISUM/controller/estudiante.php?opc=guardar_desde_excel",{
                        est_dni : columns[0],
                        est_tipo : columns[1],
                        est_cedula : columns[2],
                        est_nom : columns[3],
                        est_apep : columns[4],
                        est_apem : columns[5],
                        est_fecnac : columns[6],
                        est_correo : columns[7],
                        est_sex : columns[8],
                        est_telf :columns[9],
                        est_seme : columns[10],
                        est_egre : columns[11],
                        est_grado : columns[12]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#estudiante_data').DataTable().ajax.reload();
                $('#modalEstudiante').modal('hide');
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