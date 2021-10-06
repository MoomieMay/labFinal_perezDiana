//Validaciones
function validarAlta(){
        if($("#nombreUsuario").val() === "" && $("#apellidoUsuario").val() === "" && $("#correoUsuario").val() === ""
        && $("#confirmCorreo").val() === "" && $("#claveUsuario").val() === "" && $("#confirmUsuario").val() === ""
            ){
        $("#msj1").css({"visibility": "visible", "color":"red"});
        $("#msj1").html("Ingresa tu nombre");
        $("#msj2").css({"visibility": "visible", "color":"red"});
        $("#msj2").html("Ingresa tu apellido");
        $("#msj3").css({"visibility": "visible", "color":"red"});
        $("#msj3").html("Ingresa tu correo");
        $("#msj4").css({"visibility": "visible", "color":"red"});
        $("#msj4").html("Vuelve a ingresar tu correo");
        $("#msj5").css({"visibility": "visible", "color":"red"});
        $("#msj5").html("Ingresa tu contraseña");
        $("#msj6").css({"visibility": "visible", "color":"red"});
        $("#msj6").html("Vuelve a ingresar tu contraseña");
        //$("#msj7").css({"visibility": "visible", "color":"red"});
        //$("#msj7").html("Ingresa tu localidad");
        //$("#msj8").css({"visibility": "visible", "color":"red"});
        //$("#msj8").html("Ingresa tu perfil");
        //cuando se comience a escribir en los campos desaparece el cartel error
        $(document).ready(function(){
            $("#nombreUsuario").focus(function(){
                $("#nombreUsuario").removeAttr("style");
                $("#msj1").attr("hidden","");
            });
            $("#campoAp").focus(function(){
                $("#campoAp").removeAttr("style");
                $("#msj2").attr("hidden","");
            });
            $("#campoNU").focus(function(){
                $("#campoNU").removeAttr("style");
                $("#msj3").attr("hidden","");
            });
            $("#campoPass").focus(function(){
                $("#campoPass").removeAttr("style");
                $("#msj4").attr("hidden","");
            });
            $("#campoPass2").focus(function(){
                $("#campoPass2").removeAttr("style");
                $("#msj5").attr("hidden","");
            });
            $("#campoMail").focus(function(){
                $("#campoMail").removeAttr("style");
                $("#msj6").attr("hidden","");
            });
            $("#campoMail2").focus(function(){
                $("#campoMail2").removeAttr("style");
                $("#msj7").attr("hidden","");
            });
        });
        return false;
    }
}

var totalRecords = 0,
recPerPage = 3,
page = 1,
totalPages = 0,
records = [];

let artista = {
    // Variables
    "data" : {"id":0, "nombre":"", "apellido":"", "correo":"", "clave":"", "localidad":"", "disciplina":"","estado":"", 
        "idTarj":0, "descripcion":"", "facebook":"", "instagram":"", "youtube":"", "aux":"", "accion":""},
    "filtros" : {"accion":"", "orden": "", "indice": 0, "cantidad":0, "clave":"", "clave2":""},
    "parametros": {"url":"files/controladores/artistaControlador.php"},
        
    
    // Funciones
    "alta": function(){   
        artista.data.id = 0;
        artista.data.nombre = $("#nombreUsuario").val();
        artista.data.apellido = $("#apellidoUsuario").val();
        artista.data.correo = $("#correoUsuario").val();
        artista.data.clave = $("#claveUsuario").val();
        artista.data.localidad = $("#localidadUsuario").val();

        var seleccion = document.getElementById('disciplinaUsuario');
        artista.data.disciplina = seleccion.value;
        validarAlta();
        artista.data.accion = "ALTA";
        artista.abm(this.data);
    },
    
    "modificar": function(){
        artista.data.id = $("#idOculto").val();
        artista.data.nombre = $("#textNombre").val();
        artista.data.apellido = $("#textApellido").val(); 
        artista.data.correo = $("#textMail").val(); 
        artista.data.descripcion = $("#descripcionUsuario").val();
        artista.data.facebook = $("#faceUsuario").val(); 
        artista.data.instagram = $("#instaUsuario").val(); 
        artista.data.youtube = $("#ytUsuario").val(); 
        
        
        artista.data.accion = "MODIFICAR";
        artista.abm(this.data);
    },
    
    "actualizarTarjeta":function(){
        artista.data.descripcion = $("#descripcionUsuario").val();
        artista.data.facebook = $("#faceUsuario").val(); 
        artista.data.instagram = $("#instaUsuario").val(); 
        artista.data.youtube = $("#ytUsuario").val(); 
        
        artista.data.accion = "ACTUALIZARTA";
        artista.abm(this.data);
    },
    
    "baja": function(){
        artista.data.id = $("#idOculto").val();        
        
        artista.data.accion = "BAJA";
        artista.abm(this.data);
        
    },
    
    "cambiarClave": function(){
        artista.data.id = $("#idOculto").val();
        artista.data.clave = $("#textClaveVieja").val();
        artista.data.aux = $("#textClave").val(); 
        
        artista.data.accion = "CAMBIARCLAVE";
        artista.abm(this.data);
    },
    
    "cargar": function(id){
        artista.abm({"id":id,"accion":"CARGAR"});
    },
    
    "listarusu": function(){
        artista.filtros.accion = "LISTARUSU";
        artista.filtros.indice = 0;
        artista.filtros.cantidad = 20;
        artista.filtros.clave = $("#filtro").val();
        artista.abm(this.filtros);
    },
    
    //Buscar Artista
    "buscarArtista": function(){
        $('#pagination').empty();
        $('#pagination').removeData("twbs-pagination");
        $('#pagination').unbind("page");
         
        artista.filtros.accion = "BUSCARARTISTA";
        artista.filtros.indice = 0;
        artista.filtros.cantidad = 20;
        artista.filtros.clave =$("input:text[name=textSugestivo]").val();
        
        artista.abm(this.filtros);
        //setTimeout("location.href='http://localhost/labFinal_perezDiana/files/artistaBusqueda.php'",200); 
    },
    
    //Filtros para los espectaculos
    "listarFiltros": function(){
         $('#pagination').empty();
         $('#pagination').removeData("twbs-pagination");
         $('#pagination').unbind("page");
        console.log("listarFiltros Funciones JS");
        
        artista.filtros.indice = 0;
        artista.filtros.cantidad = 20;
        artista.filtros.clave =$('input:checkbox[name=loc]:checked').val();
        artista.filtros.clave2 = $('input:checkbox[name=disc]:checked').val();
        if(artista.filtros.clave===undefined){
            artista.filtros.accion = "LISTARFILTROSDISC";
        }else if(artista.filtros.clave2===undefined){
            artista.filtros.accion = "LISTARFILTROSLOC";
        }else{
           artista.filtros.accion = "LISTARFILTROS"; 
        }             
        
        artista.abm(this.filtros);
    },
    
    "quitarFiltros":function(){
        console.log("quitando filtros..."); 
        $('#loc li label input[type=checkbox]').prop('checked',false);
        $('#disc li label input[type=checkbox]').prop('checked',false);
        //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
        $pagination.twbsPagination("destroy"); 
        $pagination.remove();
        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
        $('#filtros').html('<div class="container" id="tarjetaTipo"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>');
                      
        artista.listarusu();
        //setTimeout("location.reload()", 100);
    },
    
    "completar":function(){
        artista.data.id = $("#idOculto").val();
        artista.data.descripcion = $("#descripcionUsuario").val();
        artista.data.facebook = $("#faceUsuario").val(); 
        artista.data.instagram = $("#instaUsuario").val(); 
        artista.data.youtube = $("#ytUsuario").val(); 
        
        artista.data.accion = "COMPLETAR";
        artista.abm(this.data);
    },
    
    
    "abm": function(datojson){
        $.ajax(
                {"url":artista.parametros.url,
                "method":"post",
                "dataType":"json",
                "accept":"json",
                "data":{"data":JSON.stringify(datojson)}
            }).done(function(data,textStatus){
                
                switch(data.accion){
                    case "ALTA":
                        if(data.error == "Duplicado"){
                            swal("Este artista ya esta registrado", "Por favor intente de nuevo", "error");
                       
                        }
                        else{
                            swal("Registrado con éxito","", "success").then(function(){
                               setTimeout("location.href='http://localhost/labFinal_perezDiana/files/sesionArtista.php'",200); 
                            });  
                        }             
                        break;
                
                
                    case "BAJA":
                        swal("Usuario eliminado con éxito", "", "success").then(function(){
                            setTimeout("location.href='http://localhost/labFinal_perezDiana/files/secciones/logoff.php'",200);
                        });
                        
                    break;
                    
                    case "ALTATARJETA":
                        if(data.error == "Duplicado"){
                            
                            artista.actualizarTarjeta();
                       
                        }
                        else{
                            swal("Tarjeta guardada con éxito","", "success").then(function(){
                               setTimeout("location.href='http://localhost/labFinal_perezDiana/files/indexArtista.php'",200); 
                            });  
                        }             
                        break;
                
                
                    case "BAJA":
                        swal("Usuario eliminado con éxito", "", "success").then(function(){
                            setTimeout("location.href='http://localhost/labFinal_perezDiana/files/secciones/logoff.php'",200);
                        });
                        
                    break;
                    
                    
                    case "MODIFICAR":
                        if(data.error == "Duplicado"){
                            swal("Datos duplicados", "Por favor revise los campos", "error");
                        }
                        else{
                            artista.actualizar();
                            //setTimeout(location.reload(),30000);
                        }
                       
                    break;
                    
                    case "ACTUALIZARTA":
                        if(data.error == "Duplicado"){
                            swal("Datos duplicados", "Por favor revise los campos", "error");
                        }
                        else{
                            artista.actualizar();
                            //setTimeout(location.reload(),30000);
                        }
                       
                    break;
                    
                    case "CAMBIARCLAVE":
                        if(data.error === "Duplicado"){
                            swal("La clave actual ingresada no es correcta", "", "error");
                        }
                        else{
                            artista.actualizar();
                            //setTimeout(location.reload(),30000);
                        }
                       
                    break;
                    
                    case "CARGAR":
                        if(data.error !== ""){
                            console.log("hay un error :(");
                        }
                        else{
                            
                            let artista = data.registros.nombre +' '+ data.registros.apellido;
                            let facebook = data.registros.facebook;
                            
                            $("#nombreBusqueda").val(artista);
                            $("#localidadBusqueda").val(data.registros.localidad);
                            $("#disciplinaBusqueda").val(data.registros.disciplina);
                            alert(artista.data.facebook_artista);
                            for(let registro of rec){
                            let descripcion = registro.presentacion_artista;
                            let facebook = registro.facebook_artista;
                        
                             $("#faceUsuario").val(facebook);
                            
                            
                            }
                            
                            
                            artista.data.descripcion = $("#descripcionUsuario").val();
                            artista.data.facebook = $("#faceUsuario").val(); 
                            artista.data.instagram = $("#instaUsuario").val(); 
                            artista.data.youtube = $("#ytUsuario").val(); 
                            
                            $("#faceUsuario").val(facebook);
                             $("#instaUsuario").val(data.registros.instagram);
                              $("#ytUsuario").val(data.registros.youtube);
                            
                            
                            document.getElementById("descripcionUsuario").innerHTML = (data.registros.presentacion_artista); 
                            document.getElementById("descripcionBusqueda").innerHTML = (data.registros.descripcion); 
                        }
                    break;
                    
                    //Buscar artista por nombre o apellido ... PODRIA IR A LA PAGINA DE RESULTADOS PARA NO APLICAR FILTROS
                        case "BUSCARARTISTA":
                        //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
                        $pagination.twbsPagination("destroy"); 
                        $pagination.remove();
                        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
                        $('#filtrosB').html('<div class="container" id="artistasBusqueda" style="margin-right: auto; margin-left: auto"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>'); 
                        
                        console.log("listarFiltros Case JS");
                        $("#busquedaEscondida").removeAttr("hidden");
                        $("#artistasListado").attr("hidden","");
                        if(data.registros.length == 0){
                            $("#artistasBusqueda").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }
                        
                        caso = "buscarArtista";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        artista.paginacion();
                        
                        break;
                    
                
                
                //****************************************
                
                
                //Filtros desde las opciones laterales
                        case "LISTARFILTROS":
                        //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
                        $pagination.twbsPagination("destroy"); 
                        $pagination.remove();
                        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
                        $('#filtros').html('<div class="container" id="artistasGeneral"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>'); 
                        
                        console.log("listarFiltros Case JS");
                        if(data.registros.length === 0){
                            $("#artistasGeneral").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }
                        
                        logueado = data.logueado;
                        caso = "filtros";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        artista.paginacion();
                        
                        break;
                        
                        
                            //Filtros desde las opciones laterales
                        case "LISTARFILTROSDISC":
                            //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
                        $pagination.twbsPagination("destroy"); 
                        $pagination.remove();
                        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
                        $('#filtros').html('<div class="container" id="tarjetaTipo"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>'); 
                        
                        console.log("listarFiltros CAT");
                        if(data.registros.length === 0){
                            $("#artistasGeneral").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }
                        
                        logueado = data.logueado;
                        caso = "filtrosDISC";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        artista.paginacion();
                        
                        break;
                        
                        
                            //Filtros desde las opciones laterales
                        case "LISTARFILTROSLOC":
                            //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
                        $pagination.twbsPagination("destroy"); 
                        $pagination.remove();
                        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
                        $('#filtros').html('<div class="container" id="tarjetaTipo"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>'); 
                        
                        console.log("listarFiltros Case JS");
                        if(data.registros.length == 0){
                            $("#artistasGeneral").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }
                        
                        logueado = data.logueado;
                        caso = "filtrosLOC";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        artista.paginacion();
                        
                        break;
                
                
                //*******************************        
                
                
                
                    case "LISTARUSU":
                        for(let registro of data.registros){
                            let descripcion = registro.descripcion_artista;                            
                            
                            if(descripcion !== ""){
                                totalRecords ++;
                            }
                        }

                        caso = "listar";
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        artista.paginacion();
                            //if(facebook !== "") 
                              //  $("#redes").append('');}
                        
                        break;
                                            
                        
                        
                        break;
                        
                        case "COMPLETAR":
                        if(data.error == "Duplicado"){
                            swal("Datos duplicados", "Por favor revise los campos", "error");
                        }
                        else{
                            artista.actualizar();
                            //setTimeout(location.reload(),30000);
                        }
                       
                    break;
                        
                        
                    default: break;
                }
               
                //artista.resetarAlta();
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error("Error: "+textStatus+"-"+errorThrown); 
            }).always(function(){});
    },
    
    //Funciones extra
    "confirmar": function(){
        swal({
        title: "¿Estas seguro?",
        text: "Si continuas no podras acceder a tus beneficios",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar Cuenta"],
        dangerMode: true
      })
      .then((willDelete) => {
        if (willDelete) {
          artista.baja();
        } else {
          swal("Tu cuenta esta a salvo");
        }
      });
      },
    
    // Botones de tarjeta de artista
    "habilitar": function(){
        $("#datosArtista").removeAttr("hidden");       
        $("#alertaTarjeta").attr("hidden","");
        $("#descripcionUsuario").removeAttr("disabled");
        $("#faceUsuario").removeAttr("disabled");
        $("#instaUsuario").removeAttr("disabled");
        $("#ytUsuario").removeAttr("disabled");
    },
    
    "cancelarTarjeta": function(){
        $("#descripcionUsuario").attr("disabled","");
        $("#faceUsuario").attr("disabled","");
        $("#instaUsuario").attr("disabled","");
        $("#ytUsuario").attr("disabled","");
        
         $("#btnCancelarTARJ").attr("hidden","");
        $("#btnAceptarTARJ").attr("hidden", "");
        $("#btnEditarTA").removeAttr("hidden");
    },
    
    "altaTarjeta": function(){   
        artista.data.idTarj = 0;
        artista.data.id = $("#idOculto").val();
        console.log($("#idOculto").val());
        artista.data.descripcion = $("#descripcionUsuario").val();
        artista.data.facebook = $("#faceUsuario").val();
        artista.data.instagram = $("#instaUsuario").val();
        artista.data.youtube = $("#ytUsuario").val();

        artista.data.accion = "ALTATARJETA";
        artista.abm(this.data);
    },
    
    // Formulario Datos 
    "editar": function(){
        $("#textNombre").removeAttr("disabled");
        $("#textApellido").removeAttr("disabled");
        $("#textMail").removeAttr("disabled");
        $("#btnAceptar").removeAttr("hidden");
        $("#btnCancelar").removeAttr("hidden");
        $("#btnModificar").attr("hidden","");
        $("#btnCambiar").attr("hidden","");
        $("#btnEliminar").attr("hidden",""); 
        $("#btnClave").attr("hidden","");
    },
    
    
    "editarTA": function(){
        $("#descripcionUsuario").removeAttr("disabled");
        $("#faceUsuario").removeAttr("disabled");
        $("#instaUsuario").removeAttr("disabled");
        $("#ytUsuario").removeAttr("disabled");
        
        $("#btnCancelarTARJ").removeAttr("hidden");
        $("#btnAceptarTARJ").removeAttr("hidden");
        $("#btnEditarTA").attr("hidden","");
    },
    
    
    "actualizar" : function(){
        artista.cancelar();
        swal("Datos Modificados", "", "success").then(function(){
        setTimeout(location.reload(),2000);});
    },
    
    
    
     "cancelar": function(){
        $("#textNombre").attr("disabled","");
        $("#textApellido").attr("disabled","");
        $("#textMail").attr("disabled","");
        $("#descripcionUsuario").attr("disabled","");
        $("#faceUsuario").attr("disabled","");
        $("#instaUsuario").attr("disabled","");
        $("#ytUsuario").attr("disabled","");
        $("#btnAceptar").attr("hidden","");
        $("#btnCancelar").attr("hidden","");
        $("#btnModificar").removeAttr("hidden");
        $("#btnCambiar").removeAttr("hidden");
        $("#btnEliminar").removeAttr("hidden");
        
        
    },
    //Cambio de clave
    "editarClave": function(){
        $("#editarClave1").removeAttr("hidden");
        $("#editarClave2").removeAttr("hidden");
        $("#editarClave3").removeAttr("hidden");
        $("#btnClaveNueva").removeAttr("hidden");
        $("#btnCancelarClave").removeAttr("hidden");
        $("#btnModificar").attr("hidden","");
        $("#btnCambiar").attr("hidden","");
        $("#btnEliminar").attr("hidden","");
        
    },
     
    "aceptarClave": function(){
        artista.cambiarClave();
        
    },
    
    "cancelarClave": function(){
        $("#btnClaveNueva").attr("hidden","");
        $("#btnCancelarClave").attr("hidden","");
        $("#btnModificar").removeAttr("hidden");
        $("#btnCambiar").removeAttr("hidden");
        $("#btnEliminar").removeAttr("hidden");
        $("#btnTarjeta").removeAttr("hidden");
        $("#editarClave1").attr("hidden","");
        $("#editarClave2").attr("hidden","");
        $("#editarClave3").attr("hidden","");
        
    },
    
    "paginacion": function() {
        $pagination = $("#paginas");
        $pagination.twbsPagination({
            totalPages: totalPages,
            hideOnlyOnePage:true,
            visiblePages: 6,
            first: 'Primera',
            prev: 'Anterior',
            next: 'Siguiente',
            last: 'Última',
            
            onPageClick: function (event, page) {
                  displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                  endRec = (displayRecordsIndex) + recPerPage;
                  displayRecords = records.slice(displayRecordsIndex, endRec);
                  
                  if(caso==="listar"){
                    console.log("ENTRO 1");
                    artista.listaru(displayRecords);
                }
                if(caso==="filtros"){
                    console.log("ENTRO F");
                    artista.listarF(displayRecords);
                }
                if(caso==="filtrosDISC"){
                    console.log("ENTRO D");
                    artista.listarFcat(displayRecords);
                }
                if(caso==="filtrosLOC"){
                    console.log("ENTRO C");
                    artista.listarFloc(displayRecords);
                }
                if(caso==="buscarArtista"){
                    console.log("ENTRO 2");
                    artista.buscar(displayRecords);
                }
                  
            }
      });
},

    "listaru":function(rec){
    $("#artistasGeneral").empty();
    for(let registro of rec){
                            let id =registro.id_artista;
                            let nombre = registro.nombre_artista;
                            let apellido = registro.apellido_artista;
                            let localidad = registro.localidad_artista;
                            let disciplina = registro.disciplina_artista;
                            let descripcion = registro.presentacion_artista;
                            let facebook = registro.facebook_artista;
                            let instagram = registro.instagram_artista;
                             let youtube = registro.youtube_artista;
                             let correo = registro.correo_artista;
                            
                            
                            if(descripcion !== ""){
                                $("#artistasGeneral").append('<div class="row cnt-block" id="paginacion"><div class="col-md-4" ><figure><img src="img/artist.jpg"></figure></div><div class="col-md-6" id="tarjetaArtista"><input type="text" hidden value="'+id+'"/><h2>'+nombre+' '+apellido+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+disciplina+'</span></h2><p>'+descripcion+'</p><span id="social"><ul><li><a id="facebook" href="'+facebook+'" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li><li><a id="instagram" href="'+instagram+'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><li><a id="youtube" href="'+youtube+'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li><li><a id="correo" href="mailto:'+correo+'" target="_blank"><i class="fas fa-envelope-open-text" aria-hidden="true"></i></a></li></ul></span></div></div>');
                            }
} 
},
"listarF":function(rec){
     $("#artistasGeneral").empty();
    for(let registro of rec){
                            let id =registro.id_artista;
                            let nombre = registro.nombre_artista;
                            let apellido = registro.apellido_artista;
                            let localidad = registro.localidad_artista;
                            let disciplina = registro.disciplina_artista;
                            let descripcion = registro.presentacion_artista;
                            let facebook = registro.facebook_artista;
                            let instagram = registro.instagram_artista;
                            let youtube = registro.youtube_artista;
                            let correo = registro.correo_artista;
                            
                            
                            if(descripcion !== ""){
                                $("#artistasGeneral").append('<div class="row cnt-block" id="paginacion"><div class="col-md-4" ><figure><img src="img/artist.jpg"></figure></div><div class="col-md-6" id="tarjetaArtista"><input type="text" hidden value="'+id+'"/><h2>'+nombre+' '+apellido+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+disciplina+'</span></h2><p>'+descripcion+'</p><span id="social"><ul><li><a id="facebook" href="'+facebook+'" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li><li><a id="instagram" href="'+instagram+'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><li><a id="youtube" href="'+youtube+'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li><li><a id="correo" href="mailto:'+correo+'" target="_blank"><i class="fas fa-envelope-open-text" aria-hidden="true"></i></a></li></ul></span></div></div>');
                            }
} 
},

"listarFcat":function(rec){
     $("#artistasGeneral").empty();
    for(let registro of rec){
                            let id =registro.id_artista;
                            let nombre = registro.nombre_artista;
                            let apellido = registro.apellido_artista;
                            let localidad = registro.localidad_artista;
                            let disciplina = registro.disciplina_artista;
                            let descripcion = registro.presentacion_artista;
                            let facebook = registro.facebook_artista;
                            let instagram = registro.instagram_artista;
                             let youtube = registro.youtube_artista;
                             let correo = registro.correo_artista;
                            
                            
                            if(descripcion !== ""){
                                $("#artistasGeneral").append('<div class="row cnt-block" id="paginacion"><div class="col-md-4" ><figure><img src="img/artist.jpg"></figure></div><div class="col-md-6" id="tarjetaArtista"><input type="text" hidden value="'+id+'"/><h2>'+nombre+' '+apellido+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+disciplina+'</span></h2><p>'+descripcion+'</p><span id="social"><ul><li><a id="facebook" href="'+facebook+'" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li><li><a id="instagram" href="'+instagram+'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><li><a id="youtube" href="'+youtube+'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li><li><a id="correo" href="mailto:'+correo+'" target="_blank"><i class="fas fa-envelope-open-text" aria-hidden="true"></i></a></li></ul></span></div></div>');
                            }
} 
},

"listarFloc":function(rec){
     $("#artistasGeneral").empty();
    for(let registro of rec){
                            let id =registro.id_artista;
                            let nombre = registro.nombre_artista;
                            let apellido = registro.apellido_artista;
                            let localidad = registro.localidad_artista;
                            let disciplina = registro.disciplina_artista;
                            let descripcion = registro.presentacion_artista;
                            let facebook = registro.facebook_artista;
                            let instagram = registro.instagram_artista;
                             let youtube = registro.youtube_artista;
                             let correo = registro.correo_artista;
                            
                            
                            if(descripcion !== ""){
                                $("#artistasGeneral").append('<div class="row cnt-block" id="paginacion"><div class="col-md-4" ><figure><img src="img/artist.jpg"></figure></div><div class="col-md-6" id="tarjetaArtista"><input type="text" hidden value="'+id+'"/><h2>'+nombre+' '+apellido+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+disciplina+'</span></h2><p>'+descripcion+'</p><span id="social"><ul><li><a id="facebook" href="'+facebook+'" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li><li><a id="instagram" href="'+instagram+'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><li><a id="youtube" href="'+youtube+'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li><li><a id="correo" href="mailto:'+correo+'" target="_blank"><i class="fas fa-envelope-open-text" aria-hidden="true"></i></a></li></ul></span></div></div>');
                            }
} 
},

"buscar":function(rec){
    console.log("Buscar Abajo");
    $("#artistasBusqueda").empty();
    console.log(rec);
    for(let registro of rec){
                            let id =registro.id_artista;
                            let nombre = registro.nombre_artista;
                            let apellido = registro.apellido_artista;
                            let localidad = registro.localidad_artista;
                            let disciplina = registro.disciplina_artista;
                            let descripcion = registro.presentacion_artista;
                            let facebook = registro.facebook_artista;
                            let instagram = registro.instagram_artista;
                             let youtube = registro.youtube_artista;
                            let correo = registro.correo_artista;
                            
                            if(descripcion !== ""){
                                console.log("entre if");
                                $("#artistasBusqueda").append('<div class="row cnt-block" id="paginacion"><div class="col-md-4" ><figure><img src="img/artist.jpg"></figure></div><div class="col-md-6" id="tarjetaArtista"><input type="text" hidden value="'+id+'"/><h2>'+nombre+' '+apellido+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+disciplina+'</span></h2><p>'+descripcion+'</p><span id="social"><ul><li><a id="facebook" href="'+facebook+'" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li><li><a id="instagram" href="'+instagram+'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><li><a id="youtube" href="'+youtube+'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li><li><a id="correo" href="mailto:'+correo+'" target="_blank"><i class="fas fa-envelope-open-text" aria-hidden="true"></i></a></li></ul></span></div></div>');
                            }
} 
},


};
 
 
 
 
 
 
let sugestivo = {
    "parametros":{"contenedor":"divSugestivo", "inputText":"textSugestivo", "lista":"ulSugestivo", "actualizar": false, "buscar": false},
    "activar":function(){
        console.log("#"+sugestivo.parametros.inputText);
        $("#"+sugestivo.parametros.inputText).keydown(function(e){
            //identifico la tecla que se presiono y me aseguro que funciones para todos los navegadores
            let cod = e.which;
            console.log(e);
            if (cod === null) cod = e.keyCode;
            if(cod === 27) $("#"+sugestivo.parametros.lista).remove();
            if(cod === 8) sugestivo.parametros.actualizar = true;
        });
        
        $("#"+sugestivo.parametros.inputText).keypress(function(e){
            let cod = e.which;
            if (cod === null) cod = e.keyCode;
            if((cod >= 97 && cod <=122) || (cod >=65 && cod<=90) || (cod >=48 && cod<=57) || (cod === 32) || (cod === 46)){
                sugestivo.parametros.buscar = true;
                
                return true;
            }
            if(sugestivo.parametros.actualizar) {return true;}
            else{
                sugestivo.parametros.buscar = false;
                return false;
            }
        });
        
        $("#"+sugestivo.parametros.inputText).keyup(function(e){
           if(sugestivo.parametros.buscar || sugestivo.parametros.actualizar){
              if(($("#"+sugestivo.parametros.inputText).val().length) > 0) sugestivo.buscar(); 
              else $("#"+sugestivo.parametros.lista).remove();
           } 
           sugestivo.parametros.actualizar = sugestivo.parametros.buscar = false;
        });
    },
    
    "buscar":function(){
        
        console.log("MMLPQTP");
        artista.filtros.accion = "LISTARUSU";
        artista.filtros.indice = 0;
        artista.filtros.cantidad = 10;
        artista.filtros.clave = $("#"+sugestivo.parametros.inputText).val();
        
        $.ajax(
            {
            "url": artista.parametros.url,
            "method":"POST",
            "dataType":"JSON",
            "accept":"JSON",
            "data":{"data":JSON.stringify(artista.filtros)}
            
        }).done(function(data,textStatus){
            $("#"+sugestivo.parametros.lista).remove();
            if(data.registros.length > 0){
                var nombre = data.registros.id_artista;
                console.log(nombre);
                $("#"+sugestivo.parametros.contenedor).prepend('<ul id="'+sugestivo.parametros.lista+'" class+"list-group text-left" style="position:absolute; z-index: 100; margin-top:36px; margin-left:30px;">');
                for(let registros of data.registros){
                    $("#"+sugestivo.parametros.lista).append('<a href="files/artistaBusqueda.php?id='+registros.id_artista+'"><li class="list-group-item" style="line-height;1.8em;">'+ registros.nombre_artista +' '+ registros.apellido_artista +'</li></a>');
                }
            }
            
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error("Error: "+textStatus+" - "+errorThrown);
        }).always(function(){});
    }
};



// Efecto de los filtros
$(document).ready(function () {
    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target !== 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

 });

 
$().ready(function(){
    artista.listarusu();
    //sugestivo.activar();
    
    let id2 = document.getElementById("idOculto");
    console.log(document.getElementById("idOculto"));
    if(id2 !== null){
        
        id2 = parseInt(id2.value);
        artista.cargar(id2);
    }
    
    
    let id = document.getElementById("idArtista");
    if(id !== null){
        alert("no es nulo");
        id = parseInt(id.value);
        artista.cargar(id);
    }
});

$(document).ready(function() {
    $('.checkbox1 input[type=checkbox]').on('click', function(){
        $('#loc li label input[type=checkbox]').prop('checked',false);
        $(this).prop('checked', true);
        $("#btnFiltros").removeAttr("disabled");
    });
    $('input[type=checkbox]').on('click', function(){
        $('#disc li label input[type=checkbox]').prop('checked',false);
        $(this).prop('checked', true);
                $("#btnFiltros").removeAttr("disabled");

    });
});
