<?php

require_once 'DAO.php';
require_once 'DAOInterfaceProduccion.php';
require_once '../entidades/Produccion.php';

class ProduccionDAO extends DAO implements DAOInterfaceProduccion {
    //Constructor
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    // Métodos
    
    public function alta($objeto): bool {
        $this->setError("");
        $resultado = false;
        
        $id = $objeto->getId();
        
        $artista = $objeto->getArtista();
        $tipo = $objeto->getTipo();
        $categoria = $objeto->getCategoria();
        $nombre = $objeto->getNombre();
        $descripcion = $objeto->getDescripcion();
        $direccion = $objeto->getDireccion();
        $localidad = $objeto->getLocalidad();
        $fecha = $objeto->getFecha();
        $hora = $objeto->getHora();
        $precio = $objeto->getPrecio();
        $cupo = $objeto->getCupo();
        $asistentes = $objeto->getAsistentes();
        $estado = $objeto->getEstado();
        
        $consulta = 'SELECT * FROM producciones WHERE id_produccion = "'.$id.'";';   
        //where user_cuenta = cuenta and (id_usuario <>id) 
         if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 1){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'insert into producciones values(null, :artista, :tipo, :categoria, :nombre, :descripcion, :direccion, :localidad, :fecha, :hora, :precio, :cupo, 0, 1);';
                    if($stmt = $this->conexion->prepare($sql)){
                        if($stmt->execute(array("artista"=>$objeto->getArtista(), "tipo"=>$objeto->getTipo(), "categoria"=>$objeto->getCategoria(),
                            "nombre"=>$objeto->getNombre(), "descripcion"=>$objeto->getDescripcion(), "direccion"=>$objeto->getDireccion(), "localidad"=>$objeto->getLocalidad(),
                           "fecha"=>$objeto->getFecha(), "hora"=>$objeto->getHora() ,"precio"=>$objeto->getPrecio(), "cupo"=>$objeto->getCupo()))){             
                            $objeto->setId((int)$this->conexion->lastInsertId());
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
        $consulta = 'SELECT * FROM producciones WHERE id_produccion = "'.$id.'";';   
        if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 2){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'UPDATE producciones SET estado_produccion = 0 WHERE id_produccion = "'.$id.'";';

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

    public function cargar($id): \Produccion {
        $produccion = new Produccion();
        if(!is_integer($id) || ($id <= 0)){
            $this->setError("Id invalido");
            return false;
        }
        $sql = "select * FROM producciones WHERE id_produccion = :id;";
        if(($stmt = $this->conexion->prepare($sql))){
            if($stmt->execute(array("id"=>$id ))){
                if($stmt->rowCount() == 1){
                    $registro = $stmt->fetch();
                    $produccion->setId((int)$registro->id_produccion);
                    $produccion->setArtista($registro->id_artista);
                    $produccion->setTipo($registro->tipo_produccion);
                    $produccion->setCategoria($registro->categoria_produccion);
                    $produccion->setNombre($registro->nombre_produccion);
                    $produccion->setDescripcion($registro->descripcion_produccion);
                    $produccion->setLocalidad($registro->localidad_produccion);
                    $produccion->setDireccion($registro->direccion_produccion);
                    $produccion->setFecha($registro->fecha_produccion);
                    $produccion->setHora($registro->hora_produccion);
                    $produccion->setPrecio($registro->precio_produccion);
                    $produccion->setCupo($registro->cupo_produccion);
                }
            }
            else $this->setError($stmt->errorInfo()[2]);
            $stmt = null;
        }
        else $this->setError($this->conexion->errorInfo()[2]);//devuelve false o excepcion si no es posible
        
    return $produccion;
    }

    public function listar($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT * FROM producciones P, artistas A";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(localidad_produccion LIKE '".$filtros->{"clave"}."%')";
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY localidad_produccion ASC";
        
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
    
    public function listartipo($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM producciones P, artistas A";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(P.id_artista=A.id_artista AND tipo_produccion LIKE '".$filtros->{"clave"}."%')";
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_produccion ASC";
        
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
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM producciones";
        $clausulas = [];
        $sugestivo = false;
        
        //Ninguna clave vacía
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(tipo_produccion = '".$filtros->{"clave"}."' AND localidad_produccion LIKE '".$filtros->{"clave2"}."%' AND categoria_produccion LIKE '".$filtros->{"clave3"}."%')";
            $sugestivo = true; 
        }  
        //Clave de Localidad vacía - Clave2
        //if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0 && is_string($filtros->{"clave3"}) && strlen($filtros->{"clave3"}) > 0){
           // $clausulas[] = "(tipo_produccion = '".$filtros->{"clave"}."' AND categoria_produccion LIKE '".$filtros->{"clave3"}."%')";
           // }$sugestivo = true;
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_produccion ASC";
        
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
    public function listarFiltrosCat($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM producciones";
        $clausulas = [];
        $sugestivo = false;
        
        
        //Clave de Localidad vacía - Clave2
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0 && is_string($filtros->{"clave3"}) && strlen($filtros->{"clave3"}) > 0){
            $clausulas[] = "(tipo_produccion = '".$filtros->{"clave"}."' AND categoria_produccion LIKE '".$filtros->{"clave3"}."%')";
           $sugestivo = true;
           
            }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_produccion ASC";
        
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
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM producciones";
        $clausulas = [];
        $sugestivo = false;
        
        //Clave de Categoria vacía - Clave2
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0 && is_string($filtros->{"clave2"}) && strlen($filtros->{"clave2"}) > 0){
            $clausulas[] = "(tipo_produccion = '".$filtros->{"clave"}."' AND localidad_produccion LIKE '".$filtros->{"clave2"}."%')";
           $sugestivo = true;
           
            }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_produccion ASC";
        
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
    
    
    
    
    
    
    
    
    
    
    public function listartabla($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM producciones";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(id_artista LIKE '".$filtros->{"clave"}."%')";
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY nombre_produccion ASC";
        
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

    
}