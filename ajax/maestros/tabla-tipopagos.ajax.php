<?php

require_once "../../controladores/tipopago.controlador.php";
require_once "../../modelos/tipopago.modelo.php";

class TablaTipoPagos{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaTipoPagos(){

        $item = null;     
        $valor = null;

        $tipopago = ControladorTipoPagos::ctrMostrarVariosPagos($item, $valor);	
        if(count($tipopago)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($tipopago); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarTipoPago' idTipoPago='".$tipopago[$i]["id"]."' data-toggle='modal' data-target='#modalEditarTipoPago'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarTipoPago' idTipoPago='".$tipopago[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$tipopago[$i]["codigo"].'",
            "'.$tipopago[$i]["descripcion"].'",
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
ACTIVAR TABLA DE TIPO DE PAGO
=============================================*/ 
$activarTipoPagos = new TablaTipoPagos();
$activarTipoPagos -> mostrarTablaTipoPagos();

