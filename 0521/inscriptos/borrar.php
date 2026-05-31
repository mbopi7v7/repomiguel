<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Inscripciones.php";
$db = new Conex(); //creamos la conexion (instanciamos)
$con = $db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$datos = new Inscripciones($con);
$fila = $datos->getByID($_GET['id'])->fetch_assoc();
//print_r($fila);

if (isset($_GET['id'])) {
     if($rs = $datos->delete($_GET['id'])) 
        { ;
        header("Location: index.php?ok=3&id=".$fila['evento_id']);
        exit(); 
        } else {
            header("Location: index.php?error=3&id=".$fila['evento_id']);
            exit();
        }
} else {
    echo "No se recibió un ID válido para eliminar.";
    header("Location: index.php?error=3&id=".$fila['evento_id']);
    exit();
}
