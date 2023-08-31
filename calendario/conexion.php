<?php
    function regresarConexion(){
        $server = "localhost";
        $usuario = "root";
        $clave = "";
        $base = "balconeria";
        
        $conexion = mysqli_connect($server, $usuario, $clave, $base) or die("Problemas de Conexion");
        mysqli_set_charset($conexion, 'utf8');
        return $conexion;
    }
?>