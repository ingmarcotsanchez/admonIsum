google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(inicializarBarras);

function inicializarBarras() {

    actualizarBarras();
    setInterval(actualizarBarras, 60000); 
}

function actualizarBarras() {
    var url = '/ISUM/controller/barras.php?opc=actualizarBarras';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            drawChart(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function drawChart(datos) {
    var chartData = [['Year', 'Semestre 1', 'Semestre 2']];
    var añoActual = datos[0].año;
    var semestre1 = 0;
    var semestre2 = 0;
    for (var i = 0; i < datos.length; i++) {
        if (datos[i].año == añoActual) {
            if (datos[i].semestre == '10') {
                semestre1 = datos[i].cantidad_estudiantes;
            } else if (datos[i].semestre == '60') {
                semestre2 = datos[i].cantidad_estudiantes;
            }
        } else {
            chartData.push([añoActual, semestre1, semestre2]);
            añoActual = datos[i].año;
            semestre1 = (datos[i].semestre == '10') ? datos[i].cantidad_estudiantes : 0;
            semestre2 = (datos[i].semestre == '60') ? datos[i].cantidad_estudiantes : 0;
        }
    }
    chartData.push([añoActual, semestre1, semestre2]);  // Añade los datos del último año

    var data = google.visualization.arrayToDataTable(chartData);

    var options = {
        chart: {
            title: 'Número de Estudiantes por Año',
            subtitle: 'Distribución acumulada de estudiantes por semestre desde 2017 hasta ' + new Date().getFullYear(),
        },
        vAxis: {
            viewWindow: {
                min: 0,
                max: Math.max(semestre1, semestre2) + 20  
            },
            format: '0'
        },
        hAxis: {
            title: 'Año'
        }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
}