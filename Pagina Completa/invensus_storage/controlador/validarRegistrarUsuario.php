<?php
require "../modelo/conexionBD.php";
require "../modelo/claseUsuario.php";

$objUsuario = new Usuario();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idusuarios = $_POST["idusuarios"];
    $usu_nombre = $_POST["usu_nombre"];
    $usu_tipoid = $_POST["usu_tipoid"];
    $usu_identificacion = $_POST["usu_identificacion"];
    $usu_numerotel = $_POST["usu_numerotel"];
    $usu_correo = $_POST["usu_correo"];
    $usu_contrasena =md5($_POST["usu_contrasena"]);
    $usu_estado = $_POST["usu_estado"];
    $idsexo = $_POST["idsexo"];
    $idroles = $_POST["idroles"];

    if (empty($usu_nombre) || empty($usu_tipoid) || empty($usu_identificacion) || empty($usu_numerotel) || empty($usu_correo) || empty($usu_contrasena) || empty($usu_estado) || empty($idsexo) || empty($idroles)) {
        echo "Todos los campos son obligatorios. Por favor, verifica los datos-";
    } else{

        $objUsuario->crearUsuario($idusuarios, $usu_nombre, $usu_tipoid, $usu_identificacion, $usu_numerotel, $usu_correo, $usu_contrasena, $usu_estado, $idsexo, $idroles);

        $resultado = $objUsuario->agregarUsuario();

        if ($resultado) {
            header("location: listarUsuarios.php?x=1");
        } else {
            echo "Error al registrar usuario: ";

        }
    }
}
?>