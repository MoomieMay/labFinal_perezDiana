<?php
    //require_once '../secret.php';

    //convierte el stringify a json
    $data = json_decode($_POST["data"]);
    $respuesta = json_decode('{"accion":"","registros":[],"error":"","total":0}');
    
    require_once '../entidades/Produccion.php';
    require_once '../modelos/Conexion.php';
    require_once '../modelos/produccionDAO.php';
    
    $respuesta->{"accion"} = $data->{"accion"};
    
    //validaciones: que exista data en post, no haya errores en json_decode
    
    
    //Si recibe de la vista la acción ALTA
    if($data->{"accion"} === "ALTA"){
        try{
        $conexion = Conexion::establecer();
        $produccion = new Produccion();
        
        $produccion->setArtista($data->{"artista"});
        
        $produccion->setTipo($data->{"tipo"});
        $produccion->setCategoria($data->{"categoria"});
        $produccion->setNombre($data->{"nombre"});
        $produccion->setDescripcion($data->{"descripcion"}); 
        $produccion->setDireccion($data->{"direccion"});
        $produccion->setLocalidad($data->{"localidad"});
        $produccion->setFecha($data->{"fecha"});
        $produccion->setHora($data->{"hora"});
        $produccion->setPrecio($data->{"precio"});
        $produccion->setCupo($data->{"cupo"});
        $produccion->setAsistentes(0);
        $produccion->setEstado(1);
        
        $produccionDAO = new ProduccionDAO($conexion);
        
        if($produccionDAO->alta($produccion)){
            $respuesta->{"registros"} = $produccion->toJSON();
        }else{
            $respuesta->{"error"} = $produccionDAO->getError();
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
            $produccion = new Usuario();
            $produccion->setId((int)$data->{"id"});

            $produccionDAO = new UsuarioDAO($conexion);
            if($produccionDAO->baja($produccion)){
                $respuesta->{"registros"} = $produccion->toJSON();
            }else{
                $respuesta->{"error"} = $produccionDAO->getError();
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
            $produccion = new Usuario();
            $produccion->setId((int)$data->{"id"});
            $produccion->setNombre($data->{"nombre"});
            $produccion->setApellido($data->{"apellido"});
            $produccion->setCorreo($data->{"correo"});
            //$produccion->setClave(md5($data->{"clave"}));
            //$produccion->setLocalidad($data->{"localidad"});
            //$produccion->setPerfil($data->{"perfil"});
            //$produccion->setDisciplina($data->{"disciplina"});
           
            
            $produccionDAO = new UsuarioDAO($conexion);
            if($produccionDAO->modificar($produccion)){
                $respuesta->{"registros"} = $produccion->toJSON();
                
            }else{
                $respuesta->{"error"} = $produccionDAO->getError();
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
            $produccionDAO = new ProduccionDAO($conexion);
            
            $produccion = $produccionDAO->cargar($data->{"id"});

            if($produccion->getId() > 0){
                $respuesta->{"registros"} = $produccion->toJSON();
            }
            else{
                $respuesta->{"error"} = $produccionDAO->getError();
            }

            $conexion = null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    //Si recibe de la vista la acción LISTAR, lista las producciones por Localidad
    else if($data->{"accion"} === "LISTAR"){
            try{
            $conexion = Conexion::establecer();
            $produccionDAO = new ProduccionDAO($conexion);
            $respuesta->{"registros"} = $produccionDAO->listar($data);
            $respuesta->{"error"} = $produccionDAO->getError();
            $respuesta->{"total"} = $produccionDAO->getRegistrosEncontrados();
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
    
    //Si recibe de la vista la acción LISTAR, lista las producciones por Tipo
    else if($data->{"accion"} === "LISTARTIPO"){
            try{
            $conexion = Conexion::establecer();
            $produccionDAO = new ProduccionDAO($conexion);
            $respuesta->{"registros"} = $produccionDAO->listartipo($data);
            $respuesta->{"error"} = $produccionDAO->getError();
            $respuesta->{"total"} = $produccionDAO->getRegistrosEncontrados();
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
    
    
    
    
    
    ////////////////////////////////////////////////////////////////////////////
    
    //Si recibe de la vista la acción FILTROS
    else if($data->{"accion"} === "LISTARFILTROS"){
            try{
            $conexion = Conexion::establecer();
            $produccionDAO = new ProduccionDAO($conexion);
            $respuesta->{"registros"} = $produccionDAO->listarFiltros($data);
            $respuesta->{"error"} = $produccionDAO->getError();
            $respuesta->{"total"} = $produccionDAO->getRegistrosEncontrados();
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
    
    //Si recibe de la vista la acción FILTROS
    else if($data->{"accion"} === "LISTARFILTROSCAT"){
            try{
            $conexion = Conexion::establecer();
            $produccionDAO = new ProduccionDAO($conexion);
            $respuesta->{"registros"} = $produccionDAO->listarFiltrosCat($data);
            $respuesta->{"error"} = $produccionDAO->getError();
            $respuesta->{"total"} = $produccionDAO->getRegistrosEncontrados();
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
    
    //Si recibe de la vista la acción FILTROS
    else if($data->{"accion"} === "LISTARFILTROSLOC"){
            try{
            $conexion = Conexion::establecer();
            $produccionDAO = new ProduccionDAO($conexion);
            $respuesta->{"registros"} = $produccionDAO->listarFiltrosLoc($data);
            $respuesta->{"error"} = $produccionDAO->getError();
            $respuesta->{"total"} = $produccionDAO->getRegistrosEncontrados();
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
    
    
    
    
    
    
    
    ///////////////////////////////////////////////////////////////////////
    //Si recibe de la vista la acción LISTAR, lista las producciones por Tipo
    else if($data->{"accion"} === "LISTARTABLA"){
            try{
            $conexion = Conexion::establecer();
            $produccionDAO = new ProduccionDAO($conexion);
            $respuesta->{"registros"} = $produccionDAO->listartabla($data);
            $respuesta->{"error"} = $produccionDAO->getError();
            $respuesta->{"total"} = $produccionDAO->getRegistrosEncontrados();
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
