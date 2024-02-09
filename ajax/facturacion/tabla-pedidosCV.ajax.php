<?php

require_once "../../controladores/pedidos.controlador.php";
require_once "../../modelos/pedidos.modelo.php";

class TablaPedidosCV
{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaPedidosCV()
    {

        $valor = null;

        $pedidos = ControladorPedidos::ctrMostraPedidosGeneral($valor);

        if (count($pedidos) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($pedidos); $i++) {

                /*
            * ESTADOS
            */
                if ($pedidos[$i]["estado"] == "GENERADO") {

                    $estado = "<button class='btn btn-basic btn-xs btnAprobarPedido' codigo='" . $pedidos[$i]["codigo"] . "' estadoPedido='APROBADO'>GENERADO</button>";
                } else if ($pedidos[$i]["estado"] == "APROBADO") {

                    $estado = "<button class='btn btn-warning btn-xs' codigo='" . $pedidos[$i]["codigo"] . "' estadoPedido='APT'>APROBADO</button>";
                } else if ($pedidos[$i]["estado"] == "APT") {

                    $estado = "<button class='btn btn-default btn-xs btn' codigo='" . $pedidos[$i]["codigo"] . "' estadoPedido='CONFIRMADO'>APT</button>";
                } else if ($pedidos[$i]["estado"] == "CONFIRMADO") {

                    $estado = "<button class='btn btn-info btn-xs btn ' codigo='" . $pedidos[$i]["codigo"] . "' >CONFIRMADO</button>";
                } else if ($pedidos[$i]["estado"] == "ANULADO") {

                    $estado = "<button class='btn btn-danger btn-xs btn' codigo='" . $pedidos[$i]["codigo"] . "'>ANULADO</button>";
                } else {

                    $estado = "<button class='btn btn-success btn-xs btn' codigo='" . $pedidos[$i]["codigo"] . "' estadoPedido='FACTURADO'>FACTURADO</button>";
                }

                $total = "<div style='text-align:right !important'>S/ " . number_format($pedidos[$i]["total"], 2) . "</div>";

                /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
                if ($pedidos[$i]["estado"] == 'FACTURADO') {
                    $botones =  "<div class='btn-group'><button title='Imprimir Pedido' class='btn btn-xs  btn-success btnImprimirPedido' codigo='" . $pedidos[$i]["codigo"] . "'><i class='fa fa-print'></i></button></div>";
                } else if ($pedidos[$i]["estado"] == 'ANULADO') {
                    $botones =  "<div> </div>";
                } else {
                    $botones =  "<div class='btn-group'><button title='Editar Pedido' class='btn btn-xs  btn-warning btnEditarPedidoCV' codigo='" . $pedidos[$i]["codigo"] . "'><i class='fa fa-pencil-square-o'></i></button><button title='Imprimir Pedido' class='btn btn-xs btn-success btnImprimirPedido' codigo='" . $pedidos[$i]["codigo"] . "'><i class='fa fa-print'></i></button><button title='Anular Pedido' class='btn btn-xs  btn-danger btnAnularPedidoCV' codigo='" . $pedidos[$i]["codigo"] . "' estado='" . $pedidos[$i]["estado"] . "'><i class='fa fa-close'></i></button></div>";
                }



                $datosJson .= '[
            "' . ($i + 1) . '",
            "<b>' . $pedidos[$i]["codigo"] . '</b>",
            "' . $pedidos[$i]["cod_cli"] . '",
            "<b>' . $pedidos[$i]["nombre"] . '</b>",
            "' . $pedidos[$i]["vendedor"] . '",
            "<b>' . $total . '</b>",
            "' . $pedidos[$i]["descripcion"] . '",
            "' . $estado . '",
            "' . $pedidos[$i]["nom_usu"] . '",
            "' . $pedidos[$i]["fecha"] . '",
            "' . $botones . '"
            ],';
            }

            $datosJson = substr($datosJson, 0, -1);

            $datosJson .= ']

            }';

            echo $datosJson;
        } else {

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
$activarArticulosPedidos->mostrarTablaPedidosCV();
