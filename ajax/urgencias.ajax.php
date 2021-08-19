<?php

require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';
require_once '../controladores/materiaprima.controlador.php';
require_once '../modelos/materiaprima.modelo.php';

class AjaxUrgencias{

    /* 
	* VISUALIZAR LA CABECERA DE LA URGENCIA
	*/
	public $codigo;
	public function ajaxVisualizarUrgencias(){


		$valor = $this->codigo;

		$respuesta = controladorArticulos::ctrMostrarUrgencia($valor,null);

		echo json_encode($respuesta);
	
    }
    
	/* 
	* VISUALIZAR DETALLE DE LA MATERIA PRIMA
	*/
	public function ajaxVisualizarUrgenciasDetalle(){

        $valor = $this->codigoD;

        $respuestaDetalle = controladorArticulos::ctrVisualizarUrgenciasDetalle($valor);

        echo json_encode($respuestaDetalle);
	}
	
	/* 
	* VISUALIZAR LA CABECERA DE LA URGENCIA DE LA AMP
	*/
	public function ajaxVisualizarUrgenciasAMP(){

		$valor = $this->codigoAMP;

		$respuestaA = ControladorMateriaPrima::ctrMostrarUrgenciaAMP($valor);

		echo json_encode($respuestaA);
	
	}	

	/* 
	* VISUALIZAR LA CABECERA DE LA URGENCIA DE LA AMP - ORDEN DE COMPRA
	*/
	public function ajaxVisualizarUrgenciasOC(){

		$valor = $this->codigoOC;

		$respuestaB = ControladorMateriaPrima::ctrVisualizarUrgenciasAMPDetalleOC($valor);

		echo json_encode($respuestaB);
	
	}		

	/* 
	* VISUALIZAR LA CABECERA DE LA URGENCIA DE LA AMP - ARTICULO
	*/
	public function ajaxVisualizarUrgenciasART(){

		$valor = $this->codigoART;

		$respuestaC = ControladorMateriaPrima::ctrVisualizarUrgenciasAMPDetalleART($valor);

		echo json_encode($respuestaC);
	
	}		



}

/* 
 * VISUALIZAR LA CABECERA DE LA URGENCIA
*/
if(isset($_POST["codigo"])){

	$visualizarUrgencias = new AjaxUrgencias();
	$visualizarUrgencias -> codigo = $_POST["codigo"];
	$visualizarUrgencias -> ajaxVisualizarUrgencias();
  
}

/* 
 * VISUALIZAR DETALLE DE LA URGENCIA
*/
if(isset($_POST["codigoD"])){

    $visualizarUrgenciasDetalle = new AjaxUrgencias();
    $visualizarUrgenciasDetalle -> codigoD = $_POST["codigoD"];
    $visualizarUrgenciasDetalle -> ajaxVisualizarUrgenciasDetalle();

}

/* 
 * VISUALIZAR LA CABECERA DE LA MATERIA PRIMA
*/
if(isset($_POST["codigoAMP"])){

	$visualizarUrgenciasAMP = new AjaxUrgencias();
	$visualizarUrgenciasAMP -> codigoAMP = $_POST["codigoAMP"];
	$visualizarUrgenciasAMP -> ajaxVisualizarUrgenciasAMP();
  
}

/* 
 * VISUALIZAR LA CABECERA DE LA MATERIA PRIMA - ORDEN DE CORTE
*/
if(isset($_POST["codigoOC"])){

	$visualizarUrgenciasOC = new AjaxUrgencias();
	$visualizarUrgenciasOC -> codigoOC = $_POST["codigoOC"];
	$visualizarUrgenciasOC -> ajaxVisualizarUrgenciasOC();
  
}

/* 
 * VISUALIZAR LA CABECERA DE LA MATERIA PRIMA - ORDEN DE CORTE
*/
if(isset($_POST["codigoART"])){

	$visualizarUrgenciasART = new AjaxUrgencias();
	$visualizarUrgenciasART -> codigoART = $_POST["codigoART"];
	$visualizarUrgenciasART -> ajaxVisualizarUrgenciasART();
  
}