<?php
function Conectarse()
{
    $Conexion = new mysqli("localhost","root", "", "invensus_storage");

    if ($Conexion->connect_errno)
        echo "Problemas en la conexion ". $Conexion->connect_error;
    else 
        return $Conexion;
}



?>