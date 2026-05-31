console.log('Hola Mundo!');
const nombreEvento="Charla de JavaScript + IA";
console.log(`Bienvenidos a la ${nombreEvento}`);
let asistentes=100;
console.log(`Número de asistentes: ${asistentes}`);
asistentes='Cien';
console.log(`Número de asistentes después de agregar más: ${asistentes}`);
inputNombre=document.getElementById('nombre');
//console.log(`Valor del input: ${inputNombre.value}`);
inputNombre.value='Carlos García';
const mensaje=document.getElementById('mensaje');
mensaje.innerHTML='<b style="color: green;">Datos cargados correctamente</b>';
inputNombre.style.border='2px solid red';
let lista=['JavaScript', 'HTML', 'CSS'];
let contenido="";
lista.forEach((item)=>{
    contenido+=`<li class="item">${item}</li>`;
});
const listaElement=document.getElementById('lista');
listaElement.innerHTML=contenido;
/*
let itemLista=document.getElementsByClassName('.item');
itemLista.forEach((item)=>{
    item.style.color='blue';
}); */
const btenviar=document.getElementById('enviar');
btenviar.addEventListener('click',()=>{
    alert(`¡Gracias por participar`);
}); 

inputNombre.addEventListener('input',()=>{
    console.log(`Valor del input: ${inputNombre.value}`);
    mensaje.innerHTML=`<b style="color: blue;">Valor del input: ${inputNombre.value}</b>`;
});
inputNombre.addEventListener('blur',(e)=>{
    console.log(`Salio del input`);
    console.log(e.target.id);
    if(e.target.value.trim()===''){
        mensaje.innerHTML=`<b style="color: red;">El campo no puede estar vacío</b>`;
        inputNombre.style.border='2px solid red';
        //inputNombre.focus();
    }
});
const form=document.getElementById('formulario');
form.addEventListener('submit',(e)=>{
    e.preventDefault();
    console.log(`Formulario enviado`);
    mensaje.innerHTML=`<b style="color: green;">Formulario enviado correctamente</b>`;
    if (inputNombre.value.trim()===''){
        mensaje.innerHTML=`<b style="color: red;">El campo no puede estar vacío</b>`;
        inputNombre.style.border='2px solid red';
        inputNombre.focus();
        return;
    } else {
    e.target.submit(); }
});