<?php

require_once "../../controladores/produccion.controlador.php";
require_once "../../modelos/produccion.modelo.php";

class TablaQuincena{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaQuincena(){

        $valor = null;

        $quincena = ControladorProduccion::ctrMostrarQuincenas($valor);	

        if(count($quincena)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($quincena); $i++){

            /* 
            * BOTONES            
            */
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarQuincena' title='Editar Fechas' id='".$quincena[$i]["id"]."' data-toggle='modal' data-target='#modalEditarQuincena'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-success btnEficiencia' title='Eficiencia' inicio='".$quincena[$i]["inicio"]."' fin='".$quincena[$i]["fin"]."' nquincena='".$quincena[$i]["nquincena"]."' id='".$quincena[$i]["id"]."'><i class='fa fa-percent'></i></button><button class='btn btn-xs btn-primary btnPagos' title='Pagos' inicio='".$quincena[$i]["inicio"]."' fin='".$quincena[$i]["fin"]."' nquincena='".$quincena[$i]["nquincena"]."' id='".$quincena[$i]["id"]."'><i class='fa fa-money'></i></button><button class='btn btn-xs btn-danger btnEliminarQuincena' title='Eliminar' id='".$quincena[$i]["id"]."'><i class='fa fa-times'></i></button></div>";
            
            /* 
            *trusas
            */

            $trusas = "<button class='btn btn-outline-success  btnReportePagosTrusas' title='Reporte de Pagos Trusas' id='".$quincena[$i]["id"]."' inicio='".$quincena[$i]["inicio"]."' fin='".$quincena[$i]["fin"]."' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='17px'></button>";

            /* 
            *brasier
            */
            $brasier = "<button class='btn btn-outline-success  btnReportePagosBrasier' title='Reporte de Pagos Brasier' id='".$quincena[$i]["id"]."' inicio='".$quincena[$i]["inicio"]."' fin='".$quincena[$i]["fin"]."' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='17px'></button>";
     
            $datosJson .= '[
            "'.($i+1).'",
            "'.$quincena[$i]["ano"].'",
            "'.$quincena[$i]["mes"].'",
            "'.$quincena[$i]["quincena"].'",
            "'.$quincena[$i]["inicio"].'",
            "'.$quincena[$i]["fin"].'",
            "'.$quincena[$i]["nombre"].'",
            "'.$quincena[$i]["fecha_creacion"].'",
            "'.$botones.'",
            "<center>'.$trusas.'</center>",
            "<center>'.$brasier.'</center>"
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
ACTIVAR TABLA DE ARTICULOS
=============================================*/ 
$activarArticulos = new TablaQuincena();
$activarArticulos -> mostrarTablaQuincena();