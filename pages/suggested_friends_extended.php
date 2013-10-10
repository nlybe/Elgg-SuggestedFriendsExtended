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

$friends = get_input('friends', 0);
$groups = get_input('groups', 0);

$people = suggested_friends_extended_get_people($page_owner->guid, $friends, $groups);

$content = elgg_view('suggested_friends_extended/list', array('people' => $people));

$body = elgg_view_layout('one_sidebar', array('content' => $content));

echo elgg_view_page(elgg_echo('suggested_friends_extended'), $body);
