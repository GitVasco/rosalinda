/* 
* tabla paraa cargar la lista de quincenas
*/
$('.tablaQuincena').DataTable( {
    "ajax": "ajax/produccion/tabla-quincenas.ajax.php?perfil="+$("#perfilOculto").val(),
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
* EDITAR QUINCENA
*/
$(".tablaQuincena").on("click",".btnEditarQuincena",function(){

	var id=$(this).attr("id");
    var datos=new FormData();
    
	datos.append("id",id);
	$.ajax({
		url:"ajax/quincena.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){

            //console.log(respuesta)
            $("#id").val(respuesta["id"]);
            $("#editarMes").val(respuesta["nmes"]);
            $("#editarMes").selectpicker('refresh');
            $("#editarQuincena").val(respuesta["nquincena"]);
            $("#editarQuincena").selectpicker('refresh');
            $("#editarInicio").val(respuesta["inicio"]);
            $("#editarFin").val(respuesta["fin"]);
            
        }
        
    });
    
});

/* 
* BOTON VER EFICIENCIA
*/
$(".tablaQuincena").on("click", ".btnEficiencia", function () {

	var inicio = $(this).attr("inicio");
	var fin = $(this).attr("fin");
	var nquincena = $(this).attr("nquincena");
	var id = $(this).attr("id");
	console.log(inicio, fin, nquincena, id);

	localStorage.setItem("inicio", inicio);
	localStorage.setItem("fin", fin);
	localStorage.setItem("nquincena", nquincena);
	localStorage.setItem("id", id);

	window.location = "index.php?ruta=eficiencia&inicio=" + inicio + "&fin=" + fin + "&nquincena=" + nquincena + "&id=" + id;

	
  
})

// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("sectorEfi") != null) {
	cargarEficiencia(localStorage.getItem("inicio"), localStorage.getItem("fin"), localStorage.getItem("nquincena"), localStorage.getItem("id"),localStorage.getItem("sectorEfi"));
} else {
	cargarEficiencia(localStorage.getItem("inicio"), localStorage.getItem("fin"), localStorage.getItem("nquincena"), localStorage.getItem("id"),null);
}

function cargarEficiencia(inicio,fin,nquincena,id,sectorEfi){

	$('.tablaEficiencia').DataTable({
		"ajax": "ajax/produccion/tabla-eficiencia.ajax.php?perfil=" + $("#perfilOculto").val() + "&inicio=" + inicio + "&fin=" + fin + "&nquincena=" + nquincena + "&id=" + id + "&sectorEfi="+sectorEfi,
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

//Reporte de Eficiencias
$(".box").on("click", ".btnReporteEficiencia", function () {
	inicio=$(this).attr("inicio");
	fin=$(this).attr("fin");
	quincena=$(this).attr("quincena");
	id=$(this).attr("id");
    window.location = "vistas/reportes_excel/rpt_eficiencia.php?inicio="+inicio+"&fin="+fin+"&quincena="+quincena+"&id="+id;
  
})

/* 
* BOTON VER PAGOS
*/
$(".tablaQuincena").on("click", ".btnPagos", function () {

	var inicio = $(this).attr("inicio");
	var fin = $(this).attr("fin");
	var nquincena = $(this).attr("nquincena");
	var id = $(this).attr("id");
	//console.log(inicio, fin, nquincena, id);

	localStorage.setItem("inicio", inicio);
	localStorage.setItem("fin", fin);
	localStorage.setItem("nquincena", nquincena);
	localStorage.setItem("id", id);

	window.location = "index.php?ruta=pagos&inicio=" + inicio + "&fin=" + fin + "&nquincena=" + nquincena + "&id=" + id;	
  
})
// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("sectorTra") != null) {
	cargarPagos(localStorage.getItem("inicio"), localStorage.getItem("fin"), localStorage.getItem("nquincena"), localStorage.getItem("id"),localStorage.getItem("sectorTra"));
} else {
	cargarPagos(localStorage.getItem("inicio"), localStorage.getItem("fin"), localStorage.getItem("nquincena"), localStorage.getItem("id"),null);
}



function cargarPagos(inicio,fin,nquincena,id,sectorTra){

	$('.tablaPagos').DataTable({
		"ajax": "ajax/produccion/tabla-pagos.ajax.php?perfil=" + $("#perfilOculto").val() + "&inicio=" + inicio + "&fin=" + fin + "&nquincena=" + nquincena + "&id=" + id + "&sectorTra=" + sectorTra,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[23, "desc"]],
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
	
		},
		"drawCallback":function(){
			var api=this.api();
			$(api.column(2).footer()).html(
				api.column(2,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(3).footer()).html(
				api.column(3,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(4).footer()).html(
				api.column(4,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(5).footer()).html(
				api.column(5,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(6).footer()).html(
				api.column(6,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(7).footer()).html(
				api.column(7,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(8).footer()).html(
				api.column(8,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(9).footer()).html(
				api.column(9,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(10).footer()).html(
				api.column(10,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(11).footer()).html(
				api.column(11,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(12).footer()).html(
				api.column(12,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(13).footer()).html(
				api.column(13,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(14).footer()).html(
				api.column(14,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(15).footer()).html(
				api.column(15,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(16).footer()).html(
				api.column(16,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(17).footer()).html(
				api.column(17,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(18).footer()).html(
				api.column(18,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(19).footer()).html(
				api.column(19,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(20).footer()).html(
				api.column(20,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(21).footer()).html(
				api.column(21,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(22).footer()).html(
				api.column(22,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(23).footer()).html(
				api.column(23,{page:'current'}).data().sum().toFixed(2)
			)
			$(api.column(24).footer()).html(
				api.column(24,{page:'current'}).data().sum().toFixed(2)
			)
		}
		
	});

}
/*
* BOTON REPORTE DE PAGOS DE TRUSAS
*/
$(".tablaQuincena").on("click", ".btnReportePagosTrusas", function () {

	inicio = $(this).attr("inicio");
	fin = $(this).attr("fin");
	id = $(this).attr("id");

    window.location = "vistas/reportes_excel/rpt_pagos_trusas.php?inicio=" + inicio + "&fin=" + fin + "&id=" + id;
  
})

/*
* BOTON REPORTE DE PAGOS DE BRASIERES
*/
$(".tablaQuincena").on("click", ".btnReportePagosBrasier", function () {

	inicio = $(this).attr("inicio");
	fin = $(this).attr("fin");
	id = $(this).attr("id");

    window.location = "vistas/reportes_excel/rpt_pagos_brasier.php?inicio=" + inicio + "&fin=" + fin + "&id=" + id;
  
})

//Reporte de Eficiencias
$(".box").on("click", ".btnReporteEficiencia", function () {
	inicio=$(this).attr("inicio");
	fin=$(this).attr("fin");
	quincena=$(this).attr("quincena");
	id=$(this).attr("id");
    window.location = "vistas/reportes_excel/rpt_eficiencia.php?inicio="+inicio+"&fin="+fin+"&quincena="+quincena+"&id="+id;
  
})

//Reporte de Eficiencias
$(".box").on("click", ".btnReportePago", function () {
	inicio=$(this).attr("inicio");
	fin=$(this).attr("fin");
	quincena=$(this).attr("quincena");
	id=$(this).attr("id");
    window.location = "vistas/reportes_excel/rpt_pago.php?inicio="+inicio+"&fin="+fin+"&quincena="+quincena+"&id="+id;
  
});

/*=============================================
ELIMINAR QUICENA
=============================================*/

$(".tablaQuincena tbody").on("click", "button.btnEliminarQuincena", function(){

	var idQuincena = $(this).attr("id");
	//console.log("idQuincena", idQuincena);

	swal({

		title: '¿Está seguro de borrar la quincena?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar quincena!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=quincena&idQuincena="+ idQuincena ;

        }


	})

})

$("#selectSectorTra").change(function(){
	$(".tablaPagos").DataTable().destroy();
	var sectorTra=$(this).val();
	localStorage.setItem("sectorTra", sectorTra);
	cargarPagos(localStorage.getItem("inicio"), localStorage.getItem("fin"), localStorage.getItem("nquincena"), localStorage.getItem("id"),localStorage.getItem("sectorTra"));
	
});
/* 
* BOTON LIMPIAR SECTOR TRABAJADOR 
*/
$(".box").on("click", ".btnLimpiarSectorTra", function () {
	var inicio = $(this).attr("inicio");
	var fin = $(this).attr("fin");
	var quincena = $(this).attr("quincena");
	var id = $(this).attr("id");
	localStorage.removeItem("sectorTra");
	window.location = "index.php?ruta=pagos&inicio="+inicio+"&fin="+fin+"&quincena="+quincena+"&id="+id;
	
})

$("#selectSectorEfi").change(function(){
	$(".tablaEficiencia").DataTable().destroy();
	var sectorEfi=$(this).val();
	localStorage.setItem("sectorEfi", sectorEfi);
	cargarEficiencia(localStorage.getItem("inicio"), localStorage.getItem("fin"), localStorage.getItem("nquincena"), localStorage.getItem("id"),localStorage.getItem("sectorEfi"));
	
});
/* 
* BOTON LIMPIAR SECTOR TRABAJADOR 
*/
$(".box").on("click", ".btnLimpiarSectorEfi", function () {
	var inicio = $(this).attr("inicio");
	var fin = $(this).attr("fin");
	var nquincena = $(this).attr("nquincena");
	var id = $(this).attr("id");
	localStorage.removeItem("sectorEfi");
	window.location = "index.php?ruta=eficiencia&inicio="+inicio+"&fin="+fin+"&nquincena="+nquincena+"&id="+id;
	
})