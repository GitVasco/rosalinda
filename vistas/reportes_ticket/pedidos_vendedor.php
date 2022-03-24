<html>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v8.css" target="_blank" rel="stylesheet" type="text/css">
    </head>

<body>
<!-- <body onload="window.print();"> -->
<?php
    require_once "../../controladores/pedidos.controlador.php";
    require_once "../../modelos/pedidos.modelo.php";

    require_once "../../extensiones/cantidad_en_letras.php";

    /* 
    todo: traemos todos lso datos para el ticket
    */

    $vendedor = $_GET["vendedor"];

    if($_GET["vendedor"] == ""){

        $vendedor = null;

    }else{

        $vendedor = $_GET["vendedor"];

    }

    $pedidos = ControladorPedidos::ctrPedidosPendientes($vendedor);
    #var_dump($pedidos);


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
                        
                                <th style="text-align:left;" colspan="11">Pedidos y Facturación</th>
                        
                            </tr>         
                            
                            <tr>
                        
                                <th style="text-align:center;" colspan="11">Pedidos Pendientes</th>
                        
                            </tr>   

                            <tr>
                        
                                <th style="text-align:center;" colspan="11"></th>
                        
                            </tr>  
                        </thead>
                    
                </table>';

            echo '<br>';
            echo '<br>';

            echo '<table border="1" align="left" width="980px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:12%;text-align:center;">Ven.</th>
                        <th style="width:20%;text-align:left;">Zona</th>
                        <th style="width:7%;text-align:left;">Pedido</th>
                        <th style="width:8%;text-align:left;">Cliente</th>
                        <th style="width:27%;text-align:left;">Nombre</th>
                        <th style="width:8%;text-align:left;">fecha</th>
                        <th style="width:8%;text-align:left;">Monto</th>
                        <th style="width:10%;text-align:left;">Estado</th>

                        
                    </tr>
            
                </thead>
        
            </table>';      
            
            echo '<table border="1" align="left" width="980px">';

                $suma = 0;
                foreach($pedidos as $key => $value){

                    if($value["estado"] == "GENERADO"){

                        $estado = '<td style="width:10%;text-align:center;color:purple;"><b>'.$value["estado"].'</b></td>';

                    }else if($value["estado"] == "APROBADO"){

                        $estado = '<td style="width:10%;text-align:center;color:orange;"><b>'.$value["estado"].'</b></td>';

                    }else if($value["estado"] == "APT"){

                        $estado = '<td style="width:10%;text-align:center;color:black;"><b>'.$value["estado"].'</b></td>';

                    }else if($value["estado"] == "CONFIRMADO"){

                        $estado = '<td style="width:10%;text-align:center;color:blue;"><b>'.$value["estado"].'</b></td>';

                    }

                    echo '<tr>
                                
                            <td style="width:12%;text-align:left;"><b>'.$value["vendedor"].' - '.$value["nom_vendedor"].'</b></td>
                            <td style="width:20%;text-align:left;">'.$value["nom_ubigeo"].'</td>
                            <td style="width:7%;text-align:left;">'.$value["codigo"].'</td>
                            <td style="width:8%;text-align:left;">'.$value["cliente"].'</td>
                            <td style="width:27%;text-align:left;">'.substr($value["nombre"],0,30).'</td>
                            <td style="width:8%;text-align:right;">'.$value["fecha"].'</td>
                            <td style="width:8%;text-align:right;">'.number_format($value["op_gravada"],2).'</td>
                            '.$estado.'
                            
                        

                        </tr>';  
                        
                    $suma+= $value["op_gravada"];

                }

            echo '</table>';        
            
            echo '<table border="1" align="left" width="980px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:12%;text-align:center;"></th>
                        <th style="width:20%;text-align:left;"></th>
                        <th style="width:7%;text-align:left;"></th>
                        <th style="width:8%;text-align:left;"></th>
                        <th style="width:27%;text-align:left;"></th>
                        <th style="width:8%;text-align:RIGHT;">Total S/</th>
                        <th style="width:8%;text-align:right;">'.number_format($suma,2).'</th>
                        <th style="width:10%;text-align:left;"></th>

                        
                    </tr>
            
                </thead>
        
            </table>';                 
            
            #var_dump($suma);
            

        ?>

        


    </div>
    <p>&nbsp;</p>

</body>

</html>




