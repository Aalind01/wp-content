<?php
/**
 * WWD Options
 *
 * @package Elite_Business
 */

class Elite_Business_WWD_Options {
	public function __construct() {
		// Register WWD Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'elite_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_business_wwd_visibility'   => 'disabled',
			'elite_business_wwd_number'       => 6,
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
				'settings'          => 'elite_business_wwd_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'elite-business' ),
				'section'           => 'elite_business_ss_wwd',
				'choices'           => Elite_Business_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'elite_business_wwd_visibility', array(
			'selector' => '#wwd-section',
		) );

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'settings'          => 'elite_business_wwd_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'elite-business' ),
				'section'           => 'elite_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_wwd_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'elite-business' ),
				'section'           => 'elite_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_wwd_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'elite-business' ),
				'section'           => 'elite_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_wwd_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'elite-business' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'elite-business' ),
				'section'           => 'elite_business_ss_wwd',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Business_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'elite_business_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'elite-business' ),
				/* translators: 1: Link Start html, 2: Link end html. */
				'description'       =>  sprintf( esc_html__( 'If you want camera icon, save "fas fa-camera". For more classes, check %1$sthis%2$s', 'elite-business' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ),
				'section'           => 'elite_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		$numbers = elite_business_gtm( 'elite_business_wwd_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Elite_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Business_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'elite_business_text_sanitization',
					'settings'          => 'elite_business_wwd_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'elite-business' )  . $j,
					'section'           => 'elite_business_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Elite_Business_Customizer_Utilities::register_option(
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'elite_business_wwd_custom_icon_' . $i,
					'label'             => esc_html__( 'Icon Class', 'elite-business' ),
					'section'           => 'elite_business_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Elite_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'elite_business_wwd_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'elite-business' ),
					'section'           => 'elite_business_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
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
	 * WWD visibility active callback.
	 */
	public function is_wwd_visible( $control ) {
		return ( elite_business_display_section( $control->manager->get_setting( 'elite_business_wwd_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$elite_business_ss_wwd = new Elite_Business_WWD_Options();
