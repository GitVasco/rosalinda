<?php

require_once "../../controladores/tarjetas.controlador.php";
require_once "../../modelos/tarjetas.modelo.php";


class TablaTarjetas{

    /*=============================================
    MOSTRAR LA TABLA DE TARJETAS
    =============================================*/ 

    public function mostrarTablaTarjetas(){

        $item = null;     
        $valor = null;

        $tarjetas = ControladorTarjetas::ctrMostrarTarjetas($item, $valor);	
        if(count($tarjetas)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($tarjetas); $i++){

            
            /*=============================================
            ESTADO TARJETA
            =============================================*/ 

            if($tarjetas[$i]["estado_tarjeta"] == "RE"){

                $estado_tarjeta = "<button class='btn btn-warning btn-xs btnActivarT' idTarjeta='".$tarjetas[$i]["id"]."' estadoTarjeta='AC'>Revisar</button>";
    
            }else{
    
                $estado_tarjeta = "<button class='btn btn-primary btn-xs' idTarjeta='".$tarjetas[$i]["id"]."' estadoTarjeta='RE'>Aprobado</button>";
    
            }

            /*=============================================
            ESTADO ARTICULO
            =============================================*/ 

            if($tarjetas[$i]["estado_articulo"] == "Descontinuado"){

                $estado_articulo = "<span class='label label-danger'>Inactivo</span>";

                
            }else if($tarjetas[$i]["estado_articulo"] == "CAMPAÑAD"){

                $estado_articulo = "<span class='label label-warning'>CampañaD</span>";

            }else{

                $estado_articulo = "<span class='label label-success'>Activo</span>";

            }

            /*=============================================
            formato numero 6 digitos
            =============================================*/ 

            $neto=number_format($tarjetas[$i]["neto"],6);

            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
            
            /* 
            todo: PARA SUPER-SISTEMAS-COSTOS-DISEÑO TIENEN ACCESO TOTAL
            */
            if( $_GET["perfil"]=="Supervisores" ||
                $_GET["perfil"]=="Sistemas" ||
                $_GET["perfil"]=="Costos" ||
                $_GET["perfil"]=="Udp"){

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-info btnVisualizarTarjeta' title='Visualizar Tarjeta' data-toggle='modal' data-target='#modalVisualizarTarjeta' articuloTarjeta='".$tarjetas[$i]["articulo"]."'><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-primary  btnCopiarTarjeta' title='Copiar Tarjeta' idTarjeta='".$tarjetas[$i]["id"]."'><i class='fa fa-files-o'></i></button><button class='btn btn-xs btn-warning  btnEditarTarjeta' title='Editar Tarjeta' idTarjeta='".$tarjetas[$i]["id"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-success  btnAgregarFicha' title='Ficha tecnica' data-toggle='modal' data-target='#modalAgregarFichaTecnica'idTarjeta='".$tarjetas[$i]["id"]."'><i class='fa fa-file-pdf-o'></i></button><button class='btn btn-xs btn-danger  btnEliminarTarjeta' title='Eliminar Tarjeta' idTarjeta='".$tarjetas[$i]["id"]."'><i class='fa fa-times'></i></button></div>";

            }else{

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-info btnVisualizarTarjeta' data-toggle='modal' data-target='#modalVisualizarTarjeta' articuloTarjeta='".$tarjetas[$i]["articulo"]."'><i class='fa fa-eye'></i></button></div>"; 

            }
            

    
                $datosJson .= '[
                "'.$tarjetas[$i]["codigo"].'",
                "'.$estado_tarjeta.'",
                "'.$tarjetas[$i]["fecha"].'",
                "'.$neto.'",
                "'.$tarjetas[$i]["articulo"].'",
                "'.$tarjetas[$i]["modelo"].'",
                "'.$tarjetas[$i]["nombre"].'",
                "'.$tarjetas[$i]["packing"].'",
                "'.$estado_articulo.'",
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
ACTIVAR TABLA DE Tarjetas
=============================================*/ 
$activarTarjetas = new TablaTarjetas();
$activarTarjetas -> mostrarTablaTarjetas();