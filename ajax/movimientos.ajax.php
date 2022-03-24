<?php

require_once '../controladores/movimientos.controlador.php';
require_once '../modelos/movimientos.modelo.php';

class AjaxMovimientos{

    /* 
    * 
    */
	public $activarId;
    public $activarTarjeta;
    
	public function ajaxActualizarMovimientos(){
		
		$valor1=$this->año;
		
		$valor2=$this->mes;


		/* var_dump($tabla,$valor1,$valor2); */


		$respuesta=ModeloMovimientos::mdlActualizarMovimientos($valor1,$valor2);

		echo $respuesta;
	}


	public function ajaxActualizarTC(){

		$fecha=$this->fecha;

		$ws = file_get_contents("https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=$fecha");

		$tipoCambio = json_decode($ws, true);

		if($tipoCambio["venta"] == "Fuera de plazo permitido"){

			$respuesta = "no";

		}else{

			$respuesta = ModeloMovimientos::mdlActualizarTipoCambio($tipoCambio["compra"], $tipoCambio["venta"], $fecha);

		}

		

		
		echo $respuesta;

	}


}

if(isset($_POST["año"])){
	$actualizar=new AjaxMovimientos();
	$actualizar->año=$_POST["año"];
	$actualizar->mes=$_POST["mes"];
	$actualizar->ajaxActualizarMovimientos();
}

if(isset($_POST["fecha"])){
	$actualizar=new AjaxMovimientos();
	$actualizar->fecha=$_POST["fecha"];
	$actualizar->ajaxActualizarTC();
}