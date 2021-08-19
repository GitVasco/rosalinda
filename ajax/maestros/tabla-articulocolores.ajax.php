<?php

require_once "../../controladores/colores.controlador.php";
require_once "../../modelos/colores.modelo.php";

class TablaArticuloColores{

    /*=============================================
    MOSTRAR LA TABLA DE GENERAR ARTICULO COLORES
    =============================================*/ 

    public function mostrarTablaArticuloColores(){

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
        
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs recuperarBoton  agregarColor' idColor='".$color[$i]["cod_color"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>"; 

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
ACTIVAR TABLA PARA GENERAR ARTICULOS CON COLORES
=============================================*/ 
$activarArticuloColores = new TablaArticuloColores();
$activarArticuloColores -> mostrarTablaArticuloColores();

