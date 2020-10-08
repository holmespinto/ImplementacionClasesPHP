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
		# por ello creamos la clase ImprimirElementos 
		# la cual recibe la consulta y genera un json

class Modalidades{
 
 	/**
	 * variable con el nommbre de la tabla para la consulta
     * @var string
	 */  
 protected $table=null;
 
  	/**
	 * variable con la respuesta de la tabla para la consulta
	 * @var string 
	 */  
 protected $sql=array();

    public function ConsultarCampos($table) {
        //metodo que cargar un array de los nombres de cada campos de una tabla
           
   												$datos=array();
												$values=array();
    
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
	
	
    public function ConstruirDatos($sql,$campos_table,$values) {
     
    //metodo que cargar un array de los registros de una tabla
 

											    ///CONSULTE LA BD PARA TRAER LOS REGISTROS DE LA TABLA
												$j=0;
												while ($rows = sql_fetch($sql)) 
												{

													for($i=0; $i<count($campos_table); $i++){
													
													if(substr($values[$i],0,4)=='text'){
														
														$str=preg_replace("/\r\n|\r|\n/",'\n',$rows[''.$campos_table[$i].'']);
													}else{
														$str=$rows[''.$campos_table[$i].''];
													};	
													if(is_null($str)){$str='null';}
												
													$datos[$j][$i]="\"".$campos_table[$i]."\":\"".ltrim(rtrim($str))."\"\n";
													
													}
												$j++;
												} 
												//FIN DE LA CONSULTA
                                      			
                                        return $datos;
        
    }   




        
    }
  
  
 class ImprimirJson{ 
  	/**
	 * array donde se lista los datos de la tabla
	 * @var array
	 */ 
 protected $datos=array();

 	/**
	 * variable que genera la peticion read de kendo ui
	 *  @var string
	 */  
 protected $callback = null;
         
          
          public function VerJson($datos, $callback) {
         //metodo que permite tomar el  array de los registros de una tabla e imprimirlo como un json
         
                                            	    
                                            		echo ''.$callback.'([';
    												    for($k=0; $k<count($datos); $k++){
    													if($k==count($datos)-1){
    														echo'{';
    														echo implode(", ", $datos[$k]);
    														echo'}';
    													}else{
    														echo'{';
    														echo implode(", ", $datos[$k]);
    														echo'},';												
    													}
    												}
    											    echo '])';  
                
          
            }  
      
      }
 


?>
