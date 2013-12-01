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
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<div id="recent-articles">
			<h2>Recent Articles</h2>
			<?php 
			$catID = get_post_meta($post->ID, 'page_category', single);
			$catURL = get_category_link( $catID );
			$queryPosts = new WP_Query( array( 'post_type' => 'post',  'cat' => $catID, 'posts_per_page' => 5) );
			//print_r($queryPosts);
			if( $queryPosts->found_posts && $catID) { ?>
				<ul>
					<?php
					while ( $queryPosts->have_posts() ) : $queryPosts->the_post(); ?>
							<li><a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul>
				<div class="page-recentarticles-bar">
					<div class="small button more"><a href="<?php echo $catURL; ?>" title="view more">view more</a></div>
				</div>
			<?php } else { echo "<p class=no-articles>no articles<p>"; } ?>
		</div>				

		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
