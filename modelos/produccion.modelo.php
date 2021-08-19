<?php

require_once "conexion.php";

class ModeloProduccion
{

	/* 
	* MOSTRAR PRODUCCION
	*/
	static public function mdlMostrarQuincenas($valor){

		if ($valor != null) {

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                            q.id,
                                                            q.ano,
                                                            m.mes,
                                                            q.mes AS nmes,
                                                            q.quincena AS nquincena,
                                                            CASE
                                                            WHEN q.quincena = '1' 
                                                            THEN '1ra Quincena' 
                                                            ELSE '2da Quincena' 
                                                            END AS quincena,
                                                            q.inicio,
                                                            q.fin,
                                                            u.nombre,
                                                            q.fecha_creacion 
                                                        FROM
                                                            quincenasjf q 
                                                            LEFT JOIN usuariosjf u 
                                                            ON q.usuario = u.id 
                                                            LEFT JOIN 
                                                            (SELECT DISTINCT 
                                                                codigo,
                                                                descripcion AS mes 
                                                            FROM
                                                                meses) AS m 
                                                            ON q.mes = m.codigo 
                                                        WHERE q.id = :valor");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT 
                                            q.id,
                                            q.ano,
                                            CASE
                                              WHEN q.mes = '1' 
                                              THEN 'Enero' 
                                              WHEN q.mes = '2' 
                                              THEN 'Febrero' 
                                              WHEN q.mes = '3' 
                                              THEN 'Marzo' 
                                              WHEN q.mes = '4' 
                                              THEN 'Abril' 
                                              WHEN q.mes = '5' 
                                              THEN 'Mayo' 
                                              WHEN q.mes = '6' 
                                              THEN 'Junio' 
                                              WHEN q.mes = '7' 
                                              THEN 'Julio' 
                                              WHEN q.mes = '8' 
                                              THEN 'Agosto' 
                                              WHEN q.mes = '9' 
                                              THEN 'Septiembre' 
                                              WHEN q.mes = '10' 
                                              THEN 'Octubre' 
                                              WHEN q.mes = '11' 
                                              THEN 'Noviembre' 
                                              ELSE 'Diciembre' 
                                            END AS mes,
                                            q.mes AS nmes,
                                            q.quincena AS nquincena,
                                            CASE
                                              WHEN q.quincena = '1' 
                                              THEN '1ra Quincena' 
                                              ELSE '2da Quincena' 
                                            END AS quincena,
                                            q.inicio,
                                            q.fin,
                                            u.nombre,
                                            q.fecha_creacion 
                                          FROM
                                            quincenasjf q 
                                            LEFT JOIN usuariosjf u 
                                              ON q.usuario = u.id");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
    }

	/*
	* CREAR QUINCENA
	*/
	static public function mdlCrearQuincenas($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO quincenasjf (
                                                ano,
                                                mes,
                                                quincena,
                                                inicio,
                                                fin,
                                                usuario
                                            ) 
                                            VALUES
                                                (
                                                :ano,
                                                :mes,
                                                :quincena,
                                                :inicio,
                                                :fin,
                                                :usuario
                                                )");

		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
		$stmt->bindParam(":quincena", $datos["quincena"], PDO::PARAM_STR);
		$stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fin", $datos["fin"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
    }
    
	static public function mdlEditarQuincenas($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    quincenasjf 
                                                SET
                                                    ano = :ano,
                                                    mes = :mes,
                                                    quincena = :quincena,
                                                    inicio = :inicio,
                                                    fin = :fin,
                                                    usuario = :usuario 
                                                WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
        $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
        $stmt->bindParam(":quincena", $datos["quincena"], PDO::PARAM_STR);
        $stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fin", $datos["fin"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }    

  /*
	* Método para la eficiencia por mes
	*/
	static public function mdlMostrarEficiencia($inicio, $fin, $nquincena, $id,$sector){
      if($sector != "null"){

        if($nquincena == "1"){
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '2' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d2,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '3' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d3,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '4' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d4,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '5' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d5,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '6' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d6,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '7' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d7,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '8' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d8,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '9' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d9,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '10' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d10,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '11' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d11,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '12' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d12,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
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
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio
          AND :fin
        AND t.sector = '".$sector."'
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);

          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else{
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '17' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d17,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '18' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d18,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '19' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d19,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '20' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d20,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '21' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d21,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '22' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d22,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '23' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d23,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '24' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d24,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '25' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d25,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '26' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d26,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '27' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d27,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
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
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
          AND :fin 
        AND t.sector = '".$sector."'
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    
          $stmt->execute();
          
          return $stmt->fetchAll();
    
        }
      }else{

        if($nquincena == "1"){
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '2' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d2,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '3' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d3,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '4' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d4,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '5' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d5,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '6' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d6,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '7' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d7,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '8' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d8,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '9' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d9,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '10' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d10,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '11' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d11,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '12' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d12,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
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
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio
          AND :fin
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);

          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else{
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '17' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d17,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '18' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d18,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '19' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d19,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '20' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d20,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '21' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d21,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '22' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d22,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '23' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d23,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '24' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d24,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '25' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d25,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '26' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d26,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '27' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d27,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
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
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
          AND :fin 
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    
          $stmt->execute();
          
          return $stmt->fetchAll();
    
        }

      }
    
          $stmt=null;
    
      }
      
  /*
	* Método para los pagos por mes
	*/
	static public function mdlMostrarPagos($inicio, $fin, $nquincena, $id,$sector){
    if($sector != "null"){
      if($nquincena == "1"){

        $sql="SELECT 
              et.trabajador,
              CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '1' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d1,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '2' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d2,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '3' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d3,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '4' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d4,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '5' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d5,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '6' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d6,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '7' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d7,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '8' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d8,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '9' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d9,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '10' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d10,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '11' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d11,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '12' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d12,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '13' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d13,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '14' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d14,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '15' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d15,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '16' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d16,
              SUM(
              CASE
                WHEN DAY(fecha_terminado) = '27' 
                THEN et.total_precio 
                ELSE 0 
              END
              ) AS d27,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '28' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d28,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '29' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d29,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '30' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d30,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '31' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d31,
              SUM(et.total_precio) AS total,
              (t.sueldo_total/2) as sueldo_total
            FROM
              entallerjf et 
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
                WHERE et.trabajador IS NOT NULL 
                AND (a.fecha BETWEEN :inicio
                  AND :fin
                )) AS asi 
                ON et.trabajador = asi.trabajador 
                AND DATE(fecha_terminado) = asi.fecha 
              LEFT JOIN trabajadorjf t 
                ON et.trabajador = t.cod_tra,
              (SELECT 
                inicio,
                fin 
              FROM
                quincenasjf q 
              WHERE q.id = :id) AS q 
            WHERE DATE(et.fecha_terminado) BETWEEN :inicio
              AND :fin
            AND t.sector = '".$sector."'
            GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        
        $stmt->execute();
  
        return $stmt->fetchAll();
  
      }else{
  
        $sql="SELECT 
                et.trabajador,
                CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '1' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d1,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '12' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d12,                
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '13' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d13,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '14' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d14,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '15' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d15,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '16' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d16,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '17' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d17,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '18' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d18,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '19' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d19,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '20' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d20,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '21' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d21,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '22' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d22,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '23' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d23,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '24' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d24,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '25' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d25,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '26' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d26,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '27' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d27,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '28' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d28,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '29' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d29,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '30' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d30,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '31' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d31,
                SUM(et.total_precio) AS total,
                (t.sueldo_total/2) as sueldo_total
              FROM
                entallerjf et 
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
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra,
                (SELECT 
                  inicio,
                  fin 
                FROM
                  quincenasjf q 
                WHERE q.id = :id) AS q 
              WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
                AND :fin 
              AND t.sector = '".$sector."'
              GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  
        $stmt->execute();
        
        return $stmt->fetchAll();
  
      }
    }else{
      if($nquincena == "1"){

        $sql="SELECT 
              et.trabajador,
              CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '1' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d1,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '2' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d2,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '3' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d3,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '4' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d4,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '5' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d5,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '6' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d6,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '7' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d7,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '8' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d8,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '9' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d9,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '10' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d10,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '11' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d11,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '12' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d12,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '13' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d13,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '14' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d14,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '15' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d15,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '16' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d16,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '27' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d27,              
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '28' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d28,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '29' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d29,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '30' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d30,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '31' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d31,
              SUM(et.total_precio) AS total,
              (t.sueldo_total/2) as sueldo_total
            FROM
              entallerjf et 
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
                WHERE et.trabajador IS NOT NULL
                AND (a.fecha BETWEEN :inicio
                  AND :fin
                )) AS asi 
                ON et.trabajador = asi.trabajador 
                AND DATE(fecha_terminado) = asi.fecha 
              LEFT JOIN trabajadorjf t 
                ON et.trabajador = t.cod_tra,
              (SELECT 
                inicio,
                fin 
              FROM
                quincenasjf q 
              WHERE q.id = :id) AS q 
            WHERE DATE(et.fecha_terminado) BETWEEN :inicio
              AND :fin
            GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        
        $stmt->execute();
  
        return $stmt->fetchAll();
  
      }else{
  
        $sql="SELECT 
                et.trabajador,
                CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '1' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d1,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '12' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d12,                
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '13' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d13,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '14' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d14,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '15' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d15,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '16' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d16,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '17' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d17,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '18' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d18,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '19' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d19,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '20' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d20,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '21' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d21,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '22' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d22,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '23' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d23,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '24' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d24,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '25' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d25,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '26' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d26,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '27' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d27,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '28' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d28,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '29' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d29,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '30' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d30,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '31' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d31,
                SUM(et.total_precio) AS total,
                (t.sueldo_total/2) as sueldo_total
              FROM
                entallerjf et 
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
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra,
                (SELECT 
                  inicio,
                  fin 
                FROM
                  quincenasjf q 
                WHERE q.id = :id) AS q 
              WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
                AND :fin 
              GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  
        $stmt->execute();
        
        return $stmt->fetchAll();
  
      }

    }
    

      $stmt=null;

  }      

	/* 
	* BORRAR QUINCENA
	*/
	static public function mdlEliminarQuincena($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM quincenasjf WHERE id = :id ");

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);

		if ($stmt->execute()) {

      return "ok";
      
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}  
    
}