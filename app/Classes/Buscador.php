<?php
namespace App\Classes;


class Buscador{

	function __destruct(){
		
		$this->resultado = "";

	}

	private $resultado = "";
	
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

	function buscadorFacultades($programas){
		

		$facultad = "";
		foreach ($programas['programas'] as $programa) {
			$facultad[$programa['programa']['id_facultad']] = $programa['programa']['facultad'];
			
			
			
		}
		
		return $facultad;
	}

	


}