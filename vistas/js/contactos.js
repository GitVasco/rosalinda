/* 
* tabla paraa cargar la lista de contactos
*/
$('.tablaContactos').DataTable( {
    "ajax": "ajax/tickets/tabla-contactos.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}    
} );

/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablaContactos").on("click", ".btnEditarPerfil", function () {

	var idUsuario = $(this).attr("idUsuario");
	/* console.log("idUsuario", idUsuario); */

	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);
            
            $("#passwordActual").val(respuesta["password"]);

            if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}else{

				$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");

			}

		}

	});
})

/* 
* BOTON PARA IR A LOS MENSAJES
*/
$(".tablaContactos").on("click", ".btnChat", function () {

    var de = $(this).attr("de");
    var para = $(this).attr("para");
    console.log("de", de, "para", para);
    
    var datos = new FormData();
	datos.append("de", de);
    datos.append("para", para);
    
    $.ajax({

		url: "ajax/mensajes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

            //console.log(respuesta);
            window.location = "index.php?ruta=mensajes&idUsuario=" + de;
		
		}
	})
  
})