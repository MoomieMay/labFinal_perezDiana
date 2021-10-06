<?php

require_once 'DAO.php';
require_once 'DAOInterfaceUsuario.php';
require_once '../entidades/Usuario.php';

class UsuarioDAO extends DAO implements DAOInterfaceUsuario{
    //Constructor
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    // Métodos
    
    public function alta($objeto): bool {
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $nombre = $objeto->getNombre();
        $apellido = $objeto->getApellido();
        $dni = $objeto->getDni();
        $correo = $objeto->getCorreo();
        $clave = $objeto->getClave();
        $localidad = $objeto->getLocalidad();
        $estado = $objeto->getEstado();
        
        $consulta = 'SELECT * FROM usuarios U, artistas A WHERE U.id_usuario = "'.$id.'" OR A.correo_artista = "'.$correo.'" OR U.correo_usuario = "'.$correo.'";';   
        //where user_cuenta = cuenta and (id_usuario <>id) 
         if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 1){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'insert into usuarios values(null, :nombre, :apellido, :dni, :correo, :clave, :localidad, 1);';
                    if($stmt = $this->conexion->prepare($sql)){
                        if($stmt->execute(array("nombre"=>$objeto->getNombre(), "apellido"=>$objeto->getApellido(), "dni"=>$objeto->getDni(),
                            "correo"=>$objeto->getCorreo(), "clave"=>$objeto->getClave(), "localidad"=>$objeto->getLocalidad()))){             
                            $objeto->setId((int)$this->conexion->lastInsertId());
                            $this->setId($objeto->getId());
                            
                            $resultado = true;
                        }
                        else $this->setError($stmt->errorInfo()[2]);
                        $stmt = null;
                    }
                    else $this->setError($this->conexion->errorInfo()[2]);
                }
            }
        }
        return $resultado;
    }

    public function baja($objeto): bool {
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $consulta = 'SELECT * FROM usuarios WHERE id_usuario = "'.$id.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE usuarios SET estado_artista = 0 WHERE id_usuario = "'.$id.'";';

                    if($stmt = $this->conexion->prepare($sql)){                    
                        if($stmt->execute()){
                            $resultado = true;
                        }
                        else $this->setError($stmt->errorInfo()[2]);
                        $stmt = null;
                    }
                    else $this->setError($this->conexion->errorInfo()[2]);//devuelve false o excepcion si no es posible
                }
            }
        }
        return $resultado;
    }
    
    public function modificar($objeto): bool {
        
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $nombre = $objeto->getNombre();
        $apellido = $objeto->getApellido();
        $correo = $objeto->getCorreo();
        $consulta = 'SELECT * FROM usuarios WHERE id_usuario = "'.$id.'" OR correo_usuario = "'.$correo.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE usuarios SET nombre_usuario = :nombre, apellido_usuario = :apellido, correo_usuario = :correo WHERE id_usuario = "'.$id.'";';

                    if($stmt = $this->conexion->prepare($sql)){                    
                        if($stmt->execute(array("nombre"=>$objeto->getNombre(), "apellido"=>$objeto->getApellido(), "correo"=>$objeto->getCorreo()))){
                            $resultado = true;
                        }
                        else $this->setError($stmt->errorInfo()[2]);
                        $stmt = null;
                    }
                    else $this->setError($this->conexion->errorInfo()[2]);//devuelve false o excepcion si no es posible
                }
            }
        }
        return $resultado;
    }
    
    public function cambiarClave($objeto): bool {
        
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $clave = $objeto->getClave();
        $aux = $objeto->getAux();
        
        $consulta = 'SELECT * FROM usuarios WHERE id_usuario = "'.$id.'" AND clave_usuario = "'.$clave.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE usuarios SET clave_usuario = :aux WHERE id_usuario = "'.$id.'";';

                    if($stmt = $this->conexion->prepare($sql)){                    
                        if($stmt->execute(array( 
                            "aux"=>$objeto->getAux()))){
                            $resultado = true;
                        }
                        else $this->setError($stmt->errorInfo()[2]);
                        $stmt = null;
                    }
                    else $this->setError($this->conexion->errorInfo()[2]);//devuelve false o excepcion si no es posible
                }
            }
        }
        return $resultado;
    }

    public function cargar($id): \Usuario {
        $usuario = new Usuario();
        if(!is_integer($id) || ($id <= 0)){
            $this->setError("Id invalido");
            return false;
        }
        $sql = "select * FROM usuarios WHERE id_usuario = :id;";
        if(($stmt = $this->conexion->prepare($sql))){
            if($stmt->execute(array("id"=>$id ))){
                if($stmt->rowCount() == 1){
                    $registro = $stmt->fetch();
                    $usuario->setId((int)$registro->id_usuario);
                    $usuario->setNombre($registro->nombre_usuario);
                    $usuario->setApellido($registro->apellido_usuario);
                    $usuario->setCorreo($registro->correo_usuario);
                    $usuario->setClave($registro->clave_usuario);
                    $usuario->setLocalidad($registro->localidad_usuario);
                    $usuario->setPerfil($registro->perfil_usuario);
                    $usuario->setDisciplina($registro->disciplina_usuario);
                    $usuario->setDescripcion($registro->descripcion_usuario);
                    $usuario->setFacebook($registro->facebook_usuario);
                    $usuario->setInstagram($registro->instagram_usuario);
                    $usuario->setYoutube($registro->youtube_usuario);
                }
            }
            else $this->setError($stmt->errorInfo()[2]);
            $stmt = null;
        }
        else $this->setError($this->conexion->errorInfo()[2]);//devuelve false o excepcion si no es posible
        
    return $usuario;
        
    }

    public function listar($filtros): array {
        
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS *  FROM usuarios ";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
             
            $clausulas[] = "(nombre_usuario LIKE'".$filtros->{"clave"}."%' OR apellido_usuario LIKE'".$filtros->{"clave"}."%') AND perfil_usuario NOT LIKE 'usuario'";
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_usuario ASC";
        
        $sql .= (is_integer($filtros->{"indice"}) && is_integer($filtros->{"cantidad"}) && ($filtros->{"cantidad"} >0))
        ? " LIMIT ".$filtros->{"indice"}.", ".$filtros->{"cantidad"}.";" : ";";
                
        if($stmt = $this->conexion->prepare($sql)){
            if($stmt->execute()){
                $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($stmtTotal = $this->conexion->prepare("SELECT FOUND_ROWS();")){
                    if($stmtTotal->execute()){
                        $total = $stmtTotal->fetch(PDO::FETCH_NUM);
                        $this->setRegistrosEncontrados((int)$total[0]);
                        unset($total);
                    }
                    $stmtTotal = null;
                }
                else{ $this->setError($this->conexion->errorInfo()[2]);}
            }
            else{ $this->setError($stmt->errorInfo()[2]);}
            $stmt = null;
        }
        else{ $this->setError($this->conexion->errorInfo()[2]);}
        
        return $registros;
    }
    
    public function listarusu($filtros): array {
        
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS *  FROM usuarios ";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
             
            $clausulas[] = "perfil_usuario LIKE'".$filtros->{"clave"}."%'";
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_usuario ASC";
        
        $sql .= (is_integer($filtros->{"indice"}) && is_integer($filtros->{"cantidad"}) && ($filtros->{"cantidad"} >0))
        ? " LIMIT ".$filtros->{"indice"}.", ".$filtros->{"cantidad"}.";" : ";";
                
        if($stmt = $this->conexion->prepare($sql)){
            if($stmt->execute()){
                $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($stmtTotal = $this->conexion->prepare("SELECT FOUND_ROWS();")){
                    if($stmtTotal->execute()){
                        $total = $stmtTotal->fetch(PDO::FETCH_NUM);
                        $this->setRegistrosEncontrados((int)$total[0]);
                        unset($total);
                    }
                    $stmtTotal = null;
                }
                else{ $this->setError($this->conexion->errorInfo()[2]);}
            }
            else{ $this->setError($stmt->errorInfo()[2]);}
            $stmt = null;
        }
        else{ $this->setError($this->conexion->errorInfo()[2]);}
        
        return $registros;
    }
    
    public function completar($objeto): bool {
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $correo = $objeto->getCorreo();
        $descripcion = $objeto->getDescripcion();
        $facebook = $objeto->getFacebook();
        $instagram = $objeto->getInstagram();
        $youtube = $objeto->getYoutube();
        
        $consulta = 'SELECT * FROM usuarios WHERE id_usuario = "'.$id.'" OR correo_usuario = "'.$correo.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE usuarios SET descripcion_usuario = :descripcion, facebook_usuario = :facebook, instagram_usuario = :instagram, youtube_usuario = :youtube WHERE id_usuario = "'.$id.'";';

                    if($stmt = $this->conexion->prepare($sql)){                    
                        if($stmt->execute(array("descripcion"=>$objeto->getDescripcion(), "facebook"=>$objeto->getFacebook(), "instagram"=>$objeto->getInstagram(), "youtube"=>$objeto->getYoutube()))){
                            $resultado = true;
                        }
                        else $this->setError($stmt->errorInfo()[2]);
                        $stmt = null;
                    }
                    else $this->setError($this->conexion->errorInfo()[2]);//devuelve false o excepcion si no es posible
                }
            }
        }
        return $resultado;
    }

}
