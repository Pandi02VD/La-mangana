if (document.getElementById('graficaPeso')) {
    let datosGrafica = new Array();
    let data = document.getElementById('mascotaid').value;
    let formData = new FormData();
    formData.append('graficaMascota', data);
    console.log(data);

    $.ajax({
        url: 'controlador/Ajax.php', 
        method: 'post', 
        data: formData, 
        cache: false, 
        contentType: false, 
        processData: false, 
        dataType: 'json', 
        success: function (response) {
            if (response) {
                console.log(response);
                for (let i = 0; i < response.length; i++) {
                    let tamano;
                    let cuerpo;
                    switch (response[i]["tamano"]) {
                        case "1": tamano = "Chico"; break;
                        case "2": tamano = "Mediano"; break;
                        case "3": tamano = "Grande"; break;
                        default: tamano = 'Sin datos'; break;
                    }
                    switch (response[i]["condicion_corporal"]) {
                        case "1": cuerpo = "Delgado"; break;
                        case "2": cuerpo = "Normal"; break;
                        case "3": cuerpo = "Robusto"; break;
                        default: cuerpo = 'Sin datos'; break;
                    }
                    datosGrafica.push({
                        'Fecha' : response[i]["fecha"], 
                        'Peso' : response[i]["peso"], 
                        'Tamaño' : response[i]["tamano"], 
                        'Cuerpo' : response[i]["condicion_corporal"]
                    });
                }

                new Morris.Line({
                    element: 'graficaPeso', 
                    data: datosGrafica, 
                    xkey: 'Fecha', 
                    ykeys: ['Peso', 'Tamaño', 'Cuerpo'], 
                    labels: ['Peso', 'Tamaño', 'Cuerpo'], 
                    resize: true, 
                    lineColors: ['#28bb96', '#757574', '#0a23ff'], 
                    lineWidth: 3
                });
            } else {
                console.log('error');
            }
        }
    });
}