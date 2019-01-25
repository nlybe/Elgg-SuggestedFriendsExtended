<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

// Get engine
require_once(dirname(dirname(dirname(__FILE__))) . "/vendor/elgg/elgg/engine/start.php");

admin_gatekeeper();

elgg_load_library('elgg:suggested_friends_extended');

$options = array('type' => 'user', 'full_view' => false, 'limit' => 0);
$users = elgg_get_entities($options);

foreach ($users as $u)  {

	if (!isset($u->location) || !$u->location) {
		echo '<p>'.$u->username.': location not set';
	}
	else    {
		// function below is required when users saved location before enable this plugin
		if (!$u->getLatitude() || !$u->getLongitude())  {
			sleep(1);

			$vars['value'] = $u->location;

			if (is_array($vars['value'])) {
					$vars['value'] = implode(', ', $vars['value']);
					$location = elgg_view('output/tag', $vars);
			}
			else
			{
				$location = $u->location;
			}
			$location = strip_tags($location);

			$ccc = sfe_save_object_coords($location, $u);

			if ($ccc) echo '<p>'.$u->username.': geolocation DONE</p>';
			else {
				echo '<p>'. $u->username . ': geolocation failed: ' . $location . '</p>';
			}

			// keeps it flowing to the browser
			flush();
			// 50000 microseconds keeps things flowing in safari, IE, firefox, etc
			usleep(50000);
		}
		else  {
			echo '<p>'.$u->username.': is OK</p>';
		}
	}
}

echo "<br/>Geolocation finished for all users";
