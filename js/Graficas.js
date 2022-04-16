if (document.getElementById('graficaPeso')) {
	let datosGrafica = new Array();
	let data = document.getElementById('mascotaId').value;
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

if (document.getElementById('graficaMes')) {
	let datosGrafica = new Array();
	// let data = document.getElementById('mascotaId').value;
	// let formData = new FormData();
	// formData.append('graficaMascota', data);
	// console.log(data);

	// $.ajax({
	// 	url: 'controlador/Ajax.php', 
	// 	method: 'post', 
	// 	data: formData, 
	// 	cache: false, 
	// 	contentType: false, 
	// 	processData: false, 
	// 	dataType: 'json', 
	// 	success: function (response) {
	// 		if (response) {
	// 			for (let i = 0; i < response.length; i++) {
	// 			console.log(response);
					// datosGrafica.push({
					// 	'Fecha' : response[i]["fecha"], 
					// 	'Peso' : response[i]["peso"], 
					// 	'Tamaño' : response[i]["tamano"], 
					// 	'Cuerpo' : response[i]["condicion_corporal"]
					// });
				// }

				new Morris.Bar({
					element: 'graficaMes', 
					data: [
						{Fecha : '2022-03-01', Atendidos : '7'}, 
						{Fecha : '2022-03-02', Atendidos : '5'}, 
						{Fecha : '2022-03-03', Atendidos : '9'}, 
						{Fecha : '2022-03-04', Atendidos : '10'}
					], 
					xkey: 'Fecha', 
					ykeys: ['Atendidos'], 
					labels: ['Pacientes Atendidos'], 
					resize: true, 
					barColors: ['#19ad88'], 
					gridTextSize: 20
				});
	// 		} else {
	// 			console.log('error');
	// 		}
	// 	}
	// });
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