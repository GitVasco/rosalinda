<?php
require_once '../controladores/servicio.controlador.php';
require_once '../modelos/servicio.modelo.php';


require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';


class AjaxServicios{
	# Método para eliminar la info de Ventas
	public $idServicio;
	public function ajaxEliminarServicio(){

        $idServicio=$this->idServicio;
        
		$respuesta=ControladorServicios::ctrEliminarServicio($idServicio);
        echo $respuesta;
        
	}
	public $servicio;
	public function ajaxUltimoServicio(){
        $servicio=$this->servicio;
		$respuesta=ControladorServicios::ctrMostrarUltimoServicio();
        echo json_encode($respuesta);
        
	}

	/*=============================================
      EDITAR PRECIO SERVICIO
      =============================================*/ 
    
    public $idPrecioServicio;

    public function ajaxEditarPrecioServicio(){
    $item="id";
    $valor = $this->idPrecioServicio;

    $respuesta = ControladorServicios::ctrMostrarPrecioServicios($item,$valor);

    echo json_encode($respuesta);

    }

    /*=============================================
      VISUALIZAR SERVICIO
    =============================================*/ 
    public $codigoServicio;
    public function ajaxVisualizarServicio(){
        $codigoServicio=$this->codigoServicio;
        $respuesta=ControladorServicios::ctrMostrarServicios("codigo",$codigoServicio);
        echo json_encode($respuesta);
        
    }
  
      public $codigoDServicio;
      public function ajaxVisualizarDetalleServicio(){
          $codigoDServicio=$this->codigoDServicio;
          $respuesta=ControladorServicios::ctrVisualizarServicioDetalle($codigoDServicio);
          echo json_encode($respuesta);
          
      }

      public $idPagoServicio;
      public function ajaxEditarPagoServicio(){
       
        $valor = $this->idPagoServicio;
    
        $respuesta = ControladorServicios::ctrMostrarPagoServicios($valor);
    
        echo json_encode($respuesta);
    
      }
}

// OBJETOS
if(isset($_POST["idServicio"])){

	$eliminarServicio=new AjaxServicios();
	$eliminarServicio->idServicio=$_POST["idServicio"];
    $eliminarServicio->ajaxEliminarServicio();
    
}

if(isset($_POST["servicio"])){

	$ultimoServicio = new AjaxServicios();
	$ultimoServicio -> servicio =$_POST["servicio"];
    $ultimoServicio -> ajaxUltimoServicio();
    
}

if(isset($_POST["idPrecioServicio"])){

	$editarPrecioServicio=new AjaxServicios();
	$editarPrecioServicio->idPrecioServicio=$_POST["idPrecioServicio"];
    $editarPrecioServicio->ajaxEditarPrecioServicio();
    
}

if(isset($_POST["codigoServicio"])){

	$verServicio=new AjaxServicios();
	$verServicio->codigoServicio=$_POST["codigoServicio"];
    $verServicio->ajaxVisualizarServicio();
    
}

if(isset($_POST["codigoDServicio"])){

	$detalleServicios=new AjaxServicios();
	$detalleServicios->codigoDServicio=$_POST["codigoDServicio"];
    $detalleServicios->ajaxVisualizarDetalleServicio();
    
}

if(isset($_POST["idPagoServicio"])){

	$editarPagoServicio=new AjaxServicios();
	$editarPagoServicio->idPagoServicio=$_POST["idPagoServicio"];
    $editarPagoServicio->ajaxEditarPagoServicio();
    
}