<?php
include "../lib/conex.php"; // incluimos clase de conexion
include "../lib/Evento.php";
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
//$sql="select * from eventos"; // creamos una consulta 
//$rs=$con->query($sql); // ejecutamos la consulta
$evento= new Evento($con);
$rs=$evento->getALL();
?>
<html>
<body>
<h3>
<?php
$nombre="pepe";
$valor=1000;
$valor=" no sé" ;
echo "Bienvenidos ".$nombre."!!! ".$valor;
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
<table border="1">
<tr>
    <td>id</td>
    <td>titulo</td>
    <td>lugar</td>
    <td>fecha</td>
    <td>hora</td>
    <td>Activo</td>
    <td colspan="2"><a href="nuevo.php">Nuevo</a></td>
</tr>
</tr>

<?php 
while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya fila en el array asociativo
    { ?>
       
<tr>
    <td> <?php echo $fila["id"]; ?></td>
    <td> <?php echo $fila["titulo"]; ?></td>
    <td> <?php echo $fila["lugar"]; ?></td>
    <td> <?php echo $fila["hora"]; ?></td>
    <td> <?php echo $fila["fecha"]; ?></td>
    <td> <?php if($fila["activo"]) { echo "Si"; } else { echo "NO";} ?></td>
    <td ><a href="editar.php?id=<?php echo $fila["id"]; ?>">Editar</a></td>
    <td ><a href="borrar.php?id=<?php echo $fila["id"]; ?>">Borrar</a></td>

</tr>

<?php     }
?>

</table>

</body>


</html>