<?php

require_once "../../controladores/almacencorte.controlador.php";
require_once "../../modelos/almacencorte.modelo.php";

class TablaVerCortes{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerCortes(){

        $item = null;     
        $valor = null;

        $cortes = ControladorAlmacenCorte::ctrRangoFechasVerCortes($_GET["fechaInicial"],$_GET["fechaFinal"]);	
        if(count($cortes)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cortes); $i++){

            if($cortes[$i]["t1"] == '0'){
                $t1 = '';
            }else{
                $t1 = $cortes[$i]["t1"];
            }  

            if($cortes[$i]["t2"] == '0'){
                $t2 = '';
            }else{
                $t2 = $cortes[$i]["t2"];
            }  

            if($cortes[$i]["t3"] == '0'){
                $t3 = '';
            }else{
                $t3 = $cortes[$i]["t3"];
            }  

            if($cortes[$i]["t4"] == '0'){
                $t4 = '';
            }else{
                $t4 = $cortes[$i]["t4"];
            }  

            if($cortes[$i]["t5"] == '0'){
                $t5 = '';
            }else{
                $t5 = $cortes[$i]["t5"];
            }  

            if($cortes[$i]["t6"] == '0'){
                $t6 = '';
            }else{
                $t6 = $cortes[$i]["t6"];
            }  

            if($cortes[$i]["t7"] == '0'){
                $t7 = '';
            }else{
                $t7 = $cortes[$i]["t7"];
            }  

            if($cortes[$i]["t8"] == '0'){
                $t8 = '';
            }else{
                $t8 = $cortes[$i]["t8"];
            }  
               
            $datosJson .= '[
            "'.$cortes[$i]["almacencorte"].'",
            "'.$cortes[$i]["fechas"].'",
            "'.$cortes[$i]["modelo"].'",
            "'.$cortes[$i]["nombre"].'",
            "'.$cortes[$i]["color"].'",
            "'.$t1.'",
            "'.$t2.'",
            "'.$t3.'",
            "'.$t4.'",
            "'.$t5.'",
            "'.$t6.'",
            "'.$t7.'",
            "'.$t8.'",
            "'.$cortes[$i]["subtotal"].'"
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
$activarVerCortes = new TablaVerCortes();
$activarVerCortes -> mostrarTablaVerCortes();