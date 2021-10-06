<?php 
    require_once 'secciones/login.php';
    session_start();
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=devide.width, initial-scale=1">
        <title> Arte Independiente </title>
        <base href="http://localhost/labFinal_perezDiana/"/> 
        <link rel="icon" href="../labFinal_perezDiana/img/pin-logo.png" type="image/png" sizes="16x16">
        
        <!-- Scripts -->
        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
        <script defer src="js/usuario.js" type="text/javascript"></script>
        <script defer src="js/artista.js" type="text/javascript"></script>
        
        
        <!-- Estilos -->
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f6346de447.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
        
        <!-- Alertas y Mensajes -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    
    
    
            
    <body class="Site">
    <!-- Llama al encabezado de la página-->
    <?php
    //session_start();
    if (!isset($_SESSION['logueado']) || ($_SESSION['logueado'] != 2020)){
        require_once 'secciones/header.php';
    }else{
        if($_SESSION['perfil'] == 'usuario'){
            require_once 'secciones/headerUsuario.php';
        }
        else{
            require_once 'secciones/headerArtista.php';
        }
    }
    ?>
        
        <!-- Comienzo del contenido de la página -->
        <main class="Site-content"> 
            <div class="fondoForm" style="padding: 30px">
                <a>
                    <h2> Hola <?php echo $_SESSION['nombre']?></h2>
                    <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                </a>
                <hr class="colorgraph">
                     
                <section class="row">
                <div class="container form-row col-md-12" id="alertaTarjeta">
                        <div class="col-md-4 form-group">
                            <div class="NOtarjeta" >
                                <div id="tituloIndex"> 
                                    <h4> Activa tu tarjeta de Presentación</h4>
                                    <h6> Con unos pocos datos tu información estará disponible para toda la comunidad </h6>
                                    <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                                </div>
                                
                            </div>
                        </div>
                    <div class="col-md-8 form-group">
                        <!-- Tarjeta de artista -->
                    <form id="formA" action="" method="" autocomplete="off" enctype="multipart/form-data">
                    
                    
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-12">
                            <label for="descripcionUsuario"> Presentación </label>
                            <textarea class="form-control" maxlength="280" id="descripcionUsuario" name="descripcionUsuario" placeholder="Escribe una pequeña bio o presentación tuya. No olvides que debe tener una longitud de HASTA 280 caracteres." disabled="true"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-4">
                            <label for="faceUsuario"> Facebook </label>
                            <input class="form-control" type="url" id="faceUsuario" name="faceUsuario" placeholder="Ingresa el enlace a tu perfil de Facebook" disabled="true">
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="instaUsuario"> Instagram </label>
                            <input class="form-control" type="url" id="instaUsuario" name="instaUsuario" placeholder="Ingresa el enlace a tu cuenta de Instagram" disabled="true">
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="ytUsuario"> YouTube </label>
                            <input class="form-control" type="url" id="ytUsuario" name="ytUsuario" placeholder="Ingresa el enlace a tu canal de YouTube" disabled="true">
                        </div>
                    </div>  
                        <div style="margin-left: 15px">
                        <button  id="btnEditarTA"type="button" class="btn btn-warning" onclick="artista.editarTA()" > Editar Tarjeta </button>
                        <button hidden id="btnCambiarTA"type="button" class="btn btn-success" onclick="artista.actualizarTarjeta()" > Actualizar Tarjeta </button>
                        <button hidden id="btnAceptarTARJ"type="button" class="btn btn-success" onclick="artista.altaTarjeta()" > Guardar Tarjeta </button>
                        <button hidden id="btnCancelarTARJ"type="button" class="btn btn-info" onclick="artista.cancelarTarjeta()" > Cancelar </button>
    </div>
                    </form>
                    </div>
                </div>
                
               
                
                
               
            </section>
                <hr style="margin-top: 20px;margin-bottom: 20px">
                <form id="formA" action="" method="" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="textNombre">Nombre</label>
                            <input type="text" class="form-control" id="textNombre" value="<?php echo $_SESSION['nombre']?>" disabled="true">
                        </div>
                         
                        <div class="form-group col-md-6">
                            <label for="textApellido">Apellido</label>
                            <input type="text" class="form-control" id="textApellido" value="<?php echo $_SESSION['apellido']?>" disabled="true">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="textMail">Correo Electrónico</label>
                            <input type="email" class="form-control" id="textMail" value="<?php echo $_SESSION['cuenta']?>" disabled="true">
                        </div>
                                                  
                        <div class="form-group col-md-2" id="editarClave1" hidden>
                            <label for="textClaveVieja"> Contraseña Actual </label>
                            <input type="password" class="form-control" id="textClaveVieja" value="">
                        </div>
                        
                        <div class="form-group col-md-2" id="editarClave2" hidden>
                            <label for="textClave"> Nueva Contraseña </label>
                            <input type="password" class="form-control" id="textClave" value="<?php echo $_SESSION['cuenta']?>">
                        </div>

                        <div class="form-group col-md-2" id="editarClave3" hidden>
                            <label for="textClave2"> Repetir Contraseña </label>
                            <input type="password" class="form-control" id="textClave2" value="">
                        </div>
                    </div>
                    
                    
                    
                    <!--BOTONES-->
                    <div class="form-row"> 
                        <div class="botonesForm"> 
                            <button id="btnModificar"type="button" onclick="artista.editar()" class="btn btn-success" > Editar</button>
                            <button id="btnCambiar" type="button" class="btn btn-info" onclick="artista.editarClave()"> Cambiar contraseña</button>
                            <button id="btnEliminar" type="button" class="btn btn-danger" name="elimCuenta" onclick="artista.confirmar()"> Eliminar cuenta</button>
                            <!-- Botones escondidos --> 
                            <button id="btnAceptar"type="button" class="btn btn-success" onclick="artista.modificar()" hidden> Aceptar </button>
                            <button id="btnClaveNueva"type="button" class="btn btn-success" onclick="artista.aceptarClave()" hidden> Aceptar Clave </button>
                            <button id="btnCancelar"type="button" class="btn btn-info" onclick="artista.cancelar()" hidden> Cancelar </button>
                            <button id="btnCancelarClave"type="button" class="btn btn-info" onclick="artista.cancelarClave()" hidden> Cancelar </button>


                        </div>                                
                    </div>
                </form>
            </div>
            
        </main>
        
        <!-- Llama al pie de la página-->
        <?php
        require_once 'secciones/footer.php';
        ?>
        
    </body>
</html>