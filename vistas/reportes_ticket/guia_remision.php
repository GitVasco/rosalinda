<html>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v6.css" target="_blank" rel="stylesheet" type="text/css">
    </head>

<body onload="window.print();">
<?php
    require_once "../../controladores/facturacion.controlador.php";
    require_once "../../modelos/facturacion.modelo.php";

    require_once "../../extensiones/cantidad_en_letras.php";

    /* 
    todo: traemos todos lso datos para el ticket
    */
    $nguia = $_GET["codigo"];
    //var_dump($nguia);
    $tipo = $_GET["tipo"];

    $guiaC = ControladorFacturacion::ctrMostrarVentaImpresion($nguia,$tipo);
    //var_dump($guiaC);
    $guiaD = ControladorFacturacion::ctrMostrarModeloImpresion($nguia,$tipo);
    //var_dump($guiaD);
    $pPartida = "Calle Santo Toribio Nro 259 Urb Santa Luisa - SMP";

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

            echo '<table>
                    <tr>
                        <td style="width:800px"></td>
                        <td>'.$nguia.'</td>
                    </tr>
            </table>';

            echo '<br>';

            echo '<table>
                    <tr>
                        <td style="width:550px;vertical-align: text-top;">'.$pPartida.'</td>
                        <td style="width:550px">'.$guiaC["direccion"].' '.$guiaC["nom_ubigeo"].'</td>
                    </tr>
            </table>';

            echo '<table>
                    <tr>
                        <td style="width:150px;"></td>
                        <td style="width:200px;"></td>
                        <td>'.$guiaC["nombre"].'</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="width:150px;"></td>
                        <td style="width:200px;"></td>
                        <td>'.$guiaC["cliente"].'</td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <td style="width:150px;"></td>
                        <td style="width:200px;">'.$guiaC["dni"].'</td>
                        <td></td>
                        <td>Fecha de Traslado: '.$guiaC["fecha"].'</td>
                    </tr>
                    
            </table>';    

            echo '<br>';
            echo '<br>';
            
            echo '<table>
                    <tr>
                        <td style="width:250px;"></td>
                        <td style="width:250px;">HYUNDAI - AIR-914</td>
                        <td style="width:200px;"></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="width:250px;"></td>
                        <td style="width:250px;"></td>
                        <td style="width:200px;"></td>
                        <td>'.$guiaC["nom_agencia"].'</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="width:250px;height:18px"></td>
                        <td style="width:250px;"></td>
                        <td style="width:200px;"></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="width:250px;"></td>
                        <td style="width:250px;">Q73493436</td>
                        <td style="width:200px;"></td>
                        <td>'.$guiaC["ruc_agencia"].'</td>
                        <td></td>
                    </tr>
                    
            </table>'; 
            
            echo '<br>';
            echo '<br>';

            echo '<table>';
            
            $cont = 0;
            foreach($guiaD as $key => $value){

                echo '<tr>
                            <td style="width:120px;">'.$value["modelo"].'</td>
                            <td style="width:600px;">'.$value["nombre"].'</td>
                            <td>'.$value["cantidad"].' '.'C62</td>
                        </tr>';

                $cont++;

            }

            //var_dump($cont);

            $relleno = 32 - $cont;
            //var_dump($relleno);

            for ($i=0; $i < $relleno ; $i++) { 
                
                echo '<tr>
                        <td style="height:20px;"></td>
                        <td style="width:600px;"></td>
                        <td></td>
                    </tr>';

            }

            echo '</table>';

            if(substr($guiaC["doc_destino"], 0, 1) == "F"){

                $docDest = "Factura";

            }else{

                $docDest = "Boleta";

            }
            
            echo '<table>
                    <tr>
                        <td style="width:250px;"></td>
                        <td style="width:250px;">N° '.$docDest.': '.$guiaC["doc_destino"].'</td>
                        <td style="width:200px;"></td>
                        <td></td>
                        <td></td>
                    </tr>
            </table>';             


        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




