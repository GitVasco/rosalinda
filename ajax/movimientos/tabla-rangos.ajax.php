<?php

require_once "../../controladores/movimientos.controlador.php";
require_once "../../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVtasGerencia(){

        $mes = $_GET["mes"];

        $movimientos = ControladorMovimientos::ctrMostrarRangos($mes);	

        if(count($movimientos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

                $ventas = "<div style='text-align:right !important'>".number_format($movimientos[$i]["ventas"],2)."</div>";

                $cobranza = "<div style='text-align:right !important; color:green'>".number_format($movimientos[$i]["cobranza"],2)."</div>";

                $saldo = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["saldo"],2)."</div>";
                
                if($movimientos[$i]["p15"] > 0){

                    $p15 = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["p15"],2)."</div>";

                }else{

                    $p15 = "<div style='text-align:right !important; color:red'>0</div>";

                }

                if($movimientos[$i]["p16"] > 0){

                    $p16 = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["p16"],2)."</div>";

                }else{

                    $p16 = "<div style='text-align:right !important; color:red'>0</div>";

                }
                
                if($movimientos[$i]["p17"] > 0){

                    $p17 = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["p17"],2)."</div>";

                }else{

                    $p17 = "<div style='text-align:right !important; color:red'>0</div>";

                }
                
                if($movimientos[$i]["p18"] > 0){

                    $p18 = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["p18"],2)."</div>";

                }else{

                    $p18 = "<div style='text-align:right !important; color:red'>0</div>";

                }
                
                if($movimientos[$i]["p19"] > 0){

                    $p19 = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["p19"],2)."</div>";

                }else{

                    $p19 = "<div style='text-align:right !important; color:red'>0</div>";

                }
                
                if($movimientos[$i]["p20"] > 0){

                    $p20 = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["p20"],2)."</div>";

                }else{

                    $p20 = "<div style='text-align:right !important; color:red'>0</div>";

                }
                
                if($movimientos[$i]["p21"] > 0){

                    $p21 = "<div style='text-align:right !important; color:red'>".number_format($movimientos[$i]["p21"],2)."</div>";

                }else{

                    $p21 = "<div style='text-align:right !important; color:red'>0</div>";

                }
                
                if($movimientos[$i]["p22"] > 0){

                    $p22 = "<div style='text-align:right !important; color:blue'>".number_format($movimientos[$i]["p22"],2)."</div>";

                }else{

                    $p22 = "<div style='text-align:right !important; color:blue'>0</div>";

                }                

                $datosJson .= '[
                "'.$movimientos[$i]["codigo"].'",
                "'.$movimientos[$i]["descripcion"].'",
                "<b>'.$ventas.'</b>",
                "<b>'.$cobranza.'</b>",
                "<b>'.$saldo.'</b>",
                "'.$p15.'",
                "'.$p16.'",
                "'.$p17.'",
                "'.$p18.'",
                "'.$p19.'",
                "'.$p20.'",
                "'.$p21.'",
                "'.$p22.'"
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarMovimientos = new TablaMovimientos();
$activarMovimientos -> mostrarTablaVtasGerencia();