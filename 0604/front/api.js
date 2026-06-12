console.log("cargo el api.js");

function cargarDatos()
{
console.log('DesCargando datos del BACKEND desde cargarDatos');
fetch('http://localhost:8080/0521/eventos/api.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        localStorage.setItem('eventos_data', JSON.stringify(data.data));
        localStorage.setItem('eventos_count', JSON.stringify(data.total));
    });
}
