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
        <script defer src="js/usuario.js" type="text/javascript"></script>
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
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
                        <h2> Entradas </h2>
                        <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                    </a>
                    <hr class="colorgraph">

                    
                    <div class="row">
                            <div class="col-md-12 col-md-offset-2">
                                
                                <!-- Comienzo de la tabla -->
                                <div class="table">
                                    <table class="table table-hover table-content">
                                        <thead>
                                            <tr>
                                                <th> Detalle del Espectáculo </th>
                                                <th> Disciplina </th>
                                                <th> Fecha de Inicio </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-status="pagado">
                                                <td class="col-md-6">
                                                    <div class="actividad-info">
                                                        <div class="info-body">
                                                            <h4 class="info-title"> Título de la actividad </h4>
                                                            <h5 class="info-content"> Localidad - Costo </h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td class="col-md-2">
                                                    <span class="pagado"> (Disciplina)</span>
                                                </td>
                                                
                                                <td class="col-md-2">
                                                    <span class="media-meta"> Fecha de la actividad </span>
                                                </td>
                                                        
                                                <td class="col-md-1">
                                                    <button type="button" class="btn-default btn-circle">
                                                        <i class="far fa-file-pdf"></i>
                                                    </button>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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