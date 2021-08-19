<?php

require_once "../../controladores/servicio.controlador.php";
require_once "../../modelos/servicio.modelo.php";

class TablaVerServicios{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerServicios(){

        $item = null;     
        $valor = null;

        $servicios = ControladorServicios::ctrRangoFechasVerServicios($_GET["fechaInicial"], $_GET["fechaFinal"]);	
        if(count($servicios)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($servicios); $i++){
            if($servicios[$i]["t1"] == '0'){
                $t1 = '';
            }else{
                $t1 = $servicios[$i]["t1"];
            }  

            if($servicios[$i]["t2"] == '0'){
                $t2 = '';
            }else{
                $t2 = $servicios[$i]["t2"];
            }  

            if($servicios[$i]["t3"] == '0'){
                $t3 = '';
            }else{
                $t3 = $servicios[$i]["t3"];
            }  

            if($servicios[$i]["t4"] == '0'){
                $t4 = '';
            }else{
                $t4 = $servicios[$i]["t4"];
            }  

            if($servicios[$i]["t5"] == '0'){
                $t5 = '';
            }else{
                $t5 = $servicios[$i]["t5"];
            }  

            if($servicios[$i]["t6"] == '0'){
                $t6 = '';
            }else{
                $t6 = $servicios[$i]["t6"];
            }  

            if($servicios[$i]["t7"] == '0'){
                $t7 = '';
            }else{
                $t7 = $servicios[$i]["t7"];
            }  

            if($servicios[$i]["t8"] == '0'){
                $t8 = '';
            }else{
                $t8 = $servicios[$i]["t8"];
            }  
    
            $datosJson .= '[
            "'.$servicios[$i]["cod_sector"]." - ".$servicios[$i]["nom_sector"].'",
            "'.$servicios[$i]["fechas"].'",
            "'.$servicios[$i]["codigo"].'",
            "'.$servicios[$i]["modelo"].'",
            "'.$servicios[$i]["nombre"].'",
            "'.$servicios[$i]["color"].'",
            "'.$t1.'",
            "'.$t2.'",
            "'.$t3.'",
            "'.$t4.'",
            "'.$t5.'",
            "'.$t6.'",
            "'.$t7.'",
            "'.$t8.'",
            "'.$servicios[$i]["total"].'"
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
$activarVerServicios = new TablaVerServicios();
$activarVerServicios -> mostrarTablaVerServicios();