<?php

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";

class AjaxPrecios{

	/*=============================================
	EDITAR COLOR
	=============================================*/	

	public $modelo;

	public function ajaxVerPrecio(){
        $item="modelo";
		$valor = $this->modelo;

		$respuesta = ControladorModelos::ctrMostrarPrecios($item,$valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
VER PRECIO
=============================================*/	

if(isset($_POST["modelo"])){

	$modelos = new AjaxPrecios();
	$modelos -> modelo = $_POST["modelo"];
	$modelos -> ajaxVerPrecio();

}
