<?php

require_once "../../controladores/movimientos.controlador.php";
require_once "../../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMovimientos(){

        $movimientos = ControladorMovimientos::ctrMostrarTotales();	
        if(count($movimientos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

            /* 
            todo: RESALTAMOS EL NOMBRE DEL MES
            */

            $nombre_mes = "<label>".$movimientos[$i]["nom_mes"]."</labe>";
    
            /* 
            todo: TRAEMOS LOS BOTONES
            */       
            
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-success btnActualizarMes' año='".$movimientos[$i]["año"]."' mes='".$movimientos[$i]["mes"]."'><i class='fa fa-refresh'></i></button></div>"; 

                $datosJson .= '[
                "'.($i+1).'",
                "'.$movimientos[$i]["año"].'",
                "'.$movimientos[$i]["mes"].'",
                "'.$nombre_mes.'",
                "'.number_format($movimientos[$i]["ventas"],0).' UND",
                "'.number_format($movimientos[$i]["produccion"],0).' UND",
                "S/ '.number_format($movimientos[$i]["ventasSoles"],2).'",
                "S/ '.number_format($movimientos[$i]["pagosSoles"],2).'",
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