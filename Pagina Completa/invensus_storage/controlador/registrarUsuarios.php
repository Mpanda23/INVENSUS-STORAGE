<?php
require "../modelo/conexionBD.php";

$objConexion = Conectarse();

$sqlSexo = "SELECT idsexo, sexo_tipo from sexo";
$sqlRoles = "SELECT idroles, rol_nombre from roles";

$resultadoSexo = $objConexion->query($sqlSexo);
$resultadoRoles = $objConexion->query($sqlRoles);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro usuarios</title>
    <link rel="stylesheet" href="../estilos/estilos-formularios.css">
    
</head>
<body> 
  <header>
    <nav class="container">
      <img src="../img/logo.jpg" alt="" height="60px" width="60px">
      <div class="links">
          <a href="listar-categorias-1.php" class="social-links">Categorias</a>
          <a href="listarUsuarios.php" class="social-links">Usuarios</a>
          <a href="listarProveedores.php" class="social-links">Proveedores</a>
          <a href="listarProductos.php" class="social-links">Productos</a>
          </div>
    </nav>
  </header> 
  
  <div class="form">
    <a href="listarUsuarios.php" target="_blank" class="regreso">
      <img src="../img/volver.png" alt="">
    </a>
    <form id="form1" name="form1" action="validarRegistrarUsuario.php" method="post" class="sub-form">
      <div class="upper-form">
      <h2>Registro de usuarios</h2>
      <br><input type="text" name="idusuarios" id="id" placeholder="Id del Usuario" readonly> <br>
      <input type="text" name="usu_nombre" id="nombre" placeholder="Nombre de usuario" required> <br>
      <select name="usu_tipoid" id="tipo" value="<?php echo $tipo['usu_tipoid']; ?>" required>
        <option value="0">Seleccione el tipo de identificacion</option>
        <option value="Tarjeta Identidad">Tarjeta Identidad</option>
        <option value="Cedula de Ciudadania">Cedula Ciudadania</option>
        <option value="Pasaporte">Pasaporte</option>
        <option value="Cedula Extranjera">Cedula Extranjera</option>
      </select><br>
      
      <input type="text" name="usu_identificacion" id="identificacion" placeholder="Numero de identificacion" required maxlength="10"> <br>
      <input type="number" name="usu_numerotel" id="numero" placeholder="Numero telefonico" maxlength="10" required> <br>
      <input type="email" name="usu_correo" id="correo" placeholder="Correo personal" required><br>
      <input type="password" name="usu_contrasena" id="contraseña" placeholder="Contraseña" required><br>
      
      <select name="usu_estado" id="estado" value="<?php echo $estado['usu_estado']; ?>" required>
        <option value="0">Seleccione el estado</option>
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
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
        <button type="submit" name="button" id="button" value="Enviar">Registrar</button> <br> <br>
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
          <img src="../img/gorjeo.png" alt="">
        </a>
        <a href="" target="_blank" class="sm-icono">
          <img src="../img/gorjeo.png" alt="">
        </a>
        <a href="" target="_blank" class="sm-icono">
          <img src="../img/whatsapp.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/tik-tok.png" alt="">
        </a>
      </div>
    <p class="texto-final">©Proyecto Sena Invensus Storage 2023</p>
</footer>
</body>
</html>