<?php

require_once "../../controladores/movimientos.controlador.php";
require_once "../../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMovimientos(){

        $movimientos = ControladorMovimientos::ctrMostrarDias();	
        if(count($movimientos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

            /* 
            todo: TRAEMOS LOS BOTONES
            */       
            
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-success btnActualizarMes' fecha='".$movimientos[$i]["fecha"]."'><i class='fa fa-refresh'></i></button></div>"; 

                $datosJson .= '[
                "'.$movimientos[$i]["fecha"].'",
                "'.$movimientos[$i]["año"].'",
                "'.$movimientos[$i]["mes"].'",
                "'.$movimientos[$i]["nom_mes"].'",
                "'.$movimientos[$i]["dia"].'",
                "'.$movimientos[$i]["total_ventas"].'",
                "'.$movimientos[$i]["total_produccion"].'",
                "'.$movimientos[$i]["total_ventas_soles"].'",
                "'.$movimientos[$i]["total_pagos_soles"].'",
                "'.$movimientos[$i]["cambio_compra"].'",
                "'.$movimientos[$i]["cambio_venta"].'",
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