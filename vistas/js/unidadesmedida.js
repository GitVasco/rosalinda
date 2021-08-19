$('.tablaUnidadesMedida').DataTable({
    "ajax": "ajax/maestros/tabla-unidadesmedida.ajax.php?perfil="+$("#perfilOculto").val(),
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
EDITAR UNIDAD MEDIDA
=============================================*/
$(".tablaUnidadesMedida").on("click", ".btnEditarUnidadMedida", function () {

    var idUnidadMedida = $(this).attr("idUnidadMedida");

    var datos = new FormData();
    datos.append("idUnidadMedida", idUnidadMedida);

    $.ajax({

        url: "ajax/unidadesmedida.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idUnidadMedida").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
        }

    })

})


/*=============================================
ELIMINAR UNIDAD MEDIDA
=============================================*/
$(".tablaUnidadesMedida").on("click", ".btnEliminarUnidadMedida", function(){

	var idUnidadMedida = $(this).attr("idUnidadMedida");
	
	swal({
        title: '¿Está seguro de borrar la unidad de medida?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar unidad de medida!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=unidadesmedida&idUnidadMedida="+idUnidadMedida;
        }

  })

})
//Reporte de Colores
// $(".box").on("click", ".btnReporteColor", function () {
//     window.location = "vistas/reportes_excel/rpt_color.php";
  
// })