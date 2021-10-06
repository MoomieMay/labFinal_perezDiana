<header>
    <div>
        <img src="img/banner.png" height="100" width="100%">
    </div>
    <!-- Navbar con logo -->
    <nav class="navbar  navbar-expand-lg " id="header" style="background-color: #006699; padding-right: 0">
        <div class="container-fluid">
            <!-- Logo del sitio -->
            <div class="navbar-header">
                <a class="navbar-brand" href="files/index.php"  style="color: whitesmoke">
                    <i class="fas fa-home"></i>
                </a>
            </div>  
        <!-- Menu hamburguesa para versión móvil -->    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 
        
        <!-- Menu de páginas del sitio -->    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav col-md-11 col-sm-11 col-xs-12 ">
                <li class="nav-item col-md-1 col-sm-2 col-xs-12" >
                    <a id="nav-link" class="nav-link" href="files/artistasGeneral.php"> Artistas </a>
                </li>
                <li class="nav-item col-md-2 col-sm-2 col-xs-12" style="text-align: center; padding-right: 0">
                    <a id="nav-link" class="nav-link" href="files/espectaculosGeneral.php"> Espectáculos </a>
                </li>
                <li class="nav-item col-md-2 col-sm-2 col-xs-12" style="padding-left: 0">
                    <a id="nav-link" class="nav-link" href="files/actividadesGeneral.php"> Actividades </a>
                </li>
            </ul>
            
            <!-- Buscador -->
            <div class="navbar-nav col-md-3" id="divSugestivo" hidden >
                <form action="" id="buscar">
                    <input type="text" id="textSugestivo" ><i class="fa fa-search"></i>
                </form>
            </div>
            
            
            <!-- Desplegable de login/registro -->
            <ul class="nav navbar-nav mr-auto col-md-1 col-sm-1 col-xs-12" id="loginDrop" style="padding-left: 30px; padding-right: -10px">
                <li class="dropdown">
                    <!-- Icono de usuario y flecha -->
                    <a href="#" id="linkLogin" data-toggle="dropdown"> <i class="fas fa-user-circle" id="loginIcon"></i> </a>
                    
                    
                    <ul class="dropdown-menu  dropdown-menu-right" id="loginMenu">
                        <li>
                            <div class="row" >
                                <div class="col-md-12">
                                   <!-- no recargue el formulario 
                                    <iframe name="frame" style="display:none"></iframe> -->
                                    <!-- Formulario para login/registro -->
                                    <form id="formLog" name="formLog" class="form" role="form" method="POST" action="" onsubmit="return true" accept-charset="UTF-8" >
                                        
                                        <hr class="colorgraph">
                                        <input type="hidden" name="accion" value="login">
                                        
                                        <div class="row justify-content-center" id="perfilLogin">
                                            <p class="justify-content-center" for="campoPerfil">Soy un: </p>
                                            <div id="radiosPerfil">
                                                <input type="radio" id="radioArtista" name="radioPerfil" value="artista"> 
                                                <label for="radioArtista"> Artista </label>
                                                <input type="radio" id="radioUsuario" name="radioPerfil" value="usuario">
                                                <label for="radioUsuario"> Usuario </label>
                                            </div>
                                            
                                            <small style="visibility: hidden;" id="msj" class="msj"></small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="sr-only" for="campoCorreo">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="campoCorreo" name="campoCorreo" placeholder="Correo Electrónico">
                                            <small style="visibility: hidden;" id="msj" class="msj"></small>
                                        </div>
                                            
                                        <div class="form-group">
                                            <label class="sr-only" for="campoPass">Contraseña</label>
                                            <input type="password" class="form-control" id="campoPass" name="campoPass"placeholder="Contraseña">
                                            <small style="visibility: hidden;" id="msj2" class="msj2"></small>
                                        
                                            <div id="loginText" class="help-block text-center" hidden>
                                                <a href="" >¿Olvidaste la contraseña?</a>
                                            </div>
                                        </div>
                                            
                                        <div class="form-group">
                                            <button type="submit" onclick="" class="btn btn-primary btn-block">Ingresar</button>
                                        </div>                                              
                                    </form>
                                </div>
                                
                                <!-- Mensaje de error -->
                                <?php if($mensajes != ""){ ?>
                                <!--div class="alert alert-danger" id="errorLogin">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button-->
                                <script>
                                    swal("<?php echo $mensajes;?>", "Por favor intente de nuevo", "error");
                                </script>
                                
                                <?php } ?> 
                                    
                                    
                                <div class="bottom text-center" id="loginText">
                                    ¿Nuevo en el sitio? <a href="../labFinal_perezDiana/files/altaUsuario.php"><b>Registrate</b></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </div> 
        </div> 
    </nav>
</header>