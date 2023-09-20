<?php
class Producto {
    private $idproductos;
    private $prod_nombre;
    private $prod_descripcion;
    private $prod_valor;
    private $prod_imagen;
    private $prod_vencimiento;
    private $prod_alerta;
    private $idcategoria;
    private $idproveedores;
    private $Conexion;

    public function __construct()
    {

    }

    // Getters
    public function getidproductos(){
        return $this->idproductos;
    }

    public function getprod_nombre(){
        return $this->prod_nombre;
    }

    public function getprod_descripcion(){
        return $this->prod_descripcion;
    }

    public function getprod_valor(){
        return $this->prod_valor;
    }

    public function getprod_imagen(){
        return $this->prod_imagen;
    }

    public function getprod_vencimiento(){
        return $this->prod_vencimiento;
    }

    public function getprod_alerta(){
        return $this->prod_alerta;
    }

    public function getidcategoria(){
        return $this->idcategoria;
    }

    public function getidproveedores(){
        return $this->idproveedores;
    }

    // Setters
    public function setidproductos($newVal){
        $this->idproductos = $newVal;
    }

    public function setprod_nombre($newVal){
        $this->prod_nombre = $newVal;
    }

    public function setprod_descripcion($newVal){
        $this->prod_descripcion = $newVal;
    }

    public function setprod_valor($newVal){
        $this->prod_valor = $newVal;
    }

    public function setprod_imagen($newVal){
        $this->prod_imagen = $newVal;
    }

    public function setprod_vencimiento($newVal){
        $this->prod_vencimiento = $newVal;
    }

    public function setprod_alerta($newVal){
        $this->prod_alerta = $newVal;
    }

    public function setidcategoria($newVal){
        $this->idcategoria = $newVal;
    }

    public function setidproveedores($newVal){
        $this->idproveedores = $newVal;
    }

    // Métodos
    public function crearProducto($idproductos, $prod_nombre, $prod_descripcion, $prod_valor, $prod_imagen, $prod_vencimiento, $prod_alerta, $idcategoria, $idproveedores)
   {
    $this->idproductos = $idproductos;
    $this->prod_nombre = $prod_nombre;
    $this->prod_descripcion = $prod_descripcion;
    $this->prod_valor = $prod_valor;
    $this->prod_imagen = $prod_imagen;
    $this->prod_vencimiento = $prod_vencimiento;
    $this->prod_alerta = $prod_alerta;
    $this->idcategoria = $idcategoria;
    $this->idproveedores = $idproveedores;
   }

   public function agregarProducto()
   {
    $this->Conexion = Conectarse();
    $sql = "INSERT INTO productos (idproductos, prod_nombre, prod_descripcion, prod_valor, prod_imagen, prod_vencimiento, prod_alerta, idcategoria, idproveedores)
    VALUES ('$this->idproductos', '$this->prod_nombre', '$this->prod_descripcion', '$this->prod_valor', '$this->prod_imagen', '$this->prod_vencimiento', '$this->prod_alerta', '$this->idcategoria', '$this->idproveedores')";
    $resultado = $this->Conexion->query($sql);
    $this->Conexion->close();
    return $resultado;
   }

    public function modificarProducto()
    {
        $this->Conexion = Conectarse();
        $sql = "UPDATE productos SET prod_nombre = '$this->prod_nombre', prod_descripcion = '$this->prod_descripcion', prod_valor = '$this->prod_valor', prod_imagen = '$this->prod_imagen', prod_vencimiento = '$this->prod_vencimiento', prod_alerta = '$this->prod_alerta', idcategoria = '$this->idcategoria', idproveedores = '$this->idproveedores'
        WHERE idproductos = '$this->idproductos'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function consultarProducto()
    {
        $this->Conexion = Conectarse();
        $sql = "SELECT * FROM productos WHERE idproductos = '$this->idproductos'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

  
}
?>