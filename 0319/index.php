<?php
include "lib/conex.php"; // incluimos clase de conexion
$db=new Conex(); //creamos la conexion (instanciamos)
$con=$db->conectar(); // conectamos a la db
$sql="select * from eventos"; // creamos una consulta 
$rs=$con->query($sql); // ejecutamos la consulta
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

<table border="1">
<tr>
    <td>id</td>
    <td>titulo</td>
    <td>lugar</td>
    <td>fecha</td>
    <td>hora</td>
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
</tr>

<?php     }
?>

</table>

</body>


</html>