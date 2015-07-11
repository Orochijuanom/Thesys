<?php
namespace App\Classes;


class Buscador{
	
	function buscadorDecano($fucionarios, $ids){

		foreach ($fucionarios['administrativos'] as $funcionario) {
			
			foreach ($ids as $id) {
				
				if ($funcionario['administrativo']['id'] == $id['cod_user_ryca']) {
					
					
					$decano[$funcionario['administrativo']['id']]['nombre'] = $funcionario['administrativo']['nombres'].' '.$funcionario['administrativo']['apellidos'];

					
				}


			}


		}

		return $decano;

	}

	


}