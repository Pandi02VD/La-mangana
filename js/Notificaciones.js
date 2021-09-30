function toast(mensaje) {
	let urlReload = window.location.href;
	alert(mensaje);
	window.location = urlReload;
}
// function createToast(mensaje){
//     var toastSuccess = document.createElement('div');
//     toastSuccess.setAttribute('class', 'C__F');
//     let divToast = document.createElement('div');
//     divToast.setAttribute('class', 'f');
//     let spanToast = document.createElement('span');
//     spanToast.innerText = mensaje;
//     divToast.appendChild(spanToast);
//     toastSuccess.appendChild(divToast);
//     document.getElementById('getToast').appendChild(toastSuccess);
// }

// function toast(mensaje) {
//     // let urlReload = window.location.href;
//     createToast(mensaje);
//     // window.location = urlReload;
// }

// () => ('DOMContentLoaded', toast("hola"));