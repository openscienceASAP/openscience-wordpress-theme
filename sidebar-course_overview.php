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

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : 
		//the_field('rss_feed_page');
		//the_field('projects');

	
		// read out variables
		$data_license = get_field('data_license');
		$content_license = get_field('content_license');
		$license_law =  get_field('license_jurisdiction');
		$sourcecode_license = get_field('sourcecode_license');
		$sourcecode_hoster = get_field('sourcecode_hosting');
		$sourcecode_repo = get_field('sourcecode_repo');
		$hashtag = get_field('twitter_hashtag');
		$category = get_the_category();
		$category_slug = $category[0]->slug;
		$language = get_field('language');
		$short_lang = get_short_lang($language);
		$twitter_timeline = get_field("twitter_timeline"); ?>

		<div id="secondary" class="widget-area" role="complementary"><!-- begin courseInformation -->
			<div class="courseInformations">
				<h2><?php echo get_lang($short_lang, "course"); ?></h2>
				<ul>
					<li>Status: <?php echo get_lang($short_lang, get_field('status') ); ?></li>
					<li>Start: <?php write_datestring2html( get_field('starting_date') ); ?></li>
					<li><?php echo get_lang($short_lang, "duration"); ?>: <?php echo the_field('course_duration'); ?> <?php echo get_lang($short_lang, "weeks"); ?></li>
					<li><?php echo get_lang($short_lang, "workload"); ?>: <?php the_field('course_workload') . get_lang($short_lang, "hperweek"); ?></li>
					<li><?php echo get_lang($short_lang, "language"); ?>: <?php get_flag( $short_lang, "medium" ); ?></li>
					<li><a href="<?php echo get_university_link(); ?>"><?php the_field('university_name'); ?></a></li>
					<li><a href="<?php echo get_course_link(); ?>"><?php echo get_lang($short_lang, "course"); ?></a> @ <a href="<?php echo get_platform_link(); ?>"><?php the_field('course_platform') ?></a></li>
					<li><?php echo get_lang($short_lang, "teacher"); ?>: <?php the_field('teacher_name') ?> <a href="http://www.twitter.com/<?php echo the_field('teacher_twitter'); ?>">T</a> + <a href="<?php echo get_teacher_link(); ?>">W</a></li>
					<li><a href="<?php echo get_freeuniversity_link(); ?>" title="Free University"><?php echo get_lang($short_lang, 'freeuniversity' ); ?></a></li>
				</ul>
			</div>

			<div class="open">
				<h2><?php echo get_lang($short_lang, "licenses"); ?></h2>
				<?php echo get_lang($short_lang, "contentlicensed");
				if( is_project_opendefinition( $data_license, $content_license, $sourcecode_license ) ) { ?>
				<a href="http://opendefinition.org/"><img alt="This material is Open Knowledge" border="0" src="http://assets.okfn.org/images/ok_buttons/ok_80x23_orange_grey.png" /></a> <?php
				} ?>

				<h3><?php echo get_lang($short_lang, "content"); ?></h3>
				<?php insert_license_logo_small( $content_license, $license_law );
				if ( is_content_opendefinition( $content_license ) ) { 
					?> <a href="http://opendefinition.org/"><img alt="This material is Open Content" border="0" src="http://assets.okfn.org/images/ok_buttons/oc_80x15_red_green.png" /></a> <?php 
				} ?>

				<h3><?php echo get_lang($short_lang, "data"); ?></h3>
				<?php insert_license_logo_small( $data_license, $license_law ); 
				if ( is_content_opendefinition( $content_license ) ) { 
					?> <a href="http://opendefinition.org/"><img alt="This material is Open Data" border="0" src="http://assets.okfn.org/images/ok_buttons/od_80x15_blue.png" /></a> <?php
				} ?>

				<h3><?php echo get_lang($short_lang, "sourcecode"); ?></h3>
					<p><?php echo get_lang($short_lang, "licensedunder"); ?> <?php get_license_html($sourcecode_license); ?>.</p>
					<p><?php get_repository_html( $sourcecode_repo ); ?></p>
			</div> <!-- end Openness -->

			<div class="recentposts">
				<?php get_latestPosts('post', $category_slug, $short_lang); ?>
			</div>

			<div class="projects">
				<?php get_related_projects($short_lang); ?>
			</div> <!-- end projects -->

			<?php $twitter_timeline = FALSE;
			if( $twitter_timeline == TRUE) { ?>
			<div class="socialMedia">
				<h2>Twitter</h2>
				<a class="twitter-timeline" href="https://twitter.com/search?q=%23compdata" data-widget-id="289088736677994497">Tweets über "#compdata"</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div> <!-- end socialMedia --> <?php 
			} ?>

			<div class="tags">
				<h2>Tags</h2>
				<?php get_all_tags( $category_slug ); ?>
			</div> <!-- end tags -->
	
		</div><!-- #secondary -->
	<?php endif; ?>
