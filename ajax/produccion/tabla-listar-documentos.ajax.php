<?php

require_once "../../controladores/salidas.controlador.php";
require_once "../../modelos/salidas.modelo.php";

class TablaListarDocumentos{

    /*=============================================
    MOSTRAR LA TABLA DE LISTAR DOCUMENTOS
    =============================================*/

    public function mostrarTablaListarDocumentos(){

        $valor = null;

        $salidas = ControladorSalidas::ctrListarDocumentos($valor);

        if(count($salidas)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($salidas); $i++){

            /*
            * ESTADOS
            */
            if($salidas[$i]["estado"] == "GENERADO"){

                $estado = "<button class='btn btn-basic btn-xs ' codigo='".$salidas[$i]["documento"]."' estadoPedido='APROBADO'>GENERADO</button>";

            }else if($salidas[$i]["estado"] == "APROBADO"){

                $estado = "<button class='btn btn-warning btn-xs ' codigo='".$salidas[$i]["documento"]."' estadoPedido='APT'>APROBADO</button>";

            }else if($salidas[$i]["estado"] == "APT"){

                $estado = "<button class='btn btn-default btn-xs btn  ' codigo='".$salidas[$i]["documento"]."' estadoPedido='CONFIRMADO'>APT</button>";

            }else if($salidas[$i]["estado"] == "CONFIRMADO"){

                $estado = "<button class='btn btn-info btn-xs btn ' codigo='".$salidas[$i]["documento"]."' estadoPedido='FACTURADO'>CONFIRMADO</button>";

            }else{

                $estado = "<button class='btn btn-success btn-xs btn' codigo='".$salidas[$i]["documento"]."' estadoPedido='FACTURADO'>FACTURADO</button>";

            }

            
            $botones="<div class='btn-group'><button class='btn btn-xs btn-primary  btnVisualizarDocumento' title='Visualizar Documento' data-toggle='modal' data-target='#modalVisualizarDocumentos' documento='".$salidas[$i]["documento"]."'><i class='fa fa-eye'></i></button></div>";
            $datosJson .= '[
            "'.($i+1).'",
            "'.$salidas[$i]["tipo"].'",
            "'.$salidas[$i]["documento"].'",
            "'.$salidas[$i]["tipo_documento"].'</b>",
            "'.$salidas[$i]["doc_origen"].'",
            "'.$salidas[$i]["total"].'</b>",
            "'.$estado.'",
            "'.$salidas[$i]["nombre"].'",
            "'.$salidas[$i]["fecha"].'",
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
ACTIVAR TABLA DE LISTAR DOCUMENTOS
=============================================*/
$activarListarDocumentos = new TablaListarDocumentos();
$activarListarDocumentos -> mostrarTablaListarDocumentos();