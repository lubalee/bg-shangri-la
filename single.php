<?php
	
//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'bg_enqueue_google_font_styles' );
function bg_enqueue_google_font_styles() {

	if ( is_single( '2140' ) ) {
		wp_enqueue_style( 'bg-google-fonts', '//fonts.googleapis.com/css?family=Lato:700|Merriweather:300|Montserrat:700|Neuton:300|Oswald:700|Quattrocento:400|Playfair+Display:700|Open+Sans:400|Roboto+Slab:700|Roboto:300', array(), CHILD_THEME_VERSION );
		wp_enqueue_style( 'bg-google-fonts-styles', get_stylesheet_directory_uri() . '/css/google-fonts.css' );

	}

	if ( is_single( '3823' ) ) {
		wp_enqueue_style( 'bg-google-fonts', '//fonts.googleapis.com/css?family=Arvo:400|Droid+Serif:400|Lora:400|Roboto+Slab:400|Slabo+27px:400', array(), CHILD_THEME_VERSION );
		wp_enqueue_style( 'bg-google-fonts-styles', get_stylesheet_directory_uri() . '/css/google-fonts.css' );

	}

	if ( is_single( '9121' ) ) {
		wp_enqueue_style( 'bg-google-fonts', '//fonts.googleapis.com/css?family=Lato:400|Open+Sans:400|Raleway:400|Roboto:400|Source+Sans+Pro:400', array(), CHILD_THEME_VERSION );
		wp_enqueue_style( 'bg-google-fonts-styles', get_stylesheet_directory_uri() . '/css/google-fonts.css' );

	}

}

//* Add newsletter signup after entry
add_action( 'genesis_entry_content', 'bg_newsletter_signup', 10 );
function bg_newsletter_signup() {

	genesis_widget_area( 'newsletter-signup', array(
		'before' => '<div class="newsletter-signup">',
		'after'  => '</div>',
	) );
}

//* Customize comment header in entry comments
add_filter( 'genesis_show_comment_date', 'bg_comments_remove_time' );
function bg_comments_remove_time( $comment_date ) {

	printf('<p %s><time %s><span class="line">—</span><a href="%s" %s>%s</a> </time></p>',
		genesis_attr( 'comment-meta' ),
		genesis_attr( 'comment-time' ),
		esc_url( get_comment_link( get_comment_ID() ) ),
		genesis_attr( 'comment-time-link' ),
		esc_html( get_comment_date() )
	);

	return false;

}

//* Run the Genesis loop
genesis();
