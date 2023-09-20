<?php
require "../modelo/conexionBaseDatos.php";
require "../modelo/Proveedores.php";

$proveedores = new Proveedores($conn);

$pro_nombre = $_POST["pro_nombre"];
$pro_direccion = $_POST["pro_direccion"];
$pro_mail = $_POST["pro_mail"];
$pro_telefono = $_POST["pro_telefono"];
$pro_estado = $_POST["pro_estado"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invensus_storage";

$Conexion = new mysqli($servername, $username, $password, $dbname);

if ($Conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $Conexion->connect_error);
}

$exito = $proveedores->insertarProveedor($Conexion, $pro_nombre, $pro_direccion, $pro_mail, $pro_telefono, $pro_estado);

if ($exito) {
    header("Location: listarProveedores.php");
} else {
    echo "Error al registrar el proveedor. Por favor, inténtalo nuevamente.";
}

$Conexion->close();
?>
