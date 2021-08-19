<?php

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

class TablaPedidosCV{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaPedidosCV(){

        $pedidos = controladorArticulos::ctrListaArticulosPedidos();

        if(count($pedidos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($pedidos); $i++){

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs modificarArtPed' data-toggle='modal' data-target='#modalModificarClienteP' modelo='".$pedidos[$i]["modelo"]."'>Agregar</button></div>";

            $datosJson .= '[
            "'.($i+1).'",
            "'.$pedidos[$i]["modelo"].'",
            "'.$pedidos[$i]["nombre"].'",
            "'.$pedidos[$i]["cant_color"].'",
            "'.$pedidos[$i]["cant_talla"].'",
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