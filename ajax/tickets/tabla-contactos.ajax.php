<?php
session_start();

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

/* require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";
 */
class TablaContactos{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaContactos(){

        $item = null;     
        $valor = null;
        $id = $_SESSION["id"];

        $contactos = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);	
        if(count($contactos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($contactos); $i++){

            /*=============================================
            TRAEMOS LA IMAGEN
            =============================================*/ 
            if($contactos[$i]["foto"] == ""){

                $imagen = "<img src='vistas/img/usuarios/default/anonymous.png' class='img-thumbnail' width='40px'>";

            }else{

                $imagen = "<img src='".$contactos[$i]["foto"]."' class='img-thumbnail' width='40px'>";

            }

            /* 
            * TRAEMOS EL ESTADO
            */
            if($contactos[$i]["estado"] == 1){

                $estado = "<span style='font-size:85%' class='label label-success'>Activo</span>";

            }else{

                $estado = "<span style='font-size:85%' class='label label-danger'>Inactivo</span>";

            }

                 
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
        
            if($contactos[$i]["id"] == $id){

                $botones =  "<div class='btn-group'><button class='btn bxs btn-warning btnEditarPerfil' title='Editar Foto' idUsuario='".$contactos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarPerfil'><i class='fa fa-picture-o'></i></button></div>"; 

            }else{
                
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-primary  btnChat' title='Enviar Mensaje' de='".$contactos[$i]["id"]."' para='".$_SESSION["id"]."'><i class='fa fa-envelope-o'></i></button></div>"; 

            }


      
            $datosJson .= '[
            "'.$contactos[$i]["id"].'",
            "'.$contactos[$i]["nombre"].'",
            "'.$contactos[$i]["usuario"].'",
            "'.$imagen.'",
            "'.$contactos[$i]["perfil"].'",
            "'.$estado.'",
            "'.$contactos[$i]["ultimo_login"].'",
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
ACTIVAR TABLA DE ARTICULOS
=============================================*/ 
$activarContactos = new TablaContactos();
$activarContactos -> mostrarTablaContactos();