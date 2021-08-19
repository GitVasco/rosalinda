<?php

require_once "conexion.php";

class ModeloMensajes{

    /* 
    * MOSTRAR MENSAJES CABCERA
    */
    static public function mdlMostrarMensajes($tabla, $de, $para){

		if($de != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                            * 
                                                        FROM
                                                            $tabla 
                                                        WHERE de = $de 
                                                            AND para = $para
                                                            OR de = $para
                                                            AND para=$de");

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                            * ,codigo as cod
                                                        FROM
                                                            $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

    }

    /* 
    * Mostrar detalle de mensajes
    */
	static public function mdlMostraDetallesMensajes($tabla, $de, $para){

		$sql="SELECT 
                        dm.id,
                        dm.mailbox,
                        dm.de,
                        dm.para,
                        dm.mensaje,
                        dm.fecha,
                        dm.estado,
                        u1.nombre AS nom_de,
                        u1.foto AS foto_de,
                        u2.nombre AS nom_para,
                        u2.foto AS foto_para 
                    FROM
                        $tabla dm 
                        LEFT JOIN usuariosjf u1 
                        ON dm.de = u1.id 
                        LEFT JOIN usuariosjf u2 
                        ON dm.para = u2.id 
                    WHERE dm.de = $de 
                        AND dm.para = $para 
                        OR dm.de = $para 
                        AND dm.para = $de 
                    ORDER BY dm.id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

    }
    
    /* 
    * GUARDAR MENSAJE CABECERA
    */
    static public function mdlGuardarMailbox($tabla,$datos){

		$sql="INSERT INTO $tabla (codigo, de, para) 
        VALUES
          (:codigo, :de, :para)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":de",$datos["de"],PDO::PARAM_INT);
		$stmt->bindParam(":para",$datos["para"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}	    

    
    /* 
    * GUARDAR MENSAJE DETALLE
    */
    static public function mdlGuardarMensaje($tabla,$datos){

		$sql="INSERT INTO $tabla (mailbox, de, para, mensaje) 
                        VALUES
                        (:codigo, :de, :para, :mensaje)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":de",$datos["de"],PDO::PARAM_INT);
		$stmt->bindParam(":para",$datos["para"],PDO::PARAM_INT);
		$stmt->bindParam(":mensaje",$datos["mensaje"],PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}

    /* 
    * MENSAJES SIN LEER
    */
    static public function mdlSinLeer($tabla, $valor){	

		$stmt = Conexion::conectar()->prepare("SELECT 
                                                        COUNT(*) AS sinLeer
                                                    FROM
                                                        $tabla m 
                                                        LEFT JOIN 
                                                        (SELECT 
                                                            MAX(dm.fecha) AS fecha,
                                                            dm.de,
                                                            dm.mailbox 
                                                        FROM
                                                            detalles_mailboxjf dm 
                                                        WHERE dm.para = $valor
                                                        GROUP BY dm.mailbox) AS dm 
                                                        ON m.codigo = dm.mailbox 
                                                        LEFT JOIN detalles_mailboxjf c 
                                                        ON dm.fecha = c.fecha 
                                                        LEFT JOIN usuariosjf u 
                                                        ON dm.de = u.id 
                                                    WHERE dm.fecha IS NOT NULL
                                                        AND c.estado = '0'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }
    
    /* 
    * MENSAJES SIN LEER
    */
    static public function mdlLeer($tabla, $de, $para){	

		$sql="UPDATE 
                    $tabla 
                SET
                    estado = 1 
                WHERE de = $de 
                    AND para = $para";

		$stmt=Conexion::conectar()->prepare($sql);

        if($stmt->execute()){

            return "ok";

        }else{

            return "false";

        }
		

		$stmt=null;

    }
    
    /* 
    * BANDEJA DE MENSAJES
    */
    static public function mdlBandeja($tabla, $valor, $estado){	

        if($estado == null){

            $stmt = Conexion::conectar()->prepare("SELECT 
                                                            m.codigo,
                                                            dm.fecha,
                                                            dm.de,
                                                            u.nombre,
                                                            u.foto,
                                                            c.mensaje,
                                                            c.estado 
                                                        FROM
                                                            $tabla m 
                                                            LEFT JOIN 
                                                            (SELECT 
                                                                MAX(dm.fecha) AS fecha,
                                                                dm.de,
                                                                dm.mailbox 
                                                            FROM
                                                                detalles_mailboxjf dm 
                                                            WHERE dm.para = $valor
                                                            GROUP BY dm.mailbox) AS dm 
                                                            ON m.codigo = dm.mailbox 
                                                            LEFT JOIN detalles_mailboxjf c 
                                                            ON dm.fecha = c.fecha 
                                                            LEFT JOIN usuariosjf u 
                                                            ON dm.de = u.id 
                                                        WHERE dm.fecha IS NOT NULL
                                                        ORDER BY dm.fecha DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT 
                                                            m.codigo,
                                                            dm.fecha,
                                                            dm.de,
                                                            u.nombre,
                                                            u.foto,
                                                            c.mensaje,
                                                            c.estado 
                                                        FROM
                                                            $tabla m 
                                                            LEFT JOIN 
                                                            (SELECT 
                                                                MAX(dm.fecha) AS fecha,
                                                                dm.de,
                                                                dm.mailbox 
                                                            FROM
                                                                detalles_mailboxjf dm 
                                                            WHERE dm.para = $valor
                                                            GROUP BY dm.mailbox) AS dm 
                                                            ON m.codigo = dm.mailbox 
                                                            LEFT JOIN detalles_mailboxjf c 
                                                            ON dm.fecha = c.fecha 
                                                            LEFT JOIN usuariosjf u 
                                                            ON dm.de = u.id 
                                                        WHERE dm.fecha IS NOT NULL
                                                            AND c.estado = $estado
                                                            ORDER BY dm.fecha DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

		$stmt -> close();

		$stmt = null;

    }    



}
