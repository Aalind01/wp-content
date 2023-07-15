<?php
/*
 * Disallow direct access
 */
if( !defined( 'ABSPATH' ) ) {
    die( 'Forbidden.' );
}


/**
 * Global constants for companion plugin
 */
define( 'LEMMONY_CHILD_THEME', true );
define( 'LEMMONY_CHILD_THEME_VERSION', '1.0.2' );
define( 'LEMMONY_CHILD_THEME_NAME', 'Agency' );


/**
 * Theme setup
 */
if( !function_exists( 'lemmony_agency_setup' ) ) :
    function lemmony_agency_setup() {
        /* Register block categories */
        register_block_pattern_category(
            'lemmony-agency-patterns',
            [ 
                'label' => __( 'Lemmony Agency Patterns', 'lemmony-agency' )
            ]
        );
    }
    add_action( 'init', 'lemmony_agency_setup' );
endif;

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 11 );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri() );
}