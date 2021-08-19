<?php

session_start();


require_once '../controladores/tarjetas.controlador.php';
require_once '../modelos/tarjetas.modelo.php';
require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';
require_once '../controladores/materiaprima.controlador.php';
require_once '../modelos/materiaprima.modelo.php';



class AjaxTarjetas{
	# Método para eliminar la info de tarjetas
	public $idTarjeta;
	public function ajaxEliminarTarjeta(){

        $idTarjeta=$this->idTarjeta;
        
		$respuesta=ControladorTarjetas::ctrEliminarTarjeta($idTarjeta);
        echo $respuesta;
        
	}

	// Activar-Desactivar tarjeta
	public $activarId;
	public $activarTarjeta;
	public function ajaxActivarDesactivarTarjeta(){

		$tabla="tarjetasjf";
		$item1="estado";
		$valor1=$this->activarTarjeta;
		$item2="id";
		$valor2=$this->activarId;
		$item3="usu_aprob";
		$valor3=$_SESSION["id"];;

		/* var_dump($tabla,$item1,$valor1,$item2,$valor2,$item3,$valor3); */

		$respuesta=ModeloTarjetas::mdlActualizarTarjeta($tabla,$item1,$valor1,$item2,$valor2,$item3,$valor3);
		echo $respuesta;
	}
	
	public $articuloTarjeta;

	public function ajaxVisualizarTarjeta(){

		$item = "articulo";
		$valor = $this->articuloTarjeta;

		$respuesta = ControladorTarjetas::ctrVisualizarTarjeta($item, $valor);

		echo json_encode($respuesta);
	}

	public function ajaxVisualizarTarjetaDetalle(){

		$item = "articulo";
		$valor = $this->articuloTarjetaDetalle;

		$respuestaDetalle = ControladorTarjetas::ctrVisualizarTarjetaDetalle($item, $valor);

		echo json_encode($respuestaDetalle);
	}	

	public $idTarjeta2;
	public function ajaxVisualizarTarjetaFichas(){

		$item = "id";
		$valor = $this->idTarjeta2;

		$respuestaDetalle = ControladorTarjetas::ctrMostrarTarjetas($item, $valor);

		echo json_encode($respuestaDetalle);
	}	


}

// ELIMINAR
if(isset($_POST["idTarjeta"])){

	$eliminarTarjeta=new AjaxTarjetas();
	$eliminarTarjeta->idTarjeta=$_POST["idTarjeta"];
    $eliminarTarjeta->ajaxEliminarTarjeta();
    
}

//ACTIVAR

if(isset($_POST["activarId"])){
	$activar=new AjaxTarjetas();
	$activar->activarId=$_POST["activarId"];
	$activar->activarTarjeta=$_POST["activarTarjeta"];
	$activar->ajaxActivarDesactivarTarjeta();
}


/*=============================================
VISUALIZAR TARJETA CABECERA
=============================================*/ 

if(isset($_POST["articuloTarjeta"])){

	$visualizarTarjeta = new AjaxTarjetas();
	$visualizarTarjeta -> articuloTarjeta = $_POST["articuloTarjeta"];
	$visualizarTarjeta -> ajaxVisualizarTarjeta();
  
}

/*=============================================
VISUALIZAR TARJETA fichas
=============================================*/ 

if(isset($_POST["idTarjeta2"])){

	$visualizarTarjetaFichas = new AjaxTarjetas();
	$visualizarTarjetaFichas->idTarjeta2 = $_POST["idTarjeta2"];
	$visualizarTarjetaFichas->ajaxVisualizarTarjetaFichas();
  
  }


 /*=============================================
VISUALIZAR SIMULACION
=============================================*/ 

if(isset($_POST["articuloTarjetaDetalle"])){

	$visualizarTarjetaFichas = new AjaxTarjetas();
	$visualizarTarjetaFichas->articuloTarjetaDetalle = $_POST["articuloTarjetaDetalle"];
	$visualizarTarjetaFichas->ajaxVisualizarTarjetaDetalle();
  
  }