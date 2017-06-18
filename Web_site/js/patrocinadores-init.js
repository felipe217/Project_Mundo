

$(document).ready( function () 
	{
		//aplicar funciones a tabla patrocinadores
		var tblContribuciones =
		    $('#tabla-patrocinadores').DataTable(
					{
				        "scrollY":        "320px",
				        "scrollCollapse": true,
				        "paging":         false,
				        "dom": '<"toolbarx">frtip'
				    }
				);


		//aplicar funciones a tabla cotribuciones
		var tblContribuciones =
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

		//aplicar funciones a tabla desembolsos
		var tblContribuciones =
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

	// Fin del documento
	});