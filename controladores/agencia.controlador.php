<?php

class ControladorAgencias{

	/*=============================================
	CREAR AGENCIA
	=============================================*/

	static public function ctrCrearAgencia(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="agenciasjf";
				   $datos = array("codigo"=>$_POST["nuevoCodAgencia"],
							   	  "nombre"=>$_POST["nuevaDescripcion"],
							      "direccion"=>$_POST["nuevaDireccion"],
								  "ubigeo"=>$_POST["nuevoUbigeo"],
								  "ruc"=>$_POST["nuevoRUC"],
								  "telefono"=>$_POST["nuevoTelefono"]);

			   	$respuesta = ModeloAgencias::mdlIngresarAgencia($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La agencia ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "agencias";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR AGENCIAS
	=============================================*/

	static public function ctrMostrarAgencias($item,$valor){
		$tabla="agenciasjf";
		$respuesta = ModeloAgencias::mdlMostrarAgencias($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR AGENCIA
	=============================================*/

	static public function ctrEditarAgencia(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="agenciasjf";
			   	$datos = array("id"=>$_POST["idAgencia"],
							   "codigo"=>$_POST["editarCodAgencia"],		   
							   "nombre"=>$_POST["editarDescripcion"],
							   "ruc"=>$_POST["editarRUC"],
							   "direccion"=>$_POST["editarDireccion"],
							   "ubigeo"=>$_POST["editarUbigeo"],
							   "telefono"=>$_POST["editarTelefono"]);

			   	$respuesta = ModeloAgencias::mdlEditarAgencia($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La agencia ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "agencias";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR AGENCIA
	=============================================*/

	static public function ctrEliminarAgencia(){

		if(isset($_GET["idAgencia"])){

			$datos = $_GET["idAgencia"];
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$agencia=ControladorAgencias::ctrMostrarAgencias($datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino una agencia';
			$descripcion   = 'El usuario '.$usuario.' elimino la agencia '.$agencia["codigo"].' - '.$agencia["nombre"];
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
			$tabla="agenciasjf";
			$respuesta = ModeloAgencias::mdlEliminarAgencia($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La agencia ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "agencias";

								}
							})

				</script>';

			}		

		}

	}    

}
