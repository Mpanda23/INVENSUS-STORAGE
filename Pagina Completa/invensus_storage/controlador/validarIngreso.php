<?php
session_start();
require "../modelo/ConexionBD.php";

if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (empty($usuario) || empty($contrasena)) {
        $_SESSION['error'] = "Por favor complete todos los campos";
        header("location: login.php");
        exit;
    }

    $objConexion = Conectarse();

    if ($objConexion->connect_error) {
        die("Error de conexion a la base de datos: " . $objConexion->connect_error);
    }

    $sql = "SELECT usu_nombre, usu_contrasena FROM usuarios WHERE usu_nombre = ?";
    $stmt = $objConexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (md5($contrasena) === $row['usu_contrasena']) { // Verifica la contraseña con MD5
            $_SESSION['usuario'] = $row['usu_nombre'];
            header("location: listar-categorias-1.php"); // Cambia la URL a tu página deseada
            exit;
        } else {
            $_SESSION['error'] = "Datos ingresados incorrectos";
            header("location: login.php"); // Redirige nuevamente a la página de inicio de sesión
            exit;
        }
    } else {
        $_SESSION['error'] = "Datos ingresados incorrectos";
        header('location: login.php');
        exit;
    }

    $objConexion->close();
} else {
    $_SESSION['error'] = "Ha ocurrido un error, inténtalo de nuevo";
    header("location: login.php");
    exit;
}





/*require "../modelo/ConexionBD.php";

if(isset($_POST['usuario'] && isset($_POST['contrasena']))){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if(empty($usuario) || empty($contrasena)){
        $_SESSION['error'] = "Por favor complete todos los campos";
        header("location: login.php");
        exit;
    }

$objConexion = Conectarse();

    if ($objConexion->connect_error){
        die("Error de conexion a la base de datos: ". $objConexion->connect_error);       
    }

    $sql = "SELECT usu_nombre, usu_contrasena FROM usuarios WHERE usu_nombre = ?";
    $stmt = $objConexion->prepare($sql);
    $stmt -> bind_param("s", $usuario);
    $stmt ->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1){
        $row = $result -> fetch_assoc();

        if (password_verify($contrasena, $row['contrasena'])){
            $_SESSION['usuario'] = $row['usu_nombre'];
            header("location: ");
            exit;
        } else {
            $_SESSION['error'] = "Datos ingresados incorrectos";
            header ("location: login.php");
            exit;
        }
    }else {
        $_SESSION['error'] = "Datos ingresados incorrectos";
        header('location: login.php');
        exit;
    }

    $objConexion->close();

    }else{
        $_SESSION['error']="Ha ocurrido un error intentalo de nuevo";
        header("location: login.php");
        exit;
    }*/



?>