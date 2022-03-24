<html>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v8.css" target="_blank" rel="stylesheet" type="text/css">
    </head>

<body>
<!-- <body onload="window.print();"> -->
<?php
    require_once "../../controladores/movimientos.controlador.php";
    require_once "../../modelos/movimientos.modelo.php";

    require_once "../../extensiones/cantidad_en_letras.php";

    /* 
    todo: traemos todos lso datos para el ticket
    */

    $mes= $_GET["mes"];
    $movimientos = ControladorMovimientos::ctrMostrarResumenVtasB($mes);	
    #var_dump($movimientos);

    switch ($mes) {
        case $mes == 1:

            $nom_mes = 'ENERO';
            
            break;

        case $mes == 2:

            $nom_mes = 'FEBRERO';
            
            break;

        case $mes == 3:

            $nom_mes = 'MARZO';
            
            break;

        case $mes == 4:

            $nom_mes = 'ABRIL';
            
            break;

        case $mes == 5:

            $nom_mes = 'MAYO';
            
            break;

        case $mes == 6:

            $nom_mes = 'JUNIO';
            
            break;

        case $mes == 7:

            $nom_mes = 'JULIO';
            
            break;
        
        case $mes == 8:

            $nom_mes = 'AGOSTO';
            
            break;   

        case $mes == 9:

            $nom_mes = 'SEPTIEMBRE';
            
            break;

        case $mes == 10:

            $nom_mes = 'OCTUBRE';
            
            break;

        case $mes == 11:

            $nom_mes = 'NOVIEMBRE';
            
            break;

        case $mes == 12:

            $nom_mes = 'DICIEMBRE';
            
            break;            
            
        default:
            $nom_mes = "2022";

            break;
    }


    $hoy = date("d-m-y"); 

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

            echo ' <table border="0" align="left" width="980px">

            <thead>

                <tr>

                    <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>

                </tr>

                <tr>

                    <th style="text-align:left;" colspan="11">Área de créditos y cobranzas</th>

                </tr>                            

                <tr>

                    <th style="width:10%;text-align:left;"></th>
                    <th style="width:50%" colspan="4">RESUMEN DE VENTAS EN S/ - '.$nom_mes.'</th>
                    <th colspan="1"></th>
                    <th style="text-align:right;">FECHA</th>
                    <td style="width:10%;text-align:right;" colspan="4">'.$hoy.'</td>

                </tr>

            </thead>

            </table>';        

            echo '<table border="1" align="left" width="980px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:15%;text-align:center;">Tipo</th>
                        <th style="width:15%;text-align:center;">Total Bruto</th>
                        <th style="width:10%;text-align:center;">Descuentos</th>
                        <th style="width:10%;text-align:center;">Fletes Otros</th>
                        <th style="width:10%;text-align:center;">Sub-Total</th>
                        <th style="width:10%;text-align:center;">Igv</th>
                        <th style="width:10%;text-align:center;">Total No Afecto</th>
                        <th style="width:10%;text-align:center;">Total Neto</th>
                        
                    </tr>
            
                </thead>
        
            </table>';      
            
            echo '<table border="0" align="left" width="980px">';

                $bruto = 0;
                $subtotal = 0;
                $igv = 0;
                $neto = 0;

                foreach($movimientos as $key => $value){

                    echo '<tr>
                                
                            <td style="width:15%;text-align:left;"><b>'.$value["tipo_documento"].'</b></td>
                            <td style="width:15%;text-align:right;">'.number_format($value["neto"],2).'</td>
                            <td style="width:10%;text-align:right;">'.number_format($value["dscto"],2).'</td>
                            <td style="width:10%;text-align:right;">0.00</td>
                            <td style="width:10%;text-align:right;"><b>'.number_format($value["neto"],2).'</b></td>
                            <td style="width:10%;text-align:right;">'.number_format($value["igv"],2).'</td>
                            <td style="width:10%;text-align:right;">0.00</td>
                            <td style="width:10%;text-align:right;"><b>'.number_format($value["total"],2).'</b></td>

                        </tr>';  
                        
                        $bruto += $value["neto"];
                        $subtotal += $value["neto"];
                        $igv += $value["igv"];
                        $neto += $value["total"];  

                }

            echo '</table>';   
            
            echo '<table border="1" align="left" width="980px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:15%;text-align:center;">Total</th>
                        <th style="width:15%;text-align:right;">'.number_format($bruto,2).'</th>
                        <th style="width:10%;text-align:right;">0.00</th>
                        <th style="width:10%;text-align:right;">0.00</th>
                        <th style="width:10%;text-align:right;">'.number_format($subtotal,2).'</th>
                        <th style="width:10%;text-align:right;">'.number_format($igv,2).'</th>
                        <th style="width:10%;text-align:right;">0.00</th>
                        <th style="width:10%;text-align:right;">'.number_format($neto,2).'</th>
                        
                    </tr>
            
                </thead>
        
            </table>';              

        ?>


    </div>

    
    <p>&nbsp;</p>

</body>
</html>




