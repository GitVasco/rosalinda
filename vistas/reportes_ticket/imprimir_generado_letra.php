<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v4.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
<?php
require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";
require_once "../../extensiones/cantidad_en_letras.php";

/* 
todo: traemos todos lso datos para el ticket
*/
$numCuenta = $_GET["numCuenta"];
$fecha = date("d-m-Y");

$cuentas = ControladorCuentas::ctrMostrarCuentasGeneradosLetras("doc_origen",$numCuenta);



?>
  
  <div class="zona_impresion">
    <!-- codigo imprimir -->
    <br>

    <?php
    foreach ($cuentas as $key => $respuesta) {

    //Establecemos los datos de las letras
    $lugar= "LIMA";
    $diaEmision = substr($respuesta["fecha"],8,2);
    $mesEmision = substr($respuesta["fecha"],5,2);
    $anoEmision = substr($respuesta["fecha"],0,4);

    $diaVencimiento = substr($respuesta["fecha_ven"],8,2);
    $mesVencimiento = substr($respuesta["fecha_ven"],5,2);
    $anoVencimiento = substr($respuesta["fecha_ven"],0,4);

    $letras= CantidadEnLetra($respuesta["monto"]);
        # code...
   

      echo '<table >
    
                <tr>
                    <td style="width:180px;text-align:center">'.$respuesta["num_cta"].'</td>
                    <td style="width:180px;text-align:center">'.$respuesta["doc_origen"].'</td>
                    <td style="width:80px;text-align:center">'.$diaEmision.'</td>
                    <td style="width:50px;text-align:center">'.$mesEmision.'</td>
                    <td style="width:50px;text-align:center">'.$anoEmision.'</td>
                    <td style="width:242px;text-align:center">'.$lugar.'</td>
                    <td style="width:50px">'.$diaVencimiento.'</td>
                    <td style="width:50px">'.$mesVencimiento.'</td>
                    <td style="width:100px">'.$anoVencimiento.'</td>
                    <td style="width:60px">S/</td>
                    <td style="width:40px;text-align:right">'.$respuesta["monto"].'</td>
                </tr>

            </table>
            <table style="padding-top:70px">
                <tr>
                    <td>'.$letras.'</td>  
                </tr>
            </table>
            <table   style="padding-top:40px">
    
                <tr>
                    <td style="width:600px;text-align:right">'.$respuesta["nombre"].'</td>
                
                </tr>
            </table>      
                
            <table style="padding-top:35px;margin-left:100px">
                <tr>
                    <td style="width:400px" rowspan="2">'.$respuesta["direccion"].'</td>
                </tr>  
            </table>
            <table style="margin-left:420px;padding-top:10px">
                <tr>
                    <td style="width:400px" >'.$respuesta["ubcli"].'</td>
                </tr>  
            </table>
            
            <table style="padding-top:10px">
                <tr>
                    <td style="width:235px;text-align:right">'.$respuesta["documento"].'</td>
                    <td style="width:300px;text-align:right">'.$respuesta["telefono"].'</td>
                </tr>
            </table>';
            if($respuesta["aval_nombre"]){
                
            
            echo'<table   style="padding-top:45px;margin-left:160px">
    
                <tr>
                    <td style="width:500px">'.$respuesta["aval_nombre"].'</td>
                
                </tr>
            </table>
            
            <table style="padding-top:25px;margin-left:100px">
                <tr>
                    <td style="width:400px" rowspan="2">'.$respuesta["aval_dir"].'</td>
                </tr>  
            </table>
            <table style="margin-left:100px;margin-top:40px">
                <tr>
                    <td style="width:350px" >'.$respuesta["ubaval"].'</td>
                    <td style="width:200px;text-align:left">'.$respuesta["aval_telf"].'</td>
                </tr>  
            </table>
            
            <table style="padding-top:17px">
                <tr>
                    <td style="width:235px;text-align:right">'.$respuesta["aval_ruc"].'</td>
                    
                </tr>
            </table>
            <table style="padding-bottom:585px">
            </table>
            ';
        }else{
            echo'<table style="padding-bottom:585px">
            </table>';
        }   
    }
    
    ?> 


    <br>
  </div>
  <p>&nbsp;</p>

</body>

</html>




