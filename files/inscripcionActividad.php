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
        <script src="js/comprobante.js" type="text/javascript"></script>
        <script src="js/pago.js" type="text/javascript"></script>
        
        <!-- Estilos -->
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
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
                <div class="container">
                    <input hidden id="idOculto" value="<?php echo $_SESSION['id_cuenta']?>"/>
                    <input hidden id="inscrOculto" value="<?php echo $_GET["id"]?>"/>
                    
                    
                    <!-- MultiStep Form -->
                    <div class="container-fluid" id="">
                        <div class="row justify-content-center mt-0">
                            <div class="col-md-12 text-center">
                                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                    <h2><strong> Revisa los datos de tu inscripción</strong></h2>
                                    &nbsp;
                                    <div class="row">
                                        <div class="col-md-12 mx-0">
                                            <form id="msform">
                                                <!-- progressbar -->
                                                <div class="col-md-offset-3" style="margin-left: 200px ">
                                                    <ul id="progressbar">
                                                    <li class="active" id="personal"><strong>Datos personales</strong></li>
                                                    <li id="resumen"><strong> Resumen</strong></li>
                                                    <li id="aviso"><strong>Aviso</strong></li>
                                                    </ul> 
                                                </div>
                                                
                                                <!-- fieldsets -->
                                                <fieldset>
                                                    <div class="form-card">
                                                        <h3 class="fs-title">Datos personales</h3> &nbsp; 
                                                        <div class="row col-md-12">
                                                            <div class="col-md-6">
                                                                <label for="nombreCompr"> Nombre </label>
                                                                <input id="nombreCompr" type="text" name="nombreCompr" placeholder="Nombre" value="<?php echo $_SESSION['nombre']?>" disabled/> 
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="apellidoCompr"> Apellido </label>
                                                                <input id="apellidoCompr" type="text" name="apellidoCompr" placeholder="Apellido" value="<?php echo $_SESSION['apellido']?>" disabled/> 
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row col-md-12">
                                                            <label for="dniCompr"> Documento </label>
                                                            <input id="dniCompr" type="text" name="dniCompr" placeholder="DNI" value="<?php echo $_SESSION['dni']?>" disabled/> 
                                                        </div>
                                                        
                                                        <div class="row col-md-12">
                                                            <label for="correoCompr"> Correo Electrónico </label>
                                                            <input id="correoCompr" type="email" name="correoCompr" placeholder="Correo Electrónico" value="<?php echo $_SESSION['cuenta']?>" disabled/>
                                                        </div>
                                                    </div> <input type="button" name="next" class="next action-button" value="Siguiente" />
                                                </fieldset>
                                                
                                                
                                                
                                                <fieldset>
                                                    <div class="form-card">
                                                        <h2 class="fs-title">Datos de la actividad</h2> &nbsp; 
                                                        <div class="row col-md-12">
                                                            <div class="col-md-9">
                                                                <label for="tituloInscr"> Nombre de la Actividad </label>
                                                                <input id="tituloInscr" type="text" name="tituloInscr" disabled/>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="precioInscr"> Precio </label>
                                                                <input id="precioInscr" type="text" name="precioInscr" disabled/> 
                                                            </div>
                                                        </div> 
                                                        
                                                        <div class="row col-md-12">
                                                            <div class="col-md-6">
                                                                <label for="lugarInscr"> Lugar </label>
                                                                <input id="lugarInscr" type="text" name="lugarInscr" disabled/>
                                                            </div>
                                                            <div class="col-md-6"> 
                                                                <label for="localidadInscr"> Localidad </label>
                                                                <input id="localidadInscr" type="text" name="localidadInscr" disabled/> 
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row col-md-12">
                                                            <div class="col-md-6">
                                                                <label for="fechaInscr"> Fecha </label>
                                                                <input id="fechaInscr" type="text" name="fechaInscr" disabled/>
                                                            </div>
                                                            <div class="col-md-6"> 
                                                                <label for="horaInscr"> Hora </label>
                                                                <input id="horaInscr" type="text" name="horaInscr" disabled/> 
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <input type="button" name="previous" class="previous action-button-previous" value="Anterior" /> 
                                                    <input type="button" name="next" class="next action-button" value="Siguiente" />
                                                </fieldset>
                                                
                                                <fieldset >
                                                    <div class="form-card">
                                                        <h2 class="fs-title">Datos del Pago</h2>
                                                       
                                                        <label class="pay">Nombre del Titular*</label> 
                                                        <input type="text" name="holdername" placeholder="" id="name_on_card" maxlength="19"/>
                                                        <div class="row">
                                                            <div class="col-9"> 
                                                                <label class="pay">Número de tarjeta*</label> 
                                                                <input type="text" name="cardno" placeholder="" id="card_number" maxlength="16"/> 
                                                            </div>
                                                            <div class="col-3"> 
                                                                <label class="pay">CVC*</label> 
                                                                <input type="text" name="cvcpwd" placeholder="***" id='cvv' maxlength="3"/> 
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3"> <label class="pay">Fecha de Vencimiento*</label> </div>
                                                            <div class="row col-9"> 
                                                                <div class="col-md-2">
                                                                    <select class="list-dt form-control" id="month" name="expmonth" id="expiry_month">
                                                                    <option selected disabled>Mes</option>
                                                                    <option>01</option>
                                                                    <option>02</option>
                                                                    <option>03</option>
                                                                    <option>04</option>
                                                                    <option>05</option>
                                                                    <option>06</option>
                                                                    <option>07</option>
                                                                    <option>08</option>
                                                                    <option>09</option>
                                                                    <option>10</option>
                                                                    <option>11</option>
                                                                    <option>12</option>
                                                                    </select>
                                                                </div>
                                                                 
                                                                <div class="col-md-2">
                                                                    <select class="list-dt form-control" id="year" name="expyear" id="expiry_year">
                                                                        <option selected disabled>Año</option>
                                                                        <option>2020</option>
                                                                        <option>2021</option>
                                                                        <option>2022</option>
                                                                        <option>2023</option>
                                                                        <option>2024</option>
                                                                        <option>2025</option>
                                                                        <option>2026</option>
                                                                    </select> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div> 
                                                    <input type="button" name="previous" class="btn btn-outline-primary previous action-button-previous" value="Anterior" /> 
                                                    <input type="button" name="make_payment" class="btn btn-outline-primary next action-button" value="Confirmar" onclick="comprobante.alta()" />
                                                </fieldset>
                                                                                              
                                            </form>
                                        </div>
                                    </div>
                                </div>
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