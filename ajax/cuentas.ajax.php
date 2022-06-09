<?php
session_start();

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";


class AjaxCuentas{
    /*=============================================
      EDITAR CUENTA
      =============================================*/ 
    
      public $idCuenta;
    
      public function ajaxEditarCuenta(){
        $item="id";
        $valor = $this->idCuenta;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentas($item,$valor);
    
        echo json_encode($respuesta);
    
      }

      public $idCancelacion;
    
      public function ajaxEditarCancelacion(){
        $item="id";
        $valor = $this->idCancelacion;
    
        $respuesta = ModeloCuentas::mdlMostrarCancelacion("cuenta_ctejf",$item,$valor);
    
        echo json_encode($respuesta);
    
      }

      public $numCta;
    
      public function ajaxCancelarCuenta(){
        $item="num_cta";
        $valor = $this->numCta;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentas($item,$valor);
    
        echo json_encode($respuesta);
    
      }

      public $clienteCredito;
    
      public function ajaxCuentaCredito(){
        $valor = $this->clienteCredito;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentaCredito($valor);
    
        echo json_encode($respuesta);
    
      }

      public $clienteDeuda;
    
      public function ajaxCuentaDeuda(){
        $valor = $this->clienteDeuda;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentaDeuda($valor);
    
        echo json_encode($respuesta);
    
      }

      public $clienteDeudaVencida;
    
      public function ajaxCuentaDeudaVencida(){
        $valor = $this->clienteDeudaVencida;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentaDeudaVencida($valor);
    
        echo json_encode($respuesta);
    
      }

      public $letraCuenta;
    
      public function ajaxCuentaLetras(){
        $valor = $this->letraCuenta;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentasUnicos("id",$valor);
    
        echo json_encode($respuesta);
    
      }

      public $datosCuenta;
      public function ajaxCrearCuentaNota(){
        $valor = $this->datosCuenta;
        $datos = json_decode($valor);

        $usureg = $_SESSION["nombre"];
        $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']); 

        foreach ($datos->{"datosCuenta"} as  $value) {
          $doc = $value->{"tipo_doc"};
          $cta = $value->{"num_cta"};
          $cli = $value->{"cliente"};
          $vend = $value->{"vendedor"};
          $monto = $value->{"monto"};
          $saldo = $value->{"saldo"};
          $fecha = $value->{"fecha"};
          $estado = $value->{"estado"};
          $nota = $value->{"notas"};
          $reno = $value->{"renovacion"};
          $prot = $value->{"protesta"};
          $mon = $value->{"tip_mon"};
          $pago = $value->{"cod_pago"};
          $origen = $value->{"doc_origen"};
          $mov = $value->{"tip_mov"};
          $user = $value->{"usuario"};
          $arregloCuenta = array("tipo_doc"=>$doc,
                                  "num_cta"=>$cta,
                                  "cliente"=>$cli,
                                  "vendedor"=>$vend,
                                  "fecha"=>$fecha,
                                  "fecha_ven"=>$fecha,
                                  "tip_mon"=>$mon,
                                  "monto"=>$monto,
                                  "estado"=>$estado,
                                  "notas"=>$nota,
                                  "cod_pago"=>$pago,
                                  "doc_origen"=>$origen,
                                  "renovacion"=>$reno,
                                  "protesta"=>$prot,
                                  "usuario"=>$user,
                                  "saldo"=>$saldo,
                                  "tip_mov" => $mov,
                                  "usureg" => $usureg,
                                  "pcreg" => $pcreg);
          
          $respuesta = ModeloCuentas::mdlIngresarCuenta("cuenta_ctejf",$arregloCuenta);
        }
    
        echo $respuesta;
    
      }

      /*=============================================
      VALIDAR DOCUMENTO DE CUENTA
      =============================================*/	
      public $documento;
      public function ajaxValidarDocumento(){
        $item="num_cta";
        $valor=$this->documento;
        $item2="tipo_doc";
        $valor2="08";
        $respuesta=ControladorCuentas::ctrValidarCuenta($item,$valor,$item2,$valor2);
        echo json_encode($respuesta);
      }
    
      /*=============================================
      EDITAR DOCUMENTO DE CUENTA
      =============================================*/	
      public $datosCuenta2;
      public function ajaxEditarCuentaNota(){
        $valor = $this->datosCuenta2;
        $datos = json_decode($valor);
        foreach ($datos->{"datosCuenta"} as  $value) {
          $id = $value->{"id"};
          $doc = $value->{"tipo_doc"};
          $cta = $value->{"num_cta"};
          $cli = $value->{"cliente"};
          $vend = $value->{"vendedor"};
          $monto = $value->{"monto"};
          $saldo = $value->{"saldo"};
          $fecha = $value->{"fecha"};
          $estado = $value->{"estado"};
          $nota = $value->{"notas"};
          $reno = $value->{"renovacion"};
          $prot = $value->{"protesta"};
          $mon = $value->{"tip_mon"};
          $pago = $value->{"cod_pago"};
          $origen = $value->{"doc_origen"};
          $user = $value->{"usuario"};
          $arregloCuenta = array("id"=>$id,
                                  "tipo_doc"=>$doc,
                                  "num_cta"=>$cta,
                                  "cliente"=>$cli,
                                  "vendedor"=>$vend,
                                  "fecha"=>$fecha,
                                  "tip_mon"=>$mon,
                                  "monto"=>$monto,
                                  "estado"=>$estado,
                                  "notas"=>$nota,
                                  "cod_pago"=>$pago,
                                  "doc_origen"=>$origen,
                                  "renovacion"=>$reno,
                                  "protesta"=>$prot,
                                  "usuario"=>$user,
                                  "saldo"=>$saldo);
          
          $respuesta = ModeloCuentas::mdlEditarCuenta("cuenta_ctejf",$arregloCuenta);
        }
        
    
        echo $respuesta;
    
      }

      public $documentoMotivo;
    
      public function ajaxMostrarMotivos(){
        $item= "tipo_dato";
        $valor = $this->documentoMotivo;

        $respuesta = ControladorCuentas::ctrMostrarPagos($item,$valor);
    
        echo json_encode($respuesta);
    
      }


      public $documentoSalida;
    
      public function ajaxNombreDocumento(){
        $item= "codigo";
        $valor = $this->documentoSalida;

        $respuesta = ControladorCuentas::ctrMostrarPagos($item,$valor);
    
        echo json_encode($respuesta);
    
      }
    
    }
    
    
    /*=============================================
    EDITAR CUENTA
    =============================================*/	
    if(isset($_POST["idCuenta"])){
    
        $tipoPago = new AjaxCuentas();
        $tipoPago -> idCuenta = $_POST["idCuenta"];
        $tipoPago -> ajaxEditarCuenta();
    }
    /*=============================================
    EDITAR CANCELACION
    =============================================*/	
    if(isset($_POST["idCancelacion"])){
    
      $tipoCancelacion = new AjaxCuentas();
      $tipoCancelacion -> idCancelacion = $_POST["idCancelacion"];
      $tipoCancelacion -> ajaxEditarCancelacion();
  }

  /*=============================================
    CANCELAR CUENTA
    =============================================*/	
    if(isset($_POST["numCta"])){
    
      $cancelaCuenta = new AjaxCuentas();
      $cancelaCuenta -> numCta = $_POST["numCta"];
      $cancelaCuenta -> ajaxCancelarCuenta();
  }

  /*=============================================
    MOSTRAR CREDITO
    =============================================*/	
    if(isset($_POST["clienteCredito"])){
    
      $cuentaCredito = new AjaxCuentas();
      $cuentaCredito -> clienteCredito = $_POST["clienteCredito"];
      $cuentaCredito -> ajaxCuentaCredito();
  }

  /*=============================================
    MOSTRAR DEUDA
    =============================================*/	
    if(isset($_POST["clienteDeuda"])){
    
      $cuentaDeuda = new AjaxCuentas();
      $cuentaDeuda -> clienteDeuda = $_POST["clienteDeuda"];
      $cuentaDeuda -> ajaxCuentaDeuda();
  }

  /*=============================================
    MOSTRAR DEUDA
    =============================================*/	
    if(isset($_POST["clienteDeudaVencida"])){
    
      $cuentaDeudaVencida = new AjaxCuentas();
      $cuentaDeudaVencida -> clienteDeudaVencida = $_POST["clienteDeudaVencida"];
      $cuentaDeudaVencida -> ajaxCuentaDeudaVencida();
  }

  /*=============================================
    ENVIO LETRAS
    =============================================*/	
    if(isset($_POST["letraCuenta"])){
    
      $cuentaLetras = new AjaxCuentas();
      $cuentaLetras -> letraCuenta = $_POST["letraCuenta"];
      $cuentaLetras -> ajaxCuentaLetras();
  }

  /*=============================================
    CREAR CUENTA
    =============================================*/	
    if(isset($_POST["jsonCuenta"])){
      
      $crearCuenta = new AjaxCuentas();
      $crearCuenta -> datosCuenta = $_POST["jsonCuenta"];
      $crearCuenta -> ajaxCrearCuentaNota();
  }

  /*=============================================
    VALIDAR CUENTA
    =============================================*/	
  if(isset($_POST["documento"])){
    $validarDocumento=new AjaxCuentas();
    $validarDocumento->documento=$_POST["documento"];
    $validarDocumento->ajaxValidarDocumento();
  }

  /*=============================================
    EDITAR CUENTA
    =============================================*/	
    if(isset($_POST["jsonCuenta2"])){
      
      $editarCuenta = new AjaxCuentas();
      $editarCuenta -> datosCuenta2 = $_POST["jsonCuenta2"];
      $editarCuenta -> ajaxEditarCuentaNota();
  }

  /*=============================================
    MOSTRAR MOTIVO CREDITO
    =============================================*/	
    if(isset($_POST["documentoMotivo"])){
    
      $motivos = new AjaxCuentas();
      $motivos -> documentoMotivo = $_POST["documentoMotivo"];
      $motivos -> ajaxMostrarMotivos();
  }

  /*=============================================
    MOSTRAR DESCRIPCION MAESTRA
    =============================================*/	
    if(isset($_POST["documentoSalida"])){
      $descripcionDocumento=new AjaxCuentas();
      $descripcionDocumento->documentoSalida=$_POST["documentoSalida"];
      $descripcionDocumento->ajaxNombreDocumento();
    }
