/* 
* tabla paraa cargar la lista de articulos
*/
$('.tablaArticulos').DataTable( {
    "ajax": "ajax/maestros/tabla-articulos.ajax.php?perfil="+$("#perfilOculto").val(),
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

$("#selectArticuloUrgencia").change(function(){
	$(".tablaUrgencias").DataTable().destroy();
	var articuloUrgencia=$(this).val();
	// console.log(articuloUrgencia);
	localStorage.setItem("articuloUrgencia", articuloUrgencia);
	cargarTablaUrgencias(localStorage.getItem("articuloUrgencia"));
});

/* 
* BOTON LIMPIAR MODELO CORTE
*/
$(".box").on("click", ".btnLimpiarArticuloUrgencia", function () {

	localStorage.removeItem("articuloUrgencia");
	localStorage.clear();
	window.location = "urgencias";
	
})

/*
* CARGAR TABLA URGENCIAS
*/
if (localStorage.getItem("articuloUrgencia") != null ) {
	$("#selectArticuloUrgencia").val(localStorage.getItem("articuloUrgencia"));
	$("#selectArticuloUrgencia").selectpicker("refresh");
	cargarTablaUrgencias(localStorage.getItem("articuloUrgencia"));
	// console.log("lleno");
	
}else{

	cargarTablaUrgencias(null);
	// console.log("vacio");

}


/* 
* tabla paraa cargar la lista de articulos - URGENCIA
*/

function cargarTablaUrgencias(articuloUrgencia){

	$('.tablaUrgencias').DataTable( {
		"ajax": "ajax/maestros/tabla-urgencias.ajax.php?perfil="+$("#perfilOculto").val()+"&articuloUrgencia=" + articuloUrgencia,
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

}







// ACTIVANDO-DESACTIVANDO ARTICULO
$(document).on("click",".btnActivarArt",function(){
	// Capturamos el id del usuario y el estado
	var idArticulo=$(this).attr("idArticulo");
	var estadoArticulo=$(this).attr("estadoArticulo");
	//console.log("idArticulo", idArticulo);
	//console.log("estadoArticulo", estadoArticulo); 
	//Realizamos la activación-desactivación por una petición AJAX
	var datos=new FormData();
	datos.append("activarId",idArticulo);
	datos.append("activarEstado",estadoArticulo);
	$.ajax({
	url:"ajax/articulos.ajax.php",
	type:"POST",
	data:datos,
	cache:false,
	contentType:false,
	processData:false,
	success:function(respuesta){
		if(window.matchMedia("(max-width:767px)").matches){
			swal({
				type: "success",
				title: "¡Ok!",
				text: "¡La información fue actualizada con éxito!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
			}).then((result)=>{
				if(result.value){
					window.location="articulos";}
			});}}
	});
	//Cambiamos el estado del botón físicamente
	if(estadoArticulo=='Descontinuado'){
	$(this).removeClass("btn-success");
	$(this).addClass("btn-danger");
	$(this).html("Inactivo");
	$(this).attr("estadoArticulo","Activo");}
	else{
	$(this).addClass("btn-success");
	$(this).removeClass("btn-danger");
	$(this).html("Activo");
	$(this).attr("estadoArticulo","Descontinuado");}
});



/*=============================================
CAPTURANDO LOS DATOS PARA ASIGNAR CÓDIGO
=============================================*/

$("#nuevoModelo").change(function(){

	var nuevoModelo = document.getElementById("nuevoModelo").value;
	var nuevoColor = document.getElementById("nuevoColor").value;
	var nuevaTalla = document.getElementById("nuevaTalla").value;

	var nuevoCodigo = nuevoModelo+nuevoColor+nuevaTalla

	/* console.log("nuevoCodigo", nuevoCodigo); */

	$("#nuevoCodigo").val(nuevoCodigo);

})

$("#nuevoColor").change(function(){

	var nuevoModelo = document.getElementById("nuevoModelo").value;
	var nuevoColor = document.getElementById("nuevoColor").value;
	var nuevaTalla = document.getElementById("nuevaTalla").value;

	var nuevoCodigo = nuevoModelo+nuevoColor+nuevaTalla

	/* console.log("nuevoCodigo", nuevoCodigo); */

	$("#nuevoCodigo").val(nuevoCodigo);

})

$("#nuevaTalla").change(function(){

	var nuevoModelo = document.getElementById("nuevoModelo").value;
	var nuevoColor = document.getElementById("nuevoColor").value;
	var nuevaTalla = document.getElementById("nuevaTalla").value;

	var nuevoCodigo = nuevoModelo+nuevoColor+nuevaTalla

	/* console.log("nuevoCodigo", nuevoCodigo); */

	$("#nuevoCodigo").val(nuevoCodigo);

})

/*=============================================
CAPTURANDO LOS DATOS PARA ASIGNAR NOMBRE DEL COLOR
=============================================*/

$("#nuevoColor").change(function(){

	var nuevoColor = document.getElementById("nuevoColor");
	var nuevoColorNombre = nuevoColor.options[nuevoColor.selectedIndex].text;
	
	var tamano = nuevoColorNombre.length;
	var color = nuevoColorNombre.substring(5,tamano);

/* 	console.log("nuevoColor", nuevoColorNombre);
	console.log("tamano", tamano);
	console.log("color", color); */

	$("#color").val(color);


})

/*=============================================
CAPTURANDO LOS DATOS PARA ASIGNAR NOMBRE DE LA TALLA
=============================================*/

$("#nuevaTalla").change(function(){

	var nuevaTalla = document.getElementById("nuevaTalla");
	var talla = nuevaTalla.options[nuevaTalla.selectedIndex].text;
	
/* 	console.log("nuevaTalla", talla); */

	$("#talla").val(talla);


})


/*=============================================
EDITAR ARTICULO
=============================================*/

$(".tablaArticulos tbody").on("click", "button.btnEditarArticulo", function(){

	var articulo = $(this).attr("articulo");

	/* console.log("articulo", articulo); */

	var datos = new FormData();
	datos.append("articulo", articulo);
	
	$.ajax({

		url:"ajax/articulos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			/* para sacar la marca */

            $("#editarMarca").val(respuesta["id_marca"]);
			$("#editarMarca").selectpicker('refresh');

			/* para sacar el color */

			var datosColor = new FormData();
			datosColor.append("idColor",respuesta["cod_color"]);
			/* console.log("idColor", respuesta["cod_color"]) */

			$.ajax({

				url:"ajax/colores.ajax.php",
				method: "POST",
				data: datosColor,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta){
					
					/* console.log("respuesta", respuesta); */

					$("#editarColor").val(respuesta["id"]);
					$("#editarColor").html(respuesta["nom_color"]);
	
				}
	
			})			

			//console.log("respuesta", respuesta);
			
			$("#editarCodigo").val(respuesta["articulo"]);

			$("#editarModelo").val(respuesta["modelo"]);

			$("#editarDescripcion").val(respuesta["nombre"]);

			$("#editarTalla").val(respuesta["cod_talla"]);
			$("#editarTalla").html(respuesta["talla"]);

			$("#editarTipo").val(respuesta["tipo"]);
			$("#editarTipo").html(respuesta["tipo"]);

			if(respuesta["imagen"] != ""){

				$("#imagenActual").val(respuesta["imagen"]);

				$(".previsualizar").attr("src",  respuesta["imagen"]);

			}

  
   
		}
  
	})	



})


/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaArticulos tbody").on("click", "button.btnEliminarArticulo", function(){

	var idArticulo = $(this).attr("idArticulo");
	var articulo = $(this).attr("articulo");
	var imagen = $(this).attr("imagen");

	/* console.log("idArticulo", idArticulo); */

	swal({

		title: '¿Está seguro de borrar el articulo?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=articulos&idArticulo="+idArticulo+"&imagen="+imagen+"&articulo="+articulo;

        }


	})

})

//Reporte de Articulos
$(".box").on("click", ".btnReporteArt", function () {
    window.location = "vistas/reportes_excel/rpt_articulo.php";
  
})