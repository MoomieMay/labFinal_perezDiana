<!-- INDEX PRINCIPAL -->

<?php 
    require_once 'secciones/login.php';
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
        <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
        <script defer src="js/artista.js" type="text/javascript"></script>
        <script defer src="js/produccion.js" type="text/javascript"></script>
        <script src="lib/jQuery/jquery.fittext.js" type="text/javascript"></script>
        
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
        session_start();
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
    
        <main class="Site-content">
            <!--<div class="parallax"></div>
            <div style="height:350px;background-color: rgba(255, 255, 255, 0.7)">-->
            <section class="row">
                <div class="container offset-col-1 col-md-10" id="alertaTarjeta">
                    <div class="">
                        <div class="col-md-12">
                            <div class="NOtarjeta" >
                                <div id="tituloIndex"> 
                                    <h4> Date a conocer a la comunidad habilitando tu tarjeta de Presentación</h4>
                                    <h6> Sólo tenes que hacer <span>clic <i class="fas fa-mouse-pointer"></i></span> en el botón </h6>
                                    <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                                </div>
                                <button id="btnTarjeta"type="button" class="btn btn-warning" onclick="artista.habilitar()"> Tarjeta de Artista </button> 
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="container offset-col-1 col-md-10" id="datosArtista" >
                    <!-- Tarjeta de artista -->
                    <form id="formA" action="" method="" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-row" hidden>
                        <div class="form-group col-md-12">
                            <label for="imgUsuario"> Imagen </label>
                            <input class="form-control" id="imgUsuario" name="imgUsuario" type="file"></input>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="descripcionUsuario"> Presentación </label>
                            <textarea class="form-control" maxlength="280" id="descripcionUsuario" name="descripcionUsuario" placeholder="Escribe una pequeña bio o presentación tuya. No olvides que debe tener una longitud de HASTA 280 caracteres." disabled="true"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-row">
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
                        <button id="btnEditarTA"type="button" class="btn btn-warning" onclick="artista.editar()" > Editar Tarjeta </button>
                        <button hidden id="btnCambiarTA"type="button" class="btn btn-success" onclick="artista.actualizarTarjeta()" > Actualizar Tarjeta </button>
                        <button id="btnAceptar"type="button" class="btn btn-success" onclick="artista.altaTarjeta()" > Alta Tarjeta </button>
                        <button id="btnCancelar"type="button" class="btn btn-info" onclick="artista.cancelarTarjeta()" > Cancelar </button>
    
                    </form>
                </div>
                
               
            </section>
        </main>
        
     
    <!-- Llama al pie de la página-->
    <?php require_once 'secciones/footer.php'; ?>
    
    </body>
</html>