<?php

class ControladorTrabajador{

	/*=============================================
	MOSTRAR TRABAJADORES
	=============================================*/

	static public function ctrMostrarTrabajador($item,$valor){
        $tabla="trabajadorjf";
		$respuesta = ModeloTrabajador::mdlMostrarTrabajador($tabla,$item,$valor);

		return $respuesta;

	}

	static public function ctrMostrarTrabajador2($valor){
		$respuesta = ModeloTrabajador::mdlMostrarTrabajador2($valor);

		return $respuesta;

	}

	static public function ctrMostrarTrabajador2Activo($valor){
		$respuesta = ModeloTrabajador::mdlMostrarTrabajador2Activo($valor);

		return $respuesta;

	}

	static public function ctrMostrarTrabajador2Inactivo($valor){
		$respuesta = ModeloTrabajador::mdlMostrarTrabajador2Inactivo($valor);

		return $respuesta;

	}


	/*=============================================
	CREAR TRABAJADOR
	=============================================*/
	static public function ctrCrearTrabajador(){

		if(isset($_POST["apellidoPaterno"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidoPaterno"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreTrabajador"])&&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidoMaterno"])&&
			   preg_match('/^[0-9]+$/', $_POST["nroDocumento"])
			   
			   ){
				$tabla="trabajadorjf";

			   	$datos = array("cod_tra"=>$_POST["codigoTrabajador"],
							   "cod_doc"=>$_POST["tipoDocumento"], 
							   "nro_doc_tra"=>$_POST["nroDocumento"],
							   "nom_tra"=>$_POST["nombreTrabajador"],
							   "ape_pat_tra"=>$_POST["apellidoPaterno"],
							   "ape_mat_tra"=>$_POST["apellidoMaterno"],
							   "cod_tip_tra"=>$_POST["tipoTrabajador"], 
							   "sueldo_total"=>$_POST["sueldoMes"],
								"sector"=>$_POST["nuevoSectorTrabajador"]);

			   	$respuesta = ModeloTrabajador::mdlIngresarTrabajador($tabla,$datos);
				//var_dump($datos);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El trabajador ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "trabajador";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El trabajador no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trabajador";

							}
						})

			  	</script>';



			}

		}


	}



	/*=============================================
	ELIMINAR TRABAJADOR
	=============================================*/

	static public function ctrEliminarTrabajador(){

		if(isset($_GET["idTrabajador"])){
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$tabla ="trabajadorjf";
			$datos = $_GET["idTrabajador"];
			$trabajador=ControladorTrabajador::ctrMostrarTrabajador("cod_tra",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un trabajador';
			$descripcion   = 'El usuario '.$usuario.' elimino el trabajador '.$trabajador["cod_tra"].' - '.$trabajador["nombre"];
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
			$respuesta = ModeloTrabajador::mdlEliminarTrabajador($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El trabajador ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "trabajador";

								}
							})

				</script>';

			}		

		}

	}    

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarTrabajador(){

		if(isset($_POST["editarNombreTrabajador"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreTrabajador"])&&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoPaterno"])&&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoMaterno"])
			){

				

				$datos = array("cod_tra"=>$_POST["editarCodigoTrabajador"],
							   "cod_doc"=>$_POST["editarTipoDocumento"],
							   "nro_doc_tra"=>$_POST["editarNroDocumento"],
							   "nom_tra"=>$_POST["editarNombreTrabajador"],
							   "ape_pat_tra"=>$_POST["editarApellidoPaterno"],
							   "ape_mat_tra"=>$_POST["editarApellidoMaterno"],
							   "cod_tip_tra"=>$_POST["editarTipoTrabajador"],
							   "sueldo_total"=>$_POST["editarSueldoMes"],
							   "sector"=>$_POST["editarSectorTrabajador"]
							);

				$tabla = "trabajadorjf";

				$respuesta = ModeloTrabajador::mdlEditarTrabajador($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El trabajador ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "trabajador";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El trabajador no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trabajador";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR TRABAJADORES
	=============================================*/

	static public function ctrMostrarTrabajadorActivo(){

		$respuesta = ModeloTrabajador::mdlMostrarTrabajadorActivo();

		return $respuesta;

	}

	/* 
	* Trabajador seleccionado
	*/
	static public function ctrMostrarTrabajadorConfigurado($usuario){

		$respuesta = ModeloTrabajador::mdlMostrarTrabajadorConfigurado($usuario);

		return $respuesta;

	}

	/* 
	* configurar trabajador para ingresos de taller
	*/
	static public function ctrConfigurarTrabajador(){

		if(isset($_POST["trabajadorSelect"])){

			$usuario = $_POST["usuario"];
			//var_dump($trabajador);

			$respuesta = ModeloTrabajador::mdlTrabajadorSet($usuario);
			//$respuesta = "false";
			
			if($respuesta == "ok"){

				$cod_tra = $_POST["trabajadorSelect"];
				ModeloTrabajador::ctrConfigurarTrabajador($cod_tra,$usuario);

				echo'<script>

					window.location = "marcar-taller";

				</script>';

			}



		}

	}
}