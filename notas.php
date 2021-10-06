<h1>Mensaje enviado</h1>

<!DOCTYPE html>
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
  
  <div class="toast" data-autohide="false">
    <div class="toast-header">
      <small class="text-muted"></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      Recibimos tu mensaje y nos comunicaremos a la brevedad.
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $('.toast').toast('show');
});
</script>



<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>


<!-- TARJETAS DEL INDEX -->
<div class="row" id="tarjetas">
            <div class="col-md-4">
                <div class="card" id="tarjLocalidad"  style="background-color: rgba(253,108,203,.8)">
                    <img src="img/escenario.jpeg" class="card-img-top" alt="danza en el escenario">
                    <div class="card-body">
                        <a href="comodoroProducciones.php?id=Comodoro Rivadavia" class="btn btn-outline btn-lg btn-block">Comodoro Rivadavia</a>
                    </div>
                </div>
            </div>
            
            <div class="card col-md-4" id="tarjLocalidad">
                <img src="img/teatro.jpg" class="card-img-top" alt="teatro Lazaro Urdin">
                <div class="card-body">
                    <a href="truncadoProducciones.php?id=Pico Truncado" class="btn btn-outline btn-lg btn-block" style="background-color: turquoise">Pico Truncado</a>
                </div>
            </div>
            
            <div class="card col col-md-3">
                    <img src="img/muestra.jpeg" class="card-img-top" alt="muestra de Comodoro">
                    <div class="card-body">
                        <a href="caletaProducciones.php?id=Caleta Olivia" class="btn btn-outline btn-lg btn-block" style="background-color: yellow">Caleta Olivia</a>
                    </div>
            </div>
        </div>
        
        <!-- STICKY FOOTER -->
        <body>
  <div class="wrapper">

      content

    <div class="push"></div>
  </div>
  <footer class="footer"></footer>
</body>

html, body{
  height: 100%;
  margin: 0;
}
.wrapper {
  min-height: 100%;

  /* Equal to height of footer */
  /* But also accounting for potential margin-bottom of last child */
  margin-bottom: -130px;
}

.footer,
.push {
  height: 150px;
}


<!-- TARJETA DE ESPECTACULOS / ACTIVIDADES -->
<div class="row cnt-block" >
                        
                        <div class="col-md-4" >
                            <figure><img src="img/espectaculoGral.jpg"></figure>
                        </div>
                            
                        <div class="col-md-8" id="tarjetaActividad">
                            <h2> Título del espectáculo <br><span class="span_loc"> Localidad </span> <span class="span_cat"> Categoría </span></h2>
                            
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Fusce facilisis turpis rutrum blandit consequat. Aliquam fermentum suscipit enim sit amet fermentum. 
                                Fusce et facilisis justo. Curabitur ligula mauris, maximus vitae lobortis sed, volutpat sit amet mi. </p>
                            
                            <ul class="list-group d-inline-block">
                                <li class="list-group-item"> <strong> Lugar: </strong> Calle, número </li>
                                <li class="list-group-item"> <strong> Fecha: </strong> dd/mm/aaaa </li>
                                <li class="list-group-item"><strong> Hora: </strong> 00:00 hs </li>
                            </ul>
                            <br><small> <strong>Precio: </strong> $99,99 </small><br>
                            <button type="button" class="btn btn-warning btn-lg"> Comprar Entrada </button>
                        </div>
                    </div>


<!-- Contenido de la tarjeta de artista --> 
                    <div class="row cnt-block">
                        <div class="col-md-4" >
                                <figure><img src="img/artist.jpg"></figure>
                        </div>
                        <div class="col-md-6" id="tarjetaArtista">
                            <div>
                                
                            </div>
                            
                            <h2> Nombre del Artista <br><span class="span_loc"> Localidad </span> <span class="span_cat"> Disciplina </span></h2>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Fusce facilisis turpis rutrum blandit consequat. Aliquam fermentum suscipit enim sit amet fermentum. 
                                Fusce et facilisis justo. Curabitur ligula mauris, maximus vitae lobortis sed, volutpat sit amet mi. </p>
                            
                            
                            
                            <span>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                </ul>
                            </span>
                        </div>
                    </div>







<span><ul>if(facebook !== null){<li><a href="'+facebook+'" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>}if(instagram !== null){<li><a href="'+instagram+'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>}if(youtube !== null){<li><a href="'+youtube+'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>}</ul></span>

<!-- Filtros -->
            <div class="container">
                <div class="row col-md-10 offset-md-2" id="filtroGrande">
                    <div class="filtros" id="filtroItem">
                        <select id="filtroDisciplina">
                        <option selected disabled> Disciplina </option>
                        <option> Artes Visuales </option>
                        <option> Música </option>
                        <option> Teatro </option>
                        </select>
                    </div>
                    
                    <div class="filtros" id="filtroItem">
                        <select id="filtroCategoria">
                            <option selected disabled> Categoría </option>
                            <option> Infantil </option>
                            <option> Adultos </option>
                            <option> Para todo público</option>
                        </select>
                    </div>
                    
                    <div class="filtros" id="filtroItem">
                        <select id="filtroLocalidad">
                            <option selected disabled> Localidad </option>
                            <option> Caleta Olivia </option>
                            <option> Comodoro Rivadavia </option>
                            <option> Pico Truncado </option>
                        </select>
                    </div>
                    
                    <div class="filtros" id="filtroItem">
                        <select id="filtroPrecio">
                            <option selected disabled> Precio </option>
                            <option> Gratuito </option>
                            <option> Hasta $200 </option>
                            <option> Hasta $500 </option>
                            <option> Hasta $1000 </option>
                        </select>
                    </div>
                    
                    <div class="filtros" id="filtroItem">
                        <button class="btn btn-sm btn-outline-success" type="button"> Aplicar </button>
                    </div>
                    
                    <div class="filtros" id="filtroItem">
                        <button class="btn btn-sm btn-outline-danger" type="button"> Quitar </button>
                    </div>
                </div>
            </div>



<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXxx -->

            <div class="card container-fluid w-25 mt-3">
               
                    <div class="card-body">
                        <form id="formBuscar" name="formBuscar" method="POST" action="files/usuarios_consulta.php" >
                            <div class="input-group flex-nowrap" id="divSug">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="addon-wrapping">Buscar</span>
                                    </div>
                                <input type="text" id="textBusquedaUsuario" name="textBusquedaUsuario" class="form-control" placeholder="Nombre de usuario" autocomplete="off" >
                            </div>
                        </form>
                    </div>
            </div>  


            <div class="container-fluid my-4" id="listaUsu" hidden>
                <h2 class="text-center bg-light">Listado de usuarios</h2>
                <table class="table mb-5">    
                <thead>
                    <tr>
                        <th>Apellido</th><th>Nombre</th><th>Cuenta</th><th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="tbodyUsu"></tbody>
                <tfoot id="tfootUsu"></tfoot>
            </table>
            </div>

            <div class="container-fluid w-25 mt-3" id="paginas" name="paginas">
                <ul id="paginacion" class="pagination-lg"></ul>
            </div>

            <div class="container-fluid my-4" id="" name="" hidden>
                <h2 class="text-center bg-light">Listado de alumnos</h2>
                    <table class="table mb-5" id="tUsuh" name="tUsuh">    
                <thead>
                    <tr>
                        <th>Apellido</th><th>Nombre</th><th>Cuenta</th>
                    </tr>
                </thead>
                <tbody id="tbodyUsuh"></tbody>
                <tfoot id="tfootUsuh"></tfoot> 
            </table>
            </div>
       <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx-->
       <tbody id="tablaEspectaculo">
                                            <tr>
                                                <td class="col-md-6">
                                                    <div class="actividad-info">
                                                        <div class="info-body">
                                                            <h4 class="info-title"> Título del espectáculo </h4>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td class="col-md-2">
                                                    <span class="media-meta"> Fecha del espectáculo </span>
                                                </td>
                                                
                                                <td class="col-md-2">
                                                    <span class="media-meta"> Cantidad </span>
                                                </td>
                                                
                                                <td class="d-inline-block">
                                                    <button type="button" class="btn-default btn-circle">
                                                        <i class="far fa-file-pdf"></i>
                                                    </button>
                                                    <button type="button" class="btn-success btn-circle">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn-danger btn-circle">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </td>
                                                
                                                
                                            </tr>
                                        </tbody>
                                        
                                        
                                        
<div class="tips">
Payment card number: (4) VISA, (51 -> 55) MasterCard, (36-38-39) DinersClub, (34-37) American Express, (65) Discover, (5019) dankort
</div>

<div class="container">
  <div class="col1">
    <div class="card">
      <div class="front">
        <div class="type">
          <img class="bankid"/>
        </div>
        <span class="chip"></span>
        <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
        <div class="date"><span class="date_value">MM / YYYY</span></div>
        <span class="fullname">FULL NAME</span>
      </div>
      <div class="back">
        <div class="magnetic"></div>
        <div class="bar"></div>
        <span class="seccode">&#x25CF;&#x25CF;&#x25CF;</span>
        <span class="chip"></span><span class="disclaimer">This card is property of Random Bank of Random corporation. <br> If found please return to Random Bank of Random corporation - 21968 Paris, Verdi Street, 34 </span>
      </div>
    </div>
  </div>
  <div class="col2">
    <label>Card Number</label>
    <input class="number" type="text" ng-model="ncard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
    <label>Cardholder name</label>
    <input class="inputname" type="text" placeholder=""/>
    <label>Expiry date</label>
    <input class="expire" type="text" placeholder="MM / YYYY"/>
    <label>Security Number</label>
    <input class="ccv" type="text" placeholder="CVC" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
    <button class="buy"><i class="material-icons">lock</i> Pay --.-- €</button>
  </div>
</div>                                   