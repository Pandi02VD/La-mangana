export default class CronoAcciones {
	// static reloj(){
	// 	if (horaActual < 12 && document.getElementById("saludo")) {
	// 		saludo.innerText = '¡Buenos días ';
	// 	}else if(horaActual > 12 && horaActual < 18 && document.getElementById("saludo")){
	// 		saludo.innerText = '¡Buenas tardes ';
	// 	}else if(horaActual > 18 && document.getElementById("saludo")){
	// 		saludo.innerText = '¡Buenas noches ';
	// 	}
	// }
	
	static getConfig(callback){
		let value = 1;
		let name = 'config';
		let formData = new FormData();
		formData.append(name, value);
		
		$.ajax({
			url: "controlador/Ajax.php", 
			method: "post", 
			data: formData, 
			cache: false, 
			contentType: false, 
			processData: false, 
			dataType: "json", 
			success: function(respuesta){
				if (respuesta) {
					let r = JSON.parse(respuesta["configJSON"]);
					callback(r);
				}else{
					console.log('Sin respuesta');
				}
			}
		});
	}
	
	// setInterval('reloj()', 5000); //--------------------- ****************** -> =>  
	// setInterval('usuarioEstado()', 1000);
}