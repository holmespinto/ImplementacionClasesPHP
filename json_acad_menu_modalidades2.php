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


function exec_json_acad_menu_modalidades2_dist(){

	header("Content-Type: application/json");
	
		      
			    //incluimos el archivo app.php donde estan alojadas todas mis clases y sus respectivos metodos
			    include_spip('base/app2');  
		       
		       //declaramos las variables
		        $callback=_request('callback');	
		    	$table='grado_acad_modalidades';
		    	$sqls= sql_select("*","grado_acad_modalidades","id_programa='266'");
		       
		       
		       //llemamos la clase Campos
		        $campos= new Campos();
		        $simple= new SimpleCamposOutput();

		        //invocamos el metodo TipoSimple para generar el array de los campos y valores de la consulta
		        list($campos_table,$values)= $campos->Generar($table, $simple);	
		       
		       
		       //llemamos la clase ConstruirDatos
		        $cargar= new ConstruirDatos();		        
		         
		        //invocamos el metodo DatosSimples
		        $datos= $cargar->Simples($sqls,$campos_table,$values);	

		      
		       //llemamos la clase ImprimirJson
		        $imprimir= new ImprimirJson();

		        //invocamos el metodo VerJson para mostrar el json
		        $json= $imprimir->VerJson($datos,$callback);		        
		        
}

?>
