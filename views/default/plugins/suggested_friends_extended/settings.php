<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

$plugin = $vars["entity"];

// how many friends to suggest
$sfe_how_many = '';
if (!is_numeric($plugin->sfe_how_many)) 	{
	$sfe_how_many .= '<span style="color:red;">'.elgg_echo('suggested_friends_extended:settings:sfe_how_many:error').'</span>';
}
$sfe_how_many .= elgg_view('input/text', array('name' => 'params[sfe_how_many]', 'value' => $plugin->sfe_how_many));
$sfe_how_many .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:sfe_how_many:how') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:sfe_how_many'), $sfe_how_many);	

//////////////////////////////// suggestions based on sex ////////////////////////////////
$suggested_sex = $plugin->sfe_sex;
if(empty($suggested_sex)){
        $suggested_sex = 'sexnone';
}    
$suggested_sex_options = array(
	"sexnone" => elgg_echo('suggested_friends_extended:settings:sex:sexnone'),
    "sexsame" => elgg_echo('suggested_friends_extended:settings:sex:sexsame'),
    "sexsameno" => elgg_echo('suggested_friends_extended:settings:sex:sexsameno'),
); 

$sfe_sex = elgg_view('input/dropdown', array('name' => 'params[sfe_sex]', 'value' => $suggested_sex, 'options_values' => $suggested_sex_options));
$sfe_sex .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:sex:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:sex'), $sfe_sex);   
/////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////// suggestions based on age range ////////////////////////////////
$suggested_age = $plugin->sfe_age;
if(empty($suggested_age)){
        $suggested_age = 'no';
}    
$suggested_age_options = array(
	"yes" => elgg_echo('suggested_friends_extended:settings:yes'),
    "no" => elgg_echo('suggested_friends_extended:settings:no'),
); 

$sfe_age = elgg_view('input/dropdown', array('name' => 'params[sfe_age]', 'value' => $suggested_age, 'options_values' => $suggested_age_options));
$sfe_age .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:age:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:age'), $sfe_age);   
/////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////// suggestions based on interests range ////////////////////////////////
$suggested_interests = $plugin->sfe_interests;
if(empty($suggested_interests)){
        $suggested_interests = 'no';
}    
$suggested_interests_options = array(
	"yes" => elgg_echo('suggested_friends_extended:settings:yes'),
    "no" => elgg_echo('suggested_friends_extended:settings:no'),
); 

$sfe_interests = elgg_view('input/dropdown', array('name' => 'params[sfe_interests]', 'value' => $suggested_interests, 'options_values' => $suggested_interests_options));
$sfe_interests .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:interests:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:interests'), $sfe_interests);   
/////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////// suggestions based on same location ////////////////////////////////
$suggested_location = $plugin->sfe_location;
if(empty($suggested_location)){
        $suggested_location = 'no';
}    
$suggested_location_options = array(
	"yes" => elgg_echo('suggested_friends_extended:settings:yes'),
    "no" => elgg_echo('suggested_friends_extended:settings:no'),
); 

$sfe_location = elgg_view('input/dropdown', array('name' => 'params[sfe_location]', 'value' => $suggested_location, 'options_values' => $suggested_location_options));
$sfe_location .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:location:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:location'), $sfe_location);   
/////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////// suggestions based on nearby locations ////////////////////////////////
$suggested_radius_loc = $plugin->sfe_radius_loc;
if(empty($suggested_radius_loc)){
        $suggested_radius_loc = 'no';
}    
$suggested_radius_loc_options = array(
	"yes" => elgg_echo('suggested_friends_extended:settings:yes'),
    "no" => elgg_echo('suggested_friends_extended:settings:no'),
); 

$sfe_radius_loc = elgg_view('input/dropdown', array('name' => 'params[sfe_radius_loc]', 'value' => $suggested_radius_loc, 'options_values' => $suggested_radius_loc_options));
$sfe_radius_loc .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:radius_loc:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:radius_loc'), $sfe_radius_loc); 

// search radius
$sfe_radius = '';
if (!is_numeric($plugin->sfe_radius)) 	{
	$sfe_radius .= '<span style="color:red;">'.elgg_echo('suggested_friends_extended:settings:sfe_radius:error').'</span>';
}
$sfe_radius .= elgg_view('input/text', array('name' => 'params[sfe_radius]', 'value' => $plugin->sfe_radius));
$sfe_radius .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:sfe_radius:how') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:sfe_radius'), $sfe_radius);	

// set unit of measurement for distance searching
$unitmeas = $plugin->unitmeas;
if(empty($unitmeas)){
        $unitmeas = 'km';
}    
$potential_unitmeas = array(
    "km" => elgg_echo('suggested_friends_extended:settings:unitmeas:km'),
    "miles" => elgg_echo('suggested_friends_extended:settings:unitmeas:miles'),
); 

$unit_of_measurement = elgg_view('input/dropdown', array('name' => 'params[unitmeas]', 'value' => $unitmeas, 'options_values' => $potential_unitmeas));
$unit_of_measurement .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:unitmeas:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:unitmeas'), $unit_of_measurement);

// Google API
$google = elgg_view('input/text', array('name' => 'params[sfe_google_api_key]', 'value' => $plugin->sfe_google_api_key));
$google .= "<div class='elgg-subtext'>" . elgg_echo('suggested_friends_extended:settings:google_api_key:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('suggested_friends_extended:settings:google_api_key'), $google); 

// batch convert geolocation	
$batchlink = elgg_view('output/url', array(
	'href' => "mod/suggested_friends_extended/putusersonmap.php",
	'text' => elgg_echo('suggested_friends_extended:settings:batchusers:start'),
	'class' => "elgg-button-action",
	'target' => "_blank",
	'style' => "padding: 3px;",
));
$batchlink .= "<div style='float:right;'>" . elgg_echo('suggested_friends_extended:settings:batchusers:note') ."</div>";			
echo elgg_view_module("inline", elgg_echo(''),"<div class='elgg-text'>".$batchlink."</div>");
///////////////////////////////////////////////////////////////////////////////////////// 
