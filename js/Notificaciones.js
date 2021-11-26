function toast(mensaje) {
	let urlReload = window.location.href;
	alert(mensaje);
	window.location = urlReload;
}