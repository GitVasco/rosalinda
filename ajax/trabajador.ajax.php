<?php
require_once "../controladores/trabajador.controlador.php";
require_once "../modelos/trabajador.modelo.php";

// require_once "../controladores/tipodocumento.controlador.php";
// require_once "../modelos/tipodocumento.modelo.php";

class AjaxTrabajador{

  // GENERAR EL CODIGO

  public $idTrabajador;

  /*=============================================
  EDITAR TRABAJADOR
  =============================================*/ 
 
  public function ajaxEditarTrabajador(){
      
    $item="cod_tra";
    $valor = $this->idTrabajador;

    $respuesta = ControladorTrabajador::ctrMostrarTrabajador($item,$valor);

    echo json_encode($respuesta);

  }
  
  //ACTIVAR TRABAJADOR
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarTrabajador(){

		$tabla="trabajadorjf";
		$valor1=$this->activarEstadoTrabajador;
		$valor2=$this->activarTrabajador;

		$respuesta=ModeloTrabajador::mdlActualizarTrabajador($tabla,$valor1,$valor2);

		echo $respuesta;
	}


	public function ajaxActivarDesactivarTrabajador2(){

		$tabla="trabajadores_graljf";
		$valor1=$this->activarEstadoTrabajador2;
		$valor2=$this->activarTrabajador2;

		$respuesta=ModeloTrabajador::mdlActualizarTrabajador2($tabla,$valor1,$valor2);

		echo $respuesta;
	}
}

/*=============================================
EDITAR TRABAJADOR
=============================================*/	
if(isset($_POST["idTrabajador"])){

	$trabajador = new AjaxTrabajador();
	$trabajador -> idTrabajador = $_POST["idTrabajador"];
	$trabajador -> ajaxEditarTrabajador();
}
/*=============================================
ACTIVAR TRABAJADOR
=============================================*/ 

if(isset($_POST["activarTrabajador"])){
	$activarTrabajador=new AjaxTrabajador();
	$activarTrabajador->activarTrabajador=$_POST["activarTrabajador"];
	$activarTrabajador->activarEstadoTrabajador=$_POST["activarEstadoTrabajador"];
	$activarTrabajador->ajaxActivarDesactivarTrabajador();
}

if(isset($_POST["activarTrabajador2"])){
	$activarTrabajador2=new AjaxTrabajador();
	$activarTrabajador2->activarTrabajador2=$_POST["activarTrabajador2"];
	$activarTrabajador2->activarEstadoTrabajador2=$_POST["activarEstadoTrabajador2"];
	$activarTrabajador2->ajaxActivarDesactivarTrabajador2();
}