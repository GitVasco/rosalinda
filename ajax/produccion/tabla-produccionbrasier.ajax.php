<?php

require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";

class TablaProduccionBrasier{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCCION TRUSAS
    =============================================*/ 

    public function mostrarTablaProduccionBrasier(){
   
        $brasier = ControladorTalleres::ctrMostrarProduccionBrasier($_GET["fechaInicial"],$_GET["fechaFinal"]);	

        if(count($brasier)>0){

            $datosJson = '{
            "data": [';

            for($i = 0; $i < count($brasier); $i++){

                /* 
                * QUITAMOS LOS CEROS - T1
                */
                if( $brasier[$i]["t1"] <= 0){

                    $t1 = '';
                    
                }else{

                    $t1 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t1"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T2
                */
                if( $brasier[$i]["t2"] <= 0){

                    $t2 = '';
                    
                }else{

                    $t2 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t2"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T3
                */
                if( $brasier[$i]["t3"] <= 0){

                    $t3 = '';
                    
                }else{

                    $t3 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t3"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T4
                */
                if( $brasier[$i]["t4"] <= 0){

                    $t4 = '';
                    
                }else{

                    $t4 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t4"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T5
                */
                if( $brasier[$i]["t5"] <= 0){

                    $t5 = '';
                    
                }else{

                    $t5 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t5"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T6
                */
                if( $brasier[$i]["t6"] <= 0){

                    $t6 = '';
                    
                }else{

                    $t6 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t6"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T7
                */
                if( $brasier[$i]["t7"] <= 0){

                    $t7 = '';
                    
                }else{

                    $t7 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t7"]."</span></center></b>";

                }

                /* 
                * QUITAMOS LOS CEROS - T8
                */
                if( $brasier[$i]["t8"] <= 0){

                    $t8 = '';
                    
                }else{

                    $t8 = "<b><center><span style='color:#000080;'>".$brasier[$i]["t8"]."</span></center></b>";

                }

        
                $datosJson .= '[
                "<b>'.$brasier[$i]["mes"].'</b>",
                "'.$brasier[$i]["fecha"].'",
                "<b><center>'.$brasier[$i]["cod_trab"].'</center></b>",
                "'.$brasier[$i]["nom_tip_trabajador"].'",
                "'.$brasier[$i]["trabajador"].'",
                "'.$brasier[$i]["cod_operacion"].'",
                "<b>'.$brasier[$i]["nombre"].'</b>",
                "<b>'.$brasier[$i]["modelo"].'</b>",
                "'.$brasier[$i]["cod_color"].'",
                "'.$brasier[$i]["color"].'",
                "'.$t1.'",
                "'.$t2.'",
                "'.$t3.'",
                "'.$t4.'",
                "'.$t5.'",
                "'.$t6.'",
                "'.$t7.'",
                "'.$t8.'",
                "<b><center>'.$brasier[$i]["total"].'</center></b>",
                "'.number_format($brasier[$i]["total_precio"],2).'",
                "<center>'.$brasier[$i]["minutos"].'</center>",
                "<b><center>'.number_format($brasier[$i]["eficiencia"],2).' %</center></b>"

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
$activarBrasier = new TablaProduccionBrasier();
$activarBrasier -> mostrarTablaProduccionBrasier();