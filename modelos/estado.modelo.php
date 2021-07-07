<?php

require_once "conexion.php";

class Modeloestado{

	/*============================================
	Mostrar todos los Registros
	============================================*/

	static public function index($tabla, $cantidad, $desde){

		if ($cantidad != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ESTADO , $tabla.NOMBRE_ESTADO FROM $tabla LIMIT $desde, $cantidad");

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ESTADO , $tabla.NOMBRE_ESTADO FROM $tabla");

		}

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
				Crear Registro 
	============================================*/

	static public function create($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(NOMBRE_ESTADO) VALUES (:NOMBRE_ESTADO)");

		$stmt -> bindParam(":NOMBRE_ESTADO", $datos["NOMBRE_ESTADO"], PDO::PARAM_STR);
		
		
		if ($stmt -> execute()) {
				
			return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

			$stmt-> close();
			$stmt= null;

	}
	/*============================================
	Mostrar un solo registro
	============================================*/

	static public function show($tabla, $id){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ESTADO , $tabla.NOMBRE_ESTADO FROM $tabla WHERE $tabla.ID_ESTADO  = :ID_ESTADO ");
		
		$stmt -> bindParam(":ID_ESTADO ", $id, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Actualizacion de un registro
	============================================*/

	static public function update($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET NOMBRE_ESTADO = :NOMBRE_ESTADO WHERE ID_ESTADO  = :ID_ESTADO ");

		$stmt -> bindParam(":ID_ESTADO ", $datos["ID_ESTADO "], PDO::PARAM_INT);
		$stmt -> bindParam(":NOMBRE_ESTADO", $datos["NOMBRE_ESTADO"], PDO::PARAM_STR);

			if ($stmt -> execute()) {
				
				return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

			$stmt-> close();
			$stmt= null;

	}
	/*============================================
	Borrar registro
	============================================*/

	static public function delete($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID_ESTADO  = :ID_ESTADO ");

		$stmt -> bindParam(":ID_ESTADO ", $id, PDO::PARAM_INT);

			if ($stmt -> execute()) {
				
				return "ok";

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}

		$stmt-> close();
		$stmt= null;

	}
}