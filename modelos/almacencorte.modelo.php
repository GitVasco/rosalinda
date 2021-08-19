<?php
require_once "conexion.php";

class ModeloAlmacenCorte{

  	/*
	* Método para sacar el ultimo codigo del almacen de corte
	*/
	static public function mdlUltimoCodigoAC(){

        $stmt = Conexion::conectar()->prepare("CALL sp_1054_almcorte_ultcod()");

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;


	}

	static public function mdlMostarArticulosOrdCorte(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1055_articulos_ordcorte()");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	/*
	* Método para actualizar el total del corte por articulo
	*/
	static public function mdlActualizarAlmCorte($valor, $valor1){

		$stmt = Conexion::conectar()->prepare("CALL sp_1056_update_articulos_almcorte_p(:valor, :valor1)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Método para actualizar los saldos de detalle de ordenes de corte
	*/
	static public function mdlActualizarSaldoOrdCorte($valor, $valor1, $valor2){

		$stmt = Conexion::conectar()->prepare("CALL sp_1057_update_ordencorte_saldo_p(:valor, :valor1, :valor2)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":valor2", $valor2, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Método para actualizar los saldos de ordenes de corte
	*/
	static public function mdlActualizarSaldoOrdCorteGral(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1058_update_ordencorte_saldo()");

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Guardar cabecera de Almacen DE CORTE
	*/
	static public function mdlGuardarAlmacenCorte($datos){

		$sql="CALL sp_1059_insert_almcorte_p(:codigo, :guia, :usuario, :total, :estado)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}

	/*
	* Guardar detalle de almacen de corte
	*/
	static public function mdlGuardarDetallesAlmacenCorte($datos){

		$sql="CALL sp_1060_insert_almcorte_detalle_p(:almcorte, :ordcorte, :detordcorte, :art, :cant)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":almcorte",$datos["almacencorte"],PDO::PARAM_INT);
		$stmt->bindParam(":ordcorte",$datos["ordcorte"],PDO::PARAM_INT);
		$stmt->bindParam(":detordcorte",$datos["idocd"],PDO::PARAM_INT);
		$stmt->bindParam(":art",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":cant",$datos["cantidad"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;

	}

	/*
	* Guardar detalle de almacen de corte
	*/
	static public function mdlGuardarDetallesAlmacenCorteMP($id){

		$sql="INSERT INTO almacencorte_detalle_mpjf (almacencorte, mat_pri, cons_total) 
		(SELECT 
		  ac.almacencorte,
		  dt.mat_pri,
		  SUM(ac.cantidad * dt.consumo) 
		FROM
		  almacencorte_detallejf ac 
		  LEFT JOIN detalles_tarjetajf dt 
			ON ac.articulo = dt.articulo 
		WHERE ac.almacencorte = :id 
		  AND dt.tej_princ = 'si' 
		GROUP BY dt.mat_pri)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":id",$id,PDO::PARAM_INT);

		$stmt->execute();

		$stmt=null;

	}	

	/*
	* Método para DESCONTAR el total del corte por articulo -ORD CORTE
	*/
	static public function mdlActualizarOrdCorte($valor, $valor1){

		$stmt = Conexion::conectar()->prepare("CALL sp_1061_update_articulos_ordcorte_p(:valor, :valor1)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Método para mostrar los datos de almacen de corte
	*/
	static public function mdlMostrarAlmacenCorte($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("CALL sp_1066_consulta_almacencorte_p(:valor)");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL sp_1062_consulta_almacencorte()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*
	* Método para actualizar lel estado de ordenes de corte a parcial
	*/
	static public function mdlActualizarOrdCorteEstadoParcial(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1063_update_ordencorte_parcial()");

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Método para actualizar lel estado de ordenes de corte a cerrado
	*/
	static public function mdlActualizarOrdCorteEstadoCerrado(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1064_update_ordencorte_cerrado()");

		$stmt->execute();

		$stmt = null;

	}

	/* 
	* Método para vizualizar detalle de la orden de corte
	*/
	static public function mdlVisualizarAlmacenCorteDetalle($valor){

		if($valor != null){
			$stmt = Conexion::conectar()->prepare("CALL sp_1067_consulta_almacencorte_detalle_p(:valor)");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("CALL sp_1071_consulta_almacencorte_detalle()");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();

		}

		

		$stmt=null;

	}
	
	/* 
	* Método para activar y desactivar un usuario
	*/
	static public function mdlEstadoCorte($valor, $valor1){

		$stmt = Conexion::conectar()->prepare("CALL sp_1068_update_alm_estado_p(:valor, :estado)");

		$stmt -> bindParam(":estado", $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		} else {

			return "error";
		}

		$stmt = null;
	}	


	/*
	* Método para ingresar la cantidad de cortes por operacion
	*/
	static public function mdlIngresarCantCorte($valor, $valor1){

		$stmt = Conexion::conectar()->prepare("UPDATE encortejf
													SET
														cantidad = cantidad + :valor1,
														total_precio = (precio_doc / 12) * cantidad,
														total_tiempo = (tiempo_stand / 60) * cantidad
													WHERE
														articulo = :valor");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}

/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasAlmacenCortes($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT  
			ac.id,
			ac.codigo,
			ac.guia,
			ac.usuario,
			u.nombre,
			ac.total,
			DATE(ac.fecha) AS fecha,
			CASE
			  WHEN ac.estado = 1 
			  THEN 'Procesado' 
			  ELSE 'Sistemas' 
			END AS estado 
		  FROM
			almacencortejf ac 
			LEFT JOIN usuariosjf u 
			  ON ac.usuario = u.id  ORDER BY ac.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT 
			ac.id,
			ac.codigo,
			ac.guia,
			ac.usuario,
			u.nombre,
			ac.total,
			DATE(ac.fecha) AS fecha,
			CASE
			  WHEN ac.estado = 1 
			  THEN 'Procesado' 
			  ELSE 'Sistemas' 
			END AS estado 
		  FROM
			almacencortejf ac 
			LEFT JOIN usuariosjf u 
			  ON ac.usuario = u.id   WHERE ac.fecha like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT 
				ac.id,
				ac.codigo,
				ac.guia,
				ac.usuario,
				u.nombre,
				ac.total,
				DATE(ac.fecha) AS fecha,
				CASE
				  WHEN ac.estado = 1 
				  THEN 'Procesado' 
				  ELSE 'Sistemas' 
				END AS estado 
			  FROM
				almacencortejf ac 
				LEFT JOIN usuariosjf u 
				  ON ac.usuario = u.id  WHERE ac.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT 
				ac.id,
				ac.codigo,
				ac.guia,
				ac.usuario,
				u.nombre,
				ac.total,
				DATE(ac.fecha) AS fecha,
				CASE
				  WHEN ac.estado = 1 
				  THEN 'Procesado' 
				  ELSE 'Sistemas' 
				END AS estado 
			  FROM
				almacencortejf ac 
				LEFT JOIN usuariosjf u 
				  ON ac.usuario = u.id  WHERE ac.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}	

		/*
	* Método para mostrar las telas de almacen de corte
	*/
	static public function mdlMostrarTelasAlmacenCorte($valor){

		$stmt = Conexion::conectar()->prepare("SELECT 
		adm.id,
		adm.almacencorte,
		adm.mat_pri,
		mp.descripcion,
		adm.cons_total,
		adm.diferencia,
  		adm.cons_real,
		adm.can_entregada,
		adm.merma,
		adm.mp_sinuso,
		adm.notificacion  
	  FROM
		almacencorte_detalle_mpjf adm 
		LEFT JOIN 
		  (SELECT DISTINCT 
			p.codpro,
			CONCAT(p.DesPro, ' - ', tb.Des_Larga) AS descripcion 
		  FROM
			producto AS p,
			Tabla_M_Detalle AS tb 
		  WHERE tb.Cod_Tabla IN ('TCOL') 
			AND tb.Cod_Argumento = p.ColPro 
			AND p.estpro = '1' 
		  ORDER BY SUBSTRING(CodFab, 1, 6) ASC) AS mp 
		  ON adm.mat_pri = mp.codpro 
	  WHERE adm.almacencorte = :codigo");

		$stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	// Método para ingresar la telas de corte
	
	static public function mdlIngresarTelaCorte($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE almacencorte_detalle_mpjf
													SET
														cons_real= :cantidad,
														diferencia= :diferencia,
														can_entregada = :entrega,
														merma = :merma,
														mp_sinuso = :mp_sinuso
													WHERE
														almacencorte = :codigo AND mat_pri= :materia");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":diferencia", $datos["diferencia"], PDO::PARAM_INT);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_INT);
		$stmt->bindParam(":merma", $datos["merma"], PDO::PARAM_INT);
		$stmt->bindParam(":mp_sinuso", $datos["mp_sinuso"], PDO::PARAM_INT);
		$stmt->bindParam(":materia", $datos["materia"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();

		$stmt = null;

	}

	// Método para ingresar la notificaciones de telas
	
	static public function mdlIngresarNotificacionCorte($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE almacencorte_detalle_mpjf
													SET
														notificacion= :notificacion
													WHERE
														almacencorte = :codigo AND mat_pri= :materia");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":notificacion", $datos["notificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":materia", $datos["materia"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();

		$stmt = null;

	}

	static public function mdlRangoFechasVerCortes($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT 
			dac.almacencorte,
			DATE(da.fecha) as fechas,
			a.modelo,
			a.nombre,
			a.color,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t8,
			SUM(dac.cantidad) AS subtotal 
		  FROM
			almacencorte_detallejf dac 
			LEFT JOIN articulojf a 
			  ON dac.articulo = a.articulo
			LEFT JOIN almacencortejf da
 			  ON dac.almacencorte=da.codigo
		  GROUP BY dac.almacencorte,
			a.modelo,
			a.nombre,
			a.color  ORDER BY dac.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT 
			dac.almacencorte,
			DATE(da.fecha) as fechas,
			a.modelo,
			a.nombre,
			a.color,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN dac.cantidad 
				ELSE 0 
			  END
			) AS t8,
			SUM(dac.cantidad) AS subtotal 
		  FROM
			almacencorte_detallejf dac 
			LEFT JOIN articulojf a 
			  ON dac.articulo = a.articulo 
			LEFT JOIN almacencortejf da
 			  ON dac.almacencorte=da.codigo
			WHERE DATE(da.fecha) like '%$fechaFinal%'
		  GROUP BY dac.almacencorte,
			a.modelo,
			a.nombre,
			a.color  ");

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

				$stmt = Conexion::conectar()->prepare("SELECT 
				dac.almacencorte,
				DATE(da.fecha) as fechas,
				a.modelo,
				a.nombre,
				a.color,
				SUM(
				  CASE
					WHEN a.cod_talla = '1' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t1,
				SUM(
				  CASE
					WHEN a.cod_talla = '2' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t2,
				SUM(
				  CASE
					WHEN a.cod_talla = '3' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t3,
				SUM(
				  CASE
					WHEN a.cod_talla = '4' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t4,
				SUM(
				  CASE
					WHEN a.cod_talla = '5' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t5,
				SUM(
				  CASE
					WHEN a.cod_talla = '6' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t6,
				SUM(
				  CASE
					WHEN a.cod_talla = '7' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t7,
				SUM(
				  CASE
					WHEN a.cod_talla = '8' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t8,
				SUM(dac.cantidad) AS subtotal 
			  FROM
				almacencorte_detallejf dac 
				LEFT JOIN articulojf a 
				  ON dac.articulo = a.articulo
				LEFT JOIN almacencortejf da
 			  	  ON dac.almacencorte=da.codigo
				WHERE DATE(da.fecha) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
			  GROUP BY dac.almacencorte,
				a.modelo,
				a.nombre,
				a.color ");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT 
				dac.almacencorte,
				DATE(da.fecha) as fechas,
				a.modelo,
				a.nombre,
				a.color,
				SUM(
				  CASE
					WHEN a.cod_talla = '1' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t1,
				SUM(
				  CASE
					WHEN a.cod_talla = '2' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t2,
				SUM(
				  CASE
					WHEN a.cod_talla = '3' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t3,
				SUM(
				  CASE
					WHEN a.cod_talla = '4' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t4,
				SUM(
				  CASE
					WHEN a.cod_talla = '5' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t5,
				SUM(
				  CASE
					WHEN a.cod_talla = '6' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t6,
				SUM(
				  CASE
					WHEN a.cod_talla = '7' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t7,
				SUM(
				  CASE
					WHEN a.cod_talla = '8' 
					THEN dac.cantidad 
					ELSE 0 
				  END
				) AS t8,
				SUM(dac.cantidad) AS subtotal 
			  FROM
				almacencorte_detallejf dac 
				LEFT JOIN articulojf a 
				  ON dac.articulo = a.articulo 
				LEFT JOIN almacencortejf da
 				  ON dac.almacencorte=da.codigo
				WHERE DATE(da.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'
			  GROUP BY dac.almacencorte,
				a.modelo,
				a.nombre,
				a.color  ");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}	
}