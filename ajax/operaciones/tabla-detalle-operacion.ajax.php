<?php

require_once "../../controladores/operaciones.controlador.php";
require_once "../../modelos/operaciones.modelo.php";

class TablaOperaciones{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaOperaciones(){

        $item = null;     
        $valor = null;

        $operaciones = ControladorOperaciones::ctrMostrarOperaciones($item, $valor);	
        if(count($operaciones)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($operaciones); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs recuperarBoton   agregarOperacion' idOperacion='".$operaciones[$i]["id"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>"; 

            $datosJson .= '[
            "'.$operaciones[$i]["codigo"].'",
            "'.$operaciones[$i]["nombre"].'",
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
ACTIVAR TABLA DE OPERACIONES
=============================================*/ 
$activarOperaciones = new TablaOperaciones();
$activarOperaciones -> mostrarTablaOperaciones();

