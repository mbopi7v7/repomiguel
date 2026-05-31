<?php
header('Content-Type: application/json');
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
include "../lib/Inscripciones.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$evento= new Evento($con);
$inscripcion= new Inscripciones($con);
// getById id= $_GET['id']
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $rs = $evento->getById($id);
} else { // getAll
    $rs = $evento->getALL();
}
if (isset($_GET['inscripcion']) && ($_GET['inscripcion']==1)) 
    {
    $conInscripcion=true;
    } else { 
    $conInscripcion=false;
    }

$datos=[];
while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya
{
    if ($conInscripcion) {
        $rsIns=$inscripcion->getByEventoID($fila['id']);
        $lista=[];
        while ($filaIns= $rsIns->fetch_assoc()) {
            $lista[]=$filaIns;
            }
        $fila['inscriptos']=$lista;
        $fila['total_inscriptos']=count($lista);
    }
    $datos[]=$fila;
}
$respuesta=[
    "status"=>"success",
    "data"=>$datos,
    "total"=>count($datos)
];

echo json_encode($respuesta);
?>
