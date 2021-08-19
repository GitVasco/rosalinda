<?php

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

class TablaArticulosTaller{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarArticuloTaller(){

        $articulos = controladorArticulos::ctrMostrarArticulosTaller($_GET["sectorIngreso"]);	
        if(count($articulos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

            $bgnegro= "black";
            $bgblanco = "white";
            $bgplomo = "gray";
            $bglanvanda = "lavender";
            $bgrosado = "pink";
            $blanco = "#FFFFFF";
            $negro = "#000000";
            $beige = "#F5F5DC";
            $plomo = "#808080";
            $turquesa = "#40E0D0";
            $chicle = "#FF69B4";
            $coral = "#FF7F50";
            $celeste = "#ADD8E6";
            $rosado = "#FFC0CB";
            $rojo = "#FF0000";
            $azalea = "#FF00FF"; //fucsia
            $perla = "#FAFAD2"; //crema
            $verdeLima = "#32CD32";
            $vaqua = "#66CDAA";
            $lila = "#9370DB";
            $marron ="#A52A2A";
            $vino = "#8B0000";
            $uva = "#800080";
            $azulino = "#0000FF";
            $amarillo = "#FFFF00";
            $melon = "#FA8072";
            $cobalto = "#008080";
            $verde = "#008000";   
            $neutro = "#000000";

       
      /* 
        todo: BOTONES
        */             
        if($articulos[$i]["guia"] == ""){
            $botones =  "<div class='btn-group '><button class='btn btn-primary btn-xs  agregarArtiTaller recuperarBoton' articuloIngreso='".$articulos[$i]["articulo"]."' taller='".$articulos[$i]["taller"]."' articulo='".$articulos[$i]["articulo"]."' idCierre='".$articulos[$i]["id"]."'><i class='fa fa-plus-circle'></i></button></div>";
        }else{
            $botones =  "<div class='btn-group '><button class='btn btn-primary btn-xs  agregarArtiTaller recuperarBoton' articuloIngreso='".$articulos[$i]["id"]."' taller='".$articulos[$i]["taller"]."' articulo='".$articulos[$i]["articulo"]."' idCierre='".$articulos[$i]["id"]."'><i class='fa fa-plus-circle'></i></button></div>";
        }
        
        /* 
        todo: STOCK
        */
        if( $articulos[$i]["stock"] >= 0){

            $stock = "<center><b><span style='color:".$cobalto."; background-color:".$bgblanco." ;'>".$articulos[$i]["stock"]."</span></b></center>";

        }else{

            $stock = "<center><b><span style='color:".$rojo."; background-color:".$bgrosado." ;'>".$articulos[$i]["stock"]."</span></b></center>";

        }

        /* 
        todo: ORDEN CORTE
        */
        if( $articulos[$i]["ord_corte"] >0 ){

            $ord_corte = "<center><b><span style='color:".$neutro."; background-color:".$bgblanco." ;'>".$articulos[$i]["ord_corte"]."</span></b></center>";

        }else{

            $ord_corte = "<center><b><span style='color:".$vino."; background-color:".$bgrosado." ;'>".$articulos[$i]["ord_corte"]."</span></b></center>";
            
        }

        /* 
        todo: ALMACEN DE CORTE
        */
        if( $articulos[$i]["alm_corte"] >0 ){

            $alm_corte = "<center><b><span style='color:".$neutro."; background-color:".$bgblanco." ;'>".$articulos[$i]["alm_corte"]."</span></b></center>";

        }else{

            $alm_corte = "<center><b><span style='color:".$vino."; background-color:".$bgrosado." ;'>".$articulos[$i]["alm_corte"]."</span></b></center>";

        }  

        /* 
        todo: TALLER
        */
        if( $articulos[$i]["taller"] >0 ){

            $taller = "<center><b><span style='color:".$neutro."; background-color:".$bgblanco." ;'>".$articulos[$i]["taller"]."</span></b></center>";

        }else{

            $taller = "<center><b><span style='color:".$vino."; background-color:".$bgrosado." ;'>".$articulos[$i]["taller"]."</span></b></center>";

        }


            $datosJson .= '[
            "<center>'.$articulos[$i]["guia"].'</center>",
            "<center>'.$articulos[$i]["modelo"].'</center>",
            "<center>'.$articulos[$i]["color"].'</center>",
            "<center>'.$articulos[$i]["talla"].'</center>",
            "'.$stock.'",
            "'.$taller.'",
            "'.$alm_corte.'",
            "'.$ord_corte.'",
            "<center>'.$botones.'</center>"
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
$activarArticuloTaller = new TablaArticulosTaller();
$activarArticuloTaller -> mostrarArticuloTaller();