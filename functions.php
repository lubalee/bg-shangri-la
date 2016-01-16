<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Load the Embed GitHub Gist plugin
include_once( get_stylesheet_directory() . '/lib/embed-github-gist.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Shangri-La' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Remove scripts
add_action( 'wp_enqueue_scripts', 'bg_scripts' );
function bg_scripts() {

	wp_dequeue_script( 'devicepx' );
	wp_deregister_script( 'comment-reply' );

}

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'bg_scripts_styles' );
function bg_scripts_styles() {

	wp_enqueue_script( 'bg-menu', get_stylesheet_directory_uri() . '/js/menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );

}

//* Remove scripts and styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Remove Jetpack frontend CSS
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

//* Unregister header right widget area
unregister_sidebar( 'header-right' );

//* Remove sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

//* Reposition primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after', 'genesis_do_nav' );

//* Exclude categories from blog homepage
add_action( 'pre_get_posts', 'bg_exclude_categories' );
function bg_exclude_categories( $query ) {

	if( $query->is_main_query() && $query->is_home() ) {
		$query->set( 'cat', '-5,-7' );
	}

}

//* Add welcome message on front page
add_action( 'genesis_after_header', 'bg_welcome_message' );
function bg_welcome_message() {

	if ( ! is_front_page() || get_query_var( 'paged' ) >= 2 )
		return;

	genesis_widget_area( 'welcome-message', array(
		'before' => '<div class="welcome-message"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

//* Customize more tag
add_filter( 'the_content_more_link', 'bg_custom_more_tag' );
function bg_custom_more_tag() {

	return '<a class="more-link" href="' . get_permalink() . '">Continue Reading</a>';

}

//* Remove entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the entry meta in the entry footer
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

//* Remove site footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Hook site footer widget area
add_action( 'genesis_footer', 'bg_site_footer', 3 );
function bg_site_footer() {

	genesis_widget_area( 'site-footer', array(
		'before' => '<footer class="site-footer" itemscope itemtype="http://schema.org/WPFooter"><div class="wrap">',
		'after'  => '</div></footer>',
	) );

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'welcome-message',
	'name'        => __( 'Welcome Message', 'bg' ),
	'description' => __( 'This is the welcome message widget area.', 'bg' ),
) );
genesis_register_sidebar( array(
	'id'          => 'newsletter-signup',
	'name'        => __( 'Newsletter Signup', 'bg' ),
	'description' => __( 'This is the newsletter signup widget area.', 'bg' ),
) );
genesis_register_sidebar( array(
	'id'          => 'site-footer',
	'name'        => __( 'Site Footer', 'bg' ),
	'description' => __( 'This is the site footer widget area.', 'bg' ),
) );