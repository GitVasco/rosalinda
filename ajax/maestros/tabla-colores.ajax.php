<?php

require_once "../../controladores/colores.controlador.php";
require_once "../../modelos/colores.modelo.php";

class TablaColores{

    /*=============================================
    MOSTRAR LA TABLA DE COLORES
    =============================================*/ 

    public function mostrarTablaColores(){

        $item = null;     
        $valor = null;

        $color = ControladorColores::ctrMostrarColores($item, $valor);	
        if(count($color)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($color); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarColor' idColor='".$color[$i]["cod_color"]."' data-toggle='modal' data-target='#modalEditarColor'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarColor' idColor='".$color[$i]["cod_color"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.$color[$i]["cod_color"].'",
            "'.$color[$i]["nom_color"].'",
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
ACTIVAR TABLA DE COLORES
=============================================*/ 
$activarColores = new TablaColores();
$activarColores -> mostrarTablaColores();

