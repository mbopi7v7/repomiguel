<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Usuario.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$datos= new Usuario($con);
$errores = [];
// $_REQUEST $_GET $_POST
 if(isset($_POST)) {
    //print_r($_POST);
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



    if (!empty($_POST['direccion']) && strlen($_POST['direccion']) > 191) {
        $errores[] = "El lugar no debe superar 191 caracteres.";
    }


    if (!in_array($_POST['esadmin'], [0,1])) {
        $errores[] = "El campo administrador debe ser 0 o 1.";
    }
    // Si hay errores, mostrarlos
    if (empty($errores)) {

            $rs=$datos->insert($_POST);
        header("Location: index.php?ok=1");
    } else {
        //header("Location: nuevo.php?error=1");
        print_r($errores);
    }
    }


?>