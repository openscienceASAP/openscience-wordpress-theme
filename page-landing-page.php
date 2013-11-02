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
					<h2 class="landingpage-header">Open Science</h2>
					<div>
					<?php echo get_post_meta($post->ID, 'about', single); ?>
					<!--
					Open Science <strong>öffnet Wissenschaft und ermöglicht allen die Teilhabe</strong> daran.
	
					Dabei ist Wissenschaft sehr weit gedacht und schliesst alle Disziplinen, wie auch Lehre, Projekte und Ressourcen mit ein.
					-->
					</div>
				</div>
				<div id="asap">
					<h2 class="landingpage-header">AS A Practice</h2>
					<div>
					<?php echo get_post_meta($post->ID, 'ASAP', single); ?>
					<!--
					<strong>openscienceASAP.org</strong> ist eine Plattform um 
					<ul>
						<li>offene Wissenschaft zu betreiben,</li>
						<li>sich eine offene Arbeitsweise anzueignen</li>
						<li>und sich dazu auszutauschen</li>
					</ul>
					 ...the practical way!
					 -->
					</div>
				</div>
				<div id="get-involved">
					<h2 class="landingpage-header">Get Involved!</h2>
					<?php echo get_post_meta($post->ID, 'get involved', single); ?>
					<!--
					<div>
						Nutze die Plattform für dich:
						<ul>
							<li>Öffne deine Ideen und Werke aus Forschung, Lehrveranstaltungen und Projekten</li>
							<li>Tools entwickeln</li>
							<li>Bloggen</li>
							<li>Wissen austauschen</li>
						</ul>
					</div>
					-->
				</div>
			</div>
			<h2 class="button stream"><a href="http://openscienceasap.org/stream" title="Stream openscienceASAP">Stream</a></h2>
			<div id="stream">
				<?php $i = 1;
				$queryStream = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'orderby' => 'date') );
				while ( $queryStream->have_posts() ) : $queryStream->the_post(); { ?>
					<div id="post-preview-<?php echo $i; ?>" class="post-preview-box">
						<h3 class="preview-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<?php if( has_post_thumbnail()) {
            				$attr = array(
		                		'class' => "folio-sample",                                  
                				'rel' => $image_thumb_url[0], // REL attribute is used to show thumbnails in the Nivo slider, can be skipped if you don't want thumbs or using other slider
            				);
            				?>
            				<div id="thumb-<?php echo $i; ?>" class="thumb">
            					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-preview', $attr); ?></a>
            				</div>
            			<?php } else { ?>
            				<div id="thumb-<?php echo $i; ?>" class="thumb">
            					<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_directory');?>/images/thumbs/thumb-<?php echo $catName; ?>.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" widht="300" height="240"></a>
           					</div>
           				<?php 
           				}
           				$cats = get_the_category();
           				$cat = $cats[0];
						$list_cats = get_category_parents($cat, true, ",");
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