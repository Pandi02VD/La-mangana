let arrayURL = {
	'Inicio' : "Inicio", 
	'IniciarSesion' : "IniciarSesion", 
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
let pagina = new URLSearchParams(url).get('pagina');
let navItem = document.getElementById(arrayURL[pagina]);
navItem.classList.add('activo');