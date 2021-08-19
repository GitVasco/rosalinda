<?php

require_once "../../controladores/produccion.controlador.php";
require_once "../../modelos/produccion.modelo.php";


class TablaEficiencia{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaEficiencia(){

        $eficiencia = ControladorProduccion::ctrMostrarEficiencia($_GET["inicio"], $_GET["fin"], $_GET["nquincena"], $_GET["id"], $_GET["sectorEfi"]);	

        if(count($eficiencia)>0){

            if($_GET["nquincena"] == "1"){

                $datosJson = '{
                    "data": [';
            
                    for($i = 0; $i < count($eficiencia); $i++){

                        $vino = "#8B0000";
                        $azulino = "#0000FF";
                        $verde = "#008000"; 

                        /* 
                        * d1
                        */
                        if($eficiencia[$i]["d1"] > 0){

                            if($eficiencia[$i]["d1"] > 1 &&  $eficiencia[$i]["d1"] <= 50){

                                $d1 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d1"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d1"] > 51 &&  $eficiencia[$i]["d1"] <= 100){

                                $d1 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d1"],2)." %</span></b>";

                            }else{

                                $d1 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d1"],2)." %</span></b>";

                            }

                        }else{

                            $d1= '';

                        }
                        /* 
                        * d2
                        */
                        if($eficiencia[$i]["d2"] > 0){

                            if($eficiencia[$i]["d2"] > 1 &&  $eficiencia[$i]["d2"] <= 50){

                                $d2 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d2"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d2"] > 51 &&  $eficiencia[$i]["d2"] <= 100){

                                $d2 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d2"],2)." %</span></b>";

                            }else{

                                $d2 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d2"],2)." %</span></b>";

                            }

                        }else{

                            $d2= '';

                        }
                        /* 
                        * d3
                        */
                        if($eficiencia[$i]["d3"] > 0){

                            if($eficiencia[$i]["d3"] > 1 &&  $eficiencia[$i]["d3"] <= 50){

                                $d3 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d3"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d3"] > 51 &&  $eficiencia[$i]["d3"] <= 100){

                                $d3 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d3"],2)." %</span></b>";

                            }else{

                                $d3 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d3"],2)." %</span></b>";

                            }

                        }else{

                            $d3= '';

                        }
                        /* 
                        * d4
                        */
                        if($eficiencia[$i]["d4"] > 0){

                            if($eficiencia[$i]["d4"] > 1 &&  $eficiencia[$i]["d4"] <= 50){

                                $d4 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d4"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d4"] > 51 &&  $eficiencia[$i]["d4"] <= 100){

                                $d4 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d4"],2)." %</span></b>";

                            }else{

                                $d4 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d4"],2)." %</span></b>";

                            }

                        }else{

                            $d4= '';

                        }
                        /* 
                        * d5
                        */
                        if($eficiencia[$i]["d5"] > 0){

                            if($eficiencia[$i]["d5"] > 1 &&  $eficiencia[$i]["d5"] <= 50){

                                $d5 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d5"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d5"] > 51 &&  $eficiencia[$i]["d5"] <= 100){

                                $d5 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d5"],2)." %</span></b>";

                            }else{

                                $d5 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d5"],2)." %</span></b>";

                            }

                        }else{

                            $d5= '';

                        }
                        /* 
                        * d6
                        */
                        if($eficiencia[$i]["d6"] > 0){

                            if($eficiencia[$i]["d6"] > 1 &&  $eficiencia[$i]["d6"] <= 50){

                                $d6 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d6"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d6"] > 51 &&  $eficiencia[$i]["d6"] <= 100){

                                $d6 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d6"],2)." %</span></b>";

                            }else{

                                $d6 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d6"],2)." %</span></b>";

                            }

                        }else{

                            $d6= '';

                        }
                        /* 
                        * d7
                        */
                        if($eficiencia[$i]["d7"] > 0){

                            if($eficiencia[$i]["d7"] > 1 &&  $eficiencia[$i]["d7"] <= 50){

                                $d7 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d7"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d7"] > 51 &&  $eficiencia[$i]["d7"] <= 100){

                                $d7 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d7"],2)." %</span></b>";

                            }else{

                                $d7 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d7"],2)." %</span></b>";

                            }

                        }else{

                            $d7= '';

                        }
                        /* 
                        * d8
                        */
                        if($eficiencia[$i]["d8"] > 0){

                            if($eficiencia[$i]["d8"] > 1 &&  $eficiencia[$i]["d8"] <= 50){

                                $d8 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d8"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d8"] > 51 &&  $eficiencia[$i]["d8"] <= 100){

                                $d8 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d8"],2)." %</span></b>";

                            }else{

                                $d8 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d8"],2)." %</span></b>";

                            }

                        }else{

                            $d8= '';

                        }
                        /* 
                        * d9
                        */
                        if($eficiencia[$i]["d9"] > 0){

                            if($eficiencia[$i]["d9"] > 1 &&  $eficiencia[$i]["d9"] <= 50){

                                $d9 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d9"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d9"] > 51 &&  $eficiencia[$i]["d9"] <= 100){

                                $d9 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d9"],2)." %</span></b>";

                            }else{

                                $d9 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d9"],2)." %</span></b>";

                            }

                        }else{

                            $d9= '';

                        }
                        /* 
                        * d10
                        */
                        if($eficiencia[$i]["d10"] > 0){

                            if($eficiencia[$i]["d10"] > 1 &&  $eficiencia[$i]["d10"] <= 50){

                                $d10 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d10"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d10"] > 51 &&  $eficiencia[$i]["d10"] <= 100){

                                $d10 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d10"],2)." %</span></b>";

                            }else{

                                $d10 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d10"],2)." %</span></b>";

                            }

                        }else{

                            $d10= '';

                        }
                        /* 
                        * d11
                        */
                        if($eficiencia[$i]["d11"] > 0){

                            if($eficiencia[$i]["d11"] > 1 &&  $eficiencia[$i]["d11"] <= 50){

                                $d11 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d11"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d11"] > 51 &&  $eficiencia[$i]["d11"] <= 100){

                                $d11 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d11"],2)." %</span></b>";

                            }else{

                                $d11 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d11"],2)." %</span></b>";

                            }

                        }else{

                            $d11= '';

                        }
                        /* 
                        * d12
                        */
                        if($eficiencia[$i]["d12"] > 0){

                            if($eficiencia[$i]["d12"] > 1 &&  $eficiencia[$i]["d12"] <= 50){

                                $d12 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d12"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d12"] > 51 &&  $eficiencia[$i]["d12"] <= 100){

                                $d12 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d12"],2)." %</span></b>";

                            }else{

                                $d12 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d12"],2)." %</span></b>";

                            }

                        }else{

                            $d12= '';

                        }
                        /* 
                        * d13
                        */
                        if($eficiencia[$i]["d13"] > 0){

                            if($eficiencia[$i]["d13"] > 1 &&  $eficiencia[$i]["d13"] <= 50){

                                $d13 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d13"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d13"] > 51 &&  $eficiencia[$i]["d13"] <= 100){

                                $d13 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d13"],2)." %</span></b>";

                            }else{

                                $d13 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d13"],2)." %</span></b>";

                            }

                        }else{

                            $d13= '';

                        }
                        /* 
                        * d14
                        */
                        if($eficiencia[$i]["d14"] > 0){

                            if($eficiencia[$i]["d14"] > 1 &&  $eficiencia[$i]["d14"] <= 50){

                                $d14 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d14"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d14"] > 51 &&  $eficiencia[$i]["d14"] <= 100){

                                $d14 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d14"],2)." %</span></b>";

                            }else{

                                $d14 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d14"],2)." %</span></b>";

                            }

                        }else{

                            $d14= '';

                        }
                        /* 
                        * d15
                        */
                        if($eficiencia[$i]["d15"] > 0){

                            if($eficiencia[$i]["d15"] > 1 &&  $eficiencia[$i]["d15"] <= 50){

                                $d15 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d15"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d15"] > 51 &&  $eficiencia[$i]["d15"] <= 100){

                                $d15 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d15"],2)." %</span></b>";

                            }else{

                                $d15 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d15"],2)." %</span></b>";

                            }

                        }else{

                            $d15= '';

                        }
                        /* 
                        * d16
                        */
                        if($eficiencia[$i]["d16"] > 0){

                            if($eficiencia[$i]["d16"] > 1 &&  $eficiencia[$i]["d16"] <= 50){

                                $d16 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d16"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d16"] > 51 &&  $eficiencia[$i]["d16"] <= 100){

                                $d16 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d16"],2)." %</span></b>";

                            }else{

                                $d16 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d16"],2)." %</span></b>";

                            }

                        }else{

                            $d16= '';

                        }
                        /* 
                        * d28
                        */
                        if($eficiencia[$i]["d28"] > 0){

                            if($eficiencia[$i]["d28"] > 1 &&  $eficiencia[$i]["d28"] <= 50){

                                $d28 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d28"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d28"] > 51 &&  $eficiencia[$i]["d28"] <= 100){

                                $d28 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d28"],2)." %</span></b>";

                            }else{

                                $d28 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d28"],2)." %</span></b>";

                            }

                        }else{

                            $d28= '';

                        }
                        /* 
                        * d29
                        */
                        if($eficiencia[$i]["d29"] > 0){

                            if($eficiencia[$i]["d29"] > 1 &&  $eficiencia[$i]["d29"] <= 50){

                                $d29 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d29"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d29"] > 51 &&  $eficiencia[$i]["d29"] <= 100){

                                $d29 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d29"],2)." %</span></b>";

                            }else{

                                $d29 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d29"],2)." %</span></b>";

                            }

                        }else{

                            $d29= '';

                        }
                        /* 
                        * d30
                        */
                        if($eficiencia[$i]["d30"] > 0){

                            if($eficiencia[$i]["d30"] > 1 &&  $eficiencia[$i]["d30"] <= 50){

                                $d30 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d30"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d30"] > 51 &&  $eficiencia[$i]["d30"] <= 100){

                                $d30 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d30"],2)." %</span></b>";

                            }else{

                                $d30 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d30"],2)." %</span></b>";

                            }

                        }else{

                            $d30= '';

                        }
                        /* 
                        * d31
                        */
                        if($eficiencia[$i]["d31"] > 0){

                            if($eficiencia[$i]["d31"] > 1 &&  $eficiencia[$i]["d31"] <= 50){

                                $d31 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d31"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d31"] > 51 &&  $eficiencia[$i]["d31"] <= 100){

                                $d31 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d31"],2)." %</span></b>";

                            }else{

                                $d31 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d31"],2)." %</span></b>";

                            }

                        }else{

                            $d31= '';

                        }
                        if($_GET["nquincena"] == 1){
                            $dTotal=$d1+$d2;
                        }else{
                            $dTotal=$d1+$d2;
                        }
                        
            
                        $datosJson .= '[
                        "'.$eficiencia[$i]["trabajador"].'",
                        "<b>'.$eficiencia[$i]["nom_tra"].'</b>",
                        "'.$d28.'",
                        "'.$d29.'",
                        "'.$d30.'",
                        "'.$d31.'",
                        "'.$d1.'",
                        "'.$d2.'",
                        "'.$d3.'",
                        "'.$d4.'",
                        "'.$d5.'",
                        "'.$d6.'",
                        "'.$d7.'",
                        "'.$d8.'",
                        "'.$d9.'",
                        "'.$d10.'",
                        "'.$d11.'",
                        "'.$d12.'",
                        "'.$d13.'",
                        "'.$d14.'",
                        "'.$d15.'",
                        "'.$d16.'"
                        ],';  
            
                    }
            
                        $datosJson=substr($datosJson, 0, -1);
            
                        $datosJson .= '] 
            
                        }';
            
                    echo $datosJson;


            }else{

                $datosJson = '{
                    "data": [';
            
                    for($i = 0; $i < count($eficiencia); $i++){

                        $vino = "#8B0000";
                        $azulino = "#0000FF";
                        $verde = "#008000";            

                        /* 
                        * d1
                        */
                        if($eficiencia[$i]["d1"] > 0){

                            if($eficiencia[$i]["d1"] > 1 &&  $eficiencia[$i]["d1"] <= 50){

                                $d1 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d1"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d1"] > 51 &&  $eficiencia[$i]["d1"] <= 100){

                                $d1 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d1"],2)." %</span></b>";

                            }else{

                                $d1 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d1"],2)." %</span></b>";

                            }

                        }else{

                            $d1= '';

                        }
                        /* 
                        * d13
                        */
                        if($eficiencia[$i]["d13"] > 0){

                            if($eficiencia[$i]["d13"] > 1 &&  $eficiencia[$i]["d13"] <= 50){

                                $d13 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d13"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d13"] > 51 &&  $eficiencia[$i]["d13"] <= 100){

                                $d13 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d13"],2)." %</span></b>";

                            }else{

                                $d13 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d13"],2)." %</span></b>";

                            }

                        }else{

                            $d13= '';

                        }
                        /* 
                        * d14
                        */
                        if($eficiencia[$i]["d14"] > 0){

                            if($eficiencia[$i]["d14"] > 1 &&  $eficiencia[$i]["d14"] <= 50){

                                $d14 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d14"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d14"] > 51 &&  $eficiencia[$i]["d14"] <= 100){

                                $d14 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d14"],2)." %</span></b>";

                            }else{

                                $d14 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d14"],2)." %</span></b>";

                            }

                        }else{

                            $d14= '';

                        }
                        /* 
                        * d15
                        */
                        if($eficiencia[$i]["d15"] > 0){

                            if($eficiencia[$i]["d15"] > 1 &&  $eficiencia[$i]["d15"] <= 50){

                                $d15 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d15"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d15"] > 51 &&  $eficiencia[$i]["d15"] <= 100){

                                $d15 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d15"],2)." %</span></b>";

                            }else{

                                $d15 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d15"],2)." %</span></b>";

                            }

                        }else{

                            $d15= '';

                        }
                        /* 
                        * d16
                        */
                        if($eficiencia[$i]["d16"] > 0){

                            if($eficiencia[$i]["d16"] > 1 &&  $eficiencia[$i]["d16"] <= 50){

                                $d16 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d16"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d16"] > 51 &&  $eficiencia[$i]["d16"] <= 100){

                                $d16 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d16"],2)." %</span></b>";

                            }else{

                                $d16 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d16"],2)." %</span></b>";

                            }

                        }else{

                            $d16= '';

                        }
                        /* 
                        * d17
                        */
                        if($eficiencia[$i]["d17"] > 0){

                            if($eficiencia[$i]["d17"] > 1 &&  $eficiencia[$i]["d17"] <= 50){

                                $d17 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d17"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d17"] > 51 &&  $eficiencia[$i]["d17"] <= 100){

                                $d17 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d17"],2)." %</span></b>";

                            }else{

                                $d17 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d17"],2)." %</span></b>";

                            }

                        }else{

                            $d17= '';

                        }
                        /* 
                        * d18
                        */
                        if($eficiencia[$i]["d18"] > 0){

                            if($eficiencia[$i]["d18"] > 1 &&  $eficiencia[$i]["d18"] <= 50){

                                $d18 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d18"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d18"] > 51 &&  $eficiencia[$i]["d18"] <= 100){

                                $d18 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d18"],2)." %</span></b>";

                            }else{

                                $d18 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d18"],2)." %</span></b>";

                            }

                        }else{

                            $d18= '';

                        }
                        /* 
                        * d19
                        */
                        if($eficiencia[$i]["d19"] > 0){

                            if($eficiencia[$i]["d19"] > 1 &&  $eficiencia[$i]["d19"] <= 50){

                                $d19 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d19"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d19"] > 51 &&  $eficiencia[$i]["d19"] <= 100){

                                $d19 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d19"],2)." %</span></b>";

                            }else{

                                $d19 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d19"],2)." %</span></b>";

                            }

                        }else{

                            $d19= '';

                        }
                        /* 
                        * d20
                        */
                        if($eficiencia[$i]["d20"] > 0){

                            if($eficiencia[$i]["d20"] > 1 &&  $eficiencia[$i]["d20"] <= 50){

                                $d20 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d20"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d20"] > 51 &&  $eficiencia[$i]["d20"] <= 100){

                                $d20 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d20"],2)." %</span></b>";

                            }else{

                                $d20 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d20"],2)." %</span></b>";

                            }

                        }else{

                            $d20= '';

                        }
                        /* 
                        * d21
                        */
                        if($eficiencia[$i]["d21"] > 0){

                            if($eficiencia[$i]["d21"] > 1 &&  $eficiencia[$i]["d21"] <= 50){

                                $d21 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d21"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d21"] > 51 &&  $eficiencia[$i]["d21"] <= 100){

                                $d21 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d21"],2)." %</span></b>";

                            }else{

                                $d21 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d21"],2)." %</span></b>";

                            }

                        }else{

                            $d21= '';

                        }
                        /* 
                        * d22
                        */
                        if($eficiencia[$i]["d22"] > 0){

                            if($eficiencia[$i]["d22"] > 1 &&  $eficiencia[$i]["d22"] <= 50){

                                $d22 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d22"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d22"] > 51 &&  $eficiencia[$i]["d22"] <= 100){

                                $d22 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d22"],2)." %</span></b>";

                            }else{

                                $d22 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d22"],2)." %</span></b>";

                            }

                        }else{

                            $d22= '';

                        }
                        /* 
                        * d23
                        */
                        if($eficiencia[$i]["d23"] > 0){

                            if($eficiencia[$i]["d23"] > 1 &&  $eficiencia[$i]["d23"] <= 50){

                                $d23 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d23"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d23"] > 51 &&  $eficiencia[$i]["d23"] <= 100){

                                $d23 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d23"],2)." %</span></b>";

                            }else{

                                $d23 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d23"],2)." %</span></b>";

                            }

                        }else{

                            $d23= '';

                        }
                        /* 
                        * d24
                        */
                        if($eficiencia[$i]["d24"] > 0){

                            if($eficiencia[$i]["d24"] > 1 &&  $eficiencia[$i]["d24"] <= 50){

                                $d24 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d24"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d24"] > 51 &&  $eficiencia[$i]["d24"] <= 100){

                                $d24 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d24"],2)." %</span></b>";

                            }else{

                                $d24 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d24"],2)." %</span></b>";

                            }

                        }else{

                            $d24= '';

                        }
                        /* 
                        * d25
                        */
                        if($eficiencia[$i]["d25"] > 0){

                            if($eficiencia[$i]["d25"] > 1 &&  $eficiencia[$i]["d25"] <= 50){

                                $d25 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d25"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d25"] > 51 &&  $eficiencia[$i]["d25"] <= 100){

                                $d25 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d25"],2)." %</span></b>";

                            }else{

                                $d25 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d25"],2)." %</span></b>";

                            }

                        }else{

                            $d25= '';

                        }
                        /* 
                        * d26
                        */
                        if($eficiencia[$i]["d26"] > 0){

                            if($eficiencia[$i]["d26"] > 1 &&  $eficiencia[$i]["d26"] <= 50){

                                $d26 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d26"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d26"] > 51 &&  $eficiencia[$i]["d26"] <= 100){

                                $d26 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d26"],2)." %</span></b>";

                            }else{

                                $d26 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d26"],2)." %</span></b>";

                            }

                        }else{

                            $d26= '';

                        }
                        /* 
                        * d27
                        */
                        if($eficiencia[$i]["d27"] > 0){

                            if($eficiencia[$i]["d27"] > 1 &&  $eficiencia[$i]["d27"] <= 50){

                                $d27 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d27"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d27"] > 51 &&  $eficiencia[$i]["d27"] <= 100){

                                $d27 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d27"],2)." %</span></b>";

                            }else{

                                $d27 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d27"],2)." %</span></b>";

                            }

                        }else{

                            $d27= '';

                        }
                        /* 
                        * d28
                        */
                        if($eficiencia[$i]["d28"] > 0){

                            if($eficiencia[$i]["d28"] > 1 &&  $eficiencia[$i]["d28"] <= 50){

                                $d28 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d28"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d28"] > 51 &&  $eficiencia[$i]["d28"] <= 100){

                                $d28 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d28"],2)." %</span></b>";

                            }else{

                                $d28 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d28"],2)." %</span></b>";

                            }

                        }else{

                            $d28= '';

                        }
                        /* 
                        * d29
                        */
                        if($eficiencia[$i]["d29"] > 0){

                            if($eficiencia[$i]["d29"] > 1 &&  $eficiencia[$i]["d29"] <= 50){

                                $d29 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d29"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d29"] > 51 &&  $eficiencia[$i]["d29"] <= 100){

                                $d29 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d29"],2)." %</span></b>";

                            }else{

                                $d29 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d29"],2)." %</span></b>";

                            }

                        }else{

                            $d29= '';

                        }
                        /* 
                        * d30
                        */
                        if($eficiencia[$i]["d30"] > 0){

                            if($eficiencia[$i]["d30"] > 1 &&  $eficiencia[$i]["d30"] <= 50){

                                $d30 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d30"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d30"] > 51 &&  $eficiencia[$i]["d30"] <= 100){

                                $d30 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d30"],2)." %</span></b>";

                            }else{

                                $d30 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d30"],2)." %</span></b>";

                            }

                        }else{

                            $d30= '';

                        }
                        /* 
                        * d31
                        */
                        if($eficiencia[$i]["d31"] > 0){

                            if($eficiencia[$i]["d31"] > 1 &&  $eficiencia[$i]["d31"] <= 50){

                                $d31 = "<b><span style='color:".$vino.";'>".number_format($eficiencia[$i]["d31"],2)." %</span></b>";

                            }else if($eficiencia[$i]["d31"] > 51 &&  $eficiencia[$i]["d31"] <= 100){

                                $d31 = "<b><span style='color:".$azulino.";'>".number_format($eficiencia[$i]["d31"],2)." %</span></b>";

                            }else{

                                $d31 = "<b><span style='color:".$verde.";'>".number_format($eficiencia[$i]["d31"],2)." %</span></b>";

                            }

                        }else{

                            $d31= '';

                        }

                        $datosJson .= '[
                        "'.$eficiencia[$i]["trabajador"].'",
                        "<b>'.$eficiencia[$i]["nom_tra"].'</b>",
                        "'.$d13.'",
                        "'.$d14.'",
                        "'.$d15.'",
                        "'.$d16.'",
                        "'.$d17.'",
                        "'.$d18.'",
                        "'.$d19.'",
                        "'.$d20.'",
                        "'.$d21.'",
                        "'.$d22.'",
                        "'.$d23.'",
                        "'.$d24.'",
                        "'.$d25.'",
                        "'.$d26.'",
                        "'.$d27.'",
                        "'.$d28.'",
                        "'.$d29.'",
                        "'.$d30.'",
                        "'.$d31.'",
                        "'.$d1.'"
                        ],';  
            
                    }
            
                        $datosJson=substr($datosJson, 0, -1);
            
                        $datosJson .= '] 
            
                        }';
            
                    echo $datosJson;


            }



        }else{

            echo '{
                "data":[]
            }';
            return;

        }
    }

}

/*=============================================
ACTIVAR TABLA DE ARTICULOS
=============================================*/ 
$activarArticulos = new TablaEficiencia();
$activarArticulos -> mostrarTablaEficiencia();