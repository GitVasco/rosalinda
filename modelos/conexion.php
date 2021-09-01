<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=192.168.1.64;dbname=rosalinda",
			            "admin",
			            "joel123");

		$link->exec("set names utf8");

		return $link;

	}

}