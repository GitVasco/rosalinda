<?php

require_once "../../controladores/unidadmedida.controlador.php";
require_once "../../modelos/unidadmedida.modelo.php";

class TablaUnidadMedidas{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaUnidadMedidas(){

        $item = null;     
        $valor = null;

        $unidadesmedida = ControladorUnidadMedidas::ctrMostrarUnidadMedidas($item, $valor);	
        if(count($unidadesmedida)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($unidadesmedida); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarUnidadMedida' idUnidadMedida='".$unidadesmedida[$i]["id"]."' data-toggle='modal' data-target='#modalEditarUnidadMedida'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarUnidadMedida' idUnidadMedida='".$unidadesmedida[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$unidadesmedida[$i]["codigo"].'",
            "'.$unidadesmedida[$i]["descripcion"].'",
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
ACTIVAR TABLA DE UNIDADES DE MEDIDA
=============================================*/ 
$activarUnidadMedidas = new TablaUnidadMedidas();
$activarUnidadMedidas -> mostrarTablaUnidadMedidas();

