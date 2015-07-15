<?php
namespace App\Classes;


class Buscador{

	function __destruct(){
		
		$this->resultado = "";

	}

	private $resultado = "";
	
	/**
	*filtra los administrativos de acuerdo a los que halla en la database
	**/
	function buscadorAdministrativo($administrativos, $ids){

		
		foreach ($administrativos['administrativos'] as $administrativo) {
			
			foreach ($ids as $id) {
				
				if ($administrativo['administrativo']['id'] == $id['cod_user_ryca']) {
					
					
					$this->resultado[$administrativo['administrativo']['id']]['nombre'] = $administrativo['administrativo']['nombres'].' '.$administrativo['administrativo']['apellidos'];

					
				}


			}


		}

		return $this->resultado;

	}

	/**
	*filtra los profesores de acuerdo a los que halla en la database
	**/
	function buscadorProfesor($profesores, $ids){

		
		foreach ($profesores['profesores'] as $profesor) {
			
			foreach ($ids as $id) {
				
				if ($profesor['profesor']['id'] == $id['cod_user_ryca']) {
					
					
					$this->resultado[$profesor['profesor']['id']]['nombre'] = $profesor['profesor']['nombres'].' '.$profesor['profesor']['apellidos'];

					
				}


			}


		}

		return $this->resultado;

	}

	/**
	*filtra los programas de acuerdo a los que halla en la database
	**/
	function buscadorPrograma($programas, $ids){

		foreach ($programas['programas'] as $programa) {
			
			foreach ($ids as $id) {
				
				if ($programa['programa']['id'] == $id['cod_prog_ryca']) {
					
					$this->resultado[$programa['programa']['id']]['programa'] = $programa['programa']['programa'];

					
				}


			}


		}

		return $this->resultado;

	}

	/**
	*Verifica si el estudiante tiene matriculado una materia de grado
	**/
	function buscadorPrematricula($prematricula){
		
		if (!$prematricula==null) {
			
			foreach ($prematricula['prematricula']['materias'] as $value) {
				
				if (preg_match('/GRADO/', $value['materia']['materia'])) {
					
					return true;
				}
				
			}

		}


		return false;
	}

	/**
	*Verifica si el estudiante ha visto una materia de grado
	**/
	function buscadorCursadas($cursadas){
		
		if (!$cursadas==null) {
			
			foreach ($cursadas['estudiante']['asignaturas'] as $value) {
				
				if (preg_match('/GRADO/', $value['materia']['materia'])) {
					
					return true;
				}
				
			}

		}


		return false;
	}

	function buscadorProgramas($programas){

		foreach ($programas['programas'] as $programa) {

			$this->resultado[$programa['programa']['id']] = $programa['programa']['programa'];
			
		}
		asort($this->resultado);
		return $this->resultado;

	}

	/**
	*formatea las facultades en un array[id_facultad] = string(facultad)
	**/
	function buscadorFacultades($programas){
		
		foreach ($programas['programas'] as $programa) {
			$this->resultado[$programa['programa']['id_facultad']] = $programa['programa']['facultad'];
			
		}
		
		return $this->resultado;
	}

	/**
	*formatea los profesores en un array[id_profesor] = string(profesor)
	**/
	function buscadorProfesores($profesores){

		if (isset($profesores['error'])) {
			
			return $this->resultado;

		}else{

			foreach ($profesores['profesores'] as $profesor) {
				
				$this->resultado[$profesor['profesor']['id']] = $profesor['profesor']['nombres'].' '.$profesor['profesor']['apellidos'];
			}

			return $this->resultado;

		}

	}

	function buscadorProgramasXFacultad($programas, $facultad){

		foreach ($programas['programas'] as $programa) {
			
			if ($programa['programa']['id_facultad'] == $facultad) {
			
				$this->resultado[$programa['programa']['id']] = $programa['programa']['programa'];
			
			}
		
		}

		return $this->resultado;

	}

	
}