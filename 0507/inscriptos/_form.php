 <h2><?php echo $titulo_form; ?></h2>
<?php 
  if (isset($_GET['error']) && $_GET['error'] == 1) {
      echo "<p style='color:red;'>Error al insertar datos del evento.</p>";
  }
  //$target="guardar.php";
  ?>
  <?php 
  if (isset($_GET['error']) && $_GET['error'] == 1) {
      echo "<p style='color:red;'>Error al actualizar el evento.</p>";
  }
  ?>
MODNO nuevo
// Modo EDICION

  <form action="<?php echo $target; ?>" method="post">
    <!-- Campo oculto para id (AUTO_INCREMENT, no se carga manualmente) -->
    <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
    <input type="hidden" name="evento_id" value="<?php echo $fila["evento_id"]; ?>">

    <label for="inscripto">Inscripto:</label><br>
    <?php
    if ($modo == "nuevo") {
        echo '<select id="usuario_id" name="usuario_id" required class="form-control">';
        while ($us_fila = $us->fetch_assoc()) {
            echo '<option value="' . $us_fila["id"] . '">' . $us_fila["apellido"] . ', ' . $us_fila["nombre"] . '</option>';
        }
        echo '</select><br><br>';
    } else { 
        echo "<span class='form-control'>" . $us_fila["apellido"] . ", " . $us_fila["nombre"] . "</span><br><br>";
      ?>
        <input type="hidden" value="<?php echo $fila["usuario_id"]; ?>" id="usuario_id" name="usuario_id" required class="form-control" readonly>
    <?php } 
    ?>
    <label for="estado">Estado:</label><br>
    <select id="estado" name="estado" required class="form-control">
      <option value="0" <?php echo ($fila["estado"] == 0) ? "selected" : ""; ?>>Pendiente</option>
      <option value="1" <?php echo ($fila["estado"] == 1) ? "selected" : ""; ?>>Aceptado</option>
      <option value="2" <?php echo ($fila["estado"] == 2) ? "selected" : ""; ?>>Rechazado</option>
    </select> <br>
    
      <?php
    if ($modo == "edicion") {
        ?>
    <label for="checkin">Presente:</label><br>    
    <select id="checkin" name="checkin" required class="form-control">
      <option value="0" <?php echo ($fila["checkin"] == 0) ? "selected" : ""; ?>>No</option>
      <option value="1" <?php echo ($fila["checkin"] == 1) ? "selected" : ""; ?>>Sí</option>
    </select>
    <?php
    } else { ?>
    <input type="hidden" value="<?php echo ($fila["checkin"]); ?>" id="checkin" name="checkin" required class="form-control">
    <?php } ?>
    <br>
    <label for="observacion">Observación:</label><br>
    <textarea id="observacion" name="observacion" class="form-control"><?php echo $fila["observacion"]; ?></textarea><br><br>
    <?php
    if ($modo == "edicion") {
        ?>
        <label for="fecha_inscripcion">Fecha de Inscripcion:</label><br>
        <input type="hidden" value='<?php echo $fila["fecha_inscripcion"]; ?>' id="fecha_inscripcion" name="fecha_inscripcion" required class="form-control">
        <span class="form-control" ><?php echo $fila["fecha_inscripcion"]; ?></span>
        <br><br>
        
        <label for="fecha_checkin">Fecha de Asistencia:</label><br>
        <input type="hidden" value='<?php echo $fila["fecha_checkin"]; ?>' id="fecha_checkin" name="fecha_checkin" required class="form-control"><br><br> 
                <span class="form-control" ><?php echo $fila["fecha_checkin"]; ?></span>
        <?php
    }
    ?>


<br><br>

    <a href="index.php?id=<?php echo $fila["evento_id"]; ?>" class="btn btn-outline-secondary">Volver al listado</a>
    <input type="submit" value="Guardar" class="btn btn-outline-success">
</form>