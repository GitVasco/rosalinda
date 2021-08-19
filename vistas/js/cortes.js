/*
* CARGAR TABLA ALMACEN DE CORTE
*/
if (localStorage.getItem("modeloCorte") != null) {
	$("#selectModeloCorte").val(localStorage.getItem("modeloCorte"));
	$("#selectModeloCorte").selectpicker("refresh");
	cargarTablaEnCortes(localStorage.getItem("modeloCorte"));
	// console.log("lleno");
	
}else{

	cargarTablaEnCortes(null);
	// console.log("vacio");

}

function cargarTablaEnCortes(modeloCorte) {
	$('.tablaCortes').DataTable({
		"ajax": "ajax/produccion/tabla-cortes.ajax.php?perfil=" + $("#perfilOculto").val()+ "&modeloCorte=" + modeloCorte,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[0, "asc"]],
		"pageLength": 20,
		"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}

	});
}
/*
* MANDAR A TALLER
*/

$(".tablaCortes tbody").on("click", "button.btnMandarTaller", function () {

	var articulo = $(this).attr("articulo");
	//console.log("articulo", articulo);
	

	var datos = new FormData();
	datos.append("articulo", articulo);

	$.ajax({

		url: "ajax/cortes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			/* para sacar la marca */
			//console.log("respuesta", respuesta);

			$("#nuevoArticulo").val(respuesta["articulo"]);
			$("#nuevoNombre").val(respuesta["nombre"]);
			$("#nuevoModelo").val(respuesta["modelo"]);
			$("#nuevoColor").val(respuesta["color"]);
			$("#nuevaTalla").val(respuesta["talla"]);
			$("#almCorte").val(respuesta["alm_corte"]);
			$("#nuevoAlmCorte").val(respuesta["alm_corte"]);
			$("#nuevoAlmCorte").attr("max", respuesta["alm_corte"]);
			$("#precio_doc").val(respuesta["precio_doc"]);
			$("#tiempo_stand").val(respuesta["tiempo_stand"]);

		}

	})

})

/*
* calcular totales
*/
function cancularTotales() {

	var realCorte = document.getElementById("almCorte").value;
	var corte = document.getElementById("nuevoAlmCorte").value;
	var precio_doc = document.getElementById("precio_doc").value;
	var tiempo_stand = document.getElementById("tiempo_stand").value;

	var precio_total = precio_doc / 12 * corte;
	//console.log("precio_total", precio_total);

	var tiempo_total = tiempo_stand / 60 * corte;
	//console.log("tiempo_total", tiempo_total);

	var nuevoCorte = realCorte - corte;
	//console.log("nuevoCorte", nuevoCorte);

	$("#precio_total").val(precio_total);
	$("#tiempo_total").val(tiempo_total);
	$("#nuevoCorte").val(nuevoCorte);

}

$("#nuevoTaller").change(function(){

	cancularTotales();

})

$("#nuevoTrabajador").change(function(){

	cancularTotales();

})

$("#nuevoAlmCorte").change(function(){

	cancularTotales();

})

$("#selectModeloCorte").change(function(){
	$(".tablaCortes").DataTable().destroy();
	var modeloCorte=$(this).val();
	localStorage.setItem("modeloCorte", modeloCorte);
	cargarTablaEnCortes(localStorage.getItem("modeloCorte"));
	
});

/* 
* BOTON LIMPIAR MODELO CORTE
*/
$(".box").on("click", ".btnLimpiarModeloCorte", function () {

	localStorage.removeItem("modeloCorte");
	localStorage.clear();
	window.location = "en-cortes";
	
})


$("#imprimirTicket").change(function(){
	if(this.checked == false){
		$(".campoSector").removeClass("hidden");
	}else{
		$(".campoSector").addClass("hidden");
	}
})

