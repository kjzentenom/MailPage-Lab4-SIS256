function enviarDatosLogin() {
  var formlogin = document.getElementById('form-login');
  var datos = new FormData(formlogin);

  fetch('login.php', {method: 'POST',body: datos})
  .then(response => response.text())
  .then(data => {
    if (data === 'true') {
      redireccionarDashboard();
    } else if (data === 'false') {
      redireccionarLogin();
    }
  })
}

function redireccionarDashboard() {
  fetch('dashboard.php')
    .then(response => response.text())
    .then(data => {
      window.location.href = 'dashboard.php';
    })
}

function redireccionarLogin() {
  const mensaje = document.getElementById('mensaje-error');
  const formulario = document.getElementById('form-login');

  mensaje.innerHTML = 'Usuario o contraseña incorrectos';

  formulario.reset();
}

function datosRegistrar() {
  fetch('formregister.php')
    .then((response) => response.text())
    .then((data) => {
		  document.querySelector("#titulo-modal").innerHTML = "Registrar Usuario"
		  document.querySelector("#contenido-modal").innerHTML = data
		  document.getElementById("myModal").style.display = "block";
		  });
}

function enviarDatosRegistro() {
  var formregister = document.getElementById('form-register');
  var datos = new FormData(formregister);

  fetch("adduser.php", { method: "POST", body: datos })
    .then((response) => response.text())
	  .then((data) => {
		  document.querySelector("#titulo-modal").innerHTML = "Mensaje"
		  document.querySelector("#contenido-modal").innerHTML = data
		  }
	  );
}

function modalCorreo() {
  fetch('redactarcorreo.php')
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Redactar Correo"
      document.querySelector("#contenido-modal").innerHTML = data
      document.getElementById("myModal").style.display = "block";
      });
}

function accionCorreo(accion) {
  var formcorreo = document.getElementById('form-correo');
  var datos = new FormData(formcorreo);
  var url = `enviarcorreo.php?accion=${accion}`;

  fetch(url, { method: "POST", body: datos })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Mensaje"
      document.querySelector("#contenido-modal").innerHTML = data
      }
    );
}

function listarCorreos(url) {
  var contenedor;
  contenedor = document.getElementById("contenido");
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      objeto = JSON.parse(data);
      contenedor.innerHTML = renderizarCorreo(objeto, url);
    });
}

function renderizarCorreo(objeto, url) {
  let correos = objeto;

  let html = `<table style="border-collapse: collapse" border="1" >
			<thead>
        	<tr id="cabecera">
            <th>*</th>
            <th>Correo</th>
            <th>Asunto</th>
            <th>Estado</th>
            <th>Operaciones</th>
        	</tr>
    		</thead>`;

  for (var i = 0; i < correos.length; i++) {
    html += `<tr`;
    if (correos[i].estado == "abierto") {
      html += ` id="abierto">`;
    }
    else if (correos[i].estado == "enviado") {
      html += ` id="enviado">`;
    }
    html += `
        <td>${correos[i].o}</td>
        <td>${correos[i].correo}</td>
        <td>${correos[i].asunto} </td>
        <td>${correos[i].estado}</td>`;
    if(correos[i].estado == "pendiente") {
      html += `<td><a href="javascript:editarCorreo('${correos[i].id}', '${url}')">Editar</a></td>`;
    }else {
      html += `<td><a href="javascript:verCorreoModal('${correos[i].id}', '${url}')">Ver</a>  <a href="javascript:eliminarCorreo('${correos[i].id}', '${url}')">Eliminar</a></td>`;
    }
  }
  html += "</tr>  </table>";
  return html;
}

function verCorreoModal(id,urlrefresh) {
  var url = `mostrarcorreo.php?id=${id}`;
  actualozarEstadoCorreo(id);
  var openCorreo = document.getElementById('abierto');
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
		  document.querySelector("#titulo-modal").innerHTML = "Correo"
		  document.querySelector("#contenido-modal").innerHTML = data
		  document.getElementById("myModal").style.display = "block"
      listarCorreos(urlrefresh);
		  });
}

function actualozarEstadoCorreo(id) {
  var url = `actualizarestadoabierto.php?id=${id}`;
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
    });
}

function eliminarCorreo(id,urlrefresh) {
  var url = `eliminarcorreo.php?id=${id}`;
  var contenedor = document.getElementById("contenido");
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      contenedor.innerHTML = data
      listarCorreos(urlrefresh);
    });
}

function editarCorreo(id,urlrefresh) {
  var url = `editarcorreo.php?id=${id}`;
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Editar Correo"
      document.querySelector("#contenido-modal").innerHTML = data
      document.getElementById("myModal").style.display = "block"
      listarCorreos(urlrefresh);
      });
}

function guardarEditarCorreo(accion, id) {
  var datos = new FormData(document.querySelector("#form-correo"));
  var url = `guardareditarcorreo.php?id=${id}&accion=${accion}`;
  var urlrefresh = 'bocorreo.php';

  fetch(url, { method: "POST", body: datos })
    .then((response) => response.text())
	  .then((data) => {
		  document.querySelector("#titulo-modal").innerHTML = "Mensaje"
		  document.querySelector("#contenido-modal").innerHTML = data
      listarCorreos(urlrefresh);
		  }
	  	  );
}

function enviarBorrador(accion, id) {
  var formborrador = document.getElementById('form-correo');
  var datos = new FormData(formborrador);
  var url = `enviarborrador.php?accion=${accion}&id=${id}`;
  var urlrefresh = 'bocorreo.php';

  fetch(url, { method: "POST", body: datos })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Mensaje"
      document.querySelector("#contenido-modal").innerHTML = data
      listarCorreos(urlrefresh);
      }
    );
}

//CRUD USUARIOS
function listarUsuarios() {
  var contenedor;
  contenedor = document.getElementById("contenido");
  fetch('a_vercuenta.php')
    .then((response) => response.text())
    .then((data) => {
      usuarios = JSON.parse(data);
      contenedor.innerHTML = renderizarUsuarios(usuarios);
    });
}

function renderizarUsuarios(objeto) {
  let usuarios = objeto;

  let html = `<table style="border-collapse: collapse" border="1" >
			  <thead>
        	<tr>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Operaciones</th>
        	</tr>
    		</thead>`;

  for (var i = 0; i < usuarios.length; i++) {
    html += `
      <tr>
        <td>${usuarios[i].nombre}</td>
        <td>${usuarios[i].user}</td>
        <td>${usuarios[i].correo}</td>
        <td><a id="openModalBtn" href="javascript:editarUsuario('${usuarios[i].id}')">Editar</a>  <a href="javascript:eliminarCuenta('${usuarios[i].id}')">Eliminar</a></td>
      </tr>`;
  }
  html += "</table>";
  html += `<a id="openModalBtn" href="javascript:datosRegistrar()">Registrar Usuario</a>`;
  return html;
}

function editarUsuario(id) {
  var url = `a_editarcuenta.php?id=${id}`;
  var urladministrarusuario = 'a_vercuentas.php';
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Editar Cuenta"
      document.querySelector("#contenido-modal").innerHTML = data
      document.getElementById("myModal").style.display = "block"
      listarUsuarios(urladministrarusuario);
      });
}

function guardarEditarCuenta(id) {
  var datos = new FormData(document.querySelector("#form-editar-cuenta"));
  var url = `a_guardarcuenta.php?id=${id}`;
  var urlrefresh = 'a_vercuentas.php';

  fetch(url, { method: "POST", body: datos })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Mensaje"
      document.querySelector("#contenido-modal").innerHTML = data
      listarUsuarios(urlrefresh);
      }
    );
}

function eliminarCuenta(id) {
  var url = `a_eliminarcuenta.php?id=${id}`;
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Mensaje"
      document.querySelector("#contenido-modal").innerHTML = data
      listarUsuarios();
      }
    );
}

function auditarCorreos() {
  var contenedor;
  contenedor = document.getElementById("contenido");
  fetch('a_auditarcorreos.php')
    .then((response) => response.text())
    .then((data) => {
      auditoria = JSON.parse(data);
      contenedor.innerHTML = renderizarAuditoria(auditoria);
    });
}

function renderizarAuditoria(objeto) {
  let auditoria = objeto;

  let html = `<table style="border-collapse: collapse" border="1" >
        <thead>
        	<tr>
            <th>Remitente</th>
            <th>Correo Remitente</th>
            <th>Fecha</th>
            <th>Asunto</th>
            <th>Cuerpo</th>
            <th>Estado</th>
            <th>Destinatario</th>
            <th>Correo Destinatario</th>
        	</tr>
    		</thead>`;
  for (var i = 0; i < auditoria.length; i++) {
    html += `<tr`;
    if (auditoria[i].tipo == "0") {
      html += ` id="eliminado">`;
    }
    else {
      html += `>`;
    }
    html += `
        <td>${auditoria[i].nombre_remitente}</td>
        <td>${auditoria[i].correo_remitente}</td>
        <td>${auditoria[i].fecha_envio}</td>
        <td>${auditoria[i].asunto}</td>
        <td>${auditoria[i].cuerpo}</td>
        <td>${auditoria[i].estado}</td>
        <td>${auditoria[i].nombre_destinatario}</td>
        <td>${auditoria[i].correo_destinatario}</td>
      </tr>`;
  }
  html += "</table>";
  return html;
}

function notificacionMasiva() {
  fetch('a_redactarcorreomasivo.php')
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Redactar Correo Masivo"
      document.querySelector("#contenido-modal").innerHTML = data
      document.getElementById("myModal").style.display = "block";
      });
}

function enviarNotificacionMasiva() {
  var formcorreo = document.getElementById('form-correo-masivo');
  var datos = new FormData(formcorreo);
  var url = `a_enviarcorreomasivo.php`;

  fetch(url, { method: "POST", body: datos })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Mensaje"
      document.querySelector("#contenido-modal").innerHTML = data
      }
    );
}
