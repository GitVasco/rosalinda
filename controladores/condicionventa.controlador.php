<?php

class ControladorCondicionVentas{

	/*=============================================
	CREAR AGENCIA
	=============================================*/

	static public function ctrCrearCondicionVenta(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="condiciones_ventajf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
							   "descripcion"=>$_POST["nuevaDescripcion"],
							   "cta_cte"=>$_POST["nuevaCtaCte"],
							   "dias"=>$_POST["nuevoDia"],
							   "letras"=>$_POST["nuevaLetra"],
							   "dscto"=>$_POST["nuevoDscto"]);

			   	$respuesta = ModeloCondicionVentas::mdlIngresarCondicionVenta($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La condicion de venta ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "condicionesventa";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR CONDICIONES DE VENTA
	=============================================*/

	static public function ctrMostrarCondicionVentas($item,$valor){
		$tabla="condiciones_ventajf";
		$respuesta = ModeloCondicionVentas::mdlMostrarCondicionVentas($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR CONDICION DE VENTA
	=============================================*/

	static public function ctrEditarCondicionVenta(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="condiciones_ventajf";
				   $datos = array("id"=>$_POST["idCondicionVenta"],
				   				  "codigo"=> $_POST["editarCodigo"],
                               	  "descripcion"=>$_POST["editarDescripcion"],
								  "cta_cte"=>$_POST["editarCtaCte"],
								  "dias"=>$_POST["editarDia"],
								  "letras"=>$_POST["editarLetra"],
								  "dscto"=>$_POST["editarDscto"]);

			   	$respuesta = ModeloCondicionVentas::mdlEditarCondicionVenta($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La condicion de venta ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "condicionesventa";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR CONDICION VENTA
	=============================================*/

	static public function ctrEliminarCondicionVenta(){

		if(isset($_GET["idCondicionVenta"])){

			$datos = $_GET["idCondicionVenta"];
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$condicion=ControladorCondicionVentas::ctrMostrarCondicionVentas("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino una condicion de venta';
			$descripcion   = 'El usuario '.$usuario.' elimino la condicino de venta '.$condicion["codigo"].' - '.$condicion["descripcion"];
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
			$tabla="condiciones_ventajf";
			$respuesta = ModeloCondicionVentas::mdlEliminarCondicionVenta($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La condicion de venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "condicionesventa";

								}
							})

				</script>';

			}		

		}

	}    

}
