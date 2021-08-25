<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaGuiasRemision{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaGuiasRemision(){

        $boletas = ControladorFacturacion::ctrRangoFechasBoletas($_GET["fechaInicial"],$_GET["fechaFinal"]);

        if(count($boletas)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($boletas); $i++){

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

            /* 
            *estado
            */
            if($boletas[$i]["estado"] == "GENERADO"){

                $estado = "<span style='font-size:85%' class='label label-success'>GENERADO</span>";
                
            }else if($boletas[$i]["estado"] == "ANULADO"){

                $estado = "<span class='btn btn-danger btn-xs btn btnEliminarDocumento' documento='".$boletas[$i]["documento"]."' tipo='".$boletas[$i]["tipo"]."' pagina='boletas'>ANULADO</span>";

            }

            $total = "<div style='text-align:right !important'>".number_format($boletas[$i]["total"],2)."</div>";        

        if($boletas[$i]["estado"] == "GENERADO"){
            $botones =  "<div class='btn-group'><button title='Imprimir Boleta' class='btn btn-xs btn-success btnImprimirBoleta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-print'></i></button><button title='Anular Documento' class='btn btn-xs  btn-danger btnAnularDocumento' documento='".$boletas[$i]["documento"]."' tipo='".$boletas[$i]["tipo"]."' pagina='boletas'><i class='fa fa-close'></i></button></div>";
        }else{

            $botones =  "<div class='btn-group'><button title='Imprimir Boleta' class='btn btn-xs btn-success btnImprimirBoleta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-print'></i></button></div>";

        }


            $datosJson .= '[
            "'.$boletas[$i]["tipo_documento"].'",
            "<b>'.$boletas[$i]["documento"].'</b>",
            "'.$total.'",
            "'.$boletas[$i]["cliente"].'",
            "<b>'.$boletas[$i]["nombre"].'</b>",
            "'.$boletas[$i]["vendedor"].'",
            "'.$boletas[$i]["fecha"].'",
            "'.$boletas[$i]["doc_destino"].'",
            "'.$estado.'",
            "'.$boletas[$i]["agencia"].'",
            "'.$boletas[$i]["ubigeo"].'",
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
ACTIVAR TABLA DE articulos
=============================================*/
$activarArticulosPedidos = new TablaGuiasRemision();
$activarArticulosPedidos -> mostrarTablaGuiasRemision();