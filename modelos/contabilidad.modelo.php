<?php
require_once "conexion.php";

class ModeloContabilidad{


    static public function mdlVentasSiscont($tipo, $documento, $inicio){

        $sql="SELECT 
                '02' AS origen,
                DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha,
                v.tipo,
                v.documento,
                CASE
                WHEN v.tipo = 'E05' 
                THEN ROUND(v.neto, 2) * - 1 
                ELSE ROUND(v.neto, 2) 
                END AS neto,
                CASE
                WHEN v.tipo = 'E05' 
                THEN ROUND(v.igv, 2) * - 1 
                ELSE ROUND(v.igv, 2) 
                END AS igv,
                CASE
                WHEN v.tipo = 'E05' 
                THEN ROUND(v.total, 2) * - 1 
                ELSE ROUND(v.total, 2) 
                END AS total,
                tm.cuenta,
                CASE
                WHEN LEFT(c.ubigeo, 1) = 'L' 
                OR LEFT(c.ubigeo, 2) = '15' 
                THEN '1' 
                ELSE '2' 
                END AS zona,
                CASE
                WHEN v.tipo IN ('S02', 'S03', 'S05') 
                AND LEFT(tm.cuenta, 2) = '12' 
                THEN v.total 
                WHEN v.tipo IN ('E05') 
                AND LEFT(tm.cuenta, 2) = '40' 
                THEN v.igv * - 1 
                WHEN v.tipo IN ('E05') 
                AND LEFT(tm.cuenta, 2) = '70' 
                THEN v.neto * - 1 
                ELSE 0 
                END AS debe,
                CASE
                WHEN v.tipo IN ('S02', 'S03', 'S05') 
                AND LEFT(tm.cuenta, 2) = '12' 
                THEN 0 
                WHEN v.tipo IN ('S02', 'S03', 'S05') 
                AND LEFT(tm.cuenta, 2) = '40' 
                THEN v.igv 
                WHEN v.tipo IN ('S02', 'S03', 'S05') 
                AND LEFT(tm.cuenta, 2) = '70' 
                THEN v.neto 
                WHEN v.tipo IN ('E05') 
                AND LEFT(tm.cuenta, 2) = '12' 
                THEN v.total * - 1 
                ELSE 0 
                END AS haber,
                'S' AS moneda,
                ROUND(v.tipo_cambio, 7) AS tipo_cambio,
                CASE
                WHEN v.tipo = 'S02' 
                THEN '03' 
                WHEN v.tipo = 'S03' 
                THEN '01' 
                WHEN v.tipo = 'E05' 
                THEN '07' 
                WHEN v.tipo = 'S05' 
                THEN '08' 
                END AS tipo_doc,
                CONCAT(
                LEFT(v.documento, 4),
                '-',
                RIGHT(v.documento, 8)
                ) AS documentoA,
                DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha_emi,
                DATE_FORMAT(
                DATE_ADD(
                    v.fecha,
                    INTERVAL IFNULL(cv.dias, 0) DAY
                ),
                '%d/%m/%y'
                ) AS fecha_ven,
                c.documento AS doc_cli,
                '001' AS mpago,
                'VENTA DE ROPA INTERIOR' AS glosa,
                CONCAT(
                LEFT(n.doc_origen, 4),
                '-',
                RIGHT(n.doc_origen, 8)
                ) AS doc_origen,
                n.tipo_doc AS tip_origen,
                DATE_FORMAT(n.fecha_origen, '%d/%m/%y') AS fec_origen,
                CASE
                WHEN c.fecha >= :inicio 
                THEN '2' 
                ELSE '' 
                END AS tip_cli,
                CASE
                WHEN c.fecha >= :inicio 
                THEN c.documento 
                ELSE '' 
                END AS ruc,
                CASE
                WHEN c.fecha >= :inicio 
                THEN c.nombre 
                ELSE '' 
                END AS nom_cliente,
                CASE
                WHEN c.fecha >= :inicio 
                THEN c.ape_paterno 
                ELSE '' 
                END AS ape_paterno,
                CASE
                WHEN c.fecha >= :inicio 
                THEN c.ape_materno 
                ELSE '' 
                END AS ape_materno,
                CASE
                WHEN c.fecha >= :inicio 
                THEN c.nombres 
                ELSE '' 
                END AS nombres,
                CASE
                WHEN c.fecha >= :inicio 
                THEN c.tipo_documento 
                ELSE '' 
                END AS tipo_documento 
            FROM
                ventajf v 
                LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
                LEFT JOIN 
                (SELECT 
                    tm.cod_argumento AS tipo,
                    tm.cod_tabla AS tabla,
                    tm.des_larga AS descripcion,
                    tm.des_corta AS cuenta,
                    tm.valor_1 AS zona 
                FROM
                    tabla_m_detalle tm 
                WHERE tm.cod_tabla = 'TASI') AS tm 
                ON v.tipo = tm.tipo 
                AND 
                CASE
                    WHEN LEFT(c.ubigeo, 1) = 'L' 
                    OR LEFT(c.ubigeo, 2) = '15' 
                    THEN '1' 
                    ELSE '2' 
                END = tm.zona 
                LEFT JOIN condiciones_ventajf cv 
                ON v.condicion_venta = cv.id 
                LEFT JOIN notascd_jf n 
                ON v.tipo = n.tipo 
                AND v.documento = n.documento 
            WHERE v.tipo = :tipo 
                AND v.documento = :documento 
                AND v.tipo IN ('S02', 'S03', 'S05', 'E05') 
            ORDER BY v.documento,
                tm.cuenta";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);   
        $stmt -> bindParam(":inicio", $inicio, PDO::PARAM_STR);   

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }

    static public function mdlVentasSiscontB($inicio, $fin){

        $sql="SELECT 
                    '02' AS t,
                    DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha,
                    v.tipo,
                    v.documento,
                    CASE
                    WHEN v.tipo = 'E05' 
                    THEN ROUND(v.neto, 2) * - 1 
                    ELSE ROUND(v.neto, 2) 
                    END AS neto,
                    CASE
                    WHEN v.tipo = 'E05' 
                    THEN ROUND(v.igv, 2) * - 1 
                    ELSE ROUND(v.igv, 2) 
                    END AS igv,
                    CASE
                    WHEN v.tipo = 'E05' 
                    THEN ROUND(v.total, 2) * - 1 
                    ELSE ROUND(v.total, 2) 
                    END AS total,
                    v.tipo_moneda,
                    CASE
                    WHEN LEFT(c.ubigeo, 1) = 'L' 
                    OR LEFT(c.ubigeo, 2) = '15' 
                    THEN '1' 
                    ELSE '2' 
                    END AS zona,
                    CASE
                    WHEN v.tipo_moneda = '1' 
                    THEN '121201' 
                    ELSE '121202' 
                    END AS cuenta,
                    CASE
                    WHEN v.tipo = 'E05' 
                    THEN 0 
                    ELSE v.total 
                    END AS debe,
                    CASE
                    WHEN v.tipo = 'E05' 
                    THEN v.total * - 1 
                    ELSE 0 
                    END AS haber,
                    CASE
                    WHEN v.tipo_moneda = '1' 
                    THEN 'S' 
                    ELSE 'D' 
                    END AS moneda,
                    ROUND(v.tipo_cambio, 7) AS tc,
                    CASE
                    WHEN v.tipo = 'S02' 
                    THEN '03' 
                    WHEN v.tipo = 'S03' 
                    THEN '01' 
                    WHEN v.tipo = 'E05' 
                    THEN '07' 
                    WHEN v.tipo = 'S05' 
                    THEN '08' 
                    END AS doc,
                    CONCAT(
                    LEFT(v.documento, 4),
                    '-',
                    RIGHT(v.documento, 8)
                    ) AS numero,
                    DATE_FORMAT(v.fecha, '%d/%m/%y') AS fechad,
                    DATE_FORMAT(
                    DATE_ADD(
                        v.fecha,
                        INTERVAL IFNULL(cv.dias, 0) DAY
                    ),
                    '%d/%m/%y'
                    ) AS fechav,
                    c.documento AS codigo,
                    '001' AS mpago,
                    (SELECT 
                    des_larga 
                    FROM
                    tabla_m_detalle t 
                    WHERE t.cod_tabla = 'TCUE' 
                    AND t.des_corta = v.cuenta) AS glosa,
                    CONCAT(
                    LEFT(n.doc_origen, 4),
                    '-',
                    RIGHT(n.doc_origen, 8)
                    ) AS rnumero,
                    n.tipo_doc AS rtdoc,
                    DATE_FORMAT(n.fecha_origen, '%d/%m/%y') AS rfecha,
                    'V' AS tl 
                FROM
                    ventajf v 
                    LEFT JOIN condiciones_ventajf cv 
                    ON v.condicion_venta = cv.id 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    LEFT JOIN notascd_jf n 
                    ON v.tipo = n.tipo 
                    AND v.documento = n.documento 
                WHERE v.fecha BETWEEN '$inicio' 
                    AND '$fin' 
                    AND v.tipo IN ('S02', 'S03', 'E05', 'S05') 
                    UNION
                    SELECT 
                    '02' AS t,
                    DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha,
                    v.tipo,
                    v.documento,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.neto, 2) * - 1 
                        ELSE ROUND(v.neto, 2) 
                    END AS neto,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.igv, 2) * - 1 
                        ELSE ROUND(v.igv, 2) 
                    END AS igv,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.total, 2) * - 1 
                        ELSE ROUND(v.total, 2) 
                    END AS total,
                    v.tipo_moneda,
                    CASE
                        WHEN LEFT(c.ubigeo, 1) = 'L' 
                        OR LEFT(c.ubigeo, 2) = '15' 
                        THEN '1' 
                        ELSE '2' 
                    END AS zona,
                    '40111' AS cuenta,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN v.igv * - 1 
                        ELSE 0 
                    END AS debe,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN 0 
                        ELSE v.igv 
                    END AS haber,
                    CASE
                        WHEN v.tipo_moneda = '1' 
                        THEN 'S' 
                        ELSE 'D' 
                    END AS moneda,
                    ROUND(v.tipo_cambio, 7) AS tc,
                    CASE
                        WHEN v.tipo = 'S02' 
                        THEN '03' 
                        WHEN v.tipo = 'S03' 
                        THEN '01' 
                        WHEN v.tipo = 'E05' 
                        THEN '07' 
                        WHEN v.tipo = 'S05' 
                        THEN '08' 
                    END AS doc,
                    CONCAT(
                        LEFT(v.documento, 4),
                        '-',
                        RIGHT(v.documento, 8)
                    ) AS numero,
                    DATE_FORMAT(v.fecha, '%d/%m/%y') AS fechad,
                    DATE_FORMAT(
                        DATE_ADD(
                        v.fecha,
                        INTERVAL IFNULL(cv.dias, 0) DAY
                        ),
                        '%d/%m/%y'
                    ) AS fechav,
                    c.documento AS codigo,
                    '001' AS mpago,
                    (SELECT 
                        des_larga 
                    FROM
                        tabla_m_detalle t 
                    WHERE t.cod_tabla = 'TCUE' 
                        AND t.des_corta = v.cuenta) AS glosa,
                    CONCAT(
                        LEFT(n.doc_origen, 4),
                        '-',
                        RIGHT(n.doc_origen, 8)
                    ) AS rnumero,
                    n.tipo_doc AS rtdoc,
                    DATE_FORMAT(n.fecha_origen, '%d/%m/%y') AS rfecha,
                    'V' AS tl 
                    FROM
                    ventajf v 
                    LEFT JOIN condiciones_ventajf cv 
                        ON v.condicion_venta = cv.id 
                    LEFT JOIN clientesjf c 
                        ON v.cliente = c.codigo 
                    LEFT JOIN notascd_jf n 
                        ON v.tipo = n.tipo 
                        AND v.documento = n.documento 
                    WHERE v.fecha BETWEEN '$inicio' 
                    AND '$fin' 
                    AND v.tipo IN ('S02', 'S03', 'E05', 'S05') 
                    UNION
                    SELECT 
                        '02' AS t,
                        DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha,
                        v.tipo,
                        v.documento,
                        CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.neto, 2) * - 1 
                        ELSE ROUND(v.neto, 2) 
                        END AS neto,
                        CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.igv, 2) * - 1 
                        ELSE ROUND(v.igv, 2) 
                        END AS igv,
                        CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.total, 2) * - 1 
                        ELSE ROUND(v.total, 2) 
                        END AS total,
                        v.tipo_moneda,
                        CASE
                        WHEN LEFT(c.ubigeo, 1) = 'L' 
                        OR LEFT(c.ubigeo, 2) = '15' 
                        THEN '1' 
                        ELSE '2' 
                        END AS zona,
                        v.cuenta,
                        CASE
                        WHEN v.tipo = 'E05' 
                        THEN v.neto * - 1 
                        ELSE 0 
                        END AS debe,
                        CASE
                        WHEN v.tipo = 'E05' 
                        THEN 0 
                        ELSE v.neto 
                        END AS haber,
                        CASE
                        WHEN v.tipo_moneda = '1' 
                        THEN 'S' 
                        ELSE 'D' 
                        END AS moneda,
                        ROUND(v.tipo_cambio, 7) AS tc,
                        CASE
                        WHEN v.tipo = 'S02' 
                        THEN '03' 
                        WHEN v.tipo = 'S03' 
                        THEN '01' 
                        WHEN v.tipo = 'E05' 
                        THEN '07' 
                        WHEN v.tipo = 'S05' 
                        THEN '08' 
                        END AS doc,
                        CONCAT(
                        LEFT(v.documento, 4),
                        '-',
                        RIGHT(v.documento, 8)
                        ) AS numero,
                        DATE_FORMAT(v.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(
                        DATE_ADD(
                            v.fecha,
                            INTERVAL IFNULL(cv.dias, 0) DAY
                        ),
                        '%d/%m/%y'
                        ) AS fechav,
                        c.documento AS codigo,
                        '001' AS mpago,
                        (SELECT 
                        des_larga 
                        FROM
                        tabla_m_detalle t 
                        WHERE t.cod_tabla = 'TCUE' 
                        AND t.des_corta = v.cuenta) AS glosa,
                        CONCAT(
                        LEFT(n.doc_origen, 4),
                        '-',
                        RIGHT(n.doc_origen, 8)
                        ) AS rnumero,
                        n.tipo_doc AS rtdoc,
                        DATE_FORMAT(n.fecha_origen, '%d/%m/%y') AS rfecha,
                        'V' AS tl 
                    FROM
                        ventajf v 
                        LEFT JOIN condiciones_ventajf cv 
                        ON v.condicion_venta = cv.id 
                        LEFT JOIN clientesjf c 
                        ON v.cliente = c.codigo 
                        LEFT JOIN notascd_jf n 
                        ON v.tipo = n.tipo 
                        AND v.documento = n.documento 
                    WHERE v.fecha BETWEEN '$inicio' 
                        AND '$fin' 
                        AND v.tipo IN ('S02', 'S03', 'E05', 'S05') 
                    ORDER BY documento,
                        cuenta";                

        $stmt=Conexion::conectar()->prepare($sql);
 
        $stmt -> bindParam(":inicio", $inicio, PDO::PARAM_STR);   
        $stmt -> bindParam(":fin", $fin, PDO::PARAM_STR);   

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }    

    static public function mdlVoucherSiscont($ano, $mes){

        $sql="SELECT 
                    tm.cod_argumento AS nmes,
                    tm.cod_tabla AS tabla,
                    tm.des_larga AS mes,
                    tm.des_corta AS ano,
                    tm.valor_1 AS correlativo,
                    tm.valor_2 AS correlativoL,
                    tm.valor_3 as correlativo04,
                    tm.valor_4 as correlativo08
                FROM
                    tabla_m_detalle tm 
                WHERE tm.cod_tabla = 'tcor' 
                    AND tm.cod_argumento = :mes 
                    AND tm.des_corta = :ano";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":ano", $ano, PDO::PARAM_STR);
		$stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt=null;

    }

    static public function mdlVentasConfiguradas($fechaInicio, $fechaFin){

        $sql="SELECT 
                    v.tipo,
                    v.documento 
                FROM
                    ventajf v 
                WHERE v.fecha BETWEEN :fechaInicio 
                    AND :fechaFin 
                    AND v.tipo IN ('S02', 'S03', 'S05', 'E05') 
                ORDER BY v.fecha,
                    v.tipo,
                    v.documento";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }    

	static public function mdlActualizarCorrelativo($ano, $mes, $correlativo, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                    tabla_m_detalle 
                                SET
                                    $valor = :correlativo
                                WHERE cod_tabla = 'tcor' 
                                    AND cod_argumento = :mes 
                                    AND des_corta = :ano");

		$stmt->bindParam(":ano", $ano, PDO::PARAM_STR);
		$stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
        $stmt->bindParam(":correlativo", $correlativo, PDO::PARAM_STR);
        
		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt -> errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

    }    

    static public function mdlLetrasConfiguradas($fechaInicio, $fechaFin){

        $sql="SELECT 
                        cc.cod_pago,
                        cc.doc_origen
                    FROM
                        cuenta_ctejf cc 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin
                        AND cc.tipo_doc = '85' 
                        AND cc.tip_mov = '+' 
                        AND cc.cod_pago <> '85'
                    GROUP BY cc.doc_origen";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }     

    static public function mdlLetrasConfiguradasB($fechaInicio, $fechaFin){

        $sql="SELECT 
                        cc.cliente 
                    FROM
                        cuenta_ctejf cc 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin
                        AND cc.tipo_doc = '85' 
                        AND cc.cod_pago = '85' 
                        AND cc.tip_mov = '+' 
                    GROUP BY cc.cliente ";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }      
    
    static public function mdlLetrasSiscont($documento){

        $sql="SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        tm.cuenta,
                        ROUND(cc.monto, 2) AS debe,
                        ROUND('0.00', 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        'LE' AS doc,
                        cc.num_cta AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                        LEFT JOIN 
                        (SELECT 
                            tm.cod_argumento AS tipo,
                            tm.cod_tabla AS tabla,
                            tm.des_larga AS nombre,
                            tm.des_corta AS cuenta 
                        FROM
                            tabla_m_detalle tm 
                        WHERE tm.cod_tabla = 'TASL') tm 
                        ON cc.tipo_doc = tm.tipo 
                    WHERE cc.doc_origen = :documento 
                        AND cc.tip_mov = '+' 
                        AND cc.tipo_doc = '85' 
                    UNION
                    SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.cod_pago,
                        cc.num_cta,
                        cc.doc_origen,
                        CASE
                        WHEN cc.cod_pago = '85' 
                        THEN '123101' 
                        ELSE '121101' 
                        END AS cuenta,
                        ROUND('0.00', 2) AS debe,
                        ROUND(SUM(cc.monto), 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        CASE
                            WHEN cc.cod_pago = '85' 
                            THEN 'LE' 
                            ELSE cc.cod_pago 
                        END AS doc,
                        CASE
                        WHEN cc.cod_pago = '85' 
                        THEN cc.doc_origen 
                        ELSE CONCAT(
                            LEFT(cc.doc_origen, 4),
                            '-',
                            RIGHT(cc.doc_origen, 8)
                        ) 
                        END AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                    WHERE cc.doc_origen = :documento AND cc.tipo_doc = '85' 
                        AND cc.tip_mov = '+' 
                    GROUP BY cc.doc_origen 
                    ORDER BY doc_origen,
                        cuenta DESC,
                        num_cta";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);   

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }    

    static public function mdlLetrasSiscontB($cliente, $fechaInicio, $fechaFin){

        $sql="SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        '123101' AS cuenta,
                        ROUND(cc.monto, 2) AS debe,
                        ROUND('0.00', 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        'LE' AS doc,
                        cc.num_cta AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                    WHERE DATE(cc.fecha) BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.cliente = :cliente 
                        AND cc.tipo_doc = '85' 
                        AND cc.cod_pago = '85' 
                        AND cc.tip_mov = '+' 
                    UNION
                    /*HABER*/
                    SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.cod_pago,
                        cc.num_cta,
                        cc.doc_origen,
                        CASE
                        WHEN cc.tipo_doc = '08' 
                        THEN '121101' 
                        ELSE '123101' 
                        END AS cuenta,
                        ROUND('0.00', 2) AS debe,
                        ROUND(cc.monto, 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN 'LE' 
                        ELSE cc.tipo_doc 
                        END AS doc,
                        CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN cc.num_cta 
                        ELSE CONCAT(
                            LEFT(cc.num_cta, 4),
                            '-',
                            RIGHT(cc.num_cta, 8)
                        ) 
                        END AS numero,
                        DATE_FORMAT(
                        (SELECT 
                            c1.fecha 
                        FROM
                            cuenta_ctejf c1 
                        WHERE c1.num_cta = cc.num_cta 
                            AND c1.tip_mov = '+'),
                        '%d/%m/%y'
                        ) AS fechad,
                        DATE_FORMAT(
                        (SELECT 
                            c1.fecha_ven 
                        FROM
                            cuenta_ctejf c1 
                        WHERE c1.num_cta = cc.num_cta 
                            AND c1.tip_mov = '+'),
                        '%d/%m/%y'
                        ) AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                    WHERE DATE(cc.fecha) BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.cliente = :cliente 
                        AND cc.tip_mov = '-' 
                        AND cc.cod_pago IN ('85', 'RF') 
                    ORDER BY ruc,
                        debe DESC";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":cliente", $cliente, PDO::PARAM_STR);   
        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }       

    static public function mdlCancelacionesSiscont04($fechaInicio, $fechaFin){

        $sql="SELECT 
                        c1.codigos_pago,
                        DATE_FORMAT(c1.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        cc.cod_pago,
                        CASE
                        WHEN c1.codigos_pago = '04' 
                        THEN '101100' 
                        ELSE '121101' 
                        END AS cuenta,
                        ROUND(c1.monto, 2) AS debe,
                        0 AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        /******/
                        CASE
                        WHEN c1.cod_pago IN ('96', '97') 
                        THEN '07' 
                        WHEN c1.cod_pago IN ('85', 'RF') 
                        THEN 'LE' 
                        WHEN c1.tipo_doc = '85' 
                        THEN 'LE' 
                        ELSE cc.tipo_doc 
                        END AS doc,
                        /***********/
                        CASE
                        WHEN c1.cod_pago IN ('96', '97') 
                        THEN c1.doc_origen 
                        WHEN c1.cod_pago IN ('85', 'RF') 
                        THEN c1.num_cta 
                        WHEN c1.tipo_doc = '85' 
                        THEN c1.num_cta 
                        ELSE cc.num_cta 
                        END AS numero,
                        /*********/
                        DATE_FORMAT(
                        CASE
                            WHEN c1.cod_pago IN ('96', '97') 
                            THEN c1.fechab 
                            WHEN c1.cod_pago IN ('85', 'RF') 
                            THEN cc.fecha 
                            WHEN c1.tipo_doc = '85' 
                            THEN cc.fecha 
                            ELSE cc.fecha 
                        END,
                        '%d/%m/%y'
                        ) AS fechad,
                        DATE_FORMAT(
                        CASE
                            WHEN c1.cod_pago IN ('96', '97') 
                            THEN c1.fechab 
                            WHEN c1.cod_pago IN ('85', 'RF') 
                            THEN cc.fecha_ven 
                            WHEN c1.tipo_doc = '85' 
                            THEN cc.fecha_ven 
                            ELSE cc.fecha_ven 
                        END,
                        '%d/%m/%y'
                        ) AS fechav,
                        /***********/
                        cc.cliente,
                        c.documento AS codigo,
                        CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN 'CANCELACION DE LETRAS' 
                        ELSE 'CANCELACION DE DOCUMENTOS' 
                        END AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                        LEFT JOIN 
                        /*******/
                        (SELECT 
                            cc.tipo_doc,
                            cc.num_cta,
                            cc.cod_pago,
                            cc.doc_origen,
                            c1.fecha,
                            cc.fecha AS fechab,
                            cc.cliente,
                            GROUP_CONCAT(
                            DISTINCT 
                            CASE
                                WHEN cc.cod_pago = '80' 
                                THEN '04' 
                                WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                THEN '08' 
                                ELSE 'CD' 
                            END 
                            ORDER BY 
                            CASE
                                WHEN cc.cod_pago = '80' 
                                THEN '04' 
                                WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                THEN '08' 
                                ELSE 'CD' 
                            END
                            ) AS codigos_pago,
                            c1.codigos_pago AS origen,
                            SUM(cc.monto) AS monto 
                        FROM
                            cuenta_ctejf cc 
                            LEFT JOIN 
                            (SELECT 
                                cc.tipo_doc,
                                cc.num_cta,
                                cc.fecha,
                                GROUP_CONCAT(
                                DISTINCT 
                                CASE
                                    WHEN cc.cod_pago = '80' 
                                    THEN '04' 
                                    WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                    THEN '08' 
                                    ELSE 'CD' 
                                END 
                                ORDER BY 
                                CASE
                                    WHEN cc.cod_pago = '80' 
                                    THEN '04' 
                                    WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                    THEN '08' 
                                    ELSE 'CD' 
                                END
                                ) AS codigos_pago,
                                SUM(cc.monto) AS monto 
                            FROM
                                cuenta_ctejf cc 
                            WHERE cc.fecha BETWEEN :fechaInicio 
                                AND :fechaFin 
                                AND cc.tip_mov = '-' 
                                AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                            GROUP BY cc.num_cta) AS c1 
                            ON cc.tipo_doc = c1.tipo_doc 
                            AND cc.num_cta = c1.num_cta 
                        WHERE cc.fecha BETWEEN :fechaInicio 
                            AND :fechaFin 
                            AND cc.tip_mov = '-' 
                            AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        GROUP BY cc.num_cta,
                            cc.cod_pago,
                            CASE
                            WHEN cc.cod_pago IN ('97', '98') 
                            THEN cc.doc_origen 
                            END) AS c1 
                        /**********/
                        ON cc.tipo_doc = c1.tipo_doc 
                        AND cc.num_cta = c1.num_cta 
                    WHERE cc.tip_mov = '+' 
                        AND c1.num_cta IS NOT NULL 
                        AND c1.origen IN (
                        '04',
                        '04,CD',
                        'CD',
                        '04,08,CD',
                        '04,08'
                        ) -- order by cc.num_cta ;
                UNION
                        /**************************SOLO 04- HABER*/                      
                        SELECT 
                        c1.codigos_pago,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        cc.cod_pago,
                        CASE
                            WHEN cc.tipo_doc = '85' 
                            THEN '123101' 
                            ELSE '121101' 
                        END AS cuenta,
                        ROUND('0.00', 2) AS debe,
                        cc.monto AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        CASE
                            WHEN cc.tipo_doc = '85' 
                            THEN 'LE' 
                            ELSE cc.tipo_doc 
                        END AS doc,
                        cc.num_cta AS numero,
                        DATE_FORMAT(c1.fecha_ori, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(c1.fecha_ori_ven, '%d/%m/%y') AS fechav,
                        cc.cliente,
                        c.documento AS codigo,
                        CASE
                            WHEN cc.tipo_doc = '85' 
                            THEN 'CANCELACION DE LETRAS' 
                            ELSE 'CANCELACION DE DOCUMENTOS' 
                        END AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                        FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                            ON cc.cliente = c.codigo 
                        LEFT JOIN 
                            /*******/
                            (SELECT 
                            cc.tipo_doc,
                            cc.num_cta,
                            GROUP_CONCAT(
                            DISTINCT 
                            CASE
                                WHEN cc.cod_pago = '80' 
                                THEN '04' 
                                WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                THEN '08' 
                                ELSE 'CD' 
                            END 
                            ORDER BY 
                            CASE
                                WHEN cc.cod_pago = '80' 
                                THEN '04' 
                                WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                THEN '08' 
                                ELSE 'CD' 
                            END
                            ) AS codigos_pago,
                            SUM(monto) AS monto ,
                            cc.fecha_ori,
                            cc.fecha_ori_ven
                        FROM
                            cuenta_ctejf cc 
                        WHERE cc.fecha BETWEEN :fechaInicio 
                            AND :fechaFin 
                            AND cc.tip_mov = '-' 
                            AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        GROUP BY cc.num_cta) AS c1 
                            /*****/
                            ON cc.tipo_doc = c1.tipo_doc 
                            AND cc.num_cta = c1.num_cta 
                        WHERE cc.tip_mov = '-' 
                        AND cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND c1.codigos_pago IN (
                            '04',
                            '04,CD',
                            'CD',
                            '04,08,CD',
                            '04,08'
                        ) 
                        ORDER BY num_cta";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }      
    
    static public function mdlCancelacionesSiscont08($fechaInicio, $fechaFin){

        $sql="SELECT DISTINCT 
                    c1.codigos_pago,
                    DATE_FORMAT(c1.fecha, '%d/%m/%y') AS fecha,
                    cc.tipo_doc,
                    cc.num_cta,
                    cc.doc_origen,
                    cc.cod_pago,
                    CASE
                    WHEN c1.cod_pago IN ('05', '00') 
                    THEN '104101' 
                    WHEN c1.cod_pago IN ('06', '14') 
                    THEN '104103' 
                    ELSE '121101' 
                    END AS cuenta,
                    ROUND(c1.monto, 2) AS debe,
                    0 AS haber,
                    'S' AS moneda,
                    ROUND(cc.tip_cambio, 7) AS tc,
                    /******/
                    CASE
                    WHEN c1.cod_pago IN ('96', '97') 
                    THEN '07' 
                    WHEN c1.cod_pago IN ('85', 'RF') 
                    THEN 'LE' 
                    WHEN c1.tipo_doc = '85' 
                    THEN 'LE' 
                    ELSE cc.tipo_doc 
                    END AS doc,
                    /***********/
                    CASE
                    WHEN c1.cod_pago IN ('96', '97') 
                    THEN c1.doc_origen 
                    WHEN c1.cod_pago IN ('85', 'RF') 
                    THEN c1.num_cta 
                    WHEN c1.tipo_doc = '85' 
                    THEN c1.num_cta 
                    ELSE cc.num_cta 
                    END AS numero,
                    /*********/
                    DATE_FORMAT(
                    CASE
                        WHEN c1.cod_pago IN ('96', '97') 
                        THEN c1.fechab 
                        WHEN c1.cod_pago IN ('85', 'RF') 
                        THEN cc.fecha 
                        WHEN c1.tipo_doc = '85' 
                        THEN cc.fecha 
                        ELSE cc.fecha 
                    END,
                    '%d/%m/%y'
                    ) AS fechad,
                    DATE_FORMAT(
                    CASE
                        WHEN c1.cod_pago IN ('96', '97') 
                        THEN c1.fechab 
                        WHEN c1.cod_pago IN ('85', 'RF') 
                        THEN cc.fecha_ven 
                        WHEN c1.tipo_doc = '85' 
                        THEN cc.fecha_ven 
                        ELSE cc.fecha_ven 
                    END,
                    '%d/%m/%y'
                    ) AS fechav,
                    /***********/
                    cc.cliente,
                    c.documento AS codigo,
                    CASE
                    WHEN cc.tipo_doc = '85' 
                    THEN 'CANCELACION DE LETRAS' 
                    ELSE 'CANCELACION DE DOCUMENTOS' 
                    END AS glosa,
                    c.documento AS ruc,
                    '2' AS tipo,
                    c.nombre AS rs,
                    c.ape_paterno AS ape1,
                    c.ape_materno AS ape2,
                    c.nombres AS nombre,
                    c.tipo_documento AS tdoci 
                FROM
                    cuenta_ctejf cc 
                    LEFT JOIN clientesjf c 
                    ON cc.cliente = c.codigo 
                    LEFT JOIN 
                    /*******/
                    (SELECT 
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.cod_pago,
                        cc.doc_origen,
                        c1.fecha,
                        cc.fecha AS fechab,
                        cc.cliente,
                        GROUP_CONCAT(
                        DISTINCT 
                        CASE
                            WHEN cc.cod_pago = '80' 
                            THEN '04' 
                            WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                            THEN '08' 
                            ELSE 'CD' 
                        END 
                        ORDER BY 
                        CASE
                            WHEN cc.cod_pago = '80' 
                            THEN '04' 
                            WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                            THEN '08' 
                            ELSE 'CD' 
                        END
                        ) AS codigos_pago,
                        c1.codigos_pago AS origen,
                        SUM(cc.monto) AS monto 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN 
                        (SELECT 
                            cc.tipo_doc,
                            cc.num_cta,
                            cc.fecha,
                            GROUP_CONCAT(
                            DISTINCT 
                            CASE
                                WHEN cc.cod_pago = '80' 
                                THEN '04' 
                                WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                THEN '08' 
                                ELSE 'CD' 
                            END 
                            ORDER BY 
                            CASE
                                WHEN cc.cod_pago = '80' 
                                THEN '04' 
                                WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                                THEN '08' 
                                ELSE 'CD' 
                            END
                            ) AS codigos_pago,
                            SUM(cc.monto) AS monto 
                        FROM
                            cuenta_ctejf cc 
                        WHERE cc.fecha BETWEEN :fechaInicio 
                            AND :fechaFin 
                            AND cc.tip_mov = '-' 
                            AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        GROUP BY cc.num_cta) AS c1 
                        ON cc.tipo_doc = c1.tipo_doc 
                        AND cc.num_cta = c1.num_cta 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.tip_mov = '-' 
                        AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                    GROUP BY cc.num_cta,
                        cc.cod_pago,
                        CASE
                        WHEN cc.cod_pago IN ('97', '98') 
                        THEN cc.doc_origen 
                        END) AS c1 
                    /**********/
                    ON cc.tipo_doc = c1.tipo_doc 
                    AND cc.num_cta = c1.num_cta 
                WHERE cc.tip_mov = '+' 
                    AND c1.num_cta IS NOT NULL 
                    AND c1.origen IN ('08', '08,CD') -- order by cc.num_cta ;
                    UNION
                    /**************************SOLO 04- HABER*/
                    SELECT 
                    c1.codigos_pago,
                    DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                    cc.tipo_doc,
                    cc.num_cta,
                    cc.doc_origen,
                    cc.cod_pago,
                    CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN '123101' 
                        ELSE '121101' 
                    END AS cuenta,
                    ROUND('0.00', 2) AS debe,
                    cc.monto AS haber,
                    'S' AS moneda,
                    ROUND(cc.tip_cambio, 7) AS tc,
                    CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN 'LE' 
                        ELSE cc.tipo_doc 
                    END AS doc,
                    cc.num_cta AS numero,
                    DATE_FORMAT(c1.fecha_ori, '%d/%m/%y') AS fechad,
                    DATE_FORMAT(c1.fecha_ori_ven, '%d/%m/%y') AS fechav,
                    cc.cliente,
                    c.documento AS codigo,
                    CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN 'CANCELACION DE LETRAS' 
                        ELSE 'CANCELACION DE DOCUMENTOS' 
                    END AS glosa,
                    c.documento AS ruc,
                    '2' AS tipo,
                    c.nombre AS rs,
                    c.ape_paterno AS ape1,
                    c.ape_materno AS ape2,
                    c.nombres AS nombre,
                    c.tipo_documento AS tdoci 
                    FROM
                    cuenta_ctejf cc 
                    LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                    LEFT JOIN 
                        /*******/
                        (SELECT 
                        cc.tipo_doc,
                        cc.num_cta,
                        GROUP_CONCAT(
                            DISTINCT 
                            CASE
                            WHEN cc.cod_pago = '80' 
                            THEN '04' 
                            WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                            THEN '08' 
                            ELSE 'CD' 
                            END 
                            ORDER BY 
                            CASE
                            WHEN cc.cod_pago = '80' 
                            THEN '04' 
                            WHEN cc.cod_pago IN ('05', '00', '06', '14') 
                            THEN '08' 
                            ELSE 'CD' 
                            END
                        ) AS codigos_pago,
                        SUM(monto) AS monto,
                        cc.fecha_ori,
                        cc.fecha_ori_ven 
                        FROM
                        cuenta_ctejf cc 
                        WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.tip_mov = '-' 
                        AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        GROUP BY cc.num_cta) AS c1 
                        /*****/
                        ON cc.tipo_doc = c1.tipo_doc 
                        AND cc.num_cta = c1.num_cta 
                    WHERE cc.tip_mov = '-' 
                    AND cc.fecha BETWEEN :fechaInicio 
                    AND :fechaFin 
                    AND c1.codigos_pago IN ('08', '08,CD') 
                    ORDER BY num_cta";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }  

    static public function mdlClientes($fechaInicio, $fechaFin){

        $sql="SELECT 
                    c.documento AS ruc,
                    '2' AS tipo,
                    c.nombre AS rs,
                    c.ape_paterno AS ape1,
                    c.ape_materno AS ape2,
                    SUBSTRING_INDEX(
                    SUBSTRING_INDEX(c.nombres, ' ', 1),
                    ' ',
                    - 1
                    ) AS nombre,
                    c.tipo_documento AS tdoci 
                FROM
                    clientesjf c 
                WHERE DATE(c.fecha) BETWEEN :fechaInicio
                    AND :fechaFin";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }      

}