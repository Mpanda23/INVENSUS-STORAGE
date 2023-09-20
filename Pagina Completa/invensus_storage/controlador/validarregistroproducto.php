<?php
require "../modelo/conexionBaseDatos.php";
require "../modelo/claseproducto.php";




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $_POST["nombre_producto"];
    $descripcion_producto = $_POST["descripcion_producto"];
    $precio_producto = $_POST["precio_producto"];
    $imagen_producto = $_POST["imagen_producto"];
    $vencimiento_producto = $_POST["vencimiento_producto"];
    $alerta_producto = $_POST["alerta_producto"];
    $categoria_id = $_POST["categoria_id"];
    $proveedor_id = $_POST["proveedor_id"];

    // Validar que los campos no estén vacíos
    if (empty($nombre_producto) || empty($descripcion_producto) || empty($precio_producto) || empty($imagen_producto) || empty($vencimiento_producto) || empty($alerta_producto) || empty($categoria_id) || empty($proveedor_id)) {
        echo "Todos los campos son obligatorios. Por favor, verifica los datos.";
    } else {
        // Crear una instancia de la clase Producto
        $objProducto = new Producto();

        // Establecer los atributos del producto
        $objProducto->setNombreProducto($nombre_producto);
        $objProducto->setDescripcionProducto($descripcion_producto);
        $objProducto->setPrecioProducto($precio_producto);
        $objProducto->setImagenProducto($imagen_producto);
        $objProducto->setVencimientoProducto($vencimiento_producto);
        $objProducto->setAlertaProducto($alerta_producto);
        $objProducto->setCategoriaId($categoria_id);
        $objProducto->setProveedorId($proveedor_id);

        // Llamar al método para agregar el producto
        $resultado = $objProducto->agregarProducto();

        if ($resultado) {
            header("location: listarProductos.php"); // x=1 indica que se registró correctamente
            exit;
        } else {
            echo "Error al registrar el producto: ";
        }
    }
}
?>
