<?php


class ControladorFacturacion{

    static public function ctrFacturar(){

        if(isset($_POST["codPedido"])){

            if($_POST["tdoc"] == "00"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaGuia = ModeloArticulos::mdlActualizarStock($datos);
                    $respuestaGuia = ModeloArticulos::mdlActualizarPedido($datos);
                    //var_dump($respuestaGuia);

                }

                //var_dump($respuestaGuia);

                /*
                todo: registrar en movimientos
                */
                if($respuestaGuia == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S01",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "GUIA REMISION");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDestino = $_POST["serieSeparado"];
                        $docDest = str_replace ( '-', '', $docDestino);
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S01",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "GUIA REMISION");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /* 
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,3);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioGuia($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero la Guia '.$documento.'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "pedidoscv";

                                            }
                                        })

                            </script>';

                        }

                    }


                }

            }else if($_POST["tdoc"] == "01"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaFactura = ModeloArticulos::mdlActualizarStock($datos);
                    $respuestaGuia = ModeloArticulos::mdlActualizarPedido($datos);
                    //var_dump($respuestaFactura);

                }

                //var_dump($respuestaFactura);

                /*
                todo: registrar en movimientos
                */
                if($respuestaFactura == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S03",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "FACTURA");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDest = "";
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S03",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "FACTURA");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /*
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,4);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioFactura($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            /*
                            todo:GENERAMOS LA CUENTA CORRIENTE
                            */
                            $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                            //var_dump($respuestaDoc);

                            $tipo_doc = $_POST["tdoc"];
                            //var_dump($tipo_doc);

                            $documento = $_POST["serie"];
                            $doc = str_replace ( '-', '', $documento);
                            //var_dump($doc);

                            $cliente = $respuestaDoc["cod_cli"];
                            //var_dump($cliente);

                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);

                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);

                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);

                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipo_doc;
                            //var_dump($cod_pago);

                            $usuario = $_POST["idUsuario"];
                            //var_dump($usuario);

                            $datos = array( "tipo_doc" => $tipo_doc,
                                            "num_cta" => $doc,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                            //var_dump($datos);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datos);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la Factura '.$documento.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
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

            }else if($_POST["tdoc"] == "03"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaBoleta = ModeloArticulos::mdlActualizarStock($datos);
                    $respuestaGuia = ModeloArticulos::mdlActualizarPedido($datos);
                    //var_dump($respuestaBoleta);

                }

                //var_dump($respuestaBoleta);

                /*
                todo: registrar en movimientos
                */
                if($respuestaBoleta == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S02",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "BOLETA");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDest = "";
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S02",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "BOLETA");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /*
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,4);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioBoleta($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            /*
                            todo:GENERAMOS LA CUENTA CORRIENTE
                            */
                            $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                            //var_dump($respuestaDoc);

                            $tipo_doc = $_POST["tdoc"];
                            //var_dump($tipo_doc);

                            $documento = $_POST["serie"];
                            $doc = str_replace ( '-', '', $documento);
                            //var_dump($doc);

                            $cliente = $respuestaDoc["cod_cli"];
                            //var_dump($cliente);

                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);

                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);

                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);

                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipo_doc;
                            //var_dump($cod_pago);

                            $usuario = $_POST["idUsuario"];
                            //var_dump($usuario);

                            $datos = array( "tipo_doc" => $tipo_doc,
                                            "num_cta" => $doc,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                            //var_dump($datos);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datos);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la Boleta '.$documento.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
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

            }else if($_POST["tdoc"] == "09"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaProforma = ModeloArticulos::mdlActualizarStock($datos);
                    $respuestaGuia = ModeloArticulos::mdlActualizarPedido($datos);
                    //var_dump($respuestaProforma);

                }

                //var_dump($respuestaProforma);

                /*
                todo: registrar en movimientos
                */
                if($respuestaProforma == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S70",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "PROFORMA");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDest = "";
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S70",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "PROFORMA");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /*
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,3);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioProforma($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            /*
                            todo:GENERAMOS LA CUENTA CORRIENTE
                            */
                            $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                            //var_dump($respuestaDoc);

                            $tipo_doc = $_POST["tdoc"];
                            //var_dump($tipo_doc);

                            $documento = $_POST["serie"];
                            $doc = str_replace ( '-', '', $documento);
                            //var_dump($doc);

                            $cliente = $respuestaDoc["cod_cli"];
                            //var_dump($cliente);

                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);

                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);

                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);

                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipo_doc;
                            //var_dump($cod_pago);

                            $usuario = $_POST["idUsuario"];
                            //var_dump($usuario);

                            $datos = array( "tipo_doc" => $tipo_doc,
                                            "num_cta" => $doc,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                            //var_dump($datos);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datos);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la Proforma '.$documento.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
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

            }else{

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){


                    $respuestaNota = ModeloArticulos::mdlActualizarStockIngreso($value["articulo"],$value["cantidad"]);//sube
                    // $respuestaGuia = ModeloArticulos::mdlActualizarPedido($datos);
                    //var_dump($respuestaNota);

                }

                //var_dump($respuestaNota);

                /*
                todo: registrar en movimientos
                */
                if($respuestaNota == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "E05",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => "-".$value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => "-".$total,
                                        "nombre_tipo" => "NC");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDest = "";
                        //var_dump($docDest);

                        $datosD = array("tipo" => "E05",
                                        "documento" => $doc,
                                        "neto" => "-".$respuestaDoc["op_gravada"],
                                        "igv" => "-".$respuestaDoc["igv"],
                                        "dscto" => "-".$respuestaDoc["descuento_total"],
                                        "total" => "-".$respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "NC");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /*
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,4);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarNotaSerie("nota_credito","serie_nc",$serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            $documento = $_POST["serie"];
                            $doc = str_replace ( '-', '', $documento);

                            $tip_nota = $_POST["tdocorigen"];
                            
                            $origen_venta = $_POST["serieOrigen"];
                            
                            $fecha_origen = $_POST["fechaOrigen"];

                            $usuario = $_POST["idUsuario"];
                            //var_dump($usuario);

                            $arregloNota = array("tipo"=>'E05',
                                                "documento"=>$doc,
                                                "tipo_doc"=>$tip_nota,
                                                "doc_origen"=>$origen_venta,
                                                "fecha_origen"=>$fecha_origen,
                                                "motivo"=>'C5',
                                                "tip_cont"=>'DE',
                                                "observacion"=>'',
                                                "usuario"=>$usuario);

                            $notaCredito = ModeloFacturacion::mdlIngresarNotaCD($arregloNota);
                            //var_dump($ctacte);

                            if($notaCredito == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la Nota cred. '.$doc.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
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

            }

        }else{

            //var_dump("no");

        }

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostrarTablas($tipo, $estado, $valor){

		$respuesta = ModeloFacturacion::mdlMostrarTablas($tipo, $estado, $valor);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHAS DE FACTURAS
    */
	static public function ctrRangoFechasFacturas($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasFacturas($fechaInicial, $fechaFinal);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHA DE BOLETAS
    */
	static public function ctrRangoFechasBoletas($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasBoletas( $fechaInicial, $fechaFinal);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHA DE PROFORMAS
    */
	static public function ctrRangoFechasProformas($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasProformas( $fechaInicial, $fechaFinal);

		return $respuesta;

    }

        /*
    * MOSTRAR talonarios credito
    */
	static public function ctrMostrarTalonarios($item, $valor){
        $tabla="talonariosjf";
		$respuesta = ModeloFacturacion::mdlMostrarTalonarios($tabla, $item, $valor);

		return $respuesta;

    }

    /*
    * MOSTRAR talonarios debito
    */
	static public function ctrMostrarTalonariosDebito($item, $valor){
        $tabla="talonariosjf";
		$respuesta = ModeloFacturacion::mdlMostrarTalonariosDebito($tabla, $item, $valor);

		return $respuesta;

    }

    /*
    * MOSTRAR RANGO DE FECHAS DE NOTAS DE VENTA CREDITO/DEBITO
    */
	static public function ctrRangoFechasNotasCD($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasNotasCD( $fechaInicial, $fechaFinal);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHA DE PROCESAR COMPROBANTES ELECTRONICOS
    */
	static public function ctrRangoFechasProcesarCE($fechaInicial, $fechaFinal,$tipo){
		$respuesta = ModeloFacturacion::mdlRangoFechasProcesarCE( $fechaInicial, $fechaFinal,$tipo);

		return $respuesta;

    }

    
     /*
    * MOSTRAR NOTAS DE DEBITO PARA IMPRESION
    */
	static public function ctrMostrarDebitoImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarDebitoImpresion( $documento, $tipo);

		return $respuesta;

    }


    /*
    * MOSTRAR VENTA DE NOTAS PARA IMPRESION
    */
	static public function ctrMostrarVentaImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarVentaImpresion( $documento, $tipo);

		return $respuesta;

    }

    /*
    * MOSTRAR MODELO DE NOTAS PARA IMPRESION
    */
	static public function ctrMostrarModeloImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarModeloImpresion( $documento, $tipo);

		return $respuesta;

    }

    /*
    * MOSTRAR MODELO DE PROFORMAS PARA IMPRESION
    */
	static public function ctrMostrarModeloProforma($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarModeloProforma( $documento, $tipo);

		return $respuesta;

    }


    /*
    * MOSTRAR UNIDADES DE BOLETA Y FACTURA PARA IMPRESION
    */
	static public function ctrMostrarUnidadesImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarUnidadesImpresion( $documento, $tipo);

		return $respuesta;

    }

    static public function ctrFacturarGuia(){

        if(isset($_POST["codPedido"])){

            $codigo = $_POST["codPedido"];
            //var_dump($codigo);
            $serie = $_POST["serieDest"];
            //var_dump($serie);
            $documento = $_POST["docDest"];
            //var_dump($serie.$documento);
            $docDestino = $serie.$documento;
            //var_dump($docDestino);

            $tip_dest = substr($serie, 0, 1);
            //var_dump($tip_dest);
            date_default_timezone_set("America/Lima");
            $fecha = date("Y-m-d");
            //var_dump($fecha);
            $tipo_origen = "S01";
            //var_dump($tipo_origen);
            $usuario = $_POST["idUsuario"];

            if($tip_dest == "F"){

                $tipo = "S03";
                //var_dump($tipo);
                $tipoCta = '01';
                //var_dump($tipoCta);
                $nombre_tipo="FACTURA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioFactura($serie);
                //var_dump("factura", $talonario);

            }else{

                $tipo = "S02";
                //var_dump($tipo);
                $tipoCta = '03';
                //var_dump($tipoCta);
                $nombre_tipo="BOLETA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioBoleta($serie);
                //var_dump("boleta", $talonario);

            }

            /*
            todo GENERAMOS EN MOVIMIENTOS
            */

            $datos = array( "tipo" => $tipo,
                            "documento" => $docDestino,
                            "fecha" => $fecha,
                            "nombre_tipo" => $nombre_tipo,
                            "codigo" => $codigo,
                            "tipo_documento" => $tipo_origen);
            //var_dump($datos);

            $facturar = ModeloFacturacion::mdlFacturarGuiaM($datos);
            //var_dump($facturar);

            /*
            todo REGISTRAMOS EN VENTAJF
            */
            if($facturar == "ok"){

                //var_dump($tipo);
                //var_dump($docDestino);
                //var_dump($nombre_tipo);
                //var_dump($codigo);
                //var_dump($usuario);

                $datosV = array(    "tipo_ori" => "S01",
                                    "tipo" => $tipo,
                                    "documento" => $docDestino,
                                    "tipo_documento" => $nombre_tipo,
                                    "doc_origen" => $codigo,
                                    "usuario" => $usuario);
                //var_dump($datosV);

                $facturarV = ModeloFacturacion::mdlFacturarGuiaV($datosV);
                //$facturarV = "ok";
                //var_dump($facturar);

                if($facturarV == "ok"){

                    $estado = ModeloFacturacion::mdlActualizarGuiaF($codigo);
                    //var_dump($estado);

                    if($estado == "ok"){

                        $codCta = $docDestino;
                        //var_dump($codCta);
                        $tipoDoc = $tipo;

                        $respuestaDoc = ModeloFacturacion::mdlMostraVentaDocumento($codCta, $tipoDoc);
                        //var_dump($respuestaDoc);

                        $cliente = $respuestaDoc["cliente"];
                        //var_dump($cliente);
                        $vendedor = $respuestaDoc["vendedor"];
                        //var_dump($vendedor);

                        date_default_timezone_set("America/Lima");
                        $fecha = date("Y-m-d");
                        //var_dump($fecha);
                        $dias = $respuestaDoc["dias"];
                        //var_dump($dias);
                        $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                        //var_dump($fecha_ven);

                        $monto = $respuestaDoc["total"];
                        //var_dump($monto);
                        $saldo = $respuestaDoc["total"];
                        //var_dump($saldo);

                        $cod_pago = $tipoCta;
                        //var_dump($cod_pago);

                        $datosCta = array(  "tipo_doc" => $tipoCta,
                                            "num_cta" => $docDestino,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                        //var_dump($datosCta);

                        $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datosCta);
                        //var_dump($ctacte);

                        if($ctacte == "ok"){

                            echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero la '.$nombre_tipo.' N° '.$docDestino.'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "guias-remision";

                                            }
                                        })

                            </script>';

                        }

                    }

                }

            }

        }

    }

    /* 
    * FACTURAR DESDE GUIA
    */
    static public function ctrFacturarB(){

        if(isset($_POST["codPedidoB"])){

            $codigo = $_POST["codPedidoB"];
            //var_dump($codigo);
            $doc = $_POST["serieSeparadoB"];
            $docDestino = str_replace ( '-', '', $doc);
            //var_dump($docDestino);
            $tip_dest = substr($docDestino, 0, 1);
            //var_dump($tip_dest);
            date_default_timezone_set("America/Lima");
            $fecha = date("Y-m-d");
            //var_dump($fecha);
            $tipo_origen = "S01";
            //var_dump($tipo_origen);
            $usuario = $_POST["idUsuarioB"];
            //var_dump($usuario);

            $serie = substr($docDestino, 0, 4);;
            //var_dump($serie);

            if($tip_dest == "F"){

                $tipo = "S03";
                //var_dump($tipo);
                $tipoCta = '01';
                //var_dump($tipoCta);
                $nombre_tipo="FACTURA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioFactura($serie);
                //var_dump("factura", $talonario);

            }else{

                $tipo = "S02";
                //var_dump($tipo);
                $tipoCta = '03';
                //var_dump($tipoCta);
                $nombre_tipo="BOLETA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioBoleta($serie);
                //var_dump("boleta", $talonario);

            }

                /*
                todo GENERAMOS EN MOVIMIENTOS
                */
                $datos = array( "tipo" => $tipo,
                                "documento" => $docDestino,
                                "fecha" => $fecha,
                                "nombre_tipo" => $nombre_tipo,
                                "codigo" => $codigo,
                                "tipo_documento" => $tipo_origen);
                //var_dump($datos);

                $facturar = ModeloFacturacion::mdlFacturarGuiaM($datos);
                //var_dump($facturar);

                /*
                todo REGISTRAMOS EN VENTAJF
                */
                if($facturar == "ok"){

                    $datosV = array(    "tipo_ori" => "S01",
                                        "tipo" => $tipo,
                                        "documento" => $docDestino,
                                        "tipo_documento" => $nombre_tipo,
                                        "doc_origen" => $codigo,
                                        "usuario" => $usuario);
                    //var_dump($datosV);

                    $facturarV = ModeloFacturacion::mdlFacturarGuiaV($datosV);
                    //var_dump($facturarV);

                    if($facturarV == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarGuiaF($codigo);
                        //var_dump($estado);

                        if($estado == "ok"){

                            $codCta = $docDestino;
                            //var_dump($codCta);
                            $tipoDoc = $tipo;

                            $respuestaDoc = ModeloFacturacion::mdlMostraVentaDocumento($codCta, $tipoDoc);
                            //var_dump($respuestaDoc);

                            $cliente = $respuestaDoc["cliente"];
                            //var_dump($cliente);
                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);
                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);
                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);
                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipoCta;
                            //var_dump($cod_pago);

                            $datosCta = array(  "tipo_doc" => $tipoCta,
                                                "num_cta" => $docDestino,
                                                "cliente" => $cliente,
                                                "vendedor" => $vendedor,
                                                "fecha_ven" => $fecha_ven,
                                                "monto" => $monto,
                                                "cod_pago" => $cod_pago,
                                                "usuario" => $usuario,
                                                "saldo" => $saldo);
                            //var_dump($datosCta);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datosCta);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la '.$nombre_tipo.' N° '.$docDestino.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                }).then(function(result){
                                                if (result.value) {

                                                window.location = "guias-remision";

                                                }
                                            })

                                </script>';

                            }

                        }

                    }

                }


        }

    }

    static public function ctrFacturarSalida(){

        if(isset($_POST["codSalida"])){


                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_ing_sal";

                $respuesta = ModeloSalidas::mdlMostraDetallesTemporal($tabla, $_POST["codSalida"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);
                    $inicioTipo = substr($_POST["tdoc"],0,1);
                    if($inicioTipo == 'E'){
                        $respuestaGuia = ModeloArticulos::mdlActualizarStockIngreso($value["articulo"],$value["cantidad"]);
                    }else{
                        $respuestaGuia = ModeloArticulos::mdlActualizarStock($datos);
                    }
                    
                    //var_dump($respuestaGuia);

                }

                //var_dump($respuestaGuia);

                /*
                todo: registrar en movimientos
                */
                if($respuestaGuia == "ok"){

                    foreach($respuesta as $value){

                        $tipo= $_POST["tdoc"];

                        $documento = $_POST["serieSalida"];
                        $doc = $tipo.$documento;
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => $tipo,
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => $_POST["nomTipo"]);
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloSalidas::mdlMostrarSalidasCabecera($_POST["codSalida"]);
                        //var_dump($respuestaDoc);

                        $tipo= $_POST["tdoc"];

                        $documento = $_POST["serieSalida"];
                        $doc = $tipo.$documento;
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codSalida"];
                        //var_dump("$docOrigen");

                        $docDestino = $_POST["serieSeparado"];
                        $docDest = str_replace ( '-', '', $docDestino);
                        //var_dump($docDest);

                        $datosD = array("tipo" => $tipo,
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => $_POST["nomTipo"]);
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloSalidas::mdlRegistrarDocumentoSalida($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /* 
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $serie = $_POST["tdoc"];
                        //var_dump($serie);

                        $talonario = ModeloSalidas::mdlActualizarArgumento($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloSalidas::mdlActualizarSalidaF($_POST["codSalida"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero el documento '.$documento.'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "salidas-varios";

                                            }
                                        })

                            </script>';

                        }

                    }


                }

            

        }else{

            //var_dump("no");

        }

    }

    static public function ctrCrearFacturaXML(){

        if(isset($_GET["tipoFact"]) && isset($_GET["documentoFact"])){

            $doc = new DOMDocument();
            $doc->formatOutput = FALSE;
            $doc->preserveWhiteSpace = TRUE;
            $doc->encoding = 'utf-8';

            require_once("/../extensiones/cantidad_en_letras.php");
            // require_once("/../vistas/generar_xml/signature.php"); // permite firmar xml

            $tipo = $_GET["tipoFact"];

            $documento = $_GET["documentoFact"];
            $venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);

            $modelos = ControladorFacturacion::ctrMostrarModeloImpresion($documento,$tipo);

            $unidad= ControladorFacturacion::ctrMostrarUnidadesImpresion($documento,$tipo);
            // var_dump($modelos);
            // $emisor = 	array(
            //             'tipodoc'		=> '6',
            //             'ruc' 			=> '20513613939', 
            //             'nombre_comercial'=> 'JACKY FORM',
            //             'razon_social'	=> 'Corporacion Vasco S.A.C.', 
            //             'referencia'	=> 'URB.SANTA LUISA 1RA ETAPA', 
            //             'direccion'		=> 'CAL.SANTO TORIBIO NRO. 259',
            //             'pais'			=> 'PE', 
            //             'departamento'  => 'LIMA',
            //             'provincia'		=> 'LIMA',
            //             'distrito'		=> 'SAN MARTIN DE PORRES',
            //             'ubigeo'		=> '140101', //CHICLAYO
            //             'usuario_sol'	=> 'MODDATOS', //USUARIO SECUNDARIO EMISOR ELECTRONICO
            //             'clave_sol'		=> 'MODDATOS' //CLAVE DE USUARIO SECUNDARIO EMISOR ELECTRONICO
            //             );

            //prueba para mandar a sunat 

            if($tipo == 'S03'){
                $tipcomprobante = '01';
            }else{
                $tipcomprobante = '03';
            }
            $emisor = 	array(
                'tipodoc'		=> '6',
                'ruc' 			=> '10472810371', 
                'razon_social'	=> 'JOEL VLADIMIR MEDRANO GÜERE', 
                'nombre_comercial'	=> 'JOEL VLADIMIR MEDRANO GÜERE', 
                'direccion'		=> 'CAL. GREGORIO SISA 133 - CARABAYLLO', 
                'pais'			=> 'PE', 
                'departamento'  => 'LIMA',//LIMA 
                'provincia'		=> 'LIMA',//LIMA 
                'distrito'		=> 'CARABAYLLO', //CARABAYLLO
                'ubigeo'		=> '150106', //CARABAYLLO
                'usuario_sol'	=> 'JOELABCD', //USUARIO SECUNDARIO EMISOR ELECTRONICO
                'clave_sol'		=> 'Unisty1' //CLAVE DE USUARIO SECUNDARIO EMISOR ELECTRONICO
                );
    
    

            $cliente = array(
                        'ruc'			=> $venta["dni"], 
                        'razon_social'  => $venta["nombre"], 
                        'cliente'       => $venta["cliente"],
                        'direccion'		=> $venta["direccion"],
                        'pais'			=> 'PE'
                        );	

            $vendedor = array(
                        "codigo"		=> $venta["vendedor"],
                        "nombre"		=> $venta["nom_vendedor"]
                        );

            $comprobante =	array(
                        'tipodoc'		=> $tipcomprobante, //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
                        'serie'			=> substr($venta["documento"],0,4),
                        'correlativo'	=> substr($venta["documento"],4,12),
                        'fecha_emision' => $venta["fecha_emision"],
                        'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
                        'total_opgravadas'=> 0, //OP. GRAVADAS
                        'total_opexoneradas'=>0,
                        'total_opinafectas'=>0,
                        'igv'			=> 0,
                        'total'			=> 0,
                        'total_texto'	=> ''
                    );



            $op_gravadas = 0;
            $op_inafectas = 0;
            $op_exoneradas = 0;

            $comprobante['total_opgravadas'] = $venta["neto"];
            $comprobante['total_opexoneradas'] = $op_exoneradas;
            $comprobante['total_opinafectas'] = $op_inafectas;
            $comprobante['igv'] = $venta["igv"];
            $comprobante['total'] = $venta["total"];
            $comprobante['total_texto'] = CantidadEnLetra($venta["total"]);
            $totalSinIGV= $venta["total"] - $venta["igv"];

            //RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
            //01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
            $nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

            $ruta = "vistas/generar_xml/archivos_xml/".$nombrexml;

            $tipoCliente = $cliente["ruc"];

            if(strlen($tipoCliente) == 8){
                $tipodoc='1';
            }else{
                $tipodoc='6';
            }

            $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
                
                <ext:UBLExtensions>
                    <ext:UBLExtension>
                        <ext:ExtensionContent />
                    </ext:UBLExtension>
               </ext:UBLExtensions>
               <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
               <cbc:CustomizationID>2.0</cbc:CustomizationID>
               <cbc:ID>'.$comprobante['serie'].'-'.$comprobante['correlativo'].'</cbc:ID>
               <cbc:IssueDate>'.$comprobante['fecha_emision'].'</cbc:IssueDate>
               <cbc:IssueTime>00:00:00</cbc:IssueTime>
               <cbc:DueDate>'.$comprobante['fecha_emision'].'</cbc:DueDate>
               <cbc:InvoiceTypeCode listID="0101">'.$comprobante['tipodoc'].'</cbc:InvoiceTypeCode>
               <cbc:Note languageLocaleID="1000"><![CDATA['.$comprobante['total_texto'].']]></cbc:Note>
               <cbc:DocumentCurrencyCode>'.$comprobante['moneda'].'</cbc:DocumentCurrencyCode>
               <cac:Signature>
                  <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                  <cbc:Note><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Note>
                  <cac:SignatoryParty>
                     <cac:PartyIdentification>
                        <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                     </cac:PartyIdentification>
                     <cac:PartyName>
                        <cbc:Name><![CDATA['.$emisor['razon_social'].']]></cbc:Name>
                     </cac:PartyName>
                  </cac:SignatoryParty>
                  <cac:DigitalSignatureAttachment>
                     <cac:ExternalReference>
                        <cbc:URI>#SIGN-EMPRESA</cbc:URI>
                     </cac:ExternalReference>
                  </cac:DigitalSignatureAttachment>
               </cac:Signature>
               <cac:AccountingSupplierParty>
                  <cac:Party>
                     <cac:PartyIdentification>
                        <cbc:ID schemeID="'.$emisor['tipodoc'].'">'.$emisor['ruc'].'</cbc:ID>
                     </cac:PartyIdentification>
                     <cac:PartyName>
                        <cbc:Name><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Name>
                     </cac:PartyName>
                     <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA['.$emisor['razon_social'].']]></cbc:RegistrationName>
                        <cac:RegistrationAddress>
                           <cbc:ID>'.$emisor['ubigeo'].'</cbc:ID>
                           <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                           <cbc:CitySubdivisionName>NONE</cbc:CitySubdivisionName>
                           <cbc:CityName>'.$emisor['provincia'].'</cbc:CityName>
                           <cbc:CountrySubentity>'.$emisor['departamento'].'</cbc:CountrySubentity>
                           <cbc:District>'.$emisor['distrito'].'</cbc:District>
                           <cac:AddressLine>
                              <cbc:Line><![CDATA['.$emisor['direccion'].']]></cbc:Line>
                           </cac:AddressLine>
                           <cac:Country>
                              <cbc:IdentificationCode>'.$emisor['pais'].'</cbc:IdentificationCode>
                           </cac:Country>
                        </cac:RegistrationAddress>
                     </cac:PartyLegalEntity>
                  </cac:Party>
               </cac:AccountingSupplierParty>
               <cac:AccountingCustomerParty>
                  <cac:Party>
                     <cac:PartyIdentification>
                        <cbc:ID schemeID="'.$tipodoc.'">'.$cliente['ruc'].'</cbc:ID>
                     </cac:PartyIdentification>
                     <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA['.$cliente['razon_social'].']]></cbc:RegistrationName>
                        <cac:RegistrationAddress>
                           <cac:AddressLine>
                              <cbc:Line><![CDATA['.$cliente['direccion'].']]></cbc:Line>
                           </cac:AddressLine>
                           <cac:Country>
                              <cbc:IdentificationCode>'.$cliente['pais'].'</cbc:IdentificationCode>
                           </cac:Country>
                        </cac:RegistrationAddress>
                     </cac:PartyLegalEntity>
                  </cac:Party>
               </cac:AccountingCustomerParty>
               
               <cac:PaymentTerms>
                  <cbc:ID>FormaPago</cbc:ID>
                  <cbc:PaymentMeansID>Contado</cbc:PaymentMeansID>
               </cac:PaymentTerms>';
                if($venta["dscto"] > 0){
                    $valor_dscto= $comprobante["total_opgravadas"] - $venta["dscto"];
                    $xml.='<cac:AllowanceCharge>
                        <cbc:ChargeIndicator>false</cbc:ChargeIndicator>
                        <cbc:AllowanceChargeReasonCode listAgencyName="PE:SUNAT" listName="Cargo/descuento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo53">02</cbc:AllowanceChargeReasonCode> 
                        <cbc:Amount currencyID="PEN">'.$venta["dscto"].'</cbc:Amount>
                    </cac:AllowanceCharge>';
                }else{
                    $valor_dscto= $comprobante["total_opgravadas"];
                }
               
      
               $xml.='<cac:TaxTotal>
                  <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                  <cac:TaxSubtotal>
                     <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$valor_dscto.'</cbc:TaxableAmount>
                     <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                     <cac:TaxCategory>
                        <cac:TaxScheme>
                           <cbc:ID>1000</cbc:ID>
                           <cbc:Name>IGV</cbc:Name>
                           <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                     </cac:TaxCategory>
                  </cac:TaxSubtotal>';
      
      
                  if($comprobante['total_opexoneradas']>0){
                     $xml.='<cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total_opexoneradas'].'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">0.00</cbc:TaxAmount>
                        <cac:TaxCategory>
                           <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                           <cac:TaxScheme>
                              <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9997</cbc:ID>
                              <cbc:Name>EXO</cbc:Name>
                              <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                           </cac:TaxScheme>
                        </cac:TaxCategory>
                     </cac:TaxSubtotal>';
                  }
      
                  if($comprobante['total_opinafectas']>0){
                     $xml.='<cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total_opinafectas'].'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">0.00</cbc:TaxAmount>
                        <cac:TaxCategory>
                           <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                           <cac:TaxScheme>
                              <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9998</cbc:ID>
                              <cbc:Name>INA</cbc:Name>
                              <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                           </cac:TaxScheme>
                        </cac:TaxCategory>
                     </cac:TaxSubtotal>';
                  }
      
                  $total_antes_de_impuestos = $comprobante['total_opgravadas']+$comprobante['total_opexoneradas']+$comprobante['total_opinafectas'];
      
               $xml.='</cac:TaxTotal>
               <cac:LegalMonetaryTotal>
                  <cbc:LineExtensionAmount currencyID="'.$comprobante['moneda'].'">'.$valor_dscto.'</cbc:LineExtensionAmount>
                  <cbc:TaxInclusiveAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total'].'</cbc:TaxInclusiveAmount>
                  <cbc:PayableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total'].'</cbc:PayableAmount>
               </cac:LegalMonetaryTotal>';
               
               foreach($modelos as $k=>$v){
                 
                  $igv = 0.18 * $v["total"];
                  $totalIGV = $v["total"]+$igv;
                  $precioIGV  = $totalIGV/$v["cantidad"];

                  $xml.='<cac:InvoiceLine>
                     <cbc:ID>'.($k+1).'</cbc:ID>
                     <cbc:InvoicedQuantity unitCode="'.$v['unidad'].'">'.number_format($v["cantidad"],3,".","").'</cbc:InvoicedQuantity>
                     <cbc:LineExtensionAmount currencyID="'.$comprobante['moneda'].'">'.$v['total'].'</cbc:LineExtensionAmount>
                     
                     <cac:PricingReference>
                        <cac:AlternativeConditionPrice>
                           <cbc:PriceAmount currencyID="'.$comprobante['moneda'].'">'.number_format($precioIGV,2,".","").'</cbc:PriceAmount>
                           <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
                        </cac:AlternativeConditionPrice>
                     </cac:PricingReference>
                     <cac:TaxTotal>
                        <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                        <cac:TaxSubtotal>
                           <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$v['total'].'</cbc:TaxableAmount>
                           <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                           <cac:TaxCategory>
                              <cbc:Percent>18</cbc:Percent>
                              <cbc:TaxExemptionReasonCode>10</cbc:TaxExemptionReasonCode>
                              <cac:TaxScheme>
                                 <cbc:ID>1000</cbc:ID>
                                 <cbc:Name>IGV</cbc:Name>
                                 <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                              </cac:TaxScheme>
                           </cac:TaxCategory>
                        </cac:TaxSubtotal>
                     </cac:TaxTotal>
                     <cac:Item>
                        <cbc:Description><![CDATA['.$v['nombre'].']]></cbc:Description>
                        <cac:SellersItemIdentification>
                           <cbc:ID>'.$v['modelo'].'</cbc:ID>
                        </cac:SellersItemIdentification>
                     </cac:Item>
                     <cac:Price>
                        <cbc:PriceAmount currencyID="'.$comprobante['moneda'].'">'.$v['precio'].'</cbc:PriceAmount>
                     </cac:Price>
                  </cac:InvoiceLine>';  	
                 }
      
                 $xml.="</Invoice>";

        

	    $doc->loadXML($xml);
	    $doc->save($ruta.'.XML');
        

        $actualizadoCreado = ModeloFacturacion::mdlActualizarProcesoFacturacion(1,$tipo,$documento);

        //CREAR XML FIRMA
        require_once('/../vistas/generar_xml/ApiFacturacion.php');

        $objApi = new ApiFacturacion();
        $envio = $objApi->EnviarComprobanteElectronico($emisor, $nombrexml);

        if($envio == "1"){
            echo "<script>  Command: toastr['success']('El XML FUE GENERADO EXITOSAMENTE')</script>";
            $actualizadoEnvio = ModeloFacturacion::mdlActualizarProcesoFacturacion(2,$tipo,$documento);

        }else{

            unlink($ruta.'.XML');
            unlink($ruta.'.ZIP');
        }          

        }

    }

    static public function ctrCrearNotaCreditoXML(){

        if(isset($_GET["tipoNotaCred"]) && isset($_GET["documentoNotaCred"])){

            $doc = new DOMDocument();
            $doc->formatOutput = FALSE;
            $doc->preserveWhiteSpace = TRUE;
            $doc->encoding = 'utf-8';

            require_once("/../extensiones/cantidad_en_letras.php");
            // require_once("/../vistas/generar_xml/signature.php"); // permite firmar xml

            $tipo = $_GET["tipoNotaCred"];

            $documento = $_GET["documentoNotaCred"];
            $venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);

            
     
            //prueba para mandar a sunat 
            $inicialOrigen = substr($venta["doc_origen"],0,1);

            if($inicialOrigen == 'B'){
                $tipoOrigen = '03';
            }else{
                $tipoOrigen = '01';
            }

            
            $emisor = 	array(
                'tipodoc'		=> '6',
                'ruc' 			=> '10472810371', 
                'razon_social'	=> 'JOEL VLADIMIR MEDRANO GÜERE', 
                'nombre_comercial'	=> 'JOEL VLADIMIR MEDRANO GÜERE', 
                'direccion'		=> 'CAL. GREGORIO SISA 133 - CARABAYLLO', 
                'pais'			=> 'PE', 
                'departamento'  => 'LIMA',//LIMA 
                'provincia'		=> 'LIMA',//LIMA 
                'distrito'		=> 'CARABAYLLO', //CARABAYLLO
                'ubigeo'		=> '150106', //CARABAYLLO
                'usuario_sol'	=> 'JOELABCD', //USUARIO SECUNDARIO EMISOR ELECTRONICO
                'clave_sol'		=> 'Unisty1' //CLAVE DE USUARIO SECUNDARIO EMISOR ELECTRONICO
                );
    
    

            $cliente = array(
                        'ruc'			=> $venta["dni"], 
                        'razon_social'  => $venta["nombre"], 
                        'cliente'       => $venta["cliente"],
                        'direccion'		=> $venta["direccion"],
                        'pais'			=> 'PE'
                        );	

            $vendedor = array(
                        "codigo"		=> $venta["vendedor"],
                        "nombre"		=> $venta["nom_vendedor"]
                        );

            $comprobante =	array(
                        'tipodoc'		=> '07', //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
                        'serie'			=> substr($venta["documento"],0,4),
                        'correlativo'	=> substr($venta["documento"],4,12),
                        'fecha_emision' => $venta["fecha_emision"],
                        'tipodoc_ref'   => $tipoOrigen,
                        'serie_ref'     => substr($venta["doc_origen"],0,4),
                        "correlativo_ref"=>substr($venta["doc_origen"],4,12),
                        'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
                        'total_opgravadas'=> 0, //OP. GRAVADAS
                        'total_opexoneradas'=>0,
                        'total_opinafectas'=>0,
                        'igv'			=> 0,
                        'total'			=> 0,
                        'total_texto'	=> ''
                    );



            $op_gravadas = 0;
            $op_inafectas = 0;
            $op_exoneradas = 0;

            $comprobante['total_opgravadas'] = ($venta["neto"]*-1);
            $comprobante['total_opexoneradas'] = $op_exoneradas;
            $comprobante['total_opinafectas'] = $op_inafectas;
            $comprobante['igv'] = ($venta["igv"]*-1);
            $comprobante['total'] = ($venta["total"]*-1);
            $comprobante['total_texto'] = CantidadEnLetra(($venta["total"]*-1));
            $totalSinIGV= ($venta["total"]*-1) - ($venta["igv"]*-1);

            //RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
            //01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
            $nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

            $ruta = "vistas/generar_xml/archivos_xml/".$nombrexml;

            $tipoCliente = $cliente["ruc"];

            //TIPO DE DOCUMENTO SI ES RUC O DNI
            if(strlen($tipoCliente) == 8){
                $tipodoc='1';
            }else{
                $tipodoc='6';
            }


            //TIPO DE MOTIVO SEGUN SUNAT
            if($venta["motivo"] == "C1"){

                $tipoMotivo = "01";

            }else if($venta["motivo"] == "C2"){

                $tipoMotivo = "02";

            }else if($venta["motivo"] == "C3"){

                $tipoMotivo = "03";

            }else if($venta["motivo"] == "C4"){

                $tipoMotivo = "04";

            }else if($venta["motivo"] == "C5"){

                $tipoMotivo = "05";

            }else if($venta["motivo"] == "C6"){

                $tipoMotivo = "06";

            }else if($venta["motivo"] == "C7"){

                $tipoMotivo = "07";

            }else if($venta["motivo"] == "C8"){

                $tipoMotivo = "08";

            }else if($venta["motivo"] == "C9"){

                $tipoMotivo = "09";

            }else{

                $tipoMotivo = "10";

            }

            if($comprobante["serie"] =="F002" || $comprobante["serie"] == "B002"){

                $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <CreditNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
                    <ext:UBLExtensions>
                        <ext:UBLExtension>
                        <ext:ExtensionContent />
                        </ext:UBLExtension>
                    </ext:UBLExtensions>
                    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
                    <cbc:CustomizationID>2.0</cbc:CustomizationID>
                    <cbc:ID>'.$comprobante['serie'].'-'.$comprobante['correlativo'].'</cbc:ID>
                    <cbc:IssueDate>'.$comprobante['fecha_emision'].'</cbc:IssueDate>
                    <cbc:IssueTime>00:00:01</cbc:IssueTime>
                    <cbc:Note languageLocaleID="1000"><![CDATA['.$comprobante['total_texto'].']]></cbc:Note>
                    <cbc:DocumentCurrencyCode>'.$comprobante['moneda'].'</cbc:DocumentCurrencyCode>
                    <cac:DiscrepancyResponse>
                        <cbc:ReferenceID>'.$comprobante['serie_ref'].'-'.$comprobante['correlativo_ref'].'</cbc:ReferenceID>
                        <cbc:ResponseCode>'.$tipoMotivo.'</cbc:ResponseCode>
                        <cbc:Description>'.ucfirst(strtolower($venta['nom_motivo'])).'</cbc:Description>
                    </cac:DiscrepancyResponse>
                    <cac:BillingReference>
                        <cac:InvoiceDocumentReference>
                        <cbc:ID>'.$comprobante['serie_ref'].'-'.$comprobante['correlativo_ref'].'</cbc:ID>
                        <cbc:DocumentTypeCode>'.$comprobante['tipodoc_ref'].'</cbc:DocumentTypeCode>
                        </cac:InvoiceDocumentReference>
                    </cac:BillingReference>
                    <cac:Signature>
                        <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                        <cbc:Note><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Note>
                        <cac:SignatoryParty>
                        <cac:PartyIdentification>
                            <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyName>
                            <cbc:Name><![CDATA['.$emisor['razon_social'].']]></cbc:Name>
                        </cac:PartyName>
                        </cac:SignatoryParty>
                        <cac:DigitalSignatureAttachment>
                        <cac:ExternalReference>
                            <cbc:URI>#SIGN-EMPRESA</cbc:URI>
                        </cac:ExternalReference>
                        </cac:DigitalSignatureAttachment>
                    </cac:Signature>
                    <cac:AccountingSupplierParty>
                        <cac:Party>
                        <cac:PartyIdentification>
                            <cbc:ID schemeID="'.$emisor['tipodoc'].'">'.$emisor['ruc'].'</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyName>
                            <cbc:Name><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Name>
                        </cac:PartyName>
                        <cac:PartyLegalEntity>
                            <cbc:RegistrationName><![CDATA['.$emisor['razon_social'].']]></cbc:RegistrationName>
                            <cac:RegistrationAddress>
                                <cbc:ID>'.$emisor['ubigeo'].'</cbc:ID>
                                <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                                <cbc:CitySubdivisionName>NONE</cbc:CitySubdivisionName>
                                <cbc:CityName>'.$emisor['provincia'].'</cbc:CityName>
                                <cbc:CountrySubentity>'.$emisor['departamento'].'</cbc:CountrySubentity>
                                <cbc:District>'.$emisor['distrito'].'</cbc:District>
                                <cac:AddressLine>
                                    <cbc:Line><![CDATA['.$emisor['direccion'].']]></cbc:Line>
                                </cac:AddressLine>
                                <cac:Country>
                                    <cbc:IdentificationCode>'.$emisor['pais'].'</cbc:IdentificationCode>
                                </cac:Country>
                            </cac:RegistrationAddress>
                        </cac:PartyLegalEntity>
                        </cac:Party>
                    </cac:AccountingSupplierParty>
                    <cac:AccountingCustomerParty>
                        <cac:Party>
                        <cac:PartyIdentification>
                            <cbc:ID schemeID="'.$tipodoc.'">'.$cliente['ruc'].'</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyLegalEntity>
                            <cbc:RegistrationName><![CDATA['.$cliente['razon_social'].']]></cbc:RegistrationName>
                            <cac:RegistrationAddress>
                                <cac:AddressLine>
                                    <cbc:Line><![CDATA['.$cliente['direccion'].']]></cbc:Line>
                                </cac:AddressLine>
                                <cac:Country>
                                    <cbc:IdentificationCode>'.$cliente['pais'].'</cbc:IdentificationCode>
                                </cac:Country>
                            </cac:RegistrationAddress>
                        </cac:PartyLegalEntity>
                        </cac:Party>
                    </cac:AccountingCustomerParty>
                    <cac:TaxTotal>
                        <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                        <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cac:TaxScheme>
                                <cbc:ID>1000</cbc:ID>
                                <cbc:Name>IGV</cbc:Name>
                                <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                        </cac:TaxSubtotal>
                    </cac:TaxTotal>
                    <cac:LegalMonetaryTotal>
                        <cbc:PayableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total'].'</cbc:PayableAmount>
                    </cac:LegalMonetaryTotal>
                    <cac:CreditNoteLine>
                        <cbc:ID>1</cbc:ID>
                        <cbc:Note>ZZ</cbc:Note>
                        <cbc:CreditedQuantity unitCode="ZZ" unitCodeListAgencyName="United Nations Economic Commission for Europe" unitCodeListID="UN/ECE rec 20">1</cbc:CreditedQuantity>
                        <cbc:LineExtensionAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:LineExtensionAmount>
                        <cac:BillingReference>
                            <cac:BillingReferenceLine>
                                <cbc:ID schemeID="AF">'.$comprobante["total"].'</cbc:ID>
                            </cac:BillingReferenceLine>
                        </cac:BillingReference>
                        <cac:PricingReference>
                            <cac:AlternativeConditionPrice>
                                <cbc:PriceAmount currencyID="PEN">'.$comprobante["total"].'</cbc:PriceAmount>
                                <cbc:PriceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Precio" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
                            </cac:AlternativeConditionPrice>
                        </cac:PricingReference>
                        <cac:TaxTotal>
                            <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                            <cac:TaxSubtotal>
                            <cbc:TaxableAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                            <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                            <cac:TaxCategory>
                                <cbc:Percent>18.00</cbc:Percent>
                                <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                                <cac:TaxScheme>
                                    <cbc:ID schemeAgencyName="PE:SUNAT" schemeName="Codigo de tributos" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">1000</cbc:ID>
                                    <cbc:Name>IGV</cbc:Name>
                                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                                </cac:TaxScheme>
                            </cac:TaxCategory>
                            </cac:TaxSubtotal>
                        </cac:TaxTotal>
                        <cac:Item>
                            <cbc:Description>'.$venta["observacion"].'</cbc:Description>
                        </cac:Item>
                        <cac:Price>
                            <cbc:PriceAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:PriceAmount>
                        </cac:Price>
                    </cac:CreditNoteLine>
                </CreditNote>';

            }else{
                $modelos = ControladorFacturacion::ctrMostrarModeloImpresion($documento,$tipo);

                $unidad= ControladorFacturacion::ctrMostrarUnidadesImpresion($documento,$tipo);

                $xml = '<?xml version="1.0" encoding="UTF-8"?>
                    <CreditNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
                        <ext:UBLExtensions>
                            <ext:UBLExtension>
                            <ext:ExtensionContent />
                            </ext:UBLExtension>
                        </ext:UBLExtensions>
                        <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
                        <cbc:CustomizationID>2.0</cbc:CustomizationID>
                        <cbc:ID>'.$comprobante['serie'].'-'.$comprobante['correlativo'].'</cbc:ID>
                        <cbc:IssueDate>'.$comprobante['fecha_emision'].'</cbc:IssueDate>
                        <cbc:IssueTime>00:00:01</cbc:IssueTime>
                        <cbc:Note languageLocaleID="1000"><![CDATA['.$comprobante['total_texto'].']]></cbc:Note>
                        <cbc:DocumentCurrencyCode>'.$comprobante['moneda'].'</cbc:DocumentCurrencyCode>
                        <cac:DiscrepancyResponse>
                            <cbc:ReferenceID>'.$comprobante['serie_ref'].'-'.$comprobante['correlativo_ref'].'</cbc:ReferenceID>
                            <cbc:ResponseCode>'.$tipoMotivo.'</cbc:ResponseCode>
                            <cbc:Description>'.ucfirst(strtolower($venta['nom_motivo'])).'</cbc:Description>
                        </cac:DiscrepancyResponse>
                        <cac:BillingReference>
                            <cac:InvoiceDocumentReference>
                            <cbc:ID>'.$comprobante['serie_ref'].'-'.$comprobante['correlativo_ref'].'</cbc:ID>
                            <cbc:DocumentTypeCode>'.$comprobante['tipodoc_ref'].'</cbc:DocumentTypeCode>
                            </cac:InvoiceDocumentReference>
                        </cac:BillingReference>
                        <cac:Signature>
                            <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                            <cbc:Note><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Note>
                            <cac:SignatoryParty>
                            <cac:PartyIdentification>
                                <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                            </cac:PartyIdentification>
                            <cac:PartyName>
                                <cbc:Name><![CDATA['.$emisor['razon_social'].']]></cbc:Name>
                            </cac:PartyName>
                            </cac:SignatoryParty>
                            <cac:DigitalSignatureAttachment>
                            <cac:ExternalReference>
                                <cbc:URI>#SIGN-EMPRESA</cbc:URI>
                            </cac:ExternalReference>
                            </cac:DigitalSignatureAttachment>
                        </cac:Signature>
                        <cac:AccountingSupplierParty>
                            <cac:Party>
                            <cac:PartyIdentification>
                                <cbc:ID schemeID="'.$emisor['tipodoc'].'">'.$emisor['ruc'].'</cbc:ID>
                            </cac:PartyIdentification>
                            <cac:PartyName>
                                <cbc:Name><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Name>
                            </cac:PartyName>
                            <cac:PartyLegalEntity>
                                <cbc:RegistrationName><![CDATA['.$emisor['razon_social'].']]></cbc:RegistrationName>
                                <cac:RegistrationAddress>
                                    <cbc:ID>'.$emisor['ubigeo'].'</cbc:ID>
                                    <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                                    <cbc:CitySubdivisionName>NONE</cbc:CitySubdivisionName>
                                    <cbc:CityName>'.$emisor['provincia'].'</cbc:CityName>
                                    <cbc:CountrySubentity>'.$emisor['departamento'].'</cbc:CountrySubentity>
                                    <cbc:District>'.$emisor['distrito'].'</cbc:District>
                                    <cac:AddressLine>
                                        <cbc:Line><![CDATA['.$emisor['direccion'].']]></cbc:Line>
                                    </cac:AddressLine>
                                    <cac:Country>
                                        <cbc:IdentificationCode>'.$emisor['pais'].'</cbc:IdentificationCode>
                                    </cac:Country>
                                </cac:RegistrationAddress>
                            </cac:PartyLegalEntity>
                            </cac:Party>
                        </cac:AccountingSupplierParty>
                        <cac:AccountingCustomerParty>
                            <cac:Party>
                            <cac:PartyIdentification>
                                <cbc:ID schemeID="'.$tipodoc.'">'.$cliente['ruc'].'</cbc:ID>
                            </cac:PartyIdentification>
                            <cac:PartyLegalEntity>
                                <cbc:RegistrationName><![CDATA['.$cliente['razon_social'].']]></cbc:RegistrationName>
                                <cac:RegistrationAddress>
                                    <cac:AddressLine>
                                        <cbc:Line><![CDATA['.$cliente['direccion'].']]></cbc:Line>
                                    </cac:AddressLine>
                                    <cac:Country>
                                        <cbc:IdentificationCode>'.$cliente['pais'].'</cbc:IdentificationCode>
                                    </cac:Country>
                                </cac:RegistrationAddress>
                            </cac:PartyLegalEntity>
                            </cac:Party>
                        </cac:AccountingCustomerParty>';
                        if($venta["dscto"] < 0){
                            $valor_dscto= $comprobante["total_opgravadas"] - ($venta["dscto"]*-1);
                            $xml.='<cac:AllowanceCharge>
                                <cbc:ChargeIndicator>false</cbc:ChargeIndicator>
                                <cbc:AllowanceChargeReasonCode listAgencyName="PE:SUNAT" listName="Cargo/descuento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo53">02</cbc:AllowanceChargeReasonCode> 
                                <cbc:Amount currencyID="PEN">'.($venta["dscto"]*-1).'</cbc:Amount>
                            </cac:AllowanceCharge>';
                        }else{
                            $valor_dscto= $comprobante["total_opgravadas"];
                        }
                    
                        $xml.='<cac:TaxTotal>
                            <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                            <cac:TaxSubtotal>
                            <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$valor_dscto.'</cbc:TaxableAmount>
                            <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                            <cac:TaxCategory>
                                <cac:TaxScheme>
                                    <cbc:ID>1000</cbc:ID>
                                    <cbc:Name>IGV</cbc:Name>
                                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                                </cac:TaxScheme>
                            </cac:TaxCategory>
                            </cac:TaxSubtotal>';

                            if($comprobante['total_opexoneradas']>0){
                            $xml.='<cac:TaxSubtotal>
                                <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total_opexoneradas'].'</cbc:TaxableAmount>
                                <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">0.00</cbc:TaxAmount>
                                <cac:TaxCategory>
                                    <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                                    <cac:TaxScheme>
                                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9997</cbc:ID>
                                        <cbc:Name>EXO</cbc:Name>
                                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                                    </cac:TaxScheme>
                                </cac:TaxCategory>
                            </cac:TaxSubtotal>';
                            }

                            if($comprobante['total_opinafectas']>0){
                            $xml.='<cac:TaxSubtotal>
                                <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total_opinafectas'].'</cbc:TaxableAmount>
                                <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">0.00</cbc:TaxAmount>
                                <cac:TaxCategory>
                                    <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                                    <cac:TaxScheme>
                                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9998</cbc:ID>
                                        <cbc:Name>INA</cbc:Name>
                                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                                    </cac:TaxScheme>
                                </cac:TaxCategory>
                            </cac:TaxSubtotal>';
                            }

                        $xml.='</cac:TaxTotal>
                        <cac:LegalMonetaryTotal>
                            <cbc:PayableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total'].'</cbc:PayableAmount>
                        </cac:LegalMonetaryTotal>';
                        
                        foreach($modelos as $k=>$v){
                            $igv = 0.18 * ($v["total"]*-1);
                            $totalIGV = ($v["total"]*-1)+$igv;
                            $precioIGV  = $totalIGV/($v["cantidad"]*-1);

                            $xml.='<cac:CreditNoteLine>
                            <cbc:ID>'.($k+1).'</cbc:ID>
                            <cbc:CreditedQuantity unitCode="'.$v['unidad'].'">'.number_format(($v['cantidad']*-1),3,".","").'</cbc:CreditedQuantity>
                            <cbc:LineExtensionAmount currencyID="'.$comprobante['moneda'].'">'.($v['total']*-1).'</cbc:LineExtensionAmount>
                            <cac:PricingReference>
                                <cac:AlternativeConditionPrice>
                                    <cbc:PriceAmount currencyID="'.$comprobante['moneda'].'">'.number_format($precioIGV,2,".","").'</cbc:PriceAmount>
                                    <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
                                </cac:AlternativeConditionPrice>
                            </cac:PricingReference>
                            <cac:TaxTotal>
                                <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                                <cac:TaxSubtotal>
                                    <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.($v['total']*-1).'</cbc:TaxableAmount>
                                    <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                                    <cac:TaxCategory>
                                        <cbc:Percent>18</cbc:Percent>
                                        <cbc:TaxExemptionReasonCode>10</cbc:TaxExemptionReasonCode>
                                        <cac:TaxScheme>
                                        <cbc:ID>1000</cbc:ID>
                                        <cbc:Name>IGV</cbc:Name>
                                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                                        </cac:TaxScheme>
                                    </cac:TaxCategory>
                                </cac:TaxSubtotal>
                            </cac:TaxTotal>
                            <cac:Item>
                                <cbc:Description><![CDATA['.$v['nombre'].']]></cbc:Description>
                                <cac:SellersItemIdentification>
                                    <cbc:ID>'.$v['modelo'].'</cbc:ID>
                                </cac:SellersItemIdentification>
                            </cac:Item>
                            <cac:Price>
                                <cbc:PriceAmount currencyID="'.$comprobante['moneda'].'">'.$v['precio'].'</cbc:PriceAmount>
                            </cac:Price>
                            </cac:CreditNoteLine>';
                        }
                        $xml.='</CreditNote>';
            } 

            

        

	    $doc->loadXML($xml);
	    $doc->save($ruta.'.XML');
        

        $actualizadoCreado = ModeloFacturacion::mdlActualizarProcesoFacturacion(1,$tipo,$documento);

        //CREAR XML FIRMA
        require_once('/../vistas/generar_xml/ApiFacturacion.php');

        $objApi = new ApiFacturacion();
        $envio = $objApi->EnviarComprobanteElectronico($emisor, $nombrexml);

        if($envio == "1"){
            echo "<script>  Command: toastr['success']('El XML FUE GENERADO EXITOSAMENTE')</script>";
            $actualizadoEnvio = ModeloFacturacion::mdlActualizarProcesoFacturacion(2,$tipo,$documento);

        }else{

            unlink($ruta.'.XML');
            unlink($ruta.'.ZIP');
        }          

        }

    }

    static public function ctrCrearNotaDebitoXML(){

        if(isset($_GET["tipoNotaDeb"]) && isset($_GET["documentoNotaDeb"])){

            $doc = new DOMDocument();
            $doc->formatOutput = FALSE;
            $doc->preserveWhiteSpace = TRUE;
            $doc->encoding = 'utf-8';

            require_once("/../extensiones/cantidad_en_letras.php");
            // require_once("/../vistas/generar_xml/signature.php"); // permite firmar xml

            $tipo = $_GET["tipoNotaDeb"];

            $documento = $_GET["documentoNotaDeb"];
            $venta = ControladorFacturacion::ctrMostrarDebitoImpresion($documento,$tipo);

            
     
            //prueba para mandar a sunat 
            $inicialOrigen = substr($venta["doc_origen"],0,1);

            if($inicialOrigen == 'B'){
                $tipoOrigen = '03';
            }else{
                $tipoOrigen = '01';
            }

            
            $emisor = 	array(
                'tipodoc'		=> '6',
                'ruc' 			=> '10472810371', 
                'razon_social'	=> 'JOEL VLADIMIR MEDRANO GÜERE', 
                'nombre_comercial'	=> 'JOEL VLADIMIR MEDRANO GÜERE', 
                'direccion'		=> 'CAL. GREGORIO SISA 133 - CARABAYLLO', 
                'pais'			=> 'PE', 
                'departamento'  => 'LIMA',//LIMA 
                'provincia'		=> 'LIMA',//LIMA 
                'distrito'		=> 'CARABAYLLO', //CARABAYLLO
                'ubigeo'		=> '150106', //CARABAYLLO
                'usuario_sol'	=> 'JOELABCD', //USUARIO SECUNDARIO EMISOR ELECTRONICO
                'clave_sol'		=> 'Unisty1' //CLAVE DE USUARIO SECUNDARIO EMISOR ELECTRONICO
                );
    
    

            $cliente = array(
                        'ruc'			=> $venta["dni"], 
                        'razon_social'  => $venta["nombre"], 
                        'cliente'       => $venta["cliente"],
                        'direccion'		=> $venta["direccion"],
                        'pais'			=> 'PE'
                        );	

            $vendedor = array(
                        "codigo"		=> $venta["vendedor"],
                        "nombre"		=> $venta["nom_vendedor"]
                        );

            $comprobante =	array(
                        'tipodoc'		=> '08', //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
                        'serie'			=> substr($venta["documento"],0,4),
                        'correlativo'	=> substr($venta["documento"],4,12),
                        'fecha_emision' => $venta["fecha_emision"],
                        'tipodoc_ref'   => $tipoOrigen,
                        'serie_ref'     => substr($venta["doc_origen"],0,4),
                        "correlativo_ref"=>substr($venta["doc_origen"],4,12),
                        'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
                        'total_opgravadas'=> 0, //OP. GRAVADAS
                        'total_opexoneradas'=>0,
                        'total_opinafectas'=>0,
                        'igv'			=> 0,
                        'total'			=> 0,
                        'total_texto'	=> ''
                    );



            $op_gravadas = 0;
            $op_inafectas = 0;
            $op_exoneradas = 0;

            $comprobante['total_opgravadas'] = $venta["neto"];
            $comprobante['total_opexoneradas'] = $op_exoneradas;
            $comprobante['total_opinafectas'] = $op_inafectas;
            $comprobante['igv'] = $venta["igv"];
            $comprobante['total'] = $venta["total"];
            $comprobante['total_texto'] = CantidadEnLetra($venta["total"]);
            $totalSinIGV= $venta["total"] - $venta["igv"];

            //RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
            //01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
            $nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

            $ruta = "vistas/generar_xml/archivos_xml/".$nombrexml;

            $tipoCliente = $cliente["ruc"];

            //TIPO DE DOCUMENTO SI ES RUC O DNI
            if(strlen($tipoCliente) == 8){
                $tipodoc='1';
            }else{
                $tipodoc='6';
            }


            //TIPO DE MOTIVO SEGUN SUNAT
            if($venta["motivo"] == "D1"){

                $tipoMotivo = "01";

            }else if($venta["motivo"] == "D2"){

                $tipoMotivo = "02";

            }else{

                $tipoMotivo = "03";

            }


            $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <DebitNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:DebitNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
                <ext:UBLExtensions>
                    <ext:UBLExtension>
                    <ext:ExtensionContent />
                    </ext:UBLExtension>
                </ext:UBLExtensions>
                <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
                <cbc:CustomizationID>2.0</cbc:CustomizationID>
                <cbc:ID>'.$comprobante['serie'].'-'.$comprobante['correlativo'].'</cbc:ID>
                <cbc:IssueDate>'.$comprobante['fecha_emision'].'</cbc:IssueDate>
                <cbc:IssueTime>00:00:01</cbc:IssueTime>
                <cbc:Note languageLocaleID="1000"><![CDATA['.$comprobante['total_texto'].']]></cbc:Note>
                <cbc:DocumentCurrencyCode>'.$comprobante['moneda'].'</cbc:DocumentCurrencyCode>
                <cac:DiscrepancyResponse>
                    <cbc:ReferenceID>'.$comprobante['serie_ref'].'-'.$comprobante['correlativo_ref'].'</cbc:ReferenceID>
                    <cbc:ResponseCode>'.$tipoMotivo.'</cbc:ResponseCode>
                    <cbc:Description>'.ucfirst(strtolower($venta['nom_motivo'])).'</cbc:Description>
                </cac:DiscrepancyResponse>
                <cac:BillingReference>
                    <cac:InvoiceDocumentReference>
                    <cbc:ID>'.$comprobante['serie_ref'].'-'.$comprobante['correlativo_ref'].'</cbc:ID>
                    <cbc:DocumentTypeCode>'.$comprobante['tipodoc_ref'].'</cbc:DocumentTypeCode>
                    </cac:InvoiceDocumentReference>
                </cac:BillingReference>
                <cac:Signature>
                    <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                    <cbc:Note><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Note>
                    <cac:SignatoryParty>
                    <cac:PartyIdentification>
                        <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name><![CDATA['.$emisor['razon_social'].']]></cbc:Name>
                    </cac:PartyName>
                    </cac:SignatoryParty>
                    <cac:DigitalSignatureAttachment>
                    <cac:ExternalReference>
                        <cbc:URI>#SIGN-EMPRESA</cbc:URI>
                    </cac:ExternalReference>
                    </cac:DigitalSignatureAttachment>
                </cac:Signature>
                <cac:AccountingSupplierParty>
                    <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeID="'.$emisor['tipodoc'].'">'.$emisor['ruc'].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name><![CDATA['.$emisor['nombre_comercial'].']]></cbc:Name>
                    </cac:PartyName>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA['.$emisor['razon_social'].']]></cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:ID>'.$emisor['ubigeo'].'</cbc:ID>
                            <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                            <cbc:CitySubdivisionName>NONE</cbc:CitySubdivisionName>
                            <cbc:CityName>'.$emisor['provincia'].'</cbc:CityName>
                            <cbc:CountrySubentity>'.$emisor['departamento'].'</cbc:CountrySubentity>
                            <cbc:District>'.$emisor['distrito'].'</cbc:District>
                            <cac:AddressLine>
                                <cbc:Line><![CDATA['.$emisor['direccion'].']]></cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode>'.$emisor['pais'].'</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                    </cac:Party>
                </cac:AccountingSupplierParty>
                <cac:AccountingCustomerParty>
                    <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeID="'.$tipodoc.'">'.$cliente['ruc'].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA['.$cliente['razon_social'].']]></cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cac:AddressLine>
                                <cbc:Line><![CDATA['.$cliente['direccion'].']]></cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode>'.$cliente['pais'].'</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                    </cac:Party>
                </cac:AccountingCustomerParty>
                <cac:TaxTotal>
                    <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                    <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cac:TaxScheme>
                            <cbc:ID>1000</cbc:ID>
                            <cbc:Name>IGV</cbc:Name>
                            <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                    </cac:TaxSubtotal>
                </cac:TaxTotal>
                <cac:RequestedMonetaryTotal>
                    <cbc:PayableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total'].'</cbc:PayableAmount>
                </cac:RequestedMonetaryTotal>
                <cac:DebitNoteLine>
                    <cbc:ID>1</cbc:ID>
                    <cbc:Note>ZZ</cbc:Note>
                    <cbc:DebitedQuantity unitCode="ZZ" unitCodeListAgencyName="United Nations Economic Commission for Europe" unitCodeListID="UN/ECE rec 20">1</cbc:DebitedQuantity>
                    <cbc:LineExtensionAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:LineExtensionAmount>
                    <cac:BillingReference>
                        <cac:BillingReferenceLine>
                            <cbc:ID schemeID="AF">'.$comprobante["total"].'</cbc:ID>
                        </cac:BillingReferenceLine>
                    </cac:BillingReference>
                    <cac:PricingReference>
                        <cac:AlternativeConditionPrice>
                            <cbc:PriceAmount currencyID="PEN">'.$comprobante["total"].'</cbc:PriceAmount>
                            <cbc:PriceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Precio" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
                        </cac:AlternativeConditionPrice>
                    </cac:PricingReference>
                    <cac:TaxTotal>
                        <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                        <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cbc:Percent>18.00</cbc:Percent>
                            <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                            <cac:TaxScheme>
                                <cbc:ID schemeAgencyName="PE:SUNAT" schemeName="Codigo de tributos" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">1000</cbc:ID>
                                <cbc:Name>IGV</cbc:Name>
                                <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                        </cac:TaxSubtotal>
                    </cac:TaxTotal>
                    <cac:Item>
                        <cbc:Description>'.$venta["observacion"].'</cbc:Description>
                    </cac:Item>
                    <cac:Price>
                        <cbc:PriceAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:PriceAmount>
                    </cac:Price>
                </cac:DebitNoteLine>
            </DebitNote>';

            
	    $doc->loadXML($xml);
	    $doc->save($ruta.'.XML');
        

        $actualizadoCreado = ModeloFacturacion::mdlActualizarProcesoFacturacion(1,$tipo,$documento);

        //CREAR XML FIRMA
        require_once('/../vistas/generar_xml/ApiFacturacion.php');

        $objApi = new ApiFacturacion();
        $envio = $objApi->EnviarComprobanteElectronico($emisor, $nombrexml);

        if($envio == "1"){
            echo "<script>  Command: toastr['success']('El XML FUE GENERADO EXITOSAMENTE')</script>";
            $actualizadoEnvio = ModeloFacturacion::mdlActualizarProcesoFacturacion(2,$tipo,$documento);

        }else{

            unlink($ruta.'.XML');
            unlink($ruta.'.ZIP');
        }          

        }

    }
    

}