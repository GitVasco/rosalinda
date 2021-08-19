<?php

require_once "../../controladores/ingresos.controlador.php";
require_once "../../modelos/ingresos.modelo.php";

class TablaIngresos{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaIngresos(){

        $ingreso = ControladorIngresos::ctrRangoFechasIngresos($_GET["fechaInicial"],$_GET["fechaFinal"]);
        // $ingreso = ControladorOrdenCorte::ctrRangoFechasOrdenCortes($item,$valor);
        
        if(count($ingreso)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($ingreso); $i++){

            /*
            todo: ESTADO
            */
            if($ingreso[$i]["almacen"] == "01"){


                $estado = "<span style='font-size:85%' class='label label-info'>APT</span>";
    
            }else{
    
                $estado = "<span style='font-size:85%' class='label label-danger'>SEGUNDA</span>";
    
            }       
              
                   
            /* 
            todo: formato de miles
            */
            $total = number_format($ingreso[$i]["total"],0);
            if($ingreso[$i]["almacen"]=="01"){
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-primary  btnVisualizarIngreso' title='Visualizar Ingreso stock' data-toggle='modal' data-target='#modalVisualizarIngreso' documentoIngreso='".$ingreso[$i]["documento"]."'><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning  btnEditarIngStock' title='Editar Ingreso stock' idIngreso='".$ingreso[$i]["id"]."' sectorIngreso='".$ingreso[$i]["taller"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger  btnEliminarIngStock' title='Eliminar Ingreso stock' idIngreso='".$ingreso[$i]["id"]."' documento='".$ingreso[$i]["documento"]."'><i class='fa fa-times'></i></button><button class='btn btn-xs btn-outline-success  btnReporteIngresoStock'  documento='".$ingreso[$i]["documento"]."' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='17px'></button></div>";

            }else{
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-primary  btnVisualizarIngreso' title='Visualizar Segunda' data-toggle='modal' data-target='#modalVisualizarIngreso' documentoIngreso='".$ingreso[$i]["documento"]."'><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning  btnEditarSegunda' title='Editar Segunda' idIngreso='".$ingreso[$i]["id"]."'sectorIngreso='".$ingreso[$i]["taller"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger  btnEliminarSegunda' title='Eliminar segunda' idSegunda='".$ingreso[$i]["id"]."' documento='".$ingreso[$i]["documento"]."'><i class='fa fa-times'></i></button><button class='btn btn-xs btn-outline-success  btnReporteIngresoStock'  documento='".$ingreso[$i]["documento"]."' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='17px'></button></div>";
            }
            
            


                $datosJson .= '[
                "'.($i+1).'",
                "'.$ingreso[$i]["tipo"].'",
                "'.$ingreso[$i]["nombre"].'",
                "'.$ingreso[$i]["guia"].'",
                "'.$ingreso[$i]["taller"]." - ".$ingreso[$i]["nom_sector"].'",
                "'.$ingreso[$i]["documento"].'",
                "'.$total.'",
                "'.$ingreso[$i]["fecha"].'",
                "'.$estado.'",
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
ACTIVAR TABLA DE orden$ingreso
=============================================*/ 
$activarIngreso = new TablaIngresos();
$activarIngreso -> mostrarTablaIngresos();