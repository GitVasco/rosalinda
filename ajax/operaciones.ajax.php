<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class AjaxOperaciones{
/*=============================================
  EDITAR OPERACIONES
  =============================================*/ 

  public $idOperacion;
  public $traerOperaciones;
  public $nombreOperacion;
  public $codigoOperacion;

  public function ajaxEditarOperacion(){
    $item="id";
    $valor = $this->idOperacion;

    $respuesta = ControladorOperaciones::ctrMostrarOperaciones($item,$valor);

    echo json_encode($respuesta);

  }
  public function ajaxVerOperacion(){
    $item="codigo";
    $valor = $this->codigoOperacion;

    $respuesta = ControladorOperaciones::ctrMostrarOperaciones($item,$valor);

    echo json_encode($respuesta);

  }
  
  /*=============================================
	VALIDAR CODIGO OPERACION
	=============================================*/	
	public $codigoOpe;
	public function ajaxValidarOperaciones(){
		$item="codigo";
		$valor=$this->codigoOpe;
		$respuesta=ControladorOperaciones::ctrMostrarOperaciones($item,$valor);
		echo json_encode($respuesta);
	}
}


/*=============================================
EDITAR OPERACION
=============================================*/	
if(isset($_POST["idOperacion"])){

	$operacion = new AjaxOperaciones();
	$operacion -> idOperacion = $_POST["idOperacion"];
	$operacion -> ajaxEditarOperacion();
}

/*=============================================
TRAER OPERACION
=============================================*/ 

if(isset($_POST["traerOperaciones"])){

  $traerOperaciones = new AjaxOperaciones();
  $traerOperaciones -> traerOperaciones = $_POST["traerOperaciones"];
  $traerOperaciones -> ajaxEditarOperacion();
}  

/*=============================================
TRAER NOMBRE OPERACION
=============================================*/ 

if(isset($_POST["nombreOperacion"])){

  $traerOperaciones = new AjaxOperaciones();
  $traerOperaciones -> nombreOperacion = $_POST["nombreOperacion"];
  $traerOperaciones -> ajaxEditarOperacion();

}

/*=============================================
TRAER POR CODIGO
=============================================*/ 
if(isset($_POST["codigoOperacion"])){

	$operacion = new AjaxOperaciones();
	$operacion -> codigoOperacion = $_POST["codigoOperacion"];
	$operacion -> ajaxVerOperacion();
}


/*=============================================
VALIDAR CODIGO
=============================================*/ 
if(isset($_POST["codigoOpe"])){
	$validarCodigo=new AjaxOperaciones();
	$validarCodigo->codigoOpe=$_POST["codigoOpe"];
	$validarCodigo->ajaxValidarOperaciones();
}