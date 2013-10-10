<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

$english = array(

	'suggested_friends_extended' => 'Suggested Friends',

	'suggested_friends_extended:new:people' => 'Suggested Friends',

	'suggested_friends_extended:people:you:may:know' => 'Suggested Friends',
	'suggested_friends_extended:widget:description' => 'This widget suggests people you may know',
	'suggested_friends_extended:see:more' => 'See more',
	'suggested_friends_extended:how:many' => 'How many people?',

	'suggested_friends_extended:all' => 'All',
	'suggested_friends_extended:friends:only' => 'Friends of my friends',
	'suggested_friends_extended:groups:only' => 'Members of my groups',

	'suggested_friends_extended:is:friend:of' => 'Friend of %s',
	'suggested_friends_extended:mutual:friends' => '%s mutual friends: %s',

	'suggested_friends_extended:is:member:of' => 'Member of %s',
	'suggested_friends_extended:shared:groups' => '%s shared groups: %s',

	'suggested_friends_extended:people:not:found' => 'There are no people to suggest',
	
	'suggested_friends_extended:settings:yes' => 'Yes',
	'suggested_friends_extended:settings:no' => 'No',
	'suggested_friends_extended:settings:sex:sexsame' => 'Same sex',
	'suggested_friends_extended:settings:sex:sexsameno' => 'Opposite sex',
	'suggested_friends_extended:settings:sex:sexboth' => 'Both',
	'suggested_friends_extended:settings:sex:sexnone' => 'No suggestions based on sex',
	'suggested_friends_extended:settings:sex' => 'Friends suggestion based on sex',
	'suggested_friends_extended:settings:sex:note' => 'Select if you want to suggest friends of same sex, different sex or no sex suggestions',
	'suggested_friends_extended:settings:age' => 'Friends suggestion based on age',
	'suggested_friends_extended:settings:age:note' => 'Select if you want to suggest friends based on age',
	'suggested_friends_extended:settings:interests' => 'Friends suggestion based on interests',
	'suggested_friends_extended:settings:interests:note' => 'Select if you want to suggest friends based on interests',
	'suggested_friends_extended:settings:location' => 'Friends suggestion based on location',
	'suggested_friends_extended:settings:location:note' => 'Select if you want to suggest friends based on same location',
	'suggested_friends_extended:settings:radius_loc' => 'Friends suggestion for nearby members',
	'suggested_friends_extended:settings:radius_loc:note' => 'Select if you want to suggest friends based on nearby location',
	'suggested_friends_extended:settings:sfe_radius' => '',
	'suggested_friends_extended:settings:sfe_radius:how' => 'Select radius in kilometers for suggesting nearby friends. It MUST be a numeric value.',		
	'suggested_friends_extended:settings:sfe_radius:error' => 'Radius must be numeric, otherwise will not be included for friend\'s suggestion.',		
	'suggested_friends_extended:settings:google_api_key' => '',
	'suggested_friends_extended:settings:google_api_key:note' => 'Enter your Google API key for Google geolocation.<br/>Go to <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">https://developers.google.com/maps/documentation/javascript/tutorial#api_key</a> to get your "Google API key". <br />(<strong>Note:</strong> the API key is NOT required. Only if you want stats on your api usage, or if you have a paid API account the key is needed)',
	'suggested_friends_extended:settings:batchusers' => 'Batch Users Geolocation',
	'suggested_friends_extended:settings:batchusers:note' => 'If you have already members on your Elgg site, click on this button for converting users location to coordinates.<br />You have to do it <strong>just once</strong> before you start using this plugin.',	
	'suggested_friends_extended:settings:batchusers:start' => 'Start Geolocation',
    'suggested_friends_extended:settings:unitmeas' => '', 
    'suggested_friends_extended:settings:unitmeas:km' => 'Kilometers', 
    'suggested_friends_extended:settings:unitmeas:miles' => 'Miles',
    'suggested_friends_extended:settings:unitmeas:note' => 'Select Unit of Measurement will be used in searching.', 	
	'suggested_friends_extended:settings:sfe_how_many' => 'How many friends to suggest',
	'suggested_friends_extended:settings:sfe_how_many:how' => 'Select how many friends to suggest for each user. If find less than this number, will suggest less.',		
	'suggested_friends_extended:settings:sfe_how_many:error' => 'This field must be numeric.',		
	

	'suggested_friends_extended:sex:same' => 'Same sex',	
	'suggested_friends_extended:sex:sameno' => 'Opposite sex',	
	'suggested_friends_extended:age:same' => 'Similar age',	
	'suggested_friends_extended:location:same' => 'Same location',
	'suggested_friends_extended:interests:same' => 'Common interests',
	'suggested_friends_extended:radius_loc:same' => 'Nearby member, less than %s %s',
);

add_translation('en', $english);
