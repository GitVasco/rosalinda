<?php

require_once "../../controladores/almacencorte.controlador.php";
require_once "../../modelos/almacencorte.modelo.php";

class TablaArticulosAlmacenCorte{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarArticuloAlmacenCorte(){

        $articulos = controladorAlmacenCorte::ctrMostarArticulosOrdCorte();	
        if(count($articulos)>0){
        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

        /* 
        todo: CARNTIDAD DE LA ORDEN DE CORTE
        */
        if( $articulos[$i]["cantidad"] >0 ){

            $cantidad = "<center><b><span class='text-default'>".$articulos[$i]["cantidad"]."</span></b></center>";

        }else{

            $cantidad = "<center>".$articulos[$i]["cantidad"]."</center>";
            
        }
        
        /* 
        todo: SALDO
        */
        if($articulos[$i]["saldo"] < $articulos[$i]["cantidad"]){

            $saldo = "<center><b><span class='text-danger'>".$articulos[$i]["saldo"]."</span></b></center>";

        }else{

            $saldo = "<center><b><span class='text-default'>".$articulos[$i]["saldo"]."</span></b></center>";

        }
        /* 
        todo 
        */
        if($articulos[$i]["alm_corte"] > 0){

            $alm_corte = "<center><b><span class='text-success'>".$articulos[$i]["alm_corte"]."</span></b></center>";

        }else{

            $alm_corte = "<center><b><span class='text-danger'>".$articulos[$i]["alm_corte"]."</span></b></center>";

        }

    
        /* 
        todo: BOTONES
        */                
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarArtAC recuperarBoton' idCorte='".$articulos[$i]["id"]."' ordcorte='".$articulos[$i]["ordencorte"]."'  saldo='".$articulos[$i]["saldo"]."' articuloAC='".$articulos[$i]["articulo"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>";
        
            $datosJson .= '[
            "'.$botones.'",
            "'.$articulos[$i]["ordencorte"].'",
            "'.$articulos[$i]["modelo"].$articulos[$i]["cod_color"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$cantidad.'",
            "'.$saldo.'",
            "'.$alm_corte.'"
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
$activarArticuloAlmacenCorte = new TablaArticulosAlmacenCorte();
$activarArticuloAlmacenCorte -> mostrarArticuloAlmacenCorte();