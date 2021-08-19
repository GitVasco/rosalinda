<?php

require_once "../../controladores/cortes.controlador.php";
require_once "../../modelos/cortes.modelo.php";

class TablaCortes{

    /*
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaCortes(){

        $modeloCorte = $_GET["modeloCorte"];
        $cortes = ControladorCortes::ctrMostrarCortesV($modeloCorte);

        if(count($cortes)>0){

        #var_dump("almacencorte", $cortes);

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($cortes); $i++){

                /*
                todo: BOTONES
                */

                if($cortes[$i]["1"] > 0){

                    $t1 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'1'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["1"]."</button>";

                }else{

                    $t1 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'1'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["1"]."</button>";

                }

                if($cortes[$i]["2"] > 0){

                    $t2 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'2'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["2"]."</button>";

                }else{

                    $t2 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'2'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["2"]."</button>";

                }

                if($cortes[$i]["3"] > 0){

                    $t3 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'3'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["3"]."</button>";

                }else{

                    $t3 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'3'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["3"]."</button>";

                }

                if($cortes[$i]["4"] > 0){

                    $t4 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'4'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["4"]."</button>";

                }else{

                    $t4 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'4'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["4"]."</button>";

                }

                if($cortes[$i]["5"] > 0){

                    $t5 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'5'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["5"]."</button>";

                }else{

                    $t5 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'5'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["5"]."</button>";

                }

                if($cortes[$i]["6"] > 0){

                    $t6 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'6'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["6"]."</button>";

                }else{

                    $t6 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'6'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["6"]."</button>";

                }

                if($cortes[$i]["7"] > 0){

                    $t7 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'7'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["7"]."</button>";

                }else{

                    $t7 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'7'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["7"]."</button>";

                }

                if($cortes[$i]["8"] > 0){

                    $t8 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'8'."' data-toggle='modal' data-target='#modalMandarTaller'>".$cortes[$i]["8"]."</button>";

                }else{

                    $t8 = "<button class='btn btn-link btn-md btnMandarTaller' articulo='".$cortes[$i]["modelo"].$cortes[$i]["cod_color"].'8'."' data-toggle='modal' data-target='#modalMandarTaller' disabled>".$cortes[$i]["8"]."</button>";

                }

                $datosJson .= '[
                "<b><center>'.$cortes[$i]["modelo"].'</center></b>",
                "'.$cortes[$i]["nombre"].'",
                "'.$cortes[$i]["color"].'",
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