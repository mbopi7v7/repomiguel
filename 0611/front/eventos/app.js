console.log("app.js cargado correctamente");

// Referencias generales
const mensaje = document.getElementById("mensaje");

// Vistas
const vistaListado = document.getElementById("vistaListado");
const vistaFormulario = document.getElementById("vistaFormulario");

// Botones del listado
const btnDescargar = document.getElementById("btnDescargar");
const btnPintar = document.getElementById("btnPintar");
const btnNuevo = document.getElementById("btnNuevo");
const btnLimpiarStorage = document.getElementById("btnLimpiarStorage");

// Tabla
const tbodyEventos = document.getElementById("tbodyEventos");

// Formulario
const formEvento = document.getElementById("formEvento");
const btnCancelar = document.getElementById("btnCancelar");
const tituloFormulario = document.getElementById("tituloFormulario");

const inputId = document.getElementById("id");
const inputTitulo = document.getElementById("titulo");
const inputLugar = document.getElementById("lugar");
const inputFecha = document.getElementById("fecha");
const inputHora = document.getElementById("hora");
const inputActivo = document.getElementById("activo");


// EVENTOS PRINCIPALES

btnDescargar.addEventListener("click", () => {
  sincronizarDesdeServidor();
});

btnPintar.addEventListener("click", () => {
  pintarTabla();
  mostrarListado();

  mostrarMensaje(
    "Tabla generada usando los datos guardados en LocalStorage.",
    "info"
  );
});

btnNuevo.addEventListener("click", () => {
  limpiarFormulario();
  tituloFormulario.innerText = "Nuevo evento";
  mostrarFormulario();

  mostrarMensaje(
    "Complete el formulario para registrar un nuevo evento.",
    "info"
  );
});

btnLimpiarStorage.addEventListener("click", () => {
  localStorage.removeItem("eventos");
  tbodyEventos.innerHTML = "";
  limpiarFormulario();
  mostrarListado();

  mostrarMensaje(
    "LocalStorage limpiado correctamente.",
    "warning"
  );
});

btnCancelar.addEventListener("click", () => {
  limpiarFormulario();
  mostrarListado();

  mostrarMensaje(
    "Operación cancelada.",
    "secondary"
  );
});

formEvento.addEventListener("submit", (e) => {
  e.preventDefault();
  procesarFormulario();
});

tbodyEventos.addEventListener("click", (e) => {
  const boton = e.target;

  if (boton.classList.contains("btnEditar")) {
    const id = boton.dataset.id;
    editarEvento(id);
  }

  if (boton.classList.contains("btnEliminar")) {
    const id = boton.dataset.id;
    eliminarEvento(id);
  }
});


// FUNCIONES DE LOCALSTORAGE

function obtenerEventos() {
  const datosTexto = localStorage.getItem("eventos");

  if (datosTexto === null) {
    return [];
  }

  return JSON.parse(datosTexto);
}

function guardarEventos(eventos) {
  localStorage.setItem("eventos", JSON.stringify(eventos));
}


// FUNCIONES DE VISTAS

function mostrarListado() {
  vistaListado.style.display = "block";
  vistaFormulario.style.display = "none";
}

function mostrarFormulario() {
  vistaListado.style.display = "none";
  vistaFormulario.style.display = "block";
}


// FUNCIONES DE INTERFAZ

function pintarTabla() {
  const eventos = obtenerEventos();

  tbodyEventos.innerHTML = "";

  if (eventos.length === 0) {
    tbodyEventos.innerHTML = `
      <tr>
        <td colspan="7" class="text-center">
          No hay eventos cargados en LocalStorage.
        </td>
      </tr>
    `;
    return;
  }

  eventos.forEach(evento => {
    const estado = evento.activo == 1 ? "Activo" : "Inactivo";

    tbodyEventos.innerHTML += `
      <tr>
        <td>${evento.id}</td>
        <td>${evento.titulo}</td>
        <td>${evento.lugar}</td>
        <td>${evento.fecha}</td>
        <td>${evento.hora}</td>
        <td>${estado}</td>
        <td>
          <button 
            class="btn btn-sm btn-warning btnEditar"
            data-id="${evento.id}">
            Editar
          </button>

          <button 
            class="btn btn-sm btn-danger btnEliminar"
            data-id="${evento.id}">
            Eliminar
          </button>
        </td>
      </tr>
    `;
  });
}

function mostrarMensaje(texto, tipo) {
  mensaje.innerHTML = `
    <div class="alert alert-${tipo}">
      ${texto}
    </div>
  `;
}

function mostrarErrores(errores) {
  let contenido = "<ul>";

  errores.forEach(error => {
    contenido += `<li>${error}</li>`;
  });

  contenido += "</ul>";

  mensaje.innerHTML = `
    <div class="alert alert-danger">
      <strong>Datos inválidos:</strong>
      ${contenido}
    </div>
  `;
}

function limpiarFormulario() {
  inputId.value = "";
  inputTitulo.value = "";
  inputLugar.value = "";
  inputFecha.value = "";
  inputHora.value = "";
  inputActivo.value = "1";
}

function cargarFormulario(evento) {
  inputId.value = evento.id;
  inputTitulo.value = evento.titulo;
  inputLugar.value = evento.lugar;
  inputFecha.value = evento.fecha;
  inputHora.value = evento.hora;
  inputActivo.value = evento.activo;
}


// FUNCIONES DE SINCRONIZACIÓN

function sincronizarDesdeServidor() {
  descargarEventos()
    .then(respuesta => {
      console.log("Respuesta recibida:", respuesta);

      if (respuesta.status === "success") {
        guardarEventos(respuesta.data);
        pintarTabla();
        mostrarListado();

        mostrarMensaje(
          "Eventos descargados correctamente. Total: " + respuesta.total,
          "success"
        );
      } else {
        mostrarMensaje(
          "No se pudieron descargar los eventos.",
          "danger"
        );
      }
    })
    .catch(error => {
      console.error("Error al descargar eventos:", error);

      mostrarMensaje(
        "Error de comunicación con el servidor al descargar eventos.",
        "danger"
      );
    });
}

function procesarFormulario() {
  const datos = new FormData(formEvento);

  if (inputId.value === "") {
    guardarEventoServidor(datos)
      .then(procesarRespuestaServidor)
      .catch(error => {
        console.error("Error al guardar:", error);
        mostrarMensaje(
          "Error de comunicación con el servidor al guardar.",
          "danger"
        );
      });
  } else {
    actualizarEventoServidor(datos)
      .then(procesarRespuestaServidor)
      .catch(error => {
        console.error("Error al actualizar:", error);
        mostrarMensaje(
          "Error de comunicación con el servidor al actualizar.",
          "danger"
        );
      });
  }
}

function procesarRespuestaServidor(respuesta) {
  console.log("Respuesta del servidor:", respuesta);

  if (respuesta.status === "success") {
    limpiarFormulario();

    mostrarMensaje(
      respuesta.msg,
      "success"
    );

    sincronizarDesdeServidor();

  } else {
    if (respuesta.errores) {
      mostrarErrores(respuesta.errores);
    } else {
      mostrarMensaje(
        respuesta.msg,
        "danger"
      );
    }
  }
}


// FUNCIONES DE ACCIONES

function editarEvento(id) {
  const eventos = obtenerEventos();

  const evento = eventos.find(item => item.id == id);

  if (!evento) {
    mostrarMensaje(
      "No se encontró el evento seleccionado.",
      "danger"
    );
    return;
  }

  cargarFormulario(evento);
  tituloFormulario.innerText = "Editar evento";
  mostrarFormulario();

  mostrarMensaje(
    "Evento cargado en el formulario.",
    "info"
  );
}

function eliminarEvento(id) {
  const confirma = confirm("¿Está seguro de eliminar este evento?");

  if (!confirma) {
    mostrarMensaje(
      "Eliminación cancelada.",
      "secondary"
    );
    return;
  }

  eliminarEventoServidor(id)
    .then(respuesta => {
      if (respuesta.status === "success") {
        mostrarMensaje(
          respuesta.msg,
          "success"
        );

        sincronizarDesdeServidor();

      } else {
        mostrarMensaje(
          respuesta.msg,
          "danger"
        );
      }
    })
    .catch(error => {
      console.error("Error al eliminar:", error);

      mostrarMensaje(
        "Error de comunicación con el servidor al eliminar.",
        "danger"
      );
    });
}


// CARGA INICIAL

pintarTabla();