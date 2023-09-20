<?php
function Conectarse()
{
    $Conexion = new mysqli("localhost", "root", "", "invensus_storage");

    if ($Conexion->connect_errno) {
        echo "Problemas en la Conexion " . $Conexion->connect_error;
    } else {
        return $Conexion;
    }
}

// Conectar a la base de datos
$conn = Conectarse();

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Realizar una consulta SQL
$sql = "SELECT u.idusuarios, u.usu_nombre, s.sexo_tipo, u.usu_tipoid, u.usu_identificacion, u.usu_numerotel, u.usu_correo, r.rol_nombre, u.usu_estado 
        FROM usuarios u
        INNER JOIN sexo s ON u.idsexo = s.idsexo
        INNER JOIN roles r ON u.idroles = r.idroles";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista productos</title>
    <link rel="stylesheet" href="../estilos/estilos-listar.css">
    
</head>
<body> 
  <header>
    <nav class="container">
      <img src="../img/logo.jpg" alt="" height="120px" width="120px">
      <div class="links">
          <a href="listar-categorias-1.php" class="social-links">Categorias</a>
          <a href="listarUsuarios.php" class="social-links">Usuarios</a>
          <a href="listarProveedores.php" class="social-links">Proveedores</a>
          <a href="listarProductos.php" class="social-links">Productos</a>
          </div>
    </nav>
  </header> 
  
  <div class="form">
    <a href="" target="_blank" class="regreso">
      <img src="../img/volver.png" alt="">
    </a>
    <a href="registrarUsuarios.php" target="_blank" class="anadir">
      <img src="../img/agregar.png" alt="">
    </a>
    <div class="sub-form">
      <h2>Lista de Usuarios</h2>
    <table class="tabla">
        <tr>
            <th>ID del Usuario</th>
            <th>Nombre del Usuario</th>
            <th>Sexo</th>
            <th>Tipo de Identificacion</th>
            <th>Numero de Identificacion</th>
            <th>Celular</th>
            <th>Correo electronico</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Editar</th>
        </tr>
        <?php
        if ($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row["idusuarios"] . "</td>";
            echo "<td>" . $row["usu_nombre"] . "</td>";
            echo "<td>" . $row["sexo_tipo"] . "</td>";
            echo "<td>" . $row["usu_tipoid"] . "</td>";
            echo "<td>" . $row["usu_identificacion"] . "</td>";
            echo "<td>" . $row["usu_numerotel"] . "</td>";
            echo "<td>" . $row["usu_correo"] . "</td>";
            echo "<td>" . $row["rol_nombre"] . "</td>";
            echo "<td>" . $row["usu_estado"] . "</td>";
            echo '<td><a href="actualizarUsuario.php?idusuarios=' . $row["idusuarios"] . '">Actualizar</a></td>';
            echo "</tr>";
          }
        }else {
          echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
      }

      $conn->close();
        ?>
    </table>
    </div>
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