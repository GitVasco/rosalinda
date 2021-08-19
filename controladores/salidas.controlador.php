<?php

class ControladorSalidas{

    /*
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostrarTemporal($valor){

		$tabla = "ing_sal";

		$respuesta = ModeloSalidas::mdlMostrarTemporal($tabla, $valor);

		return $respuesta;

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL TOTAL
    */
	static public function ctrMostrarTemporalTotal($valor){

		$respuesta = ModeloSalidas::mdlMostrarTemporalTotal($valor);

		return $respuesta;

    }

     /*
    * MOSTRAR CABECERA DE TEMPORAL TOTAL
    */
	static public function ctrMostrarArgumentoSalida($valor){

		$respuesta = ModeloSalidas::mdlMostrarArgumentoSalida($valor);

		return $respuesta;

    }

    /*
    *MOSTRAR DETALLE DE TAMPOERAL
    */
	static public function ctrMostrarDetallesTemporal($valor){

		$tabla = "detalle_ing_sal";

		$respuesta = ModeloSalidas::mdlMostraDetallesTemporal($tabla, $valor);

		return $respuesta;

    }
    
    /* 
    * CREAR ARTICULOS EN LA SALIDA
    */

    static public function ctrCrearSalida(){

        if(isset($_POST["salida"])){

            /*
            todo: VARIABLES GLOBALES DEL TALONARIO
            */
            $tabla = "ing_sal";

            #ver si ya existe el pedido
            $salida = ModeloSalidas::mdlMostrarTemporal($tabla, $_POST["salida"]);
            #var_dump("pedido", $pedido);

            if($salida["codigo"] != ""){ #si ya existe

                /*
                todo: GUARDAR EL DETALLE TEMPORAL - CUANDO YA EXISTE EL TEMPORAL
                */
                $valor = $_POST["modeloModalA"];
                $respuesta = controladorArticulos::ctrVerArticulos($valor);

                foreach($respuesta as $value){

                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_ing_sal";
                    $val1 = $articulo;
                    $val2 = $_POST[$articulo];
                    $val3 = $_POST["salida"];
                    $val4 = $_POST["precioA"];

                    #1ero eliminar si ya se registro
                    $eliminar = array(  "codigo" => $val3,
                                        "articulo" => $val1);

                    $limpiar = ModeloSalidas::mdlEliminarDetalleTemporal($tabla, $eliminar);

                    if($val2 > 0){

                       
                        #var_dump("eliminar", $eliminar);
                        #var_dump("limpiar", $limpiar);

                        $datos = array( "codigo"    => $val3,
                                        "articulo"  => $val1,
                                        "cantidad"  => $val2,
                                        "precio"    => $val4);
                        #var_dump("datos", $datos);

                        $respuesta = ModeloPedidos::mdlGuardarTemporalDetalle($tabla, $datos);
                        #var_dump("respuesta", $respuesta);

                        if($respuesta = "ok"){

                            echo '  <script>

                                        window.location="index.php?ruta=crear-salidas-varios&salida='.$_POST["salida"].'";

                                    </script>';

                        }

                    }

                }



            }else{ #si no existe

                #vemos el numero que sigue en el talonario y actualizamos en +1
                $numero = ControladorMovimientos::ctrMostrarTalonarioSalida();
                $talonario = $numero["pedido"] + 1;
                ModeloSalidas::mdlActualizarTalonario();

                $usuario = $_POST["usuario"];
                $talonarioN = $usuario.$talonario;

                /*
                todo: GUARDAR CABECERA
                */
                $datos = array( "codigo" => $talonarioN,
                                "cliente" => $_POST["clienteA"],
                                "vendedor" => $_POST["vendedorA"],
                                "lista" => $_POST["nLista"],
                                "usuario" => $_POST["usuario"]);
                                // var_dump($datos);

                ModeloSalidas::mdlGuardarTemporal($tabla, $datos);

                /*
                todo: GUARDAR EL DETALLE TEMPORAL
                */
                $valor = $_POST["modeloModalA"];
                $respuesta = controladorArticulos::ctrVerArticulos($valor);

                foreach($respuesta as $value){

                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_ing_sal";
                    $val1 = $articulo;
                    $val2 = $_POST[$articulo];
                    $val3 = $talonarioN;
                    $val4 = $_POST["precioA"];

                    if($val2 > 0){

                        $datos = array( "codigo"    => $val3,
                                        "articulo"  => $val1,
                                        "cantidad"  => $val2,
                                        "precio"    => $val4);
                        #var_dump("datos", $datos);

                        $respuesta = ModeloSalidas::mdlGuardarTemporalDetalle($tabla, $datos);
                        #var_dump("respuesta", $respuesta);

                        if($respuesta = "ok"){

                            echo '  <script>

                                        window.location="index.php?ruta=crear-salidas-varios&salida='.$talonarioN.'";

                                    </script>';

                        }

                    }

                }

            }

        }

    }


    /* 
    *CREAR CONDICIONES DE VENTA Y TOTALES
    */
    static public function ctrCrearSalidasTotales(){

        if(isset($_POST["codigoM"])){

            /*
            * ACTUALIZAMOS LOS TOTALES DEL PEDIDO
            */
            $datos = array( "cliente" => $_POST["codClienteM"],
                            "codigo" => $_POST["codigoM"],
                            "op_gravada" => $_POST["opGravadaM"],
                            "descuento_total" => $_POST["descuentoM"],
                            "sub_total" => $_POST["subTotalM"],
                            "impuesto" => $_POST["igvM"],
                            "total" => $_POST["totalM"],
                            "usuario" => $_POST["usuarioM"]);

            //var_dump($datos);

            $respuesta = ModeloSalidas::mdlActualizarTotalesPedido($datos);
            //var_dump($respuesta);
            if($respuesta == "ok"){

                $articulosM=json_decode($_POST["articulosM"],true);
                //var_dump($articulosM);

                /* 
                *ACTUALIZAMOS LAS CANTIDADES EN PEDIDOS
                */
                foreach($articulosM as $key => $value){

                    $articulo = $value["articulo"];

                    $verArticulos = ModeloArticulos::mdlMostrarArticulos($articulo);
                    //var_dump($verArticulos["pedidos"]);

                    $cantidad = $value["cantidad"];
                    //var_dump($cantidad);

                    $pedidos = $verArticulos["pedidos"] + $cantidad;
                    //var_dump($pedidos);

                    //ModeloArticulos::mdlActualizarCantPedidos($articulo, $pedidos);

                }

                $respuesta = ModeloSalidas::mdlEliminarDetalleTemporalTotal($datos);

                //var_dump($respuesta);

                foreach($articulosM as $key=>$value){

                    $datos=array(   "codigo"=>$_POST["codigoM"],
                                    "articulo"=>$value["articulo"],
                                    "cantidad"=>$value["cantidad"],
                                    "precio"=>$value["precio"],
                                    "total"=>$value["total"]);

                    //var_dump($datos);

                    $resp = ModeloSalidas::mdlGuardarTemporalDetalle("detalle_ing_sal", $datos);

                    if($resp == "ok"){

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
                                        window.location="salidas-varios";}
                                });
                            </script>';

                    }else{

                        var_dump("no llego aqui");

                    }


                }



            }else{

                var_dump("no llego aqui");

            }

        }

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostrarSalidasCabecera($valor){

		$respuesta = ModeloSalidas::mdlMostrarSalidasCabecera($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL - GENERAL
    */
	static public function ctrMostrarSalidasGeneral($valor){

		$respuesta = ModeloSalidas::mdlMostrarSalidasGeneral($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR TABLAS
    */
	static public function ctrMostraPedidosTablas($valor){

		$respuesta = ModeloSalidas::mdlMostraPedidosTablas($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION
    */
	static public function ctrSalidaImpresion($codigo, $modelo){

		$respuesta = ModeloSalidas::mdlSalidaImpresion($codigo, $modelo);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION - MODELOS
    */
	static public function ctrSalidaImpresionMod($valor){

		$respuesta = ModeloSalidas::mdlSalidaImpresionMod($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION - CABECERA
    */
	static public function ctrSalidaImpresionCab($valor){

		$respuesta = ModeloSalidas::mdlSalidaImpresionCab($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION - TOTALES GENERALES
    */
	static public function ctrSalidaImpresionTotales($valor){

		$respuesta = ModeloSalidas::mdlSalidaImpresionTotales($valor);

		return $respuesta;

    }

    /*
    * LISTAR DOCUMENTOS
    */
	static public function ctrListarDocumentos($valor){

		$respuesta = ModeloSalidas::mdlListarDocumentos($valor);

		return $respuesta;

    }

}