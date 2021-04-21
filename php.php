<?php

//recursos disponibles
$allowedResourceTypes= [
	'books',
	'authors',
	'genres',


];



//se valida que el recurso este disponible

$resourceType = $_GET['resource_type'];

if(!in_array($resourceType, $allowedResourceTypes)){

die;

}

$books = [
	1 => [
		'titulo' => 'lo que el viento se llevo',
		
		'genero' =>  [
            'id' => 1,
			'nombre_genero' => 'historia',
		
		],
		'autor' => [
			'id' => 1,
			'nombre_autor' => 'carlos ',
			'fecha de nacimiento' => 1988,
			'pais de nacimiento' => 'colombia',
		
		  ],
	
	],
	2 => [
		'titulo' => 'el principito',
		
		'genero' => [
			'id' => 2,
			'nombre_genero' => 'aventura',
		
		],
		'autor' => [
			'id' => 2,
			'nombre_autor' => 'andres ',
			'fecha de nacimiento' => 2000,
			'pais de nacimiento' => 'venezuela',
			
		 ],
	
	],
	3 => [
		'titulo' => 'la nueva colombia',
		
		'genero' => [
			'id' => 1,
			'nombre_genero' => 'historia',
		
		],
		'autor' => [
			'id' => 1,
			'nombre_autor' => 'carlos ',
			'fecha de nacimiento' => 1988,
			'pais de nacimiento' => 'colombia',
		
		  ],
	
	],
	
];





header('Content-Type: application/json');

//se levanta el id del recurso buscado

$resourceId = array_key_exists('resource_id' , $_GET) ? $_GET['resource_id'] : '';

//se genera la respuesta cuando el pedido es correcto

switch ( strtoupper($_SERVER['REQUEST_METHOD']) ){

case 'GET':
	if (empty($resourceId)) {
		echo json_encode($books);
	}
	else {
		if (array_key_exists($resourceId, $books)) {
			echo json_encode( $books[$resourceId] );
		}
	}
	


	break;

case 'POST':
	 $json = file_get_contents('php://input');

        $books []= json_decode($json, true );

	 // echo array_keys ($books )[count($books) - 1];
	 echo json_encode($books);


	break;

case 'PUT':
	      //validamos que el recurso buscado exista
		  if (!empty($resourceId) && array_key_exists($resourceId, $books)){
            // Tomamos la entrada cruda
            $json = file_get_contents('php://input');
             // transformamos el json recibido a un nuevo elemento del arreglo
            $books[$resourceId] = json_decode($json, true);
            // Retornamos la coleccion modificada en formato json
            echo json_encode($books);
        }
	break;

case 'DELETE':

	// validamos que el recurso exista
	if (!empty($resourceId) && array_key_exists($resourceId, $books)){
		// Eliminamos el recurso
		unset( $books[ $resourceId]);    
		// Aquí verificamos que los cambios se han realizado  
		echo json_encode($books);      
	}
	break;


}


