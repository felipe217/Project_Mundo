//variables globales
var cuerpo="";
var tblProyectos; //tabla lateral de proyectos
var tblTareas; //tabla de tareas
var totalTareas =0;
var tblMateriales; //tabla materiales
var tblColaboradores; //tabla colaboradores
var valor = 0;
var codTareaSel =0;
var usuarioActual=1;
var proyectoTemp =null; //es el proyecto seleccionado, objeto necesario para la funcion de edicion de los datos
var tareaTemp = null; //es un objeto json que contiene todos los datos de la tarea seleccioada. 
var patrocinadoresEditar; 
var todosPatrocinadores;

function cargarPatrocinadores(){
	var parametros = "caso=8&codigo=1";
	$.ajax(
		{
			url: "../Web_site/controles-php/proyectosControl.php",
			data: parametros,
			method: "POST",
			dataType: "json",
			success: function(respuesta){ 
				//console.log(respuesta); 
				todosPatrocinadores = respuesta;
				var opciones = " "; 		 
				for(var i=0; i<respuesta.length; i++){
					opciones = opciones + "<option value='"+respuesta[i].codigo+"'>"+respuesta[i].nombre+"</option>";
				}
				$('#selPatrocinadores').html(opciones);	  
				$('.selectpicker').selectpicker('refresh'); 
			},
			error: function(){
				alert("ocurrió un error");
			}
		}
	)
}

function cargarTiposProyecto(){
	var parametros = "caso=7&codigo=1";
	$.ajax(
		{
			url: "../Web_site/controles-php/proyectosControl.php",
			data: parametros,
			method: "POST",
			dataType: "json",
			success: function(respuesta){ 
				var opciones = "<option>Selec. un tipo</option>"; 		 
				for(var i=0; i<respuesta.length; i++){
					opciones = opciones + "<option value='"+respuesta[i].codigo+"'>"+respuesta[i].tipo+"</option>";
				}
				$('#selTipoProyecto').html(opciones);

			},
			error: function(){
				alert("ocurrió un error cargando los proyectos.");
			}
		}
	)
}

function cargarPatrocinadoresxProyecto(code){
	var parametros = "caso=9&codigo="+code;
	$('#tr-patrocinadoresxproyecto').html("");
	$.ajax({
		url:"../Web_site/controles-php/proyectosControl.php",
		data:parametros,
		method:"POST",
		dataType: "json",
		success: function(respuesta){ 
			//console.log(respuesta);
			if (respuesta != null) { 
				patrocinadoresEditar = respuesta;
				var listapatrocinadores = "<label>Patrocinadores:</label><br>";
				for(var i=0; i<respuesta.length; i++){
					listapatrocinadores = listapatrocinadores + respuesta[i].nombre+"<br>";
				}
				console.log("patrocinadores:"+listapatrocinadores);
				$('#tr-patrocinadoresxproyecto').html(listapatrocinadores);
			}else
				$('#tr-patrocinadoresxproyecto').html("No hay patrocinadores");
			
		},
		error: function(){
			alert("ocurrio un error cargando los patrocinadores de este proyecto"); 
		}
	});
}

function cargarEstados(){
	var parametros = "caso=6&codigo=1";
	$.ajax(
		{
			url: "../Web_site/controles-php/proyectosControl.php",
			data: parametros,
			method: "POST",
			dataType: "json",
			success: function(respuesta){ 
				console.log(respuesta);
				var opciones = "<option>Selec. un estado</option>";				 
				for(var i=0; i<respuesta.length; i++){
					opciones = opciones + "<option value='"+respuesta[i].codigo+"'>"+respuesta[i].estado+"</option>";
				}
				$('#selEstados').html(opciones);
			},
			error: function(){
				alert("ocurrió un error cargando los estados.");
			}
		}
	)
}

//******************* editar proyecto al presionar en el boton editar prooyecto ***************************

function cargarPatrocinadoresSeleccionados(){
	var parametros = "caso=8&codigo=1";
	$.ajax(
		{
			url: "../Web_site/controles-php/proyectosControl.php",
			data: parametros,
			method: "POST",
			dataType: "json",
			success: function(respuesta){ 
				//console.log(respuesta);  console.log(patrocinadoresEditar); 
				var opciones = " "; 	
				var cont =0;
				var flag = 0; 
				if (patrocinadoresEditar == null) {
					cargarPatrocinadores();
				}else{
					while(cont < respuesta.length){
						for (var k = cont; k < patrocinadoresEditar.length; k++) {
							if (respuesta[cont].codigo === patrocinadoresEditar[k].codigoPatrocinador) {
								opciones = opciones + "<option value='"+respuesta[cont].codigo+"' selected>"+respuesta[cont].nombre+"</option>";
								 k=patrocinadoresEditar.length;
								 flag=1;
							}
						}
						if(flag==0){
							opciones = opciones + "<option value='"+respuesta[cont].codigo+"'>"+respuesta[cont].nombre+"</option>";
						}else {
							flag=0;
						}
						cont++;
					} 

					$('#selPatrocinadores').html(opciones);	  
					$('.selectpicker').selectpicker('refresh'); 
				}
				
				/* for (var i = cont; i < respuesta.length; i++) {
					console.log(respuesta[i].codigo);
					for (var k = 0; k < patrocinadoresEditar.length; k++) {
						if (respuesta[i].codigo === patrocinadoresEditar[k].codigoPatrocinador) {
							opciones = opciones + "<option value='"+respuesta[i].codigo+"' selected>"+respuesta[i].nombre+"</option>";
							k=patrocinadoresEditar.length;
						}else{
							opciones = opciones + "<option value='"+respuesta[i].codigo+"'>"+respuesta[i].nombre+"</option>";
						}
					}
					cont++;
				} */
				console.log(opciones);
				
			},
			error: function(){
				alert("ocurrió un error");
			}
		}
	)	
}

function editarProyecto(){ 
	if (proyectoTemp != null) {
		$('#btnGuardarProyecto').addClass("hidden");
		$('#btnCancelarGuardar').addClass("hidden");
		$('#btnActualizarProyecto').removeClass("hidden"); 
		$('#btnCancelarEdicion').removeClass("hidden"); 
		cargarEstados();
		//cargarPatrocinadores(); 
		cargarTiposProyecto();  
		
		cargarPatrocinadoresSeleccionados();
		// var opciones ="";
		// for (var i = 0; i < todosPatrocinadores.length; i++) {
		// 	for (var k = 0; k < patrocinadoresEditar.length; k++) {
		// 		if (todosPatrocinadores[i].codigoPatrocinador == patrocinadoresEditar[k].codigoPatrocinador) {
		// 			opciones = opciones + "<option value='"+todosPatrocinadores[i].codigo+"' selected>"+todosPatrocinadores[i].nombre+"</option>";
		// 		}else
		// 			opciones = opciones + "<option value='"+todosPatrocinadores[i].codigo+"'>"+todosPatrocinadores[i].nombre+"</option>";
		// 	}
		// }
		//$('#selPatrocinadores').html(opciones);	    
		$('#txtcode').val(proyectoTemp.codigo);
		$('#txtNomProyecto').val(proyectoTemp.nombreProyecto);
		$('#txtLugar').val(proyectoTemp.lugar);
		$('#txtFechaInicio').val(proyectoTemp.fechaInicio);
		$('#txtFechaFinal').val(proyectoTemp.fechaFinal);
		$('#txtResponsable').val(proyectoTemp.responsable);
		$('#txtBeneficiario').val(proyectoTemp.beneficiario);
		$('#txtCosto').val(proyectoTemp.costoEstimado);
		$('#txtDescripcion').val(proyectoTemp.descripcion);
		//$('#selEstados').val(proyectoTemp.codTipoProyecto).prop('selected', true);   
		$('#selTipoProyecto').on("mouseenter", function(){
			$(this).val(proyectoTemp.codTipoProyecto).prop('selected', true);   
			$('#lblEstado').attr('name')
		});
		$('#selEstados').on("mouseenter", function(){
			$(this).val($('#lblEstado').attr('name')).prop('selected', true);   
			
		});

		
		//$('.selectpicker').selectpicker('val', 'Mustard');
	}else{
				
		alert("Debe seleccionar un proyecto primero.");
		$('#frmNuevoProyecto').modal('hide');
	}
}
 
//****************funciones del panel de proyectos: tabla colaboradores*****************

//evento click para agregar un nuevo colaborador
$('#btnAgregarColaborador').click(function(){
	$('#selUsuariosProyecto').removeClass("hidden");
	$('#rolTextGroup').removeClass("hidden");
	$('#txtRolColaborador').val("");
});

$('#btnActualizarColaborador').click(function(){ 
	$('#rolTextGroup').removeClass("hidden");
	$('#txtRolColaborador').val("");
});

$('#btnRegistrarColaborador').click(function(){ 
	var n;
	if (!isNaN($('#txtCodOculto').val())) {
		n= $('#txtCodOculto').val();
	}else  if (!isNaN($('#selUsuariosProyecto').val())) {
		n= $('#txtCodOculto').val();
	}

	if (n>0 && $('#txtRolColaborador').val()!="") {
		var parametros = "caso=5&codigoProyecto="
						+proyectoTemp.codProyecto
						+"&codUsuario="
						+n
						+"&rol="+$('#txtRolColaborador').val();
		console.log(parametros);
		$.ajax(
			{
				url: "../Web_site/controles-php/registrarProyecto.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){ 
					cargarColaboradores(proyectoTemp.codProyecto);
					cargarColaboradoresSinRol(proyectoTemp.codProyecto);
					alert(respuesta);
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);    
		$('#selUsuariosProyecto').addClass("hidden");
		$('#rolTextGroup').addClass("hidden");
	}else
		alert("Seleccione un usuario y luego indique un rol.");
});

$('#btnOcultarRolText').click(function(){ 
	$('#selUsuariosProyecto').addClass("hidden");
	$('#rolTextGroup').addClass("hidden");
});
 
function initTablaColaboradores(){
	tblColaboradores = $('#tabla-colaboradores').DataTable(
		{
	        "scrollY":        "250px",
	        "scrollCollapse": true,
	        "paging":         false
	    }
	);

	$('#tabla-colaboradores tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			tblColaboradores.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});

	$('#tabla-colaboradores tbody').on( 'click', 'td', function () {  
		if( !isNaN(tblColaboradores.cell( this ).data()) ) {  
			$('#txtCodOculto').val(tblColaboradores.cell( this ).data()); 
		}
	});	
}
function addColaborador(codUsuario,nombreUsuario,tipoUsuario,departamento,cargo,rol ){
	tblColaboradores.row.add( [ codUsuario,
								nombreUsuario,
								tipoUsuario,
								departamento,
								cargo,
								rol ] ).draw( false );
}

function cargarColaboradoresSinRol(codigoProyecto){
	tblColaboradores.clear().draw(); 
	var parametros = "caso=10&codigo="+codigoProyecto+""; 
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
          	if (respuesta!="null") { 
      		  json = respuesta;      		  
			  		var json_array = json.split('*'); 
              for (var i = 0; i<json_array.length; i++) { 
                var objColaborador = JSON.parse(json_array[i]);  
              }
          	}			             
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}

function cargarColaboradores(codigoProyecto){
	tblColaboradores.clear().draw(); 
	$("#selUsuarios").html("");
	var parametros = "caso=5&codigo="+codigoProyecto+""; 
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
          	if (respuesta!="null") { 
							json = respuesta;      		  
							var json_array = json.split('*');
							$('#colaboradoresCount').html(json_array.length);
								for (var i = 0; i<json_array.length; i++) { 
									var objColaborador = JSON.parse(json_array[i]);
									addColaborador(objColaborador.codUsuario,
										objColaborador.nombreUsuario,
										objColaborador.tipoUsuario,
										objColaborador.departamento,
										objColaborador.cargo,
										objColaborador.rol ); 
								//Agregando usuarios en formulario modal
								$("#selUsuarios").append('<option value="'+objColaborador.codUsuario+'">'+objColaborador.nombreUsuario+'</option>');
              }
							$('.selectpicker').selectpicker('refresh');
          	}else{
							$('#colaboradoresCount').html("0");  
							$("#selUsuarios").html(""); 
						}
			  			         
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}


//****************funciones del panel de proyectos: tabla materiales*****************
$('#txtMatUnidades').keyup(function(){
	//calcular el total
	var cant = parseInt($('#txtMatUnidades').val());
	var precio = parseFloat($('#txtPrecioUnidad').val());
	$("#txtMatTotal").val(cant*precio);
});
$('#txtPrecioUnidad').keyup(function(){
	//calcular el total
	var cant = parseInt($('#txtMatUnidades').val());
	var precio = parseFloat($('#txtPrecioUnidad').val());
	$("#txtMatTotal").val(cant*precio);
});
//evento click para agregar un nuevo material
$('#btnNuevoMaterial').click(function(){ 
	$('#txtMatFecha').val("");
	$('#txtProveedor').val("");
	$('#txtMaterial').val("");
	$('#txtMatUnidades').val("");
	$('#txtPrecioUnidad').val("");
	$('#txtMatTotal').val("");
});

//evento click para registrar un nuevo material
$('#btnConfirmarMaterial').click(function(){
	if (validarFormularioMaterial()!=0) {
		alert("hay errores");
	}else{
		var parametros = 
		"proveedor="+$('#txtProveedor').val()
		+"&material="+$('#txtMaterial').val()
		+"&cantidad="+$('#txtMatUnidades').val()
		+"&precio="+$('#txtPrecioUnidad').val()
		+"&total="+$('#txtMatTotal').val()
		+"&codProyecto="+proyectoTemp.codProyecto
		+"&fechaAsignacion="+$('#txtMatFecha').val();
		console.log(parametros);
		$.ajax(
				{
					url: "../Web_site/controles-php/registrarMaterial.php",
					data: parametros,
					method:"POST",
					success:function(respuesta){
						alert(respuesta);
						//addMaterial(0,$('#txtProveedor').val(),$('#txtMaterial').val(),$('#txtMatUnidades').val(),$('#txtPrecioUnidad').val(),$('#txtMatTotal').val());
						cargarMateriales(proyectoTemp.codProyecto);
						},
					error:function(){
						alert("Ocurrio un error");
					}
				}
			);   
		$('#frmNuevoMaterial').modal('hide');
	}
});


function initTablaMateriales(){
	tblMateriales = $('#tabla-materiales').DataTable(
			{
		        "scrollY":        "250px",
		        "scrollCollapse": true,
				"paging":         false,
				"language": {
					"decimal": ",",
					"thousands": "."
				}
		    });
}

function addMaterial(codMaterial,proveedor,material,cantidad,precio,total){
	tblMateriales.row.add( [codMaterial,
							proveedor,
							material,
							cantidad,
							precio,
							total ] ).draw( false );
}

function cargarMateriales(codigoProyecto){
	tblMateriales.clear().draw();
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
      		  tblMateriales.clear().draw();
			  var json_array = json.split('*');
			  $('#materialesCount').html(json_array.length);
              for (var i = 0; i<json_array.length; i++) { 
                var objMaterial = JSON.parse(json_array[i]);
                addMaterial(objMaterial.codMaterial,
							objMaterial.proveedor,
							objMaterial.material,
							objMaterial.cantidad,
							objMaterial.precio,
							objMaterial.total );
              }
          	}else
			  $('#materialesCount').html("0");
              
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}

//****************funciones del panel de proyectos: tabla tareas*****************

$('#btn-guardar-tarea').click(function(){ 
	var parametros = 
	"caso=1"
	+"&nombreTarea="+$('#txtNomTarea').val()
	+"&descripcion="+$('#txtTareaDesc').val()
	+"&prioridad="+$('#selPriodidades').val()
	+"&fechaInicio="+$('#txtTareaInicio').val()
	+"&fechaEntrega="+$('#txtTareaEntrega').val()
	+"&cadenaDeUsuarios="+$('#selUsuarios').val()
	+"&codProyecto="+proyectoTemp.codProyecto;
	console.log(parametros);
	$.ajax(
		{
			url: "../Web_site/controles-php/registrarTarea.php",
			data: parametros,
			method:"POST",
			success:function(respuesta){
				alert(respuesta);
				cargarTareas(proyectoTemp.codProyecto);
			},
			error:function(){
				alert("Ocurrio un error");
			}
		}
	);   
	//agregarTarea(0, $('#txtNomTarea').val(),$('#selPriodidades').val(),$('#txtTareaInicio').val(),$('#txtTareaEntrega').val(), "cualquier");
	$('#frmNuevaTarea').modal('hide');
}); 

$('#btnNuevaTarea').click(function(){
		$('#txtNomTarea').val("");
            $('#txtTareaDesc').val("");
            //$('#selPriodidades').val("");
            $('#txtTareaInicio').val("");
            $('#txtTareaEntrega').val("");
}) ;

function editarTarea(){
	$('#btnActualizarTarea').removeClass("hidden");
	$('#btn-guardar-tarea').addClass("hidden");


	//colocar los valores de la tarea seleccionada en las respectivas cajas de texto
}

$('#btnActualizarTarea').click(function(){
		var parametros = 
		"caso=2"
		+"&nombreTarea="+$('#txtNomTarea').val()
		+"&descripcion="+$('#txtTareaDesc').val()
		+"&prioridad="+$('#selPriodidades').val()
		+"&fechaInicio="+$('#txtTareaInicio').val()
		+"&fechaEntrega="+$('#txtTareaEntrega').val()
		+"&cadenaDeUsuarios="+$('#selUsuarios').val()
		+"&codTarea="+codTareaSel
		+"&codProyecto="+proyectoTemp.codProyecto;
		
		console.log(parametros);
		$.ajax(
			{
				url: "../Web_site/controles-php/registrarTarea.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){
					alert(respuesta);
					cargarTareas(proyectoTemp.codProyecto);
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);  
	
		$('#frmNuevaTarea').modal('hide');
	$('#btnActualizarTarea').addClass("hidden");
	$('#btn-guardar-tarea').removeClass("hidden"); 
});

function initTablaTareas(){
	tblTareas = $('#tabla-tareas').DataTable(
				{
			        "scrollY":        "250px",
			        "scrollCollapse": true,
			        "paging":         false
			    }
			);
	
	$('#tabla-tareas tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			tblTareas.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});

	$('#tabla-tareas tbody').on( 'click', 'td', function () {  
		if( !isNaN(tblTareas.cell( this ).data()) ) {  
			 codTareaSel = tblTareas.cell( this ).data();
			 //alert(codTareaSel);
			 cargarTareaSeleccionada(codTareaSel);
		}
	});	
}

function cargarTareaSeleccionada(codigoTarea){
	var parametros = "caso=11&codTarea="+codigoTarea+"&codigo="+proyectoTemp.codProyecto;
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){ 	 
			console.log(respuesta);
            tareaTemp = JSON.parse(respuesta);
            $('#txtNomTarea').val(tareaTemp.nombreTarea);
            $('#txtTareaDesc').val(tareaTemp.descripcion);
            $('#selPriodidades').val(tareaTemp.prioridad).prop('selected', true); 
            $('#txtTareaInicio').val(tareaTemp.fechaInicio);
            $('#txtTareaEntrega').val(tareaTemp.fechaEntrega);
            //$('#selUsuarios').val(tareaTemp.responsable).prop('selected', true); 
            //ciclo para descomponer cadena y agragar lista de patrocinadores
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );       
}

function agregarTarea(codTarea, nombreTarea,prioridad,fechaInicio,fechaEntrega,responsable){
	tblTareas.row.add( [codTarea,
						nombreTarea,
						prioridad,
						fechaInicio,
						fechaEntrega,
						responsable ] ).draw( false );
}

function cargarTareas(codigoProyecto){
	tblTareas.clear().draw();
	var parametros = "caso=3&codigo="+codigoProyecto+"";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
          	if (respuesta!="null") {
      		  json = respuesta;
			  var json_array = json.split('*');
			  $('#tareasCount').html(json_array.length);
              for (var i = 0; i<json_array.length; i++) { 
				var objTarea = JSON.parse(json_array[i]);
				console.log("Esta es la prioridad: "+ objTarea.prioridad);
                agregarTarea(objTarea.codTarea,
							objTarea.nombreTarea,							
							objTarea.prioridad,
							objTarea.fechaInicio,
							objTarea.fechaEntrega,
							objTarea.responsable ); 
              }
          	}else{
				$('#tareasCount').html("0");
				//console.log("no hay tareas");
			  }              
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
	  );  
}

//****************funciones del panel de proyectos*****************
//evento click para crar nuevo proyecto

$('#btn-nuevoProyecto').click(function(){
	$('#btnCancelarGuardar').removeClass("hidden");
	$('#btnGuardarProyecto').removeClass("hidden");
	$('#btnActualizarProyecto').addClass("hidden");
	$('#btnCancelarEdicion').addClass("hidden");
	$('#txtcode').val("");
	$('#txtNomProyecto').val("");
	$('#txtLugar').val("");
	$('#txtFechaInicio').val("");
	$('#txtFechaFinal').val("");
	$('#txtResponsable').val("");
	$('#txtBeneficiario').val("");
	$('#txtCosto').val("");
	$('#txtDescripcion').val("");
	cargarEstados();
	cargarTiposProyecto();
	cargarPatrocinadores(); 
});

//Evento click para gregistrar un nuevo proyecto en la base de datos
$('#btnGuardarProyecto').click(function(){
	var parametros = 
	"codigoProyecto=0"
	+"&nombre="+$('#txtNomProyecto').val()
	+"&fechaInicio="+$('#txtFechaInicio').val()
	+"&fechaFinal="+$('#txtFechaFinal').val()
	+"&lugar="+$('#txtLugar').val()
	+"&costo="+$('#txtCosto').val()
	+"&beneficiario="+$('#txtBeneficiario').val()
	+"&codEstado="+$('#selEstados').val()
	+"&codTipoProyecto="+$('#selTipoProyecto').val()
	+"&descripcion="+$('#txtDescripcion').val()
	+"&codUsuario="+usuarioActual
	+"&patrocinadores="+$('#selPatrocinadores').val()
	+"&caso=1";
	console.log(parametros);

	$.ajax(
			{
				url: "../Web_site/controles-php/registrarProyecto.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){
						console.log(respuesta);
						cargarProyectos();
						//addProyecto(valor, $('#txtNomProyecto').val(), 'proceso');
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);   
	$('#frmNuevoProyecto').modal('hide');
});

// Evento click para actualizar la informacion de un proyecto.
$('#btnActualizarProyecto').click(function(){
	var parametros = 
	"codigoProyecto="+proyectoTemp.codProyecto
	+"&nombre="+$('#txtNomProyecto').val()
	+"&fechaInicio="+$('#txtFechaInicio').val()
	+"&fechaFinal="+$('#txtFechaFinal').val()
	+"&lugar="+$('#txtLugar').val()
	+"&costo="+$('#txtCosto').val()
	+"&beneficiario="+$('#txtBeneficiario').val()
	+"&codEstado="+$('#selEstados').val()
	+"&codTipoProyecto="+$('#selTipoProyecto').val()
	+"&descripcion="+$('#txtDescripcion').val()
	+"&codUsuario="+usuarioActual
	+"&patrocinadores="+$('#selPatrocinadores').val()
	+"&caso=2";
	//console.log(parametros);
	$.ajax(
			{
				url: "../Web_site/controles-php/registrarProyecto.php",
				data: parametros,
				method:"POST",
				success:function(respuesta){
					//console.log(respuesta); 
					alert(respuesta);
					cargarSeleccionado(proyectoTemp.codProyecto);
					cargarProyectos();
					cargarPatrocinadoresxProyecto(proyectoTemp.codProyecto);
				},
				error:function(){
					alert("Ocurrio un error");
				}
			}
		);   
	$('#frmNuevoProyecto').modal('hide');

});


function cargarSeleccionado(code){
	var parametros = "caso=2&codigo="+code+"";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
            proyectoTemp = JSON.parse(respuesta); 	
            //proyectoTemp = proyecto;
            //console.log(proyecto);
            $('#lblCodProyecto').html(proyectoTemp.codProyecto);
            $('#lblNomProyecto').html(proyectoTemp.nombreProyecto);
            $('#lblInicioProy').html(proyectoTemp.fechaInicio);
            $('#lblFinalProy').html(proyectoTemp.fechaFinal);
            $('#lblLugar').html(proyectoTemp.lugar);
            $('#lblBeneficiario').html(proyectoTemp.beneficiario);
            $('#lblCosto').html(proyectoTemp.costoEstimado);
            $('#lblDescripcion').val(proyectoTemp.descripcion);
			$('#lblEstado').html(proyectoTemp.estado); 
			$('#lblEstado').attr("name",proyectoTemp.codEstado);
			$('#lblResponsable').html(proyectoTemp.responsable);
			$('#lblTipoProyecto').html(proyectoTemp.tipoProyecto);
            //ciclo para descomponer cadena y agragar lista de patrocinadores
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  

}
//funcion para consultar todos los proyectos 
function cargarProyectos(){
	tblProyectos.clear().draw();
	var parametros = "caso=1&codigo=0";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	  //console.log(respuesta);
              json = respuesta;
              var json_array = json.split("-");
              for (var i = 0; i<json_array.length; i++) {
                var myObj = JSON.parse(json_array[i]);
                addProyecto(myObj.codProyecto,myObj.nombreProyecto, myObj.estado );
                //printProyectos(myObj.codProyecto, myObj.nombreProyecto);
              }
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );    

}

function addProyecto(cod, nombre, estado){ 
    tblProyectos.row.add( [cod,nombre,estado ] ).draw( false );
}
 
function inicializarTabla(){
	tblProyectos =  $('#tabla-proyectos').DataTable({
				"scrollY":        "290px",
				"scrollCollapse": true,
				"paging":         false,
				"dom": '<"toolbar-proy">frtip'
	});

	$("div.toolbar-proy").html( 
				);

	$('#tabla-proyectos tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			tblProyectos.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});

	$('#tabla-proyectos tbody').on( 'dblclick', 'tr', function () {
	    tblProyectos.$('tr.selected').removeClass('selected');
	    $(this).addClass('selected'); 
	} );


	$('#tabla-proyectos tbody').on( 'dblclick', 'td', function () { 
	       valor = tblProyectos.cell( this ).data();
	       if( !isNaN(valor) ) { 
			  cargarSeleccionado(valor);
			  cargarTareas(valor);
			  cargarMateriales(valor);
			  cargarColaboradores(valor);
			  cargarPatrocinadoresxProyecto(valor);
			  cargarColaboradoresSinRol(valor);
			   
			}
		});	
}

$(document).ready(function(){  
        
	//inicializar la pagina proyectos 
 	inicializarTabla();
 	cargarProyectos();
 	initTablaTareas();
	initTablaMateriales(); 
	initTablaColaboradores();
 	$('#tabla-usuarios').DataTable(
		{
	        "scrollY":        "250px",
	        "scrollCollapse": true,
	        "paging":         false,
	        "dom": '<"toolbar">frtip'
	    }       
	    
	);   

	$('#tabla-bitacora').DataTable(
			{
		        "scrollY":        "250px",
		        "scrollCollapse": true,
		        "paging":         false
		    }
		);

	$('#tabla-proyectos-designados').DataTable(
			{
		        "scrollY":        "250px",
		        "scrollCollapse": true,
		        "paging":         false,
		        "dom": '<"toolbar1">frtip'
		    }
		);
 

	$("div.toolbar1").html('<form class="form-inline">'
				+'<select class="form-group selectpicker" data-live-search="true" multiple data-max-options="1" multiple size="3">'
				+'<option>Proyecto 1</option><option>Proyecto 2</option><option>Proyecto 3</option></select>&nbsp; &nbsp; '	
			    +'<button type="submit" class="btn btn-success">Asignar</button></form>&nbsp;&nbsp;&nbsp;&nbsp;'
    					);
});

function validarFormularioMaterial(){
	var errores = 0;

	if (!noVacio($('#txtProveedor').val())) {
		$('#txtProveedor').addClass('btn-warning'); 
		errores++;
	}
	if (!noVacio($('#txtMaterial').val())) {
		$('#txtMaterial').addClass('btn-warning'); 
		errores++;
	}
	if (parseInt($('#txtMatUnidades').val())<=0) { 
		$('#txtMatUnidades').addClass('btn-warning'); 
		errores++;
	}
	if (parseFloat($('#txtPrecioUnidad').val())<=0) { 
		errores++;
	} 
	return errores;
}


//funciones de validacion 
function noVacio(valor){
	var isCorrect = /^[A-Za-z\'\s\.\,]+$/.test(valor);
	return isCorrect;
} 
