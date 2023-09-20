<?php
class RegistrarProducto
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new PDO("mysql:host=localhost;dbname=invensus_storage", "root", "");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function registrarProducto($nombre, $descripcion, $precio, $imagen, $vencimiento, $alerta, $categoria_id, $proveedor_id)
    {
        $mensaje = "";

        try {
            $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM categorias WHERE idcategoria = ?");
            $stmt->execute([$categoria_id]);
            $categoria_existente = $stmt->fetchColumn();

            $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM proveedores WHERE idproveedores = ?");
            $stmt->execute([$proveedor_id]);
            $proveedor_existente = $stmt->fetchColumn();

            if ($categoria_existente && $proveedor_existente) {
                $sql = "INSERT INTO productos (prod_nombre, prod_descripcion, prod_valor, prod_imagen, prod_vencimiento, prod_alerta, idcategoria, idproveedores) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $this->conexion->prepare($sql);
                $stmt->execute([$nombre, $descripcion, $precio, $imagen, $vencimiento, $alerta, $categoria_id, $proveedor_id]);

                $mensaje = "Producto registrado con éxito.";
            } else {
                $mensaje = "Error al registrar el producto: Categoría o proveedor no válidos.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error al registrar el producto: " . $e->getMessage();
        }

        return $mensaje;
    }

    public function cerrarConexion()
    {
        $this->conexion = null;
    }
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $_POST["nombre_producto"];
    $descripcion_producto = $_POST["descripcion_producto"];
    $precio_producto = $_POST["precio_producto"];
    $imagen_producto = $_POST["imagen_producto"];
    $vencimiento_producto = $_POST["vencimiento_producto"];
    $alerta_producto = $_POST["alerta_producto"];
    $categoria_id = $_POST["categoria_id"];
    $proveedor_id = $_POST["proveedor_id"];

    $registroProducto = new RegistrarProducto();
    $mensaje = $registroProducto->registrarProducto($nombre_producto, $descripcion_producto, $precio_producto, $imagen_producto, $vencimiento_producto, $alerta_producto, $categoria_id, $proveedor_id);
    $registroProducto->cerrarConexion();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos</title>
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
    <a href="listarProductos.php" target="_blank" class="regreso">
      <img src="../img/volver.png" alt="">
    </a>
    <form action="listarProductos.php" method="POST" class="sub-form">
      <div class="upper-form">
        <h2>Registro de productos</h2>
        <br>
        <input type="text" name="nombre_producto" placeholder="Nombre del producto" required> <br>
        <input type="text" name="descripcion_producto" placeholder="Descripción del producto" required> <br>
        <input type="text" name="precio_producto" placeholder="Precio del producto" required> <br>
        <input type="text" name="imagen_producto" placeholder="URL de la imagen del producto" required> <br>
        <input type="date" name="vencimiento_producto" placeholder="Fecha de vencimiento" required> <br>
        <input type="date" name="alerta_producto" placeholder="Alerta del producto" required> <br>
        <input type="text" name="categoria_id" id="cat" placeholder="Categoria del producto"><br>
        <input type="text" name="proveedor_id" id="estado" placeholder="Proveedor"><br>
        <div class="boton">
          <button type="submit">Registrar Producto</button>
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
