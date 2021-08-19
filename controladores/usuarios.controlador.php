<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){


				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuariosjf";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];
						$_SESSION["correo"] = $respuesta["correo"];
						$_SESSION["datos"] = $respuesta["datos"];
						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Lima');
						
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if($ultimoLogin == "ok"){

							echo '<script>

								window.location = "inicio";

							</script>';

						}						
						
						echo '<script>
	
							window.location = "inicio";
	
						</script>';

					}else{

						echo '<br>
							<div class="alert alert-danger">SOLICITAR APOYO EN SISTEMAS ANEXO N° 116</div>';						

					}



				}else{

					echo '<br><div class="alert alert-danger">SOLICITAR APOYO EN SISTEMAS ANEXO N° 116</div>';

				}

			

		}

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){


			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuariosjf";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "perfil" => $_POST["nuevoPerfil"],
					           "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				$ultimoID=ModeloUsuarios::mdlMostrarUltimoID($tabla);
				$permisosCHK=$_POST["permiso"];
				
				
				for ($i=0; $i <count($permisosCHK) ; $i++) { 
					$tabla2="usuario_permisojf";
					$datos2=array("idusuario"=>$ultimoID["id"],
								   "idpermiso"=>$permisosCHK[$i]);
					$usuario_permiso=ModeloUsuarios::mdlIngresarPermiso($tabla2,$datos2);
				}
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';


				}	


		


		}


	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuariosjf";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR PERMISOS
	=============================================*/

	static public function ctrMostrarPermisos($item, $valor){

		$tabla = "permisojf";

		$respuesta = ModeloUsuarios::MdlMostrarPermisos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR PERMISOS
	=============================================*/

	static public function ctrMostrarUsuariosPermisos($item, $valor){

		$tabla = "usuario_permisojf";

		$respuesta = ModeloUsuarios::MdlMostrarUsuariosPermisos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){


				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuariosjf";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

						  	return;

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				$permisosCHK=$_POST["permisos"];
				$tabla2="usuario_permisojf";
				$datosBorrar = $_POST["idUsuario"];
				$borrado=ModeloUsuarios::mdlBorrarUsuarioPermiso($tabla2, $datosBorrar);
				
				for ($i=0; $i <count($permisosCHK) ; $i++) { 
					
					$datos2=array("idusuario"=>$_POST["idUsuario"],
								   "idpermiso"=>$permisosCHK[$i]);
					$usuario_permiso=ModeloUsuarios::mdlIngresarPermiso($tabla2,$datos2);
				}

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

				}


			

		}

	}


	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuariosjf";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}
	

	/*=============================================
	ACTUALIZAR CORREO DE  USUARIO
	=============================================*/

	static public function ctrActualizarCorreo(){

		if(isset($_POST["idUsuarioCorreo"]) ){

			$tabla ="usuariosjf";
			$item3 = "id";
			$valor3 = $_POST["idUsuarioCorreo"];
			$item2 = "correo";
			$item1 = "datos";
			if(empty($_POST["nuevoCorreo"])){
				$valor2="0";
			}else{
				$valor2=$_POST["nuevoCorreo"];
			}
			if(empty($_POST["nuevoDatos"])){
				$valor1="0";
			}else{
				$valor1=$_POST["nuevoDatos"];
			}
			var_dump($valor3);
			$respuesta = ModeloUsuarios::mdlActualizarCorreo($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido actualizado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}

	/*=============================================
	MOSTRAR CONEXIONES
	=============================================*/

	static public function ctrMostrarConexiones($item, $valor){

		$tabla = "conexionjf";

		$respuesta = ModeloUsuarios::MdlMostrarConexiones($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	CREAR CONEXIONES
	=============================================*/

	static public function ctrCrearConexion(){

		if(isset($_POST["nuevaIP"]) && isset($_POST["nuevaBD"]) && isset($_POST["nuevaUser"]) && isset($_POST["nuevaPwd"])  ){
			$tabla="conexionjf";
			$datos = array("ip"=>$_POST["nuevaIP"],
							"db"=>$_POST["nuevaBD"],
							"user"=>$_POST["nuevaUser"],
							"pwd"=>$_POST["nuevaPwd"]);

			$respuesta = ModeloUsuarios::mdlIngresarConexion($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "La conexión ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "conexionjf";

								}
							})

				</script>';

			}
		}

    }
	
	/*=============================================
	EDITAR CONEXIONES
	=============================================*/

	static public function ctrEditarConexion(){

		if(isset($_POST["idConexion"]) && isset($_POST["editarIP"]) && isset($_POST["editarBD"]) && isset($_POST["editarUser"]) && isset($_POST["editarPwd"])){
			$tabla="conexionjf";
			$datos = array("id"=>$_POST["idConexion"],
							"ip"=>$_POST["editarIP"],
							"db"=>$_POST["editarBD"],
							"user"=>$_POST["editarUser"],
							"pwd"=>$_POST["editarPwd"]);

			$respuesta = ModeloUsuarios::mdlEditarConexion($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "La conexión ha sido cambiado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "conexionjf";

								}
							})

				</script>';

			}

		}

	}
	
	
	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrEliminarConexion(){

		if(isset($_GET["idConexion"])){

			$tabla ="conexionjf";
			$datos = $_GET["idConexion"];

			$respuesta = ModeloUsuarios::mdlBorrarConexion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La conexión ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "conexionjf";

								}
							})

				</script>';

			}		

		}

	}
	
}
	