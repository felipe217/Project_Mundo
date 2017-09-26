

//variables globales
var cuerpo="";
var tblProyectos; //tabla lateral de proyectos
var tblTareas; //tabla de tareas
var tblMateriales; //tabla materiales
var tblColaboradores; //tabla colaboradores
var valor = 0;
var codTareaSel =0;
var usuarioActual=1;



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
      		  tblColaboradores.clear().draw();
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

function cargarTareas(codigoProyecto){
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
      		  tblTareas.clear().draw();
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


	$('#tabla-proyectos tbody').on( 'dblclick', 'td', function () { 
	       valor = tblProyectos.cell( this ).data();
	       if( !isNaN(valor) ) { 
			  cargarSeleccionado(valor);
			  cargarTareas(valor);
			  cargarMateriales(valor);
			  cargarColaboradores(valor);
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

$(document).ready( function () 
		{			 
			//inicializar la pagina proyectos
				
			 	inicializarTabla();
			 	cargarProyectos();
			 	initTablaTareas();
			 	initTablaMateriales();
			 	initTablaColaboradores();


	//Funciones de la tabla de proyectos	 	
	

	//Funciones de lta tabla de tareas

    

    //Funciones de la tabla de materiales  
	            //Para la página de usuarios
	            $('#tabla-usuarios').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false,
					        "dom": '<"toolbar">frtip'
					    }       
					    
					);

	            // $("div.toolbar").html('<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmNuevoProyecto"> '
	            // 					 +'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo	</button> &nbsp; &nbsp; &nbsp;'
	            // 					);

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
		   //cargar consultas:
 		  // Fin del documento
		});


