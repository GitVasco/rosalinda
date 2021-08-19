<?php

class ControladorSectores{

	/*=============================================
	CREAR SECTORES
	=============================================*/

	static public function ctrCrearSector(){

		if(isset($_POST["nuevoSector"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoSector"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigo"])){

			   	$datos = array("sector"=>$_POST["nuevoSector"],
					           "codigo"=>$_POST["nuevoCodigo"]);

			   	$respuesta = ModeloSectores::mdlIngresarSector($datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El sector ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sectores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El sector no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "sectores";

							}
						})

			  	</script>';



			}

		}

    }
    

	/*=============================================
	MOSTRAR SECTORES
	=============================================*/

	static public function ctrMostrarSectores($valor){

		$respuesta = ModeloSectores::mdlMostrarSectores($valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR SECTORES
	=============================================*/

	static public function ctrEditarSector(){

		if(isset($_POST["editarSector"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSector"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigo"])){

			   	$datos = array("id"=>$_POST["idSector"],
                               "sector"=>$_POST["editarSector"],
					           "codigo"=>$_POST["editarCodigo"]);

			   	$respuesta = ModeloSectores::mdlEditarSector($datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El sector ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sectores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El sector no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "sectores";

							}
						})

			  	</script>';



			}

		}

    }
    
	/*=============================================
	ELIMINAR SECTOR
	=============================================*/

	static public function ctrEliminarSector(){

		if(isset($_GET["idSector"])){
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$datos = $_GET["idSector"];
			$sector=ControladorSectores::ctrMostrarSectores($datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un sector';
			$descripcion   = 'El usuario '.$usuario.' elimino el sector '.$sector["cod_sector"].' - '.$sector["nom_sector"];
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
			$respuesta = ModeloSectores::mdlEliminarSector($datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El sector ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "sectores";

								}
							})

				</script>';

			}		

		}

	}    

}
