<?php
/**
 * Description of Usuario
 *
 * @author dianaperez
 */
class Usuario {
    private $id, $nombre, $apellido, $dni, $correo, $clave, $localidad, $estado, $aux;
    
    //Constructor 
    
    function __construct() {
        $this->setId(0);
        $this->setNombre("");
        $this->setApellido("");
        $this->setDni("");
        $this->setCorreo("");
        $this->setClave("");
        $this->setLocalidad("");
        $this->setEstado("");
        $this->setAux("");
    }
    
    // Getters
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getDni() {
        return $this->dni;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getClave() {
        return $this->clave;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function getEstado() {
        return $this->estado;
    }
    
    function getAux() {
        return $this->aux;
    }

    
            
    // Setters
    
    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setAux($aux) {
        $this->aux = $aux;
    }

                    
    // Métodos
    
    public function toArray(): array{        
           
        $salida = array(
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "apellido" => $this->getApellido(),
            "dni" => $this->getDni(),
            "correo" => $this->getCorreo(),
            "clave" => $this->getClave(),
            "localidad" => $this->getLocalidad(),
            "estado" => $this->getEstado(),
            "aux" => $this->getAux(),
        );
        return $salida;
    }
    
    public function toJSON(): object{
               
        $json = json_decode("{}");
        $json->{"id"} = $this->getId();
        $json->{"nombre"} = $this->getNombre();
        $json->{"apellido"} = $this->getApellido();
        $json->{"estado"} = $this->getEstado();
        $json->{"correo"} = $this->getCorreo();
        $json->{"clave"} = $this->getClave();
        $json->{"localidad"} = $this->getLocalidad();
        $json->{"estado"} = $this->getEstado();
        $json->{"aux"} = $this->getAux();
        //devuelve un string con la representacion de json
        return $json;
    }

}
