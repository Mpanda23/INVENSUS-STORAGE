<?php
require "../modelo/conexionBaseDatos.php";
require "../modelo/proveedores.php";

$proveedores = new Proveedores();

$listaProveedores = $proveedores->listarProveedores($conn);
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
    <a href="" target="_blank" class="regreso">
      <img src="../img/volver.png" alt="">
    </a>
    <a href="proveedores-2.php" target="_blank" class="anadir">
      <img src="../img/agregar.png" alt="">
    </a>
    <div class="sub-form">
    <table class="tabla">
        <tr>
        <th>id proveedor</th>
                <th>Nombre proveedor</th>
                <th>Direccion proveedor</th>
                <th>Numero telefonico</th>
                <th>Correo proveedor</th>
                <th>Estado</th>
                <th>Editar</th>
        </tr>
        <?php
        foreach ($listaProveedores as $proveedor) {
            echo "<tr>";
            echo "<td>" . $proveedor['idproveedores'] . "</td>";
            echo "<td>" . $proveedor['pro_nombre'] . "</td>";
            echo "<td>" . $proveedor['pro_direccion'] . "</td>";
            echo "<td>" . $proveedor['pro_telefono'] . "</td>";
            echo "<td>" . $proveedor['pro_mail'] . "</td>";
            echo "<td>" . $proveedor['pro_estado'] . "</td>";

            echo "<td><a href='proveedores-3.php?id=" . $proveedor['idproveedores'] . "'>Editar</a></td>";
            echo "</tr>";
        }
        ?>
        </table>
        </div>
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
        </html>';

