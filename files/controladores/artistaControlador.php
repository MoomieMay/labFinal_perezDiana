<?php
    //require_once '../secret.php';

    //convierte el stringify a json
    $data = json_decode($_POST["data"]);
    $respuesta = json_decode('{"accion":"","registros":[],"error":"","total":0}');
    
    require_once '../entidades/Artista.php';
    require_once '../modelos/Conexion.php';
    require_once '../modelos/artistaDAO.php';
    
    $respuesta->{"accion"} = $data->{"accion"};
    
    //validaciones: que exista data en post, no haya errores en json_decode
    
    
    //Si recibe de la vista la acción ALTA
    if($data->{"accion"} === "ALTA"){
        try{
        $conexion = Conexion::establecer();
        $artista = new Artista();
        
        $artista->setNombre($data->{"nombre"});
        $artista->setApellido($data->{"apellido"});
        $artista->setCorreo($data->{"correo"});
        $artista->setClave(md5($data->{"clave"}));
        $artista->setLocalidad($data->{"localidad"});
        $artista->setDisciplina($data->{"disciplina"});
        $artista->setEstado(1);
        
        $artistaDAO = new ArtistaDAO($conexion);
        
        if($artistaDAO->alta($artista)){
            $respuesta->{"registros"} = $artista->toJSON();
            // Autologin 
            session_start();
                        $_SESSION['id_cuenta'] = (int)$artistaDAO->getId();
                        $_SESSION['cuenta'] = $artista->getCorreo();
                        $_SESSION['apellido'] = $artista->getApellido();
                        $_SESSION['nombre'] = $artista->getNombre();
                        $_SESSION['perfil'] = 'artista';
                        $_SESSION['logueado'] = 2020;
        }else{
            $respuesta->{"error"} = $artistaDAO->getError();
        }
        //automaticamente pdo cierra la conexion
        $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }

    //Si recibe de la vista la acción ALTA
    if($data->{"accion"} === "ALTATARJETA"){
        try{
        $conexion = Conexion::establecer();
        $artista = new Artista();
        
        $artista->setId($data->{"id"});
        $artista->setDescripcion($data->{"descripcion"});
        $artista->setFacebook($data->{"facebook"});
        $artista->setInstagram($data->{"instagram"});
        $artista->setYoutube($data->{"youtube"});
        
        $artistaDAO = new ArtistaDAO($conexion);
        
        if($artistaDAO->altaTarjeta($artista)){
            $respuesta->{"registros"} = $artista->toJSON();
        }else{
            $respuesta->{"error"} = $artistaDAO->getError();
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
            $artista = new Artista();
            $artista->setId((int)$data->{"id"});

            $artistaDAO = new ArtistaDAO($conexion);
            if($artistaDAO->baja($artista)){
                $respuesta->{"registros"} = $artista->toJSON();
            }else{
                $respuesta->{"error"} = $artistaDAO->getError();
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
            $artista = new Artista();
            $artista->setId((int)$data->{"id"});
            $artista->setNombre($data->{"nombre"});
            $artista->setApellido($data->{"apellido"});
            $artista->setCorreo($data->{"correo"});
            //$artista->setClave(md5($data->{"clave"}));
            //$artista->setLocalidad($data->{"localidad"});
            //$artista->setPerfil($data->{"perfil"});
            //$artista->setDisciplina($data->{"disciplina"});
           
            
            $artistaDAO = new ArtistaDAO($conexion);
            if($artistaDAO->modificar($artista)){
                $respuesta->{"registros"} = $artista->toJSON();
                
                 session_start();
                        $_SESSION['cuenta'] = $artista->getCorreo();
                        $_SESSION['apellido'] = $artista->getApellido();
                        $_SESSION['nombre'] = $artista->getNombre();
                        $_SESSION['logueado'] = 2020;
                
            }else{
                $respuesta->{"error"} = $artistaDAO->getError();
            }
            
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    //Si recibe de la vista la acción MODIFICAR
    else if ($data->{"accion"} === "ACTUALIZARTA"){
        try{
            $conexion = Conexion::establecer();              
            $artista = new Artista();
            $artista->setId((int)$data->{"id"});
            $artista->setDescripcion($data->{"descripcion"});
            $artista->setFacebook($data->{"facebook"});
            $artista->setInstagram($data->{"instagram"});
            $artista->setYoutube($data->{"youtube"});
           
            
            $artistaDAO = new ArtistaDAO($conexion);
            if($artistaDAO->modificar($artista)){
                $respuesta->{"registros"} = $artista->toJSON();
                
                 session_start();
                
            }else{
                $respuesta->{"error"} = $artistaDAO->getError();
            }
            
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    //Si recibe de la vista la acción MODIFICAR
    else if ($data->{"accion"} === "CAMBIARCLAVE"){
        try{
            $conexion = Conexion::establecer();              
            $artista = new Artista();
            $artista->setId((int)$data->{"id"});
            $artista->setClave(md5($data->{"clave"}));
            $artista->setAux(md5($data->{"aux"}));

            
            $artistaDAO = new ArtistaDAO($conexion);
            if($artistaDAO->cambiarClave($artista)){
                $respuesta->{"registros"} = $artista->toJSON();
            }else{
                $respuesta->{"error"} = $artistaDAO->getError();
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
            $artistaDAO = new ArtistaDAO($conexion);
            
            $artista = $artistaDAO->cargar($data->{"id"});

            if($artista->getId() > 0){
                $respuesta->{"registros"} = $artista->toJSON();
            }
            else{
                $respuesta->{"error"} = $artistaDAO->getError();
            }

            $conexion = null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    //Si recibe de la vista la acción LISTAR
    else if($data->{"accion"} === "LISTARUSU"){
            try{
            $conexion = Conexion::establecer();
            $artistaDAO = new ArtistaDAO($conexion);
            $respuesta->{"registros"} = $artistaDAO->listarusu($data);
            $respuesta->{"error"} = $artistaDAO->getError();
            $respuesta->{"total"} = $artistaDAO->getRegistrosEncontrados();
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
    
     //Si recibe de la vista la acción LISTAR
    else if($data->{"accion"} === "LISTAR"){
            try{
            $conexion = Conexion::establecer();
            $artistaDAO = new ArtistaDAO($conexion);
            $respuesta->{"registros"} = $artistaDAO->listar($data);
            $respuesta->{"error"} = $artistaDAO->getError();
            $respuesta->{"total"} = $artistaDAO->getRegistrosEncontrados();
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
    
    //Si recibe de la vista la acción BUSCAR
    else if($data->{"accion"} === "BUSCARARTISTA"){
            try{
            $conexion = Conexion::establecer();
            $artistaDAO = new ArtistaDAO($conexion);
            $respuesta->{"registros"} = $artistaDAO->buscarArtista($data);
            $respuesta->{"error"} = $artistaDAO->getError();
            $respuesta->{"total"} = $artistaDAO->getRegistrosEncontrados();
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
            $artistaDAO = new ArtistaDAO($conexion);
            $respuesta->{"registros"} = $artistaDAO->listarFiltros($data);
            $respuesta->{"error"} = $artistaDAO->getError();
            $respuesta->{"total"} = $artistaDAO->getRegistrosEncontrados();
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
    else if($data->{"accion"} === "LISTARFILTROSDISC"){
            try{
            $conexion = Conexion::establecer();
            $artistaDAO = new ArtistaDAO($conexion);
            $respuesta->{"registros"} = $artistaDAO->listarFiltrosDisc($data);
            $respuesta->{"error"} = $artistaDAO->getError();
            $respuesta->{"total"} = $artistaDAO->getRegistrosEncontrados();
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
            $artistaDAO = new ArtistaDAO($conexion);
            $respuesta->{"registros"} = $artistaDAO->listarFiltrosLoc($data);
            $respuesta->{"error"} = $artistaDAO->getError();
            $respuesta->{"total"} = $artistaDAO->getRegistrosEncontrados();
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
            $artista = new Artista();
            $artista->setId((int)$data->{"id"});
            $artista->setDescripcion($data->{"descripcion"});
            $artista->setFacebook($data->{"facebook"});
            $artista->setInstagram($data->{"instagram"});
            $artista->setYoutube($data->{"youtube"});           
            
            $artistaDAO = new ArtistaDAO($conexion);
            if($artistaDAO->completar($artista)){
                $respuesta->{"registros"} = $artista->toJSON();
                
            }else{
                $respuesta->{"error"} = $artistaDAO->getError();
            }
            
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    //convierte el json en string, es lo que se pasa entre servidores
    echo json_encode($respuesta);
?>
