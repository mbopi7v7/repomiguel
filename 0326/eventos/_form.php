<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Eventos</title>
</head>
<body>

  <h2><?php echo $titulo_form; ?></h2>
<?php 
  if (isset($_GET['error']) && $_GET['error'] == 1) {
      echo "<p style='color:red;'>Error al insertar datos del evento.</p>";
  }
  $target="guardar.php";
  ?>
  <?php 
  if (isset($_GET['error']) && $_GET['error'] == 1) {
      echo "<p style='color:red;'>Error al actualizar el evento.</p>";
  }
  ?>

  <form action="<?php echo $target; ?>" method="post">
    <!-- Campo oculto para id (AUTO_INCREMENT, no se carga manualmente) -->
    <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
    
    <label for="titulo">Título:</label><br>
    <input type="text" value='<?php echo $fila["titulo"]; ?>' id="titulo" name="titulo" maxlength="100" required><br><br>
    
    <label for="fecha">Fecha:</label><br> 
    <input type="date" value='<?php echo $fila["fecha"]; ?>' id="fecha" name="fecha" required><br><br>
    
    <label for="hora">Hora:</label><br>
    <input type="time"  value='<?php echo $fila["hora"]; ?>' id="hora" name="hora"><br><br>
    
    <label for="lugar">Lugar:</label><br>
    <input type="text"  value='<?php echo $fila["lugar"]; ?>' id="lugar" name="lugar" maxlength="191"><br><br>
    
    <label for="activo">Activo:</label><br>
    <select id="activo" name="activo" required>
      <option value="1" <?php echo ($fila["activo"] == 1) ? "selected" : ""; ?>>Sí</option>
      <option value="0" <?php echo ($fila["activo"] == 0) ? "selected" : ""; ?>>No</option>
    </select><br><br>
    <a href="index.php">Volver al listado</a>
    <input type="submit" value="Guardar">
  </form>
</body>
</html>
