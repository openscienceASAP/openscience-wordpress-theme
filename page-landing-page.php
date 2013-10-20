<?php
/**
 * Template Name: Landing Page
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
		<div id="landing-page">
			<div id="about">
				<div id="openscience">
					<h2>Open Science</h2>
					Open Science öffnet Wissenschaft und ermöglicht allen einfach und unkompliziert die Teilhabe daran.
	
					Dabei ist Wissenschaft sehr weit gedacht und schliesst alle Disziplinen, die Lehre dazu sowie Projekte und Ressourcen rund herum mit ein.
				</div>
				<div id="asap">
					<h2>AS A Practice</h2>
				</div>
				<div id="get-involved">
					<h2>Get Involved!</h2>
					<ul>
						<li>Schreiben und Durchführen von Forschung, Kursen und Projekten</li>
						<li>Tools entwickeln</li>
						<li>Newsletter abonnieren</li>
						<li>Support</li>
					</ul>
				</div>
			</div>
			<h2 class="button stream"><a href="http://openscienceasap.org/stream" title="Stream openscienceASAP">Stream</a></h2>
			<div id="stream">
				<?php $i = 1;
				$queryStream = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'orderby' => 'date') );
				while ( $queryStream->have_posts() ) : $queryStream->the_post(); { ?>
					<div id="post-preview-<?php echo $i; ?>">
						<h3 class="preview-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<?php if( has_post_thumbnail()) {
							$image_id = get_post_thumbnail_id ($post->ID ); 
            				$image_thumb_url = wp_get_attachment_image_src( $image_id,'small-thumb');                              
            				$attr = array(
		                		'class' => "folio-sample",                                  
                				'rel' => $image_thumb_url[0], // REL attribute is used to show thumbnails in the Nivo slider, can be skipped if you don't want thumbs or using other slider
            				);
            				?><a class="thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('myFeature', $attr); ?></a><?php
						} else { ?>
            				<div class="thumb">
            					<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_directory');?>/images/thumbs/thumb-<?php echo $catName; ?>.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" widht="300" height="260"></a>
           					</div>
           				<?php 
           				}
						$list_cats = get_category_parents(get_the_category()[0], true, ",");
						$arr_cats = explode(",", $list_cats); ?>
						<div class="preview-category">
							<?php echo $arr_cats[0] . " : " . $arr_cats[count($arr_cats)-2]; ?>
						</div>
					</div>
					<?php $i++;
				} endwhile; // end of the loop. ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>