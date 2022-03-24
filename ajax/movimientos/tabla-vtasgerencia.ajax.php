<?php

require_once "../../controladores/movimientos.controlador.php";
require_once "../../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVtasGerencia(){

        $mes = $_GET["mes"];

        $movimientos = ControladorMovimientos::ctrMostrarResumenVtas($mes);	

        if(count($movimientos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

            if($movimientos[$i]["tipo"] == "2022"){

                $neto = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["neto"],2)."</b></div>";
                $igv = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["igv"],2)."</div>";
                $dscto = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["dscto"],2)."</b></div>";
                $total = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["total"],2)."</b></div>";

            }else{

                $neto = "<div style='text-align:right !important'>".number_format($movimientos[$i]["neto"],2)."</div>";
                $igv = "<div style='text-align:right !important'>".number_format($movimientos[$i]["igv"],2)."</div>";
                $dscto = "<div style='text-align:right !important'>".number_format($movimientos[$i]["dscto"],2)."</div>";
                $total = "<div style='text-align:right !important'>".number_format($movimientos[$i]["total"],2)."</div>";
                
            }




                $datosJson .= '[
                "'.$movimientos[$i]["tipo"].'",
                "'.$movimientos[$i]["tipo_documento"].'",
                "'.$neto.'",
                "'.$igv.'",
                "'.$dscto.'",
                "'.$total.'"
                ],';        
                }

                $datosJson=substr($datosJson, 0, -1);

                $datosJson .= '] 

                }';

            echo $datosJson;
            }else{

                echo '{
                    "data":[]
                }';
                return;

            }
    }
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarMovimientos = new TablaMovimientos();
$activarMovimientos -> mostrarTablaVtasGerencia();