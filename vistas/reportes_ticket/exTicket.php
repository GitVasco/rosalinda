<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

    $articulo = $_GET["articulo"];
    $modelo = $_GET["modelo"];

    //Establecemos los datos de la empresa
    $empresa = "Soluciones Innovadoras Perú S.A.C.";
    $documento = "20477157772";
    $direccion = "Chongoyape, José Gálvez 1368";
    $telefono = "931742904";
    $email = "jcarlos.ad7@gmail.com";

  ?>
  <div class="zona_impresion">
    <!-- codigo imprimir -->
    <br>

    <table border="0" align="center" width="300px">

      <tr>

        <td align="center">
          <!-- Mostramos los datos de la empresa en el documento HTML -->
          .::<strong> <?php echo $empresa; ?></strong>::.<br>
          <?php echo $documento; ?><br>
          <?php echo $direccion .' - '.$telefono; ?><br>
          <?php echo $articulo; ?><br>
          <?php echo $modelo; ?><br>
        </td>

      </tr>


    <br>
  </div>
  <p>&nbsp;</p>

</body>

</html>
