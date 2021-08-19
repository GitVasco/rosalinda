<?php

require_once "../controladores/paras.controlador.php";
require_once "../modelos/paras.modelo.php";

class AjaxParas{

	/*=============================================
	EDITAR PARA
	=============================================*/	

	public $idPara;

	public function ajaxEditarPara(){

		$item = "id";
		$valor = $this->idPara;

		$respuesta = ControladorParas::ctrMostrarParas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR PARA
=============================================*/	
if(isset($_POST["idPara"])){

	$para = new AjaxParas();
	$para -> idPara = $_POST["idPara"];
	$para -> ajaxEditarPara();
}
