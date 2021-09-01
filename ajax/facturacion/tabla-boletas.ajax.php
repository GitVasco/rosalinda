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
            if($boletas[$i]["facturacion"] == "0"){

                $estado = "<span style='font-size:85%' class='label label-success'>GENERADO</span>";
                
            }else if($boletas[$i]["facturacion"] == "1"){

                $estado = "<span style='font-size:85%' class='label label-warning'>ERROR</span>";

            }else if($boletas[$i]["facturacion"] == "2"){

                $estado = "<span style='font-size:85%' class='label label-primary'>ENVIADO</span>";

            }else if($boletas[$i]["facturacion"] == "4"){

                $estado = "<span class='btn btn-danger btn-xs btn btnEliminarDocumento' documento='".$boletas[$i]["documento"]."' tipo='".$boletas[$i]["tipo"]."' pagina='facturas'>ANULADO</span>";

            }

            $total = "<div style='text-align:right !important'>".number_format($boletas[$i]["total"],2)."</div>";

            if($boletas[$i]["facturacion"] == "0"){

                $botones =  "<div class='btn-group'><button title='Editar Documento' class='btn btn-xs  btn-warning btnEditarDocumentoCV' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-pencil-square-o'></i></button><button title='Imprimir Factura' class='btn btn-xs btn-success btnImprimirBoleta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-print'></i></button><button title='Anular Documento' class='btn btn-xs  btn-danger btnAnularDocumento' documento='".$boletas[$i]["documento"]."' tipo='".$boletas[$i]["tipo"]."' pagina='facturas'><i class='fa fa-close'></i></button></div>";

            }else{

                $botones =  "<div class='btn-group'><button title='Imprimir Factura' class='btn btn-xs btn-success btnImprimirBoleta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-print'></i></button></div>";

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