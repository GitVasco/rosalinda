<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorCierres{

	/*=============================================
	MOSTRAR CIERRES
	=============================================*/

	static public function ctrMostrarCierres($item, $valor){

		$tabla = "cierresjf";

		$respuesta = ModeloCierres::mdlMostrarCierres($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CIERRES DETALLE
	=============================================*/

	static public function ctrMostrarDetallesCierres($item, $valor){

		$tabla = "cierres_detallejf";

		$respuesta = ModeloCierres::mdlMostraDetallesCierres($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR CIERRE
	=============================================*/

	static public function ctrCrearCierre(){

		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevoCierre"]) && 
		   isset($_POST["seleccionarSector"]) && 
		   isset($_POST["listaProductos"])){

			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listaProductos"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ningún articulo. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="crear-cierre";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaProductos=json_decode($_POST["listaProductos"],true);
				
				$comprasTotales=0;

				foreach($listaProductos as $key=>$value){

					$tabla="articulojf";
					$valor=$value["articulo"];
					$respuestaProducto=ModeloArticulos::mdlMostrarArticulos($valor);
					$item1 = "servicio";
					$valor1 = $respuestaProducto["servicio"]-$value["cantidad"];
					ModeloArticulos::mdlActualizarUnDato($tabla, $item1, $valor1, $valor);
					$tabla2="servicios_detallejf";
					$item2 = "saldo";
					$valor2 = $value["saldo"] - $value["cantidad"];
					$idServicio=$value["codServicio"];
					$saldoServicio=ModeloCierres::mdlActualizarUnDato($tabla2, $item2, $valor2, $idServicio);
					

				}

			

				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$fecha=new DateTime();
				
				/* ==============================================
				GUARDAMOS LA VENTA
				============================================== */

				$datos=array("codigo"=>$_POST["nuevoCierre"],
							 "guia"=>$_POST["nuevaGuia"],
							 "taller"=>$_POST["seleccionarSector"],
							 "usuario"=>$_POST["idVendedor"],
							 "total"=>$_POST["totalVenta"],
							 "fecha"=>$fecha->format("Y-m-d H:i:s"),
							 "estado"=>"ACTIVO");

				$respuesta=ModeloCierres::mdlGuardarCierres("cierresjf",$datos);

				if($respuesta=="ok"){


					foreach($listaProductos as $key=>$value){

						$datos=array("articulo"=>$value["articulo"],
									 "cantidad"=>$value["cantidad"],
									 "codigo"=>$_POST["nuevoCierre"],
									 "cod_servicio"=>$value["codServicio"]);

									 ModeloCierres::mdlGuardarDetallesCierres("cierres_detallejf",$datos);
					
					}

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "success",
								title: "Felicitaciones",
								text: "¡La información fue registrada con éxito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="cierres";}
							});
						</script>';
					}else{

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="crear-cierre";}
							});
						</script>';
					}				
			}			
		}

	}	

	/*=============================================
	EDITAR CIERRE
	=============================================*/

	public function ctrEditarCierres(){

		if(isset($_POST["editarCierre"]) && isset($_POST["idSectorVenta"]) && isset($_POST["listaProductos"])){

			# Formateamos la tabla de Productos y de Clientes
			# Traemos los detalles asociados a la venta a editar
		
			$detaProductos=ModeloCierres::mdlMostraDetallesCierres("cierres_detallejf","codigo",$_POST["editarCierre"]);
		
			# Cambiamos los id de la lista por los id de los Productos
			foreach($detaProductos as $key=>$value){

				$infoPro=controladorArticulos::ctrMostrarArticulos($value["articulo"]);
				$detaProductos[$key]["articulo"]=$infoPro["articulo"];
				
			
			}	

			if($_POST["listaProductos"]==""){

				$listaProductos=$detaProductos;
				$validarCambio=false;

			}else{

				$listaProductos=json_decode($_POST["listaProductos"],true);
				$validarCambio=true;

			}
			
			if($validarCambio){


				foreach($listaProductos as $key=>$value){
					# Traemos los productos por ID en cada interacción
					$valor=$value["articulo"];

					$respuestaProducto=ModeloArticulos::mdlMostrarArticulos($valor);


					# Actualizamos las ventas en la tabla productos
					$item1="servicio";
					$valor1=$value["servicio"]-$value["cantidad"];

					ModeloArticulos::mdlActualizarUnDato("articulojf", $item1, $valor1, $valor);
					$tabla2="servicios_detallejf";
					$item2 = "saldo";
					$idServicio=$value["codServicio"];
					$saldoServicio=ModeloCierres::mdlActualizarUnDato($tabla2, $item2, $valor1, $idServicio);
				}


				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$fecha= new DateTime();

			}
			
			/* ==============================================
			EDITAMOS LOS CAMBIOS DE LA VENTA listaMetodoPago
			============================================== */
			$datos=array("codigo"=>$_POST["editarCierre"],
						 "guia"=>$_POST["editarGuia"],
						 "usuario"=>$_POST["idVendedor"],
						 "taller"=>$_POST["idSectorVenta"],
						 "total"=>$_POST["totalVenta"],
						 "fecha"=>$fecha->format("Y-m-d H:i:s"));
						 						

			$respuesta=ModeloCierres::mdlEditarCierres("cierresjf",$datos);


			/* var_dump("datos", $datos); */

			if($respuesta=="ok"){

				# Eliminamos los detalles de la venta
				$eliminarDeta=ModeloCierres::mdlEliminarDato("cierres_detallejf","codigo",$_POST["editarCierre"]);

				if($eliminarDeta=="ok"){

					# Guardamos los nuevos detalles de la venta
					foreach($listaProductos as $key=>$value){

						$datos=array("codigo"=>$_POST["editarCierre"],
									 "articulo"=>$value["articulo"],
									 "cantidad"=>$value["cantidad"],
									 "cod_servicio"=>$value["codServicio"]);

									 ModeloCierres::mdlGuardarDetallesCierres("cierres_detallejf",$datos);
					
					
					}
					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "success",
								title: "Felicitaciones",
								text: "¡La información fue Actualizada con éxito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="cierres";}
							});
						</script>';
				}else{
					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas al actualizar los Detalles. Por favor, comunicarse con el Administrador de la Base de Datos!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="cierres";}
							});
						</script>';
				}
					
			}else{
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡La información presento problemas y no se actualizó adecuadamente. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="cierres";}
						});
					</script>';
				
			}			



		}		
	} 


	/*=============================================
	ELIMINAR CIERRE
	=============================================*/

	static public function ctrEliminarCierre($codigo){

		$item = "codigo";
        $infoCierre = ModeloCierres::mdlMostrarCierres("cierresjf", $item, $codigo);
    	

        $detaCierre = ModeloCierres::mdlMostraDetallesCierres("cierres_detallejf", "codigo", $codigo);
        

        /* 
        todo: Actualizamos orden de corte en Articulojf
        */
        foreach($detaCierre as $key=>$value){

            $valorA = $value["articulo"];

            $infoA = ModeloArticulos::mdlMostrarArticulos($valorA);
            // var_dump("infoA", $infoA);
            #var_dump("infoA", $infoA["ord_corte"]);
            #var_dump("cantidad", $value["cantidad"]);

            $servicio = $infoA["servicio"] + $value["cantidad"];
            #var_dump("ord_corte", $ord_corte);

			ModeloArticulos::mdlActualizarUnDato("articulojf", "servicio", $servicio, $value["articulo"]);

			$tabla2="servicios_detallejf";
			$item2 = "saldo";
			$saldoServicio=ModeloArticulos::mdlActualizarUnDato($tabla2, $item2, $servicio, $value["articulo"]);

		
        }

        /* 
        todo: Eliminamos la cabecera de Orden de corte
        */
        $tablaCierre = "cierresjf";
        $itemCierre = "codigo";
        $valorCierre = $codigo;

        $respuesta = ModeloCierres::mdlEliminarDato($tablaCierre, $itemCierre, $valorCierre);

        if($respuesta == "ok"){

            /* 
            todo: Eliminamos el detalle de Orden de corte
            */
            $tablaDSer = "cierres_detallejf";
            $itemDSer = "codigo";
            $valorDSer = $codigo;

            ModeloCierres::mdlEliminarDato($tablaDSer, $itemDSer, $valorDSer);

        }

        return $respuesta;


	}

	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "cierresjf";

		$respuesta = ModeloCierres::mdlSumaTotalCierres($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR ULTIMO SERVICIOS
	=============================================*/

	static public function ctrMostrarUltimoCierre(){

		$tabla = "cierresjf";

		$respuesta = ModeloCierres::mdlUltimoCierre($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR ULTIMO SERVICIOS
	=============================================*/

	static public function ctrMostrarArticulosCierre($sectorCierre){


		$respuesta = ModeloCierres::mdlMostrarArticulosCiere($sectorCierre);

		return $respuesta;

	}
	// VISUALIZAR CIERRE DETALLE
	static public function ctrVisualizarCierrreDetalle($valor){

        $respuesta = ModeloCierres::mdlVisualizarCierreDetalle($valor);
        
		return $respuesta;

	} 

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasCierres($fechaInicial, $fechaFinal){

		$tabla = "cierresjf";

		$respuesta = ModeloCierres::mdlRangoFechasCierres($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVerCierres($fechaInicial, $fechaFinal){

		$tabla = "cierresjf";

		$respuesta = ModeloCierres::mdlRangoFechasVerCierres($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
    }
}