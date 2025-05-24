function enviarDatosLogin() {
  var formlogin = document.getElementById('form-login');
  var datos = new FormData(formlogin);

  fetch('login.php', {method: 'POST',body: datos})
  .then(response => response.text())
  .then(data => {
    if (data === 'true') {
      redireccionarDashboard();
    } else {
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
    html += `<tr id="entregado">
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
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
		  document.querySelector("#titulo-modal").innerHTML = "Correo"
		  document.querySelector("#contenido-modal").innerHTML = data
		  document.getElementById("myModal").style.display = "block"
      listarCorreos(urlrefresh);
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