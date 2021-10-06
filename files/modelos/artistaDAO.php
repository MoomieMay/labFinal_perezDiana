<?php

require_once 'DAO.php';
require_once 'DAOInterfaceArtista.php';
require_once '../entidades/Artista.php';

class ArtistaDAO extends DAO implements DAOInterfaceArtista{
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
        $correo = $objeto->getCorreo();
        $clave = $objeto->getClave();
        $localidad = $objeto->getLocalidad();
        $disciplina = $objeto->getDisciplina();
        
        $consulta = 'SELECT * FROM usuarios U, artistas A WHERE A.id_artista = "'.$id.'" OR A.correo_artista = "'.$correo.'" OR U.correo_usuario = "'.$correo.'";';   
        //where user_cuenta = cuenta and (id_artista <>id) 
         if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 1){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'INSERT into artistas values(null, :nombre, :apellido, :correo, :clave, :localidad, :disciplina, 1);';
                    if($stmt = $this->conexion->prepare($sql)){
                        if($stmt->execute(array("nombre"=>$objeto->getNombre(), "apellido"=>$objeto->getApellido(),
                            "correo"=>$objeto->getCorreo(), "clave"=>$objeto->getClave(), "localidad"=>$objeto->getLocalidad(),
                            "disciplina"=>$objeto->getDisciplina()))){             
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
    
    
    public function altaTarjeta($objeto): bool {
        $this->setError("");
        $resultado = false;
        
        $idTarj = $objeto->getIdTarj();
        $id = $objeto->getId();
        $descripcion = $objeto->getDescripcion();
        $facebook = $objeto->getFacebook();
        $instagram = $objeto->getInstagram();
        $youtube = $objeto->getYoutube();
        
        $consulta = 'SELECT * FROM tarjetas WHERE id_artista = "'.$id.'";';   
        //where user_cuenta = cuenta and (id_artista <>id) 
         if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 1){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'INSERT into tarjetas values(null, :id, :descripcion, :facebook, :instagram, :youtube);';
                    if($stmt = $this->conexion->prepare($sql)){
                        if($stmt->execute(array(
                            "id"=>$objeto->getId(), 
                            "descripcion"=>$objeto->getDescripcion(),
                            "facebook"=>$objeto->getFacebook(), 
                            "instagram"=>$objeto->getInstagram(), 
                            "youtube"=>$objeto->getYoutube()))){             
                            
                            $objeto->setIdTarj((int)$this->conexion->lastInsertId());
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
        $consulta = 'SELECT * FROM artistas WHERE id_artista = "'.$id.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE artistas SET estado_artista = 0 WHERE id_artista = "'.$id.'";';

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
        $consulta = 'SELECT * FROM artistas WHERE id_artista = "'.$id.'" OR correo_artista = "'.$correo.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE artistas SET nombre_artista = :nombre, apellido_artista = :apellido, correo_artista = :correo WHERE id_artista = "'.$id.'";';

                    if($stmt = $this->conexion->prepare($sql)){                    
                        if($stmt->execute(array(
                            "nombre"=>$objeto->getNombre(), 
                            "apellido"=>$objeto->getApellido(), 
                            "correo"=>$objeto->getCorreo()))){
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
    
    
      public function actualizarTA($objeto): bool {
        
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $descripcion = $objeto->getDescripcion();
        $facebook = $objeto->getFacebook();
        $instagram = $objeto->getInstagram();
        $youtube = $objeto->getYoutube();
        $consulta = 'SELECT * FROM tarjetas WHERE id_artista = "'.$id.'"';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE tarjetas SET presentacion_artista = :descripcion, facebook_artista = :facebook, instagram_artista = :instagram, youtube_artista = :youtube WHERE id_artista = "'.$id.'";';

                    if($stmt = $this->conexion->prepare($sql)){                    
                        if($stmt->execute(array(
                            "descripcion"=>$objeto->getDescripcion(), 
                            "facebook"=>$objeto->getFacebook(),
                            "instagram"=>$objeto->getInstagram(),
                            "youtube"=>$objeto->getYoutube()))){
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
        
        $consulta = 'SELECT * FROM artistas WHERE id_artista = "'.$id.'" AND clave_artista = "'.$clave.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE artistas SET clave_artista = :aux WHERE id_artista = "'.$id.'";';

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


    public function cargar($id): \Artista {
        $artista = new Artista();
        if(!is_integer($id) || ($id <= 0)){
            $this->setError("Id invalido");
            return false;
        }
        $sql = "select * FROM tarjetas T, artistas A WHERE T.id_artista = :id;";
        if(($stmt = $this->conexion->prepare($sql))){
            if($stmt->execute(array("id"=>$id ))){
                if($stmt->rowCount() == 1){
                    $registro = $stmt->fetch();
                    //Artistas
                    $artista->setId((int)$registro->id_artista);
                    $artista->setNombre($registro->nombre_artista);
                    $artista->setApellido($registro->apellido_artista);
                    $artista->setCorreo($registro->correo_artista);
                    $artista->setClave($registro->clave_artista);
                    $artista->setLocalidad($registro->localidad_artista);
                    $artista->setDisciplina($registro->disciplina_artista);
                    //Tarjetas
                    $artista->setDescripcion($registro->presentacion_artista);
                    $artista->setFacebook($registro->facebook_artista);
                    $artista->setInstagram($registro->instagram_artista);
                    $artista->setYoutube($registro->youtube_artista);
                }
            }
            else $this->setError($stmt->errorInfo()[2]);
            $stmt = null;
        }
        else $this->setError($this->conexion->errorInfo()[2]);//devuelve false o excepcion si no es posible
        
    return $artista;
        
    }

    public function listar($filtros): array {
    $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError(0);
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM artistas";
        $clausulas = [];
        //falta identificar los filtros que condicionan la busqueda
        $sugestivo = false;
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(nombre_artista LIKE '".$filtros->{"clave"}."%')";
            $sugestivo = true;
        }
        
        //********************************//
        //concatena de forma automatica los filtros en la instruccion SQL
        if(count($clausulas)>0){
            $sql .= " WHERE ";
            foreach ($clausulas as $clausulas){
                $sql .= $clausulas." AND ";
            }
            $sql = substr_replace($sql, "", strlen($sql)-5, 5);
        }
        //filtros que condicionan la visualizacion
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0)) ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_artista ASC";
        $sql .= (is_integer($filtros->{"indice"}) && is_integer($filtros->{"cantidad"}) && ($filtros->{"cantidad"} > 0)) ? " LIMIT ".$filtros->{"indice"}.", ".$filtros->{"cantidad"}.";" : ";";
        
        if($stmt = $this->conexion->prepare($sql)){
            //if($sujestivo){$stmt->bindParam(":clave", $filtros->{"clave"}, PDO::PARAM_STR);}
            if($stmt->execute()){
                $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($stmtTotal = $this->conexion->prepare("SELECT FOUND_ROWS();")){
                    if($stmtTotal->execute()){
                        $total = $stmtTotal->fetch(PDO::FETCH_NUM);
                        $this->setRegistrosEncontrados((int)$total[0]);
                        unset($total);
                    }
                    $stmtTotal = null;
                }else{
                    $this->setError($this->conexion->errorInfo()[2]);
            }   
        }else{
            $this->setError($stmt->errorInfo()[2]);
        }$stmt = null;
        }else{
            $this->setError($this->conexion->errorInfo()[2]);
        }
        return $registros;
    }
    
    public function listar2($filtros): array {
        
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS *  FROM artistas ";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
             
            $clausulas[] = "(nombre_artista LIKE'".$filtros->{"clave"}."%' OR apellido_artista LIKE'".$filtros->{"clave"}."%') AND perfil_artista NOT LIKE 'artista'";
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_artista ASC";
        
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
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS A.id_artista, A.nombre_artista, A.apellido_artista, A. localidad_artista, A.disciplina_artista, A.correo_artista, T.presentacion_artista, T.facebook_artista, T.instagram_artista, T.youtube_artista  "
                . "FROM artistas A, tarjetas T WHERE T.id_artista=A.id_artista";
        
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_artista ASC";
        
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
    
    
    public function buscarArtista($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT * FROM artistas A, tarjetas T";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(A.id_artista = T.id_artista AND (nombre_artista LIKE '".$filtros->{"clave"}."%' OR apellido_artista LIKE '".$filtros->{"clave"}."%'))";
            
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_artista ASC";
        
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
    
    
    
    //----------------------------------------------------------------------------------------------------------------------
    public function listarFiltros($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM artistas A, tarjetas T";
        $clausulas = [];
        $sugestivo = false;
        
        //Ninguna clave vacía
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(A.id_artista = T.id_artista AND disciplina_artista = '".$filtros->{"clave2"}."' AND localidad_artista LIKE '".$filtros->{"clave"}."%' )";
            $sugestivo = true; 
        }  
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_artista ASC";
        
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

    
    
    //----------------------------------------------------------------------------------------------------------------------
    public function listarFiltrosDisc($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM artistas A, tarjetas T";
        $clausulas = [];
        $sugestivo = false;
        
        //Clave de localidad vacia
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(A.id_artista = T.id_artista AND disciplina_artista = '".$filtros->{"clave"}."' AND localidad_artista LIKE '".$filtros->{"clave2"}."%' )";
            $sugestivo = true; 
        }  
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_artista ASC";
        
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
    
    
    
    //----------------------------------------------------------------------------------------------------------------------
    public function listarFiltrosLoc($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
         $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM artistas A, tarjetas T";
        $clausulas = [];
        $sugestivo = false;
        
        //Clave de disciplina vacia
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(A.id_artista = T.id_artista AND disciplina_artista = '".$filtros->{"clave"}."' AND localidad_artista LIKE '".$filtros->{"clave2"}."%' )";
            $sugestivo = true; 
        }  
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_artista ASC";
        
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
    
    //------------------------------------------------------------------------------
    
    
    
    
    public function completar($objeto): bool {
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $correo = $objeto->getCorreo();
        $descripcion = $objeto->getDescripcion();
        $facebook = $objeto->getFacebook();
        $instagram = $objeto->getInstagram();
        $youtube = $objeto->getYoutube();
        
        $consulta = 'SELECT * FROM artistas WHERE id_artista = "'.$id.'" OR correo_artista = "'.$correo.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE tarjetas SET descripcion_artista = :descripcion, facebook_artista = :facebook, instagram_artista = :instagram, youtube_artista = :youtube WHERE id_artista = "'.$id.'";';

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
