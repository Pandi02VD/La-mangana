export default class Pagina {
	constructor() {
		let navItem = document.getElementById(Pagina.getPagina());
		navItem.classList.add('activo');
	}

	static getPagina() {
		let arrayURL = {
			'Inicio' : "Inicio", 
			'HistoriaMedica' : "Inicio", 
			'IniciarSesion' : "IniciarSesion", 
			'Cita' : "Cita", 
			'Agenda' : "Agenda", 
			'Pacientes' : "Pacientes", 
			'PacienteInfo' : "Pacientes", 
			'Usuarios' : "Usuarios", 
			'MisDatos' : "Configuracion", 
			'Configuracion' : "Configuracion", 
			'Salir' : "Salir", 
			'Error' : "Error"
		};
		let url = window.location.search;
		let pagina;
		if (url.length == 0) {
			url = window.location.pathname;
			let titulo = '/econodentalplus/';
			pagina = url.slice(titulo.length);
			pagina.length == 0 ? pagina = 'Cita' : pagina = pagina;
		} else {
			pagina = new URLSearchParams(url).get('pagina');
		}
		return arrayURL[pagina];
	}
}