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

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=' . $fecha,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_SSL_VERIFYPEER => false
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {

			$tipoCambioSunat = json_decode($response, true);	
			
			if($tipoCambioSunat["venta"] == "Fuera de plazo permitido"){

				$respuesta = "no";
	
			}else{
	
				$respuesta = ModeloMovimientos::mdlActualizarTipoCambio($tipoCambioSunat["compra"], $tipoCambioSunat["venta"], $fecha);
	
			}	
	
			
			echo $respuesta;	
		}


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