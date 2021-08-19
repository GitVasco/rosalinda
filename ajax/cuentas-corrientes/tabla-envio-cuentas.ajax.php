<?php

require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";

class TablaEnvioCuentas{

    /*=============================================
    MOSTRAR LA TABLA DE CuentaS
    =============================================*/ 

    public function mostrarTablaEnvioCuentas(){

        $item = null;     
        $valor = null;

        $Cuenta = ControladorCuentas::ctrRangoFechaEnvioCuentas($_GET["fechaInicial"], $_GET["fechaFinal"]);	
        if(count($Cuenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($Cuenta); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-info btnVisualizarEnvioCuenta' idCuenta='".$Cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalVisualizarEnvioCuenta'><i class='fa fa-eye'></i></button><a class='btn btn-xs btn-success' href='".$Cuenta[$i]["archivo"]."' download ><i class='fa fa-download'></i></a></div>"; 

            $datosJson .= '[
            "'.$Cuenta[$i]["codigo"].'",
            "'.$Cuenta[$i]["fecha"].'",
            "'.$Cuenta[$i]["nombre"].'",
            "'.$Cuenta[$i]["cantidad"].'",
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
$activarEnvioCuentas = new TablaEnvioCuentas();
$activarEnvioCuentas -> mostrarTablaEnvioCuentas();

