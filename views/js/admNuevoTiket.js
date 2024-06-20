function init(){
    $("#ticket_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){

    // Summernote
    $('#tick_descrip').summernote({
        height: 150,
        lang: "es-ES",
        /* callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detect...");
            }
        }, */
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $.post("/ISUM/controller/categoria.php?opc=combo",function(data, status){
        $('#cat_id').html(data);
    });

});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    if ($('#tick_descrip').summernote('isEmpty') || $('#tick_titulo').val()=='' || $('#cat_id').val() == 0){
     //if ($('#tick_descrip').summernote('isEmpty') || $('#tick_titulo').val()==''|| $('#cats_id').val() == 0 || $('#cat_id').val() == 0 || $('#prio_id').val() == 0){
        Swal.fire({
            title: 'Advertencia!',
            text: 'Falta Descripción',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        })
    }else{
        var totalfiles = $('#fileElem').val().length;
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }
        $.ajax({
            url: "/ISUM/controller/ticket.php?opc=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            
            success: function(data){  
                console.log(data);

                $('#tick_titulo').val('');
                $('#tick_descrip').summernote('reset');
                
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Registro Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }
                /* data = JSON.parse(data);
                console.log(data[0].tick_id);

              
                $.post("../../controller/email.php?op=ticket_abierto", {tick_id : data[0].tick_id}, function (data) {

                });

               
                $.post("../../controller/whatsapp.php?op=w_ticket_abierto", {tick_id : data[0].tick_id}, function (data) {

                });

               
                $('#tick_titulo').val('');
                $('#tick_descrip').summernote('reset');
                
                swal("Correcto!", "Registrado Correctamente", "success");
            } */
        }); 
    }
}

init();