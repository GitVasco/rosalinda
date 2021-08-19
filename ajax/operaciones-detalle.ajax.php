<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class AjaxDetalleOperaciones{
/*=============================================
  EDITAR OPERACIONES
  =============================================*/ 

  public $modeloDetalle;

  public function ajaxVerOperacion(){
    $item="modelo";
    $valor = $this->modeloDetalle;

    $respuesta = ControladorOperaciones::ctrVisualizarOperacionDetalle($item,$valor);

    echo json_encode($respuesta);

	}
}


/*=============================================
EDITAR OPERACION
=============================================*/	
if(isset($_POST["modeloDetalle"])){

	$detalleOperacion = new AjaxDetalleOperaciones();
	$detalleOperacion -> modeloDetalle = $_POST["modeloDetalle"];
	$detalleOperacion -> ajaxVerOperacion();
}

