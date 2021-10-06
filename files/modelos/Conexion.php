<?php

class Conexion {
    public static function establecer(){
        
        require_once '../../lib/config.php';
        
        //existe un cuarto parametro para los errores en modo de desarrollo
        $conexion = new PDO(DB_DATA,DB_USER,DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        if(!$conexion) throw new PDOException ();
        $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //seteo el modo de traer los resultados como OBJETOS. Por defecto es un arreglo
        return $conexion;
    }
}

?>