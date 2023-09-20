<?php

require "../modelo/ConexionBD.php";

extract($_REQUEST);
$objConexion = Conectarse();
$sql = "UPDATE categorias SET cat_nombre='$_REQUEST[nomCat]' WHERE idcategoria='$_REQUEST[idCat]'";

$resultado=$objConexion->query($sql);

if ($resultado)
    header("location: listar-categorias-1.php");
else 
    echo"Error al actualizar";

?>