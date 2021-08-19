<?php

require_once "conexion.php";

class ModeloTipoTrabajador{
    /*=============================================
	MOSTRAR TIPO DE TRABAJADOR
	=============================================*/

	static public function mdlMostrarTipoTrabajador($tabla,$item,$valor){

		if($valor != null){

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
	CREAR TIPO DE TRABAJADOR
	=============================================*/

	static public function mdlIngresarTipoTrabajador($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nom_tip_trabajador,detalle) VALUES (:nom_tip_trabajador,:detalle)");

		$stmt->bindParam(":nom_tip_trabajador", $datos["nom_tip_trabajador"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}  

	/*=============================================
	EDITAR TIPO DE TRABAJADOR
	=============================================*/

	static public function mdlEditarTipoTrabajador($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nom_tip_trabajador = :nom_tip_trabajador , detalle = :detalle WHERE cod_tip_tra = :cod_tip_tra");

		
		$stmt->bindParam(":nom_tip_trabajador", $datos["nom_tip_trabajador"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_tip_tra", $datos["cod_tip_tra"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	/*=============================================
	ELIMINAR TIPO DE TRABAJADOR
	=============================================*/

	static public function mdlEliminarTipoTrabajador($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cod_tip_tra = :cod_tip_tra");

		$stmt -> bindParam(":cod_tip_tra", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    



	
	
    


}