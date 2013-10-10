<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

$spanish = array(

	'suggested_friends_extended' => 'Posibles Amigos',

	'suggested_friends_extended:new:people' => 'Amistad',

	'suggested_friends_extended:people:you:may:know' => 'Sugerencias de Amistad',
	'suggested_friends_extended:widget:description' => 'Este widget te sugiere nuevos amigos',
	'suggested_friends_extended:see:more' => 'Ver mas',
	'suggested_friends_extended:how:many' => 'Cuanta gente?',

	'suggested_friends_extended:all' => 'Todos',
	'suggested_friends_extended:friends:only' => 'Amigos de mis amigos',
	'suggested_friends_extended:groups:only' => 'Miembros de mis grupos',

	'suggested_friends_extended:is:friend:of' => 'Amigo de %s',
	'suggested_friends_extended:mutual:friends' => '%s amigos comunes: %s',

	'suggested_friends_extended:is:member:of' => 'Miembro de %s',
	'suggested_friends_extended:shared:groups' => '%s grupos comunes: %s',

	'suggested_friends_extended:people:not:found' => 'No hay sugerencias de amistad',
	
	'suggested_friends_extended:settings:yes' => 'Si',
	'suggested_friends_extended:settings:no' => 'No',
	'suggested_friends_extended:settings:sex:sexsame' => 'Mismo sexo',
	'suggested_friends_extended:settings:sex:sexsameno' => 'Sexo opuesto',
	'suggested_friends_extended:settings:sex:sexboth' => 'Ambos',
	'suggested_friends_extended:settings:sex:sexnone' => 'Ignorar sexo',
	'suggested_friends_extended:settings:sex' => 'Amistades basadas en el sexo',
	'suggested_friends_extended:settings:sex:note' => 'Selecciona el sexo de las sugerencias',
	'suggested_friends_extended:settings:age' => 'Amistades basadas en la edad',
	'suggested_friends_extended:settings:age:note' => 'Selecciona si deseas las sugerencias basadas en una edad similar',
	'suggested_friends_extended:settings:interests' => 'Amistades basadas en intereses comunes',
	'suggested_friends_extended:settings:interests:note' => 'Selecciona si deseas las sugerencias basadas en intereses comunes',
	'suggested_friends_extended:settings:location' => 'Amistades basadas en el lugar de residencia',
	'suggested_friends_extended:settings:location:note' => 'Selecciona si deseas las sugerencias basadas en una misma localizacion',
	'suggested_friends_extended:settings:radius_loc' => 'Amistades basadas en usuarios cercanos',
	'suggested_friends_extended:settings:radius_loc:note' => 'Selecciona si deseas las sugerencias basadas en lugares de residencia cercanos',
	'suggested_friends_extended:settings:sfe_radius' => '',
	'suggested_friends_extended:settings:sfe_radius:how' => 'Selecciona el radio en Kilometros para sugerir amistades cercanas. DEBE ser un valor numerico.',		
	'suggested_friends_extended:settings:sfe_radius:error' => 'El radio debe ser un valor numerico o no se incluiran amistades basadas en la distancia.',		
	'suggested_friends_extended:settings:google_api_key' => '',
	'suggested_friends_extended:settings:google_api_key:note' => 'Entra tu Google API key para la geolocalizacion de Google.<br/>Ir a <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">https://developers.google.com/maps/documentation/javascript/tutorial#api_key</a> para conseguir tu "Google API key". <br />(<strong>AVISO:</strong> la API key no es obligatoria. Solo es necesaria para acceder a las estaditicas de uso o a tu cuenta de pago)',
	'suggested_friends_extended:settings:batchusers' => 'Proceso de Geolocalizacion de Usuarios',
	'suggested_friends_extended:settings:batchusers:note' => 'Si ya ya existen usuarios en tu web de Elgg, haz click en este boton para convertir la localizacion de usuarios en coordenadas.<br />Este proceso solo es necesario ejecutarlo <strong>la primera vez</strong> que uses este plugin.',	
	'suggested_friends_extended:settings:batchusers:start' => 'Iniciar Geolocalizacion',
    'suggested_friends_extended:settings:unitmeas' => '', 
    'suggested_friends_extended:settings:unitmeas:km' => 'Kilometros', 
    'suggested_friends_extended:settings:unitmeas:miles' => 'Millas',
    'suggested_friends_extended:settings:unitmeas:note' => 'Selecciona la unidad de distancia.', 	
	'suggested_friends_extended:settings:sfe_how_many' => 'Cuantas amistades',
	'suggested_friends_extended:settings:sfe_how_many:how' => 'Selecciona el maximo de sugerencias que se muestran para cada usuario.',		
	'suggested_friends_extended:settings:sfe_how_many:error' => 'Este campo debe ser numerico.',		
	

	'suggested_friends_extended:sex:same' => 'Mismo sexo',	
	'suggested_friends_extended:sex:sameno' => 'Sexo opuesto',	
	'suggested_friends_extended:age:same' => 'Edad similar',	
	'suggested_friends_extended:location:same' => 'Misma residencia',
	'suggested_friends_extended:interests:same' => 'Intereses comunes',
	'suggested_friends_extended:radius_loc:same' => 'Usuario cercano, menos de %s %s',
);

add_translation('es', $spanish);
