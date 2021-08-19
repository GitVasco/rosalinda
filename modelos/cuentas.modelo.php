<?php

require_once "conexion.php";

class ModeloCuentas{

	/*=============================================
	CREAR CUENTA
	=============================================*/

	static public function mdlIngresarCuenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_doc,num_cta,cliente,vendedor,fecha,fecha_ven,fecha_cep,tip_mon,monto,tip_cambio,estado,notas,cod_pago,doc_origen,renovacion,protesta,usuario,saldo,ult_pago,estado_doc,banco,num_unico,fecha_envio,fecha_abono,tip_mov) VALUES (:tipo_doc,:num_cta,:cliente,:vendedor,:fecha,:fecha_ven,:fecha_cep,:tip_mon,:monto,:tip_cambio,:estado,:notas,:cod_pago,:doc_origen,:renovacion,:protesta,:usuario,:saldo,:ult_pago,:estado_doc,:banco,:num_unico,:fecha_envio,:fecha_abono,:tip_mov)");

		$stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ven", $datos["fecha_ven"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cep", $datos["fecha_cep"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_mon", $datos["tip_mon"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_cambio", $datos["tip_cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":notas", $datos["notas"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_pago", $datos["cod_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
		$stmt->bindParam(":renovacion", $datos["renovacion"], PDO::PARAM_STR);
		$stmt->bindParam(":protesta", $datos["protesta"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);
		$stmt->bindParam(":ult_pago", $datos["ult_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_doc", $datos["estado_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":num_unico", $datos["num_unico"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_abono", $datos["fecha_abono"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_mov", $datos["tip_mov"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	static public function mdlIngresarCuentaBckp($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cuenta_cte_bkpjf 
		(SELECT 
		  *,
		  :usuario_bkp,
		  :fecha_bkp 
		FROM
		  cuenta_ctejf
		  WHERE num_cta = :num_cta) ;");

		$stmt->bindParam(":usuario_bkp", $datos["usuario_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_bkp", $datos["fecha_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	static public function mdlIngresarCuentaBckp2($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cuenta_cte_bkpjf 
		(SELECT 
		  *,
		  :usuario_bkp,
		  :fecha_bkp 
		FROM
		  cuenta_ctejf
		  WHERE id = :id) ;");

		$stmt->bindParam(":usuario_bkp", $datos["usuario_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_bkp", $datos["fecha_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    


	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function mdlMostrarCuentas($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+' AND c.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR CUENTAS LETRAS IMPRESION
	=============================================*/

	static public function mdlMostrarCuentasLetras($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
			c.num_cta,
			c.doc_origen,
			c.fecha_ven,
			c.fecha,
			c.monto,
			cli.codigo,
			cli.nombre,
			cli.direccion,
			uc.ubcli,
			cli.documento,
			cli.telefono,
			cli.ubigeo,
			cli.aval_nombre,
			cli.aval_dir,
			cli.aval_postal,
			ua.ubaval,
			cli.aval_telf,
			cli.aval_ruc 
		  FROM
			cuenta_ctejf c 
			LEFT JOIN clientesjf cli 
			  ON c.cliente = cli.codigo 
			LEFT JOIN 
			  (SELECT 
				codigo,
				CONCAT(
				  Departamento,
				  '/',
				  provincia,
				  '/',
				  distrito
				) AS ubcli 
			  FROM
				ubigeo) AS uc 
			  ON cli.ubigeo = uc.codigo 
			LEFT JOIN 
			  (SELECT 
				codigo,
				CONCAT(
				  Departamento,
				  '/',
				  provincia,
				  '/',
				  distrito
				) AS ubaval 
			  FROM
				ubigeo) AS ua 
			  ON cli.aval_postal = ua.codigo 
			  WHERE c.tip_mov ='+' 
			  AND c.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT c.num_cta,c.doc_origen,c.fecha_ven,c.fecha,c.monto,cli.nombre,cli.direccion,cli.documento,cli.telefono FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR CUENTAS GENERA LETRAS IMPRESION
	=============================================*/

	static public function mdlMostrarCuentasGeneradosLetras($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
			c.num_cta,
			c.doc_origen,
			c.fecha_ven,
			c.fecha,
			c.monto,
			cli.codigo,
			cli.nombre,
			cli.direccion,
			uc.ubcli,
			cli.documento,
			cli.telefono,
			cli.ubigeo,
			cli.aval_nombre,
			cli.aval_dir,
			cli.aval_postal,
			ua.ubaval,
			cli.aval_telf,
			cli.aval_ruc 
		  FROM
			cuenta_ctejf c 
			LEFT JOIN clientesjf cli 
			  ON c.cliente = cli.codigo 
			LEFT JOIN 
			  (SELECT 
				codigo,
				CONCAT(
				  Departamento,
				  '/',
				  provincia,
				  '/',
				  distrito
				) AS ubcli 
			  FROM
				ubigeo) AS uc 
			  ON cli.ubigeo = uc.codigo 
			LEFT JOIN 
			  (SELECT 
				codigo,
				CONCAT(
				  Departamento,
				  '/',
				  provincia,
				  '/',
				  distrito
				) AS ubaval 
			  FROM
				ubigeo) AS ua 
			  ON cli.aval_postal = ua.codigo 
			  WHERE c.tip_mov ='+' 
			  AND c.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT c.num_cta,c.doc_origen,c.fecha_ven,c.fecha,c.monto,cli.nombre,cli.direccion,cli.documento,cli.telefono FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function mdlMostrarCuentasUnicos($tabla,$item,$valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT c.*,CONCAT(
				SUBSTR(c.fecha_ven, 9, 2),
				SUBSTR(c.fecha_ven, 6, 2),
				SUBSTR(c.fecha_ven, 3, 2)
			  ) AS fechaVen,
			  REPLACE(c.num_cta,'-','') AS cuenta,
			  cli.nombre,
			  cli.ape_paterno,
			  cli.ape_materno,
			  cli.nombres,
			  cli.documento 
			  FROM $tabla c 
			LEFT JOIN clientesjf cli ON c.cliente=cli.codigo
			WHERE c.tip_mov ='+'
			AND c.tipo_doc = '85'
			AND c.estado= 'PENDIENTE'
			AND c.id = $valor");
			$stmt -> execute();
	
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT c.*,REPLACE(DATE_FORMAT(c.fecha_ven,'%d-%m-%Y'),'-','') AS fechaVen,REPLACE(c.num_cta,'-','') AS cuenta,cli.nombre,cli.ape_paterno,cli.ape_materno,cli.nombres,cli.documento FROM $tabla c 
			LEFT JOIN clientesjf cli ON c.cliente=cli.codigo
			WHERE c.tip_mov ='+'
			AND c.tipo_doc = '85'
			AND c.estado= 'PENDIENTE'
			AND (c.estado_doc IS NULL OR c.estado_doc = '') ");
	
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}

		

		$stmt -> close();

		$stmt = null;

	}

	
	
	static public function mdlMostrarPagos($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY codigo");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	static public function mdlMostrarCancelaciones($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tip_mov = '-'");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tip_mov = '-' ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
	
	
	static public function mdlMostrarCancelacion($tabla,$item,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tip_mov = '-' ");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }
	/*=============================================
	EDITAR TIPO DE PAGO
	=============================================*/

	static public function mdlEditarCuenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_doc=:tipo_doc,num_cta=:num_cta,cliente=:cliente,vendedor=:vendedor,fecha=:fecha,fecha_ven=:fecha_ven,fecha_cep=:fecha_cep,tip_mon=:tip_mon,monto=:monto,tip_cambio=:tip_cambio,estado=:estado,notas=:notas,cod_pago=:cod_pago,doc_origen=:doc_origen,renovacion=:renovacion,protesta=:protesta,usuario=:usuario,saldo=:saldo,ult_pago=:ult_pago,estado_doc=:estado_doc,banco=:banco,num_unico=:num_unico,fecha_envio=:fecha_envio,fecha_abono=:fecha_abono WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ven", $datos["fecha_ven"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cep", $datos["fecha_cep"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_mon", $datos["tip_mon"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_cambio", $datos["tip_cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":notas", $datos["notas"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_pago", $datos["cod_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
		$stmt->bindParam(":renovacion", $datos["renovacion"], PDO::PARAM_STR);
		$stmt->bindParam(":protesta", $datos["protesta"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);
		$stmt->bindParam(":ult_pago", $datos["ult_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_doc", $datos["estado_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":num_unico", $datos["num_unico"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_abono", $datos["fecha_abono"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR CUENTA
	=============================================*/

	static public function mdlEliminarCuenta($tabla,$datos){

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

	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function mdlEliminarCuentaCancelacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE num_cta = :num_cta");

		$stmt -> bindParam(":num_cta", $datos, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

	/* 
	* Método para actualizar un dato CON EL articulo
	*/
	static public function mdlActualizarUnDato($tabla, $item1, $valor1, $valor2){

		$sql = "UPDATE $tabla SET $item1=:$item1 WHERE id=:id";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function mdlMostrarCuentasPendientes($tabla,$saldo){

		if($saldo != "null" ){
			$stmt = Conexion::conectar()->prepare("SELECT 
													* 
												FROM
													$tabla 
												WHERE saldo > 0 
												AND tip_mov ='+'
												ORDER BY saldo BETWEEN ($saldo - 10) 
													AND ($saldo + 10) DESC,
													saldo ASC ");
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
														* 
													FROM
														$tabla 
													WHERE saldo > 0 
														AND tip_mov ='+' 
													ORDER BY saldo ASC ");

			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}
		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function mdlMostrarTipoCuentas($tabla,$item,$valor){

		if($valor != "null"){

			$stmt = Conexion::conectar()->prepare("SELECT 
			c.*,cli.nombre,IFNULL(DATEDIFF(c.ult_pago, c.fecha_ven), 0) AS diferencia,
			DATE_FORMAT(c.fecha, '%d-%m-%Y')AS nuevaFecha, 
			DATE_FORMAT(c.fecha_ven, '%d-%m-%Y')AS nuevaFechaVen,
			DATE_FORMAT(c.ult_pago, '%d-%m-%Y')AS nuevaFechaPago  
			FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo 
			WHERE c.tip_mov ='+' AND c.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			c.*,
			cli.nombre,
			IFNULL(DATEDIFF(c.ult_pago, c.fecha_ven), 0) AS diferencia,
			DATE_FORMAT(c.fecha, '%d-%m-%Y')AS nuevaFecha, 
			DATE_FORMAT(c.fecha_ven, '%d-%m-%Y')AS nuevaFechaVen,
			DATE_FORMAT(c.ult_pago, '%d-%m-%Y')AS nuevaFechaPago 
		  FROM
			cuenta_ctejf c 
			LEFT JOIN clientesjf cli 
			  ON c.cliente = cli.codigo 
		  WHERE c.tip_mov = '+' 
		  ORDER BY c.id ASC");
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentas($tabla, $ano){

		if($ano == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'  AND YEAR(c.fecha) = YEAR(NOW()) ORDER BY c.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else {

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE YEAR(c.fecha) = '".$ano."' AND c.tip_mov ='+'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentasPendientes($tabla, $ano){

		if($ano == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'  AND c.estado='PENDIENTE' ORDER BY c.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else {

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE YEAR(c.fecha) = '".$ano."' AND c.tip_mov ='+' AND c.estado='PENDIENTE' ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentasAprobadas($tabla, $ano){

		if($ano == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+' AND c.estado='CANCELADO' AND YEAR(c.fecha) = YEAR(NOW())  ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else{

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE YEAR(c.fecha) = '".$ano."' AND c.tip_mov ='+' AND c.estado='CANCELADO' ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function mdlMostrarCuentaCredito($tabla,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT 
		c.cliente,
		SUM(monto) AS total_credito 
		FROM
			cuenta_ctejf c 
		WHERE c.cliente = :cliente
		AND c.tip_mov = '+'
		GROUP BY c.cliente ");

		$stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }

	static public function mdlMostrarCuentaDeuda($tabla,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT 
		c.cliente,
		IFNULL(SUM(saldo),0) AS total_deuda
		FROM
			cuenta_ctejf c 
		WHERE c.cliente = :cliente
		AND c.estado = 'pendiente' 
		AND c.tip_mov = '+'
		GROUP BY c.cliente ");

		$stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


    }


	static public function mdlMostrarCuentaDeudaVencida($tabla,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT 
		c.cliente,
		IFNULL(SUM(saldo),0) AS total_vencido
		FROM
			cuenta_ctejf c 
		WHERE c.cliente = :cliente 
		AND c.estado = 'pendiente' 
		AND c.fecha_ven < NOW() 
		AND c.tip_mov = '+'
		GROUP BY c.cliente  ");

		$stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }


	/*=============================================
	RANGO FECHAS ENVIOS DE CUENTAS
	=============================================*/	

	static public function mdlRangoFechaEnvioCuentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id  ORDER BY e.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id WHERE e.fecha like '%$fechaFinal%' ");

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

				$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id  WHERE e.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id  WHERE e.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	CREAR ENVIO LETRA CABECERA
	=============================================*/

	static public function mdlIngresarEnvioLetra($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,fecha,usuario,cantidad,archivo) VALUES (:codigo,:fecha,:usuario,:cantidad,:archivo)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	} 

	/*=============================================
	CREAR ENVIO LETRA DETALLE
	=============================================*/

	static public function mdlIngresarEnvioLetraDetalle($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(num_cta,codigo) VALUES (:num_cta,:codigo)");

		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	} 

	static public function mdlMostrarReporteCobrar($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

		if($orden1 == 'tipo' && $orden2 == 'ordNumCuenta' ){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordVencimiento'){

			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.fecha_ven ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordCliente'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.cliente ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			FORMAT(cc.saldo,2) AS saldo
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.cliente = '".$cli."' 
		  ORDER BY cc.tipo_doc ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			CASE
			  WHEN cc.estado_doc = '01' 
			  THEN 'COBRANZA' 
			  ELSE '' 
			END AS estado_doc,
			CASE
			  WHEN cc.banco = '02' 
			  THEN 'BCP' 
			  ELSE '' 
			END AS banco,
			cc.num_unico,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  UNION
		  SELECT 
			cc.cliente,
			c.nombre,
			'',
			'0000-00-00',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  GROUP BY cc.cliente 
		  UNION
		  SELECT 
			cc.cliente,
			'',
			'',
			'9999-12-31',
			'',
			'',
			'',
			'',
			'',
			'Total Cliente',
			FORMAT(SUM(cc.saldo), 2) AS saldo_total,
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  GROUP BY cc.cliente 
		  ORDER BY cliente,
			fecha ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.doc_origen,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."' 
		  ORDER BY cc.tipo_doc");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordCliente' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  ORDER BY cc.tipo_doc,
		  cc.cliente,
		  cc.num_cta
			 ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if($orden1 == 'fecha_ven' && $orden2 == 'ordNumCuenta'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  ORDER BY cc.tipo_doc,
			cc.fecha_ven,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;


    }

	static public function mdlMostrarReporteVencidos($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

		if($orden1 == 'tipo' && $orden2 == 'ordNumCuenta' ){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()>cc.fecha_ven  
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordVencimiento'){

			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()>cc.fecha_ven 
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.fecha_ven ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordCliente'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()>cc.fecha_ven  
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.cliente ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			FORMAT(cc.saldo,2) AS saldo
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.cliente = '".$cli."' 
		    AND NOW()>cc.fecha_ven  
		  ORDER BY cc.tipo_doc ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			CASE
			  WHEN cc.estado_doc = '01' 
			  THEN 'COBRANZA' 
			  ELSE '' 
			END AS estado_doc,
			CASE
			  WHEN cc.banco = '02' 
			  THEN 'BCP' 
			  ELSE '' 
			END AS banco,
			cc.num_unico,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  UNION
		  SELECT 
			cc.cliente,
			c.nombre,
			'',
			'0000-00-00',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  GROUP BY cc.cliente 
		  UNION
		  SELECT 
			cc.cliente,
			'',
			'',
			'9999-12-31',
			'',
			'',
			'',
			'',
			'',
			'Total Cliente',
			FORMAT(SUM(cc.saldo), 2) AS saldo_total,
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()>cc.fecha_ven  
		  GROUP BY cc.cliente 
		  ORDER BY cliente,
			fecha ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente'  
		    AND NOW()>cc.fecha_ven 
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.doc_origen,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."'  
		    AND NOW()>cc.fecha_ven 
		  ORDER BY cc.tipo_doc");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordCliente' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()>cc.fecha_ven  
		  ORDER BY cc.tipo_doc,
		  cc.cliente,
		  cc.num_cta
			 ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if($orden1 == 'fecha_ven' && $orden2 == 'ordNumCuenta'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()>cc.fecha_ven  
		  ORDER BY cc.tipo_doc,
			cc.fecha_ven,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;


    }

	static public function mdlMostrarReporteNoVencidos($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

		if($orden1 == 'tipo' && $orden2 == 'ordNumCuenta' ){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()<cc.fecha_ven  
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordVencimiento'){

			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()<cc.fecha_ven 
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.fecha_ven ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordCliente'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()<cc.fecha_ven  
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.cliente ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			FORMAT(cc.saldo,2) AS saldo
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.cliente = '".$cli."' 
		    AND NOW()<cc.fecha_ven  
		  ORDER BY cc.tipo_doc ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			CASE
			  WHEN cc.estado_doc = '01' 
			  THEN 'COBRANZA' 
			  ELSE '' 
			END AS estado_doc,
			CASE
			  WHEN cc.banco = '02' 
			  THEN 'BCP' 
			  ELSE '' 
			END AS banco,
			cc.num_unico,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  UNION
		  SELECT 
			cc.cliente,
			c.nombre,
			'',
			'0000-00-00',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  GROUP BY cc.cliente 
		  UNION
		  SELECT 
			cc.cliente,
			'',
			'',
			'9999-12-31',
			'',
			'',
			'',
			'',
			'',
			'Total Cliente',
			FORMAT(SUM(cc.saldo), 2) AS saldo_total,
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()<cc.fecha_ven  
		  GROUP BY cc.cliente 
		  ORDER BY cliente,
			fecha ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente'  
		    AND NOW()<cc.fecha_ven 
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.doc_origen,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."'  
		    AND NOW()<cc.fecha_ven 
		  ORDER BY cc.tipo_doc");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordCliente' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()<cc.fecha_ven  
		  ORDER BY cc.tipo_doc,
		  cc.cliente,
		  cc.num_cta
			 ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if($orden1 == 'fecha_ven' && $orden2 == 'ordNumCuenta'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()<cc.fecha_ven  
		  ORDER BY cc.tipo_doc,
			cc.fecha_ven,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;


    }

	static public function mdlMostrarReporteProtestados($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

		if($orden1 == 'tipo' && $orden2 == 'ordNumCuenta' ){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
  			AND cc.protesta = 1  
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordVencimiento'){

			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
  			AND cc.protesta = 1   
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.fecha_ven ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if($orden1 == 'tipo' && $orden2 == 'ordCliente'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
  			AND cc.protesta = 1   
		  ORDER BY cc.tipo_doc,cc.num_cta,
			cc.cliente ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			FORMAT(cc.saldo,2) AS saldo
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.cliente = '".$cli."'  
  			AND cc.protesta = 1  
		  ORDER BY cc.tipo_doc ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();

		}else if ($orden1 == 'cliente' && $orden2 == 'ordNumCuenta' && $cli == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.vendedor,
			cc.doc_origen,
			CASE
			  WHEN cc.estado_doc = '01' 
			  THEN 'COBRANZA' 
			  ELSE '' 
			END AS estado_doc,
			CASE
			  WHEN cc.banco = '02' 
			  THEN 'BCP' 
			  ELSE '' 
			END AS banco,
			cc.num_unico,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  UNION
		  SELECT 
			cc.cliente,
			c.nombre,
			'',
			'0000-00-00',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		  GROUP BY cc.cliente 
		  UNION
		  SELECT 
			cc.cliente,
			'',
			'',
			'9999-12-31',
			'',
			'',
			'',
			'',
			'',
			'Total Cliente',
			FORMAT(SUM(cc.saldo), 2) AS saldo_total,
			'' 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
  			AND cc.protesta = 1   
		  GROUP BY cc.cliente 
		  ORDER BY cliente,
			fecha ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
  			AND cc.protesta = 1   
		  ORDER BY cc.tipo_doc,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordNumCuenta' && $vend != 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.fecha,
			cc.fecha_ven,
			cc.doc_origen,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."' 
  			AND cc.protesta = 1   
		  ORDER BY cc.tipo_doc");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if ($orden1 == 'vendedor' && $orden2 == 'ordCliente' && $vend == 'todo'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
  			AND cc.protesta = 1   
		  ORDER BY cc.tipo_doc,
		  cc.cliente,
		  cc.num_cta
			 ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}else if($orden1 == 'fecha_ven' && $orden2 == 'ordNumCuenta'){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.tipo_doc,
			cc.num_cta,
			cc.banco,
			cc.fecha,
			cc.vendedor,
			cc.fecha_ven,
			cc.cliente,
			c.nombre,
			FORMAT(cc.saldo, 2) AS saldo,
			CASE
			  WHEN cc.protesta = 0 
			  THEN '' 
			  ELSE 'Si' 
			END AS protesta,
			IFNULL(cc.num_unico, '') AS num_unico 
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
  			AND cc.protesta = 1   
		  ORDER BY cc.tipo_doc,
			cc.fecha_ven,
			cc.num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;


    }

	static public function mdlMostrarReportePagos($tabla,$orden1,$orden2,$canc,$vend,$inicio,$fin){
		
	if($orden1 == "fecha_ven" && $orden2 == "ordNumCuenta" && $canc=="todo"){
		$stmt = Conexion::conectar()->prepare("SELECT 
		'-1' AS tipo_doc,
		'Fecha de pago:' AS num_cta,
		cc.fecha,
		'' AS cliente,
		'' AS nombre,
		'' AS cod_pago,
		'' AS doc_origen,
		'' AS fact,
		'' AS letra 
	  FROM
		cuenta_ctejf cc 
		LEFT JOIN clientesjf c 
		  ON cc.cliente = c.codigo 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			maestrajf 
		  WHERE tipo_dato = 'tvend') v 
		  ON cc.vendedor = v.codigo 
	  WHERE cc.tip_mov = '-' 
		AND (
		  cc.fecha BETWEEN '".$inicio."' 
		  AND '".$fin."'
		) 
	  GROUP BY cc.fecha 
	  UNION
	  SELECT 
		cc.tipo_doc,
		cc.num_cta,
		cc.fecha,
		cc.cliente,
		c.nombre,
		cc.cod_pago,
		cc.doc_origen,
		CASE
		  WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
		  THEN FORMAT(cc.monto, 2) 
		  ELSE '' 
		END AS fact,
		CASE
		  WHEN cc.tipo_doc IN ('85') 
		  THEN FORMAT(cc.monto, 2) 
		  ELSE '' 
		END AS letra 
	  FROM
		cuenta_ctejf cc 
		LEFT JOIN clientesjf c 
		  ON cc.cliente = c.codigo 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			maestrajf 
		  WHERE tipo_dato = 'tvend') v 
		  ON cc.vendedor = v.codigo 
	  WHERE cc.tip_mov = '-' 
		AND (
		  cc.fecha BETWEEN '".$inicio."' 
		  AND '".$fin."'
		) 
		UNION
		SELECT 
		  '999' AS tipo_doc,
		  'Fecha de pago:',
		  cc.fecha,
		  '',
		  '',
		  '',
		  '',
		  FORMAT(
			SUM(
			  CASE
				WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
				THEN cc.monto 
				ELSE '' 
			  END
			),
			2
		  ) AS fact,
		  FORMAT(
			SUM(
			  CASE
				WHEN cc.tipo_doc IN ('85') 
				THEN cc.monto 
				ELSE '' 
			  END
			),
			2
		  ) AS letra 
		FROM
		  cuenta_ctejf cc 
		  LEFT JOIN clientesjf c 
			ON cc.cliente = c.codigo 
		  LEFT JOIN 
			(SELECT 
			  * 
			FROM
			  maestrajf 
			WHERE tipo_dato = 'tvend') v 
			ON cc.vendedor = v.codigo 
		WHERE cc.tip_mov = '-' 
		  AND (
			cc.fecha BETWEEN '".$inicio."' 
		  AND '".$fin."'
		  ) 
		GROUP BY cc.fecha 
		ORDER BY fecha,
		  tipo_doc");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
	}else if($orden1 == "vendedor" && $orden2 == "ordNumCuenta" ){
		$stmt = Conexion::conectar()->prepare("SELECT 
		'-1' AS tipo_doc,
		'Vendedor: ' AS num_cta,
		CONCAT( m.codigo , ' ', m.descripcion) AS fecha,
		'' AS cliente,
		'' AS nombre,
		'' AS cod_pago,
		'' AS doc_origen,
		'' AS fact,
		'' AS letra 
	  FROM
		maestrajf m 
	  WHERE m.tipo_dato = 'tvend' 
		AND m.codigo = '".$vend."' 
	  UNION
	  SELECT 
		cc.tipo_doc,
		cc.num_cta,
		cc.fecha,
		cc.cliente,
		c.nombre,
		cc.cod_pago,
		cc.doc_origen,
		CASE
		  WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
		  THEN FORMAT(cc.monto, 2) 
		  ELSE '' 
		END AS fact,
		CASE
		  WHEN cc.tipo_doc IN ('85') 
		  THEN FORMAT(cc.monto, 2) 
		  ELSE '' 
		END AS letra 
	  FROM
		cuenta_ctejf cc 
		LEFT JOIN clientesjf c 
		  ON cc.cliente = c.codigo 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			maestrajf 
		  WHERE tipo_dato = 'tvend') v 
		  ON cc.vendedor = v.codigo 
	  WHERE cc.tip_mov = '-' 
		AND (
		  cc.fecha BETWEEN '".$inicio."' 
		  AND '".$fin."'
		) 
		AND cc.vendedor = '".$vend."'  
	  UNION
	  SELECT 
		'999' AS tipo_doc,
		'' AS num_cta,
		'9999-12-31' AS fecha,
		'' AS cliente,
		'' AS nombre,
		cc.cod_pago,
		'' AS doc_origen,
		FORMAT(
		  SUM(
			CASE
			  WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
			  THEN cc.monto 
			  ELSE '' 
			END
		  ),
		  2
		) AS fact,
		FORMAT(
		  SUM(
			CASE
			  WHEN cc.tipo_doc IN ('85') 
			  THEN cc.monto 
			  ELSE '' 
			END
		  ),
		  2
		) AS letra 
	  FROM
		cuenta_ctejf cc 
		LEFT JOIN clientesjf c 
		  ON cc.cliente = c.codigo 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			maestrajf 
		  WHERE tipo_dato = 'tvend') v 
		  ON cc.vendedor = v.codigo 
	  WHERE cc.tip_mov = '-' 
		AND (
		  cc.fecha BETWEEN '".$inicio."' 
		  AND '".$fin."'
		) 
		AND cc.vendedor = '".$vend."' 
	  GROUP BY cc.cod_pago 
	  ORDER BY cod_pago,
		tipo_doc,
		fecha,
		num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
	}else if($orden1 == "fecha_ven" && $orden2 == "ordNumCuenta" && $canc != "todo"){
		$stmt = Conexion::conectar()->prepare("SELECT 
		cc.tipo_doc,
		cc.num_cta,
		cc.fecha,
		cc.cliente,
		c.nombre,
		cc.cod_pago,
		cc.doc_origen,
		CASE
		  WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
		  THEN FORMAT(cc.monto, 2) 
		  ELSE '' 
		END AS fact,
		CASE
		  WHEN cc.tipo_doc IN ('85') 
		  THEN FORMAT(cc.monto, 2) 
		  ELSE '' 
		END AS letra 
	  FROM
		cuenta_ctejf cc 
		LEFT JOIN clientesjf c 
		  ON cc.cliente = c.codigo 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			maestrajf 
		  WHERE tipo_dato = 'tvend') v 
		  ON cc.vendedor = v.codigo 
	  WHERE cc.tip_mov = '-' 
		AND (
		  cc.fecha BETWEEN '".$inicio."' 
		  AND '".$fin."'
		) 
		AND cc.cod_pago = '".$canc."'  
	  UNION
	  SELECT 
		'999' AS tipo_doc,
		'' AS num_cta,
		'9999-12-31' AS fecha,
		'' AS cliente,
		'' AS nombre,
		cc.cod_pago,
		'' AS doc_origen,
		FORMAT(
		  SUM(
			CASE
			  WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
			  THEN cc.monto 
			  ELSE '' 
			END
		  ),
		  2
		) AS fact,
		FORMAT(
		  SUM(
			CASE
			  WHEN cc.tipo_doc IN ('85') 
			  THEN cc.monto 
			  ELSE '' 
			END
		  ),
		  2
		) AS letra 
	  FROM
		cuenta_ctejf cc 
		LEFT JOIN clientesjf c 
		  ON cc.cliente = c.codigo 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			maestrajf 
		  WHERE tipo_dato = 'tvend') v 
		  ON cc.vendedor = v.codigo 
	  WHERE cc.tip_mov = '-' 
		AND (
		  cc.fecha BETWEEN '".$inicio."' 
		  AND '".$fin."'
		) 
		AND cc.cod_pago = '".$canc."' 
	  GROUP BY cc.cod_pago 
	  ORDER BY cod_pago,
		tipo_doc,
		fecha,
		num_cta ");
			
		  $stmt -> execute();

		  return $stmt -> fetchAll();
	}
		


		$stmt -> close();

		$stmt = null;


    }

	static public function mdlMostrarReporteTotalCobrar($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

		
		$stmt = Conexion::conectar()->prepare("SELECT 
		FORMAT(SUM(cc.saldo), 2) AS saldo_total 
		FROM
		cuenta_ctejf cc 
		LEFT JOIN clientesjf c 
		ON cc.cliente = c.codigo 
		WHERE cc.tip_mov = '+' 
		AND cc.estado = 'Pendiente' 
		ORDER BY cc.tipo_doc ");
		// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();
		

		$stmt -> close();

		$stmt = null;

    }

	static public function mdlMostrarReporteTotalVencidos($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

			
			$stmt = Conexion::conectar()->prepare("SELECT 
			FORMAT(SUM(cc.saldo), 2) AS saldo_total 
			FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			ON cc.cliente = c.codigo 
			WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
		    AND NOW()>cc.fecha_ven  
			ORDER BY cc.tipo_doc ");
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
	
			$stmt -> close();
	
			$stmt = null;
	
		}

		static public function mdlMostrarReporteTotalNoVencidos($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

				$stmt = Conexion::conectar()->prepare("SELECT 
				FORMAT(SUM(cc.saldo), 2) AS saldo_total 
				FROM
				cuenta_ctejf cc 
				LEFT JOIN clientesjf c 
				ON cc.cliente = c.codigo 
				WHERE cc.tip_mov = '+' 
				AND cc.estado = 'Pendiente' 
				AND NOW()<cc.fecha_ven  
				ORDER BY cc.tipo_doc ");
				// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
		
				$stmt -> execute();
		
				return $stmt -> fetch();
				
		
				$stmt -> close();
		
				$stmt = null;
		
			}

			static public function mdlMostrarReporteTotalProtestados($tabla,$orden1,$orden2,$tip_doc,$cli,$vend,$banco){

		
				$stmt = Conexion::conectar()->prepare("SELECT 
				FORMAT(SUM(cc.saldo), 2) AS saldo_total 
				FROM
				cuenta_ctejf cc 
				LEFT JOIN clientesjf c 
				ON cc.cliente = c.codigo 
				WHERE cc.tip_mov = '+' 
				AND cc.estado = 'Pendiente'
				AND cc.protesta = 1  
				ORDER BY cc.tipo_doc ");
				// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
		
				$stmt -> execute();
		
				return $stmt -> fetch();
				
		
				$stmt -> close();
		
				$stmt = null;
		
			}

			static public function mdlMostrarReporteTotalPagos($tabla,$orden1,$orden2,$canc,$vend,$inicio,$fin){

				if($orden1 == "fecha_ven" && $orden2 == "ordNumCuenta"){
					$stmt = Conexion::conectar()->prepare("SELECT 
					'Total General' AS total_gral,
					FORMAT(
					  SUM(
						CASE
						  WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
						  THEN cc.monto 
						  ELSE '' 
						END
					  ),
					  2
					) AS fact,
					FORMAT(
					  SUM(
						CASE
						  WHEN cc.tipo_doc IN ('85') 
						  THEN cc.monto 
						  ELSE '' 
						END
					  ),
					  2
					) AS letra 
				  FROM
					cuenta_ctejf cc 
					LEFT JOIN clientesjf c 
					  ON cc.cliente = c.codigo 
					LEFT JOIN 
					  (SELECT 
						* 
					  FROM
						maestrajf 
					  WHERE tipo_dato = 'tvend') v 
					  ON cc.vendedor = v.codigo 
				  WHERE cc.tip_mov = '-' 
					AND (
					  cc.fecha BETWEEN '".$inicio."' 
					 AND '".$fin."'
					) ");
					// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
			
					$stmt -> execute();
			
					return $stmt -> fetch();
				}else if ($orden1 == "vendedor" && $orden2 == "ordNumCuenta"){
					$stmt = Conexion::conectar()->prepare("SELECT 
					'Total General' AS total_gral,
					cc.vendedor, 
					FORMAT(
					  SUM(
						CASE
						  WHEN cc.tipo_doc IN ('01', '03', '09', '08', '07') 
						  THEN cc.monto 
						  ELSE '' 
						END
					  ),
					  2
					) AS fact,
					FORMAT(
					  SUM(
						CASE
						  WHEN cc.tipo_doc IN ('85') 
						  THEN cc.monto 
						  ELSE '' 
						END
					  ),
					  2
					) AS letra 
				  FROM
					cuenta_ctejf cc 
					LEFT JOIN clientesjf c 
					  ON cc.cliente = c.codigo 
					LEFT JOIN 
					  (SELECT 
						* 
					  FROM
						maestrajf 
					  WHERE tipo_dato = 'tvend') v 
					  ON cc.vendedor = v.codigo 
				  WHERE cc.tip_mov = '-' 
					AND (
					  cc.fecha BETWEEN '".$inicio."' 
					 AND '".$fin."'
					) AND cc.vendedor= '".$vend."'  
				  GROUP BY cc.vendedor ");
					// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
			
					$stmt -> execute();
			
					return $stmt -> fetch();
				}
				
				
		
				$stmt -> close();
		
				$stmt = null;
		
			}

	static public function mdlMostrarReporteNombre($tabla,$cli,$vend){	

		if(isset($cli)){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			c.nombre,
			FORMAT(SUM(cc.saldo), 2) AS saldo_total 
			FROM
				cuenta_ctejf cc 
				LEFT JOIN clientesjf c 
				ON cc.cliente = c.codigo 
			WHERE cc.tip_mov = '+' 
				AND cc.estado = 'Pendiente' 
				AND cc.cliente = '".$cli."' 
			GROUP BY cc.cliente 
			  ORDER BY cc.tipo_doc");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.vendedor,
			v.descripcion,
			FORMAT(SUM(cc.saldo),2) AS total_general
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."' 
		  GROUP BY cc.vendedor 
		  ORDER BY cc.tipo_doc ");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}
		

		$stmt -> close();

		$stmt = null;

    }

	static public function mdlMostrarReporteNombreVencidos($tabla,$cli,$vend){	

		if(isset($cli)){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			c.nombre,
			FORMAT(SUM(cc.saldo), 2) AS saldo_total 
			FROM
				cuenta_ctejf cc 
				LEFT JOIN clientesjf c 
				ON cc.cliente = c.codigo 
			WHERE cc.tip_mov = '+' 
				AND cc.estado = 'Pendiente' 
				AND cc.cliente = '".$cli."' 
		    	AND NOW()>cc.fecha_ven  
			GROUP BY cc.cliente 
			  ORDER BY cc.tipo_doc ");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.vendedor,
			v.descripcion,
			FORMAT(SUM(cc.saldo),2) AS total_general
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."'
			AND NOW()>cc.fecha_ven  
		  GROUP BY cc.vendedor 
		  ORDER BY cc.tipo_doc ;");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}
		

		$stmt -> close();

		$stmt = null;

    }

	static public function mdlMostrarReporteNombreNoVencidos($tabla,$cli,$vend){	

		if(isset($cli)){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			c.nombre
			FORMAT(SUM(cc.saldo), 2) AS saldo_total 
			FROM
				cuenta_ctejf cc 
				LEFT JOIN clientesjf c 
				ON cc.cliente = c.codigo 
			WHERE cc.tip_mov = '+' 
				AND cc.estado = 'Pendiente' 
				AND cc.cliente = '".$cli."' 
				AND NOW()<cc.fecha_ven  
			GROUP BY cc.cliente 
			  ORDER BY cc.tipo_doc ");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.vendedor,
			v.descripcion,
			FORMAT(SUM(cc.saldo),2) AS total_general
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."'
			AND NOW()<cc.fecha_ven  
		  GROUP BY cc.vendedor 
		  ORDER BY cc.tipo_doc ;");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}
		

		$stmt -> close();

		$stmt = null;

    }

	static public function mdlMostrarReporteNombreProtestados($tabla,$cli,$vend){	

		if(isset($cli)){
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.cliente,
			c.nombre,
			FORMAT(SUM(cc.saldo), 2) AS saldo_total 
			FROM
				cuenta_ctejf cc 
				LEFT JOIN clientesjf c 
				ON cc.cliente = c.codigo 
			WHERE cc.tip_mov = '+' 
				AND cc.estado = 'Pendiente' 
				AND cc.cliente = '".$cli."'
				AND cc.protesta = 1   
			GROUP BY cc.cliente 
			  ORDER BY cc.tipo_doc");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			cc.vendedor,
			v.descripcion,
			FORMAT(SUM(cc.saldo),2) AS total_general
		  FROM
			cuenta_ctejf cc 
			LEFT JOIN clientesjf c 
			  ON cc.cliente = c.codigo 
			LEFT JOIN 
			  (SELECT 
				* 
			  FROM
				maestrajf 
			  WHERE tipo_dato = 'tvend') v 
			  ON cc.vendedor = v.codigo 
		  WHERE cc.tip_mov = '+' 
			AND cc.estado = 'Pendiente' 
			AND cc.vendedor = '".$vend."'
			AND cc.protesta = 1   
		  GROUP BY cc.vendedor 
		  ORDER BY cc.tipo_doc ");
	
			// $stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();
		}
		

		$stmt -> close();

		$stmt = null;

    }
	
   


}