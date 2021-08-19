<?php

require_once "../../controladores/tipomovimiento.controlador.php";
require_once "../../modelos/tipomovimiento.modelo.php";

class TablaTipoMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE TIPO DE MOVIMIENTO
    =============================================*/ 

    public function mostrarTablaTipoMovimientos(){

        $item = null;     
        $valor = null;

        $tipomovimiento = ControladorTipoMovimientos::ctrMostrarTipoMovimientos($item, $valor);	
        if(count($tipomovimiento)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($tipomovimiento); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarTipoMovimiento' idTipoMovimiento='".$tipomovimiento[$i]["id"]."' data-toggle='modal' data-target='#modalEditarTipoMovimiento'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarTipoMovimiento' idTipoMovimiento='".$tipomovimiento[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$tipomovimiento[$i]["codigo"].'",
            "'.$tipomovimiento[$i]["descripcion"].'",
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
ACTIVAR TABLA DE TIPO DE MOVIMIENTO
=============================================*/ 
$activarTipoMovimientos = new TablaTipoMovimientos();
$activarTipoMovimientos -> mostrarTablaTipoMovimientos();

