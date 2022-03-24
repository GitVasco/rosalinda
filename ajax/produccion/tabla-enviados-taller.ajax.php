<?php

require_once "../../controladores/cortes.controlador.php";
require_once "../../modelos/cortes.modelo.php";

class TablaCortes{

    /*
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaCortes(){

        $modeloTaller = $_GET["modeloTaller"];
        $cortes = ControladorCortes::ctrMostrarEnviadosTaller($modeloTaller);

        if(count($cortes)>0){

        #var_dump("almacencorte", $cortes);

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($cortes); $i++){

                /*
                todo: BOTONES
                */

                if($cortes[$i]["t1"] > 0){

                    $t1 = "<span>".$cortes[$i]["t1"]."</span>";

                }else{

                    $t1 = "<span></span>";

                }

                if($cortes[$i]["t2"] > 0){

                    $t2 = "<span>".$cortes[$i]["t2"]."</span>";

                }else{

                    $t2 = "<span></span>";

                }
                
                if($cortes[$i]["t3"] > 0){

                    $t3 = "<span>".$cortes[$i]["t3"]."</span>";

                }else{

                    $t3 = "<span></span>";

                }

                if($cortes[$i]["t4"] > 0){

                    $t4 = "<span>".$cortes[$i]["t4"]."</span>";

                }else{

                    $t4 = "<span></span>";

                }

                if($cortes[$i]["t5"] > 0){

                    $t5 = "<span>".$cortes[$i]["t5"]."</span>";

                }else{

                    $t5 = "<span></span>";

                }

                if($cortes[$i]["t5"] > 0){

                    $t5 = "<span>".$cortes[$i]["t5"]."</span>";

                }else{

                    $t5 = "<span></span>";

                }

                if($cortes[$i]["t6"] > 0){

                    $t6 = "<span>".$cortes[$i]["t6"]."</span>";

                }else{

                    $t6 = "<span></span>";

                }

                if($cortes[$i]["t7"] > 0){

                    $t7 = "<span>".$cortes[$i]["t7"]."</span>";

                }else{

                    $t7 = "<span></span>";

                }

                if($cortes[$i]["t8"] > 0){

                    $t8 = "<span>".$cortes[$i]["t8"]."</span>";

                }else{

                    $t8 = "<span></span>";

                }                

                $datosJson .= '[
                "'.$cortes[$i]["fecha"].'",
                "'.$cortes[$i]["taller"].'",
                "'.$cortes[$i]["nombre_taller"].'",
                "<b><center>'.$cortes[$i]["modelo"].'</center></b>",
                "'.$cortes[$i]["nombre"].'",
                "<b>'.$cortes[$i]["color"].'</b>",
                "<center>'.$t1.'</center>",
                "<center>'.$t2.'</center>",
                "<center>'.$t3.'</center>",
                "<center>'.$t4.'</center>",
                "<center>'.$t5.'</center>",
                "<center>'.$t6.'</center>",
                "<center>'.$t7.'</center>",
                "<center>'.$t8.'</center>",
                "<center><b>'.$cortes[$i]["total"].'</b></center>"
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
$activarAlmacenCorte = new TablaCortes();
$activarAlmacenCorte -> mostrarTablaCortes();