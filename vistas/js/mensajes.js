/* 
* BOTON ACTUALIZAR
*/
$(".btnRefresh").click(function () {

    var idUsuario = $(this).attr("idUsuario");
    /* console.log("idUsuario", idUsuario); */

    window.location = "index.php?ruta=mensajes&idUsuario=" + idUsuario;

})

/* 
* BOTON ACTUALIZAR
*/
$(".btnLeer").click(function () {

    var de = $(this).attr("de");
    var para = $(this).attr("para");
    //console.log("de", de, "para", para);
    
    var datos = new FormData();
	datos.append("de", de);
    datos.append("para", para);
    
    $.ajax({

		url: "ajax/mensajes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

            //console.log(respuesta);
            window.location = "index.php?ruta=mensajes&idUsuario=" + de;
		
		}
	})

})