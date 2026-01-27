<?php
function wm_stylescripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style('wm-style', get_stylesheet_uri(), array(), $theme_version );
	if ( get_theme_mod('wm_mode') != "" ) {
		wp_enqueue_style('wm-mode', get_template_directory_uri().'/'.get_theme_mod('wm_mode') .'/style.css', array(), $theme_version );
	} else {
		wp_enqueue_style('wm-mode', get_template_directory_uri().'/masjid/style.css', array(), $theme_version );
	}
	wp_enqueue_style('wm-owl', get_template_directory_uri().'/wm-css/owl.carousel.min.css', array(), $theme_version );
	wp_enqueue_style('wm-ani', get_template_directory_uri().'/wm-css/owl.animate.css', array(), $theme_version );
	wp_enqueue_style('wm-theme', get_template_directory_uri().'/wm-css/owl.theme.default.min.css', array(), $theme_version );
	wp_enqueue_style('wm-font', get_template_directory_uri().'/wm-css/wm-font.css', array(), $theme_version );
	wp_enqueue_style('wm-icofont', get_template_directory_uri().'/wm-css/icofont.css', array(), $theme_version );
}
add_action('wp_enqueue_scripts', 'wm_stylescripts');

function admin_customizercss() {
	$theme_version = wp_get_theme()->get( 'Version' );
    wp_register_style( 'customizer_css', get_template_directory_uri() . '/wm-css/customizer.css', false, $theme_version );
    wp_enqueue_style( 'customizer_css' );
}
add_action( 'admin_enqueue_scripts', 'admin_customizercss' );

function wm_scripts() {
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'wm-owls', get_template_directory_uri() . '/wm-script/owl.carousel.min.js', array(), false, true );
	wp_enqueue_script( 'wm-ticker', get_template_directory_uri() . '/wm-script/acmeticker.min.js', array(), false, true );
	wp_enqueue_script( 'wm-footer', get_template_directory_uri() . '/wm-script/footer.js', array(), false, true );
	
}
add_action('wp_enqueue_scripts', 'wm_scripts');

/**
 * Enqueue owl carousel initialization script for widgets
 * 
 * Use this function instead of inline <script> tags in widgets.
 * 
 * @param string $widget_id The widget ID to use as selector
 * @param array  $options   Owl carousel options (loop, nav, items, etc.)
 */
function wm_enqueue_carousel_script( $widget_id, $options = array() ) {
	// Default carousel options
	$defaults = array(
		'loop'                 => true,
		'nav'                  => false,
		'dots'                 => false,
		'lazyLoad'             => true,
		'autoplay'             => true,
		'smartSpeed'           => 1000,
		'autoplayTimeout'      => 4000,
		'autoplayHoverPause'   => true,
		'margin'               => 15,
		'items'                => 1,
	);
	
	$options = wp_parse_args( $options, $defaults );
	$options_json = wp_json_encode( $options );
	$safe_id = esc_js( $widget_id );
	
	$script = "jQuery(document).ready(function($) {
		$('." . $safe_id . "').owlCarousel(" . $options_json . ");
	});";
	
	wp_add_inline_script( 'wm-owls', $script );
}
