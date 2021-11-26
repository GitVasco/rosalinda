<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v5.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
<?php
require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

require_once "../../extensiones/cantidad_en_letras.php";

/* 
todo: traemos todos lso datos para el ticket
*/
$tipo = $_GET["tipo"];
$documento = $_GET["documento"];

$venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);
$detalle_venta = ControladorFacturacion::ctrMostrarModeloImpresion($documento,$tipo);
//var_dump($detalle_venta);

    if($tipo = "S02"){

        $nombre_tipo = "Boleta Electrónica N°: ";
        $cliente_tipo = "Nombre: ";
        $documento_tipo = "DNI: ";
        $docsunat = "03";
        $docsuncli = "1";

    }else{

        $nombre_tipo = "Factura Electrónica N°: ";
        $cliente_tipo = "Razón Social: ";
        $documento_tipo = "RUC: ";
        $docsunat = "01";
        $docsuncli = "6";

    }

//Establecemos los datos de la empresa
$empresa = "Jose Adolfo Vasquez Cortez";
$ruc = "10094806777";
$direccionA = "Calle 2 Mz. O Lt. 10 - Urb. San Elias";
$direccionB = "Los Olivos - Lima - Perú";

$serdoc = substr($venta["documento"],0,4)."-".substr($venta["documento"],4,12);
$fecha_emision = $venta["fecha_emision"];
$fecha = date("d/m/Y", strtotime($fecha_emision));
$codcli = $venta["cliente"];
$nomcli = $venta["nombre"];
$doccli = $venta["dni"];
$dircli = $venta["direccion"];
$ubicli = $venta["nom_ubigeo"];
$codven = $venta["vendedor"];
$nomven = $venta["nom_vendedor"];

$monto_letra= CantidadEnLetra($venta["total"]);

$contenido = $ruc.'|'.$docsunat.'|'.substr($venta["documento"],0,4)."|".substr($venta["documento"],4,12).'|'.$venta["igv"].'|'.$venta["total"].'|'.$fecha.'|'.$docsuncli.'|'.$doccli.'|';
//var_dump($contenido);


//*GENERAMOS EL CODIGO QR

	//Agregamos la libreria para genera códigos QR
	require "phpqrcode/qrlib.php";    
	
	//Declaramos una carpeta temporal para guardar la imagenes generadas
	$dir = 'temp/';
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
        //Declaramos la ruta y nombre del archivo a generar
	$filename = $dir.'test.png';
 
        //Parametros de Condiguración
	
	$tamaño = 5; //Tamaño de Pixel
	$level = 'L'; //Precisión Baja
	$framSize = 3; //Tamaño en blanco
	//$contenido = "http://codigosdeprogramacion.com"; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

?>
        <!-- codigo imprimir -->
        <div class="zona_impresion">

            <!-- Cabecera -->
            <table border="0" align="center" width="500px">

                <tr>
                    <td align="center">
                        <img src="../img/plantilla/letras-rosa.png" width="350"><br>
                        <!-- Mostramos los datos de la empresa en el documento HTML -->
                        <strong> <?php echo $empresa; ?></strong><br>
                        <strong> <?php echo 'RUC: '.$ruc; ?></strong><br>
                        <?php echo $direccionA; ?><br>
                        <?php echo $direccionB; ?><br>
                        
                    </td>
                </tr>  

                <tr>
                    <td colspan="3">=====================================================</td>
                </tr>  

            </table>

            <!-- DATOS DEL DOCUMENTO -->
            <table border="0" align="center" width="500px">

                <tr>
                    <td align="left">

                        <?php echo '<strong>'.$nombre_tipo.'</strong> '.$serdoc; ?><br>
                        <?php echo '<strong>Fecha Emision: </strong>'.$fecha; ?><br>
                        <?php echo '<strong>'.$cliente_tipo.'</strong> '.$codcli.' - '.$nomcli; ?><br>
                        <?php echo '<strong>'.$documento_tipo.'</strong> '.$doccli; ?><br>
                        <?php echo '<strong>Dirección: </strong>'.$dircli.' - '.$ubicli; ?><br>
                        <?php echo '<strong>Vendedor: </strong>'.$codven.' - '.$nomven; ?><br>
                        
                    </td>
                </tr>  

                <tr>
                    <td colspan="3">=====================================================</td>
                </tr>  

            </table>        
            
            <!-- Cbecera detalle -->
            <table border="0" align="center" width="500px">

                <tr>
                    <td style="width:50%;"><strong>Descripcion</strong></td>
                    <td style="width:20%;" align="right"><strong>Cant</strong></td>
                    <td style="width:15%;" align="right"><strong>V. Unit</strong></td>
                    <td style="width:15%;" align="right"><strong>P. Venta</strong></td>
                </tr>  

                <tr>
                    <td colspan="4">=====================================================</td>
                </tr>  

            </table>   
            
            <!-- cuerpo detalle -->
            <table border="0" align="center" width="500px">

                <?php

                    foreach ($detalle_venta as $key => $value) {

                        echo '<tr>
                                    <td style="width:50%;">'.$value["modelo"].' - '.$value["nombre"].'</td>
                                    <td style="width:20%;" align="right">'.$value["cantidad"].' UND</td>
                                    <td style="width:15%;" align="right">'.$value["precio"].'</td>
                                    <td style="width:15%;" align="right">'.$value["total"].'</td>
                                </tr> ';

                    }

                ?>

                <tr>
                    <td colspan="4">=====================================================</td>
                </tr>  

            </table>  
            
            <!-- TOTALES -->
            <table border="0" align="center" width="500px">

                <tr>
                    <td style="width:10%;"></td>
                    <td style="width:10%;"></td>
                    <td style="width:50%;" align="right">Op. Gravadas S/</td>
                    <td style="width:30%;" align="right"><strong><?php echo $venta["neto"] ?></strong></td>
                </tr>  

                <tr>
                    <td style="width:35%;"></td>
                    <td style="width:20%;"></td>
                    <td style="width:15%;" align="right">IGV 18%</td>
                    <td style="width:30%;" align="right"><strong><?php echo $venta["igv"] ?></strong></td>
                </tr>   
                
                <tr>
                    <td style="width:35%;"></td>
                    <td style="width:20%;"></td>
                    <td style="width:15%;" align="right">Total S/</td>
                    <td style="width:30%;" align="right"><strong><?php echo $venta["total"] ?></strong></td>
                </tr>
                <tr>

                <tr>
                    <td colspan="4"><?php echo '<strong>Son: </strong>'.$monto_letra?></td>
                </tr>  

            </table>   
            
            <!-- CODIGO QR -->
            <table border="0" align="center" width="500px">

                <tr>
                    <td align="center">
                        <?php
                            echo '<img src="'.$dir.basename($filename).'" /><hr/>';
                        ?>
                    </td>
                </tr>  

            </table>                
            
            <!-- Cabecera -->
            <table border="0" align="center" width="500px">

                <tr>
                    <td align="center">
                        Representación impresa del comprobante electrónico<br>
                        .::Gracias por su compra::.<br>
                        .::Celular: 914-275-598::.
                    </td>
                </tr>  

                <tr>
                    <td colspan="4">=====================================================</td>
                </tr>  

            </table>       

        </div>

    </body>

</html>

