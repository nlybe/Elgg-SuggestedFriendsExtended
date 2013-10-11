<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

gatekeeper();

$page_owner = elgg_get_logged_in_user_entity();
elgg_set_page_owner_guid($page_owner->guid);

//$friends = get_input('friends', 0);
//$groups = get_input('groups', 0);

$sfe_limit = trim(elgg_get_plugin_setting('sfe_how_many', 'suggested_friends_extended'));
if (!is_numeric($sfe_limit) || !($sfe_limit > 0)) 	{
	$sfe_limit = SUGGESTED_FRIENDS_LIMIT;
}

$people = suggested_friends_extended_get_people($page_owner->guid, $sfe_limit);

$content = elgg_view('suggested_friends_extended/list', array('people' => $people, 'num_display' => $sfe_limit));

$body = elgg_view_layout('one_sidebar', array('content' => $content));

echo elgg_view_page(elgg_echo('suggested_friends_extended'), $body);
