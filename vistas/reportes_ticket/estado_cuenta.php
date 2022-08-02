<html>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v8.css" target="_blank" rel="stylesheet" type="text/css">
    </head>

<body>
<!-- <body onload="window.print();"> -->
<?php
    require_once "../../controladores/cuentas.controlador.php";
    require_once "../../modelos/cuentas.modelo.php";

    require_once "../../extensiones/cantidad_en_letras.php";

    /* 
    todo: traemos todos lso datos para el ticket
    */
    $cliente = $_GET["cliente"];
    #var_dump($cliente);

    $ctaCab = Controladorcuentas::ctrEstadoCuentaCab($cliente);
    #var_dump($ctaCab);
    $ctaDet = Controladorcuentas::ctrEstadoCuentaDet($cliente);
    #var_dump($ctaDet);

    $hoy = date("d-m-y"); 

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

            echo ' <table border="0" align="left" width="1000px">

                        <thead>
                    
                            <tr>
                        
                                <th style="text-align:left;" colspan="11">ROSALINDA</th>
                        
                            </tr>

                            <tr>
                        
                                <th style="text-align:left;" colspan="11">Área de créditos y cobranzas</th>
                        
                            </tr>                            
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">Cod. Cliente</th>
                                <td style="width:50%" colspan="4">'.$ctaCab["cliente"].'</td>
                                <th colspan="1"></th>
                                <th style="text-align:right;">FECHA</th>
                                <td style="width:10%;text-align:right;" colspan="4">'.$hoy.'</td>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">CLIENTE:</th>
                                <td style="width:50%" colspan="4">'.$ctaCab["nombre"].'</td>
                                <th colspan="1"></th>
                                <th style="text-align:right;">Deuda Total:</th>
                                <th style="width:10%;text-align:right;" colspan="4">S/ '.number_format($ctaCab["monto_total"],2).'</td>                             

                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["direccion"].'</td>

                            </tr>                            
                    
                            <tr>
                        
                                <th style="width:10%;text-align:left;">ZONA:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["nom_ubigeo"].'</td>

                            </tr>    

                            <tr>
                        
                                <th style="width:10%;text-align:left;">RUC/DNI:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["documento"].'</td>

                            </tr>  
                            
                            <tr>
                        
                                <th style="width:10%;text-align:left;">TELÉFONO:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["telefono"].'</td>

                            </tr>  
                            
                            <tr>
                        
                                <th style="width:10%;text-align:left;"></th>
                                <th style="width:50%" colspan="10">Cta Recaudadora - BCP: 191-1553564-0-64</th>

                            </tr>                            

                        </thead>
                    
                </table>';

            echo '<br>';
            echo '<br>';

            echo '<table border="1" align="left" width="1000px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:4%">N°</th>
                        <th style="width:10%;text-align:left;">T/D</th>
                        <th style="width:10%;text-align:left;">DOCUMENTO</th>
                        <th style="width:8%;text-align:left;">FECHA EMISIÓN</th>
                        <th style="width:8%;text-align:left;">FECHA VEN.</th>
                        <th style="width:5%;text-align:left;">VEND.</th>
                        <th style="width:8%;text-align:left;">NRO ÚNICO</th>
                        <th style="width:8%;text-align:left;">BANCO</th>
                        <th style="width:8%;text-align:left;">MONTO TOTAL</th>
                        <th style="width:8%;text-align:left;">SALDO PENDIENTE</th>
                        <th style="width:8%;text-align:left;">GASTOS</th>
                        <th style="width:8%;text-align:left;">DEUDA TOTAL</th>
                        <th style="width:6%;text-align:left;">PROT.</th>
                        
                    </tr>
            
                </thead>
        
            </table>';            
 
            echo '<table border="1" align="left" width="1000px">';

                foreach($ctaDet as $key => $value){

                    if($value["protesta"]=="SI"){

                        $prot = '<td style="width:6%;text-align:center;"><b>'.$value["protesta"].'</b></td>';

                        $gasto = '<td style="width:8%;text-align:right;"><b>S/ '.number_format($value["gasto"],2).'</b></td>';

                    }else{

                        $prot = '<td style="width:6%;text-align:center;">'.$value["protesta"].'</td>';

                        $gasto = '<td style="width:8%;text-align:right;">S/ '.number_format($value["gasto"],2).'</td>';

                    }

                    echo '<tr>
                                
                                <td style="width:4%">'.($key+1).'</td>
                                <td style="width:10%;text-align:left;">'.$value["tipo_documento"].'</td>
                                <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                                <td style="width:8%;text-align:left;">'.$value["fecha"].'</td>
                                <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                                <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                                <td style="width:8%;text-align:left;">'.$value["num_unico"].'</td>
                                <td style="width:8%;text-align:center;">'.$value["banco"].'</td>
                                <td style="width:8%;text-align:right;">S/ '.number_format($value["monto"],2).'</td>
                                <td style="width:8%;text-align:right;">S/ '.number_format($value["saldo"],2).'</td>
                                '.$gasto.'
                                <td style="width:8%;text-align:right;"><b>S/ '.number_format($value["monto_total"],2).'</b></td>
                                '.$prot.'                                

                        </tr>';                    

                }

            echo '</table>';

            echo '<table border="1" align="left" width="1000px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:4%"></th>
                        <th style="width:10%;text-align:left;"></th>
                        <th style="width:10%;text-align:left;"></th>
                        <th style="width:8%;text-align:left;"></th>
                        <th style="width:8%;text-align:left;"></th>
                        <th style="width:5%;text-align:left;"></th>
                        <th style="width:8%;text-align:left;"></th>
                        <th style="width:8%;text-align:left;"></th>
                        <th style="width:8%;text-align:left;"></th>
                        <th style="width:8%;text-align:right;">S/ '.number_format($ctaCab["saldo"],2).'</th>
                        <th style="width:8%;text-align:right;">S/ '.number_format($ctaCab["gastos"],2).'</th>
                        <th style="width:8%;text-align:right;">S/ '.number_format($ctaCab["monto_total"],2).'</th>
                        <th style="width:6%;text-align:left;"></th>
                        
                    </tr>
            
                </thead>
        
            </table>';               

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




