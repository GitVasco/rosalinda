<?php

require_once "conexion.php";

class ModeloTipoDocumento{

    /*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarTipoDocumento($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
    /*=============================================
	CREAR TIPO DE DOCUMENTO
	=============================================*/

	static public function mdlIngresarTipoDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_doc) VALUES (:tipo_doc)");

		$stmt->bindParam(":tipo_doc", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarTipoDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_doc = :tipo_doc WHERE cod_doc = :cod_doc");

		$stmt -> bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
		$stmt -> bindParam(":cod_doc", $datos["cod_doc"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarTipoDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cod_doc = :cod_doc");

		$stmt -> bindParam(":cod_doc", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	

}
