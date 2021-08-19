<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class AjaxDetalleOperaciones{
/*=============================================
  EDITAR OPERACIONES
  =============================================*/ 

  public $idOperacion;

  public function ajaxVerOperacion(){
    $item="id";
    $valor = $this->idOperacion;

    $respuesta = ControladorOperaciones::ctrMostrarCabeceraOperaciones($item,$valor);

    echo json_encode($respuesta);

	}
}


/*=============================================
EDITAR OPERACION
=============================================*/	
if(isset($_POST["idOperacion"])){

	$detalleOperacion = new AjaxDetalleOperaciones();
	$detalleOperacion -> idOperacion = $_POST["idOperacion"];
	$detalleOperacion -> ajaxVerOperacion();
}

