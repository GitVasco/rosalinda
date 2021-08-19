/*
* cargamos la tabla para articulos en pedidos
*/
$(".tablaArticulosPedidos").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});



/*
* BOTON CREAR PEDIDO
*/
$(".btnCrearPedido").click(function () {

    var pedido = $(this).attr("pedido");
    //console.log("pedido", pedido);

    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;

})


$("#seleccionarCliente").change(function(){

    var cliList = document.getElementById("seleccionarCliente").value;
    // console.log(cliList);

    var datos = new FormData();
    datos.append("cliList", cliList);

    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDet){

            // console.log(respuestaDet);

            $("#lista").val(respuestaDet["lista_precios"]);

		}

	})

})

/*
* quitar productos con el boton
*/

$(".formularioPedidoCV").on("click", "button.quitarArtPed", function() {

    //console.log("boton");

    $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .remove();

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();


});

/* 
* activar cuando cambien el descuento
*/

$("#descPer").change(function(){

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();

})

function cambioDescuento(){

    var bruto = document.getElementById("nuevoSubTotal").value;
    var descuento = document.getElementById("descPer").value;

    var descN = bruto * (descuento / 100);

    var subTotal = bruto - descN;

    var impNuevo = subTotal * 0.18;

    var total = subTotal + impNuevo;

    $("#descTotal").val(descN.toFixed(2));
    $("#subTotal").val(subTotal.toFixed(2));
    $("#impTotal").val(impNuevo.toFixed(2));
    $("#nuevoTotal").val(total.toFixed(2));

    //console.log(descN);

}

/*
* nuevos  totales al cambiar la cantidad
*/

$(".formularioPedidoCV").on("change", "input.nuevaCantidadArtPed", function() {

    var precio = $(this)
    .parent()
    .parent()
    .children(".ingresoPrecio")
    .children()
    .children(".nuevoPrecioArticulo");

    //console.log("precio", precio.val());

    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal.toFixed(4));

    /* var nuevoArtPed = Number($(this).attr("artPed")) + Number($(this).val());
    console.log(nuevoArtPed);

    $(this).attr("nuevoArtPed", nuevoArtPed); */

    //console.log(precioFinal);

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();


});

/*
* SUMAR TODOS LOS TOTALES
*/

function sumarTotalesPreciosA(){

    var precioItem = $(".nuevoPrecioArticulo");

    var arraySumaPrecio = [];

    for (var i = 0; i < precioItem.length; i++) {
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
    }

    //console.log("arraySumaPrecio", arraySumaPrecio);

    function sumaArrayPrecios(total, numero) {
        return total + numero;
    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    //console.log("sumaTotalPrecio", sumaTotalPrecio);

    $("#nuevoSubTotalA").val(sumaTotalPrecio.toFixed(2));
    $("#nuevoSubTotal").val(sumaTotalPrecio.toFixed(2));

}

/*
* ARRAY CON TODOS LOS ARTICULOS
*/

function listarArticulos() {

    var listaArticulos = [];

    var descripcion = $(".nuevaDescripcionArticulo");
    var cantidad = $(".nuevaCantidadArtPed");
    var precio = $(".nuevoPrecioArticulo");

    for (var i = 0; i < descripcion.length; i++) {
        listaArticulos.push({

            articulo: $(descripcion[i]).attr("articulo"),
            descripcion: $(descripcion[i]).val(),
            cantidad: $(cantidad[i]).val(),
            precio: $(precio[i]).attr("precioReal"),
            total: $(precio[i]).val()
        });
    }

    //console.log("listaArticulos", JSON.stringify(listaArticulos));

    $("#listaProductosPedidos").val(JSON.stringify(listaArticulos));

}

/* 
* AL CAMBIAR LA CONDICION DE VENTA
*/

$("#condicionVenta").change(function(){

    //console.log("si llego")

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();

    $('#modalito').removeAttr('disabled');
    $('#modalito').removeClass('btn-default');
    $('#modalito').addClass('btn-primary');

})

$("#seleccionarCliente").change(function(){

    //console.log("si llego al cliente")

    //sumarTotalesPreciosA();
    //cambioDescuento();
    //listarArticulos();

    var cliente = document.getElementById("seleccionarCliente").value;
    //console.log(cliente);
    $("#codClienteM").val(cliente);

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
		success:function(respuestaDet){

            //console.log(respuestaDet);

            $("#nomClienteM").val(respuestaDet["nombre"]);

		}

	})

    /* var nomCliente = document.getElementById("nomCliente").value;
    console.log(nomCliente);
    $("#nomClienteM").val(nomCliente); */

    var vendedor = document.getElementById("seleccionarVendedor").value;
    //console.log(vendedor)
    $("#vendedorM").val(vendedor);

})

$(".crearPedido").click(function () {

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();

    var codigo = document.getElementById("nuevoCodigo").value;
    $("#codigoM").val(codigo);

    var cliente = document.getElementById("seleccionarCliente").value;
    //console.log(cliente);
    $("#codClienteM").val(cliente);

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
		success:function(respuestaDet){

            //console.log(respuestaDet);

            $("#nomClienteM").val(respuestaDet["nombre"]);

		}

	})

    var vendedor = document.getElementById("seleccionarVendedor").value;
    $("#vendedorM").val(vendedor);

    var lista = document.getElementById("seleccionarLista").value;

    var opGravada = document.getElementById("nuevoSubTotalA").value;
    $("#opGravadaM").val(opGravada);

    var descuento = document.getElementById("descTotal").value;
    $("#descuentoM").val(descuento);

    var subTotal = document.getElementById("subTotal").value;
    $("#subTotalM").val(subTotal);

    var impuesto = document.getElementById("impTotal").value;
    $("#igvM").val(impuesto);

    var total = document.getElementById("nuevoTotal").value;
    $("#totalM").val(total);

    var articulos = document.getElementById("listaProductosPedidos").value;
    $("#articulosM").val(articulos);

    var condicionVenta = document.getElementById("condicionVenta").value;
    //console.log(condicionVenta);
    $("#condicionVentaM").val(condicionVenta);

    var agencia = document.getElementById("agencia").value;
    $("#agenciaM").val(agencia);

    var usuario = document.getElementById("idUsuario").value;
    $("#usuarioM").val(usuario);

    //console.log(usuario);

})

/*
* cargamos la tabla de pedidos
*/
$(".tablaPedidosCV").DataTable({
    ajax: "ajax/facturacion/tabla-pedidosCV.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});


/*
* BOTON REVISAR PEDIDO
*/
$(".box").on("click", ".btnEditarPedidoCV", function () {

    var pedido = $(this).attr("codigo");
    //console.log("pedido", pedido);

    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;

})

/* 
* BOTON  IMPRIMIR TICKET
*/
$(".tablaPedidosCV, .tablaPedidosGenerados, .tablaPedidosAprobados").on("click", ".btnImprimirPedido", function () {

    var codigo = $(this).attr("codigo");
    //console.log(codigo);


	window.open("vistas/reportes_ticket/impresion_pedido.php?codigo=" +codigo,"_blank");

})

/* 
* AL CAMBIAR EL SELECT DE DOCUMENTO
*/
$("#tdoc").change(function(){

	var documento = document.getElementById("tdoc").value;
    //console.log(documento);

    document.getElementById("chkFactura").checked = false;
    document.getElementById("chkBoleta").checked = false;

    if(documento == "00"){

        document.getElementById("chkFactura").disabled = false;
        document.getElementById("chkBoleta").disabled = false;

    }else{

        document.getElementById("chkFactura").disabled = true;
        document.getElementById("chkBoleta").disabled = true;

        document.getElementById("chkFactura").checked = false;
        document.getElementById("chkBoleta").checked = false;

    }

    if(documento == "07"){
        $(".campoTipOrigen").removeClass("hidden");
        $(".campoDocOrigen").removeClass("hidden");
        $(".campoFecOrigen").removeClass("hidden");
    }else{
        $(".campoTipOrigen").addClass("hidden");
        $(".campoDocOrigen").addClass("hidden");
        $(".campoFecOrigen").addClass("hidden");
    }

    var serie = $("#serie");
    //console.log(serie);

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({

        url:"ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            //console.log(respuesta);

            // Limpiamos el select
            serie.find('option').remove();

            serie.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serie.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serie);
            }

        }

    })

})

/*
* validar el checkbox
*/
$(".chkFactura").change(function(){

    var chkBox = document.getElementById('chkFactura');

    var documento = "01";
    //console.log(documento);

    var serieSeparado = $("#serieSeparado");
    //console.log(serieSeparado);


    if(chkBox.checked == true){

        document.getElementById("chkBoleta").disabled = true;
        document.getElementById("chkBoleta").checked = false;

        document.getElementById("serieSeparado").disabled = false;

    }else{

        document.getElementById("chkBoleta").disabled = false;
        document.getElementById("serieSeparado").disabled = true;

    }

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({

        url:"ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            //console.log(respuesta);

            // Limpiamos el select
            serieSeparado.find('option').remove();

            serieSeparado.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serieSeparado.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serieSeparado);
            }

        }

    })

})

$(".chkBoleta").change(function(){

    var chkBox = document.getElementById('chkBoleta');
    //console.log(chkBox.checked);

    var serieSeparado = $("#serieSeparado");
    serieSeparado.find('option').remove();
    //console.log(serieSeparado);


    var documento = "03";

    if(chkBox.checked == true){

        document.getElementById("chkFactura").disabled = true;
        document.getElementById("chkFactura").checked = false;

        document.getElementById("serieSeparado").disabled = false;

    }else{

        document.getElementById("chkFactura").disabled = false;
        document.getElementById("serieSeparado").disabled = true;

    }

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({

        url:"ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            //console.log(respuesta);

            // Limpiamos el select
            serieSeparado.find('option').remove();

            serieSeparado.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serieSeparado.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serieSeparado);
            }

        }

    })

})


/*
* ACTIVAR MODAL
*/

$(".tablaPedidosCV , .tablaPedidosAprobados").on("click", "button.btnFacturar", function(){

    var codigo = $(this).attr("codigo");
    var cod_cli = $(this).attr("cod_cli");
    var nom_cli = $(this).attr("nom_cli");
    var tip_doc = $(this).attr("tip_doc");
    var nro_doc = $(this).attr("nro_doc");
    var dscto = $(this).attr("dscto");
    var cod_ven = $(this).attr("cod_ven");
    //console.log(nro_doc);

    $("#codPedido").val(codigo);
    $("#codCli").val(cod_cli);
    $("#nomCli").val(nom_cli);
    $("#tipDoc").val(tip_doc);
    $("#nroDoc").val(nro_doc);
    $("#dscto").val(dscto);
    $("#codVen").val(cod_ven);

})

/*
* BOTON REVISAR FACTURA
*/
$(".box").on("click", ".btnEditarFacturaCV", function () {

    var pedido = $(this).attr("codigo");
    //console.log("factura", pedido);

    window.location = "index.php?ruta=crear-facturascv&pedido=" + pedido;

})

/*
* BOTON IR A PEDIDOS GENERADOS
*/
$(".btnGenerados").click(function(){

    window.location = "pedidos-generados";

})

/*
* BOTON IR A PEDIDOS APROBADOS
*/
$(".btnAprobados").click(function(){

    window.location = "pedidos-aprobados";

})

/*
* BOTON IR A PEDIDOS EN APT
*/
$(".btnAPT").click(function(){

    window.location = "pedidos-apt";

})

/*
* BOTON IR A PEDIDOS CONFIRMADOS
*/
$(".btnConfirmados").click(function(){

    window.location = "pedidos-confirmados";

})

/*
* BOTON IR A PEDIDOS FACTURADOS
*/
$(".btnFacturados").click(function(){

    window.location = "pedidos-facturados";

})

/*
* BOTON IR A PEDIDOS INICIO
*/
$(".btnInicioPed").click(function(){

    window.location = "pedidoscv";

})

/*
* CARGADOS TABLA GENERADOS
*/
$(".tablaPedidosGenerados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-generados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});

/*
* CARGADOS TABLA APROBADOS
*/
$(".tablaPedidosAprobados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-aprobados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});

/*
* CARGADOS TABLA APT
*/
$(".tablaPedidosAPT").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-apt.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});

/*
* CARGADOS TABLA CONFIRMADOS
*/
$(".tablaPedidosConfirmados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-confirmados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});

/*
* CARGADOS TABLA FACTURADOS
*/
$(".tablaPedidosFacturados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-facturados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});


$(".tablaPedidosGenerados , .tablaPedidosCV").on("click", ".btnAprobarPedido", function () {
    var codigo = $(this).attr("codigo");
	var estadoPedido=$(this).attr("estadoPedido");
	//Realizamos la activación-desactivación por una petición AJAX
	var datos=new FormData();
	datos.append("activarId",codigo);
	datos.append("activarEstado",estadoPedido);

    $.ajax({
        url:"ajax/facturacion.ajax.php",
        type:"POST",
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        success:function(respuesta){
            // console.log(respuesta);
            swal({
                type: "success",
                title: "¡Ok!",
                text: "¡El pedido fue aprobado con éxito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            }).then((result)=>{
                if(result.value){
                    window.location="pedidos-aprobados";}
            });}
    });
})


$(".tablaPedidosAprobados , .tablaPedidosCV").on("click", ".btnAptear", function () {
    var codigo = $(this).attr("codigo");
	var estadoPedido=$(this).attr("estadoPedido");
	//Realizamos la activación-desactivación por una petición AJAX
	var datos=new FormData();
	datos.append("activarId",codigo);
	datos.append("activarEstado",estadoPedido);

    $.ajax({
        url:"ajax/facturacion.ajax.php",
        type:"POST",
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        success:function(respuesta){
            // console.log(respuesta);
            swal({
                type: "success",
                title: "¡Ok!",
                text: "¡El pedido fue dado de apta con éxito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            }).then((result)=>{
                if(result.value){
                    window.location="pedidos-aprobados";}
            });}
    });
})

$(".tablaPedidosAPT , .tablaPedidosCV").on("click", ".btnConfirmar", function () {
    var codigo = $(this).attr("codigo");
	var estadoPedido=$(this).attr("estadoPedido");
	//Realizamos la activación-desactivación por una petición AJAX
	var datos=new FormData();
	datos.append("activarId",codigo);
	datos.append("activarEstado",estadoPedido);

    $.ajax({
        url:"ajax/facturacion.ajax.php",
        type:"POST",
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        success:function(respuesta){
            // console.log(respuesta);
            swal({
                type: "success",
                title: "¡Ok!",
                text: "¡El pedido fue confirmado con éxito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            }).then((result)=>{
                if(result.value){
                    window.location="pedidos-apt";}
            });}
    });
})


$(".formularioPedidoCV").on("click", ".btnCargarCliente", function () {
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
        xhr: function () {
            var xhr = $.ajaxSettings.xhr();
            xhr.upload.onprogress = function (event) {
                var perc = Math.round((event.loaded / event.total) * 100);
                $("#progressBar1").html('Cargando clientes..');
                $("#progressBar1").css('width', perc + '%');
            };
            return xhr;
        },
        beforeSend: function (xhr) {
            $("#progressBar1").text('0%');
            $("#progressBar1").css('width', '0%');
        },
        success: function (respuesta2)
        {        
            $("#progressBar1").addClass("progress-bar");
            $("#progressBar1").text('100% - Carga realizada');
        
        
        $("#seleccionarCliente").find('option').remove();
        $("#seleccionarCliente").append("<option value='' > Seleccionar cliente </option>");
        for (let i = 0; i < respuesta2.length; i++) {
            
            $("#seleccionarCliente").append("<option value='"+respuesta2[i]["codigo"]+"'>"+respuesta2[i]["codigo"]+" - "+respuesta2[i]["nombre"]+"</option>");
            
        }
        $("#seleccionarCliente").selectpicker("refresh");
        }

    })

})


$(".tablaArticulosPedidos").on("click", ".modificarArtPed", function () {

    //console.log("hola mundo");

    var cliente = document.getElementById("seleccionarCliente").value;
    var vendedor = document.getElementById("seleccionarVendedor").value;
    var pedido = document.getElementById("nuevoCodigo").value;
    var modLista = document.getElementById("lista").value;

    // console.log(pedido);

    if(modLista == ''){

        var modLista1 = document.getElementById("seleccionarLista").value;
        $("#nLista").val(modLista1);
        var datos = new FormData();
        datos.append("modLista", modLista1);
        //console.log('lista',modLista1);

    }else{

        $("#nLista").val(modLista);
        var datos = new FormData();
        datos.append("modLista", modLista);
        //console.log('lista',modLista);

    }

    
    //ver para q sirve
    $("#clienteA").val(cliente);
    $("#vendedorA").val(vendedor);

    $("#modeloModalA").val($(this).attr("modelo"));

    /*
    *datos para la cabecera
    */
    var mod = $(this).attr("modelo");
    //console.log(mod);

    //var datos = new FormData();
    datos.append("mod", mod);
    //datos.append("modLista", modLista);

    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaLista){

            //console.log("respuesta",respuestaLista["precio"]);

            $("#precioA").val(respuestaLista["precio"]);

		}

	})

    /*
    * datos para la tabla
    */

    var modelo = $(this).attr("modelo");
    // console.log(modelo);

	var datosPedido = new FormData();
	datosPedido.append("modeloA", modelo);
    datosPedido.append("pedido", pedido);
    // console.log(datosPedido);

	$.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datosPedido,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaA){ 

            console.log("respuestaA", respuestaA);

            $(".detalleCT").remove();

			for(var id of respuestaA){

                /* TALLA 1 */
                if(id.t1 == 1){

                    var talla1 = '<td><input style="width:100%" class="pruebaA" type="number" name="'+ id.modelo + id.cod_color +1 +'" id="'+ id.modelo + id.cod_color +1 +'" value="'+id.v1+'" min="0"></td>'

                }else{

                    var talla1 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +1 +'" id="'+ id.modelo + id.cod_color +1 +'" readonly></td>'

                }

                /* TALLA 2 */
                if(id.t2 == 1){

                    var talla2 = '<td><input style="width:100%" class="pruebaA" type="number" name="'+ id.modelo + id.cod_color +2 +'" id="'+ id.modelo + id.cod_color +2 +'" value="'+id.v2+'" min="0"></td>'

                }else{

                    var talla2 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +2 +'" id="'+ id.modelo + id.cod_color +2 +'" readonly></td>'

                }

                /* TALLA 3 */
                if(id.t3 == 1){

                    var talla3 = '<td><input style="width:100%" class="pruebaA" type="number" name="'+ id.modelo + id.cod_color +3 +'" id="'+ id.modelo + id.cod_color +3 +'" value="'+id.v3+'" min="0"></td>'

                }else{

                    var talla3 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +3 +'" id="'+ id.modelo + id.cod_color +3 +'" readonly></td>'

                }

                /* TALLA 4 */
                if(id.t4 == 1){

                    var talla4 = '<td><input style="width:100%" class="pruebaA" type="number" name="'+ id.modelo + id.cod_color +4 +'" id="'+ id.modelo + id.cod_color +4 +'" value="'+id.v4+'" min="0"></td>'

                }else{

                    var talla4 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +4 +'" id="'+ id.modelo + id.cod_color +4 +'" readonly></td>'

                }

                /* TALLA 5 */
                if(id.t5 == 1){

                    var talla5 = '<td><input style="width:100%" class="pruebaA" type="number" name="'+ id.modelo + id.cod_color +5 +'" id="'+ id.modelo + id.cod_color +5 +'" value="'+id.v5+'" min="0"></td>'

                }else{

                    var talla5 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +5 +'" id="'+ id.modelo + id.cod_color +5 +'" readonly></td>'

                }

                /* TALLA 6 */
                if(id.t6 == 1){

                    var talla6 = '<td><input style="width:100%" class="pruebaA" type="number" name="'+ id.modelo + id.cod_color +6 +'" id="'+ id.modelo + id.cod_color +6 +'" value="'+id.v6+'" min="0"></td>'

                }else{

                    var talla6 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +6 +'" id="'+ id.modelo + id.cod_color +6 +'" readonly></td>'

                }

                /* TALLA 7*/
                if(id.t7 == 1){

                    var talla7 = '<td><input style="width:100%" class="pruebaA" type="number" name="'+ id.modelo + id.cod_color +7 +'" id="'+ id.modelo + id.cod_color +7 +'" value="'+id.v7+'" min="0"></td>'

                }else{

                    var talla7 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +7 +'" id="'+ id.modelo + id.cod_color +7 +'" readonly></td>'

                }

                /* TALLA 8 */
                if(id.t8 == 1){

                    var talla8 = '<td><input style="width:100%" class="cantidad" type="number" name="'+ id.modelo + id.cod_color +8 +'" id="'+ id.modelo + id.cod_color +8 +'"value="'+id.v8+'" min="0"></td>'

                }else{

                    var talla8 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +8 +'" id="'+ id.modelo + id.cod_color +8 +'" readonly></td>'

                }

                var fila ='<tr class="detalleCT">' +
                                '<td>' + id.modelo + ' </td>' +
                                '<td>' + id.color + ' </td>' +
                                talla1 +
                                talla2 +
                                talla3 +
                                talla4 +
                                talla5 +
                                talla6 +
                                talla7 +
                                talla8 +

                            '</tr>'

				$('.tablaColTal').append(

                    fila


                )

			}

		}

    })

})

$(".btnCalCantA").click(function () {

    var totalCantidadA=0;
    $(".pruebaA").each(function(){

        totalCantidadA+=parseInt($(this).val()) || 0;

    });

    var precio=document.getElementById("precioA").value;

    var totalSolesA = (totalCantidadA * precio)

    $("#totalCantidadA").val(totalCantidadA);

    $("#totalSolesA").val(totalSolesA);
    $("#totalSolesA").number(true, 2);

    //console.log(totalSolesA);
    //console.log(totalCantidadA);

})
