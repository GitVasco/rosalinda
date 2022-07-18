/* 
* CARGAR TABLA TARJETAS
*/
$('.tablaTarjetas').DataTable({
	"ajax": "ajax/tarjetas/tabla-tarjetas.ajax.php?perfil=" + $("#perfilOculto").val(),
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[4, "asc"]],
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

/* 
*CARGAR LA TABLA DE MATERIA PRIMA EN CREAR TARJETA
*/
$('.tablaMateriaPrimaTarjetas').DataTable( {
    "ajax": "ajax/tarjetas/tabla-materiaprimaTarjetas.ajax.php",
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

/* 
* AGREGANDO MATERIA PRIMA A LA TARJETA DESDE LA TABLA
*/
$(".tablaMateriaPrimaTarjetas tbody").on("click", "button.agregarMP", function () {

	var idMateriaPrima = $(this).attr("idMateriaPrima");
  
	/* console.log("idMateriaPrima", idMateriaPrima); */
  
	$(this).removeClass("btn-primary agregarMP");
  
	$(this).addClass("btn-default");
  
  
	var datos = new FormData();
	datos.append("idMateriaPrima", idMateriaPrima);
  
	$.ajax({
  
	  url: "ajax/materiaprima.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
	  contentType: false,
	  processData: false,
	  dataType: "json",
	  success: function (respuesta) {
  
/* 		console.log("respuesta", respuesta); */

		var codigo=respuesta["codpro"];
		var descripcion = respuesta["descripcion"];
		var stock = respuesta["CodAlm01"];
		var precio = respuesta["cospro"];

/* 		console.log("codigo",codigo);
		console.log("descripcion",descripcion);
		console.log("stock",stock);
		console.log("precio",precio); */

		/* agregar campos */

		$(".nuevaMateriaPrima").append(

			'<div class="row" style="padding:5px 15px">' +
	
				'<!-- Descripción del producto -->' +
		
				'<div class="col-xs-6" style="padding-right:0px">' +
		
					'<div class="input-group">' +
			
						'<span class="input-group-addon input-sm"><button type="button" class="btn btn-danger btn-xs quitarMP" idMateriaPrima="' + idMateriaPrima + '"><i class="fa fa-times"></i></button></span>' +
				
						'<input type="text" class="form-control input-sm nuevaDescripcionProducto" idMateriaPrima="' + idMateriaPrima + '" name="agregarMP" value="' + descripcion + '" codigoP="'+codigo+'" readonly required>' +
			
					'</div>' +
		
				'</div>' +

				'<!-- Tejido Principal-->' +
		
				'<div class="col-xs-2">' +
		
					'<input type="text" class="form-control input-sm tejidoPrincipal" name="tejidoPrincipal" value="no" required>' +
		
				'</div>' +
		
				'<!-- Cantidad del producto -->' +
		
				'<div class="col-xs-2">' +
		
					'<input type="number" class="form-control input-sm nuevaCantidadProducto" name="nuevaCantidadProducto" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" step="any" required>' +
		
				'</div>' +
		
				'<!-- Precio del producto -->' +
		
				'<div class="col-xs-2 ingresoPrecio" style="padding-left:0px">' +
		
					'<div class="input-group">' +
			
						'<span class="input-group-addon"><i class="fa fa-money"></i></span>' +
				
						'<input type="text" class="form-control input-sm nuevoPrecioProducto" precioReal="' + precio + '" name="nuevoPrecioProducto" value="' + precio + '" readonly required>' +
			
					'</div>' +
		
				'</div>' +
	
			'</div>');
  
			/* AQUI AGREGAR SUMARTOTALPRECIOST - AGREGAR IMPUESTOS - LISTAR PRODUCTOS */

			sumarTotalPreciosT();

			$(".nuevoPrecioProducto").number(true, 6);

			agregarImpuestoT();

			listarMP();

  
	  }


  
	})
  
  });

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaMateriaPrimaTarjetas").on("draw.dt", function () {

	/* console.log("tabla"); */

	if (localStorage.getItem("quitarMP") != null) {

		var listaIdMateriaPrima = JSON.parse(localStorage.getItem("quitarMP"));

		for (var i = 0; i < listaIdMateriaPrima.length; i++) {

			$("button.recuperarBoton[idMateriaPrima='" + listaIdMateriaPrima[i]["idMateriaPrima"] + "']").removeClass('btn-default');

			$("button.recuperarBoton[idMateriaPrima='" + listaIdMateriaPrima[i]["idMateriaPrima"] + "']").addClass('btn-primary agregarMP');

		}


	}

})

/* 
* QUITAR MATERIA PRIMA DE LA TARJETA Y RECUPERAR BOTÓN
*/
var idQuitarMateriaPrima = [];

localStorage.removeItem("quitarMP");

$(".formularioMateriaPrima").on("click", "button.quitarMP", function () {

  /* console.log("boton"); */

  $(this).parent().parent().parent().parent().remove();

  var idMateriaPrima = $(this).attr("idMateriaPrima");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarMP") == null) {

    idQuitarMateriaPrima = [];

  } else {

    idQuitarMateriaPrima.concat(localStorage.getItem("quitarMP"))

  }

  idQuitarMateriaPrima.push({
    "idMateriaPrima": idMateriaPrima
  });

  localStorage.setItem("quitarMP", JSON.stringify(idQuitarMateriaPrima));

  $("button.recuperarBoton[idMateriaPrima='" + idMateriaPrima + "']").removeClass('btn-default');

  $("button.recuperarBoton[idMateriaPrima='" + idMateriaPrima + "']").addClass('btn-primary agregarMP');


  if ($(".nuevaMateriaPrima").children().length == 0) {

    $("#nuevoImpuestoTarjeta").val(0);
    $("#nuevoTotalTarjeta").val(0);
    $("#totalTarjeta").val(0);
    $("#nuevoTotalTarjeta").attr("total", 0);

  } else {

/* AQUI AGREGAR SUMARTOTALPRECIOST - AGREGAR IMPUESTOS - LISTAR PRODUCTOS */


	sumarTotalPreciosT();

	agregarImpuestoT();

	listarMP();

  }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioMateriaPrima").on("change", "input.nuevaCantidadProducto", function () {

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  
	/* console.log("precio", precio.val()); */
  
	var precioFinal = $(this).val() * precio.attr("precioReal");
  
  
	precio.val(precioFinal);


	var precioFinal = $(this).val() * precio.attr("precioReal");

	precio.val(precioFinal);
  
  
/* AQUI AGREGAR SUMARTOTALPRECIOST - AGREGAR IMPUESTOS - LISTAR PRODUCTOS */

	sumarTotalPreciosT();

	agregarImpuestoT();
	
	listarMP();
  
  })

/* 
* MODIFICAR SI EN TEJIDO PRINCIPAL
*/  

$(".formularioMateriaPrima").on("change", "input.tejidoPrincipal", function () {

	/* var tejido = $(this); */
  
	/* console.log("tejido", tejido.val()); */

	listarMP();
  
  })

/* 
* SUMAR TODOS LOS PRECIOS
*/
function sumarTotalPreciosT() {

	var precioItem = $(".nuevoPrecioProducto");
  
	var arraySumaPrecioT = [];
  
	for (var i = 0; i < precioItem.length; i++) {
  
	  arraySumaPrecioT.push(Number($(precioItem[i]).val()));
  
  
	}
  
	  /* console.log("arraySumaPrecioT", arraySumaPrecioT); */
  
	function sumaArrayPrecios(total, numero) {
  
	  return total + numero;
  
	}
  
	var sumaTotalPrecio = arraySumaPrecioT.reduce(sumaArrayPrecios);
  
	  /* console.log("sumaTotalPrecio", sumaTotalPrecio); */
  
	$("#nuevoTotalTarjeta").val(sumaTotalPrecio);
		$("#totalTarjeta").val(sumaTotalPrecio);
	$("#nuevoTotalTarjeta").attr("total", sumaTotalPrecio);
  
  
  }

/* 
* FUNCIÓN AGREGAR IMPUESTO
*/
function agregarImpuestoT() {

	var impuesto = $("#nuevoImpuestoTarjeta").val();
	var precioTotal = $("#nuevoTotalTarjeta").attr("total");
  
	var precioImpuesto = Number(precioTotal * impuesto / 100);
  
	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
  
	$("#nuevoTotalTarjeta").val(totalConImpuesto);
  
	$("#totalTarjeta").val(totalConImpuesto);
  
	$("#nuevoPrecioImpuesto").val(precioImpuesto);
  
	$("#nuevoPrecioNeto").val(precioTotal);
  
  }
  
/* 
* CUANDO CAMBIA EL IMPUESTO
*/
$("#nuevoImpuestoTarjeta").change(function () {

	agregarImpuestoT();

});

/* 
* FORMATO AL PRECIO FINAL
*/
$("#nuevoTotalTarjeta").number(true, 6);

/* 
* LISTAR TODAS LAS MATERIAS PRIMAS
*/
function listarMP() {

	var listaMP = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var tejido = $(".tejidoPrincipal");
  
	var cantidad = $(".nuevaCantidadProducto");
  
	var precio = $(".nuevoPrecioProducto");
  
	for (var i = 0; i < descripcion.length; i++) {
  
	  listaMP.push({
		"id": $(descripcion[i]).attr("idMateriaPrima"),
		"codigo":$(descripcion[i]).attr("codigoP"),
		"descripcion": $(descripcion[i]).val(),
		"tejido": $(tejido[i]).val(),
		"cantidad": $(cantidad[i]).val(),
		"precio": $(precio[i]).attr("precioReal"),
		"total": $(precio[i]).val()
	  })
  
	}

	/* console.log("listaMP", JSON.stringify(listaMP)); */
  
	$("#listaMP").val(JSON.stringify(listaMP));
  
  }

/* 
* BOTON EDITAR TARJETA
*/
$(".tablaTarjetas").on("click", ".btnEditarTarjeta", function () {

	var idTarjeta = $(this).attr("idTarjeta");

  window.location = "index.php?ruta=editar-tarjeta&idTarjeta=" + idTarjeta;
  
})

/* 
* FORMATO PARA LOS NUMEROS EN LAS CAJAS
*/
$(".nuevoPrecioProducto").number(true,6);
$("#totalTarjeta").number(true,6);

/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO LA MATERIA PRIMA YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarProductoT() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idMateriaPrima = $(".quitarMP");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTablaT = $(".tablaMateriaPrimaTarjetas tbody button.agregarMP");
	console.log(botonesTablaT.length);

	//Recorremos en un ciclo para obtener los diferentes idMateriaPrima que fueron agregados a la venta
	for (var i = 0; i < idMateriaPrima.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idMateriaPrima[i]).attr("idMateriaPrima");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaT.length; j++) {

			if ($(botonesTablaT[j]).attr("idMateriaPrima") == boton) {

				$(botonesTablaT[j]).removeClass("btn-primary agregarMP");
				$(botonesTablaT[j]).addClass("btn-default");

			}
		}

	}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$('.tablaMateriaPrimaTarjetas').on('draw.dt', function () {

	quitarAgregarProductoT();

})

/* 
* BORRAR LA TARJETA
*/
$(".tablaTarjetas").on("click", ".btnEliminarTarjeta", function () {

	var idTarjeta = $(this).attr("idTarjeta");

	swal({
		type: "warning",
		title: "Advertencia",
		text: "¿Está seguro de eliminar la Tarjeta? ¡Si no está seguro, puede cancelar la acción!",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: "¡Si, eliminar Tarjeta!",
		cancelButtonText: "Cancelar",
	}).then(function (result) {
		if (result.value) {
			var datos = new FormData();
			datos.append("idTarjeta", idTarjeta);
			$.ajax({
				url: "ajax/tarjetas.ajax.php",
				type: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function (respuesta) {

					/* console.log("respuestaaaaaa", respuesta); */

					if (respuesta == "ok") {
						swal({
							type: "success",
							title: "¡Ok!",
							text: "¡La información fue Eliminada con éxito!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result) => {
							if (result.value) {
								window.location = "tarjetas";
							}
						});
					}
				}
			});
		}
	});

})

/* 
* ACTIVAR O MANDAR A REVISAR TARJETAS
*/
$(".tablaTarjetas").on("click", ".btnActivarT", function () {

	var idTarjeta = $(this).attr("idTarjeta");
	var estadoTarjeta = $(this).attr("estadoTarjeta");

	var datos = new FormData();
	datos.append("activarId", idTarjeta);
	datos.append("activarTarjeta", estadoTarjeta);

	$.ajax({

		url: "ajax/tarjetas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

			swal({
				title: "La Información ha sido actualizada",
				type: "success",
				confirmButtonText: "¡Cerrar!"
			}).then(function (result) {
				if (result.value) {

					window.location = "tarjetas";

				}
			});			
		}
	})

	if (estadoTarjeta == "RE") {
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-warning');
		$(this).html('Revisar');
		$(this).attr('estadoTarjeta', "AC");
	} else {
		$(this).addClass('btn-primary');
		$(this).removeClass('btn-warning');
		$(this).html('Aprobado');
		$(this).attr('estadoTarjeta', "RE");
	}

})


/* 
* BOTON COPIAR TARJETA
*/
$(".tablaTarjetas").on("click", ".btnCopiarTarjeta", function () {

	var idTarjeta = $(this).attr("idTarjeta");

  window.location = "index.php?ruta=copiar-tarjeta&idTarjeta=" + idTarjeta;
  
})

/* 
* PASAR DATOS AL MODAL modalTejidoPrincipal
*/
$('#modalTejidoPrincipal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var recipient = button.data('whatever') 
	var modal = $(this)
	modal.find('.modal-title').text('New message to ' + recipient)
	modal.find('.modal-body input').val(recipient)
})


/* 
* BOTON VISUALIZAR TARJETA
*/
$(".tablaTarjetas").on("click", ".btnVisualizarTarjeta", function () {

	var articuloTarjeta = $(this).attr("articuloTarjeta");

	/* console.log("articuloTarjeta", articuloTarjeta); */

	var datos = new FormData();
	datos.append("articuloTarjeta", articuloTarjeta);

	$.ajax({

		url: "ajax/tarjetas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			/* console.log("respuesta", respuesta); */

			$("#articulo").val(respuesta["articulo"]);

			$("#descripcion").val(respuesta["descripcion"]);

			$("#fecha").val(respuesta["fecha"]);

			$("#costo").val(respuesta["neto"]);

			$("#estado").val(respuesta["estadoTarjeta"]);

			$("#tejidoPrincipal").val(respuesta["descripcionMP"]);

		}

	})

	var articuloTarjetaDetalle = $(this).attr("articuloTarjeta");

	/* console.log("articuloTarjetaDetalle", articuloTarjetaDetalle); */

	var datosDetalle = new FormData();
	datosDetalle.append("articuloTarjetaDetalle", articuloTarjetaDetalle);

	$.ajax({

		url: "ajax/tarjetas.ajax.php",
		method: "POST",
		data: datosDetalle,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuestaDetalle) {


			$(".simulacion").change(function () {

				var simulacion = $(this).val();

				/* console.log("simulacion", simulacion); */

				$(".btnCalcular").click(function () {


					$(".detalle").remove();


					for (var id of respuestaDetalle) {

						/* 
						todo: Calculamos el total del consumo
						*/
						var cons = id.consumo;

						var sumaCons = Number(simulacion) * Number(cons);

						sumaCons = Number(sumaCons.toFixed(6));

						/* 
						todo: Calculamos el total del costo
						*/

						var total = id.total_detalle;

						var sumaTotal = Number(simulacion) * Number(total);

						sumaTotal = Number(sumaTotal.toFixed(6));



						$('.tablaDetalle').append(

							'<tr class="detalle">' +
							'<td>' + id.mat_pri + ' </td>' +
							'<td>' + id.descripcionMP + ' </td>' +
							'<td>' + id.unidad + ' </td>' +
							'<td>' + sumaCons + ' </td>' +
							'<td>' + id.tej_princ + ' </td>' +
							'<td>' + id.precio_mp + ' </td>' +
							'<td>' + sumaTotal + ' </td>' +
							'</tr>'


						)

					}


				})


			})

			/* console.log("respuestaDetalle", respuestaDetalle); */



		}

	})



});

/* 
* BOTON REPORTE DE OPERACIONES X MODELO
*/
$(".box").on("click", ".btnReporteTarjeta", function () {

    window.location = "vistas/reportes_excel/rpt_tarjeta_articulo.php";
  
})

/* 
* BOTON REPORTE DE TARJETA 
*/
$(".box").on("click", ".btnReporteMateriaP", function () {

    window.location = "vistas/reportes_excel/rpt_tarjeta_mp.php";
  
})

/* 
* CARGAR TABLA FICHA TECNICA
*/
// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturarRango6") != null) {
	$("#daterange-btnFichas span").html(localStorage.getItem("capturarRango6"));
	cargarTablaFichas(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnFichas span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaFichas(null, null);
}


function cargarTablaFichas(fechaInicial, fechaFinal){
$('.tablaFichaTecnica').DataTable({
	"ajax": "ajax/tarjetas/tabla-ficha-tecnica.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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
/*=============================================
EDITAR FICHA TECNICA
=============================================*/
$(".tablaTarjetas").on("click", ".btnAgregarFicha", function () {

	var idTarjeta2 = $(this).attr("idTarjeta");
    var datos = new FormData();
    datos.append("idTarjeta2", idTarjeta2);

    $.ajax({
        url: "ajax/tarjetas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta", respuesta); 

			$("#nuevaTarjeta").val(respuesta["codigo"]);
			$("#nuevoModelo").val(respuesta["modelo"]);
            $("#idTarjeta").val(respuesta["id"]);

        }

    })

})


/*=============================================
RANGO DE FECHAS
=============================================*/
moment.locale('es');
$("#daterange-btnFichas").daterangepicker(
    {
	  cancelClass: "CancelarFicha",
	  locale:{
		"daysOfWeek": [
			"Dom",
			"Lun",
			"Mar",
			"Mie",
			"Jue",
			"Vie",
			"Sab"
		],
		"monthNames": [
			"Enero",
			"Febrero",
			"Marzo",
			"Abril",
			"Mayo",
			"Junio",
			"Julio",
			"Agosto",
			"Septiembre",
			"Octubre",
			"Noviembre",
			"Diciembre"
		],
	  },
      ranges: {
        Hoy: [moment(), moment()],
        Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
        "Últimos 7 días": [moment().subtract(6, "days"), moment()],
        "Últimos 30 días": [moment().subtract(29, "days"), moment()],
        "Este mes": [moment().startOf("month"), moment().endOf("month")],
        "Último mes": [
          moment()
            .subtract(1, "month")
            .startOf("month"),
          moment()
            .subtract(1, "month")
            .endOf("month")
        ]
      },
      
      startDate: moment(),
      endDate: moment()
    },
    function(start, end) {
      $("#daterange-btnFichas span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango6 = $("#daterange-btnFichas span").html();
  
      localStorage.setItem("capturarRango6", capturarRango6);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaFichaTecnica").DataTable().destroy();
      cargarTablaFichas(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarFicha").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango6");
      localStorage.removeItem("fechaInicial");
    	localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "ficha-tecnica";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
  
  	if(ruta == "ficha-tecnica"){
		if (textoHoy == "Hoy") {
		var d = new Date();
	
		var dia = d.getDate();
		var mes = d.getMonth() + 1;
		var año = d.getFullYear();
	
		dia = ("0" + dia).slice(-2);
		mes = ("0" + mes).slice(-2);
	
		var fechaInicial = año + "-" + mes + "-" + dia;
		var fechaFinal = año + "-" + mes + "-" + dia;
	
		localStorage.setItem("capturarRango6", "Hoy");
		localStorage.setItem("fechaInicial", fechaInicial);
		localStorage.setItem("fechaFinal", fechaFinal);
		// Recargamos la tabla con la información para ser mostrada en la tabla
		$(".tablaFichaTecnica").DataTable().destroy();
		cargarTablaFichas(fechaInicial, fechaFinal);
		}
	}
  });