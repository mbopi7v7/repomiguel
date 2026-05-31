 <h2><?php echo $titulo_form; ?> </h2>
 <?php

  if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<p style='color:red;'>Error al insertar datos del evento.</p>";
  }
  //$target="guardar.php";
  ?>
 <?php
  if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo "<p style='color:red;'>Error al actualizar el evento.</p>";
  }
  ?>

 <form action="<?php echo $target; ?>" method="post">
   <!-- Campo oculto para id (AUTO_INCREMENT, no se carga manualmente) -->
   <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
   <input type="hidden" name="evento_id" value="<?php echo $fila["evento_id"]; ?>">
   <input type="hidden" value='<?php echo $fila["fecha_inscripcion"]; ?>' id="fecha_inscripcion" name="fecha_inscripcion" required class="form-control"><br><br>
   <input type="hidden" value='<?php echo $fila["fecha_checkin"]; ?>' id="fecha_checkin" name="fecha_checkin" required class="form-control"><br><br>
   <label for="usuario_id">Usuario:</label><br>
   <?php if ($accion == "nuevo") { ?>
     <select id="usuario_id" name="usuario_id" required class="form-control">
       <?php while ($us = $usuarios->fetch_assoc()) { ?>
         <option value="<?php echo $us["id"]; ?>"
           <?php echo ($fila["usuario_id"] == $us["id"]) ? "selected" : ""; ?>><?php echo $us["apellido"] . ", " . $us["nombre"]; ?>
         </option>
       <?php } ?>
     </select><br>
   <?php  } else { ?>
     <input type="hidden" id="usuario_id" name="usuario_id" required class="form-control" value="<?php echo $fila["usuario_id"]; ?>">
     <span class="form-control" ><?php echo $us["apellido"] . ", " . $us["nombre"]; ?></span><br>
   <?php } ?>
   <?php if ($accion == "editar") { ?>
     <label for="estado">Estado Inscripción:</label><br>
     <select id="estado" name="estado" required class="form-control">
       <option value="0" <?php echo ($fila["estado"] == 0) ? "selected" : ""; ?>>Pendiente</option>
       <option value="1" <?php echo ($fila["estado"] == 1) ? "selected" : ""; ?>>Aceptado</option>
       <option value="2" <?php echo ($fila["estado"] == 2) ? "selected" : ""; ?>>Cancelado</option>
     </select><br>

     <label for="checkin">Presente:</label><br>
     <select id="checkin" name="checkin" required class="form-control">
       <option value="0" <?php echo ($fila["checkin"] == 0) ? "selected" : ""; ?>>Ausente</option>
       <option value="0" <?php echo ($fila["checkin"] == 1) ? "selected" : ""; ?>>Presente</option>
     </select><br>
   <?php } else { ?>
     <input type="hidden" name="estado" value="<?php echo $fila["estado"]; ?>">
     <input type="hidden" name="checkin" value="<?php echo $fila["checkin"]; ?>">
   <?php } ?>
   <label for="observacion">Observación:</label><br>
   <?php //echo $fila["observacion"]; 
    ?>
   <textarea name="observacion" id="observacion" class="form-control" rows="3"><?php echo $fila["observacion"]; ?></textarea><br>
   <?php if ($fila["fecha_inscripcion"] != "") { ?>
     <p>Fecha de inscripción: <br> <span class="form-control"><?php echo $fila["fecha_inscripcion"]; ?></span></p>
   <?php } ?>
   <?php if ($fila["fecha_checkin"] != "") { ?>
     <p>Fecha de check-in: <br> <span class="form-control"><?php echo $fila["fecha_checkin"]; ?></span></p>
   <?php } ?>
   <a href="index.php?id=<?php echo $ev_id; ?>" class="btn btn-outline-secondary">Volver al listado</a>
   <input type="submit" value="Guardar" class="btn btn-outline-success">
 </form>