<?php
$target="guardar.php";
$titulo_form="Registrar Evento";   

$fila = [
    "id" => "",
    "nombre" => "",
    "apellido" => "",
    "mail" => "",
    "telefono" => "",
        "doc" => "",
    "fenac" => "",
        "direccion" => "",
        "contrasena" => "",
    "esadmin" => 0
];

include_once '../partials/template_start.php'; 
include "_form.php";
include_once '../partials/template_end.php';

?>