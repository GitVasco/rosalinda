<?php

require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";

class TablaTalleresT{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaTalleresT(){

        $talleres = ControladorTalleres::ctrMostrarTalleresT();	
        if(count($talleres)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($talleres); $i++){

            /*
            todo: ESTADO
            */
            if($talleres[$i]["estado"] == "1"){


                $estado = "<span style='font-size:85%' class='label label-info'>Generado</span>";
    
            }elseif($talleres[$i]["estado"] == "2"){
    
                $estado = "<span style='font-size:85%' class='label label-primary'>En Proceso</span>";
    
            }else{
    
                $estado = "<span style='font-size:85%' class='label label-success'>Terminado</span>";
    
            }       
              

            $datosJson .= '[
            "'.$talleres[$i]["codigo"].'",
            "'.$talleres[$i]["trabajador"].'",
            "'.$talleres[$i]["operacion"].'",
            "'.$talleres[$i]["articulo"].'",
            "'.$talleres[$i]["cantidad"].'",
            "'.$estado.'",
            "'.$talleres[$i]["hora_termino"].'"
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarTalleresT = new TablaTalleresT();
$activarTalleresT -> mostrarTablaTalleresT();