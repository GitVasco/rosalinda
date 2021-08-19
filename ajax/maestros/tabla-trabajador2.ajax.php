<?php

require_once "../../controladores/trabajador.controlador.php";
require_once "../../modelos/trabajador.modelo.php";

class TablaTrabajador2{

    /*=============================================
    MOSTRAR LA TABLA DE TRABAJADORES
    =============================================*/ 

    public function mostrarTablaTrabajador2(){

        $valor = null;

        $trabajador = ControladorTrabajador::ctrMostrarTrabajador2($valor);	
        if(count($trabajador)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($trabajador); $i++){  

        /*=============================================
        ESTADO
        =============================================*/ 

        if($trabajador[$i]["estado"] == 0){

            /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-danger btn-xs btnActivarTrabajador2' idTrabajador2='".$trabajador[$i]["id"]."' estadoTrabajador2='1'>Inactivo</button>";

        }

        else{

            /* $estado = "<button class='btn btn-success btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-success btn-xs btnActivarTrabajador2' idTrabajador2='".$trabajador[$i]["id"]."' estadoTrabajador2='0'>Activo</button>";

        }

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-info  btn-xs btnPaseLaboral' title='Pase laboral de trabajador' codigo='".$trabajador[$i]["id"]."'><i class='fa fa-file-text' ></i></button><button class='btn btn-success btn-xs btnCarnetID' title='Carnet  de trabajador' codigo='".$trabajador[$i]["id"]."' ><i class='fa fa-id-card-o' ></i></button><button class='btn btn-xs btn-warning  btnCarnetIDReves' title='Carnet  de trabajador reversa' codigo='".$trabajador[$i]["id"]."' ><i class='fa fa-id-card-o' ></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$trabajador[$i]["dni"].'",
            "'.$trabajador[$i]["nombres"].'",
            "'.$trabajador[$i]["ape_pat"].'",
            "'.$trabajador[$i]["ape_mat"].'",
            "'.$estado.'",
            "'.$trabajador[$i]["sector"].'",
            "'.$trabajador[$i]["funcion"].'",
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
ACTIVAR TABLA DE OPERACIONES
=============================================*/ 
$activarTrabajador2 = new TablaTrabajador2();
$activarTrabajador2 -> mostrarTablaTrabajador2();