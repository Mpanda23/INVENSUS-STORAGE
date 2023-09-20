<?php

require "../modelo/ConexionBD.php";
require "../modelo/Categorias.php";

extract($_REQUEST);
if (!isset($_REQUEST['x']))
  $_REQUEST['x']=0;

$objConexion = Conectarse();
$objCategoria = new Categorias();

$resultado = $objCategoria -> consultaCategoria();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista productos</title>
    <link rel="stylesheet" href="../estilos/estilos-listar.css">
    
</head>
<body> 
<header>
  <nav class="container">
    <div class="logo">
      <img src="../img/logo.jpg" alt="" height="120px" width="120px">
    </div>
    <div class="links">
          <a href="listar-categorias-1.php" class="social-links">Categorias</a>
          <a href="listarUsuarios.php" class="social-links">Usuarios</a>
          <a href="listarProveedores.php" class="social-links">Proveedores</a>
          <a href="listarProductos.php" class="social-links">Productos</a>
          </div>
  </nav>
</header>

  
  <div class="form">
    <a href="" target="_blank" class="regreso">
      <img src="../img/volver.png" alt="">
    </a>
    <a href="frmcategorias-2.php" target="_blank" class="anadir">
      <img src="../img/agregar.png" alt="" while="32" >
    </a>
    <div class="sub-form">
    <table class="tabla">
      <h1>Lista de categorias</h1><br>
        <tr>
            <th>Id Categoria</th>
            <th>Nombre Categoria</th>
            <th>Editar</th>
        </tr>

        <?php
        while ($categoria = $resultado->fetch_object())
        {
        ?>
        <tr>
          <td><?php echo $categoria->idcategoria ?></td>
          <td><?php echo $categoria->cat_nombre ?></td>
          <td><a href="frmcategorias-3.php?idCat=<?php echo $categoria -> idcategoria ?>">Actualizar</a></td>
        </tr>
          
        <?php
        }
        ?>
    </table>
    </div>
  </div>
  <footer>
  <div>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/instagram.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/facebook.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/gorjeo.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/whatsapp.png" alt="">
        </a>
        <a href="" target="_blank" class="sm-icono">
          <img src="../img/tik-tok.png" alt="">
        </a>
      </div>
    <p class="texto-final">©Proyecto Sena Invensus Storage 2023</p>
</footer>
</body>
</html>