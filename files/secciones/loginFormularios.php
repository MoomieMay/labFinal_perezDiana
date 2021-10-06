<?php 
    $mensajes = "";
    $accion = filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING);
    if(is_string($accion) && ($accion == "login")){
        
        //Hizo click en ingresar
        $correo = filter_input(INPUT_POST, "campoCorreo", FILTER_SANITIZE_STRING);
        $clave = filter_input(INPUT_POST, "campoPass", FILTER_SANITIZE_STRING);
        
        require_once 'modelos/Conexion.php';
        require_once '../lib/config.php';
        
        
        try{    
            $conexion = new PDO(DB_DATA, DB_USER, DB_PASS);
            if (!$conexion) throw new PDOException();
            $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $clave = md5($clave);
            $sql = "SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario, clave_usuario, localidad_usuario, perfil_usuario, disciplina_usuario "
                    . "FROM usuarios WHERE correo_usuario = :correo AND clave_usuario = :clave;";
            
            if($stmt = $conexion->prepare($sql)){
                if($stmt->execute(array("correo" => $correo, "clave" => $clave))){
                    if ($stmt->rowCount() == 1){
                        $registro = $stmt->fetch();
                        session_start();
                        $_SESSION['id_cuenta'] = (int)$registro->id_usuario;
                        $_SESSION['cuenta'] = $registro->correo_usuario;
                        $_SESSION['apellido'] = $registro->apellido_usuario;
                        $_SESSION['nombre'] = $registro->nombre_usuario;
                        $_SESSION['perfil'] = $registro->perfil_usuario;
                        $_SESSION['logueado'] = 2020;
                        $stmt = null;
                        $conexion = null;                        
                        unset($registro);
                        header("Location:index.php");
                    }else $mensajes = "El usuario o las clave es incorrecta.";
                    $stmt->closeCursor();
                }else $mensajes = "No se pudo ejecutar la operacion";
                $stmt = null;
            }else $mensajes = "No se pudo ejecutar la operacion";
            $conexion = null;
        } catch (Exception $ex) {
            $mensajes = "No es posible conectarse a la base de datos";
        }
    }
?>