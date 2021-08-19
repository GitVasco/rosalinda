<?php

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

class TablaUrgencias{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarUrgencias(){

        $valor = null;
        $articulos = controladorArticulos::ctrMostrarUrgencia($valor,$_GET["articuloUrgencia"]);	
        if(count($articulos)>0){

        #var_dump("articulos", $articulos);

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

            /* 
            todo: Modelo
            */
            $modelo = "<b><span style='font-size:100%' class='text-primary'>".$articulos[$i]["modelo"]."</span></b>";

            /* 
            todo: Proyección
            */
            $proyeccionI = number_format($articulos[$i]["proyeccion"],0);
            $proyeccion = "<center><span style='font-size:100%' class='text-success'>".$proyeccionI."</span></center>";

            /* 
            todo: Avance %
            */
            if($articulos[$i]["avance"] <= 90){

                $avanceI = number_format($articulos[$i]["avance"],2);
                $avance = "<center><b><span style='font-size:100%' class='text-success'>".$avanceI." %</span></b></center>";


            }else{

                $avanceI = number_format($articulos[$i]["avance"],2);
                $avance = "<center><b><span style='font-size:100%' class='text-danger'>".$avanceI." %</span></b></center>";

            }

            /* 
            todo: Estado
            */
            if($articulos[$i]["estado"] == "Descontinuado"){

                $estado = "<span style='font-size:80%' class='label label-danger'>Inactivo</span>";

            }else if($articulos[$i]["estado"] == "CampañaD"){

                $estado = "<span style='font-size:80%' class='label label-warning'>CampañaD</span>";

            }else{

                $estado = "<span style='font-size:80%' class='label label-success'>Activo</span>";

            }
            
            /* 
            todo: Stock
            */
            if($articulos[$i]["stockB"] < 0){

                $stockI = number_format($articulos[$i]["stockB"],0);
                $stock = "<center><span style='font-size:85%' class='label label-danger'>".$stockI."</span></center>";

            }else{

                $stockI = number_format($articulos[$i]["stockB"],0);
                $stock = "<center><b>".$stockI."</b></center>";

            }

            /* 
            todo: Pedidos
            */
            $pedidosI = number_format($articulos[$i]["pedidos"],0);
            $pedidos = "<center><b><span style='font-size:100%' class='text-default'>".$pedidosI."</span></b></center>";

            /* 
            todo: Taller
            */
            if($articulos[$i]["taller"] <= 0){

                $tallerI = number_format($articulos[$i]["taller"],0);
                $taller = "<center><b><span style='font-size:100%' class='text-danger'>".$tallerI."</span></b></center>";

            }else{

                $tallerI = number_format($articulos[$i]["taller"],0);
                $taller = "<center><b><span style='font-size:100%' class='text-primary'>".$tallerI."</span></b></center>";

            }

            /* 
            todo: Almacen de corte
            */
            if($articulos[$i]["alm_corte"] <= 0){

                $alm_corteI = number_format($articulos[$i]["alm_corte"],0);
                $alm_corte = "<center><b><span style='font-size:100%' class='text-danger'>".$alm_corteI."</span></b></center>";

            }else{

                $alm_corteI = number_format($articulos[$i]["alm_corte"],0);
                $alm_corte = "<center><b><span style='font-size:100%' class='text-success'>".$alm_corteI."</span></b></center>";

            }

            /* 
            todo: Ord Corte
            */
            if($articulos[$i]["ord_corte"] > 0){

                $ord_corteI = number_format($articulos[$i]["ord_corte"],0);
                $ord_corte = "<center><b><span style='font-size:100%' class='text-secondary'>".$ord_corteI."</span></b></center>";

            }else{

                $ord_corteI = number_format($articulos[$i]["ord_corte"],0);
                $ord_corte = "<center><b><span style='font-size:100%' class='text-danger'>".$ord_corteI."</span></b></center>";

            }

            /* 
            todo: ventas 30 dias
            */
            if($articulos[$i]["ult_mes"] > 0){

                $ult_mesI = number_format($articulos[$i]["ult_mes"],0);
                $ult_mes = "<center><b><span style='font-size:100%' class='text-info'>".$ult_mesI."</span></b></center>";

            }else{

                $ult_mesI = number_format($articulos[$i]["ult_mes"],0);
                $ult_mes = "<center><b><span style='font-size:100%' class='text-danger'>".$ult_mesI."</span></b></center>";

            }

            /*
            todo: BOTONES
            */
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-info btnVerUrgencias' codigo='".$articulos[$i]["articulo"]."' data-toggle='modal' data-target='#modalVisualizarUrgencias'><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-primary btnMpFaltante' codigo='".$articulos[$i]["articulo"]."' data-toggle='modal' data-target='#modalMpFaltante'><i class='fa fa-fire'></i></button></div>"; 

                $datosJson .= '[
                "'.$modelo.'",
                "'.$articulos[$i]["nombre"].'",
                "'.$articulos[$i]["color"].'",
                "'.$articulos[$i]["talla"].'",
                "'.$estado.'",
                "'.$proyeccion.'",
                "'.$avance.'",
                "'.$stock.'",
                "'.$pedidos.'",
                "'.$taller.'",
                "'.$alm_corte.'",
                "'.$ord_corte.'",
                "'.$ult_mes.'",
                "'.$articulos[$i]["mp_faltante"].'",
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
ACTIVAR TABLA DE URGENCIAS  APT
=============================================*/ 
$activarUrgencias = new TablaUrgencias();
$activarUrgencias -> mostrarUrgencias();