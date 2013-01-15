<?php
/**
 * Template Name: Course Overview
 * Description: A Page Template for the overview page of a course
 *
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<div class="entry-content">
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); 

					// get language
					$language = get_field('language');
					$short_lang = get_short_lang($language); ?>

					<div class="shortDescription">
						<?php the_field('short_description'); ?>
					</div>

					<div class="description">
						<h2><?php echo get_lang($short_lang, "description"); ?></h2>
						<?php the_field('description'); ?>
					</div>

					<div class="openness">
						<h2><?php echo get_lang($short_lang, "openness"); ?></h2>
						<?php the_field('openness'); ?>
					</div>

					<div class="participation">
						<h2><?php echo get_lang($short_lang, "participation"); ?></h2>
						<div class="participation_options">
							<ul>
								<?php get_wiki_link();
								get_etherpad_link(); ?>
							<ul>
						</div>
						<div class="participants">
							<?php get_all_course_participants($short_lang); ?>						
						</div>
						<?php the_field('participation'); ?>
					</div>

					<div class="sources">
						<h2><?php echo get_lang($short_lang, "sources"); ?></h2>
						<?php the_field('sources'); ?>
					</div>
	 
				</div><!-- .entry-content -->

				<div>
					<h2><?php echo get_lang($short_lang, "revisions"); ?></h2>
					<?php the_revision_note_prd() ?>
					<?php the_revision_list_prd() ?>
					<?php the_revision_diffs_prd() ?>
				</div>

				<footer class="entry-meta">
					<?php echo get_lang($short_lang, "publishedat") . the_date() ?>, <?php the_time(); ?><br/>
					<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' );
					if ( function_exists('socialshareprivacy') ) { socialshareprivacy(); } ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post -->
			<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar('course_overview'); ?>
<?php get_footer(); ?>

