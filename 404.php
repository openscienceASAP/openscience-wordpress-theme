<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

// WP 404 ALERTS @ http://wp-mix.com/wordpress-404-email-alerts/

// set status
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");

// site info
$blog  = get_bloginfo('name');
$site  = get_bloginfo('url') . '/';
$email = get_bloginfo('admin_email');

// theme info
if (!empty($_COOKIE["nkthemeswitch" . COOKIEHASH])) {
	$theme = clean($_COOKIE["nkthemeswitch" . COOKIEHASH]);
} else {
	$theme_data = wp_get_theme();
	$theme = clean($theme_data->Name);
}

// referrer
if (isset($_SERVER['HTTP_REFERER'])) {
	$referer = clean($_SERVER['HTTP_REFERER']);
} else {
	$referer = "undefined";
}
// request URI
if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER["HTTP_HOST"])) {
	$request = clean('http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
} else {
	$request = "undefined";
}
// query string
if (isset($_SERVER['QUERY_STRING'])) {
	$string = clean($_SERVER['QUERY_STRING']);
} else {
	$string = "undefined";
}
// IP address
if (isset($_SERVER['REMOTE_ADDR'])) {
	$address = clean($_SERVER['REMOTE_ADDR']);
} else {
	$address = "undefined";
}
// user agent
if (isset($_SERVER['HTTP_USER_AGENT'])) {
	$agent = clean($_SERVER['HTTP_USER_AGENT']);
} else {
	$agent = "undefined";
}
// identity
if (isset($_SERVER['REMOTE_IDENT'])) {
	$remote = clean($_SERVER['REMOTE_IDENT']);
} else {
	$remote = "undefined";
}
// log time
$time = clean(date("F jS Y, h:ia", time()));

// sanitize
function clean($string) {
	$string = rtrim($string); 
	$string = ltrim($string); 
	$string = htmlentities($string, ENT_QUOTES); 
	$string = str_replace("n", "<br>", $string);

	if (get_magic_quotes_gpc()) {
		$string = stripslashes($string);
	} 
	return $string;
}

$message = 
	"TIME: "            . $time    . "n" . 
	"*404: "            . $request . "n" . 
	"SITE: "            . $site    . "n" . 
	"THEME: "           . $theme   . "n" . 
	"REFERRER: "        . $referer . "n" . 
	"QUERY STRING: "    . $string  . "n" . 
	"REMOTE ADDRESS: "  . $address . "n" . 
	"REMOTE IDENTITY: " . $remote  . "n" . 
	"USER AGENT: "      . $agent   . "nnn";

mail($email, "404 Alert: " . $blog . " [" . $theme . "]", $message, "From: $email"); 

// start html
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>


