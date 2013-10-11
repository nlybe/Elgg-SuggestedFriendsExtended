<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

$people = $vars['people'];

if (is_array($people) && sizeof($people) > 0) {
	
	$sfe_how_many = trim(elgg_get_plugin_setting('sfe_how_many', 'suggested_friends_extended'));
	if (!is_numeric($sfe_limit) || !($sfe_limit > 0)) 	{
		$sfe_how_many = SUGGESTED_FRIENDS_LIMIT;
	}

	$i = 0;
	foreach ($people as $person) {
		$i++;
		
		$info = '<span><b><a href="' . $person['entity']->getUrl() . '">' . $person['entity']->name . '</a></b></span><br />';

		$mutuals = count($person['mutuals']);
		if ($mutuals == 1) {
			$friend = $person['mutuals'][0];
			$info .= '<span>' . sprintf(elgg_echo('suggested_friends_extended:is:friend:of'), '<a href="' . $friend->getURL() . '">' . $friend->name . '</a>') . '</span><br />';
		} else if ($mutuals > 1) {
			$friends = array();
			foreach ($person['mutuals'] as $friend){
				$friends[] = '<a href="' . $friend->getURL() . '">' . $friend->name . '</a>';
			}
			$info .= '<span>' . sprintf(elgg_echo('suggested_friends_extended:mutual:friends'), $mutuals, implode(', ', $friends)) . '</span><br />';
		}

		$shared_groups = count($person['groups']);
		if ($shared_groups == 1) {
			$group = $person['groups'][0];
			$info .= '<span>' . sprintf(elgg_echo('suggested_friends_extended:is:member:of'), '<a href="' . $group->getURL() . '">' . $group->name . '</a>') . '</span><br />';
		} else if ($shared_groups > 1) {
			$groups = array();
			foreach ($person['groups'] as $group){
				$groups[] = '<a href="' . $group->getURL() . '">' . $group->name . '</a>';
			}
			$info .= '<span>' . sprintf(elgg_echo('suggested_friends_extended:shared:groups'), $shared_groups, implode(', ', $groups)) . '</span><br />';
		}
		
		/* search by sex (male/female) */
		$sfe_sex = trim(elgg_get_plugin_setting('sfe_sex', 'suggested_friends_extended'));
		if ($sfe_sex === 'sexnone')	{
			// do nothing
		}
		else
		{		
			$sex = count($person['sex']);
			if ($sex > 0) {
				$sexfriend = $person['sex'][0];
				if ($sfe_sex === 'sexsame')	{	$sex_echo = elgg_echo('suggested_friends_extended:sex:same');	}
				else if ($sfe_sex === 'sexsameno')	{	$sex_echo = elgg_echo('suggested_friends_extended:sex:sameno');	}
				$info .= '<span>' . $sex_echo . '</span><br />';
			} 		
		}
		
		/* search by age (same age) */
		$sfe_age = trim(elgg_get_plugin_setting('sfe_age', 'suggested_friends_extended'));
		if (!empty($sfe_age) && $sfe_age === 'yes')	{
			$age = count($person['age']);
			if ($age > 0) {
				$agefriend = $person['age'][0];
				$info .= '<span>' . elgg_echo('suggested_friends_extended:age:same') . '</span><br />';
			} 		
		}	
		
		/* search by location (same location) */
		$sfe_location = trim(elgg_get_plugin_setting('sfe_location', 'suggested_friends_extended'));
		if (!empty($sfe_location) && $sfe_location === 'yes')	{
			$location = count($person['location']);
			if ($location > 0) {
				$locationfriend = $person['location'][0];
				$info .= '<span>' . elgg_echo('suggested_friends_extended:location:same') .': ' .$person['loc'] . '</span><br />';
			} 		
		}	
		
		/* search by nearby location */
		$sfe_radius_loc = trim(elgg_get_plugin_setting('sfe_radius_loc', 'suggested_friends_extended'));
		if (!empty($sfe_radius_loc) && $sfe_radius_loc === 'yes')	{
			$radius_loc = count($person['radius_loc']);
			if ($radius_loc > 0) {
				$radius_locfriend = $person['radius_loc'][0];
				$info .= '<span>' . elgg_echo('suggested_friends_extended:radius_loc:same', array(elgg_get_plugin_setting('sfe_radius', 'suggested_friends_extended'),elgg_get_plugin_setting('unitmeas', 'suggested_friends_extended'))) .'</span><br />';
			} 		
		}					
		
		/* search by interests */
		$sfe_interests = trim(elgg_get_plugin_setting('sfe_interests', 'suggested_friends_extended'));
		if (!empty($sfe_interests) && $sfe_interests === 'yes')	{
			$interests = count($person['interests']);
			if ($interests > 0) {
				$interestsfriend = $person['interests'][0];
				$info .= '<span>' . elgg_echo('suggested_friends_extended:interests:same') .': ' .substr_replace($person['interest'] ,"",-2). '</span><br />';
			} 		
		}				

		$icon = elgg_view_entity_icon($person['entity'], 'small');
		
		echo elgg_view('page/components/image_block', array(
			'image' => $icon,
			'body' => $info
		));

		if($i==$sfe_how_many) break;
	}
} else {
	echo elgg_echo('suggested_friends_extended:people:not:found');
}
