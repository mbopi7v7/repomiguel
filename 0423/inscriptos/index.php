<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Inscripciones.php";
include "../lib/Evento.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$inscripcion= new Inscripciones($con);
$eventos= new Evento($con);    
if (isset($_GET['id'])) {
    $rs=$inscripcion->getByEventoID($_GET['id']);
    $ev=$eventos->getByID($_GET['id']);
    $evento=$ev->fetch_assoc();
    $ev_id=$_GET['id'];
} 
//$rs=$inscripcion->getALL();
?>
<?php include_once '../partials/template_start.php'; ?>
             
<h3>   
<?php 
//echo "Bienvenidos ".$nombre."!!! ".$valor;
?>    
</h3>
  <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 1) {
      echo "<p style='color:green;'> Inscripción correctamente.</p>";
  }
  ?>
  <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 2) {
      echo "<p style='color:green;'>Inscripción actualizada correctamente.</p>";
  }
  ?>
    <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 3) {
      echo "<p style='color:green;'>Inscripción eliminada correctamente.</p>";
  }
  ?>
  <?php 
  if (isset($_GET['error']) && $_GET['error'] == 3) {
      echo "<p style='color:red;'>Error al eliminar el evento.</p>";
  }
  ?>
  <div>
    <h3>Charla: <?php echo $evento['titulo']; ?></h3>
    <h4>Fecha: <?php echo $evento['fecha']; ?></h4>
    <h4>Lugar: <?php echo $evento['lugar']; ?></h4>
  </div>  

<table class="table table-striped ">
<tr>
    <th>Apellido</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Estado</th>
    <th>Presente</th>
    <th>Fecha Inscripcion</th>
    <th >
        <a href="nuevo.php?evento_id=<?php echo $ev_id; ?>" class="btn btn-outline-primary">Nuevo</a>
     </th>
        <th colspan="2">   
        <a href="../eventos/index.php" class="btn btn-outline-secondary">Volver a Eventos</a>
    </th>
</tr>
</tr>

<?php 
while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya fila en el array asociativo
    { ?>
       
<tr>
    <td> <?php echo $fila["apellido"]; ?></td>
    <td> <?php echo $fila["nombre"]; ?></td>
    <td> <?php echo $fila["mail"]; ?></td>
    <td> <?php echo $fila["estado"]; ?></td>
    <td> <?php echo $fila["checkin"]; ?></td>
    <td> <?php echo $fila["fecha_inscripcion"]; ?></td>
    <td ><a href="editar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-warning">Editar</a></td>
    <td ><a href="borrar.php?id=<?php echo $fila["id"]; ?>&evento_id=<?php echo $ev_id; ?>" class="btn btn-outline-danger">Borrar</a></td>

</tr>

<?php     }
?>

</table>

<?php include_once '../partials/template_end.php'; ?>  