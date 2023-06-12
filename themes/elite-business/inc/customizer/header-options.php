<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Elite_Business
 */

class Elite_Business_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'elite_business_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'elite-business' ),
				'panel' => 'elite_business_theme_options'
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_business_header_top_text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Text', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_business_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_business_header_phone',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Phone', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_business_header_address',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Address', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_business_header_open_hours',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_business_header_button_text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'elite_business_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Business_Toggle_Switch_Custom_control',
				'settings'          => 'elite_business_header_button_target',
				'sanitize_callback' => 'elite_business_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'elite-business' ),
				'section'           => 'elite_business_header_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$elite_business_theme_options = new Elite_Business_Header_Options();
