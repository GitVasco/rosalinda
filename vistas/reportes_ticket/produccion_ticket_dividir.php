<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

/* 
todo: traemos todos lso datos para el ticket
*/
$modelo = $_GET["modelo"];

$nombre = $_GET["nombre"];
$color = $_GET["color"];
$talla = $_GET["talla"];
$cantidad= $_GET["cant_taller"];

$cod_operacion = $_GET["cod_operacion"];
$nom_operacion = $_GET["nom_operacion"];

$fecha = date("d-m-Y");

$codigo = $_GET["ultimo"];


$cantidad2= $_GET["cant_taller2"];

$codigo2 = $_GET["ultimo2"];

//Establecemos los datos de la empresa
$empresa = "Corporacion Vasco S.A.C.";
$documento = "20513613939";

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
        </td>
      </tr>
  
      <tr>
        <td align="center"><?php echo $fecha; ?></td>
      </tr>

      <tr>
        <td colspan="3">===============================</td>
      </tr>  

      <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td><strong>Trabajador:  </strong></td>
      </tr>
      <tr>
      <td colspan="3">===============================</td>
      </tr>

    </table>

    <table border="0" align="center" width="300px">

      <tr>
        <td><strong><u>Modelo</u></strong></td>
        <td><strong><u>Nombre</u></strong></td>      
      </tr>
      
      <tr>
        <td style="font-size: x-large;"><?php echo $modelo?></td>
        <td style="font-size: x-large;"><?php echo $nombre?></td>
      </tr>

    </table>

    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td><strong><u>Color</u></strong></td>
        <td><strong><u>Talla</u></strong></td>      
        <td><strong><u>Cantidad</u></strong></td>
      </tr>
      
      <tr>
        <td style="font-size: x-large;"><?php echo $color?></td>
        <td style="font-size: x-large;"><?php echo $talla?></td>
        <td style="font-size: x-large;"><?php echo $cantidad?></td>
      </tr>

    </table>

    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td><strong><u>Cod. Operación</u></strong></td>
        <td><strong><u>Operación</u></strong></td>      
      </tr>
      
      <tr>
        <td style="font-size: x-large;"><?php echo $cod_operacion?></td>
        <td style="font-size: x-large;"><?php echo $nom_operacion?></td>
      </tr>

    </table>


    <table border="0" align="center" width="300px">

      <tr>
 
        <td align="center">

          <input type="hidden" name="codigo" id="codigo" value=<?php echo $codigo?>>
          <div>
            <svg id="barcode" style="width: 400px; height:220px;"></svg>
          </div> 

        </td>

      </tr>

    </table>
 

    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td align="center">
          <!-- Mostramos los datos de la empresa en el documento HTML -->
          .::<strong> <?php echo $empresa; ?></strong>::.<br>
          <?php echo $documento; ?><br>
        </td>
      </tr>
  
      <tr>
        <td align="center"><?php echo $fecha; ?></td>
      </tr>

      <tr>
        <td colspan="3">===============================</td>
      </tr>  

      <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td><strong>Trabajador:  </strong></td>
      </tr>
      <tr>
      <td colspan="3">===============================</td>
      </tr>

    </table>

    <table border="0" align="center" width="300px">

      <tr>
        <td><strong><u>Modelo</u></strong></td>
        <td><strong><u>Nombre</u></strong></td>      
      </tr>
      
      <tr>
        <td style="font-size: x-large;"><?php echo $modelo?></td>
        <td style="font-size: x-large;"><?php echo $nombre?></td>
      </tr>

    </table>

    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td><strong><u>Color</u></strong></td>
        <td><strong><u>Talla</u></strong></td>      
        <td><strong><u>Cantidad</u></strong></td>
      </tr>
      
      <tr>
        <td style="font-size: x-large;"><?php echo $color?></td>
        <td style="font-size: x-large;"><?php echo $talla?></td>
        <td style="font-size: x-large;"><?php echo $cantidad2?></td>
      </tr>

    </table>

    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td><strong><u> Cod. Operación</u></strong></td>
        <td><strong><u>Operación</u></strong></td>      
      </tr>
      
      <tr>
        <td ><?php echo $cod_operacion?></td>
        <td style="font-size: x-large;"><?php echo $nom_operacion?></td>
      </tr>

    </table>


    <table border="0" align="center" width="300px">

      <tr>
 
        <td align="center">

          <input type="hidden" name="codigo2" id="codigo2" value=<?php echo $codigo2?>>
          <div>
            <svg id="barcode2" style="width: 400px; height:220px;"></svg>
          </div> 

        </td>

      </tr>

    </table>
  </div>
  <p>&nbsp;</p>

</body>

</html>

<script src="../bower_components/barcode/JsBarcode.all.min.js"></script>

<script>
  var codigo= document.getElementById("codigo").value;
  //console.log(codigo);

  JsBarcode("#barcode", codigo)

  var codigo2 = document.getElementById("codigo2").value;
  //console.log(codigo);

  JsBarcode("#barcode2", codigo2)


</script>
