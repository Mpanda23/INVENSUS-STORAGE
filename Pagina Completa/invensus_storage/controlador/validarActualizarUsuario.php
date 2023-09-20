<?php
require "../modelo/conexionBD.php";
require "../modelo/claseUsuario.php";

$objConexion = Conectarse();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idusuarios"]) && isset($_POST["usu_nombre"]) && isset($_POST["usu_tipoid"]) && isset($_POST["usu_identificacion"]) && isset($_POST["usu_numerotel"]) && isset($_POST["usu_correo"]) && isset($_POST["usu_contrasena"]) && isset($_POST["usu_estado"]) && isset($_POST["idsexo"]) && isset($_POST["idroles"])) {
  $idusuarios = $_POST["idusuarios"];
  $usu_nombre = $_POST["usu_nombre"];
  $usu_tipoid = $_POST["usu_tipoid"];
  $usu_identificacion = $_POST["usu_identificacion"];
  $usu_numerotel = $_POST["usu_numerotel"];
  $usu_correo = $_POST["usu_correo"];
  $usu_contrasena = $_POST["usu_contrasena"];
  $usu_estado = $_POST["usu_estado"];
  $idsexo = $_POST["idsexo"];
  $idroles = $_POST["idroles"];

    $objUsuario = new Usuario();
    $objUsuario->setidusuarios($idusuarios);
    $objUsuario->setusu_nombre($usu_nombre);
    $objUsuario->setusu_tipoid($usu_tipoid);
    $objUsuario->setusu_identificacion($usu_identificacion);
    $objUsuario->setusu_numerotel($usu_numerotel);
    $objUsuario->setusu_correo($usu_correo);
    $objUsuario->setusu_contrasena($usu_contrasena);
    $objUsuario->setusu_estado($usu_estado);
    $objUsuario->setidsexo($idsexo);
    $objUsuario->setidroles($idroles);

    $resultadoActualizacion = $objUsuario->modificarUsuario();

    if ($resultadoActualizacion) {
        header("location: listarUsuarios.php?x=1"); // x=1 indica que se modificó correctamente
        exit;
    } else {
        echo "no se actualizo";
        //header("location: listarUsuarios.php?x=2"); // x=2 indica que hubo un error en la modificación
        exit;
    }
}
?>
