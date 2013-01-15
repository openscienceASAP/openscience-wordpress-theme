<?php
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'twentytwelve-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'twentytwelve-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );

/**
 * Activates ACF User Field Add-On
 *
 * @since Open Science 0.1.1
 */
if(function_exists('register_field'))
{
register_field('Users_field', dirname(__File__) . '/plugins/acf/users_field.php');
}

/**
 * Activates ACF Taxonomies Field Add-On
 *
 * @since Open Science 0.1.1
 */
if( function_exists( 'register_field' ) )
{
	register_field('Tax_field', dirname(__File__) . '/plugins/acf/acf-tax.php');
}

/**
 * Adds the Fields Institute + Website, Mendeley, Data Repository, Sourcecode Repository and Slideshare to the Profile Page
 *
 * @since Open Science 0.1.1
 */
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
	<h3>Scientific Informations</h3>
	<table class="form-table">
		<tr>
			<th><label for="profile">Open Science Profile</label></th>
			<span class="description"><?php echo "URL of your Open Science Profile page." ?></span>
			<td>
				<input type="text" name="profile" id="profile" value="<?php echo esc_attr( get_the_author_meta( 'profile', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="institute">Institute</label></th>
			<span class="description"><?php echo "This informations plus Email, Displayname, Website and Biographic Informations will be published." ?></span>
			<td>
				<input type="text" name="institute" id="institute" value="<?php echo esc_attr( get_the_author_meta( 'institute', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="institute-url">Institute Website</label></th>
			<td>
				<input type="text" name="institute-url" id="institute-url" value="<?php echo esc_attr( get_the_author_meta( 'institute-url', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>
		<tr>
			<th><label for="mendeley">Mendeley</label></th>
			<td>
				<input type="text" name="mendeley" id="mendeley" value="<?php echo esc_attr( get_the_author_meta( 'mendeley', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("URL"); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="slideshare">Slideshare</label></th>
			<td>
				<input type="text" name="slideshare" id="slideshare" value="<?php echo esc_attr( get_the_author_meta( 'slideshare', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("URL"); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="data-repository">Data Repository</label></th>
			<td>
				<input type="text" name="data-repository" id="data-repository" value="<?php echo esc_attr( get_the_author_meta( 'data-repository', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("URL"); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="sourcecode-repository">Sourcode Repository</label></th>
			<td>
				<input type="text" name="sourcecode-repository" id="sourcecode-repository" value="<?php echo esc_attr( get_the_author_meta( 'sourcecode-repository', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("URL"); ?></span>
			</td>
		</tr>
	</table>
<?php }

/**
 * Saves new user profile fields
 * 
 * @since Open Science 0.1.1
 */
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

	update_user_meta( $user_id, 'profile', $_POST['profile'] );
	update_user_meta( $user_id, 'institute', $_POST['institute'] );
	update_user_meta( $user_id, 'institute-url', $_POST['institute-url'] );
	update_user_meta( $user_id, 'mendeley', $_POST['mendeley'] );
	update_user_meta( $user_id, 'slideshare', $_POST['slideshare'] );
	update_user_meta( $user_id, 'data-repository', $_POST['data-repository'] );
	update_user_meta( $user_id, 'sourcecode-repository', $_POST['sourcecode-repository'] );
}

/**
 * Insert Creative Commons License Logos
 * 
 * @since Open Science 0.1.1
 */
function insert_license_logo_small( $license, $law, $width = -1) { 
	if ($width == -1) $width = 88;

	if($license == 'cc-zero') {
		$license_url = "https://creativecommons.org/about/cc0";
	}
	else {
		$license_url = "https://creativecommons.org/licenses/" . $license . "/3.0/" . $law;
	}
	$image_url = get_template_directory_uri() . "/images/logos/" . $license . ".png";
?>
<a rel="license" href="<?php echo $license_url ?>"><img alt="Creative Commons License" style="border-width:0" src="<?php echo $image_url ?>" width="<?php echo $width; ?>" height="31" /></a>
<?php }

/**
 * Is the Project (Science, Project and Course) Open Knowledge, Open Science?
 * 
 * @since Open Science 0.1.1
 */
function is_project_opendefinition( $data, $content, $sourcecode ) { 
	if( is_content_opendefinition( $content ) && is_data_opendefinition( $data ) && is_software_opensource( $sourcecode ) ) return TRUE;
	else return FALSE;
}

/**
 * Is the content open by the opendefinition?
 * 
 * @since Open Science 0.1.1
 */
function is_content_opendefinition( $license ) { 

	// http://opendefinition.org/licenses/
	if( $license == 'by' || $license == 'cc-zero' || $license == 'by-sa' || $license == 'fdl' || $license == 'fal' || $license == 'miros'  ) return TRUE;
	else return FALSE;
}

/**
 * Is the data open by the opendefinition?
 * 
 * @since Open Science 0.1.1
 */
function is_data_opendefinition( $license ) { 

	// http://opendefinition.org/licenses/
	if( $license == 'odcpddl' || $license == 'odcby' || $license == 'odbl' || $license == 'cc-zero' ) return TRUE;
	else return FALSE;
}

/**
 * Is the Sourcecode Open Source?
 * 
 * @since Open Science 0.1.1
 */
function is_software_opensource( $license ) { 
	return TRUE;
}

/**
 * Get HTML of repository
 * 
 * @since Open Science 0.1.1
 */
function get_repository_html( $repo_url ) {
	// parse host out of url
	$repo = parse_url($repo_url);
	$hoster = $repo['host'];

	switch ($hoster) {
		case "github.com":
		case "www.github.com":
			// parse repo and username out of url
			$repo_path = $repo['path'];
			$github_repo = split("/", $repo_path);
			$username = $github_repo[1];
			$repo_name = $github_repo[2];
			get_github_button($username, $repo_name, "watch");
			break;

		case "bitbucket.org": 
		case "www.bitbucket.org": 
			$domain = "https://bitbucket.org/";
			$hoster = "bitbucket";
			?><a href="<?php echo $repo_url; ?>">Repository</a> hosted at <a href="<?php echo $domain; ?>">Bitbucket.org</a> <?php
			break;

		default:
			$domain = $repo['scheme'] . "://" . $repo['host'];
			$hoster = $repo['host'];
			?><a href="<?php echo $repo_url; ?>">Repository</a> hosted at <a href="<?php echo $domain; ?>"><?php echo $hoster; ?></a> <?php
			break;
	}
}

/**
 * Get HTML of License
 * 
 * @since Open Science 0.1.1
 */
function get_license_html( $license ) {

	// write license text with link to license
	switch ($license) {
		case "GPLv2": 
			$license_url = "https://www.gnu.org/licenses/gpl-2.0.html";
			$license = "GPL v2";
			break;

		case "GPLv3":
			$license_url = "http://gplv3.fsf.org/";
			$license = "GPL v3";
			break;

		case "BSD 2-clause":
			$license_url = "http://opensource.org/licenses/BSD-2-Clause";
			$license = "BSD 2-clause License";
			break;

		case "BSD 3-clause":
			$license_url = "http://opensource.org/licenses/BSD-3-Clause";
			$license = "BSD 3-clause License";
			break;

		case "MIT":
			$license_url = "http://opensource.org/licenses/mit-license.html";
			$license = "MIT License";
			break;

		case "MPLv2":
			$license_url = "http://opensource.org/licenses/MPL-2.0";
			$license = "Mozilla Public License 2.0";
			break;

		case "LGPLv2.1":
			$license_url = "http://opensource.org/licenses/lgpl-2.1.php";
			$license = "Lesser GPL v2.1";
			break;

		case "LGPLv3.0":
			$license_url = "http://opensource.org/licenses/lgpl-3.0.html";
			$license = "Lesser GPL v3.0";
			break;

		case "ApacheLv2.0":
			$license_url = "http://opensource.org/licenses/Apache-2.0";
			$license = "Apache License 2.0";
			break;
	} ?>
	<a href="<?php echo $license_url; ?>"><?php echo $license; ?></a> <?php
}

/**
 * Get latest post of a category
 * 
 * @since Open Science 0.1.1
 */
function get_latestPosts($posttype, $category, $language, $count = 5) { 
	$myQuery = new WP_Query( array( 'post_type' => $posttype, 'posts_per_page' => $count, 'category_name' => $category ) ); 
	$num_posts = count($myQuery);
	if( $num_posts > 0 ) { ?>
		<div class="content">
			<h2><?php echo get_lang($language, "recentArticles"); ?></h2>
			<ul>
				<?php while( $myQuery->have_posts() ) : $myQuery->the_post();
					?><li class="latestPosts"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li><?php 
				endwhile; 
				wp_reset_postdata(); ?>
				<li><a href="<?php echo home_url() . '/category/' . $category; ?>"><button class="btn btn-mini" type="button">Read more >></button></a></li>
			</ul> 
			<p><a href="<?php echo home_url() . '/category/' . $category_slug . '/feed'; ?>"><img alt="RSS Feed" src="<?php echo get_template_directory_uri(); ?>/images/rss-small.gif" />RSS Feed</a></p>
		</div> <!-- end articles --> <?php
	} 
}

/**
 * Get GitHub Button via http://ghbtns.com/
 * 
 * @since Open Science 0.1.1
 */
function get_github_button($username, $repo, $buttontype = "watch", $count = TRUE) {
	if($count == TRUE) {
		?><iframe src="http://ghbtns.com/github-btn.html?user=<?php echo $username; ?>&repo=<?php echo $repo; ?>&type=<?php echo $buttontype; ?>&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe> <?php
	} else {
		?><iframe src="http://ghbtns.com/github-btn.html?user=<?php echo $username; ?>&repo=<?php echo $repo; ?>&type=<?php echo $buttontype; ?>" allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe> <?php
	}
}

/**
 * Convert the numeric date representation into html and write the result
 * 
 * @since Open Science 0.1.1
 */
function write_datestring2html($date) {
	$date = split("-", $date);
	echo strftime( "%e. %b %Y", mktime(12, 0, 0, $date[1], $date[2], $date[0] ) );
}

/**
 * shows the flag of a language
 * 
 * @since Open Science 0.1.1
 */
function get_flag($language, $size) {
	$filename = $language;

	// get size
	switch($size) {
		case "small":
			$filename = $filename . "-16";
			break;

		case "medium":
			$filename = $filename . "-24";
			break;

		case "large":
			$filename = $filename . "-32";
			break;
	} ?>
	<img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $filename; ?>.png" alt="<?php echo $language; ?> Flag" width="24" height="24" /> <?php
}

/**
 * Returns the short form of the language
 * 
 * @since Open Science 0.1.1
 */
function get_short_lang($language) {

	// get language
	switch($language) {
		case "German":
			$short = "de";
			break;

		case "English":
			$short = "en";
			break;
	}
	return $short;
}

/**
 * Register Categories for posts
 * 
 * @since Open Science 0.1.1
 */
register_taxonomy_for_object_type( "category", "post" );

/**
 * Returns text in the proper language
 * 
 * @since Open Science 0.1.1
 */
function get_lang($language, $ID) {
	
	switch($ID) {
		case "description":
			$text['de'] = "Beschreibung";
			$text['en'] = "Description";
			break;

		case "openness":
			$text['de'] = "Offenheit";
			$text['en'] = "Openness";
			break;

		case "participation":
			$text['de'] = "Partizipieren";
			$text['en'] = "Participation";
			break;

		case "sources":
			$text['de'] = "Quellen";
			$text['en'] = "Sources";
			break;

		case "revisions":
			$text['de'] = "Revisionen";
			$text['en'] = "Revisions";
			break;

		case "coursedetails":
			$text['de'] = "Kurs Details";
			$text['en'] = "Course Details";
			break;

		case "duration":
			$text['de'] = "Dauer";
			$text['en'] = "Duration";
			break;

		case "workload":
			$text['de'] = "Aufwand";
			$text['en'] = "Workload";
			break;

		case "language":
			$text['de'] = "Sprache";
			$text['en'] = "Language";
			break;

		case "courseinstitution":
			$text['de'] = "Kurs Institution";
			$text['en'] = "Course Institution";
			break;

		case "articles":
			$text['de'] = "Artikel";
			$text['en'] = "Articles";
			break;

		case "teacher":
			$text['de'] = "Lehrperson";
			$text['en'] = "Teacher";
			break;

		case "licenses":
			$text['de'] = "Lizenzen";
			$text['en'] = "Licenses";
			break;

		case "contentlicensed":
			$text['de'] = "Der Inhalt steht unter den folgenden Lizenzen solange nicht anders angegeben.";
			$text['en'] = "The content is licensed under the following license(s), except otherwise stated.";
			break;

		case "content":
			$text['de'] = "Inhalt";
			$text['en'] = "Content";
			break;

		case "data":
			$text['de'] = "Daten";
			$text['en'] = "Data";
			break;

		case "sourcecode":
			$text['de'] = "Quellcode";
			$text['en'] = "Sourecode";
			break;

		case "licensedunder":
			$text['de'] = "Lizenziert unter";
			$text['en'] = "Licensed under";
			break;

		case "course":
			$text['de'] = "Kurs";
			$text['en'] = "Course";
			break;

		case "author":
			$text['de'] = "AutorIn";
			$text['en'] = "Author";
			break;

		case "allarticles":
			$text['de'] = "Alle Artikel";
			$text['en'] = "All Articles";
			break;

		case "category":
			$text['de'] = "Kategorie";
			$text['en'] = "Category";
			break;

		case "hperweek":
			$text['de'] = " Std. / Woche";
			$text['en'] = "h / week";
			break;

		case "weeks":
			$text['de'] = "Wochen";
			$text['en'] = "weeks";
			break;

		case "biography":
			$text['de'] = "Biographie";
			$text['en'] = "Biography";
			break;

		case "institute":
			$text['de'] = "Institut";
			$text['en'] = "Institute";
			break;

		case "page":
			$text['de'] = "Seite";
			$text['en'] = "Page";
			break;

		case "profile":
			$text['de'] = "Profil";
			$text['en'] = "Profile";
			break;

		case "comingsoon":
		case "announcement":
			$text['de'] = "Beginn in Kürze";
			$text['en'] = "Coming Soon";
			break;

		case "underwrapup":
		case "wrapping-up":
			$text['de'] = "In Nachbereitung";
			$text['en'] = "Under Wrap-Up";
			break;

		case "running":
		case "participating":
			$text['de'] = "Am Laufen";
			$text['en'] = "Running";
			break;

		case "preparations":
			$text['de'] = "In Vorbereitung";
			$text['en'] = "Under Preparation";
			break;

		case "recentArticles":
			$text['de'] = "Letzten Artikel";
			$text['en'] = "Recent Articles";
			break;

		case "participants":
			$text['de'] = "TeilnehmerInnen";
			$text['en'] = "Participants";
			break;

		case "publishedat":
			$text['de'] = "Veröffentlicht am ";
			$text['en'] = "Published at ";
			break;

		case "relatedprojects":
			$text['de'] = "Verbundene Projekte";
			$text['en'] = "Related Projects";
			break;

		case "freeuniversity":
			$text['de'] = "Freie Universität";
			$text['en'] = "Free University";
			break;
	}
	echo $text[$language];
}

/**
 * List up all participants of a course
 * 
 * @since Open Science 0.1.1
 */
function get_all_course_participants($language) {
	$participants = get_field('participants');
	?> <h2><?php echo get_lang($language, "participants"); ?></h2>
	<ul> <?php

	foreach( $participants as $user) {
		// get name and profile url of participant
		$profile = "http://openscience.alpine-geckos.at/profile/user/" . $user[ID];
		$name = $user[display_name]; ?>
			<li><?php echo $name; ?><a href="<?php echo $profile; ?>" title="profile"><i class="icon-info-sign"></i></a></li> <?php
	}
	?> </ul> <?php
}

/**
 * Lists all related project
 * 
 * @since Open Science 0.1.1
 */
function get_related_projects($language) { 
	$projects = get_field("projects"); 
	if($projects == TRUE) {?>
		<div>
			<h2><?php echo get_lang($language, "relatedprojects"); ?></h2>
			<ul> <?php
				foreach($projects as $project) { ?>
					<li><a href="<?php echo get_permalink( $project->ID ); ?>" title="related project"><?php echo $project->post_title; ?></a></li> <?php
				} ?>
			</ul>
		</div> <?php
	}
}

/**
 * Lists all related project
 * 
 * @since Open Science 0.1.1
 */
function get_all_tags( $category ) { 
	// query all posts of category
	//$myQuery = new WP_Query( array( 'post_type' => 'post', 'category_name' => $category ) ); 
	$tag_array = array();
	$myQuery = get_posts( array( 'category' => $category ) ); 

	foreach($myQuery as $post) {
		//print_r($post);
		$tags = get_the_terms( $post->id, 'post_tag' ); 
		//print_r($tags);
		foreach($tags as $tag) {
			$key = $tag->term_id;
			$tag_array = array( $tag->name, $tag->slug );
			$tags_array[$key] = $tag_array;
		}
	}
	wp_reset_postdata(); ?>

	<!-- write array into html list -->
	<ul> <?
	foreach($tags_array as $tag) { ?>
		<li><a href="<?php home_url(); ?>/tag/<?php echo $tag[1]; ?>" title="tag"><?php echo $tag[0]; ?></a></li>
	<?php } ?>
	</lu> <?php
}

/**
 * Returns Etherpad Link, if there is one
 * 
 * @since Open Science 0.1.2
 */
function get_etherpad_link() { 
	$url = get_field('etherpad');
	if( validate_URL($url) ) { ?>
		<li><a href="<?php echo $url; ?>">Etherpad</a></li> <?php
	}
}

/**
 * Returns Wiki Link, if there is one
 * 
 * @since Open Science 0.1.2
 */
function get_wiki_link() { 
	$url = get_field('wiki-page');
	if( validate_URL($url) ) { ?>
		<li><a href="<?php echo $url; ?>">Wiki</a></li> <?php
	}
}

/**
 * Validates URL via regex
 * 
 * @since Open Science 0.1.2
 */
function validate_URL( $url ) { 
	$urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
	if (eregi($urlregex, $url)) {return TRUE ;} else {return FALSE;}
}

/**
 * Returns University Link, if there is one
 * 
 * @since Open Science 0.1.2
 */
function get_university_link() { 
	$url = get_field('university_url');
	if( validate_URL($url) ) {
		return $url;
	}
}

/**
 * Returns Course Platform Link, if there is one
 * 
 * @since Open Science 0.1.2
 */
function get_platform_link() { 
	$url = get_field('course_platform_url');
	if( validate_URL($url) ) {
		return $url;
	}
}

/**
 * Returns Course Page Link, if there is one
 * 
 * @since Open Science 0.1.2
 */
function get_course_link() { 
	$url = get_field('course_page');
	if( validate_URL($url) ) {
		return $url;
	}
}

/**
 * Returns Teacher Link, if there is one
 * 
 * @since Open Science 0.1.2
 */
function get_teacher_link() { 
	$url = get_field('teacher_url');
	if( validate_URL($url) ) {
		return $url;
	}
}

/**
 * Returns Free University Link, if there is one
 * 
 * @since Open Science 0.1.2
 */
function get_freeuniversity_link() {
	$url = get_field('free_university');
	if( validate_URL($url) ) {
		return $url;
	}
}



