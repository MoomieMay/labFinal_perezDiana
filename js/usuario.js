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


let usuario = {
    // Variables
    "data" : {"id":0, "nombre":"", "apellido":"", "correo":"", "clave":"", "localidad":"", "perfil":"",
            "disciplina":"", "descripcion":"", "facebook":"", "instagram":"", "youtube":"", "aux":"", "accion":""},
    "filtros" : {"accion":"", "orden": "", "indice": 0, "cantidad":0, "clave":""},
    "parametros": {"url":"files/controladores/usuarioControlador.php"},
        
    
    // Funciones
    "alta": function(){   
        usuario.data.id = 0;
        usuario.data.nombre = $("#nombreUsuario").val();
        usuario.data.apellido = $("#apellidoUsuario").val();
        usuario.data.dni = $("#dniUsuario").val();
        usuario.data.correo = $("#correoUsuario").val();
        usuario.data.clave = $("#claveUsuario").val();
        usuario.data.localidad = $("#localidadUsuario").val();

        usuario.data.accion = "ALTA";
        usuario.abm(this.data);
    },
    
    "modificar": function(){
        usuario.data.id = $("#idOculto").val();
        usuario.data.nombre = $("#textNombre").val();
        usuario.data.apellido = $("#textApellido").val(); 
        usuario.data.correo = $("#textMail").val(); 
        
        usuario.data.accion = "MODIFICAR";
        usuario.abm(this.data);
    },
    
    "cambiarClave": function(){
        usuario.data.id = $("#idOculto").val();
        usuario.data.clave = $("#textClaveVieja").val();
        usuario.data.aux = $("#textClave").val(); 
        
        usuario.data.accion = "CAMBIARCLAVE";
        usuario.abm(this.data);
    },
    
    "baja": function(){
        usuario.data.id = $("#idOculto").val();        
        
        usuario.data.accion = "BAJA";
        usuario.abm(this.data);
        
    },
    
    "cargar": function(id){
        usuario.abm({"id":id,"accion":"CARGAR"});
    },
    
    "listarusu": function(){
        usuario.filtros.accion = "LISTARUSU";
        usuario.filtros.indice = 0;
        usuario.filtros.cantidad = 20;
        usuario.filtros.clave = $("#filtro").val();
        usuario.abm(this.filtros);
    },    
    
    "abm": function(datojson){
        $.ajax(
                {"url":usuario.parametros.url,
                "method":"post",
                "dataType":"json",
                "accept":"json",
                "data":{"data":JSON.stringify(datojson)}
            }).done(function(data,textStatus){
                
                switch(data.accion){
                    case "ALTA":
                        if(data.error == "Duplicado"){
                            swal("Este usuario ya esta registrado", "Por favor intente de nuevo", "error");
                       
                        }
                        else{
                            swal("Registrado con éxito","Ya puedes ingresar con tu correo y contraseña", "success").then(function(){
                               setTimeout("history.back()",200); 
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
                            usuario.actualizar();
                            //setTimeout(location.reload(),30000);
                        }
                       
                    break;
                    
                    case "CAMBIARCLAVE":
                        if(data.error === "Duplicado"){
                            swal("La clave actual ingresada no es correcta", "", "error");
                        }
                        else{
                            usuario.actualizar();
                            //setTimeout(location.reload(),30000);
                        }
                       
                    break;
                    
                    case "CARGAR":
                        if(data.error !== ""){
                            console.log("hay un error :(");
                        }
                        else{
                            let artista = data.registros.nombre +' '+ data.registros.apellido;
                            
                            $("#nombreBusqueda").val(artista);
                            $("#localidadBusqueda").val(data.registros.localidad);
                            $("#disciplinaBusqueda").val(data.registros.disciplina);
                            
                            document.getElementById("descripcionBusqueda").innerHTML = (data.registros.descripcion); 
                        }
                    break;
                    
                    
                
                    case "LISTARUSU":
                        for(let registro of data.registros){
                            let descripcion = registro.descripcion_usuario;                            
                            
                            if(descripcion !== ""){
                                totalRecords ++;
                            }
                        }

                        totalPages = Math.ceil(totalRecords / recPerPage);
                        records = data.registros;
                        usuario.paginacion();
                            //if(facebook !== "") 
                              //  $("#redes").append('');}
                        
                        break;                   
                        
                    default: break;
                }
               
            }).fail(function(jqXHR, textStatus, errorThrown){
                console.error("Error: "+textStatus+"-"+errorThrown); 
            }).always(function(){});
    },
    
    //Funciones extra
    "confirmar": function(){
        swal({
        title: "¿Estas seguro?",
        text: "Si continuas no podrás recuperar tu cuenta",
        icon: "warning",
        buttons: true,
        dangerMode: true
      })
      .then((willDelete) => {
        if (willDelete) {
          usuario.baja();
        } else {
            swal("Tu cuenta NO ha sido eliminada");}
      });
      },
    
    
    "editar": function(){
        $("#textNombre").removeAttr("disabled");
        $("#textApellido").removeAttr("disabled");
        $("#textMail").removeAttr("disabled");
        $("#btnAceptar").removeAttr("hidden");
        $("#btnCancelar").removeAttr("hidden");
        $("#btnModificar").attr("hidden","");
        $("#btnCambiar").attr("hidden","");
        $("#btnEliminar").attr("hidden",""); 
        $("#btnTarjeta").attr("hidden","");
        
    },
    
    "actualizar" : function(){
        usuario.cancelar();
        swal("Datos Modificados", "", "success").then(function(){
        setTimeout(location.reload(),2000);});
    },
    
    "cancelar": function(){
        $("#textNombre").attr("disabled","");
        $("#textApellido").attr("disabled","");
        $("#textMail").attr("disabled","");
        $("#btnAceptar").attr("hidden","");
        $("#btnCancelar").attr("hidden","");
        $("#btnModificar").removeAttr("hidden");
        $("#btnCambiar").removeAttr("hidden");
        $("#btnEliminar").removeAttr("hidden");
        $("#btnTarjeta").removeAttr("hidden");
        
    },
    
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
        usuario.cambiarClave();
        
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
            visiblePages: 6,
            first: 'Primera',
            prev: 'Anterior',
            next: 'Siguiente',
            last: 'Última',
            
            onPageClick: function (event, page) {
                  displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                  endRec = (displayRecordsIndex) + recPerPage;
                  displayRecords = records.slice(displayRecordsIndex, endRec);
                  usuario.listaru(displayRecords);
            }
      });
},

    "listaru":function(rec){
    $("#artistasGeneral").empty();
    for(let registro of rec){
                            let nombre = registro.nombre_usuario;
                            let apellido = registro.apellido_usuario;
                            let localidad = registro.localidad_usuario;
                            let disciplina = registro.disciplina_usuario;
                            let descripcion = registro.descripcion_usuario;
                            let facebook = registro.facebook_usuario;
                            let instagram = registro.instagram_usuario;
                            let youtube = registro.youtube_usuario;
                            
                            
                            if(descripcion !== ""){
                                $("#artistasGeneral").append('<div class="row cnt-block" id="paginacion"><div class="col-md-4" ><figure><img src="img/artist.jpg"></figure></div><div class="col-md-6" id="tarjetaArtista"><h2>'+nombre+' '+apellido+'<br><span class="span_loc">'+localidad+'</span> <span class="span_cat">'+disciplina+'</span></h2><p>'+descripcion+'</p><span><ul><li><a href="'+facebook+'" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li><li><a href="'+instagram+'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><li><a href="'+youtube+'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li></ul></span></div></div>');
                            }
}  
}
};
 
 
 
 


// Carga de la disciplina, para perfil Artista
$(document).ready(function() {
    $("#perfilUsuario").bind("change", function() {
        if ($(this).val() === "artista") {
            $("#disciplina").removeAttr("hidden");
            $("#aceptarAltaA").removeAttr("hidden");
            $("#aceptarAltaU").attr("hidden", "true");
            $("#dniUsuario").attr("hidden", "true");            
        }
        else {
            $("#disciplinaUsuario").val('');
            $("#disciplina").attr("hidden", "true");
            $("#aceptarAltaU").removeAttr("hidden");
            $("#aceptarAltaA").attr("hidden", "true");
            $("#dniUsuario").removeAttr("hidden");
        }
    });
});


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
    usuario.listarusu();
    sugestivo.activar();
    let id = document.getElementById("idArtista");
    if(id !== null){
        id = parseInt(id.value);
        usuario.cargar(id);
    }
});