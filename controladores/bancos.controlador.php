<?php

class ControladorBancos{

	/*=============================================
	CREAR TIPO DE PAGO
	=============================================*/

	static public function ctrCrearBanco(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="maestrajf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
							   "descripcion"=>$_POST["nuevaDescripcion"],
							   "tipo_dato"=>"TBAN",);

			   	$respuesta = ModeloBancos::mdlIngresarBanco($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El banco ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "bancos";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR BANCO
	=============================================*/

	static public function ctrMostrarBancos($item,$valor){
		$tabla="maestrajf";
		$respuesta = ModeloBancos::mdlMostrarBancos($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR TIPO DE PAGO
	=============================================*/

	static public function ctrEditarBanco(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="maestrajf";
				   $datos = array("id"=>$_POST["idBanco"],
				   				"codigo"=> $_POST["editarCodigo"],
                               "descripcion"=>$_POST["editarDescripcion"]);

			   	$respuesta = ModeloBancos::mdlEditarBanco($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El banco ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "bancos";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function ctrEliminarBanco(){

		if(isset($_GET["idBanco"])){

			$datos = $_GET["idBanco"];
			$tabla="maestrajf";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$bancos=ControladorBancos::ctrMostrarBancos("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un banco';
			$descripcion   = 'El usuario '.$usuario.' elimino el banco '.$bancos["codigo"].' - '.$bancos["descripcion"];
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
			
			$respuesta = ModeloBancos::mdlEliminarBanco($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El banco ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "bancos";

								}
							})

				</script>';

			}		

		}

	}    

}
