<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
$db = new Conex(); //creamos la conexion (instanciamos)
$con = $db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$evento = new Evento($con);

// $_REQUEST $_GET $_POST
if (isset($_POST)) {
    //print_r($_POST);
    // Validaciones
    if (empty($_POST['titulo']) || strlen($_POST['titulo']) > 100) {
        $errores[] = "El título es obligatorio y no debe superar 100 caracteres.";
    }

    if (empty($_POST['fecha'])) {
        $errores[] = "La fecha es obligatoria.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['fecha'])) {
        $errores[] = "La fecha debe tener formato YYYY-MM-DD.";
    }

    if (!empty($_POST['hora']) && !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $_POST['hora'])) {
        $errores[] = "La hora debe tener formato HH:MM o HH:MM:SS.";
    }

    if (!empty($_POST['lugar']) && strlen($_POST['lugar']) > 191) {
        $errores[] = "El lugar no debe superar 191 caracteres.";
    }

    if (!in_array($_POST['activo'], [0, 1])) {
        $errores[] = "El campo activo debe ser 0 o 1.";
    }
    // Si hay errores, mostrarlos
    if (empty($errores)) {
        /* foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        } */
        $rs = $evento->update($_POST);
        header("Location: index.php?ok=2");
    } else {
        header("Location: editar.php?id=" . $_POST['id'] . "&error=2");
    }


    exit();
} else {
    echo "No llegaron valores por POST";
}
