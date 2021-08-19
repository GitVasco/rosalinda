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

        if($proformas[$i]["doc_destino"] != ""){
            $botones =  "<div class='btn-group'><button title='Facturar Pedido' class='btn btn-xs btn-primary btnFacturarA' documento='".$proformas[$i]["documento"]."' cod_cli='".$proformas[$i]["cliente"]."'  nom_cli='".$proformas[$i]["nombre"]."' tip_doc='".$proformas[$i]["tip_doc"]."' nro_doc='".$proformas[$i]["num_doc"]."' cod_ven='".$proformas[$i]["vendedor"]."' serie_dest='".$proformas[$i]["serie_dest"]."' nro_dest='".$proformas[$i]["nro_dest"]."' data-toggle='modal' data-target='#modalFacturarA'><i class='fa fa-paper-plane'></i></button><button title='Imprimir Proforma' class='btn btn-xs btn-success btnImprimirProforma' tipo='".$proformas[$i]["tipo"]."' documento='".$proformas[$i]["documento"]."'><i class='fa fa-print'></i></button></div>";
        }else{

            $botones =  "<div class='btn-group'><button title='Facturar Pedido' class='btn btn-xs btn-primary btnFacturarB' documento='".$proformas[$i]["documento"]."' cod_cli='".$proformas[$i]["cliente"]."'  nom_cli='".$proformas[$i]["nombre"]."' tip_doc='".$proformas[$i]["tip_doc"]."' nro_doc='".$proformas[$i]["num_doc"]."' cod_ven='".$proformas[$i]["vendedor"]."' data-toggle='modal' data-target='#modalFacturarB'><i class='fa fa-paper-plane'></i></button><button title='Imprimir Proforma' class='btn btn-xs btn-success btnImprimirProforma' tipo='".$proformas[$i]["tipo"]."' documento='".$proformas[$i]["documento"]."'><i class='fa fa-print'></i></button></div>";

        }


            $datosJson .= '[
            "'.$proformas[$i]["tipo_documento"].'",
            "<b>'.$proformas[$i]["documento"].'</b>",
            "'.$proformas[$i]["total"].'",
            "'.$proformas[$i]["cliente"].'",
            "<b>'.$proformas[$i]["nombre"].'</b>",
            "'.$proformas[$i]["vendedor"].'",
            "'.$proformas[$i]["fecha"].'",
            "'.$proformas[$i]["doc_destino"].'",
            "'.$proformas[$i]["estado"].'",
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