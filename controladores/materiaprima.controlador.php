<?php

class ControladorMateriaPrima{

	/* 
	* MOSTRAR DATOS DE LA MATERIA PRIMA
	*/
	static public function ctrMostrarMateriaPrima($valor){

		$respuesta = ModeloMateriaPrima::mdlMostrarMateriaPrima($valor);

		return $respuesta;

    }

	/* 
	*EDITAR NOMBRE DE MATERIA PRIMA
	*/
	static public function ctrEditarMateriaPrima(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])){

				$datos = array("descripcion" => $_POST["editarDescripcion"],
							"codpro" => $_POST["editarCodigo"]);

				$respuesta = ModeloMateriaPrima::mdlEditarMateriaPrima($datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							type: "success",
							title: "La materia prima ha sido editada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "materiaprima";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						type: "error",
						title: "¡La Materia Prima no puede ir con los campos vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "materiaprima";

							}
						})

				</script>';
			}
		}

	}
	
	/* 
	* VISUALIZAR DATOS DE LA MATERIA PRIMA DETALLE
	*/
	static public function ctrVisualizarMateriaPrimaDetalle($valor){

		$respuesta = ModeloMateriaPrima::mdlVisualizarMateriaPrimaDetalle($valor);

		return $respuesta;

	}
	
	/* 
	*EDITAR COSTO DE MATERIA PRIMA
	*/
	static public function ctrEditarMateriaPrimaCosto(){

		if(isset($_POST["codigo"])){


			$tabla = "producto";

			$datos = array("codpro" => $_POST["codigo"],
						"cospro" => $_POST["costo"]);

			$respuesta = ModeloMateriaPrima::mdlEditarMateriaPrimaCosto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						type: "success",
						title: "La materia prima ha sido editada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
									if (result.value) {

									window.location = "materiaprima";

									}
								})

					</script>';

			}else{

				echo'<script>

				swal({
					type: "danger",
					title: "La materia prima no ha sido editada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "materiaprima";

								}
							})

				</script>';


			}

		}

	}
	
	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA
	*/	
	static public function ctrMostrarUrgenciaAMP($valor){

		$respuesta = ModeloMateriaPrima::mdlMostrarUrgenciaAMP($valor);

		return $respuesta;
		
	}	
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/	
	static public function ctrVisualizarUrgenciasAMPDetalleOC($valor){

		$respuesta = ModeloMateriaPrima::mdlVisualizarUrgenciasAMPDetalleOC($valor);

		return $respuesta;
		
	}	
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/	
	static public function ctrVisualizarUrgenciasAMPDetalleART($valor){
		
		$respuesta = ModeloMateriaPrima::mdlVisualizarUrgenciasAMPDetalleART($valor);

		return $respuesta;
		
	}	

    /* 
    * MOSTRAR LAS SALIDAS POR MATERIA PRIMA
    */
    static public function ctrProyMp($mp){

        $respuesta = ModeloMateriaPrima::mdlProyMp($mp);

        return $respuesta;

	}  
	
}