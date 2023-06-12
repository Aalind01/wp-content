<?php

/**
 * Main Class for customizer
 */
class Elite_Business_Dark_Customizer {
	public function __construct() {
		// Register Custozier Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 100 );

		// Add default options.
		add_filter( 'elite_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_business_wwd_style'              => 'style-three',
			'elite_business_portfolio_style'        => 'style-three',
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 * Other basic stuff for customizer initialization.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register_options( $wp_customize ) {
		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_wwd_style',
				'type'              => 'select',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Style', 'elite-business-dark' ),
				'section'           => 'elite_business_ss_wwd',
				'choices'           => array(
					'style-one' => esc_html__( 'Style One', 'elite-business-dark' ),
					'style-two' => esc_html__( 'Style Two', 'elite-business-dark' ),
				),
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_portfolio_style',
				'type'              => 'select',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Style', 'elite-business-dark' ),
				'section'           => 'elite_business_ss_portfolio',
				'choices'           => array(
					'style-one' => esc_html__( 'Style One', 'elite-business-dark' ),
					'style-three' => esc_html__( 'Style three', 'elite-business-dark' ),
				),
				'active_callback'   => array( $this, 'is_portfolio_visible' ),
			)
		);
	}

	/**
	 * Featured Content visibility active callback.
	 */
	public function is_wwd_visible( $control ) {
		return ( elite_business_display_section( $control->manager->get_setting( 'elite_business_wwd_visibility' )->value() ) );
	}

	/**
	 * Featured Content visibility active callback.
	 */
	public function is_portfolio_visible( $control ) {
		return ( elite_business_display_section( $control->manager->get_setting( 'elite_business_portfolio_visibility' )->value() ) );
	}
}

/**
 * Initialize customizer class.
 */
$elite_business_customizer = new Elite_Business_Dark_Customizer();
