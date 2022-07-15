<?php

require_once "../../controladores/servicio.controlador.php";
require_once "../../modelos/servicio.modelo.php";

class TablaPrecioServicios{

    /*=============================================
    MOSTRAR LA TABLA DE PRECIO DE SERVICIOS
    =============================================*/ 

    public function mostrarTablaPrecioServicios(){

        $item = null;     
        $valor = null;

        $precio = ControladorServicios::ctrMostrarPrecioServicios($item, $valor);	
        if(count($precio)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($precio); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarPrecioServicio' idPrecioServicio='".$precio[$i]["id"]."' data-toggle='modal' data-target='#modalEditarPrecioServicio'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarPrecioServicio' idPrecioServicio='".$precio[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

        $sector = $precio[$i]["taller"].' - '.$precio[$i]["nom_sector"];

            $datosJson .= '[
            "'.$sector.'",
            "'.$precio[$i]["modelo"].'",
            "'.$precio[$i]["nombre"].'",
            "'.$precio[$i]["precio_doc"].'",
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
ACTIVAR TABLA DE PRECIO SERVICIOS
=============================================*/ 
$activarPrecioServicios = new TablaPrecioServicios();
$activarPrecioServicios -> mostrarTablaPrecioServicios();

