<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaMateriaPrimaTarjetas{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMateriaPrimaTarjetas(){
   
        $valor = null;

        $materiaprima = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);	
        if(count($materiaprima)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($materiaprima); $i++){

    
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarMP recuperarBoton' idMateriaPrima='".$materiaprima[$i]["codigo"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>"; 

            $datosJson .= '[
            "'.$materiaprima[$i]["codlinea"].'",
            "'.$materiaprima[$i]["codigo"].'",
            "'.$materiaprima[$i]["descripcion"].'",
            "'.$materiaprima[$i]["color"].'",
            "'.$materiaprima[$i]["unidad"].'",
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
ACTIVAR TABLA DE MATERIA PRIMA TARJETAS
=============================================*/ 
$activarMateriaPrimaTarjetas = new TablaMateriaPrimaTarjetas();
$activarMateriaPrimaTarjetas -> mostrarTablaMateriaPrimaTarjetas();