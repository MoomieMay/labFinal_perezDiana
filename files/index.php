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
        <script defer src="js/usuario.js" type="text/javascript"></script>
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
            
            <section class="our-webcoderskull padding-lg">
                <div class="container offset-col-1 col-md-10">
                    <div id="tituloIndex"> 
                        <h4> ¡En <b style="color: #563068"> Arte Independiente</b> encontrá actividades y espectáculos en tu localidad!</h4>
                        <h6> Sólo tenes que hacer <span>clic <i class="fas fa-mouse-pointer"></i></span> en la ciudad </h6>
                    </div>
                    
                    <!-- TARJETAS LOCALIDADES -->
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
                                <div style="background-image: url(img/caleta-index.jpeg);" class="entry-cover image-grid-cover has-image" id="ciudad">
                                    <a href="files/caletaProducciones.php?id=Caleta Olivia" class="image-grid-clickbox"></a>
                                    <a href="files/caletaProducciones.php?id=Caleta Olivia" class="cover-wrapper">Caleta Olivia</a>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
                                <div style="background-image: url(img/cdro-index.jpg);" class="entry-cover image-grid-cover has-image" id="ciudad">
                                    <a href="files/comodoroProducciones.php?id=Comodoro Rivadavia" class="image-grid-clickbox"></a>
                                    <a href="files/comodoroProducciones.php?id=Comodoro Rivadavia" class="cover-wrapper">Comodoro Rivadavia</a>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
                                <div style="background-image: url(img/truncado-index.jpeg);" class="entry-cover image-grid-cover has-image" id="ciudad">
                                    <a href="files/truncadoProducciones.php?id=Pico Truncado" class="image-grid-clickbox"></a>
                                    <a href="files/truncadoProducciones.php?id=Pico Truncado" class="cover-wrapper">Pico Truncado </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TARJETAS LOCALIDADES -->
                    <div class="row justify-content-center" hidden>
                        <div class="col-md-4" >
                            <div class="cnt-block" >
                                <figure><img src="img/caleta-index.jpeg" class="img-responsive" alt=""></figure>
                                <h4><a href="files/caletaProducciones.php?id=Caleta Olivia"> Caleta Olivia </a></h4>
                                <p> Santa Cruz</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="cnt-block"> 
                                <figure><img src="img/cdro-index.jpg" class="img-responsive" alt=""></figure>
                                <h4><a href="files/comodoroProducciones.php?id=Comodoro Rivadavia"> Comodoro Rivadavia </a></h4>
                                <p> Chubut </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="cnt-block" >
                                <figure><img src="img/truncado-index.jpeg" class="img-responsive" alt=""></figure>
                                <h4><a href="files/truncadoProducciones.php?id=Pico Truncado"> Pico Truncado </a></h4>
                                <p> Santa Cruz </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            
             
        </main>
        
     
    <!-- Llama al pie de la página-->
    <?php require_once 'secciones/footer.php'; ?>
    
    </body>
</html>