<?php

require_once '../controladores/almacencorte.controlador.php';
require_once '../modelos/almacencorte.modelo.php';

require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxAlmacenCorte{

    /* 
	* VISUALIZAR LA CABECERA DEL CORTE
	*/
    public function ajaxVisualizarAlmacen(){

        $valor = $this->codigoAC;

        $respuesta = ControladorAlmacenCorte::ctrMostrarAlmacenCorte($valor);

        echo json_encode($respuesta);

    }

	/* 
	* VISUALIZAR DETALLE DEL CORTE
	*/
	public function ajaxVisualizarAlmacenDetalle(){

        $valor = $this->codigoDAC;

        $respuestaDetalle = ControladorAlmacenCorte::ctrVisualizarAlmacenCorteDetalle($valor);

        echo json_encode($respuestaDetalle);
    }
    
	/* 
	* ESTADO CORTE
	*/
	public function ajaxEstadoCorte(){

        $valor=$this->activarId;
        
        $valor1=$this->activarAM;

		$respuesta = ModeloAlmacenCorte::mdlEstadoCorte($valor, $valor1);

		echo $respuesta;
	}    

	 /* 
	* VISUALIZAR LA CABECERA DEL CORTE
	*/
    public function ajaxEditarAlmacen(){

        $valor = $this->codigo;

        $respuesta = ControladorAlmacenCorte::ctrMostrarTelasAlmacenCorte($valor);

        echo json_encode($respuesta);

    }

}


/* 
 * VISUALIZAR LA CABECERA DEL CORTE
*/
if(isset($_POST["codigoAC"])){

	$visualizarAlmacenCorte = new AjaxAlmacenCorte();
	$visualizarAlmacenCorte -> codigoAC = $_POST["codigoAC"];
	$visualizarAlmacenCorte -> ajaxVisualizarAlmacen();
  
}

/* 
 * VISUALIZAR DETALLE DE LA ORDEN DE CORTE
*/
if(isset($_POST["codigoDAC"])){

    $visualizarAlmacenCorteDetalle = new AjaxAlmacenCorte();
    $visualizarAlmacenCorteDetalle -> codigoDAC = $_POST["codigoDAC"];
    $visualizarAlmacenCorteDetalle -> ajaxVisualizarAlmacenDetalle();

}

/* 
* PROCESADO Y PEDIR REVISAR A SISTEMAS
*/
if(isset($_POST["activarId"])){

	$activar = new AjaxAlmacenCorte();
	$activar -> activarId = $_POST["activarId"];
	$activar -> activarAM=  $_POST["activarAM"];
    $activar -> ajaxEstadoCorte();
    
}

/* 
 * VISUALIZAR LA CABECERA DEL CORTE
*/
if(isset($_POST["codigo"])){

	$editarAlmacenCorte = new AjaxAlmacenCorte();
	$editarAlmacenCorte -> codigo = $_POST["codigo"];
	$editarAlmacenCorte -> ajaxEditarAlmacen();
  
}