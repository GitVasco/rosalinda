// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturarRango2") != null) {
	$("#daterange-btnes span").html(localStorage.getItem("capturarRango2"));
	cargarTablaAsistencias(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnes span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaAsistencias(null, null);
}


function cargarTablaAsistencias(fechaInicial, fechaFinal){
$('.tablaAsistencias').DataTable({
    "ajax": "ajax/produccion/tabla-asistencias.ajax.php?perfil="+$("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[3, "desc"]],
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
  });
}

/*=============================================
EDITAR Asistencia
=============================================*/
$(".tablaAsistencias").on("click", ".btnEditarAsistencia", function () {

    var idAsistencia = $(this).attr("idAsistencia");
    var datos = new FormData();
    datos.append("idAsistencia", idAsistencia);
    
    $.ajax({
        url: "ajax/asistencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          $(".para1").remove();
          $(".para2").remove();
          for (let i = 0; i < respuesta.length; i++) {
              $(".paras").append('<div class="form-group col-lg-6 para1">'+
              '<label ><strong>Para</strong></label>'+
                '<div class="input-group">'+
                '<span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>'+
                  '<input type="text" name="editarParasNombre" id="editarParasNombre" class="form-control input-lg" value="'+respuesta[i]["nombre"]+'" readonly>'+
                  '<input type="hidden" name="editarParas" id="editarParas" class="form-control input-lg" value="'+respuesta[i]["id"]+'">'+
                  '<input type="hidden" name="idDetalle'+i+'" id="idDetalle'+i+'" class="form-control input-lg" value="'+respuesta[i]["idDetalle"]+'">'+
                '</div>'+
              '</div>'+
            '<div class="form-group col-lg-6 para2">'+
              '<label><strong>Tiempo de para(minutos)</strong></label>'+
              '<div class="input-group">'+
               '<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>'+ 
                '<input type="number" class="form-control input-lg" name="editarTiempoParas'+i+'" id="editarTiempoParas'+i+'" step="any" min="0" max="585" value="'+respuesta[i]["tiempo_para"]+'" readonly>'+
              '</div>'+
            '</div>');
            $("#editarCodigo").val(respuesta[i]["id_trabajador"]);
            $("#editarTrabajador").val(respuesta[i]["nom_tra"]+" "+respuesta[i]["ape_pat_tra"]+" "+respuesta[i]["ape_mat_tra"]);
            $("#editarMinutos").val(respuesta[i]["minutos"]);
            $("#editarPara").val(respuesta[i]["para"]);
            $("#editarTiempoParas").val(respuesta[i]["tiempo_para"]);
            $("#idAsistencia").val(respuesta[i]["id"]);
            $("#cantidad").val(respuesta.length);
            $("#editarMinutos").attr("original",respuesta[i]["minutos"]);
            localStorage.setItem("cantidad", respuesta.length);
            var suma = new Array(parseInt(respuesta[i]["tiempo_para"]));
          }
          
          
        }

    })
    
    
})
$(document).ready(function(){
  for (let index = 0; index < localStorage.getItem("cantidad"); index++) {
    $(".paras").on("change","#editarTiempoParas"+index,function(){
        var nuevoValor=$("#editarMinutos").attr("original")-$(this).val();
        $("#editarMinutos").val(nuevoValor);
      });
    } 
});


/*=============================================
EDITAR NUEVA PARA
=============================================*/
$(".tablaAsistencias").on("click", ".btnEditarPara", function () {

  var idAsistencia = $(this).attr("idAsistencia");
  var datos = new FormData();
  datos.append("idAsistencia", idAsistencia);
  
  $.ajax({
      url: "ajax/asistencias.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        for (let i = 0; i < respuesta.length; i++) {
          $("#editarCodigo3").val(respuesta[i]["id_trabajador"]);
          $("#editarTrabajador3").val(respuesta[i]["nom_tra"]+" "+respuesta[i]["ape_pat_tra"]+" "+respuesta[i]["ape_mat_tra"]);
          $("#editarMinutos3").val(respuesta[i]["minutos"]);
          $("#idAsistencia3").val(respuesta[i]["id"]);
          $("#editarMinutos3").attr("original",respuesta[i]["minutos"]);
          
          $("#editarMinutos3").attr("original2",parseInt(respuesta[i]["minutos"])+parseInt(respuesta[i]["tiempo_para"]));
        }
      }

  })
  
})


$("#editarTiempoPara3").change(function(){
  if($("#editarMinutos3").attr("original2")== "NaN"){
      var nuevoValor=$("#editarMinutos3").attr("original")-$(this).val();
      $("#editarMinutos3").val(nuevoValor);
  }else{
      var nuevoValor2=$("#editarMinutos3").attr("original")-$(this).val();
      $("#editarMinutos3").val(nuevoValor2);
  }
  
  
})



// ACTIVANDO-DESACTIVANDO ARTICULO
$(".tablaAsistencias").on("click",".btnAprobarAsistencia",function(){
	// Capturamos el id del usuario y el estado
    var idAsistencia=$(this).attr("idAsistencia");
	var estadoAsistencia=$(this).attr("estadoAsistencia");
	var datos=new FormData();
	datos.append("activarId",idAsistencia);
    datos.append("activarEstado",estadoAsistencia);
    console.log(idAsistencia);
	$.ajax({
		url:"ajax/asistencias.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){
				swal({
					type: "success",
					title: "¡Ok!",
					text: "¡La información fue actualizada con éxito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location="asistencia";}
				});}
	});
	// Cambiamos el estado del botón físicamente
	if(estadoAsistencia="FALTA"){
		$(this).attr("estadoAsistencia","ASISTIO");}
	else{
		$(this).attr("estadoAsistencia","FALTA");}
});

/*=============================================
EDITAR EXTRAS
=============================================*/
$(".tablaAsistencias").on("click", ".btnEditarExtras", function () {

    var idAsistencia = $(this).attr("idAsistencia");
    var datos = new FormData();
	datos.append("idAsistencia", idAsistencia);
    $.ajax({
        url: "ajax/asistencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#editarCodigo2").val(respuesta[0]["id_trabajador"]);
            $("#editarTrabajador2").val(respuesta[0]["nom_tra"]+" "+respuesta[0]["ape_pat_tra"]+" "+respuesta[0]["ape_mat_tra"]);
            $("#editarMinutos2").val(respuesta[0]["minutos"]);
            $("#editarExtras").val(respuesta[0]["horas_extras"]);
            $("#idAsistencia2").val(respuesta[0]["id"]);
            $("#editarMinutos2").attr("originales",respuesta[0]["minutos"]);
            $("#editarMinutos2").attr("originales2",parseInt(respuesta[0]["minutos"])-parseInt(respuesta[0]["horas_extras"]));

        }

    })
    
})


$("#editarExtras").change(function(){
    if($("#editarMinutos2").attr("originales2")!=$("#editarMinutos2").attr("originales")){
        var nuevoValor=parseInt($("#editarMinutos2").attr("originales2"))+parseInt($(this).val());
        $("#editarMinutos2").val(nuevoValor);
    }else{
        var nuevoValor2=parseInt($("#editarMinutos2").attr("originales"))+parseInt($(this).val());
        $("#editarMinutos2").val(nuevoValor2);
	}
    
})


/*=============================================
RANGO DE FECHAS
=============================================*/

$("#daterange-btnes").daterangepicker(
    {
      cancelClass: "CancelarAsistencia",
      ranges: {
        HOY: [moment(), moment()],
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
      $("#daterange-btnes span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango2 = $("#daterange-btnes span").html();
  
      localStorage.setItem("capturarRango2", capturarRango2);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaAsistencias").DataTable().destroy();
      cargarTablaAsistencias(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarAsistencia").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango2");
      localStorage.removeItem("fechaInicial");
    	localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "asistencia";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
  
    if(ruta == "asistencia"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango2", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
        // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaAsistencias").DataTable().destroy();
        cargarTablaAsistencias(fechaInicial, fechaFinal);
      }
    }
  });
  
//   /* 
// * AGREGANDO LOS ARTICULOS DE ORDEN DE CORTE A CORTE
// */
// $(".agregarPara").click( function () {

//   $(this).removeClass("btn-primary agregarPara");
//   $(this).addClass("btn-default");
//   $(".paras").append('<div class="form-group col-lg-6">'+
//   '<label ><strong>Para</strong></label>'+
//     '<div class="input-group">'+
//     '<span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>'+
//       '<select name="editarParas" id="editarParas" class="form-control input-lg " data-live-search="true">'+
//         '<option value="1">Seleccionar Para</option>'+
//       '</select>'+
//     '</div>'+
//   '</div>'+
// '<div class="form-group col-lg-4">'+
//   '<label><strong>Tiempo de para</strong></label>'+
//   '<div class="input-group">'+
//    '<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>'+ 
//     '<input type="number" class="form-control input-lg" name="editarTiempoPara" id="editarTiempoPara" step="any" min="0" max="585" required>'+
//   '</div>'+
// '</div>'+
// '<div class="form-group col-lg-2">'+
//     '<div class="input-group" style="margin-top:30px">'+
//       '<button type="button" class="btn btn-primary agregarPara"><i class="fa fa-plus" ></i></button>'+
//     '</div>'+
// '</div>');
//   // var datos = new FormData();
//   // datos.append("articuloAC", articuloAC);

//   // $.ajax({

//   //     url: "ajax/articulos.ajax.php",
//   //     method: "POST",
//   //     data: datos,
//   //     cache: false,
//   //     contentType: false,
//   //     processData: false,
//   //     dataType: "json",
//   //     success: function (respuesta) {

//   //         //console.log("respuesta", respuesta);

//   //         var articulo = respuesta["articulo"];
//   //         var packing = respuesta["packing"];
//   //         var alm_corte = respuesta["alm_corte"];

//   //         /* 
//   //         todo: AGREGAR LOS CAMPOS
//   //         */

//   //         
//   //     }
//   //  })
//   });


//Reporte de Salidas
$(".box").on("click", ".btnReporteAsistencia", function () {
    window.location = "vistas/reportes_excel/rpt_asistencia.php";
  
})

// $(".btnAumentarMin").click(function(){
//   $("#aumentarFecha").val();
// })

// $(".btnRestarMin").click(function(){
//   $("#aumentarFecha").val();
// })
