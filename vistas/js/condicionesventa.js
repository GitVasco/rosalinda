$('.tablaCondicionesVenta').DataTable({
    "ajax": "ajax/maestros/tabla-condicionesventa.ajax.php?perfil="+$("#perfilOculto").val(),
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
/*=============================================
EDITAR AGENCIA
=============================================*/
$(".tablaCondicionesVenta").on("click", ".btnEditarCondicionVenta", function () {

    var idCondicionVenta = $(this).attr("idCondicionVenta");

    var datos = new FormData();
    datos.append("idCondicionVenta", idCondicionVenta);

    $.ajax({

        url: "ajax/condicionesventa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idCondicionVenta").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarCtaCte").val(respuesta["cta_cte"]);
            $("#editarCtaCte").selectpicker('refresh');
            $("#editarDia").val(respuesta["dias"]);
            $("#editarLetra").val(respuesta["letras"]);
            $("#editarLetra").selectpicker('refresh');
            $("#editarDscto").val(respuesta["dscto"]);
            $("#editarDscto").selectpicker('refresh');
        }

    })

})


/*=============================================
ELIMINAR AGENCIA
=============================================*/
$(".tablaCondicionesVenta").on("click", ".btnEliminarCondicionVenta", function(){

	var idCondicionVenta = $(this).attr("idCondicionVenta");
	
	swal({
        title: '¿Está seguro de borrar la condicion de venta?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar condicion de venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=condicionesventa&idCondicionVenta="+idCondicionVenta;
        }

  })

})
//Reporte de Colores
// $(".box").on("click", ".btnReporteColor", function () {
//     window.location = "vistas/reportes_excel/rpt_color.php";
  
// })