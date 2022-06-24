if (document.getElementById('graficaPeso')) {
	let datosPeso = new Array();
	let datosCuerpo = new Array();
	let data = document.getElementById('mascotaId').value;
	let formData = new FormData();
	formData.append('graficaMascota', data);

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
				for (let i = 0; i < response.length; i++) {
					datosPeso.push({
						'Fecha' : response[i]["fecha"], 
						'Peso' : response[i]["peso"]
					});
					
					datosCuerpo.push({
						'Fecha' : response[i]["fecha"], 
						'Tamaño' : response[i]["tamano"], 
						'Cuerpo' : response[i]["condicion_corporal"]
					});
				}

				new Morris.Line({
					element: 'graficaPeso', 
					data: datosPeso, 
					xkey: 'Fecha', 
					ykeys: ['Peso'], 
					labels: ['Peso'], 
					resize: true, 
					lineColors: ['#28bb96'], 
					lineWidth: 2
				});
				
				new Morris.Bar({
					element: 'graficaCuerpo', 
					data: datosCuerpo, 
					xkey: 'Fecha', 
					ykeys: ['Tamaño', 'Cuerpo'], 
					labels: ['Tamaño', 'Cuerpo'], 
					resize: true, 
					barColors: ['#757574', '#0a23ff'], 
					barWidth: 1
				});
			} else {
				console.log('error');
			}
		}
	});
}

if (document.getElementById('graficaMes')) {
	let datosGrafica = new Array();
	let data = 'resumen';
	let formData = new FormData();
	formData.append('graficaResumen', data);
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
				console.table(response);
				console.log(response.length);
				for (let i = 0; i < response.length; i++) {
					datosGrafica.push({
						'Fecha' : response[i]["fecha"], 
						'Atendidos' : response[i]["atendidos"]
					});
				}

				new Morris.Bar({
					element: 'graficaMes', 
					data: datosGrafica,
					xkey: 'Fecha', 
					ykeys: ['Atendidos'], 
					labels: ['Pacientes Atendidos'], 
					resize: true, 
					barColors: ['#19ad88'], 
					gridTextSize: 18
				});
			} else {
				console.log('error');
			}
		}
	});
}

// const ctx = document.getElementById('myChart').getContext('2d');
// const myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: [
// 			'01/03/2022', '02/03/2022', '03/03/2022', '04/03/2022'
// 		],
//         datasets: [{
//             label: 'Pacientes Atendidos',
//             data: [7, 5, 9, 10],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });