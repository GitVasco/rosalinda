<?php

require_once "../../controladores/cortes.controlador.php";
require_once "../../modelos/cortes.modelo.php";

class TablaCortes{

    /*
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaCortes(){

        $valor1 = null;
        $valor2 = null;

        $cortes = ControladorCortes::ctrMostrarCortes($valor1, $valor2);
        if(count($cortes)>0){

        #var_dump("almacencorte", $cortes);

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($cortes); $i++){

            /*
            todo: Modelo
            */
            $modelo = "<b><span style='font-size:100%' class='text-primary'>".$cortes[$i]["modelo"]."</span></b>";

            /*
            todo: Almacen de Corte
            */
            $alm_corteI = number_format($cortes[$i]["alm_corte"],0);
            $alm_corte = "<center><b><span style='font-size:100%' class='text-default'>".$alm_corteI."</span></b></center>";

            /*
            todo: BOTONES
            */
            $botones =  "<div class='btn-group'><button class='btn btn-primary btnMandarTaller' articulo='".$cortes[$i]["articulo"]."' data-toggle='modal' data-target='#modalMandarTaller'><i class='fa fa-users'></i></button></div>"; 

                $datosJson .= '[
                "'.$cortes[$i]["articulo"].'",
                "'.$cortes[$i]["marca"].'",
                "'.$modelo.'",
                "'.$cortes[$i]["nombre"].'",
                "'.$cortes[$i]["color"].'",
                "'.$cortes[$i]["talla"].'",
                "'.$alm_corte.'",
                "'.$botones.'"
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