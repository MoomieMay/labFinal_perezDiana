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
        <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
        <script defer src="js/usuario.js" type="text/javascript"></script>
        <script src="js/produccion.js" type="text/javascript"></script>
        
        <!-- Estilos -->
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f6346de447.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
        
        <!-- Sweet Alert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <!-- jQuery timepicker -->
        <link rel="stylesheet" href="lib/jquery-timepicker/jquery.timepicker.min.css">
        <script  defer src="lib/jquery-timepicker/jquery.timepicker.min.js"></script>
        
        <!--jQuery datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="lib/jQuery/datepicker-es.js" type="text/javascript"></script>
    </head>
    
         
    <body class="Site">
    <!-- Llama al encabezado de la p??gina-->
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
        
    <!-- Comienzo del contenido de la p??gina -->
    <main class="Site-content"> 
            
        <div class="fondoForm" id="altaEspectaculo">
            <a>
                <h2> Registra tu espect??culo </h2>
                <input hidden id="usuarioOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                <input hidden id="tipoOculto" value="espectaculo"/>
            </a>
            
            <form id="formAltaEsp" action="" method="POST" autocomplete="off">
                <hr class="colorgraph">
                
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="nombreProduccion"> Nombre del espect??culo </label>
                        <input class="form-control" type="text" id="nombreProduccion" name="nombreProduccion" placeholder="Ingresa el nombre de tu espect??culo">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="categoriaProduccion"> Categor??a </label>
                        <select class="form-control" id="categoriaProduccion" name="categoriaProduccion">
                            <option disabled selected value=""> Selecciona una opci??n</option>
                            <option value="Infantil"> Infantil </option>
                            <option value="Adulto"> Adultos </option>
                            <option value="ATP"> Apta para Todo P??blico </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                       <label for="direccionProduccion"> Ubicaci??n </label>
                       <input class="form-control" type="text" id="direccionProduccion" name="direccionProduccion" placeholder="Ingresa nombre del lugar ?? CALLE y N??MERO">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="localidadProduccion"> Localidad </label>
                        <select class="form-control" id="localidadProduccion" name="localidadProduccion">
                            <option disabled selected value=""> Selecciona una opci??n</option>
                            <option value="Caleta Olivia"> Caleta Olivia </option>
                            <option value="Comodoro Rivadavia"> Comodoro Rivadavia </option>
                            <option value="Pico Truncado"> Pico Truncado </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="fechaProduccion"> Fecha </label>
                        <input class="form-control" type="text" id="fechaProduccion" name="fechaProduccion" placeholder="Ingresa la fecha">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="horaProduccion"> Hora </label>
                        <input class="form-control time" type="text" id="horaProduccion" name="horaProduccion" >
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="precioProduccion"> Precio </label>
                        <input class="form-control" type="number" min="0" max="2000" step="50" id="precioProduccion" name="precioProduccion" placeholder="Ingresa el valor del espect??culo">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="cupoProduccion"> Cupo </label>
                        <input class="form-control" type="number" min="0" max="200" step="1" id="cupoProduccion" name="cupoProduccion" placeholder="Cupo M??XIMO de entradas">
                    </div>
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-12">
                        <label for="descripcionProduccion"> Descripci??n del espect??culo </label>
                        <textarea class="form-control" maxlength="280" id="descripcionProduccion" name="descripcionProduccion" placeholder="Describe tu espect??culo para que los dem??s sep??n de que se trata. No olvides que debe tener una longitud de HASTA 280 caracteres."></textarea>
                    </div>
                </div>

                <div>&nbsp;</div>
                
                <div> 
                    <button class="btn btn-outline btn-success" id="aceptarAlta" type="button" onclick="produccion.alta()" > Aceptar </button>
                    <button type="reset" class="btn btn-info"> Resetear </button>
                </div>
            </form>    
            </div>    
        </main>
        <!-- Llama al pie de la p??gina-->
        <?php require_once 'secciones/footer.php'; ?>
    </body>
</html>