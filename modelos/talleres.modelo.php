<?php
require_once "conexion.php";

class ModeloTalleres{

    /*
	* Método para mostrar talleres en general
	*/
	static public function mdlMostrarTalleresG($valor){

        if($valor == null){

            $stmt = Conexion::conectar()->prepare("SELECT 
                                                            et.id,
                                                            et.sector,
                                                            CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                            et.articulo,
                                                            a.modelo,
                                                            a.nombre,
                                                            a.color,
                                                            a.talla,
                                                            et.cod_operacion,
                                                            o.nombre AS nom_operacion,
                                                            et.trabajador AS cod_trabajador,
                                                            CONCAT(
                                                            t.nom_tra,
                                                            ' ',
                                                            t.ape_pat_tra,
                                                            ' ',
                                                            t.ape_mat_tra
                                                            ) AS trabajador,
                                                            et.cantidad,
                                                            DATE(et.fecha) AS fecha,
                                                            et.estado,
                                                            et.codigo 
                                                        FROM
                                                            entallerjf et 
                                                            LEFT JOIN trabajadorjf t 
                                                            ON et.trabajador = t.cod_tra 
                                                            LEFT JOIN articulojf a 
                                                            ON et.articulo = a.articulo 
                                                            LEFT JOIN operacionesjf o 
                                                            ON et.cod_operacion = o.codigo 
                                                            LEFT JOIN sectorjf s 
                                                            ON et.sector = s.cod_sector");

			$stmt -> execute();

			return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT t.*,
            a.marca,
            a.modelo,
            a.nombre,
            a.color,
            a.talla,
            o.nombre AS nom_operacion
        FROM
          entallerjf  t
          LEFT JOIN articulojf a
          ON a.articulo = t.articulo
          LEFT JOIN operacionesjf o 
          ON t.cod_operacion = o.codigo 
          WHERE t.codigo='$valor'");

			$stmt->execute();

			return $stmt->fetch();

        }

		$stmt -> close();

		$stmt = null;


    }

    /*
	* Método para mostrar talleres en proceso
	*/
	static public function mdlMostrarTalleresP(){

            $stmt = Conexion::conectar()->prepare("SELECT 
            et.codigo,
            CONCAT(et.sector, '-', s.nom_sector) AS sector,
            CONCAT(
              t.nom_tra,
              ' ',
              t.ape_pat_tra,
              ' ',
              t.ape_mat_tra
            ) AS trabajador,
            CONCAT(et.cod_operacion, ' - ', o.nombre) AS operacion,
            CONCAT(a.modelo, ' - ', a.color, ' -T', a.talla) AS articulo,
            et.cantidad,
            et.estado,
            DATE_FORMAT(et.fecha_proceso, '%H:%i') AS hora_proceso 
          FROM
            entallerjf et 
            LEFT JOIN trabajadorjf t 
              ON et.trabajador = t.cod_tra 
            LEFT JOIN articulojf a 
              ON et.articulo = a.articulo 
            LEFT JOIN operacionesjf o 
              ON et.cod_operacion = o.codigo 
            LEFT JOIN sectorjf s 
              ON et.sector = s.cod_sector 
          WHERE et.estado = 2 
          ORDER BY et.fecha_proceso DESC 
          LIMIT 5");

			$stmt -> execute();

			return $stmt -> fetchAll();

            $stmt -> close();

            $stmt = null;


    }
    
    /*
	* Método para mostrar talleres en terminado
	*/
	static public function mdlMostrarTalleresT(){

        $stmt = Conexion::conectar()->prepare("SELECT 
                                                        et.codigo,
                                                        CONCAT(et.sector, '-', s.nom_sector) AS sector,
                                                        CONCAT(
                                                        t.nom_tra,
                                                        ' ',
                                                        t.ape_pat_tra,
                                                        ' ',
                                                        t.ape_mat_tra
                                                        ) AS trabajador,
                                                        CONCAT(et.cod_operacion, ' - ', o.nombre) AS operacion,
                                                        CONCAT(a.modelo, ' - ', a.color, ' -T', a.talla) AS articulo,
                                                        et.cantidad,
                                                        et.estado,
                                                        DATE_FORMAT(et.fecha_terminado, '%H:%i') AS hora_termino 
                                                    FROM
                                                        entallerjf et 
                                                        LEFT JOIN trabajadorjf t 
                                                        ON et.trabajador = t.cod_tra 
                                                        LEFT JOIN articulojf a 
                                                        ON et.articulo = a.articulo 
                                                        LEFT JOIN operacionesjf o 
                                                        ON et.cod_operacion = o.codigo 
                                                        LEFT JOIN sectorjf s 
                                                        ON et.sector = s.cod_sector 
                                                    WHERE et.estado = 3 
                                                    ORDER BY et.fecha_terminado DESC 
                                                    LIMIT 5");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;


    }

        /*
	* Método para mostrar talleres en terminado
	*/
	static public function mdlMostrarTalleresTerminado(){

    $stmt = Conexion::conectar()->prepare("SELECT 
                                                      et.id,
                                                      et.sector,
                                                      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                      et.articulo,
                                                      a.modelo,
                                                      a.nombre,
                                                      a.color,
                                                      a.talla,
                                                      et.cod_operacion,
                                                      o.nombre AS nom_operacion,
                                                      et.trabajador AS cod_trabajador,
                                                      CONCAT(
                                                        t.nom_tra,
                                                        ' ',
                                                        t.ape_pat_tra,
                                                        ' ',
                                                        t.ape_mat_tra
                                                      ) AS trabajador,
                                                      et.cantidad,
                                                      DATE(et.fecha) AS fecha,
                                                      et.estado,
                                                      et.codigo 
                                                    FROM
                                                      entallerjf et 
                                                      LEFT JOIN trabajadorjf t 
                                                        ON et.trabajador = t.cod_tra 
                                                      LEFT JOIN articulojf a 
                                                        ON et.articulo = a.articulo 
                                                      LEFT JOIN operacionesjf o 
                                                        ON et.cod_operacion = o.codigo 
                                                      LEFT JOIN sectorjf s 
                                                        ON et.sector = s.cod_sector 
                                                    WHERE et.estado = '3'");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;


}
    
    /* 
    *ACTUALIZAR EN PROCESO
    */
	static public function mdlProceso($fecha, $codigo, $trabajador){

		$sql="UPDATE entallerjf SET fecha_proceso='$fecha', estado='2', trabajador= '$trabajador'  WHERE codigo='$codigo'";

		$stmt=Conexion::conectar()->prepare($sql);

        if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;

    }
    
    /* 
    *ACTUALIZAR TERMINADO
    */
	static public function mdlTerminado($fecha, $codigo, $trabajador){

		$sql="UPDATE entallerjf SET fecha_terminado='$fecha', estado='3', trabajador= '$trabajador' WHERE codigo='$codigo'";

		$stmt=Conexion::conectar()->prepare($sql);

        if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;

  }
  
    /* 
    *ASIGNAR TRABAJADOR
    */
    static public function mdlAsignarTrabajador( $datos){

      $sql="UPDATE 
                entallerjf 
              SET
                trabajador= :trabajador,
                fecha_proceso = :fecha_proceso,
                fecha_terminado = :fecha_terminado
              WHERE codigo = :codigo";
  
      $stmt=Conexion::conectar()->prepare($sql);
      $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
      $stmt -> bindParam(":trabajador", $datos["trabajador"], PDO::PARAM_STR);
      $stmt -> bindParam(":fecha_proceso", $datos["fecha_proceso"], PDO::PARAM_STR);
      $stmt -> bindParam(":fecha_terminado", $datos["fecha_terminado"], PDO::PARAM_STR);
      if($stmt->execute()){
  
        return "ok";
      
      }else{
  
        return "error";
      
      }
  
      $stmt=null;
  
    }  

  
	/*=============================================
	ELIMINAR TALLER
	=============================================*/

	static public function mdlEliminarTaller($tabla,$datos){

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

  static public function mdlEliminarTallerGenerado($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id AND estado = '1'");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

  }    
  
  	/*=============================================
	ELIMINAR TALLER DETALLE
	=============================================*/

	static public function mdlEliminarTallerDetalle($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cabecera = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

  }    
  
	/*=============================================
	CREAR TALLER
	=============================================*/

	static public function mdlIngresarTaller($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO entallerjf (
      id_cabecera,
      articulo,
      cod_operacion,
      cantidad,
      usuario,
      total_precio,
      total_tiempo,
      codigo
  ) 
  (SELECT 
      :codigo,
      a.articulo,
      od.cod_operacion,
      :cantidad,
      :usuario,
      ((od.precio_doc) / 12) * :cantidad,
      ((od.tiempo_stand) / 60) * :cantidad,
      :editarBarra 
  FROM
      articulojf a 
      LEFT JOIN operaciones_detallejf od 
      ON a.modelo = od.modelo 
  WHERE articulo = :articulo AND cod_operacion= :operacion)");

    $stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
    $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
    $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":editarBarra", $datos["editarBarra"], PDO::PARAM_STR);
    $stmt->bindParam(":operacion", $datos["operacion"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}   

    
	/*=============================================
	CREAR TALLER
	=============================================*/

	static public function mdlIngresarTallerTerminado($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO entallerjf (
      id_cabecera,
      articulo,
      cod_operacion,
      cantidad,
      usuario,
      total_precio,
      total_tiempo,
      codigo,
      trabajador,
      fecha_proceso,
      fecha_terminado,
      estado
  ) 
  (SELECT 
      :codigo,
      a.articulo,
      od.cod_operacion,
      :cantidad,
      :usuario,
      ((od.precio_doc) / 12) * :cantidad,
      ((od.tiempo_stand) / 60) * :cantidad,
      :editarBarra,
      :trabajador,
      :fecha_proceso,
      :fecha_terminado,
      3 
  FROM
      articulojf a 
      LEFT JOIN operaciones_detallejf od 
      ON a.modelo = od.modelo 
  WHERE articulo = :articulo AND cod_operacion= :operacion)");

    $stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
    $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
    $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":editarBarra", $datos["editarBarra"], PDO::PARAM_STR);
    $stmt->bindParam(":operacion", $datos["operacion"], PDO::PARAM_STR);
    $stmt->bindParam(":trabajador", $datos["trabajador"], PDO::PARAM_STR);
    $stmt->bindParam(":fecha_proceso", $datos["fecha_proceso"], PDO::PARAM_STR);
    $stmt->bindParam(":fecha_terminado", $datos["fecha_terminado"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}   
  /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasTalleres($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT et.id,
      et.sector,
      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
      et.articulo,
      a.modelo,
      a.nombre,
      a.color,
      a.talla,
      et.fecha_terminado,
      et.cod_operacion,
      o.nombre AS nom_operacion,
      et.trabajador AS cod_trabajador,
      CONCAT(
      t.nom_tra,
      ' ',
      t.ape_pat_tra,
      ' ',
      t.ape_mat_tra
      ) AS trabajador,
      et.cantidad,
      DATE(et.fecha) AS fecha,
      et.estado,
      et.codigo 
  FROM
      entallerjf et 
      LEFT JOIN trabajadorjf t 
      ON et.trabajador = t.cod_tra 
      LEFT JOIN articulojf a 
      ON et.articulo = a.articulo 
      LEFT JOIN operacionesjf o 
      ON et.cod_operacion = o.codigo 
      LEFT JOIN sectorjf s 
      ON et.sector = s.cod_sector ORDER BY et.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT et.id,
      et.sector,
      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
      et.articulo,
      a.modelo,
      a.nombre,
      a.color,
      a.talla,
      et.fecha_terminado,
      et.cod_operacion,
      o.nombre AS nom_operacion,
      et.trabajador AS cod_trabajador,
      CONCAT(
      t.nom_tra,
      ' ',
      t.ape_pat_tra,
      ' ',
      t.ape_mat_tra
      ) AS trabajador,
      et.cantidad,
      DATE(et.fecha) AS fecha,
      et.estado,
      et.codigo 
  FROM
      entallerjf et 
      LEFT JOIN trabajadorjf t 
      ON et.trabajador = t.cod_tra 
      LEFT JOIN articulojf a 
      ON et.articulo = a.articulo 
      LEFT JOIN operacionesjf o 
      ON et.cod_operacion = o.codigo 
      LEFT JOIN sectorjf s 
      ON et.sector = s.cod_sector  WHERE et.fecha like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT et.id,
        et.sector,
        CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
        et.articulo,
        a.modelo,
        a.nombre,
        a.color,
        a.talla,
        et.cod_operacion,
        et.fecha_terminado,
        o.nombre AS nom_operacion,
        et.trabajador AS cod_trabajador,
        CONCAT(
        t.nom_tra,
        ' ',
        t.ape_pat_tra,
        ' ',
        t.ape_mat_tra
        ) AS trabajador,
        et.cantidad,
        DATE(et.fecha) AS fecha,
        et.estado,
        et.codigo 
    FROM
        entallerjf et 
        LEFT JOIN trabajadorjf t 
        ON et.trabajador = t.cod_tra 
        LEFT JOIN articulojf a 
        ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
        ON et.cod_operacion = o.codigo 
        LEFT JOIN sectorjf s 
        ON et.sector = s.cod_sector WHERE et.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT et.id,
        et.sector,
        CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
        et.articulo,
        a.modelo,
        a.nombre,
        a.color,
        a.talla,
        et.fecha_terminado,
        et.cod_operacion,
        o.nombre AS nom_operacion,
        et.trabajador AS cod_trabajador,
        CONCAT(
        t.nom_tra,
        ' ',
        t.ape_pat_tra,
        ' ',
        t.ape_mat_tra
        ) AS trabajador,
        et.cantidad,
        DATE(et.fecha) AS fecha,
        et.estado,
        et.codigo 
    FROM
        entallerjf et 
        LEFT JOIN trabajadorjf t 
        ON et.trabajador = t.cod_tra 
        LEFT JOIN articulojf a 
        ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
        ON et.cod_operacion = o.codigo 
        LEFT JOIN sectorjf s 
        ON et.sector = s.cod_sector WHERE et.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

  }	

  /* 
	* MOSTRAR MESES
	*/
	static public function mdlMes(){

    $stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                                codigo,
                                descripcion 
                              FROM
                                meses m WHERE ano='2020'");

    $stmt -> execute();

    return $stmt -> fetchAll();
  }
  /*=============================================
	RANGO FECHAS TERMINADOS
	=============================================*/	

	static public function mdlRangoFechasTalleresTerminados($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT 
      et.id,
      et.sector,
      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
      et.articulo,
      a.modelo,
      a.nombre,
      a.color,
      a.talla,
      et.cod_operacion,
      o.nombre AS nom_operacion,
      et.trabajador AS cod_trabajador,
      et.fecha_proceso,
      et.fecha_terminado,
      CONCAT(
        t.nom_tra,
        ' ',
        t.ape_pat_tra,
        ' ',
        t.ape_mat_tra
      ) AS trabajador,
      et.cantidad,
      DATE(et.fecha) AS fecha,
      et.estado,
      et.codigo,
      TIMESTAMPDIFF(
    MINUTE,
    et.fecha_proceso,
    et.fecha_terminado
  )  AS tiempo_real 
    FROM
      entallerjf et 
      LEFT JOIN trabajadorjf t 
        ON et.trabajador = t.cod_tra 
      LEFT JOIN articulojf a 
        ON et.articulo = a.articulo 
      LEFT JOIN operacionesjf o 
        ON et.cod_operacion = o.codigo 
      LEFT JOIN sectorjf s 
        ON et.sector = s.cod_sector 
    WHERE et.estado = '3' ORDER BY et.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT 
      et.id,
      et.sector,
      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
      et.articulo,
      a.modelo,
      a.nombre,
      a.color,
      a.talla,
      et.cod_operacion,
      o.nombre AS nom_operacion,
      et.trabajador AS cod_trabajador,
      et.fecha_proceso,
      et.fecha_terminado,
      CONCAT(
        t.nom_tra,
        ' ',
        t.ape_pat_tra,
        ' ',
        t.ape_mat_tra
      ) AS trabajador,
      et.cantidad,
      DATE(et.fecha) AS fecha,
      et.estado,
      et.codigo,
      TIMESTAMPDIFF(
    MINUTE,
    et.fecha_proceso,
    et.fecha_terminado
  ) AS tiempo_real 
    FROM
      entallerjf et 
      LEFT JOIN trabajadorjf t 
        ON et.trabajador = t.cod_tra 
      LEFT JOIN articulojf a 
        ON et.articulo = a.articulo 
      LEFT JOIN operacionesjf o 
        ON et.cod_operacion = o.codigo 
      LEFT JOIN sectorjf s 
        ON et.sector = s.cod_sector 
    WHERE et.estado = '3' AND  DATE(et.fecha_terminado) like '%$fechaFinal%'");

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
        et.id,
        et.sector,
        CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
        et.articulo,
        a.modelo,
        a.nombre,
        a.color,
        a.talla,
        et.cod_operacion,
        o.nombre AS nom_operacion,
        et.trabajador AS cod_trabajador,
        et.fecha_proceso,
        et.fecha_terminado,
        CONCAT(
          t.nom_tra,
          ' ',
          t.ape_pat_tra,
          ' ',
          t.ape_mat_tra
        ) AS trabajador,
        et.cantidad,
        DATE(et.fecha) AS fecha,
        et.estado,
        et.codigo,
      TIMESTAMPDIFF(
    MINUTE,
    et.fecha_proceso,
    et.fecha_terminado
  )  AS tiempo_real 
      FROM
        entallerjf et 
        LEFT JOIN trabajadorjf t 
          ON et.trabajador = t.cod_tra 
        LEFT JOIN articulojf a 
          ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
          ON et.cod_operacion = o.codigo 
        LEFT JOIN sectorjf s 
          ON et.sector = s.cod_sector 
      WHERE et.estado = '3' AND DATE(et.fecha_terminado) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT 
        et.id,
        et.sector,
        CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
        et.articulo,
        a.modelo,
        a.nombre,
        a.color,
        a.talla,
        et.cod_operacion,
        o.nombre AS nom_operacion,
        et.trabajador AS cod_trabajador,
        et.fecha_proceso,
        et.fecha_terminado,
        CONCAT(
          t.nom_tra,
          ' ',
          t.ape_pat_tra,
          ' ',
          t.ape_mat_tra
        ) AS trabajador,
        et.cantidad,
        DATE(et.fecha) AS fecha,
        et.estado,
        et.codigo,
      TIMESTAMPDIFF(
    MINUTE,
    et.fecha_proceso,
    et.fecha_terminado
  )  AS tiempo_real 
      FROM
        entallerjf et 
        LEFT JOIN trabajadorjf t 
          ON et.trabajador = t.cod_tra 
        LEFT JOIN articulojf a 
          ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
          ON et.cod_operacion = o.codigo 
        LEFT JOIN sectorjf s 
          ON et.sector = s.cod_sector 
      WHERE et.estado = '3' AND DATE(et.fecha_terminado) BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}	
  static public function mdlVerTalleresTerminado($valor){

    $stmt = Conexion::conectar()->prepare("SELECT 
                                                      et.id,
                                                      et.sector,
                                                      et.fecha_proceso,
                                                      et.fecha_terminado,
                                                      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                      et.articulo,
                                                      a.modelo,
                                                      a.nombre,
                                                      a.color,
                                                      a.talla,
                                                      et.cod_operacion,
                                                      o.nombre AS nom_operacion,
                                                      et.trabajador AS cod_trabajador,
                                                      CONCAT(
                                                        t.nom_tra,
                                                        ' ',
                                                        t.ape_pat_tra,
                                                        ' ',
                                                        t.ape_mat_tra
                                                      ) AS trabajador,
                                                      et.cantidad,
                                                      DATE(et.fecha) AS fecha,
                                                      et.estado,
                                                      et.codigo 
                                                    FROM
                                                      entallerjf et 
                                                      LEFT JOIN trabajadorjf t 
                                                        ON et.trabajador = t.cod_tra 
                                                      LEFT JOIN articulojf a 
                                                        ON et.articulo = a.articulo 
                                                      LEFT JOIN operacionesjf o 
                                                        ON et.cod_operacion = o.codigo 
                                                      LEFT JOIN sectorjf s 
                                                        ON et.sector = s.cod_sector 
                                                    WHERE et.estado = '3' AND et.id= $valor");

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

}  
  
  /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlMostrarProduccionTrusas($fechaInicial,$fechaFinal){

    if($fechaInicial=="null"){

      $sql="SELECT 
                et.fecha_terminado,
                m.descripcion AS mes,
                MONTH(et.fecha_terminado) AS terminado,
                DAY(et.fecha_terminado) AS fecha,
                et.trabajador AS cod_trab,
                tt.nom_tip_trabajador,
                CONCAT(t.nom_tra) AS trabajador,
                et.cod_operacion,
                o.nombre,
                a.modelo,
                a.cod_color,
                a.color,
                a.nombre AS des_modelo,
                SUM(
                  CASE
                    WHEN a.cod_talla = '1' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t1,
                SUM(
                  CASE
                    WHEN a.cod_talla = '2' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t2,
                SUM(
                  CASE
                    WHEN a.cod_talla = '3' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t3,
                SUM(
                  CASE
                    WHEN a.cod_talla = '4' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t4,
                SUM(
                  CASE
                    WHEN a.cod_talla = '5' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t5,
                SUM(
                  CASE
                    WHEN a.cod_talla = '6' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t6,
                SUM(
                  CASE
                    WHEN a.cod_talla = '7' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t7,
                SUM(
                  CASE
                    WHEN a.cod_talla = '8' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t8,
                SUM(cantidad) AS total,
                SUM(total_precio) AS total_precio,
                SUM(total_tiempo) AS total_tiempo,
                asi.minutos,
                (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
              FROM
                entallerjf et 
                LEFT JOIN articulojf a 
                  ON et.articulo = a.articulo 
                LEFT JOIN operacionesjf o 
                  ON et.cod_operacion = o.codigo 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN tipo_trabajadorjf tt 
                  ON t.cod_tip_tra = tt.cod_tip_tra 
                LEFT JOIN modelojf m 
                  ON a.modelo = m.modelo 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    codigo,
                    descripcion 
                  FROM
                    meses m WHERE ano='2020') m 
                  ON MONTH(et.fecha_terminado) = m.codigo 
              WHERE et.estado = '3' 
                AND m.tipo NOT IN ('brasier')
                AND m.modelo NOT IN ('10013') 
                AND MONTH(et.fecha_terminado) = MONTH(NOW()) 
              GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),
                et.trabajador,
                et.cod_operacion,
                a.modelo,
                a.color 
              ORDER BY DATE(et.fecha_terminado) DESC,
                et.trabajador,
                cod_color";

      $stmt=Conexion::conectar()->prepare($sql);
      
      $stmt->execute();

      return $stmt->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $sql="SELECT 
                et.fecha_terminado,
                m.descripcion AS mes,
                MONTH(et.fecha_terminado) AS terminado,
                DAY(et.fecha_terminado) AS fecha,
                et.trabajador AS cod_trab,
                tt.nom_tip_trabajador,
                CONCAT(t.nom_tra) AS trabajador,
                et.cod_operacion,
                o.nombre,
                a.modelo,
                a.cod_color,
                a.color,
                a.nombre AS des_modelo,
                SUM(
                  CASE
                    WHEN a.cod_talla = '1' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t1,
                SUM(
                  CASE
                    WHEN a.cod_talla = '2' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t2,
                SUM(
                  CASE
                    WHEN a.cod_talla = '3' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t3,
                SUM(
                  CASE
                    WHEN a.cod_talla = '4' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t4,
                SUM(
                  CASE
                    WHEN a.cod_talla = '5' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t5,
                SUM(
                  CASE
                    WHEN a.cod_talla = '6' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t6,
                SUM(
                  CASE
                    WHEN a.cod_talla = '7' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t7,
                SUM(
                  CASE
                    WHEN a.cod_talla = '8' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t8,
                SUM(cantidad) AS total,
                SUM(total_precio) AS total_precio,
                SUM(total_tiempo) AS total_tiempo,
                asi.minutos,
                (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
              FROM
                entallerjf et 
                LEFT JOIN articulojf a 
                  ON et.articulo = a.articulo 
                LEFT JOIN operacionesjf o 
                  ON et.cod_operacion = o.codigo 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN tipo_trabajadorjf tt 
                  ON t.cod_tip_tra = tt.cod_tip_tra 
                LEFT JOIN modelojf m 
                  ON a.modelo = m.modelo 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    codigo,
                    descripcion 
                  FROM
                    meses m WHERE ano='2020') m 
                  ON MONTH(et.fecha_terminado) = m.codigo 
              WHERE et.estado = '3' 
                AND m.tipo NOT IN ('brasier') 
                AND DATE(et.fecha_terminado) like '%$fechaFinal%'
                GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),
              et.trabajador,
                      et.cod_operacion,
                a.modelo,
                a.color 
              ORDER BY DATE(et.fecha_terminado) DESC,
                et.trabajador,
                cod_color";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();
      
      return $stmt->fetchAll();

    }else{
      $fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){
        $sql="SELECT 
        et.fecha_terminado,
        m.descripcion AS mes,
        MONTH(et.fecha_terminado) AS terminado,
        DAY(et.fecha_terminado) AS fecha,
        et.trabajador AS cod_trab,
        tt.nom_tip_trabajador,
        CONCAT(t.nom_tra) AS trabajador,
        et.cod_operacion,
        o.nombre,
        a.modelo,
        a.cod_color,
        a.color,
        a.nombre AS des_modelo,
        SUM(
          CASE
            WHEN a.cod_talla = '1' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t1,
        SUM(
          CASE
            WHEN a.cod_talla = '2' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t2,
        SUM(
          CASE
            WHEN a.cod_talla = '3' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t3,
        SUM(
          CASE
            WHEN a.cod_talla = '4' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t4,
        SUM(
          CASE
            WHEN a.cod_talla = '5' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t5,
        SUM(
          CASE
            WHEN a.cod_talla = '6' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t6,
        SUM(
          CASE
            WHEN a.cod_talla = '7' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t7,
        SUM(
          CASE
            WHEN a.cod_talla = '8' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t8,
        SUM(cantidad) AS total,
        SUM(total_precio) AS total_precio,
        SUM(total_tiempo) AS total_tiempo,
        asi.minutos,
        (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
      FROM
        entallerjf et 
        LEFT JOIN articulojf a 
          ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
          ON et.cod_operacion = o.codigo 
        LEFT JOIN trabajadorjf t 
          ON et.trabajador = t.cod_tra 
        LEFT JOIN 
          (SELECT DISTINCT 
            et.trabajador,
            DATE(a.fecha) AS fecha,
            a.minutos 
          FROM
            asistenciasjf a 
            LEFT JOIN entallerjf et 
              ON a.id_trabajador = et.trabajador 
              AND DATE(a.fecha) = DATE(et.fecha_terminado) 
          WHERE et.trabajador IS NOT NULL) AS asi 
          ON et.trabajador = asi.trabajador 
          AND DATE(fecha_terminado) = asi.fecha 
        LEFT JOIN tipo_trabajadorjf tt 
          ON t.cod_tip_tra = tt.cod_tip_tra 
        LEFT JOIN modelojf m 
          ON a.modelo = m.modelo 
        LEFT JOIN 
          (SELECT DISTINCT 
            codigo,
            descripcion 
          FROM
            meses m WHERE ano='2020') m 
          ON MONTH(et.fecha_terminado) = m.codigo 
          WHERE et.estado = '3' 
            AND m.tipo NOT IN ('brasier') 
            AND DATE(et.fecha_terminado) BETWEEN '$fechaInicial' AND '$fechaFinal'
            GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),
           et.trabajador,
                  et.cod_operacion,
            a.modelo,
            a.color 
          ORDER BY DATE(et.fecha_terminado) DESC,
            et.trabajador,
            cod_color";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetchAll();

      }else{

        $sql="SELECT 
        et.fecha_terminado,
        m.descripcion AS mes,
        MONTH(et.fecha_terminado) AS terminado,
        DAY(et.fecha_terminado) AS fecha,
        et.trabajador AS cod_trab,
        tt.nom_tip_trabajador,
        CONCAT(t.nom_tra) AS trabajador,
        et.cod_operacion,
        o.nombre,
        a.modelo,
        a.cod_color,
        a.color,
        a.nombre AS des_modelo,
        SUM(
          CASE
            WHEN a.cod_talla = '1' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t1,
        SUM(
          CASE
            WHEN a.cod_talla = '2' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t2,
        SUM(
          CASE
            WHEN a.cod_talla = '3' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t3,
        SUM(
          CASE
            WHEN a.cod_talla = '4' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t4,
        SUM(
          CASE
            WHEN a.cod_talla = '5' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t5,
        SUM(
          CASE
            WHEN a.cod_talla = '6' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t6,
        SUM(
          CASE
            WHEN a.cod_talla = '7' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t7,
        SUM(
          CASE
            WHEN a.cod_talla = '8' 
            THEN et.cantidad 
            ELSE 0 
          END
        ) AS t8,
        SUM(cantidad) AS total,
        SUM(total_precio) AS total_precio,
        SUM(total_tiempo) AS total_tiempo,
        asi.minutos,
        (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
      FROM
        entallerjf et 
        LEFT JOIN articulojf a 
          ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
          ON et.cod_operacion = o.codigo 
        LEFT JOIN trabajadorjf t 
          ON et.trabajador = t.cod_tra 
        LEFT JOIN 
          (SELECT DISTINCT 
            et.trabajador,
            DATE(a.fecha) AS fecha,
            a.minutos 
          FROM
            asistenciasjf a 
            LEFT JOIN entallerjf et 
              ON a.id_trabajador = et.trabajador 
              AND DATE(a.fecha) = DATE(et.fecha_terminado) 
          WHERE et.trabajador IS NOT NULL) AS asi 
          ON et.trabajador = asi.trabajador 
          AND DATE(fecha_terminado) = asi.fecha 
        LEFT JOIN tipo_trabajadorjf tt 
          ON t.cod_tip_tra = tt.cod_tip_tra 
        LEFT JOIN modelojf m 
          ON a.modelo = m.modelo 
        LEFT JOIN 
          (SELECT DISTINCT 
            codigo,
            descripcion 
          FROM
            meses m WHERE ano='2020') m 
          ON MONTH(et.fecha_terminado) = m.codigo 
          WHERE et.estado = '3' 
            AND m.tipo NOT IN ('brasier') 
            AND DATE(et.fecha_terminado) BETWEEN '$fechaInicial' AND '$fechaFinal'
            GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),
          et.trabajador,
                  et.cod_operacion,
            a.modelo,
            a.color 
          ORDER BY DATE(et.fecha_terminado) DESC,
            et.trabajador,
            cod_color";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }

    }

      $stmt=null;

  }

  /*
	* Método para mostrar produccion de brasier
	*/
	static public function mdlMostrarProduccionBrasier($fechaInicial,$fechaFinal){

    if($fechaInicial=="null"){

      $sql="SELECT 
                et.fecha_terminado,
                m.descripcion AS mes,
                MONTH(et.fecha_terminado) AS terminado,
                DAY(et.fecha_terminado) AS fecha,
                et.trabajador AS cod_trab,
                tt.nom_tip_trabajador,
                CONCAT(t.nom_tra) AS trabajador,
                et.cod_operacion,
                o.nombre,
                a.modelo,
                a.cod_color,
                a.color,
                a.nombre AS des_modelo,
                SUM(
                  CASE
                    WHEN a.cod_talla = '1' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t1,
                SUM(
                  CASE
                    WHEN a.cod_talla = '2' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t2,
                SUM(
                  CASE
                    WHEN a.cod_talla = '3' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t3,
                SUM(
                  CASE
                    WHEN a.cod_talla = '4' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t4,
                SUM(
                  CASE
                    WHEN a.cod_talla = '5' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t5,
                SUM(
                  CASE
                    WHEN a.cod_talla = '6' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t6,
                SUM(
                  CASE
                    WHEN a.cod_talla = '7' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t7,
                SUM(
                  CASE
                    WHEN a.cod_talla = '8' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t8,
                SUM(cantidad) AS total,
                SUM(total_precio) AS total_precio,
                SUM(total_tiempo) AS total_tiempo,
                asi.minutos,
                (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
              FROM
                entallerjf et 
                LEFT JOIN articulojf a 
                  ON et.articulo = a.articulo 
                LEFT JOIN operacionesjf o 
                  ON et.cod_operacion = o.codigo 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN tipo_trabajadorjf tt 
                  ON t.cod_tip_tra = tt.cod_tip_tra 
                LEFT JOIN modelojf m 
                  ON a.modelo = m.modelo 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    codigo,
                    descripcion 
                  FROM
                    meses m WHERE ano='2020') m 
                  ON MONTH(et.fecha_terminado) = m.codigo 
              WHERE et.estado = '3' 
                AND (m.tipo = 'brasier'
                  OR a.modelo IN ('10013'))
                AND MONTH(et.fecha_terminado) = MONTH(NOW()) 
              GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),
                et.trabajador,
                et.cod_operacion,
                a.modelo,
                a.color 
              ORDER BY DATE(et.fecha_terminado) DESC,
                et.trabajador,
                cod_color";

      $stmt=Conexion::conectar()->prepare($sql);
      
      $stmt->execute();

      return $stmt->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $sql="SELECT 
                et.fecha_terminado,
                m.descripcion AS mes,
                MONTH(et.fecha_terminado) AS terminado,
                DAY(et.fecha_terminado) AS fecha,
                et.trabajador AS cod_trab,
                tt.nom_tip_trabajador,
                CONCAT(t.nom_tra) AS trabajador,
                et.cod_operacion,
                o.nombre,
                a.modelo,
                a.cod_color,
                a.color,
                a.nombre AS des_modelo,
                SUM(
                  CASE
                    WHEN a.cod_talla = '1' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t1,
                SUM(
                  CASE
                    WHEN a.cod_talla = '2' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t2,
                SUM(
                  CASE
                    WHEN a.cod_talla = '3' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t3,
                SUM(
                  CASE
                    WHEN a.cod_talla = '4' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t4,
                SUM(
                  CASE
                    WHEN a.cod_talla = '5' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t5,
                SUM(
                  CASE
                    WHEN a.cod_talla = '6' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t6,
                SUM(
                  CASE
                    WHEN a.cod_talla = '7' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t7,
                SUM(
                  CASE
                    WHEN a.cod_talla = '8' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t8,
                SUM(cantidad) AS total,
                SUM(total_precio) AS total_precio,
                SUM(total_tiempo) AS total_tiempo,
                asi.minutos,
                (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
              FROM
                entallerjf et 
                LEFT JOIN articulojf a 
                  ON et.articulo = a.articulo 
                LEFT JOIN operacionesjf o 
                  ON et.cod_operacion = o.codigo 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN tipo_trabajadorjf tt 
                  ON t.cod_tip_tra = tt.cod_tip_tra 
                LEFT JOIN modelojf m 
                  ON a.modelo = m.modelo 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    codigo,
                    descripcion 
                  FROM
                    meses m WHERE ano='2020') m 
                  ON MONTH(et.fecha_terminado) = m.codigo 
              WHERE et.estado = '3' 
                AND (m.tipo = 'brasier'
                  OR a.modelo IN ('10013'))
                AND DATE(et.fecha_terminado) like '%$fechaFinal%'
                GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),              
                et.trabajador,
                et.cod_operacion,
                a.modelo,
                a.color 
              ORDER BY DATE(et.fecha_terminado) DESC,
                et.trabajador,
                cod_color";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();
      
      return $stmt->fetchAll();
                
    }else{
       $fechaActual = new DateTime();
      	$fechaActual ->add(new DateInterval("P1D"));
      	$fechaActualMasUno = $fechaActual->format("Y-m-d");

      	$fechaFinal2 = new DateTime($fechaFinal);
      	$fechaFinal2 ->add(new DateInterval("P1D"));
      	$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        	if($fechaFinalMasUno == $fechaActualMasUno){
          $sql="SELECT 
          et.fecha_terminado,
          m.descripcion AS mes,
          MONTH(et.fecha_terminado) AS terminado,
          DAY(et.fecha_terminado) AS fecha,
          et.trabajador AS cod_trab,
          tt.nom_tip_trabajador,
          CONCAT(t.nom_tra) AS trabajador,
          et.cod_operacion,
          o.nombre,
          a.modelo,
          a.cod_color,
          a.color,
          a.nombre AS des_modelo,
          SUM(
            CASE
              WHEN a.cod_talla = '1' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t1,
          SUM(
            CASE
              WHEN a.cod_talla = '2' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t2,
          SUM(
            CASE
              WHEN a.cod_talla = '3' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t3,
          SUM(
            CASE
              WHEN a.cod_talla = '4' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t4,
          SUM(
            CASE
              WHEN a.cod_talla = '5' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t5,
          SUM(
            CASE
              WHEN a.cod_talla = '6' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t6,
          SUM(
            CASE
              WHEN a.cod_talla = '7' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t7,
          SUM(
            CASE
              WHEN a.cod_talla = '8' 
              THEN et.cantidad 
              ELSE 0 
            END
          ) AS t8,
          SUM(cantidad) AS total,
          SUM(total_precio) AS total_precio,
          SUM(total_tiempo) AS total_tiempo,
          asi.minutos,
          (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
        FROM
          entallerjf et 
          LEFT JOIN articulojf a 
            ON et.articulo = a.articulo 
          LEFT JOIN operacionesjf o 
            ON et.cod_operacion = o.codigo 
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra 
          LEFT JOIN 
            (SELECT DISTINCT 
              et.trabajador,
              DATE(a.fecha) AS fecha,
              a.minutos 
            FROM
              asistenciasjf a 
              LEFT JOIN entallerjf et 
                ON a.id_trabajador = et.trabajador 
                AND DATE(a.fecha) = DATE(et.fecha_terminado) 
            WHERE et.trabajador IS NOT NULL) AS asi 
            ON et.trabajador = asi.trabajador 
            AND DATE(fecha_terminado) = asi.fecha 
          LEFT JOIN tipo_trabajadorjf tt 
            ON t.cod_tip_tra = tt.cod_tip_tra 
          LEFT JOIN modelojf m 
            ON a.modelo = m.modelo 
          LEFT JOIN 
            (SELECT DISTINCT 
              codigo,
              descripcion 
            FROM
              meses m WHERE ano='2020') m 
            ON MONTH(et.fecha_terminado) = m.codigo 
        WHERE et.estado = '3' 
              AND (m.tipo = 'brasier'
                  OR a.modelo IN ('10013')) AND
          DATE(et.fecha_terminado) BETWEEN '$fechaInicial' AND '$fechaFinal'
          GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),   
        et.trabajador,
          et.cod_operacion,
          a.modelo,
          a.color 
        ORDER BY DATE(et.fecha_terminado) DESC,
          et.trabajador,
          cod_color";

    $stmt=Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetchAll();
      }else{
      $sql="SELECT 
            et.fecha_terminado,
            m.descripcion AS mes,
            MONTH(et.fecha_terminado) AS terminado,
            DAY(et.fecha_terminado) AS fecha,
            et.trabajador AS cod_trab,
            tt.nom_tip_trabajador,
            CONCAT(t.nom_tra) AS trabajador,
            et.cod_operacion,
            o.nombre,
            a.modelo,
            a.cod_color,
            a.color,
            a.nombre AS des_modelo,
            SUM(
              CASE
                WHEN a.cod_talla = '1' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t1,
            SUM(
              CASE
                WHEN a.cod_talla = '2' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t2,
            SUM(
              CASE
                WHEN a.cod_talla = '3' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t3,
            SUM(
              CASE
                WHEN a.cod_talla = '4' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t4,
            SUM(
              CASE
                WHEN a.cod_talla = '5' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t5,
            SUM(
              CASE
                WHEN a.cod_talla = '6' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t6,
            SUM(
              CASE
                WHEN a.cod_talla = '7' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t7,
            SUM(
              CASE
                WHEN a.cod_talla = '8' 
                THEN et.cantidad 
                ELSE 0 
              END
            ) AS t8,
            SUM(cantidad) AS total,
            SUM(total_precio) AS total_precio,
            SUM(total_tiempo) AS total_tiempo,
            asi.minutos,
            (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
          FROM
            entallerjf et 
            LEFT JOIN articulojf a 
              ON et.articulo = a.articulo 
            LEFT JOIN operacionesjf o 
              ON et.cod_operacion = o.codigo 
            LEFT JOIN trabajadorjf t 
              ON et.trabajador = t.cod_tra 
            LEFT JOIN 
              (SELECT DISTINCT 
                et.trabajador,
                DATE(a.fecha) AS fecha,
                a.minutos 
              FROM
                asistenciasjf a 
                LEFT JOIN entallerjf et 
                  ON a.id_trabajador = et.trabajador 
                  AND DATE(a.fecha) = DATE(et.fecha_terminado) 
              WHERE et.trabajador IS NOT NULL) AS asi 
              ON et.trabajador = asi.trabajador 
              AND DATE(fecha_terminado) = asi.fecha 
            LEFT JOIN tipo_trabajadorjf tt 
              ON t.cod_tip_tra = tt.cod_tip_tra 
            LEFT JOIN modelojf m 
              ON a.modelo = m.modelo 
            LEFT JOIN 
              (SELECT DISTINCT 
                codigo,
                descripcion 
              FROM
                meses m WHERE ano='2020') m 
              ON MONTH(et.fecha_terminado) = m.codigo 
          WHERE et.estado = '3' 
                  AND (m.tipo = 'brasier'
                  OR a.modelo IN ('10013'))
            DATE(et.fecha_terminado) BETWEEN '$fechaInicial' AND '$fechaFinal'
            GROUP BY MONTH(et.fecha_terminado),
                DAY(et.fecha_terminado),   
          et.trabajador,
            et.cod_operacion,
            a.modelo,
            a.color 
          ORDER BY DATE(et.fecha_terminado) DESC,
            et.trabajador,
            cod_color";
  
      $stmt=Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
  
      $stmt->execute();
  
      return $stmt->fetchAll();
      }

    
    }

      $stmt=null;

  }  

  /*
	* Método para mostrar produccion de vasco
	*/
	static public function mdlMostrarProduccionVasco($mes){

    if($mes=="null"){

      $sql="SELECT 
                m.descripcion AS mes,
                MONTH(et.fecha_terminado) AS terminado,
                DAY(et.fecha_terminado) AS fecha,
                et.trabajador AS cod_trab,
                tt.nom_tip_trabajador,
                CONCAT(t.nom_tra) AS trabajador,
                et.cod_operacion,
                o.nombre,
                a.modelo,
                a.cod_color,
                a.color,
                a.nombre AS des_modelo,
                SUM(
                  CASE
                    WHEN a.cod_talla = '1' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t1,
                SUM(
                  CASE
                    WHEN a.cod_talla = '2' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t2,
                SUM(
                  CASE
                    WHEN a.cod_talla = '3' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t3,
                SUM(
                  CASE
                    WHEN a.cod_talla = '4' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t4,
                SUM(
                  CASE
                    WHEN a.cod_talla = '5' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t5,
                SUM(
                  CASE
                    WHEN a.cod_talla = '6' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t6,
                SUM(
                  CASE
                    WHEN a.cod_talla = '7' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t7,
                SUM(
                  CASE
                    WHEN a.cod_talla = '8' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t8,
                SUM(cantidad) AS total,
                SUM(total_precio) AS total_precio,
                SUM(total_tiempo) AS total_tiempo,
                asi.minutos,
                (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
              FROM
                entallerjf et 
                LEFT JOIN articulojf a 
                  ON et.articulo = a.articulo 
                LEFT JOIN operacionesjf o 
                  ON et.cod_operacion = o.codigo 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN tipo_trabajadorjf tt 
                  ON t.cod_tip_tra = tt.cod_tip_tra 
                LEFT JOIN modelojf m 
                  ON a.modelo = m.modelo 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    codigo,
                    descripcion 
                  FROM
                    meses m WHERE ano='2020') m 
                  ON MONTH(et.fecha_terminado) = m.codigo 
              WHERE et.estado = '3' 
                AND MONTH(et.fecha_terminado) = MONTH(NOW())
                AND a.marca = 'vasco'  
              GROUP BY et.trabajador,
                et.cod_operacion,
                a.modelo,
                a.color 
              ORDER BY DATE(et.fecha_terminado) DESC,
                et.trabajador,
                cod_color";

      $stmt=Conexion::conectar()->prepare($sql);
      
      $stmt->execute();

      return $stmt->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $sql="SELECT 
                m.descripcion AS mes,
                MONTH(et.fecha_terminado) AS terminado,
                DAY(et.fecha_terminado) AS fecha,
                et.trabajador AS cod_trab,
                tt.nom_tip_trabajador,
                CONCAT(t.nom_tra) AS trabajador,
                et.cod_operacion,
                o.nombre,
                a.modelo,
                a.cod_color,
                a.color,
                a.nombre AS des_modelo,
                SUM(
                  CASE
                    WHEN a.cod_talla = '1' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t1,
                SUM(
                  CASE
                    WHEN a.cod_talla = '2' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t2,
                SUM(
                  CASE
                    WHEN a.cod_talla = '3' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t3,
                SUM(
                  CASE
                    WHEN a.cod_talla = '4' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t4,
                SUM(
                  CASE
                    WHEN a.cod_talla = '5' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t5,
                SUM(
                  CASE
                    WHEN a.cod_talla = '6' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t6,
                SUM(
                  CASE
                    WHEN a.cod_talla = '7' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t7,
                SUM(
                  CASE
                    WHEN a.cod_talla = '8' 
                    THEN et.cantidad 
                    ELSE 0 
                  END
                ) AS t8,
                SUM(cantidad) AS total,
                SUM(total_precio) AS total_precio,
                SUM(total_tiempo) AS total_tiempo,
                asi.minutos,
                (SUM(total_tiempo) / asi.minutos) * 100 AS eficiencia 
              FROM
                entallerjf et 
                LEFT JOIN articulojf a 
                  ON et.articulo = a.articulo 
                LEFT JOIN operacionesjf o 
                  ON et.cod_operacion = o.codigo 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN tipo_trabajadorjf tt 
                  ON t.cod_tip_tra = tt.cod_tip_tra 
                LEFT JOIN modelojf m 
                  ON a.modelo = m.modelo 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    codigo,
                    descripcion 
                  FROM
                    meses m WHERE ano='2020') m 
                  ON MONTH(et.fecha_terminado) = m.codigo 
              WHERE et.estado = '3' 
                AND MONTH(et.fecha_terminado) = :mes
                AND a.marca = 'vasco'  
              GROUP BY et.trabajador,
                et.cod_operacion,
                a.modelo,
                a.color 
              ORDER BY DATE(et.fecha_terminado) DESC,
                et.trabajador,
                cod_color";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();
      
      return $stmt->fetchAll();

    }

      $stmt=null;

  }    

  /*=============================================
	MOSTRAR TALLER CABECERA
	=============================================*/

	static public function mdlMostrarTallerCabecera($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT t.*,a.color,a.talla FROM $tabla  t LEFT JOIN articulojf a ON a.articulo = t.articulo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

  /*=============================================
	MOSTRAR TALLER CABECERA
	=============================================*/

	static public function mdlMostrarSelectTaller($valor){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                              t.*,
                                              a.color,
                                              a.talla 
                                            FROM
                                              entaller_cabjf t 
                                              LEFT JOIN articulojf a 
                                                ON a.articulo = t.articulo 
                                            WHERE SUBSTRING(t.fecha,1,10) = '$valor'");


			$stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

		  $stmt = null;

      
    }

    static public function mdlMostrarTalleresGenerados($articuloTaller){

      if($articuloTaller != "null"){
          $stmt = Conexion::conectar()->prepare("SELECT 
                                                          et.id,
                                                          et.fecha,
                                                          et.sector,
                                                          CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                          et.articulo,
                                                          a.modelo,
                                                          a.nombre,
                                                          a.color,
                                                          a.talla,
                                                          et.cod_operacion,
                                                          o.nombre AS nom_operacion,
                                                          et.trabajador AS cod_trabajador,
                                                          CONCAT(
                                                            t.nom_tra,
                                                            ' ',
                                                            t.ape_pat_tra,
                                                            ' ',
                                                            t.ape_mat_tra
                                                          ) AS trabajador,
                                                          et.cantidad,
                                                          DATE(et.fecha) AS fecha,
                                                          et.estado,
                                                          et.codigo 
                                                        FROM
                                                          entallerjf et 
                                                          LEFT JOIN trabajadorjf t 
                                                            ON et.trabajador = t.cod_tra 
                                                          LEFT JOIN articulojf a 
                                                            ON et.articulo = a.articulo 
                                                          LEFT JOIN operacionesjf o 
                                                            ON et.cod_operacion = o.codigo 
                                                          LEFT JOIN sectorjf s 
                                                            ON et.sector = s.cod_sector 
                                                        WHERE et.estado = '1' AND
                                                        et.articulo = '".$articuloTaller."'
                                                        AND et.total_precio > 0");
    
        $stmt -> execute();
    
        return $stmt -> fetchAll();
      }else{

        $stmt = Conexion::conectar()->prepare("SELECT 
                                                          et.id,
                                                          et.fecha,
                                                          et.sector,
                                                          CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                          et.articulo,
                                                          a.modelo,
                                                          a.nombre,
                                                          a.color,
                                                          a.talla,
                                                          et.cod_operacion,
                                                          o.nombre AS nom_operacion,
                                                          et.trabajador AS cod_trabajador,
                                                          CONCAT(
                                                            t.nom_tra,
                                                            ' ',
                                                            t.ape_pat_tra,
                                                            ' ',
                                                            t.ape_mat_tra
                                                          ) AS trabajador,
                                                          et.cantidad,
                                                          DATE(et.fecha) AS fecha,
                                                          et.estado,
                                                          et.codigo 
                                                        FROM
                                                          entallerjf et 
                                                          LEFT JOIN trabajadorjf t 
                                                            ON et.trabajador = t.cod_tra 
                                                          LEFT JOIN articulojf a 
                                                            ON et.articulo = a.articulo 
                                                          LEFT JOIN operacionesjf o 
                                                            ON et.cod_operacion = o.codigo 
                                                          LEFT JOIN sectorjf s 
                                                            ON et.sector = s.cod_sector 
                                                        WHERE et.estado = '1'
                                                        AND et.total_precio > 0");
    
        $stmt -> execute();
    
        return $stmt -> fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
  }

  static public function mdlMostrarTalleresGenerados2($codigoTaller){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                                      et.id,
                                                      et.fecha,
                                                      et.sector,
                                                      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                      et.articulo,
                                                      a.modelo,
                                                      a.nombre,
                                                      a.color,
                                                      a.talla,
                                                      et.cod_operacion,
                                                      o.nombre AS nom_operacion,
                                                      et.trabajador AS cod_trabajador,
                                                      CONCAT(
                                                        t.nom_tra,
                                                        ' ',
                                                        t.ape_pat_tra,
                                                        ' ',
                                                        t.ape_mat_tra
                                                      ) AS trabajador,
                                                      et.cantidad,
                                                      DATE(et.fecha) AS fecha,
                                                      et.estado,
                                                      et.codigo 
                                                    FROM
                                                      entallerjf et 
                                                      LEFT JOIN trabajadorjf t 
                                                        ON et.trabajador = t.cod_tra 
                                                      LEFT JOIN articulojf a 
                                                        ON et.articulo = a.articulo 
                                                      LEFT JOIN operacionesjf o 
                                                        ON et.cod_operacion = o.codigo 
                                                      LEFT JOIN sectorjf s 
                                                        ON et.sector = s.cod_sector 
                                                    WHERE et.codigo = '".$codigoTaller."'
                                                    AND et.total_precio > 0");

    $stmt -> execute();

    return $stmt -> fetch();
    

    $stmt -> close();

    $stmt = null;


}

  /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasTalleresOperaciones($modelo){

		if($modelo != "null"){
      $stmt = Conexion::conectar()->prepare("SELECT 
      et.id,
      et.sector,
      et.articulo,
      a.modelo,
      a.nombre,
      a.color,
      a.talla,
      et.cod_operacion,
      o.nombre AS nom_operacion,
      et.cantidad,
      DATE(et.fecha) AS fecha,
      et.estado,
      et.codigo 
    FROM
      entallerjf et 
      LEFT JOIN articulojf a 
        ON et.articulo = a.articulo 
      LEFT JOIN operacionesjf o 
        ON et.cod_operacion = o.codigo 
    WHERE et.estado = 1 
      AND (
        o.nombre LIKE '%atraque x%' 
        OR o.nombre LIKE '%unir el%' 
        OR o.nombre LIKE '%pegar et%' 
        OR o.nombre LIKE '%pegar elastico a c%' 
        OR o.nombre LIKE '%PEGAR TIRANTE ESPALDA x4%' 
        OR o.nombre LIKE '%PEGAR TIRANTE DELANTERO X2%' 
        OR o.nombre LIKE '%ATRAQUE TIRANTE X2%'
      ) AND a.modelo = '".$modelo."'
      ORDER BY et.articulo ASC");
			

			$stmt -> execute();

			return $stmt -> fetchAll();	



			}else{

        $stmt = Conexion::conectar()->prepare("SELECT 
        et.id,
        et.sector,
        et.articulo,
        a.modelo,
        a.nombre,
        a.color,
        a.talla,
        et.cod_operacion,
        o.nombre AS nom_operacion,
        et.cantidad,
        DATE(et.fecha) AS fecha,
        et.estado,
        et.codigo 
      FROM
        entallerjf et 
        LEFT JOIN articulojf a 
          ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
          ON et.cod_operacion = o.codigo 
      WHERE et.estado = 1 
        AND (
          o.nombre LIKE '%atraque x%' 
          OR o.nombre LIKE '%unir el%' 
          OR o.nombre LIKE '%pegar et%' 
          OR o.nombre LIKE '%pegar elastico a c%' 
          OR o.nombre LIKE '%PEGAR TIRANTE ESPALDA x4%' 
          OR o.nombre LIKE '%PEGAR TIRANTE DELANTERO X2%' 
          OR o.nombre LIKE '%ATRAQUE TIRANTE X2%'
         ) 
        ORDER BY et.articulo ASC");
				
        $stmt -> execute();

        return $stmt -> fetchAll();
			}
		
      $stmt -> close();
  
      $stmt = null;

    }
    
    static public function mdlActualizarTallerT($valor1, $valor2){

      $sql = " UPDATE 
                  entallerjf 
                SET
                  fecha_proceso = NULL,
                  fecha_terminado = NULL,
                  trabajador=0,
                  estado = :estado
                WHERE codigo = :valor";
  
      $stmt = Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":estado", $valor1, PDO::PARAM_STR);
      $stmt->bindParam(":valor", $valor2, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";

      } else {
  
        return "error";
      }
  
      $stmt = null;
    
  }
  
  static public function mdlMesB($mes){

    $stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                                codigo,
                                descripcion 
                              FROM
                                meses m WHERE ano='2020' AND codigo=$mes");

    $stmt -> execute();

    return $stmt -> fetch();
  }  

    
}