let sugestivo = {
    "parametros":{"contenedor":"divSugestivo", "inputText":"textSugestivo", "lista":"ulSugestivo", "actualizar": false, "buscar": false},
    
    "activar":function(){
        $("#"+sugestivo.parametros.inputText).keydown(function(e){
            //identifico la tecla que se presiono y me aseguro que funciones para todos los navegadores
            let cod = e.which;
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
            if(sugestivo.parametros.actualizar) {return true}
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
        usuario.filtros.accion = "LISTAR";
        usuario.filtros.indice = 0;
        usuario.filtros.cantidad = 10;
        usuario.filtros.clave = $("#"+sugestivo.parametros.inputText).val();
        $.ajax(
            {
            "url": usuario.parametros.url,
            "method":"POST",
            "dataType":"JSON",
            "accept":"JSON",
            "data":{"data":JSON.stringify(usuario.filtros)}
        }).done(function(data,textStatus){
            $("#"+sugestivo.parametros.lista).remove();
            if(data.registros.length > 0){
                $("#"+sugestivo.parametros.contenedor).prepend('<ul id="'+sugestivo.parametros.lista+'" class+"list-group text-left" style="position:absolute; z-index: 100; margin-top:36px; margin-left:30px;">');
                for(let reg of data.registros){
                    $("#"+sugestivo.parametros.lista).append('<a href="files/usuarios_consulta.php?id='+reg.id_usuario+'"><li class="list-group-item" style="line-height;1.8em;">'+reg.user_cuenta+'</li></a>');
                }
            }
            
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.error("Error: "+textStatus+" - "+errorThrown);
        }).always(function(){});
    }
};

$(document).ready(function(){
   sugestivo.activar(); 
    let idUsuario = document.getElementById("textIdC");
    if(idUsuario !== null){
        idUsuario = parseInt(idUsuario.value);
        usuario.cargar(idUsuario);
    }
});


