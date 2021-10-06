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
        <script defer src="js/produccion.js" type="text/javascript"></script>
        <script src="js/usuario.js" type="text/javascript"></script>
        
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
                    <div class="">
                        <h2 class="d-inline-block align-middle"> Producciones </h2>
                        <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                        <input hidden id="tipoOculto" value="<?php echo $_SESSION['perfil']?>"/>
                        <button class="btn btn-outline-primary float-right" id="agregarEspectaculo" onclick="location.href='files/altaEspectaculo.php'"> Agregar Espectáculo </button>
                        <button class="btn btn-outline-primary float-right" id="agregarActividad" onclick="location.href='files/altaActividad.php'"> Agregar Actividad </button>
                    </div>
                        
                    <hr class="colorgraph">

                    
                    <div class="row">
                            <div class="col-md-12 col-md-offset-2" id="tablaMisProdus">
                                 
                                <!-- Comienzo de la tabla -->
                                <table class="table table-striped table-content" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th> Actividad/Espectáculo </th>
                                                <th> Tipo </th>
                                                <th> Fecha</th>
                                                <th> Entradas Vendidas </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaEspectaculo">
                                            <!-- Espectaculos por Artista -->
                                        </tbody>
                                    </table>
                                    <div class="row bloque col-md-12" id="paginas">
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