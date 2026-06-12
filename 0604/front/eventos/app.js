console.log("app.js cargado correctamente");

// Referencias generales
const mensaje = document.getElementById("mensaje");

// Vistas
const vistaListado = document.getElementById("vistaListado");
const vistaFormulario = document.getElementById("vistaFormulario");

// Botones del listado
const btnDescargar = document.getElementById("btnDescargar");
const btnPintar = document.getElementById("btnPintar");
const btnLimpiarStorage = document.getElementById("btnLimpiarStorage");

// Tabla
const tbodyEventos = document.getElementById("tbodyEventos");

// Formulario
const formEvento = document.getElementById("formEvento");
const btnCancelar = document.getElementById("btnCancelar");

const inputId = document.getElementById("id");
const inputTitulo = document.getElementById("titulo");
const inputLugar = document.getElementById("lugar");
const inputFecha = document.getElementById("fecha");
const inputHora = document.getElementById("hora");
const inputActivo = document.getElementById("activo");


// EVENTOS PRINCIPALES

btnDescargar.addEventListener("click", () => {
  cargarDatos()
 /*    .then(respuesta => {
      console.log("Respuesta recibida:", respuesta);

      guardarEventos(respuesta.data);
      pintarTabla();
      mostrarListado();

      mostrarMensaje(
        "Eventos descargados correctamente. Total: " + respuesta.total,
        "success"
      );
    })
    .catch(error => {
      console.error("Error al descargar eventos:", error);

      mostrarMensaje(
        "No se pudieron descargar los eventos desde el backend.",
        "danger"
      );
    }); */
}) ;

btnPintar.addEventListener("click", () => {
  pintarTabla();
  mostrarListado();

  mostrarMensaje(
    "Tabla generada usando los datos guardados en LocalStorage.",
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
    "Edición cancelada.",
    "secondary"
  );
});

formEvento.addEventListener("submit", (e) => {
  e.preventDefault();
  guardarCambiosLocales();
});

tbodyEventos.addEventListener("click", (e) => {
  const boton = e.target;
 // console.log(boton)
 //mostrarMensaje(boton., "secondary");
  if (boton.classList.contains("btnEditar")) {
    const id = boton.dataset.id;
    editarEvento(id);
  }

  if (boton.classList.contains("btnEliminar")) {
    const id = boton.dataset.id;
    eliminarEventoLocal(id);
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
            Eliminar local
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


// FUNCIONES DE ACCIONES LOCALES

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
  mostrarFormulario();

  mostrarMensaje(
    "Evento cargado en el formulario. Puede modificar los datos.",
    "info"
  );
}

function guardarCambiosLocales() {
  const id = inputId.value;

  if (id === "") {
    mostrarMensaje(
      "Primero debe seleccionar un evento para editar.",
      "warning"
    );
    return;
  }

  const eventoActualizado = {
    id: id,
    titulo: inputTitulo.value,
    lugar: inputLugar.value,
    fecha: inputFecha.value,
    hora: inputHora.value,
    activo: inputActivo.value
  };

  let eventos = obtenerEventos();

  eventos = eventos.map(item => {
    if (item.id == eventoActualizado.id) {
      return eventoActualizado;
    }

    return item;
  });

  guardarEventos(eventos);
  pintarTabla();
  limpiarFormulario();
  mostrarListado();

  mostrarMensaje(
    "Evento actualizado localmente. La base de datos todavía no fue modificada.",
    "success"
  );
}

function eliminarEventoLocal(id) {
  const confirmar = confirm(
    "¿Desea eliminar este evento de la copia local?"
  );

  if (!confirmar) {
    return;
  }

  let eventos = obtenerEventos();

  eventos = eventos.filter(item => item.id != id);

  guardarEventos(eventos);
  pintarTabla();
  limpiarFormulario();
  mostrarListado();

  mostrarMensaje(
    "Evento eliminado localmente. La base de datos todavía conserva el registro.",
    "warning"
  );
}


// INICIO DE LA PANTALLA

mostrarListado();
pintarTabla();