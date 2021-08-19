<?php

require_once "conexion.php";

class ModeloAbonos{

	/*=============================================
	CREAR ABONO
	=============================================*/

	static public function mdlIngresarAbono($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha,descripcion,monto,agencia,num_ope) VALUES (:fecha,:descripcion,:monto,:agencia,:num_ope)");

		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_INT);
        $stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
        $stmt->bindParam(":num_ope", $datos["num_ope"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR ABONOS
	=============================================*/

	static public function mdlMostrarAbonos($tabla,$item,$valor){

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
	EDITAR ABONO
	=============================================*/

	static public function mdlEditarAbono($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = :fecha, descripcion = :descripcion, monto = :monto, agencia = :agencia,num_ope = :num_ope WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_INT);
        $stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
        $stmt->bindParam(":num_ope", $datos["num_ope"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function mdlEliminarAbono($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

}