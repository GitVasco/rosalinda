<?php

require_once "../controladores/unidadmedida.controlador.php";
require_once "../modelos/unidadmedida.modelo.php";

class AjaxUnidadMedidas{
/*=============================================
  EDITAR UNIDAD MEDIDA
  =============================================*/ 

  public $idUnidadMedida;

  public function ajaxEditarUnidadMedida(){
    $item="id";
    $valor = $this->idUnidadMedida;

    $respuesta = ControladorUnidadMedidas::ctrMostrarUnidadMedidas($item,$valor);

    echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR UNIDAD MEDIDA
=============================================*/	
if(isset($_POST["idUnidadMedida"])){

	$unidadmedida = new AjaxUnidadMedidas();
	$unidadmedida -> idUnidadMedida = $_POST["idUnidadMedida"];
	$unidadmedida -> ajaxEditarUnidadMedida();
}
