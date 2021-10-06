var totalRecords = 0,
recPerPage = 5,
page = 1,
totalPages = 0,
records = [];


let comprobante = {
    // Variables
    "data" : {"id":0, "produccion":"", "usuario":"", "tipo":"", "categoria":"", "nombre":"", "descripcion":"",
        "localidad":"", "direccion":"", "fecha":"", "hora":"", "precio":"", "accion":""},
    "filtros" : {"accion":"", "orden": "", "indice": 0, "cantidad":0, "clave":"","clave2":"","clave3":""},
    "parametros": {"url":"files/controladores/comprobanteControlador.php"},
    
    //Validaciones
    
       
    
    // Funciones $id, $usuario, $tipo, $categoria, $nombre, $descripcion, $localidad, $direccion, $fecha, $hora, $precio;
    "alta": function(){
        comprobante.data.id = 0;
        comprobante.data.produccion = $("#inscrOculto").val();
        comprobante.data.usuario = $("#idOculto").val();       
        
        comprobante.data.accion = "ALTA";
        comprobante.abm(this.data);
    },
    
    "modificar": function(){
        comprobante.data.id = $("#idOculto").val();
        comprobante.data.nombre = $("#textNombre").val();
        comprobante.data.apellido = $("#textApellido").val(); 
        comprobante.data.correo = $("#textMail").val(); 
        
        comprobante.data.accion = "MODIFICAR";
        comprobante.abm(this.data);
    },
    
    "baja": function(){
        comprobante.data.id = $("#idProduccion").val();        
        
        comprobante.data.accion = "BAJA";
        comprobante.abm(this.data);
        
    },
    
    "tablausu": function(){
        comprobante.filtros.accion = "TABLAUSU";
        comprobante.filtros.indice = 0;
        comprobante.filtros.cantidad = 20;
        comprobante.filtros.clave = $("#idProd").val();
        comprobante.abm(this.filtros);
    },
    
    "listartablausu": function(){
        comprobante.filtros.accion = "LISTARTABLAUSU";
        comprobante.filtros.indice = 0;
        comprobante.filtros.cantidad = 20;
        comprobante.filtros.clave = $("#idOculto").val();
        comprobante.abm(this.filtros);
    },
    
    //Lista las ventas hechas entre dos fechas dadas, solamente los datos de la base
    "listarVentas": function(){
        comprobante.filtros.accion = "LISTARVENTAS";
        comprobante.filtros.indice = 0;
        comprobante.filtros.cantidad = 20;
        comprobante.filtros.clave = $("#fecha1").val();
        comprobante.filtros.clave2 = $("#fecha2").val();
        comprobante.filtros.clave3=$("#idConsulta").val();
        comprobante.abm(this.filtros);
    },
    
        
    "cargar": function(id){
        comprobante.abm({"id":id,"accion":"CARGAR"});
    },  
    
    "abm": function(datojson){
        $.ajax(
                {"url":comprobante.parametros.url,
                "method":"post",
                "dataType":"json",
                "accept":"json",
                "data":{"data":JSON.stringify(datojson)}
            }).done(function(data,textStatus){
                
                switch(data.accion){
                    case "ALTA":
                        if(data.error == "Duplicado"){
                          swal("Duplicado", "Ya tienes un comprobante para este evento", "error");
                          
                        }
                        else{
                            swal("¡Inscripción exitosa!", "Puedes revisarla en tus actividades", "success").then(function(){
                                setTimeout("location.href='http://localhost/labFinal_perezDiana/files/comprobantesUsuario.php'",200);
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
                            $("#idalerta").html("<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span></button><small>Datos duplicados: Revise nombre de comprobante o correo eletronico</small>");
                        }
                        else{
                            console.log(comprobante.data.id);
                            $("#mensajeEdit").removeAttr("hidden");
                            $("#idalerta").removeAttr("class");
                            $("#idalerta").attr("class","alert alert-success alert-dismissible col-6");
                            $("#idalerta").html("<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span></button><small>¡Datos modificados correctamente!</small>");
                            
                            comprobante.cancelar();
                        }
                       
                    break;
                    
                    case "TABLAUSU":
                        for(let registro of data.registros){
                            let nombre = registro.nombre_usuario;
                            let apellido = registro.apellido_usuario;
                            let dni = registro.dni_usuario;
                            let correo = registro.correo_usuario;
                            
                            $("#tablaListado").append('<tr><td class="col-3"><div class="columnaLista"><h4 class="contenidoLista"> '+nombre+'</h4></div></td>   <td class="col-3"><div class="columnaLista"><h4 class="contenidoLista"> '+apellido+'</h4></div></td>    <td class="col-2"><div class="columnaLista"><h4 class="contenidoLista"> '+dni+'</h4></div></td>     <td class="col-4"><div class="columnaLista"><h4 class="contenidoLista"> '+correo+'</h4></div></td></tr>');
                        }
                        
                        break;
                        
                    case "LISTARTABLAUSU":
                        if(data.registros.length === 0){
                            $("#cabeceraComprobantes").attr("hidden","");
                            $("#tablaActividades").append('<div class="row bloqueNoReg col-md-12" id="paginas" style="width:80%; margin:auto; height:150px"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. No tenes registrados comprobantes de actividades o espectáculos. </ul></div>');   
                        } 
                        
                        caso = "tabla";
                        console.log("1");
                        logueado = data.logueado;   
                        totalRecords = data.registros.length;
                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        comprobante.paginacion();
                        
                    
                        break;   
                        
                        //Lista las ventas realizadas entre dos fechas dadas
                        case "LISTARVENTAS":
                        if(data.registros.length === 0){
                            $("#paginas").attr("hidden","");
                            $("#tablaEspectaculo").empty();
                            $("#cabeceraComprobantes").attr("hidden","");
                            $("#tablaEspectaculo").append('<div class="row bloqueNoReg col-md-12" id="paginas" style="width:80%; margin:auto; height:150px"><ul id="paginacion" class="pagination-lg"><i><img  src="img/icono-pin.png"></i>Lo sentimos. No tenes registradas ventas en este periodo. </ul></div>');   
                            $("#cabeceraComprobantes").attr("hidden","");
                            
                            
                        } 
                        else{
                            $("#paginas").removeAttr("hidden");
                            caso = "ventas";
                            console.log("2");
                            logueado = data.logueado;   
                            totalRecords = data.registros.length;
                            totalPages = Math.ceil(totalRecords / recPerPage);
                            records = data.registros;
                            comprobante.paginacion();
                        }
                            //comprobante.cargarVentas(comprobante.filtros.clave);
                        
                                               
                        break; 
                                            
                        
                        
                    
                    case "CARGAR":
                        if(data.error !== ""){
                            console.log("hay un error :");
                        }
                        else{
                            
                            $("#nombreProd").val(data.registros.nombre);
                            $("#fechaProd").val(data.registros.fecha);
                            $("#horaProd").val(data.registros.hora);
                            $("#lugarProd").val(data.registros.direccion);
                            $("#localidadProd").val(data.registros.localidad);
                            $("#precioProd").val("$ "+ data.registros.precio);
                            
                            //cargar Modal
                            $("#modalId").text(data.registros.nombre);
                            $("#modalLugar").text("En: "+data.registros.direccion);
                            $("#modalLoc").text("De: "+data.registros.localidad);
                            $("#modalFecha").text("El: "+data.registros.fecha);
                            $("#modalHora").text("A las: "+data.registros.hora);
                            
                            //cargar Listado
                            $("#nombreProdu").text(data.registros.nombre);
                            $("#fechaProdu").text(data.registros.fecha);


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
                        comprobante.paginacion();
                        
                        break;
                        
                    default: break;
                }
               
                //comprobante.resetarAlta();
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error("Error: "+textStatus+"-"+errorThrown); 
            }).always(function(){
                //independiemente si entra a done o fal se va a ejecutar (normalmente resetear
            });
    },
    
"cargarModal":function(){
    
},

"topdf": function(){
    var rep = $("#asistList").html();
    rep = encodeURIComponent(rep);
    window.open("files/PDF/asistentesPDF.php?pdf="+rep);
},

"comprobantepdf": function(){
    var rep = $("#comprobanteTabla").html();
    rep = encodeURIComponent(rep);
    window.open("files/PDF/comprobantePDF.php?pdf="+rep);
},
"ventaspdf": function(){
    var rep = $("#asistList").html();
    rep = encodeURIComponent(rep);
    window.open("files/PDF/ventasPDF.php?pdf="+rep);
},

"paginacion": function() {
        console.log(caso +" arriba");
        console.log(comprobante.filtros.clave);
        $pagination = $("#paginas");
        $pagination.twbsPagination({
            totalPages: totalPages,
            visiblePages: 6,
            first: 'Primera',
            prev: 'Anterior',
            next: 'Siguiente',
            last: 'Última',
            onPageClick: function (event, page) {
                  displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                  endRec = (displayRecordsIndex) + recPerPage;
                  displayRecords = records.slice(displayRecordsIndex, endRec);
                  
                  console.log(caso +" abajo");
                  
                if(caso==="tabla"){
                    console.log("ENTRO 1");
                    comprobante.listartab(displayRecords);
                }
                if(caso==="ventas"){
                    console.log("ENTRO 2");
                    comprobante.listarventas(displayRecords);
                }
                  
            }
      });
},

"listartab":function(rec){
    $("#tablaActividades").empty();
    //console.log("entro listartab");
    
    for(let registroTab of rec){
        let id = registroTab.id_produccion; 
        let tipo = registroTab.tipo_produccion;
        let nombre = registroTab.nombre_produccion;
        let fecha = registroTab.fecha_produccion;
        let lugar = registroTab.direccion_produccion;
        
                            
        $("#tablaActividades").append('<tr><td class="col-md-4"><div class="actividad-info"><div class="info-body"> <h4 class="info-title"> '+nombre+' </h4></div></div></td><td class="col-md-2"> <span>'+tipo+'</span></td><td class="col-md-2"><span>'+lugar+'</span></td><td class="col-md-2"><span> '+fecha+' </span></td>\n\
                                <td><a data-toggle="modal" data-target="#comprobanteModal" data-id='+id+' onclick="comprobante.cargar('+id+')"><i class="fas fa-ticket-alt"></i></a></td></tr>');
                           
        }
},

//Lista las ventas realizadas entre dos fechas dadas
"listarventas":function(rec){
    $("#tablaEspectaculo").empty();
    $("#cabeceraComprobantes").removeAttr("hidden");
    
    console.log("entro listarventas");
    
    for(let registroVenta of rec){
        let apellido = registroVenta.apellido_usuario; 
        let nombre = registroVenta.nombre_usuario;
        let produccion = registroVenta.nombre_produccion;
        let precio = registroVenta.precio_produccion;
        let fecha = registroVenta.pago_comprobante;
        
                            
        $("#tablaEspectaculo").append('<tr> <td>'+ nombre +' '+ apellido +'</td> <td> '+produccion+' </td> <td>'+precio+'</td> <td> '+fecha+'</td> </tr>');
                           
        }
}

};   

$(function(){
    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $("#fecha1").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: "-3M",
        maxDate: "0",
    });
    $("#fecha2").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: "-3M",
        maxDate: "0"
    });
});

$(document).ready(function(){
    
    let idProd = document.getElementById("idProd");
    if(idProd !== null){
        idProd = parseInt(idProd.value);
        comprobante.cargar(idProd);
    }
    
    comprobante.tablausu();
    comprobante.listartablausu();
    
});