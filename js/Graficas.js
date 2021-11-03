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
					lineWidth: 2
				});
			} else {
				console.log('error');
			}
		}
	});
}