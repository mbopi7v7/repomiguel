<?php
header('Content-Type: application/json');

include "../lib/conex.php";
include "../lib/Evento.php";
include "../lib/Inscripciones.php";

$db = new Conex();
$con = $db->conectar();

$evento = new Evento($con);
$inscripcion = new Inscripciones($con);

function responderJSON($respuesta) {
    echo json_encode($respuesta);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $rs = $evento->getByID($_GET['id']);
    } else {
        $rs = $evento->getALL();
    }

    if (isset($_GET['inscripcion']) && ($_GET['inscripcion'] == 1)) {
        $conInscripcion = true;
    } else {
        $conInscripcion = false;
    }

    $datos = [];

    while ($fila = $rs->fetch_assoc()) {

        if ($conInscripcion) {
            $rsIns = $inscripcion->getByEventoID($fila['id']);
            $lista = [];

            while ($filaIns = $rsIns->fetch_assoc()) {
                $lista[] = $filaIns;
            }

            $fila['inscriptos'] = $lista;
            $fila['total_inscriptos'] = count($lista);
        }

        $datos[] = $fila;
    }

    responderJSON([
        "status" => "success",
        "data" => $datos,
        "total" => count($datos)
    ]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST["action"] ?? "";

    if ($action == "guardar") {

        $errores = $evento->validarDatos($_POST, false);

        if (!empty($errores)) {
            responderJSON([
                "status" => "error",
                "msg" => "Datos inválidos.",
                "errores" => $errores
            ]);
        }

        $rs = $evento->insert($_POST);

        if ($rs) {
            responderJSON([
                "status" => "success",
                "msg" => "Evento guardado correctamente.",
                "data" => null
            ]);
        } else {
            responderJSON([
                "status" => "error",
                "msg" => "No se pudo guardar el evento."
            ]);
        }
    }

    if ($action == "actualizar") {

        $errores = $evento->validarDatos($_POST, true);

        if (!empty($errores)) {
            responderJSON([
                "status" => "error",
                "msg" => "Datos inválidos.",
                "errores" => $errores
            ]);
        }

        $rs = $evento->update($_POST);

        if ($rs) {
            responderJSON([
                "status" => "success",
                "msg" => "Evento actualizado correctamente.",
                "data" => null
            ]);
        } else {
            responderJSON([
                "status" => "error",
                "msg" => "No se pudo actualizar el evento."
            ]);
        }
    }

    if ($action == "eliminar") {

        if (empty($_POST["id"])) {
            responderJSON([
                "status" => "error",
                "msg" => "El id del evento es obligatorio para eliminar."
            ]);
        }

        $rs = $evento->delete($_POST["id"]);

        if ($rs) {
            responderJSON([
                "status" => "success",
                "msg" => "Evento eliminado correctamente.",
                "data" => null
            ]);
        } else {
            responderJSON([
                "status" => "error",
                "msg" => "No se pudo eliminar el evento."
            ]);
        }
    }

    responderJSON([
        "status" => "error",
        "msg" => "Acción no válida."
    ]);
}

responderJSON([
    "status" => "error",
    "msg" => "Método no permitido."
]);
?>