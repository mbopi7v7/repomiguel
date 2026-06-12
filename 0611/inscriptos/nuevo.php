<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Usuario.php";
//include "../lib/Inscripciones.php";
include "../lib/Evento.php";
$db = new Conex(); //creamos la conexion (instanciamos)

$con = $db->conectar(); // conectamos a la db
$eventos = new Evento($con);
$usuarios = new Usuario($con);
//$inscripciones = new Inscripciones($con);
$ev=$eventos->getByID($_GET['evento_id'])->fetch_assoc();
$us=$usuarios->getAll();
$modo="nuevo";
$target="guardar.php";
$titulo_form="Registrar Inscripción para el evento: ".$ev['titulo'];   
$evento_id = $_GET['evento_id'];


$fila = [
    "id" => "",
    "usuario_id" => "",
    "evento_id" => $evento_id,
    "estado" => "0",
    "checkin" => "0",
    "observacion" => "",
    "fecha_inscripcion" => "",
    "fecha_checkin" => "",
];

include_once '../partials/template_start.php'; 
include "_form.php";
include_once '../partials/template_end.php';

?>