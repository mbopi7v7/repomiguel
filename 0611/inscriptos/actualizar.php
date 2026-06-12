<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Inscripciones.php";
$db = new Conex(); //creamos la conexion (instanciamos)
$con = $db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$datos = new Inscripciones($con);

// $_REQUEST $_GET $_POST
if(isset($_POST)) {
    //print_r($_POST);
   /*
    // Validaciones
    if (empty($_POST['nombre']) || strlen($_POST['nombre']) > 100) {
        $errores[] = "El nombre es obligatorio y no debe superar 100 caracteres.";
    }
        if (empty($_POST['apellido']) || strlen($_POST['apellido']) > 100) {
        $errores[] = "El apellido es obligatorio y no debe superar 100 caracteres.";
    }
        if (empty($_POST['doc']) || strlen($_POST['doc']) > 191) {
        $errores[] = "El número de documento es obligatorio y no debe superar 191 caracteres.";
    }
        if (empty($_POST['mail']) || strlen($_POST['mail']) > 191) {
        $errores[] = "El correo electrónico es obligatorio y no debe superar 191 caracteres.";
    }
    if (empty($_POST['fenac'])) {
        $errores[] = "La fecha es obligatoria.";
    } 
     if (empty($_POST['id'])) {
        $errores[] = "La id es obligatoria.";
    } 
    if (!empty($_POST['direccion']) && strlen($_POST['direccion']) > 191) {
        $errores[] = "El lugar no debe superar 191 caracteres.";
    }


    if (!in_array($_POST['esadmin'], [0,1])) {
        $errores[] = "El campo administrador debe ser 0 o 1.";
    }
    // Si hay errores, mostrarlos * *
*/
        $checkin = $_POST['checkin'];
        if ($checkin == 1) {
            $_POST['fecha_checkin'] ="'".date("Y-m-d H:i:s")."'";
        } else {
            $_POST['fecha_checkin'] = "NULL";
        }

    if (empty($errores)) {
        if($rs = $datos->update($_POST)) {
            header("Location: index.php?ok=2&id=".$_POST['evento_id']);
        } else {
            header("Location: editar.php?id=" . $_POST['id'] . "&error=1");
        }   
    } else {
        header("Location: editar.php?id=" . $_POST['id'] . "&error=2");     
    }


    exit();
} else {
    echo "No llegaron valores por POST";
}
