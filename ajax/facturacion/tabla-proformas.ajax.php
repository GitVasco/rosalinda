<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaProformas{

    /*=============================================
    MOSTRAR LA TABLA DE PROFORMAS
    =============================================*/

    public function mostrarTablaProformas(){


        $proformas = ControladorFacturacion::ctrRangoFechasProformas($_GET["fechaInicial"],$_GET["fechaFinal"]);

        if(count($proformas)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($proformas); $i++){

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

            /* 
            *estado
            */
            if($proformas[$i]["estado"] == "GENERADO"){

                $estado = "<span style='font-size:85%' class='label label-success'>GENERADO</span>";
                
            }else if($proformas[$i]["estado"] == "ANULADO"){

                $estado = "<span class='btn btn-danger btn-xs btn btnEliminarDocumento' documento='".$proformas[$i]["documento"]."' tipo='".$proformas[$i]["tipo"]."' pagina='proformas'>ANULADO</span>";

            }

            $total = "<div style='text-align:right !important'>".number_format($proformas[$i]["total"],2)."</div>";        

        if($proformas[$i]["estado"] == "GENERADO"){
            $botones =  "<div class='btn-group'><button title='Imprimir Proforma' class='btn btn-xs btn-success btnImprimirProforma' tipo='".$proformas[$i]["tipo"]."' documento='".$proformas[$i]["documento"]."'><i class='fa fa-print'></i></button><button title='Anular Documento' class='btn btn-xs  btn-danger btnAnularDocumento' documento='".$proformas[$i]["documento"]."' tipo='".$proformas[$i]["tipo"]."' pagina='proformas'><i class='fa fa-close'></i></button></div>";
        }else{

            $botones =  "<div class='btn-group'><button title='Imprimir Proforma' class='btn btn-xs btn-success btnImprimirProforma' tipo='".$proformas[$i]["tipo"]."' documento='".$proformas[$i]["documento"]."'><i class='fa fa-print'></i></button></div>";

        }


            $datosJson .= '[
            "'.$proformas[$i]["tipo_documento"].'",
            "<b>'.$proformas[$i]["documento"].'</b>",
            "'.$total.'",
            "'.$proformas[$i]["cliente"].'",
            "<b>'.$proformas[$i]["nombre"].'</b>",
            "'.$proformas[$i]["vendedor"].'",
            "'.$proformas[$i]["fecha"].'",
            "'.$proformas[$i]["doc_destino"].'",
            "'.$estado.'",
            "'.$proformas[$i]["agencia"].'",
            "'.$proformas[$i]["ubigeo"].'",
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
ACTIVAR TABLA DE PROFORMAS
=============================================*/
$activarTablaProformas = new TablaProformas();
$activarTablaProformas -> mostrarTablaProformas();