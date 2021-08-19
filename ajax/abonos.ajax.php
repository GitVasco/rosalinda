<?php

require_once "../controladores/abonos.controlador.php";
require_once "../modelos/abonos.modelo.php";

class AjaxAbonos{

	/*=============================================
	EDITAR ABONO
	=============================================*/	

	public $idAbono;

	public function ajaxEditarAbono(){

		$valor = $this->idAbono;

		$respuesta = ControladorAbonos::ctrMostrarAbonos("id",$valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR ABONO
=============================================*/	

if(isset($_POST["idAbono"])){

	$abono = new AjaxAbonos();
	$abono -> idAbono = $_POST["idAbono"];
	$abono -> ajaxEditarAbono();

}