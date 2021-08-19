<?php

require_once "../controladores/condicionventa.controlador.php";
require_once "../modelos/condicionventa.modelo.php";
class AjaxCondicionVentas{
    /*=============================================
      EDITAR CONDICION DE VENTA
      =============================================*/ 
    
      public $idCondicionVenta;
    
      public function ajaxEditarCondicionVenta(){
        $item="id";
        $valor = $this->idCondicionVenta;
    
        $respuesta = ControladorCondicionVentas::ctrMostrarCondicionVentas($item,$valor);
    
        echo json_encode($respuesta);
    
      }
    
    }
    
    
/*=============================================
EDITAR CONDICION DE VENTA
=============================================*/	
if(isset($_POST["idCondicionVenta"])){

    $condicionVenta = new AjaxCondicionVentas();
    $condicionVenta -> idCondicionVenta = $_POST["idCondicionVenta"];
    $condicionVenta -> ajaxEditarCondicionVenta();
}
