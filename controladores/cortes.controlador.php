<?php
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class ControladorCortes{

    /*
    * MOSTRAR DATOS DE ALMACEN DE CORTE
    */
    static public function ctrMostrarCortes($valor1){

        $respuesta = ModeloCortes::mdlMostrarCortes($valor1);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE ALMACEN DE CORTE -VERSION 2
    */
    static public function ctrMostrarCortesV($modeloCorte){

        $respuesta = ModeloCortes::mdlMostrarCortesV($modeloCorte);

        return $respuesta;

    }

    /*
    * MOSTRAR TALLERES DISPONIBLES
    */
	static public function ctrMostrarTaller(){

		$respuesta = ModeloCortes::mdlMostrarTallerA();

		return $respuesta;

    }

    /*
    *MANDAR A CORTE A TALLER
    */
    static public function ctrMandarTaller(){

        if(isset($_POST["nuevoArticulo"])){

            /* 
            * registramos en la tabla taller cabecera para el código
            */

            if($_POST["seleccionarSectorServicio"] != ""){

                $tallerCab = $_POST["seleccionarSectorServicio"];

            }else{

                $tallerCab = "VC";

            }

            $datosCab = array(  "usuario"   => $_POST["usuario"],
                                "articulo"  => $_POST["nuevoArticulo"],
                                "cantidad"  => $_POST["nuevoAlmCorte"],
                                "estado"    => "0",
                                "taller"    => $tallerCab);

            $respuestaCab = ModeloCortes::mdlMandarTallerCab($datosCab);

            if($respuestaCab == "ok"){

                /* 
                * ultimo codigo
                */
                $ult_codigo = ModeloCortes::mdlUltCodigo();
                //var_dump($ult_codigo[ult_codigo]);

                /* 
                * Registramos en la tabla taller detalle
                */
                $datos = array( "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["nuevoArticulo"],
                                "cantidad" => $_POST["nuevoAlmCorte"],
                                "codigo" => $ult_codigo["ult_codigo"]);
                //var_dump($datos);
                
                $respuesta = ModeloCortes::mdlMandarTaller($datos);

                if($respuesta == "ok"){
                    
                    $cod = $ult_codigo["ult_codigo"];
                    
                    $ticket=$_POST["ticket"];

                    if($ticket == "1"){

                        /* 
                        * Actualizamos la cantidad que queda en corte y pasa al taller en el articulo
                        */
                        $articulo  = $_POST["nuevoArticulo"];
                        $cantidad =  $_POST["nuevoAlmCorte"];

                            $actualizaArticuloTaller = ModeloArticulos::mdlActualizarTallerCorte($articulo,$cantidad);

                    //     $nombre_impresora = "Star BSC10"; 
 
                    //     $connector = new WindowsPrintConnector($nombre_impresora);
                    //     $printer = new Printer($connector);
            
                    //     $fecha = date("d-m-Y");
    
                    //     $respuesta = ControladorCortes::ctrMostrarEnTalleres($cod);
                    //     //Establecemos los datos de la empresa
                    //     $empresa = "Corporacion Vasco S.A.C.";
                    //     $documento = "20513613939";
    
                    //     foreach ($respuesta as $key => $value) {
                            
                    //         $printer -> setFont(Printer::FONT_B);
                    //         $printer -> setJustification(Printer::JUSTIFY_CENTER);
                    //         $printer -> setTextSize(1, 1);
                    //         //Activamos negrita
    
                    //         $printer->setPrintLeftMargin(0); // margen 0
                    //         $printer->setEmphasis(true);
                    //         $printer -> text(".::Corporación Vasco S.A.C::."."\n");//Nombre de la empresa
            
                    //         $printer -> text("=================================="."\n");//Dirección de la empresa
                    //         //Quitamos negrita
                            
                            
                    //         $printer -> setJustification(Printer::JUSTIFY_LEFT);
    
                    //         $printer -> text("Modelo:".$value["modelo"]." - ".$value["nombre"]."\n");//Modelo
    
                    //         $printer->setEmphasis(false);
    
                    //         $printer -> text("Color y Talla:  ".$value["color"]." - T".$value["talla"]."\n");//Color Y tALLA
    
                    //         $printer -> text("Cantidad:  ".$value["cantidad"]."\n");//Cantidad
                    //         //Activamos negrita
                    //         $printer->setEmphasis(true);
    
                    //         $printer -> text("Operación:".$value["cod_operacion"]." - ".$value["operacion"]."\n");//Modelo
                        
                    //         $cantidad= strlen($value["codigo"]);
                    //         $a=substr($value["codigo"],0,2);
                    //         $b=substr($value["codigo"],2,2);
                    //         $c=substr($value["codigo"],4,2);
                    //         $d=substr($value["codigo"],6,2);
                    //         $e=substr($value["codigo"],8,2);
                    //         $item = "{C" . chr ( $a ). chr ( $b ). chr ( $c ). chr ( $d ). chr ( $e ) ;
                    //         //BARCODE
                    //         $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
                    //         $printer->setJustification(Printer::JUSTIFY_CENTER);
                    //         $printer->setBarcodeWidth(8);
                    //         $printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
                    //         $printer->barcode( $item , Printer::BARCODE_CODE128 );
                    //         $printer -> feed(1);
                            
                    //         $printer -> cut();
                    
                    //         }
    
                    //     $printer -> close();
                     }
                    else{
                        /* 
                        * Actualizamos la cantidad que queda en corte y pasa al servicio en el articulo
                        */
                        $articulo  = $_POST["nuevoArticulo"];
                        $cantidad =  $_POST["nuevoAlmCorte"];

                        $actualizaArticuloServicio = ModeloArticulos::mdlActualizarServicioCorte($articulo,$cantidad);

                        /* 
                        * Traemos el codigo del servicio cabecera creado mediante el evento 
                        */

                        $sector = $_POST["seleccionarSectorServicio"];

                        $primerServicio = ModeloServicios::mdlPrimerServicio($sector);

                        $codigoServicio = $primerServicio["codigo"];

                        /* 
                        * Guardamos el detalle del servicio y lo asignamos a la cabecera con el codigo de servicio 
                        */

                        $datosDetalle=array("articulo"=>$articulo,
                                            "cantidad"=>$cantidad,
                                            "codigo"=>$codigoServicio,
                                            "saldo"=>$cantidad,
                                            "cabecera_taller"=>$ult_codigo["ult_codigo"]);

						$respuestaDetalle =ModeloServicios::mdlGuardarDetallesServicios("servicios_detallejf",$datosDetalle);
                    }

                    

                    echo'<script>

                    swal({
                          type: "success",
                          title: "Se mando a taller correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "en-cortes";

                                    }
                                })

                    </script>';

                }

            }

        }

    }

    /*
    * MOSTRAR TALLERES DISPONIBLES
    */
	static public function ctrMostrarEnTalleres($articulo){

		$respuesta = ModeloCortes::mdlMostrarEnTalleres($articulo);

		return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE ALMACEN DE CORTE -VERSION 2
    */
    static public function ctrMostrarEnviadosTaller($modeloTaller){

        $respuesta = ModeloCortes::mdlMostrarEnviadosTaller($modeloTaller);

        return $respuesta;

    }    

}