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
                barColors: ["#6a329f"], 
            });
        }); 

    }else{
        $.post("/ISUM/controller/ticket.php?opc=total", function (data) {
            data = JSON.parse(data);
            $('#lbltotalTickets').html(data.TOTAL);
        }); 
    
        $.post("/ISUM/controller/ticket.php?opc=totalabierto", function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsAbiertos').html(data.TOTAL);
        });
    
        $.post("/ISUM/controller/ticket.php?opc=totalcerrado", function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsCerrados').html(data.TOTAL);
        });

        $.post("/ISUM/controller/ticket.php?opc=grafico", function (data) {
            data = JSON.parse(data);
    
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value'],
                barColors: ["#2986cc"], 
            });
        }); 

    }

 
});

init();