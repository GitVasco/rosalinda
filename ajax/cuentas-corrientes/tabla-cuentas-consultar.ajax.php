<?php

require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";
class TablaCuentasConsultar{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaCuentasConsultar(){

        $item = "cliente";     
        $valor = $_GET["cliente"];

        $cuenta = ControladorCuentas::ctrMostrarTipoCuentas($item, $valor);	
        if(count($cuenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cuenta); $i++){  
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/      
            if($cuenta[$i]["protesta"] == 1){
                $renov="SI";
            }else{
                $renov="NO";
            }

            if($cuenta[$i]["renovacion"] == 1){
                $protesta="SI";
            }else{
                $protesta="NO";
            }

            if($cuenta[$i]["estado"]=='PENDIENTE'){
                $estado =  "<button class='btn btn-danger btn-xs'>PENDIENTE</button>";
            }else{
                $estado =  "<button class='btn btn-success btn-xs'>CANCELADO</button>";
            }
                
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-primary btnVisualizarCuentaConsultar' numCta='".$cuenta[$i]["num_cta"]."'  title='Visualizar cuenta'><i class='fa fa-eye'></i></button></div>";
             
            $datosJson .= '[
            "'.$cuenta[$i]["tipo_doc"].'",
            "'.$cuenta[$i]["num_cta"].'",
            "'.$cuenta[$i]["cod_pago"].'",
            "'.$cuenta[$i]["doc_origen"].'",
            "'.$cuenta[$i]["nuevaFecha"].'",
            "'.$cuenta[$i]["nuevaFechaVen"].'",
            "'.number_format($cuenta[$i]["monto"],2).'",
            "'.number_format($cuenta[$i]["saldo"],2).'",
            "'.$cuenta[$i]["nuevaFechaPago"].'",
            "'.$cuenta[$i]["diferencia"].'",
            "'.$renov.'",
            "'.$protesta.'",
            "'.$cuenta[$i]["banco"].'",
            "'.$cuenta[$i]["num_unico"].'",
            "'.$cuenta[$i]["vendedor"].'",
            "'.$estado.'",
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
ACTIVAR TABLA DE TIPO DE PAGO
=============================================*/ 
$activarCuentasConsultar = new TablaCuentasConsultar();
$activarCuentasConsultar -> mostrarTablaCuentasConsultar();

