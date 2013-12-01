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

$parents = get_ancestors( $post->ID, 'page', true );
$parent = get_page( $parents[0] ); ?>
<div class="sidebar-left">
	<?php if ($parent) { ?>
		<div id="menu-parentpage">
			<h2><a href="<?php echo get_permalink( $parent->ID ); ?>" title="<?php echo $parent->post_title; ?>"><?php echo $parent->post_title; ?></br><<</a></h2>
		</div>
	<?php } ?>
</div>
<?php
$children = wp_list_pages( array(
	'child_of' => get_the_ID(), // Only pages that are children of the current page
	'depth' => 1 ,   // Only show one level of hierarchy
	'sort_order' => 'asc',
	'title_li' => '',
	'echo' => '0',
	'post_status'  => 'publish' 
)); 
if($children) { ?>
	<div class="sidebar-right">
		<div id="menu-childpages">
			<h2>>></h2>
			<ul>
				<?php echo $children; ?>
			</ul>
		</div><?php
} else { ?>
	<div class="sidebar-empty">
<?php } ?>
	<div id="menu-stream">
	<?php 
		$catID = get_post_meta($post->ID, 'page_category', single); 
		$catURL = get_category_link( $catID );
	?>
		<h2><a href="<?php echo $catURL; ?>" title="Articles">Articles</a> <a href="<?php echo $catURL; ?>feed" title="RSS Feed" class="icon-rss"></a></h2>
	</div>
</div>

