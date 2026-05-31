<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Usuario.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$usuario= new Usuario($con);
$rs=$usuario->getALL();
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
    <th>Doc</th>
    <th>Apellido</th>
    <th>Fecha</th>
    <th>Telefono</th>
    
    <th>Mail</th>
    <th>Admin</th>
    <th colspan="2"><a href="nuevo.php" class="btn btn-outline-primary">Nuevo</a></th>
</tr>
</tr>

<?php 
while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya fila en el array asociativo
    { ?>
       
<tr>
    <td> <?php echo $fila["doc"]; ?></td>
    <td> <?php echo $fila["apellido"].', '.$fila["nombre"]; ?></td>
    <td> <?php echo $fila["fenac"]; ?></td>
    <td> <?php echo $fila["telefono"]; ?></td>
    <td> <?php echo $fila["mail"]; ?></td>
    <td> <?php if($fila["esadmin"]) { echo "Si"; } else { echo "NO";} ?></td>
    <td ><a href="editar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-warning">Editar</a></td>
    <td ><a href="borrar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-danger">Borrar</a></td>

</tr>

<?php     }
?>

</table>

<?php include_once '../partials/template_end.php'; ?>  