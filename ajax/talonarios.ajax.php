<?php

require_once "../controladores/talonarios.controlador.php";
require_once "../modelos/talonarios.modelo.php";

require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";

class AjaxTalonarios{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxTraerTalonario(){

		$valor = $this->documento;

		$respuesta = ControladorTalonarios::ctrMostrarTalonarios($valor);

		echo json_encode($respuesta);

	}

	public function ajaxTraerSerieCredito(){

		$valor = $this->notaCredito;

		$respuesta = ControladorFacturacion::ctrMostrarTalonarios(null,null);

		echo json_encode($respuesta);

	}

	public function ajaxTraerSerieDebito(){

		$valor = $this->notaDebito;

		$respuesta = ControladorFacturacion::ctrMostrarTalonariosDebito(null,null);

		echo json_encode($respuesta);

	}
	
	
	public function ajaxTraerNotaCredito(){

		$valor = $this->serie;

		$respuesta = ControladorFacturacion::ctrMostrarTalonarios("serie_nc",$valor);

		echo json_encode($respuesta);

	}
	
	public function ajaxTraerNotaDebito(){

		$valor = $this->serieDebito;

		$respuesta = ControladorFacturacion::ctrMostrarTalonariosDebito("serie_nd",$valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["documento"])){

	$talonario = new AjaxTalonarios();
	$talonario -> documento = $_POST["documento"];
	$talonario -> ajaxTraerTalonario();
}

/*=============================================
TRAER NOTA DE CREDITO
=============================================*/	
if(isset($_POST["serie"])){

	$talonarioCredito = new AjaxTalonarios();
	$talonarioCredito -> serie = $_POST["serie"];
	$talonarioCredito -> ajaxTraerNotaCredito();
}

/*=============================================
TRAER NOTA DE DEBITO
=============================================*/	
if(isset($_POST["serieDebito"])){

	$talonarioDebito = new AjaxTalonarios();
	$talonarioDebito -> serieDebito = $_POST["serieDebito"];
	$talonarioDebito -> ajaxTraerNotaDebito();
}
/*=============================================
TRAER SERIE DE CREDITO
=============================================*/	
if(isset($_POST["notaCredito"])){

	$serieCredito = new AjaxTalonarios();
	$serieCredito -> notaCredito = $_POST["notaCredito"];
	$serieCredito -> ajaxTraerSerieCredito();
}


/*=============================================
TRAER SERIE DE CREDITO
=============================================*/	
if(isset($_POST["notaDebito"])){

	$serieDebito = new AjaxTalonarios();
	$serieDebito -> notaDebito = $_POST["notaDebito"];
	$serieDebito -> ajaxTraerSerieDebito();
}