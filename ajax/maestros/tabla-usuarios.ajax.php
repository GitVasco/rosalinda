<?php

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

class TablaUsuarios{

    /*=============================================
    MOSTRAR LA TABLA DE USUARIOS
    =============================================*/ 

    public function mostrarTablaUsuarios(){

        $item = null;
        $valor = null;

        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
        if(count($usuarios)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($usuarios); $i++){  

        if($usuarios[$i]["estado"] != 0){

            $estado = "<button class='btn btn-success btn-xs btnActivarUS' idUsuario='".$usuarios[$i]["id"]."' estadoUsuario='0'>Activado</button>";

        }else{

            $estado = "<button class='btn btn-danger btn-xs btnActivarUS' idUsuario='".$usuarios[$i]["id"]."' estadoUsuario='1'>Desactivado</button>";

        }

        if($usuarios[$i]["foto"] != ""){

            $foto= "<img src='".$usuarios[$i]["foto"]."' class='img-thumbnail' width='40px'>";

          }else{

            $foto= "<img src='vistas/img/usuarios/default/anonymous.png' class='img-thumbnail' width='40px'>";

          }

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarUsuario' idUsuario='".$usuarios[$i]["id"]."' data-toggle='modal' data-target='#modalEditarUsuario' title='Editar Usuario'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarUsuario' idUsuario='".$usuarios[$i]["id"]."' fotoUsuario='".$usuarios[$i]["foto"]."' usuario='".$usuarios[$i]["usuario"]."' title='Eliminar Usuario'><i class='fa fa-times'></i></button><button class='btn btn-xs btn-primary btnEditarCorreo' idUsuario='".$usuarios[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCorreo' title='Envio correo datos'><i class='fa fa-envelope'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$usuarios[$i]["nombre"].'",
            "'.$usuarios[$i]["usuario"].'",
            "'.$foto.'",
            "'.$usuarios[$i]["perfil"].'",
            "'.$estado.'",
            "'.$usuarios[$i]["ultimo_login"].'",
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
ACTIVAR TABLA USUARIOS
=============================================*/ 
$activarTablaUsuario = new TablaUsuarios();
$activarTablaUsuario -> mostrarTablaUsuarios();

