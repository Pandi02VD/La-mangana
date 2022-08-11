import Pagina from './Pagina.js';
import Interactividad from './Interactividad.js';
import JQueryAcciones from './JQueryAcciones.js';
import Validaciones from './Validaciones.js';
import CronoAcciones from './CronoAcciones.js';

const pagina = Pagina.getPagina();
class All {
	constructor () {
		this.callScripts();
		new Pagina();
	}

	static navegacion(userBar, menuBar) {
		userBar.addEventListener('click', () => {
			menuBar.classList.toggle('showBar');
		});
	}

	callScripts () {
		if(pagina == 'Agenda') {
			Interactividad.interactFormModal(
				document.querySelector('#citaBtn-s'), 
				document.querySelector('#citaBtn-x'), 
				document.querySelector('#citaForm')
			);
			
			Interactividad.interactFormModal(
				document.querySelector('#posponerBtn-s'), 
				document.querySelector('#posponerBtn-x'), 
				document.querySelector('#posponerForm')
			);
			
			Interactividad.interactFormModal(
				document.querySelector('#cancelarBtn-s'), 
				document.querySelector('#cancelarBtn-x'), 
				document.querySelector('#cancelarForm')
			);
			
			Interactividad.checkBox(
				document.querySelector('#checkCitas'), 
				document.getElementsByName('checkCita'), 
				document.querySelector('#posponerBtn-s'), 
				document.querySelector('#cancelarBtn-s')
			);
			
			Interactividad.itemsTable(document.getElementsByName('checkCita'));

			Interactividad.confirmarCita(
				'nuevo-paciente', 
				document.getElementsByName('citaBtn-C'), 
				(r) => {
					$('#pacienteNombre-N').val(r["nombre"]);
					$('#pacienteApellidos-N').val(r["apellidos"]);
					$('#pacienteTelefono-N').val(r["telefono"]);
					$('#idCitaC').val(r["idCita"]);
					let form = document.querySelector('#pacienteNForm');
					let buttonHide = document.querySelector('#pacienteNBtn-x');
					form.classList.remove('oculto');
					Interactividad.interactFormModalSecret(buttonHide, form);
				}
			);
			
			JQueryAcciones.search($('#citaBtn-b'), $('#tbl-citas'), 'buscarCitas', (respuesta) => {
				console.log("Funcion buscar paciente agenda");
				let tabla = $('#tbl-citas tr:gt(0)');
				let tbl = $('#tbl-citas > tbody');
				if (respuesta.length > 0) {
					tabla.empty();
					for (const k in respuesta) {
						let idCita = respuesta[k]["idCita"];
						let nombre = respuesta[k]["nombre"] + respuesta[k]["apellidos"];
						let fechaCita = respuesta[k]["fechaCita"];
						let telefono = respuesta[k]["telefono"];
						let row = $(
							'<tr>' + 
								'<td>' + 
									'<input type="checkbox" name="checkCita" id="checkCita' + idCita + '" value="' + idCita + '">' + 
								'</td>' + 
								'<td id="' + idCita + '" name="checkCita">' + nombre + '</td>' + 
								'<td id="' + idCita + '" name="checkCita">' + fechaCita + '</td>' + 
								'<td id="' + idCita + '" name="checkCita">' + telefono + '</td>' + 
								'<td id="' + idCita + '" name="checkCita">' + 
									'<input type="button" name="citaBtn-C" class="btn" value="Confirmar">' + 
								'</td>' + 
							'</tr>'
						);
						tbl.append(row);
						$('#results').text(respuesta.length + ' resultados');
					}
					Interactividad.checkBox(
						document.querySelector('#checkCitas'), 
						document.getElementsByName('checkCita'), 
						document.querySelector('#posponerBtn-s'), 
						document.querySelector('#cancelarBtn-s')
					);
					Interactividad.itemsTable(document.getElementsByName('checkCita'));
					Interactividad.confirmarCita(document.getElementsByName('citaBtn-C'));
					JQueryAcciones.editForm(
						$('#posponerBtn-s'), 
						$('[name="checkCita"]'), 
						$('#idPosponer'), 
						function (resultado) {
							let fecha = JQueryAcciones.completarHoraInicio(resultado['fechaCita']);
							$('#posponerTiempo').val(fecha);
						}
					);
					
					JQueryAcciones.deleteForm(
						$('#cancelarBtn-s'), 
						$('#cancelarBtn-C'), 
						$('#cancelarBtn-x'), 
						$('[name="checkCita"]'), 
						document.getElementById('cancelarForm'), 
						'cancelarCitas', 
						'Agenda'
					);
				}
			});

			JQueryAcciones.editForm(
				$('#posponerBtn-s'), 
				$('[name="checkCita"]'), 
				$('#idPosponer'), 
				function (resultado) {
					let fecha = JQueryAcciones.completarHoraInicio(resultado['fechaCita']);
					$('#posponerTiempo').val(fecha);
				}
			);
			
			JQueryAcciones.deleteForm(
				$('#cancelarBtn-s'), 
				$('#cancelarBtn-C'), 
				$('#cancelarBtn-x'), 
				$('[name="checkCita"]'), 
				document.getElementById('cancelarForm'), 
				'cancelarCitas', 
				'Agenda'
			);

			Validaciones.nombresPropios(document.getElementById('citaNombre-n'), 2, 30);
			Validaciones.nombresPropios(document.getElementById('citaApellidos-n'), 2, 50);
			Validaciones.enterosSinIntervalo(document.getElementById('citaTelefono-n'), 10);

			CronoAcciones.getConfig((r) => {
				let i = 0;
				let dots = {};
				for (const k in r) {
					dots[i] = r[k];
					i++;
				}
				Validaciones.fechas(document.getElementById('citaFecha-n'), 1, dots);
				Validaciones.horas(document.getElementById('citaHora-n'), r.horaA, r.horaC);
			});
		} else if (pagina == 'Cita') {
			Validaciones.nombresPropios(document.getElementById('citaNombre-n'), 2, 30);
			Validaciones.nombresPropios(document.getElementById('citaApellidos-n'), 2, 50);
			Validaciones.enterosSinIntervalo(document.getElementById('citaTelefono-n'), 10);
			
			CronoAcciones.getConfig((r) => {
				let i = 0;
				let dots = {};
				for (const k in r) {
					dots[i] = r[k];
					i++;
				}
				Validaciones.fechas(document.getElementById('citaFecha-n'), 1, dots);
				Validaciones.horas(document.getElementById('citaHora-n'), r.horaA, r.horaC);
			});
			Interactividad.ajuste();
		} else if (pagina == 'Usuarios') {
			Interactividad.interactFormModal(
				document.querySelector('#usuarioNBtn-s'), 
				document.querySelector('#usuarioNBtn-x'), 
				document.querySelector('#usuarioNForm')
			);
			
			Interactividad.interactFormModal(
				document.querySelector('#usuarioABtn-s'), 
				document.querySelector('#usuarioABtn-x'), 
				document.querySelector('#usuarioAForm')
			);
			
			Interactividad.interactFormModal(
				document.querySelector('#usuarioEBtn-s'), 
				document.querySelector('#usuarioEBtn-x'), 
				document.querySelector('#usuarioEForm')
			);

			Interactividad.checkBox(
				document.querySelector('#checkUsuarios'), 
				document.getElementsByName('checkUsuario'), 
				document.querySelector('#usuarioABtn-s'), 
				document.querySelector('#usuarioEBtn-s')
			);
			
			Interactividad.itemsTable(document.getElementsByName('checkUsuario'));
			
			JQueryAcciones.search($('#usuarioBtn-b'), $('#tbl-usuarios'), 'buscarUsuarios', (respuesta) => {
				let tabla = $('#tbl-usuarios tr:gt(0)');
				let tbl = $('#tbl-usuarios > tbody');
				if (respuesta.length > 0) {
					tabla.empty();
					for (const k in respuesta) {
						let nombre = respuesta[k]["nombre"] + ' ' + respuesta[k]["apellidos"];
						let idUsuario = respuesta[k]["idUsuario"];
						let fechaRegistro = respuesta[k]["fechaRegistro"];
						let cargos = ['Paciente', 'Administrador', 'Gerente', 'Doctor', 'Recepcionista', 'Asistente'];
						let estados = ['Desconectado', 'Conectado'];
						let cargo = cargos[respuesta[k]["tipoUsuario"]];
						let estado = estados[respuesta[k]["estado"]];
						let row = $(
							'<tr>' + 
								'<td>' + 
									'<input type="checkbox" name="checkUsuario" id="checkUsuario' + idUsuario + '" value="' + idUsuario + '">' + 
								'</td>' + 
								'<td id="' + idUsuario + '" name="checkUsuario">' + nombre + '</td>' + 
								'<td id="' + idUsuario + '" name="checkUsuario">' + cargo + '</td>' + 
								'<td id="' + idUsuario + '" name="checkUsuario">' + fechaRegistro + '</td>' + 
								'<td id="' + idUsuario + '" name="checkUsuario">' + estado + '</td>' + 
							'</tr>'
						);
						tbl.append(row);
						$('#results').text(respuesta.length + ' resultados');
					}
					Interactividad.checkBox(
						document.querySelector('#checkUsuarios'), 
						document.getElementsByName('checkUsuario'), 
						document.querySelector('#usuarioABtn-s'), 
						document.querySelector('#usuarioEBtn-s')
					);
					Interactividad.itemsTable(document.getElementsByName('checkUsuario'));

					JQueryAcciones.editForm(
						$('#usuarioABtn-s'), 
						$('[name="checkUsuario"]'), 
						$('#idUsuario-A'), 
						function (resultado) {
							let select = $('#usuarioCargo-A');
							$('#usuarioNombre-A').val(resultado["nombre"]);
							$('#usuarioApellidos-A').val(resultado["apellidos"]);
							select[0].options.selectedIndex = false;
							for(const k of select[0].options){
								if(k.value == resultado["tipoUsuario"]){
									k.selected = true;
								}
							}
						}
					);
					
					JQueryAcciones.deleteForm(
						$('#usuarioEBtn-s'), 
						$('#usuarioEBtn-C'), 
						$('#usuarioEBtn-x'), 
						$('[name="checkUsuario"]'), 
						document.getElementById('usuarioEForm'), 
						'eliminarUsuarios', 
						'Usuarios'
					);
				}
			});

			JQueryAcciones.editForm(
				$('#usuarioABtn-s'), 
				$('[name="checkUsuario"]'), 
				$('#idUsuario-A'), 
				function (resultado) {
					let select = $('#usuarioCargo-A');
					$('#usuarioNombre-A').val(resultado["nombre"]);
					$('#usuarioApellidos-A').val(resultado["apellidos"]);
					select[0].options.selectedIndex = false;
					for(const k of select[0].options){
						if(k.value == resultado["tipoUsuario"]){
							k.selected = true;
						}
					}
				}
			);
			
			JQueryAcciones.deleteForm(
				$('#usuarioEBtn-s'), 
				$('#usuarioEBtn-C'), 
				$('#usuarioEBtn-x'), 
				$('[name="checkUsuario"]'), 
				document.getElementById('usuarioEForm'), 
				'eliminarUsuarios', 
				'Usuarios'
			);
		} else if (pagina == 'Pacientes') {
			Interactividad.checkBox(
				document.querySelector('#checkPacientes'), 
				document.getElementsByName('checkPaciente'), 
				document.querySelector('#pacienteABtn-s'), 
				document.querySelector('#pacienteFBtn-s')
			);
			Interactividad.itemsTable(document.getElementsByName('checkPaciente'));
			Interactividad.interactFormModal(
				document.querySelector('#pacienteNBtn-s'), 
				document.querySelector('#pacienteNBtn-x'), 
				document.querySelector('#pacienteNForm') 
			);
			Interactividad.interactFormModal(
				document.querySelector('#pacienteABtn-s'), 
				document.querySelector('#pacienteABtn-x'), 
				document.querySelector('#pacienteAForm') 
			);
			Interactividad.interactFormModal(
				document.querySelector('#pacienteFBtn-s'), 
				document.querySelector('#pacienteFBtn-x'), 
				document.querySelector('#pacienteFForm') 
			);
			
			Validaciones.nombresPropios(document.getElementById('pacienteNombre-N'), 2, 30);
			Validaciones.nombresPropios(document.getElementById('pacienteApellidos-N'), 2, 50);
			Validaciones.enterosSinIntervalo(document.getElementById('pacienteTelefono-N'), 10);
			
			Validaciones.nombresPropios(document.getElementById('pacienteNombre-A'), 2, 30);
			Validaciones.nombresPropios(document.getElementById('pacienteApellidos-A'), 2, 50);
			Validaciones.enterosSinIntervalo(document.getElementById('pacienteTelefono-A'), 10);
		
			/*PacienteInfo*/
			Validaciones.nombresPropios(document.getElementById('pacienteNombre-a'), 2, 30);
			Validaciones.nombresPropios(document.getElementById('pacienteApellidos-a'), 2, 50);
			Validaciones.nombresPropios(document.getElementById('pacienteOcupacion-a'), 0, 45);

			Interactividad.interactFormModal(
				document.querySelector('#correoNBtn-s'), 
				document.querySelector('#correoNBtn-x'), 
				document.querySelector('#correoNForm') 
			);
			Interactividad.interactFormModal(
				document.querySelector('#telefonoNBtn-s'), 
				document.querySelector('#telefonoNBtn-x'), 
				document.querySelector('#telefonoNForm') 
			);
			Interactividad.interactFormModal(
				document.querySelector('#domicilioNBtn-s'), 
				document.querySelector('#domicilioNBtn-x'), 
				document.querySelector('#domicilioNForm') 
			);
			Interactividad.interactDiv(
				document.querySelector('#divPacienteBtn-s'), 
				document.getElementsByName('divs'), 
				document.querySelector('#infoPacienteDiv')
			);
			Interactividad.interactDiv(
				document.querySelector('#divContactoBtn-s'), 
				document.getElementsByName('divs'), 
				document.querySelector('#infoContactoDiv')
			);
			Interactividad.interactDiv(
				document.querySelector('#divMedicaBtn-s'), 
				document.getElementsByName('divs'), 
				document.querySelector('#infoMedicaDiv')
			);
			Interactividad.interactDiv(
				document.querySelector('#divHistoriaBtn-s'), 
				document.getElementsByName('divs'), 
				document.querySelector('#infoHistoriaDiv')
			);
		} else if (pagina == 'Configuracion') {
			Validaciones.contrasenas(document.getElementById('pwdNueva'), 30);
			Interactividad.interactFormModal(
				document.querySelector('#changePwdBtn-s'), 
				document.querySelector('#changePwdBtn-x'), 
				document.querySelector('#changePwdForm')
			);
			
			Interactividad.interactFormModal(
				document.querySelector('#horarioNBtn-s'), 
				document.querySelector('#horarioNBtn-x'), 
				document.querySelector('#horarioNForm')
			);

			Validaciones.correosElectronicos(document.getElementById('correo-n'), 30);
			Interactividad.interactFormModal(
				document.querySelector('#correoNBtn-s'), 
				document.querySelector('#correoNBtn-x'), 
				document.querySelector('#correoNForm')
			);
			
			Interactividad.formModal(
				document.getElementsByName('correoABtn-s'), 
				document.querySelector('#correoABtn-x'), 
				document.querySelector('#correoAForm'), 
				(idElement, nameElement) => {
					JQueryAcciones.editFormModal(idElement, nameElement, (datosCorreo) => {
						$('#correo-a').val(datosCorreo["correo"]);
						$('#correoId-a').val(datosCorreo["idUsuarioCorreo"]);
					});
				}
			);
			
			Interactividad.formModal(
				document.getElementsByName('correoEBtn-s'), 
				document.querySelector('#correoEBtn-x'), 
				document.querySelector('#correoEForm'), 
				(idElement, nameElement) => {
					JQueryAcciones.editFormModal(idElement, nameElement, (datosCorreo) => {
						$('#correoId-e').val(datosCorreo["idUsuarioCorreo"]);
					});
				}
			);
			
			Validaciones.enterosSinIntervalo(document.getElementById('telNumero-n'), 10);
			Interactividad.interactFormModal(
				document.querySelector('#telefonoNBtn-s'), 
				document.querySelector('#telefonoNBtn-x'), 
				document.querySelector('#telefonoNForm')
			);
			
			Interactividad.formModal(
				document.getElementsByName('telefonoABtn-s'), 
				document.querySelector('#telefonoABtn-x'), 
				document.querySelector('#telefonoAForm'), 
				(idElement, nameElement) => {
					JQueryAcciones.editFormModal(idElement, nameElement, (datosTelefono) => {
						$('#telNumero-a').val(datosTelefono["numero"]);
						$('#telId-a').val(datosTelefono["idUsuarioTelefono"]);
						for (const i of $('#telTipo-a')[0].options) {
							i.value == datosTelefono["tipoTelefono"] ? i.selected = true : null;
						}
					});
				}
			);
			
			Interactividad.formModal(
				document.getElementsByName('telefonoEBtn-s'), 
				document.querySelector('#telefonoEBtn-x'), 
				document.querySelector('#telefonoEForm'), 
				(idElement, nameElement) => {
					console.log(idElement, nameElement);
					JQueryAcciones.editFormModal(idElement, nameElement, (datosTelefono) => {
						$('#telId-e').val(datosTelefono["idUsuarioTelefono"]);
					});
				}
			);
			
			// Validaciones.enterosSinIntervalo(document.getElementById('telNumero-n'), 10);
			JQueryAcciones.autocompleteAddress(
				document.getElementById('domUbicacion-n'), 
				document.getElementById('domEstado-n'), 
				document.getElementById('domMunicipio-n'), 
				document.getElementById('domColonia-n'), 
				document.getElementById('domCalle-n')
			);
			JQueryAcciones.autocompleteAddress(
				document.getElementById('domUbicacion-a'), 
				document.getElementById('domEstado-a'), 
				document.getElementById('domMunicipio-a'), 
				document.getElementById('domColonia-a'), 
				document.getElementById('domCalle-a')
			);
			Interactividad.interactFormModal(
				document.querySelector('#domicilioNBtn-s'), 
				document.querySelector('#domicilioNBtn-x'), 
				document.querySelector('#domicilioNForm')
			);
			
			Interactividad.formModal(
				document.getElementsByName('domicilioABtn-s'), 
				document.querySelector('#domicilioABtn-x'), 
				document.querySelector('#domicilioAForm'), 
				(idElement, nameElement) => {
					JQueryAcciones.editFormModal(idElement, nameElement, (domicilioJSON) => {
						let domJSON = JSON.parse(domicilioJSON["domicilioJSON"]);
						$('#domId-a').val(domicilioJSON["idUsuarioDomicilio"]);
						$('#domEstado-a').val(domJSON.estado);
						$('#domMunicipio-a').val(domJSON.municipio);
						$('#domColonia-a').val(domJSON.colonia);
						$('#domCalle-a').val(domJSON.calle);
						$('#domNumExt-a').val(domJSON.numExt);
						$('#domRef-a').val(domJSON.referencia);
						$('#domNumInt-a').val(domJSON.numInt != undefined ? domJSON.numInt : '');
						$('#domCalle1-a').val(domJSON.calle1 != undefined ? domJSON.calle1 : '');
						$('#domCalle2-a').val(domJSON.calle2 != undefined ? domJSON.calle2 : '');
					});
				}
			);
			
			Interactividad.formModal(
				document.getElementsByName('domicilioEBtn-s'), 
				document.querySelector('#domicilioEBtn-x'), 
				document.querySelector('#domicilioEForm'), 
				(idElement, nameElement) => {
					JQueryAcciones.editFormModal(idElement, nameElement, (datosDomicilio) => {
						console.log(datosDomicilio["idUsuarioDomicilio"]);
						$('#domId-e').val(datosDomicilio["idUsuarioDomicilio"]);
					});
				}
			);
		} else if (pagina == 'IniciarSesion') {
			Interactividad.ajuste();
		} else if (pagina == 'Inicio') {
			setInterval(() => {Interactividad.stepSlide(document.getElementById('sliderContent'))}, 5000);
			Interactividad.sliderControls(
				document.getElementById('prevSlide'), 
				document.getElementById('nextSlide'), 
				document.querySelectorAll('.slide'), 
				document.getElementById('sliderContent')
			);
		}
	}
}

All.navegacion(
	document.getElementById('userBar'), 
	document.getElementById('menuBar')
);
new All();