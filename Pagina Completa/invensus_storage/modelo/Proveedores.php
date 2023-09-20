<?php

    class Proveedores {
        private $conn;

    public function __construct() {
        require "conexionBaseDatos.php"; 
        $this->conn = $conn;
    }

    
    private $_idProveedor;
    private $_nombrePR;
    private $_direccionPR;
    private $_emailPR;
    private $_telefonoPR;
    private $_tipo_PagoPR;
    private $_estadoPR;

    public function entrega_productos() {
    }

    public function setIdProveedor($aIdProveedor) {
        $this->_idProveedor = $aIdProveedor;
    }

    public function getIdProveedor() {
        return $this->_idProveedor;
    }

    public function setNombrePR($aNombrePR) {
        $this->_nombrePR = $aNombrePR;
    }

    public function getNombrePR() {
        return $this->_nombrePR;
    }

    public function setDireccionPR($aDireccionPR) {
        $this->_direccionPR = $aDireccionPR;
    }

    public function getDireccionPR() {
        return $this->_direccionPR;
    }

    public function setEmailPR($aEmailPR) {
        $this->_emailPR = $aEmailPR;
    }

    public function getEmailPR() {
        return $this->_emailPR;
    }

    public function setTelefonoPR($aTelefonoPR) {
        $this->_telefonoPR = $aTelefonoPR;
    }

    public function getTelefonoPR() {
        return $this->_telefonoPR;
    }

    public function setTipo_PagoPR($aTipo_PagoPR) {
        $this->_tipo_PagoPR = $aTipo_PagoPR;
    }

    public function getTipo_PagoPR() {
        return $this->_tipo_PagoPR;
    }

    public function setEstadoPR($aEstadoPR) {
        $this->_estadoPR = $aEstadoPR;
    }

    public function getEstadoPR() {
        return $this->_estadoPR;
    }

    public function insertarProveedor($conn, $pro_nombre, $pro_direccion, $pro_mail, $pro_telefono, $pro_estado) {
        $sql = "INSERT INTO proveedores (pro_nombre, pro_direccion, pro_mail, pro_telefono, pro_estado) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $pro_nombre, $pro_direccion, $pro_mail, $pro_telefono, $pro_estado);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    public function getProveedorPorID($conn, $idProveedor) {
        $sql = "SELECT * FROM proveedores WHERE idproveedores = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idProveedor);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; 
        }
    }
    public function actualizarProveedor($idProveedor, $nuevoNombre, $nuevaDireccion, $nuevoCorreo, $nuevoTelefono, $nuevoEstado) {
        $sql = "UPDATE proveedores SET pro_nombre=?, pro_direccion=?, pro_mail=?, pro_telefono=?, pro_estado=? WHERE idproveedores=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $nuevoNombre, $nuevaDireccion, $nuevoCorreo, $nuevoTelefono, $nuevoEstado, $idProveedor);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            return false;
        }

    }

    public function listarProveedores($conn) {
        $sql = "SELECT * FROM proveedores";
        $result = $conn->query($sql);
    
        $proveedores = array();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $proveedores[] = $row;
            }
        }
    
        return $proveedores;
    }
}

?>
