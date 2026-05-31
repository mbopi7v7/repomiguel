<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
$db = new Conex(); //creamos la conexion (instanciamos)
$con = $db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$evento = new Evento($con);
if (isset($_GET['id'])) {
     if($rs = $evento->delete($_GET['id'])) 
        { ;
        header("Location: index.php?ok=3");
        exit(); 
        } else {
            header("Location: index.php?error=3");
            exit();
        }
} else {
    echo "No se recibió un ID válido para eliminar.";
    header("Location: index.php?error=3");
    exit();
}
