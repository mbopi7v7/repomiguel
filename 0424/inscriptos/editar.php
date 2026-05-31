<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Usuario.php";
include "../lib/Inscripciones.php";
include "../lib/Evento.php";
$db = new Conex(); //creamos la conexion (instanciamos)

$con = $db->conectar(); // conectamos a la db
$eventos = new Evento($con);
$usuarios = new Usuario($con);
$dato = new Inscripciones($con);
$fila=$dato->getByID($_GET['id'])->fetch_assoc(); 
//print_r($fila);
$ev=$eventos->getByID($fila['evento_id'])->fetch_assoc();
$us_fila=$usuarios->getByID($fila['usuario_id'])->fetch_assoc();
$us=$usuarios->getAll();
$modo="edicion";
$target="actualizar.php";
$titulo_form="Editar Inscripción para el evento: ".$ev['titulo']; 

?>
<?php include_once '../partials/template_start.php';

include "_form.php";
include_once '../partials/template_end.php';
 ?>