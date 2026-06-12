<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Inscripciones.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$inscripciones= new Inscripciones($con);
$rs=$inscripciones->getByEventoID($_GET['id']);
?>
<?php include_once '../partials/template_start.php'; ?>
             
<h3>   
<?php 
//echo "Bienvenidos ".$nombre."!!! ".$valor;
?>    
</h3>
  <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 1) {
      echo "<p style='color:green;'>Evento insertado correctamente.</p>";
  }
  ?>
  <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 2) {
      echo "<p style='color:green;'>Evento actualizado correctamente.</p>";
  }
  ?>
    <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 3) {
      echo "<p style='color:green;'>Evento eliminado correctamente.</p>";
  }
  ?>
  <?php 
  if (isset($_GET['error']) && $_GET['error'] == 3) {
      echo "<p style='color:red;'>Error al eliminar el evento.</p>";
  }
  ?>
<table class="table table-striped ">
<tr>
    <th>Documento</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Estado</th>
    <th>Presente</th>
    <th><a href="../eventos/" class="btn btn-outline-secondary">Volver a Eventos</a></th>
    <th><a href="nuevo.php?evento_id=<?php echo $_GET['id']; ?>" class="btn btn-outline-primary">Nuevo</a></th>
</tr>
</tr>

<?php 
while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya fila en el array asociativo
    { ?>
       
<tr>
    <td> <?php echo $fila["doc"]; ?></td>
    <td> <?php echo $fila["apellido"].', '.$fila["nombre"]; ?></td>
    <td> <?php echo $fila["mail"]; ?></td>
    <td> <?php 
    switch($fila['estado']) {
        case 0: 
            echo '<i class="bi bi-clock-history text-warning" title="Pendiente"></i>Pendiente'; 
            break;
        case 1: 
            echo '<i class="bi bi-check-circle-fill text-success" title="Aceptado"></i>Aceptado'; 
            break;
        case 2: 
            echo '<i class="bi bi-x-circle-fill text-danger" title="Rechazado"></i>Rechazado'; 
            break;
    }
    ?></td>
    <td><?php if($fila['checkin'] == 1): ?>
        <i class="bi bi-person-check-fill text-primary" style="font-size: 1.2rem;"></i>
    <?php else: ?>
        <i class="bi bi-person-x text-muted" style="opacity: 0.5;"></i>
    <?php endif; ?></td>
    <td ><a href="editar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-warning">Editar</a></td>
    <td ><a href="borrar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-danger">Borrar</a></td>

</tr>

<?php     }
?>

</table>

<?php include_once '../partials/template_end.php'; ?>  