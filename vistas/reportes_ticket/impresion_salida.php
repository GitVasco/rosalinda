<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v2.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

    require_once "../../controladores/salidas.controlador.php";
    require_once "../../modelos/salidas.modelo.php";

    /* 
    * TRAEMOS LOS DATOS DEL PEDIDO
    */
    $codigo = $_GET["codigo"];
    //var_dump($codigo);

    $respuesta = ControladorSalidas::ctrSalidaImpresionCab($codigo);
    //var_dump($respuesta["pedido"]);
    //var_dump($respuesta);

    $totales = ControladorSalidas::ctrSalidaImpresionTotales($codigo);
    //var_dump($totales);

    date_default_timezone_set("America/Lima");

    //var_dump($respuesta["fecha"]);

    $originalDate = $respuesta["fecha"];
    $newDate = date("d/m/Y", strtotime($originalDate));
    //var_dump($newDate);

  ?>
  <div class="zona_impresion">
  <!-- codigo imprimir -->

    <table border="0" align="left" width="900px">

    <thead>

      <tr>

        <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>

      </tr>

      <tr>

        <th style="width:10%;text-align:left;">Nro. SALIDA</th>
        <td style="width:20%"><?php echo $respuesta["pedido"]; ?></td>
        <th colspan="6"></th>
        <th style="width:6%;text-align:left;">FECHA</th>
        <td colspan="2"><?php echo $newDate; ?></td>

      </tr>

      <tr>

        <th style="width:10%;text-align:left;">CLIENTE:</th>
        <td colspan="4"><?php echo $respuesta["nombre"]; ?></td>
        <th colspan="2"></th>
        <th style="width:6%">Cod:</th>
        <td colspan="2"><?php echo $respuesta["codigo"]; ?></td>
        <th style="width:6%"></th>

      </tr>

      <tr>

        <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
        <td colspan="10"><?php echo $respuesta["direccion"]; ?></td>

      </tr>

      <tr>

        <th style="width:10%"></th>
        <td colspan="6"><?php echo $respuesta["nom_ubi"]; ?></td>
        <th style="width:10%;text-align:left;" colspan="2"><?php echo $respuesta["ubigeo"]; ?></th>
        <th style="width:6%"></th>
        <th style="width:6%"></th>

      </tr>

      <tr>

        <th style="width:10%;text-align:left;">VENDEDOR</th>
        <td style="width:20%"><?php echo $respuesta["vendedor"]; ?></td>
        <th style="width:6%;text-align:left;"><?php echo $respuesta["tipo_doc"]; ?></th>
        <td colspan="2"><?php echo $respuesta["documento"]; ?></td>
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

    </table>

    <table border="1" align="left" width="900px">

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

    </table>

    <?php

      $modelo = ControladorSalidas::ctrSalidaImpresionMod($codigo);
      //var_dump($modelo);

      foreach($modelo as $key => $value){

        echo '<table border="1" style="border:dashed" align="left" width="900px">';

        $respuesta = ControladorSalidas::ctrSalidaImpresion($codigo, $value["modelo"]);

        foreach($respuesta as $key => $value2){

          if($value2["t1"] <= 0){

            $value2["t1"] = " ";

          }else{

            $value2["t1"];

          }

          if($value2["t2"] <= 0){

            $value2["t2"] = " ";

          }else{

            $value2["t2"];

          }

          if($value2["t3"] <= 0){

            $value2["t3"] = " ";

          }else{

            $value2["t3"];

          }

          if($value2["t4"] <= 0){

            $value2["t4"] = " ";

          }else{

            $value2["t4"];

          }

          if($value2["t5"] <= 0){

            $value2["t5"] = " ";

          }else{

            $value2["t5"];

          }

          if($value2["t6"] <= 0){

            $value2["t6"] = " ";

          }else{

            $value2["t6"];

          }

          if($value2["t7"] <= 0){

            $value2["t7"] = " ";

          }else{

            $value2["t7"];

          }

          if($value2["t8"] <= 0){

            $value2["t8"] = " ";

          }else{

            $value2["t8"];

          }

          echo '<tr>
                  <th style="width:10%;font-weight: normal;text-align:left;">'.$value2["modelo"].'</th>
                  <th style="width:20%;text-align:left;">'.$value2["color"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t1"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t2"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t3"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t4"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t5"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t6"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t7"].'</th>
                  <th style="width:6%;font-weight: normal;">'.$value2["t8"].'</th>
                  <th style="width:6%">'.$value2["total"].'</th>
              </tr>';

        }

        echo '</table>';

      }

    ?>

    <table border="1" align="left" width="900px">

    </thead>

      <tr>

        <th style="width:10%;text-align:left;">TOTALES</th>
        <th style="width:20%;text-align:left;">SALIDA</th>
        <th style="width:6%"><?php echo $totales["t1"]; ?></th>
        <th style="width:6%"><?php echo $totales["t2"]; ?></th>
        <th style="width:6%"><?php echo $totales["t3"]; ?></th>
        <th style="width:6%"><?php echo $totales["t4"]; ?></th>
        <th style="width:6%"><?php echo $totales["t5"]; ?></th>
        <th style="width:6%"><?php echo $totales["t6"]; ?></th>
        <th style="width:6%"><?php echo $totales["t7"]; ?></th>
        <th style="width:6%"><?php echo $totales["t8"]; ?></th>
        <th style="width:6%"><?php echo $totales["total"]; ?></th>

      </tr>

    </thead>

    </table>

    <br>

    <table border="0" align="left" width="900px">

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

      <?php

        $pedidos = ControladorSalidas::ctrMostrarSalidasCabecera($codigo);

        //var_dump($pedidos);

        echo '<td style="width:10%;text-align:left;">TOTAL S/</td>
              <th style="width:20%;text-align:left;">'.$pedidos["total"].'</th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>';

      ?>

      </tr>

      <tr>

      <?php



        echo '<td style="width:10%;text-align:left;">Forma de Pago</td>
              <th colspan="7" style="width:20%;text-align:left;">'.$pedidos["descripcion"].'</th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>
              <th style="width:6%"></th>';

      ?>

      </tr>

    </thead>

    </table>

  </div>
  <p>&nbsp;</p>

</body>

</html>
