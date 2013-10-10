<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

/*
 * People usort callback
 */
function suggested_friends_extended_sorter($a, $b){
	if ($a['priority'] == $b['priority']) {
		return 0;
	}
	return ($a['priority'] < $b['priority']) ? 1 : -1;
}

/**
 *
 * Returns array of people containing entity, mutuals (friends), groups (shared) and priority
 * @param Int $guid
 * @param Int $friends_limit
 * @param Int $groups_limit
 * @return Array
 */      
function suggested_friends_extended_get_people($guid, $friends_of_friends_limit = 3, $groups_members_limit = 3) {

	global $CONFIG;
	$user = get_user($guid);

	// retrieve all users friends
	$options = array(
		'type' => 'user',
		'relationship' => 'friend',
		'relationship_guid' => $guid,
		'wheres' => "u.banned = 'no'",
		'joins' => "INNER JOIN {$CONFIG->dbprefix}users_entity u USING (guid)",
		'order_by' => 'u.last_action DESC',
	    'limit' => 0,
	);
	$friends = elgg_get_entities_from_relationship($options);
	
	// generate a guids array
	$in = array($guid);
	if(is_array($friends) && count($friends) > 0){
		foreach ($friends as $friend) {
		  $in[] = $friend->guid;
		}
	}
	$in = implode(',', $in);

	// retrieve all non users friends
	$options_non = array(
		'type' => 'user',
		'limit' => 0,
		'wheres' => array(
			"u.banned = 'no'",
			"e.guid NOT IN ($in)"
		),	
		'joins' => "INNER JOIN {$CONFIG->dbprefix}users_entity u USING (guid)",			
	);		
	$get_non_user_friends = elgg_get_entities_from_metadata($options_non);

	$people = array();

	/* seach by friends */
	
	if ($friends_of_friends_limit > 0) {
		foreach ($friends as $friend) {
			// retrieve friends of each friend (discarding the users friends)
			$fof = elgg_get_entities_from_relationship(array(
				'type' => 'user',
				'relationship' => 'friend',
				'relationship_guid' => $friend->guid,
				'wheres' => array(
					"e.guid NOT IN ($in)",
					"u.banned = 'no'"
				),
				'joins' => "INNER JOIN {$CONFIG->dbprefix}users_entity u USING (guid)",
				'order_by' => 'u.last_action DESC',
				'limit' => $friends_of_friends_limit
			));
			if (is_array($fof) && count($fof) > 0) {
				// populate $people
				foreach ($fof as $f) {
					if (isset($people[$f->guid])) {
						// if the current person is present in $people, increase the priority and attach the common friend entity
						$people[$f->guid]['mutuals'][] = $friend;
						++$people[$f->guid]['priority'];
					} else {
						$people[$f->guid] = array(
							'entity' => $f,
							'mutuals' => array($friend),
							'groups' => array(),
							'priority' => 0
						);
					}
				}
			}
		}
	}
	

	// suggestions based on sex 
	$sfe_sex = trim(elgg_get_plugin_setting('sfe_sex', 'suggested_friends_extended'));
	if ($sfe_sex === 'sexnone')	{
		// do nothing
	}
	else if (!empty($user->sex))
	{
		$options = array(
			'type' => 'user',
			'limit' => 0,
			'wheres' => array(
				"u.banned = 'no'",
				"e.guid NOT IN ($in)"
			),	
			'joins' => "INNER JOIN {$CONFIG->dbprefix}users_entity u USING (guid)",			
		);		
		if ($sfe_sex === 'sexsame')	{
			$options[metadata_name_value_pairs] = array(array('name' => 'sex','value' => $user->sex, 'operand' => '='));
		}
		else if ($sfe_sex === 'sexsameno')	{
			$options[metadata_name_value_pairs] = array(array('name' => 'sex','value' => $user->sex, 'operand' => '<>'));
		}
		$get_users_by_sex = elgg_get_entities_from_metadata($options);
		
		if (is_array($get_users_by_sex) && count($get_users_by_sex) > 0) {
			// populate $people
			foreach ($get_users_by_sex as $f) {
				if (isset($people[$f->guid])) {
					// if the current person is present in $people, increase the priority and attach the common friend entity
					$people[$f->guid]['sex'][] = $user->sex;
					++$people[$f->guid]['priority'];
				} else {
					$people[$f->guid] = array(
						'entity' => $f,
						'sex' => array($friend),
						'groups' => array(),
						'priority' => 0
					);
				}
			}
		}		
		unset($options);
	}
	// suggestions based on sex ended
	

	// suggestions based on age 
	$sfe_age = trim(elgg_get_plugin_setting('sfe_age', 'suggested_friends_extended'));
	if (!empty($sfe_age) && $sfe_age === 'yes' && !empty($user->age))	{
		$options = array(
			'type' => 'user',
			'limit' => 0,
			'wheres' => array(
				"u.banned = 'no'",
				"e.guid NOT IN ($in)"
			),	
			'joins' => "INNER JOIN {$CONFIG->dbprefix}users_entity u USING (guid)",			
			'metadata_name_value_pairs' => array(
				array('name' => 'age','value' => $user->age, 'operand' => '='),
			),
		);		
		$get_users_by_age = elgg_get_entities_from_metadata($options);
		
		if (is_array($get_users_by_age) && count($get_users_by_age) > 0) {
			// populate $people
			foreach ($get_users_by_age as $f) {
				if (isset($people[$f->guid])) {
					// if the current person is present in $people, increase the priority and attach the common friend entity
					$people[$f->guid]['age'][] = $user->age;
					++$people[$f->guid]['priority'];
				} else {
					$people[$f->guid] = array(
						'entity' => $f,
						'age' => array($friend),
						'groups' => array(),
						'priority' => 0
					);
				}
			}
		}		
		unset($options);
	}
	// suggestions based on age ended	
	
	
	// suggestions based on location 
	$sfe_location = trim(elgg_get_plugin_setting('sfe_location', 'suggested_friends_extended'));
	if (!empty($sfe_location) && $sfe_location === 'yes' && !empty($user->location))	{
		$options = array(
			'type' => 'user',
			'limit' => 0,
			'wheres' => array(
				"u.banned = 'no'",
				"e.guid NOT IN ($in)"
			),	
			'joins' => "INNER JOIN {$CONFIG->dbprefix}users_entity u USING (guid)",			
			'metadata_name_value_pairs' => array(
				array('name' => 'location','value' => '%'.$user->location.'%', 'operand' => 'like'),
			),
		);		
		$get_users_by_location = elgg_get_entities_from_metadata($options);
		
		if (is_array($get_users_by_location) && count($get_users_by_location) > 0) {
			// populate $people
			foreach ($get_users_by_location as $f) {
				if (isset($people[$f->guid])) {
					// if the current person is present in $people, increase the priority and attach the common friend entity
					$people[$f->guid]['location'][] = $user->location;
					++$people[$f->guid]['priority'];
				} else {
					$people[$f->guid] = array(
						'entity' => $f,
						'location' => array($friend),
						'groups' => array(),
						'loc' => $user->location,
						'priority' => 0
					);
				}
			}
		}		
		unset($options);
	}
	// suggestions based on location ended	
	
	
	// suggestions based on location radius 
	$sfe_radius_loc = trim(elgg_get_plugin_setting('sfe_radius_loc', 'suggested_friends_extended'));
	$sfe_radius_loc_unitmeas = trim(elgg_get_plugin_setting('unitmeas', 'suggested_friends_extended'));
	if (!empty($sfe_radius_loc) && $sfe_radius_loc === 'yes' && !empty($user->location))	{
		$sfe_radius = trim(elgg_get_plugin_setting('sfe_radius', 'suggested_friends_extended'));
		if (is_numeric($sfe_radius)) 	{
		
			if ($sfe_radius_loc_unitmeas === 'miles') $sfe_radius = 1.609344*$sfe_radius;
			
			$get_users_by_radius_loc = $get_non_user_friends;
			
			if (is_array($get_users_by_radius_loc) && count($get_users_by_radius_loc) > 0) {
				// populate $people
				foreach ($get_users_by_radius_loc as $f) {
					$xxx = distance($user->getLatitude(), $user->getLongitude(),$f->getLatitude(), $f->getLongitude(),"K");
		
					if ($xxx <= $sfe_radius)	{
						if (isset($people[$f->guid])) {
							// if the current person is present in $people, increase the priority and attach the common friend entity
							$people[$f->guid]['radius_loc'][] = $user->radius_loc;
							++$people[$f->guid]['priority'];
						} else {
							$people[$f->guid] = array(
								'entity' => $f,
								'radius_loc' => array($friend),
								'groups' => array(),
								'priority' => 0
							);
						}
					}
				}
			}
		}		
		unset($options);
	}
	// suggestions based on location radius ended			


	// suggestions based on interests 
	$sfe_interests = trim(elgg_get_plugin_setting('sfe_interests', 'suggested_friends_extended'));
	if (!empty($sfe_interests) && $sfe_interests === 'yes' && !empty($user->interests))	{
		if (is_array($user->interests))	{
			$user_interests = $user->interests;
		}	
		else
		{
			$user_interests = explode(" ", $user->interests);
			array_walk($user_interests, 'trim_value');
		}
		
		$get_users_by_interests = $get_non_user_friends;
	
		$user_interests = array_values($user_interests);
		foreach ($user_interests as $ui)
		{
			foreach ($get_users_by_interests as $f)
			{
				if (is_array($f->interests))	{
					$f_interests = $f->interests;
				}	
				else
				{
					$f_interests = explode(" ", $f->interests);
					array_walk($f_interests, 'trim_value');
				}				
				
				if (in_array($ui, $f_interests)) {
					if (isset($people[$f->guid])) {
						// if the current person is present in $people, increase the priority and attach the common friend entity
						$people[$f->guid]['interests'][] = $ui;
						++$people[$f->guid]['priority'];
						$people[$f->guid]['interest'] .= $ui.', ';
					} else {
						$people[$f->guid] = array(
							'entity' => $f,
							'interests' => array($friend),
							'interest' => $ui.', ',
							'groups' => array(),
							'priority' => 0
						);
					}
				}
				
			}

		}
	}
	// suggestions based on interests ended	
	
	
	unset($friends);

	/* search by groups */
	if ($groups_members_limit > 0) {
		// retrieve ($groups_limit) user's groups
		$options = array(
			'type' => 'group',
			'relationship' => 'member',
			'relationship_guid' => $guid,
			'order_by' => 'time_created DESC',
			'limit' => 0
		);
		
		$groups = elgg_get_entities_from_relationship($options);

		if (is_array($groups) && count($groups) > 0) {
			foreach ($groups as $group) {
				// retrieve 3 members of each group (discarding the users friends)
				$members = elgg_get_entities_from_relationship(array(
					'type' => 'user',
					'relationship' => 'member',
					'relationship_guid' => $group->guid,
					'inverse_relationship' => TRUE,
					'wheres' => array(
						"e.guid NOT IN ($in)",
						"u.banned = 'no'"
					),
					'joins' => "INNER JOIN {$CONFIG->dbprefix}users_entity u USING (guid)",
					'order_by' => 'u.last_action DESC',
					'limit' => $groups_members_limit
				));
				if (is_array($members) && count($members) > 0) {
					// populate $people
					foreach ($members as $member) {
						if (isset($people[$member->guid])) {
							// if the current person is present in $people, increase the priority and attach the common group entity
							$people[$member->guid]['groups'][] = $group;
							++$people[$member->guid]['priority'];
						} else {
							$people[$member->guid] = array(
								'entity' => $member,
								'mutuals' => array(),
								'groups' => array($group),
								'priority' => 0
							);
						}
					}
				}
			}
		}
		unset($groups);
	}

	// sort by priority
	usort($people, 'suggested_friends_extended_sorter');

	return $people;

}

function trim_value(&$value)
{ 
    $value = trim($value);
}

// Based on user location, save his coords. 
function sfe_save_object_coords($location, $object) {
	
    $mapkey = trim(elgg_get_plugin_setting('google_api_key', 'suggested_friends_extended'));
    $geocoder = new Geocodersfe($mapkey);

    if ($location) {
        try {
            $placemarks = $geocoder->lookup($location);
        }
        catch (Exception $ex) {
            system_message($ex->getMessage());
            //exit;
        }   

        if (count($placemarks) > 0) { 
            $object->setLatLong($placemarks[0]->getPoint()->getLatitude(),$placemarks[0]->getPoint()->getLongitude());
            $object->setLocation($location);
            return true;
        } 
    }
    
    return false;
}


function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);

	if ($unit == "K") {
		return ($miles * 1.609344);
	} 
	else if ($unit == "N") {
		return ($miles * 0.8684);
	} else {
		return $miles;
	}
}
