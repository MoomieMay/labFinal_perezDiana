$(document).ready(function(){
var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});


});




//VALIDACION
let usuario = {
    //Para alta, baja o modificación envío data
    "data":{
        "id":0,
        "apellido":"",
        "nombres":"",
        "dni":"",
        "telefono":"",
        "correo":"",
        "clave":"",
        "tipo":"",
        "estado":"",
        "fechaAlta":"",
        "calificacion":"",
        "descripcion":"",
        "accion":""
    },
    //Para listar envío filtros
    "filtros": {"accion":"","orden":"","indice":0,"cantidad":0, "clave":""},
    "parametros":{"url":"files/controlador/UsuarioControlador.php"},
    "resetearAlta": function(){
        $("#form_usuario_registro input[type=text]").val("");
    },
    "validar":function(){
        usuario.data.apellido = $("#name_on_card").val();
        usuario.data.nombres = $("#name_on_card").val();
        usuario.data.dni = $("#textDniRegistroAlta").val();
        usuario.data.telefono = $("#textTelefonoRegistroAlta").val();
        usuario.data.correo = $("#textCorreoRegistroAlta").val();
        
        if(usuario.data.apellido.length>24){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error");
            $("#textApellidoRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textApellidoRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textApellidoRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textApellidoRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(usuario.data.apellido === ""){
            $("#tarjetaValidar").empty();
            $("#tarjetaValidar").removeAttr("hidden");
            $("#tarjetaValidar").text("Error: Complete este campo");
            $("#name_on_card").focus();
            
            $(document).ready(function (){
                $("#name_on_card").focus(function (){
                    $("#tarjetaValidar").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#name_on_card").keyup(function (){
                   var form = $(this).parents("#name_on_card");
                   var check = checkCampos(form);
                   if(check){
                       $("#tarjetaValidar").attr("hidden","");
                   }else{
                       $("#tarjetaValidar").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(usuario.data.nombres === ""){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: Complete este campo");
            $("#textNombresRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textNombresRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textNombresRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textNombresRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(usuario.data.nombres.length>60){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error");
            $("#textNombresRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textNombresRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textNombresRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textNombresRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(usuario.data.nombres === ""){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: Complete este campo");
            $("#textNombresRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textNombresRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textNombresRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textNombresRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(usuario.data.nombres.length>60){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error");
            $("#textNombresRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textNombresRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textNombresRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textNombresRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }

        if(usuario.data.dni === ""){            
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: Complete este campo");
            $("#textDniRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textDniRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textDniRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textDniRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(isNaN(usuario.data.dni)){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: debe ser un numero");
            $("#textDniRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textDniRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textDniRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textDniRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(usuario.data.dni.length <= 7){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: debe ser mayor a 7 dígitos");
            $("#textDniRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textDniRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textDniRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textDniRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(usuario.data.telefono === ""){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: Complete este campo");
            $("#textTelefonoRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textTelefonoRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textTelefonoRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textTelefonoRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if(isNaN(usuario.data.telefono)){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: debe ser un numero");
            $("#textTelefonoRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textTelefonoRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textTelefonoRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textTelefonoRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        if((usuario.data.correo.length<4)||(usuario.data.correo.length>120)){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: correo no válido");
            $("#textCorreoRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textCorreoRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textCorreoRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textCorreoRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        
        var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        
        if(!emailreg.test($("#textCorreoRegistroAlta").val())){
            $("#alertValidacionAlta").empty();
            $("#alertValidacionAlta").removeAttr("hidden");
            $("#alertValidacionAlta").text("Error: correo no válido");
            $("#textCorreoRegistroAlta").focus();
            
            $(document).ready(function (){
                $("#textCorreoRegistroAlta").focus(function (){
                    $("#alertValidacionAlta").attr("hidden",""); 
                });
                
                //siempre que salgamos de un campo de texto, se chequea esta función
                $("#textCorreoRegistroAlta").keyup(function (){
                   var form = $(this).parents("#textCorreoRegistroAlta");
                   var check = checkCampos(form);
                   if(check){
                       $("#alertValidacionAlta").attr("hidden","");
                   }else{
                       $("#alertValidacionAlta").removeAttr("hidden");
                   }
                });
            });
            
            return false;
        }
        return true;
    }
    };
