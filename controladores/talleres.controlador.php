<?php
//session_start();
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class ControladorTalleres{

    /*
    * MOSTRAR DATOS DE TALLERES GENERAL
    */
    static public function ctrMostrarTalleresG($valor){

        $respuesta = ModeloTalleres::mdlMostrarTalleresG($valor);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES TERMINADO GENERAL
    */
    static public function ctrMostrarTalleresTerminado($valor){

        $respuesta = ModeloTalleres::mdlMostrarTalleresTerminado($valor);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES GENERADOS GENERAL
    */
    static public function ctrMostrarTalleresGenerados($articuloTaller){

        $respuesta = ModeloTalleres::mdlMostrarTalleresGenerados($articuloTaller);

        return $respuesta;

    }
    /*
    * MOSTRAR DATOS DE TALLERES PROCESO 5 LINEAS
    */
    static public function ctrMostrarTalleresP(){

        $respuesta = ModeloTalleres::mdlMostrarTalleresP();

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES TERMINADO
    */
    static public function ctrMostrarTalleresT(){

        $respuesta = ModeloTalleres::mdlMostrarTalleresT();

        return $respuesta;

    }
    
    /*
    * MOSTRAR DATOS DE TALLERES GENERAL
    */
    static public function ctrMostrarTallerCabecera($item,$valor){

        $tabla="entaller_cabjf";
        $respuesta = ModeloTalleres::mdlMostrarTallerCabecera($tabla,$item,$valor);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES TERMINADO GENERAL
    */
    static public function ctrActualizarTallerT($valor1,$valor2){

        $respuesta = ModeloTalleres::mdlActualizarTallerT($valor1, $valor2);

        return $respuesta;

    }

    /* 
    * ACTUALIZAR A EN PROCESO
    */
    static public function ctrProceso(){

        if(isset($_POST["codigoBarra"])){

            $cobar = $_POST["codigoBarra"];

            $validar = ModeloTalleres::mdlMostrarTalleresG($cobar);
            //var_dump($validar);
            //var_dump("fecha_proceso", $validar["fecha_proceso"]);

            if($validar["fecha_proceso"] == null){

                # Actualizamos ultima_compra en la tabla Clientes
                date_default_timezone_set('America/Lima');

                //$fecha = "2021-02-26";
                $fecha = date('Y-m-d G:i:s');
                //var_dump($fecha);

                $codigo = $_POST["codigoBarra"];
                $trabajador = $_POST["cod_tra"];

                $respuesta = ModeloTalleres::mdlProceso($fecha,$codigo,$trabajador);
                //var_dump($respuesta);

                $respuesta2 = ModeloTalleres::mdlTerminado($fecha,$codigo,$trabajador);

                if($respuesta == "ok"){

                echo'<script>

                Command: toastr["success"]("Registrado exitosamente!");

                </script>';


                }else{
                    echo'<script>

                        Command: toastr["error"]("El ticket ya fue registrado antes!");

                        </script>';
                }
                

            }else{

                # Actualizamos ultima_compra en la tabla Clientes
                date_default_timezone_set('America/Lima');

                //$fecha = "2021-02-26";
                $fecha = date('Y-m-d G:i:s');
                //var_dump($fecha);

                $codigo = $_POST["codigoBarra"];
                $trabajador = $_POST["cod_tra"];

                $respuesta = ModeloTalleres::mdlProceso($fecha,$codigo,$trabajador);

                $respuesta = ModeloTalleres::mdlTerminado($fecha,$codigo,$trabajador);

                if($respuesta == "ok"){
                    echo'<script>
                        

                        Command: toastr["success"]("Registrado exitosamente!");

                        </script>';

                }else{
                    echo'<script>

                        Command: toastr["error"]("El ticket ya fue registrado antes!");

                        </script>';
                }

            }

        }

    }


	/* 
	* Asignar codigo de barra a trabajador
	*/

	static public function ctrAsignarTrabajador(){

		if(isset($_POST["cod_tra"])){
            $datos =array( "codigo"=>$_POST["codigoBarra"],
                            "trabajador"=>$_POST["cod_tra"],
                            "fecha_proceso"=>$_POST["editarFechaProceso"],
                            "fecha_terminado"=>$_POST["editarFechaTerminado"]);

            $respuesta = ModeloTalleres::mdlAsignarTrabajador($datos);
            // var_dump($respuesta);

            if($respuesta == "ok"){

                echo'<script>
                    swal({
						  type: "success",
						  title: "El trabajador y fecha ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-tallert";

									}
								})

					</script>';

            }

		}

    }    
    
    /*=============================================
	Dividir Cantidad Taller General
	=============================================*/

	static public function ctrEditarCantidad(){

		if(isset($_POST["editarCantidad2"])){
            $dividir=substr($_POST["editarBarra"],-1);
            $cantidad= strlen($_POST["editarBarra"]);
            if($cantidad == 11){
                if($dividir == 'A'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."2";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'B'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."3";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'C'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."4";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'D'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."5";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'E'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."6";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'F'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."7";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '1'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."2";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '2'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."3";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '3'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."4";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '4'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."5";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '5'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."6";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '6'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."7";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '7'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."8";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == '8'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."9";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }

            }else{
                $datos = array("codigo" => $_POST["editarCodigo"], 
                        "usuario" => $_POST["usuario"],
                        "articulo" => $_POST["editarArticulo"],
                        "operacion" => $_POST["editarCodOperacion"],
                        "cantidad" => $_POST["editarCantidad2"],
                        "editarBarra" => $_POST["editarBarra"]);

                $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."1";
                $datos2 = array("codigo" => $_POST["editarCodigo"],
                        "usuario" => $_POST["usuario"],
                        "articulo" => $_POST["editarArticulo"],
                        "operacion" => $_POST["editarCodOperacion"],
                        "cantidad" => $cantidad2,
                        "editarBarra" => $codigoBarraNuevo);
                $tabla="entallerjf";
                $id=$_POST["editarTaller"];
                $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
            }
                
                
				if($respuesta == "ok" ){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidad2"];
                    $cod_ope = $_POST["editarCodOperacion"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    // $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir2.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-taller";

									}
								})

					</script>';

				}


		}

    }

    
/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasTalleres($fechaInicial, $fechaFinal){

		$tabla = "entallerjf";

		$respuesta = ModeloTalleres::mdlRangoFechasTalleres($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
    }

    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasTalleresOperaciones($modelo){


		$respuesta = ModeloTalleres::mdlRangoFechasTalleresOperaciones($modelo);

		return $respuesta;
		
    }
    

    static public function ctrMes(){

        $respuesta = ModeloTalleres::mdlMes();

        return $respuesta;

    }    
    
    /*
    * MOSTRAR PRODUCCION DE TRUSAS
    */
    static public function ctrMostrarProduccionTrusas($fechaInicial,$fechaFinal){

        $respuesta = ModeloTalleres::mdlMostrarProduccionTrusas($fechaInicial,$fechaFinal);

        return $respuesta;

    }

    /*
    * MOSTRAR PRODUCCION DE BRASIER
    */
    static public function ctrMostrarProduccionBrasier($fechaInicial,$fechaFinal){

        $respuesta = ModeloTalleres::mdlMostrarProduccionBrasier($fechaInicial,$fechaFinal);

        return $respuesta;

    }

    /*
    * MOSTRAR PRODUCCION DE VASCO
    */
    static public function ctrMostrarProduccionVasco($mes){

        $respuesta = ModeloTalleres::mdlMostrarProduccionVasco($mes);

        return $respuesta;

    }    


    /*=============================================
	RANGO FECHAS TERMINADOS
	=============================================*/	

	static public function ctrRangoFechasTalleresTerminados($fechaInicial, $fechaFinal){

		$tabla = "entallerjf";

		$respuesta = ModeloTalleres::mdlRangoFechasTalleresTerminados($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

    
    /*=============================================
	Dividir Cantidad Taller Terminado
	=============================================*/

	static public function ctrEditarCantidadTerminado(){

		if(isset($_POST["editarCantidades"])){
            $dividir=substr($_POST["editarBarra"],-1);
            $cantidad= strlen($_POST["editarBarra"]);
            if($cantidad == 11){
                if($dividir == 'A'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."2";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == 'B'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."3";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == 'C'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."4";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == 'D'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."5";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == 'E'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."6";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == 'F'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."7";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '1'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."2";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '2'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."3";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '3'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."4";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '4'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."5";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '5'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."6";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '6'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."7";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '7'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."8";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }else if($dividir == '8'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);
    
                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."9";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                }

            }else{
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."1";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
                }
                
				if($respuesta == "ok" && $respuesta2=="ok"){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidades"];
                    $cod_ope = $_POST["editarCodOperaciones"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    // $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir2.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-tallert";

									}
								})

					</script>';

				}


		}

    }

    /*=============================================
	EXPORTAR TICKET POR CODIGO UNICO TALLER CABECERA
	=============================================*/

	static public function ctrExportarArticulo(){

		if(isset($_POST["nuevoCodigo"])){

            $cod = $_POST["nuevoCodigo"];

            $nombre_impresora = "Star BSC10"; 
 
            $connector = new WindowsPrintConnector($nombre_impresora);
            $printer = new Printer($connector);
 
            $fecha = date("d-m-Y");

            $respuesta = ControladorCortes::ctrMostrarEnTalleres($cod);
            //Establecemos los datos de la empresa
            $empresa = "Corporacion Vasco S.A.C.";
            $documento = "20513613939";

            foreach ($respuesta as $key => $value) {
                
                $printer -> setFont(Printer::FONT_B);
                $printer -> setJustification(Printer::JUSTIFY_CENTER);
                $printer -> setTextSize(1, 1);
                //Activamos negrita

                $printer->setPrintLeftMargin(0); // margen 0
                $printer->setEmphasis(true);
				$printer -> text(".::Corporación Vasco S.A.C::."."\n");//Nombre de la empresa
 
				$printer -> text("=================================="."\n");//Dirección de la empresa
                //Quitamos negrita
                
                
                $printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("Modelo:".$value["modelo"]." - ".$value["nombre"]."\n");//Modelo

                $printer->setEmphasis(false);

				$printer -> text("Color y Talla:  ".$value["color"]." - T".$value["talla"]."\n");//Color Y tALLA

                $printer -> text("Cantidad:  ".$value["cantidad"]."\n");//Cantidad
                //Activamos negrita
                $printer->setEmphasis(true);

                $printer -> text("Operación:".$value["cod_operacion"]." - ".$value["operacion"]."\n");//Modelo
               
                $cantidad= strlen($value["codigo"]);
                $a=substr($value["codigo"],0,2);
                $b=substr($value["codigo"],2,2);
                $c=substr($value["codigo"],4,2);
                $d=substr($value["codigo"],6,2);
                $e=substr($value["codigo"],8,2);
                $item = "{C" . chr ( $a ). chr ( $b ). chr ( $c ). chr ( $d ). chr ( $e ) ;
                //BARCODE
                $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->setBarcodeWidth(8);
                $printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
                $printer->barcode( $item , Printer::BARCODE_CODE128 );
				$printer -> feed(1);
                  
                $printer -> cut();
          
                }
                $printer -> close();


            echo'<script>

            swal({
                  type: "success",
                  title: "Se exporto ticket de articulo a taller correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "en-taller";

                            }
                        })

            </script>';
		}

    }

    /*=============================================
	ELIMINAR TALLER POR CODIGO UNICO TALLER CABECERA
	=============================================*/

	static public function ctrEliminarArticulo(){

		if(isset($_POST["nuevoCodigo2"])){
            $tabla="entallerjf";
            $cod = $_POST["nuevoCodigo2"];

            $respuesta1=ModeloTalleres::mdlEliminarTallerDetalle($tabla,$cod);
            $tabla2="entaller_cabjf";
            //Traemos la cabecera taller
            $cabeceraTaller=ControladorTalleres::ctrMostrarTallerCabecera("id",$cod);

            $existeServicio = ControladorServicios::ctrMostrarDetallesServicios("cabecera_taller",$cod);

            if($existeServicio){

                /* 
                * Actualizamos la cantidad que quedo en taller y regresa al corte en el codigo unico eliminado
                */
                $articulo  = $cabeceraTaller["articulo"];
                $cantidad =  $cabeceraTaller["cantidad"];

                $respuesta=ModeloArticulos::mdlActualizarServicioEliminado($articulo,$cantidad);

                /* 
                * Eliminar el servicio detalle 
                */
                $eliminarDeta=ModeloServicios::mdlEliminarDato("servicios_detallejf","cabecera_taller",$cod);

            }else{

                /* 
                * Actualizamos la cantidad que quedo en taller y regresa al corte en el codigo unico eliminado
                */
                $articulo  = $cabeceraTaller["articulo"];
                $cantidad =  $cabeceraTaller["cantidad"];

                $respuesta=ModeloArticulos::mdlActualizarTallerEliminado($articulo,$cantidad);

            }


            $respuesta2=ModeloTalleres::mdlEliminarTaller($tabla2,$cod);
            if($respuesta2 == "ok"){
                echo'<script>

                swal({
                    type: "success",
                    title: "Se elimino el ticket de taller correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                                if (result.value) {

                                window.location = "en-taller";

                                }
                            })
                </script>';
            }
		}

    }

    /*=============================================
	Dividir cantidad Taller Operaciones
	=============================================*/

	static public function ctrEditarCantidadOperacion(){

		if(isset($_POST["editarCantidad2"])){
                $dividir=substr($_POST["editarBarra"],-1);
                $cantidad= strlen($_POST["editarBarra"]);
                if($cantidad == 11){
                    if($dividir == 'A'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."2";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == 'B'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."3";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == 'C'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."4";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == 'D'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."5";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == 'E'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."6";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == 'F'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."7";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == '1'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."2";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    } else if($dividir == '2'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."3";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == '3'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."4";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == '4'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."5";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == '5'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."6";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    } else if($dividir == '6'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."7";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == '7'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."8";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }else if($dividir == '8'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $_POST["editarCantidad2"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                        $codigoBarraNuevo=$_POST["editarBarra"]."9";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperacion"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }
                }else{
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarBarra"]."1";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
                }
                
                
				if($respuesta == "ok" ){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidad2"];
                    $cod_ope = $_POST["editarCodOperacion"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    // $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir2.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operacion-taller";

									}
								})

					</script>';

				}


		}

    }

    /*=============================================
	Dividir Cantidad Taller Generado
	=============================================*/

	static public function ctrEditarCantidadGenerado(){

		if(isset($_POST["editarCantidades"])){
                $dividir=substr($_POST["editarBarra"],-1);
                $cantidad= strlen($_POST["editarBarra"]);
                if($cantidad == 11){
                    if($dividir == 'A'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."2";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperaciones"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == 'B'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."3";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                    "usuario" => $_POST["usuario"],
                                    "articulo" => $_POST["editarArticulo"],
                                    "operacion" => $_POST["editarCodOperaciones"],
                                    "cantidad" => $cantidad2,
                                    "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == 'C'){
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."4";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == 'D'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."5";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == 'E'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."6";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == 'F'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."7";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == '1'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."2";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == '2'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."3";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == '3'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."4";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == '4'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."5";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }elseif($dividir == '5'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."6";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }
                    elseif($dividir == '6'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."7";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }
                    elseif($dividir == '7'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."8";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }
                    elseif($dividir == '8'){
    
                        $datos = array("codigo" => $_POST["editarCodigo"], 
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $_POST["editarCantidades"],
                                "editarBarra" => $_POST["editarBarra"]);
    
                        $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                        $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."9";
                        $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                        $tabla="entallerjf";
                        $id=$_POST["editarTaller"];
                        $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                        $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                        $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
    
                    }


                }else{
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."1";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
                }
                
                
				if($respuesta == "ok" ){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidades"];
                    $cod_ope = $_POST["editarCodOperaciones"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    // $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir2.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-tallerp";

									}
								})

					</script>';

				}


		}

    }

    /*=============================================
	Dividir Cantidad Taller Generado
	=============================================*/

	static public function ctrRegresarCantidadGenerado(){

		if(isset($_POST["regresarCantidades"])){
                $barraAntiguo=ModeloTalleres::mdlMostrarTalleresGenerados2($_POST["regresarBarra"]);
                var_dump($barraAntiguo);
                $cantidad2=$barraAntiguo["cantidad"]+$_POST["regresarCantidades"];
                $datos2 = array("codigo" => $_POST["regresarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["regresarArticulo"],
                            "operacion" => $_POST["regresarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $_POST["regresarBarra"]);
                $tabla="entallerjf";
                $id=$_POST["regresarTaller"];
                $estadoAntiguo=$barraAntiguo["estado"];
               
    
                if($estadoAntiguo == "1"){
                    $eliminar=ModeloTalleres::mdlEliminarTallerGenerado($tabla,$id);
                    $eliminarAntiguo=ModeloTalleres::mdlEliminarTallerGenerado($tabla,$barraAntiguo["id"]);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
                    
                        echo'<script>
    
                        swal({
                              type: "success",
                              title: "La cantidad ha sido regresada correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "en-tallerp";
    
                                        }
                                    })
    
                        </script>';
                }else{
                    echo'<script>
    
                    swal({
                          type: "error",
                          title: "El codigo de barra anterior ya fue terminado",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "en-tallerp";

                                    }
                                })

                    </script>';

                }
                
                
				


		}

    }

    static public function ctrCrearTicket(){

		if(isset($_POST["verCantidad"])){
            $datosCab=array("articulo" => $_POST["verArti"], 
                             "usuario" => $_POST["verUser"],
                             "cantidad" => $_POST["verCantidad"]);
            $respuestaCab=ModeloCortes::mdlMandarTallerCab($datosCab);
            
            

            $ultId=ModeloCortes::mdlUltCodigo();

            $datos = array("codigo" => $ultId["ult_codigo"], 
                    "usuario" => $_POST["verUser"],
                    "articulo" => $_POST["verArti"],
                    "operacion" => $_POST["verCodOP"],
                    "cantidad" => $_POST["verCantidad"],
                    "editarBarra" => $ultId["ult_codigo"].$_POST["verCodOP"]);

            $respuesta=ModeloTalleres::mdlIngresarTaller($datos);
            
            if($respuesta == "ok"){
                $ultimo = $ultId["ult_codigo"].$_POST["verCodOP"];
                $valor=$_POST["verArti"];
                $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                $modelo = $rpt_articulo["modelo"];
                $nombre = $rpt_articulo["nombre"];
                $color = $rpt_articulo["color"];
                $talla = $rpt_articulo["talla"];
                $cantidad = $_POST["verCantidad"];
                $cod_ope = $_POST["verCodOP"];
                $tablaop="operacionesjf";
                $itemop="codigo";
                $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                $nom_ope = $rpt_operacion["nombre"];

                echo '<script>

                window.open("vistas/reportes_ticket/produccion_ticket_detalle.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                </script>';

                echo'<script>
                    swal({
						  type: "success",
						  title: "El ticket ha sido creado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-taller";

									}
								})

					</script>';

            }

        }
    }

    static public function ctrCrearTicketOriginal(){

        if(isset($_POST["ticketArticulo"])){

            /* 
            * registramos en la tabla taller cabecera para el código
            */
            $datosCab = array( "usuario" => $_POST["ticketUser"],
                            "articulo" => $_POST["ticketArticulo"],
                            "cantidad" => $_POST["ticketCantidad"]);

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
                $datos = array("codigo" => $ult_codigo["ult_codigo"], 
                    "usuario" => $_POST["ticketUser"],
                    "articulo" => $_POST["ticketArticulo"],
                    "operacion" => $_POST["ticketOperacion"],
                    "cantidad" => $_POST["ticketCantidad"],
                    "editarBarra" => $ult_codigo["ult_codigo"].$_POST["ticketOperacion"]);
                

                $respuesta=ModeloTalleres::mdlIngresarTaller($datos);

                //var_dump($respuesta);
                if($respuesta == "ok"){

                    $ultimo = $ult_codigo["ult_codigo"].$_POST["ticketOperacion"];
                    $valor=$_POST["ticketArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["ticketCantidad"];
                    $cod_ope = $_POST["ticketOperacion"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];
    
                    echo '<script>
    
                    window.open("vistas/reportes_ticket/produccion_ticket_detalle.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                    </script>';
                    echo'<script>

                    swal({
                          type: "success",
                          title: "Se mando a taller correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {

                            window.location = "en-taller";

                            }
                        })

                    </script>';

                }

            }

        }

    }

    static public function ctrMesB($mes){

        $respuesta = ModeloTalleres::mdlMesB($mes);

        return $respuesta;

    }  

}