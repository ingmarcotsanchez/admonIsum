var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    mostrar_notificacion();
});
function mostrar_notificacion(){
    var formData = new FormData();
    formData.append('usu_id',$('#usu_idx').val());
    
    $.ajax({
        url: "/ISUM/controller/notificacion.php?opc=mostrar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){  
            //console.log(data);
            if(data == ''){

            }else{
                data = JSON.parse(data);
                $.notify({
                    icon:'glyphicon glyphicon-star',
                    message: data.not_mensaje,
                    url:"http://localhost/ISUM/views/detalle_tiket.php?ID="+data.tick_id   
                });

                $.post("/ISUM/controller/notificacion.php?opc=actualizar",{not_id : data.not_id}, function (data){

                });
            }
            
        }
    });
    
    
}
setInterval(function(){
    //mostrar_notificacion();
},5000);