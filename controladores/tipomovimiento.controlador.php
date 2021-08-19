<?php

class ControladorTipoMovimientos{

	/*=============================================
	CREAR TIPO DE MOVIMIENTO
	=============================================*/

	static public function ctrCrearTipoMovimiento(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="tipo_movimientosjf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
							   "descripcion"=>$_POST["nuevaDescripcion"]);

			   	$respuesta = ModeloTipoMovimientos::mdlIngresarTipoMovimiento($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de movimiento ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipomovimientos";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR TIPO DE MOVIMIENTOS
	=============================================*/

	static public function ctrMostrarTipoMovimientos($item,$valor){
		$tabla="tipo_movimientosjf";
		$respuesta = ModeloTipoMovimientos::mdlMostrarTipoMovimientos($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR TIPO DE MOVIMIENTO
	=============================================*/

	static public function ctrEditarTipoMovimiento(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="tipo_movimientosjf";
				   $datos = array("id"=>$_POST["idTipoMovimiento"],
								"codigo"=> $_POST["editarCodigo"],
                               "descripcion"=>$_POST["editarDescripcion"]);

			   	$respuesta = ModeloTipoMovimientos::mdlEditarTipoMovimiento($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de movimiento ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipomovimientos";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR TIPO DE MOVIMIENTO
	=============================================*/

	static public function ctrEliminarTipoMovimiento(){

		if(isset($_GET["idTipoMovimiento"])){

			$datos = $_GET["idTipoMovimiento"];
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$tipomovimientos=ControladorTipoMovimientos::ctrMostrarTipoMovimientos("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un tipo de movimiento';
			$descripcion   = 'El usuario '.$usuario.' elimino el tipo de movimiento '.$tipomovimientos["codigo"].' - '.$tipomovimientos["descripcion"];
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
			$tabla="tipo_movimientosjf";
			$respuesta = ModeloTipoMovimientos::mdlEliminarTipoMovimiento($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El tipo de movimiento ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "tipomovimientos";

								}
							})

				</script>';

			}		

		}

	}    

}
