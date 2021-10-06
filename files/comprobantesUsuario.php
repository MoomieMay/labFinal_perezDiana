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
        <script defer src="js/comprobante.js" type="text/javascript"></script>
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
            <div class="fondoForm">
                <div class="container-fluid"> 
                    <!-- Titulo de la seccion -->
                    <a>
                        <h2> Comprobantes </h2>
                        <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                        <input hidden id="tipoOculto" value="<?php echo $_SESSION['perfil']?>"/>
                    </a>
                    <hr class="colorgraph">

                    
                    <div class="row">
                            <div class="col-md-12 col-md-offset-2">
                                
                                <!-- Comienzo de la tabla -->
                                <div class="table">
                                    <table class="table table-striped table-content" id="tablaActComprob">
                                        <thead class="thead-dark" id="cabeceraComprobantes">
                                            <tr>
                                                <th> Actividad </th>
                                                <th> Tipo </th>
                                                <th> Lugar </th>
                                                <th> Fecha </th>
                                                <th> Ver Comprobante </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaActividades">
                                            <!-- Contenido de la tabla -->
                                        </tbody>
                                    </table>
                                    
                                    <div class="row bloque col-md-12" id="paginas">
                                        <ul id="paginacion" class="pagination-lg"></ul>
                                    </div>
                                    
                                </div>
                            </div>
                        
        <!-- Modal Comprobante -->
            
        <div class="modal fade" id="comprobanteModal" tabindex="-1" role="dialog" aria-labelledby="contactoTitulo" aria-hidden="true" style="font-family: 'Playfair Display', serif">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <i><img class="logoPin" src="img/icono-pin.png"></i> 
                        <h5 class="modal-title" id="contactoTitulo"> Tu comprobante </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> 
                        
                    </div>
                      
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                
                            
                                    
                            <div class="row">
                                <div class="col-md-12" style="margin: auto 0;">       
                                                  
                                    <table id="comprobanteTabla" >
                                        <thead>
                                        <th id="modalId" colspan="5" style="font-size: 20px"> Título </th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="modalLugar" colspan="2" style="font-size: 14px">Lugar</td>
                                                <td id="modalLoc" colspan="2" style="font-size: 14px">Localidad</td>
                                            </tr>
                                            <tr>
                                                <td id="modalFecha" colspan="2" style="font-size: 14px">Fecha</td>
                                                <td id="modalHora" colspan="2" style="font-size: 14px">Hora</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><hr style="color: #cccccc"></td>
                                            </tr>
                                            <tr style="text-transform: uppercase;font-size: 17px; color: #666666; padding-top: 5px">
                                                <td id="modalNom" colspan="2"><?php echo $_SESSION['nombre']?> <?php echo $_SESSION['apellido']?></td>
                                                <td id="modalDni" colspan="2">DNI <?php echo $_SESSION['dni']?></td>
                                            </tr>
                                        </tbody>
                                    </table>                     
                                            
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <input type="button" class="btn btn-lg btn-success btn-block" value="Generar PDF" onclick="comprobante.comprobantepdf()">
                                        </div>
                                            
                                    </div>

                                    </div>
                                            
                                    </div>                           
                                 </div>      
                            </div>
                        </div>
                    </div>
                                                    
                </div>
            </div>
        </div>
                             
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Llama al pie de la página-->
        <?php
        require_once 'secciones/footer.php';
        ?>
        
    </body>
</html>