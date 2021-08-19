<?php

require_once "../../controladores/almacencorte.controlador.php";
require_once "../../modelos/almacencorte.modelo.php";

class TablaVerAlmacenCortes{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerAlmacenCortes(){

        $item = null;     
        $valor = $_GET["codigo"];

        $almacencortes = ControladorAlmacenCorte::ctrVisualizarAlmacenCorteDetalle($valor);	
        if(count($almacencortes)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($almacencortes); $i++){

            if($almacencortes[$i]["t1"] == '0'){
                $t1 = '';
            }else{
                $t1 = $almacencortes[$i]["t1"];
            }  

            if($almacencortes[$i]["t2"] == '0'){
                $t2 = '';
            }else{
                $t2 = $almacencortes[$i]["t2"];
            }  

            if($almacencortes[$i]["t3"] == '0'){
                $t3 = '';
            }else{
                $t3 = $almacencortes[$i]["t3"];
            }  

            if($almacencortes[$i]["t4"] == '0'){
                $t4 = '';
            }else{
                $t4 = $almacencortes[$i]["t4"];
            }  

            if($almacencortes[$i]["t5"] == '0'){
                $t5 = '';
            }else{
                $t5 = $almacencortes[$i]["t5"];
            }  

            if($almacencortes[$i]["t6"] == '0'){
                $t6 = '';
            }else{
                $t6 = $almacencortes[$i]["t6"];
            }  

            if($almacencortes[$i]["t7"] == '0'){
                $t7 = '';
            }else{
                $t7 = $almacencortes[$i]["t7"];
            }  

            if($almacencortes[$i]["t8"] == '0'){
                $t8 = '';
            }else{
                $t8 = $almacencortes[$i]["t8"];
            }  

            $datosJson .= '[
            "'.$almacencortes[$i]["almacencorte"].'",
            "'.$almacencortes[$i]["fechas"].'",
            "'.$almacencortes[$i]["modelo"].'",
            "'.$almacencortes[$i]["nombre"].'",
            "'.$almacencortes[$i]["color"].'",
            "'.$t1.'",
            "'.$t2.'",
            "'.$t3.'",
            "'.$t4.'",
            "'.$t5.'",
            "'.$t6.'",
            "'.$t7.'",
            "'.$t8.'",
            "'.$almacencortes[$i]["subtotal"].'"
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
$activarVerAlmacenCortes = new TablaVerAlmacenCortes();
$activarVerAlmacenCortes -> mostrarTablaVerAlmacenCortes();