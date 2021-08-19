<?php

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

class TablaClientes{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaClientes(){

        $item = null;     
        $valor = null;

        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);	
        if(count($clientes)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($clientes); $i++){

            /* 
            todo: TIPO PERSONA
            */
            if($clientes[$i]["tipo_persona"] == "1"){

                $tipo_persona = "<span style='font-size:85%' class='label label-success'>NATURAL</span>";

                
            }else if($clientes[$i]["tipo_persona"] == "2"){

                $tipo_persona = "<span style='font-size:85%' class='label label-info'>JURÍDICA</span>";

            }else{

                $tipo_persona = "<span style='font-size:85%' class='label label-warning'></span>";

            }
            
            /* 
            todo: TIPO DOCUMENTO
            */
            if($clientes[$i]["tipo_documento"] == "1"){

                $tipo_documento = "<span style='font-size:85%' class='label label-primary'>DNI</span>";
                
            }elseif($clientes[$i]["tipo_documento"] == "6"){

                $tipo_documento = "<span style='font-size:85%' class='label label-danger'>RUC</span>";

            }elseif($clientes[$i]["tipo_documento"] == "0"){

                $tipo_documento = "<span style='font-size:85%' class='label label-warning'>SIN DOC.</span>";

            }elseif($clientes[$i]["tipo_documento"] == "4"){

                $tipo_documento = "<span style='font-size:85%' class='label label-warning'>C. Extra</span>";

            }elseif($clientes[$i]["tipo_documento"] == "7"){

                $tipo_documento = "<span style='font-size:85%' class='label label-warning'>Pasaporte</span>";

            }elseif($clientes[$i]["tipo_documento"] == "A"){

                $tipo_documento = "<span style='font-size:85%' class='label label-warning'>C. Diplom</span>";

            }else{

                $tipo_documento = "<span style='font-size:85%' class='label label-warning'></span>";

            }            


    
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         
            
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarCliente' codigo='".$clientes[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarCliente' title='Editar cliente'><i class='fa fa-pencil' ></i></button><button class='btn btn-xs btn-primary btnEditarAval' title='Editar Aval'  codigo='".$clientes[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarAval'><i class='fa fa-user'></i></button></div>"; 

                $datosJson .= '[
                "'.$clientes[$i]["codigo"].'",
                "'.$clientes[$i]["nombre"].'",
                "'.$tipo_persona.'",
                "'.$tipo_documento.'",
                "'.$clientes[$i]["documento"].'",
                "'.$clientes[$i]["telefono"].'",
                "'.$clientes[$i]["ubigeos"].'",
                "'.$clientes[$i]["fecha"].'",
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
ACTIVAR TABLA DE CLIENTES
=============================================*/ 
$activarClientes = new TablaClientes();
$activarClientes -> mostrarTablaClientes();