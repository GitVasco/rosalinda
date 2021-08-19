<?php

require_once "../../controladores/pedidos.controlador.php";
require_once "../../modelos/pedidos.modelo.php";

class TablaPedidosCV{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaPedidosCV(){

        $valor = 'apt';

        $pedidos = ControladorPedidos::ctrMostraPedidosTablas($valor);

        if(count($pedidos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($pedidos); $i++){

            /*
            * ESTADOS
            */
            if($pedidos[$i]["estado"] == "GENERADO"){

                $estado = "<button class='btn btn-basic btn-xs btnAprobarPedido' codigo='".$pedidos[$i]["codigo"]."' estadoPedido='APROBADO'>GENERADO</button>";

            }else if($pedidos[$i]["estado"] == "APROBADO"){

                $estado = "<button class='btn btn-warning btn-xs btnAptear' codigo='".$pedidos[$i]["codigo"]."' estadoPedido='APT'>APROBADO</button>";

            }else if($pedidos[$i]["estado"] == "APT"){

                $estado = "<button class='btn btn-default btn-xs btn  btnConfirmar' codigo='".$pedidos[$i]["codigo"]."' estadoPedido='CONFIRMADO'>APT</button>";

            }else if($pedidos[$i]["estado"] == "CONFIRMADO"){

                $estado = "<button class='btn btn-info btn-xs btn btnFacturar' codigo='".$pedidos[$i]["codigo"]."' estadoPedido='FACTURADO'>CONFIRMADO</button>";

            }else{

                $estado = "<button class='btn btn-success btn-xs btn' codigo='".$pedidos[$i]["codigo"]."' estadoPedido='FACTURADO'>FACTURADO</button>";

            }

            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/

            $botones =  "<div class='btn-group'><button title='Editar Pedido' class='btn-xs btn-warning btnEditarPedidoCV' codigo='".$pedidos[$i]["codigo"]."'><i class='fa fa-pencil-square-o'></i></button><button title='Imprimir Pedido' class='btn btn-xs btn-success btnImprimirPedido' codigo='".$pedidos[$i]["codigo"]."'><i class='fa fa-print'></i></button><button title='Facturar Pedido' class='btn btn-xs btn-primary btnFacturar' codigo='".$pedidos[$i]["codigo"]."' cod_cli='".$pedidos[$i]["cod_cli"]."'  nom_cli='".$pedidos[$i]["nombre"]."' tip_doc='".$pedidos[$i]["tipo_documento"]."' nro_doc='".$pedidos[$i]["documento"]."' dscto='".$pedidos[$i]["dscto"]."' cod_ven='".$pedidos[$i]["vendedor"]."' data-toggle='modal' data-target='#modalFacturar'><i class='fa fa-paper-plane'></i></button></div>";

            $datosJson .= '[
            "'.($i+1).'",
            "<b>'.$pedidos[$i]["codigo"].'</b>",
            "'.$pedidos[$i]["cod_cli"].'",
            "<b>'.$pedidos[$i]["nombre"].'</b>",
            "'.$pedidos[$i]["vendedor"].'",
            "<b>S/ '.$pedidos[$i]["total"].'</b>",
            "'.$pedidos[$i]["descripcion"].'",
            "'.$estado.'",
            "'.$pedidos[$i]["nom_usu"].'",
            "'.$pedidos[$i]["fecha"].'",
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
$activarArticulosPedidos = new TablaPedidosCV();
$activarArticulosPedidos -> mostrarTablaPedidosCV();