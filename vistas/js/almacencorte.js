/* 
* CARGAR TABLA ALMACEN DE CORTE
*/
// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturarRango4") != null) {
	$("#daterange-btnCortes span").html(localStorage.getItem("capturarRango4"));
	cargarTablaAlmacenCortes(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnCortes span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaAlmacenCortes(null, null);
}


function cargarTablaAlmacenCortes(fechaInicial, fechaFinal){
$('.tablaAlmacenCorte').DataTable({
	"ajax": "ajax/produccion/tabla-almacencorte.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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
* tabla de articulos en almacen de corte
*/
$('.tablaArticulosAlmacenCorte').DataTable( {
    "ajax": "ajax/produccion/tabla-articulosalmacencorte.ajax.php",
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
* AGREGANDO LOS ARTICULOS DE ORDEN DE CORTE A CORTE
*/

$(".tablaArticulosAlmacenCorte tbody").on("click", "button.agregarArtAC", function () {

    var articuloAC = $(this).attr("articuloAC");
    var ordcorte = $(this).attr("ordcorte");
    var idCorte = $(this).attr("idCorte");
    var saldo = $(this).attr("saldo");
    //console.log("ordcorte", ordcorte);
    //console.log("articuloAC", articuloAC);
    //console.log("idCorte", idCorte);
    //console.log("saldo", saldo);

    $(this).removeClass("btn-primary agregarArtAC");
    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("articuloAC", articuloAC);

    $.ajax({

        url: "ajax/articulos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            //console.log("respuesta", respuesta);

            var articulo = respuesta["articulo"];
            var packing = respuesta["packing"];
            var alm_corte = respuesta["alm_corte"];

            /* 
            todo: AGREGAR LOS CAMPOS
            */

            $(".nuevoArticuloAC").append(

                '<div class="row" style="padding:5px 15px">' +

                    "<!-- Numero de OC y quitar -->" +

                    '<div class="col-xs-3" style="padding-right:0px">' +

                        '<div class="input-group">' +
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarAC" idCorte="' + idCorte + '"><i class="fa fa-times"></i></button></span>' +

                            '<input type="text" class="form-control nuevoAlmacenCorte"   name="nrooc" value="N° - ' + ordcorte + '" idCorte="' + idCorte + '" ordcorte="' + ordcorte + '" readonly required>' +

                        "</div>" +

                    "</div>" +

                    "<!-- Descripción del Articulo -->" +

                    '<div class="col-xs-5" style="padding-right:0px">' +                        

                            '<input type="text" class="form-control nuevaDescripcionProducto" articuloAC="' + articuloAC + '" name="agregarAC" value="' + packing + '" codigoAC="' + articulo + '" readonly required>' +                        

                    "</div>" +

                    "<!-- Cantidad del Corte -->" +

                    '<div class="col-xs-2">' +

                        '<input type="number" class="form-control nuevaCantidadArticuloAC" name="nuevaCantidadArticuloAC" min="1" value="1" ordcorte="' + ordcorte + '" saldo="' + saldo + '" nuevoSaldo="' + (Number(saldo)-1) + '" alm_corte="' + alm_corte + '" nuevoAlmCorte="' + (Number(alm_corte)+1) + '" required>' +

                    "</div>" +

                    "<!-- Cantidad del SALDO -->" +

                    '<div class="col-xs-2 ingresoSaldo">' +

                        '<input type="number" class="form-control nuevaCantidadSaldo" name="nuevaCantidadSaldo" saldoReal="' + saldo + '" nuevoSaldoP="' + (Number(saldo)-1) + '" value="' +  (Number(saldo)-1) + '" readonly required>' +

                    "</div>" +                    
                
                "</div>"

            );

            // SUMAR TOTAL DE UNIDADES

            sumarTotalAC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosAC();
            listArticulo();

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                      
        }

    })


});

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaArticulosAlmacenCorte").on("draw.dt", function () {
    /* console.log("tabla"); */

    if (localStorage.getItem("quitarAC") != null) {
        var listaIdArticuloAC = JSON.parse(localStorage.getItem("quitarAC"));
        //console.log("listaIdArticuloAC", listaIdArticuloAC);
        

        for (var i = 0; i < listaIdArticuloAC.length; i++) {
            $("button.recuperarBoton[idCorte='" + listaIdArticuloAC[i]["idCorte"] + "']").removeClass("btn-default");

            $("button.recuperarBoton[idCorte='" + listaIdArticuloAC[i]["idCorte"] + "']").addClass("btn-primary agregarArtAC");
        }
    }
});

/* 
* QUITAR ARTICULO DE CORTE Y RECUPERAR BOTÓN
*/
var idQuitarArticuloAC = [];

localStorage.removeItem("quitarAC");

$(".formularioAlmacenCorte").on("click", "button.quitarAC", function () {

    /* console.log("boton"); */

    $(this).parent().parent().parent().parent().remove();

    var idCorte = $(this).attr("idCorte");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarAC") == null) {

        idQuitarArticuloAC = [];

    } else {

        idQuitarArticuloAC.concat(localStorage.getItem("quitarAC"))

    }

    idQuitarArticuloAC.push({
        "idCorte": idCorte
    });

    localStorage.setItem("quitarAC", JSON.stringify(idQuitarArticuloAC));

    $("button.recuperarBoton[idCorte='" + idCorte + "']").removeClass('btn-default');

    $("button.recuperarBoton[idCorte='" + idCorte + "']").addClass('btn-primary agregarArtAC');


    if ($(".nuevoArticuloAC").children().length == 0) {

        $("#nuevoTotalAlmacenCorte").val(0);
        $("#totalAlmacenCorte").val(0);
        $("#nuevoTotalAlmacenCorte").attr("total", 0);

    } else {

            // SUMAR TOTAL DE UNIDADES

            sumarTotalAC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosAC();
            listArticulo();

    }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioAlmacenCorte").on("change", "input.nuevaCantidadArticuloAC", function() {

    var saldoA = $(this)
    .parent()
    .parent()
    .children(".ingresoSaldo")
    .children(".nuevaCantidadSaldo");
    //console.log("saldoA", saldoA.val());

    var saldoFinal = saldoA.attr("saldoReal") - $(this).val() ;
    //console.log("saldoFinal", saldoFinal);

    saldoA.val(saldoFinal);

    var nuevoAlmCorte = Number($(this).attr("alm_corte")) + Number($(this).val());
    var nuevoSaldo = Number($(this).attr("saldo")) - Number($(this).val());
    var oc = $(this).attr("ordcorte");
    //console.log("oc", oc);
  
    $(this).attr("nuevoAlmCorte", Number(nuevoAlmCorte));
    $(this).attr("nuevoSaldo", Number(nuevoSaldo));


/*     if (Number($(this).val()) > Number($(this).attr("saldo"))) {


    
        $(this).val(1);

        saldoA.val(Number($(this).attr("saldo"))-1);

        sumarTotalAC();
    
        swal({
          title: "La cantidad supera el Saldo de la Orden de Corte N° - " + oc +" ",
          text: "¡Sólo hay " + $(this).attr("saldo") + " unidades!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });
    
        return;
    } */
  
  
    // SUMAR TOTAL DE UNIDADES
  
        sumarTotalAC()
    
    // AGREGAR IMPUESTO
  

  
    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
        listarArticulosAC();
        listArticulo();


  });

  /* 
* SUMAR EL TOTAL DE LOS CORTES
*/
  
function sumarTotalAC() {

    var cantidadAc = $(".nuevaCantidadArticuloAC");  
    //console.log("cantidadAc", cantidadAc);

    var arraySumarCantidades = [];

    for (var i = 0; i < cantidadAc.length; i++){

        arraySumarCantidades.push(Number($(cantidadAc[i]).val()));

    }
        //console.log("arraySumarCantidades", arraySumarCantidades);
  
    function sumaArrayCantidades(total, numero) {

        return total + numero;

    }

    var sumarTotal = arraySumarCantidades.reduce(sumaArrayCantidades);

    //console.log("sumarTotal", sumarTotal);

    $("#nuevoTotalAlmacenCorte").val(sumarTotal);
    $("#totalAlmacenCorte").val(sumarTotal);
    $("#nuevoTotalAlmacenCorte").attr("total", sumarTotal);

}

/* 
*formato al total
*/
$("#nuevoTotalAlmacenCorte").number(true, 0);


/* 
* LISTAR TODOS LOS ARTICULOS DEL DETALLE
*/
function listarArticulosAC() {

    var listaArticulos = [];
  
    var ordencorte = $(".nuevoAlmacenCorte");

    var articulo = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadArticuloAC");
    
    var saldo = $(".nuevaCantidadSaldo");
    
    for (var i = 0; i < ordencorte.length; i++) {

      listaArticulos.push({

        ordencorte: $(ordencorte[i]).attr("ordcorte"),
        idocd: $(ordencorte[i]).attr("idCorte"),
        articulo: $(articulo[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).val(),
        saldo: $(saldo[i]).val()

      });
    }
  
    //console.log("listaArticulos", JSON.stringify(listaArticulos));
  
    $("#listaArticulosAC").val(JSON.stringify(listaArticulos));
    
}

/* 
* LISTAR TODOS LOS ARTICULOS
*/
function listArticulo() {

    var listArticulo = [];

    var articulo = $(".nuevaDescripcionProducto");
    var cantidad = $(".nuevaCantidadArticuloAC");

    
    for (var i = 0; i < articulo.length; i++) {

        listArticulo.push({

        articulo: $(articulo[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).val(),

      });
    }
  
    //console.log("listArticulo", JSON.stringify(listArticulo));
    //console.log("listArticulo", listArticulo);
  
    $("#listArticulo").val(JSON.stringify(listArticulo));
    
}



/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL ARTICULO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarArticuloAC() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
    var articuloAC = $(".quitarAC");
    //console.log("articuloAC", articuloAC);

	//Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTablaAC = $(".tablaArticulosAlmacenCorte tbody button.agregarArtAC");
    //console.log("botonesTablaAC", botonesTablaAC);

	//Recorremos en un ciclo para obtener los diferentes articuloAC que fueron agregados a la venta
	for (var i = 0; i < articuloAC.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(articuloAC[i]).attr("articuloAC");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaAC.length; j++) {

			if ($(botonesTablaAC[j]).attr("articuloAC") == boton) {

				$(botonesTablaAC[j]).removeClass("btn-primary agregarArtAC");
				$(botonesTablaAC[j]).addClass("btn-default");

			}
		}

	}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$(".tablaArticulosAlmacenCorte").on("draw.dt", function() {
    quitarAgregarArticuloAC();
});
  

/* 
* VISUALIZAR DETALLE DEL CORTE
*/ 
$(".tablaAlmacenCorte").on("click", ".btnVisualizarAC", function () {

	var codigoAC = $(this).attr("codigoAC");
    //console.log("codigoAC", codigoAC);
    
    var datos = new FormData();
	datos.append("codigoAC", codigoAC);

	$.ajax({

		url:"ajax/almacencorte.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			//console.log("respuesta", respuesta);

            $("#almacencorte").val(respuesta["codigo"]);
            $("#guia").val(respuesta["guia"]);
            $("#fecha").val(respuesta["fecha"]);
            $("#nombre").val(respuesta["nombre"]);
            $("#cantidad").val(respuesta["total"]);
            $("#estado").val(respuesta["estado"]);

            $("#cantidad").number(true, 0);

			
		}

    })
    
    var codigoDAC = $(this).attr("codigoAC");
    
    $(".tablaVerACDetalle").DataTable().destroy();
    $('.tablaVerACDetalle').DataTable({
        "ajax": "ajax/produccion/tabla-ver-almacencorte.ajax.php?perfil=" + $("#perfilOculto").val()+"&codigo="+ codigoDAC,
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
    //console.log("codigoDAC", codigoDAC);

    // var datosDOC = new FormData();
    // datosDOC.append("codigoDAC", codigoDAC);
    
    // $.ajax({

	// 	url:"ajax/almacencorte.ajax.php",
	// 	method: "POST",
	// 	data: datosDOC,
	// 	cache: false,
	// 	contentType: false,
	// 	processData: false,
	// 	dataType:"json",
	// 	success:function(respuestaDetalle){

	// 		//console.log("respuestaDetalle", respuestaDetalle);

    //         $(".detalleMP").remove();
            
	// 		for(var id of respuestaDetalle){

    //             if(id.t1 > 0){

    //                 var t1 = id.t1;
    //             }else

    //                 var t1 = "";

    //             if(id.t2 > 0){

    //                 var t2 = id.t2;
    //             }else

    //                 var t2 = "";
                    
    //             if(id.t3 > 0){

    //                 var t3 = id.t3;
    //             }else

    //                 var t3 = "";
                    
    //             if(id.t4 > 0){

    //                 var t4 = id.t4;
    //             }else

    //                 var t4 = "";    
                    
    //             if(id.t5 > 0){

    //                 var t5 = id.t5;
    //             }else

    //                 var t5 = "";
                    
    //             if(id.t6 > 0){

    //                 var t6 = id.t6;
    //             }else

    //                 var t6 = "";
                    
    //             if(id.t7 > 0){

    //                 var t7 = id.t7;
    //             }else

    //                 var t7 = "";
                    
    //             if(id.t8 > 0){

    //                 var t8 = id.t8;
    //             }else

    //                 var t8 = "";                    

	// 			$('.tablaDetalleOC').append(

	// 				'<tr class="detalleMP">' +
	// 					'<td>' + id.almacencorte + ' </td>' +
	// 					'<td><b>' + id.modelo + ' </b></td>' +
	// 					'<td>' + id.nombre + ' </td>' +
	// 					'<td>' + id.color + ' </td>' +
	// 					'<td><b>' + t1 + ' </b></td>' +
	// 					'<td><b>' + t2 + ' </b></td>' +
	// 					'<td><b>' + t3 + ' </b></td>' +
    //                     '<td><b>' + t4 + ' </b></td>' +
    //                     '<td><b>' + t5 + ' </b></td>' +
    //                     '<td><b>' + t6 + ' </b></td>' +
    //                     '<td><b>' + t7 + ' </b></td>' +
    //                     '<td><b>' + t8 + ' </b></td>' +
    //                     '<td><b>' + id.subtotal + ' </b></td>' +
	// 				'</tr>'

	// 			)

	// 		}            

	// 	}

	// })
  
})

/* 
* PROCESADO O PEDIR A SISTEMAS QUE LO REVISE
*/
$(".tablaAlmacenCorte").on("click", ".btnSistemas", function () {

	var codigo = $(this).attr("codigo");
    var estadoAM = $(this).attr("estadoAM");
    console.log("codigo", codigo);
    console.log("estadoAM", estadoAM);

	var datos = new FormData();
	datos.append("activarId", codigo);
	datos.append("activarAM", estadoAM);

	$.ajax({

		url: "ajax/almacencorte.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {
            
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
                        window.location="almacencorte";}
                });}

		}
	})

	if (estadoAM == "0") {
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-warning');
		$(this).html('Sistemas');
		$(this).attr('estadoAM', "1");
	} else {
		$(this).addClass('btn-primary');
		$(this).removeClass('btn-warning');
		$(this).html('Procesado');
		$(this).attr('estadoAM', "0");
	}

})
moment.locale('es');
/*=============================================
RANGO DE FECHAS
=============================================*/

$("#daterange-btnCortes").daterangepicker(
    {
      cancelClass: "CancelarCortes",
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
      $("#daterange-btnCortes span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango4 = $("#daterange-btnCortes span").html();
  
      localStorage.setItem("capturarRango4", capturarRango4);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaAlmacenCorte").DataTable().destroy();
      cargarTablaAlmacenCortes(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarCortes").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango4");
      localStorage.removeItem("fechaInicial");
    	localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "almacencorte";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
  
    if(ruta == "almacencorte"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango4", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
        // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaAlmacenCorte").DataTable().destroy();
        cargarTablaAlmacenCortes(fechaInicial, fechaFinal);
      }
    }
  });

  $(".box").on("click", ".btnReporteAlmacen", function () {

    window.location = "vistas/reportes_excel/rpt_almacencorte.php";
  
})

$(".tablaAlmacenCorte").on("click", ".btnEditarAC", function () {
    var cod= $(this).attr("codigoAC");
   
    var datos = new FormData();
	datos.append("codigo", cod);

	$.ajax({

		url:"ajax/almacencorte.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
            $(".telaMP").remove();
			for (let i = 0; i < respuesta.length; i++) {
                $("#almacencorteMP").val(respuesta[0]["almacencorte"]);
                $("#telas").append("<div class='telaMP col-lg-12' style='padding:0px'><div class='col-lg-5 col-md-5'><label><b>Tela "+(i+1)+"</b></label><input type='text' class='form-control' name='telas[]' value='"+respuesta[i]["descripcion"]+"' readonly></div><div class='col-lg-1 col-md-1 col-lg-offset-1'><label><b>C. usada "+(i+1)+"</b></label><input type='number' min='0' step='any' class='form-control input-sm' name='cantidadMP"+i+"' id='cantidadMP"+i+"' value='"+respuesta[i]["cons_real"]+"' required></div><div class='col-lg-1 col-md-1'><label><b>C. estimad "+(i+1)+"</b></label><input type='hidden' step='any' value='"+respuesta[i]["mat_pri"]+"' name='materia"+i+"' ><input type='number' class='form-control' value='"+respuesta[i]["cons_total"]+"' name='resta"+i+"' id='resta"+i+"' readonly></div><div class='col-lg-1'><label><b>Diferencia "+(i+1)+"</b></label><input type='number'  step='any'class='form-control input-sm' step='any' name='diferenciaMP"+i+"' id='diferenciaMP"+i+"' value='"+respuesta[i]["diferencia"]+"' readonly></div><div class='col-lg-1 col-md-1'><label><b>C. recibida "+(i+1)+"</b></label><input type='number'step='any' class='form-control input-sm' name='entregaMP"+i+"' min='0' id='entregaMP"+i+"' value='"+respuesta[i]["can_entregada"]+"' required></div><div class='col-lg-1 col-md-1'><label><b>Merma "+(i+1)+"</b></label><input type='number' class='form-control input-sm' step='any' min='0' name='mermaMP"+i+"' id='mermaMP"+i+"' value='"+respuesta[i]["merma"]+"' required></div><div class='col-lg-1 col-md-1'><label><b>MP sin uso "+(i+1)+"</b></label><input type='number'step='any' class='form-control input-sm' name='sinusoMP"+i+"' id='sinusoMP"+i+"' value='"+respuesta[i]["mp_sinuso"]+"' readonly></div></div>");
               
                $("#cantidadMP"+i+"").change(function(){
                    $("#diferenciaMP"+i+"").val(Number($("#cantidadMP"+i+"").val())-Number($("#resta"+i+"").val()));
                    $("#sinusoMP"+i+"").val(Number($("#entregaMP"+i+"").val())-Number($("#cantidadMP"+i+"").val())-Number($("#mermaMP"+i+"").val()));
                })
                $("#entregaMP"+i+"").change(function(){
                    $("#sinusoMP"+i+"").val(Number($("#entregaMP"+i+"").val())-Number($("#cantidadMP"+i+"").val())-Number($("#mermaMP"+i+"").val()));
                })
                $("#mermaMP"+i+"").change(function(){
                    $("#sinusoMP"+i+"").val(Number($("#entregaMP"+i+"").val())-Number($("#cantidadMP"+i+"").val())-Number($("#mermaMP"+i+"").val()));  
                })
            }
            
			
		}

    })
})


$(".tablaAlmacenCorte").on("click", ".btnEditarNotificacion", function () {
    var cod= $(this).attr("codigoAC");
    //console.log(cod);
   
    var datos = new FormData();
	datos.append("codigo", cod);

	$.ajax({

		url:"ajax/almacencorte.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
            $(".telaMP").remove();
			for (let i = 0; i < respuesta.length; i++) {
                $("#almacencorteNot").val(respuesta[0]["almacencorte"]);
                $("#notificaciones").append("<div class='telaMP col-lg-12' style='padding:0px'><div class='col-lg-5 col-md-5'><label><b>Tela "+(i+1)+"</b></label><input type='text' class='form-control' name='telasNot[]' value='"+respuesta[i]["descripcion"]+"' readonly><br></div><div class='col-lg-1 col-md-1'><label><b>C. usada "+(i+1)+"</b></label><input type='number' '  class='form-control input-sm' value='"+respuesta[i]["cons_real"]+"' readonly><br></div><input type='hidden' step='any' value='"+respuesta[i]["mat_pri"]+"' name='materiaNot"+i+"' ><div class='col-lg-1 col-md-1'><label><b>C. recibida "+(i+1)+"</b></label><input type='number'step='any' class='form-control input-sm'    value='"+respuesta[i]["can_entregada"]+"' readonly><br></div><div class='col-lg-1 col-md-1'><label><b>Merma "+(i+1)+"</b></label><input type='number' class='form-control input-sm' step='any' min='0' name='mermaMP"+i+"' id='mermaMP"+i+"' value='"+respuesta[i]["merma"]+"' readonly><br></div><div class='col-lg-4 col-md-4'><label><b>Notificación "+(i+1)+"</b></label><textarea class='form-control input-sm' row='1' name='notificacionMP"+i+"' id='notificacionMP"+i+"'>"+respuesta[i]["notificacion"]+"</textarea></div></div>");
               
            }
            
			
		}

    })
})


if (localStorage.getItem("capturarRango17") != null) {
    $("#daterange-btnVerCierres span").html(localStorage.getItem("capturarRango17"));
    cargarTablaDetalleCortes(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
  } else {
    $("#daterange-btnVerCierres span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
    cargarTablaDetalleCortes(null, null);
  }
  
  
    
    function cargarTablaDetalleCortes(fechaInicial,fechaFinal) {
    $(".tablaDetalleCorteTotal").DataTable({
      ajax:"ajax/produccion/tabla-ver-cortes.ajax.php?perfil="+$("#perfilOculto").val() + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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
      },
      "createdRow":function(row,data,index){
        if(data[0] == "T4 - ADELA"){
          $('td',row).css({
            'background-color':'#D6C4D5',
            'color':'black'
          })
        }else if (data[0] == "T6 - PABLO"){
          $('td',row).css({
            'background-color':'#C7C1D8',
            'color':'black'
          })
        }else if(data[0] == "T9 - FRANCISCO"){
          $('td',row).css({
            'background-color':'#DADEBE',
            'color':'black'
          })
        }else if(data[0] == "TA - ELVIRA"){
          $('td',row).css({
            'background-color':'#F7E4E9',
            'color':'black'
          })
        }else if(data[0] == "T7 - GUSTAVO"){
          $('td',row).css({
            'background-color':'#D4F8F7',
            'color':'black'
          })
        }else if(data[0] == "T6 - PABLO"){
          $('td',row).css({
            'background-color':'#D4F8E2',
            'color':'black'
          })
        }else if(data[0] == "T8 - MIGUEL"){
          $('td',row).css({
            'background-color':'#F4F8D4',
            'color':'black'
          })
        }
      }
    
      });
    }

/*=============================================
RANGO DE FECHAS
=============================================*/

$("#daterange-btnVerCortes").daterangepicker(
    {
      cancelClass: "CancelarVerCortes",
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
      $("#daterange-btnVerCortes span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango17 = $("#daterange-btnVerCortes span").html();
    
      localStorage.setItem("capturarRango17", capturarRango17);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
  
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaDetalleCorteTotal").DataTable().destroy();
      cargarTablaDetalleCortes(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarVerCortes").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango17");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "almacencorte";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
  
    if(ruta == "almacencorte"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango17", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaDetalleCorteTotal").DataTable().destroy();
        cargarTablaDetalleCortes(fechaInicial, fechaFinal);
      }
    }
  });