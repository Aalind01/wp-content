<?php
/**
 * Testimonial Options
 *
 * @package Elite_Business
 */

class Elite_Business_Testimonial_Options {
	public function __construct() {
		// Register Testimonial Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'elite_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_business_testimonial_visibility' => 'disabled',
			'elite_business_testimonial_number'     => 4,
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
				'settings'          => 'elite_business_testimonial_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'elite-business' ),
				'section'           => 'elite_business_ss_testimonial',
				'choices'           => Elite_Business_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'elite_business_testimonial_visibility', array(
			'selector' => '#testimonial-section',
		) );

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'settings'          => 'elite_business_testimonial_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'elite-business' ),
				'section'           => 'elite_business_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_testimonial_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'elite-business' ),
				'section'           => 'elite_business_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_testimonial_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'elite-business' ),
				'section'           => 'elite_business_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);


		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_testimonial_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'elite-business' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'elite-business' ),
				'section'           => 'elite_business_ss_testimonial',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		$numbers = elite_business_gtm( 'elite_business_testimonial_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Elite_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'elite_business_testimonial_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'elite-business' ),
					'section'           => 'elite_business_ss_testimonial',
					'active_callback'   => array( $this, 'is_testimonial_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}
	}

	/**
	 * Testimonial visibility active callback.
	 */
	public function is_testimonial_visible( $control ) {
		return ( elite_business_display_section( $control->manager->get_setting( 'elite_business_testimonial_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$elite_business_ss_testimonial = new Elite_Business_Testimonial_Options();
