<?php

require_once "../controladores/asistencia.controlador.php";
require_once "../modelos/asistencia.modelo.php";

class AjaxAsistencias{

	/*=============================================
	EDITAR ASISTENCIA
	=============================================*/	

	public $idAsistencia;

	public function ajaxEditarAsistencia(){

		$item = "id";
		$valor = $this->idAsistencia;

		$respuesta = ControladorAsistencias::ctrMostrarAsistencias($item, $valor);

		echo json_encode($respuesta);

	}

	//ACTIVAR ASISTENCIA
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarAsistencia(){

		$tabla="asistenciasjf";
		$valor1=$this->activarEstado;
		$valor2=$this->activarId;

		$respuesta=ModeloAsistencias::mdlActualizarAsistencia($tabla,$valor1, $valor2);

		echo $respuesta;
	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idAsistencia"])){

	$asistencia = new AjaxAsistencias();
	$asistencia -> idAsistencia = $_POST["idAsistencia"];
	$asistencia -> ajaxEditarAsistencia();
}
/*=============================================
ACTIVAR ASISTENCIA
=============================================*/ 

if(isset($_POST["activarId"])){
	$activar=new AjaxAsistencias();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxActivarDesactivarAsistencia();
}
