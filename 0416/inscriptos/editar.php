<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
include "../lib/Usuario.php";
include "../lib/Inscripciones.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
if (isset($_GET['evento_id'])) {
    $ev_id=$_GET['evento_id'];
    $eventos= new Evento($con); 
    $usuario= new Usuario($con);
    $evento=$eventos->getByID($ev_id);
    $ev=$evento->fetch_assoc();
    $usuarios=$usuario->getALL();
    $inscripcion= new Inscripciones($con);
     $ins=$inscripcion->getByID($_GET['id']);
     $fila=$ins->fetch_assoc();
    //$us=$usuarios->fetch_assoc();
}

$target="actualizar.php";
$titulo_form="Editar Inscripto - ".$ev['titulo'];   
?>
<?php include_once '../partials/template_start.php';

include "_form.php";
include_once '../partials/template_end.php';
 ?>