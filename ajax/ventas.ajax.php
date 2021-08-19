<?php
require_once '../controladores/ventas.controlador.php';
require_once '../modelos/ventas.modelo.php';
require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';
require_once '../controladores/productos.controlador.php';
require_once '../modelos/productos.modelo.php';

class AjaxVentas{
	# Método para eliminar la info de Ventas
	public $idVenta;
	public function ajaxEliminarVenta(){

        $idVenta=$this->idVenta;
        
		$respuesta=ControladorVentas::ctrEliminarVenta($idVenta);
        echo $respuesta;
        
	}
}

// OBJETOS
if(isset($_POST["idVenta"])){

	$eliminarVenta=new AjaxVentas();
	$eliminarVenta->idVenta=$_POST["idVenta"];
    $eliminarVenta->ajaxEliminarVenta();
    
}