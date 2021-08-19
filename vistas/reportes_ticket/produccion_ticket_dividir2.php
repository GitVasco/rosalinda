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



//Establecemos los datos de la empresa
$empresa = "Corporacion Vasco S.A.C.";
$documento = "20513613939";

?>
  <div class="zona_impresion">
    <!-- codigo imprimir -->
   

    <table border="0" align="center" width="300px">

      <tr>
        <td align="center">
          <!-- Mostramos los datos de la empresa en el documento HTML -->
          .::<strong> <?php echo $empresa; ?></strong>::.<br>
        </td>
      </tr>
  

      <tr>
      <td colspan="3">===============================</td>
      </tr>

    </table>

    <!-- Contenido    -->
    <table border="0"  width="300px">

      <tr>
        <td><b>Modelo:</b><strong ><?php echo $modelo?> - <?php echo $nombre?></strong></strong></td>  
      </tr>

      <tr>
        <td><b>Color y Talla:  </b><?php echo $color?> - T<?php echo $talla?></td>
        
      </tr>

      <tr>
        <td><b>Cantidad:  </b><?php echo $cantidad?></td>
      </tr>

      <tr>
        <td><b>Operación:</b><strong ><?php echo $cod_operacion?> - <?php echo $nom_operacion?></strong></td>      
      </tr>
      
    </table


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
</body>

</html>

<script src="../bower_components/barcode/JsBarcode.all.min.js"></script>

<script>
  var codigo= document.getElementById("codigo").value;
  //console.log(codigo);

  JsBarcode("#barcode", codigo)

</script>
