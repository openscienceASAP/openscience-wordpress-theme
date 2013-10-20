<?php
/**
 * Template Name: Stream
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div class="sidebar-left"></div>
		<?php get_sidebar(); ?>
		<div id="content" role="main">
				<div id="stream">
					<h2>Stream</h2>
					<?php $i = 1;
					$queryStream = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'orderby' => 'date') );
					while ( $queryStream->have_posts() ) : $queryStream->the_post(); { ?>
						<div id="post-preview-<?php echo $i; ?>">
							<?php if( has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id ($post->ID ); 
	            				$image_thumb_url = wp_get_attachment_image_src( $image_id,'small-thumb');                              
	            				$attr = array(
			                		'class' => "folio-sample",                                  
	                				'rel' => $image_thumb_url[0], // REL attribute is used to show thumbnails in the Nivo slider, can be skipped if you don't want thumbs or using other slider
	            				);
	            				?><a class="thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('myFeature', $attr); ?></a><?php
							} else { 
								$imgNum = (get_the_ID() % 8) + 1;
	            				?><a class="thumb" href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_directory');?>/images/thumbs/thumb-<?php echo $imgNum; ?>.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" height="140" widht="215"></a><?php
							}?>	
							<div class="post-excerpt">
								<a class="thumb" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
								<div class="preview-article-text">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
						<?php $i++;

					} endwhile; // end of the loop. ?>
				</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
