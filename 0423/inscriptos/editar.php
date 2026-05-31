<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
include "../lib/Usuario.php";
include "../lib/Inscripciones.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
if (isset($_GET['id'])) {
    //$ev_id=$_GET['evento_id'];
    $eventos= new Evento($con); 
    $usuario= new Usuario($con);
    $usuarios=$usuario->getALL();
    $inscripcion= new Inscripciones($con);
     $ins=$inscripcion->getByID($_GET['id']);
    // echo "ID: ".$ins->num_rows();
     $fila=$ins->fetch_assoc();
    $evento=$eventos->getByID($fila['evento_id']);
    $ev=$evento->fetch_assoc();
   // print_r($fila);
    $ev_id=$fila["evento_id"];
     $usuario=$usuario->getByID($fila['usuario_id']);
     $us=$usuario->fetch_assoc();
    //$us=$usuarios->fetch_assoc();
}
$accion="editar";
$target="actualizar.php";
$titulo_form="Editar Inscripto - ".$ev['titulo'];   
?>
<?php include_once '../partials/template_start.php';

include "_form.php";
include_once '../partials/template_end.php';
 ?>