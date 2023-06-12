<?php
/**
 * Hero Content Options
 *
 * @package Elite_Business
 */

class Elite_Business_Hero_Content_Options {
	public function __construct() {
		// Register Hero Content Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'elite_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_business_hero_content_visibility' => 'disabled',
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_hero_content_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'elite-business' ),
				'section'           => 'elite_business_ss_hero_content',
				'choices'           => Elite_Business_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'elite_business_hero_content_visibility', array(
			'selector' => '#hero-content-section',
		) );

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Business_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'elite_business_hero_content_page',
				'label'             => esc_html__( 'Select Page', 'elite-business' ),
				'section'           => 'elite_business_ss_hero_content',
				'active_callback'   => array( $this, 'is_hero_content_visible' ),
				'input_attrs' => array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'orderby'        => 'name',
					'order'          => 'ASC',
				),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'settings'          => 'elite_business_hero_content_custom_subtitle',
				'label'             => esc_html__( 'Top Subtitle', 'elite-business' ),
				'section'           => 'elite_business_ss_hero_content',
				'active_callback'   => array( $this, 'is_hero_content_visible' ),
			)
		);
	}

	/**
	 * Hero Content visibility active callback.
	 */
	public function is_hero_content_visible( $control ) {
		return ( elite_business_display_section( $control->manager->get_setting( 'elite_business_hero_content_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$elite_business_ss_hero_content = new Elite_Business_Hero_Content_Options();
