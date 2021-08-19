<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
<?php
require_once "../../controladores/cortes.controlador.php";
require_once "../../modelos/cortes.modelo.php";

/* 
todo: traemos todos lso datos para el ticket
*/
$codigo = $_GET["codigo"];
$fecha = date("d-m-Y");

$respuesta = ControladorCortes::ctrMostrarEnTalleres($codigo);
//var_dump($respuesta);

//Establecemos los datos de la empresa
$empresa = "Corporacion Vasco SAC";
$documento = "20513613939";

?>
  <div class="zona_impresion">
    <!-- codigo imprimir -->
    <br>

    <?php

      foreach ($respuesta as $key => $value) {

      echo '<table border="0" align="center" width="300px">

              <tr>
                <td colspan="3">================================</td>
              </tr>  

              <tr>
                <td align="center" colspan="3">
                  <strong>'.$empresa.'</strong><br>
                  '.$documento.'<br>
                </td>
              </tr>

              <tr>
                <td colspan="3">================================</td>
              </tr>  

              <tr>
                <td><b><u>Modelo</u></b></td>
                <td><b><u>Nombre</u></b></td>      
              </tr>

              <tr>
                <td style="font-size: x-large;"><strong>'.$value["modelo"].'</strong></td>
                <td style="font-size: x-large;"><strong>'.$value["nombre"].'</strong></td>
              </tr>
    
            </table>
        
            <table border="0" align="center" width="300px">

                    <tr>
                      <td><b><u>Color</u></b></td>
                      <td><b><u>Talla</u></b></td>      
                      <td><b><u>Cantidad</u></b></td>
                    </tr>
                    
                    <tr>
                       <td style="font-size: x-large;"><strong>'.$value["color"].'</strong></td>
                       <td style="font-size: x-large;"><strong>'.$value["talla"].'</strong></td>
                       <td style="font-size: x-large;"><strong>'.$value["cantidad"].'</strong></td>
                    </tr>

            </table>
                
            <table border="0" align="center" width="300px">

                <tr>
                  <td><b><u>Cod. Op.</u></b></td>
                  <td><b><u>Operación</u></b></td>      
                </tr>
                
                <tr>
                  <td><strong>'.$value["cod_operacion"].'</strong></td>
                  <td style="font-size: x-large;"><strong>'.$value["operacion"].'</strong></td>
                </tr>
        
            </table>
            
      
          
          <table border="0" align="center" width="300px">

            <tr>
      
              <td align="center">
    
                <input type="hidden" name="codigo" id="'.$value["codigo"].'" value="'.$value["codigo"].'">
                <span>
                  <svg id="barcode'.$value["codigo"].'" style="width: 420px; height:250px;"></svg>
                </span> 
    
              </td>
    
            </tr>
    
          </table>
          <script src="../bower_components/barcode/JsBarcode.all.min.js"></script>
          
          <script>

            var c'.$value["codigo"].' = document.getElementById("'.$value["codigo"].'").value;
            console.log(c'.$value["codigo"].');
      
            JsBarcode("#barcode'.$value["codigo"].'", c'.$value["codigo"].')
    
          </script>';

      }
   
    
    ?> 

    <br>
  </div>
  <p>&nbsp;</p>

</body>

</html>




