<?php

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

class TablaProductosServicios{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaProductosServicios(){
    

        $articulos = controladorArticulos::ctrMostrarArticulosServicio();	
        if(count($articulos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

        

        // if($articulos[$i]["taller"] <= 0){

        //     $taller = "<button class='btn btn-danger'>".$articulos[$i]["taller"]."</button>";

        // }else{

        //     $taller = "<button class='btn btn-success'>".$articulos[$i]["taller"]."</button>";

        // }        

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-primary agregarProducto recuperarBoton' articuloServicio='".$articulos[$i]["articulo"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>"; 

            $datosJson .= '[
            "'.$articulos[$i]["articulo"].'",
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["nombre"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$articulos[$i]["servicio"].'",
            "'.$articulos[$i]["taller"].'",
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductosServicios = new TablaProductosServicios();
$activarProductosServicios -> mostrarTablaProductosServicios();