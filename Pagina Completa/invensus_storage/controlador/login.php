<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../estilos/estilo-login.css">
    
</head>
<body>  
  <header>
    <nav class="container">
      <img src="../img/logo.jpg" alt="" height="120px" width="120px">
      <div class="links">
        <a href="menu-1.php#qsomos" class="social-links">Quienes somos</a>
        <a href="menu-1.php#qhistoria" class="social-links">Historia</a>
        <a href="menu-1.php#qmision-vision" class="social-links">Mision / Vision</a>
        <a href="menu-1.php#qpagos" class="social-links">Metodos de pago</a>
        <a href="menu-1.php#qubicaciones" class="social-links">Ubicaciones</a>
      </div>
    </nav>
  </header>  
  <div class="form">
    <form method="post" action="validarIngreso.php" class="sub-form">
      <div class="upper-form">
      <h2>Login ingreso</h2>
      <input type="text" name="usuario" id="usuario" placeholder="Usuario" required> <br>
      <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required> <br>
      <div class="boton">
        <button type="submit">Ingresar</button> <br>
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