/* 
* CARGAR TABLA ORDEN DE CORTE
*/
// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturarRango3") != null) {
	$("#daterange-btnCorte span").html(localStorage.getItem("capturarRango3"));
    cargarTablaCortes(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnCorte span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
    cargarTablaCortes(null,null);
}


function cargarTablaCortes(fechaInicial, fechaFinal){
$('.tablaOrdenCorte').DataTable({
	"ajax": "ajax/produccion/tabla-ordencorte.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "desc"]],
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
* tabla de articulos con urgencia para orden de corte
*/
$('.tablaArticulosOrdenCorte').DataTable( {
    "ajax": "ajax/produccion/tabla-articulosordencorte.ajax.php",
    "deferRender": true,
	"retrieve": true,
    "processing": true,
    "pageLength": 20,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     ">>>",
			"sPrevious": "<<<"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}
} );

/* 
* AGREGANDO LOS ARTICULOS A LA ORDEN DE CORTE DESDE LA TABLA
*/

$(".tablaArticulosOrdenCorte tbody").on("click", "button.agregarArt", function () {

    var articuloOC = $(this).attr("articuloOC");
    var proyeccion = $(this).attr("proyeccion");
    var sumprog = $(this).attr("sumprog");
    var ventasG = $(this).attr("ventasG");
    //console.log(stockG);

    /* console.log("articuloOC", articuloOC); */

    $(this).removeClass("btn-primary agregarArt");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("articuloOC", articuloOC);

    $.ajax({

        url: "ajax/articulos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            /* console.log("respuesta", respuesta); */

            var articulo = respuesta["articulo"];
            var packing = respuesta["packingB"];
            var ord_corte = respuesta["ord_corte"];
            var stockG = respuesta["stockG"];
            
            var mes = (Number(stockG) + 50) / (Number(ventasG * 1.3)) ;
            //console.log(mes.toFixed(2));


            /* 
            !PENDIENTE DE PRPYECCION 
            */
            if(Number(Number(proyeccion) - Number(sumprog)  - 50 ) > 0){

                var pen = '<input style="color:#008000; background-color:white;" type="text" class="form-control nuevoPendienteProy input-sm" name="'+ articulo +'" id="'+ articulo +'"  value="' + Number(Number(proyeccion) - Number(sumprog)  - 50 ) + '" pendienteReal="' + Number(Number(proyeccion) - Number(sumprog)) + '" readonly></input>';


            }else{

                var pen = '<input style="color:#FF0000; background-color:pink;" type="text" class="form-control nuevoPendienteProy input-sm" name="'+ articulo +'" id="'+ articulo +'"  value="' + Number(Number(proyeccion) - Number(sumprog)  - 50 ) + '" pendienteReal="' + Number(Number(proyeccion) - Number(sumprog)) + '" readonly></input>';

            }

            /* 
            ! DURACION DEL MES
            */

            if(mes.toFixed(2) < 2.1 ){

                duracion = '<input style="color:#8B0000; background-color:pink;" type="text" class="form-control nuevoMes input-sm" name="'+ articulo +'" id="'+ articulo + 'M' +'" value="' + mes.toFixed(2) + '" mesReal="' + mes.toFixed(2) +'" stockG="' + stockG + '" ventasG="' + (Number(ventasG)) + '" readonly>';

            }else{

                duracion = '<input style="color:#8B0000; background-color:white;" type="text" class="form-control nuevoMes input-sm" name="'+ articulo +'" id="'+ articulo + 'M' +'" value="' + mes.toFixed(2) + '" mesReal="' + mes.toFixed(2) +'" stockG="' + stockG + '" ventasG="' + (Number(ventasG)) + '" readonly>';

            }


            /* 
            todo: AGREGAR LOS CAMPOS
            */

            $(".nuevoArticuloOC").append(

                '<div class="row munditoOC" style="padding:5px 15px">' +

                    "<!-- Descripción del Articulo -->" +

                    '<div class="col-xs-6" style="padding-right:0px">' +

                        '<div class="input-group">' +
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarOC" articuloOC="' + articuloOC + '"><i class="fa fa-times"></i></button></span>' +

                            '<input type="text" class="form-control nuevaDescripcionProducto input-sm" articuloOC="' + articuloOC + '" name="agregarOC" value="' + packing + '" codigoAC="' + articulo + '" readonly required>' +

                        "</div>" +

                    "</div>" +

                    "<!-- Cantidad de la Orden de Corte -->" +

                    '<div class="col-xs-2">' +

                        '<input type="number" class="form-control nuevaCantidadArticuloOC input-sm" name="nuevaCantidadArticuloOC" id="nuevaCantidadArticuloOC" min="1" value="50" ord_corte="' + ord_corte + '" articulo="'+ articulo +'" nuevoOrdCorte="' + Number(Number(ord_corte) + 50) + '" required>' +

                    "</div>" +

                    "<!-- Cantidad PENDIENTE DE PROYECCION -->" +

                    '<div class="col-xs-2 pendiente">' +

                         pen +

                    "</div>" +

                    "<!-- Cantidad de meses que va a durar -->" +

                    '<div class="col-xs-2 mes">' +

                        duracion +

                    "</div>" +
                
                "</div>"

            );

            // SUMAR TOTAL DE UNIDADES

                sumarTotalOC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosOC();

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                      
        }

    })


});

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaArticulosOrdenCorte").on("draw.dt", function () {
    /* console.log("tabla"); */

    if (localStorage.getItem("quitarOC") != null) {
        var listaIdArticuloOC = JSON.parse(localStorage.getItem("quitarOC"));

        for (var i = 0; i < listaIdArticuloOC.length; i++) {
            $("button.recuperarBoton[articuloOC='" + listaIdArticuloOC[i]["articuloOC"] + "']").removeClass("btn-default");

            $("button.recuperarBoton[articuloOC='" + listaIdArticuloOC[i]["articuloOC"] + "']").addClass("btn-primary agregarArt");
        }
    }
});

/* 
* QUITAR ARTICULO DE LA ORDEN DE CORTE Y RECUPERAR BOTÓN
*/
var idQuitarArticuloOC = [];

localStorage.removeItem("quitarOC");

$(".formularioOrdenCorte").on("click", "button.quitarOC", function () {

    /* console.log("boton"); */

    $(this).parent().parent().parent().parent().remove();

    var articuloOC = $(this).attr("articuloOC");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarOC") == null) {

        idQuitarArticuloOC = [];

    } else {

        idQuitarArticuloOC.concat(localStorage.getItem("quitarOC"))

    }

    idQuitarArticuloOC.push({
        "articuloOC": articuloOC
    });

    localStorage.setItem("quitarOC", JSON.stringify(idQuitarArticuloOC));

    $("button.recuperarBoton[articuloOC='" + articuloOC + "']").removeClass('btn-default');

    $("button.recuperarBoton[articuloOC='" + articuloOC + "']").addClass('btn-primary agregarArt');


    if ($(".nuevoArticuloOC").children().length == 0) {

        $("#nuevoTotalOrdenCorte").val(0);
        $("#totalOrdenCorte").val(0);
        $("#nuevoTotalOrdenCorte").attr("total", 0);

    } else {

            // SUMAR TOTAL DE UNIDADES

            sumarTotalOC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosOC()


    }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioOrdenCorte").on("change", "input.nuevaCantidadArticuloOC", function() {

    var nuevoOrdCorte = Number($(this).attr("ord_corte")) + Number($(this).val());
    var articulo = $(this).attr("articulo");
    //console.log(articulo);
    var articuloM = articulo+'M';
    //console.log(articuloM);

    var pendiente = $(this)
    .parent()
    .parent()
    .children(".pendiente")
    .children(".nuevoPendienteProy");
    //console.log(pendiente);

    var pendienteReal = pendiente.attr("pendienteReal");
    //console.log(pendiente);
    //console.log(pendienteReal);

    var quedaPen = pendienteReal - Number($(this).val());
    //console.log(quedaPen);

    pendiente.val(quedaPen);

    $(this).attr("nuevoOrdCorte", Number(nuevoOrdCorte));


    if (quedaPen > 0){

        inputPositivoPend(articulo);

    }else{

        inputNegativoPend(articulo);

    }

    var mes = $(this)
    .parent()
    .parent()
    .children(".mes")
    .children(".nuevoMes");
    //console.log(mes);

    var mesReal = mes.attr("mesReal");
    //console.log(mesReal);

    var stockG = mes.attr("stockG");
    //console.log(Number(stockG) +50);
    var stock = Number(stockG) + Number($(this).val());

    var ventasG = mes.attr("ventasG");
    //console.log(ventasG * 1.3);
    var venta = ventasG * 1.3
 
    var quedaMes = stock / venta;
    //console.log(quedaMes);

    mes.val(quedaMes.toFixed(2));

    if(quedaMes < 2.1){

        inputPositivoMes(articuloM);
        //console.log("Hola mundo");

    }else{

        inputNegativoMes(articuloM);
        //console.log("Hola no Mundo");

    }



    // SUMAR TOTAL DE UNIDADES

    sumarTotalOC();
  
    // AGREGAR IMPUESTO
  

    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
    listarArticulosOC();



  });

  function inputPositivoPend(articulo){

    var input =   document.getElementById(articulo);
    //console.log(input);

        input.removeAttribute("style");
        input.style.color = "#008000";
        input.style.background = "white";

  }

  function inputNegativoPend(articulo){

    var input =   document.getElementById(articulo);
    //console.log(input);

        input.removeAttribute("style");
        input.style.color = "#FF0000";
        input.style.background = "pink";

  }  
  
  function inputPositivoMes(articuloM){

    var input =   document.getElementById(articuloM);
    //console.log(input);

        input.removeAttribute("style");
        input.style.color = "#8B0000";
        input.style.background = "pink";

  }

  function inputNegativoMes(articuloM){

    var input =   document.getElementById(articuloM);
    //console.log(input);

        input.removeAttribute("style");
        input.style.color = "#8B0000";
        input.style.background = "white";

  }  
  

  
/* 
* SUMAR EL TOTAL DE LAS ORDENES DE CORTE
*/
  
function sumarTotalOC() {

    var cantidadOc = $(".nuevaCantidadArticuloOC");
  
    //console.log("cantidadOc", cantidadOc);
  
    var arraySumarCantidades = [];

    for (var i = 0; i < cantidadOc.length; i++){

        arraySumarCantidades.push(Number($(cantidadOc[i]).val()));

    }
        /* console.log("arraySumarCantidades", arraySumarCantidades); */

    function sunaArrayCantidades(total, numero) {
        return total + numero;
    }

    var sumarTotal = arraySumarCantidades.reduce(sunaArrayCantidades);

    /* console.log("sumarTotal", sumarTotal); */

    $("#nuevoTotalOrdenCorte").val(sumarTotal);
    $("#totalOrdenCorte").val(sumarTotal);
    $("#nuevoTotalOrdenCorte").attr("total", sumarTotal);

}

/* 
* FORMATO DE MILES AL TOTAL
*/
$("#nuevoTotalOrdenCorte").number(true, 0);

/* 
* LISTAR TODOS LOS ARTICULOS
*/
function listarArticulosOC() {

    var listaArticulos = [];
  
    var descripcion = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadArticuloOC");
    
    for (var i = 0; i < descripcion.length; i++) {

      listaArticulos.push({

        id: $(descripcion[i]).attr("articuloOC"),
        articulo: $(descripcion[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).val(),
        ord_corte: $(cantidad[i]).attr("nuevoOrdCorte")

      });
    }
  
    /* console.log("listaArticulos", JSON.stringify(listaArticulos)); */
  
    $("#listaArticulosOC").val(JSON.stringify(listaArticulos));

}

/* 
* BOTON EDITAR ORDEN DE CORTE
*/
$(".tablaOrdenCorte").on("click", ".btnEditarOC", function () {

	var codigo = $(this).attr("codigo");

  window.location = "index.php?ruta=editar-detalle-ordencorte&codigo=" + codigo;
  
})

/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL ARTICULO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarArticuloOC() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
    var articuloOC = $(".quitarOC");
    //console.log("articuloOC", articuloOC);

	//Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTablaOC = $(".tablaArticulosOrdenCorte tbody button.agregarArt");
    //console.log("botonesTablaOC", botonesTablaOC);

	//Recorremos en un ciclo para obtener los diferentes articuloOC que fueron agregados a la venta
	for (var i = 0; i < articuloOC.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(articuloOC[i]).attr("articuloOC");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaOC.length; j++) {

			if ($(botonesTablaOC[j]).attr("articuloOC") == boton) {

				$(botonesTablaOC[j]).removeClass("btn-primary agregarMP");
				$(botonesTablaOC[j]).addClass("btn-default");

			}
		}

	}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$(".tablaArticulosOrdenCorte").on("draw.dt", function() {
    quitarAgregarArticuloOC();
});
  

/*=============================================
BORRAR VENTA
=============================================*/
$(".tablaOrdenCorte").on("click", ".btnEliminarOC", function() {
    var codigo = $(this).attr("codigo");

    /* console.log("codigo", codigo); */

    swal({
		type: "warning",
		title: "Advertencia",
		text: "¿Está seguro de eliminar la Orden de Corte? ¡Si no está seguro, puede cancelar la acción!",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: "¡Si, eliminar Orden de Corte!",
		cancelButtonText: "Cancelar",
	}).then(function (result) {
		if (result.value) {
			var datos = new FormData();
			datos.append("codigo", codigo);
			$.ajax({
				url: "ajax/ordencorte.ajax.php",
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
								window.location = "ordencorte";
							}
						});
					}


				}
			});
		}
	});

  });


/* 
* VISUALIZAR DETALLE DE LA ORDEN DE CORTE
*/ 
$(".tablaOrdenCorte").on("click", ".btnVisualizarOC", function () {

	var codigoOC = $(this).attr("codigo");
    //console.log("codigoOC", codigoOC);
    
    var datos = new FormData();
	datos.append("codigoOC", codigoOC);

	$.ajax({

		url:"ajax/ordencorte.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			//console.log("respuesta", respuesta);

            $("#ordencorte").val(respuesta["codigo"]);
            $("#fecha").val(respuesta["fecha"]);
            $("#configuracion").val(respuesta["configuracion"]);
            $("#nombre").val(respuesta["nombre"]);
            $("#cantidad").val(respuesta["total"]);
            $("#saldo").val(respuesta["saldo"]);
            $("#estado").val(respuesta["estado"]);

            $("#cantidad").number(true, 0);
            $("#saldo").number(true, 0);
			
		}

    })
    
     var codigoDOC = $(this).attr("codigo");	

    $(".tablaVerOrdenCorte").DataTable().destroy();
    $('.tablaVerOrdenCorte').DataTable({
        "ajax": "ajax/produccion/tabla-ver-ordencorte.ajax.php?perfil=" + $("#perfilOculto").val()+"&codigo="+ codigoDOC,
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "order": [[0, "desc"]],
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
  
})

/* 
* VISUALIZAR DETALLE DE LA ORDEN DE CORTE
*/ 
$(".tablaOrdenCorte").on("click", ".btnVisualizarOCCantidad", function () {

	var codigoOC = $(this).attr("codigo");
    //console.log("codigoOC", codigoOC);
    
    var datos = new FormData();
	datos.append("codigoOC", codigoOC);

	$.ajax({

		url:"ajax/ordencorte.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			//console.log("respuesta", respuesta);

            $("#ordencorte2").val(respuesta["codigo"]);
            $("#fecha2").val(respuesta["fecha"]);
            $("#configuracion2").val(respuesta["configuracion"]);
            $("#nombre2").val(respuesta["nombre"]);
            $("#cantidad2").val(respuesta["total"]);
            $("#saldo2").val(respuesta["saldo"]);
            $("#estado2").val(respuesta["estado"]);

            $("#cantidad2").number(true, 0);
            $("#saldo2").number(true, 0);
			
		}

    })
    
     var codigoDOC = $(this).attr("codigo");	

    $(".tablaVerOrdenCorteCantidad").DataTable().destroy();
    $('.tablaVerOrdenCorteCantidad').DataTable({
        "ajax": "ajax/produccion/tabla-ver-ordencorte-detacantidad.ajax.php?perfil=" + $("#perfilOculto").val()+"&codigo="+ codigoDOC,
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "order": [[0, "desc"]],
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
  
})

/* 
* BOTON REPORTE DE ORDEN DE CORTE
*/
$(".tablaOrdenCorte").on("click", ".btnReporteOC", function () {

    var codigo = $(this).attr("codigo");
    //console.log("codigo", codigo);

    window.location = "vistas/reportes_excel/rpt_ordencorte.php?codigo=" + codigo;
  
})

moment.locale('es');
/*=============================================
RANGO DE FECHAS
=============================================*/

$("#daterange-btnCorte").daterangepicker(
    {
      cancelClass: "CancelarCorte",
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
      $("#daterange-btnCorte span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango3 = $("#daterange-btnCorte span").html();
  
      localStorage.setItem("capturarRango3", capturarRango3);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaOrdenCorte").DataTable().destroy();
      cargarTablaCortes(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarCorte").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango3");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "ordencorte";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
  
    if(ruta == "ordencorte"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango3", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
        // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaOrdenCorte").DataTable().destroy();
        cargarTablaCortes(fechaInicial, fechaFinal);
      }
    }
  });

  // EDITAR OPERACIÓN
$(".tablas tbody").on("click","button.btnEditarDetalleCorte",function(){
    var idDetalle =$(this).attr("idDetalle");
	var datos= new FormData();
	datos.append("idDetalle",idDetalle);
	$.ajax({
		url:"ajax/ordencorte.ajax.php",
		method:"POST",
		data:datos,
		cache: false,
		contentType:false,
		processData:false,
		dataType: "json",
		success:function(respuesta){
            //console.log(respuesta);
            $("#idDetalle").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["ordencorte"]);
			$("#editarArticulo").val(respuesta["articulo"]);
            $("#editarCantidad").val(respuesta["cantidad"]);
            $("#cantOri").val(respuesta["cantidad"]);
		}
	});
	
});


// ELIMINAR OPERACIÓN
$(".tablas tbody").on("click","button.btnEliminarDetalleCorte",function(){
    var idDetalle =$(this).attr("idDetalle");
    var codigo =$(this).attr("codigo");
    var cantidad = $(this).attr("cantidad");

    var ncant = Number(cantidad) *-1;
    console.log(ncant);

	swal({
		title: "¿Está seguro de borrar la orden de corte?",
		text: "¡Si no lo está se puede cancelar la acción!",
		type:"warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar orden de corte!" 
	}).then((result)=>{
		if(result.value){
            window.location = "index.php?ruta=editar-detalle-ordencorte&codigo="+codigo+"&idDetalle="+idDetalle+"&cantidad="+ncant;
		}
	})
	
	
});

/* 
* CAMBIOS DE CANTIDAD SI SUMA O RESTA
*/
$("#editarCantidad").change(function(){

	var cantidad = document.getElementById("editarCantidad").value;
    //console.log("cantidad", cantidad);

    var cantOri = document.getElementById("cantOri").value;
    //console.log("cantOri", cantOri);
    
    cambio = Number(cantidad) - Number(cantOri);
    //console.log(cambio);    
    
    $("#cambio").val(cambio);

})
//Reporte de Salidas
$(".box").on("click", ".btnReporteOrdenC", function () {
    window.location = "vistas/reportes_excel/rpt_ordencorte_general.php";
  
})


if (localStorage.getItem("capturarRango18") != null) {
	$("#daterange-btnGeneralCorte span").html(localStorage.getItem("capturarRango18"));
    cargarTablaGeneralCortes(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnGeneralCorte span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
    cargarTablaGeneralCortes(null,null);
}


function cargarTablaGeneralCortes(fechaInicial, fechaFinal){
$(".tablaDetalleOrdenCorteTotal").DataTable({
    ajax:"ajax/produccion/tabla-ver-ordencorte-general.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    deferRender: true,
    retrieve: true,
    processing: true,
    language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior"
    },
    oAria: {
        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
        sSortDescending: ": Activar para ordenar la columna de manera descendente"
    }
    }

});
}

/*=============================================
RANGO DE FECHAS
=============================================*/

$("#daterange-btnGeneralCorte").daterangepicker(
    {
      cancelClass: "CancelarGeneralCorte",
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
      $("#daterange-btnGeneralCorte span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango18 = $("#daterange-btnGeneralCorte span").html();
  
      localStorage.setItem("capturarRango18", capturarRango18);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaDetalleOrdenCorteTotal").DataTable().destroy();
      cargarTablaGeneralCortes(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarGeneralCorte").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango18");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "ordencorte";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
  
    if(ruta == "ordencorte"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango18", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
        // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaDetalleOrdenCorteTotal").DataTable().destroy();
        cargarTablaGeneralCortes(fechaInicial, fechaFinal);
      }
    }
  });

  if (localStorage.getItem("capturarRango21") != null) {
    $("#daterange-btnCantidadCorte span").html(localStorage.getItem("capturarRango21"));
    cargarTablaCantidadCortes(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
  } else {
    $("#daterange-btnCantidadCorte span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
    cargarTablaCantidadCortes(null,null);
  }
  
  
function cargarTablaCantidadCortes(fechaInicial, fechaFinal){
  $(".tablaCantidadOrdenCorteTotal").DataTable({
      ajax:"ajax/produccion/tabla-ver-ordencorte-cantidad.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
      deferRender: true,
      retrieve: true,
      processing: true,
      language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior"
      },
      oAria: {
          sSortAscending: ": Activar para ordenar la columna de manera ascendente",
          sSortDescending: ": Activar para ordenar la columna de manera descendente"
      }
      }
  
  });
  }
  
  /*=============================================
  RANGO DE FECHAS
  =============================================*/
  
  $("#daterange-btnCantidadCorte").daterangepicker(
      {
        cancelClass: "CancelarCantidadCorte",
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
        $("#daterange-btnCantidadCorte span").html(
          start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
        );
    
        var fechaInicial = start.format("YYYY-MM-DD");
    
        var fechaFinal = end.format("YYYY-MM-DD");
    
        var capturarRango21 = $("#daterange-btnCantidadCorte span").html();
    
        localStorage.setItem("capturarRango21", capturarRango21);
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
        // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaCantidadOrdenCorteTotal").DataTable().destroy();
        cargarTablaCantidadCortes(fechaInicial, fechaFinal);
      });
    
    /*=============================================
    CANCELAR RANGO DE FECHAS
    =============================================*/
    
    $(".daterangepicker.opensleft .range_inputs .CancelarCantidadCorte").on(
      "click",
      function() {
        localStorage.removeItem("capturarRango21");
        localStorage.removeItem("fechaInicial");
        localStorage.removeItem("fechaFinal");
        localStorage.clear();
        window.location = "ordencorte";
      }
    );
    
    /*=============================================
    CAPTURAR HOY
    =============================================*/
    
    $(".daterangepicker.opensleft .ranges li").on("click", function() {
      var textoHoy = $(this).attr("data-range-key");
      var ruta = $("#rutaAcceso").val();
  
      if(ruta == "ordencorte"){
        if (textoHoy == "Hoy") {
          var d = new Date();
      
          var dia = d.getDate();
          var mes = d.getMonth() + 1;
          var año = d.getFullYear();
      
          dia = ("0" + dia).slice(-2);
          mes = ("0" + mes).slice(-2);
      
          var fechaInicial = año + "-" + mes + "-" + dia;
          var fechaFinal = año + "-" + mes + "-" + dia;
      
          localStorage.setItem("capturarRango21", "Hoy");
          localStorage.setItem("fechaInicial", fechaInicial);
          localStorage.setItem("fechaFinal", fechaFinal);
          // Recargamos la tabla con la información para ser mostrada en la tabla
          $(".tablaCantidadOrdenCorteTotal").DataTable().destroy();
          cargarTablaCantidadCortes(fechaInicial, fechaFinal);
        }
      }
    });