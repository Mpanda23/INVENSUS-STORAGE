<?php
require "../modelo/conexionBaseDatos.php";
require "../modelo/claseproducto.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $producto_id = $_POST["producto_id"];
    $nombre_producto = $_POST["nombre_producto"];
    $descripcion_producto = $_POST["descripcion_producto"];
    $precio_producto = $_POST["precio_producto"];
    $imagen_producto = $_POST["imagen_producto"];
    $vencimiento_producto = $_POST["vencimiento_producto"];
    $alerta_producto = $_POST["alerta_producto"];
    $categoria_id = $_POST["categoria_id"];
    $proveedor_id = $_POST["proveedor_id"];

    // Crear una instancia de la clase Producto
    $objProducto = new Producto();
    $objProducto->setProductoID($producto_id);
    $objProducto->setNombre($nombre_producto);
    $objProducto->setDescripcion($descripcion_producto);
    $objProducto->setPrecio($precio_producto);
    $objProducto->setImagen($imagen_producto);
    $objProducto->setVencimiento($vencimiento_producto);
    $objProducto->setAlerta($alerta_producto);
    $objProducto->setCategoriaID($categoria_id);
    $objProducto->setProveedorID($proveedor_id);

    // Realizar la actualización del producto
    $resultadoActualizacion = $objProducto->actualizarProducto();

    if ($resultadoActualizacion) {
        $mensaje = "Producto actualizado con éxito.";
    } else {
        $mensaje = "No se realizó ninguna actualización en el producto.";
    }
}

// Obtener el ID del producto de la URL
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $producto_id = $_GET["id"];

    // Crear una instancia de la clase Producto
    $objProducto = new Producto();
    $producto = $objProducto->obtenerProductoPorID($producto_id);

    if (!$producto) {
        $mensaje = "Producto no encontrado.";
    }
} else {
    $mensaje = "ID del producto no válido.";
}

// Obtener la lista de categorías y proveedores
$objProducto = new Producto();
$categorias = $objProducto->obtenerCategorias();
$proveedores = $objProducto->obtenerProveedores();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="vista.css">
</head>
<body> 
  <header>
    <nav class="container">
      <img src="logo.jpg" alt="" height="60px" width="60px">
      <div class="links">
        <a href="" class="social-links">Quienes somos</a>
        <a href="" class="social-links">Historia</a>
        <a href="" class="social-links">Mision / Vision</a>
        <a href="" class="social-links">Metodos de pago</a>
        <a href="" class="social-links">Ubicaciones</a>
        
      </div>
      <div class="icon">
        <a href="#" target="_blank" class="sm-icono">
          <img src="instagram.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="twitter.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="tik-tok.png" alt="">
        </a>
      </div>
    </nav>
  </header> 
  
  <div class="form">
    <a href="../productos-1.php" class="regreso">
      <img src="volver.png" alt="">
    </a>
    <form action="actualizar_producto.php" method="POST" class="sub-form">
      <div class="upper-form">
        <h2>Actualizar Producto</h2>
        <br>
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
        <input type="text" name="nombre_producto" placeholder="Nuevo nombre del producto" value="<?php echo $producto['nombre_producto']; ?>" required> <br>
        <input type="text" name="descripcion_producto" placeholder="Nueva descripción del producto" value="<?php echo $producto['descripcion_producto']; ?>" required> <br>
        <input type="text" name="precio_producto" placeholder="Nuevo precio del producto" value="<?php echo $producto['precio_producto']; ?>" required> <br>
        <input type="text" name="imagen_producto" placeholder="Nueva URL de la imagen del producto" value="<?php echo $producto['imagen_producto']; ?>" required> <br>
        <input type="date" name="vencimiento_producto" placeholder="Nueva fecha de vencimiento" value="<?php echo $producto['vencimiento_producto']; ?>" required> <br>
        <input type="date" name="alerta_producto" placeholder="Nueva alerta del producto" value="<?php echo $producto['alerta_producto']; ?>" required> <br>
        <select name="categoria_id" id="cat">
          <option value="">Seleccione la nueva categoría del producto</option>
          <?php
          foreach ($categorias as $categoria) {
              $selected = ($categoria['idcategoria'] == $producto['idcategoria']) ? 'selected' : '';
              echo '<option value="' . $categoria['idcategoria'] . '" ' . $selected . '>' . $categoria['nombre_categoria'] . '</option>';
          }
          ?>
        </select> 
        <select name="proveedor_id" id="estado">
          <option value="">Seleccione el nuevo proveedor</option>
          <?php
          foreach ($proveedores as $proveedor) {
              $selected = ($proveedor['idproveedores'] == $producto['idproveedores']) ? 'selected' : '';
              echo '<option value="' . $proveedor['idproveedores'] . '" ' . $selected . '>' . $proveedor['nombre_proveedor'] . '</option>';
          }
          ?>
        </select>
        <div class="boton">
          <button type="submit">Actualizar Producto</button>
        </div>
      </div>
    </form>
  </div>

  <footer>
    <p class="texto-final">©Proyecto Sena Invensus Storage 2023</p>
  </footer>
</body>
</html>
