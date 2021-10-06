<?php

/**
 * Description of Produccion
 *
 * @author dianaperez
 */
class Produccion {
    private $id, $artista, $tipo, $categoria, $nombre, $descripcion, $localidad, $direccion, $fecha, $hora, $precio, $cupo, $asistentes, $estado;
    
    //Constructor
    
    function __construct() {
       $this->setId(0);
       $this->setArtista("");
       $this->setTipo("");
       $this->setCategoria("");
       $this->setNombre("");
       $this->setDescripcion("");
       $this->setLocalidad("");
       $this->setDireccion("");
       $this->setFecha("");
       $this->setHora("");
       $this->setPrecio("");   
       $this->setCupo("");
       $this->setAsistentes("");
       $this->setEstado("");
    }
    
    // Getters
    
    function getId() {
        return $this->id;
    }

    function getArtista() {
        return $this->artista;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getPrecio() {
        return $this->precio;
    }
    
    function getCupo() {
        return $this->cupo;
    }

    function getAsistentes() {
        return $this->asistentes;
    }

    function getEstado() {
        return $this->estado;
    }

        

    // Setters
    
    function setId($id) {
        $this->id = $id;
    }

    function setArtista($artista) {
        $this->artista = $artista;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }
    
    function setCupo($cupo) {
        $this->cupo = $cupo;
    }

    function setAsistentes($asistentes) {
        $this->asistentes = $asistentes;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

            
    // Métodos 
    
    public function toArray(): array{        
           
        $salida = array(
            "id" => $this->getId(),
            "artista" => $this->getArtista(),
            "tipo" => $this->getTipo(),
            "categoria" => $this->getCategoria(),
            "nombre" => $this->getNombre(),
            "descripcion" => $this->getDescripcion(),
            "localidad" => $this->getLocalidad(),
            "direccion" => $this->getDireccion(),
            "fecha" => $this->getFecha(),
            "hora" => $this->getHora(),
            "precio" => $this->getPrecio(),
            "asistentes" => $this->getAsistentes(),
            "estado" => $this->getEstado()
        );
        return $salida;
    }
    
    public function toJSON(): object{
               
        $json = json_decode("{}");
        $json->{"id"} = $this->getId();
        $json->{"artista"} = $this->getArtista();
        $json->{"tipo"} = $this->getTipo();
        $json->{"categoria"} = $this->getCategoria();
        $json->{"nombre"} = $this->getNombre();
        $json->{"descriocion"} = $this->getDescripcion();
        $json->{"localidad"} = $this->getLocalidad();
        $json->{"direccion"} = $this->getDireccion();
        $json->{"fecha"} = $this->getFecha();
        $json->{"hora"} = $this->getHora();
        $json->{"precio"} = $this->getPrecio();
        $json->{"asistentes"} = $this->getAsistentes();
        $json->{"estado"} = $this->getEstado();
        
        //devuelve un string con la representacion de json
        return $json;
    }

}
