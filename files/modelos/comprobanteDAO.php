<?php

require_once 'DAO.php';
require_once 'DAOInterfaceComprobante.php';
require_once '../entidades/Comprobante.php';
require_once '../entidades/Produccion.php';


class ComprobanteDAO extends DAO implements DAOInterfaceComprobante{
    //Constructor
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    public function alta($objeto): bool {
        $this->setError("");
        $resultado = false;
        $id = $objeto->getId();
        $produccion = $objeto->getProduccion();
        $usuario = $objeto->getUsuario();
        
        $consulta = 'SELECT * FROM comprobantes WHERE id_produccion = "'.$produccion.'" AND id_usuario ="'.$usuario.'";';   
        //where user_cuenta = cuenta and (id_usuario <>id) 
         if($stmt = $this->conexion->prepare($consulta)){
            if($stmt->execute(array())){
                if($stmt->rowCount() >= 1){
                    $this->setError("Duplicado");  
                }
                else{
                    $sql = 'insert into comprobantes values(null, :usuario, :produccion, 1, "26-08-2020");';
                    if($stmt = $this->conexion->prepare($sql)){
                        if($stmt->execute(array("produccion"=>$objeto->getProduccion(), "usuario"=>$objeto->getUsuario()))){             
                            $objeto->setId((int)$this->conexion->lastInsertId());
                            
                            //actualizo los asistentes
                            $sql = 'UPDATE producciones SET asistentes_produccion = asistentes_produccion+1 WHERE id_produccion = "'.$produccion.'";';

                            if($stmt = $this->conexion->prepare($sql)){                    
                            if($stmt->execute()){
                                $resultado = true;
                            }
                            }
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
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS nombre_usuario, apellido_usuario, dni_usuario, correo_usuario FROM comprobantes C, usuarios U ";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
             
            $clausulas[] = "(C.id_produccion ='".$filtros->{"clave"}."') AND (C.id_usuario = U.id_usuario)";
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
    
    //Lista las ventas realizadas entre dos fechas dadas
    public function listarVentas($filtros): array {           
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT U.nombre_usuario, U.apellido_usuario, P.nombre_produccion, P.precio_produccion, C.pago_comprobante "
                . "FROM comprobantes C, usuarios U, producciones P "
                . "WHERE P.id_artista = '".$filtros->{"clave3"}."' "
                . "AND U.id_usuario=C.id_usuario "
                . "AND C.id_produccion=P.id_produccion "
                . "AND C.pago_comprobante BETWEEN '".$filtros->{"clave"}."' AND '".$filtros->{"clave2"}."'";
        
        /* No no
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(C.id_usuario ='".$filtros->{"clave"}."') AND (C.id_produccion = P.id_produccion)";
            $sugestivo = true; 
        }
        //-----------------------------------------------------------
        if(count($clausulas) > 0){
            $sql .= " WHERE ";
            foreach($clausulas as $clausula){ $sql .= $clausula." AND ";}
            $sql = substr_replace($sql, "", strlen($sql)-5,5);
        }*/ 
        $sql .= (is_string($filtros->{"orden"}) && (strlen($filtros->{"orden"}) > 0))
        ? " ORDER BY ".$filtros->{"orden"} : " ORDER BY pago_comprobante ASC"; /*
        
        $sql .= (is_integer($filtros->{"indice"}) && is_integer($filtros->{"cantidad"}) && ($filtros->{"cantidad"} >0))
        ? " LIMIT ".$filtros->{"indice"}.", ".$filtros->{"cantidad"}.";" : ";";
      
        */        
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
    
    
    
    public function listartablausu($filtros): array {
        $registros = array();
        $this->setRegistrosEncontrados(0);
        $this->setError('');
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS P.id_produccion, C.id_usuario, tipo_produccion, nombre_produccion, localidad_produccion, direccion_produccion, fecha_produccion, hora_produccion, id_comprobante FROM comprobantes C, producciones P";
        $clausulas = [];
        $sugestivo = false;
        
        if(is_string($filtros->{"clave"}) && strlen($filtros->{"clave"}) > 0){
            $clausulas[] = "(C.id_usuario ='".$filtros->{"clave"}."') AND (C.id_produccion = P.id_produccion)";
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
    
    

    public function modificar($objeto): bool {
        
    }

}