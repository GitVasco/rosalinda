<?php

require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";

class TablaTalleresOperaciones{

    /*
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaTalleresOperaciones(){


        $talleres = ControladorTalleres::ctrRangoFechasTalleresOperaciones($_GET["modeloTallerOp"]);
        #var_dump("almacencorte", $talleres);
        if(count($talleres)>0){
        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($talleres); $i++){

            /*
            todo: ESTADO
            */
            if($talleres[$i]["estado"] == "1"){


                $estado = "<span style='font-size:85%' class='label label-info'>Generado</span>";
    
            }elseif($talleres[$i]["estado"] == "2"){
    
                $estado = "<span style='font-size:85%' class='label label-primary'>En Proceso</span>";
    
            }else{
    
                $estado = "<span style='font-size:85%' class='label label-success'>Terminado</span>";
    
            } 
            $dividir=substr($talleres[$i]["codigo"],-1);
            /*
            todo: BOTONES
            */
            if($talleres[$i]["estado"] == "3"){

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarTallerOperacion' idTaller='".$talleres[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarCantidadOperacion'><i class='fa fa-random'></i></button></div>";

            }else{
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarTallerOperacion' idTaller='".$talleres[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarCantidadOperacion'><i class='fa fa-random'></i></button><button class='btn btn-xs btn-success btnImprimirTicket' ultimo='".$talleres[$i]["codigo"]."'modelo='".$talleres[$i]["modelo"]."'nombre='".$talleres[$i]["nombre"]."'color='".$talleres[$i]["color"]."'talla='".$talleres[$i]["talla"]."'cant_taller='".$talleres[$i]["cantidad"]."'cod_operacion='".$talleres[$i]["cod_operacion"]."'nom_operacion='".$talleres[$i]["nom_operacion"]."'><i class='fa fa-print'></i></button></div>";

            }


                $datosJson .= '[
                "'.$talleres[$i]["id"].'",
                "'.$talleres[$i]["codigo"].'",
                "'.$talleres[$i]["modelo"].'",
                "'.$talleres[$i]["color"].'",
                "'.$talleres[$i]["talla"].'",
                "'.$talleres[$i]["nom_operacion"].'",
                "'.$talleres[$i]["cantidad"].'",
                "'.$talleres[$i]["fecha"].'",
                "'.$estado.'",
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
ACTIVAR TABLA DE TALLERES OPERACIONES
=============================================*/ 
$activarTalleresOperaciones = new TablaTalleresOperaciones();
$activarTalleresOperaciones -> mostrarTablaTalleresOperaciones();