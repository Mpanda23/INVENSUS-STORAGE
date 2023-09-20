<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invensus_storage";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


class Producto {
    public $idproductos;
    public $prod_nombre;
    public $prod_descripcion;
    public $prod_valor;
    public $prod_imagen;
    public $prod_vencimiento;
    public $prod_alerta;
    public $idcategoria;
    public $idproveedores;
}


$sql = "SELECT * FROM productos";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
    $productos = [];

    while ($row = $result->fetch_assoc()) {
        
        $producto = new Producto();
        $producto->idproductos = $row["idproductos"];
        $producto->prod_nombre = $row["prod_nombre"];
        $producto->prod_descripcion = $row["prod_descripcion"];
        $producto->prod_valor = $row["prod_valor"];
        $producto->prod_imagen = $row["prod_imagen"];
        $producto->prod_vencimiento = $row["prod_vencimiento"];
        $producto->prod_alerta = $row["prod_alerta"];
        $producto->idcategoria = $row["idcategoria"];
        $producto->idproveedores = $row["idproveedores"];

        
        $productos[] = $producto;
    }

  
    $conn->close();
    

    echo '<!DOCTYPE html>
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
            <a href="registrar_producto.php" target="_blank" class="anadir">
                <img src="../img/agregar.png" alt="" while="32" >
            </a>
            <div class="sub-form">
                <table class="tabla">
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre Producto</th>
                        <th>Descripción Producto</th>
                        <th>Valor Producto</th>
                        <th>Imagen</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Alerta</th>
                        <th>ID Categoría</th>
                        <th>ID Proveedor</th>
                        <th>Editar</th>
                    </tr>';

    foreach ($productos as $producto) {
        echo '<tr>';
        echo '<td>' . $producto->idproductos . '</td>';
        echo '<td>' . $producto->prod_nombre . '</td>';
        echo '<td>' . $producto->prod_descripcion . '</td>';
        echo '<td>' . $producto->prod_valor . '</td>';
        echo '<td>' . $producto->prod_imagen . '</td>';
        echo '<td>' . $producto->prod_vencimiento . '</td>';
        echo '<td>' . $producto->prod_alerta . '</td>';
        echo '<td>' . $producto->idcategoria . '</td>';
        echo '<td>' . $producto->idproveedores . '</td>';
        echo '<td><a href="actualizar_producto.php?id=' . $producto->idproductos . '">Editar</a></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '<footer>
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
} else {
    echo "No se encontraron productos en la base de datos.";
}

?>
