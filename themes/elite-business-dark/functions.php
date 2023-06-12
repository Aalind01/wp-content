<?php
/**
 * Child Theme functions and definitions.
 * This theme is a child theme for Elite Business.
 *
 * @package Elite_Business_Dark
 * @author  FireflyThemes https://fireflythemes.com
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

/**
 * Theme functions and definitions.
 */
function elite_business_agency_enqueue_styles() {
	// Parent Theme stylesheet.
	wp_enqueue_style( 'elite-business-style', get_template_directory_uri() . '/style.css', null, elite_business_agency_get_file_mod_date( get_template_directory() . '/style.css' ) );

	wp_enqueue_style( 'elite-business-dark-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'elite-business-style' ),
        elite_business_agency_get_file_mod_date( get_stylesheet_directory() . '/style.css' )
    );
}
add_action(  'wp_enqueue_scripts', 'elite_business_agency_enqueue_styles' );

/**
 * Get file modified date
 */
function elite_business_agency_get_file_mod_date( $file ) {
	return date( 'Ymd-Gis', filemtime( $file ) );
}

/**
 * Loads the child theme textdomain.
 */
function elite_business_agency_setup() {
    load_child_theme_textdomain( 'elite-business-dark', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'elite_business_agency_setup', 11 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elite_business_agency_widgets_init() {
	register_sidebar( array(
			'name'        => esc_html__( 'Footer 4', 'elite-business-dark' ),
			'id'          => 'sidebar-5',
			'description' => esc_html__( 'Add widgets here to appear in your footer.', 'elite-business-dark' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'elite_business_agency_widgets_init', 100 );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since 1.0
 */
function elite_business_agency_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-5' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // WPCS: XSS OK.
	}
}

/**
 * Load Social Menu Widget
 */
require get_theme_file_path( '/inc/social-menu.php' );

/**
 * Load Customizer Options
 */
require get_theme_file_path( '/inc/customizer.php' );
