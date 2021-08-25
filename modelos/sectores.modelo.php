<?php

require_once "conexion.php";

class ModeloSectores{

	/*=============================================
	CREAR SECTOR
	=============================================*/

	static public function mdlIngresarSector($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO sectorjf (cod_sector, nom_sector) 
        VALUES
          (:codigo, :nombre) ;");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["sector"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR SECTORES
	=============================================*/

	static public function mdlMostrarSectores($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                            *,
															CONCAT(cod_sector, ' - ', nom_sector) AS sector  
                                                        FROM
                                                            sectorjf c
                                                        WHERE c.cod_sector = :valor");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("  SELECT 
                                                            * 
                                                        FROM
                                                            sectorjf ORDER BY cod_sector");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR SECTOR
	=============================================*/

	static public function mdlEditarSector($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                        sectorjf 
                                                    SET
                                                        cod_sector = :codigo,
                                                        nom_sector = :sector 
                                                    WHERE id = :valor");

		$stmt->bindParam(":valor", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":sector", $datos["sector"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR SECTOR
	=============================================*/

	static public function mdlEliminarSector($datos){

		$stmt = Conexion::conectar()->prepare("  DELETE 
                                                        FROM
                                                        sectorjf 
                                                        WHERE cod_sector = :valor");

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