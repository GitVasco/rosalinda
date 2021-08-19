<?php

require_once "conexion.php";

class ModeloTalonarios{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlMostrarTalonarios($valor){

        /* 
        * cuando es factura
        */
		if($valor == "01"){

			$sql="SELECT
                        id,
                        serie_factura,
                        facturas AS nro,
                        CONCAT(
                        serie_factura,
                        '-',
                        REPEAT('0', 8- LENGTH(facturas + 1)),
                        facturas + 1
                        ) AS numero
                    FROM
                        talonariosjf
                    WHERE serie_factura IS NOT NULL";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

		}else if($valor == "03"){

			$sql="SELECT
                        id,
                        serie_boletas,
                        boletas AS nro,
                        CONCAT(
                        serie_boletas,
                        '-',
                        REPEAT('0', 8- LENGTH(boletas + 1)),
                        boletas + 1
                        ) AS numero
                    FROM
                        talonariosjf
                    WHERE serie_boletas IS NOT NULL";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

		}else if($valor == "07"){

			$sql="SELECT
                        id,
                        serie_nc,
                        nota_credito AS nro,
                        CONCAT(
                        serie_nc,
                        '-',
                        REPEAT('0', 8- LENGTH(nota_credito + 1)),
                        nota_credito + 1
                        ) AS numero
                    FROM
                        talonariosjf
                    WHERE serie_nc IS NOT NULL";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }else if($valor == "08"){

			$sql="SELECT
                        id,
                        serie_nd,
                        nota_debito AS nro,
                        CONCAT(
                        serie_nd,
                        '-',
                        REPEAT('0', 8- LENGTH(nota_debito + 1)),
                        nota_debito + 1
                        ) AS numero
                    FROM
                        talonariosjf
                    WHERE serie_nd IS NOT NULL";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }else if($valor == "09"){

			$sql="SELECT
                        id,
                        serie_proformas,
                        proformas AS nro,
                        CONCAT(
                        serie_proformas,
                        '-',
                        REPEAT('0', 8- LENGTH(proformas + 1)),
                        proformas + 1
                        ) AS numero
                    FROM
                        talonariosjf
                    WHERE serie_proformas IS NOT NULL";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }else{

			$sql="SELECT
                        id,
                        serie_guias,
                        guias_remision AS nro,
                        CONCAT(
                        serie_guias,
                        '-',
                        REPEAT('0', 8- LENGTH(guias_remision + 1)),
                        guias_remision + 1
                        ) AS numero
                    FROM
                        talonariosjf
                    WHERE serie_guias IS NOT NULL";

            $stmt=Conexion::conectar()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }

		$stmt=null;

    }

}