

//variables globales
var cuerpo="";
var tblProyectos; //tabla lateral de proyectos
var tblTareas; //tabla de tareas
var tblMateriales; //tabla materiales
var tblColaboradores; //tabla colaboradores
var valor = 0;
var codTareaSel =0;
var usuarioActual=1;
var proyectoTemp; 
var valor = 0;
var codTareaSel =0;
var usuarioActual=1; 

function cargarPatrocinadores(){
	var parametros = "caso=8&codigo=1";
	$.ajax(
		{
			url: "../Web_site/controles-php/proyectosControl.php",
			data: parametros,
			method: "POST",
			dataType: "json",
			success: function(respuesta){ 
				console.log(respuesta);
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
			if (respuesta != 'null') {
				var listapatrocinadores = "<label>Patrocinadores:</label><br>";
				for(var i=0; i<respuesta.length; i++){
					listapatrocinadores = listapatrocinadores + respuesta[i].nombre+"<br>";
				}
				console.log("patrocinadores:"+listapatrocinadores);
				$('#tr-patrocinadoresxproyecto').html(listapatrocinadores);
			}else
				console.log("No hay patrocinadores");
			
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
function editarProyecto(){
	console.log("Valores del select: "+$('#selPatrocinadores').val());
	$('#txtcode').val(proyectoTemp.codigo);
	$('#txtNomProyecto').val(proyectoTemp.nombreProyecto);
	$('#txtLugar').val(proyectoTemp.lugar);
	$('#txtFechaInicio').val(proyectoTemp.fechaInicio);
	$('#txtFechaFinal').val(proyectoTemp.fechaFinal);
	$('#txtResponsable').val(proyectoTemp.responsable);
	$('#txtBeneficiario').val(proyectoTemp.beneficiario);
	$('#txtCosto').val(proyectoTemp.costoEstimado);
	$('#txtDescripcion').val(proyectoTemp.descripcion);
	$('#selEstados').val("1").prop('selected', true); 
	console.log("Valores del select: "+$('#selPatrocinadores').val());
}
//****************funciones del panel de proyectos: tabla colaboradores*****************
function initTablaColaboradores(){
	tblColaboradores = $('#tabla-colaboradores').DataTable(
		{
	        "scrollY":        "250px",
	        "scrollCollapse": true,
	        "paging":         false
	    }
	);
}
function addColaborador(codUsuario,nombreUsuario,tipoUsuario,departamento,cargo,rol ){
	
	tblColaboradores.row.add( [ codUsuario,
								nombreUsuario,
								tipoUsuario,
								departamento,
								cargo,
								rol ] ).draw( false );
}

function cargarColaboradores(codigoProyecto){
	tblColaboradores.clear().draw();
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
              for (var i = 0; i<json_array.length; i++) { 
                var objColaborador = JSON.parse(json_array[i]);
                addColaborador(objColaborador.codUsuario,
							objColaborador.nombreUsuario,
							objColaborador.tipoUsuario,
							objColaborador.departamento,
							objColaborador.cargo,
							objColaborador.rol );
              }
          	}else
          		alert("no hay colaboradores");               
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}


//****************funciones del panel de proyectos: tabla materiales*****************
function initTablaMateriales(){
	tblMateriales = $('#tabla-materiales').DataTable(
			{
		        "scrollY":        "250px",
		        "scrollCollapse": true,
		        "paging":         false
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
          		alert("no hay tareas");
              
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}

//****************funciones del panel de proyectos: tabla tareas*****************
function initTablaTareas(){
	tblTareas = $('#tabla-tareas').DataTable(
				{
			        "scrollY":        "250px",
			        "scrollCollapse": true,
			        "paging":         false
			    }
			);
}

function agregarTarea(codTarea, nombreTarea,descripcion,prioridad,fechaInicio,fechaEntrega){
	tblTareas.row.add( [codTarea,
						nombreTarea,
						descripcion,
						prioridad,
						fechaInicio,
						fechaEntrega ] ).draw( false );
}
 
//****************funciones del panel de proyectos: tabla materiales*****************
function initTablaMateriales(){
	tblMateriales = $('#tabla-materiales').DataTable(
			{
		        "scrollY":        "250px",
		        "scrollCollapse": true,
		        "paging":         false
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
      		 
              var json_array = json.split('*');
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
          		alert("no hay materiales ");
              
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}
//****************funciones del panel de proyectos: tabla tareas*****************
function initTablaTareas(){
	tblTareas = $('#tabla-tareas').DataTable(
				{
			        "scrollY":        "250px",
			        "scrollCollapse": true,
			        "paging":         false
			    }
			);
}

function agregarTarea(codTarea, nombreTarea,descripcion,prioridad,fechaInicio,fechaEntrega){
	tblTareas.row.add( [codTarea,
						nombreTarea,
						descripcion,
						prioridad,
						fechaInicio,
						fechaEntrega ] ).draw( false );
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
              for (var i = 0; i<json_array.length; i++) { 
                var objTarea = JSON.parse(json_array[i]);
                agregarTarea(objTarea.codTarea,
							objTarea.nombreTarea,
							objTarea.descripcion,
							objTarea.prioridad,
							objTarea.fechaInicio,
							objTarea.fechaEntrega );
              }
          	}else
          		alert("no hay tareas");
              
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  
}

//****************funciones del panel de proyectos*****************
function cargarSeleccionado(code){
	var parametros = "caso=2&codigo="+code+"";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
            var proyecto = JSON.parse(respuesta); 	
            proyectoTemp = proyecto;
            //console.log(proyecto);
            $('#lblCodProyecto').html(proyecto.codProyecto);
            $('#lblNomProyecto').html(proyecto.nombreProyecto);
            $('#lblInicioProy').html(proyecto.fechaInicio);
            $('#lblFinalProy').html(proyecto.fechaFinal);
            $('#lblLugar').html(proyecto.lugar);
            $('#lblBeneficiario').html(proyecto.beneficiario);
            $('#lblCosto').html(proyecto.costoEstimado);
            $('#lblDescripcion').html(proyecto.descripcion);
			$('#lblEstado').html(proyecto.estado); 
			$('#lblEstado').attr("name",proyecto.estado);
            $('#lblResponsable').html(proyecto.responsable);
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
	var parametros = "caso=1&codigo=0";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	/*console.log(respuesta);*/
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
function inicializarTabla(){
	tblProyectos =  $('#tabla-proyectos').DataTable({
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
	});

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

	//seleccionar proyecto para ver sus datos
	$('#tabla-proyectos tbody').on( 'dblclick', 'td', function () { 
				 valor = tblProyectos.cell( this ).data();
				 console.log("cargar tablas");
	       if( !isNaN(valor) ) {  
			  	cargarSeleccionado(valor); 
			  	cargarTareas(valor); 
					cargarMateriales(valor); 
					cargarColaboradores(valor); 
					cargarPatrocinadoresxProyecto(valor);
			}
		});	
}

function addProyecto(cod, nombre, estado){ 
    tblProyectos.row.add( [cod,nombre,estado ] ).draw( false );
}

//Eventos click
$('#btnGuardarProyecto').click(function(){ 
	var parametros = 
	"nombre="+$('#txtNomProyecto').val()
	+"&fechaInicio="+$('#txtFechaInicio').val()
	+"&fechaFinal="+$('#txtFechaFinal').val()
	+"&lugar="+$('#txtLugar').val()
	+"&costo="+$('#txtCosto').val()
	+"&beneficiario="+$('#txtBeneficiario').val()
	+"&codEstado="+$('#selEstados').val()
	+"&codTipoProyecto="+$('#selTipoProyecto').val()
	+"&descripcion="+$('#txtDescripcion').val()
	+"&codUsuario="+usuarioActual+""
	+"&patrocinadores="+$('#selPatrocinadores').val();
	console.log($('#selPatrocinadores').val());
	console.log(parametros);
/* 	$.ajax(
	        {
	          url: "../Web_site/controles-php/registrarProyecto.php",
	          data: parametros,
	          method:"POST",
	          success:function(respuesta){
	          	 alert(respuesta);
	          },
	          error:function(){
	            alert("Ocurrio un error");
	          }
	        }
	      );    */

	addProyecto(valor, $('#txtNomProyecto').val(), 'proceso');
	$('#frmNuevoProyecto').modal('hide');
});


$('#btn-nuevoProyecto').click(function(){
	cargarEstados();
	cargarTiposProyecto();
	cargarPatrocinadores(); 
});

//evento click para agregar nueva tarea
/* $('#btn-guardar-tarea').click(function(){ 
	var parametros = 
	"nombreTarea="+$('#txtNomTarea').val()
	+"&fechaInicio="+$('#txtFechaInicio').val()
	+"&fechaFinal="+$('#txtFechaFinal').val()
	+"&lugar="+$('#txtLugar').val()
	+"&costo="+$('#txtCosto').val()
	+"&beneficiario="+$('#txtBeneficiario').val()
	+"&codEstado="+$('#selEstados').val()
	+"&codTipoProyecto="+$('#selTipoProyecto').val()
	+"&descripcion="+$('#txtDescripcion').val()
	+"&codUsuario="+usuarioActual+"";
	console.log(parametros);
	$.ajax(
	        {
	          url: "../Web_site/controles-php/registrarTarea.php",
	          data: parametros,
	          method:"POST",
	          success:function(respuesta){
	          	 alert(respuesta);
	          },
	          error:function(){
	            alert("Ocurrio un error");
	          }
	        }
	      );   

	addProyecto(valor, $('#txtNomProyecto').val(), 'proceso');
	$('#frm').modal('hide');
}); */



//funciones de consultas 
function getCodigoEstado(){
	var codigoConsultado =0;
	var parametros = "";
	$.ajax(
	        {
	          url: "../Web_site/controles-php/registrarTarea.php",
	          data: parametros,
	          method:"POST",
	          success:function(respuesta){
	          	 alert(respuesta);
	          },
	          error:function(){
	            alert("Ocurrio un error");
	          }
	        }
		  );    
	
	return codigoConsultado;
} 

//****************funciones del panel de proyectos*****************
function cargarSeleccionado(code){
	var parametros = "caso=2&codigo="+code+"";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
            var proyecto = JSON.parse(respuesta); 	
            console.log(proyecto);
            $('#lblCodProyecto').html(proyecto.codProyecto);
            $('#lblNomProyecto').html(proyecto.nombreProyecto);
            $('#lblInicioProy').html(proyecto.fechaInicio);
            $('#lblFinalProy').html(proyecto.fechaFinal);
            $('#lblLugar').html(proyecto.lugar);
            $('#lblBeneficiario').html(proyecto.beneficiario);
            $('#lblCosto').html(proyecto.costoEstimado);
            $('#lblDescripcion').html(proyecto.descripcion);
            $('#lblEstado').html(proyecto.estado); 
            $('#lblResponsable').html(proyecto.responsable);
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  

}

 
//funcion para consultar todos los proyectos 
function cargarProyectos(){
	var parametros = "caso=1&codigo=0";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	/*console.log(respuesta);*/
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


function inicializarTabla(){
	tblProyectos =  $('#tabla-proyectos').DataTable({
					        "scrollY":        "250px",
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
			}
		});	
}

function addProyecto(cod, nombre, estado){ 
    tblProyectos.row.add( [cod,nombre,estado ] ).draw( false );
}


$('#btnGuardarProyecto').click(function(){
	var parametros = 
	"nombre="+$('#txtNomProyecto').val()
	+"&fechaInicio="+$('#txtFechaInicio').val()
	+"&fechaFinal="+$('#txtFechaFinal').val()
	+"&lugar="+$('#txtLugar').val()
	+"&costo="+$('#txtCosto').val()
	+"&beneficiario="+$('#txtBeneficiario').val()
	+"&codEstado="+$('#selEstados').val()
	+"&codTipoProyecto="+$('#selTipoProyecto').val()
	+"&descripcion="+$('#txtDescripcion').val()
	+"&codUsuario="+usuarioActual+"";
	console.log(parametros);

	$.ajax(
	        {
	          url: "../Web_site/controles-php/registrarProyecto.php",
	          data: parametros,
	          method:"POST",
	          success:function(respuesta){
	          	 alert(respuesta);
	          },
	          error:function(){
	            alert("Ocurrio un error");
	          }
	        }
	      );   

	addProyecto(valor, $('#txtNomProyecto').val(), 'proceso');
	$('#frmNuevoProyecto').modal('hide');
});

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