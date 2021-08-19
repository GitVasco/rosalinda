<?php

require_once "../../controladores/tarjetas.controlador.php";
require_once "../../modelos/tarjetas.modelo.php";

class TablaFichaTecnica{
 /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaFichaTecnica(){

        $item = null;     
        $valor = null;

        $fichaTecnica = ControladorTarjetas::ctrRangoFechasFichas($_GET["fechaInicial"],$_GET["fechaFinal"]);	
        if(count($fichaTecnica)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($fichaTecnica); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><a class='btn btn-xs btn-success' href='vistas/fichas/".$fichaTecnica[$i]["archivo"]."' download title='Descargar ficha tecnica'><i class='fa fa-download'></i></a></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$fichaTecnica[$i]["codigo"].'",
            "'.$fichaTecnica[$i]["codigotarjeta"].'",
            "'.$fichaTecnica[$i]["modelo"].'",
            "'.$fichaTecnica[$i]["archivo"].'",
            "'.$fichaTecnica[$i]["fecha_cambio"].'",
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
$activarFichaTecnica = new TablaFichaTecnica();
$activarFichaTecnica -> mostrarTablaFichaTecnica();