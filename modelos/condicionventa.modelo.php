<?php

require_once "conexion.php";

class ModeloCondicionVentas{

	/*=============================================
	CREAR CONDICION DE VENTA
	=============================================*/

	static public function mdlIngresarCondicionVenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,descripcion,cta_cte,dias,letras,dscto) VALUES (:codigo,:descripcion,:cta_cte,:dias,:letras,:dscto)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":cta_cte", $datos["cta_cte"], PDO::PARAM_STR);
        $stmt->bindParam(":dias", $datos["dias"], PDO::PARAM_STR);
        $stmt->bindParam(":letras", $datos["letras"], PDO::PARAM_STR);
        $stmt->bindParam(":dscto", $datos["dscto"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR CONDICIONES DE VENTAS
	=============================================*/

	static public function mdlMostrarCondicionVentas($tabla,$item,$valor){

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
	EDITAR CONDICION DE VENTA
	=============================================*/

	static public function mdlEditarCondicionVenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, descripcion = :descripcion, cta_cte = :cta_cte, dias = :dias, letras = :letras, dscto = :dscto WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":cta_cte", $datos["cta_cte"], PDO::PARAM_STR);
        $stmt->bindParam(":dias", $datos["dias"], PDO::PARAM_STR);
        $stmt->bindParam(":letras", $datos["letras"], PDO::PARAM_STR);
        $stmt->bindParam(":dscto", $datos["dscto"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR CONDICION DE VENTA
	=============================================*/

	static public function mdlEliminarCondicionVenta($tabla,$datos){

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