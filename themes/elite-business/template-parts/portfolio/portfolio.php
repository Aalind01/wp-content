<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Business
 */

$elite_business_visibility = elite_business_gtm( 'elite_business_portfolio_visibility' );

if ( ! elite_business_display_section( $elite_business_visibility ) ) {
	return;
}

?>
<div id="portfolio-section" class="section-portfolio section page style-two">
	<div class="container">
		<?php elite_business_section_title( 'portfolio' ); ?>

		<?php get_template_part( 'template-parts/portfolio/post-type' ); ?>
	</div>
</div><!-- .section -->
