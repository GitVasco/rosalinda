<?php

require_once '../controladores/produccion.controlador.php';
require_once '../modelos/produccion.modelo.php';

class AjaxQuincenas{

    /* 
	* Editar quincena
	*/
	public function ajaxEditarQuincena(){

		$valor = $this->id;

		$respuesta = ControladorProduccion::ctrMostrarQuincenas($valor);

		echo json_encode($respuesta);

	}


}

/* 
* Editar qincena
*/
if(isset($_POST["id"])){

	$editarQuincena = new AjaxQuincenas();
	$editarQuincena -> id = $_POST["id"];
	$editarQuincena -> ajaxEditarQuincena();
  
}