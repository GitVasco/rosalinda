<?php

require_once "conexion.php";

class ModeloAsistencias{

	/*=============================================
	CREAR Asistencia
	=============================================*/

	static public function mdlIngresarAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_trabajador,fecha) VALUES (:id_trabajador,:fecha) ");

		$stmt->bindParam(":id_trabajador", $datos["id_trabajador"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CREAR Asistencia SABADO
	=============================================*/

	static public function mdlIngresarAsistencia2($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_trabajador,minutos,fecha) VALUES (:id_trabajador,:minutos,:fecha) ");

		$stmt->bindParam(":id_trabajador", $datos["id_trabajador"], PDO::PARAM_INT);
		$stmt->bindParam(":minutos", $datos["minutos"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	CREAR Asistencia
	=============================================*/

	static public function mdlIngresarAsistenciaPara($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_asistencia,id_para,tiempo_para) VALUES (:id_asistencia,:id_para,:tiempo_para)");

		$stmt -> bindParam(":id_asistencia", $datos["id_asistencia"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_para", $datos["id_para"], PDO::PARAM_INT);
		$stmt -> bindParam(":tiempo_para", $datos["tiempo_para"], PDO::PARAM_INT);
	
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }

	/*=============================================
	MOSTRAR AsistenciaS
	=============================================*/

	static public function mdlMostrarAsistencias($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT a.*,p.nombre,ap.id as idDetalle,ap.tiempo_para, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra LEFT JOIN asistencia_parajf ap ON a.id=ap.id_asistencia LEFT JOIN parajf p ON ap.id_para=p.id  WHERE a.id = :id");

			$stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare(
				"SELECT a.*,ap.id_asistencia, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra  ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Asistencia
	=============================================*/

	static public function mdlEditarAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET minutos = :minutos , estado_para = 1 WHERE id = :id");

		$stmt -> bindParam(":minutos", $datos["minutos"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

		/*=============================================
	EDITAR Asistencia y para
	=============================================*/

	static public function mdlEditarAsistenciaPara($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tiempo_para = :tiempo_para WHERE id_asistencia = :id_asistencia AND id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":tiempo_para", $datos["tiempo_para"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_asistencia", $datos["id_asistencia"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR Asistencia
	=============================================*/

	static public function mdlEditarExtra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET minutos = :minutos,  horas_extras = :horas_extras WHERE id = :id");

		$stmt -> bindParam(":minutos", $datos["minutos"], PDO::PARAM_INT);
		$stmt -> bindParam(":horas_extras", $datos["horas_extras"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	APROBAR Asistencia
	=============================================*/

	static public function mdlActualizarAsistencia($tabla, $valor1,$valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

		$stmt -> bindParam(":estado", $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor2, PDO::PARAM_INT);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	


	/*=============================================
	MOSTRAR Presente
	=============================================*/

	static public function mdlMostrarPresente($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT DATE(FECHA) as fecha FROM asistenciasjf WHERE DATE(FECHA)= DATE(NOW())");


		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasAsistencias($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT a.*, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT a.*, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra WHERE a.fecha like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT a.*, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra WHERE a.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT a.*, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra WHERE a.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}	

		/*=============================================
	AGREGAR TIEMPO
	=============================================*/

	static public function mdlAgregarTiempo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET minutos = minutos + :minutos WHERE DATE(fecha) = :fecha");

		$stmt -> bindParam(":minutos", $datos["minutos"], PDO::PARAM_INT);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

			/*=============================================
	QUITAR TIEMPO
	=============================================*/

	static public function mdlQuitarTiempo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET minutos = minutos - :minutos WHERE DATE(fecha) = :fecha");

		$stmt -> bindParam(":minutos", $datos["minutos"], PDO::PARAM_INT);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
    
}
    