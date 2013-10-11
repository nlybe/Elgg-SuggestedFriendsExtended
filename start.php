<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

// get our functions
require_once 'lib/functions.php';


// plugin init
function suggested_friends_extended_init() {
	define('SUGGESTED_FRIENDS_LIMIT', 10);	// set max limit on suggested friends
	define('GENERAL_NON_FRIENDS_LIMIT', 2000);	// set max limit on general users search. It can be modified depending the total number of users

	elgg_register_library('elgg:suggested_friends_extended', elgg_get_plugins_path() . 'suggested_friends_extended/lib/Geocodersfe.php');
	
	elgg_extend_view('css/elgg', 'suggested_friends_extended/css');

	elgg_register_page_handler('suggested_friends_extended', 'suggested_friends_extended_page_handler');

	elgg_register_widget_type('suggested_friends_extended', elgg_echo('suggested_friends_extended:people:you:may:know'), elgg_echo('suggested_friends_extended:widget:description'), 'dashboard,profile');
	
    // load kanelgga maps api libraries if it's enabled. If not, it will not be working
    if(!elgg_is_active_plugin("membersmap")){
		elgg_load_library('elgg:suggested_friends_extended'); 

		// Register a handler for create members
		elgg_register_event_handler('create', 'user', 'sfe_geolocation');   
		// Register a handler for update members
		elgg_register_event_handler('update', 'user', 'sfe_geolocation');		
	}	
}



function suggested_friends_extended_page_handler($page) {

  $friends = $groups = 0;
  switch ($page[0]) {
	case 'friends':
		$friends = 3;
		break;
	case 'groups':
		$groups = 3;
		break;
	default:
		$friends = $groups = 3;
  }

  set_input('friends', $friends);
  set_input('groups', $groups);
	
  if(include('pages/suggested_friends_extended.php')){
    return TRUE;
  }
  
  return FALSE;
}

//
// set up our links and page specific items
function suggested_friends_extended_page_setup(){

  // add to site links
  if(elgg_is_logged_in()){
    $item = new ElggMenuItem('suggested_friends_extended', elgg_echo('suggested_friends_extended:new:people'), elgg_get_site_url() . 'suggested_friends_extended/');
    elgg_register_menu_item('site', $item);
  }
	
  if(elgg_get_context() == "suggested_friends"){
    $all = new ElggMenuItem('suggested_friends_extended_all', elgg_echo('suggested_friends_extended:all'), elgg_get_site_url() . 'suggested_friends_extended/');
    $friends = new ElggMenuItem('suggested_friends_extended_friends', elgg_echo('suggested_friends_extended:friends:only'), elgg_get_site_url() . 'suggested_friends_extended/friends');
    $groups = new ElggMenuItem('suggested_friends_extended_groups', elgg_echo('suggested_friends_extended:groups:only'), elgg_get_site_url() . 'suggested_friends_extended/groups');
    
    elgg_register_menu_item('page', $all);
    elgg_register_menu_item('page', $friends);
    elgg_register_menu_item('page', $groups);
  }
}

/**
 * Geolocate User based on location field
 */
function sfe_geolocation($event, $object_type, $object) {
	$location = $object->location;
	if ($location) {
		$ccc = sfe_save_object_coords($location, $object);
	}	
	//register_error(elgg_echo('skata'));
	
	return true;
}

elgg_register_event_handler('pagesetup', 'system', 'suggested_friends_extended_page_setup');
elgg_register_event_handler('init', 'system', 'suggested_friends_extended_init');


