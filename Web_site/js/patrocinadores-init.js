//variables globales
var dtDesembolsos; //objeto datatable para los desembolsos
var dtPatrocinios; //objeto datatable para los patrocinios
var dtPatrocinadores// objeto datatable para los patrocinadores 
var codPatrocinadorSel;
var patrocinadorTemp;

//funciones para patrocinadores
$('#btnEditar').click(function(){
	$('#btnGuardarNuevo').addClass("hidden"); 
	$('#btnConfirmarEdit').removeClass("hidden"); 
});

$('#btnNuevoPatrocinador').click(function(){
	$('#btnGuardarNuevo').removeClass("hidden"); 
	$('#btnConfirmarEdit').addClass("hidden");
	limpiarCampos();
});

function limpiarCampos(){
	//formulario nuevo patrocinador
	$('#txtNombrePatrocinador').val("");
	$('#txtProcedencia').val("");
	$('#txtUbicacion').val("");
	$('#txtPersonaContacto').val("");
	$('#txtCorreoContacto').val("");
	$('#txtTelefono').val("");
	//formulario nuevo patrocinio
	$('#txtFecha').val("");
	$('#txtValor').val("");
	$('#txtDescripcion').val(""); 
}

function confirmarEditar(){

}

function cargarTablaPatrocinadores(){
		dtPatrocinadores.clear().draw();
		var parametros = "caso=4&codigo="+codigoProyecto+"";
		$.ajax(
			{
				url: "../Web_site/controles-php/proyectosControl.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){
					console.log(respuesta);
					if (respuesta!="null") { 
						json = respuesta;
						dtPatrocinadores.clear().draw();
						var json_array = json.split('*');
						for (var i = 0; i<json_array.length; i++) { 
							var objPatrocinador = JSON.parse(json_array[i]);
							addMaterial(objPatrocinador.codigo,
													objPatrocinador.nombre
												 );
						}
					}else
						alert("No hay patrocinadores");
						
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);  
}

function addPatrocinador(codigo, nombre){
	dtPatrocinadores.add([codigo,nombre]).draw(false);
}

function cargarPatrocinadorSeleccionado(codigo){
	//var parametros = "caso=11&codTarea="+codigoTarea+"&codigo="+proyectoTemp.codProyecto;
	$('#lblNombrePatrocinador').html(codigo);
	$('#lblProcedencia').html(codigo); 
	$('#lblTipoPatrocinador').html(codigo);
	$('#lblUbicacion').html(codigo);
	$('#lblNombreContacto').html(codigo);
	$('#lblCorreo').html(codigo);
	$('#lblTelefono').html(codigo);
	/* $.ajax(
		{
			url: "../Web_site/controles-php/proyectosControl.php",
			data: parametros,
			method:"POST",
			success:function(respuesta){ 	 
				console.log(respuesta);
				patrocinadorTemp = JSON.parse(respuesta); 
				
			},
			error:function(){
				alert("Ocurrio un error");
			}
		}
	);   */
}
function initTablaPatrocinadores(){
	//aplicar funciones a tabla patrocinadores
	dtPatrocinadores =	$('#tabla-patrocinadores').DataTable(
				{
					"scrollY":        "350px",
					"scrollCollapse": true,
					"paging":         false,
					"dom": '<"toolbarx">frtip'
				}
			);
	$('#tabla-patrocinadores tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			dtPatrocinadores.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
 
	$('#tabla-patrocinadores tbody').on( 'dblclick', 'td', function () { 
		codPatrocinadorSel = dtPatrocinadores.cell( this ).data();
		if( !isNaN(codPatrocinadorSel) ) { 
			alert(codPatrocinadorSel);
			cargarPatrocinadorSeleccionado(codPatrocinadorSel);
		 }
	});	

}

//funciones para tabla de contribuciones de patrocinadores
function initTablaPatronicios(){
	//aplicar funciones a tabla cotribuciones
	dtPatrocinios =
	$('#tabla-patrocinios').DataTable(
			{
				"scrollY":        "320px",
				"scrollCollapse": true,
				"paging":         false,
				"dom": '<"toolbar1">frtip'
			}
		);

	$("div.toolbar1").html('<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmNuevoPatrocinio">' 
							+'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</button>');

	$('#tabla-patrocinios tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			dtPatrocinios.$('tr.selected').removeClass('selected');
			$(this).addClass('selected'); 
			console.log(dtPatrocinios.cell(this,0).data());
		}
	});
}

function addPatrocinio(codigo, fecha, tipo, valor, descripcion){
	dtPatrocinios.add([codigo, fecha, tipo, valor, descripcion]).draw(false);
}
//funciones para tabla desembolsos
function initTablaDesembolsos(){
	//aplicar funciones a tabla desembolsos
	dtDesembolsos =
	$('#tabla-desembolsos').DataTable(
			{
				"scrollY":        "320px",
				"scrollCollapse": true,
				"paging":         false,
				order: [[4, 'asc']],
				rowGroup: {
					dataSrc: 4
				}
			}
		);

	$('#tabla-desembolsos tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			dtDesembolsos.$('tr.selected').removeClass('selected');
			$(this).addClass('selected'); 
			console.log(dtDesembolsos.cell(this,0).data());
		}
	});
}

$(document).ready( function () {
	initTablaPatrocinadores();
	initTablaPatronicios();
	initTablaDesembolsos();

// Fin del documento
});