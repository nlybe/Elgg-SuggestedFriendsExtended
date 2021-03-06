<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */


$widget = $vars['entity'];

$num_display = $widget->num_display != null ? $widget->num_display : SUGGESTED_FRIENDS_LIMIT;

//$people = suggested_friends_extended_get_people(elgg_get_logged_in_user_guid(), $friends, $groups);
$people = suggested_friends_extended_get_people(elgg_get_logged_in_user_guid(), $num_display);

echo elgg_view('suggested_friends_extended/people', array('people' => $people, 'num_display' => $num_display)); ?>

<div class="clearfloat"></div>
<div class="widget_more_wrapper"><a href="<?php echo elgg_get_site_url(); ?>suggested_friends_extended"><?php echo elgg_echo('suggested_friends_extended:see:more'); ?></a></div>
