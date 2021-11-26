/** Validación de campos de texto para Nombres propios s/n. */
function nombresPropios(input, min, max) {
	if (input) {
		let regExp = new RegExp("^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{" + min + "," + max + "}$");
		let text = "Solo letras y espacios.";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de texto para Nombres propios numerados. */
function nombresPropiosNumerados(input, min, max) {
	if (input) {
		let regExp = new RegExp("^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{" + min + "," + max + "}$");
		let text = "Letras, numéros y espacios.";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de texto para descripciones y referencias. */
function descripciones(input, min, max) {
	if (input) {
		let regExp = new RegExp("^[0-9a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,-_/&# ]{" + min + "," + max + "}$");
		let text = "Letras, números, espacios y estos caracteres(. , - _ / & #)";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de texto para nombres de usuario. */
function nombresUsuarios(input, min, max) {
	if (input) {
		let regExp = new RegExp("^[0-9a-zA-Z ]{" + min + "," + max + "}$");
		let text = "Solo letras (sin acentos ni eñes), números y espacios.";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de texto para contraseñas. */
function contrasenas(input, max) {
	if (input) {
		let regExp = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{4,}$");
		let text = "Debe tener por lo menos 1 mayúscula, 1 minúscula, 1 número y 1 caracter especial";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de texto para correos electrónicos. */
function correosElectronicos(input, max) {
	if (input) {
		let regExp = new RegExp("^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$");
		let text = "Debe conincidir con el formato: nombre@ejemplo.com";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de numéricos para enteros con longitud variable. */
function enterosEnIntervalo(input, min, max) {
	if (input) {
		let regExp = new RegExp("^[0-9]{" + min + "," + max + "}$");
		let text = "Digite de " + min + " a " + max + " números enteros";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de numéricos para enteros con longitud constante. */
function enterosSinIntervalo(input, max) {
	if (input) {
		let regExp = new RegExp("^[0-9]{" + max + "}$");
		let text = "Digite " + max + " números enteros";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos de numéricos para decimales con 3 cifras después del punto. */
function decimales(input, max) {
	if (input) {
		let regExp = new RegExp("^[0-9]+([.][0-9]+)?$");
		let text = "Digite números enteros o decimales";
		validarCampo(input, regExp, max, text);
	}
}

/** Validación de campos basados en el proceso de expresiones regulares. */
function validarCampo(input, regExp, max, text) {
	let counter = document.createElement('div');
	let message = document.createElement('div');
	counter.setAttribute('class', 'counter');
	message.setAttribute('class', 'message');
	message.innerText = text;

	input.addEventListener('keyup', () => {
		input.classList.remove('yeah');
		input.classList.remove('noug');
		counter.innerText = input.value.length + '/' + max;
		if(input.value.length <= max && regExp.test(input.value)) {
			input.classList.add('yeah');
			counter.setAttribute('data-content', '✔');
			counter.style.color = 'currentColor';
		} else {
			counter.setAttribute('data-content', '✖');
			counter.style.color = 'red';
			input.classList.add('noug');
			input.value = input.value.substring(0, max);
		}
	});

	input.addEventListener('focusin', () => {
		input.parentElement.appendChild(message);
		input.parentElement.appendChild(counter);
	});
	
	input.addEventListener('blur', () => {
		counter.remove();
		message.remove();
	});
}

nombresPropios(document.getElementById('citaNombre-n'), 2, 30);
nombresPropios(document.getElementById('citaApellidos-n'), 2, 50);
enterosSinIntervalo(document.getElementById('citaTelefono-n'), 10);

// correosElectronicos(document.getElementById('correo-new'), 30);
// correosElectronicos(document.getElementById('correo-edit'), 30);

// enterosSinIntervalo(document.getElementById('telefono-edit'), 10);

// nombresPropiosNumerados(document.getElementById('domicilio-estado-new'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-municipio-new'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-colonia-new'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-calle-new'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-calle1-new'), 0, 25);
// nombresPropiosNumerados(document.getElementById('domicilio-calle2-new'), 0, 25);
// enterosEnIntervalo(document.getElementById('domicilio-numero-e-new'), 0, 5);
// enterosEnIntervalo(document.getElementById('domicilio-numero-i-new'), 0, 5);
// descripciones(document.getElementById('domicilio-referencia-new'), 2, 50);

// nombresPropiosNumerados(document.getElementById('domicilio-estado-edit'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-municipio-edit'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-colonia-edit'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-calle-edit'), 2, 50);
// nombresPropiosNumerados(document.getElementById('domicilio-calle1-edit'),0, 25);
// nombresPropiosNumerados(document.getElementById('domicilio-calle2-edit'),0, 25);
// enterosEnIntervalo(document.getElementById('domicilio-numero-e-edit'), 0, 5);
// enterosEnIntervalo(document.getElementById('domicilio-numero-i-edit'), 0, 5);
// descripciones(document.getElementById('domicilio-referencia-edit'), 2, 50);

// nombresPropios(document.getElementById('nombre-new'), 2, 50);
// nombresUsuarios(document.getElementById('usuario-new'), 2, 50);
// contrasenas(document.getElementById('contrasena-new'), 30);
// contrasenas(document.getElementById('contrasena-edit'), 30);

// nombresPropios(document.getElementById('nombre-edit'), 2, 50);

// nombresPropios(document.getElementById('pet-nombre-new'), 2, 50);
// enterosEnIntervalo(document.getElementById('pet-anos-new'), 1, 2);
// decimales(document.getElementById('pet-peso-new'), 6);