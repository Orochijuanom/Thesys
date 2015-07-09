<?php
namespace App\Classes;

class StringManager{
	
	
	private $resultado = array();

	public function arreglar($datos){

		//limpia de corchetes y comillas la cadena de caracteres
          $datos = preg_replace(['/{/','/}/','/"/',], "", $datos);

          //separa la cadena de caracteres devuelta en donde encuentra ,espacio
          $datos = preg_split('[,\s]', $datos);
		
		foreach ($datos as $dato) {

			$dato = preg_split('/:\s/', $dato);

			if($dato[0] == 'user'){
				$resultado[$dato[1]] = $dato[2];
			}else{
			$resultado[$dato[0]] = $dato[1];
			}
			
		}

        return $resultado;

	}

}