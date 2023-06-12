<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Elite_Business
 */

class Elite_Business_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Register Search Options.
		add_action( 'customize_register', array( $this, 'register_search_options' ) );

		// Add default options.
		add_filter( 'elite_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'elite_business_header_image_visibility' => 'entire-site',

			// Breadcrumb
			'elite_business_breadcrumb_show' => 1,

			// Layout Options.
			'elite_business_layout_type'             => 'fluid',
			'elite_business_default_layout'          => 'right-sidebar',
			'elite_business_homepage_archive_layout' => 'no-sidebar-full-width',
			
			// Excerpt Options
			'elite_business_excerpt_length'    => 30,
			'elite_business_excerpt_more_text' => esc_html__( 'Continue reading', 'elite-business' ),

			// Homepage/Frontpage Options.
			'elite_business_front_page_category'   => '',
			
			// Search Options.
			'elite_business_search_text'         => esc_html__( 'Search...', 'elite-business' ),
		);


		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'elite_business_theme_options',
		 	array(
				'title' => esc_html__( 'Theme Options', 'elite-business' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'elite_business_breadcrumb_options',
			array(
				'title' => esc_html__( 'Breadcrumb', 'elite-business' ),
				'panel' => 'elite_business_theme_options',
			)
		);

		if ( function_exists( 'bcn_display' ) ) {
			Elite_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Business_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'elite-business' ),
					'description'       =>  sprintf( esc_html__( 'Since Breadcrumb NavXT Plugin is installed, edit plugin\'s settings %1$shere%2$s', 'elite-business' ), '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=breadcrumb-navxt' ) ) . '" target="_blank">', '</a>' ),
					'section'           => 'ff_multiputpose_breadcrumb_options',
				)
			);

			return;
		}

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Business_Toggle_Switch_Custom_control',
				'settings'          => 'elite_business_breadcrumb_show',
				'sanitize_callback' => 'elite_business_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'elite-business' ),
				'section'           => 'elite_business_breadcrumb_options',
			)
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'elite_business_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'elite-business' ),
				'panel' => 'elite_business_theme_options'
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'elite_business_layout_type',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Site Layout', 'elite-business' ),
				'section'           => 'elite_business_layouts',
				'choices'           => array(
					'fluid' => esc_html__( 'Fluid', 'elite-business' ),
					'boxed' => esc_html__( 'Boxed', 'elite-business' ),
				),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'elite_business_default_layout',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'elite-business' ),
				'section'           => 'elite_business_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'elite-business' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'elite-business' ),
				),
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'elite_business_homepage_archive_layout',
				'sanitize_callback' => 'elite_business_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'elite-business' ),
				'section'           => 'elite_business_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'elite-business' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'elite-business' ),
				),
			)
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'elite_business_excerpt_options',
			array(
				'title' => esc_html__( 'Excerpt Options', 'elite-business' ),
				'panel' => 'elite_business_theme_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'elite_business_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'elite-business' ),
				'section'           => 'elite_business_excerpt_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_business_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'elite-business' ),
				'section'           => 'elite_business_excerpt_options',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		Elite_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Business_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'settings'          => 'elite_business_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'elite-business' ),
				'label'             => esc_html__( 'Categories', 'elite-business' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'elite-business' ) => Elite_Business_Customizer_Utilities::get_terms( 'category' ) ),
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_search_options( $wp_customize ) {
		// Add Homepage/Frontpage Section.
		$wp_customize->add_section( 'elite_business_search',
			array(
				'title' => esc_html__( 'Search', 'elite-business' ),
				'panel' => 'elite_business_theme_options',
			)
		);

		Elite_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_business_search_text',
				'sanitize_callback' => 'elite_business_text_sanitization',
				'label'             => esc_html__( 'Search Text', 'elite-business' ),
				'section'           => 'elite_business_search',
				'type'              => 'text',
			)
		);
	}
}

/**
 * Initialize class
 */
$elite_business_theme_options = new Elite_Business_Theme_Options();
