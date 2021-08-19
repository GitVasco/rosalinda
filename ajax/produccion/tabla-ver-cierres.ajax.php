<?php

require_once "../../controladores/cierres.controlador.php";
require_once "../../modelos/cierres.modelo.php";

class TablaVerCierres{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerCierres(){

        $item = null;     
        $valor = null;

        $cierres = ControladorCierres::ctrRangoFechasVerCierres($_GET["fechaInicial"],$_GET["fechaFinal"]);	
        if(count($cierres)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cierres); $i++){
            
            if($cierres[$i]["t1"] == '0'){
                $t1 = '';
            }else{
                $t1 = $cierres[$i]["t1"];
            }  

            if($cierres[$i]["t2"] == '0'){
                $t2 = '';
            }else{
                $t2 = $cierres[$i]["t2"];
            }  

            if($cierres[$i]["t3"] == '0'){
                $t3 = '';
            }else{
                $t3 = $cierres[$i]["t3"];
            }  

            if($cierres[$i]["t4"] == '0'){
                $t4 = '';
            }else{
                $t4 = $cierres[$i]["t4"];
            }  

            if($cierres[$i]["t5"] == '0'){
                $t5 = '';
            }else{
                $t5 = $cierres[$i]["t5"];
            }  

            if($cierres[$i]["t6"] == '0'){
                $t6 = '';
            }else{
                $t6 = $cierres[$i]["t6"];
            }  

            if($cierres[$i]["t7"] == '0'){
                $t7 = '';
            }else{
                $t7 = $cierres[$i]["t7"];
            }  

            if($cierres[$i]["t8"] == '0'){
                $t8 = '';
            }else{
                $t8 = $cierres[$i]["t8"];
            }  
    
            $datosJson .= '[
            "'.$cierres[$i]["cod_sector"]." - ".$cierres[$i]["nom_sector"].'",
            "'.$cierres[$i]["guia"].'",
            "'.$cierres[$i]["fechas"].'",
            "'.$cierres[$i]["codigo"].'",
            "'.$cierres[$i]["modelo"].'",
            "'.$cierres[$i]["nombre"].'",
            "'.$cierres[$i]["color"].'",
            "'.$t1.'",
            "'.$t2.'",
            "'.$t3.'",
            "'.$t4.'",
            "'.$t5.'",
            "'.$t6.'",
            "'.$t7.'",
            "'.$t8.'",
            "'.$cierres[$i]["total"].'"
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
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
$activarVerCierres = new TablaVerCierres();
$activarVerCierres -> mostrarTablaVerCierres();