<?php

require_once "../../controladores/movimientos.controlador.php";
require_once "../../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMovimientos(){

        $movimientos = ControladorMovimientos::ctrMostrarRangosDias();	
        if(count($movimientos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

            $uno = "<div style='text-align:right !important; color:blue'>".number_format($movimientos[$i]["1a30"],2)."</div>";

            $dos = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["31a60"],2)."</div>";

            $tres = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["61a90"],2)."</div>";

            $cuatro = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["91a120"],2)."</div>";

            $cinco = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["121a150"],2)."</div>";

            $seis = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["151a180"],2)."</div>";

            $siete = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["180amas"],2)."</div>";

            $total = "<div style='text-align:right !important; color:red'><b>".number_format($movimientos[$i]["total"],2)."</b></div>";

            $datosJson .= '[
            "'.$movimientos[$i]["vendedor"].'-'.$movimientos[$i]["nombre"].'",
            "'.$uno.'",
            "'.$dos.'",
            "'.$tres.'",
            "'.$cuatro.'",
            "'.$cinco.'",
            "'.$seis.'",
            "'.$siete.'",
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
$activarMovimientos -> mostrarTablaMovimientos();