<?php

require_once "../controladores/salidas.controlador.php";
require_once "../modelos/salidas.modelo.php";
require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';


class AjaxSalidas{
      /*=============================================
      SELECT DOCUMENTO
      =============================================*/ 
    
      public $documento;
    
      public function ajaxSelectDocumento(){
        $valor = $this->documento;
    
        $respuesta = ControladorSalidas::ctrMostrarArgumentoSalida($valor);
    
        echo json_encode($respuesta);
    
      }

      /* 
      * VISUALIZAR COLORES
      */
      public function ajaxVerColoresCantidades2(){

        $salida = $this->salida;
        $modelo = $this->modeloA;

        $respuesta = controladorArticulos::ctrVerColoresCantidades2($salida, $modelo);
      
        echo json_encode($respuesta);
      }    

      /*=============================================
      LISTAR DOCUMENTOS PARA VISUALIZAR
      =============================================*/ 
    
      public $documento2;
    
      public function ajaxVisualizarListaDocumento(){
        $valor = $this->documento2;
    
        $respuesta = ControladorSalidas::ctrListarDocumentos($valor);
    
        echo json_encode($respuesta);
    
      }

    
    }
    
    
/*=============================================
SELECT DOCUMENTO
=============================================*/	
if(isset($_POST["documento"])){

    $selectDocumento = new AjaxSalidas();
    $selectDocumento -> documento = $_POST["documento"];
    $selectDocumento -> ajaxSelectDocumento();
}
    
    /* 
 * VISUALIZAR COLORES Y MODIFICAR
*/
if(isset($_POST["salida"])){

  $verColoresyCantidades = new AjaxSalidas();
  $verColoresyCantidades -> salida = $_POST["salida"];
  $verColoresyCantidades -> modeloA = $_POST["modeloA"];
  $verColoresyCantidades -> ajaxVerColoresCantidades2();

}


/*=============================================
VISUALIZAR LISTA DOCUMENTO
=============================================*/	
if(isset($_POST["documento2"])){

  $listarDocumento = new AjaxSalidas();
  $listarDocumento -> documento2 = $_POST["documento2"];
  $listarDocumento -> ajaxVisualizarListaDocumento();
}