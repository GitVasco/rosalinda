<?php

require_once "../../controladores/ordencorte.controlador.php";
require_once "../../modelos/ordencorte.modelo.php";

class TablaVerOrdenCorteCantidad{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarVerTablaOrdenCorteCantidad(){

        $ordencorte = ControladorOrdenCorte::ctrRangoFechasOrdenCortesCantidad($_GET["fechaInicial"],$_GET["fechaFinal"]);
        // $ordencorte = ControladorOrdenCorte::ctrRangoFechasOrdenCortes($item,$valor);
        
        if(count($ordencorte)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($ordencorte); $i++){
                if($ordencorte[$i]["t1"] == '0'){
                    $t1 = '';
                }else{
                    $t1 = $ordencorte[$i]["t1"];
                }  
    
                if($ordencorte[$i]["t2"] == '0'){
                    $t2 = '';
                }else{
                    $t2 = $ordencorte[$i]["t2"];
                }  
    
                if($ordencorte[$i]["t3"] == '0'){
                    $t3 = '';
                }else{
                    $t3 = $ordencorte[$i]["t3"];
                }  
    
                if($ordencorte[$i]["t4"] == '0'){
                    $t4 = '';
                }else{
                    $t4 = $ordencorte[$i]["t4"];
                }  
    
                if($ordencorte[$i]["t5"] == '0'){
                    $t5 = '';
                }else{
                    $t5 = $ordencorte[$i]["t5"];
                }  
    
                if($ordencorte[$i]["t6"] == '0'){
                    $t6 = '';
                }else{
                    $t6 = $ordencorte[$i]["t6"];
                }  
    
                if($ordencorte[$i]["t7"] == '0'){
                    $t7 = '';
                }else{
                    $t7 = $ordencorte[$i]["t7"];
                }  
    
                if($ordencorte[$i]["t8"] == '0'){
                    $t8 = '';
                }else{
                    $t8 = $ordencorte[$i]["t8"];
                }  
                    
          
                $datosJson .= '[
                "'.$ordencorte[$i]["ordencorte"].'",
                "'.$ordencorte[$i]["fechas"].'",
                "'.$ordencorte[$i]["modelo"].'",
                "'.$ordencorte[$i]["nombre"].'",
                "'.$ordencorte[$i]["color"].'",
                "'.$t1.'",
                "'.$t2.'",
                "'.$t3.'",
                "'.$t4.'",
                "'.$t5.'",
                "'.$t6.'",
                "'.$t7.'",
                "'.$t8.'",
                "'.$ordencorte[$i]["subtotal"].'"
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
ACTIVAR TABLA DE orden$ordencorte
=============================================*/ 
$activarVerOrdenCorteCantidad = new TablaVerOrdenCorteCantidad();
$activarVerOrdenCorteCantidad -> mostrarVerTablaOrdenCorteCantidad();