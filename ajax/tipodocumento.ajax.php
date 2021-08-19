<?php

require_once "../controladores/tipodocumento.controlador.php";
require_once "../modelos/tipodocumento.modelo.php";

class AjaxTipoDocumento{

	/*=============================================
	EDITAR TIPO DE DOCUMENTO
	=============================================*/	

	public $idTipoDocumento;

	public function ajaxEditarTipoDocumento(){

		$item = "cod_doc";
		$valor = $this->idTipoDocumento;

		$respuesta = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR TIPO DE DOCUMENTO
=============================================*/	
if(isset($_POST["idTipoDocumento"])){

	$tipodocumento = new AjaxTipoDocumento();
	$tipodocumento -> idTipoDocumento = $_POST["idTipoDocumento"];
	$tipodocumento -> ajaxEditarTipoDocumento();
}
