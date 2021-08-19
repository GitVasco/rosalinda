<?php

require_once "../../controladores/servicio.controlador.php";
require_once "../../modelos/servicio.modelo.php";

class TablaVerPagoServicios{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerPagoServicios(){

        $inicio = $_GET["inicio"];     
        $fin = $_GET["fin"];

        $pagoservicios = ControladorServicios::ctrVerPagoServicios($inicio,$fin);	
        if(count($pagoservicios)>0){

        $datosJson = '{
        "data": [';


        for($i = 0; $i < count($pagoservicios); $i++){
            //convirtiendo fecha datetime a date por cadena
            $fecha=substr($pagoservicios[$i]["fecha"],0,10);

            if($pagoservicios[$i]["t1"] == '0'){
                $t1 = '';
            }else{
                $t1 = $pagoservicios[$i]["t1"];
            }  

            if($pagoservicios[$i]["t2"] == '0'){
                $t2 = '';
            }else{
                $t2 = $pagoservicios[$i]["t2"];
            }  

            if($pagoservicios[$i]["t3"] == '0'){
                $t3 = '';
            }else{
                $t3 = $pagoservicios[$i]["t3"];
            }  

            if($pagoservicios[$i]["t4"] == '0'){
                $t4 = '';
            }else{
                $t4 = $pagoservicios[$i]["t4"];
            }  

            if($pagoservicios[$i]["t5"] == '0'){
                $t5 = '';
            }else{
                $t5 = $pagoservicios[$i]["t5"];
            }  

            if($pagoservicios[$i]["t6"] == '0'){
                $t6 = '';
            }else{
                $t6 = $pagoservicios[$i]["t6"];
            }  

            if($pagoservicios[$i]["t7"] == '0'){
                $t7 = '';
            }else{
                $t7 = $pagoservicios[$i]["t7"];
            }  

            if($pagoservicios[$i]["t8"] == '0'){
                $t8 = '';
            }else{
                $t8 = $pagoservicios[$i]["t8"];
            }  
    
            $datosJson .= '[
            "'.$pagoservicios[$i]["cod_sector"]." - ".$pagoservicios[$i]["nom_sector"].'",
            "'.$pagoservicios[$i]["guia"].'",
            "'.$fecha.'",
            "'.$pagoservicios[$i]["codigo"].'",
            "'.$pagoservicios[$i]["modelo"].'",
            "'.$pagoservicios[$i]["nombre"].'",
            "'.$pagoservicios[$i]["cod_color"].'",
            "'.$pagoservicios[$i]["color"].'",
            "'.$t1.'",
            "'.$t2.'",
            "'.$t3.'",
            "'.$t4.'",
            "'.$t5.'",
            "'.$t6.'",
            "'.$t7.'",
            "'.$t8.'",
            "'.$pagoservicios[$i]["total_docenas"].'",
            "'.$pagoservicios[$i]["precio_doc"].'",
            "'.$pagoservicios[$i]["total_soles"].'"
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
$activarVerPagoServicios = new TablaVerPagoServicios();
$activarVerPagoServicios -> mostrarTablaVerPagoServicios();