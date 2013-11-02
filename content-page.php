<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<div id="children-preview">
				<?php
				$pageID = get_the_ID();
				$queryChildren = new WP_Query( array( 'post_type' => 'page',  'post_parent' => $pageID, 'posts_per_page' => -1, 'orderby' => 'modified') );
				while ( $queryChildren->have_posts() ) {
					$queryChildren->the_post(); ?> 
					<div class="page-children-preview">
						<h3 class="page-children-title"><?php the_title(); ?></h3>
						<div class="page-children-excerpt">
							<?php echo get_post_meta($post->ID, 'short_description', single); ?>
						</div>
						<div id="featured-image-<?php echo the_ID(); ?>" class="featured-image">
							<?php if( has_post_thumbnail()) {
	            				$attr = array(
			                		'class' => "folio-sample",                                  
	                				'rel' => $image_thumb_url[0], // REL attribute is used to show thumbnails in the Nivo slider, can be skipped if you don't want thumbs or using other slider
	            				);
	            				?>
	           					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', $attr); ?></a>
	           				<?php } ?>
						</div>
						<div class="small button more"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">view more</a></div>
					</div>
				<?php } ?>
			</div>				
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
