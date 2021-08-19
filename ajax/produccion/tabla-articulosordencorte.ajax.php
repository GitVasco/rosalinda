<?php

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

class TablaArticulosOrdenCorte{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarArticuloOrdenCorte(){

        $articulos = controladorArticulos::ctrMostrarArticulosUrgencia();	
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
        todo> COLORES
        */    

        if($articulos[$i]["cod_color"] == "01"){

            $colores = "<b><span style='color:".$blanco."; background-color:".$bgplomo." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "02"){

            $colores = "<b><span style='color:".$beige."; background-color:".$bgnegro." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "03"){

            $colores = "<b><span style='color:".$negro."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "04"){

            $colores = "<b><span style='color:".$plomo."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "05"){

            $colores = "<b><span style='color:".$turquesa."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "06"){  

            $colores = "<b><span style='color:".$chicle."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "07"){  

            $colores = "<b><span style='color:".$coral."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "08"){  

            $colores = "<b><span style='color:".$celeste."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "09"){  

            $colores = "<b><span style='color:".$rosado."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "10"){  

            $colores = "<b><span style='color:".$rojo."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "11" || $articulos[$i]["cod_color"] == "26"){  

            $colores = "<b><span style='color:".$azalea."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "12" || $articulos[$i]["cod_color"] == "14"){  

            $colores = "<b><span style='color:".$perla."; background-color:".$bgnegro." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "13"){  

            $colores = "<b><span style='color:".$verdeLima."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "18"){  

            $colores = "<b><span style='color:".$vaqua."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "19"){  

            $colores = "<b><span style='color:".$lila."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "20"){  

            $colores = "<b><span style='color:".$marron."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "21"){  

            $colores = "<b><span style='color:".$vino."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "22"){  

            $colores = "<b><span style='color:".$uva."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "23"){  

            $colores = "<b><span style='color:".$azulino."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "28"){  

            $colores = "<b><span style='color:".$amarillo."; background-color:".$bgnegro." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "29"){  

            $colores = "<b><span style='color:".$melon."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }else if($articulos[$i]["cod_color"] == "30"){  

            $colores = "<b><span style='color:".$cobalto."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        } 
        else{
            //blanco 2 - naranja - platano - surtido - perico 
            $colores = "<b><span style='color:".$negro."; background-color:".$bgblanco." ;'>".$articulos[$i]["color"]."</span></b>";

        }

        /* 
        todo: PROYECCION
        */
        if($articulos[$i]["proyeccion"] > 0){

            $proyeccion = "<b><span style='color:".$verde."; background-color:".$bgblanco." ;'>".$articulos[$i]["proyeccion"]."</span></b>";

        }else{

            $proyeccion = "<b><span style='color:".$vino."; background-color:".$bgblanco." ;'>".$articulos[$i]["proyeccion"]."</span></b>";

        }
    
        /* 
        todo: PRODUCCION
        */
        if($articulos[$i]["prod"] > 0){

            $prod = "<b><span style='color:".$azulino."; background-color:".$bgblanco." ;'>".$articulos[$i]["prod"]."</span></b>";

        }else{

            $prod = "<b><span style='color:".$neutro."; background-color:".$bgblanco." ;'>".$articulos[$i]["prod"]."</span></b>";

        }

        /* 
        todo: AVANCE
        */
        if($articulos[$i]["avance"] >= '100' || $articulos[$i]["avance"] == 'NP'){

            $avance = "<b><span style='color:".$verdeLima."; background-color:".$bgblanco." ;'>".$articulos[$i]["avance"]." %</span></b>";

        }else{

            $avance = "<b><span style='color:".$rojo."; background-color:".$bgblanco." ;'>".$articulos[$i]["avance"]." %</span></b>";

        }
        
        /* 
        todo: SUMPROG
        */
        $sumprog = $articulos[$i]["prod"] + $articulos[$i]["ord_corte"] + $articulos[$i]["alm_corte"] + $articulos[$i]["taller"];

        /* 
        todo: VENTAS GENERAL
        */
        $ventasG = $articulos[$i]["ventas"] + $articulos[$i]["pedidos"];
        
        
        /* 
        todo: BOTONES
        */                
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarArt recuperarBoton' articuloOC='".$articulos[$i]["articulo"]."' ventasG='".$ventasG."' proyeccion='".$articulos[$i]["proyeccion"]."' sumprog='".$sumprog."'><i class='fa fa-plus-circle'></i></button></div>";
        
        /* 
        todo: PEDIDOS
        */
        if( $articulos[$i]["pedidos"] > 0){

            $pedidos = "<center><b><span style='color:".$azulino."; background-color:".$bgblanco." ;'>".$articulos[$i]["pedidos"]."</span></b></center>";

        }else{

            $pedidos = "<center><b><span style='color:".$neutro."; background-color:".$bgblanco." ;'>".$articulos[$i]["pedidos"]."</span></b></center>";

        }

        /* 
        todo: STOCK
        */
        if( $articulos[$i]["stockB"] >= 0){

            $stock = "<center><b><span style='color:".$cobalto."; background-color:".$bgblanco." ;'>".$articulos[$i]["stockB"]."</span></b></center>";

        }else{

            $stock = "<center><b><span style='color:".$rojo."; background-color:".$bgrosado." ;'>".$articulos[$i]["stockB"]."</span></b></center>";

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

        /* 
        todo: XPROG
        */
        if( $articulos[$i]["xprog"] > 100 ){

            $xprog = "<center><b><span style='color:".$neutro."; background-color:".$bgblanco." ;'>".$articulos[$i]["xprog"]." %</span></b></center>";

        }else{

            $xprog = "<center><b><span style='color:".$vino."; background-color:".$bgrosado." ;'>".$articulos[$i]["xprog"]." %</span></b></center>";

        }

      


            $datosJson .= '[
            "'.$botones.'",
            "'.$articulos[$i]["modelo"].'",
            "'.$colores.'",
            "'.$articulos[$i]["talla"].'",
            "'.$proyeccion.'",
            "'.$prod.'",
            "'.$avance.'",
            "'.$stock.'",
            "'.$pedidos.'",
            "'.$taller.'",
            "'.$alm_corte.'",
            "'.$ord_corte.'",
            "<center>'.$articulos[$i]["ventas"].'</center>",
            "'.$xprog.'"            
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
$activarArticuloOrdenCorte = new TablaArticulosOrdenCorte();
$activarArticuloOrdenCorte -> mostrarArticuloOrdenCorte();