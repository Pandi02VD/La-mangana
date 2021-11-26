let arrayURL = {
	'Inicio' : "Inicio", 
	'IniciarSesion' : "IniciarSesion", 
	'Cita' : "Cita", 
	'Agenda' : "Agenda", 
	'Usuarios' : "Clientes", 
	'Usuario' : "Clientes", 
	'Clientes' : "Clientes", 
	'Cliente' : "Clientes", 
	'MascotasCliente' : "Mascotas", 
	'Mascotas' : "Mascotas", 
	'Mascota' : "Mascotas", 
	'HistoriaClinica' : "Mascotas", 
	'Razas' : "Mascotas", 
	'Jaulas' : "Mascotas", 
	'Servicios' : "Servicios", 
	'Hospitalizacion' : "Servicios", 
	'HospitalizacionInfo' : "Servicios", 
	'Cirugia' : "Servicios", 
	'CirugiaInfo' : "Servicios", 
	'Medicina' : "Servicios", 
	'MedicinaInfo' : "Servicios", 
	'Salir' : "Salir", 
	'Error' : "Error"
};
let url = window.location.search;
let pagina;
if (url.length == 0) {
	url = window.location.pathname;
	let titulo = '/econodentalplus/';
	pagina = url.slice(titulo.length);
	pagina == null ? pagina = 'Cita' : pagina = pagina;
} else {
	pagina = new URLSearchParams(url).get('pagina');
}
let navItem = document.getElementById(arrayURL[pagina]);
navItem.classList.add('activo');