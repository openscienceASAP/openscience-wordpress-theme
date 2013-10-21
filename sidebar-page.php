<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<?php 
	$children = wp_list_pages( array(
		'child_of' => get_the_ID(), // Only pages that are children of the current page
		'depth' => 1 ,   // Only show one level of hierarchy
		'sort_order' => 'asc',
		'title_li' => '',
		'echo' => '0',
		'post_status'  => 'publish' 
	)); 
	if($children) {
		?><div id="sidebar-page" class="sidebar-right"><h2>Navigation</h2> <?php
		echo $children;
		?></div><?php
	} else { ?>
		<div id="sidebar-page" class="sidebar-empty"></div>
	<?php }
	?>
