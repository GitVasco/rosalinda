<?php

require_once "../controladores/tipotrabajador.controlador.php";
require_once "../modelos/tipotrabajador.modelo.php";

class AjaxTipoTrabajador{
/*=============================================
  EDITAR OPERACIONES
  =============================================*/ 

  public $idTipoTrabajador;

  public function ajaxEditarTipoTrabajador(){
      
    $item="cod_tip_tra";
    $valor = $this->idTipoTrabajador;

    $respuesta = ControladorTipoTrabajador::ctrMostrarTipoTrabajador($item,$valor);

    echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR OPERACION
=============================================*/	
if(isset($_POST["idTipoTrabajador"])){

	$tipotrabajador = new AjaxTipoTrabajador();
	$tipotrabajador -> idTipoTrabajador = $_POST["idTipoTrabajador"];
	$tipotrabajador -> ajaxEditarTipoTrabajador();
}
