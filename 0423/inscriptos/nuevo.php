<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
include "../lib/Usuario.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
     

  
if (isset($_GET['evento_id'])) {
    $ev_id=$_GET['evento_id'];
    $eventos= new Evento($con); 
    $usuario= new Usuario($con);
    $evento=$eventos->getByID($ev_id);
    $ev=$evento->fetch_assoc();
    $usuarios=$usuario->getALL();
    //$us=$usuarios->fetch_assoc();
}
$fila = [
    "id" => "",
    "evento_id" => $ev_id,
    "usuario_id" => "",
    "estado" => "0",
    "checkin" => "0",
    "observacion" => "",
    "fecha_checkin" => null,
    "fecha_inscripcion" => ""
];
$accion="nuevo";
$target="guardar.php";
$titulo_form="Registrar Inscripto - ".$ev['titulo']; 
include_once '../partials/template_start.php'; 
include "_form.php";
include_once '../partials/template_end.php';

?>