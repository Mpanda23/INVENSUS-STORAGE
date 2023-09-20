<?php

require "../modelo/ConexionBD.php";

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro categorias</title>
    <link rel="stylesheet" href="../estilos/estilos-formularios.css">
    
</head>
<body> 
  <header>
    <nav class="container">
      <img src="../img/logo.jpg" alt="" height="120px" width="120px">
      <div class="links">
          <a href="listar-categorias-1.php" class="social-links">Categorias</a>
          <a href="listarUsuarios.php" class="social-links">Usuarios</a>
          <a href="listarProveedores.php" class="social-links">Proveedores</a>
          <a href="listarProductos.php" class="social-links">Productos</a>
          </div>
    </nav>
  </header> 
  
  <div class="form">
    <a href="listar-categorias-1.php" target="_blank" class="regreso">
      <img src="../img/volver.png" alt="">
    </a>
    <form action="validarRegistrarCategoria.php" class="sub-form">
      <div class="upper-form">
      <h2>Registro de categorias</h2>
      <br><input type="number" name="idCat" id="idCat" placeholder="ID categoria" require readonly><br>
      <input type="text" name="nomCat" id="nomCat" placeholder="Nombre de categoria" required> <br>
      <div class="boton">
        <button type="submit">Registrar</button> <br> <br>
      </div>
    </div>
    </form>
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
        <a href="" class="sm-icono">
          <img src="../img/tik-tok.png" alt="">
        </a>
      </div>
    <p class="texto-final">©Proyecto Sena Invensus Storage 2023</p>
</footer>
</body>
</html>