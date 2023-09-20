<?php

class Categorias {

	private $_idCategorias;
	private $_nombreC;
	public function setIdCategorias($aIdCategorias) {
		$this->_idCategorias = $aIdCategorias;
	}
	public function getIdCategorias() {
		return $this->_idCategorias;
	}

	public function setNombreC($aNombreC) {
		$this->_nombreC = $aNombreC;
	}
	public function getNombreC() {
		return $this->_nombreC;
	}

	public function crearCategoria($id, $nombre){
		$this -> IdCategorias = $id;
		$this -> NombreC = $nombre;
	}

	public function agregarCategoria(){
		$this -> Conexion=Conectarse();
		$sql = "insert into categorias (idcategoria, cat_nombre)
		values ('$this->IdCategorias', '$this->NombreC')";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}

	public function modificarCategoria(){
		$this->Conexion=Conectarse();
		$sql="update categorias where idcategoria = '$this->IdCategorias'";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}

	public function consultaCategoria(){
		$this->Conexion=Conectarse();
		$sql="select * from categorias where 1";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}

}
?>