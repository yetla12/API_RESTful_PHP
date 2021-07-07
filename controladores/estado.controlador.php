<?php

class Controladorestado{

	/*============================================
	Mostrar todos los registros
	============================================*/

	public function index($page){


		if ($page != null) {
			
			/*============================================
			Mostrar estadoes con paginación
			============================================*/

			$cantidad = 10;
			$desde = ($page-1)*$cantidad;

			$estado = Modeloestado::index("estado", $cantidad, $desde);

		}else{

			/*============================================
			Mostrar todos los estadoes
			============================================*/

			$estado = Modeloestado::index("estado", null, null);

		}

		
		if (!empty($estado)) {
			

			$json = array(
				"status"=>200,
				"total_registros"=>count($estado),
				"detalle"=> $estado
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún estado registrado"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Crear un estado
	============================================*/

	public function create($datos){
		
		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo NOMBRE_ESTADO".$key
				);

				echo json_encode($json, true);
				return;
			}
		}

		/*============================================
		Validar que el NOMBRE_ESTADO_ESTADO no esté repetido
		============================================*/

		$estado = Modeloestado::index("estado", null, null);
		foreach ($estado as $key => $value) {
			
			if ($value->NOMBRE_ESTADO_ESTADO == $datos["NOMBRE_ESTADO_ESTADO"]) {

				$json = array(
					"status"=>404,
					"detalle"=>"El NOMBRE_ESTADO_ESTADO ya existe en la base de datos"
				);

				echo json_encode($json, true);
				return;
			}
			
		}

		/*============================================
		Llevar datos al modelo
		============================================*/

		$datos = array( "NOMBRE_ESTADO_ESTADO"=>$datos["NOMBRE_ESTADO_ESTADO"]);


		$create = Modeloestado::create("estado", $datos);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($create == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Su registro ha sido guardado"
			);

			echo json_encode($json, true);
			return;
		}
	}
	/*============================================
	Mostrando un solo estado
	============================================*/

	public function show($id){
			
		/*============================================
		Mostrar todos los estadoes
		============================================*/

		$estado = Modeloestado::show("estado", $id);

		if (!empty($estado)) {
			

			$json = array(
				"status"=>200,
				"detalle"=> $estado
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún estado registrado"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Editar un estado
	============================================*/

	public function update($id, $datos){

		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo NOMBRE_ESTADO".$key
				);

				echo json_encode($json, true);
				return;
			}

			/*============================================
			Llevar datos al modelo
			============================================*/

			$datos = array( "ID_estado"=>$id,
							"NOMBRE_ESTADO"=>$datos["NOMBRE_ESTADO"]);

			$update = Modeloestado::update("estado", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($update == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Su registro ha sido actualizado"
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
	/*============================================
	Borrar estado
	============================================*/

	public function delete($id){

		/*============================================
		Llevar datos al modelo
		============================================*/

		$delete = Modeloestado::delete("estado", $id);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($delete == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Se ha borrado con éxito"
			);

			echo json_encode($json, true);
			return;
		}
	}
}