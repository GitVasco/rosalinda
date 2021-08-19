<?php

require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";

class TablaVerCuentas2{

    /*=============================================
    MOSTRAR LA TABLA DE CuentaS
    =============================================*/ 

    public function mostrarTablaVerCuentas2(){

        $Cuenta = ControladorCuentas::ctrMostrarCancelaciones("num_cta",$_GET["numCta"]);
        if(count($Cuenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($Cuenta); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
       $botones="<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarCancelacion' idCancelacion='".$Cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCancelacion'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarCancelacion' idCancelacion='".$Cuenta[$i]["id"]."' ><i class='fa fa-times'></i></button></div>";

            $datosJson .= '[
            "'.$Cuenta[$i]["cod_pago"].'",
            "'.$Cuenta[$i]["doc_origen"].'",
            "'.$Cuenta[$i]["fecha"].'",
            "'.$Cuenta[$i]["notas"].'",
            "'.$Cuenta[$i]["monto"].'",
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
ACTIVAR TABLA DE Cuenta
=============================================*/ 
$activarVerCuentas2 = new TablaVerCuentas2();
$activarVerCuentas2 -> mostrarTablaVerCuentas2();

