<?php
/**
 * Elite Business Theme Customizer
 *
 * @package Elite_Business
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elite_business_sortable_sections( $wp_customize ) {
	$wp_customize->add_panel( 'elite_business_sp_sortable', array(
		'title'       => esc_html__( 'Sections', 'elite-business' ),
		'priority'    => 150,
	) );

	$sortable_sections = array (
        'slider'               => esc_html__( 'Slider', 'elite-business' ),
        'wwd'                  => esc_html__( 'What We Do', 'elite-business' ),
        'hero_content'         => esc_html__( 'Hero Content', 'elite-business' ),
        'featured_product'     => esc_html__( 'Featured Product', 'elite-business' ),
        'portfolio'            => esc_html__( 'Portfolio', 'elite-business' ),
        'testimonial'          => esc_html__( 'Testimonials', 'elite-business' ),
        'featured_content'     => esc_html__( 'Featured Content', 'elite-business' ),
    );

	foreach ( $sortable_sections as $key => $value ) {
			// Add sections.
			$wp_customize->add_section( 'elite_business_ss_' . $key,
				array(
					'title' => $value,
					'panel' => 'elite_business_sp_sortable'
				)
			);
		
	}
}
add_action( 'customize_register', 'elite_business_sortable_sections', 1 );
