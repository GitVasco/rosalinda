<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $codigo;

	public function ajaxEditarCliente(){

		$item = "codigo";
		$valor = $this->codigo;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}
	/*=============================================
	VALIDAR DOCUMENTO CLIENTE
	=============================================*/	
	public $documento;
	public function ajaxValidarDocumento(){
		$item="documento";
		$valor=$this->documento;
		$respuesta=ControladorClientes::ctrMostrarClientes($item,$valor);
		echo json_encode($respuesta);
	}

	public $clienteCuenta;

	public function ajaxMostrarClienteCuenta(){

		$respuesta = ControladorClientes::ctrMostrarClientesCuentas(null, null);

		echo json_encode($respuesta);


	}

	/*=============================================
	CONSULTAR RUC  CLIENTE
	=============================================*/	
	public $nuevoRuc;
	public function ajaxConsultarRUC(){

		$valor=$this->nuevoRuc;

		$ws = file_get_contents("https://dniruc.apisperu.com/api/v1/ruc/$valor?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im5vdGlmaWNhY2lvbmVzdmFzY29ycEBnbWFpbC5jb20ifQ.c-6WZwJBvvbLMYouVDCfsnSn0NnoT88AmAJVRIIcGx4");


		echo $ws;

	}

	/*=============================================
	CONSULTAR DNI CLIENTE
	=============================================*/	
	public $nuevoDni;
	public function ajaxConsultarDNI(){

		$valor=$this->nuevoDni;

		$ws = file_get_contents("https://dniruc.apisperu.com/api/v1/dni/$valor?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im5vdGlmaWNhY2lvbmVzdmFzY29ycEBnbWFpbC5jb20ifQ.c-6WZwJBvvbLMYouVDCfsnSn0NnoT88AmAJVRIIcGx4");


		echo $ws;

	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["codigo"])){

	$cliente = new AjaxClientes();
	$cliente -> codigo = $_POST["codigo"];
	$cliente -> ajaxEditarCliente();

}

if(isset($_POST["documento"])){
	$validarDocumento=new AjaxClientes();
	$validarDocumento->documento=$_POST["documento"];
	$validarDocumento->ajaxValidarDocumento();
}

if(isset($_POST["clienteCuenta"])){
	$clienteCuenta=new AjaxClientes();
	$clienteCuenta->clienteCuenta=$_POST["clienteCuenta"];
	$clienteCuenta->ajaxMostrarClienteCuenta();
}


/*=============================================
CONSULTAR RUC CLIENTE
=============================================*/	

if(isset($_POST["nuevoRuc"])){

	$consultarRuc = new AjaxClientes();
	$consultarRuc -> nuevoRuc = $_POST["nuevoRuc"];
	$consultarRuc -> ajaxConsultarRUC();

}

/*=============================================
CONSULTAR DNI CLIENTE
=============================================*/	

if(isset($_POST["nuevoDni"])){

	$consultarDni = new AjaxClientes();
	$consultarDni -> nuevoDni = $_POST["nuevoDni"];
	$consultarDni -> ajaxConsultarDNI();

}