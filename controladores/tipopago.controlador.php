<?php

class ControladorTipoPagos{

	/*=============================================
	CREAR TIPO DE PAGO
	=============================================*/

	static public function ctrCrearTipoPago(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="maestrajf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
							   "descripcion"=>$_POST["nuevaDescripcion"],
							   "tipo_dato"=>'TCAN');

			   	$respuesta = ModeloTipoPagos::mdlIngresarTipoPago($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de pago ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipopagos";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR TIPO DE PAGO
	=============================================*/

	static public function ctrMostrarTipoPagos($item,$valor){
		$tabla="maestrajf";
		$respuesta = ModeloTipoPagos::mdlMostrarTipoPagos($tabla,$item,$valor);

		return $respuesta;

	}
	
	/*=============================================
	MOSTRAR varios DE PAGO
	=============================================*/

	static public function ctrMostrarVariosPagos($item,$valor){
		$tabla="maestrajf";
		$respuesta = ModeloTipoPagos::mdlMostrarVariosPagos($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR TIPO DE PAGO
	=============================================*/

	static public function ctrEditarTipoPago(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="maestrajf";
				   $datos = array("id"=>$_POST["idTipoPago"],
				   				"codigo"=> $_POST["editarCodigo"],
                               "descripcion"=>$_POST["editarDescripcion"]);

			   	$respuesta = ModeloTipoPagos::mdlEditarTipoPago($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de pago ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipopagos";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function ctrEliminarTipoPago(){

		if(isset($_GET["idTipoPago"])){

			$datos = $_GET["idTipoPago"];
			$tabla="maestrajf";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$tipopagos=ControladorTipoPagos::ctrMostrarTipoPagos("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un tipo de pago';
			$descripcion   = 'El usuario '.$usuario.' elimino el tipo de pago '.$tipopagos["codigo"].' - '.$tipopagos["descripcion"];
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
			
			$respuesta = ModeloTipoPagos::mdlEliminarTipoPago($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El tipo de pago ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "tipopagos";

								}
							})

				</script>';

			}		

		}

	}    

}
