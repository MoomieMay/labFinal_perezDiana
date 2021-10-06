<footer id="foot" class="footer">
    <div class="container">
        <ul class="footerSecciones">
            <li>
                <a data-toggle="modal" data-target="#somosModal" href="">Quienes Somos</a>
            </li>
            
            <li>
                <a data-toggle="modal" data-target="#contactoModal" href="">Contacto</a>
            </li>
            
            <li>
                <a data-toggle="modal" data-target="#politicaModal" href="">Política de Privacidad</a>
            </li>
            
            <li>
                <a data-toggle="modal" data-target="#faqsModal" href="">Preguntas Frecuentes</a>
            </li>
            
            <li id="faceLogo">
            <a href="http://www.facebook.com" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
            </li>
            
            <li id="twitLogo">
            <a href="http://www.twitter.com" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            </li>

            <li id="instaLogo">
                <a href="http://www.instagram.com" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            
        </ul>
<!-- Fin de sección de items -->
    


    <ul class="footerSocial" hidden>
        <li id="faceLogo">
            <a href="http://www.facebook.com" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
        </li>
        
        <li id="">
            <a href="http://www.twitter.com" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
        </li>
        
        <li>
            <a href="http://www.instagram.com" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
        </li>
        
    </ul>
<!-- Fin de sección de redes sociales-->
<p class="text-center footerTitulo">Copyright @2020 | Diseñado por <a>Diana Pérez</a></p>
    </div>
</footer>

<!-- Modal Quienes Somos -->
            
        <div class="modal fade" id="somosModal" tabindex="-1" role="dialog" aria-labelledby="somosTitulo" aria-hidden="true" style="font-family: 'Playfair Display', serif">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <i><img class="logoPin" src="img/icono-pin.png"></i> 
                        <h5 class="modal-title" id="somosTitulo">¿Quienes somos?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="row">
                                        <div class="text-center">
                                           Somos una web independiente que nuclea todo tipo de espectaculos y actividades artisticas de las localidades de Caleta Olivia,
                                           Comodoro Rivadavia y Pico Truncado. <br> 
                                           A través de nuestro sitio podrás ver artistas locales, conocer sus próximas producciones, inscribirte a cursos, comprar entradas
                                           <strong>¡y mucho más!</strong> <br> &nbsp;
                                           
                                        </div>

                                    </div>
                                                     
                                 </div>      
                            </div>
                        </div>
                    </div>
                                                    
                </div>
            </div>
        </div>

<!-- Modal Contacto -->
            
        <div class="modal fade" id="contactoModal" tabindex="-1" role="dialog" aria-labelledby="contactoTitulo" aria-hidden="true" style="font-family: 'Playfair Display', serif">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <i><img class="logoPin" src="img/icono-pin.png"></i> 
                        <h5 class="modal-title" id="contactoTitulo">Dejanos tu mensaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> 
                        
                    </div>
                      
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                
                            
                                    
                            <div class="row">
                                <div class="col-md-12">       
                                        <form role="form" method="POST" action="files/secciones/indexMailer.php" >
                                                                              
                                        <fieldset>
                                            <div class="form-group">
                                               <input type="text" id="consultaNombre" name="consultaNombre" class="form-control input-lg" placeholder="Ingresa tu nombre">
                                            </div>
                                            
                                            <div class="form-group">
                                               <input type="email" id="consultaCorreo" name="consultaCorreo" class="form-control input-lg" placeholder="Ingresa tu correo electrónico">
                                            </div>
                                                        
                                                        
                                            <div class="form-group">
                                                <textarea type="text" id="consultaMensaje" name="consultaMensaje" class="form-control input-lg" placeholder="Ingresa tu mensaje"></textarea>
                                            </div>
                                                            
                                                          
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <input type="submit" class="btn btn-lg btn-success btn-block" value="Envia tu consulta">
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
            </div>
        </div>

<!-- Modal FAQs -->
            
        <div class="modal fade" id="faqsModal" tabindex="-1" role="dialog" aria-labelledby="ModalHorariosTitulo" aria-hidden="true" style="font-family: 'Playfair Display', serif">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <i><img class="logoPin" src="img/icono-pin.png"></i> 
                        <h5 class="modal-title" id="exampleModalLongTitle">Preguntas Frecuentes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="row">
                                        <ul id="accordion" class="col-sm-6 col-md-12 faqs">
                                           <!-- Question 7 -->
                                            <li>
                                                <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                                                    ¿Cómo creo una cuenta?
                                                    <span class=" text-info pull-right"></span>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                              <div class="card-body">
                                                  Para crear una cuenta debes hacer clic en el hipervinculo “Registrate” que se encuentra dentro del icono de la sesión en el lado derecho de la barra de menú. Esto abrirá un formulario con los datos que tenes que completar. Recorda que existen dos tipos de cuentas: artista y usuario. Los artistas pueden publicar sus
                                              espectáculos y actividades y los usuarios son los que podrán inscribirse y comprar entradas.</div>
                                            </div>
                                            </li>
                                            <!-- Question one -->
                                            <li>
                                                <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                                                    ¿Cómo puedo comprar una entrada?
                                                    <span class=" text-info pull-right"></span>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                              <div class="card-body">
                                                  Para comprar una entrada a los espectáculos publicados tenes que ingresar en el sitio con tu correo y contraseña.<br>
                                                 Luego,ingresa en "Espectaculos" y cuando encuentres uno que te interese clickea en el botón "Comprar Entrada". 
                                                 Deberás completar el formulario con tus datos, elegir el medio de pago ¡y listo!</div>
                                            </div>
                                            </li>
                                            
                                            <!-- Question two -->
                                            <li>
                                                <div class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" >
                                                    ¿Puedo volver a descargar un comprobante?
                                                    <span class=" text-info pull-right"></span>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                              <div class="card-body">
                                                  Podes descargar tus comprobantes todas las veces que quieras. Para esto sólo tenes que ir a “Comprobantes” haciendo clic en tu nombre en la parte derecha del menú. Ahí vas a ver una tabla con todas tus inscripciones y compras y haciendo clic en el icono de la entrada vas a visualizar los datos y vas a poder generar un archivo PDF que podes descargar.
                                              </div>
                                            </div>
                                            </li>
                                            <!-- Question 3 -->
                                            <li>
                                                <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                                                    ¿Cómo me contacto con un artista?
                                                    <span class=" text-info pull-right"></span>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                              <div class="card-body">
                                                  Para contactarte con un artista tenes que buscar su “Tarjeta de Artista”. Las mismas se encuentran dentro de “Artistas”. En ellas podes encontrar los enlaces a sus redes sociales y su dirección de correo electrónico.</div>
                                            </div>
                                            </li>
                                            <!-- Question 4 -->
                                            <li>
                                                <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                                                   ¿Cómo publico una actividad o espectáculo?
                                                    <span class=" text-info pull-right"></span>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                              <div class="card-body">
                                                  Para publicar una actividad o espectáculo tenes que iniciar sesión. Para esto sólo tenes que ir a “Gestión de Producciones” haciendo clic en tu nombre en la parte derecha del menú. Ahí vas a ver los botones para agregar una actividad o un
                                              espectáculo. Si los presionas vas a ver el formulario con todos los datos que tenes que completar.</div>
                                            </div>
                                            </li><!-- Question 5 -->
                                            <li>
                                                <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                                                    ¿Cómo descargo la lista de asistentes?
                                                    <span class=" text-info pull-right"></span>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                              <div class="card-body">
                                                  Para publicar una actividad o espectáculo tenes que iniciar sesión. Para esto sólo tenes que ir a “Gestión de Producciones” haciendo clic en tu nombre en la parte derecha del menú. Vas a ver una tabla con todas tus producciones y si haces clic en el icono de la lista vas a poder ver la lista de asistentes y presionando el botón “Generar PDF” vas a poder descargarla.</div>
                                            </div>
                                            </li>
                                            <!-- Question 6 -->
                                            <li>
                                                <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >
                                                    Se me pide que complete mi tarjeta de artista, ¿Qué proposito tiene la misma?
                                                    <span class=" text-info pull-right"></span>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                              <div class="card-body">
                                                 La “Tarjeta de Artista” es tu tarjeta de presentación para que la comunidad te conozca. En la misma figura tu nombre, disciplina principal, localidad, una pequeña biografía, los enlaces a tus redes sociales y tu correo electronico para que cualquiera pueda contactarte.</div>
                                            </div>
                                            </li>
                                            


                                        </ul>
                                    </div>
                                            
                                    
                                    <hr class="colorgraph">
                                                              
                                 </div>      
                            </div>
                        </div>
                    </div>
                                                    
                </div>
            </div>
        </div>

<!-- Modal Politica de Privacidad -->
            
        <div class="modal fade" id="politicaModal" tabindex="-1" role="dialog" aria-labelledby="ModalHorariosTitulo" aria-hidden="true" style="font-family: 'Playfair Display', serif">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <i><img class="logoPin" src="img/icono-pin.png"></i> 
                        <h5 class="modal-title" ><strong>Política de Privacidad</strong></h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      
                    <div class="modal-body">
                        <div class="container">
                            <div class="row" style="">
                                <div class="col-md-12">
                                   
                                    
                                    <div class="row">
                                        <div class="aboutus">
                                           <p>La presente Política de Privacidad establece los términos en que Arte Independiente usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. 
                                               Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, 
                                               lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que 
                                               le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.</p>
                                           <p><strong>Información que es recogida</strong></p><p>Nuestro sitio web podrá recoger información personal por ejemplo: Nombre,&nbsp; información de contacto como&nbsp; su dirección de correo electrónica e información demográfica.
                                               Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.</p><p><strong>Uso de la información recogida</strong></p>
                                           <p>Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios. 
                                               &nbsp;Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o 
                                               ue pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.</p><p>Arte Independiente está altamente comprometido 
                                               para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.</p>
                                           <p><strong>Cookies</strong></p><p>Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces
                                               para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto 
                                               brindarte el mejor servicio personalizado de su web.</p><p>Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente 
                                               para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar 
                                               un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente. Usted puede aceptar o negar el uso de cookies, 
                                               sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. 
                                               Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.</p>
                                           <p><strong>Enlaces a Terceros</strong></p><p>Este sitio web pudiera contener en laces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, 
                                               ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. 
                                               Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.</p>
                                           <p><strong>Control de su información personal</strong></p><p>En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web.&nbsp; 
                                               Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico. &nbsp;
                                               En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.</p>
                                           <p>Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.</p>
                                           <p>Arte Independiente Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.</p>

                                        </div>

                                    </div>
                                            
                                    
                                 </div>      
                            </div>
                        </div>
                    </div>
                                                    
                </div>
            </div>
        </div>