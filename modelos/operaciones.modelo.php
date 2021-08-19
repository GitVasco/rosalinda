<?php

require_once "conexion.php";

class ModeloOperaciones{

	/*=============================================
	CREAR OPERACION
	=============================================*/

	static public function mdlIngresarOperacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,nombre) VALUES (:codigo,:nombre)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}    
	static public function mdlIngresarCabeceraOperacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(articulo,vendedor_fk,total_pd,total_ts) VALUES (:articulo,:vendedor_fk, :total_pd, :total_ts)");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor_fk", $datos["vendedor_fk"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pd", $datos["total_pd"], PDO::PARAM_STR);
		$stmt->bindParam(":total_ts", $datos["total_ts"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}  
	static public function mdlIngresarDetalleOperacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(modelo,cod_operacion,precio_doc,tiempo_stand) VALUES (:modelo,:cod_operacion, :precio_doc,:tiempo_stand)");

		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam("cod_operacion", $datos["cod_operacion"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_doc", $datos["precio_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo_stand", $datos["tiempo_stand"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}  

	/*=============================================
	MOSTRAR OPERACIONES
	=============================================*/

	static public function mdlMostrarOperaciones($tabla,$item,$valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR MODELOS
	=============================================*/
	static public function mdlMostrarModelos($tabla,$item,$valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
			a.modelo,
			a.nombre,
			CONCAT(a.modelo, ' - ', a.nombre) AS packing 
		  FROM
			$tabla a WHERE operaciones=0 AND estado='ACTIVO' AND estado='Activo'
		  GROUP BY a.modelo ;
		  ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================
	MOSTRAR CABECERA OPERACIONES
	=============================================*/

	static public function mdlMostrarCabeceraOperaciones($tabla,$item,$valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
			cabecera.id, 
			cabecera.articulo,
			mo.nombre as descripcion,
			cabecera.vendedor_fk,
			cabecera.total_pd,
			cabecera.total_ts,
			usu.nombre
		  FROM
			$tabla  cabecera 
			LEFT JOIN usuariosjf  usu 
		  ON cabecera.vendedor_fk = usu.id 
		  LEFT JOIN modelojf mo 
		  on cabecera.articulo=mo.modelo ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
	
	/*=============================================
	MOSTRAR DETALLE OPERACIONES
	=============================================*/

	static public function mdlMostrarDetalleOperaciones($tabla,$item,$valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

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
    
	/*=============================================
	EDITAR OPERACION
	=============================================*/

	static public function mdlEditarOperacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo , nombre = :nombre WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR OPERACION
	=============================================*/

	static public function mdlEliminarOperacion($tabla,$datos){

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
	EDITAR CABECERA OPERACION
	=============================================*/

	static public function mdlEditarCabeceraOperacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET articulo = :articulo , vendedor_fk = :vendedor_fk, total_pd = :total_pd, total_ts = :total_ts WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor_fk", $datos["vendedor_fk"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pd", $datos["total_pd"], PDO::PARAM_STR);
		$stmt->bindParam(":total_ts", $datos["total_ts"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR DETALLE OPERACION
	=============================================*/

	static public function mdlEditarDetalleOperacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET modelo = :modelo , cod_operacion = :cod_operacion, precio_doc = :precio_doc, tiempo_stand = :tiempo_stand WHERE modelo = :modelo");

		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_operacion", $datos["cod_operacion"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_doc", $datos["precio_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo_stand", $datos["tiempo_stand"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }

		// Método para actualizar un dato CON EL MODELO
		static public function mdlActualizarUnDato($tabla,$item1,$valor1,$valor2){

			$sql="UPDATE $tabla SET $item1=:$item1 WHERE modelo=:modelo";
	
			$stmt=Conexion::conectar()->prepare($sql);
	
			$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
			$stmt->bindParam(":modelo",$valor2,PDO::PARAM_STR);
	
			$stmt->execute();
	
			$stmt=null;
	
		}

	//ELIMINAR CABECERA OPERACION
	static public function mdlEliminarCabeceraOperacion($tabla,$datos){

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

	//ELIMINAR DETALLE OPERACION
	static public function mdlEliminarDetalleOperacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE modelo = :modelo");

		$stmt -> bindParam(":modelo", $datos, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	} 

	// Método para eliminar un detalle de venta
	static public function mdlEliminarDato($tabla,$item,$valor){
		$sql="DELETE FROM $tabla WHERE $item=:$item";
		$stmt=Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";}
		else{
			return "error";}
		$stmt=null;
	}

	/* 
	* Método para vizualizar detalle de la operacion
	*/
	static public function mdlVisualizarOperacionDetalle($tabla,$item,$valor){

		$sql="SELECT 
		dt.modelo,
		dt.cod_operacion,
		dt.precio_doc,
		dt.tiempo_stand,
		o.nombre
	  FROM
		$tabla dt 
		LEFT JOIN operacionesjf o 
		ON dt.cod_operacion = o.codigo
	  WHERE dt.$item = :$item
	  ORDER BY dt.id ASC";

		$stmt=Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

}
