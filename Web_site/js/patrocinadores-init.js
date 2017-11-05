//variables globales
var dtDesembolsos; //objeto datatable para los desembolsos
var dtPatrocinios; //objeto datatable para los patrocinios
var dtPatrocinadores// objeto datatable para los patrocinadores 
var codPatrocinadorSel;
var patrocinadorTemp;
var desembolsoMaximo = 0; //la cantidad maxima de dinero que se puede asignar a un proyecto
var sumaPatrocinios =0; // cantidad total de aportaciones realizadas por un patrocinador
var sumaDesembolsos =0; // cantidad total de desembolsos asignados a un proyectos, provenientes de un patrocinador

function cargarProyectosPatrocinados(){ 
	var parametros = "caso=6&codPatrocinador="+codPatrocinadorSel;
	$.ajax(
		{
			url: "../Web_site/controles-php/recursosControl.php",
			data: parametros,
			method:"POST",
			dataType:"json",
			success:function(respuesta){
				console.log(respuesta);
				if (respuesta!="null") { 
					$('#selProyectos').html("<option value='0'>Seleccione proyecto</option>");
					for (var i = 0; i < respuesta.length; i++) {
						$('#selProyectos').append(
							'<option value="'+respuesta[i].codProyecto+'">'+respuesta[i].nombreProyecto+'</option>'
						); 
					} 
				}  
			},
			error:function(e){
				alert("Ocurrio un error cargando los proyectos patrocinados");
				console.log(e);
			}
		}
	);  		
}

//funciones para patrocinadores
$('#btnEditar').click(function(){
	$('.form-control').removeClass("invalid");
	$('#btnGuardarNuevo').addClass("hidden"); 
	$('#btnConfirmarEdit').removeClass("hidden"); 
	$('#txtNombrePatrocinador').val($('#lblNombrePatrocinador').html());
	$('#txtProcedencia').val($('#lblProcedencia').html());
	$('#txtUbicacion').val($('#lblUbicacion').html());
	$('#txtPersonaContacto').val($('#lblNombreContacto').html());
	$('#txtCorreoContacto').val($('#lblCorreo').html());
	$('#txtTelefono').val($('#lblTelefono').html());
	$('#selTipoPatrocinador').val($('#lblTipoPatrocinador').html());
});

$('#btnNuevoPatrocinador').click(function(){
	$('.form-control').removeClass("invalid");
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

$('#btnGuardarNuevo').click(function(){
	if (validarFormularioPatrocinador()<=0) { 
		var parametros = 
		"caso=1"
		+"&nombre="+$('#txtNombrePatrocinador').val()
		+"&lugarProcedencia="+$('#txtProcedencia').val()
		+"&direccion="+$('#txtUbicacion').val()
		+"&nombreContacto="+$('#txtPersonaContacto').val()
		+"&correoElectronico="+$('#txtCorreoContacto').val()
		+"&telefonoContacto="+$('#txtTelefono').val()
		+"&tipoPatrocinador="+$('#selTipoPatrocinador').val();
		console.log(parametros);
		$.ajax(
			{
				url: "../Web_site/controles-php/registrarPatrocinador.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){
					alert(respuesta);
					cargarTablaPatrocinadores(codPatrocinadorSel);
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);   
		//agregarTarea(0, $('#txtNomTarea').val(),$('#selPriodidades').val(),$('#txtTareaInicio').val(),$('#txtTareaEntrega').val(), "cualquier");
		$('#frmNuevoPatrocinador').modal('hide');
	}
	
});

$('#btnConfirmarEdit').click(function(){
	if (validarFormularioPatrocinador()<=0) {
		var parametros = 
		"caso=2&codPatrocinador="+codPatrocinadorSel
		+"&nombre="+$('#txtNombrePatrocinador').val()
		+"&lugarProcedencia="+$('#txtProcedencia').val()
		+"&direccion="+$('#txtUbicacion').val()
		+"&nombreContacto="+$('#txtPersonaContacto').val()
		+"&correoElectronico="+$('#txtCorreoContacto').val()
		+"&telefonoContacto="+$('#txtTelefono').val()
		+"&tipoPatrocinador="+$('#selTipoPatrocinador').val();
		console.log(parametros);
		$.ajax(
			{
				url: "../Web_site/controles-php/registrarPatrocinador.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){
					alert(respuesta);
					cargarTablaPatrocinadores(codPatrocinadorSel); 
					cargarPatrocinadorSeleccionado(codPatrocinadorSel);
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);   
		$('#frmNuevoPatrocinador').modal('hide');
	}
});

function cargarTablaPatrocinadores(){
	dtPatrocinadores.clear().draw();
	var parametros = "caso=1&codPatrocinador=1";
	$.ajax(
		{
			url: "../Web_site/controles-php/recursosControl.php",
			data: parametros,
			method:"POST",
			success:function(respuesta){
				console.log(respuesta);
				if (respuesta!="null") { 
					json = respuesta; 
					var json_array = json.split('*');
					for (var i = 0; i<json_array.length; i++) {  
						var objPatrocinador = JSON.parse(json_array[i]);
						addPatrocinador(objPatrocinador.codPatrocinador,objPatrocinador.nombre); 
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
	dtPatrocinadores.row.add([codigo,nombre]).draw(false);
}

function cargarPatrocinadorSeleccionado(codigo){
	var parametros = "caso=3&codPatrocinador="+codigo;
	$.ajax(
		{
			url: "../Web_site/controles-php/recursosControl.php",
			data: parametros,
			method:"POST",
			success:function(respuesta){ 	 
				console.log(respuesta);
				patrocinadorTemp = JSON.parse(respuesta); 
				$('#selectedTag').html(patrocinadorTemp.nombre);
				$('#lblNombrePatrocinador').html(patrocinadorTemp.nombre);
				$('#lblProcedencia').html(patrocinadorTemp.lugarProcedencia); 
				$('#lblTipoPatrocinador').html(patrocinadorTemp.tipoPatrocinador);
				$('#lblUbicacion').html(patrocinadorTemp.direccion);
				$('#lblNombreContacto').html(patrocinadorTemp.nombreContacto);
				$('#lblCorreo').html(patrocinadorTemp.correoElectronico);
				$('#lblTelefono').html(patrocinadorTemp.telefonoContacto);
			},
			error:function(){
				alert("Ocurrio un error");
			}
		}
	);  
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
			//alert(codPatrocinadorSel);
			cargarPatrocinadorSeleccionado(codPatrocinadorSel);
			cargarTablaPatrocinios();
			cargarDesembolsos();
			cargarProyectosPatrocinados();   
		 }
	});	

}
 

//funciones para tabla de contribuciones de patrocinadores
$('#btnGuardarPatrocinio').click(function(){
	if (validarFormularioPatrocinio()>0) {
		alert("Algunos datos están erroneos. Verifique la información.");
	}else{
		var parametros = 
		"caso=1"
		+"&tipoPatrocinio="+$('#selTipoPatrocinio').val()
		+"&descripcion="+$('#txtDescripcion').val()
		+"&fecha="+$('#txtFecha').val()
		+"&valor="+$('#txtValor').val()
		+"&codPatrocinador="+codPatrocinadorSel;
		console.log(parametros);
		$.ajax(
			{
				url: "../Web_site/controles-php/registrarPatrocinio.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){
					alert(respuesta);
					cargarTablaPatrocinios();
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);  
		$('#frmNuevoPatrocinio').modal('hide');
		$('.form-control').removeClass("invalid");
		$('#txtDescripcion').val("");
		$('#txtValor').val("");
	}

});

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
	dtPatrocinios.row.add([codigo, fecha, tipo, valor, descripcion]).draw(false);
}

function cargarTablaPatrocinios(){
	sumaPatrocinios=0;
	dtPatrocinios.clear().draw();
	var parametros = "caso=5&codPatrocinador="+codPatrocinadorSel;
	$.ajax(
		{
			url: "../Web_site/controles-php/recursosControl.php",
			data: parametros,
			method:"POST",
			success:function(respuesta){
				console.log(respuesta);
				if (respuesta!="null") { 
					json = respuesta; 
					var json_array = json.split('*'); 
					for (var i = 0; i<json_array.length; i++) {  
						var objPatrocinador = JSON.parse(json_array[i]); 
						addPatrocinio(	objPatrocinador.codigo,
										objPatrocinador.fecha,
										objPatrocinador.tipoPatrocinio,
										objPatrocinador.valor,
										objPatrocinador.descripcion );
						sumaPatrocinios = sumaPatrocinios + parseFloat(objPatrocinador.valor);
						$('#contribucionesCount').html(sumaPatrocinios);
					}
					
					// //calcular el maximo de contribuciones 
					// $('#txtMontoDesembolso').attr("placeholder", "maximo "+sumaPatrocinios+" lps");
				} else
				$('#contribucionesCount').html("0");
			},
			error:function(){
				alert("Ocurrio un error");
			}
		}
	);  	
}

//funciones para tabla desembolsos
$('#btnGuardarDesembolso').click(function(){  
	
	if (validarDesembolso()<=0) { 
		if ($('#txtMontoDesembolso').val()>desembolsoMaximo) {
			alert("El valor que intenta desembolsar supera la suma de contribuciones del patrocinador"+
				  ". Intente una cantidad menor");
			$('#txtMontoDesembolso').val("");
			$('#txtMontoDesembolso').attr("placeholder", "maximo "+desembolsoMaximo+" lps");
		} else {
			alert("entro");
			var parametros = 
			"caso=1"
			+"&fecha=null"
			+"&valor="+$('#txtMontoDesembolso').val()
			+"&codPatrocinio=1"
			+"&codProyecto="+$('#selProyectos').val()
			+"&codPatrocinador="+codPatrocinadorSel;
			console.log(parametros);
			$.ajax( 
				{
					url: "../Web_site/controles-php/registrarDesembolso.php",
					data: parametros,
					method:"POST",
					success:function(respuesta){
						alert(respuesta); 
						cargarDesembolsos(); 
					},
					error:function(){
						alert("Ocurrio un error");
					}
				}
			);   
		}	
	}	
});


function cargarDesembolsos(){
	sumaDesembolsos =0;
	dtDesembolsos.clear().draw();
	var parametros = "caso=4&codPatrocinador="+codPatrocinadorSel;
	$.ajax(
		{
			url: "../Web_site/controles-php/recursosControl.php",
			data: parametros,
			method:"POST",
			dataType:"json",
			success:function(respuesta){ 
				console.log(respuesta);
				if (respuesta!="null" && respuesta != null) { 
					for (var i = 0; i < respuesta.length; i++) {
						addDesembolso(
							respuesta[i].codDesembolso,
							respuesta[i].fecha,
							respuesta[i].valor,
							respuesta[i].nombreProyecto
						); 
						sumaDesembolsos = sumaDesembolsos + parseFloat(respuesta[i].valor);
						$('#desembolsosCount').html(sumaDesembolsos);
					}  
				} else{
					$('#desembolsosCount').html("0");
					$("#disponible").html("0");	
				}
				
				$("#disponible").html(sumaPatrocinios-sumaDesembolsos);
				desembolsoMaximo = sumaPatrocinios-sumaDesembolsos;
				$('#txtMontoDesembolso').attr("placeholder", "maximo "+desembolsoMaximo+" lps");
				
			},
			error:function(){
				alert("Ocurrio un error");
			}
		}
	);  		
}

function addDesembolso(codigo, fecha, monto, proyecto){
	dtDesembolsos.row.add([codigo, fecha, monto, proyecto]).draw(false);
}

function initTablaDesembolsos(){
	//aplicar funciones a tabla desembolsos
	dtDesembolsos =
	$('#tabla-desembolsos').DataTable(
			{
				"scrollY":        "320px",
				"scrollCollapse": true,
				"paging":         false,
				order: [[3, 'asc']],
				rowGroup: {
					dataSrc: 3
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

//funciones de validacion 

// funciones de validaciones
function validarFormularioPatrocinador(){
	var errores = 0;
	if ($('#selTipoPatrocinador').val()<=0) {  
		$('#selTipoPatrocinador').addClass('invalid');  
		errores++;
	}else{
		$('#selTipoPatrocinador').removeClass('invalid');  
	}
	if (!noVacio($('#txtNombrePatrocinador').val())) {
		$('#txtNombrePatrocinador').addClass('invalid'); 
		errores++;
	}else{
		$('#txtNombrePatrocinador').removeClass('invalid');  
	} 
	if (!noVacio($('#txtProcedencia').val())) {
		$('#txtProcedencia').addClass('invalid'); 
		errores++;
	}else{
		$('#txtProcedencia').removeClass('invalid');  
	}  
	if (!noVacio($('#txtUbicacion').val())) {
		$('#txtUbicacion').addClass('invalid'); 
		errores++;
	}else{
		$('#txtUbicacion').removeClass('invalid');  
	} 
	if (!noVacio($('#txtPersonaContacto').val())) {
		$('#txtPersonaContacto').addClass('invalid'); 
		errores++;
	}else{
		$('#txtPersonaContacto').removeClass('invalid');  
	} 
	if (!esCorreo($('#txtCorreoContacto').val())) {
		$('#txtCorreoContacto').addClass('invalid'); 
		errores++;
	}else{
		$('#txtCorreoContacto').removeClass('invalid');  
	}  
	if (!esTelefono($('#txtTelefono').val())) {
		$('#txtTelefono').addClass('invalid'); 
		errores++;
	}else{
		$('#txtTelefono').removeClass('invalid');  
	}   
	return errores;
}

function validarDesembolso(){
	var errores =0;
	if (!noVacio($('#txtMontoDesembolso').val()) && $('#txtMontoDesembolso').val()<=0) { 
		$('#txtMontoDesembolso').addClass('invalid');  
		errores++;
	} else{
		$('#txtMontoDesembolso').removeClass('invalid');  
	}
	if ($('#selProyectos').val()<=0) {  
		$('#selProyectos').addClass('invalid');  
		errores++;
	}else{
		$('#selProyectos').removeClass('invalid');  
	}
	return errores;
}

function validarFormularioPatrocinio(){
	var errores = 0;
	if ($('#selTipoPatrocinio').val()<=0) {  
		$('#selTipoPatrocinio').addClass('invalid');  
		errores++;
	}else{
		$('#selTipoPatrocinio').removeClass('invalid');  
	}
	if (!noVacio($('#txtDescripcion').val())) {
		$('#txtDescripcion').addClass('invalid'); 
		errores++;
	}else{
		$('#txtDescripcion').removeClass('invalid');  
	} 
	if (!noVacio($('#txtValor').val()) && $('#txtValor').val()<=0) { 
		$('#txtValor').addClass('invalid');  
		errores++;
	} else{
		$('#txtValor').removeClass('invalid');  
	} 
	return errores;
}

$(document).ready( function () {
	initTablaPatrocinadores();
	cargarTablaPatrocinadores();
	initTablaPatronicios();
	initTablaDesembolsos(); 
// Fin del documento
});