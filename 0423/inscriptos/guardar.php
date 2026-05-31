<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Inscripciones.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$datos= new Inscripciones($con);
$errores = [];
// $_REQUEST $_GET $_POST
 if(isset($_POST)) {
    //print_r($_POST);
   // Validaciones
   if ($datos->checkInscripto($_POST['evento_id'], $_POST['usuario_id']) > 0) {
        $errores[] = "El usuario ya está inscripto en este evento.";
    }
    if (empty($_POST['usuario_id'])) {
        $errores[] = "El usuario es obligatorio.";
    }
        if (empty($_POST['evento_id'])) {
        $errores[] = "El evento  es obligatorio ";
    }
     if (!in_array($_POST['estado'], [0,1,2])) {
        $errores[] = "El campo estado debe ser 0, 1 o 2.";
    }
     if (!in_array($_POST['checkin'], [0,1])) {
        $errores[] = "El campo check-in debe ser 0 o 1.";
    }
    // Si hay errores, mostrarlos
    if (empty($errores)) {
        $rs=$datos->insert($_POST);
        header("Location: index.php?ok=1&id=".$_POST['evento_id']);
    } else {
    header("Location: nuevo.php?evento_id=".$_POST['evento_id']."&error=1");
        print_r($errores);
    }
    }


?>