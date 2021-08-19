<?php
require_once '../controladores/ingresos.controlador.php';
require_once '../modelos/ingresos.modelo.php';


class AjaxIngresos{
	
	public $documentoIngreso;
	public function ajaxVisualizarIngreso(){
        $documentoIngreso=$this->documentoIngreso;
		$respuesta=ControladorIngresos::ctrMostrarIngresos("documento",$documentoIngreso);
        echo json_encode($respuesta);
        
	}

	public $documentoDIngreso;
	public function ajaxVisualizarDetalleIngreso(){
        $documentoDIngreso=$this->documentoDIngreso;
		$respuesta=ControladorIngresos::ctrVisualizarIngresoDetalle($documentoDIngreso);
        echo json_encode($respuesta);
        
	}
}

// OBJETOS
if(isset($_POST["documentoIngreso"])){

	$verIngreso=new AjaxIngresos();
	$verIngreso->documentoIngreso=$_POST["documentoIngreso"];
    $verIngreso->ajaxVisualizarIngreso();
    
}

if(isset($_POST["documentoDIngreso"])){

	$detalleIngreso=new AjaxIngresos();
	$detalleIngreso->documentoDIngreso=$_POST["documentoDIngreso"];
    $detalleIngreso->ajaxVisualizarDetalleIngreso();
    
}