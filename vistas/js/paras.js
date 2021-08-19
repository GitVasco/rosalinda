/*=============================================
EDITAR PARA
=============================================*/
$(".tablas").on("click", ".btnEditarPara", function () {

    var idPara = $(this).attr("idPara");
    var datos = new FormData();
    datos.append("idPara", idPara);

    $.ajax({
        url: "ajax/paras.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            /* console.log("respuesta", respuesta); */

            $("#editarPara").val(respuesta["nombre"]);
            $("#idPara").val(respuesta["id"]);

        }

    })

})

/*=============================================
ELIMINAR PARA
=============================================*/
$(".tablas").on("click", ".btnEliminarPara", function () {

    var idPara = $(this).attr("idPara");

    swal({
        title: '¿Está seguro de borrar la para?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar para!'
    }).then(function (result) {

        if (result.value) {

            window.location = "index.php?ruta=paras&idPara=" + idPara;

        }

    })

})
//Reporte de Para
$(".box").on("click", ".btnReporteParas", function () {
    window.location = "vistas/reportes_excel/rpt_paras.php";
  
})