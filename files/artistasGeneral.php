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
        <script defer src="js/artista.js" type="text/javascript"></script>        
        <script defer src="lib/jQuery/jquery.twbsPagination.js" type="text/javascript"></script>
        
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
            
            <!-- **************PAGINA DE ARTISTAS*************** -->
            <div class="fondoForm" id="artistasListado">
                <!-- Título de la página -->
                <a>
                    <h3> Artistas </h3>
                    <input hidden id="filtro" name="filtro" value="artista"/>
                    
                </a>
                        
 
                <hr class="colorgraph">
            
                <!-- Inicio de las tarjetas -->
                <section class="our-webcoderskull padding-lg">
                    <div class="row"> 
                
                <!-- Filtros -->
                <div class="col-md-3" >
                        <!-- Buscador FINAL FINAL ESTE SI de artistas -->
                        <div id="custom-search-input">
                            <div class="input-group col-md-12" id="divSugestivo">
                                <input id="textSugestivo" name="textSugestivo" type="text" class="form-control " placeholder="Buscar Artista..." />
                                <span class="input-group-btn">
                                    <button class="btn" type="button" onclick="artista.buscarArtista()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Filtros -->
                        <div  class="card" style="margin-top: 15px">
                            <div class="card-header"> Localidad </div>

                            <ul class="list-group list-group-flush" id="loc">
                                <li class="list-group-item"> Caleta Olivia 
                                    <label class="checkbox1" id="locInput">
                                        <input type="checkbox" name="loc" value="Caleta Olivia"/> <span class="success"></span>
                                    </label>
                                </li>
                                <li class="list-group-item"> Comodoro Rivadavia 
                                    <label class="checkbox1" id="locInput">
                                        <input type="checkbox" name="loc" value="Comodoro Rivadavia"/> <span class="success"></span>
                                    </label>
                                </li>
                                <li class="list-group-item"> Pico Truncado 
                                    <label class="checkbox1" id="locInput">
                                        <input type="checkbox" name="loc" value="Pico Truncado"/> <span class="success"></span>
                                    </label>
                                </li>

                            </ul>   
                        </div>
                        
                        <div   class="card" >
                            <div class="card-header" > Disciplina </div>

                            <ul class="list-group list-group-flush" id="disc">
                                <li class="list-group-item"> Artes Visuales 
                                    <label class="checkbox">
                                        <input type="checkbox" name="disc" value="Artes Visuales"/> <span class="info"></span>
                                    </label>
                                </li>
                                <li class="list-group-item"> Música 
                                    <label class="checkbox">
                                        <input type="checkbox" name="disc" value="Musica"/> <span class="info"></span>
                                    </label>
                                </li>
                                <li class="list-group-item"> Teatro 
                                    <label class="checkbox">
                                        <input type="checkbox" name="disc" value="Teatro"/> <span class="info"></span>
                                    </label>
                                </li>

                            </ul>   
                        </div>
                    
                        
                        <div class="filtros" id="filtroItem" style="display: inline-block;float: right">
                            <button class="btn btn-sm btn-outline-danger" type="button" onclick="artista.quitarFiltros()"> Quitar </button>
                        </div>
                        <div class="filtros" id="filtroItem" style="display: inline-block;float: right">
                            <button id="btnFiltros"disabled="true" class="btn btn-sm btn-outline-success" type="button" onclick="artista.listarFiltros()"> Aplicar </button>
                        </div>
                    </div>
                <div class="col-md-9" id="filtros">
                    <div class="container" id="artistasGeneral">
                        <!-- Contenido de la tarjeta de artista --> 
                    </div>
                    
                    <div class="row bloque col-md-12" id="paginas">
                        <ul id="paginacion" class="pagination-lg"></ul>
                    </div>
                </div>
                
                <div class="row cnt-block" hidden>
                    <div class="col-md-4" id="social">
                                <figure><img src="img/artist.jpg"></figure>
                                <span>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                </ul>
                            </span>
                        </div>
                    
                    
                        <div class="col-md-8" id="tarjetaArtista">
                                <h2> Nombre del Artista <br><span class="span_loc"> Localidad </span> <span class="span_cat"> Disciplina </span></h2>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Fusce facilisis turpis rutrum blandit consequat. Aliquam fermentum suscipit enim sit amet fermentum. 
                                Fusce et facilisis justo. Curabitur ligula mauris, maximus vitae lobortis sed, volutpat sit amet mi. </p>
                            
                            <h2> Comentarios </h2>
                            <div class="scroll_text" style=" height: 180px;  margin: 0em;   overflow-y: auto;">
                                
                                
                                <div class="cuerpo">
                                    <div id="contenido">

                                        <p>
                                            Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
		   
                        </div>
                    </div>
                </section>
            </div> 
            
            
            
            
            <!-- **************PAGINA DE BUSQUEDA ******************* -->
                      
            <div hidden class="fondoForm" id="busquedaEscondida">
                <!-- Título de la página -->
                <a>
                    <h3> Resultado de la búsqueda: </h3>
                                        
                </a>
                        
 
                <hr class="colorgraph">
            
                <!-- Inicio de las tarjetas -->
                <section class="our-webcoderskull padding-lg">
                    <div class="row"> 
                
                
                <div class="col-md-9" id="filtrosB" style="margin-right: auto; margin-left: auto">
                    <div class="container" id="artistasBusqueda" style="margin-right: auto; margin-left: auto">
                        <!-- Contenido de la tarjeta de artista --> 
                    </div>
                    
                    <div class="row bloque col-md-12" id="paginas">
                        <ul id="paginacion" class="pagination-lg"></ul>
                    </div>
                </div>
                
                
                    </div>
                </section>
            </div>
            
        </main>
        <!-- Llama al pie de la página-->
        <?php require_once 'secciones/footer.php'; ?>
    </body>
</html>