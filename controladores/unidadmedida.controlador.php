<?php

class ControladorUnidadMedidas{

	/*=============================================
	CREAR AGENCIA
	=============================================*/

	static public function ctrCrearUnidadMedida(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="unidades_medidajf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
							   "descripcion"=>$_POST["nuevaDescripcion"]);

			   	$respuesta = ModeloUnidadMedidas::mdlIngresarUnidadMedida($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La unidad de medida ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidadesmedida";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR UNIDADES DE MEDIDA
	=============================================*/

	static public function ctrMostrarUnidadMedidas($item,$valor){
		$tabla="unidades_medidajf";
		$respuesta = ModeloUnidadMedidas::mdlMostrarUnidadMedidas($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR UNIDAD DE MEDIDA
	=============================================*/

	static public function ctrEditarUnidadMedida(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="unidades_medidajf";
				   $datos = array("id"=>$_POST["idUnidadMedida"],
				   				"codigo"=> $_POST["editarCodigo"],
                               "descripcion"=>$_POST["editarDescripcion"]);

			   	$respuesta = ModeloUnidadMedidas::mdlEditarUnidadMedida($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La unidad de medida ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidadesmedida";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR AGENCIA
	=============================================*/

	static public function ctrEliminarUnidadMedida(){

		if(isset($_GET["idUnidadMedida"])){

			$datos = $_GET["idUnidadMedida"];
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$unidad=ControladorUnidadMedidas::ctrMostrarUnidadMedidas("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino una unidad de medida';
			$descripcion   = 'El usuario '.$usuario.' elimino la unidad de medida '.$unidad["codigo"].' - '.$unidad["descripcion"];
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
			$tabla="unidades_medidajf";
			$respuesta = ModeloUnidadMedidas::mdlEliminarUnidadMedida($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La unidad de medida ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "unidadesmedida";

								}
							})

				</script>';

			}		

		}

	}    

}
