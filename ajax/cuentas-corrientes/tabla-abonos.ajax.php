<?php

require_once "../../controladores/abonos.controlador.php";
require_once "../../modelos/abonos.modelo.php";

class TablaAbonos{

    /*=============================================
    MOSTRAR LA TABLA DE ABONOS
    =============================================*/ 

    public function mostrarTablaAbonos(){

        $item = null;     
        $valor = null;

        $abono = ControladorAbonos::ctrMostrarAbonos($item, $valor);	
        if(count($abono)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($abono); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarAbono' idAbono='".$abono[$i]["id"]."' data-toggle='modal' data-target='#modalEditarAbono'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarAbono' idAbono='".$abono[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.$abono[$i]["fecha"].'",
            "'.$abono[$i]["descripcion"].'",
            "S/.'.$abono[$i]["monto"].'",
            "'.$abono[$i]["agencia"].'",
            "'.$abono[$i]["num_ope"].'",
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
ACTIVAR TABLA DE ABONO
=============================================*/ 
$activarAbonos = new TablaAbonos();
$activarAbonos -> mostrarTablaAbonos();

