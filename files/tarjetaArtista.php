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
            
        <div class="fondoForm" id="altaUsuario">
            <a>
                <h2> Completa tu Tarjeta de Artista </h2> <p> Es tu carta de presentación con los demás usuarios </p>
                <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
            </a>
            
            <form id="formAlta" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                <hr class="colorgraph">
                
                <div class="form-row" hidden>
                    <div class="form-group col-md-12">
                        <label for="imgUsuario"> Imagen </label>
                        <input class="form-control" id="imgUsuario" name="imgUsuario" type="file"></input>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="descripcionUsuario"> Presentación </label>
                        <textarea class="form-control" maxlength="280" id="descripcionUsuario" name="descripcionUsuario" placeholder="Escribe una pequeña bio o presentación tuya. No olvides que debe tener una longitud de HASTA 280 caracteres."></textarea>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="faceUsuario"> Facebook </label>
                        <input class="form-control" type="url" id="faceUsuario" name="faceUsuario" placeholder="Ingresa el enlace a tu perfil de Facebook">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="instaUsuario"> Instagram </label>
                        <input class="form-control" type="url" id="instaUsuario" name="instaUsuario" placeholder="Ingresa el enlace a tu cuenta de Instagram">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="ytUsuario"> YouTube </label>
                        <input class="form-control" type="url" id="ytUsuario" name="ytUsuario" placeholder="Ingresa el enlace a tu canal de YouTube">
                    </div>
                </div>
                
                
                <div>&nbsp;</div>
                
                <div> 
                    <button class="btn btn-outline btn-success" id="aceptarAlta" type="button" onclick="usuario.completar()" > Aceptar </button>
                    <button type="reset" class="btn btn-info"> Resetear </button>
                </div>
            </form>    
            </div>    
        </main>
        <!-- Llama al pie de la página-->
        <?php require_once 'secciones/footer.php'; ?>
    </body>
</html>