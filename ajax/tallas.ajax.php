<?php

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";

class AjaxTallas{

	/*=============================================
	VER TALLAS POR GRUPO
	=============================================*/	

	public $grupo;

	public function ajaxVerTalla(){

		$item = "nombre_grupo";
		$valor = $this->grupo;

		$respuesta = ControladorModelos::ctrMostrarTallas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
VER TALLA POR GRUPO
=============================================*/	
if(isset($_POST["grupo"])){

	$talla = new AjaxTallas();
	$talla -> grupo = $_POST["grupo"];
	$talla -> ajaxVerTalla();
}
