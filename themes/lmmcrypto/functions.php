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
define( 'LEMMONY_CHILD_THEME_NAME', 'lmm-crypto' );


/**
 * Theme setup
 */
if( !function_exists( 'lmm_crypto_setup' ) ) :
    function lmm_crypto_setup() {
        /* Register block categories */
        register_block_pattern_category(
            'lmm-crypto-patterns',
            [ 
                'label' => __( 'LMM Crypto Patterns', 'lmm-crypto' )
            ]
        );
    }
    add_action( 'init', 'lmm_crypto_setup' );
endif;