<?php 
    $mensajes = "";
    $accion = filter_input(INPUT_POST, "accion", FILTER_SANITIZE_STRING);
    if(is_string($accion) && ($accion == "login")){
        
        //Hizo click en ingresar
        $correo = filter_input(INPUT_POST, "campoCorreo", FILTER_SANITIZE_STRING);
        $clave = filter_input(INPUT_POST, "campoPass", FILTER_SANITIZE_STRING);
        $perfil = $_POST['radioPerfil'];
        
        require_once 'modelos/Conexion.php';
        require_once '../lib/config.php';
             
            
        // Chequea el valor de tipo de usuario
        if ($perfil == "artista"){
            try{    
                $conexion = new PDO(DB_DATA, DB_USER, DB_PASS);
                if (!$conexion) throw new PDOException();
                $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $clave = md5($clave);
                $sql = "SELECT * FROM artistas WHERE correo_artista = :correo AND clave_artista = :clave;";

            
                if($stmt = $conexion->prepare($sql)){
                    if($stmt->execute(array("correo" => $correo, "clave" => $clave))){
                        if ($stmt->rowCount() == 1){
                            $registro = $stmt->fetch();
                            if($registro->estado_artista == 1){
                                session_start();
                                $_SESSION['id_cuenta'] = (int)$registro->id_artista;
                                $_SESSION['cuenta'] = $registro->correo_artista;
                                $_SESSION['apellido'] = $registro->apellido_artista;
                                $_SESSION['nombre'] = $registro->nombre_artista;
                                $_SESSION['perfil'] = "artista";
                                $_SESSION['logueado'] = 2020;
                                $stmt = null;
                                $conexion = null;                        
                                unset($registro);
                                header("Location:sesionArtista.php");
                            }//else header("Location:index.php");
                            }  
                         else $mensajes = "Algún dato es incorrecto";
                        $stmt->closeCursor();
                    }else $mensajes = "No se pudo ejecutar la operacion 1A";
                    $stmt = null;
                }else $mensajes = "No se pudo ejecutar la operacion 2A";
                $conexion = null; 
                } catch (Exception $ex) {
                $mensajes = "No es posible conectarse a la base de datos";
                }
                
                
        }else{
            try{    
                $conexion = new PDO(DB_DATA, DB_USER, DB_PASS);
                if (!$conexion) throw new PDOException();
                $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $clave = md5($clave);
                $sql = "SELECT * FROM usuarios WHERE correo_usuario= :correo AND clave_usuario = :clave;";
            
                if($stmt = $conexion->prepare($sql)){
                    if($stmt->execute(array("correo" => $correo, "clave" => $clave))){
                        if ($stmt->rowCount() == 1){
                            $registro = $stmt->fetch();
                            if($registro->estado_usuario == 1){
                                session_start();
                                $_SESSION['id_cuenta'] = (int)$registro->id_usuario;
                                $_SESSION['cuenta'] = $registro->correo_usuario;
                                $_SESSION['apellido'] = $registro->apellido_usuario;
                                $_SESSION['nombre'] = $registro->nombre_usuario;
                                $_SESSION['dni'] = $registro->dni_usuario;
                                $_SESSION['perfil'] = "usuario";
                                $_SESSION['logueado'] = 2020;
                                $stmt = null;
                                $conexion = null;                        
                                unset($registro);
                                header("Location:sesionUsuario.php");
                            }//else header("Location:index.php");
                        }  
                         else $mensajes = "Algún dato es incorrecto";
                        $stmt->closeCursor();
                    }else $mensajes = "No se pudo ejecutar la operacion 1U";
                    $stmt = null;
                }else $mensajes = "No se pudo ejecutar la operacion 2U";
                $conexion = null;  
            } catch (Exception $ex) {
                $mensajes = "No es posible conectarse a la base de datos";
            }
        }  
    }
?>