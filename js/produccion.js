var totalRecords = 0,
recPerPage = 5,
page = 1,
totalPages = 0,
records = [];


let produccion = {
    // Variables
    "data" : {"id":0, "artista":"", "tipo":"", "categoria":"", "nombre":"", "descripcion":"",
        "localidad":"", "direccion":"", "fecha":"", "hora":"", "precio":"", "cupo":"", "asistentes":"", "estado":"","accion":""},
    "filtros" : {"accion":"", "orden": "", "indice": 0, "cantidad":0, "clave":"", "clave2":"", "clave3":""},
    "parametros": {"url":"files/controladores/produccionControlador.php"},
    
    // Funciones $id, $usuario, $tipo, $categoria, $nombre, $descripcion, $localidad, $direccion, $fecha, $hora, $precio;
    "alta": function(){
        produccion.data.id = 0;
        produccion.data.artista = $("#usuarioOculto").val();
        produccion.data.tipo = $("#tipoOculto").val();
        produccion.data.categoria = $("#categoriaProduccion").val();
        produccion.data.nombre = $("#nombreProduccion").val();
        produccion.data.descripcion = $("#descripcionProduccion").val();
        produccion.data.direccion = $("#direccionProduccion").val();
        produccion.data.localidad = $("#localidadProduccion").val();
        produccion.data.fecha = $("#fechaProduccion").val();
        produccion.data.hora = $("#horaProduccion").val();
        produccion.data.precio = $("#precioProduccion").val();
        produccion.data.cupo = $("#cupoProduccion").val();
        
        
        produccion.data.accion = "ALTA";
        produccion.abm(this.data);
    },
    
    "modificar": function(){ //FALTA
        produccion.data.id = $("#idOculto").val();
        produccion.data.nombre = $("#textNombre").val();
        produccion.data.apellido = $("#textApellido").val(); 
        produccion.data.correo = $("#textMail").val(); 
        
        produccion.data.accion = "MODIFICAR";
        produccion.abm(this.data);
    },
    
    "baja": function(){
        produccion.data.id = $("#idProduccion").val();        
        
        produccion.data.accion = "BAJA";
        produccion.abm(this.data);
        
    },
    
    "listar": function(){
        produccion.filtros.accion = "LISTAR";
        produccion.filtros.indice = 0;
        produccion.filtros.cantidad = 20;
        produccion.filtros.clave = $("#filtro").val();
        produccion.abm(this.filtros);
    },
    
    //Lista de acuerdo a si la produccion es de tipo actividad o de tipo espectáculo
    "listartipo": function(){
        produccion.filtros.accion = "LISTARTIPO";
        produccion.filtros.indice = 0;
        produccion.filtros.cantidad = 20;
        produccion.filtros.clave = $("#filtre").val();
        produccion.abm(this.filtros);
    },
    
    "listartabla": function(){
        produccion.filtros.accion = "LISTARTABLA";
        produccion.filtros.indice = 0;
        produccion.filtros.cantidad = 20;
        produccion.filtros.clave = $("#idOculto").val();
        produccion.abm(this.filtros);
    },
    
    "listartab_usuario":function(){
        produccion.filtros.accion = "LISTARTAB_USUARIO";
        produccion.filtros.indice = 0;
        produccion.filtros.cantidad = 20;
        produccion.filtros.clave = $("#idOculto").val();
        produccion.abm(this.filtros);
    },
    //Filtros para los espectaculos
    "listarFiltros": function(){
         $('#pagination').empty();
         $('#pagination').removeData("twbs-pagination");
         $('#pagination').unbind("page");
        console.log("listarFiltros Funciones JS");
        
        produccion.filtros.indice = 0;
        produccion.filtros.cantidad = 20;
        produccion.filtros.clave = $("#filtre").val();
        produccion.filtros.clave2 =$('input:checkbox[name=loc]:checked').val();
        produccion.filtros.clave3 = $('input:checkbox[name=cat]:checked').val();
        
        
        if(produccion.filtros.clave2===undefined){
            produccion.filtros.accion = "LISTARFILTROSCAT";
        }else if(produccion.filtros.clave3===undefined){
            produccion.filtros.accion = "LISTARFILTROSLOC";
        }else{
           produccion.filtros.accion = "LISTARFILTROS"; 
        }             
        
        produccion.abm(this.filtros);
    },
    
    
   
    
    "quitarFiltros":function(){
        console.log("quitando filtros..."); 
        $('#loc li label input[type=checkbox]').prop('checked',false);
        $('#cat li label input[type=checkbox]').prop('checked',false);
        //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
        $pagination.twbsPagination("destroy"); 
        $pagination.remove();
        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
        $('#filtros').html('<div class="container" id="tarjetaTipo"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>');
                      
        produccion.listartipo();
        //setTimeout("location.reload()", 100);
    },
    
     "cargar": function(id){
        produccion.abm({"id":id,"accion":"CARGAR"});
    },
    
    "abm": function(datojson){
        $.ajax(
                {"url":produccion.parametros.url,
                "method":"post",
                "dataType":"json",
                "accept":"json",
                "data":{"data":JSON.stringify(datojson)}
            }).done(function(data,textStatus){
                
                switch(data.accion){
                    case "ALTA":
                        if(data.error === "Duplicado"){
                          swal("Datos duplicados", "Por favor intente de nuevo", "error");
                          
                        }
                        else{
                            swal("¡Guardado con éxito!", "", "success").then(function(){
                                setTimeout("location.href='http://localhost/labFinal_perezDiana/files/produccionesArtista.php'",2000);
                            });
                            
                        }             
                        break;
                
                
                    case "BAJA":
                        swal("Usuario eliminado con éxito", "", "success").then(function(){
                        setTimeout("location.href='http://localhost/labFinal_perezDiana/logoff.php'",2000);
                    });
                    break;
                    
                    
                    case "MODIFICAR":
                        if(data.error == "Duplicado"){
                            $("#idalerta").removeAttr("hidden");
                            $("#idalerta").removeAttr("class");
                            $("#idalerta").attr("class","alert alert-danger alert-dismissible col-6");
                            $("#idalerta").html("<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span></button><small>Datos duplicados: Revise nombre de produccion o correo eletronico</small>");
                        }
                        else{
                            console.log(produccion.data.id);
                            $("#mensajeEdit").removeAttr("hidden");
                            $("#idalerta").removeAttr("class");
                            $("#idalerta").attr("class","alert alert-success alert-dismissible col-6");
                            $("#idalerta").html("<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span></button><small>¡Datos modificados correctamente!</small>");
                            
                            produccion.cancelar();
                        }
                       
                    break;
                    
                    
                    
                    case "CARGAR":
                        if(data.error != ""){
                            console.log("hay un error :(");
                        }
                        else{
                            $("#tituloInscr").val(data.registros.nombre);
                            $("#categoriaInscr").val(data.registros.categoria);
                            $("#lugarInscr").val(data.registros.direccion);
                            $("#localidadInscr").val(data.registros.localidad); 
                            $("#fechaInscr").val(data.registros.fecha);
                            $("#horaInscr").val(data.registros.hora); 
                            $("#precioInscr").val(data.registros.precio);
                            
                            
                        }
                    break;
                    
                    
                
                    case "LISTAR":
                        if(data.registros.length == 0){
                            $("#tarjetaLocalidad").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados para esta localidad.</ul></div>');
                            
                        }
                            
                        logueado = data.logueado;
                        caso = "listar";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        produccion.paginacion();
                        
                        
                        break;
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        //Filtros desde las opciones laterales
                        case "LISTARFILTROS":
                            //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
                        $pagination.twbsPagination("destroy"); 
                        $pagination.remove();
                        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
                        $('#filtros').html('<div class="container" id="tarjetaTipo"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>'); 
                        
                        console.log("listarFiltros Case JS");
                        if(data.registros.length == 0){
                            $("#tarjetaTipo").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }
                        
                        logueado = data.logueado;
                        caso = "filtros";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        produccion.paginacion();
                        
                        break;
                        
                        
                            //Filtros desde las opciones laterales
                        case "LISTARFILTROSCAT":
                            //Destruye la paginacion anterior para cargar una nueva sin recargar la pagina
                        $pagination.twbsPagination("destroy"); 
                        $pagination.remove();
                        //Vuelve a crear los elementos que se destruyeron dentro de el contenedor de la paginacion
                        $('#filtros').html('<div class="container" id="tarjetaTipo"></div><div class="row bloque col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"></ul></div>'); 
                        
                        console.log("listarFiltros CAT");
                        if(data.registros.length == 0){
                            $("#tarjetaTipo").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }
                        
                        logueado = data.logueado;
                        caso = "filtrosCAT";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        produccion.paginacion();
                        
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
                            $("#tarjetaTipo").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }
                        
                        logueado = data.logueado;
                        caso = "filtrosLOC";
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        produccion.paginacion();
                        
                        break;
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        case "LISTARTIPO":
                        if(data.registros.length === 0){
                            $("#tarjetaTipo").append('<div class="row bloqueNoReg col-md-12" id="paginas"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. Parece que no hay resultados.</ul></div>');
                            
                        }    
                        caso = "listarT";
                        logueado = data.logueado;   
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        produccion.paginacion();
                        
                    
                        break;
                        
                        case "LISTARTABLA":
                        if(data.registros.length === 0){
                            $("#tablaMisProdus").append('<div class="row bloqueNoReg col-md-12" id="paginas" style="width:80%;margin:-85px auto 0; height:150px"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. No tenes registradas actividades o espectáculos. </ul></div>');   
                        } 
                        
                        caso = "tabla";
                        console.log(caso);
                        logueado = data.logueado;   
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        produccion.paginacion();
                        
                    
                        break;
                        
                        
                        
                    default: break;
                }
               
                //produccion.resetarAlta();
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error("Error: "+textStatus+"-"+errorThrown); 
            }).always(function(){
                //independiemente si entra a done o fal se va a ejecutar (normalmente resetear
            });
    },

"paginacion": function() {
        $pagination = $("#paginas");
        console.log(caso +" arriba");
        console.log($pagination);
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
                
                console.log(caso + " 2");
                
                if(caso==="listar"){
                    console.log("ENTRO 1");
                    produccion.listarL(displayRecords);
                }
                if(caso==="filtros"){
                    console.log("ENTRO F");
                    produccion.listarF(displayRecords);
                }
                if(caso==="filtrosCAT"){
                    console.log("ENTRO F");
                    produccion.listarFcat(displayRecords);
                }
                if(caso==="filtrosLOC"){
                    console.log("ENTRO F");
                    produccion.listarFloc(displayRecords);
                }
                if(caso==="listarT"){
                    console.log("ENTRO 2");
                    produccion.listarT(displayRecords);
                }
                if(caso==="tabla"){
                    console.log("ENTRO");
                    produccion.listartab(displayRecords);
                }
                
            }
      });
},

"listarT":function(rec){
    $("#tarjetaTipo").empty();
    
    for(let registroTipo of rec){
        let categoria = registroTipo.categoria_produccion;  
        let nombre = registroTipo.nombre_produccion;
        let nombreA = registroTipo.nombre_artista; 
        let apellido = registroTipo.apellido_artista;
        let descripcion = registroTipo.descripcion_produccion;
        let localidad = registroTipo.localidad_produccion;
        let direccion = registroTipo.direccion_produccion;
        let fecha = registroTipo.fecha_produccion;
        let hora = registroTipo.hora_produccion;
        let precio = registroTipo.precio_produccion;
        let tipo = registroTipo.tipo_produccion;
        let asistentes = registroTipo.asistentes_produccion;
        let cupo = registroTipo.cupo_produccion;
                            
        $("#tarjetaTipo").append('<div class="row cnt-block"><div class="col-md-4" ><figure><img src="img/espectaculoGral.jpg"></figure><h6 style="color: #006699">Organiza: '+nombreA+' '+apellido+'</h6></div> <div class="col-md-8" id="tarjetaActividad"> <h2> '+nombre+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+categoria+'</span></h2><p>'+descripcion+'</p><ul class="list-group d-inline-block"><li class="list-group-item"> <strong> Lugar: </strong>'+direccion+'</li><li class="list-group-item"> <strong> Fecha: </strong>'+fecha+'</li><li class="list-group-item"><strong> Hora: </strong>'+hora+'</li></ul> <br><small> <strong>Precio: </strong>$ '+precio+'</small><br><div id="padre'+registroTipo.id_produccion+'"></div></div></div>');
        
        if(cupo===asistentes){
            $("#padre"+registroTipo.id_produccion).append('<p style="font-weight:bolder;color:red;font-size:1.2em"> SIN CUPO </p>');
        }
        else{
            if(logueado===1 && tipo==="actividad") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/inscripcionActividad.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Inscribirse  </button>');}
            else if(logueado===1 && tipo==="espectaculo") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/compraEntrada.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Comprar Entrada  </button>');}

            if(logueado===0 && tipo==="actividad"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Inscribirse  </button>');}
            else if(logueado===0 && tipo==="espectaculo"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Comprar Entrada </button>');}
        }
    }
},

"listarF":function(rec){
    console.log("Listar F Abajo");
    $("#tarjetaTipo").empty();
    
    for(let registroTipo of rec){
        let categoria = registroTipo.categoria_produccion;  
        let nombre = registroTipo.nombre_produccion;
        let nombreA = registroTipo.nombre_artista; 
        let apellido = registroTipo.apellido_artista;
        let descripcion = registroTipo.descripcion_produccion;
        let localidad = registroTipo.localidad_produccion;
        let direccion = registroTipo.direccion_produccion;
        let fecha = registroTipo.fecha_produccion;
        let hora = registroTipo.hora_produccion;
        let precio = registroTipo.precio_produccion;
        let tipo = registroTipo.tipo_produccion;
        let asistentes = registroTipo.asistentes_produccion;
        let cupo = registroTipo.cupo_produccion;
                            
        $("#tarjetaTipo").append('<div class="row cnt-block"><div class="col-md-4" ><figure><img src="img/espectaculoGral.jpg"></figure><h6 style="color: #006699">Organiza: '+nombreA+' '+apellido+'</h6></div> <div class="col-md-8" id="tarjetaActividad"> <h2> '+nombre+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+categoria+'</span></h2><p>'+descripcion+'</p><ul class="list-group d-inline-block"><li class="list-group-item"> <strong> Lugar: </strong>'+direccion+'</li><li class="list-group-item"> <strong> Fecha: </strong>'+fecha+'</li><li class="list-group-item"><strong> Hora: </strong>'+hora+'</li></ul> <br><small> <strong>Precio: </strong>$ '+precio+'</small><br><div id="padre'+registroTipo.id_produccion+'"></div></div></div>');
        
        if(cupo===asistentes){
            $("#padre"+registroTipo.id_produccion).append('<p style="font-weight:bolder;color:red;font-size:1.2em"> SIN CUPO </p>');
        }
        else{
            if(logueado===1 && tipo==="actividad") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/inscripcionActividad.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Inscribirse  </button>');}
            else if(logueado===1 && tipo==="espectaculo") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/compraEntrada.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Comprar Entrada  </button>');}

            if(logueado===0 && tipo==="actividad"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Inscribirse  </button>');}
            else if(logueado===0 && tipo==="espectaculo"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Comprar Entrada </button>');}
        }
    }
},

"listarFcat":function(rec){
    console.log("Listar F cat Abajo");
    $("#tarjetaTipo").empty();
    
    for(let registroTipo of rec){
        let categoria = registroTipo.categoria_produccion;  
        let nombre = registroTipo.nombre_produccion;
        let nombreA = registroTipo.nombre_artista; 
        let apellido = registroTipo.apellido_artista;
        let descripcion = registroTipo.descripcion_produccion;
        let localidad = registroTipo.localidad_produccion;
        let direccion = registroTipo.direccion_produccion;
        let fecha = registroTipo.fecha_produccion;
        let hora = registroTipo.hora_produccion;
        let precio = registroTipo.precio_produccion;
        let tipo = registroTipo.tipo_produccion;
        let asistentes = registroTipo.asistentes_produccion;
        let cupo = registroTipo.cupo_produccion;
                            
        $("#tarjetaTipo").append('<div class="row cnt-block"><div class="col-md-4" ><figure><img src="img/espectaculoGral.jpg"></figure><h6 style="color: #006699">Organiza: '+nombreA+' '+apellido+'</h6></div> <div class="col-md-8" id="tarjetaActividad"> <h2> '+nombre+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+categoria+'</span></h2><p>'+descripcion+'</p><ul class="list-group d-inline-block"><li class="list-group-item"> <strong> Lugar: </strong>'+direccion+'</li><li class="list-group-item"> <strong> Fecha: </strong>'+fecha+'</li><li class="list-group-item"><strong> Hora: </strong>'+hora+'</li></ul> <br><small> <strong>Precio: </strong>$ '+precio+'</small><br><div id="padre'+registroTipo.id_produccion+'"></div></div></div>');
        
        if(cupo===asistentes){
            $("#padre"+registroTipo.id_produccion).append('<p style="font-weight:bolder;color:red;font-size:1.2em"> SIN CUPO </p>');
        }
        else{
            if(logueado===1 && tipo==="actividad") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/inscripcionActividad.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Inscribirse </button>');}
            else if(logueado===1 && tipo==="espectaculo") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/compraEntrada.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Comprar Entrada  </button>');}

            if(logueado===0 && tipo==="actividad"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Inscribirse </button>');}
            else if(logueado===0 && tipo==="espectaculo"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Comprar Entrada </button>');}
        }
    }
},

"listarFloc":function(rec){
    console.log("Listar F loc Abajo");
    $("#tarjetaTipo").empty();
    
    for(let registroTipo of rec){
        let categoria = registroTipo.categoria_produccion;  
        let nombre = registroTipo.nombre_produccion;
        let nombreA = registroTipo.nombre_artista; 
        let apellido = registroTipo.apellido_artista;
        let descripcion = registroTipo.descripcion_produccion;
        let localidad = registroTipo.localidad_produccion;
        let direccion = registroTipo.direccion_produccion;
        let fecha = registroTipo.fecha_produccion;
        let hora = registroTipo.hora_produccion;
        let precio = registroTipo.precio_produccion;
        let tipo = registroTipo.tipo_produccion;
        let asistentes = registroTipo.asistentes_produccion;
        let cupo = registroTipo.cupo_produccion;
                            
        $("#tarjetaTipo").append('<div class="row cnt-block"><div class="col-md-4" ><figure><img src="img/espectaculoGral.jpg"></figure><h6 style="color: #006699">Organiza: '+nombreA+' '+apellido+'</h6></div> <div class="col-md-8" id="tarjetaActividad"> <h2> '+nombre+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+categoria+'</span></h2><p>'+descripcion+'</p><ul class="list-group d-inline-block"><li class="list-group-item"> <strong> Lugar: </strong>'+direccion+'</li><li class="list-group-item"> <strong> Fecha: </strong>'+fecha+'</li><li class="list-group-item"><strong> Hora: </strong>'+hora+'</li></ul> <br><small> <strong>Precio: </strong>$ '+precio+'</small><br><div id="padre'+registroTipo.id_produccion+'"></div></div></div>');
        
        if(cupo===asistentes){
            $("#padre"+registroTipo.id_produccion).append('<p style="font-weight:bolder;color:red;font-size:1.2em"> SIN CUPO </p>');
        }
        else{
            if(logueado===1 && tipo==="actividad") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/inscripcionActividad.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Inscribirse  </button>');}
            else if(logueado===1 && tipo==="espectaculo") {$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="location.href = '+"'files/compraEntrada.php?id="+registroTipo.id_produccion+"'"+'" class="btn btn-warning btn-lg"> Comprar Entrada  </button>');}

            if(logueado===0 && tipo==="actividad"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Inscribirse  </button>');}
            else if(logueado===0 && tipo==="espectaculo"){$("#padre"+registroTipo.id_produccion).append('<button type="button" onclick="" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#loginModal"> Comprar Entrada </button>');}
        }
    }
},




//---------------------------------------
"listarL":function(rec){
    $("#tarjetaLocalidad").empty();
    
    for(let registro of rec){
        let categoria = registro.categoria_produccion;  
        let nombre = registro.nombre_produccion;
        let nombreA = registro.nombre_artista; 
        let apellido = registro.apellido_artista;
        let descripcion = registro.descripcion_produccion;
        let localidad = registro.localidad_produccion;
        let direccion = registro.direccion_produccion;
        let fecha = registro.fecha_produccion;
        let hora = registro.hora_produccion;
        let precio = registro.precio_produccion;
                            
        $("#tarjetaLocalidad").append('<div class="row cnt-block"><div class="col-md-4" ><figure><img src="img/espectaculoGral.jpg"></figure><h6 style="color: #006699">Organiza: '+nombreA+' '+apellido+'</h6></div> <div class="col-md-8" id="tarjetaActividad"> <h2> '+nombre+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+categoria+'</span></h2><p>'+descripcion+'</p><ul class="list-group d-inline-block"><li class="list-group-item"> <strong> Lugar: </strong>'+direccion+'</li><li class="list-group-item"> <strong> Fecha: </strong>'+fecha+'</li><li class="list-group-item"><strong> Hora: </strong>'+hora+' hs </li></ul> <br><small> <strong>Precio: </strong>$ '+precio+'</small><br><button type="button" class="btn btn-warning btn-lg"> Comprar Entrada </button></div></div>');
        
         if(logueado===1) {$("#padre"+registro.id_curso).append('<button type="button" onclick="location.href = '+"'files/reservaCurso.php?id="+registro.id_curso+"'"+'" class="btn btn-outline-info" style="padding:10px; width: 90%" > Inscribite </button> ');}
        else {$("#padre"+registro.id_curso).append('<button type="button" onclick="" class="btn btn-outline-info" style="padding:10px; width: 90%" data-toggle="modal" data-target="#loginModal"> Inscribirse </button>');}
                            
        }
},

"listartab":function(rec){
    $("#tablaEspectaculo").empty();
    //console.log("entro listartab");
    
    for(let registroTab of rec){
        let id = registroTab.id_produccion;
        let categoria = registroTab.categoria_produccion; 
        let tipo = registroTab.tipo_produccion;
        let nombre = registroTab.nombre_produccion;
        let fecha = registroTab.fecha_produccion;
        let asistentes = registroTab.asistentes_produccion;
                            
        $("#tablaEspectaculo").append('<tr><td class="col-4"><div class="actividad-info"><div class="info-body"><h4 class="info-title"> '+nombre+'</h4></div></div></td><td class="col-2"><span class="media-meta">'+tipo+'</span></td><td class="col-2"><span class="media-meta">'+fecha+'</span></td><td class="col-2"><span class="media-meta"> '+asistentes+' </span></td><td class="d-inline-block" >  <button style="margin-left: auto;margin-right:auto"type="button" class="btn-default btn-circle" onclick="location.href=' +"'"+  'files/listadoAsistentes.php?id='+id+'   '+"'"+ '"><i class="far fa-list-alt"></i></button><button hidden style="margin-left:10px" type="button" class="btn-success btn-circle"><i class="fas fa-edit"></i></button><button hidden type="button" class="btn-danger btn-circle"><i class="fas fa-times"></i> </button></td></tr>');
                            
        }
}

};       

$(document).ready(function(){
    /*sugestivo.activar();
    let idUsuario = document.getElementById("idUser");
    if(idUsuario !== null){
        idUsuario = parseInt(idUsuario.value);
        usuario.cargar(idUsuario);
    }*/
    produccion.listar();
    produccion.listartipo();
    produccion.listartabla();
    
    
});

$(document).ready(function(){
    $('#horaProduccion').timepicker({
        timeFormat: 'hh:mm p',
        interval: 30,
        minTime: '00',
        maxTime: '11:00pm',
        defaultTime: '00',
        startTime: '00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});

$(function(){
    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $("#fechaProduccion").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        maxDate: "+5M"
    });
});


$(document).ready(function(){
    let id = document.getElementById("inscrOculto");
    if(id !== null){
        id = parseInt(id.value);
        produccion.cargar(id);
    }
});

$(document).ready(function() {
    $('.checkbox1 input[type=checkbox]').on('click', function(){
        $('#loc li label input[type=checkbox]').prop('checked',false);
        $(this).prop('checked', true);
        $("#btnFiltros").removeAttr("disabled");
    });
    $('input[type=checkbox]').on('click', function(){
        $('#cat li label input[type=checkbox]').prop('checked',false);
        $(this).prop('checked', true);
                $("#btnFiltros").removeAttr("disabled");

    });
});