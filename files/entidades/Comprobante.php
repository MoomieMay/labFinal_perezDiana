<?php

/**
 * Description of Produccion
 *
 * @author dianaperez
 */
class Comprobante {
    private $id, $usuario, $nombreUsuario, $apellidoUsuario, $produccion, $precio, $estado, $pago;
    
    //Constructor
    
    function __construct() {
       $this->setId(0);
       $this->setUsuario("");  
       $this->setNombreUsuario("");
       $this->setApellidoUsuario("");
       $this->setProduccion("");
       $this->setPrecio("");
       $this->setEstado("");
       $this->setPago("");
    }
    
    // Getters
    
    function getId() {
        return $this->id;
    }

    function getProduccion() {
        return $this->produccion;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getEstado() {
        return $this->dni;
    }

    function getPago() {
        return $this->pago;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getApellidoUsuario() {
        return $this->apellidoUsuario;
    }

    function getPrecio() {
        return $this->precio;
    }

            
    // Setters
    
    function setId($id) {
        $this->id = $id;
    }

    function setProduccion($produccion) {
        $this->produccion = $produccion;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setEstado($dni) {
        $this->dni = $dni;
    }

    function setPago($pago) {
        $this->pago = $pago;
    }

    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setApellidoUsuario($apellidoUsuario) {
        $this->apellidoUsuario = $apellidoUsuario;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

                    
    // Métodos 
    
    public function toArray(): array{        
           
        $salida = array(
            "id" => $this->getId(),
            "usuario" => $this->getUsuario(),
            "nombreUsuario" => $this->getNombreUsuario(),
            "apellidoUsuario" => $this->getApellidoUsuario(),
            "produccion"=> $this->getProduccion(),
            "precio" => $this->getPrecio(),
            "estado" => $this->getEstado(),
            "pago" => $this->getPago(),
        );
        return $salida;
    }
    
    public function toJSON(): object{
               
        $json = json_decode("{}");
        $json->{"id"} = $this->getId();
        $json->{"usuario"} = $this->getUsuario();
        $json->{"nombreUsuario"} = $this->getNombreUsuario();
        $json->{"apellidoUsuario"} = $this->getApellidoUsuario();
        $json->{"produccion"} = $this->getProduccion();
        $json->{"precio"} = $this->getPrecio();
        $json->{"estado"} = $this->getEstado();
        $json->{"pago"} = $this->getPago();
        
        //devuelve un string con la representacion de json
        return $json;
    }

}