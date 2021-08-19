<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Crear salidas

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear ingresos o salidas</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-7 col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <form role="form" metohd="post" class="formularioSalidaVarios">

                        <div class="box-body">

                            <div class="box">

                                <?php

                                    date_default_timezone_set('America/Lima');
                                    $ahora=date('Y/m/d h:i:s');

                                ?>

                                <!--=====================================
                                ENTRADA DEL RESPONSABLE
                                ======================================-->

                                <div class="form-group">
                                    

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                        <input type="text" class="form-control input-sm" id="nuevoResponsable" name="nuevoResponsable" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                                        <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                                        <input type="hidden" name="fechaActual" value="<?php echo $ahora; ?>">

                                        <input type="hidden" name="lista" id="lista">

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL CODIGO
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                        <?php

                                        $salida = $_GET["salida"];
                                        #var_dump("pedido", $pedido);

                                        echo '<input type="text" class="form-control input-sm" id="nuevoCodigo" name="nuevoCodigo" value="' . $salida . '" readonly>';

                                        ?>



                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL CLIENTE
                                ======================================-->
                                <div class="form-group">
                                    <div class='progress progress-striped'>
                                        <div id='progressBar1' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>0%</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                        <select class="form-control selectpicker" id="seleccionarCliente" name="seleccionarCliente" data-live-search="true"  required>

                                        <?php

                                        $valor = $_GET["salida"];

                                        $salida = ControladorSalidas::ctrMostrarTemporal($valor);
                                        //var_dump("pedido", $pedido);

                                        if ($salida["codigo"] != "") {

                                            $item = "codigo";
                                            $valor = $salida["cliente"];

                                            $clientes = ControladorClientes::ctrMostrarClientesP($item, $valor);
                                            //var_dump($clientes["nombreB"]);

                                            echo '<option value="'.$clientes["codigo"].'">'.$clientes["nombreB"].'</option>';

                                            $client2 = ControladorClientes::ctrMostrarClientesP(null, null);

                                            //var_dump($client2);

                                            foreach ($client2 as $key => $value) {

                                            echo '<option value="'.$value["codigo"].'">'.$value["nombreB"].'</option>';

                                            }

                                        } else {

                                            // $clientes = ControladorClientes::ctrMostrarClientesP(null, null);
                                            // var_dump($clientes);

                                            echo '<option value="">Seleccione Cliente</option>';
                                            // //var_dump($clientes);

                                            // foreach ($clientes as $key => $value) {

                                            //     echo '<option value="'.$value["codigo"].'">'.$value["nombreB"].'</option>';

                                            // }

                                        }


                                        ?>

                                        </select>


                                        <?php
                                            

                                            $valor = $_GET["salida"];

                                            if($valor == ""){
                                                echo "<button  type='button' class='btn btn-primary btnCargarCliente'> Cargar</button> ";
                                            }

                                            $salida = ControladorSalidas::ctrMostrarTemporal($valor);
                                            //var_dump("pedido", $pedido);

                                            if ($salida["codigo"] != "") {

                                                $item = "codigo";
                                                $valor = $salida["cliente"];

                                                $clientes = ControladorClientes::ctrMostrarClientesP($item, $valor);

                                                echo '<input type="hidden" class="form-control input-sm" id="codCliente" name="codCliente" value="' . $clientes["codigo"] . '" readonly>';

                                                echo '<input type="text" class="form-control input-sm" id="nomCliente" name="nomCliente" value="' . $clientes["nombre"] . '" readonly>';
                                            }

                                        ?>

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL VENDEDOR
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-shopping-cart"></i></span>

                                        <select class="form-control" id="seleccionarVendedor" name="seleccionarVendedor" required>

                                        <?php

                                        $valor = $_GET["salida"];

                                        $salida = ControladorSalidas::ctrMostrarTemporal($valor);
                                        //var_dump("pedido", $pedido["vendedor"]);

                                        if ($salida["vendedor"] != "") {

                                            $vendedor = ControladorVendedores::ctrMostrarVendedores("codigo", $salida["vendedor"]);
                                            //var_dump($vendedor);

                                            echo '<option value="'.$vendedor["codigo"].'">'.$vendedor["codigo"].' - '.$vendedor["descripcion"].'</option>';

                                            $vend2 = ControladorVendedores::ctrMostrarVendedores(null, null);

                                            //var_dump($vend2);

                                            foreach ($vend2 as $key => $value) {

                                            echo '<option value="'.$value["id"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                                            }

                                        } else {

                                            $vendedor = ControladorVendedores::ctrMostrarVendedores(null, null);

                                            echo '<option value="">Seleccione Vendedor</option>';
                                            //var_dump($vendedor);

                                            foreach ($vendedor as $key => $value) {

                                                echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                                            }

                                        }

                                        ?>

                                        </select>

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA LA LISTA DE PRECIOS
                                ======================================-->

                                    <?php

                                    $valor = $_GET["salida"];

                                    $salida = ControladorSalidas::ctrMostrarTemporal($valor);
                                    #var_dump("pedido", $pedido);

                                    if ($salida["codigo"] != "") {

                                        echo '<input type="hidden" class="form-control input-sm" id="seleccionarLista" name="seleccionarLista" value="' . $salida["lista"] . '" readonly>';
                                    } else {

                                        echo '<input type="hidden" class="form-control input-sm" id="seleccionarLista" name="seleccionarLista" value="' . $salida["lista"] . '" readonly>';
                                    }

                                    ?>

                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->

                                <div class="form-group row nuevoProductoPedido" style="height:500px; overflow: scroll;">

                                <p class="buscador" id="elid">
                                    <label>Buscar:</label>
                                    <input type="text" class="form-control input-sm" id="buscador" name="buscador">
                                </p>

                                <!--=====================================
                                        TITULOS
                                ======================================-->

                                <div class="box box-primary">

                                    <div class="row">

                                        <div class="col-xs-7">

                                            <label>Item</label>

                                        </div>

                                        <div class="col-xs-2">

                                            <label for="">Cantidad</label>

                                        </div>

                                        <div class="col-xs-3">

                                            <label for="">Total S/ IGV</label>

                                        </div>

                                    </div>

                                </div>

                                    <?php

                                    #tremos la lista de items
                                    $listaArtPed = ControladorSalidas::ctrMostrarDetallesTemporal($_GET["salida"]);
                                    // var_dump($listaArtPed);
                                    #var_dump("listaArtPed", $listaArtPed);

                                    foreach ($listaArtPed as $key => $value) {

                                        $infoArtPed = controladorArticulos::ctrMostrarArticulos($value["articulo"]);

                                        $total_detalle = $value["cantidad"] * $value["precio"];
                                        #var_dump("infoArtPed", $infoArtPed);

                                        echo '  <div class="row mundito" style="padding:5px 15px">

                                                <div class="col-xs-7" style="padding-right:0px">

                                                    <div class="input-group">

                                                        <span class="input-group-addon">

                                                            <button type="button" class="btn btn-danger btn-xs quitarArtPed" articulo="' . $infoArtPed["articulo"] . '"><i class="fa fa-times"></i></button>

                                                        </span>

                                                        <input type="text" class="form-control nuevaDescripcionArticulo input-sm" articulo="' . $infoArtPed["articulo"] . '" name="agregarProducto" value="' . $infoArtPed["packing"] . '" articuloP="' . $infoArtPed["articulo"] . '" readonly required>

                                                    </div>

                                                </div>

                                                <div class="col-xs-2">

                                                    <input type="number" class="form-control nuevaCantidadArtPed input-sm" name="nuevaCantidadArtPed" min="1" value="' . $value["cantidad"] . '" artPed="'.$infoArtPed["pedidos"].'" nuevoArtPed="0" required>

                                                </div>

                                                <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                                        <input type="text" class="form-control nuevoPrecioArticulo" precioReal="' . $value["precio"] . '" name="nuevoPrecioArticulo" value="' . $total_detalle . '" readonly required>

                                                    </div>

                                                </div>

                                            </div>';
                                    }

                                    ?>

                                </div>

                                <input type="hidden" id="listaProductosPedidos" name="listaProductosPedidos">

                                <hr>

                                <div class="row">

                                    <!--=====================================
                                    SUB TOTALES Y TOTALES
                                    ======================================-->

                                    <div class="form-group row">

                                        <!--=====================================
                                        TOTAL BRUTO
                                        ======================================-->

                                        <div class="form-group">

                                            <div class="col-xs-4">
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="input-group pull-right">

                                                <span class="form-control"><b>Op. Gravadas S/</b></span>

                                                </div>
                                            </div>

                                            <div class="col-xs-2">

                                                <input type="hidden">

                                            </div>

                                            <div class="col-xs-3">

                                                <div class="input-group">

                                                <?php

                                                    $valor = $_GET["salida"];

                                                    $totalArt = ControladorSalidas::ctrMostrarTemporalTotal($valor);

                                                    //var_dump($totalArt["totalArt"]);

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="nuevoSubTotalA" name="nuevoSubTotalA" value="'.number_format($totalArt["totalArt"],2).'" readonly required>';

                                                    echo '<input type="hidden" id="nuevoSubTotal" name="nuevoSubTotal" value="'.$totalArt["totalArt"].'">';

                                                ?>



                                                </div>

                                            </div>
                                        </div>

                                        <!--=====================================
                                        DESCUENTOS
                                        ======================================-->

                                        <div class="form-group">

                                            <div class="col-xs-4">
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="input-group pull-right">

                                                <span class="form-control"><b>Descuento %</b></span>

                                                </div>
                                            </div>

                                            <div class="col-xs-2">

                                                <?php

                                                $valor = $_GET["salida"];

                                                $descuento = ControladorSalidas::ctrMostrarTemporal($valor);
                                                //var_dump($descuento["descuento_total"]);

                                                if($descuento == false){

                                                    //var_dump("hola 0");

                                                    echo '<input type="number" step="any" class="form-control" min="0" id="descPer" name="descPer" value="0">';

                                                }else if($descuento["descuento_total"] == "0"){

                                                    //var_dump("hola 1");

                                                    echo '<input type="number" step="any" class="form-control" min="0" id="descPer" name="descPer" value="0">';

                                                }else{

                                                    //var_dump("hola 2");

                                                    $subD= $descuento["op_gravada"];
                                                    $descD= $descuento["descuento_total"];

                                                    $descN = $descD / $subD * 100;

                                                    //var_dump(round($descN,2));

                                                    echo '<input type="number" step="any" class="form-control" min="0" id="descPer" name="descPer" value="'.round($descN,2).'">';

                                                }

                                                ?>


                                            </div>

                                            <div class="col-xs-3">

                                                <div class="input-group">

                                                <?php

                                                $valor = $_GET["salida"];

                                                $descuento = ControladorSalidas::ctrMostrarTemporal($valor);
                                                //var_dump($descuento["descuento_total"]);

                                                if($descuento == false){

                                                    //var_dump("hola 0");

                                                    echo '<input type="text" style="text-align:right;" min="0" class="form-control" id="descTotal" name="descTotal" placeholder="0.00" readonly>';

                                                }else if($descuento["descuento_total"] == "0"){

                                                    //var_dump("hola 1");

                                                    echo '<input type="text" style="text-align:right;" min="0" class="form-control" id="descTotal" name="descTotal" placeholder="0.00" readonly>';

                                                }else{

                                                    $decuentoR = round($descuento["descuento_total"],2);

                                                    echo '<input type="text" style="text-align:right;" min="0" class="form-control" id="descTotal" name="descTotal" placeholder="0.00" value="'.$decuentoR.'" readonly>';

                                                }

                                                ?>


                                                </div>

                                            </div>
                                        </div>

                                        <!--=====================================
                                        SUB TOTAL
                                        ======================================-->

                                        <div class="form-group">

                                            <div class="col-xs-4">
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="input-group pull-right">

                                                <span class="form-control"><b>Sub Total S/</b></span>

                                                </div>
                                            </div>

                                            <div class="col-xs-2">

                                                <input type="hidden">

                                            </div>

                                            <div class="col-xs-3">

                                                <div class="input-group">

                                                <?php

                                                $valor = $_GET["salida"];

                                                $subTotalA = ControladorSalidas::ctrMostrarTemporal($valor);
                                                //var_dump($subTotalA["sub_total"]);

                                                if($subTotalA == false){

                                                    //var_dump("hola 0");

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="subTotal" name="subTotal" value="0" readonly>';

                                                }else if($subTotalA["descuento_total"] == "0"){

                                                    //var_dump("hola 1");

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="subTotal" name="subTotal" value="0" readonly>';

                                                }else{

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="subTotal" name="subTotal" value="'.$subTotalA["sub_total"].'" readonly>';

                                                }

                                                ?>

                                                </div>

                                            </div>
                                        </div>

                                        <!--=====================================
                                        IMPUESTO
                                        ======================================-->

                                        <div class="form-group">

                                            <div class="col-xs-4">
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="input-group pull-right">

                                                <span class="form-control"><b>IGV %</b></span>

                                                </div>
                                            </div>

                                            <div class="col-xs-2">

                                                <input type="number" step="any" class="form-control" min="1" id="impPer" name="impPer" value="18" readonly>

                                            </div>

                                            <div class="col-xs-3">

                                                <div class="input-group">

                                                <?php

                                                $valor = $_GET["salida"];

                                                $igvA = ControladorSalidas::ctrMostrarTemporal($valor);
                                                //var_dump($igvA["sub_total"]);

                                                if($igvA == false){

                                                    //var_dump("hola 0");

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="impTotal" name="impTotal" value="0" readonly>';

                                                }else if($igvA["descuento_total"] == "0"){

                                                    //var_dump("hola 1");

                                                    $neto = $totalArt["totalArt"] * 0.18;

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="impTotal" name="impTotal" value="'.round($neto,2).'" readonly>';

                                                }else{

                                                    //var_dump("hola 2");

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="impTotal" name="impTotal" value="'.$igvA["igv"].'" readonly>';

                                                }

                                                ?>

                                                </div>

                                            </div>
                                        </div>

                                        <!--=====================================
                                        TOTAL
                                        ======================================-->

                                        <div class="form-group">

                                            <div class="col-xs-4">
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="input-group pull-right">

                                                <span class="form-control"><b>Total S/</b></span>

                                                </div>
                                            </div>

                                            <div class="col-xs-2">

                                                <input type="hidden">

                                            </div>

                                            <div class="col-xs-3">

                                                <div class="input-group">

                                                <?php

                                                $valor = $_GET["salida"];

                                                $totalA = ControladorSalidas::ctrMostrarTemporal($valor);
                                                //var_dump($totalA["descuento_total"]);

                                                if($totalA == false){

                                                    //var_dump("hola 0");

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="nuevoTotal" name="nuevoTotal" value="0" readonly>';

                                                }else if($totalA["descuento_total"] == "0"){

                                                    //var_dump("hola 1");

                                                    $neto = $totalArt["totalArt"] * 1.18;

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="nuevoTotal" name="nuevoTotal" value="'.round($neto,2).'" readonly>';

                                                }else{

                                                    //var_dump("hola 2");

                                                    echo '<input type="text" style="text-align:right;" min="1" class="form-control" id="nuevoTotal" name="nuevoTotal" value="'.$totalA["total"].'" readonly>';

                                                }

                                                ?>

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <br>

                            </div>

                        </div>

                        <div class="box-header with-border">

                            <button onclick="history.back()" type="button" class="btn btn-danger pull-left">Cancelar
                            </button>

                        <?php

                            $valor = $_GET["salida"];

                            $salida = ControladorSalidas::ctrMostrarTemporal($valor);

                            if($salida["estado"] == "GENERADO"){

                                //var_dump("hola 1");

                                echo '<button type="button" class="btn btn-primary pull-right crearSalidaVarios" id="modalito" name="modalito" data-toggle="modal" data-target="#modalGenerarSalida">Crear Salida
                                </button>';

                            }else{

                                //var_dump("hola 2");

                                echo '<button type="button" class="btn btn-primary pull-right crearSalidaVarios" id="modalito" name="modalito" data-toggle="modal" data-target="#modalGenerarSalida" >Crear Salida
                                </button>';

                            }

                        ?>


                        </div>

                    </form>

                </div>

            </div>

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->

            <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

                <div class="box box-warning">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablaArticulosSalidas" width="100%">

                            <thead>

                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Modelo</th>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>Talla</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>


            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL MODIFICAR ARTICULOS
======================================-->

<div id="modalModificarClienteP" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 60% !important;">

        <div class="modal-content">

            <form role="form" method="post" class="formularioPedido">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Detalle Artículos</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <div class="box box-primary">

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="modeloModalA" name="modeloModalA" readonly>

                                </div>

                            </div>

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                    <input type="text" class="form-control input-sm" id="precioA" name="precioA">

                                </div>

                            </div>

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="clienteA" name="clienteA" placeholder="Tiene que escoger el Cliente" required>

                                </div>

                            </div>

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="vendedorA" name="vendedorA" placeholder="Tiene que escoger el Vendedor" required>

                                    <input type="hidden" class="form-control input-sm" id="nLista" name="nLista" readonly>

                                    <input type="hidden" class="form-control input-sm" id="usuario" name="usuario" value="<?php echo $_SESSION["id"]; ?>">

                                </div>

                            </div>


                            <?php

                            $salida = $_GET["salida"];

                            echo '<input type="hidden" class="form-control input-sm" id="salida" name="salida" value="' . $salida . '" readonly>';


                            ?>


                        </div>

                        <div class="box box-warning col-lg-12">

                            <!-- TABLA DE DETALLES -->

                            <label>TABLA DETALLES</label>

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive tablaColTal" width="100%">

                                    <thead>

                                        <tr>
                                            <th style="width:50px"></th>
                                            <th style="width:200px"></th>
                                            <th style="width:100px">S</th>
                                            <th style="width:100px">M</th>
                                            <th style="width:100px">L</th>
                                            <th style="width:100px">XL</th>
                                            <th style="width:100px">XXL</th>
                                            <th style="width:100px">XS</th>
                                            <th style="width:100px"></th>
                                            <th style="width:100px"></th>
                                        </tr>

                                        <tr>
                                            <th style="width:50px"></th>
                                            <th style="width:200px"></th>
                                            <th style="width:100px">28</th>
                                            <th style="width:100px">30</th>
                                            <th style="width:100px">32</th>
                                            <th style="width:100px">34</th>
                                            <th style="width:100px">36</th>
                                            <th style="width:100px">38</th>
                                            <th style="width:100px">40</th>
                                            <th style="width:100px">42</th>
                                        </tr>

                                        <tr>
                                            <th style="width:50px">Modelo</th>
                                            <th style="width:200px">Color</th>
                                            <th style="width:100px">3</th>
                                            <th style="width:100px">4</th>
                                            <th style="width:100px">6</th>
                                            <th style="width:100px">8</th>
                                            <th style="width:100px">10</th>
                                            <th style="width:100px">12</th>
                                            <th style="width:100px">14</th>
                                            <th style="width:100px">16</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <tr class="detalleCT">

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>




                    </div>

                </div>

                <div class="box box-success">

                    <div class="form-group col-lg-4">

                        <label> Total Unidades</label>

                        <div class="input-group">

                            <input type="text" name="totalCantidadA" id="totalCantidadA" readonly>


                        </div>

                    </div>

                    <div class="form-group col-lg-4">

                        <label> Total Soles</label>

                        <div class="input-group">

                            <input type="text" name="totalSolesA" id="totalSolesA" readonly>


                        </div>


                    </div>

                    <div class="form-group col-lg-4">

                        <label></label>

                        <div class="input-group">

                            <button type="button" class="btn btn-success pull-left btnCalCantA">Calcular</button>

                        </div>


                    </div>

                </div>


                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar Modelo</button>

                </div>



            </form>

            <?php

            $crearSalida = new ControladorSalidas();
            $crearSalida->ctrCrearSalida();

            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL PARA GENERAR EL PEDIDO
======================================-->

<div id="modalGenerarSalida" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

            <div class="modal-header" style="background:#008080; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Resumen de Salida</h4>

            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <div class="box-body">

                <!-- ENTRADA PARA EL CODIGO -->

                <div class="form-group">

                    <label>Código de Salida</label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-certificate"></i></span>

                        <input type="text" class="form-control input-sm" name="codigoM" id="codigoM" required readonly>

                    </div>

                </div>

                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group">

                    <label>Cliente</label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control input-sm" name="codClienteM" id="codClienteM" required readonly>

                        <input type="text" class="form-control input-sm" name="nomClienteM" id="nomClienteM" required readonly>

                    </div>

                </div>


                <!-- ENTRADA PARA EL VENDEDOR-->

                <div class="form-group">

                    <label>Vendedor</label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-child"></i></span>

                        <input type="text" class="form-control input-sm" name="vendedorM" id="vendedorM" required readonly>

                    </div>

                </div>

                <div class="form-group col-lg-12 pull-right">

                    <div>

                        <h3>
                            <label>Totales</label>
                        </h3>

                    </div>

                </div>

                <!-- ENTRADA PARA LOS TOTALES-->

                <div class="form-group col-lg-7 pull-right">

                    <div class="input-group">

                        <span class="input-group-addon" style="width: 150px;">Op. Gravada <b>S/</b></span>

                        <input type="text" class="form-control input-lg" style="text-align:right;" name="opGravadaM" id="opGravadaM" required readonly>

                    </div>

                </div>

                <div class="form-group col-lg-7 pull-right">

                    <div class="input-group">

                        <span class="input-group-addon" style="width: 150px;">Descuento <b>S/</b></span>

                        <input type="text" class="form-control input-lg" style="text-align:right;" name="descuentoM" id="descuentoM" required readonly>

                    </div>

                </div>

                <div class="form-group col-lg-7 pull-right">

                    <div class="input-group">

                        <span class="input-group-addon" style="width: 150px;">Subtotal <b>S/</b></span>

                        <input type="text" class="form-control input-lg" style="text-align:right;" name="subTotalM" id="subTotalM" required readonly>

                    </div>

                </div>

                <div class="form-group col-lg-7 pull-right">

                    <div class="input-group">

                        <span class="input-group-addon" style="width: 150px;">Igv <b>18%</b></span>

                        <input type="text" class="form-control input-lg" style="text-align:right;" name="igvM" id="igvM" required readonly>

                    </div>

                </div>

                <div class="form-group col-lg-7 pull-right">

                    <div class="input-group">

                        <span class="input-group-addon" style="width: 150px;">Total <b>S/</b></span>

                        <input type="text" class="form-control input-lg" style="text-align:right;" name="totalM" id="totalM" required readonly>

                    </div>

                </div>

                <div class="form-group col-lg-7 pull-right">

                    <div class="input-group">

                        <input type="hidden" class="form-control input-lg" style="text-align:right;" name="articulosM" id="articulosM" required readonly>

                    </div>

                </div>


                <div class="form-group col-lg-7 pull-right">

                    <div class="input-group">

                    <input type="hidden" class="form-control input-sm" name="usuarioM" id="usuarioM">

                    </div>

                </div>

                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Crear Salida</button>

            </div>

        </form>


      <?php

        $totalesSalida = new ControladorSalidas();
        $totalesSalida -> ctrCrearSalidasTotales();

      ?>


    </div>

  </div>

</div>

<script>
window.document.title = "Crear salida varios"
</script>

<script>
$('.nuevoProductoPedido').ready(function(){
    $('#buscador').keyup(function(){

    //console.log("hola mundo")

    var nombres = $('.nuevaDescripcionArticulo');
    //console.log(nombres.val())
    //console.log(nombres.length())

    var buscando = $(this).val();
    //console.log(buscando.length);

    var item='';

       for( var i = 0; i < nombres.length; i++ ){

        item = $(nombres[i]).val().toLowerCase();
        console.log(item);

            for(var x = 0; x < item.length; x++ ){

                if( buscando.length == 0 || item.indexOf( buscando ) > -1 ){

                    $(nombres[i]).parents('.mundito').show(); 

                }else{

                    $(nombres[i]).parents('.mundito').hide();

                }
            }
       }
    });
  });

</script>