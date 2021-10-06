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
        <script defer src="lib/jQuery/jquery.twbsPagination.js" type="text/javascript"></script>
        <script src="js/produccion.js" type="text/javascript"></script>
        <script src="js/usuario.js" type="text/javascript"></script>
        <script src="js/comprobante.js" type="text/javascript"></script>

        
        <!-- Estilos -->
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f6346de447.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
        
         <!--jQuery datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="lib/jQuery/datepicker-es.js" type="text/javascript"></script>
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
                    <div class="">
                        <h2 class="d-inline-block align-middle"> Informes de venta </h2>
                        <input hidden id="idConsulta" value="<?php echo $_SESSION['id_cuenta']?>"/>
                        <input hidden id="tipoOculto" value="<?php echo $_SESSION['perfil']?>"/>
                        <button hidden class="btn btn-outline-primary float-right" id="agregarActividad" onclick="location.href='files/altaActividad.php'"> Generar PDF </button>
                    </div>
                        
                    <hr class="colorgraph">

                    <form id="formVentas" action="" method="POST" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-1" style="margin:auto; text-align: right">
                                <label> Desde: </label>
                            </div>
                            
                            <div class="form-group col-3" style="margin:auto">
                                <input class="form-control" type="text" id="fecha1" name="fecha1" placeholder="Ingresa la fecha">
                            </div>
                            
                            <div class="form-group col-1" style="margin:auto; text-align: right">
                                <label> Hasta: </label>
                            </div>
                            
                            <div class="form-group col-3" style="margin:auto">
                                
                                <input class="form-control" type="text" id="fecha2" name="fecha2" placeholder="Ingresa la fecha" style="margin:auto">
                            </div>
                            
                            <div class="form-group col-3 " style="margin:auto">
                                <input class="btn btn-outline-success" type="button" value="Realizar Consulta" onclick="comprobante.listarVentas($('#fecha1').val(), $('#fecha2').val())">
                            </div>
                        </div>
                        </form>
                    <br>
                    <div class="row" style="margin-top: 25px">
                            <div class="col-md-12 col-md-offset-2">
                                 
                                <!-- Comienzo de la tabla -->
                                    <table class="table table-striped table-content">
                                        <thead class="thead-dark" id="cabeceraComprobantes" hidden>
                                            <tr>
                                                <th> Usuario </th>
                                                <th> Actividad/Espectáculo </th>
                                                <th> Precio</th>
                                                <th> Fecha de Pago </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaEspectaculo">
                                            <!-- Espectaculos por Artista -->
                                            
                                        </tbody>
                                    </table>
                                <div class="row bloque col-md-12" id="paginas" hidden="">
                                        <ul id="paginacion" class="pagination-lg"></ul>
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