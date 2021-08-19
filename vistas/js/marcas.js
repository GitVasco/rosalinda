/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarMarca", function () {

    var idMarca = $(this).attr("idMarca");

    var datos = new FormData();
    datos.append("idMarca", idMarca);

    $.ajax({
        url: "ajax/marcas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            /* console.log("respuesta", respuesta); */

            $("#editarMarca").val(respuesta["marca"]);
            $("#idMarca").val(respuesta["id"]);

        }

    })

})


/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarMarca", function(){

    var idMarca = $(this).attr("idMarca");

    swal({
        title: '¿Está seguro de borrar la marca?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar marca!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=marcas&idMarca="+idMarca;

        }

    })

})
// ACTIVANDO-DESACTIVANDO ARTICULO
$(document).on("click",".btnActivarMarca",function(){
	// Capturamos el id del usuario y el estado
    var idMarca=$(this).attr("idMarca");
	var estadoMarca=$(this).attr("estadoMarca");
	var datos=new FormData();
	datos.append("activarId",idMarca);
	datos.append("activarEstado",estadoMarca);
	$.ajax({
		url:"ajax/marcas.ajax.php",
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
						window.location="marcas";}
				});}
	});
	// Cambiamos el estado del botón físicamente
	if(estadoMarca=0){
		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		$(this).html("Inactivo");
		$(this).attr("estadoMarca","1");}
	else{
		$(this).addClass("btn-success");
		$(this).removeClass("btn-danger");
		$(this).html("Activo");
		$(this).attr("estadoMarca","0");}
});
//Reporte de Marca
$(".box").on("click", ".btnReporteMarca", function () {
    window.location = "vistas/reportes_excel/rpt_marca.php";
  
})
