<?php

class ControladorTalonarios{

    /*=============================================
	MOSTRAR TALONARIOS
	=============================================*/

	static public function ctrMostrarTalonarios($valor){

		$respuesta = ModeloTalonarios::mdlMostrarTalonarios($valor);

		return $respuesta;

    }

}