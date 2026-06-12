console.log("cargo el api.js");
const URL_EVENTOS = "/../../eventos/api.php";

function cargarDatos()
{
console.log('DesCargando datos del BACKEND desde cargarDatos');
fetch('URL_EVENTOS')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        localStorage.setItem('eventos_data', JSON.stringify(data.data));
        localStorage.setItem('eventos_count', JSON.stringify(data.total));
    });
}
function guardarEventoServidor(datos) {
  datos.append("action", "guardar");

  return fetch(URL_EVENTOS, {
    method: "POST",
    body: datos
  }).then(res => res.json());
}

function actualizarEventoServidor(datos) {
  datos.append("action", "actualizar");

  return fetch(URL_EVENTOS, {
    method: "POST",
    body: datos
  }).then(res => res.json());
}

function eliminarEventoServidor(id) {
  const datos = new FormData();

  datos.append("action", "eliminar");
  datos.append("id", id);

  return fetch(URL_EVENTOS, {
    method: "POST",
    body: datos
  }).then(res => res.json());
}