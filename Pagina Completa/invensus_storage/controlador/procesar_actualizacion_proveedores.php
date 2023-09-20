<?php
require "../modelo/conexionBaseDatos.php"; 
require "../modelo/Proveedores.php";

$proveedores = new Proveedores($conn);

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $idProveedor = $_GET["id"];
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
