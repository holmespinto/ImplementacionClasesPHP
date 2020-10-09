<?php

/***************************************************************************\
 * CCHE, Constructor de Clase para Herramienta de Elementos                           *
 *                                                                         *
 *  Copyright (c) 2020-2020                                                *
 *  Holmes Pinto, Armando Lopez, Braulio Barrios, Carlos Andres Romero  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('base/connect_sql');   

		// TODO: consulta a la tabla se genera un json para la peticion del kendo ui
		# por ello creamos la interface CamposOutput 
		# la cual recibe un string y genera un array
    # Para la clase SimpleCamposOutput puede ser el nombre de la tabla para buscar en BD 
    # los campos correspondientes que necesita la clase imprimir
    # Para la clase MultipleCamposOutput es un estring del select que permite cargar la configuracion de los campos
    # que deseamos consultar
    
//IMPLEMENTACION DEL PRINCIPIO NO.2


interface CamposOutput{
    
    public function output($str) {
    }
}

 class Campos{ 
  
    public function Generar($str, CamposOutput $output ) {
   	
   		return $output->output($str);

	}
 } 

 class SimpleCamposOutput implements CamposOutput 
 {
     
     public function output($table) {
               									$datos=array();
												$values=array(); 
												$sqlval=array(); 
                                                include_spip('base/connect_sql');   
    
    												//CONECTARSE A LA BD PARA CARGAR LOS CAMPOS DE LA TABLA
												    $connect = $flux['args']['connect'];
												    $trouver_table = charger_fonction('trouver_table', 'base');
    												if ($desc = $trouver_table($table, $connect)) {
    													$field = $desc['field'];
    												}											
												    //VARIABLES DEL ARRAY CON LOS NOMBRES DE LOS CAMPOS
											    	$campos_table=array_keys($field);
											        $values=array_values($field);
   											

   												return array($campos_table,$values);  
         
     }
  
 }
 
 class MultipleCamposOutput implements CamposOutput 
 {
     
     public function output($str) { 
 
      												   $sqlval=explode(',',$str);
                                 foreach ($sqlval as $key => $val) {
                                     $pos = strpos($val, '.', 1);
                                       $field[]= substr($val,$pos+1);
                                 } 	 												
   												    
												    //VARIABLES DEL ARRAY CON LOS NOMBRES DE LOS CAMPOS
											    	//$campos_table=array_keys($field);
											        $values=array_values($field);   
											       
											       return $values;     
     } 
 } 
 

 
 
?>
