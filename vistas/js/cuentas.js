//cuentas  select ano
$("#selectAnoCuenta").change(function(){
  //ano de cuenta  
  var ano = $(this).val();
  localStorage.setItem("ano",ano);
  $(".tablaCuentas").DataTable().destroy();
  cargarTablaCuentas(ano);
  $(".btnReporteCuentas").attr("ano",localStorage.getItem("ano"));
 });

 //cuentas pendientes select ano
 $("#selectAnoCuentaP").change(function(){
  //ano de cuenta  
  var anoP = $(this).val();
  localStorage.setItem("anoP",anoP);
  $(".tablaCuentasPendientes").DataTable().destroy();
  cargarTablaCuentasPendientes(anoP);
  $(".btnReporteCuentasPendientes").attr("ano",localStorage.getItem("anoP"));
 });

 //cuentas canceladas select ano
 $("#selectAnoCuentaC").change(function(){
  //ano de cuenta  
  var anoC = $(this).val();
  localStorage.setItem("anoC",anoC);
  $(".tablaCuentasAprobadas").DataTable().destroy();
  cargarTablaCuentasAprobadas(anoC);
  $(".btnReporteCuentasAprobadas").attr("ano",localStorage.getItem("anoC"));
 });

 // Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("ano") != null) {
  $("#selectAnoCuenta").val(localStorage.getItem("ano"));
  $("#selectAnoCuenta").selectpicker("refresh");

	cargarTablaCuentas(localStorage.getItem("ano"));
  
} else {
	cargarTablaCuentas(null);
}

 //CUENTAS 
function cargarTablaCuentas(ano){
  $('.tablaCuentas').DataTable({
    "ajax": "ajax/cuentas-corrientes/tabla-cuentas.ajax.php?perfil="+$("#perfilOculto").val()+"&ano=" + ano ,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[5, "desc"]],
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
  });
}
// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("anoP") != null) {
  $("#selectAnoCuentaP").val(localStorage.getItem("anoP"));
  $("#selectAnoCuentaP").selectpicker("refresh");
	cargarTablaCuentasPendientes(localStorage.getItem("anoP"));
  
} else {
	cargarTablaCuentasPendientes(null);
}

 //CUENTAS PENDIENTES
function cargarTablaCuentasPendientes(ano){
  $('.tablaCuentasPendientes').DataTable({
    "ajax": "ajax/cuentas-corrientes/tabla-cuentas-pendientes.ajax.php?perfil="+$("#perfilOculto").val()+"&ano=" + ano ,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[5, "desc"]],
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
  });
}

// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("anoC") != null) {
  $("#selectAnoCuentaC").val(localStorage.getItem("anoC"));
  $("#selectAnoCuentaC").selectpicker("refresh");
	cargarTablaCuentasAprobadas(localStorage.getItem("anoC"));
  
} else {
	cargarTablaCuentasAprobadas(null);
}

 //CUENTAS 
function cargarTablaCuentasAprobadas(ano){
  $('.tablaCuentasAprobadas').DataTable({
    "ajax": "ajax/cuentas-corrientes/tabla-cuentas-canceladas.ajax.php?perfil="+$("#perfilOculto").val()+"&ano=" + ano ,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[5, "desc"]],
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
  });
}

  $("#nuevoMonto").change(function(){
    var saldo = $(this).val();
    $("#nuevoSaldo").val(saldo);
    estadoSaldo2();
  });
  function estadoSaldo2(){
    var saldo = $("#nuevoSaldo").val();
    if(saldo== "0"){
      $("#nuevoEstado1").val("CANCELADO");
      $("#nuevoEstado1").css("background-color", "green");
      $("#nuevoEstado1").css("color", "white");
    }else{
      $("#nuevoEstado1").val("PENDIENTE");
      $("#nuevoEstado1").css("background-color", "red");
      $("#nuevoEstado1").css("color", "white");
    }
  }
/*=============================================
EDITAR TIPO DE PAGO
=============================================*/
$(".tablaCuentas").on("click", ".btnEditarCuenta", function () {

    var idCuenta = $(this).attr("idCuenta");

    var datos = new FormData();
    datos.append("idCuenta", idCuenta);

    $.ajax({

        url: "ajax/cuentas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idCuenta").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["tipo_doc"]);
            $("#editarCodigo").selectpicker('refresh');
            $("#editarDocumento").val(respuesta["num_cta"]);
            $("#editarNota").val(respuesta["notas"]);
            $("#editarVendedor").val(respuesta["vendedor"]);
            $("#editarVendedor").selectpicker('refresh');
            if(respuesta["renovacion"] == 1){
              $("#editarRenovacion").prop('checked',true);
            }
            if(respuesta["protesta"] == 1){
              $("#editarProtestado").prop('checked',true);
            }
            $("#editarBanco").val(respuesta["banco"]);
            $("#editarBanco").selectpicker('refresh');
            $("#editarTipoDocumento").val(respuesta["cod_pago"]);
            $("#editarTipoDocumento").selectpicker('refresh');
            $("#editarFecha").val(respuesta["fecha"]);
            $("#editarFechaVenc").val(respuesta["fecha_ven"]);
            $("#editarUnico").val(respuesta["num_unico"]);
            $("#editarOrigen").val(respuesta["doc_origen"]);
            $("#editarFechaAcep").val(respuesta["fecha_cep"]);
            $("#editarFechaEnvio").val(respuesta["fecha_envio"]);
            $("#editarSaldo").val(respuesta["saldo"]);
            $("#editarFechaUltima").val(respuesta["ult_pago"]);
            $("#editarMoneda").val(respuesta["tip_mon"]);
            $("#editarMoneda").selectpicker('refresh');
            $("#editarFechaAbono").val(respuesta["fecha_abono"]);
            $("#editarEstado1").val(respuesta["estado"]);
            $("#editarMonto").val(respuesta["monto"]);
            $("#editarTipoCambio").val(respuesta["tip_cambio"]);
            $("#editarEstado").val(respuesta["estado_doc"]);
            $("#editarEstado").selectpicker('refresh');

            
            var clienteCuenta = "1";

            var datos = new FormData();
            datos.append("clienteCuenta", clienteCuenta);
            $.ajax({

              url: "ajax/clientes.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              dataType: "json",
              success: function (respuesta2) {
                
                $("#editarCliente").find('option').remove();
                
                
                for (let i = 0; i < respuesta2.length; i++) {
                  
                  $("#editarCliente").append("<option value='"+respuesta2[i]["codigo"]+"'>"+respuesta2[i]["codigo"]+" - "+respuesta2[i]["nombre"]+"</option>");
                  
                }
                $("#editarCliente").val(respuesta["cliente"]);
                $("#editarCliente").selectpicker("refresh");
              }

          })
        }

    })

})

$(".tablaCuentasPendientes").on("click", ".btnEditarCuenta", function () {

  var idCuenta = $(this).attr("idCuenta");

  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

          $("#idCuenta").val(respuesta["id"]);
          $("#editarCodigo").val(respuesta["tipo_doc"]);
          $("#editarCodigo").selectpicker('refresh');
          $("#editarDocumento").val(respuesta["num_cta"]);
          $("#editarNota").val(respuesta["notas"]);
          $("#editarVendedor").val(respuesta["vendedor"]);
          $("#editarVendedor").selectpicker('refresh');
          if(respuesta["renovacion"] == 1){
            $("#editarRenovacion").prop('checked',true);
          }
          if(respuesta["protesta"] == 1){
            $("#editarProtestado").prop('checked',true);
          }
          $("#editarBanco").val(respuesta["banco"]);
          $("#editarBanco").selectpicker('refresh');
          $("#editarTipoDocumento").val(respuesta["cod_pago"]);
          $("#editarTipoDocumento").selectpicker('refresh');
          $("#editarFecha").val(respuesta["fecha"]);
          $("#editarFechaVenc").val(respuesta["fecha_ven"]);
          $("#editarUnico").val(respuesta["num_unico"]);
          $("#editarOrigen").val(respuesta["doc_origen"]);
          $("#editarFechaAcep").val(respuesta["fecha_cep"]);
          $("#editarFechaEnvio").val(respuesta["fecha_envio"]);
          $("#editarSaldo").val(respuesta["saldo"]);
          $("#editarFechaUltima").val(respuesta["ult_pago"]);
          $("#editarMoneda").val(respuesta["tip_mon"]);
          $("#editarMoneda").selectpicker('refresh');
          $("#editarFechaAbono").val(respuesta["fecha_abono"]);
          $("#editarEstado1").val(respuesta["estado"]);
          $("#editarMonto").val(respuesta["monto"]);
          $("#editarTipoCambio").val(respuesta["tip_cambio"]);
          $("#editarEstado").val(respuesta["estado_doc"]);
          $("#editarEstado").selectpicker('refresh');

          
          var clienteCuenta = "1";

          var datos = new FormData();
          datos.append("clienteCuenta", clienteCuenta);
          $.ajax({

            url: "ajax/clientes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta2) {
              
              $("#editarCliente").find('option').remove();
              
              
              for (let i = 0; i < respuesta2.length; i++) {
                
                $("#editarCliente").append("<option value='"+respuesta2[i]["codigo"]+"'>"+respuesta2[i]["codigo"]+" - "+respuesta2[i]["nombre"]+"</option>");
                
              }
              $("#editarCliente").val(respuesta["cliente"]);
              $("#editarCliente").selectpicker("refresh");
            }

        })
      }

  })

})

$(".tablaCuentasAprobadas").on("click", ".btnEditarCuenta", function () {

  var idCuenta = $(this).attr("idCuenta");

  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

          $("#idCuenta").val(respuesta["id"]);
          $("#editarCodigo").val(respuesta["tipo_doc"]);
          $("#editarCodigo").selectpicker('refresh');
          $("#editarDocumento").val(respuesta["num_cta"]);
          $("#editarNota").val(respuesta["notas"]);
          $("#editarVendedor").val(respuesta["vendedor"]);
          $("#editarVendedor").selectpicker('refresh');
          if(respuesta["renovacion"] == 1){
            $("#editarRenovacion").prop('checked',true);
          }
          if(respuesta["protesta"] == 1){
            $("#editarProtestado").prop('checked',true);
          }
          $("#editarBanco").val(respuesta["banco"]);
          $("#editarBanco").selectpicker('refresh');
          $("#editarTipoDocumento").val(respuesta["cod_pago"]);
          $("#editarTipoDocumento").selectpicker('refresh');
          $("#editarFecha").val(respuesta["fecha"]);
          $("#editarFechaVenc").val(respuesta["fecha_ven"]);
          $("#editarUnico").val(respuesta["num_unico"]);
          $("#editarOrigen").val(respuesta["doc_origen"]);
          $("#editarFechaAcep").val(respuesta["fecha_cep"]);
          $("#editarFechaEnvio").val(respuesta["fecha_envio"]);
          $("#editarSaldo").val(respuesta["saldo"]);
          $("#editarFechaUltima").val(respuesta["ult_pago"]);
          $("#editarMoneda").val(respuesta["tip_mon"]);
          $("#editarMoneda").selectpicker('refresh');
          $("#editarFechaAbono").val(respuesta["fecha_abono"]);
          $("#editarEstado1").val(respuesta["estado"]);
          $("#editarMonto").val(respuesta["monto"]);
          $("#editarTipoCambio").val(respuesta["tip_cambio"]);
          $("#editarEstado").val(respuesta["estado_doc"]);
          $("#editarEstado").selectpicker('refresh');

          
          var clienteCuenta = "1";

          var datos = new FormData();
          datos.append("clienteCuenta", clienteCuenta);
          $.ajax({

            url: "ajax/clientes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta2) {
              
              $("#editarCliente").find('option').remove();
              
              
              for (let i = 0; i < respuesta2.length; i++) {
                
                $("#editarCliente").append("<option value='"+respuesta2[i]["codigo"]+"'>"+respuesta2[i]["codigo"]+" - "+respuesta2[i]["nombre"]+"</option>");
                
              }
              $("#editarCliente").val(respuesta["cliente"]);
              $("#editarCliente").selectpicker("refresh");
            }

        })
      }

  })

})

$("#cancelarMonto").keyup(function(){
  var saldo = $(this).val();
  var saldoAntiguo = $("#cancelarSaldoAntiguo").val();
  var diferencia =  saldoAntiguo - saldo;
  $("#cancelarSaldo").val(diferencia);
  if(diferencia<0){
    swal({
      title: "La cantidad supera el Saldo de la cuenta ",
      text: "¡Sólo hay S/. " + saldoAntiguo + " de saldo!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });
    $(this).val("");
    $("#cancelarSaldo").val(saldoAntiguo);
    return;
  }
  
});

$("#editarMonto").change(function(){
  var saldo = $(this).val();
  $("#editarSaldo").val(saldo);
  estadoSaldo();
});
function estadoSaldo(){
  var saldo = $("#editarSaldo").val();
  if(saldo== "0"){
    $("#editarEstado1").val("CANCELADO");
  }else{
    $("#editarEstado1").val("PENDIENTE");
  }
}



/*=============================================
ELIMINAR TIPO DE PAGO
=============================================*/
$(".tablaCuentas").on("click", ".btnEliminarCuenta", function(){

	var idCuenta = $(this).attr("idCuenta");
  var rutas = "cuentas";
	
	swal({
        title: '¿Está seguro de borrar la cuenta?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cuenta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cuentas&idCuenta="+idCuenta+"&rutas=" + rutas;
        }

  })

})

$(".tablaCuentasPendientes").on("click", ".btnEliminarCuenta", function(){

	var idCuenta = $(this).attr("idCuenta");
	var rutas = "cuentas-pendientes";
	swal({
        title: '¿Está seguro de borrar la cuenta?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cuenta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cuentas&idCuenta="+idCuenta+"&rutas=" + rutas;
        }

  })

})

$(".tablaCuentasAprobadas").on("click", ".btnEliminarCuenta", function(){

	var idCuenta = $(this).attr("idCuenta");
	var rutas = "cuentas-canceladas";
	swal({
        title: '¿Está seguro de borrar la cuenta?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cuenta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cuentas&idCuenta="+idCuenta+"&rutas=" + rutas;
        }

  })

})

//Reporte de Cuentas
$(".box").on("click", ".btnReporteCuentas", function () {
    var ano = $(this).attr("ano");
    window.location = "vistas/reportes_excel/rpt_cuentas.php?ano="+ano;
  
})

//Reporte de Cuentas
$(".box").on("click", ".btnReporteCuentasPendientes", function () {
    var anoP = $(this).attr("ano");
    window.location = "vistas/reportes_excel/rpt_cuentas_pendientes.php?anoP="+anoP;

})

//Reporte de Cuentas
$(".box").on("click", ".btnReporteCuentasAprobadas", function () {
    var anoC = $(this).attr("ano");
    window.location = "vistas/reportes_excel/rpt_cuentas_aprobadas.php?anoC="+anoC;

})

$(".box").on("click", ".btnCodigoCuenta", function () {
  
  $("#nuevaMoneda").val("Soles");
  $("#nuevaMoneda").selectpicker("refresh");

  var clienteCuenta = "1";

  var datos = new FormData();
  datos.append("clienteCuenta", clienteCuenta);
  $.ajax({

    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      $("#nuevoClienteCuenta").find('option').remove();
			$("#nuevoClienteCuenta").append('<option value="">Seleccionar cliente</option>');
      for (let i = 0; i < respuesta.length; i++) {
        
        $("#nuevoClienteCuenta").append("<option value='"+respuesta[i]["codigo"]+"'>"+respuesta[i]["codigo"]+" - "+respuesta[i]["nombre"]+"</option>");
        
      }
      $("#nuevoClienteCuenta").selectpicker("refresh");
    }

})

  
  
})

$(".tablaCuentas").on("click", ".btnVisualizarCuenta", function () {
  var numCuenta = $(this).attr("numCta");
  localStorage.setItem("numCta2",numCuenta);
  var rutas="cuentas";
  window.location = "index.php?ruta=ver-cuentas&numCta=" + numCuenta +"&rutas=" + rutas;

})

$(".tablaCuentasPendientes").on("click", ".btnVisualizarCuenta", function () {
  var numCuenta = $(this).attr("numCta");
  localStorage.setItem("numCta2",numCuenta);
  var rutas="cuentas-pendientes";
  window.location = "index.php?ruta=ver-cuentas&numCta=" + numCuenta  +"&rutas=" + rutas;

})

$(".tablaCuentasAprobadas").on("click", ".btnVisualizarCuenta", function () {
  var numCuenta = $(this).attr("numCta");
  localStorage.setItem("numCta2",numCuenta);
  var rutas="cuentas-canceladas";
  window.location = "index.php?ruta=ver-cuentas&numCta=" + numCuenta  +"&rutas=" + rutas;

})

$(".tablaCuentasConsultar").on("click", ".btnVisualizarCuentaConsultar", function () {
  var numCuenta = $(this).attr("numCta");
  localStorage.setItem("numCta",numCuenta);
  
  window.location = "index.php?ruta=ver-cuentas-consultar&numCta=" + numCuenta ;

  
})

/*=============================================
ELIMINAR TIPO DE PAGO
=============================================*/
$(".tablaVerCuentas").on("click", ".btnEliminarCancelacion", function(){

	var idCancelacion = $(this).attr("idCancelacion");
	swal({
        title: '¿Está seguro de borrar la cancelación?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cancelación!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ver-cuentas&idCancelacion="+idCancelacion;
        }

  })

})

$(".tablaVerCuentas").on("click", ".btnEditarCancelacion", function () {

  var idCancelacion = $(this).attr("idCancelacion");
  var datos = new FormData();
  datos.append("idCancelacion", idCancelacion);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        //console.log(respuesta);
          $("#idCuenta2").val(respuesta["id"]);
          $("#cancelarDocumento").val(respuesta["num_cta"]);
          $("#docEditar").val(respuesta["num_cta"]);
          $("#cancelarNota").val(respuesta["notas"]);
          $("#cancelarCodigo").val(respuesta["cod_pago"]);
          $("#tipEditar").val(respuesta["tipo_doc"]);
          $("#cancelarCodigo").selectpicker('refresh');
          $("#cancelarVendedor").val(respuesta["vendedor"]);
          $("#cancelarCliente").val(respuesta["cliente"]);
          $("#cancelarFechaUltima").val(respuesta["fecha"]);
          $("#cancelarMonto2").val(respuesta["monto"]);
          $("#cancelarMontoAntiguo").val(respuesta["monto"]);
          $("#cliEditar").val(respuesta["cliente"]);
      }

  })

})


$("#cancelarMonto2").change(function(){

    var montoNuevo = $(this).val();
    var saldoAntiguo = $("#cancelarSaldoAntiguo").val();
    var montoAntiguo = $("#cancelarMontoAntiguo").val();

    var disponible = Number(saldoAntiguo) + Number(montoAntiguo);

    var validar = Number(saldoAntiguo) + Number(montoAntiguo) - Number(montoNuevo);

    //console.log(validar);  

    if(validar >= 0){

    }else{

      swal({
        title: "La cantidad supera el Saldo de la cuenta ",
        text: "¡Sólo hay S/. " + disponible + " de saldo!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  
      return;

    }

});


$(".tablaCuentas").on("click", ".btnAgregarLetra", function () {

  var idCuenta = $(this).attr("idCuenta");
  var cliente = $(this).attr("cliente");
  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          $("#idCuenta3").val(respuesta["id"]);
          $("#letraCodigo").val(respuesta["tipo_doc"]);
          $("#letraDocumento").val(respuesta["num_cta"]);
          $("#letraUsuario").val(respuesta["usuario"]);
          $("#letraVendedor").val(respuesta["vendedor"]);
          $("#letraCli").val(respuesta["cliente"]);
          $("#letraFecha").val(respuesta["fecha"]);
          $("#letraMonto").val(respuesta["monto"]);
          $("#letraSaldo").val(respuesta["saldo"]);
          $("#letraMoneda").val(respuesta["tip_mon"]);
          $("#letraCliente").val(cliente);
          $(".letraCuenta").remove();
      }

  })

})

$(".tablaCuentasPendientes").on("click", ".btnAgregarLetra", function () {

  var idCuenta = $(this).attr("idCuenta");
  var cliente = $(this).attr("cliente");
  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          $("#idCuenta3").val(respuesta["id"]);
          $("#letraCodigo").val(respuesta["tipo_doc"]);
          $("#letraDocumento").val(respuesta["num_cta"]);
          $("#letraUsuario").val(respuesta["usuario"]);
          $("#letraVendedor").val(respuesta["vendedor"]);
          $("#letraCli").val(respuesta["cliente"]);
          $("#letraFecha").val(respuesta["fecha"]);
          $("#letraMonto").val(respuesta["monto"]);
          $("#letraSaldo").val(respuesta["saldo"]);
          $("#letraMoneda").val(respuesta["tip_mon"]);
          $("#letraCliente").val(cliente);
          $(".letraCuenta").remove();
      }

  })

})

$(".tablaCuentasAprobadas").on("click", ".btnAgregarLetra", function () {

  var idCuenta = $(this).attr("idCuenta");
  var cliente = $(this).attr("cliente");
  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          $("#idCuenta3").val(respuesta["id"]);
          $("#letraCodigo").val(respuesta["tipo_doc"]);
          $("#letraDocumento").val(respuesta["num_cta"]);
          $("#letraUsuario").val(respuesta["usuario"]);
          $("#letraVendedor").val(respuesta["vendedor"]);
          $("#letraCli").val(respuesta["cliente"]);
          $("#letraFecha").val(respuesta["fecha"]);
          $("#letraMonto").val(respuesta["monto"]);
          $("#letraSaldo").val(respuesta["saldo"]);
          $("#letraMoneda").val(respuesta["tip_mon"]);
          $("#letraCliente").val(cliente);
          $(".letraCuenta").remove();
      }

  })

})

$(".btnGenerarLetra").click(function(){
  $(this).attr("disabled", true);
  $(this).removeClass("btn-primary");
  $(this).addClass("btn-default");
  var nroLetra = $("#nroLetra").val();  
  var saldo=$("#letraSaldo").val();
  var montoLetra=Number(saldo)/Number(nroLetra);
  var fecha= new Date($("#letraFecha").val());
  var sumaDias = Number($("#sumaFecha").val())+1;
  var intervalo=Number($("#sumaIntervalo").val());
  fecha.setDate(fecha.getDate() + sumaDias);
  var mes=(fecha.getMonth() + 1);
  var dia =fecha.getDate();
  if(mes.toString().length == 1){
    if(dia.toString().length == 1){
      var resultado= fecha.getFullYear() + '-0' +
      (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
    }else{
      var resultado= fecha.getFullYear() + '-0' +
      (fecha.getMonth() + 1) + '-' + fecha.getDate();
    }
  }else{
    if(dia.toString().length == 1){
      var resultado= fecha.getFullYear() + '-' +
      (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
    }else{
      var resultado= fecha.getFullYear() + '-' +
      (fecha.getMonth() + 1) + '-' + fecha.getDate();
    }
  }
  
  
  for (let index = 0; index < nroLetra; index++) {
    
    if(index==0){
      $(".listaLetras").append(
        '<div class="letraCuenta col-lg-12" style="padding:0px">'+
          '<div class="col-lg-3" style="padding-top:10px">' +
              '<input type="date" class="form-control "   name="fechaVenc[]" value="'+ resultado +'"  required>' +
          '</div>'+
          '<div class="col-lg-6" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="obs'+index+'" value="Letra '+(index+1)+'"  >' +
          '</div>'+
          '<div class="col-lg-2" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="monto'+index+'" value="' + montoLetra.toFixed(2) + '" readonly required>' +
          '</div>'+
          '<div class="col-lg-12"></div><br>'+
        '</div>' );
    }
    else{
    fecha.setDate(fecha.getDate() + intervalo);
    var mes2=(fecha.getMonth() + 1);
    var dia2 =fecha.getDate();
    if(mes2.toString().length == 1){
      if(dia2.toString().length == 1){
        var resultado2= fecha.getFullYear() + '-0' +
        (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
      }else{
        var resultado2= fecha.getFullYear() + '-0' +
        (fecha.getMonth() + 1) + '-' + fecha.getDate();
      }
    }else{
      if(dia2.toString().length == 1){
        var resultado2= fecha.getFullYear() + '-' +
        (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
      }else{
        var resultado2= fecha.getFullYear() + '-' +
        (fecha.getMonth() + 1) + '-' + fecha.getDate();
      }
    }
      $(".listaLetras").append(
        '<div class="letraCuenta col-lg-12" style="padding:0px">'+
          '<div class="col-lg-3" style="padding-top:10px">' +
              '<input type="date" class="form-control "   name="fechaVenc[]" value="'+resultado2+'"  required>' +
          '</div>'+
          '<div class="col-lg-6" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="obs'+index+'"  value="Letra '+(index+1)+'"  >' +
          '</div>'+
          '<div class="col-lg-2" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="monto'+index+'" value="' + montoLetra.toFixed(2) + '" readonly required>' +
          '</div>'+
          '<div class="col-lg-12"></div><br>'+
        '</div>' );
    }
    
  }
   
});
$(".btnLimpiarLetra").click(function(){
  $(".btnGenerarLetra").removeAttr('disabled');
  $(".btnGenerarLetra").removeClass("btn-default");
  $(".btnGenerarLetra").addClass("btn-primary");
  $(".letraCuenta").remove();
});



$(".btnCancelarCuenta2").click(function(){
  var numCta = $(this).attr("numCta");
  var datos = new FormData();
  datos.append("numCta", numCta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          $("#idCuenta3").val(respuesta["id"]);
          $("#cancelarTipoDocumento2").val(respuesta["tipo_doc"]);
          $("#cancelarDocumentoOriginal2").val(respuesta["num_cta"]);
          $("#cancelarDocumento2").val(respuesta["num_cta"]);
          $("#cancelarVendedor2").val(respuesta["vendedor"]);
          $("#cancelarFechaOrigen2").val(respuesta["fecha"]);
          $("#cancelarVencimientoOrigen2").val(respuesta["fecha_ven"]);
          $("#cancelarCliente2").val(respuesta["cliente"]);
          $("#cancelarClienteNomOrigen2").val(respuesta["nombre"]);
          $("#cancelarSaldo2").val(respuesta["saldo"]);
          $("#cancelarSaldoAntiguo2").val(respuesta["saldo"]);
          $("#cancelarEstado2").val(respuesta["estado"]);
          $("#cancelarNumUnico2").val(respuesta["estado"]);
          $("#cancelarTotal2").val(respuesta["saldo"]);
      }

  })
});

$("#cancelarMonto3").change(function(){
  var saldo = $(this).val();
  var saldoAntiguo = $("#cancelarSaldoAntiguo2").val();
  var diferencia =  saldoAntiguo - saldo;
  $("#cancelarSaldo2").val(diferencia);
  if(diferencia<0){
    swal({
      title: "La cantidad supera el Saldo de la cuenta ",
      text: "¡Sólo hay S/. " + saldoAntiguo + " de saldo!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });
    $(this).val("");
    $("#cancelarSaldo2").val(saldoAntiguo);
    return;
  }
});
$("#tipoCliente").change(function(){
  var cliente = $(this).val();
  var descripcion = $(this).find('option:selected').text();
  $(".tablaCuentasConsultar").DataTable().destroy();
  localStorage.setItem("cliente",cliente);
  sessionStorage.setItem("desCliente",descripcion);
  /* console.log("codigo", codigo); */
  //traer nombre de cliente
  var datos = new FormData();
  datos.append("codigo", cliente);

  $.ajax({

    url:"ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      $("#consultaCliente").val(respuesta["codigo"]+" - "+respuesta["nombre"])
      $("#consultaCliente").css("background-color", "darkblue");
      $("#consultaCliente").css("color", "white");
    }

  })

  //traer total credito
  var datos2 = new FormData();
  datos2.append("clienteCredito", cliente);

  $.ajax({

    url:"ajax/cuentas.ajax.php",
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta2){
      var credito = parseFloat(respuesta2["total_credito"]);
      $("#consultaCredito").val("S/ "+new Intl.NumberFormat('de-DE').format(credito.toFixed(2)));
      $("#consultaCredito").css("background-color", "green");
      $("#consultaCredito").css("color", "white");
    }

  })

  //traer total deuda
  var datos3 = new FormData();
  datos3.append("clienteDeuda", cliente);

  $.ajax({

    url:"ajax/cuentas.ajax.php",
    method: "POST",
    data: datos3,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta3){
        if(respuesta3 ==  false){
          $("#consultaDeudaTot").val("S/ 0")
        }else{
          var deuda = parseFloat(respuesta3["total_deuda"]);
          $("#consultaDeudaTot").val("S/ "+new Intl.NumberFormat('de-DE').format(deuda.toFixed(2)));
        }
      $("#consultaDeudaTot").css("background-color", "green");
      $("#consultaDeudaTot").css("color", "white");
    }

  })

  //traer deuda vencida
  var datos4 = new FormData();
  datos4.append("clienteDeudaVencida", cliente);

  $.ajax({

    url:"ajax/cuentas.ajax.php",
    method: "POST",
    data: datos4,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta4){
      if(respuesta4 == false){
        $("#consultaDeudaVen").val("S/ 0")
      }else{
        var deudaVen = parseFloat(respuesta4["total_vencido"]);
        $("#consultaDeudaVen").val("S/ "+new Intl.NumberFormat('de-DE').format(deudaVen.toFixed(2)));
        
      }
      
      $("#consultaDeudaVen").css("background-color", "red");
      $("#consultaDeudaVen").css("color", "white");
    }

  })
  cargarTablaCuentasConsultar(cliente);
 });

  // Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("cliente") != null) {
  $("#tipoCliente").find('option').remove();
  $("#tipoCliente").append("<option value='' selected>"+sessionStorage.getItem("desCliente")+"</option>");
  $("#tipoCliente").selectpicker("refresh");
	cargarTablaCuentasConsultar(localStorage.getItem("cliente"));
} else {
	cargarTablaCuentasConsultar(null);
}

//CUENTAS consultar
function cargarTablaCuentasConsultar(cliente){
$('.tablaCuentasConsultar').DataTable({
  "ajax": "ajax/cuentas-corrientes/tabla-cuentas-consultar.ajax.php?perfil="+$("#perfilOculto").val()+"&cliente=" + cliente ,
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "order": [[5, "asc"]],
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
});
}

//Dividir letra

$(".tablaCuentas").on("click", ".btnDividirLetra", function () {

  var idCuenta = $(this).attr("idCuenta");
  var cliente = $(this).attr("cliente");

  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          console.log(respuesta);
          $("#idCuenta4").val(respuesta["id"]);
          $("#dividirDocumento").val(respuesta["tipo_doc"]);
          $("#dividirNroDocumento").val(respuesta["num_cta"]);
          $("#dividirFecha").val(respuesta["fecha"]);
          $("#dividirFechaVencimiento").val(respuesta["fecha_ven"]);
          $("#dividirSaldo").val(respuesta["saldo"]);
          $("#dividirVendedor").val(respuesta["vendedor"]);
          $("#dividirCliente").val(respuesta["cliente"]);
          $("#dividirNomCliente").val(cliente);
          $("#dividirFecha2").val(respuesta["fecha_ven"]);
          $("#dividirNroDocumento2").val(respuesta["num_cta"]);

          var fecha= new Date(respuesta["fecha_ven"]);
          fecha.setDate(fecha.getDate() + 31);
          var mes=(fecha.getMonth() + 1);
          var dia =fecha.getDate();
          if(mes.toString().length == 1){
            if(dia.toString().length == 1){
              var resultado= fecha.getFullYear() + '-0' +
              (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
            }else{
              var resultado= fecha.getFullYear() + '-0' +
              (fecha.getMonth() + 1) + '-' + fecha.getDate();
            }
          }else{
            if(dia.toString().length == 1){
              var resultado= fecha.getFullYear() + '-' +
              (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
            }else{
              var resultado= fecha.getFullYear() + '-' +
              (fecha.getMonth() + 1) + '-' + fecha.getDate();
            }
          }
          $("#dividirFechaVencimiento2").val(resultado);
      }

  })

})

$(".tablaCuentasPendientes").on("click", ".btnDividirLetra", function () {

  var idCuenta = $(this).attr("idCuenta");
  var cliente = $(this).attr("cliente");

  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          console.log(respuesta);
          $("#idCuenta4").val(respuesta["id"]);
          $("#dividirDocumento").val(respuesta["tipo_doc"]);
          $("#dividirNroDocumento").val(respuesta["num_cta"]);
          $("#dividirFecha").val(respuesta["fecha"]);
          $("#dividirFechaVencimiento").val(respuesta["fecha_ven"]);
          $("#dividirSaldo").val(respuesta["saldo"]);
          $("#dividirVendedor").val(respuesta["vendedor"]);
          $("#dividirCliente").val(respuesta["cliente"]);
          $("#dividirNomCliente").val(cliente);
          $("#dividirFecha2").val(respuesta["fecha_ven"]);
          $("#dividirNroDocumento2").val(respuesta["num_cta"]);

          var fecha= new Date(respuesta["fecha_ven"]);
          fecha.setDate(fecha.getDate() + 31);
          var mes=(fecha.getMonth() + 1);
          var dia =fecha.getDate();
          if(mes.toString().length == 1){
            if(dia.toString().length == 1){
              var resultado= fecha.getFullYear() + '-0' +
              (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
            }else{
              var resultado= fecha.getFullYear() + '-0' +
              (fecha.getMonth() + 1) + '-' + fecha.getDate();
            }
          }else{
            if(dia.toString().length == 1){
              var resultado= fecha.getFullYear() + '-' +
              (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
            }else{
              var resultado= fecha.getFullYear() + '-' +
              (fecha.getMonth() + 1) + '-' + fecha.getDate();
            }
          }
          $("#dividirFechaVencimiento2").val(resultado);
      }

  })

})


$(".box").on("click", "#cargaClienteCuenta", function () {
  var clienteCuenta = "1";

  var datos = new FormData();
  datos.append("clienteCuenta", clienteCuenta);
  $.ajax({

    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#tipoCliente").find('option').remove();
			$("#tipoCliente").append('<option value="">Seleccionar cliente</option>');
      for (let i = 0; i < respuesta.length; i++) {
        
        $("#tipoCliente").append("<option value='"+respuesta[i]["codigo"]+"'>"+respuesta[i]["codigo"]+" - "+respuesta[i]["nombre"]+"</option>");
        
      }
      $("#tipoCliente").selectpicker("refresh");
    }

  })  
  
});

if (localStorage.getItem("numCta") != null) {
	cargarTablaVerCuentasConsultar(localStorage.getItem("numCta"));
} else {
	cargarTablaVerCuentasConsultar(null);
}

//CUENTAS consultar
function cargarTablaVerCuentasConsultar(numCta){
$('.tablaVerCuentasConsultar').DataTable({
  "ajax": "ajax/cuentas-corrientes/tabla-ver-cuentas-consultar.ajax.php?perfil="+$("#perfilOculto").val()+"&numCta=" + numCta ,
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "order": [[0, "asc"]],
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
});
}

if (localStorage.getItem("numCta2") != null) {
	cargarTablaVerCuentas(localStorage.getItem("numCta2"));
} else {
	cargarTablaVerCuentas(null);
}

//CUENTAS consultar
function cargarTablaVerCuentas(numCta){
$('.tablaVerCuentas').DataTable({
  "ajax": "ajax/cuentas-corrientes/tabla-ver-cuentas.ajax.php?perfil="+$("#perfilOculto").val()+"&numCta=" + numCta ,
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "order": [[0, "asc"]],
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
});
}

$('.tablaEnvioLetras').DataTable({
  "ajax": "ajax/cuentas-corrientes/tabla-envio-letras.ajax.php?perfil="+$("#perfilOculto").val(),
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "order": [[0, "asc"]],
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
});


/* 
* AGREGANDO LOS ARTICULOS DE ORDEN DE CORTE A CORTE
*/

$(".tablaEnvioLetras tbody").on("click", "button.agregarEnvioCuenta", function () {

  var idcuenta = $(this).attr("idcuenta");
  //console.log("ordcorte", ordcorte);
  //console.log("articuloAC", articuloAC);
  //console.log("idCorte", idCorte);
  //console.log("saldo", saldo);

  $(this).removeClass("btn-primary agregarEnvioCuenta");
  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("letraCuenta", idcuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

          // console.log("respuesta", respuesta);

          var nrocta = respuesta["cuenta"];
          var cliente = respuesta["cliente"]+"-"+respuesta["nombre"];
          var monto = respuesta["monto"];

          /* 
          todo: AGREGAR LOS CAMPOS
          */

          $(".nuevoCampoEnvio").append(

              '<div class="row" style="padding:5px 15px">' +

                  "<!-- Numero de CUENTA Y QUITAR -->" +

                  '<div class="col-xs-3" style="padding-right:0px">' +

                      '<div class="input-group">' +
                      
                          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarEnvioCuenta" idcuenta="' + idcuenta + '"><i class="fa fa-times"></i></button></span>' +

                          '<input type="text" class="form-control nuevoNumCuenta"   name="nrocta" value="' + nrocta + '" idcuenta="' + idcuenta + '" fecha_ven ="'+respuesta["fechaVen"]+'" readonly required>' +

                      "</div>" +

                  "</div>" +

                  "<!-- Descripción del CLIENTE -->" +

                  '<div class="col-xs-7" style="padding-right:0px">' +                        

                          '<input type="text" class="form-control nuevaDescripcionCliente" name="cliente" value="' + cliente + '"  nombres ="'+respuesta["nombres"]+'" ape_pat ="'+respuesta["ape_paterno"]+'" ape_mat ="'+respuesta["ape_materno"]+'" documento ="'+respuesta["documento"]+'" readonly required>' +                        

                  "</div>" +

                  "<!-- MONTO -->" +

                  '<div class="col-xs-2">' +

                      '<input type="number" class="form-control nuevoMonto" name="nuevoMonto"  value="' + monto + '" readonly required>' +

                  "</div>" +               
              
              "</div>"

          );

          // SUMAR TOTAL DE UNIDADES

          sumarTotalEnvio();


          

          // AGRUPAR PRODUCTOS EN FORMATO JSON

          listarCuentas();


                    
      }

  })


});

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaEnvioLetras").on("draw.dt", function () {
  /* console.log("tabla"); */

  if (localStorage.getItem("quitarEnvioCuenta") != null) {
      var listaIdEnvioCuenta = JSON.parse(localStorage.getItem("quitarEnvioCuenta"));
      //console.log("listaIdArticuloAC", listaIdArticuloAC);
      

      for (var i = 0; i < listaIdEnvioCuenta.length; i++) {
          $("button.recuperarEnvioCuenta[idcuenta='" + listaIdEnvioCuenta[i]["idcuenta"] + "']").removeClass("btn-default");

          $("button.recuperarEnvioCuenta[idcuenta='" + listaIdEnvioCuenta[i]["idcuenta"] + "']").addClass("btn-primary agregarEnvioCuenta");
      }
  }
});

/* 
* QUITAR ARTICULO DE CORTE Y RECUPERAR BOTÓN
*/
var idQuitarEnvioCuenta = [];

localStorage.removeItem("quitarEnvioCuenta");

$(".formularioEnvioLetra").on("click", "button.quitarEnvioCuenta", function () {

  /* console.log("boton"); */

  $(this).parent().parent().parent().parent().remove();

  var idcuenta = $(this).attr("idcuenta");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarEnvioCuenta") == null) {

    idQuitarEnvioCuenta = [];

  } else {

    idQuitarEnvioCuenta.concat(localStorage.getItem("quitarEnvioCuenta"))

  }

  idQuitarEnvioCuenta.push({
      "idcuenta": idcuenta
  });

  localStorage.setItem("quitarEnvioCuenta", JSON.stringify(idQuitarEnvioCuenta));

  $("button.recuperarEnvioCuenta[idcuenta='" + idcuenta + "']").removeClass('btn-default');

  $("button.recuperarEnvioCuenta[idcuenta='" + idcuenta + "']").addClass('btn-primary agregarEnvioCuenta');


  if ($(".nuevoCampoEnvio").children().length == 0) {

      $("#nuevoTotalCuentaEnvio").val(0);
      $("#totalEnvioCuentas").val(0);
      $("#nuevoTotalCuentaEnvio").attr("total", 0);
      


  } else {

          // SUMAR TOTAL DE UNIDADES

          sumarTotalEnvio();

          // AGREGAR IMPUESTO

          

          // AGRUPAR PRODUCTOS EN FORMATO JSON

          listarCuentas();

  }

})


/* 
* SUMAR EL TOTAL DE LOS CORTES
*/

function sumarTotalEnvio() {

  var num_cta = $(".nuevoNumCuenta");  
  //console.log("cantidadAc", cantidadAc);


  var sumarTotal = num_cta.length;

  //console.log("sumarTotal", sumarTotal);

  $("#nuevoTotalCuentaEnvio").val(sumarTotal);
  $("#totalEnvioCuentas").val(sumarTotal);
  $("#nuevoTotalCuentaEnvio").attr("total", sumarTotal);

}

/* 
*formato al total
*/
$("#nuevoTotalCuentaEnvio").number(true, 0);


/* 
* LISTAR TODOS LOS ARTICULOS
*/
function listarCuentas() {

  var listaCuenta = [];

  var numcta = $(".nuevoNumCuenta");
  var cliente = $(".nuevaDescripcionCliente");
  var monto = $(".nuevoMonto");

  
  for (var i = 0; i < numcta.length; i++) {

    listaCuenta.push({
      idcuenta: $(numcta[i]).attr("idcuenta"),
      numcta: $(numcta[i]).val(),
      fecha: $(numcta[i]).attr("fecha_ven"),
      cliente_nom: $(cliente[i]).attr("nombres"),
      cliente_pat: $(cliente[i]).attr("ape_pat"),
      cliente_mat: $(cliente[i]).attr("ape_mat"),
      cliente_doc: $(cliente[i]).attr("documento"),
      monto: $(monto[i]).val()

    });
  }

  console.log("listaCuenta", JSON.stringify(listaCuenta));
  //console.log("listArticulo", listArticulo);

  $("#listaEnvioLetra").val(JSON.stringify(listaCuenta));
  
}



/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL ARTICULO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarEnvioCuenta() {

//Capturamos todos los id de productos que fueron elegidos en la venta
  var idCuenta = $(".quitarEnvioCuenta");
  //console.log("articuloAC", articuloAC);

//Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTablaEnvio = $(".tablaEnvioLetras tbody button.agregarEnvioCuenta");
  //console.log("botonesTablaAC", botonesTablaAC);

//Recorremos en un ciclo para obtener los diferentes articuloAC que fueron agregados a la venta
for (var i = 0; i < idCuenta.length; i++) {

  //Capturamos los Id de los productos agregados a la venta
  var boton = $(idCuenta[i]).attr("idCuenta");

  //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
  for (var j = 0; j < botonesTablaEnvio.length; j++) {

    if ($(botonesTablaEnvio[j]).attr("idCuenta") == boton) {

      $(botonesTablaEnvio[j]).removeClass("btn-primary agregarEnvioCuenta");
      $(botonesTablaEnvio[j]).addClass("btn-default");

    }
  }

}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$(".tablaEnvioLetras").on("draw.dt", function() {
  quitarAgregarEnvioCuenta();
});


if (localStorage.getItem("capturarRango22") != null) {
	$("#daterange-btnEnvioCta span").html(localStorage.getItem("capturarRango22"));
	cargarTablaEnvioCuentas(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnEnvioCta span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaEnvioCuentas(null, null);
}


function cargarTablaEnvioCuentas(fechaInicial, fechaFinal){
$('.tablaEnvioCuentas').DataTable({
	"ajax": "ajax/cuentas-corrientes/tabla-envio-cuentas.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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


$("#daterange-btnEnvioCta").daterangepicker(
  {
    cancelClass: "CancelarEnvioCta",
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
    $("#daterange-btnEnvioCta span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango22 = $("#daterange-btnEnvioCta span").html();

    localStorage.setItem("capturarRango22", capturarRango22);
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaEnvioCuentas").DataTable().destroy();
    cargarTablaEnvioCuentas(fechaInicial, fechaFinal);
  });

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .CancelarEnvioCta").on(
  "click",
  function() {
    localStorage.removeItem("capturarRango22");
    localStorage.removeItem("fechaInicial");
    localStorage.removeItem("fechaFinal");
    localStorage.clear();
    window.location = "ver-envio-letras";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function() {
  var textoHoy = $(this).attr("data-range-key");
  var ruta = $("#rutaAcceso").val();
  
  if(ruta == "ver-envio-letras"){
    if (textoHoy == "Hoy") {
      var d = new Date();

      var dia = d.getDate();
      var mes = d.getMonth() + 1;
      var año = d.getFullYear();

      dia = ("0" + dia).slice(-2);
      mes = ("0" + mes).slice(-2);

      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;

      localStorage.setItem("capturarRango22", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaEnvioCuentas").DataTable().destroy();
      cargarTablaEnvioCuentas(fechaInicial, fechaFinal);
    }
  }
});

  
//Imprimir letra con hoja pequeña
$(".tablaCuentas").on("click", ".btnImprimirLetra", function () {

  var numCuenta = $(this).attr("numCuenta");
  //console.log(codigo);


window.open("vistas/reportes_ticket/imprimir_letra.php?numCuenta=" +numCuenta,"_blank");

})

//Imprimir letra con hoja pequeña
$(".tablaCuentasPendientes").on("click", ".btnImprimirLetra", function () {

  var numCuenta = $(this).attr("numCuenta");
  //console.log(codigo);


window.open("vistas/reportes_ticket/imprimir_letra.php?numCuenta=" +numCuenta,"_blank");

})

//Imprimir letra con hoja pequeña
$(".tablaCuentasAprobadas").on("click", ".btnImprimirLetra", function () {

  var numCuenta = $(this).attr("numCuenta");
  //console.log(codigo);


window.open("vistas/reportes_ticket/imprimir_letra.php?numCuenta=" +numCuenta,"_blank");

})


$(".box").on("change", ".optradio", function () {
  var consulta = $(this).val();
  $(".btnGenerarReporteCuenta").attr("consulta",consulta);
  // console.log(consulta);
  if(consulta == "pendiente" || consulta == 'pendienteVencidoMenor' || consulta == 'pendienteVencidoMayor' || consulta == 'protestado' || consulta == 'option5' || consulta == 'estadoEnvioVacio' || consulta == 'unicoCartera' || consulta == 'option8' || consulta == 'option9' || consulta == 'cancelado' ){
    $("#fechaCuentaInicio").prop("disabled", true);
    $("#fechaCuentaFin").prop("disabled", true);
  }else{
    $("#fechaCuentaInicio").prop("disabled", false);
    $("#fechaCuentaFin").prop("disabled", false);
  }

  if (consulta=='pagos'){
    $(".campoCancelacion").removeClass("hidden");
    $(".campoDocumento").addClass("hidden");
    $(".btnGenerarReporteCuenta").attr("tip_doc",'');
  }else{
    $(".campoDocumento").removeClass("hidden");
    $(".campoCancelacion").addClass("hidden");
    $(".btnGenerarReporteCuenta").attr("canc",'');
  }
})

$(".box").on("change", ".radioOrd1", function () {
  var orden1 = $(this).val();
  $(".btnGenerarReporteCuenta").attr("orden1",orden1);
  if(orden1 == "vendedor"){
    $(".campoVendedor").removeClass("hidden");
    $(".campoCliente").addClass("hidden");
    $(".btnGenerarReporteCuenta").attr("cli",'');
  }else if(orden1 == "cliente"){
    $(".campoCliente").removeClass("hidden");
    $(".campoVendedor").addClass("hidden");
    $(".btnGenerarReporteCuenta").attr("vend",'');
  }else{
    $(".campoVendedor").addClass("hidden");
    $(".campoCliente").addClass("hidden");
    $(".btnGenerarReporteCuenta").attr("cli",'');
    $(".btnGenerarReporteCuenta").attr("vend",'');
  }

})

$(".box").on("change", ".radioOrd2", function () {
  var orden2 = $(this).val();
  $(".btnGenerarReporteCuenta").attr("orden2",orden2);

})

$(".box").on("change", "#tipoDocumentoReporte", function () {
  var tip_doc = $(this).val();
  $(".btnGenerarReporteCuenta").attr("tip_doc",tip_doc);

})

$(".box").on("change", "#tipoCancelacionReporte", function () {
  var canc = $(this).val();
  $(".btnGenerarReporteCuenta").attr("canc",canc);

})

$(".box").on("change", "#tipoClienteReporte", function () {
  var cliente = $(this).val();
  $(".btnGenerarReporteCuenta").attr("cli",cliente);

})

$(".box").on("change", "#tipoVendedorReporte", function () {
  var vendedor = $(this).val();
  $(".btnGenerarReporteCuenta").attr("vend",vendedor);

})

$(".box").on("change", "#tipoBancoReporte", function () {
  var banco = $(this).val();
  $(".btnGenerarReporteCuenta").attr("banco",banco);

})

$(".box").on("change", "#fechaCuentaInicio", function () {
  var inicio = $(this).val();
  $(".btnGenerarReporteCuenta").attr("inicio",inicio);

})

$(".box").on("change", "#fechaCuentaFin", function () {
  var fin = $(this).val();
  $(".btnGenerarReporteCuenta").attr("fin",fin);

})

$(".box").on("change", "#fechaCuentaFin", function () {
  var fin = $(this).val();
  $(".btnGenerarReporteCuenta").attr("fin",fin);

})

$(".box").on("change", ".radioImpresion", function () {
  var impresion = $(this).val();
  $(".btnGenerarReporteCuenta").attr("impresion",impresion);

})

$(".btnGenerarReporteCuenta").click(function(){ 
 var consulta = $(this).attr("consulta");
 var orden1 = $(this).attr("orden1");
 var orden2 = $(this).attr("orden2");
 var tip_doc = $(this).attr("tip_doc");
 var canc = $(this).attr("canc");
 var cli = $(this).attr("cli");
 var vend = $(this).attr("vend");
 var banco = $(this).attr("banco");
 var inicio = $(this).attr("inicio");
 var fin = $(this).attr("fin");
 var impresion = $(this).attr("impresion");

 //console.log(vend);
 
if (impresion == "pantalla") {

    if (consulta == 'pendiente' || consulta == 'pendienteVencidoMenor' || consulta == 'pendienteVencidoMayor' || consulta == 'protestado') {

        if (orden1 == "cliente") {

            window.open("extensiones/tcpdf/pdf/reporte_cliente_cuentas.php?consulta=" + consulta + "&orden1=" + orden1 + "&orden2=" + orden2 + "&cli=" + cli, "_blank");

        } else if (orden1 == "tipo") {

            window.open("extensiones/tcpdf/pdf/reporte_general_cuentas.php?consulta=" + consulta + "&orden1=" + orden1 + "&orden2=" + orden2, "_blank");

        } else if (orden1 == "vendedor") {

            if (vend == '') {

                window.open("extensiones/tcpdf/pdf/reporte_vendedor_cuentas.php?consulta=" + consulta + "&orden1=" + orden1 + "&orden2=" + orden2 + "&tip_doc=" + tip_doc + "&cli=" + cli + "&banco=" + banco + "&inicio=" + inicio + "&fin=" + fin + "&vend=" + vend, "_blank");

            } else {

                window.open("extensiones/tcpdf/pdf/reporte_vendedor_cuentas.php?consulta=" + consulta + "&orden1=" + orden1 + "&orden2=" + orden2 + "&tip_doc=" + tip_doc + "&cli=" + cli + "&banco=" + banco + "&inicio=" + inicio + "&fin=" + fin + "&vend=" + vend, "_blank");

            }

        } else if (orden1 == "fecha_ven") {
            window.open("extensiones/tcpdf/pdf/reporte_general_cuentas.php?consulta=" + consulta + "&orden1=" + orden1 + "&orden2=" + orden2, "_blank");
        }

    } else if (consulta == "pagos") {

        window.open("extensiones/tcpdf/pdf/reporte_pago_cuentas.php?consulta=" + consulta + "&orden1=" + orden1 + "&orden2=" + orden2 + "&canc=" + canc + "&vend=" + vend + "&inicio=" + inicio + "&fin=" + fin, "_blank");

    } else if (consulta == "fechaActualSaldo") {

        window.open("extensiones/tcpdf/pdf/reporte_estado_cuentas.php?consulta=" + consulta + "&orden1=" + orden1 + "&orden2=" + orden2 + "&canc=" + canc + "&vend=" + vend + "&inicio=" + inicio + "&fin=" + fin, "_blank");

    }

} else {

    alert("hola");

}

  
})