<?php
class Usuario {
    private $idusuarios;
    private $usu_nombre;
    private $usu_tipoid;
    private $usu_identificacion;
    private $usu_numerotel;
    private $usu_correo;
    private $usu_contrasena;
    private $usu_estado;
    private $idsexo;
    private $idroles;
    public $Conexion;

    public function __construct()
    {

    }
    public function getidusuarios(){
        return $this->idusuarios;
    }


    public function getusu_nomnbre(){
        return $this->usu_nombre;
    }

    public function getusu_tipoid(){
        return $this->usu_tipoid;
    }

    public function getusu_identinticacion(){
        return $this->usu_identificacion;
    }

    public function getusu_numerotel(){
        return $this->usu_numerotel;
    }

    public function getusu_correo(){
        return $this->usu_correo;
    }

    public function getusu_contrasena(){
        return $this->usu_contrasena;
    }

    public function getusu_estado(){
        return $this->usu_estado;
    }

    public function getidsexo(){
        return $this->idsexo;
    }

    public function getidroles(){
        return $this->idroles;
    }

    //setters
    public function setidusuarios($newVal){
        $this->idusuarios = $newVal;
   }

    public function setusu_nombre($newVal){
         $this->usu_nombre = $newVal;
    }

    public function setusu_tipoid($newVal){
         $this->usu_tipoid = $newVal;
    }

    public function setusu_identificacion($newVal){
         $this->usu_identificacion = $newVal;
    }

    public function setusu_numerotel($newVal){
         $this->usu_numerotel = $newVal;
    }

    public function setusu_correo($newVal){
         $this->usu_correo = $newVal;
    }

    public function setusu_contrasena($newVal){
         $this->usu_contrasena = $newVal;
    }

    public function setusu_estado($newVal){
         $this->usu_estado = $newVal;
    }

    public function setidsexo($newVal){
         $this->idsexo = $newVal;
    }

    public function setidroles($newVal){
         $this->idroles = $newVal;
    }

    //metodos
    public function crearUsuario($idusuarios, $usu_nombre, $usu_tipoid, $usu_identificacion, $usu_numerotel, $usu_correo, $usu_contrasena, $usu_estado, $idsexo, $idroles)
   {
    $this->idusuarios = $idusuarios;
    $this->usu_nombre = $usu_nombre;
    $this->usu_tipoid = $usu_tipoid;
    $this->usu_identificacion = $usu_identificacion;
    $this->usu_numerotel = $usu_numerotel;
    $this->usu_correo = $usu_correo;
    $this->usu_contrasena = $usu_contrasena;
    $this->usu_estado = $usu_estado;
    $this->idsexo = $idsexo;
    $this->idroles = $idroles;
   }

   public function agregarUsuario()
   {
    $this->Conexion = Conectarse();
    $sql = "INSERT INTO usuarios (idusuarios, usu_nombre, usu_tipoid, usu_identificacion, usu_numerotel, usu_correo, usu_contrasena, usu_estado, idsexo, idroles)
    VALUES ('$this->idusuarios', '$this->usu_nombre', '$this->usu_tipoid', '$this->usu_identificacion', '$this->usu_numerotel', '$this->usu_correo', '$this->usu_contrasena', '$this->usu_estado', '$this->idsexo', '$this->idroles')";
    $resultado = $this->Conexion->query($sql);
    $this->Conexion->close();
    return $resultado;
   }
    public function modificarUsuario()
    {
        $this->Conexion = Conectarse();
        $sql = "UPDATE usuarios SET usu_nombre = '$this->usu_nombre', usu_tipoid = '$this->usu_tipoid', usu_numerotel = '$this->usu_numerotel', usu_correo = '$this->usu_correo', usu_contrasena = '$this->usu_contrasena', usu_estado = '$this->usu_estado', idsexo = '$this->idsexo', idroles = '$this->idroles'
        WHERE idusuarios = '$this->idusuarios'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function consultarUsuario()
    {
        $this->Conexion = Conectarse();
        $sql = "SELECT * FROM usuarios WHERE idusuarios = '$this->idusuarios'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
}
?>