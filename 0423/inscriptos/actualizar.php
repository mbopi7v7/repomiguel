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
    if ($datos->getUsuarioId($_POST['id']) != $_POST['usuario_id']) {
        $errores[] = "El NO DEBE SER CAMBIADO.";
    }
    if (empty($_POST['usuario_id'])) {
        $errores[] = "El usuario es obligatorio.";
    }
        if (empty($_POST['evento_id']) || strlen($_POST['evento_id']) > 100) {
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
            if ($_POST['checkin'] == 1 && empty($_POST['fecha_checkin'])) {
                $_POST['fecha_checkin'] = date("Y-m-d H:i:s");
            } elseif ($_POST['checkin'] == 0) {
                $_POST['fecha_checkin'] = '0000-00-00 00:00:00';
            }
            $rs=$datos->update($_POST);
        header("Location: index.php?ok=1&id=".$_POST['evento_id']);
    } else {
    header("Location: editar.php?error=2&id=".$_POST['id']);
        //print_r($errores);
    }
    }
