<?php
require "../modelo/conexionBaseDatos.php";
require "../modelo/proveedores.php";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $idProveedor = $_GET["id"];

    $proveedores = new Proveedores();

    $proveedor = $proveedores->getProveedorPorID($conn, $idProveedor);

    if (!$proveedor) {
        echo "Proveedor no encontrado.";
        exit;
    }
} else {
    echo "ID de proveedor no válido.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nuevoNombre = $_POST["nombre"];
    $nuevaDireccion = $_POST["direccion"];
    $nuevoCorreo = $_POST["correo"];
    $nuevoTelefono = $_POST["telefono"];
    $nuevoEstado = $_POST["estado"];

    if ($proveedores->actualizarProveedor($idProveedor, $nuevoNombre, $nuevaDireccion, $nuevoCorreo, $nuevoTelefono, $nuevoEstado)) {
        header("Location: listarProveedores.php");
        exit;
    } else {
        echo "Error al actualizar el proveedor.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar proveedor</title>
    <link rel="stylesheet" href="../estilos/estilos-formularios.css">
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
        <a href="listarProveedores.php" class="regreso">
            <img src="../img/volver.png" alt="Volver">
        </a>
        <form action="" method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Editar proveedor</h2>
                <br>
                <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $proveedor['pro_nombre']; ?>" required><br>
                <input type="text" name="direccion" placeholder="Dirección" value="<?php echo $proveedor['pro_direccion']; ?>" required><br>
                <input type="email" name="correo" placeholder="Correo Electrónico" value="<?php echo $proveedor['pro_mail']; ?>" required><br>
                <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo substr($proveedor['pro_telefono'], 0, 10); ?>" maxlength="10" required><br>
                <select name="estado" required>
                    <option value="activo" <?php if($proveedor['pro_estado'] == 'activo') echo 'selected'; ?>>Activo</option>
                    <option value="inactivo" <?php if($proveedor['pro_estado'] == 'inactivo') echo 'selected'; ?>>Inactivo</option>
                </select>
                <br>                <div class="boton">
                    <button type="submit">Actualizar Proveedor</button><br><br>
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
