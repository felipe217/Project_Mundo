var code = 0;

$('#btnActualizarPerfil').click(function(){
    $('.hiddengroup').removeClass("hidden");
    $('#btnGuardarCambios').removeClass("hidden");
});

$('#btnCancelarGuardar').click(function(){ 
    $('.hiddengroup').addClass("hidden");
    $('#btnGuardarCambios').addClass("hidden");
    $('#txtContrasena').val("");
    $('#txtContrasenaConfirm').val("");
});

$('#btnGuardarCambios').click(function(){
    actualizarPerfil();
    $('.hiddengroup').addClass("hidden");
    $('#btnGuardarCambios').addClass("hidden");
    $('#txtContrasena').val("");
    $('#txtContrasenaConfirm').val("");
});

function actualizarPerfil(){
    var parametros = 
    "caso=2&codigo="+code
    +"&usuario="+$('#txtUserName').val()
    +"&contrasena="+$('#txtContrasena').val(); 
	$.ajax(
        {
          url: "../Web_site/controles-php/perfilControl.php",
          data: parametros,
          method:"POST",
          dataType: "text",
          success:function(respuesta){  
                alert(respuesta);
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );    
}

function buscarInfo(valor){
    var parametros = "caso=1&codigo="+valor+"";
	$.ajax(
        {
          url: "../Web_site/controles-php/perfilControl.php",
          data: parametros,
          method:"POST",
          dataType: "json",
          success:function(respuesta){ 
              console.log(respuesta);
              $('#txtUserName').val(respuesta[0].usuario);
              $('#txtPais').val(respuesta[0].pais);
              $('#txtDepartamento').val(respuesta[0].departamento);
              $('#txtCargo').val(respuesta[0].cargo); 
              $('#userTag').html(respuesta[0].usuario); 
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}

$(document).ready(function(){
    code = $("#receptor").html();
    buscarInfo($("#receptor").html());
});