<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Elite_Business
 */

$elite_business_enable = elite_business_gtm( 'elite_business_hero_content_visibility' );

if ( ! elite_business_display_section( $elite_business_enable ) ) {
	return;
}

get_template_part( 'template-parts/hero-content/content-hero' );
