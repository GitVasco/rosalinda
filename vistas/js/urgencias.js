/* 
 * BOTON VISUALIZAR URGENCIAS APT
 */
$(".tablaUrgencias").on("click", ".btnVerUrgencias", function () {

    var codigo = $(this).attr("codigo");
    //console.log("codigo", codigo);

    var datos = new FormData();
    datos.append("codigo", codigo);

    $.ajax({

        url: "ajax/urgencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            //console.log("respuesta", respuesta);

            $("#articulo").val(respuesta["articulo"]);
            $("#modelo").val(respuesta["modelo"]);
            $("#nombre").val(respuesta["nombre"]);
            $("#color").val(respuesta["color"]);
            $("#talla").val(respuesta["talla"]);
            $("#stock").val(respuesta["stockB"]);
            $("#pedidos").val(respuesta["pedidos"]);
            $("#taller").val(respuesta["taller"]);
            $("#alm_corte").val(respuesta["alm_corte"]);
            $("#ord_corte").val(respuesta["ord_corte"]);
            $("#estado").val(respuesta["estado"]);
            
        }

    })

    var codigoD = $(this).attr("codigo");
    //console.log("codigoD", codigoD);

    var datosDetalle = new FormData();
	datosDetalle.append("codigoD", codigoD);

	$.ajax({

		url:"ajax/urgencias.ajax.php",
		method: "POST",
		data: datosDetalle,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDetalle){

			//console.log("respuestaDetalle", respuestaDetalle);

            $(".detalleUrg").remove();
            
            for(var id of respuestaDetalle){

                $('.tablaDetalleUrgencia').append(

					'<tr class="detalleUrg">' +
						'<td>' + id.mat_pri + ' </td>' +
						'<td><b>' + id.descripcionMP + ' </b></td>' +
						'<td>' + id.consumo + ' </td>' +
						'<td>' + id.unidad + ' </td>' +
						'<td><center>' + id.stockMP + ' </center></td>' +
						'<td><center>' + id.tej_princ + ' </center></td>' +
						'<td><b>' + id.urgenciaMp + ' </b></td>' +
						'<td><b>' + id.alerta + ' </b></td>' +
					'</tr>'

				)

			}

		}

	})


})

/* 
 * BOTON VISUALIZAR URGENCIAS AMP
 */
$(".tablaUrgenciasAMP").on("click", ".btnVerUrgenciasAMP", function () {

	var codigoAMP = $(this).attr("codigoAMP");
    //console.log("codigoAMP", codigoAMP);

	var datosA = new FormData();
	datosA.append("codigoAMP", codigoAMP);

	$.ajax({

		url:"ajax/urgencias.ajax.php",
		method: "POST",
		data: datosA,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaA){

            //console.log("respuestaA", respuestaA);
            
            $("#codpro").val(respuestaA["codpro"]);			
			$("#codLinea").val(respuestaA["codlinea"]);
			$("#linea").val(respuestaA["linea"]);
			$("#codfab").val(respuestaA["codfab"]);
			$("#descripcion").val(respuestaA["descripcion"]);
			$("#unidad").val(respuestaA["unidad"]);
			$("#color").val(respuestaA["color"]);
			$("#stock").val(respuestaA["stock"]);
			$("#proveedor").val(respuestaA["proveedor"]);

		}

    })
    
    var codigoOC = $(this).attr("codigoAMP");
    //console.log("codigoOC", codigoOC);

	var datosB = new FormData();
	datosB.append("codigoOC", codigoOC);

	$.ajax({

		url:"ajax/urgencias.ajax.php",
		method: "POST",
		data: datosB,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaB){

			//console.log("respuestaB", respuestaB);

			$(".detalleOC").remove();

			for(var id of respuestaB){

				$('.tablaDetalleOC').append(

					'<tr class="detalleOC">' +
						'<td><b>' + id.nro + ' </b></td>' +
						'<td>' + id.emision + ' </td>' +
						'<td>' + id.llegada + ' </td>' +
						'<td><b>' + id.razpro + ' </b></td>' +
						'<td>' + id.cantidad_pedida + ' </td>' +
						'<td>' + id.saldo + ' </td>' +
						'<td>' + id.estac + ' </td>' +
					'</tr>'


				)

			}

		}

	})    

    var codigoART = $(this).attr("codigoAMP");
    console.log("codigoART", codigoART);

	var datosC = new FormData();
	datosC.append("codigoART", codigoART);

	$.ajax({

		url:"ajax/urgencias.ajax.php",
		method: "POST",
		data: datosC,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaC){

			console.log("respuestaC", respuestaC);

			$(".detalleART").remove();

			for(var id of respuestaC){

				$('.tablaDetalleART').append(

					'<tr class="detalleART">' +
						'<td>' + id.articulo + ' </td>' +
                        '<td><b>' + id.modelo + ' </b></td>' +
                        '<td>' + id.nombre + ' </td>' +
						'<td>' + id.color + ' </td>' +
						'<td>' + id.talla + ' </td>' +
						'<td>' + id.stockB + ' </td>' +
						'<td>' + id.pedidos + ' </td>' +
					'</tr>'


				)

			}

		}

	}) 

})

/* 
 * BOTON VISUALIZAR URGENCIAS APT
 */
$(".tablaUrgencias").on("click", ".btnMpFaltante", function () {

    var codigo = $(this).attr("codigo");
    //console.log("codigo", codigo);

    var datos = new FormData();
    datos.append("codigo", codigo);

    $.ajax({

        url: "ajax/urgencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            //console.log("respuesta", respuesta);

            $("#articuloA").val(respuesta["articulo"]);
            $("#modeloA").val(respuesta["modelo"]);
			$("#nombreA").val(respuesta["nombre"]);
			$("#cod_color").val(respuesta["cod_color"]);
            $("#colorA").val(respuesta["color"]);
            $("#tallaA").val(respuesta["talla"]);
            $("#stockA").val(respuesta["stockB"]);
            $("#pedidosA").val(respuesta["pedidos"]);
			$("#estadoA").val(respuesta["estado"]);
			$("#mpFaltante").val(respuesta["mp_faltante"]);

        }

    })




})