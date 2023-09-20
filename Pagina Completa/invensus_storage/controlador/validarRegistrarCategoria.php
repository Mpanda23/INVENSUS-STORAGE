<?php

require "../modelo/ConexionBD.php";
require "../modelo/Categorias.php";

$objCategorias = new Categorias();

$objCategorias->crearCategoria($_REQUEST['idCat'], $_REQUEST['nomCat']);
$resultado = $objCategorias = $objCategorias->agregarCategoria();

if($resultado)
    header("location: listar-categorias-1.php");
else 
    echo "Error al agregar";

?>