<header>
    <div>
        <img src="img/banner.png" height="100" width="100%">
    </div>
    <!-- Navbar con logo -->
    <nav class="navbar  navbar-expand-lg " id="header" style="background-color: #006699">
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
            <ul class="navbar-nav col-md-10 col-sm-11 col-xs-12 ">
                <li class="nav-item col-md-1 col-sm-2 col-xs-12">
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
            <div class="navbar-nav col-md-2" id="divSugestivo" hidden >
                <form action="" id="buscar">
                    <input type="text" id="textSugestivo" ><i class="fa fa-search"></i>
                </form>
            </div>
            
            <!-- Desplegable de sesión -->
            <ul class="nav navbar-nav mr-auto col-md-2 col-sm-4 col-xs-12" id="nombreUsuHeader">
                <li class="dropdown">
                    
                        <!-- Titulo de menu -->
                        <a class="nav-link dropdown-toggle sesionName" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b id="nombreSesion"> Hola <?php echo $_SESSION['nombre']?> <span><i class="fas fa-angle-down"></i></span> </b>
                        </a>
                        
                        <!-- Secciones de menu -->
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="sesionMenu">
                            <a class="dropdown-item" href="files/sesionUsuario.php"> Datos Personales </a>
                            <a class="dropdown-item" href="files/comprobantesUsuario.php"> Comprobantes </a>
                            <hr class="colorgraph">
                            <a class="dropdown-item" href="files/secciones/logoff.php">Cerrar Sesión</a>
                        </div>
                </li>
            </ul>
        </div>
        </div>
    </nav>
</header>