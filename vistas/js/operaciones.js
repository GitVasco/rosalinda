$('.tablaOperaciones').DataTable( {
    "ajax": "ajax/maestros/tabla-operaciones.ajax.php",
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

// EDITAR OPERACIÓN
$(".tablaOperaciones tbody").on("click","button.btnEditarOperacion",function(){
	var idOperacion =$(this).attr("idOperacion");
	var datos= new FormData();
	datos.append("idOperacion",idOperacion);
	$.ajax({
		url:"ajax/operaciones.ajax.php",
		method:"POST",
		data:datos,
		cache: false,
		contentType:false,
		processData:false,
		dataType: "json",
		success:function(respuesta){
			$("#editarCodigoOpe").val(respuesta["codigo"]);
			$("#editarOperacion").val(respuesta["nombre"]);
			$("#idOperacion").val(respuesta["id"]);
		}
	});
	
});


// ELIMINAR OPERACIÓN
$(".tablaOperaciones tbody").on("click","button.btnEliminarOperacion",function(){
	var idOperacion =$(this).attr("idOperacion");
	//console.log("idOperacion", idOperacion);
	swal({
		title: "¿Está seguro de borrar la operación?",
		text: "¡Si no lo está se puede cancelar la acción!",
		type:"warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar operación!" 
	}).then((result)=>{
		if(result.value){
			window.location = "index.php?ruta=operaciones&idOperacion="+idOperacion;
		}
	})
	
	
});

//TABLA DINAMICA DE CABECERA OPERACIONES

$('.tablaDetalleOperaciones').DataTable( {
    "ajax": "ajax/operaciones/tabla-cabecera-operacion.ajax.php",
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

//TABLA DINAMICA DE DETALLE OPERACIONES

$('.tablaArticuloOperaciones').DataTable( {
    "ajax": "ajax/operaciones/tabla-detalle-operacion.ajax.php",
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
			"sNext":     ">>",
			"sPrevious": "<<"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}
} );

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaArticuloOperaciones tbody").on("click", "button.agregarOperacion", function() {

	var idOperacion = $(this).attr("idOperacion");
  
  
	$(this).removeClass("btn-primary agregarOperacion");
  
	$(this).addClass("btn-default");
  
	var datos = new FormData();
	datos.append("idOperacion", idOperacion);
  
	$.ajax({
	  url: "ajax/operaciones.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
	  contentType: false,
	  processData: false,
	  dataType: "json",
	  success: function(respuesta) {
		var codigo = respuesta["codigo"];
		var nombre = respuesta["nombre"];
		
		$(".nuevaOperacion").append(
  
		  '<div class="row" style="padding:5px 15px">' +
  
			"<!-- Descripción del producto -->" +
  
			'<div class="col-xs-6" style="padding-right:0px">' +
  
			  '<div class="input-group">' +
  
				'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarOperacion" idOperacion="' + idOperacion + '"><i class="fa fa-times"></i></button></span>' +
  
				'<input type="text" class="form-control nuevaDescripcionOperacion2"  name="agregarOperacion" value="'+ codigo +" - "+ nombre + '"  readonly required>' +
				'<input type="hidden" class="form-control nuevaDescripcionOperacion" value="'+nombre+'" idOperacion="' + idOperacion + '" codigoOP= "'+codigo+'">'+
  
			  "</div>" +
  
			"</div>" +
  
			"<!-- Precio Decena -->" +
  
			'<div class="col-xs-3 ingresoDocena">' +
  
			'<input type="number" class="form-control nuevoPrecioDocena" name="nuevoPrecioDocena" min="0" value="0" step="any" required readonly>' +
  
			"</div>" +
  
			"<!-- Tiempo Standar -->" +
  
			'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
  
			  '<div class="input-group">' +
  
			  '<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>' +
  
			  '<input type="number" class="form-control nuevoTiempoStandar" name="nuevoTiempoStandar" id="nuevoTiempoStandar"  value="0" step="any" required>' +
  
			  "</div>" +
  
			"</div>" +
  
		  "</div>"
		);
		$(".nuevoPrecioDocena").number(true, 6);
		$(".nuevoTiempoStandar").number(true, 4);

		sumarTotalPrecios();
		sumarTotalTiempos();
		listarOperaciones();
    }
  });
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaArticuloOperaciones").on("draw.dt", function() {
	//console.log("tabla");
  
	if (localStorage.getItem("quitarOperacion") != null) {
	  var listaIdOperaciones = JSON.parse(localStorage.getItem("quitarOperacion"));

	  for (var i = 0; i < listaIdOperaciones.length; i++) {
		$(
		  "button.recuperarBoton[idOperacion='" +
			listaIdOperaciones[i]["idOperacion"] +
			"']"
		).removeClass("btn-default");
		$(
		  "button.recuperarBoton[idOperacion='" +
			listaIdOperaciones[i]["idOperacion"] +
			"']"
		).addClass("btn-primary agregarOperacion");
	  }
	}
  });
  
  /*=============================================
  QUITAR OPERACIONES POR ARTICULO Y RECUPERAR BOTÓN
  =============================================*/
  
  var idQuitarOperacion = [];
  
  localStorage.removeItem("quitarOperacion");
  
  $(".formularioOperacion").on("click", "button.quitarOperacion", function() {
  
	$(this)
	  .parent()
	  .parent()
	  .parent()
	  .parent()
	  .remove();
  
	var idOperacion = $(this).attr("idOperacion");
  
	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DE OPERACION A QUITAR
	=============================================*/
  
	if (localStorage.getItem("quitarOperacion") == null) {
	  idQuitarOperacion = [];
	} else {
	  idQuitarOperacion.concat(localStorage.getItem("quitarOperacion"));
	}
  
	idQuitarOperacion.push({
	  idOperacion: idOperacion
	});
  
	localStorage.setItem("quitarOperacion", JSON.stringify(idQuitarOperacion));
  
	$("button.recuperarBoton[idOperacion='" + idOperacion + "']").removeClass(
	  "btn-default"
	);
  
	$("button.recuperarBoton[idOperacion='" + idOperacion + "']").addClass(
	  "btn-primary agregarOperacion"
	);
  
	if ($(".nuevaOperacion").children().length == 0) {
		$("#nuevoTotalDocena").val(0);
		$("#nuevoTotalStandar").val(0);
	}else{
		sumarTotalPrecios();
		sumarTotalTiempos();
		listarOperaciones();
	}
  });

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarOperaciones() {
	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idOperaciones = $(".quitarOperacion");
  
	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaArticuloOperaciones tbody button.agregarOperacion");
	
	
  
	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for (var i = 0; i < idOperaciones.length; i++) {
	  //Capturamos los Id de los productos agregados a la venta
	  var boton = $(idOperaciones[i]).attr("idOperacion");
	//   console.log(boton);
	
	  //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
	  for (var j = 0; j < botonesTabla.length; j++) {
		if ($(botonesTabla[j]).attr("idOperacion") == boton) {
		  $(botonesTabla[j]).removeClass("btn-primary agregarOperacion");
		  $(botonesTabla[j]).addClass("btn-default");
		}
	  }
	}
  }

//FUNCION PAR SUMAR CADA VEZ QUE SE MODIFIQUE LAS PRECIOS
  $(".formularioOperacion").on("change", "input.nuevoPrecioDocena", function() {
  
	sumarTotalPrecios();
	listarOperaciones();
  
  });
  //FUNCION PAR SUMAR CADA VEZ QUE SE MODIFIQUE LOS TIEMPOS
  $(".formularioOperacion").on("change", "input.nuevoTiempoStandar", function() {

	// SUMAR TOTAL DE TIEMPOS
  
	sumarTotalTiempos();
	listarOperaciones();
  
  });
  
  /*=============================================
  CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
  =============================================*/
  
  $(".tablaArticuloOperaciones").on("draw.dt", function() {
	quitarAgregarOperaciones();
  });
  
  function sumarTotalPrecios() {
	var precioItem = $(".nuevoPrecioDocena");
  
   /*  console.log("precioitem", precioItem); */
  
	var arraySumaPrecio = [];
  
	for (var i = 0; i < precioItem.length; i++) {
	  arraySumaPrecio.push(Number($(precioItem[i]).val()));
	}
  
	/* console.log("arraySumaPrecio", arraySumaPrecio); */
  
	function sumaArrayPrecios(total, numero) {
	  return total + numero;
	}
  
	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  
	/*     console.log("sumaTotalPrecio", sumaTotalPrecio); */
  
	$("#nuevoTotalDocena").val(sumaTotalPrecio);
  }

  function sumarTotalTiempos() {
	var precioItem = $(".nuevoTiempoStandar");
  
   /*  console.log("precioitem", precioItem); */
  
	var arraySumaPrecio = [];
  
	for (var i = 0; i < precioItem.length; i++) {
	  arraySumaPrecio.push(Number($(precioItem[i]).val()));
	}
  
	/* console.log("arraySumaPrecio", arraySumaPrecio); */
  
	function sumaArrayPrecios(total, numero) {
	  return total + numero;
	}
  
	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  
	/*     console.log("sumaTotalPrecio", sumaTotalPrecio); */
  
	$("#nuevoTotalStandar").val(sumaTotalPrecio);
  }

$("#nuevoTotalDocena").number(true, 6);
$("#nuevoTotalStandar").number(true, 4);

  /*=============================================
LISTAR TODAS LAS OPERACIONES
=============================================*/

function listarOperaciones() {
	var listaOperaciones = [];
  
	var descripcion = $(".nuevaDescripcionOperacion");
  
	var precio = $(".nuevoPrecioDocena");
  
	var tiempo = $(".nuevoTiempoStandar");
  
	for (var i = 0; i < descripcion.length; i++) {
	  listaOperaciones.push({
		id: $(descripcion[i]).attr("idOperacion"),
		codigo: $(descripcion[i]).attr("codigoOP"),
		descripcion: $(descripcion[i]).val(),
		precio: $(precio[i]).val(),
		tiempo: $(tiempo[i]).val()
	  });
	}
	$("#listaOperaciones").val(JSON.stringify(listaOperaciones));

	
	
	
}
//EDITAR DETALLE OPERACION

//EDITAR VENTA
$(".tablaDetalleOperaciones").on("click", ".btnEditarOperacion",function(){
	var idOperacion= $(this).attr("idOperacion");
	window.location="index.php?ruta=editardetalleoperaciones&idOperacion="+idOperacion;
})

// ELIMINAR CABECERA OPERACIÓN
$(".tablaDetalleOperaciones tbody").on("click","button.btnEliminarOperacion",function(){
	var idOperacion =$(this).attr("idOperacion");
	//console.log("idOperacion", idOperacion);
	swal({
		title: "¿Está seguro de borrar la operación modelo?",
		text: "¡Si no lo está se puede cancelar la acción!",
		type:"warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar operación modelo!" 
	}).then((result)=>{
		if(result.value){
			window.location = "index.php?ruta=detalleoperaciones&idOperacion="+idOperacion;
		}
	})
	
	
});

/* 
* BOTON VISUALIZAR DETALLE OPERACION
*/

$(".tablaDetalleOperaciones").on("click", ".btnDetalleOperacion", function () {

	var idOperacion = $(this).attr("idOperacion");

	var datos = new FormData();
	datos.append("idOperacion", idOperacion);

	$.ajax({

		url: "ajax/operaciones-cabecera.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$("#verModelo").val(respuesta["articulo"]);
			
			//vendedores
			var idUsuario = respuesta["vendedor_fk"];
			
			var datos3 = new FormData();
			datos3.append("idUsuario", idUsuario);
			$.ajax({

				url: "ajax/usuarios.ajax.php",
				method: "POST",
				data: datos3,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					
					$("#verVendedor").val(respuesta["nombre"]);
				}
				
			})

			$("#verTotalDocena").val(respuesta["total_pd"]);

			$("#verTiempoTotal").val(respuesta["total_ts"]);
			
			var modeloDetalle = respuesta["articulo"];
			
			var datos2 = new FormData();
			datos2.append("modeloDetalle", modeloDetalle);
			$.ajax({

				url: "ajax/operaciones-detalle.ajax.php",
				method: "POST",
				data: datos2,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					
					$(".detalle").remove();
					for (var id of respuesta) {
						
						$('.tablaOperacionModelo').append(

							'<tr class="detalle">' +
							'<td>' + id.cod_operacion + ' </td>' +
							'<td>' + id.nombre + ' </td>' +
							'<td>' + id.precio_doc + ' </td>' +
							'<td>' + id.tiempo_stand + ' </td>' +
							'</tr>'	
						)
					}
					
				}
				
			})

		}

    })
});

/* 
* BOTON REPORTE DE OPERACIONES X MODELO
*/
$(".box").on("click", ".btnReporteOG", function () {

    window.location = "vistas/reportes_excel/rpt_operacionesgeneral.php";
  
})
$(document).ready(function(){
	
})

//Reporte de Salidas
$(".box").on("click", ".btnReporteTO", function () {
    window.location = "vistas/reportes_excel/rpt_operacionesdetalle.php";
  
})

//Reporte de Operaciones
$(".box").on("click", ".btnReporteOPE", function () {
    window.location = "vistas/reportes_excel/rpt_operaciones.php";
  
})

$(".formularioOperacion").on("keyup", "input.nuevoTiempoStandar", function() {
	var inputPrecio = $(this)
	.parent()
	.parent()
	.parent()
    .children(".ingresoDocena")
    .children(".nuevoPrecioDocena");
	var tiempo = $(this).val();
	var precio = (tiempo/60)*0.1*12;
	inputPrecio.val(precio.toFixed(2));
	sumarTotalPrecios();
});


// VALIDACIÓN DE UN DOCUMENTO EXISTENTE EN LA BD AL REGISTRAR
$("#codigoOpe").change(function () {
	var codigoOpe = $(this).val();
	var datos = new FormData();
	datos.append("codigoOpe", codigoOpe);
	$.ajax({
		url: "ajax/operaciones.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			if (respuesta) {
				if ($(".msgError").length == 0) {
					$("#codigoOpe").parent().after('<div class="alert alert-danger alert-dismissable msgError" id="mensajeError">' +
						'<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>' +
						'<strong>Error!</strong> El codigo ya existe en la Base de Datos, por favor verifique.' +
						'</div>');
				}
				$("#codigoOpe").val("");
				$("#codigoOpe").focus();
			} else {
				$(".msgError").remove();
			}
		}
	});
});

// VALIDACIÓN DE UN DOCUMENTO EXISTENTE EN LA BD AL EDITAR
$("#editarCodigoOpe").change(function () {
	var codigoOpe = $(this).val();
	var datos = new FormData();
	datos.append("codigoOpe", codigoOpe);
	$.ajax({
		url: "ajax/operaciones.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			if (respuesta) {
				if ($(".msgError").length == 0) {
					$("#editarCodigoOpe").parent().after('<div class="alert alert-danger alert-dismissable msgError" id="mensajeError">' +
						'<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>' +
						'<strong>Error!</strong> El codigo ya existe en la Base de Datos, por favor verifique.' +
						'</div>');
				}
				$("#editarCodigoOpe").val("");
				$("#editarCodigoOpe").focus();
			} else {
				$(".msgError").remove();
			}
		}
	});
});