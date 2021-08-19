<?php

class ControladorTipoDocumento{

    /*=============================================
	CREAR TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrCrearTipoDocumento(){

		if(isset($_POST["nuevoTipoDocumento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTipoDocumento"])){

                $tabla = "tipo_documentojf";

				$datos = $_POST["nuevoTipoDocumento"];

				$respuesta = ModeloTipoDocumento::mdlIngresarTipoDocumento($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de documento ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipodocumentos";

									}
								})

					</script>';

				}



			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El tipo de documento no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tipodocumentos";

							}
						})

			  	</script>';

			}

		}

    }
    /*=============================================
	MOSTRAR TIPO DOCUMENTO
	=============================================*/

	static public function ctrMostrarTipoDocumento($item, $valor){

		$tabla = "tipo_documentojf";

		$respuesta = ModeloTipoDocumento::mdlMostrarTipoDocumento($tabla, $item, $valor);

        return $respuesta;
        
	
	}    
	/*=============================================
	EDITAR TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrEditarTipoDocumento(){

		if(isset($_POST["editarTipoDocumento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTipoDocumento"])){

				$tabla = "tipo_documentojf";

				$datos = array("tipo_doc"=> $_POST["editarTipoDocumento"],
							   "cod_doc"=> $_POST["idTipoDocumento"]);

				$respuesta = ModeloTipoDocumento::mdlEditarTipoDocumento($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de documento ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipodocumentos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El tipo de documento no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tipodocumentos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrBorrarTipoDocumento(){

		if(isset($_GET["idTipoDocumento"])){
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$tabla ="tipo_documentojf";
			$datos = $_GET["idTipoDocumento"];
			$documento=ControladorTipoDocumento::ctrMostrarTipoDocumento("cod_doc",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un tipo de documento';
			$descripcion   = 'El usuario '.$usuario.' elimino el tipo de documento '.$documento["cod_doc"].' - '.$documento["tipo_doc"];
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
			$respuesta = ModeloTipoDocumento::mdlBorrarTipoDocumento($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de documento ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipodocumentos";

									}
								})

					</script>';
			}
		}
		
	}


}