<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaUrgenciasAMP{


    public function mostrarUrgenciasAMP(){

        $valor = null;
        $mp = ControladorMateriaPrima::ctrMostrarUrgenciaAMP($valor);	

        #var_dump("mp", $mp);
        if(count($mp)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($mp); $i++){

              
            /* 
            todo: BOTONES
            */                
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-info btnVerUrgenciasAMP' codigoAMP='".$mp[$i]["mat_pri"]."' data-toggle='modal' data-target='#modalVisualizarUrgenciasAMP'><i class='fa fa-eye'></i></button></div>"; 
            
                $datosJson .= '[
                "'.$mp[$i]["mat_pri"].'",
                "'.$mp[$i]["linea"].'",
                "'.$mp[$i]["codfab"].'",
                "'.$mp[$i]["descripcion"].'",
                "'.$mp[$i]["color"].'",
                "'.$mp[$i]["unidad"].'",
                "'.$mp[$i]["items"].'",
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
ACTIVAR TABLA DE URGENCIAS AMP
=============================================*/ 
$activarUrgenciasAMP = new TablaUrgenciasAMP();
$activarUrgenciasAMP -> mostrarUrgenciasAMP();