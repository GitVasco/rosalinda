<?php

require_once "../controladores/colores.controlador.php";
require_once "../modelos/colores.modelo.php";

class AjaxColores{

	/*=============================================
	EDITAR COLOR
	=============================================*/	

	public $idColor;

	public function ajaxEditarColor(){

		$valor = $this->idColor;

		$respuesta = ControladorColores::ctrMostrarColores($valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR COLOR
=============================================*/	

if(isset($_POST["idColor"])){

	$color = new AjaxColores();
	$color -> idColor = $_POST["idColor"];
	$color -> ajaxEditarColor();

}

if(isset($_POST["idColores"])){

	$colores = new AjaxColores();
	$colores -> idColor = $_POST["idColores"];
	$colores -> ajaxEditarColor();

}