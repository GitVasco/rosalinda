<?php

require_once "../controladores/agencia.controlador.php";
require_once "../modelos/agencia.modelo.php";

class AjaxAgencias{
/*=============================================
  EDITAR AGENCIAS
  =============================================*/ 

  public $idAgencia;

  public function ajaxEditarAgencia(){
    $item="id";
    $valor = $this->idAgencia;

    $respuesta = ControladorAgencias::ctrMostrarAgencias($item,$valor);

    echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR AGENCIAS
=============================================*/	
if(isset($_POST["idAgencia"])){

	$agencia = new AjaxAgencias();
	$agencia -> idAgencia = $_POST["idAgencia"];
	$agencia -> ajaxEditarAgencia();
}
