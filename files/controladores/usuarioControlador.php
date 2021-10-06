<?php
    //require_once '../secret.php';

    //convierte el stringify a json
    $data = json_decode($_POST["data"]);
    $respuesta = json_decode('{"accion":"","registros":[],"error":"","total":0}');
    
    require_once '../entidades/Usuario.php';
    require_once '../modelos/Conexion.php';
    require_once '../modelos/usuarioDAO.php';
    
    $respuesta->{"accion"} = $data->{"accion"};
    
    //validaciones: que exista data en post, no haya errores en json_decode
    
    
    //Si recibe de la vista la acción ALTA
    if($data->{"accion"} === "ALTA"){
        try{
        $conexion = Conexion::establecer();
        $usuario = new Usuario();
        
        $usuario->setNombre($data->{"nombre"});
        $usuario->setApellido($data->{"apellido"});
        $usuario->setDni($data->{"dni"});
        $usuario->setCorreo($data->{"correo"});
        $usuario->setClave(md5($data->{"clave"}));
        $usuario->setLocalidad($data->{"localidad"});
        $usuario->setPerfil($data->{"perfil"});   
        $usuario->setEstado(1);
        
        $usuarioDAO = new UsuarioDAO($conexion);
        
        if($usuarioDAO->alta($usuario)){
            $respuesta->{"registros"} = $usuario->toJSON();
            // Autologin
            session_start();
                        $_SESSION['id_cuenta'] = (int)$usuarioDAO->getId();
                        $_SESSION['cuenta'] = $usuario->getCorreo();
                        $_SESSION['apellido'] = $usuario->getApellido();
                        $_SESSION['nombre'] = $usuario->getNombre();
                        $_SESSION['perfil'] = 'usuario';
                        $_SESSION['logueado'] = 2020;
        }else{
            $respuesta->{"error"} = $usuarioDAO->getError();
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
            $usuario = new Usuario();
            $usuario->setId((int)$data->{"id"});

            $usuarioDAO = new UsuarioDAO($conexion);
            if($usuarioDAO->baja($usuario)){
                $respuesta->{"registros"} = $usuario->toJSON();
            }else{
                $respuesta->{"error"} = $usuarioDAO->getError();
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
            $usuario = new Usuario();
            $usuario->setId((int)$data->{"id"});
            $usuario->setNombre($data->{"nombre"});
            $usuario->setApellido($data->{"apellido"});
            $usuario->setCorreo($data->{"correo"});
            //$usuario->setClave(md5($data->{"clave"}));
            //$usuario->setLocalidad($data->{"localidad"});
            //$usuario->setPerfil($data->{"perfil"});
            //$usuario->setDisciplina($data->{"disciplina"});
           
            
            $usuarioDAO = new UsuarioDAO($conexion);
            if($usuarioDAO->modificar($usuario)){
                $respuesta->{"registros"} = $usuario->toJSON();
                
                 session_start();
                        $_SESSION['id_cuenta'] = (int)$usuarioDAO->getId();
                        $_SESSION['cuenta'] = $usuario->getCorreo();
                        $_SESSION['apellido'] = $usuario->getApellido();
                        $_SESSION['nombre'] = $usuario->getNombre();
                        $_SESSION['logueado'] = 2020;
                
            }else{
                $respuesta->{"error"} = $usuarioDAO->getError();
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
            $usuario = new Usuario();
            $usuario->setId((int)$data->{"id"});
            $usuario->setClave(md5($data->{"clave"}));
            $usuario->setAux(md5($data->{"aux"}));

            
            $usuarioDAO = new UsuarioDAO($conexion);
            if($usuarioDAO->cambiarClave($usuario)){
                $respuesta->{"registros"} = $usuario->toJSON();
            }else{
                $respuesta->{"error"} = $usuarioDAO->getError();
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
            $usuarioDAO = new UsuarioDAO($conexion);
            
            $usuario = $usuarioDAO->cargar($data->{"id"});

            if($usuario->getId() > 0){
                $respuesta->{"registros"} = $usuario->toJSON();
            }
            else{
                $respuesta->{"error"} = $usuarioDAO->getError();
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
            $usuarioDAO = new UsuarioDAO($conexion);
            $respuesta->{"registros"} = $usuarioDAO->listarusu($data);
            $respuesta->{"error"} = $usuarioDAO->getError();
            $respuesta->{"total"} = $usuarioDAO->getRegistrosEncontrados();
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
            $usuario = new Usuario();
            $usuario->setId((int)$data->{"id"});
            $usuario->setDescripcion($data->{"descripcion"});
            $usuario->setFacebook($data->{"facebook"});
            $usuario->setInstagram($data->{"instagram"});
            $usuario->setYoutube($data->{"youtube"});           
            
            $usuarioDAO = new UsuarioDAO($conexion);
            if($usuarioDAO->completar($usuario)){
                $respuesta->{"registros"} = $usuario->toJSON();
                
            }else{
                $respuesta->{"error"} = $usuarioDAO->getError();
            }
            
            $conexion = null;
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    //convierte el json en string, es lo que se pasa entre servidores
    echo json_encode($respuesta);
?>
