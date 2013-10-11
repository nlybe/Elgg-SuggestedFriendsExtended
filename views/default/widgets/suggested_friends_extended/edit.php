<?php
/**
 * Elgg suggested_friends_extended plugin
 *
 * @package SuggestedFriendsExtended 
 * Based on suggested_friends by Matt Beckett
 */

//
// number of results
$num_display = $vars['entity']->num_display;
if($num_display == ''){
	$num_display = '5';
} 
?>

<p>
		<?php echo elgg_echo("suggested_friends_extended:how:many"); ?>:
		<select name="params[num_display]">
			<option value="1" <?php if($num_display == 1) echo "SELECTED"; ?>>1</option>
			<option value="2" <?php if($num_display == 2) echo "SELECTED"; ?>>2</option>
			<option value="3" <?php if($num_display == 3) echo "SELECTED"; ?>>3</option>
			<option value="4" <?php if($num_display == 4) echo "SELECTED"; ?>>4</option>
			<option value="5" <?php if($num_display == 5) echo "SELECTED"; ?>>5</option>
			<option value="6" <?php if($num_display == 5) echo "SELECTED"; ?>>6</option>
			<option value="7" <?php if($num_display == 5) echo "SELECTED"; ?>>7</option>
			<option value="8" <?php if($num_display == 5) echo "SELECTED"; ?>>8</option>
			<option value="9" <?php if($num_display == 5) echo "SELECTED"; ?>>9</option>
			<option value="10" <?php if($num_display == 5) echo "SELECTED"; ?>>10</option>
		</select>
</p>



