<?php
session_start();
require_once "../controladores/talleres.controlador.php";
require_once "../modelos/talleres.modelo.php";
require_once "../modelos/ingresos.modelo.php";
require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
class AjaxTalleres{
/*=============================================
  EDITAR CANTIDAD DE TALLER
  =============================================*/ 

  public $idTaller;

  public function ajaxEditarCantidad(){

    $valor = $this->idTaller;

    $respuesta = ControladorTalleres::ctrMostrarTalleresG($valor);

    echo json_encode($respuesta);

    }
    public $idTallerT;
    public function ajaxVerTallerT(){

      $valor = $this->idTallerT;
  
      $respuesta = ModeloTalleres::mdlVerTalleresTerminado($valor);
  
      echo json_encode($respuesta);
  
      }

    public $fecha;
    public function ajaxSelectTaller(){

      $valor = $this->fecha;
  
      $respuesta = ModeloTalleres::mdlMostrarSelectTaller($valor);
  
      echo json_encode($respuesta);
  
    }

    public $ingreso;
	  public function ajaxUltimoServicio(){
        $ingreso=$this->ingreso;
		    $respuesta=ModeloIngresos::mdlUltimoIngreso("movimientos_cabecerajf");
        echo json_encode($respuesta);
        
    }
    public $modelo;
	  public function ajaxSelectOperacionModelo(){
        $modelo=$this->modelo;
		    $respuesta=ControladorOperaciones::ctrVisualizarOperacionDetalle("modelo",$modelo);
        echo json_encode($respuesta);
        
    }

    /* 
	* Reiniciar TallerT
	*/
	public $activarId;
	public $activarEstado;

	public function ajaxReiniciarTallerT(){

		$valor1=$this->activarEstado;

		$valor2=$this->activarId;
		$usuario= $_SESSION["nombre"];
    date_default_timezone_set('America/Lima');
    $fecha = new DateTime();
    $para      = 'notificacionesvascorp@gmail.com';
    $asunto    = 'Se reinicio un taller';
    $descripcion   = 'El usuario '.$usuario.' reinicio el taller con el codigo '.$valor2;
    $de = 'From: notificacionesvascorp@gmail.com';
    if($_SESSION["correo"] == 1){
      mail($para, $asunto, $descripcion, $de);
    }
    if($_SESSION["datos"] == 1){
      $datos2= array( "usuario" => $usuario,
              "concepto" => $descripcion,
              "fecha" => $fecha->format("Y-m-d H:i:s"));
      $auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
    }
		
		$respuesta=ControladorTalleres::ctrActualizarTallerT($valor1, $valor2);

		echo $respuesta;
	}

}
/*=============================================
EDITAR CANTIDAD DE TALLER
=============================================*/	
if(isset($_POST["idTaller"])){

	$taller = new AjaxTalleres();
	$taller -> idTaller = $_POST["idTaller"];
	$taller -> ajaxEditarCantidad();
}

/*=============================================
VER TALLER T
=============================================*/	
if(isset($_POST["idTallerT"])){

	$verTallerT = new AjaxTalleres();
	$verTallerT -> idTallerT = $_POST["idTallerT"];
	$verTallerT -> ajaxVerTallerT();
}

/*=============================================
SELECT TALLER
=============================================*/	
if(isset($_POST["fecha"])){

	$selectTaller = new AjaxTalleres();
	$selectTaller -> fecha = $_POST["fecha"];
	$selectTaller -> ajaxSelectTaller();
}

/*=============================================
SELECT ingreso
=============================================*/	
if(isset($_POST["ingreso"])){

	$ultimoServicio = new AjaxTalleres();
	$ultimoServicio -> ingreso =$_POST["ingreso"];
  $ultimoServicio -> ajaxUltimoServicio();
    
}

/*=============================================
SELECT operacion modelo
=============================================*/	
if(isset($_POST["modelo"])){
  
	$selectModelo = new AjaxTalleres();
	$selectModelo -> modelo =$_POST["modelo"];
  $selectModelo -> ajaxSelectOperacionModelo();
    
}
/*=============================================
REINICIAR TALLERT
=============================================*/
if(isset($_POST["activarId"])){
	$activar=new AjaxTalleres();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxReiniciarTallerT();
}
