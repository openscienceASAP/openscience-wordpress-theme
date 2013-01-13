<?php
/**
 * Template Name: Courses Page
 * Description: A Page Template for the Courses Page
 *
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<?php while ( have_posts() ) : the_post();
						$sections = array( "announcement", "preparations", "participating", "wrapping-up" );
						foreach ( $sections as $parts ) { 
							$myQuery = new WP_Query( array( 'post_type' => 'page', 'post_parent' => $post->ID, 'meta_key' => 'status', 'meta_value' => $parts ) ); ?>
							<h2><?php echo get_lang('en', $parts); ?></h2> <?php
							while ( $myQuery->have_posts() ) : $myQuery->the_post(); ?>
								<div>
									<h2><?php the_title(); ?></h2>
									<p><?php the_field("short_description" ); ?></p>
									<a href="<?php echo get_permalink($post->ID); ?>"><buttuon class="btn btn-mini">more</button></a>
								</div>
							<?php endwhile;
						wp_reset_postdata();
						} // End FOREACH
					endwhile; // end of the loop. ?>
					<?php if ( function_exists('socialshareprivacy') ) { socialshareprivacy(); } ?>
				</article><!-- #post -->	
			</div><!-- #content -->
			<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
			<?php comments_template( '', true ); ?>
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


