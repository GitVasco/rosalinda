<?php

require_once "conexion.php";

class ModeloMateriaPrima{

	/* 
	* MOSTRAR DATOS DE LA MATERIA PRIMA
	*/
	static public function mdlMostrarMateriaPrima($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("CALL sp_1028_consulta_mp_p($valor)");

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL sp_1029_consulta_mp()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }    
    
	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/
	static public function mdlEditarMateriaPrima($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1030_update_mp_p(:descripcion, :valor)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}
	
	/* 
	* Método para vizualizar detalle de la materia prima
	*/
	static public function mdlVisualizarMateriaPrimaDetalle($valor){

		$sql="CALL sp_1031_articulos_x_mp_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* EDITAR COSTO DE LA MATERIA PRIMA
	*/
	static public function mdlEditarMateriaPrimaCosto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1032_update_mp_costo_p(:cospro,:valor)");

		$stmt->bindParam(":cospro", $datos["cospro"], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}
	
	/* 
	* MOSTRAR MATERIA PRIMA PARA LA TABLA URGENCIA
	*/
	static public function mdlMostrarUrgenciaAMP($valor){

		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("CALL sp_1033_mp_urgencias()");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("CALL sp_1028_consulta_mp_p($valor)");

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleOC($valor){

		$sql="CALL sp_1034_mp_en_oc_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleART($valor){

		$sql="CALL sp_1035_art_mp_urg_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	

   // Método para mostrar el Rango de Fechas de Ventas
	static public function mdlProyMp($mp){

		if($mp=="null"){

			$sql="SELECT 
						mp.linea,
						mp.codsublinea,
						mp.codpro,
						mp.codfab,
						mp.descripcion,
						mp.color,
						mp.unidad,
						mp.stock,
						SUM(doc.saldo * dt.consumo) AS requerimiento,
						IFNULL(oc.saldo, 0) AS saldo_oc,
						IFNULL(os.saldo, 0) AS saldo_os,
						IFNULL(pr.cons_total, 0) AS cons_total,
						IFNULL(i.ing,0) AS ingresos,
						IFNULL(
						(
						IFNULL(i.ing, 0) / IFNULL(pr.cons_total, 0)
						) * 100,
						0
						) AS avance  
					FROM
						ordencortejf o 
						LEFT JOIN detalles_ordencortejf doc 
						ON o.codigo = doc.ordencorte 
						LEFT JOIN detalles_tarjetajf dt 
						ON doc.articulo = dt.articulo 
						LEFT JOIN 
						(SELECT DISTINCT 
							p.Codpro AS codpro,
							SUBSTRING(p.CodFab, 1, 3) AS codlinea,
							Tb4.Des_larga AS linea,
							SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
							Tb1.Des_larga AS sublinea,
							p.CodFab AS codfab,
							p.DesPro AS descripcion,
							p.CodAlm01 AS stock,
							Tabla_M_Detalle.Des_Larga AS color,
							Tb2.Des_Corta AS unidad 
						FROM
							producto p,
							Tabla_M_Detalle,
							Tabla_M_Detalle AS Tb1,
							Tabla_M_Detalle AS Tb2,
							Tabla_M_Detalle AS Tb4 
						WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
							AND Tb2.Cod_Tabla IN ('TUND') 
							AND tB4.Cod_Tabla IN ('TLIN') 
							AND Tb1.Cod_Tabla IN ('TSUB') 
							AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
							AND Tb2.Cod_Argumento = p.UndPro 
							AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
							AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
							AND Tb4.Des_Corta = Tb1.Des_Corta 
						ORDER BY p.CodPro ASC) AS mp 
						ON dt.mat_pri = mp.codpro 
						LEFT JOIN 
						(SELECT 
							ocd.codpro,
							ocd.nro,
							DATE(oc.fecemi) AS emision,
							DATE(oc.fecllegada) AS llegada,
							p.razpro,
							ocd.canpro AS cantidad_pedida,
							ocd.cantni AS saldo,
							oc.estac 
						FROM
							ocomdet ocd 
							LEFT JOIN ocompra oc 
							ON ocd.nro = oc.nro 
							LEFT JOIN proveedor p 
							ON oc.codruc = p.codruc 
						WHERE oc.estac IN ('ABI', 'PAR') 
							AND ocd.estac IN ('ABI', 'PAR') 
							AND oc.estoco = '03' 
							AND ocd.estoco = '03' 
							AND YEAR(oc.fecemi) = YEAR(NOW())) AS oc 
						ON dt.mat_pri = oc.codpro 
						LEFT JOIN 
						(SELECT 
							osd.CodProOrigen,
							osd.CodProDestino AS codpro,
							osd.Saldo 
						FROM
							oserviciodet osd 
							LEFT JOIN oservicio os 
							ON os.Nro = osd.Nro 
						WHERE osd.EstReg = '1' 
							AND osd.EstOS IN ('ABI', 'PAR') 
							AND YEAR(os.fecent) = YEAR(NOW())) AS os 
						ON dt.mat_pri = os.codpro 
						LEFT JOIN 
						(SELECT 
							dt.mat_pri,
							dt.consumo,
							a.proyeccion,
							SUM(dt.consumo * a.proyeccion) AS cons_total 
						FROM
							detalles_tarjetajf dt 
							LEFT JOIN articulojf a 
							ON dt.articulo = a.articulo 
						WHERE a.proyeccion > 0 
						GROUP BY dt.mat_pri) AS pr 
						ON dt.mat_pri = pr.mat_pri 
						LEFT JOIN 
						(SELECT 
							nd.codpro,
							SUM(nd.cansol) AS ing 
						FROM
							neadet nd 
						WHERE nd.fecemi > '2020-07-31' 
						GROUP BY nd.codpro) AS i 
						ON dt.mat_pri = i.codpro 
					WHERE o.estado NOT IN ('Cerrado') 
					GROUP BY mp.codpro 
					ORDER BY mp.linea";
			
			$stmt=Conexion::conectar()->prepare($sql);

			$stmt->execute();
			
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
			return $stmt->fetchAll();

      	}else{

			$sql="SELECT 
			mp.linea,
			mp.codsublinea,
			mp.codpro,
			mp.codfab,
			mp.descripcion,
			mp.color,
			mp.unidad,
			mp.stock,
			SUM(doc.saldo * dt.consumo) AS requerimiento,
			IFNULL(oc.saldo, 0) AS saldo_oc,
			IFNULL(os.saldo, 0) AS saldo_os,
			IFNULL(pr.cons_total, 0) AS cons_total,
			IFNULL(i.ing, 0) AS ingresos,
			IFNULL(
			  (
				IFNULL(i.ing, 0) / IFNULL(pr.cons_total, 0)
			  ) * 100,
			  0
			) AS avance 
		  FROM
			ordencortejf o 
			LEFT JOIN detalles_ordencortejf doc 
			  ON o.codigo = doc.ordencorte 
			LEFT JOIN detalles_tarjetajf dt 
			  ON doc.articulo = dt.articulo 
			LEFT JOIN 
			  (SELECT DISTINCT 
				p.Codpro AS codpro,
				SUBSTRING(p.CodFab, 1, 3) AS codlinea,
				Tb4.Des_larga AS linea,
				SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
				Tb1.Des_larga AS sublinea,
				p.CodFab AS codfab,
				p.DesPro AS descripcion,
				p.CodAlm01 AS stock,
				Tabla_M_Detalle.Des_Larga AS color,
				Tb2.Des_Corta AS unidad 
			  FROM
				producto p,
				Tabla_M_Detalle,
				Tabla_M_Detalle AS Tb1,
				Tabla_M_Detalle AS Tb2,
				Tabla_M_Detalle AS Tb4 
			  WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
				AND Tb2.Cod_Tabla IN ('TUND') 
				AND tB4.Cod_Tabla IN ('TLIN') 
				AND Tb1.Cod_Tabla IN ('TSUB') 
				AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
				AND Tb2.Cod_Argumento = p.UndPro 
				AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
				AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
				AND Tb4.Des_Corta = Tb1.Des_Corta 
			  ORDER BY p.CodPro ASC) AS mp 
			  ON dt.mat_pri = mp.codpro 
			LEFT JOIN 
			  (SELECT 
				ocd.codpro,
				ocd.nro,
				DATE(oc.fecemi) AS emision,
				DATE(oc.fecllegada) AS llegada,
				p.razpro,
				ocd.canpro AS cantidad_pedida,
				ocd.cantni AS saldo,
				oc.estac 
			  FROM
				ocomdet ocd 
				LEFT JOIN ocompra oc 
				  ON ocd.nro = oc.nro 
				LEFT JOIN proveedor p 
				  ON oc.codruc = p.codruc 
			  WHERE oc.estac IN ('ABI', 'PAR') 
				AND ocd.estac IN ('ABI', 'PAR') 
				AND oc.estoco = '03' 
				AND ocd.estoco = '03' 
				AND YEAR(oc.fecemi) = YEAR(NOW())) AS oc 
			  ON dt.mat_pri = oc.codpro 
			LEFT JOIN 
			  (SELECT 
				osd.CodProOrigen,
				osd.CodProDestino AS codpro,
				osd.Saldo 
			  FROM
				oserviciodet osd 
				LEFT JOIN oservicio os 
				  ON os.Nro = osd.Nro 
			  WHERE osd.EstReg = '1' 
				AND osd.EstOS IN ('ABI', 'PAR') 
				AND YEAR(os.fecent) = YEAR(NOW())) AS os 
			  ON dt.mat_pri = os.codpro 
			LEFT JOIN 
			  (SELECT 
				dt.mat_pri,
				dt.consumo,
				a.proyeccion,
				SUM(dt.consumo * a.proyeccion) AS cons_total 
			  FROM
				detalles_tarjetajf dt 
				LEFT JOIN articulojf a 
				  ON dt.articulo = a.articulo 
			  WHERE a.proyeccion > 0 
			  GROUP BY dt.mat_pri) AS pr 
			  ON dt.mat_pri = pr.mat_pri 
			LEFT JOIN 
			  (SELECT 
				nd.codpro,
				SUM(nd.cansol) AS ing 
			  FROM
				neadet nd 
			  WHERE nd.fecemi > '2020-07-31' 
			  GROUP BY nd.codpro) AS i 
			  ON dt.mat_pri = i.codpro 
		  WHERE o.estado NOT IN ('Cerrado') 
			AND o.codigo = :mp
		  GROUP BY mp.codpro 
		  ORDER BY mp.linea";

			$stmt=Conexion::conectar()->prepare($sql);
			
			$stmt->bindParam(":mp", $mp, PDO::PARAM_STR);

			$stmt->execute();

			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
			return $stmt->fetchAll();
         
      	}
      
		$stmt=null;
   }      	


}