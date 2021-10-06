<?php
/**
 * Description of Usuario
 *
 * @author dianaperez
 */
class Artista {
    private $id, $nombre, $apellido, $correo, $clave, $localidad, $disciplina, $estado, $idTarj, $descripcion, $facebook, $instagram, $youtube, $aux;
    
    //Constructor 
    
    function __construct() {
        $this->setId(0);
        $this->setNombre("");
        $this->setApellido("");
        $this->setCorreo("");
        $this->setClave("");
        $this->setLocalidad("");
        $this->setDisciplina("");
        $this->setEstado("");
        $this->setDescripcion("");
        $this->setFacebook("");
        $this->setInstagram("");
        $this->setYoutube("");
        $this->setIdTarj(0);
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

    function getCorreo() {
        return $this->correo;
    }

    function getClave() {
        return $this->clave;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDisciplina() {
        return $this->disciplina;
    }

    function getEstado() {
        return $this->estado;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFacebook() {
        return $this->facebook;
    }

    function getInstagram() {
        return $this->instagram;
    }

    function getYoutube() {
        return $this->youtube;
    }

    function getIdTarj() {
        return $this->idTarj;
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

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setDisciplina($disciplina) {
        $this->disciplina = $disciplina;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    function setInstagram($instagram) {
        $this->instagram = $instagram;
    }

    function setYoutube($youtube) {
        $this->youtube = $youtube;
    }

    function setIdTarj($idTarj) {
        $this->idTarj = $idTarj;
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
            "correo" => $this->getCorreo(),
            "clave" => $this->getClave(),
            "localidad" => $this->getLocalidad(),
            "disciplina" => $this->getDisciplina(),
            "estado" => $this->getEstado(),
            "idTarj" => $this->getIdTarj(),
            "descripcion" => $this->getDescripcion(),
            "facebook" => $this->getFacebook(),
            "instagram" => $this->getInstagram(),
            "youtube" => $this->getYoutube(),
            "aux" => $this->getAux(),
        );
        return $salida;
    }
    
    public function toJSON(): object{
               
        $json = json_decode("{}");
        $json->{"id"} = $this->getId();
        $json->{"nombre"} = $this->getNombre();
        $json->{"apellido"} = $this->getApellido();
        $json->{"correo"} = $this->getCorreo();
        $json->{"clave"} = $this->getClave();
        $json->{"localidad"} = $this->getLocalidad();
        $json->{"disciplina"} = $this->getDisciplina();
        $json->{"estado"} = $this->getEstado();
        $json->{"idTarj"} = $this->getIdTarj();
        $json->{"descripcion"} = $this->getDescripcion();
        $json->{"facebook"} = $this->getFacebook();
        $json->{"instagram"} = $this->getInstagram();
        $json->{"youtube"} = $this->getYoutube();
        $json->{"aux"} = $this->getAux();
        //devuelve un string con la representacion de json
        return $json;
    }

}
