<?php
   
   require_once "conexion.php";

class ModeloIngresos{

	static public function mdlMostarIngresos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre,s.nom_sector FROM $tabla mc LEFT JOIN usuariosjf u 
			ON mc.usuario = u.id LEFT JOIN sectorjf s ON mc.taller = s.cod_sector WHERE mc.$item = :$item ORDER BY mc.id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
															mc.*,u.nombre
														FROM
															movimientos_cabecerajf mc 
															LEFT JOIN usuariosjf u 
																ON mc.usuario = u.id");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;		


	}

	static public function mdlMostarDetallesIngresos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;		


	}
 
	/* 
	* Guardar cabecera de ORDENES DE CORTE
	*/
	static public function mdlGuardarIngreso($tabla,$datos){

		$sql="INSERT INTO $tabla (			tipo,
											guia,
											usuario,
											taller,
											documento,
											total,
											fecha,
											almacen
										) 
										VALUES
											(:tipo,
											:guia,
											:usuario,
											:taller,
											:documento,
											:total,
											:fecha,
											:almacen
											)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
        $stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	static public function mdlGuardarSegunda($tabla,$datos){

		$sql="INSERT INTO $tabla (			tipo,
											guia,
											usuario,
											taller,
											documento,
											total,
											fecha,
											almacen,
											trabajador
										) 
										VALUES
											(:tipo,
											:guia,
											:usuario,
											:taller,
											:documento,
											:total,
											:fecha,
											:almacen,
											:trabajador
											)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
        $stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);
		$stmt->bindParam(":trabajador",$datos["trabajador"],PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}

	/* 
	* Guardar cabecera de ORDENES DE CORTE
	*/
	static public function mdlGuardarDetalleIngreso($tabla,$datos){

		$sql="INSERT INTO $tabla (
											tipo,
											documento,
											taller,
											fecha,
											articulo,
											cantidad,
											almacen,
											idcierre
										) 
										VALUES
											(
											:tipo,
											:documento,
											:taller,
											:fecha,
											:articulo,
											:cantidad,
											:almacen,
											:idcierre
											)";

		$stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);
		$stmt->bindParam(":idcierre",$datos["idcierre"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	
	static public function mdlGuardarDetalleSegunda($tabla,$datos){

		$sql="INSERT INTO $tabla (
											tipo,
											documento,
											taller,
											fecha,
											articulo,
											cliente,
											cantidad,
											almacen,
											idcierre
										) 
										VALUES
											(
											:tipo,
											:documento,
											:taller,
											:fecha,
											:articulo,
											:cliente,
											:cantidad,
											:almacen,
											:idcierre
											)";

		$stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":cliente",$datos["cliente"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);
		$stmt->bindParam(":idcierre",$datos["idcierre"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	
	/* 
	* Método para editar las ventas
	*/
	static public function mdlEditarIngreso($tabla,$datos){

		$sql="UPDATE $tabla SET guia=:guia, usuario=:usuario, taller=:taller, documento=:documento, total=:total, fecha=:fecha WHERE id=:id";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
        $stmt->bindParam(":id",$datos["id"],PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
		
	}

	static public function mdlEditarSegunda($tabla,$datos){

		$sql="UPDATE $tabla SET guia = :guia, usuario=:usuario, taller=:taller, documento=:documento, total=:total, fecha=:fecha,trabajador=:trabajador WHERE id=:id";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":trabajador",$datos["trabajador"],PDO::PARAM_INT);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
        $stmt->bindParam(":id",$datos["id"],PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
		
	}
/* 
	* Método para eliminar los detalles de los ingresos
	*/
	static public function mdlEliminarDato($tabla,$item,$valor){

		$sql="DELETE FROM $tabla WHERE $item=:$item";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;
	}

	/* 
	* Método para eliminar la orden de corte
	*/
	static public function mdlEliminarIngreso($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = $valor");

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	


/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasIngresos($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre,s.nom_sector FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id LEFT JOIN sectorjf s ON mc.taller = s.cod_sector where YEAR(m.fecha)=YEAR(NOW()) ORDER BY mc.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre,s.nom_sector FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id LEFT JOIN sectorjf s ON mc.taller = s.cod_sector WHERE mc.fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre,s.nom_sector FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id LEFT JOIN sectorjf s ON mc.taller = s.cod_sector WHERE mc.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre,s.nom_sector FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id LEFT JOIN sectorjf s ON mc.taller = s.cod_sector WHERE mc.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function mdlUltimoIngreso($tabla){

		$sql="SELECT COUNT(taller) + 1 AS ultimo_codigo FROM $tabla";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;


	}


	//VISUALIZAR DETALLE CIERRE
	static public function mdlVisualizarIngresoDetalle($valor){

		if($valor!=null){
			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.documento,
			IFNULL(s.guia,'') AS guia,
			DATE(s.fecha) AS fechas,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t1,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t2,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t3,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t4,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t5,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t6,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t7,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			),0) AS t8,
			FORMAT(SUM(sd.cantidad),0) AS total 
		  FROM
			movimientosjf_2021 sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN movimientos_cabecerajf s 
			  ON sd.documento = s.documento 
			LEFT JOIN sectorjf se 
			  ON s.taller = se.cod_sector 
			WHERE sd.documento = :valor 
			GROUP BY sd.documento,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color ");
	
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();
	
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.documento,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t8,
			SUM(sd.cantidad) AS total 
		  FROM
			movimientosjf_2021 sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN movimientos_cabecerajf s 
			  ON sd.documento = s.documento 
			LEFT JOIN sectorjf se 
			  ON s.taller = se.cod_sector 
		  GROUP BY sd.documento,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color ");
	
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();
	
		}
	
			
			$stmt=null;
	
	}


}