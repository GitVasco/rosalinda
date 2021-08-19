<?php

require_once "conexion.php";

class ModeloMarcas{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarMarca($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1023_insert_marcas_p(:valor)");

		$stmt->bindParam(":valor", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
    
	/*=============================================
	MOSTRAR Marcas
	=============================================*/

	static public function mdlMostrarMarcas($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("CALL sp_1024_consulta_marcas_p($valor)");

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL sp_1025_consulta_marcas()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	EDITAR MARCA
	=============================================*/

	static public function mdlEditarMarca($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1026_update_marcas_p(:marca, :valor)");

		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":valor", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }    
    
	/*=============================================
	BORRAR MARCA
	=============================================*/

	static public function mdlBorrarMarca($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1027_delete_marcas_p(:valor)");

		$stmt -> bindParam(":valor", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

		/* 
	* Método para activar y desactivar una MArca
	*/
	static public function mdlActualizarMarca($tabla,$valor1,$valor2){

		$sql = "UPDATE $tabla SET venta = :venta WHERE id=:valor";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":venta", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":valor", $valor2, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}
	


}