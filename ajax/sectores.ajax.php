<?php

require_once "../controladores/sectores.controlador.php";
require_once "../modelos/sectores.modelo.php";

class AjaxSectores{

	/*=============================================
	EDITAR SECTOR
	=============================================*/	

	public $id;

	public function ajaxEditarSector(){

		$valor = $this->id;

		$respuesta = ControladorSectores::ctrMostrarSectores($valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR SECTOR
=============================================*/	

if(isset($_POST["idSector"])){

	$sector = new AjaxSectores();
	$sector -> id = $_POST["idSector"];
	$sector -> ajaxEditarSector();

}