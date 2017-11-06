var dtDocumentos = null; 
$('#btnNuevo').on('click', function() { 
    $('#docUser').val(1);
    $('#docProy').val($('#slcProyectos').val());
}); 

$('#slcProyectos').on('change', function() { 
   cargarTablaDocumentos($('#slcProyectos').val());
}); 

function cargarDocumento(id){ 
    if (id!=undefined) {
        $('#docViewer').attr("src",id);  
    }
   
}

function initTabla(){
    dtDocumentos =  $('#tabla-documentos').DataTable({
        "scrollY":        "290px",
        "scrollCollapse": true,
        "paging":         false,
        "dom": '<"toolbar-proy">frtip'
        });

        $('#tabla-documentos tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dtDocumentos.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#tabla-documentos tbody').on( 'dblclick', 'tr', function () {
           // console.log($(dtDocumentos.row(this).node()).attr("id"));
            cargarDocumento($(dtDocumentos.row(this).node()).attr("id"));
            $('#tittleTag').html(dtDocumentos.cell(this,0).data());
            $('#docUserTag').html(dtDocumentos.cell(this,1).data());
        });
}

function addDocumento(nombre, usuario, id){
    dtDocumentos.row.add([nombre, usuario]).node().id = id;
    dtDocumentos.draw(false);
}

function cargarTablaDocumentos(code){ 
    dtDocumentos.clear().draw();
	var parametros = "caso=1&codigo="+code;
	$.ajax(
		{
			url: "../Web_site/controles-php/documentosControl.php",
			data: parametros,
            method:"POST",
            dataType: "json",
			success:function(respuesta){
                console.log(respuesta); 
				if (respuesta!=null) {  
                    for (var i = 0; i < respuesta.length; i++) {
                        addDocumento(respuesta[i].nombre, respuesta[i].usuario,respuesta[i].url) ; 
                    }
				}else
					alert("No hay Documentos");
			},
			error:function(){
				alert("Ocurrio un error");
			}
		}
	);     
}


$(document).ready(function(){ 
    initTabla();
    
});