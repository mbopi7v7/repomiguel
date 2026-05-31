//$fila= $rs->fetch_assoc()
<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$evento= new Evento($con);
if (isset($_GET['id']))
     {
    $rs=$evento->getByID($_GET['id']);
    $fila= $rs->fetch_assoc();
     }   
$target="actualizar.php";
$titulo_form="Editar Evento";   
include "_form.php";

?>