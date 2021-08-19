$('.tablaTipoTrabajador').DataTable( {
    "ajax": "ajax/maestros/tabla-tipotrabajador.ajax.php",
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
// ELIMINAR OPERACIÓN
$(".tablaTipoTrabajador tbody").on("click","button.btnEliminarTipoTrabajador",function(){
	var idTipoTrabajador =$(this).attr("idTipoTrabajador");
	//console.log("idOperacion", idOperacion);
	swal({
		title: "¿Está seguro de borrar el tipo de trabajador?",
		text: "¡Si no lo está se puede cancelar la acción!",
		type:"warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar tipo de trabajador!" 
	}).then((result)=>{
		if(result.value){
			window.location = "index.php?ruta=tipotrabajador&idTipoTrabajador="+idTipoTrabajador;
		}
	})
	
	
});
// EDITAR TIPO TRABAJADOR
$(".tablaTipoTrabajador tbody").on("click","button.btnEditarTipoTrabajador",function(){
	var idTipoTrabajador =$(this).attr("idTipoTrabajador");
	//console.log("idTipoTrabajador", idTipoTrabajador);
	var datos= new FormData();
	datos.append("idTipoTrabajador",idTipoTrabajador);
	$.ajax({
		url:"ajax/tipotrabajador.ajax.php",
		method:"POST",
		data:datos,
		cache: false,
		contentType:false,
		processData:false,
		dataType: "json",
		success:function(respuesta){

			console.log("respuesta", respuesta);

			$("#editarTipoTrabajador").val(respuesta["nom_tip_trabajador"]);
			$("#editarSectorTrabajador").val(respuesta["detalle"]);
			$("#editarSectorTrabajador").selectpicker('refresh');
			$("#idTipoTrabajador").val(respuesta["cod_tip_tra"]);
		}
	});
	
});
//Reporte de Tipo Trabajador
$(".box").on("click", ".btnReporteTipoTra", function () {
    window.location = "vistas/reportes_excel/rpt_tipo_trabajador.php";
  
})
