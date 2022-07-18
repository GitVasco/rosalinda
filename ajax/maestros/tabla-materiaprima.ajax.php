<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){

        $valor = null;

        $materiaprima = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);	
        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

                $descripcion = str_replace('"','',$materiaprima[$i]["descripcion"]);


            /*=============================================
            PROMEDIO
            =============================================*/ 
            if($materiaprima[$i]["prom"] >= $materiaprima[$i]["stock"] ){

                $prom = "<span style='font-size:85%' class='label label-danger'>".$materiaprima[$i]["prom"]."</span>";

            }else{

                $prom = "<span style='font-size:85%' class='label label-warning'>".$materiaprima[$i]["prom"]."</span>";

            }  
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                $botones = "<div class='btn-group'><button class='btn btn-xs btn-info btnVisualizarArticulos' title='Visualizar Articulos' data-toggle='modal' data-target='#modalVisualizarArticulos' articuloMP='".$materiaprima[$i]["codigo"]."'><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning btnEditarMateriaPrima' idMateriaPrima='".$materiaprima[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarMateriaPrima'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-primary btnEditarCosto' title='Visualizar Costo' data-toggle='modal' data-target='#modalEditarCostos' materiaPrima='".$materiaprima[$i]["codigo"]."'><i class='fa fa-money'></i></button></div>";
    
                $datosJson .= '[
                "'.($i+1).'",
                "'.$materiaprima[$i]["codigo"].'",
                "'.$materiaprima[$i]["codlinea"].'",
                "'.$materiaprima[$i]["linea"].'",
                "'.$descripcion.'",
                "'.$materiaprima[$i]["color"].'",
                "'.$materiaprima[$i]["stock"].'",
                "'.$prom.'",
                "'.$materiaprima[$i]["unidad"].'",
                "'.$materiaprima[$i]["cospro"].'",
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
ACTIVAR TABLA DE MATERIA PRIMA
=============================================*/ 
$activarMateriaPrima = new TablaMateriaPrima();
$activarMateriaPrima -> mostrarTablaMateriaPrima();