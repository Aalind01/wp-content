<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Business
 */

$elite_business_enable_slider = elite_business_gtm( 'elite_business_slider_visibility' );

if ( ! elite_business_display_section( $elite_business_enable_slider ) ) {
	return;
}

?>
<div id="slider-section" class="section zoom-disabled overlay-enabled no-padding style-one">
	<div class="swiper-wrapper">
		<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
	</div><!-- .swiper-wrapper -->

	<div class="swiper-pagination"></div>

	<div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div><!-- .main-slider -->
