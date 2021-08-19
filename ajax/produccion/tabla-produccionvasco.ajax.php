<?php

require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";

class TablaProduccionVasco{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCCION TRUSAS
    =============================================*/ 

    public function mostrarTablaProduccionVasco(){
   
        $vasco = ControladorTalleres::ctrMostrarProduccionVasco($_GET["mesV"]);	

        if(count($vasco)>0){

            $datosJson = '{
            "data": [';

            for($i = 0; $i < count($vasco); $i++){

                /* 
                * QUITAMOS LOS CEROS - T1
                */
                if( $vasco[$i]["t1"] <= 0){

                    $t1 = '';
                    
                }else{

                    $t1 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t1"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T2
                */
                if( $vasco[$i]["t2"] <= 0){

                    $t2 = '';
                    
                }else{

                    $t2 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t2"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T3
                */
                if( $vasco[$i]["t3"] <= 0){

                    $t3 = '';
                    
                }else{

                    $t3 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t3"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T4
                */
                if( $vasco[$i]["t4"] <= 0){

                    $t4 = '';
                    
                }else{

                    $t4 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t4"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T5
                */
                if( $vasco[$i]["t5"] <= 0){

                    $t5 = '';
                    
                }else{

                    $t5 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t5"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T6
                */
                if( $vasco[$i]["t6"] <= 0){

                    $t6 = '';
                    
                }else{

                    $t6 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t6"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T7
                */
                if( $vasco[$i]["t7"] <= 0){

                    $t7 = '';
                    
                }else{

                    $t7 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t7"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T8
                */
                if( $vasco[$i]["t8"] <= 0){

                    $t8 = '';
                    
                }else{

                    $t8 = "<b><center><span style='color:#000080;'>".$vasco[$i]["t8"]."</span></center></b>";

                }

        
                $datosJson .= '[
                "<b>'.$vasco[$i]["mes"].'</b>",
                "'.$vasco[$i]["fecha"].'",
                "<b><center>'.$vasco[$i]["cod_trab"].'</center></b>",
                "'.$vasco[$i]["nom_tip_trabajador"].'",
                "'.$vasco[$i]["trabajador"].'",
                "'.$vasco[$i]["cod_operacion"].'",
                "<b>'.$vasco[$i]["nombre"].'</b>",
                "<b>'.$vasco[$i]["modelo"].'</b>",
                "'.$vasco[$i]["cod_color"].'",
                "'.$vasco[$i]["color"].'",
                "'.$t1.'",
                "'.$t2.'",
                "'.$t3.'",
                "'.$t4.'",
                "'.$t5.'",
                "'.$t6.'",
                "'.$t7.'",
                "'.$t8.'",
                "<b><center>'.$vasco[$i]["total"].'</center></b>",
                "'.number_format($vasco[$i]["total_precio"],2).'",
                "<center>'.$vasco[$i]["minutos"].'</center>",
                "<b><center>'.number_format($vasco[$i]["eficiencia"],2).' %</center></b>"

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
ACTIVAR TABLA DE MATERIA PRIMA TARJETAS
=============================================*/ 
$activarTrusas = new TablaProduccionVasco();
$activarTrusas -> mostrarTablaProduccionVasco();