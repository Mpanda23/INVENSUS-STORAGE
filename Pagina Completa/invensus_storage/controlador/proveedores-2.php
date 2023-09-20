<?php

require "../modelo/conexionBaseDatos.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro proveedores</title>
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
        <a href="listarProveedores.php" target="_blank" class="regreso">
            <img src="../img/volver.png" alt="">
        </a>


        <form action="procesar_registro_proveedores.php" method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Registro de proveedores</h2>
                <input type="text" name="pro_nombre" placeholder="Nombre de proveedor" required> <br>
                <input type="text" name="pro_direccion" placeholder="Dirección" required> <br>
                <input type="email" name="pro_mail" placeholder="Correo proveedor" required><br>
                <input type="number" name="pro_telefono" placeholder="Numero telefonico" oninput="this.value = this.value.slice(0, 10)" required> <br>
                <input type="hidden" name="pro_estado" value="Activo">
                <div class="boton">
                    <button type="submit">Registrar Proveedor</button> <br> <br>
                </div>
            </div>
        </form>
    </div>
    <footer>
    <div class="icon">
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/instagram.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/gorjeo.png" alt="">
        </a>
        <a href="" target="_blank" class="sm-icono">
          <img src="../img/gorjeo.png" alt="">
        </a>
        <a href="" target="_blank" class="sm-icono">
          <img src="../img/whatsapp.png" alt="">
        </a>
        <a href="#" target="_blank" class="sm-icono">
          <img src="../img/tik-tok.png" alt="">
        </a>
      </div>
        <p class="texto-final">©Proyecto Sena Invensus Storage 2023</p>
    </footer>
</body>
</html>
