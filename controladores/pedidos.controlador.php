<?php

class ControladorPedidos{

    /*
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostrarTemporal($valor){

		$tabla = "temporaljf";

		$respuesta = ModeloPedidos::mdlMostrarTemporal($tabla, $valor);

		return $respuesta;

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL TOTAL
    */
	static public function ctrMostrarTemporalTotal($valor){

		$respuesta = ModeloPedidos::mdlMostrarTemporalTotal($valor);

		return $respuesta;

    }

    /*
    *MOSTRAR DETALLE DE TAMPOERAL
    */
	static public function ctrMostrarDetallesTemporal($valor){

		$tabla = "detalle_temporal";

		$respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $valor);

		return $respuesta;

    }
    
    /* 
    * CREAR ARTICULOS EN EL PEDIDO
    */

    static public function ctrCrearPedido(){

        if(isset($_POST["pedido"])){

            /*
            todo: VARIABLES GLOBALES DEL TALONARIO
            */
            $tabla = "temporaljf";

            #ver si ya existe el pedido
            $pedido = ModeloPedidos::mdlMostrarTemporal($tabla, $_POST["pedido"]);
            #var_dump("pedido", $pedido);

            if($pedido["codigo"] != ""){ #si ya existe

                /*
                todo: GUARDAR EL DETALLE TEMPORAL - CUANDO YA EXISTE EL TEMPORAL
                */
                $valor = $_POST["modeloModalA"];
                $respuesta = controladorArticulos::ctrVerArticulos($valor);

                foreach($respuesta as $value){

                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_temporal";
                    $val1 = $articulo;
                    $val2 = $_POST[$articulo];
                    $val3 = $_POST["pedido"];
                    $val4 = $_POST["precioA"];

                    #1ero eliminar si ya se registro
                    $eliminar = array(  "codigo" => $val3,
                    "articulo" => $val1);

                    $limpiar = ModeloPedidos::mdlEliminarDetalleTemporal($tabla, $eliminar);

                    if($val2 > 0){

                        
                        // var_dump("eliminar", $eliminar);
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

                                        window.location="index.php?ruta=crear-pedidocv&pedido='.$_POST["pedido"].'";

                                    </script>';

                        }

                    }

                }



            }else{ #si no existe

                #vemos el numero que sigue en el talonario y actualizamos en +1
                $numero = ControladorMovimientos::ctrMostrarTalonario();
                $talonario = $numero["pedido"] + 1;
                ModeloPedidos::mdlActualizarTalonario();

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

                ModeloPedidos::mdlGuardarTemporal($tabla, $datos);

                /*
                todo: GUARDAR EL DETALLE TEMPORAL
                */
                $valor = $_POST["modeloModalA"];
                $respuesta = controladorArticulos::ctrVerArticulos($valor);

                foreach($respuesta as $value){

                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_temporal";
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

                        $respuesta = ModeloPedidos::mdlGuardarTemporalDetalle($tabla, $datos);
                        #var_dump("respuesta", $respuesta);

                        if($respuesta = "ok"){

                            echo '  <script>

                                        window.location="index.php?ruta=crear-pedidocv&pedido='.$talonarioN.'";

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
    static public function ctrCrearPedidoTotales(){

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
                            "usuario" => $_POST["usuarioM"],
                            "condicion_venta" => $_POST["condicionVentaM"],
                            "agencia" => $_POST["agenciaM"]);

            //var_dump($datos);

            $respuesta = ModeloPedidos::mdlActualizarTotalesPedido($datos);
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

                $respuesta = ModeloPedidos::mdlEliminarDetalleTemporalTotal($datos);

                //var_dump($respuesta);

                foreach($articulosM as $key=>$value){

                    $datos=array(   "codigo"=>$_POST["codigoM"],
                                    "articulo"=>$value["articulo"],
                                    "cantidad"=>$value["cantidad"],
                                    "precio"=>$value["precio"],
                                    "total"=>$value["total"]);

                    //var_dump($datos);

                    $resp = ModeloPedidos::mdlGuardarTemporalDetalle("detalle_temporal", $datos);

                }

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
                                    window.location="pedidoscv";}
                            });
                        </script>';

                }else{

                    var_dump("no llego aqui");

                }



            }else{

                var_dump("no llego aqui");

            }

        }

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostraPedidosCabecera($valor){

		$respuesta = ModeloPedidos::mdlMostraPedidosCabecera($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL - GENERAL
    */
	static public function ctrMostraPedidosGeneral($valor){

		$respuesta = ModeloPedidos::mdlMostraPedidosGeneral($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR TABLAS
    */
	static public function ctrMostraPedidosTablas($valor){

		$respuesta = ModeloPedidos::mdlMostraPedidosTablas($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION
    */
	static public function ctrPedidoImpresion($codigo, $modelo){

		$respuesta = ModeloPedidos::mdlPedidoImpresion($codigo, $modelo);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION - MODELOS
    */
	static public function ctrPedidoImpresionMod($valor){

		$respuesta = ModeloPedidos::mdlPedidoImpresionMod($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION - CABECERA
    */
	static public function ctrPedidoImpresionCab($valor){

		$respuesta = ModeloPedidos::mdlPedidoImpresionCab($valor);

		return $respuesta;

    }

    /*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION - TOTALES GENERALES
    */
	static public function ctrPedidoImpresionTotales($valor){

		$respuesta = ModeloPedidos::mdlPedidoImpresionTotales($valor);

		return $respuesta;

    }

    /* 
    *ANULAR PEDIDO
    */
	static public function ctrAnularPedido(){

        if(isset($_GET["codigoP"])){

            $codigo = $_GET["codigoP"];
            //var_dump("AQUI",$codigo);

            $pedido = ModeloPedidos::mdlMostraPedidosCabecera($codigo);
            //var_dump($pedido);

            $respuesta = ModeloFacturacion::mdlActualizarPedido($codigo,"ANULADO",$_SESSION["id"]);
            #var_dump($respuesta);

            $reiniciar = ModeloPedidos::mdlReiniciarPedido();
            #var_dump($reiniciar);

            $contar = ModeloPedidos::mdlCantAprobados();
            #var_dump($contar);

            if($contar == "ok"){

                echo'<script>

                swal({
                    type: "success",
                    title: "El pedido ha sido anulada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then(function(result){
                                if (result.value) {

                                window.location = "pedidoscv";

                                }
                            })

                </script>';

            }



        }


    }    

}