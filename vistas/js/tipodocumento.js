/*=============================================
EDITAR TIPO DE DOCUMENTO
=============================================*/
$(".tablas").on("click", ".btnEditarTipoDocumento", function () {

    var idTipoDocumento = $(this).attr("idTipoDocumento");
    var datos = new FormData();
    datos.append("idTipoDocumento", idTipoDocumento);

    $.ajax({
        url: "ajax/tipodocumento.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            /* console.log("respuesta", respuesta); */

            $("#editarTipoDocumento").val(respuesta["tipo_doc"]);
            $("#idTipoDocumento").val(respuesta["cod_doc"]);

        }

    })

})
/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarTipoDocumento", function () {

    var idTipoDocumento = $(this).attr("idTipoDocumento");

    swal({
        title: '¿Está seguro de borrar el tipo de documento?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar tipo de documento!'
    }).then(function (result) {

        if (result.value) {

            window.location = "index.php?ruta=tipodocumentos&idTipoDocumento=" + idTipoDocumento;

        }

    })

})

//Reporte de Documento
$(".box").on("click", ".btnReporteDoc", function () {
    window.location = "vistas/reportes_excel/rpt_documento.php";
  
})
