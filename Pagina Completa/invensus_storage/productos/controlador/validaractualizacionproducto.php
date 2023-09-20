<?php
require "../modelo/conexionBaseDatos.php";
require "../modelo/claseproducto.php";


$objConexion = Conectarse();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idproductos"]) && isset($_POST["prod_nombre"]) && isset($_POST["prod_descripcion"]) && isset($_POST["prod_valor"]) && isset($_POST["prod_imagen"]) && isset($_POST["prod_vencimiento"]) && isset($_POST["prod_alerta"]) && isset($_POST["idcategoria"]) && isset($_POST["idproveedores"])) {
    $idproductos = $_POST["idproductos"];
    $prod_nombre = $_POST["prod_nombre"];
    $prod_descripcion = $_POST["prod_descripcion"];
    $prod_valor = $_POST["prod_valor"];
    $prod_imagen = $_POST["prod_imagen"];
    $prod_vencimiento = $_POST["prod_vencimiento"];
    $prod_alerta = $_POST["prod_alerta"];
    $idcategoria = $_POST["idcategoria"];
    $idproveedores = $_POST["idproveedores"];

    // Crear una instancia de la clase Producto
    $objProducto = new Producto();
    
    // Establecer los atributos del producto
    $objProducto->setidproductos($idproductos);
    $objProducto->setprod_nombre($prod_nombre);
    $objProducto->setprod_descripcion($prod_descripcion);
    $objProducto->setprod_valor($prod_valor);
    $objProducto->setprod_imagen($prod_imagen);
    $objProducto->setprod_vencimiento($prod_vencimiento);
    $objProducto->setprod_alerta($prod_alerta);
    $objProducto->setidcategoria($idcategoria);
    $objProducto->setidproveedores($idproveedores);

    // Llamar al método para modificar el producto
    $resultadoActualizacion = $objProducto->modificarProducto();

    if ($resultadoActualizacion) {
        header("location: listarProductos.php?x=1"); // x=1 indica que se modificó correctamente
        exit;
    } else {
        header("location: listarProductos.php?x=2"); // x=2 indica que hubo un error en la modificación
        exit;
    }
}
?>
