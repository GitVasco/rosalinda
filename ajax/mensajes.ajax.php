<?php

require_once '../controladores/mensajes.controlador.php';
require_once '../modelos/mensajes.modelo.php';

class AjaxMensajes{

    /* 
    * LEER LOS MENSAJES
    */
	public function ajaxLeerMensajes(){

		$tabla="detalles_mailboxjf";
		$de=$this->de;
		$para=$this->para;

		$respuesta=ModeloMensajes::mdlLeer($tabla, $de, $para);
		echo $respuesta;
	}


}

/* 
* LEEER
*/
if(isset($_POST["de"])){

	$leer=new AjaxMensajes();
	$leer->de=$_POST["de"];
	$leer->para=$_POST["para"];
    $leer->ajaxLeerMensajes();
    
}