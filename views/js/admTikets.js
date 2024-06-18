function init(){
   
}
var usu_id = $('#usu_idx').val();
$(document).ready(function(){
    var usu_id = $('#usu_idx').val();

    if ( $('#rol_idx').val() == "E"){
        $.post("/ISUM/controller/usuario.php?opc=total", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTickets').html(data.TOTAL);
        }); 
    
        $.post("/ISUM/controller/usuario.php?opc=totalabierto", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsAbiertos').html(data.TOTAL);
        });
    
        $.post("/ISUM/controller/usuario.php?opc=totalcerrado", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsCerrados').html(data.TOTAL);
        });

        $.post("/ISUM/controller/usuario.php?opc=grafico", {usu_id:usu_id},function (data) {
            data = JSON.parse(data);
    
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value'],
                barColors: ["#1AB244"], 
            });
        }); 

    }else{
        $.post("/ISUM/controller/usuario.php?op=total", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTickets').html(data.TOTAL);
        }); 
    
        $.post("/ISUM/controller/usuario.php?op=totalabierto", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsAbiertos').html(data.TOTAL);
        });
    
        $.post("/ISUM/controller/usuario.php?op=totalcerrado", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsCerrados').html(data.TOTAL);
        });

        $.post("/ISUM/controller/usuario.php?op=grafico", {usu_id:usu_id},function (data) {
            data = JSON.parse(data);
    
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value'],
                barColors: ["#1AB244"], 
            });
        }); 

    }

 
});

init();