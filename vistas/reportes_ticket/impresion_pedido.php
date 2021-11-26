<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v2.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

    require_once "../../controladores/pedidos.controlador.php";
    require_once "../../modelos/pedidos.modelo.php";

    /* 
    * TRAEMOS LOS DATOS DEL PEDIDO
    */
    $codigo = $_GET["codigo"];
    //var_dump($codigo);

    $respuesta = ControladorPedidos::ctrPedidoImpresionCab($codigo);
    //var_dump($respuesta["pedido"]);
    //var_dump($respuesta);

    $totales = ControladorPedidos::ctrPedidoImpresionTotales($codigo);
    //var_dump($totales);

    $pedidos = controladorPedidos::ctrMostraPedidosCabecera($codigo);

    date_default_timezone_set("America/Lima");

    //var_dump($respuesta["fecha"]);

    $originalDate = $respuesta["fecha"];
    $newDate = date("d/m/Y", strtotime($originalDate));
    //var_dump($newDate);

    //*Construir hojas
    $ini = 0;
    $fin = 1000;

    $articulos = ControladorPedidos::ctrPedidoImpresionB($codigo, $ini, $fin);
    $cantidadArticulos = count($articulos);
    //var_dump(count($articulos));

  ?>
    <div class="zona_impresion">

        <?php

            //todo: 1 PAGINA
            if($cantidadArticulos <=50){

                //*Cabecera GLOBAL
                echo' <table border="0" align="left" width="900px">

                        <thead>
                    
                            <tr>
                        
                                <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">Nro. PEDIDO</th>
                                <td style="width:20%">'.$respuesta["pedido"].'</td>
                                <th colspan="6"></th>
                                <th style="width:6%;text-align:left;">FECHA</th>
                                <td colspan="2">'.$newDate.'</td>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">CLIENTE:</th>
                                <td colspan="4">'.$respuesta["nombre"].'</td>
                                <th colspan="2"></th>
                                <th style="width:6%">Cod:</th>
                                <td colspan="2">'.$respuesta["codigo"].'</td>
                                <th style="width:6%"></th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                                <td colspan="10">'.$respuesta["direccion"].'</td>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%"></th>
                                <td colspan="6">'.$respuesta["nom_ubi"].'</td>
                                <th style="width:10%;text-align:left;" colspan="2">'.$respuesta["ubigeo"].'</th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">VENDEDOR</th>
                                <td style="width:20%">'.$respuesta["vendedor"].'</td>
                                <th style="width:6%;text-align:left;">'.$respuesta["tipo_doc"].'</th>
                                <td colspan="2">'.$respuesta["documento"].'</td>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%"></th>
                                <th style="width:20%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                        
                            </tr>
                    
                        </thead>
                    
                </table>';

                //*Cabecera PEDIDO
                echo '<table border="1" align="left" width="900px">

                    <thead>
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">S</th>
                        <th style="width:6%">M</th>
                        <th style="width:6%">L</th>
                        <th style="width:6%">XL</th>
                        <th style="width:6%">XXL</th>
                        <th style="width:6%">XS</th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">28</th>
                        <th style="width:6%">30</th>
                        <th style="width:6%">32</th>
                        <th style="width:6%">34</th>
                        <th style="width:6%">36</th>
                        <th style="width:6%">38</th>
                        <th style="width:6%">40</th>
                        <th style="width:6%">42</th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%;text-align:left;">Modelo</th>
                        <th style="width:20%">Color</th>
                        <th style="width:6%">3</th>
                        <th style="width:6%">4</th>
                        <th style="width:6%">6</th>
                        <th style="width:6%">8</th>
                        <th style="width:6%">10</th>
                        <th style="width:6%">12</th>
                        <th style="width:6%">14</th>
                        <th style="width:6%">16</th>
                        <th style="width:6%">TOTAL</th>
                    </tr>
                    </thead>
            
                </table>';
                
                //*Cuerpo
                echo '<table border="1" style="border:dashed" align="left" width="900px">';

                    foreach($articulos as $key => $value){

                        if($value["t1"] <= 0){

                            $value["t1"] = " ";
                
                        }else{
                
                            $value["t1"];
                
                        }
                
                        if($value["t2"] <= 0){
                
                            $value["t2"] = " ";
                
                        }else{
                
                            $value["t2"];
                
                        }
                
                        if($value["t3"] <= 0){
                
                            $value["t3"] = " ";
                
                        }else{
                
                            $value["t3"];
                
                        }
                
                        if($value["t4"] <= 0){
                
                            $value["t4"] = " ";
                
                        }else{
                
                            $value["t4"];
                
                        }
                
                        if($value["t5"] <= 0){
                
                            $value["t5"] = " ";
                
                        }else{
                
                            $value["t5"];
                
                        }
                
                        if($value["t6"] <= 0){
                
                            $value["t6"] = " ";
                
                        }else{
                
                            $value["t6"];
                
                        }
                
                        if($value["t7"] <= 0){
                
                            $value["t7"] = " ";
                
                        }else{
                
                            $value["t7"];
                
                        }
                
                        if($value["t8"] <= 0){
                
                            $value["t8"] = " ";
                
                        }else{
                
                            $value["t8"];
                
                        }
                        
                        if($value["cod_color"] == "99"){

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">=====</th>
                                <th style="width:20%;text-align:left;">====================</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%">===</th>
                            </tr>';                          


                        }else{

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">'.$value["modelo"].'</th>
                                <th style="width:20%;text-align:left;">'.$value["color"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t1"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t2"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t3"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t4"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t5"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t6"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t7"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t8"].'</th>
                                <th style="width:6%">'.$value["total"].'</th>
                            </tr>'; 
                        }
                    
    

                    }

                echo '</table';     
                
                //*Total unidades
                echo '<table border="1" align="left" width="900px">

                    </thead>                
                        <tr>               
                            <th style="width:10%;text-align:left;">TOTALES</th>
                            <th style="width:20%;text-align:left;">PEDIDO</th>
                            <th style="width:6%">'.$totales["t1"].'</th>
                            <th style="width:6%">'.$totales["t2"].'</th>
                            <th style="width:6%">'.$totales["t3"].'</th>
                            <th style="width:6%">'.$totales["t4"].'</th>
                            <th style="width:6%">'.$totales["t5"].'</th>
                            <th style="width:6%">'.$totales["t6"].'</th>
                            <th style="width:6%">'.$totales["t7"].'</th>
                            <th style="width:6%">'.$totales["t8"].'</th>
                            <th style="width:6%">'.$totales["total"].'</th>                
                        </tr>                
                    </thead>
            
                </table>';                

                //*Detalle fin de pedido
                echo '<table border="0" align="left" width="900px">

                        </thead>
                    
                        <tr>                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>                    
                        </tr>
                    
                        <tr>                    
                            <td style="width:10%;text-align:left;">TOTAL S/</td>
                            <th style="width:20%;text-align:left;">'.$pedidos["total"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                        </tr>
                    
                        <tr>                    
                            <td style="width:10%;text-align:left;">Forma de Pago</td>
                            <th colspan="7" style="width:20%;text-align:left;">'.$pedidos["descripcion"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>               
                        </tr>
                    
                        </thead>
            
                </table>';           

            }
            //todo: 2 PAGINAS
            else if($cantidadArticulos > 50 && $cantidadArticulos <= 100){
                    
                //*Cabecera GLOBAL PAG 1
                echo '<table border="0" align="left" width="900px">

                    <thead>
                
                        <tr>
                    
                            <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">Nro. PEDIDO</th>
                            <td style="width:20%">'.$respuesta["pedido"].'</td>
                            <th colspan="6"></th>
                            <th style="width:6%;text-align:left;">FECHA</th>
                            <td colspan="2">'.$newDate.'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">CLIENTE:</th>
                            <td colspan="4">'.$respuesta["nombre"].'</td>
                            <th colspan="2"></th>
                            <th style="width:6%">Cod:</th>
                            <td colspan="2">'.$respuesta["codigo"].'</td>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                            <td colspan="10">'.$respuesta["direccion"].'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <td colspan="6">'.$respuesta["nom_ubi"].'</td>
                            <th style="width:10%;text-align:left;" colspan="2">'.$respuesta["ubigeo"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">VENDEDOR</th>
                            <td style="width:20%">'.$respuesta["vendedor"].'</td>
                            <th style="width:6%;text-align:left;">'.$respuesta["tipo_doc"].'</th>
                            <td colspan="2">'.$respuesta["documento"].'</td>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                
                    </thead>
                
                </table>';

                //*Cabecera PEDIDO PAG 1
                echo '<table border="1" align="left" width="900px">

                    <thead>
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">S</th>
                        <th style="width:6%">M</th>
                        <th style="width:6%">L</th>
                        <th style="width:6%">XL</th>
                        <th style="width:6%">XXL</th>
                        <th style="width:6%">XS</th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">28</th>
                        <th style="width:6%">30</th>
                        <th style="width:6%">32</th>
                        <th style="width:6%">34</th>
                        <th style="width:6%">36</th>
                        <th style="width:6%">38</th>
                        <th style="width:6%">40</th>
                        <th style="width:6%">42</th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%;text-align:left;">Modelo</th>
                        <th style="width:20%">Color</th>
                        <th style="width:6%">3</th>
                        <th style="width:6%">4</th>
                        <th style="width:6%">6</th>
                        <th style="width:6%">8</th>
                        <th style="width:6%">10</th>
                        <th style="width:6%">12</th>
                        <th style="width:6%">14</th>
                        <th style="width:6%">16</th>
                        <th style="width:6%">TOTAL</th>
                    </tr>
                    </thead>
            
                </table>';

                //*Cuerpo PAG 1
                echo '<table border="1" style="border:dashed" align="left" width="900px">';

                    $articulosP1 = ControladorPedidos::ctrPedidoImpresionB($codigo, 0, 50);

                    foreach($articulosP1 as $key => $value){

                        if($value["t1"] <= 0){

                            $value["t1"] = " ";
                
                        }else{
                
                            $value["t1"];
                
                        }
                
                        if($value["t2"] <= 0){
                
                            $value["t2"] = " ";
                
                        }else{
                
                            $value["t2"];
                
                        }
                
                        if($value["t3"] <= 0){
                
                            $value["t3"] = " ";
                
                        }else{
                
                            $value["t3"];
                
                        }
                
                        if($value["t4"] <= 0){
                
                            $value["t4"] = " ";
                
                        }else{
                
                            $value["t4"];
                
                        }
                
                        if($value["t5"] <= 0){
                
                            $value["t5"] = " ";
                
                        }else{
                
                            $value["t5"];
                
                        }
                
                        if($value["t6"] <= 0){
                
                            $value["t6"] = " ";
                
                        }else{
                
                            $value["t6"];
                
                        }
                
                        if($value["t7"] <= 0){
                
                            $value["t7"] = " ";
                
                        }else{
                
                            $value["t7"];
                
                        }
                
                        if($value["t8"] <= 0){
                
                            $value["t8"] = " ";
                
                        }else{
                
                            $value["t8"];
                
                        }
                        
                        if($value["cod_color"] == "99"){

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">=====</th>
                                <th style="width:20%;text-align:left;">====================</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%">===</th>
                            </tr>';                          


                        }else{

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">'.$value["modelo"].'</th>
                                <th style="width:20%;text-align:left;">'.$value["color"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t1"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t2"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t3"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t4"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t5"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t6"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t7"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t8"].'</th>
                                <th style="width:6%">'.$value["total"].'</th>
                            </tr>'; 
                        }
                    
    

                    }

                echo '</table';
                
                //*RELLENO PAG 1                    
                for ($i=0; $i < 25; $i++) { 
                    echo '<table border="0" align="left" width="900px">
                        <tr>
                            <td></td>
                        </tr>
                    </table>';
                }

                //*Cabecera GLOBAL PAG 2
                echo '<table border="0" align="left" width="900px">

                    <thead>
                
                        <tr>
                    
                            <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">Nro. PEDIDO</th>
                            <td style="width:20%">'.$respuesta["pedido"].'</td>
                            <th colspan="6"></th>
                            <th style="width:6%;text-align:left;">FECHA</th>
                            <td colspan="2">'.$newDate.'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">CLIENTE:</th>
                            <td colspan="4">'.$respuesta["nombre"].'</td>
                            <th colspan="2"></th>
                            <th style="width:6%">Cod:</th>
                            <td colspan="2">'.$respuesta["codigo"].'</td>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                            <td colspan="10">'.$respuesta["direccion"].'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <td colspan="6">'.$respuesta["nom_ubi"].'</td>
                            <th style="width:10%;text-align:left;" colspan="2">'.$respuesta["ubigeo"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">VENDEDOR</th>
                            <td style="width:20%">'.$respuesta["vendedor"].'</td>
                            <th style="width:6%;text-align:left;">'.$respuesta["tipo_doc"].'</th>
                            <td colspan="2">'.$respuesta["documento"].'</td>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                
                    </thead>
                
                </table>';

                //*Cabecera PEDIDO PAG 2
                echo '<table border="1" align="left" width="900px">

                    <thead>
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">S</th>
                        <th style="width:6%">M</th>
                        <th style="width:6%">L</th>
                        <th style="width:6%">XL</th>
                        <th style="width:6%">XXL</th>
                        <th style="width:6%">XS</th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">28</th>
                        <th style="width:6%">30</th>
                        <th style="width:6%">32</th>
                        <th style="width:6%">34</th>
                        <th style="width:6%">36</th>
                        <th style="width:6%">38</th>
                        <th style="width:6%">40</th>
                        <th style="width:6%">42</th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%;text-align:left;">Modelo</th>
                        <th style="width:20%">Color</th>
                        <th style="width:6%">3</th>
                        <th style="width:6%">4</th>
                        <th style="width:6%">6</th>
                        <th style="width:6%">8</th>
                        <th style="width:6%">10</th>
                        <th style="width:6%">12</th>
                        <th style="width:6%">14</th>
                        <th style="width:6%">16</th>
                        <th style="width:6%">TOTAL</th>
                    </tr>
                    </thead>
            
                </table>';                    
                
                //*Cuerpo PAG 2
                echo '<table border="1" style="border:dashed" align="left" width="900px">';

                    $articulosP1 = ControladorPedidos::ctrPedidoImpresionB($codigo, 51, 100);

                    foreach($articulosP1 as $key => $value){

                        if($value["t1"] <= 0){

                            $value["t1"] = " ";
                
                        }else{
                
                            $value["t1"];
                
                        }
                
                        if($value["t2"] <= 0){
                
                            $value["t2"] = " ";
                
                        }else{
                
                            $value["t2"];
                
                        }
                
                        if($value["t3"] <= 0){
                
                            $value["t3"] = " ";
                
                        }else{
                
                            $value["t3"];
                
                        }
                
                        if($value["t4"] <= 0){
                
                            $value["t4"] = " ";
                
                        }else{
                
                            $value["t4"];
                
                        }
                
                        if($value["t5"] <= 0){
                
                            $value["t5"] = " ";
                
                        }else{
                
                            $value["t5"];
                
                        }
                
                        if($value["t6"] <= 0){
                
                            $value["t6"] = " ";
                
                        }else{
                
                            $value["t6"];
                
                        }
                
                        if($value["t7"] <= 0){
                
                            $value["t7"] = " ";
                
                        }else{
                
                            $value["t7"];
                
                        }
                
                        if($value["t8"] <= 0){
                
                            $value["t8"] = " ";
                
                        }else{
                
                            $value["t8"];
                
                        }
                        
                        if($value["cod_color"] == "99"){

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">=====</th>
                                <th style="width:20%;text-align:left;">====================</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%">===</th>
                            </tr>';                          


                        }else{

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">'.$value["modelo"].'</th>
                                <th style="width:20%;text-align:left;">'.$value["color"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t1"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t2"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t3"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t4"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t5"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t6"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t7"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t8"].'</th>
                                <th style="width:6%">'.$value["total"].'</th>
                            </tr>'; 
                        }
                    
    

                    }

                echo '</table';                    

                //*Total unidades
                echo '<table border="1" align="left" width="900px">

                    </thead>                
                        <tr>               
                            <th style="width:10%;text-align:left;">TOTALES</th>
                            <th style="width:20%;text-align:left;">PEDIDO</th>
                            <th style="width:6%">'.$totales["t1"].'</th>
                            <th style="width:6%">'.$totales["t2"].'</th>
                            <th style="width:6%">'.$totales["t3"].'</th>
                            <th style="width:6%">'.$totales["t4"].'</th>
                            <th style="width:6%">'.$totales["t5"].'</th>
                            <th style="width:6%">'.$totales["t6"].'</th>
                            <th style="width:6%">'.$totales["t7"].'</th>
                            <th style="width:6%">'.$totales["t8"].'</th>
                            <th style="width:6%">'.$totales["total"].'</th>                
                        </tr>                
                    </thead>
            
                </table>';                

                //*Detalle fin de pedido
                echo '<table border="0" align="left" width="900px">

                        </thead>
                    
                        <tr>                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>                    
                        </tr>
                    
                        <tr>                    
                            <td style="width:10%;text-align:left;">TOTAL S/</td>
                            <th style="width:20%;text-align:left;">'.$pedidos["total"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                        </tr>
                    
                        <tr>                    
                            <td style="width:10%;text-align:left;">Forma de Pago</td>
                            <th colspan="7" style="width:20%;text-align:left;">'.$pedidos["descripcion"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>               
                        </tr>
                    
                        </thead>
            
                </table>';                     

            }
            //todo: 3 PAGINAS
            else if($cantidadArticulos > 100 && $cantidadArticulos <= 150){

                //*Cabecera GLOBAL PAG 1
                echo '<table border="0" align="left" width="900px">

                    <thead>
                
                        <tr>
                    
                            <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">Nro. PEDIDO</th>
                            <td style="width:20%">'.$respuesta["pedido"].'</td>
                            <th colspan="6"></th>
                            <th style="width:6%;text-align:left;">FECHA</th>
                            <td colspan="2">'.$newDate.'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">CLIENTE:</th>
                            <td colspan="4">'.$respuesta["nombre"].'</td>
                            <th colspan="2"></th>
                            <th style="width:6%">Cod:</th>
                            <td colspan="2">'.$respuesta["codigo"].'</td>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                            <td colspan="10">'.$respuesta["direccion"].'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <td colspan="6">'.$respuesta["nom_ubi"].'</td>
                            <th style="width:10%;text-align:left;" colspan="2">'.$respuesta["ubigeo"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">VENDEDOR</th>
                            <td style="width:20%">'.$respuesta["vendedor"].'</td>
                            <th style="width:6%;text-align:left;">'.$respuesta["tipo_doc"].'</th>
                            <td colspan="2">'.$respuesta["documento"].'</td>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                
                    </thead>
                
                </table>';

                //*Cabecera PEDIDO PAG 1
                echo '<table border="1" align="left" width="900px">

                    <thead>
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">S</th>
                        <th style="width:6%">M</th>
                        <th style="width:6%">L</th>
                        <th style="width:6%">XL</th>
                        <th style="width:6%">XXL</th>
                        <th style="width:6%">XS</th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">28</th>
                        <th style="width:6%">30</th>
                        <th style="width:6%">32</th>
                        <th style="width:6%">34</th>
                        <th style="width:6%">36</th>
                        <th style="width:6%">38</th>
                        <th style="width:6%">40</th>
                        <th style="width:6%">42</th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%;text-align:left;">Modelo</th>
                        <th style="width:20%">Color</th>
                        <th style="width:6%">3</th>
                        <th style="width:6%">4</th>
                        <th style="width:6%">6</th>
                        <th style="width:6%">8</th>
                        <th style="width:6%">10</th>
                        <th style="width:6%">12</th>
                        <th style="width:6%">14</th>
                        <th style="width:6%">16</th>
                        <th style="width:6%">TOTAL</th>
                    </tr>
                    </thead>
            
                </table>';

                //*Cuerpo PAG 1
                echo '<table border="1" style="border:dashed" align="left" width="900px">';

                    $articulosP1 = ControladorPedidos::ctrPedidoImpresionB($codigo, 0, 50);

                    foreach($articulosP1 as $key => $value){

                        if($value["t1"] <= 0){

                            $value["t1"] = " ";
                
                        }else{
                
                            $value["t1"];
                
                        }
                
                        if($value["t2"] <= 0){
                
                            $value["t2"] = " ";
                
                        }else{
                
                            $value["t2"];
                
                        }
                
                        if($value["t3"] <= 0){
                
                            $value["t3"] = " ";
                
                        }else{
                
                            $value["t3"];
                
                        }
                
                        if($value["t4"] <= 0){
                
                            $value["t4"] = " ";
                
                        }else{
                
                            $value["t4"];
                
                        }
                
                        if($value["t5"] <= 0){
                
                            $value["t5"] = " ";
                
                        }else{
                
                            $value["t5"];
                
                        }
                
                        if($value["t6"] <= 0){
                
                            $value["t6"] = " ";
                
                        }else{
                
                            $value["t6"];
                
                        }
                
                        if($value["t7"] <= 0){
                
                            $value["t7"] = " ";
                
                        }else{
                
                            $value["t7"];
                
                        }
                
                        if($value["t8"] <= 0){
                
                            $value["t8"] = " ";
                
                        }else{
                
                            $value["t8"];
                
                        }
                        
                        if($value["cod_color"] == "99"){

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">=====</th>
                                <th style="width:20%;text-align:left;">====================</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%">===</th>
                            </tr>';                          


                        }else{

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">'.$value["modelo"].'</th>
                                <th style="width:20%;text-align:left;">'.$value["color"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t1"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t2"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t3"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t4"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t5"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t6"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t7"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t8"].'</th>
                                <th style="width:6%">'.$value["total"].'</th>
                            </tr>'; 
                        }
                    
    

                    }

                echo '</table';

                //*RELLENO PAG 1                    
                for ($i=0; $i < 25; $i++) { 
                    echo '<table border="0" align="left" width="900px">
                        <tr>
                            <td></td>
                        </tr>
                    </table>';
                }

                //*Cabecera GLOBAL PAG 2
                echo '<table border="0" align="left" width="900px">

                    <thead>
                
                        <tr>
                    
                            <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">Nro. PEDIDO</th>
                            <td style="width:20%">'.$respuesta["pedido"].'</td>
                            <th colspan="6"></th>
                            <th style="width:6%;text-align:left;">FECHA</th>
                            <td colspan="2">'.$newDate.'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">CLIENTE:</th>
                            <td colspan="4">'.$respuesta["nombre"].'</td>
                            <th colspan="2"></th>
                            <th style="width:6%">Cod:</th>
                            <td colspan="2">'.$respuesta["codigo"].'</td>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                            <td colspan="10">'.$respuesta["direccion"].'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <td colspan="6">'.$respuesta["nom_ubi"].'</td>
                            <th style="width:10%;text-align:left;" colspan="2">'.$respuesta["ubigeo"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">VENDEDOR</th>
                            <td style="width:20%">'.$respuesta["vendedor"].'</td>
                            <th style="width:6%;text-align:left;">'.$respuesta["tipo_doc"].'</th>
                            <td colspan="2">'.$respuesta["documento"].'</td>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                
                    </thead>
                
                </table>';

                //*Cabecera PEDIDO PAG 2
                echo '<table border="1" align="left" width="900px">

                    <thead>
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">S</th>
                        <th style="width:6%">M</th>
                        <th style="width:6%">L</th>
                        <th style="width:6%">XL</th>
                        <th style="width:6%">XXL</th>
                        <th style="width:6%">XS</th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">28</th>
                        <th style="width:6%">30</th>
                        <th style="width:6%">32</th>
                        <th style="width:6%">34</th>
                        <th style="width:6%">36</th>
                        <th style="width:6%">38</th>
                        <th style="width:6%">40</th>
                        <th style="width:6%">42</th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%;text-align:left;">Modelo</th>
                        <th style="width:20%">Color</th>
                        <th style="width:6%">3</th>
                        <th style="width:6%">4</th>
                        <th style="width:6%">6</th>
                        <th style="width:6%">8</th>
                        <th style="width:6%">10</th>
                        <th style="width:6%">12</th>
                        <th style="width:6%">14</th>
                        <th style="width:6%">16</th>
                        <th style="width:6%">TOTAL</th>
                    </tr>
                    </thead>
            
                </table>';                    
                
                //*Cuerpo PAG 2
                echo '<table border="1" style="border:dashed" align="left" width="900px">';

                    $articulosP1 = ControladorPedidos::ctrPedidoImpresionB($codigo, 51, 50);

                    foreach($articulosP1 as $key => $value){

                        if($value["t1"] <= 0){

                            $value["t1"] = " ";
                
                        }else{
                
                            $value["t1"];
                
                        }
                
                        if($value["t2"] <= 0){
                
                            $value["t2"] = " ";
                
                        }else{
                
                            $value["t2"];
                
                        }
                
                        if($value["t3"] <= 0){
                
                            $value["t3"] = " ";
                
                        }else{
                
                            $value["t3"];
                
                        }
                
                        if($value["t4"] <= 0){
                
                            $value["t4"] = " ";
                
                        }else{
                
                            $value["t4"];
                
                        }
                
                        if($value["t5"] <= 0){
                
                            $value["t5"] = " ";
                
                        }else{
                
                            $value["t5"];
                
                        }
                
                        if($value["t6"] <= 0){
                
                            $value["t6"] = " ";
                
                        }else{
                
                            $value["t6"];
                
                        }
                
                        if($value["t7"] <= 0){
                
                            $value["t7"] = " ";
                
                        }else{
                
                            $value["t7"];
                
                        }
                
                        if($value["t8"] <= 0){
                
                            $value["t8"] = " ";
                
                        }else{
                
                            $value["t8"];
                
                        }
                        
                        if($value["cod_color"] == "99"){

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">=====</th>
                                <th style="width:20%;text-align:left;">====================</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%">===</th>
                            </tr>';                          


                        }else{

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">'.$value["modelo"].'</th>
                                <th style="width:20%;text-align:left;">'.$value["color"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t1"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t2"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t3"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t4"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t5"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t6"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t7"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t8"].'</th>
                                <th style="width:6%">'.$value["total"].'</th>
                            </tr>'; 
                        }
                    
    

                    }

                echo '</table';                     

                //*RELLENO PAG 2                    
                for ($i=0; $i < 30; $i++) { 
                    echo '<table border="0" align="left" width="900px">
                        <tr>
                            <td></td>
                        </tr>
                    </table>';
                }        
                
                //*Cabecera GLOBAL PAG 3
                echo '<table border="0" align="left" width="900px">

                    <thead>
                
                        <tr>
                    
                            <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">Nro. PEDIDO</th>
                            <td style="width:20%">'.$respuesta["pedido"].'</td>
                            <th colspan="6"></th>
                            <th style="width:6%;text-align:left;">FECHA</th>
                            <td colspan="2">'.$newDate.'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">CLIENTE:</th>
                            <td colspan="4">'.$respuesta["nombre"].'</td>
                            <th colspan="2"></th>
                            <th style="width:6%">Cod:</th>
                            <td colspan="2">'.$respuesta["codigo"].'</td>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                            <td colspan="10">'.$respuesta["direccion"].'</td>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <td colspan="6">'.$respuesta["nom_ubi"].'</td>
                            <th style="width:10%;text-align:left;" colspan="2">'.$respuesta["ubigeo"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%;text-align:left;">VENDEDOR</th>
                            <td style="width:20%">'.$respuesta["vendedor"].'</td>
                            <th style="width:6%;text-align:left;">'.$respuesta["tipo_doc"].'</th>
                            <td colspan="2">'.$respuesta["documento"].'</td>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                    
                        <tr>
                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                    
                        </tr>
                
                    </thead>
                
                </table>';   
                
                //*Cabecera PEDIDO PAG 3
                echo '<table border="1" align="left" width="900px">

                    <thead>
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">S</th>
                        <th style="width:6%">M</th>
                        <th style="width:6%">L</th>
                        <th style="width:6%">XL</th>
                        <th style="width:6%">XXL</th>
                        <th style="width:6%">XS</th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%"></th>
                        <th style="width:20%"></th>
                        <th style="width:6%">28</th>
                        <th style="width:6%">30</th>
                        <th style="width:6%">32</th>
                        <th style="width:6%">34</th>
                        <th style="width:6%">36</th>
                        <th style="width:6%">38</th>
                        <th style="width:6%">40</th>
                        <th style="width:6%">42</th>
                        <th style="width:6%"></th>
                    </tr>
                
                    <tr>
                        <th style="width:10%;text-align:left;">Modelo</th>
                        <th style="width:20%">Color</th>
                        <th style="width:6%">3</th>
                        <th style="width:6%">4</th>
                        <th style="width:6%">6</th>
                        <th style="width:6%">8</th>
                        <th style="width:6%">10</th>
                        <th style="width:6%">12</th>
                        <th style="width:6%">14</th>
                        <th style="width:6%">16</th>
                        <th style="width:6%">TOTAL</th>
                    </tr>
                    </thead>
            
                </table>';           
                
                //*Cuerpo PAG 3
                echo '<table border="1" style="border:dashed" align="left" width="900px">';

                    $articulosP1 = ControladorPedidos::ctrPedidoImpresionB($codigo, 101, 50);

                    foreach($articulosP1 as $key => $value){

                        if($value["t1"] <= 0){

                            $value["t1"] = " ";
                
                        }else{
                
                            $value["t1"];
                
                        }
                
                        if($value["t2"] <= 0){
                
                            $value["t2"] = " ";
                
                        }else{
                
                            $value["t2"];
                
                        }
                
                        if($value["t3"] <= 0){
                
                            $value["t3"] = " ";
                
                        }else{
                
                            $value["t3"];
                
                        }
                
                        if($value["t4"] <= 0){
                
                            $value["t4"] = " ";
                
                        }else{
                
                            $value["t4"];
                
                        }
                
                        if($value["t5"] <= 0){
                
                            $value["t5"] = " ";
                
                        }else{
                
                            $value["t5"];
                
                        }
                
                        if($value["t6"] <= 0){
                
                            $value["t6"] = " ";
                
                        }else{
                
                            $value["t6"];
                
                        }
                
                        if($value["t7"] <= 0){
                
                            $value["t7"] = " ";
                
                        }else{
                
                            $value["t7"];
                
                        }
                
                        if($value["t8"] <= 0){
                
                            $value["t8"] = " ";
                
                        }else{
                
                            $value["t8"];
                
                        }
                        
                        if($value["cod_color"] == "99"){

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">=====</th>
                                <th style="width:20%;text-align:left;">====================</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%;font-weight: normal;">===</th>
                                <th style="width:6%">===</th>
                            </tr>';                          


                        }else{

                            echo '<tr>
                                <th style="width:10%;font-weight: normal;text-align:left;">'.$value["modelo"].'</th>
                                <th style="width:20%;text-align:left;">'.$value["color"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t1"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t2"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t3"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t4"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t5"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t6"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t7"].'</th>
                                <th style="width:6%;font-weight: normal;">'.$value["t8"].'</th>
                                <th style="width:6%">'.$value["total"].'</th>
                            </tr>'; 
                        }
                    
    

                    }

                echo '</table';       
                
                //*Total unidades
                echo '<table border="1" align="left" width="900px">

                    </thead>                
                        <tr>               
                            <th style="width:10%;text-align:left;">TOTALES</th>
                            <th style="width:20%;text-align:left;">PEDIDO</th>
                            <th style="width:6%">'.$totales["t1"].'</th>
                            <th style="width:6%">'.$totales["t2"].'</th>
                            <th style="width:6%">'.$totales["t3"].'</th>
                            <th style="width:6%">'.$totales["t4"].'</th>
                            <th style="width:6%">'.$totales["t5"].'</th>
                            <th style="width:6%">'.$totales["t6"].'</th>
                            <th style="width:6%">'.$totales["t7"].'</th>
                            <th style="width:6%">'.$totales["t8"].'</th>
                            <th style="width:6%">'.$totales["total"].'</th>                
                        </tr>                
                    </thead>
            
                </table>';                

                //*Detalle fin de pedido
                echo '<table border="0" align="left" width="900px">

                        </thead>
                    
                        <tr>                    
                            <th style="width:10%"></th>
                            <th style="width:20%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>                    
                        </tr>
                    
                        <tr>                    
                            <td style="width:10%;text-align:left;">TOTAL S/</td>
                            <th style="width:20%;text-align:left;">'.$pedidos["total"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                        </tr>
                    
                        <tr>                    
                            <td style="width:10%;text-align:left;">Forma de Pago</td>
                            <th colspan="7" style="width:20%;text-align:left;">'.$pedidos["descripcion"].'</th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>
                            <th style="width:6%"></th>               
                        </tr>
                    
                        </thead>
            
                </table>';                      

            }

        ?>


    </div>
  <p>&nbsp;</p>

</body>

</html>
