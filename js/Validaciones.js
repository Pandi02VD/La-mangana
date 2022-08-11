export default class Validaciones {
	/** Validación de campos de texto para Nombres propios s/n. */
	static nombresPropios(input, min, max) {
		if (input) {
			let regExp = new RegExp("^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{" + min + "," + max + "}$");
			let text = "Solo letras y espacios.";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de texto para Nombres propios numerados. */
	static nombresPropiosNumerados(input, min, max) {
		if (input) {
			let regExp = new RegExp("^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{" + min + "," + max + "}$");
			let text = "Letras, numéros y espacios.";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de texto para descripciones y referencias. */
	static descripciones(input, min, max) {
		if (input) {
			let regExp = new RegExp("^[0-9a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,-_/&# ]{" + min + "," + max + "}$");
			let text = "Letras, números, espacios y estos caracteres(. , - _ / & #)";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de texto para nombres de usuario. */
	static nombresUsuarios(input, min, max) {
		if (input) {
			let regExp = new RegExp("^[0-9a-zA-Z ]{" + min + "," + max + "}$");
			let text = "Solo letras (sin acentos ni eñes), números y espacios.";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de texto para contraseñas. */
	static contrasenas(input, max) {
		if (input) {
			let regExp = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{4,}$");
			let text = "Debe tener por lo menos 1 mayúscula, 1 minúscula, 1 número y 1 caracter especial";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de texto para correos electrónicos. */
	static correosElectronicos(input, max) {
		if (input) {
			let regExp = new RegExp("^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$");
			let text = "Debe conincidir con el formato: Alguien@ejemplo.com";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de numéricos para enteros con longitud variable. */
	static enterosEnIntervalo(input, min, max) {
		if (input) {
			let regExp = new RegExp("^[0-9]{" + min + "," + max + "}$");
			let text = "Digite de " + min + " a " + max + " números enteros";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de numéricos para enteros con longitud constante. */
	static enterosSinIntervalo(input, max) {
		if (input) {
			let regExp = new RegExp("^[0-9]{" + max + "}$");
			let text = "Digite " + max + " números enteros";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de numéricos para decimales con 3 cifras después del punto. */
	static decimales(input, max) {
		if (input) {
			let regExp = new RegExp("^[0-9]+([.][0-9]+)?$");
			let text = "Digite números enteros o decimales";
			Validaciones.validarCampo(input, regExp, max, text);
		}
	}

	/** Validación de campos de datetime-local para fechas con hora. */
	static fechas(input, min, dots) {
		if (input) {
			let message = document.createElement('div');
			message.setAttribute('class', 'message');
			message.innerText = 'Fecha inválida, agendar con 1 día antes de su cita.';
			input.addEventListener('change', () => {
				input.classList.remove('noug');
				input.classList.remove('yeah');
				message.remove();
				let d = new Date();
				let fechaInput = new Date(input.value);
				let fechaActual = d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + (d.getDate() + min)).slice(-2);
				if (input.value < fechaActual || (!dots[fechaInput.getDay()])) {
					input.classList.add('noug');
					input.value = null;
					input.parentElement.appendChild(message);
				} else {
					input.classList.add('yeah');
				}
			})
		}
	}
	
	static horas(input, min, max) {
		if (input) {
			let message = document.createElement('div');
			message.setAttribute('class', 'message');
			message.innerText = 'Hora inválida.';
			input.addEventListener('change', () => {
				input.classList.remove('noug');
				input.classList.remove('yeah');
				message.remove();
				if (input.value < min || input.value > max) {
					input.classList.add('noug');
					input.value = null;
					input.parentElement.appendChild(message);
				} else {
					input.classList.add('yeah');
				}
			})
		}
	}

	/** Validación de campos basados en el proceso de expresiones regulares. */
	static validarCampo(input, regExp, max, text) {
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
}