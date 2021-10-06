<?php
    //require_once '../secret.php';

    //convierte el stringify a json
    $data = json_decode($_POST["data"]);
    $respuesta = json_decode('{"accion":"","registros":[],"error":"","total":0}');
    
    require_once '../entidades/Comprobante.php';
    require_once '../modelos/Conexion.php';
    require_once '../modelos/comprobanteDAO.php';
    
    $respuesta->{"accion"} = $data->{"accion"};
    
    //validaciones: que exista data en post, no haya errores en json_decode
    
    
    //Si recibe de la vista la acción ALTA
    if($data->{"accion"} === "ALTA"){
        try{
        $conexion = Conexion::establecer();
        $comprobante = new Comprobante();
        
        $comprobante->setProduccion($data->{"produccion"});
        $comprobante->setUsuario($data->{"usuario"}); 
        
        $comprobanteDAO = new ComprobanteDAO($conexion);
        
        if($comprobanteDAO->alta($comprobante)){
            $respuesta->{"registros"} = $comprobante->toJSON();
        }else{
            $respuesta->{"error"} = $comprobanteDAO->getError();
        }
        //automaticamente pdo cierra la conexion
        $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }

    
    //Si recibe de la vista la acción BAJA
    else if ($data->{"accion"} === "BAJA"){
        try{
            $conexion = Conexion::establecer();              
            $comprobante = new Usuario();
            $comprobante->setId((int)$data->{"id"});

            $comprobanteDAO = new UsuarioDAO($conexion);
            if($comprobanteDAO->baja($comprobante)){
                $respuesta->{"registros"} = $comprobante->toJSON();
            }else{
                $respuesta->{"error"} = $comprobanteDAO->getError();
            }
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    
    //Si recibe de la vista la acción MODIFICAR
    else if ($data->{"accion"} === "MODIFICAR"){
        try{
            $conexion = Conexion::establecer();              
            $comprobante = new Usuario();
            $comprobante->setId((int)$data->{"id"});
            $comprobante->setNombre($data->{"nombre"});
            $comprobante->setApellido($data->{"apellido"});
            $comprobante->setCorreo($data->{"correo"});
            //$comprobante->setClave(md5($data->{"clave"}));
            //$comprobante->setLocalidad($data->{"localidad"});
            //$comprobante->setPerfil($data->{"perfil"});
            //$comprobante->setDisciplina($data->{"disciplina"});
           
            
            $comprobanteDAO = new UsuarioDAO($conexion);
            if($comprobanteDAO->modificar($comprobante)){
                $respuesta->{"registros"} = $comprobante->toJSON();
                
            }else{
                $respuesta->{"error"} = $comprobanteDAO->getError();
            }
            
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    
    
    //Si recibe de la vista la acción CARGAR
     else if($data->{"accion"} === "CARGAR"){
        try{
            $conexion = Conexion::establecer();
            $comprobanteDAO = new ComprobanteDAO($conexion);
            
            $comprobante = $comprobanteDAO->cargar($data->{"id"});

            if($comprobante->getId() > 0){
                $respuesta->{"registros"} = $comprobante->toJSON();
            }
            else{
                $respuesta->{"error"} = $comprobanteDAO->getError();
            }

            $conexion = null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    //Si recibe de la vista la acción LISTAR
    else if($data->{"accion"} === "TABLAUSU"){
            try{
            $conexion = Conexion::establecer();
            $comprobanteDAO = new ComprobanteDAO($conexion);
            $respuesta->{"registros"} = $comprobanteDAO->listar($data);
            $respuesta->{"error"} = $comprobanteDAO->getError();
            $respuesta->{"total"} = $comprobanteDAO->getRegistrosEncontrados();
            $respuesta->{"logueado"} = 0;
            session_start();
            if (isset($_SESSION["logueado"]) && ($_SESSION["logueado"] == 2020)){
                $respuesta->{"logueado"} = 1;
            }
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    //Si recibe de la vista la acción COMPLETAR
    else if ($data->{"accion"} === "COMPLETAR"){
        try{
            $conexion = Conexion::establecer();              
            $comprobante = new Usuario();
            $comprobante->setId((int)$data->{"id"});
            $comprobante->setDescripcion($data->{"descripcion"});
            $comprobante->setFacebook($data->{"facebook"});
            $comprobante->setInstagram($data->{"instagram"});
            $comprobante->setYoutube($data->{"youtube"});           
            
            $comprobanteDAO = new UsuarioDAO($conexion);
            if($comprobanteDAO->completar($comprobante)){
                $respuesta->{"registros"} = $comprobante->toJSON();
                
            }else{
                $respuesta->{"error"} = $comprobanteDAO->getError();
            }
            
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    //Si recibe de la vista la acción LISTAR, lista las producciones por Tipo
    else if($data->{"accion"} === "LISTARTABLAUSU"){
            try{
            $conexion = Conexion::establecer();
            $comprobanteDAO = new ComprobanteDAO($conexion);
            $respuesta->{"registros"} = $comprobanteDAO->listartablausu($data);
            $respuesta->{"error"} = $comprobanteDAO->getError();
            $respuesta->{"total"} = $comprobanteDAO->getRegistrosEncontrados();
            $respuesta->{"logueado"} = 0;
            session_start();
            if (isset($_SESSION["logueado"]) && ($_SESSION["logueado"] == 2020)){
                $respuesta->{"logueado"} = 1;
            }
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    //Lista las ventas realizadas entre dos fechas dadas
    else if($data->{"accion"} === "LISTARVENTAS"){
            try{
            $conexion = Conexion::establecer();
            $comprobanteDAO = new ComprobanteDAO($conexion);
            $respuesta->{"registros"} = $comprobanteDAO->listarVentas($data);
            $respuesta->{"error"} = $comprobanteDAO->getError();
            $respuesta->{"total"} = $comprobanteDAO->getRegistrosEncontrados();
            $respuesta->{"logueado"} = 0;
            session_start();
            if (isset($_SESSION["logueado"]) && ($_SESSION["logueado"] == 2020)){
                $respuesta->{"logueado"} = 1;
            }
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    
    //convierte el json en string, es lo que se pasa entre servidores
    echo json_encode($respuesta);
?>
