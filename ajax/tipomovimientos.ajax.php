<?php

require_once "../controladores/tipomovimiento.controlador.php";
require_once "../modelos/tipomovimiento.modelo.php";

class AjaxTipoMovimientos{
/*=============================================
  EDITAR TIPO DE MOVIMIENTO
  =============================================*/ 

  public $idTipoMovimiento;

  public function ajaxEditarTipoMovimiento(){
    $item="id";
    $valor = $this->idTipoMovimiento;

    $respuesta = ControladorTipoMovimientos::ctrMostrarTipoMovimientos($item,$valor);

    echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR TIPO DE MOVIMIENTO
=============================================*/	
if(isset($_POST["idTipoMovimiento"])){

	$tipoMovimiento = new AjaxTipoMovimientos();
	$tipoMovimiento -> idTipoMovimiento = $_POST["idTipoMovimiento"];
	$tipoMovimiento -> ajaxEditarTipoMovimiento();
}
