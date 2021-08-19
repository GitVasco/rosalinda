<?php

require_once "../controladores/tipopago.controlador.php";
require_once "../modelos/tipopago.modelo.php";


class AjaxTipoPagos{
    /*=============================================
      EDITAR TIPO DE PAGO
      =============================================*/ 
    
      public $idTipoPago;
    
      public function ajaxEditarTipoPago(){
        $item="id";
        $valor = $this->idTipoPago;
    
        $respuesta = ControladorTipoPagos::ctrMostrarTipoPagos($item,$valor);
    
        echo json_encode($respuesta);
    
      }
    
    }
    
    
    /*=============================================
    EDITAR TIPO DE PAGO
    =============================================*/	
    if(isset($_POST["idTipoPago"])){
    
        $tipoPago = new AjaxTipoPagos();
        $tipoPago -> idTipoPago = $_POST["idTipoPago"];
        $tipoPago -> ajaxEditarTipoPago();
    }
    