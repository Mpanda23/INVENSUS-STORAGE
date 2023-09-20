<?php
require "../modelo/conexionBD.php";
require "../modelo/claseUsuario.php";

$objConexion = Conectarse();

$sqlSexo = "SELECT idsexo, sexo_tipo from sexo";
$sqlRoles = "SELECT idroles, rol_nombre from roles";

$resultadoSexo = $objConexion->query($sqlSexo);
$resultadoRoles = $objConexion->query($sqlRoles);

$usuario = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["idusuarios"])) {
    $idusuarios = $_GET["idusuarios"];
    $objUsuario = new Usuario();
    $objUsuario->setidusuarios($idusuarios);
    $resultadoConsulta = $objUsuario->consultarUsuario();

    if ($resultadoConsulta && $resultadoConsulta->num_rows > 0) {
        $usuario = $resultadoConsulta->fetch_assoc();
    } else {
        echo "No se encontraron registros para el id proporcionado.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idusuarios"]) && isset($_POST["usu_nombre"]) && isset($_POST["usu_tipoid"]) && isset($_POST["usu_identificacion"]) && isset($_POST["usu_numerotel"]) && isset($_POST["usu_correo"]) && isset($_POST["usu_contrasena"]) && isset($_POST["usu_estado"]) && isset($_POST["idsexo"]) && isset($_POST["idroles"])) {
  $idusuarios = $_POST["idusuarios"];
  $usu_nombre = $_POST["usu_nombre"];
  $usu_tipoid = $_POST["usu_tipoid"];
  $usu_identificacion = $_POST["usu_identificacion"];
  $usu_numerotel = $_POST["usu_numerotel"];
  $usu_correo = $_POST["usu_correo"];
  $usu_contrasena = $_POST["usu_contrasena"];
  $usu_estado = $_POST["usu_estado"];
  $idsexo = $_POST["idsexo"];
  $idroles = $_POST["idroles"];

    $objUsuario = new Cita();
    $objUsuario->setidusuarios($idusuarios);
    $objUsuario->setusu_nombre($usu_nombre);
    $objUsuario->setusu_tipoid($usu_tipoid);
    $objUsuario->setusu_identificacion($usu_identificacion);
    $objUsuario->setusu_numerotel($usu_numerotel);
    $objUsuario->setusu_correo($usu_correo);
    $objUsuario->setusu_contrasena($usu_contrasena);
    $objUsuario->setusu_estado($usu_estado);
    $objUsuario->setidsexo($idsexo);
    $objUsuario->setidroles($idroles);


    $resultadoActualizacion = $objUsuario->modificarUsuario();

    if ($resultadoActualizacion) {
        header("location: listarUsuarios.php?x=1"); // x=1 indica que se modificó correctamente
        exit;
    } else {
        header("location: listarUsuarios.php?x=2"); // x=2 indica que hubo un error en la modificación
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar usuarios</title>
    <link rel="stylesheet" href="../estilos/estilos-formularios.css">
    
</head>
<body> 
  <header>
    <nav class="container">
      <img src="../img/logo.jpg" alt="" height="60px" width="60px">
      <div class="links">
      <div class="links">
          <a href="listar-categorias-1.php" class="social-links">Categorias</a>
          <a href="listarUsuarios.php" class="social-links">Usuarios</a>
          <a href="listarProveedores.php" class="social-links">Proveedores</a>
          <a href="listarProductos.php" class="social-links">Productos</a>
          </div>
      </div>
    </nav>
  </header> 
  
  <div class="form">
    <a href="listarUsuarios.php" target="_blank" class="regreso">
      <img src="../img/volver.png" alt="">
    </a>

    <form action="validarActualizarUsuario.php" method="post" class="sub-form">
      <div class="upper-form">
      <h2>Actualizar de usuarios</h2>
      <br><input type="hidden" name="idusuarios" id="nombre"  value="<?php echo $usuario['idusuarios']; ?>"> <br>
      <input type="text" name="usu_nombre" id="nombre" placeholder="Nombre de usuario" value="<?php echo $usuario['usu_nombre']; ?>" required> <br>
      <select name="usu_tipoid" id="tipo" required>
    <option value="0">Seleccione el tipo de identificacion</option>
    <option value="Tarjeta Identidad" <?php echo ($usuario['usu_tipoid'] == 'Tarjeta Identidad') ? 'selected' : ''; ?>>Tarjeta Identidad</option>
    <option value="Cedula de Ciudadania" <?php echo ($usuario['usu_tipoid'] == 'Cedula de Ciudadania') ? 'selected' : ''; ?>>Cedula Ciudadania</option>
    <option value="Pasaporte" <?php echo ($usuario['usu_tipoid'] == 'Pasaporte') ? 'selected' : ''; ?>>Pasaporte</option>
    <option value="Cedula Extranjera" <?php echo ($usuario['usu_tipoid'] == 'Cedula Extranjera') ? 'selected' : ''; ?>>Cedula Extranjera</option>
</select><br>
<input type="number" name="usu_identificacion" placeholder="Numero de Identificacion" maxlength="10" value="<?php echo $usuario['usu_identificacion']; ?>" required> <br>
      <input type="number" name="usu_numerotel" placeholder="Numero telefonico" maxlength="10" value="<?php echo $usuario['usu_numerotel']; ?>" required> <br>
      <input type="email" name="usu_correo" placeholder="Correo personal" value="<?php echo $usuario['usu_correo']; ?>" required><br>
      <input type="password" name="usu_contrasena" placeholder="Contraseña" value="<?php echo $usuario['usu_contrasena']; ?>" required><br>
      <select name="usu_estado" id="estado" required>
        <option value="0">Seleccione el estado</option>
        <option value="Activo" <?php echo ($usuario['usu_estado'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
        <option value="Inactivo" <?php echo ($usuario['usu_estado'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
      </select><br>

      <select name="idsexo" id="sexo" required>
    <option value="">Seleccione el sexo de usuario</option>
      <?php
      while($sexo = $resultadoSexo->fetch_object()) {
      ?>
      <option value="<?php echo $sexo->idsexo ?>"><?php echo $sexo->sexo_tipo ?></option>
      <?php
      }
      ?>
    </select><br>

      <select name="idroles" id="roles" required>
        <option value="">Seleccione el rol de usuario</option>
        <?php
        while($roles = $resultadoRoles->fetch_object()) {
        ?>
        <option value="<?php echo $roles->idroles?>"><?php echo $roles->rol_nombre ?></option>
        <?php
        }
        ?>
      </select><br>
      <div class="boton">
        <button type="submit" name="button" id="actualizar" value="Actualizar" >Actualizar</button> <br> <br>
      </div>
    </div>
    </form>
  </div>
  <footer>
  <div class="icon">
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/instagram.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/twitter.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/tik-tok.png" alt="">
        </a>
      </div>
    <p class="texto-final">©Proyecto Sena Invensus Storage 2023</p>
</footer>
</body>
</html>