<?php
require_once "conexion.php";

class ModeloFacturacion{

	/*
	* REGISTAR MOVIMIENTOS 
	*/
	static public function mdlRegistrarMovimientos($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO movimientosjf_2021 (
                                                    tipo,
                                                    documento,
                                                    fecha,
                                                    articulo,
                                                    cliente,
                                                    vendedor,
                                                    cantidad,
                                                    precio,
                                                    dscto1,
                                                    dscto2,
                                                    total,
                                                    nombre_tipo
                                                )
                                                VALUES
                                                    (
                                                    :tipo,
                                                    :documento,
                                                    DATE(NOW()),
                                                    :articulo,
                                                    :cliente,
                                                    :vendedor,
                                                    :cantidad,
                                                    :precio,
                                                    '0',
                                                    :dscto2,
                                                    :total,
                                                    :nombre_tipo
                                                    )");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":dscto2", $datos["dscto2"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_tipo", $datos["nombre_tipo"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }
    
	/*
	* REGISTAR DOCUMENTO 
	*/
	static public function mdlRegistrarDocumento($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventajf (
                                                        tipo,
                                                        documento,
                                                        neto,
                                                        igv,
                                                        dscto,
                                                        total,
                                                        cliente,
                                                        vendedor,
                                                        agencia,
                                                        fecha,
                                                        tipo_documento,
                                                        lista_precios,
                                                        condicion_venta,
                                                        doc_destino,
                                                        doc_origen,
                                                        usuario
                                                    )
                                                    VALUES
                                                        (
                                                        :tipo,
                                                        :documento,
                                                        :neto,
                                                        :igv,
                                                        :dscto,
                                                        :total,
                                                        :cliente,
                                                        :vendedor,
                                                        :agencia,
                                                        DATE(NOW()),
                                                        :tipo_documento,
                                                        :lista_precios,
                                                        :condicion_venta,
                                                        :doc_destino,
                                                        :doc_origen,
                                                        :usuario
                                                        )");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
        $stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
        $stmt->bindParam(":dscto", $datos["dscto"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
        $stmt->bindParam(":lista_precios", $datos["lista_precios"], PDO::PARAM_STR);
        $stmt->bindParam(":condicion_venta", $datos["condicion_venta"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_destino", $datos["doc_destino"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 GUIA
    */
	static public function mdlActualizarTalonarioGuia($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    guias_remision = guias_remision + 1
                WHERE serie_guias = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 FACTURA
    */
	static public function mdlActualizarTalonarioFactura($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    facturas = facturas + 1
                WHERE serie_factura = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 BOLETA
    */
	static public function mdlActualizarTalonarioBoleta($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    boletas = boletas + 1
                WHERE serie_boletas = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 PROFORMA
    */
	static public function mdlActualizarTalonarioProforma($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    proformas = proformas + 1
                WHERE serie_proformas = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR PEDIDO A FACTURADO
    */
	static public function mdlActualizarPedidoF($codigo){

		$sql="UPDATE
                    temporaljf
                SET
                    estado = 'FACTURADO'
                WHERE codigo = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 FACTURA
    */
	static public function mdlGenerarCtaCte($datos){

		$sql="INSERT INTO cuenta_ctejf (
                        tipo_doc,
                        num_cta,
                        cliente,
                        vendedor,
                        fecha,
                        fecha_ven,
                        monto,
                        cod_pago,
                        doc_origen,
                        usuario,
                        saldo
                    )
                    VALUES
                        (
                        :tipo_doc,
                        :num_cta,
                        :cliente,
                        :vendedor,
                        DATE(NOW()),
                        :fecha_ven,
                        :monto,
                        :cod_pago,
                        :num_cta,
                        :usuario,
                        :saldo
                        )";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ven", $datos["fecha_ven"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_pago", $datos["cod_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);

		if ($stmt->execute()) {

            return "ok";

		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostrarTablas($tipo, $estado, $valor){

		if($valor == null){

			$sql="SELECT
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.total,
                    v.cliente,
                    c.nombre,
                    c.tipo_documento AS tip_doc,
                    c.documento AS num_doc,
                    v.vendedor,
                    v.fecha,
                    cv.descripcion,
                    v.doc_destino,
                    LEFT(v.doc_destino,4) AS serie_dest,
                    SUBSTR(v.doc_destino,5,8) AS nro_dest,
                    v.estado,
                    IFNULL(a.nombre, '') AS agencia,
                    IFNULL(u.nom_ubi, '') AS ubigeo
                FROM
                    ventajf v
                    LEFT JOIN clientesjf c
                    ON v.cliente = c.codigo
                    LEFT JOIN condiciones_ventajf cv
                    ON v.condicion_venta = cv.id
                    LEFT JOIN agenciasjf a
                    ON v.agencia = a.id
                    LEFT JOIN ubigeojf u
                    ON c.ubigeo = u.cod_ubi
                WHERE v.tipo = :tipo
                    AND v.estado = :estado";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		}else{

			$sql="SELECT
                    v.tipo_documento,
                    v.documento,
                    v.total,
                    v.cliente,
                    c.nombre,
                    c.tipo_documento AS tip_doc,
                    c.documento AS num_doc,
                    v.vendedor,
                    v.fecha,
                    cv.descripcion,
                    v.doc_destino,
                    LEFT(v.doc_destino,4) AS serie_dest,
                    SUBSTR(v.doc_destino,5,8) AS nro_dest,
                    v.estado,
                    IFNULL(a.nombre, '') AS agencia,
                    IFNULL(u.nom_ubi, '') AS ubigeo
                FROM
                    ventajf v
                    LEFT JOIN clientesjf c
                    ON v.cliente = c.codigo
                    LEFT JOIN condiciones_ventajf cv
                    ON v.condicion_venta = cv.id
                    LEFT JOIN agenciasjf a
                    ON v.agencia = a.id
                    LEFT JOIN ubigeojf u
                    ON c.ubigeo = u.cod_ubi
                WHERE v.tipo = :tipo
                    AND v.estado = :estado
                    AND v.documento = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		}

		$stmt=null;

    }

	/*
	* REGISTAR MOVIMIENTO DESDE GUIA
	*/
	static public function mdlFacturarGuiaM($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO movimientosjf_2021 (
                                                            tipo,
                                                            documento,
                                                            fecha,
                                                            articulo,
                                                            cliente,
                                                            vendedor,
                                                            cantidad,
                                                            precio,
                                                            dscto2,
                                                            total,
                                                            nombre_tipo
                                                        )
                                                        (SELECT
                                                            :tipo,
                                                            :documento,
                                                            :fecha,
                                                            m.articulo,
                                                            m.cliente,
                                                            m.vendedor,
                                                            m.cantidad,
                                                            m.precio,
                                                            m.dscto2,
                                                            m.total,
                                                            :nombre_tipo
                                                        FROM
                                                            movimientosjf_2021 m
                                                        WHERE m.documento = :codigo
                                                            AND m.tipo = :tipo_documento)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_tipo", $datos["nombre_tipo"], PDO::PARAM_STR);





		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

	/*
	* REGISTAR VENTA DESDE GUIA
	*/
	static public function mdlFacturarGuiaV($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventajf (
                                                                tipo,
                                                                documento,
                                                                neto,
                                                                igv,
                                                                dscto,
                                                                total,
                                                                cliente,
                                                                vendedor,
                                                                agencia,
                                                                fecha,
                                                                tipo_documento,
                                                                lista_precios,
                                                                condicion_venta,
                                                                doc_origen,
                                                                usuario
                                                            )
                                                            (SELECT
                                                                :tipo,
                                                                :documento,
                                                                v.neto,
                                                                v.igv,
                                                                v.dscto,
                                                                v.total,
                                                                v.cliente,
                                                                v.vendedor,
                                                                v.agencia,
                                                                v.fecha,
                                                                :tipo_documento,
                                                                v.lista_precios,
                                                                v.condicion_venta,
                                                                :codigo,
                                                                :usuario
                                                            FROM
                                                                ventajf v
                                                            WHERE v.documento = :codigo
                                                                AND v.tipo = :tipo_ori)");

        $stmt->bindParam(":codigo", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_ori", $datos["tipo_ori"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

    /*
    * ACTUALIZAR GUIA A FACTURADO
    */
	static public function mdlActualizarGuiaF($codigo){

		$sql="UPDATE
                    ventajf
                SET
                    estado = 'FACTURADO'
                WHERE documento = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraVentaDocumento($valor, $tipoDoc){

		if($valor == null){

			$sql="SELECT
                        *
                    FROM
                        ventajf v";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		}else{

			$sql="SELECT
                        v.tipo,
                        v.documento,
                        v.neto,
                        v.igv,
                        v.dscto,
                        v.total,
                        v.cliente,
                        v.vendedor,
                        v.agencia,
                        v.fecha,
                        v.tipo_documento,
                        v.lista_precios,
                        v.condicion_venta,
                        cv.descripcion,
                        cv.dias,
                        v.doc_destino,
                        v.doc_origen
                    FROM
                        ventajf v
                        LEFT JOIN condiciones_ventajf cv
                        ON v.condicion_venta = cv.id
                    WHERE v.documento = :codigo
                        AND v.tipo = :tipo_doc";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		}

		$stmt=null;

	}
  
/*
    * MOSTRAR IMPRESION DE NOTA DE DEBITO
    */
    static public function mdlMostrarDebitoImpresion($valor, $tipoDoc){

			$sql="SELECT 
      v.tipo,
      v.documento,
      v.neto,
      v.igv,
      v.dscto,
      v.total,
      v.doc_origen as origen2,
      n.observacion,
      n.doc_origen,
      n.motivo,
      (SELECT 
        descripcion 
      FROM
        maestrajf m 
      WHERE m.tipo_dato = 'TMOTD' 
        AND n.motivo = m.codigo) AS nom_motivo,
      DATE_FORMAT(n.fecha_origen,'%Y-%m-%d') AS fecha_origen,
      v.cliente,
      c.nombre,
      c.documento as dni,
      c.direccion,
      c.email,
      CONCAT(u.distrito, ' / ', u.provincia) AS nom_ubigeo,
      u.departamento,
      c.ubigeo,
      v.agencia,
      DATE_FORMAT(v.fecha,'%d/%m/%Y') AS fecha,
      v.fecha AS fecha_emision,
      v.tipo_documento,
      v.lista_precios,
      v.condicion_venta,
      cv.descripcion,
      v.vendedor,
      ven.descripcion AS nom_vendedor,
      cv.dias,
      v.doc_destino
    FROM
      ventajf v 
      LEFT JOIN condiciones_ventajf cv 
        ON v.condicion_venta = cv.id 
      LEFT JOIN clientesjf c 
        ON v.cliente = c.codigo 
      LEFT JOIN ubigeo u 
        ON c.ubigeo = u.codigo 
        LEFT JOIN notascd_jf n
        ON v.documento=n.documento AND v.tipo=n.tipo
      LEFT JOIN 
        (SELECT 
          codigo,
          descripcion 
        FROM
          maestrajf m 
        WHERE m.tipo_dato = 'TVEND') ven 
        ON v.vendedor = ven.codigo 
    WHERE v.documento = :codigo
    AND v.tipo = :tipo_doc";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();


		$stmt=null;

	}
    
  /*
    * MOSTRAR IMPRESION DE FACTURA
    */
	static public function mdlMostrarVentaImpresion($valor, $tipoDoc){

        $sql="SELECT 
        v.tipo,
        v.documento,
        v.neto,
        v.igv,
        v.dscto,
        v.total,
        n.observacion,
        n.tipo_doc,
        n.tip_cont,
        n.doc_origen,
        n.motivo,
        (SELECT 
          descripcion 
        FROM
          maestrajf m 
        WHERE m.tipo_dato = 'TMOT' 
          AND n.motivo = m.codigo) AS nom_motivo,
        DATE_FORMAT(n.fecha_origen,'%Y-%m-%d') AS fecha_origen,
        v.cliente,
        c.nombre,
        c.documento as dni,
        c.direccion,
        c.email,
        CONCAT(u.distrito, ' / ', u.provincia) AS nom_ubigeo,
        u.departamento,
        c.ubigeo,
        v.agencia,
        DATE_FORMAT(v.fecha,'%d/%m/%Y') AS fecha,
        v.fecha AS fecha_emision,
        v.tipo_documento,
        v.lista_precios,
        v.condicion_venta,
        cv.descripcion,
        v.vendedor,
        ven.descripcion AS nom_vendedor,
        cv.dias,
        v.doc_destino
        FROM
        ventajf v 
        LEFT JOIN condiciones_ventajf cv 
            ON v.condicion_venta = cv.id 
        LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
            ON c.ubigeo = u.codigo 
            LEFT JOIN notascd_jf n
            ON v.documento=n.documento AND v.tipo=n.tipo
        LEFT JOIN 
            (SELECT 
            codigo,
            descripcion 
            FROM
            maestrajf m 
            WHERE m.tipo_dato = 'TVEND') ven 
            ON v.vendedor = ven.codigo 
        WHERE v.documento = :codigo
        AND v.tipo = :tipo_doc";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
            $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetch();


            $stmt=null;

        }

        /*
    * MOSTRAR IMPRESION DE NOTA DE CREDITO
    */
	static public function mdlMostrarCreditoImpresion($valor, $tipoDoc){

    $sql="SELECT 
    v.tipo,
    v.documento,
    v.neto,
    v.igv,
    v.dscto,
    v.total,
    n.observacion,
    n.doc_origen,
    n.motivo,
    (SELECT 
      descripcion 
    FROM
      maestrajf m 
    WHERE m.tipo_dato = 'TMOT' 
      AND n.motivo = m.codigo) AS nom_motivo,
    (SELECT 
    descripcion 
  FROM
    maestrajf m 
  WHERE m.tipo_dato = 'TCON' 
    AND n.tip_cont = m.codigo) AS nom_tipo_con,
    DATE_FORMAT(n.fecha_origen,'%Y-%m-%d') AS fecha_origen,
    v.cliente,
    c.nombre,
    c.documento as dni,
    c.direccion,
    c.email,
    CONCAT(u.distrito, ' / ', u.provincia) AS nom_ubigeo,
    u.departamento,
    c.ubigeo,
    v.agencia,
    DATE_FORMAT(v.fecha,'%d/%m/%Y') AS fecha,
    v.fecha AS fecha_emision,
    v.tipo_documento,
    v.lista_precios,
    v.condicion_venta,
    cv.descripcion,
    v.vendedor,
    ven.descripcion AS nom_vendedor,
    cv.dias,
    v.doc_destino
    FROM
    ventajf v 
    LEFT JOIN condiciones_ventajf cv 
        ON v.condicion_venta = cv.id 
    LEFT JOIN clientesjf c 
        ON v.cliente = c.codigo 
    LEFT JOIN ubigeo u 
        ON c.ubigeo = u.codigo 
        LEFT JOIN notascd_jf n
        ON v.documento=n.documento AND v.tipo=n.tipo
    LEFT JOIN 
        (SELECT 
        codigo,
        descripcion 
        FROM
        maestrajf m 
        WHERE m.tipo_dato = 'TVEND') ven 
        ON v.vendedor = ven.codigo 
    WHERE v.documento = :codigo
    AND v.tipo = :tipo_doc";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();


        $stmt=null;

    }

        /*
        * MOSTRAR MODELO PARA NC , FACTURA Y BOLETA
        */
        static public function mdlMostrarModeloImpresion($valor, $tipoDoc){

        $sql="SELECT 
        a.modelo,
        ROUND(SUM(cantidad), 0) AS cantidad,
        'C62' AS unidad,
        a.nombre,
        ROUND(m.precio, 2) AS precio,
        ROUND(m.dscto1, 2) AS dscto1,
        ROUND(SUM(m.cantidad * m.precio), 2) AS total 
        FROM
        movimientosjf_2021 m 
        LEFT JOIN articulojf a 
        ON m.articulo = a.articulo 
        WHERE m.tipo = :tipo_doc 
        AND m.documento = :codigo 
        GROUP BY a.modelo ";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt=null;

        }

    /*
    * MOSTRAR MODELO PROFORMA IMPRESION
    */
    static public function mdlMostrarModeloProforma($valor, $tipoDoc){

        $sql="SELECT 
        a.modelo,
        ROUND(SUM(cantidad), 0) AS cantidad,
        'C62' AS unidad,
        a.nombre,
        ROUND(m.precio * 1.18, 2) AS precio,
        ROUND(m.dscto1, 2) AS dscto1,
        ROUND(SUM(m.cantidad * m.precio) * 1.18, 2) AS total 
        FROM
        movimientosjf_2021 m 
        LEFT JOIN articulojf a 
            ON m.articulo = a.articulo
        WHERE m.tipo = :tipo_doc 
        AND m.documento = :codigo 
        GROUP BY a.modelo ";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);
            $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt=null;

    }

    /*
    * MOSTRAR NUMERO DE UNIDADES BOLETA FACTURA
    */
    static public function mdlMostrarUnidadesImpresion($valor, $tipoDoc){

        $sql="SELECT 
        m.documento,
        ROUND(SUM(cantidad), 0) AS cantidad 
        FROM
        movimientosjf_2021 m 
        WHERE m.tipo = :tipo_doc 
        AND m.documento = :codigo 
        GROUP BY m.documento  ";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);
            $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();


        $stmt=null;

    }

      /*=============================================
	MOSTRAR TIPO DE PAGO
	=============================================*/

	static public function mdlMostrarTalonarios($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT nota_credito FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT serie_nc FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    static public function mdlMostrarTalonariosDebito($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT nota_debito FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT serie_nd FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    	/*
	* REGISTAR DOCUMENTO  VENTA CON NOTA DE CREDITO O DEBITO
	*/
	static public function mdlRegistrarVentaNota($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventajf (
                                                        tipo,
                                                        documento,
                                                        neto,
                                                        igv,
                                                        dscto,
                                                        total,
                                                        cliente,
                                                        vendedor,
                                                        agencia,
                                                        fecha,
                                                        lista_precios,
                                                        tipo_documento,
                                                        doc_destino,
                                                        doc_origen,
                                                        usuario,
                                                        estado
                                                    )
                                                    VALUES
                                                        (
                                                        :tipo,
                                                        :documento,
                                                        :neto,
                                                        :igv,
                                                        0,
                                                        :total,
                                                        :cliente,
                                                        :vendedor,
                                                        '',
                                                        :fecha,
                                                        '',
                                                        :tipo_documento,
                                                        '',
                                                        :doc_origen,
                                                        :usuario,
                                                        'FACTURADO'
                                                        )");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
        $stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

     	/*
	* EDITAR DOCUMENTO  VENTA CON NOTA DE CREDITO O DEBITO
	*/
	static public function mdlEditarVentaNota($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventajf SET 
                                                        tipo = :tipo,
                                                        documento = :documento,
                                                        neto = :neto,
                                                        igv = :igv,
                                                        total = :total,
                                                        cliente = :cliente,
                                                        vendedor = :vendedor,
                                                        fecha = :fecha,
                                                        doc_origen = :doc_origen,
                                                        usuario = :usuario
                                                    WHERE tipo = :tipo
                                                    AND documento = :documento");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
        $stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

     /*
    * Ingresar Notas de credito o debito 
    */
	static public function mdlIngresarNotaCD($datos){

		$sql="INSERT INTO notascd_jf (
                        tipo,
                        documento,
                        tipo_doc,
                        doc_origen,
                        fecha_origen,
                        motivo,
                        tip_cont,
                        observacion,
                        usuario
                    )
                    VALUES
                        (
                        :tipo,
                        :documento,
                        :tipo_doc,
                        :doc_origen,
                        :fecha_origen,
                        :motivo,
                        :tip_cont,
                        :observacion,
                        :usuario
                        )";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_origen", $datos["fecha_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":tip_cont", $datos["tip_cont"], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

            return "ok";

		} else {

			return "error";
		}

		$stmt=null;

    }

     	/*
	* EDITAR NOTA DE CREDITO O DEBITO
	*/
	static public function mdlEditarNotaCD($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE notascd_jf SET 
                                                        tipo = :tipo,
                                                        documento = :documento,
                                                        tipo_doc = :tipo_doc,
                                                        doc_origen = :doc_origen,
                                                        fecha_origen = :fecha_origen,
                                                        motivo = :motivo,
                                                        tip_cont = :tip_cont,
                                                        observacion = :observacion,
                                                        usuario = :usuario
                                                    WHERE tipo = :tipo
                                                    AND documento = :documento");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_origen", $datos["fecha_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":tip_cont", $datos["tip_cont"], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }
    
    /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasNotasCD($fechaInicial,$fechaFinal){

        if($fechaInicial=="null"){
    
          $sql="SELECT 
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          v.usuario,
          u.nombre as nombres,
          v.estado,
          v.fecha 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN usuariosjf u 
            ON v.usuario = u.id 
        WHERE v.tipo IN ('E05', 'E23') 
          AND YEAR(v.fecha) = 2021";
    
          $stmt=Conexion::conectar()->prepare($sql);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else if($fechaInicial == $fechaFinal){
    
          $sql="SELECT 
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          v.usuario,
          u.nombre as nombres,
          v.estado,
          v.fecha 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN usuariosjf u 
            ON v.usuario = u.id 
        WHERE v.tipo IN ('E05', 'E23') 
          AND DATE(v.fecha)  like '%$fechaFinal%' ";
    
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
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            v.usuario,
            u.nombre as nombres,
            v.estado,
            v.fecha 
          FROM
            ventajf v 
            LEFT JOIN clientesjf c 
              ON v.cliente = c.codigo 
            LEFT JOIN usuariosjf u 
              ON v.usuario = u.id 
          WHERE v.tipo IN ('E05', 'E23') 
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
          $stmt->execute();
    
          return $stmt->fetchAll();
    
          }else{
    
            $sql="SELECT 
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            v.usuario,
            u.nombre as nombres,
            v.estado,
            v.fecha 
          FROM
            ventajf v 
            LEFT JOIN clientesjf c 
              ON v.cliente = c.codigo 
            LEFT JOIN usuariosjf u 
              ON v.usuario = u.id 
          WHERE v.tipo IN ('E05', 'E23') 
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
            $stmt=Conexion::conectar()->prepare($sql);
    
            $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();
          }
    
        }
    
          $stmt=null;
    
      }

     /*
    * ACTUALIZAR PEDIDO A FACTURADO
    */
	static public function mdlActualizarPedido($codigo,$estado,$usuario){

		$sql="UPDATE
                    temporaljf
                SET
                    estado = :estado,
                    usuario_estado = :usuario_estado
                WHERE codigo = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":usuario_estado", $usuario, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

     /*
    * ACTUALIZAR PEDIDO DE ARTICULO
    */
	static public function mdlActualizarArticuloPedido($codigo,$pedido){

		$sql="UPDATE articulojf SET pedidos = pedidos + :pedido WHERE articulo = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $stmt->bindParam(":pedido", $pedido, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

            /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasFacturas($fechaInicial,$fechaFinal){

        if($fechaInicial=="null"){
    
          $sql="SELECT
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_origen,
          v.doc_destino,
          LEFT(v.doc_destino,4) AS serie_dest,
          SUBSTR(v.doc_destino,5,8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          v.facturacion
      FROM
          ventajf v
          LEFT JOIN clientesjf c
          ON v.cliente = c.codigo
          LEFT JOIN condiciones_ventajf cv
          ON v.condicion_venta = cv.id
          LEFT JOIN agenciasjf a
          ON v.agencia = a.id
          LEFT JOIN ubigeojf u
          ON c.ubigeo = u.cod_ubi
      WHERE v.tipo = 'S03'
          AND YEAR(v.fecha) = 2021";
    
          $stmt=Conexion::conectar()->prepare($sql);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else if($fechaInicial == $fechaFinal){
    
          $sql="SELECT
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_origen,
          v.doc_destino,
          LEFT(v.doc_destino,4) AS serie_dest,
          SUBSTR(v.doc_destino,5,8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          v.facturacion
      FROM
          ventajf v
          LEFT JOIN clientesjf c
          ON v.cliente = c.codigo
          LEFT JOIN condiciones_ventajf cv
          ON v.condicion_venta = cv.id
          LEFT JOIN agenciasjf a
          ON v.agencia = a.id
          LEFT JOIN ubigeojf u
          ON c.ubigeo = u.cod_ubi
      WHERE v.tipo = 'S03'
          AND DATE(v.fecha)  like '%$fechaFinal%' ";
    
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
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_origen,
            v.doc_destino,
            LEFT(v.doc_destino,4) AS serie_dest,
            SUBSTR(v.doc_destino,5,8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            v.facturacion
        FROM
            ventajf v
            LEFT JOIN clientesjf c
            ON v.cliente = c.codigo
            LEFT JOIN condiciones_ventajf cv
            ON v.condicion_venta = cv.id
            LEFT JOIN agenciasjf a
            ON v.agencia = a.id
            LEFT JOIN ubigeojf u
            ON c.ubigeo = u.cod_ubi
        WHERE v.tipo = 'S03'
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
          $stmt->execute();
    
          return $stmt->fetchAll();
    
          }else{
    
            $sql="SELECT
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_origen,
            v.doc_destino,
            LEFT(v.doc_destino,4) AS serie_dest,
            SUBSTR(v.doc_destino,5,8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            v.facturacion
        FROM
            ventajf v
            LEFT JOIN clientesjf c
            ON v.cliente = c.codigo
            LEFT JOIN condiciones_ventajf cv
            ON v.condicion_venta = cv.id
            LEFT JOIN agenciasjf a
            ON v.agencia = a.id
            LEFT JOIN ubigeojf u
            ON c.ubigeo = u.cod_ubi
        WHERE v.tipo = 'S03'
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
            $stmt=Conexion::conectar()->prepare($sql);
    
            $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();
          }
    
        }
    
          $stmt=null;
    
      }
    
        /*
        * Método para mostrar produccion de trusas
        */
        static public function mdlRangoFechasBoletas($fechaInicial,$fechaFinal){
    
        if($fechaInicial=="null"){
    
          $sql="SELECT
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_destino,
          LEFT(v.doc_destino,4) AS serie_dest,
          SUBSTR(v.doc_destino,5,8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          v.facturacion
      FROM
          ventajf v
          LEFT JOIN clientesjf c
          ON v.cliente = c.codigo
          LEFT JOIN condiciones_ventajf cv
          ON v.condicion_venta = cv.id
          LEFT JOIN agenciasjf a
          ON v.agencia = a.id
          LEFT JOIN ubigeojf u
          ON c.ubigeo = u.cod_ubi
      WHERE v.tipo = 'S02'
          AND YEAR(v.fecha) = 2021";
    
          $stmt=Conexion::conectar()->prepare($sql);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else if($fechaInicial == $fechaFinal){
    
          $sql="SELECT
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_destino,
          LEFT(v.doc_destino,4) AS serie_dest,
          SUBSTR(v.doc_destino,5,8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          v.facturacion
      FROM
          ventajf v
          LEFT JOIN clientesjf c
          ON v.cliente = c.codigo
          LEFT JOIN condiciones_ventajf cv
          ON v.condicion_venta = cv.id
          LEFT JOIN agenciasjf a
          ON v.agencia = a.id
          LEFT JOIN ubigeojf u
          ON c.ubigeo = u.cod_ubi
      WHERE v.tipo = 'S02'
          AND DATE(v.fecha)  like '%$fechaFinal%' ";
    
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
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_destino,
            LEFT(v.doc_destino,4) AS serie_dest,
            SUBSTR(v.doc_destino,5,8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            v.facturacion
        FROM
            ventajf v
            LEFT JOIN clientesjf c
            ON v.cliente = c.codigo
            LEFT JOIN condiciones_ventajf cv
            ON v.condicion_venta = cv.id
            LEFT JOIN agenciasjf a
            ON v.agencia = a.id
            LEFT JOIN ubigeojf u
            ON c.ubigeo = u.cod_ubi
        WHERE v.tipo = 'S02'
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
          $stmt->execute();
    
          return $stmt->fetchAll();
    
          }else{
    
            $sql="SELECT
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_destino,
            LEFT(v.doc_destino,4) AS serie_dest,
            SUBSTR(v.doc_destino,5,8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            v.facturacion
        FROM
            ventajf v
            LEFT JOIN clientesjf c
            ON v.cliente = c.codigo
            LEFT JOIN condiciones_ventajf cv
            ON v.condicion_venta = cv.id
            LEFT JOIN agenciasjf a
            ON v.agencia = a.id
            LEFT JOIN ubigeojf u
            ON c.ubigeo = u.cod_ubi
        WHERE v.tipo = 'S02'
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
            $stmt=Conexion::conectar()->prepare($sql);
    
            $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();
          }
    
        }
    
          $stmt=null;
    
      }
    
        /*
        * Método para mostrar produccion de trusas
        */
        static public function mdlRangoFechasProformas($fechaInicial,$fechaFinal){
    
        if($fechaInicial=="null"){
    
          $sql="SELECT
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_destino,
          LEFT(v.doc_destino,4) AS serie_dest,
          SUBSTR(v.doc_destino,5,8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          v.facturacion
      FROM
          ventajf v
          LEFT JOIN clientesjf c
          ON v.cliente = c.codigo
          LEFT JOIN condiciones_ventajf cv
          ON v.condicion_venta = cv.id
          LEFT JOIN agenciasjf a
          ON v.agencia = a.id
          LEFT JOIN ubigeojf u
          ON c.ubigeo = u.cod_ubi
      WHERE v.tipo = 'S70'
          AND YEAR(v.fecha) = 2021";
    
          $stmt=Conexion::conectar()->prepare($sql);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else if($fechaInicial == $fechaFinal){
    
          $sql="SELECT
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_destino,
          LEFT(v.doc_destino,4) AS serie_dest,
          SUBSTR(v.doc_destino,5,8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          v.facturacion
      FROM
          ventajf v
          LEFT JOIN clientesjf c
          ON v.cliente = c.codigo
          LEFT JOIN condiciones_ventajf cv
          ON v.condicion_venta = cv.id
          LEFT JOIN agenciasjf a
          ON v.agencia = a.id
          LEFT JOIN ubigeojf u
          ON c.ubigeo = u.cod_ubi
      WHERE v.tipo = 'S70'
          AND DATE(v.fecha)  like '%$fechaFinal%' ";
    
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
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_destino,
            LEFT(v.doc_destino,4) AS serie_dest,
            SUBSTR(v.doc_destino,5,8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            v.facturacion
        FROM
            ventajf v
            LEFT JOIN clientesjf c
            ON v.cliente = c.codigo
            LEFT JOIN condiciones_ventajf cv
            ON v.condicion_venta = cv.id
            LEFT JOIN agenciasjf a
            ON v.agencia = a.id
            LEFT JOIN ubigeojf u
            ON c.ubigeo = u.cod_ubi
        WHERE v.tipo = 'S70'
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
          $stmt->execute();
    
          return $stmt->fetchAll();
    
          }else{
    
            $sql="SELECT
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_destino,
            LEFT(v.doc_destino,4) AS serie_dest,
            SUBSTR(v.doc_destino,5,8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            v.facturacion
        FROM
            ventajf v
            LEFT JOIN clientesjf c
            ON v.cliente = c.codigo
            LEFT JOIN condiciones_ventajf cv
            ON v.condicion_venta = cv.id
            LEFT JOIN agenciasjf a
            ON v.agencia = a.id
            LEFT JOIN ubigeojf u
            ON c.ubigeo = u.cod_ubi
        WHERE v.tipo = 'S70'
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
            $stmt=Conexion::conectar()->prepare($sql);
    
            $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();
          }
    
        }
    
          $stmt=null;
    
      }

              /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasProcesarCE($fechaInicial,$fechaFinal,$tipo){

        if($fechaInicial=="null"){
    
          $sql="SELECT 
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_destino,
          v.facturacion,
          v.doc_origen as origen2,
          LEFT(v.doc_destino, 4) AS serie_dest,
          SUBSTR(v.doc_destino, 5, 8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          n.doc_origen,
          n.fecha_origen,
          n.motivo,
          n.tip_cont,
          n.observacion 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN condiciones_ventajf cv 
            ON v.condicion_venta = cv.id 
          LEFT JOIN agenciasjf a 
            ON v.agencia = a.id 
          LEFT JOIN ubigeojf u 
            ON c.ubigeo = u.cod_ubi 
          LEFT JOIN notascd_jf n 
            ON v.tipo = n.tipo 
            AND v.documento = n.documento 
        WHERE v.tipo = :tipo 
          AND YEAR(v.fecha) = 2021";
    
          $stmt=Conexion::conectar()->prepare($sql);
          
          $stmt->bindParam(":tipo",$tipo,PDO::PARAM_STR);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else if($fechaInicial == $fechaFinal){
    
          $sql="SELECT 
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.total,
          v.cliente,
          c.nombre,
          c.tipo_documento AS tip_doc,
          c.documento AS num_doc,
          v.vendedor,
          v.fecha,
          cv.descripcion,
          v.doc_destino,
          v.facturacion,
          v.doc_origen as origen2,
          LEFT(v.doc_destino, 4) AS serie_dest,
          SUBSTR(v.doc_destino, 5, 8) AS nro_dest,
          v.estado,
          IFNULL(a.nombre, '') AS agencia,
          IFNULL(u.nom_ubi, '') AS ubigeo,
          n.doc_origen,
          n.fecha_origen,
          n.motivo,
          n.tip_cont,
          n.observacion 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN condiciones_ventajf cv 
            ON v.condicion_venta = cv.id 
          LEFT JOIN agenciasjf a 
            ON v.agencia = a.id 
          LEFT JOIN ubigeojf u 
            ON c.ubigeo = u.cod_ubi 
          LEFT JOIN notascd_jf n 
            ON v.tipo = n.tipo 
            AND v.documento = n.documento 
      WHERE v.tipo = :tipo
          AND DATE(v.fecha)  like '%$fechaFinal%' ";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    
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
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_destino,
            v.facturacion,
            v.doc_origen as origen2,
            LEFT(v.doc_destino, 4) AS serie_dest,
            SUBSTR(v.doc_destino, 5, 8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            n.doc_origen,
            n.fecha_origen,
            n.motivo,
            n.tip_cont,
            n.observacion 
          FROM
            ventajf v 
            LEFT JOIN clientesjf c 
              ON v.cliente = c.codigo 
            LEFT JOIN condiciones_ventajf cv 
              ON v.condicion_venta = cv.id 
            LEFT JOIN agenciasjf a 
              ON v.agencia = a.id 
            LEFT JOIN ubigeojf u 
              ON c.ubigeo = u.cod_ubi 
            LEFT JOIN notascd_jf n 
              ON v.tipo = n.tipo 
              AND v.documento = n.documento 
        WHERE v.tipo = :tipo
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    
          $stmt->execute();
    
          return $stmt->fetchAll();
    
          }else{
    
            $sql="SELECT 
            v.tipo,
            v.tipo_documento,
            v.documento,
            v.total,
            v.cliente,
            c.nombre,
            c.tipo_documento AS tip_doc,
            c.documento AS num_doc,
            v.vendedor,
            v.fecha,
            cv.descripcion,
            v.doc_destino,
            v.facturacion,
            v.doc_origen as origen2,
            LEFT(v.doc_destino, 4) AS serie_dest,
            SUBSTR(v.doc_destino, 5, 8) AS nro_dest,
            v.estado,
            IFNULL(a.nombre, '') AS agencia,
            IFNULL(u.nom_ubi, '') AS ubigeo,
            n.doc_origen,
            n.fecha_origen,
            n.motivo,
            n.tip_cont,
            n.observacion 
          FROM
            ventajf v 
            LEFT JOIN clientesjf c 
              ON v.cliente = c.codigo 
            LEFT JOIN condiciones_ventajf cv 
              ON v.condicion_venta = cv.id 
            LEFT JOIN agenciasjf a 
              ON v.agencia = a.id 
            LEFT JOIN ubigeojf u 
              ON c.ubigeo = u.cod_ubi 
            LEFT JOIN notascd_jf n 
              ON v.tipo = n.tipo 
              AND v.documento = n.documento 
        WHERE v.tipo = :tipo
            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
            $stmt=Conexion::conectar()->prepare($sql);
    
            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt->fetchAll();
          }
    
        }
    
          $stmt=null;
    
      }

       /*
    * ACTUALIZAR ESTADO DE FACTURACION ELECTRONICA 
    */
	static public function mdlActualizarProcesoFacturacion($estado,$situacion,$tipo,$documento){

		$sql="UPDATE 
                ventajf 
            SET
                facturacion = :estado,
                estado = :situacion 
            WHERE tipo = :tipo 
                AND documento = :documento ";

        $stmt=Conexion::conectar()->prepare($sql);

        
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":situacion", $situacion, PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR NOTA DE CREDITO O DEBITO + 1 POR SERIE
    */
    static public function mdlActualizarNotaSerie($item,$item2,$valor2){

		$sql="UPDATE
                    talonariosjf
                SET
                    $item = $item + 1
                WHERE $item2 = :$item2";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }


       /*
    * ACTUALIZAR TOKEN DE CONSULTA DE COMPROBANTES DE LA SUNAT
    */
    static public function mdlActualizarToken($valor,$valor2){

      $sql="UPDATE 
      maestrajf 
    SET
      descripcion = :descripcion,
      token = :token 
    WHERE tipo_dato = 'TOKEN' ";
  
          $stmt=Conexion::conectar()->prepare($sql);
          $stmt->bindParam(":descripcion", $valor2 ,PDO::PARAM_STR);
          $stmt->bindParam(":token", $valor, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
      } else {
  
        return "error";
      }
  
      $stmt=null;
  
      }

    /*
    * CONSULTA DE TOKEN
    */
    static public function mdlConsultarToken(){

      $sql="SELECT 
      *
      FROM maestrajf 
    WHERE tipo_dato = 'TOKEN' ";
  
      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->execute();

      return $stmt->fetch();
  
      $stmt=null;
  
      }

  static public function mdlRegresarStock($tipo, $documento){

    $sql="UPDATE 
          articulojf a 
          LEFT JOIN movimientosjf_2021 m 
            ON a.articulo = m.articulo SET a.stock = a.stock + m.cantidad 
        WHERE m.tipo = :tipo 
          AND m.documento = :documento";

    $stmt=Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return "error";

    }

    $stmt=null;

  }

  static public function mdlEliminarDetalle($tipo, $documento){

    $sql="DELETE 
            FROM
              movimientosjf_2021  
            WHERE tipo = :tipo
              AND documento = :documento";

    $stmt=Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return $stmt->errorInfo();

    }

    $stmt=null;

  }  

  static public function mdlAnularCabecera($tipo, $documento, $usuario){

    $sql="UPDATE 
                ventajf 
              SET
                neto = 0,
                igv = 0,
                dscto = 0,
                total = 0,
                cliente = '',
                vendedor = '',
                agencia = '',
                lista_precios = '',
                condicion_venta = '',
                usuario = :usuario,
                fecha_creacion = NOW(),
                estado = 'ANULADO',
                facturacion = '4' 
              WHERE tipo = :tipo 
                AND documento = :documento";

    $stmt=Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return $stmt->errorInfo();

    }

    $stmt=null;

  }  

  static public function mdlEliminarCta($tip, $documento){

    $sql="DELETE 
              FROM
                cuenta_ctejf 
              WHERE tipo_doc = :tipo 
                AND num_cta = :documento";

    $stmt=Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":tipo", $tip, PDO::PARAM_STR);
    $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return $stmt->errorInfo();

    }

    $stmt=null;

  }  

  static public function mdlEliminarDocumento($tipo, $documento){

    $sql="DELETE 
            FROM
              ventajf 
            WHERE tipo = :tipo 
              AND documento = :documento";

    $stmt=Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return $stmt->errorInfo();

    }

    $stmt=null;

  }  

  static public function mdlMostrarCabeceraDoc($tipo, $documento){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                * 
                              FROM
                                ventajf v 
                              WHERE v.tipo = :tipo
                                AND v.documento = :documento");

			$stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

    }
    
    static public function mdlMostrarDetalleDoc($tipo, $documento){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                    * 
                                  FROM
                                    movimientosjf_2021 m 
                              WHERE m.tipo = :tipo
                                AND m.documento = :documento");

			$stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

      $stmt -> close();

      $stmt = null;

    }     

}