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

}