<?php
session_start();
// Requerimos el controlador y el modelo
require_once '../controladores/modelos.controlador.php';
require_once '../modelos/modelos.modelo.php';
require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';

class AjaxModelos{
	//ACTIVAR ARTICULO
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarModelo(){

		$tabla="modelojf";
		$tabla2="articulojf";
		$valor1=$this->activarEstado;
		$valor2=$this->activarId;
		$modelo=ControladorModelos::ctrMostrarModelos("modelo",$valor2);
		$usuario= $_SESSION["nombre"];
		if($valor1 == "Activo"){
			
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se activo un modelo';
			$descripcion   = 'El usuario '.$usuario.' activo el modelo '.$modelo["modelo"].' - '.$modelo["nombre"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if($_SESSION["correo"] == 1){
				mail($para, $asunto, $descripcion, $de);
			  }
			if($_SESSION["datos"] == 1){
				$datos2= array( "usuario" => $usuario,
						"concepto" => $descripcion,
						"fecha" => $fecha->format("Y-m-d H:i:s"));
				$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
			}
		}else{
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se descontinuo un modelo';
			$descripcion   = 'El usuario '.$usuario.' descontinuo el modelo '.$modelo["modelo"].' - '.$modelo["nombre"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if($_SESSION["correo"] == 1){
				mail($para, $asunto, $descripcion, $de);
			}
			if($_SESSION["datos"] == 1){
				$datos2= array( "usuario" => $usuario,
						"concepto" => $descripcion,
						"fecha" => $fecha->format("Y-m-d H:i:s"));
				$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
			}
		}
		$respuesta=ModeloModelos::mdlActualizarModelo($tabla,$tabla2,$valor1, $valor2);

		echo $respuesta;
	}
	/* 
	* EDITAR ARTICULO
	*/
	public $modelo;

	public function ajaxEditarModelo(){

        $item="modelo";
		$valor = $this->modelo;

		$respuesta = ControladorModelos::ctrMostrarModelos($item,$valor);

		echo json_encode($respuesta);

	}


	public function ajaxVerModelo(){

        $item="modelo";
		$valor = $this->modelo;

		$respuesta = ControladorModelos::ctrMostrarModeloArticulo($item,$valor);

		echo json_encode($respuesta);

	}

}


/*=============================================
ACTIVAR ARTICULO
=============================================*/ 

if(isset($_POST["activarId"])){
	$activar=new AjaxModelos();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxActivarDesactivarModelo();
}


/*=============================================
EDITAR ARTICULO
=============================================*/ 

if(isset($_POST["modelo"])){

	$editarModelo = new AjaxModelos();
	$editarModelo -> modelo = $_POST["modelo"];
	$editarModelo -> ajaxEditarModelo();
  
}

/*=============================================
VER MODELO
=============================================*/ 

if(isset($_POST["modelo2"])){

	$verModelo = new AjaxModelos();
	$verModelo -> modelo = $_POST["modelo2"];
	$verModelo -> ajaxVerModelo();
  
}