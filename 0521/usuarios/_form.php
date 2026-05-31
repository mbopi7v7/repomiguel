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

  <form action="<?php echo $target; ?>" method="post">
    <!-- Campo oculto para id (AUTO_INCREMENT, no se carga manualmente) -->
    <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">

    <label for="apellido">Apellido:</label><br>
    <input type="text" value='<?php echo $fila["apellido"]; ?>' id="apellido" name="apellido" maxlength="100" required class="form-control"><br><br>

    <label for="nombre">Nombre:</label><br>
    <input type="text" value='<?php echo $fila["nombre"]; ?>' id="nombre" name="nombre" maxlength="100" required class="form-control"><br><br>

    <label for="fenac">Fecha de nacimiento:</label><br>
    <input type="date" value='<?php echo $fila["fenac"]; ?>' id="fenac" name="fenac" required class="form-control"><br><br>

    <label for="doc">Documento:</label><br>
    <input type="text" value='<?php echo $fila["doc"]; ?>' id="doc" name="doc" maxlength="191" required class="form-control"><br><br>

    <label for="mail">Correo electrónico:</label><br>
    <input type="email" value='<?php echo $fila["mail"]; ?>' id="mail" name="mail" maxlength="191" required class="form-control"><br><br>

    <label for="telefono">Teléfono:</label><br>
    <input type="text" value='<?php echo $fila["telefono"]; ?>' id="telefono" name="telefono" maxlength="191" class="form-control"><br><br>

    <label for="direccion">Dirección:</label><br>
    <textarea id="direccion" name="direccion" class="form-control" required><?php echo $fila["direccion"]; ?></textarea><br><br>

    <label for="contrasena">Contraseña:</label><br>
    <input type="password" value='<?php echo $fila["contrasena"]; ?>' id="contrasena" name="contrasena" maxlength="191" required class="form-control"><br><br>

    <label for="esadmin">Es administrador:</label><br>
    <select id="esadmin" name="esadmin" required class="form-control">
      <option value="1" <?php echo ($fila["esadmin"] == 1) ? "selected" : ""; ?>>Sí</option>
      <option value="0" <?php echo ($fila["esadmin"] == 0) ? "selected" : ""; ?>>No</option>
    </select><br><br>

    <a href="index.php" class="btn btn-outline-secondary">Volver al listado</a>
    <input type="submit" value="Guardar" class="btn btn-outline-success">
</form>