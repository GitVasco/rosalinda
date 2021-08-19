<?php

require_once "../../controladores/operaciones.controlador.php";
require_once "../../modelos/operaciones.modelo.php";

class TablaOperacionesModelos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 
    public $modeloDetalle;

    public function mostrarTablaOperacionesModelos(){

        $item="modelo";
        $valor = $this->modeloDetalle;
    
        $operaciones = ControladorOperaciones::ctrVisualizarOperacionDetalle($item,$valor);
        if(count($operaciones)>0){


        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($operaciones); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        

            $datosJson .= '[
            "'.$operaciones[$i]["cod_operacion"].'",
            "'.$operaciones[$i]["nombre"].'",
            "'.$operaciones[$i]["precio_doc"].'",
            "'.$operaciones[$i]["tiempo_stand"].'"
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
MOSTRARAR TABLA DE OPERACIONES MODELOS
=============================================*/ 

if(isset($_POST["modeloDetalle"])){

	$activarOperacionesModelos = new TablaOperacionesModelos();
	$activarOperacionesModelos -> modeloDetalle = $_POST["modeloDetalle"];
	$activarOperacionesModelos -> mostrarTablaOperacionesModelos();;
}
