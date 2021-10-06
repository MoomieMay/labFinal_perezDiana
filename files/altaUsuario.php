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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
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
            
        <div class="fondoForm" id="altaUsuario">
            <a>
                <h2> ¡Registrate! </h2>
            </a>
            
            <form id="formAlta" action="" method="POST" autocomplete="off">
                <hr class="colorgraph">
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombreUsuario"> Nombre </label>
                        <input class="form-control" type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Ingresa tu nombre">
                        <small style="visibility: hidden" id="msj1"></small> 
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="apellidoUsuario"> Apellido </label>
                        <input class="form-control" type="text" id="apellidoUsuario" name="apellidoUsuario" placeholder="Ingresa tu apellido">
                        <small style="visibility: hidden" id="msj2"></small>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="correoUsuario"> Correo Electrónico </label>
                        <input class="form-control" type="email" id="correoUsuario" name="correoUsuario" placeholder="Ingresa tu correo electrónico">
                        <small style="visibility: hidden" id="msj3"></small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirmCorreo"> Confirmar Correo Electrónico </label>
                        <input class="form-control" type="email" id="confirmCorreo" name="confirmCorreo" placeholder="Vuelve a escribir tu correo electrónico">
                        <small style="visibility: hidden" id="msj4"></small>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="claveUsuario"> Contraseña </label>
                        <input class="form-control" type="password" id="claveUsuario" name="claveUsuario" placeholder="Ingresa una contraseña de 8 caracteres (letras y números)">
                        <small style="visibility: hidden" id="msj5"></small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirmUsuario"> Confirmar Contraseña </label>
                        <input class="form-control"  type="password" id="confirmUsuario" name="confirmUsuario" placeholder="Vuelve a escribir tu contraseña">
                        <small style="visibility: hidden" id="msj6"></small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="localidadUsuario"> Localidad </label>
                        <select class="form-control" id="localidadUsuario" name="localidadUsuario">
                            <option disabled selected value=""> Selecciona una opción</option>
                            <option value="Caleta Olivia"> Caleta Olivia </option>
                            <option value="Comodoro Rivadavia"> Comodoro Rivadavia </option>
                            <option value="Pico Truncado"> Pico Truncado </option>
                        </select>
                        <small style="visibility: hidden" id="msj7"></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="perfilUsuario"> Perfil </label>
                        <select class="form-control" id="perfilUsuario" name="perfilUsuario">
                            <option disabled selected value=""> Selecciona una opción</option>
                            <option value="artista"> Artista </option>
                            <option value="usuario"> Usuario </option>
                        </select>
                        <small style="visibility: hidden" id="msj8"></small>
                    </div>

                    <div class="form-group col-md-4" id="disciplina" hidden>
                        <label for="disciplinaUsuario"> Disciplina Principal </label> <br>
                        <select class="form-control" id="disciplinaUsuario" name="disciplinaUsuario">
                            <option disabled selected value=""> Selecciona una opción</option>
                            <option value="Artes Visuales"> Artes Visuales </option>
                            <option value="Música"> Música </option>
                            <option value="Teatro"> Teatro </option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-4" id="dniUsuario" hidden>
                        <label for="dniUsuario"> Documento </label> <br>
                        <input class="form-control" type="text" id="dniUsuario" name="dniUsuario" placeholder="Ingresa tu DNI, sin puntos" maxlength="8">
                    </div>
                </div>
                
                <div>&nbsp;</div>
                
                <div>
                    <div id="mensajeAlta" hidden><div class="alert alert-danger" role="alert"></div></div>    
                    <button class="btn btn-outline btn-success" id="aceptarAltaU" type="button" onclick="usuario.alta()" > Aceptar </button>
                    <button hidden class="btn btn-outline btn-success" id="aceptarAltaA" type="button" onclick="artista.alta()" > Aceptar </button>
                    <button type="reset" class="btn btn-info"> Resetear </button>
                </div>
            </form>    
            </div>    
        </main>
        <!-- Llama al pie de la página-->
        <?php require_once 'secciones/footer.php'; ?>
    </body>
</html>