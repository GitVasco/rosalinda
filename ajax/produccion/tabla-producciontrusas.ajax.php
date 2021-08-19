<?php

require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";

class TablaProduccionTrusas{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCCION TRUSAS
    =============================================*/ 

    public function mostrarTablaProduccionTrusas(){
   
        $trusas = ControladorTalleres::ctrMostrarProduccionTrusas($_GET["fechaInicial"],$_GET["fechaFinal"]);	

        if(count($trusas)>0){

            $datosJson = '{
            "data": [';

            for($i = 0; $i < count($trusas); $i++){

                /* 
                * QUITAMOS LOS CEROS - T1
                */
                if( $trusas[$i]["t1"] <= 0){

                    $t1 = '';
                    
                }else{

                    $t1 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t1"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T2
                */
                if( $trusas[$i]["t2"] <= 0){

                    $t2 = '';
                    
                }else{

                    $t2 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t2"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T3
                */
                if( $trusas[$i]["t3"] <= 0){

                    $t3 = '';
                    
                }else{

                    $t3 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t3"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T4
                */
                if( $trusas[$i]["t4"] <= 0){

                    $t4 = '';
                    
                }else{

                    $t4 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t4"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T5
                */
                if( $trusas[$i]["t5"] <= 0){

                    $t5 = '';
                    
                }else{

                    $t5 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t5"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T6
                */
                if( $trusas[$i]["t6"] <= 0){

                    $t6 = '';
                    
                }else{

                    $t6 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t6"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T7
                */
                if( $trusas[$i]["t7"] <= 0){

                    $t7 = '';
                    
                }else{

                    $t7 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t7"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T8
                */
                if( $trusas[$i]["t8"] <= 0){

                    $t8 = '';
                    
                }else{

                    $t8 = "<b><center><span style='color:#000080;'>".$trusas[$i]["t8"]."</span></center></b>";

                }

        
                $datosJson .= '[
                "<b>'.$trusas[$i]["mes"].'</b>",
                "'.$trusas[$i]["fecha"].'",
                "<b><center>'.$trusas[$i]["cod_trab"].'</center></b>",
                "'.$trusas[$i]["nom_tip_trabajador"].'",
                "'.$trusas[$i]["trabajador"].'",
                "'.$trusas[$i]["cod_operacion"].'",
                "<b>'.$trusas[$i]["nombre"].'</b>",
                "<b>'.$trusas[$i]["modelo"].'</b>",
                "'.$trusas[$i]["cod_color"].'",
                "'.$trusas[$i]["color"].'",
                "'.$t1.'",
                "'.$t2.'",
                "'.$t3.'",
                "'.$t4.'",
                "'.$t5.'",
                "'.$t6.'",
                "'.$t7.'",
                "'.$t8.'",
                "<b><center>'.$trusas[$i]["total"].'</center></b>",
                "'.number_format($trusas[$i]["total_precio"],2).'",
                "<center>'.$trusas[$i]["minutos"].'</center>",
                "<b><center>'.number_format($trusas[$i]["eficiencia"],2).' %</center></b>"

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
$activarTrusas = new TablaProduccionTrusas();
$activarTrusas -> mostrarTablaProduccionTrusas();