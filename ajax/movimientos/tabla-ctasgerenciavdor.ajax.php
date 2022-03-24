<?php

require_once "../../controladores/movimientos.controlador.php";
require_once "../../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMovimientos(){

        $movimientos = ControladorMovimientos::ctrMostrarCtasVdor();	
        if(count($movimientos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

            if($movimientos[$i]["vendedor"] == "ZZ"){

                $facturas = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["facturas"],2)."</b></div>";
                $guias = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["guias"],2)."</div>";
                $letras = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["letras"],2)."</b></div>";
                $total = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["total"],2)."</b></div>";

            }else{

                $facturas = "<div style='text-align:right !important'>".number_format($movimientos[$i]["facturas"],2)."</div>";
                $guias = "<div style='text-align:right !important'>".number_format($movimientos[$i]["guias"],2)."</div>";
                $letras = "<div style='text-align:right !important'>".number_format($movimientos[$i]["letras"],2)."</div>";
                $total = "<div style='text-align:right !important'>".number_format($movimientos[$i]["total"],2)."</div>";
                
            }


            if($movimientos[$i]["vendedor"] != "ZZ"){

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-success btnEstadoCtaVdor' title='Descargar Estado de Cuenta' vendedor=".$movimientos[$i]['vendedor']."><i class='fa fa-download'></i></button><button class='btn btn-xs btn-danger btnEstadoCtaVdorVdos' title='Descargar Estado de Cuenta Vencidos' vendedor=".$movimientos[$i]['vendedor']."><i class='fa fa-download'></i></button></div>"; 

            }else{

                $botones =  "<div class='btn-group'></div>"; 

            }

            $datosJson .= '[
            "'.$movimientos[$i]["vendedor"].'",
            "'.$movimientos[$i]["nom_vendedor"].'",
            "'.$facturas.'",
            "'.$guias.'",
            "'.$letras.'",
            "'.$total.'",
            "'.$botones.'"
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