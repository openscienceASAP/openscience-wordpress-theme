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
				$queryChildren = new WP_Query( array( 'post_type' => 'page',  'post_parent' => $pageID, 'post__not_in' => array( 667, 674, 676, 677 ), 'posts_per_page' => -1, 'orderby' => 'modified') );
				while ( $queryChildren->have_posts() ) {
					$queryChildren->the_post(); ?> 
					<div id="page-preview-<?php echo the_ID(); ?>" class="page-children-preview">
						<h3 class="page-children-title"><?php the_title(); ?></h3>
						<div>
							<div id="featured-image-<?php echo the_ID(); ?>" class="featured-image">
	            				<?php $attr = array(
		                			'class' => "folio-sample",                                  
	               					'rel' => $image_thumb_url[0], // REL attribute is used to show thumbnails in the Nivo slider, can be skipped if you don't want thumbs or using other slider
	           					); ?>
	       						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(240, 180), $attr); ?></a>
	       					</div>
	           				<div class="page-children-short-description">
								<?php echo get_post_meta($post->ID, 'short_description', single); ?>
	           				</div>
	           			</div>
	           			<div class="page-children-icons">
		       				<span class="small button more"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">view more</a></span>
		       			</div>
					</div>
				<?php } ?>
			</div>				
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
