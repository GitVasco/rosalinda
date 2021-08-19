<?php

require_once "../../controladores/condicionventa.controlador.php";
require_once "../../modelos/condicionventa.modelo.php";

class TablaCondicionVentas{

    /*=============================================
    MOSTRAR LA TABLA DE CONDICIONES DE VENTA
    =============================================*/ 

    public function mostrarTablaCondicionVentas(){

        $item = null;     
        $valor = null;

        $CondicionVenta = ControladorCondicionVentas::ctrMostrarCondicionVentas($item, $valor);	
        if(count($CondicionVenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($CondicionVenta); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarCondicionVenta' idCondicionVenta='".$CondicionVenta[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCondicionVenta'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarCondicionVenta' idCondicionVenta='".$CondicionVenta[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$CondicionVenta[$i]["codigo"].'",
            "'.$CondicionVenta[$i]["descripcion"].'",
            "'.$CondicionVenta[$i]["cta_cte"].'",
            "'.$CondicionVenta[$i]["dias"].'",
            "'.$CondicionVenta[$i]["letras"].'",
            "'.$CondicionVenta[$i]["dscto"].'",
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
ACTIVAR TABLA DE CONDICION DE VENTA
=============================================*/ 
$activarCondicionVentas = new TablaCondicionVentas();
$activarCondicionVentas -> mostrarTablaCondicionVentas();

