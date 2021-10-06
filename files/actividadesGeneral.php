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
        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
        
        <script defer src="js/produccion.js" type="text/javascript"></script>
        <script defer src="lib/jQuery/jquery.twbsPagination.js" type="text/javascript"></script>
        
        <!-- Estilos -->
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f6346de447.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
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
            <div class="fondoForm">
                <!-- Título de la página -->
                <a>
                    <h3> Actividades </h3>
                    <input hidden id="filtre" value="actividad"/>
                </a>
                <hr class="colorgraph">
                        
            <!-- Inicio de las tarjetas -->
            <section class="our-webcoderskull padding-lg">
                <div class="row">
                    <!-- Filtros -->
                     <div class="col-md-3">
                    <div class="card" >
                            <div class="card-header"> Localidad </div>

                            <ul class="list-group list-group-flush" id="loc">
                                <li class="list-group-item"> Caleta Olivia 
                                    <label class="checkbox1" id="locInput">
                                        <input id="loc" type="checkbox" name="loc" value="Caleta Olivia"/> <span class="success"></span>
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
                   
                                                
                        <div class="card">
                            <div class="card-header">  Categoría </div>

                            <ul class="list-group list-group-flush"id="cat">
                                <li class="list-group-item"> Adultos 
                                    <label class="checkbox">
                                        <input type="checkbox" name="cat" value="Adulto"/> <span class="warning"></span>
                                    </label>
                                </li>
                                <li class="list-group-item"> Apto para todo público 
                                    <label class="checkbox">
                                        <input type="checkbox" name="cat" value="ATP" /> <span class="warning"></span>
                                    </label>
                                </li>
                                <li class="list-group-item"> Infantil 
                                    <label class="checkbox">
                                        <input type="checkbox" name="cat" value="Infantil" /> <span class="warning"></span>
                                    </label>
                                </li>

                            </ul>   
                        </div>
                     

                        <div class="filtros" id="filtroItem" style="display: inline-block;float: right">
                            <button class="btn btn-sm btn-outline-danger" type="button" onclick="produccion.quitarFiltros()"> Quitar </button>
                        </div>
                        <div class="filtros" id="filtroItem" style="display: inline-block;float: right">
                            <button id="btnFiltros"disabled="true" class="btn btn-sm btn-outline-success" type="button" onclick="produccion.listarFiltros()"> Aplicar </button>
                        </div>
                    
                        
                    
                        
                
                    </div>
                    <div class="col-md-9" id="filtros">
                        <div class="container" id="tarjetaTipo">
                        <!-- Contenido de la tarjeta de actividad -->
                        </div>
                        <div class="row bloque col-md-12" id="paginas">
                            <ul id="paginacion" class="pagination-lg"></ul>
                        </div>
                    </div>
                </div>
            </section>
            </div>
            
            <!-- Modal Login-->    
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="ModalHorariosTitulo" aria-hidden="true" style="font-family: 'Playfair Display', serif">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Debes iniciar tu sesión</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="container">
                                <div class="row" style="">
                                    <div class="col-md-12">
                                        <form role="form" method="POST"  onsubmit="return true" action="">

                                            <input type="hidden" name="accion" value="login">

                                            <fieldset>
                                                <hr class="colorgraph">
                                                <div class="form-group">
                                                   <input type="email" id="campoCorreo" name="campoCorreo" class="form-control input-lg" placeholder="Ingresa tu correo electrónico">
                                                </div>


                                                <div class="form-group">
                                                    <input type="password" id="campoPass" name="campoPass" class="form-control input-lg" placeholder="Ingresa tu contraseña">
                                                </div>

                                                <hr class="colorgraph">
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Iniciar Sesión">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        <a href="../labFinal_perezDiana/files/altaUsuario.php" class="btn btn-lg btn-primary btn-block">Registrate</a>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>                        
                                     </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </main>
        
     
    <!-- Llama al pie de la página-->
    <?php require_once 'secciones/footer.php'; ?>
    
    </body>
</html>