<?php

require_once "conexion.php";

class ModeloTarjetas{

	/* 
	* Método para mostrar las tarjetas
	*/
	static public function mdlMostrarTarjetas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT t.*,a.modelo FROM $tabla t LEFT JOIN articulojf a 
			ON t.articulo = a.articulo WHERE t.$item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT       t.id,
                                                                t.codigo,
                                                                t.articulo,
                                                                t.usuario,
                                                                u.nombre as nom_usu,
																t.impuesto,
																t.neto,
                                                                t.total,
                                                                t.estado AS estado_tarjeta,
                                                                DATE(t.fecha) AS fecha,
                                                                a.id as id_articulo,
                                                                a.articulo,
                                                                m.marca,
                                                                a.modelo,
                                                                a.nombre,
                                                                a.cod_color,
                                                                a.color,
                                                                a.cod_talla,
                                                                a.talla,
                                                                CONCAT(a.color,' - ',a.talla) AS packing,
                                                                a.estado AS estado_articulo 
                                                            FROM 
                                                                $tabla t
                                                                LEFT JOIN articulojf a 
                                                                    ON t.articulo = a.articulo
                                                                LEFT JOIN marcasjf m
                                                                    ON a.id_marca=m.id
                                                                LEFT JOIN usuariosjf u
                                                                    ON t.usuario=u.id  
                                                            ORDER BY t.codigo DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	/* 
	* Método para Mostrar los detalles de tarjetas
	*/
	static public function mdlMostraDetallesTarjetas($tabla,$item,$valor){

		$sql="SELECT * FROM $tabla WHERE $item=:$item ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/* 
	* Método para guardar las tarjetas
	*/
	static public function mdlGuardarTarjetas($tabla,$datos){

		$sql="INSERT INTO $tabla(codigo,articulo,usuario,impuesto,neto,total,estado) VALUES (:codigo,:articulo,:usuario,:impuesto,:neto,:total,:estado)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
		$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	
	/* 
	* Método para guardar detalle de las tarjetas
	*/
	static public function mdlGuardarDetallesTarjeta($tabla,$datos){

		$sql="INSERT INTO $tabla(articulo,mat_pri,tej_princ,consumo,precio_mp,total_detalle) VALUES (:articulo,:mat_pri,:tej_princ,:consumo,:precio_mp,:total_detalle)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":mat_pri",$datos["mat_pri"],PDO::PARAM_STR);
		$stmt->bindParam(":tej_princ",$datos["tej_princ"],PDO::PARAM_STR);
		$stmt->bindParam(":consumo",$datos["consumo"],PDO::PARAM_INT);
		$stmt->bindParam(":precio_mp",$datos["precio_mp"],PDO::PARAM_STR);
		$stmt->bindParam(":total_detalle",$datos["total_detalle"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}

	/* 
	* Método para guardar el tejido principal
	*/
	static public function mdlActualizarTP($tablaT, $valorT1, $valorT2){

		$sql="UPDATE $tablaT SET tej_princ='si' WHERE articulo=:articulo AND mat_pri=:mat_pri";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo",$valorT1,PDO::PARAM_STR);
		$stmt->bindParam(":mat_pri",$valorT2,PDO::PARAM_STR);

		$stmt->execute();

		$stmt=null;



	}
	
    /* 
	* Método para pedir último Id de tarjeta
	*/	
	static public function mdlUltimoIdTarjeta($tabla){
		$sql="SELECT * FROM $tabla ORDER BY id DESC LIMIT 1";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
		return $stmt->fetchAll();

		$stmt=null;
	}

	/* 
	* Método para sacar el ultimo id de la tarjeta
	*/	
	static public function mdlUltimoCodigoTarjeta(){

		$sql="SELECT 
		MAX(t.codigo) AS ultimo_codigo
		FROM
		  tarjetasjf t";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
		return $stmt->fetchAll();

		$stmt=null;


	}
       
	/* 
	* Método para editar las tarjetas  
	*/
	static public function mdlEditarTarjetas($tabla,$datos){

		$sql="UPDATE $tabla SET usuario=:usuario, impuesto=:impuesto, neto=:neto, total=:total, lastUpdate=:lastUpdate WHERE articulo=:articulo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
		$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":lastUpdate",$datos["lastUpdate"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
	}
	
	/* 
	* Método para eliminar los detalles de la tarjeta
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
	* Método para eliminar la tarjeta
	*/
	static public function mdlEliminarTarjeta($tabla, $datos){

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
	
	/* 
	* Método par aactivar o revisar tarjetas
	*/
	static public function mdlActualizarTarjeta($tabla,$item1,$valor1,$item2,$valor2,$item3,$valor3){
	
		$sql="UPDATE $tabla SET $item1=:$item1, $item3=:$item3 WHERE $item2=:$item2";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":".$item2,$valor2,PDO::PARAM_INT);
		$stmt->bindParam(":".$item3,$valor3,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		
		}else{
		
			return "error";
		
		}
		
		$stmt=null;


	}
	
	/* 
	* Método para vizualizar cabecera tarjeta
	*/
	static public function mdlVisualizarTarjeta($tabla, $item, $valor){

		$sql="SELECT DISTINCT 
								t.articulo,
								CONCAT(
									a.modelo,
									' - ',
									a.nombre,
									' - ',
									a.color,
									' - ',
									a.talla
									) AS descripcion,
								DATE(t.fecha) AS fecha,
								t.neto,
								CASE
									WHEN t.estado = 're' 
									THEN 'REVISAR' 
									ELSE 'APROBADO' 
								END AS estadoTarjeta,
								tp.descripcionMP 
							FROM
								$tabla t 
								LEFT JOIN articulojf a 
									ON t.articulo = a.articulo 
								LEFT JOIN 
								(SELECT 
									dt.articulo,
									dt.mat_pri,
									dt.tej_princ,
									mp.descripcionMP 
								FROM
									detalles_tarjetajf dt 
									LEFT JOIN 
									(SELECT DISTINCT 
										p.Codpro,
										CONCAT(p.DesPro, ' - ', tb.Des_Larga) AS descripcionMP 
									FROM
										producto AS p,
										Tabla_M_Detalle AS tb 
									WHERE tb.Cod_Tabla IN ('TCOL') 
										AND tb.Cod_Argumento = p.ColPro) AS mp 
									ON dt.mat_pri = mp.codpro 
								WHERE $item = :$item
									AND tej_princ = 'si') AS tp 
								ON t.articulo = tp.articulo 
							WHERE t.$item = :$item";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}

	/* 
	* Método para vizualizar detalle tarjeta
	*/
	static public function mdlVisualizarTarjetaDetalle($tabla, $item, $valor){

		$sql="SELECT 
						dt.mat_pri,
						mp.descripcionMP,
						mp.unidad,
						ROUND(dt.consumo, 6) AS consumo,
						CASE
							WHEN dt.tej_princ='no' THEN ''
							ELSE 'SI'
						END AS tej_princ,
						ROUND(dt.precio_mp, 6) AS precio_mp,
						ROUND(dt.total_detalle, 6) AS total_detalle 
					FROM
						$tabla dt 
						LEFT JOIN 
						(SELECT DISTINCT 
							p.Codpro,
							CONCAT(p.DesPro, ' - ', tb.Des_Larga) AS descripcionMP,
							tb2.Des_Corta AS unidad 
						FROM
							producto AS p,
							Tabla_M_Detalle AS tb,
							Tabla_M_Detalle AS tb2 
						WHERE tb.Cod_Tabla IN ('TCOL') 
							AND tb2.Cod_Tabla IN ('TUND') 
							AND tb.Cod_Argumento = p.ColPro 
							AND tb2.Cod_Argumento = p.UndPro) AS mp 
						ON dt.mat_pri = mp.codpro 
					WHERE dt.$item = :$item";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	
	/*=============================================
	MOSTRAR FICHAS TECNICA
	=============================================*/

	static public function mdlMostrarFichasTecnicas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT f.*,t.codigo as codigotarjeta,a.modelo FROM $tabla f LEFT JOIN tarjetasjf t ON f.idtarjeta = t.id LEFT JOIN articulojf a ON t.articulo = a.articulo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CREAR PARA
	=============================================*/

	static public function mdlIngresarFichaTecnica($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,archivo,idtarjeta,idusuario) VALUES (:codigo,:archivo,:idtarjeta,:idusuario)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);
		$stmt->bindParam(":idtarjeta", $datos["idtarjeta"], PDO::PARAM_STR);
		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);

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

	static public function mdlRangoFechasFichas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT f.*,t.codigo as codigotarjeta,a.modelo FROM $tabla f LEFT JOIN tarjetasjf t ON f.idtarjeta = t.id LEFT JOIN articulojf a ON t.articulo = a.articulo ORDER BY f.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT f.*,t.codigo as codigotarjeta,a.modelo FROM $tabla f LEFT JOIN tarjetasjf t ON f.idtarjeta = t.id LEFT JOIN articulojf a ON t.articulo = a.articulo  WHERE DATE(f.fecha_cambio) like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT f.*,t.codigo as codigotarjeta,a.modelo FROM $tabla f LEFT JOIN tarjetasjf t ON f.idtarjeta = t.id LEFT JOIN articulojf a ON t.articulo = a.articulo WHERE DATE(f.fecha_cambio) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT f.*,t.codigo as codigotarjeta,a.modelo FROM $tabla f LEFT JOIN tarjetasjf t ON f.idtarjeta = t.id LEFT JOIN articulojf a ON t.articulo = a.articulo WHERE DATE(f.fecha_cambio) BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}	

}