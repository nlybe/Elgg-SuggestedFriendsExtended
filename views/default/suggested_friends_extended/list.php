<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */
 ?>

<div class="pftn_list_title">
	<h2><?php echo elgg_echo('suggested_friends_extended'); ?></h2>
</div>
<?php echo elgg_view('suggested_friends_extended/people', array('people' => $vars['people'], 'num_display' => $vars['num_display'])); ?>
