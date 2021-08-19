<?php

require_once "conexion.php";

class ModeloServicios{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarServicios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector WHERE se.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector  ORDER BY se.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	// Método para Mostrar los detalles de servicios
	static public function mdlMostraDetallesServicios($tabla,$item,$valor){

		$sql="SELECT * FROM $tabla WHERE $item=:$item ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	static public function mdlMostraDetallesServicioUnico($tabla,$item,$valor){

		$sql="SELECT * FROM $tabla WHERE $item=:$item ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}


	
	// Método para guardar los servicios
	static public function mdlGuardarServicios($tabla,$datos){

		$sql="INSERT INTO $tabla(codigo,usuario,taller,total,fecha,estado) VALUES (:codigo,:usuario,:taller,:total,:fecha,:estado)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}	
	
	// Método para guardar las ventas
	static public function mdlGuardarDetallesServicios($tabla,$datos){

		$sql="INSERT INTO $tabla(codigo,articulo,cantidad,saldo,cabecera_taller) VALUES (:codigo,:articulo,:cantidad,:saldo,:cabecera_taller)";

		$stmt=Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(":saldo",$datos["saldo"],PDO::PARAM_INT);
		$stmt->bindParam(":cabecera_taller",$datos["cabecera_taller"],PDO::PARAM_INT);
		
		$stmt->execute();

		$stmt=null;
	}

	// Método para editar las ventas
	static public function mdlEditarServicios($tabla,$datos){

		$sql="UPDATE $tabla SET codigo=:codigo,usuario=:usuario,taller=:taller,total=:total,fecha=:fecha WHERE codigo=:codigo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
	}
	// Método para editar los detalles de ventas - NO ES NECESARIO
	static public function mdlEditarDetallesServicios($tabla,$datos){

		$sql="UPDATE $tabla SET impuesto=:impuesto,neto=:neto,total=:total,metodo_pago=:metodo_pago WHERE codigo=:codigo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
		$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago",$datos["metodo_pago"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		$stmt=null;
	}

	/*=============================================
	ELIMINAR SERVICIO
	=============================================*/

	static public function mdlEliminarServicio($tabla, $datos){

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
	
	// Método para actualizar un dato CON EL ID
	static public function mdlActualizarUnDato($tabla,$item1,$valor1,$valor2){

		$sql="UPDATE $tabla SET $item1=:$item1 WHERE articulo=:articulo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$valor2,PDO::PARAM_STR);

		$stmt->execute();

		$stmt=null;

	}

	// Método para actualizar un dato con el PRODUCTO_CODIGO
	static public function mdlActualizarUnDatoArticulo($tabla,$item1,$valor1,$valor2){

		$sql="UPDATE $tabla SET $item1=:$item1 WHERE codigo=:id";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":id",$valor2,PDO::PARAM_INT);

		$stmt->execute();

		$stmt=null;

	}
	

	
	// Método para pedir último Id de venta
	static public function mdlUltimoId($tabla,$cliente,$vendedor){
		$sql="SELECT * FROM $tabla WHERE id_cliente=:id_cliente AND id_vendedor=:id_vendedor ORDER BY fecha DESC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":id_cliente",$cliente,PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor",$vendedor,PDO::PARAM_STR);

		$stmt->execute();

		# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
		return $stmt->fetchAll();

		$stmt=null;
	}



	// Método para eliminar un detalle de venta
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
	
	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalServicios($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlUltimoServicio($tabla){

		$sql="SELECT COUNT(codigo) + 1 AS ultimo_codigo FROM $tabla";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;


	}

	/*=============================================
	CREAR PRECIO SERVICIO
	=============================================*/

	static public function mdlIngresarPrecioServicio($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(taller,modelo,precio_doc) VALUES (:taller,:modelo,:precio_doc)");

		$stmt->bindParam(":taller", $datos["taller"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_doc", $datos["precio_doc"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR PRECIO SERVICIO
	=============================================*/

	static public function mdlMostrarPrecioServicios($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT pd.*,m.nombre FROM $tabla pd LEFT JOIN modelojf  m ON pd.modelo = m.modelo WHERE pd.$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT pd.*,m.nombre FROM $tabla pd LEFT JOIN modelojf  m ON pd.modelo = m.modelo ORDER BY pd.id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR PRECIO SERVICIO
	=============================================*/

	static public function mdlEditarPrecioServicio($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET taller = :taller, modelo = :modelo, precio_doc=:precio_doc WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":taller", $datos["taller"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_doc", $datos["precio_doc"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR PRECIO SERVICIO
	=============================================*/

	static public function mdlEliminarPrecioServicio($tabla,$datos){

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

	//VISUALIZAR DETALLE SERVICIO
	static public function mdlVisualizarServicioDetalle($valor){

		if($valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t8,
			SUM(sd.saldo) AS total 
		  FROM
			servicios_detallejf sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN serviciosjf s
			  ON s.codigo = sd.codigo
			LEFT JOIN sectorjf se
			  ON  s.taller=se.cod_sector
		  WHERE sd.codigo = :valor
		  GROUP BY sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color
		  HAVING SUM(sd.saldo) > 0");
	
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN sd.saldo 
				ELSE 0 
			  END
			) AS t8,
			SUM(sd.saldo) AS total 
		  FROM
			servicios_detallejf sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN serviciosjf s
			  ON s.codigo = sd.codigo
			LEFT JOIN sectorjf se
			  ON  s.taller=se.cod_sector
			WHERE total > 0
		  GROUP BY sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color
			HAVING SUM(sd.saldo) > 0
			ORDER BY a.modelo ASC
		   ");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();
		}
		$stmt=null;

	}

	
    /* 
	* MOSTRAR PRODUCCION
	*/
	static public function mdlMostrarPagoServicios($valor){

		if ($valor != null) {

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                            q.id,
                                                            q.ano,
                                                            m.mes,
                                                            q.mes AS nmes,
                                                            q.inicio,
                                                            q.fin,
                                                            u.nombre,
                                                            q.fecha_creacion 
                                                        FROM
                                                            pago_serviciosjf q 
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
                                            q.inicio,
                                            q.fin,
                                            u.nombre,
                                            q.fecha_creacion 
                                          FROM
                                            pago_serviciosjf q 
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
	static public function mdlCrearPagoServicio($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO pago_serviciosjf (
                                                ano,
                                                mes,
                                                inicio,
                                                fin,
                                                usuario
                                            ) 
                                            VALUES
                                                (
                                                :ano,
                                                :mes,
                                                :inicio,
                                                :fin,
                                                :usuario
                                                )");

		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
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
    
	static public function mdlEditarPagoServicio($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    pago_serviciosjf 
                                                SET
                                                    ano = :ano,
                                                    mes = :mes,
                                                    inicio = :inicio,
                                                    fin = :fin,
                                                    usuario = :usuario 
                                                WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
        $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
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
	* BORRAR QUINCENA
	*/
	static public function mdlEliminarPagoServicio($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM pago_serviciosjf WHERE id = :id ");

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);

		if ($stmt->execute()) {

      return "ok";
      
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}  

	 /* 
	* MOSTRAR PRODUCCION
	*/
	static public function mdlVerPagoServicios($inicio,$fin){

		$stmt = Conexion::conectar()->prepare("SELECT 
		c.taller,
		s.cod_sector,
		s.nom_sector,
		sd.codigo,
		c.fecha,
		c.guia,
		a.modelo,
		a.nombre,
		a.cod_color,
		a.color,
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
		SUM(sd.cantidad) AS total_und,
		ROUND(SUM(sd.cantidad) / 12, 2) AS total_docenas,
		ps.precio_doc,
		ROUND(
		  (
			(SUM(sd.cantidad) / 12) * ps.precio_doc
		  ),
		  2
		) AS total_soles 
	  FROM
		cierresjf c 
		LEFT JOIN cierres_detallejf sd 
		  ON c.codigo = sd.codigo 
		LEFT JOIN articulojf a 
		  ON sd.articulo = a.articulo 
		LEFT JOIN precio_serviciojf ps 
		  ON c.taller = ps.taller 
		  AND a.modelo = ps.modelo 
		LEFT JOIN sectorjf s 
		  ON c.taller = s.cod_sector 
	  WHERE DATE(c.fecha) BETWEEN '".$inicio."' 
		AND '".$fin."' 
	  GROUP BY sd.codigo,
		a.modelo,
		a.nombre,
		a.cod_color,
		a.color");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
	
	static public function mdlVerSectores($inicio,$fin){

		$stmt = Conexion::conectar()->prepare("SELECT 
		c.taller,
		s.nom_completo
	  FROM
		cierresjf c 
		LEFT JOIN cierres_detallejf sd 
		  ON c.codigo = sd.codigo 
		LEFT JOIN articulojf a 
		  ON sd.articulo = a.articulo 
		LEFT JOIN precio_serviciojf ps 
		  ON c.taller = ps.taller 
		  AND a.modelo = ps.modelo 
		LEFT JOIN sectorjf s 
		  ON c.taller = s.cod_sector 
	  WHERE DATE(c.fecha) BETWEEN '".$inicio."' 
		AND '".$fin."' 
	  GROUP BY c.taller ;
	  ");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
	
	static public function mdlVerTotalPagar($inicio,$fin,$sector){

		$stmt = Conexion::conectar()->prepare("SELECT 
		c.taller,
		ROUND(
		  SUM(sd.cantidad / 12 * ps.precio_doc),
		  2
		) AS total_soles 
	  FROM
		cierresjf c 
		LEFT JOIN cierres_detallejf sd 
		  ON c.codigo = sd.codigo 
		LEFT JOIN articulojf a 
		  ON sd.articulo = a.articulo 
		LEFT JOIN precio_serviciojf ps 
		  ON c.taller = ps.taller 
		  AND a.modelo = ps.modelo 
		LEFT JOIN sectorjf s 
		  ON c.taller = s.cod_sector 
	  WHERE DATE(c.fecha) BETWEEN '".$inicio."' 
		AND '".$fin."' 
		AND c.taller = '".$sector."' 
	  GROUP BY c.taller ");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}

	static public function mdlVerPagoServicioSector($inicio,$fin,$sector){

		$stmt = Conexion::conectar()->prepare("SELECT 
		c.taller,
		s.cod_sector,
		s.nom_sector,
		sd.codigo,
		c.fecha,
		CASE
		  WHEN MONTH(c.fecha) = '1' 
		  THEN CONCAT(DAY(c.fecha), '-Ene') 
		  WHEN MONTH(c.fecha) = '2' 
		  THEN CONCAT(DAY(c.fecha), '-Feb') 
		  WHEN MONTH(c.fecha) = '3' 
		  THEN CONCAT(DAY(c.fecha), '-Mar') 
		  WHEN MONTH(c.fecha) = '4' 
		  THEN CONCAT(DAY(c.fecha), '-Abr') 
		  WHEN MONTH(c.fecha) = '5' 
		  THEN CONCAT(DAY(c.fecha), '-May') 
		  WHEN MONTH(c.fecha) = '6' 
		  THEN CONCAT(DAY(c.fecha), '-Jun') 
		  WHEN MONTH(c.fecha) = '7' 
		  THEN CONCAT(DAY(c.fecha), '-Jul') 
		  WHEN MONTH(c.fecha) = '8' 
		  THEN CONCAT(DAY(c.fecha), '-Ago') 
		  WHEN MONTH(c.fecha) = '9' 
		  THEN CONCAT(DAY(c.fecha), '-Sep') 
		  WHEN MONTH(c.fecha) = '10' 
		  THEN CONCAT(DAY(c.fecha), '-Oct') 
		  WHEN MONTH(c.fecha) = '11' 
		  THEN CONCAT(DAY(c.fecha), '-Nov') 
		  ELSE CONCAT(DAY(c.fecha), '-Dic') 
		END AS fec2,
		c.guia,
		a.modelo,
		a.nombre,
		a.cod_color,
		a.color,
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
		SUM(sd.cantidad) AS total_und,
		ROUND(SUM(sd.cantidad) / 12, 2) AS total_docenas,
		ps.precio_doc,
		ROUND(
		  (
			(SUM(sd.cantidad) / 12) * ps.precio_doc
		  ),
		  2
		) AS total_soles 
	  FROM
		cierresjf c 
		LEFT JOIN cierres_detallejf sd 
		  ON c.codigo = sd.codigo 
		LEFT JOIN articulojf a 
		  ON sd.articulo = a.articulo 
		LEFT JOIN precio_serviciojf ps 
		  ON c.taller = ps.taller 
		  AND a.modelo = ps.modelo 
		LEFT JOIN sectorjf s 
		  ON c.taller = s.cod_sector 
	  WHERE DATE(c.fecha) BETWEEN '".$inicio."' 
		AND '".$fin."' 
		AND c.taller = '".$sector."' 
	  GROUP BY sd.codigo,
		a.modelo,
		a.nombre,
		a.cod_color,
		a.color 
		ORDER BY c.guia,
		c.fecha,
		a.modelo ");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
	
	static public function mdlVerSumaPagos($inicio,$fin,$sector){

		$stmt = Conexion::conectar()->prepare("SELECT 
		c.taller,
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
		SUM(sd.cantidad) AS total_und,
		ROUND(SUM(sd.cantidad) / 12, 2) AS total_docenas 
	  FROM
		cierresjf c 
		LEFT JOIN cierres_detallejf sd 
		  ON c.codigo = sd.codigo 
		LEFT JOIN articulojf a 
		  ON sd.articulo = a.articulo 
		LEFT JOIN precio_serviciojf ps 
		  ON c.taller = ps.taller 
		  AND a.modelo = ps.modelo 
		LEFT JOIN sectorjf s 
		  ON c.taller = s.cod_sector 
	  WHERE DATE(c.fecha) BETWEEN '".$inicio."' 
		AND '".$fin."' 
	  AND c.taller='".$sector."'
	  GROUP BY c.taller ;");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasServicios($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector,u.nombre FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector LEFT JOIN usuariosjf u ON se.usuario = u.id ORDER BY se.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector,u.nombre FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector LEFT JOIN usuariosjf u ON se.usuario = u.id WHERE DATE(se.fecha) like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector,u.nombre FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector LEFT JOIN usuariosjf u ON se.usuario = u.id WHERE DATE(se.fecha) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector,u.nombre FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector LEFT JOIN usuariosjf u ON se.usuario = u.id WHERE DATE(se.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVerServicios($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.codigo,
			DATE(s.fecha) AS fechas,
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
			servicios_detallejf sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN serviciosjf s 
			  ON sd.codigo = s.codigo 
			LEFT JOIN sectorjf se 
			  ON s.taller = se.cod_sector 
		  GROUP BY sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color ORDER BY sd.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.codigo,
			DATE(s.fecha) AS fechas,
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
			servicios_detallejf sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN serviciosjf s 
			  ON sd.codigo = s.codigo 
			LEFT JOIN sectorjf se 
			  ON s.taller = se.cod_sector 
			WHERE DATE(s.fecha) like '%$fechaFinal%'
		  GROUP BY sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color ");

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
				sd.codigo,
				DATE(s.fecha) AS fechas,
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
				servicios_detallejf sd 
				LEFT JOIN articulojf a 
				  ON sd.articulo = a.articulo 
				LEFT JOIN serviciosjf s 
				  ON sd.codigo = s.codigo 
				LEFT JOIN sectorjf se 
				  ON s.taller = se.cod_sector 
				WHERE DATE(s.fecha) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
			  GROUP BY sd.codigo,
				a.modelo,
				a.nombre,
				a.cod_color,
				a.color");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT 
				sd.codigo,
				DATE(s.fecha) AS fechas,
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
				servicios_detallejf sd 
				LEFT JOIN articulojf a 
				  ON sd.articulo = a.articulo 
				LEFT JOIN serviciosjf s 
				  ON sd.codigo = s.codigo 
				LEFT JOIN sectorjf se 
				  ON s.taller = se.cod_sector 
				WHERE DATE(s.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'

			  GROUP BY sd.codigo,
				a.modelo,
				a.nombre,
				a.cod_color,
				a.color ");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	// TRAER EL PRIMER SERVICIO CREADO POR EVENTO PARA MANDAR DE ALMACEN CORTE
	static public function mdlPrimerServicio($taller){
		$sql="SELECT 
				codigo 
			FROM
				serviciosjf 
			WHERE taller = :taller
				AND DATE(fecha) = DATE(NOW()) 
			ORDER BY id ASC 
			LIMIT 1 ";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":taller",$taller,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt -> close();

		$stmt=null;
	}

}