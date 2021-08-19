<?php

class ControladorOperaciones{

	/*=============================================
	CREAR OPERACIONES
	=============================================*/

	static public function ctrCrearOperacion(){

		if(isset($_POST["nuevaOperacion"])){

			
				$tabla="operacionesjf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
					           "nombre"=>$_POST["nuevaOperacion"]);

			   	$respuesta = ModeloOperaciones::mdlIngresarOperacion($tabla,$datos);
				
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operación ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operaciones";

									}
								})

					</script>';

				}

		}

	}

	/*=============================================
	CREAR OPERACIONES DESDE OPERACIONES MODELO
	=============================================*/

	static public function ctrCrearOperacion2(){

		if(isset($_POST["nuevaOperacion"])){

			
				$tabla="operacionesjf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
					           "nombre"=>$_POST["nuevaOperacion"]);

			   	$respuesta = ModeloOperaciones::mdlIngresarOperacion($tabla,$datos);
				
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operación ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "creardetalleoperaciones";

									}
								})

					</script>';

				}

		}

	}
	/*=============================================
	MOSTRAR OPERACIONES
	=============================================*/

	static public function ctrMostrarOperaciones($item,$valor){
        $tabla="operacionesjf";
		$respuesta = ModeloOperaciones::mdlMostrarOperaciones($tabla,$item,$valor);

		return $respuesta;

    }
	
	
	/*=============================================
	MOSTRAR CABECERA OPERACIONES
	=============================================*/

	static public function ctrMostrarCabeceraOperaciones($item,$valor){
        $tabla="operacion_cabecerajf";
		$respuesta = ModeloOperaciones::mdlMostrarCabeceraOperaciones($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR MODELOS
	=============================================*/

	static public function ctrMostrarModelos($item,$valor){
        $tabla="modelojf";
		$respuesta = ModeloOperaciones::mdlMostrarModelos($tabla,$item,$valor);

		return $respuesta;

	}
	
	/*=============================================
	MOSTRAR DETALLE OPERACIONES
	=============================================*/

	static public function ctrMostrarDetalleOperaciones($item,$valor){
        $tabla="operaciones_detallejf";
		$respuesta = ModeloOperaciones::mdlMostrarDetalleOperaciones($tabla,$item,$valor);

		return $respuesta;

    }
	/*=============================================
	EDITAR OPERACIONES
	=============================================*/

	static public function ctrEditarOperacion(){

		if(isset($_POST["editarOperacion"])){

			var_dump("editarOperacion", $_POST["editarOperacion"]);


			   	$datos = array("id"=>$_POST["idOperacion"],
							   "codigo"=>$_POST["editarCodigo"],
							   "nombre"=>$_POST["editarOperacion"]);

				$tabla="operacionesjf";
			   	$respuesta = ModeloOperaciones::mdlEditarOperacion($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operacion ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operaciones";

									}
								})

					</script>';

				}

		}

    }
    
	/*=============================================
	ELIMINAR OPERACION
	=============================================*/

	static public function ctrEliminarOperacion(){

		if(isset($_GET["idOperacion"])){
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$tabla ="operacionesjf";
			$datos = $_GET["idOperacion"];
			$operacion=ControladorOperaciones::ctrMostrarOperaciones("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino una operacion';
			$descripcion   = 'El usuario '.$usuario.' elimino la operacion '.$operacion["codigo"].' - '.$operacion["nombre"];
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
			$respuesta = ModeloOperaciones::mdlEliminarOperacion($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La operación ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "operaciones";

								}
							})

				</script>';

			}		

		}

	}    
	/* 
	* VISUALIZAR DATOS DETALLE OPERAICON
	*/
	static public function ctrVisualizarOperacionDetalle($item,$valor){
		$tabla="operaciones_detallejf";
		$respuesta = ModeloOperaciones::mdlVisualizarOperacionDetalle($tabla,$item,$valor);

		return $respuesta;

	}
	
	/*=============================================
	CREAR OPERACIÓN POR MODELO
	=============================================*/

	static public function ctrCrearOperacionModelo(){

		if(isset($_POST["seleccionarArticulo"])){

			if($_POST["listaOperaciones"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ninguna operacion. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="detalleoperaciones";}
						});
					</script>';
			}else{
				$tabla="operacion_cabecerajf";
				$datos = array("articulo" => $_POST["seleccionarArticulo"],
				   				 "vendedor_fk"=>$_POST["idVendedor"],
					   		     "total_pd"=>$_POST["nuevoTotalDocena"],
							     "total_ts"=>$_POST["nuevoTotalStandar"]
							   );

			   	$respuesta = ModeloOperaciones::mdlIngresarCabeceraOperacion($tabla,$datos);
				ModeloOperaciones::mdlActualizarUnDato("modelojf","operaciones",1,$_POST["seleccionarArticulo"]);
				//DETALLE
				
				$operaciones=json_decode($_POST["listaOperaciones"],true);
				foreach($operaciones as $key=>$value){
					$tabla2="operaciones_detallejf";
					$datos2=array("modelo"=>$_POST["seleccionarArticulo"],
								  "cod_operacion"=>$value["codigo"],
								  "precio_doc"=>$value["precio"],
								  "tiempo_stand"=>$value["tiempo"],);
					$respuesta2= ModeloOperaciones::mdlIngresarDetalleOperacion($tabla2,$datos2);
					
				}
			   	if($respuesta == "ok"  && $respuesta2=="ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operación ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "detalleoperaciones";

									}
								})

					</script>';

				}

			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La operación no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "detalleoperaciones";

							}
						})

			  	</script>';



			}
		}

		}

    }
    


	/*=============================================
	EDITAR DETALLE OPERACIONES
	=============================================*/

	static public function ctrEditarCabeceraOperacion(){

		if(isset($_POST["seleccionarArticulo"])){

			if($_POST["listaOperaciones"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ninguna operacion. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="detalleoperaciones";}
						});
					</script>';
			}else{
				$tabla="operacion_cabecerajf";
				$datos = array( "id"=>$_POST["editarDetalleOperacion"],
								"articulo" => $_POST["seleccionarArticulo"],
				   				 "vendedor_fk"=>$_POST["idVendedor"],
					   		     "total_pd"=>$_POST["nuevoTotalDocena"],
							     "total_ts"=>$_POST["nuevoTotalStandar"]
							   );

			   	$respuesta = ModeloOperaciones::mdlEditarCabeceraOperacion($tabla,$datos);
				
				$tabla2="operaciones_detallejf";
				$valor2=$_POST["seleccionarArticulo"];
				

				//DETALLE
				
				$operaciones=json_decode($_POST["listaOperaciones"],true);
				$detalle = ModeloOperaciones::mdlEliminarDetalleOperacion($tabla2,$valor2);
				foreach($operaciones as $key=>$value){
					
					$datos2=array("modelo"=>$_POST["seleccionarArticulo"],
								  "cod_operacion"=>$value["codigo"],
								  "precio_doc"=>$value["precio"],
								  "tiempo_stand"=>$value["tiempo"],);
					$respuesta2= ModeloOperaciones::mdlIngresarDetalleOperacion($tabla2,$datos2);
					
				}
			   	if($respuesta == "ok"  && $respuesta2=="ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operación ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "detalleoperaciones";

									}
								})

					</script>';

				}

			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La operación no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "detalleoperaciones";

							}
						})

			  	</script>';



			}
		}

		}

	}
	
	//ELIMINAR CABECERA OPERACION
	static public function ctrEliminarCabeceraOperacion(){

		if(isset($_GET["idOperacion"])){

			$tabla ="operacion_cabecerajf";
			$datos = $_GET["idOperacion"];

			

			$respuesta = "ok";

			//LLAMAMOS CABECERA
			$item="id";
			$cabecera=ModeloOperaciones::mdlMostrarCabeceraOperaciones($tabla,$item,$datos);

			$tabla2="operaciones_detallejf";
			$itemDetalle="modelo";
			$valorDetalle=$cabecera["articulo"];
			$detalle=ModeloOperaciones::mdlMostrarDetalleOperaciones($tabla2,$itemDetalle,$valorDetalle);
			$modelo=ModeloOperaciones::mdlActualizarUnDato("modelojf","operaciones",0,$valorDetalle);

			foreach ($detalle as $key => $value) {
		
				$respuesta2=ModeloOperaciones::mdlEliminarDetalleOperacion($tabla2,$value["modelo"]);

			}
			$respuesta = ModeloOperaciones::mdlEliminarCabeceraOperacion($tabla,$datos);
			

	

		}

	} 


}
