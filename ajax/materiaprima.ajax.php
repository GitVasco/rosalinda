<?php

// Requerimos el controlador y el modelo
require_once '../controladores/materiaprima.controlador.php';
require_once '../modelos/materiaprima.modelo.php';

class AjaxMateriaPrima{


	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/

	public $idMateriaPrima;

	public function ajaxEditarMateriaPrima(){

		$valor = $this->idMateriaPrima;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);

		echo json_encode($respuesta);

	}

	/* 
	* EDITAR EL COSTO DE LA MATERIA PRIMA
	*/

	public $materiaPrima;

	public function ajaxEditarMateriaPrimaCostos(){

		$valor = $this->materiaPrima;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);

		echo json_encode($respuesta);

	}

	/* 
	* VISUALIZAR LA CABECERA DE LA MATERIA PRIMA
	*/
	public $articuloMP;
	public function ajaxVisualizarMateriaPrima(){

		$valor = $this->articuloMP;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);

		echo json_encode($respuesta);
	
	}

	/* 
	* VISUALIZAR DETALLE DE LA MATERIA PRIMA
	*/
	public function ajaxVisualizarMateriaPrimaDetalle(){

			$valor = $this->articuloMPDetalle;

			$respuestaDetalle = ControladorMateriaPrima::ctrVisualizarMateriaPrimaDetalle($valor);

			echo json_encode($respuestaDetalle);
	}	

}


/* 
* EDITAR NOMBRE DE MATERIA PRIMA
*/

if(isset($_POST["idMateriaPrima"])){

	$editarMateriaPrima = new AjaxMateriaPrima();
	$editarMateriaPrima -> idMateriaPrima = $_POST["idMateriaPrima"];
	$editarMateriaPrima -> ajaxEditarMateriaPrima();
  
}

/* 
* EDITAR COSTO DE MATERIA PRIMA
*/

if(isset($_POST["materiaPrima"])){

	$editarMateriaPrimaCostos = new AjaxMateriaPrima();
	$editarMateriaPrimaCostos -> materiaPrima = $_POST["materiaPrima"];
	$editarMateriaPrimaCostos -> ajaxEditarMateriaPrimaCostos();
  
}

/* 
 * VISUALIZAR LA CABECERA DE LA MATERIA PRIMA
*/
if(isset($_POST["articuloMP"])){

	$visualizarMateriaPrima = new AjaxMateriaPrima();
	$visualizarMateriaPrima -> articuloMP = $_POST["articuloMP"];
	$visualizarMateriaPrima -> ajaxVisualizarMateriaPrima();
  
}

/* 
 * VISUALIZAR DETALLE DE LA MATERIA PRIMA
*/
if(isset($_POST["articuloMPDetalle"])){

  	$visualizarMateriaPrimaDetalle = new AjaxMateriaPrima();
	$visualizarMateriaPrimaDetalle -> articuloMPDetalle = $_POST["articuloMPDetalle"];
	$visualizarMateriaPrimaDetalle -> ajaxVisualizarMateriaPrimaDetalle();
  
}