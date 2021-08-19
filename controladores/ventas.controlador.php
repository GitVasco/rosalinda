<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevaVenta"]) && 
		   isset($_POST["seleccionarCliente"]) && 
		   isset($_POST["listaProductos"])){

			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listaProductos"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ningún producto. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="crear-venta";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaProductos=json_decode($_POST["listaProductos"],true);
				
				$comprasTotales=0;

				foreach($listaProductos as $key=>$value){

					$tabla="productos";
					$item="id";
					$valor=$value["id"];

					$comprasTotales=$comprasTotales+$value["cantidad"];
					$respuestaProducto=ModeloProductos::mdlMostrarProductos($tabla,$item,$valor);


					# Actualizamos las ventas en la tabla productos
					$item1="ventas";
					$valor1=$respuestaProducto["ventas"]+$value["cantidad"];
					ModeloVentas::mdlActualizarUnDato($tabla,$item1,$valor1,$valor);


					# Actualizamos el stock en la tabla productos
					$item2="stock";
					$valor2=$value["stock"];
					ModeloVentas::mdlActualizarUnDato($tabla,$item2,$valor2,$valor);

				}

				
				# Traemos la información del cliente
				$tabla="clientes";
				$item="id";
				$valor=$_POST["seleccionarCliente"];
				$cliente=ModeloClientes::mdlMostrarClientes($tabla,$item,$valor);

				# Actualizamos el compras en la tabla Clientes
				$item2="compras";
				$valor2=$cliente["compras"]+$comprasTotales;
				ModeloVentas::mdlActualizarUnDato($tabla,$item2,$valor2,$valor);

				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$item3="ultima_compra";
				$valor3=date('Y/m/d h:i:s');
				ModeloVentas::mdlActualizarUnDato($tabla,$item3,$valor3,$valor);	
				
				/* ==============================================
				GUARDAMOS LA VENTA
				============================================== */

				$datos=array("codigo"=>$_POST["nuevaVenta"],
							 "id_cliente"=>$_POST["seleccionarCliente"],
							 "id_vendedor"=>$_POST["idVendedor"],
							 "impuesto"=>$_POST["nuevoPrecioImpuesto"],
							 "neto"=>$_POST["nuevoPrecioNeto"],
							 "total"=>$_POST["totalVenta"],
							 "metodo_pago"=>$_POST["listaMetodoPago"],
							 "estado"=>"AC");

				$respuesta=ModeloVentas::mdlGuardarVentas("ventasjf",$datos);

				if($respuesta=="ok"){

					$ultimoId=ModeloVentas::mdlUltimoId("ventasjf",
														$_POST["seleccionarCliente"],
														$_POST["idVendedor"]);

					foreach($listaProductos as $key=>$value){

						$datos=array("id_venta"=>$ultimoId[0]["id"],
									 "producto"=>$value["codigo"],
									 "cantidad"=>$value["cantidad"],
									 "precio"=>$value["precio"],
									 "total_detalle"=>$value["total"]);

					ModeloVentas::mdlGuardarDetallesVenta("detalles_ventajf",$datos);
					
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
									window.location="ventas";}
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
									window.location="crear-venta";}
							});
						</script>';
					}				
			}			
		}

	}	

	/*=============================================
	EDITAR VENTA
	=============================================*/

	public function ctrEditarVentas(){

		if(isset($_POST["editarVenta"]) && isset($_POST["idClienteVenta"]) && isset($_POST["listaProductos"])){

			# Formateamos la tabla de Productos y de Clientes
			# Traemos los detalles asociados a la venta a editar
		
			$detaProductos=ModeloVentas::mdlMostraDetallesVentas("detalles_ventajf","id_venta",$_POST["editarVenta"]);

			# Cambiamos los id de la lista por los id de los Productos
			foreach($detaProductos as $key=>$value){

				$infoPro=ControladorProductos::ctrMostrarProductos("codigo",$value["producto"]);
				$detaProductos[$key]["id"]=$infoPro["id"];
			
			}	

			if($_POST["listaProductos"]==""){

				$listaProductos=$detaProductos;
				$validarCambio=false;

			}else{

				$listaProductos=json_decode($_POST["listaProductos"],true);
				$validarCambio=true;

			}
			
			if($validarCambio){

				# Traemos la información del cliente
				$itemCliente="id";
				$valorCliente=$_POST["idClienteVenta"];

				$cliente=ModeloClientes::mdlMostrarClientes("clientes",$itemCliente,$valorCliente);

				$comprasTotales=$cliente["compras"];

				foreach($detaProductos as $key=>$value){

					# Traemos los productos por ID en cada interacción
					$valor=$value["id"];

					$infoProducto=ModeloProductos::mdlMostrarProductos("productos","id",$valor);

					# Realizamos la resta de compras totales
					$comprasTotales=$comprasTotales-$value["cantidad"];

					# Actualizamos las ventas en la tabla productos
					$item1="ventas";
					$valor1=$infoProducto["ventas"]-$value["cantidad"];

					ModeloVentas::mdlActualizarUnDato("productos",$item1,$valor1,$valor);

					# Actualizamos el stock en la tabla productos
					$item2="stock";
					$valor2=$value["cantidad"]+$infoProducto["stock"];
					ModeloVentas::mdlActualizarUnDato("productos",$item2,$valor2,$valor);

				}
				# Actualizamos el compras en la tabla Clientes
				$item2="compras";
				$valor2=$comprasTotales;
				ModeloVentas::mdlActualizarUnDato("clientes",$item2,$valor2,$_POST["idClienteVenta"]);

				# Actualizamos los datos con lo que viene en las cajas
				# Modificamos la información de los productos comprados en un array

				$comprasTotales=0;

				foreach($listaProductos as $key=>$value){

					# Traemos los productos por ID en cada interacción
					$valor=$value["id"];

					$respuestaProducto=ModeloProductos::mdlMostrarProductos("productos","id",$valor);

					# Realizamos la suma de compras totales
					$comprasTotales=$comprasTotales+$value["cantidad"];

					# Actualizamos las ventas en la tabla productos
					$item1="ventas";
					$valor1=$respuestaProducto["ventas"]+$value["cantidad"];

					ModeloVentas::mdlActualizarUnDato("productos",$item1,$valor1,$valor);

					# Actualizamos el stock en la tabla productos
					$item2="stock";
					$valor2=$value["stock"];
					ModeloVentas::mdlActualizarUnDato("productos",$item2,$valor2,$valor);
				}

				# Traemos la información del cliente
				$item="id";
				$valor=$_POST["idClienteVenta"];

				$cliente=ModeloClientes::mdlMostrarClientes("clientes",$item,$valor);

				# Actualizamos el compras en la tabla Clientes
				$item2="compras";
				$valor2=$cliente["compras"]+$comprasTotales;

				ModeloVentas::mdlActualizarUnDato("clientes",$item2,$valor2,$_POST["idClienteVenta"]);

				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$item3="ultima_compra";
				$valor3=date('Y/m/d h:i:s');

				ModeloVentas::mdlActualizarUnDato("clientes",$item3,$valor3,$_POST["idClienteVenta"]);

			}
			
			/* ==============================================
			EDITAMOS LOS CAMBIOS DE LA VENTA listaMetodoPago
			============================================== */
			$datos=array("codigo"=>$_POST["editarVenta"],
						 "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						 "neto"=>$_POST["nuevoPrecioNeto"],
						 "total"=>$_POST["totalVenta"],
						 "metodo_pago"=>$_POST["listaMetodoPago"]);
						 						

			$respuesta=ModeloVentas::mdlEditarVentas("ventasjf",$datos);

			/* var_dump($_POST["listaMetodoPago"]); */

			/* var_dump("datos", $datos); */

			if($respuesta=="ok"){

				# Eliminamos los detalles de la venta
				$eliminarDeta=ModeloVentas::mdlEliminarDato("detalles_ventajf","id_venta",$_POST["editarVenta"]);

				if($eliminarDeta=="ok"){

					# Guardamos los nuevos detalles de la venta
					foreach($listaProductos as $key=>$value){

						$datos=array("id_venta"=>$_POST["editarVenta"],
									 "producto"=>$value["codigo"],
									 "cantidad"=>$value["cantidad"],
									 "precio"=>$value["precio"],
									 "total_detalle"=>$value["total"]);

						ModeloVentas::mdlGuardarDetallesVenta("detalles_ventaJF",$datos);
					
					
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
									window.location="ventas";}
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
									window.location="ventas";}
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
								window.location="ventas";}
						});
					</script>';
				
			}			



		}		
	} 


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta($idVenta){

		# Nos traemos la información de la Venta
		$item="id";
		$infoVenta=ModeloVentas::mdlMostrarVentas("ventasjf",$item,$idVenta);

		/* var_dump("infoventa", $infoVenta); */

		# ACTUALIZAMOS ÚLTIMA FECHA DE COMPRA
		# Traemos todas las ventas
		$todasVentas=ModeloVentas::mdlMostrarVentas("ventasjf",null,null);

		$arrayFechas=array();

		foreach($todasVentas as $key=>$value){	

			# Traemos todas las fechas del cliente al que se le borra la venta
			if($value["id_cliente"]==$infoVenta["id_cliente"]){

				# Almacenamos las fechas en el array
				array_push($arrayFechas,$value["fecha"]);
			
			}
		}

		# Válidamos que el array sea mayor a 1
		if(count($arrayFechas)>1){

			# Validamos que la fecha de la venta que se va a borrar sea la penúltima fecha
			if($infoVenta["fecha"]>$arrayFechas[count($arrayFechas)-2]){

				$item="ultima_compra";
				$valor=$arrayFechas[count($arrayFechas)-2];
				ModeloVentas::mdlActualizarUnDato("clientes",$item,$valor,$infoVenta["id_cliente"]);
			
			}
			# Si es la última
			else{
				$item="ultima_compra";
				$valor=$arrayFechas[count($arrayFechas)-1];
				ModeloVentas::mdlActualizarUnDato("clientes",$item,$valor,$infoVenta["id_cliente"]);}
		}else{
			$item="ultima_compra";
			$valor="0000-00-00 00:00:00";
			ModeloVentas::mdlActualizarUnDato("clientes",$item,$valor,$infoVenta["id_cliente"]);

		}

		# Formateamos la tabla de Productos y de Clientes

		$detalleProductos=ModeloVentas::mdlMostraDetallesVentas("detalles_ventajf","id_venta",$idVenta);
		/* var_dump("detalleProductos", $detalleProductos); */		
		
/* 		$productosEliminados=json_decode($detalleProductos["id"],true);
		var_dump("productosEliminados", $productosEliminados); */

		# Traemos la información del cliente
		$itemCliente="id";
		$valorCliente=$infoVenta["id_cliente"];

		$cliente=ModeloClientes::mdlMostrarClientes("clientes",$itemCliente,$valorCliente);

		$comprasTotales=$cliente["compras"];

		/* var_dump("productosEliminados", $productosEliminados); */

		foreach($detalleProductos as $key=>$value){

			# Traemos los productos por ID en cada interacción
			$item="codigo";
			$valor=$value["producto"];
			

			$infoProducto=ModeloProductos::mdlMostrarProductos("productos",$item,$valor);


			# Realizamos la resta de compras totales
			$comprasTotales=$comprasTotales-$value["cantidad"];

			# Actualizamos las ventas en la tabla productos
			$item1="ventas";
			$valor1=$infoProducto["ventas"]-$value["cantidad"];

			ModeloVentas::mdlActualizarUnDatoProducto("productos",$item1,$valor1,$valor);

			/* var_dump("ventas: ", $infoProducto["ventas"]," cantidad",$value["cantidad"]); */

			/* var_dump("formula","update productos set",$item1,"=",$valor1,"codigo=",$valor); */

			# Actualizamos el stock en la tabla productos
			$item2="stock";
			$valor2=$value["cantidad"]+$infoProducto["stock"];

			ModeloVentas::mdlActualizarUnDatoProducto("productos",$item2,$valor2,$valor);
		}
		# Actualizamos el compras en la tabla Clientes
		$item2="compras";
		$valor2=$comprasTotales;
		ModeloVentas::mdlActualizarUnDato("clientes",$item2,$valor2,$valorCliente);

		/* ==============================================
		ELIMINAMOS LA VENTA
		============================================== */
		$respuesta=ModeloVentas::mdlEliminarVenta("ventasjf",$idVenta);

		if($respuesta == "ok"){

			#eliminamos el detalla

			$respuesta2=ModeloVentas::mdlEliminarDato("detalles_ventajf","id_venta",$idVenta);

		}

		return $respuesta;


	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
		
			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

	/*=============================================
	DESCARGAR XML
	=============================================*/

	static public function ctrDescargarXML(){

		if(isset($_GET["xml"])){


			$tabla = "ventas";
			$item = "codigo";
			$valor = $_GET["xml"];

			$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			// PRODUCTOS

			$listaProductos = json_decode($ventas["productos"], true);

			// CLIENTE

			$tablaClientes = "clientes";
			$item = "id";
			$valor = $ventas["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			// VENDEDOR

			$tablaVendedor = "usuarios";
			$item = "id";
			$valor = $ventas["id_vendedor"];

			$traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

			//http://php.net/manual/es/book.xmlwriter.php

			$objetoXML = new XMLWriter();

			$objetoXML->openURI($_GET["xml"].".xml"); //Creación del archivo XML

			$objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

			$objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

			$objetoXML->startDocument('1.0', 'utf-8');// Inicio del documento
			
			// $objetoXML->startElement("etiquetaPrincipal");// Inicio del nodo raíz

			// $objetoXML->writeAttribute("atributoEtiquetaPPal", "valor atributo etiqueta PPal"); // Atributo etiqueta principal

			// 	$objetoXML->startElement("etiquetaInterna");// Inicio del nodo hijo

			// 		$objetoXML->writeAttribute("atributoEtiquetaInterna", "valor atributo etiqueta Interna"); // Atributo etiqueta interna

			// 		$objetoXML->text("Texto interno");// Inicio del nodo hijo
			
			// 	$objetoXML->endElement(); // Final del nodo hijo
			
			// $objetoXML->endElement(); // Final del nodo raíz


			$objetoXML->writeRaw('<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">');

			$objetoXML->writeRaw('<ext:UBLExtensions>');

			foreach ($listaProductos as $key => $value) {
				
				$objetoXML->text($value["descripcion"].", ");
			
			}

			

			$objetoXML->writeRaw('</ext:UBLExtensions>');

			$objetoXML->writeRaw('</fe:Invoice>');

			$objetoXML->endDocument(); // Final del documento

			return true;	
		}

	}

}