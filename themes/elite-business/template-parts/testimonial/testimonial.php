<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Business
 */

$elite_business_visibility = elite_business_gtm( 'elite_business_testimonial_visibility' );

if ( ! elite_business_display_section( $elite_business_visibility ) ) {
	return;
}

$image = elite_business_gtm( 'elite_business_testimonial_bg_image' );
?>
<div id="testimonial-section" class="testimonial-section section carousel-enabled" <?php echo $image ? 'style="background-image: url( ' .esc_url( $image ) . ' )"' : ''; ?>>
	<div class="section-testimonial testimonial-layout-1">
		<div class="container">
			<?php elite_business_section_title( 'testimonial' ); ?>
	         <div class="section-carousel-wrapper">
				<div class="next-prev-wrap">
			   		<div class="swiper-button-prev"></div>
				    <div class="swiper-button-next"></div>
				</div>
				<?php get_template_part( 'template-parts/testimonial/post-type' ); ?>
			</div><!-- .section-carousel-wrapper -->
		</div><!-- .container -->
	</div><!-- .section-testimonial  -->
</div><!-- .section -->
