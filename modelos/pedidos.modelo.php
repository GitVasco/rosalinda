<?php
require_once "conexion.php";

class ModeloPedidos{

    /*
    * MOSTRAR TEMPORAL CABECERA
    */
    static public function mdlMostrarTemporal($tabla, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo = $valor ORDER BY id ASC");

        $stmt -> execute();

        return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

    /*
    * MOSTRAR TEMPORAL CABECERA
    */
    static public function mdlMostrarTemporalTotal($valor){

        $stmt = Conexion::conectar()->prepare("SELECT
												dt.codigo,
												SUM(total) AS totalArt
											FROM
												detalle_temporal dt
											WHERE dt.codigo = $valor");

        $stmt -> execute();

        return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraDetallesTemporal($tabla, $valor){

		$sql="SELECT * FROM $tabla WHERE codigo=$valor ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

    /*
    * MOSTRAR DETALLE DE TEMPORAL B
    */
	static public function mdlMostraDetallesTemporalB($valor){

		$stmt = Conexion::conectar()->prepare("SELECT 
					t.codigo,
					t.articulo,
					t.cantidad,
					t.precio,
					t.total,
					CONCAT(
					modelo,
					' - ',
					nombre,
					' - ',
					color,
					' - T',
					talla
					) AS packing,
					a.pedidos 
				FROM
					detalle_temporal t 
					LEFT JOIN articulojf a 
					ON t.articulo = a.articulo 
				WHERE t.codigo = :codigo 
				ORDER BY t.articulo");

		$stmt->bindParam(":codigo", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	

    /*
	* GUARDAR DETALLE DE TEMPORAL
	*/
	static public function mdlGuardarTemporal($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, cliente, vendedor, lista) VALUES (:codigo, :cliente, :vendedor, :lista)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":lista", $datos["lista"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*
	* GUARDAR DETALLE DE TEMPORAL
	*/
	static public function mdlGuardarTemporalDetalle($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, articulo, cantidad, precio, total) VALUES (:codigo, :articulo, :cantidad, :precio, (:cantidad * :precio) )");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*
	* GUARDAR DETALLE DE TEMPORAL
	*/
	static public function mdlGuardarTemporalDetalleB($detalle){


		$stmt = Conexion::conectar()->prepare("INSERT INTO detalle_temporal (
													codigo,
													articulo,
													cantidad,
													precio,
													total
												) 
												VALUES 
												$detalle");

		//$stmt->bindParam(":detalle", $detalle, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		} else {

			//return $detalle;
			return $stmt->errorInfo();

		}

		$stmt->close();
		$stmt = null;
	}	

    /*
    * ELIMINAR ARTICULO REPETIDO
    */
	static public function mdlEliminarDetalleTemporal($tabla, $eliminar){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo = :codigo AND articulo = :articulo");

        $stmt -> bindParam(":codigo", $eliminar["codigo"], PDO::PARAM_INT);
        $stmt -> bindParam(":articulo", $eliminar["articulo"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

    /*
    * ELIMINAR DETALLES DEL PEDIDO PARA PONER LOS REALES
    */
	static public function mdlEliminarDetalleTemporalTotal($datos){

		$stmt = Conexion::conectar()->prepare("DELETE
												FROM
												detalle_temporal
												WHERE codigo = :codigo");

        $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

    }

    /*
    * ACTUALIZAR TALONARIO +1
    */
	static public function mdlActualizarTalonario(){

		$sql="UPDATE talonariosjf SET pedido = pedido+1";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		$stmt=null;

	}

    /*
    *ACTUALIZAR TOTALES DEL PEDIDO
    */
	static public function mdlActualizarTotalesPedido($datos){

		$sql="UPDATE
					temporaljf
				SET
					cliente = :cliente,
					op_gravada = :op_gravada,
					descuento_total = :descuento_total,
					sub_total = :sub_total,
					igv = :impuesto,
					total = :total,
					condicion_venta = :condicion_venta,
					agencia = :agencia,
					usuario = :usuario
				WHERE codigo = :codigo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":op_gravada", $datos["op_gravada"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento_total", $datos["descuento_total"], PDO::PARAM_STR);
		$stmt->bindParam(":sub_total", $datos["sub_total"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":condicion_venta", $datos["condicion_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;

	}

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraPedidosCabecera($valor){

		if($valor == null){

			$sql="SELECT
				t.id,
				t.codigo,
				c.codigo AS cod_cli,
				c.nombre,
				c.tipo_documento,
				c.documento,
				t.lista,
				t.vendedor,
				t.op_gravada,
				t.descuento_total,
				t.sub_total,
				t.igv,
				t.total,
				ROUND(
				t.descuento_total / t.op_gravada * 100,
				2
				) AS dscto,
				t.condicion_venta,
				cv.descripcion,
				t.estado,
				t.usuario,
				t.agencia,
				u.nombre AS nom_usu,
				DATE(t.fecha) AS fecha,
				cv.dias,
				DATE_ADD(DATE(t.fecha), INTERVAL cv.dias DAY) AS fecha_ven
			FROM
				temporaljf t
				LEFT JOIN clientesjf c
				ON t.cliente = c.codigo
				LEFT JOIN condiciones_ventajf cv
				ON t.condicion_venta = cv.id
				LEFT JOIN usuariosjf u
				ON t.usuario = u.id
			WHERE t.estado = 'generado'
			ORDER BY fecha DESC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		}else{

			$sql="SELECT
					t.id,
					t.codigo,
					c.codigo AS cod_cli,
					c.nombre,
					c.tipo_documento,
					c.documento,
					t.lista,
					t.vendedor,
					t.op_gravada,
					t.descuento_total,
					t.sub_total,
					t.igv,
					t.total,
					ROUND(
					t.descuento_total / t.op_gravada * 100,
					2
					) AS dscto,
					t.condicion_venta,
					cv.descripcion,
					t.estado,
					t.usuario,
					t.agencia,
					u.nombre AS nom_usu,
					DATE(t.fecha) AS fecha,
					cv.dias,
					DATE_ADD(DATE(t.fecha), INTERVAL cv.dias DAY) AS fecha_ven
				FROM
					temporaljf t
					LEFT JOIN clientesjf c
					ON t.cliente = c.codigo
					LEFT JOIN condiciones_ventajf cv
					ON t.condicion_venta = cv.id
					LEFT JOIN usuariosjf u
					ON t.usuario = u.id
				WHERE t.codigo = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		}

		$stmt=null;

	}

    /*
    * MOSTRAR LOS DATOS PARA LA IMPRESION
    */
	static public function mdlPedidoImpresion($codigo, $modelo){

		$sql="SELECT 
						m.id_modelo,
						m.modelo,
						a.cod_color,
						a.color,
						SUM(
						CASE
							WHEN a.cod_talla = '1'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t1,
						SUM(
						CASE
							WHEN a.cod_talla = '2'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t2,
						SUM(
						CASE
							WHEN a.cod_talla = '3'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t3,
						SUM(
						CASE
							WHEN a.cod_talla = '4'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t4,
						SUM(
						CASE
							WHEN a.cod_talla = '5'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t5,
						SUM(
						CASE
							WHEN a.cod_talla = '6'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t6,
						SUM(
						CASE
							WHEN a.cod_talla = '7'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t7,
						SUM(
						CASE
							WHEN a.cod_talla = '8'
							THEN dt.cantidad
							ELSE 0
						END
						) AS t8,
						SUM(dt.cantidad) AS total
					FROM
						detalle_temporal dt
						LEFT JOIN articulojf a
						ON dt.articulo = a.articulo
						LEFT JOIN modelojf m
						ON a.modelo = m.modelo
					WHERE dt.codigo = '".$codigo."'
						AND m.modelo = '".$modelo."'
					GROUP BY m.modelo,
						a.cod_color,
						a.color";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	

    /*
    * MOSTRAR LOS DATOS PARA LA IMPRESION
    */
	static public function mdlPedidoImpresionB($codigo, $ini, $fin){

		$sql="SELECT 
						dt.codigo,
						a.modelo,
						a.cod_color,
						a.color,
						SUM(
						CASE
							WHEN a.cod_talla = '1' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t1,
						SUM(
						CASE
							WHEN a.cod_talla = '2' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t2,
						SUM(
						CASE
							WHEN a.cod_talla = '3' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t3,
						SUM(
						CASE
							WHEN a.cod_talla = '4' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t4,
						SUM(
						CASE
							WHEN a.cod_talla = '5' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t5,
						SUM(
						CASE
							WHEN a.cod_talla = '6' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t6,
						SUM(
						CASE
							WHEN a.cod_talla = '7' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t7,
						SUM(
						CASE
							WHEN a.cod_talla = '8' 
							THEN dt.cantidad 
							ELSE 0 
						END
						) AS t8,
						SUM(dt.cantidad) AS total 
					FROM
						detalle_temporal dt 
						LEFT JOIN articulojf a 
						ON dt.articulo = a.articulo 
					WHERE codigo = $codigo 
					GROUP BY dt.codigo,
						a.modelo,
						a.cod_color,
						a.color 
					UNION
					SELECT 
						dt.codigo,
						a.modelo,
						'99',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'' 
					FROM
						detalle_temporal dt 
						LEFT JOIN articulojf a 
						ON dt.articulo = a.articulo 
					WHERE codigo = $codigo 
					GROUP BY dt.codigo,
						a.modelo 
					ORDER BY modelo,
						cod_color
					LIMIT $ini, $fin";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	

	/*
    * MOSTRAR LOS DATOS PARA LA IMPRESION
    */
	static public function mdlPedidoImpresionMod($valor){

		$sql="SELECT
			m.id_modelo,
			m.modelo
		FROM
			detalle_temporal dt
			LEFT JOIN articulojf a
			ON dt.articulo = a.articulo
			LEFT JOIN modelojf m
			ON a.modelo = m.modelo
		WHERE dt.codigo = $valor
		GROUP BY m.id_modelo
		ORDER BY m.modelo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/*
    * MOSTRAR LOS DATOS PARA LA IMPRESION CABECERA
    */
	static public function mdlPedidoImpresionCab($valor){

		$sql="SELECT 
					t.codigo AS pedido,
					DATE(t.fecha) AS fecha,
					c.codigo,
					c.nombre,
					c.direccion,
					c.ubigeo,
					u.nombre AS nom_ubi,
					CONCAT(
						t.vendedor,
						'-',
						(SELECT 
						m.descripcion 
						FROM
						maestrajf m 
						WHERE m.tipo_dato = 'TVEND' 
						AND t.vendedor = m.codigo)
					) AS vendedor,
					td.tipo_doc,
					c.documento,
					t.agencia,
					(SELECT 
						nombre 
					FROM
						agenciasjf a 
					WHERE a.id = t.agencia) AS nom_agencia  
					FROM
					temporaljf t 
					LEFT JOIN clientesjf c 
						ON t.cliente = c.codigo 
					LEFT JOIN ubigeo u 
						ON c.ubigeo = u.codigo 
					LEFT JOIN tipo_documentojf td 
						ON td.cod_doc = c.tipo_documento
				WHERE t.codigo = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}

	/*
    * MOSTRAR PEDIDO CON FORMATO DE IMRPESION - TOTALES GENERALES
    */
	static public function mdlPedidoImpresionTotales($valor){

		$sql="SELECT
					'TOTAL',
					'PEDIDO',
					SUM(
					CASE
						WHEN a.cod_talla = '1'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t1,
					SUM(
					CASE
						WHEN a.cod_talla = '2'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t2,
					SUM(
					CASE
						WHEN a.cod_talla = '3'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t3,
					SUM(
					CASE
						WHEN a.cod_talla = '4'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t4,
					SUM(
					CASE
						WHEN a.cod_talla = '5'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t5,
					SUM(
					CASE
						WHEN a.cod_talla = '6'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t6,
					SUM(
					CASE
						WHEN a.cod_talla = '7'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t7,
					SUM(
					CASE
						WHEN a.cod_talla = '8'
						THEN dt.cantidad
						ELSE 0
					END
					) AS t8,
					SUM(dt.cantidad) AS total 
				FROM
					detalle_temporal dt
					LEFT JOIN articulojf a
					ON dt.articulo = a.articulo
				WHERE dt.codigo = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraPedidosGeneral($valor){

		if($valor == null){

			$sql="SELECT
						t.id,
						t.codigo,
						c.codigo AS cod_cli,
						c.nombre,
						c.tipo_documento,
						c.documento,
						t.lista,
						t.vendedor,
						t.op_gravada,
						t.descuento_total,
						t.sub_total,
						t.igv,
						t.total,
						ROUND(
						t.descuento_total / t.op_gravada * 100,
						2
						) AS dscto,
						t.condicion_venta,
						cv.descripcion,
						t.estado,
						t.usuario,
						t.agencia,
						u.nombre AS nom_usu,
						DATE(t.fecha) AS fecha,
						cv.dias,
						DATE_ADD(DATE(t.fecha), INTERVAL cv.dias DAY) AS fecha_ven
					FROM
						temporaljf t
						LEFT JOIN clientesjf c
						ON t.cliente = c.codigo
						LEFT JOIN condiciones_ventajf cv
						ON t.condicion_venta = cv.id
						LEFT JOIN usuariosjf u
						ON t.usuario = u.id
					ORDER BY fecha DESC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		}else{

			$sql="SELECT
					t.id,
					t.codigo,
					c.codigo AS cod_cli,
					c.nombre,
					c.tipo_documento,
					c.documento,
					t.lista,
					t.vendedor,
					t.op_gravada,
					t.descuento_total,
					t.sub_total,
					t.igv,
					t.total,
					ROUND(
					t.descuento_total / t.op_gravada * 100,
					2
					) AS dscto,
					t.condicion_venta,
					cv.descripcion,
					t.estado,
					t.usuario,
					t.agencia,
					u.nombre AS nom_usu,
					DATE(t.fecha) AS fecha,
					cv.dias,
					DATE_ADD(DATE(t.fecha), INTERVAL cv.dias DAY) AS fecha_ven
				FROM
					temporaljf t
					LEFT JOIN clientesjf c
					ON t.cliente = c.codigo
					LEFT JOIN condiciones_ventajf cv
					ON t.condicion_venta = cv.id
					LEFT JOIN usuariosjf u
					ON t.usuario = u.id
				WHERE t.codigo = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		}

		$stmt=null;

	}

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraPedidosTablas($valor){

		if($valor != null){

			$sql="SELECT
						t.id,
						t.codigo,
						c.codigo AS cod_cli,
						c.nombre,
						c.tipo_documento,
						c.documento,
						t.lista,
						t.vendedor,
						t.op_gravada,
						t.descuento_total,
						t.sub_total,
						t.igv,
						t.total,
						ROUND(
						t.descuento_total / t.op_gravada * 100,
						2
						) AS dscto,
						t.condicion_venta,
						cv.descripcion,
						t.estado,
						t.usuario,
						t.agencia,
						u.nombre AS nom_usu,
						DATE(t.fecha) AS fecha,
						cv.dias,
						DATE_ADD(DATE(t.fecha), INTERVAL cv.dias DAY) AS fecha_ven
					FROM
						temporaljf t
						LEFT JOIN clientesjf c
						ON t.cliente = c.codigo
						LEFT JOIN condiciones_ventajf cv
						ON t.condicion_venta = cv.id
						LEFT JOIN usuariosjf u
						ON t.usuario = u.id
					WHERE t.estado = '$valor'
					ORDER BY fecha DESC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		}else{

			$sql="SELECT
					t.id,
					t.codigo,
					c.codigo AS cod_cli,
					c.nombre,
					c.tipo_documento,
					c.documento,
					t.lista,
					t.vendedor,
					t.op_gravada,
					t.descuento_total,
					t.sub_total,
					t.igv,
					t.total,
					ROUND(
					t.descuento_total / t.op_gravada * 100,
					2
					) AS dscto,
					t.condicion_venta,
					cv.descripcion,
					t.estado,
					t.usuario,
					t.agencia,
					u.nombre AS nom_usu,
					DATE(t.fecha) AS fecha,
					cv.dias,
					DATE_ADD(DATE(t.fecha), INTERVAL cv.dias DAY) AS fecha_ven
				FROM
					temporaljf t
					LEFT JOIN clientesjf c
					ON t.cliente = c.codigo
					LEFT JOIN condiciones_ventajf cv
					ON t.condicion_venta = cv.id
					LEFT JOIN usuariosjf u
					ON t.usuario = u.id
				WHERE t.codigo = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		}

		$stmt=null;

	}

	/*
	* GUARDAR TEMPORAL BKP
	*/
	static public function mdlGuardarTemporalBkp($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, cliente, vendedor, lista,op_gravada,descuento_total,sub_total,igv,total,condicion_venta,estado,fecha,usuario,agencia,usuario_estado) VALUES (:codigo, :cliente, :vendedor, :lista,:op_gravada,:descuento_total,:sub_total,:igv,:total,:condicion_venta,:estado,:fecha,:usuario,:agencia,:usuario_estado)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":lista", $datos["lista"], PDO::PARAM_STR);
		$stmt->bindParam(":op_gravada", $datos["op_gravada"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento_total", $datos["descuento_total"], PDO::PARAM_STR);
		$stmt->bindParam(":sub_total", $datos["sub_total"], PDO::PARAM_STR);
		$stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":condicion_venta", $datos["condicion_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_estado", $datos["usuario_estado"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*
	* GUARDAR TEMPORAL BKP
	*/
	static public function mdlReiniciarPedido(){


		$stmt = Conexion::conectar()->prepare("UPDATE 
										articulojf 
									SET
										pedidos = 0");
		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}	

	static public function mdlCantAprobados(){


		$stmt = Conexion::conectar()->prepare("UPDATE 
		articulojf a 
		LEFT JOIN 
		  (SELECT 
			articulo,
			SUM(cantidad) AS total 
		  FROM
			temporaljf t 
			LEFT JOIN detalle_temporal dt 
			  ON t.codigo = dt.codigo 
		  WHERE estado = 'APROBADO' 
		  GROUP BY articulo) t 
		  ON a.articulo = t.articulo SET a.pedidos = t.total 
	  WHERE t.total > 0");
		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}	

}