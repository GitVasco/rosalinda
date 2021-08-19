<?php

require_once "../controladores/vendedor.controlador.php";
require_once "../modelos/vendedor.modelo.php";


class AjaxVendedores{
    /*=============================================
      EDITAR VENDEDOR
      =============================================*/ 
    
      public $idVendedor;
    
      public function ajaxEditarVendedor(){
        $item="id";
        $valor = $this->idVendedor;
    
        $respuesta = ControladorVendedores::ctrMostrarVendedores($item,$valor);
    
        echo json_encode($respuesta);
    
      }
    
    }
    
    
    /*=============================================
    EDITAR VENDEDOR
    =============================================*/	
    if(isset($_POST["idVendedor"])){
    
        $tipoPago = new AjaxVendedores();
        $tipoPago -> idVendedor = $_POST["idVendedor"];
        $tipoPago -> ajaxEditarVendedor();
    }
    