
function alerta(){
	alert("probandp");
}



$(document).ready( function () 
		{
			//inicializar la pagina proyectos
			var tblProyectos =
			    $('#tabla-proyectos').DataTable(
						{
					        "scrollY":        "320px",
					        "scrollCollapse": true,
					        "paging":         false,
					        "dom": '<"toolbarx">frtip'
					    }
					);

			    $('#tabla-proyectos tbody').on( 'click', 'tr', function () {
			        if ( $(this).hasClass('selected') ) {
			            $(this).removeClass('selected');
			        }
			        else {
			            tblProyectos.$('tr.selected').removeClass('selected');
			            $(this).addClass('selected');
			        }

			    } );

			    $('#tabla-proyectos tbody').on( 'dblclick', 'tr', function () {
		            tblProyectos.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected'); 
			    } );


			    //tblProyectos.row(':eq(1)', { page: 'current' }).select();

			     $('#tabla-proyectos tbody').on( 'dblclick', 'td', function () { 
			           valor = tblProyectos.cell( this ).data();
			           if( !isNaN(valor) ) {
						  alert("El numero es: "+valor); 
						}
	                   
   
	           } );



			     

			    $('#tabla-tareas').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    }
					);

			    $('#tabla-materiales').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    }
					);

			    $('#tabla-colaboradores').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    }
					);


			   


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

		  // Fin del documento
		});

