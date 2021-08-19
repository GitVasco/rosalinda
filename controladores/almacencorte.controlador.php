<?php
class ControladorAlmacenCorte{

    /*
    * SACAR EL ULTIMO CODIGO
    */
    static public function ctrUltimoCodigoAC(){

        $respuesta = ModeloAlmacenCorte::mdlUltimoCodigoAC();

        return $respuesta;

    }

	/*
	* MOSTRAR ARTICULOS EN ORDENES DE CORTE PARA EL ALMACEN CORTE
	*/
	static public function ctrMostarArticulosOrdCorte(){

		$respuesta = ModeloAlmacenCorte::mdlMostarArticulosOrdCorte();

		return $respuesta;

    }

    /*
    * CREAR ALMACEN DE CORTE
    */
    static public function ctrCrearAlmacenCorte(){

        /*
        todo: ver si trae datos
        */
        if( isset($_POST["nuevaAlmacenCorte"]) &&
            isset($_POST["idUsuario"]) &&
            isset($_POST["listaArticulosAC"])){

            #var_dump("nuevoAlmacenCorte", $_POST["nuevaAlmacenCorte"]);
            #var_dump("idUsuario", $_POST["idUsuario"]);
            #var_dump("listaArticulosAC", $_POST["listaArticulosAC"]);

                if($_POST["listaArticulosAC"] == ""){

                    /*
                    ? Mostramos una alerta suave si viene vacia
                    */
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error",
                                text: "¡No se seleccionó ningún artículo. Por favor, intenteló de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="crear-almacencorte";}
                            });
                        </script>';

                }else{

                    #var_dump("listaArticulosAC", $_POST["listaArticulosAC"]);

                    /*
                    ? Capturamos los articulos unicos y sumamos sus cantidades
                    */
                    $listArticulo = json_decode($_POST["listArticulo"], true);
                    #var_dump("listArticulo", $listArticulo);

                    /*
                    * array on los articulos unicos sin repetir
                    */
                    $articulos_array = [];
                    foreach ($listArticulo as $valor) {

                        $articulo = $valor["articulo"];

                        if (! in_array($articulo, $articulos_array)) {

                            $articulos_array[] = $articulo;

                        }

                    }
                    #var_dump("articulos_array", $articulos_array);

                    /*
                    * crear un array con la lista unica
                    */
                    $resultado = [];
                    foreach ($articulos_array as $unico_id) {

                        $temporal = [];
                        $cantidad = 0;
                        foreach ($listArticulo as $valor) {

                            $id = $valor["articulo"];

                            if ($id === $unico_id) {

                                $temporal[] = $valor;

                            }

                        }

                        $producto = $temporal[0];

                        $producto["cantidad"] = 0;
                        foreach ($temporal as $producto_temporal) {

                            $producto["cantidad"] = $producto["cantidad"] + $producto_temporal["cantidad"];

                        }
                        // dx($producto["cantidad"]); // trace

                        // store unique productoo with updated quantity
                        $resultado[] = $producto;

                    }
                    #var_dump("resultado", $resultado);

                    /*
                    todo: GUARDAMOS LOS TOTALES DEL CORTE EN ARTICULO
                    */
                    foreach($resultado as $value){

                        $valor = $value["articulo"];

                        $valor1 = $value["cantidad"];

                        ModeloAlmacenCorte::mdlActualizarAlmCorte($valor, $valor1);

                    }

                    /*
                    todo: DESCONTAMOS LOS TOTALES DEL CORTE EN ARTICULO - ORDEN DE CORTE
                    */
                    foreach($resultado as $value){

                        $valor = $value["articulo"];

                        $valor1 = $value["cantidad"];

                        ModeloAlmacenCorte::mdlActualizarOrdCorte($valor, $valor1);

                        ModeloAlmacenCorte::mdlIngresarCantCorte($valor, $valor1);

                    }

                    /*
                    todo: Actualizamos saldos de las Detalles de Ordenes de Corte
                    */

                    $listaArticulosAC = json_decode($_POST["listaArticulosAC"], true);
                    #var_dump("listaArticulosAC", $listaArticulosAC);

                    foreach($listaArticulosAC as $value){

                        $valor = $value["articulo"];

                        $valor1 = $value["ordencorte"];

                        $valor2 = $value["cantidad"];

                        ModeloAlmacenCorte::mdlActualizarSaldoOrdCorte($valor, $valor1, $valor2);

                    }

                    /*
                    todo: Actualizamos saldos de las ordenes de corte y estados
                    */
                        ModeloAlmacenCorte::mdlActualizarSaldoOrdCorteGral();

                        ModeloAlmacenCorte::mdlActualizarOrdCorteEstadoParcial();

                        ModeloAlmacenCorte::mdlActualizarOrdCorteEstadoCerrado();

                    /*
                    todo: Guardar cabeera de ALMACEN DE CORTE
                    */
                    $datos=array(   "codigo"=>$_POST["nuevaAlmacenCorte"],
                                    "guia"=>$_POST["nuevaGuia"],
                                    "usuario"=>$_POST["idUsuario"],
                                    "total"=>$_POST["totalAlmacenCorte"],
                                    "estado"=>"1");
                    #var_dump("datos", $datos);

                    $respuesta = ModeloAlmacenCorte::mdlGuardarAlmacenCorte($datos);
                    #var_dump("respuesta", $respuesta);
                    #$respuesta = "no";

                    if($respuesta =="ok"){

                        /*
                        todo: Guardar detalle de almacen de corte
                        */
                        $ultimoId = ModeloAlmacenCorte::mdlUltimoCodigoAC();
                        #var_dump("ultimoId", $ultimoId);

                        foreach($listaArticulosAC as $key=>$value){

                            $datosD = array("almacencorte"=>$ultimoId["ultimo_codigo"],
                                            "ordcorte"=>$value["ordencorte"],
                                            "idocd"=>$value["idocd"],
                                            "articulo"=>$value["articulo"],
                                            "cantidad"=>$value["cantidad"]);
                            #var_dump("datosD", $datosD);

                            ModeloAlmacenCorte::mdlGuardarDetallesAlmacenCorte($datosD);

                        }

                        ModeloAlmacenCorte::mdlGuardarDetallesAlmacenCorteMP($ultimoId["ultimo_codigo"]);

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue registrada con éxito!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="almacencorte";}
                                });
                            </script>';

                    }else{

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "error",
                                    title: "Error",
                                    text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="crear-almacencorte";}
                                });
                            </script>';

                    }

                }

        }

    }

    /*
    * MOSTRAR DATOS DE ALMACEN DE CORTE
    */
    static public function ctrMostrarAlmacenCorte($valor){

        $respuesta = ModeloAlmacenCorte::mdlMostrarAlmacenCorte($valor);

        return $respuesta;

    }

	/* 
	* VISUALIZAR DATOS DEL CORTE DETALLE
	*/
	static public function ctrVisualizarAlmacenCorteDetalle($valor){

        $respuesta = ModeloAlmacenCorte::mdlVisualizarAlmacenCorteDetalle($valor);
        
		return $respuesta;

	}    

/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasAlmacenCortes($fechaInicial, $fechaFinal){

		$tabla = "almacencortejf";

		$respuesta = ModeloAlmacenCorte::mdlRangoFechasAlmacenCortes($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
    }
    
    static public function ctrRangoFechasVerCortes($fechaInicial, $fechaFinal){

		$tabla = "almacencortejf";

		$respuesta = ModeloAlmacenCorte::mdlRangoFechasVerCortes($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}


    /*
    * MOSTRAR DATOS DE ALMACEN DE CORTE
    */
    static public function ctrMostrarTelasAlmacenCorte($valor){

        $respuesta = ModeloAlmacenCorte::mdlMostrarTelasAlmacenCorte($valor);

        return $respuesta;

    }

    
	/*=============================================
	EDITAR SECTORES
	=============================================*/

	static public function ctrEditarTelaCorte(){

		if(isset($_POST["almacencorteMP"])){
            $telasInput=$_POST["telas"];
            for ($i=0; $i <count($telasInput) ; $i++) { 
					
                $datos = array("codigo"=>$_POST["almacencorteMP"],
                "cantidad"=>$_POST["cantidadMP".$i],
                "diferencia"=>$_POST["diferenciaMP".$i],
                "entrega"=>$_POST["entregaMP".$i],
                "merma"=>$_POST["mermaMP".$i],
                "mp_sinuso"=>$_POST["sinusoMP".$i],
                "materia" => $_POST["materia".$i]);
                
                $respuesta = ModeloAlmacenCorte::mdlIngresarTelaCorte($datos);
            }
			   	
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La tela del corte ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "almacencorte";

									}
								})

					</script>';

				}


		}

    }

    /*=============================================
	EDITAR SECTORES
	=============================================*/

	static public function ctrEditarNotificacionCorte(){

		if(isset($_POST["almacencorteNot"])){
            $telasInput=$_POST["telasNot"];
            for ($i=0; $i <count($telasInput) ; $i++) { 
					
                $datos = array("codigo"=>$_POST["almacencorteNot"],
                "notificacion"=>$_POST["notificacionMP".$i],
                "materia" => $_POST["materiaNot".$i]);
                
                $respuesta = ModeloAlmacenCorte::mdlIngresarNotificacionCorte($datos);
            }
			   	
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La tela del corte ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "almacencorte";

									}
								})

					</script>';

				}


		}

    }
}