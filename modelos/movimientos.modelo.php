<?php

require_once "conexion.php";

class ModeloMovimientos{

   /* 
   * total unidades vendidas del mes actual y mes pasado
   */
   static public function mdlTotUndVen($valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1003_venta_mes_und()");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1004_venta_mes_und_p($valor)");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }

   }

   /* 
   * total unidades producidas del mes actual y pasado
   */
   static public function mdlTotUndProd($valor){

      if($valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1005_produccion_mes_und");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1006_produccion_mes_und_p($valor)");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }

   }
   
   /* 
   * query para sacar los meses codigo y nombre
   */
   static public function mldMesesMov(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1011_nombre_meses()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de ventas por mes
   */
   static public function mdlTotalMesVent(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1001_venta_anoxmes_und()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de produccion por mes
   */
   static public function mdlTotalMesProd(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1002_produccion_anoxmes_und()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }
   
   /* 
   * sacamos los totales por mes de la  nueva tabla TOTALES
   */
   static public function mldMostrarTotales(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1007_resumen_mov_mes()");

      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

      $stmt = null;

   }

   /* 
	* Método para actualizar los totales por dia
	*/
	static public function mdlActualizarMovimientos($valor1,$valor2){
	
		$sql="CALL sp_1008_actualizar_totales_p($valor1, $valor2)";

		$stmt=Conexion::conectar()->prepare($sql);

		if($stmt->execute()){

			return "ok";
		
		}else{
		
			return "error";
		
		}
		
		$stmt=null;

	}

   /* 
   * sacamos las ventas de los ultimos 3 años, por mes y año
   */
   static public function mdlTotalesSolesVenta(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1009_ventas_ult_3annos()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los pagos por mes y año
   */
   static public function mdlTotalesSolesPagos(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1010_pagos_ult_3annos()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * total de dias con produccion del mes pasado
   */
   static public function mdlTotDiasProd($valor){

      $stmt = Conexion::conectar()->prepare("CALL sp_1012_contar_dias_prod_p('$valor')");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;
   } 
   
   /* 
   * top 10 de ventas modelos
   */
   static public function mdlMovMes($valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1013_top10_mod()");

         $stmt -> execute();

         return $stmt -> fetchALL();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1014_top10_mod_p($valor)");

         $stmt -> execute();

         return $stmt -> fetchAll();

         $stmt -> close();

         $stmt = null;

      }


   }    

   /* 
   * Cantidad total de unidades vendidas el mes actual
   */
   static public function mdlSumaUnd($valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1015_vent_und_total_mes()");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1016_vent_und_total_mes_p($valor)");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }


   }    

   /* 
   * MOSTRAR ULTIMO NUMERO DE TALONARIO
   */
   static public function mdlMostrarTalonario(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1017_consulta_talonarios()");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;
   } 

   static public function mdlMostrarTalonarioSalida(){

      $stmt = Conexion::conectar()->prepare("SELECT 
      pedido 
    FROM
      talonariosjf 
    WHERE LEFT(pedido, 1) = '3' ");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;
   } 

	// Método para mostrar el Rango de Fechas de Ventas
	static public function mdlMovProdMod($modelo){

		if($modelo=="null"){

         $sql="SELECT 
                     a1.modelo AS modelo,
                     a1.articulo AS articulo,
                     a1.nombre AS nombre,
                     a1.cod_color,
                     a1.color,
                     a1.talla,
                     a1.estado AS estado,
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '1' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '1',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '2' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '2',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '3' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '3',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '4' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '4',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '5' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '5',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '6' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '6',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '7' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '7',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '8' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '8',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '9' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '9',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '10' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '10',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '11' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '11',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '12' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '12',
                     ROUND(SUM(m.cantidad)) AS total 
                  FROM
                     movimientosjf m 
                     LEFT JOIN articulojf a1 
                     ON m.articulo = a1.articulo 
                  WHERE YEAR(m.fecha) = YEAR(NOW()) 
                     AND m.tipo = 'E20' 
                  GROUP BY a1.modelo,
                     a1.articulo,
                     a1.nombre,
                     a1.cod_color,
                     a1.color,
                     a1.talla,
                     a1.estado 
                  UNION
                  SELECT 
                     mo.modelo AS modelo,
                     'TOTAL' AS articulo,
                     mo.nombre AS nombre,
                     '-',
                     '-',
                     '-',
                     mo.estado AS estado,
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '1' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '1',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '2' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '2',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '3' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '3',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '4' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '4',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '5' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '5',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '6' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '6',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '7' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '7',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '8' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '8',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '9' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '9',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '10' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '10',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '11' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '11',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '12' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '12',
                     ROUND(SUM(m.cantidad)) AS total 
                  FROM
                     movimientosjf m 
                     LEFT JOIN articulojf a2 
                     ON m.articulo = a2.articulo 
                     LEFT JOIN modelojf mo 
                     ON a2.modelo = mo.modelo 
                  WHERE YEAR(m.fecha) = YEAR(NOW()) 
                     AND m.tipo = 'E20' 
                  GROUP BY mo.modelo,
                     mo.nombre,
                     mo.estado 
                  ORDER BY modelo ASC,
                     articulo ASC";
         
			$stmt=Conexion::conectar()->prepare($sql);
         $stmt->execute();
         
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();

      }else{

			$sql="SELECT 
                     a1.modelo AS modelo,
                     a1.articulo AS articulo,
                     a1.nombre AS nombre,
                     a1.cod_color,
                     a1.color,
                     a1.talla,
                     a1.estado AS estado,
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '1' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '1',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '2' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '2',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '3' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '3',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '4' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '4',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '5' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '5',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '6' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '6',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '7' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '7',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '8' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '8',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '9' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '9',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '10' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '10',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '11' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '11',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '12' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '12',
                     ROUND(SUM(m.cantidad)) AS total 
                  FROM
                     movimientosjf m 
                     LEFT JOIN articulojf a1 
                     ON m.articulo = a1.articulo 
                  WHERE YEAR(m.fecha) = YEAR(NOW()) 
                     AND m.tipo = 'E20' 
                     AND a1.modelo = :modelo
                  GROUP BY a1.modelo,
                     a1.articulo,
                     a1.nombre,
                     a1.cod_color,
                     a1.color,
                     a1.talla,
                     a1.estado 
                  UNION
                  SELECT 
                     mo.modelo AS modelo,
                     'TOTAL' AS articulo,
                     mo.nombre AS nombre,
                     '-',
                     '-',
                     '-',
                     mo.estado AS estado,
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '1' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '1',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '2' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '2',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '3' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '3',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '4' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '4',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '5' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '5',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '6' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '6',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '7' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '7',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '8' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '8',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '9' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '9',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '10' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '10',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '11' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '11',
                     SUM(
                     CASE
                        WHEN MONTH(m.fecha) = '12' 
                        THEN ROUND(m.cantidad, 0) 
                        ELSE 0 
                     END
                     ) AS '12',
                     ROUND(SUM(m.cantidad)) AS total 
                  FROM
                     movimientosjf m 
                     LEFT JOIN articulojf a2 
                     ON m.articulo = a2.articulo 
                     LEFT JOIN modelojf mo 
                     ON a2.modelo = mo.modelo 
                  WHERE YEAR(m.fecha) = YEAR(NOW()) 
                     AND m.tipo = 'E20' 
                     AND a2.modelo = :modelo 
                  GROUP BY mo.modelo,
                     mo.nombre,
                     mo.estado 
                  ORDER BY modelo ASC,
                     articulo ASC";

         $stmt=Conexion::conectar()->prepare($sql);
         
         $stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);


			$stmt->execute();
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();
         
      }
      
		$stmt=null;
	}   

   // Método para mostrar el Rango de Fechas de Ventas
	static public function mdlMovVtaMod($modelo){

		if($modelo=="null"){

         $sql="SELECT 
                  a1.modelo AS modelo,
                  a1.articulo AS articulo,
                  a1.nombre AS nombre,
                  a1.cod_color,
                  a1.color,
                  a1.talla,
                  a1.estado AS estado,
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '1' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '1',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '2' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '2',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '3' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '3',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '4' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '4',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '5' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '5',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '6' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '6',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '7' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '7',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '8' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '8',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '9' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '9',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '10' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '10',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '11' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '11',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '12' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '12',
                  ROUND(SUM(m.cantidad)) AS total 
               FROM
                  movimientosjf m 
                  LEFT JOIN articulojf a1 
                  ON m.articulo = a1.articulo 
               WHERE YEAR(m.fecha) = YEAR(NOW()) 
                  AND m.tipo IN ('S02', 'S03', 'S70', 'E05') 
               GROUP BY a1.modelo,
                  a1.articulo,
                  a1.nombre,
                  a1.cod_color,
                  a1.color,
                  a1.talla,
                  a1.estado 
               UNION
               SELECT 
                  a2.modelo AS modelo,
                  'TOTAL' AS articulo,
                  a2.nombre AS nombre,
                  '-',
                  '-',
                  '-',
                  a2.estado AS estado,
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '1' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '1',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '2' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '2',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '3' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '3',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '4' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '4',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '5' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '5',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '6' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '6',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '7' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '7',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '8' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '8',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '9' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '9',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '10' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '10',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '11' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '11',
                  SUM(
                  CASE
                     WHEN MONTH(m.fecha) = '12' 
                     THEN ROUND(m.cantidad, 0) 
                     ELSE 0 
                  END
                  ) AS '12',
                  ROUND(SUM(m.cantidad)) AS total 
               FROM
                  movimientosjf m 
                  LEFT JOIN articulojf a2 
                  ON m.articulo = a2.articulo 
               WHERE YEAR(m.fecha) = YEAR(NOW()) 
                  AND m.tipo IN ('S02', 'S03', 'S70', 'E05', 'E21') 
               GROUP BY a2.modelo,
                  a2.nombre 
               ORDER BY modelo ASC,
                  articulo ASC";
         
			$stmt=Conexion::conectar()->prepare($sql);
         $stmt->execute();
         
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();

      }else{

			$sql="SELECT 
               a1.modelo AS modelo,
               a1.articulo AS articulo,
               a1.nombre AS nombre,
               a1.cod_color,
               a1.color,
               a1.talla,
               a1.estado AS estado,
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '1' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '1',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '2' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '2',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '3' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '3',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '4' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '4',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '5' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '5',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '6' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '6',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '7' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '7',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '8' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '8',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '9' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '9',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '10' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '10',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '11' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '11',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '12' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '12',
               ROUND(SUM(m.cantidad)) AS total 
            FROM
               movimientosjf m 
               LEFT JOIN articulojf a1 
               ON m.articulo = a1.articulo 
            WHERE YEAR(m.fecha) = YEAR(NOW()) 
               AND m.tipo IN ('S02', 'S03', 'S70', 'E05') 
               AND a1.modelo = :modelo 
            GROUP BY a1.modelo,
               a1.articulo,
               a1.nombre,
               a1.cod_color,
               a1.color,
               a1.talla,
               a1.estado 
            UNION
            SELECT 
               a2.modelo AS modelo,
               'TOTAL' AS articulo,
               a2.nombre AS nombre,
               '-',
               '-',
               '-',
               a2.estado AS estado,
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '1' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '1',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '2' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '2',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '3' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '3',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '4' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '4',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '5' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '5',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '6' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '6',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '7' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '7',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '8' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '8',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '9' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '9',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '10' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '10',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '11' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '11',
               SUM(
               CASE
                  WHEN MONTH(m.fecha) = '12' 
                  THEN ROUND(m.cantidad, 0) 
                  ELSE 0 
               END
               ) AS '12',
               ROUND(SUM(m.cantidad)) AS total 
            FROM
               movimientosjf m 
               LEFT JOIN articulojf a2 
               ON m.articulo = a2.articulo 
            WHERE YEAR(m.fecha) = YEAR(NOW()) 
               AND m.tipo IN ('S02', 'S03', 'S70', 'E05', 'E21') 
               AND a2.modelo = :modelo
            GROUP BY a2.modelo,
               a2.nombre 
            ORDER BY modelo ASC,
               articulo ASC";

         $stmt=Conexion::conectar()->prepare($sql);
         
         $stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);

			$stmt->execute();
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();
         
      }
      
		$stmt=null;
   }      
   
   /* 
   * sacamos los totales de ventas por mes
   */
  static public function mdlLineaMP(){

   $stmt = Conexion::conectar()->prepare("SELECT 
                                          t.des_corta AS codlinea,
                                          t.cod_tabla,
                                          t.des_larga AS descripcion 
                                       FROM
                                          tabla_m_detalle t 
                                       WHERE t.cod_tabla = 'TLIN'");

   $stmt -> execute();

   return $stmt -> fetchall();

   }   

   // Método para mostrar el Rango de Fechas de Ventas
	static public function mdlMovIngMp($linea){

		if($linea=="null"){

         $sql="SELECT 
                        mp.codsublinea,
                        mp.codigofabrica,
                        n.codpro,
                        mp.codlinea,
                        mp.linea,
                        mp.descripcion,
                        mp.color,
                        mp.unidad,
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '1' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '1',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '2' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '2',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '3' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '3',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '4' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '4',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '5' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '5',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '6' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '6',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '7' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '7',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '8' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '8',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '9' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '9',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '10' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '10',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '11' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '11',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '12' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '12',
                        SUM(n.cansol) AS total 
                     FROM
                        neadet n 
                        LEFT JOIN 
                        (SELECT DISTINCT 
                           p.Codpro AS Codigo,
                           SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                           Tb4.Des_larga AS Linea,
                           p.CodFab AS CodigoFabrica,
                           p.DesPro AS Descripcion,
                           p.CodAlm01 AS Stk_Actual,
                           Tabla_M_Detalle.Des_Larga AS Color,
                           Tb2.Des_Corta AS Unidad,
                           p.CosPro,
                           SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                           Tb1.Des_larga AS SubLinea 
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
                        ON n.codpro = mp.codigo 
                     WHERE n.EstReg = 'P' 
                        AND n.CanSol > 0 
                        AND YEAR(n.fecreg) = YEAR(NOW()) 
                     GROUP BY n.codpro 
                     UNION
                     SELECT 
                        mp.codsublinea,
                        'TOTAL',
                        '-',
                        mp.codlinea,
                        mp.linea,
                        '-',
                        '-',
                        '-',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '1' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '1',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '2' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '2',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '3' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '3',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '4' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '4',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '5' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '5',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '6' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '6',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '7' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '7',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '8' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '8',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '9' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '9',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '10' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '10',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '11' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '11',
                        SUM(
                        CASE
                           WHEN MONTH(n.fecreg) = '12' 
                           THEN n.CanSol 
                           ELSE 0 
                        END
                        ) AS '12',
                        SUM(n.cansol) AS total 
                     FROM
                        neadet n 
                        LEFT JOIN 
                        (SELECT DISTINCT 
                           p.Codpro AS Codigo,
                           SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                           Tb4.Des_larga AS Linea,
                           p.CodFab AS CodigoFabrica,
                           p.DesPro AS Descripcion,
                           p.CodAlm01 AS Stk_Actual,
                           Tabla_M_Detalle.Des_Larga AS Color,
                           Tb2.Des_Corta AS Unidad,
                           p.CosPro,
                           SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                           Tb1.Des_larga AS SubLinea 
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
                        ON n.codpro = mp.codigo 
                     WHERE n.EstReg = 'P' 
                        AND n.CanSol > 0 
                        AND YEAR(n.fecreg) = YEAR(NOW()) 
                     GROUP BY mp.codsublinea 
                     ORDER BY codsublinea,
                        codigofabrica";
         
			$stmt=Conexion::conectar()->prepare($sql);
         $stmt->execute();
         
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();

      }else{

			$sql="SELECT 
                     mp.codsublinea,
                     mp.codigofabrica,
                     n.codpro,
                     mp.codlinea,
                     mp.linea,
                     mp.descripcion,
                     mp.color,
                     mp.unidad,
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '1' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '1',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '2' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '2',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '3' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '3',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '4' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '4',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '5' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '5',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '6' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '6',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '7' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '7',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '8' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '8',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '9' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '9',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '10' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '10',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '11' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '11',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '12' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '12',
                     SUM(n.cansol) AS total 
                  FROM
                     neadet n 
                     LEFT JOIN 
                     (SELECT DISTINCT 
                        p.Codpro AS Codigo,
                        SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                        Tb4.Des_larga AS Linea,
                        p.CodFab AS CodigoFabrica,
                        p.DesPro AS Descripcion,
                        p.CodAlm01 AS Stk_Actual,
                        Tabla_M_Detalle.Des_Larga AS Color,
                        Tb2.Des_Corta AS Unidad,
                        p.CosPro,
                        SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                        Tb1.Des_larga AS SubLinea 
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
                     ON n.codpro = mp.codigo 
                  WHERE n.EstReg = 'P' 
                     AND n.CanSol > 0 
                     AND YEAR(n.fecreg) = YEAR(NOW()) 
                     AND mp.codlinea = :linea    
                  GROUP BY n.codpro 
                  UNION
                  SELECT 
                     mp.codsublinea,
                     'TOTAL',
                     '-',
                     mp.codlinea,
                     mp.linea,
                     '-',
                     '-',
                     '-',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '1' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '1',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '2' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '2',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '3' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '3',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '4' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '4',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '5' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '5',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '6' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '6',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '7' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '7',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '8' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '8',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '9' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '9',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '10' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '10',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '11' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '11',
                     SUM(
                     CASE
                        WHEN MONTH(n.fecreg) = '12' 
                        THEN n.CanSol 
                        ELSE 0 
                     END
                     ) AS '12',
                     SUM(n.cansol) AS total 
                  FROM
                     neadet n 
                     LEFT JOIN 
                     (SELECT DISTINCT 
                        p.Codpro AS Codigo,
                        SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                        Tb4.Des_larga AS Linea,
                        p.CodFab AS CodigoFabrica,
                        p.DesPro AS Descripcion,
                        p.CodAlm01 AS Stk_Actual,
                        Tabla_M_Detalle.Des_Larga AS Color,
                        Tb2.Des_Corta AS Unidad,
                        p.CosPro,
                        SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                        Tb1.Des_larga AS SubLinea 
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
                     ON n.codpro = mp.codigo 
                  WHERE n.EstReg = 'P' 
                     AND n.CanSol > 0 
                     AND YEAR(n.fecreg) = YEAR(NOW()) 
                     AND mp.codlinea = :linea
                  GROUP BY mp.codsublinea 
                  ORDER BY codsublinea,
                     codigofabrica";

         
         $stmt=Conexion::conectar()->prepare($sql);
         
         $stmt->bindParam(":linea", $linea, PDO::PARAM_STR);

			$stmt->execute();
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();
         
      }
      
		$stmt=null;
   }   

// Método para mostrar el Rango de Fechas de Ventas
	static public function mdlMovSalMp($linea){

		if($linea=="null"){

         $sql="SELECT 
                  mp.codsublinea,
                  mp.codigofabrica,
                  vd.codpro,
                  mp.codlinea,
                  mp.linea,
                  mp.descripcion,
                  mp.color,
                  mp.unidad,
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '1' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '1',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '2' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '2',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '3' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '3',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '4' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '4',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '5' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '5',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '6' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '6',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '7' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '7',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '8' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '8',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '9' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '9',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '10' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '10',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '11' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '11',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '12' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '12',
                  SUM(vd.canvta) AS total 
               FROM
                  venta_det vd 
                  LEFT JOIN 
                  (SELECT DISTINCT 
                     p.Codpro AS Codigo,
                     SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                     Tb4.Des_larga AS Linea,
                     p.CodFab AS CodigoFabrica,
                     p.DesPro AS Descripcion,
                     p.CodAlm01 AS Stk_Actual,
                     Tabla_M_Detalle.Des_Larga AS Color,
                     Tb2.Des_Corta AS Unidad,
                     p.CosPro,
                     SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                     Tb1.Des_larga AS SubLinea 
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
                  ON vd.codpro = mp.codigo 
               WHERE vd.EstVta = 'P' 
                  AND vd.canvta > 0 
                  AND YEAR(vd.fecemi) = YEAR(NOW()) 
               GROUP BY vd.codpro 
               UNION
               SELECT 
                  mp.codsublinea,
                  'TOTAL',
                  '-',
                  mp.codlinea,
                  mp.linea,
                  '-',
                  '-',
                  '-',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '1' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '1',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '2' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '2',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '3' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '3',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '4' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '4',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '5' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '5',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '6' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '6',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '7' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '7',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '8' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '8',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '9' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '9',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '10' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '10',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '11' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '11',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '12' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '12',
                  SUM(vd.canvta) AS total 
               FROM
                  venta_det vd 
                  LEFT JOIN 
                  (SELECT DISTINCT 
                     p.Codpro AS Codigo,
                     SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                     Tb4.Des_larga AS Linea,
                     p.CodFab AS CodigoFabrica,
                     p.DesPro AS Descripcion,
                     p.CodAlm01 AS Stk_Actual,
                     Tabla_M_Detalle.Des_Larga AS Color,
                     Tb2.Des_Corta AS Unidad,
                     p.CosPro,
                     SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                     Tb1.Des_larga AS SubLinea 
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
                  ON vd.codpro = mp.codigo 
               WHERE vd.EstVta = 'P' 
                  AND vd.canvta > 0 
                  AND YEAR(vd.fecemi) = YEAR(NOW()) 
               GROUP BY mp.codsublinea 
               ORDER BY codsublinea,
                  codigofabrica";
         
			$stmt=Conexion::conectar()->prepare($sql);
         $stmt->execute();
         
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();

      }else{

			$sql="SELECT 
                  mp.codsublinea,
                  mp.codigofabrica,
                  vd.codpro,
                  mp.codlinea,
                  mp.linea,
                  mp.descripcion,
                  mp.color,
                  mp.unidad,
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '1' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '1',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '2' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '2',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '3' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '3',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '4' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '4',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '5' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '5',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '6' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '6',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '7' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '7',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '8' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '8',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '9' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '9',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '10' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '10',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '11' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '11',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '12' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '12',
                  SUM(vd.canvta) AS total 
               FROM
                  venta_det vd 
                  LEFT JOIN 
                  (SELECT DISTINCT 
                     p.Codpro AS Codigo,
                     SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                     Tb4.Des_larga AS Linea,
                     p.CodFab AS CodigoFabrica,
                     p.DesPro AS Descripcion,
                     p.CodAlm01 AS Stk_Actual,
                     Tabla_M_Detalle.Des_Larga AS Color,
                     Tb2.Des_Corta AS Unidad,
                     p.CosPro,
                     SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                     Tb1.Des_larga AS SubLinea 
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
                  ON vd.codpro = mp.codigo 
               WHERE vd.EstVta = 'P' 
                  AND vd.canvta > 0 
                  AND YEAR(vd.fecemi) = YEAR(NOW()) 
                  AND mp.codlinea = :linea 
               GROUP BY vd.codpro 
               UNION
               SELECT 
                  mp.codsublinea,
                  'TOTAL',
                  '-',
                  mp.codlinea,
                  mp.linea,
                  '-',
                  '-',
                  '-',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '1' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '1',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '2' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '2',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '3' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '3',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '4' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '4',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '5' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '5',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '6' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '6',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '7' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '7',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '8' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '8',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '9' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '9',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '10' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '10',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '11' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '11',
                  SUM(
                  CASE
                     WHEN MONTH(vd.fecemi) = '12' 
                     THEN vd.canvta 
                     ELSE 0 
                  END
                  ) AS '12',
                  SUM(vd.canvta) AS total 
               FROM
                  venta_det vd 
                  LEFT JOIN 
                  (SELECT DISTINCT 
                     p.Codpro AS Codigo,
                     SUBSTRING(p.CodFab, 1, 3) AS codlinea,
                     Tb4.Des_larga AS Linea,
                     p.CodFab AS CodigoFabrica,
                     p.DesPro AS Descripcion,
                     p.CodAlm01 AS Stk_Actual,
                     Tabla_M_Detalle.Des_Larga AS Color,
                     Tb2.Des_Corta AS Unidad,
                     p.CosPro,
                     SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
                     Tb1.Des_larga AS SubLinea 
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
                  ON vd.codpro = mp.codigo 
               WHERE vd.EstVta = 'P' 
                  AND vd.canvta > 0 
                  AND YEAR(vd.fecemi) = YEAR(NOW()) 
                  AND mp.codlinea = :linea 
               GROUP BY mp.codsublinea 
               ORDER BY codsublinea,
                  codigofabrica";

         
         $stmt=Conexion::conectar()->prepare($sql);
         
         $stmt->bindParam(":linea", $linea, PDO::PARAM_STR);

			$stmt->execute();
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
         return $stmt->fetchAll();
         
      }
      
		$stmt=null;
   }      

	/*
	* MOSTRAR TOTALES DEL MES
	*/
	static public function mdlTotalesSoles($mes){

      if( $mes == null || $mes == "TODO" ){

         $stmt = Conexion::conectar()->prepare("SELECT 
         t.año,
         SUM(total_ventas_soles) AS vtas_soles,
         SUM(total_pagos_soles) AS pagos_soles 
       FROM
         totalesjf t 
       WHERE t.año = YEAR(NOW()) 
       GROUP BY t.año");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                        t.año,
                        t.mes,
                        SUM(total_ventas_soles) AS vtas_soles,
                        SUM(total_pagos_soles) AS pagos_soles 
                     FROM
                        totalesjf t 
                     WHERE t.año = YEAR(NOW()) 
                        AND t.mes = $mes
                     GROUP BY t.año,
                        t.mes ;");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }

	}	   

	static public function mdlTotalesSolesPedidos($mes){

      if( $mes == null || $mes == "TODO"){

         $stmt = Conexion::conectar()->prepare("SELECT 
         MONTH(t.fecha) AS mes,
         SUM(op_gravada) AS total 
      FROM
         temporaljf t 
      WHERE YEAR(t.fecha) = YEAR(NOW()) 
         AND t.estado IN ('APROBADO', 'APT', 'CONFIRMADO')");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                MONTH(t.fecha) AS mes,
                                                SUM(op_gravada) AS total 
                                             FROM
                                                temporaljf t 
                                             WHERE YEAR(t.fecha) = YEAR(NOW()) 
                                                AND t.estado IN ('APROBADO', 'APT', 'CONFIRMADO')");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }

	}   
   
	static public function mdlTotalVencidos(){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                          c.tip_mov,
                                          SUM(c.saldo) AS saldo
                                       FROM
                                          cuenta_ctejf c 
                                       WHERE c.tip_mov = '+' 
                                          AND c.estado = 'PENDIENTE' 
                                          AND c.fecha_ven < DATE(NOW())
                                          GROUP BY c.tip_mov");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;


	}    

  static public function mdlFacturas($mes){

   if( $mes == null){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                 IFNULL(SUM(neto), 0) AS neto 
                              FROM
                                 ventajf v 
                              WHERE YEAR(v.fecha) = YEAR(NOW()) 
                                 AND v.tipo IN ('S02', 'S03', 'E05', 'S05') 
                                 AND v.vendedor <> '99' 
                              GROUP BY YEAR(NOW())");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }else{

      $stmt = Conexion::conectar()->prepare("SELECT 
                              IFNULL(SUM(neto), 0) AS neto 
                           FROM
                              ventajf v 
                           WHERE YEAR(v.fecha) = YEAR(NOW()) 
                              AND MONTH(v.fecha) = $mes 
                              AND v.tipo IN ('S02', 'S03', 'E05', 'S05')
                              AND v.vendedor <> '99' 
                           GROUP BY MONTH(v.fecha)");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }

 }      

 static public function mdlProformas($mes){

   if( $mes == null){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                 IFNULL(SUM(neto), 0) AS neto 
                              FROM
                                 ventajf v 
                              WHERE YEAR(v.fecha) = YEAR(NOW()) 
                                 AND v.tipo IN ('S70') 
                                 AND v.vendedor <> '99' 
                              GROUP BY YEAR(NOW())");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }else{

      $stmt = Conexion::conectar()->prepare("SELECT 
                              IFNULL(SUM(neto), 0) AS neto 
                           FROM
                              ventajf v 
                           WHERE YEAR(v.fecha) = YEAR(NOW()) 
                              AND MONTH(v.fecha) = $mes 
                              AND v.tipo IN ('S70')
                              AND v.vendedor <> '99' 
                           GROUP BY MONTH(v.fecha)");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }

    }   


   /* 
   * sacamos los totales vencidos por vendedor
   */
  static public function mdlTotalesVencidosVendedor($inicio, $lineas){

   $stmt = Conexion::conectar()->prepare("SELECT 
                                       c.vendedor,
                                       (SELECT 
                                       descripcion 
                                       FROM
                                       maestrajf m 
                                       WHERE m.tipo_dato = 'tvend' 
                                       AND m.codigo = c.vendedor) AS nom_vendedor,
                                       SUM(c.saldo) AS saldo 
                                    FROM
                                       cuenta_ctejf c 
                                    WHERE c.tip_mov = '+' 
                                       AND c.estado = 'PENDIENTE' 
                                       AND c.fecha_ven < DATE(NOW()) 
                                    GROUP BY c.vendedor 
                                    ORDER BY c.vendedor
                                    LIMIT $inicio, $lineas");

   $stmt -> execute();

   return $stmt -> fetchall();

    }

	static public function mldMostrarCtasVdor(){

        $stmt = Conexion::conectar()->prepare("SELECT 
                                            c.vendedor,
                                            (SELECT 
                                            descripcion 
                                            FROM
                                            maestrajf m 
                                            WHERE c.vendedor = m.codigo 
                                            AND tipo_dato = 'tvend') AS nom_vendedor,
                                            SUM(
                                            CASE
                                                WHEN c.tipo_doc IN ('01', '03', '07', '08') 
                                                THEN c.saldo 
                                                ELSE 0 
                                            END
                                            ) AS 'facturas',
                                            SUM(
                                            CASE
                                                WHEN c.tipo_doc IN ('09') 
                                                THEN c.saldo 
                                                ELSE 0 
                                            END
                                            ) AS 'guias',
                                            SUM(
                                            CASE
                                                WHEN c.tipo_doc IN ('85') 
                                                THEN c.saldo 
                                                ELSE 0 
                                            END
                                            ) AS 'letras',
                                            SUM(c.saldo) AS total 
                                        FROM
                                            cuenta_ctejf c 
                                        WHERE c.tip_mov = '+' 
                                            AND c.estado = 'PENDIENTE' 
                                        GROUP BY c.vendedor 
                                        UNION
                                        SELECT 
                                            'ZZ' AS tip_mov,
                                            '' AS nom_vendedor,
                                            SUM(
                                            CASE
                                                WHEN c.tipo_doc IN ('01', '03', '07', '08') 
                                                THEN c.saldo 
                                                ELSE 0 
                                            END
                                            ) AS 'facturas',
                                            SUM(
                                            CASE
                                                WHEN c.tipo_doc IN ('09') 
                                                THEN c.saldo 
                                                ELSE 0 
                                            END
                                            ) AS 'guias',
                                            SUM(
                                            CASE
                                                WHEN c.tipo_doc IN ('85') 
                                                THEN c.saldo 
                                                ELSE 0 
                                            END
                                            ) AS 'letras',
                                            SUM(c.saldo) AS total 
                                        FROM
                                            cuenta_ctejf c 
                                        WHERE c.tip_mov = '+' 
                                            AND c.estado = 'PENDIENTE' 
                                        GROUP BY c.tip_mov");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

	} 
    
	static public function mldMostrarRangosDias(){

        $stmt = Conexion::conectar()->prepare("SELECT 
                             c.vendedor,
                             (SELECT 
                             descripcion 
                             FROM
                             maestrajf m 
                             WHERE m.tipo_dato = 'TVEND' 
                             AND m.codigo = c.vendedor) AS nombre,
                             SUM(
                             CASE
                                WHEN TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) >= 1 
                                AND TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) <= 30 
                                THEN c.saldo 
                                ELSE 0 
                             END
                             ) AS '1a30',
                             SUM(
                             CASE
                                WHEN TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) > 30 
                                AND TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) <= 60 
                                THEN c.saldo 
                                ELSE 0 
                             END
                             ) AS '31a60',
                             SUM(
                             CASE
                                WHEN TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) > 60 
                                AND TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) <= 90 
                                THEN c.saldo 
                                ELSE 0 
                             END
                             ) AS '61a90',
                             SUM(
                             CASE
                                WHEN TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) > 90 
                                AND TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) <= 120 
                                THEN c.saldo 
                                ELSE 0 
                             END
                             ) AS '91a120',
                             SUM(
                             CASE
                                WHEN TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) > 120 
                                AND TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) <= 150 
                                THEN c.saldo 
                                ELSE 0 
                             END
                             ) AS '121a150',
                             SUM(
                             CASE
                                WHEN TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) > 150 
                                AND TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) <= 180 
                                THEN c.saldo 
                                ELSE 0 
                             END
                             ) AS '151a180',
                             SUM(
                             CASE
                                WHEN TIMESTAMPDIFF(DAY, c.fecha_ven, DATE(NOW())) > 180 
                                THEN c.saldo 
                                ELSE 0 
                             END
                             ) AS '180amas' ,
                             SUM(c.saldo) AS total
                          FROM
                             cuenta_ctejf c 
                          WHERE c.tip_mov = '+' 
                             AND c.estado = 'PENDIENTE' 
                             AND c.fecha_ven < DATE(NOW()) 
                          GROUP BY c.vendedor");
  
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
        $stmt -> close();
  
        $stmt = null;
  
     }  
     
     static public function mdlMostrarRangos($mes){

        if( $mes == "null" || $mes == "TODO"){
  
           $stmt = Conexion::conectar()->prepare("SELECT 
                                      m.codigo,
                                      m.descripcion,
                                      IFNULL(v.ventas, 0) AS ventas,
                                      IFNULL(c.cobranza, 0) AS cobranza,
                                      IFNULL(ve.saldo, 0) AS saldo,
                                      IFNULL(p.a2015, 0) AS 'p15',
                                      IFNULL(p.a2016, 0) AS 'p16',
                                      IFNULL(p.a2017, 0) AS 'p17',
                                      IFNULL(p.a2018, 0) AS 'p18',
                                      IFNULL(p.a2019, 0) AS 'p19',
                                      IFNULL(p.a2020, 0) AS 'p20',
                                      IFNULL(p.a2021, 0) AS 'p21',
                                      IFNULL(p.a2022, 0) AS 'p22',
                                      IFNULL(p.total,0) AS 'total' 
                                   FROM
                                      maestrajf m 
                                      LEFT JOIN 
                                      (SELECT 
                                         v.vendedor,
                                         SUM(v.neto) AS ventas 
                                      FROM
                                         ventajf v 
                                      WHERE YEAR(v.fecha) = YEAR(NOW()) 
                                         AND v.estado <> 'ANULADO' 
                                         AND v.tipo IN ('S02', 'S03', 'S70', 'E05', 'S05') 
                                         AND v.vendedor <> '99' 
                                      GROUP BY v.vendedor, YEAR(v.fecha)) AS v 
                                      ON m.codigo = v.vendedor 
                                      LEFT JOIN 
                                      (SELECT 
                                         cc.vendedor,
                                         SUM(cc.monto) AS cobranza 
                                      FROM
                                         cuenta_ctejf cc 
                                      WHERE YEAR(cc.fecha) = YEAR(NOW()) 
                                         AND cc.tip_mov = '-' 
                                         AND cc.cod_pago IN ('00', '05', '06', '14', '80', '82', 'TR') 
                                      GROUP BY cc.vendedor) AS c 
                                      ON m.codigo = c.vendedor 
                                      LEFT JOIN 
                                      (SELECT 
                                         c.vendedor,
                                         SUM(c.saldo) AS saldo 
                                      FROM
                                         cuenta_ctejf c 
                                      WHERE c.tip_mov = '+' 
                                         AND c.estado = 'PENDIENTE' 
                                         AND c.fecha_ven < DATE(NOW()) 
                                      GROUP BY c.vendedor) AS ve 
                                      ON m.codigo = ve.vendedor 
                                      LEFT JOIN 
                                      (SELECT 
                                         c.vendedor,
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2015' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2015',
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2016' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2016',
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2017' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2017',
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2018' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2018',
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2019' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2019',
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2020' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2020',
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2021' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2021',
                                         SUM(
                                            CASE
                                            WHEN YEAR(c.fecha_ven) = '2022' 
                                            THEN c.saldo 
                                            ELSE 0 
                                            END
                                         ) AS 'a2022',
                                         SUM(c.saldo) AS total 
                                      FROM
                                         cuenta_ctejf c 
                                      WHERE c.tip_mov = '+' 
                                         AND c.estado = 'PENDIENTE' 
                                         AND c.fecha_ven < DATE(NOW()) 
                                      GROUP BY c.vendedor) AS p 
                                      ON m.codigo = p.vendedor 
                                   WHERE m.tipo_dato = 'TVEND' 
                                      AND (
                                      IFNULL(v.ventas, 0) + IFNULL(c.cobranza, 0) + IFNULL(ve.saldo, 0)
                                      ) > 0 
                                   ORDER BY m.codigo");
  
           $stmt -> execute();
  
           return $stmt -> fetchAll();
  
           $stmt -> close();
  
           $stmt = null;
  
        }else{
  
           $stmt = Conexion::conectar()->prepare("SELECT 
                                            m.codigo,
                                            m.descripcion,
                                            IFNULL(v.ventas, 0) AS ventas,
                                            IFNULL(c.cobranza, 0) AS cobranza,
                                            IFNULL(ve.saldo, 0) AS saldo,
                                            IFNULL(p.a2015, 0) AS 'p15',
                                            IFNULL(p.a2016, 0) AS 'p16',
                                            IFNULL(p.a2017, 0) AS 'p17',
                                            IFNULL(p.a2018, 0) AS 'p18',
                                            IFNULL(p.a2019, 0) AS 'p19',
                                            IFNULL(p.a2020, 0) AS 'p20',
                                            IFNULL(p.a2021, 0) AS 'p21',
                                            IFNULL(p.a2022, 0) AS 'p22',
                                            IFNULL(p.total,0) AS 'total' 
                                         FROM
                                            maestrajf m 
                                            LEFT JOIN 
                                            (SELECT 
                                               v.vendedor,
                                               SUM(v.neto) AS ventas 
                                            FROM
                                               ventajf v 
                                            WHERE YEAR(v.fecha) = YEAR(NOW()) 
                                               AND MONTH(v.fecha) = $mes 
                                               AND v.estado <> 'ANULADO' 
                                               AND v.tipo IN ('S02', 'S03', 'S70', 'E05', 'S05') 
                                               AND v.vendedor <> '99' 
                                            GROUP BY v.vendedor) AS v 
                                            ON m.codigo = v.vendedor 
                                            LEFT JOIN 
                                            (SELECT 
                                               cc.vendedor,
                                               SUM(cc.monto) AS cobranza 
                                            FROM
                                               cuenta_ctejf cc 
                                            WHERE YEAR(cc.fecha) = YEAR(NOW()) 
                                               AND MONTH(cc.fecha) = $mes 
                                               AND cc.tip_mov = '-' 
                                               AND cc.cod_pago IN ('00', '05', '06', '14', '80', '82', 'TR') 
                                            GROUP BY cc.vendedor) AS c 
                                            ON m.codigo = c.vendedor 
                                            LEFT JOIN 
                                            (SELECT 
                                               c.vendedor,
                                               SUM(c.saldo) AS saldo 
                                            FROM
                                               cuenta_ctejf c 
                                            WHERE c.tip_mov = '+' 
                                               AND c.estado = 'PENDIENTE' 
                                               AND c.fecha_ven < DATE(NOW()) 
                                            GROUP BY c.vendedor) AS ve 
                                            ON m.codigo = ve.vendedor 
                                            LEFT JOIN 
                                            (SELECT 
                                               c.vendedor,
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2015' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2015',
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2016' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2016',
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2017' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2017',
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2018' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2018',
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2019' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2019',
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2020' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2020',
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2021' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2021',
                                               SUM(
                                                  CASE
                                                  WHEN YEAR(c.fecha_ven) = '2022' 
                                                  THEN c.saldo 
                                                  ELSE 0 
                                                  END
                                               ) AS 'a2022',
                                               SUM(c.saldo) AS total 
                                            FROM
                                               cuenta_ctejf c 
                                            WHERE c.tip_mov = '+' 
                                               AND c.estado = 'PENDIENTE' 
                                               AND c.fecha_ven < DATE(NOW()) 
                                            GROUP BY c.vendedor) AS p 
                                            ON m.codigo = p.vendedor 
                                         WHERE m.tipo_dato = 'TVEND' 
                                            AND (
                                            IFNULL(v.ventas, 0) + IFNULL(c.cobranza, 0) + IFNULL(ve.saldo, 0)
                                            ) > 0 
                                         ORDER BY m.codigo");
  
           $stmt -> execute();
  
           return $stmt -> fetchAll();
  
           $stmt -> close();
  
           $stmt = null;
  
        }
  
      }  
      
      static public function mdlMostrarResumenVtas($mes){

        if( $mes == "null" || $mes == "TODO"){
  
           $stmt = Conexion::conectar()->prepare("SELECT 
           v.tipo,
           v.tipo_documento,
           SUM(v.neto) AS neto,
           SUM(v.igv) AS igv,
           SUM(v.dscto) AS dscto,
           SUM(v.total) AS total 
         FROM
           ventajf v 
         WHERE YEAR(v.fecha) = YEAR(NOW()) 
         AND v.tipo IN ('E05', 'S02', 'S03', 'S70','S05') 
         AND v.vendedor <> '99' 
         GROUP BY v.tipo,
           v.tipo_documento 
         UNION
         SELECT 
           YEAR(v.fecha) AS anno,
           '' AS mes,
           SUM(v.neto) AS neto,
           SUM(v.igv) AS igv,
           SUM(v.dscto) AS dscto,
           SUM(v.total) AS total 
         FROM
           ventajf v 
         WHERE YEAR(v.fecha) = YEAR(NOW()) 
         AND v.tipo IN ('E05', 'S02', 'S03', 'S70','S05') 
         AND v.vendedor <> '99' 
         GROUP BY YEAR(v.fecha)");
  
           $stmt -> execute();
  
           return $stmt -> fetchAll();
  
           $stmt -> close();
  
           $stmt = null;
  
        }else{
  
           $stmt = Conexion::conectar()->prepare("SELECT 
           v.tipo,
           v.tipo_documento,
           SUM(v.neto) AS neto,
           SUM(v.igv) AS igv,
           SUM(v.dscto) AS dscto,
           SUM(v.total) AS total 
         FROM
           ventajf v 
         WHERE YEAR(v.fecha) = YEAR(NOW()) 
           AND MONTH(v.fecha) = $mes 
           AND v.tipo IN ('E05', 'S02', 'S03', 'S70','S05') 
           AND v.vendedor <> '99' 
         GROUP BY v.tipo,
           v.tipo_documento 
         UNION
         SELECT 
           YEAR(v.fecha) AS anno,
           '' AS mes,
           SUM(v.neto) AS neto,
           SUM(v.igv) AS igv,
           SUM(v.dscto) AS dscto,
           SUM(v.total) AS total 
         FROM
           ventajf v 
         WHERE YEAR(v.fecha) = YEAR(NOW()) 
           AND MONTH(v.fecha) = $mes 
           AND v.tipo IN ('E05', 'S02', 'S03', 'S70','S05') 
           AND v.vendedor <> '99' 
         GROUP BY YEAR(v.fecha),
           MONTH(fecha)");
  
           $stmt -> execute();
  
           return $stmt -> fetchAll();
  
           $stmt -> close();
  
           $stmt = null;
  
        }
  
      }          

      static public function mdlMostrarResumenVdor($mes){

        if( $mes == "null" || $mes == "TODO"){
  
           $stmt = Conexion::conectar()->prepare("SELECT 
                          m.codigo,
                          m.descripcion,
                          IFNULL(p.pedidos, 0) AS pedidos,
                          IFNULL(v.ventas, 0) AS ventas,
                          (
                          IFNULL(p.pedidos, 0) + IFNULL(v.ventas, 0)
                          ) AS total 
                       FROM
                          maestrajf m 
                          LEFT JOIN 
                          (SELECT 
                             t.vendedor,
                             SUM(op_gravada) AS pedidos 
                          FROM
                             temporaljf t 
                          WHERE t.estado IN ('APROBADO', 'APT', 'CONFIRMADO') 
                             AND YEAR(t.fecha) = YEAR(NOW()) 
                          GROUP BY t.vendedor) AS p 
                          ON m.codigo = p.vendedor 
                          LEFT JOIN 
                          (SELECT 
                             v.vendedor,
                             SUM(v.neto) AS ventas 
                          FROM
                             ventajf v 
                          WHERE YEAR(v.fecha) = YEAR(NOW()) 
                             AND v.tipo IN ('E05', 'S02', 'S03', 'S70', 'S05') 
                          GROUP BY v.vendedor) AS v 
                          ON m.codigo = v.vendedor 
                       WHERE m.tipo_dato = 'TVEND' 
                          AND (
                          IFNULL(p.pedidos, 0) + IFNULL(v.ventas, 0)
                          ) <> 0 
                          AND m.codigo <> '99'");
  
           $stmt -> execute();
  
           return $stmt -> fetchAll();
  
           $stmt -> close();
  
           $stmt = null;
  
        }else{
  
           $stmt = Conexion::conectar()->prepare("SELECT 
                             m.codigo,
                             m.descripcion,
                             IFNULL(p.pedidos, 0) AS pedidos,
                             IFNULL(v.ventas, 0) AS ventas,
                             (
                             IFNULL(p.pedidos, 0) + IFNULL(v.ventas, 0)
                             ) AS total 
                          FROM
                             maestrajf m 
                             LEFT JOIN 
                             (SELECT 
                                t.vendedor,
                                SUM(op_gravada) AS pedidos 
                             FROM
                                temporaljf t 
                             WHERE t.estado IN ('APROBADO', 'APT', 'CONFIRMADO') 
                                AND YEAR(t.fecha) = YEAR(NOW()) 
                             GROUP BY t.vendedor) AS p 
                             ON m.codigo = p.vendedor 
                             LEFT JOIN 
                             (SELECT 
                                v.vendedor,
                                SUM(v.neto) AS ventas 
                             FROM
                                ventajf v 
                             WHERE YEAR(v.fecha) = YEAR(NOW()) 
                                AND MONTH(v.fecha) =  $mes 
                                AND v.tipo IN ('E05', 'S02', 'S03', 'S70','S05') 
                             GROUP BY v.vendedor) AS v 
                             ON m.codigo = v.vendedor 
                          WHERE m.tipo_dato = 'TVEND' 
                             AND (
                             IFNULL(p.pedidos, 0) + IFNULL(v.ventas, 0)
                             ) <> 0 
                             AND m.codigo <> '99'");
  
           $stmt -> execute();
  
           return $stmt -> fetchAll();
  
           $stmt -> close();
  
           $stmt = null;
  
        }
  
      }       

   /* 
   * sacamos los totales por mes de la  nueva tabla TOTALES
   */
  static public function mldMostrarDias(){

         $stmt = Conexion::conectar()->prepare("SELECT 
                                       t.id,
                                       t.año,
                                       t.mes,
                                       CASE
                                       WHEN t.mes = '1' 
                                       THEN 'ENERO' 
                                       WHEN t.mes = '2' 
                                       THEN 'FEBRERO' 
                                       WHEN t.mes = '3' 
                                       THEN 'MARZO' 
                                       WHEN t.mes = '4' 
                                       THEN 'ABRIL' 
                                       WHEN t.mes = '5' 
                                       THEN 'MAYO' 
                                       WHEN t.mes = '6' 
                                       THEN 'JUNIO' 
                                       WHEN t.mes = '7' 
                                       THEN 'JULIO' 
                                       WHEN t.mes = '8' 
                                       THEN 'AGOSTO' 
                                       WHEN t.mes = '9' 
                                       THEN 'SEPTIEMBRE' 
                                       WHEN t.mes = '10' 
                                       THEN 'OCTUBRE' 
                                       WHEN t.mes = '11' 
                                       THEN 'NOVIEMBRE' 
                                       ELSE 'DICIEMBRE' 
                                       END AS nom_mes,
                                       t.dia,
                                       t.total_ventas,
                                       t.total_produccion,
                                       t.total_ventas_soles,
                                       t.total_pagos_soles,
                                       t.cambio_compra,
                                       t.cambio_venta,
                                       DATE(t.fecha) AS fecha 
                                    FROM
                                       totalesjf t 
                                    WHERE DATE(t.fecha) <= DATE(NOW()) 
                                    AND YEAR(t.fecha) = YEAR(NOW())");

         $stmt -> execute();

         return $stmt -> fetchAll();

         $stmt -> close();

         $stmt = null;

   }        

   /* 
	* Método para actualizar los totales por dia
	*/
	static public function mdlActualizarTipoCambio($compra, $venta, $fecha){
	
		$sql="UPDATE 
                    totalesjf 
                SET
                    cambio_compra = :compra,
                    cambio_venta = :venta 
                WHERE DATE(fecha) = :fecha";

		$stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":compra", $compra, PDO::PARAM_STR);
        $stmt->bindParam(":venta", $venta, PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		
		}else{
		
			return $stmt->errorInfo();
		
		}
		
		$stmt=null;

	}  

	static public function mdlMostrarResumenVtasB($mes){

      if( $mes == "null" || $mes == "TODO"){

         $stmt = Conexion::conectar()->prepare("SELECT 
                        v.tipo,
                        v.tipo_documento,
                        SUM(v.neto) AS neto,
                        SUM(v.igv) AS igv,
                        SUM(v.dscto) AS dscto,
                        SUM(v.total) AS total 
                     FROM
                        ventajf v 
                     WHERE YEAR(v.fecha) = YEAR(NOW()) 
                        AND v.tipo IN ('E05', 'S02', 'S03', 'S05') 
                     GROUP BY v.tipo,
                        v.tipo_documento 
                     ORDER BY v.tipo_documento ");

         $stmt -> execute();

         return $stmt -> fetchAll();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                        v.tipo,
                        v.tipo_documento,
                        SUM(v.neto) AS neto,
                        SUM(v.igv) AS igv,
                        SUM(v.dscto) AS dscto,
                        SUM(v.total) AS total 
                     FROM
                        ventajf v 
                     WHERE YEAR(v.fecha) = YEAR(NOW()) 
                        AND MONTH(v.fecha) = $mes 
                        AND v.tipo IN ('E05', 'S02', 'S03', 'S05') 
                     GROUP BY v.tipo,
                        v.tipo_documento");

         $stmt -> execute();

         return $stmt -> fetchAll();

         $stmt -> close();

         $stmt = null;

      }

	}     

   /* 
   * top 10 de ventas modelos FOTOS
   */
  static public function mdlMovMesFoto(){

   $stmt = Conexion::conectar()->prepare("SELECT 
                     m.modelo,
                     m.nombre,
                     m.imagen,
                     m.vtas_mes_pasado 
                  FROM
                     modelojf m 
                     WHERE m.modelo NOT IN ('10013')
                  ORDER BY m.vtas_mes_pasado DESC 
                  LIMIT 12");

   $stmt -> execute();

   return $stmt -> fetchAll();

   $stmt -> close();

   $stmt = null;

}     

}