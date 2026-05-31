<?php
$target="guardar.php";
$titulo_form="Registrar Evento";   

$fila = [
    "id" => "",
    "titulo" => "",
    "fecha" => "",
    "hora" => "",
    "lugar" => "",
    "activo" => 1
];

include_once '../partials/template_start.php'; 
include "_form.php";
include_once '../partials/template_end.php';

?>