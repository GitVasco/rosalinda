<?php

require_once "conexion.php";

class ModeloColores{

	/*=============================================
	CREAR COLOR
	=============================================*/

	static public function mdlIngresarColor($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1018_insert_colores_p(:codigo, :color)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR COLORES
	=============================================*/

	static public function mdlMostrarColores($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("CALL sp_1019_consulta_colores_p(:valor)");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL sp_1020_consulta_colores()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR COLOR
	=============================================*/

	static public function mdlEditarColor($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1021_update_colores_p(:codigo, :color, :valor)");

		$stmt->bindParam(":valor", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR COLOR
	=============================================*/

	static public function mdlEliminarColor($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1022_delete_colores_p(:valor)");

		$stmt -> bindParam(":valor", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

}