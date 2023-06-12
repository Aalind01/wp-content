<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Business
 */

$elite_business_visibility = elite_business_gtm( 'elite_business_featured_content_visibility' );

if ( ! elite_business_display_section( $elite_business_visibility ) ) {
	return;
}

?>
<div id="featured-content-section" class="featured-content-section section style-one page">
	<div class="section-latest-posts">
		<div class="container">
			<?php elite_business_section_title( 'featured_content' ); ?>

		    <?php get_template_part( 'template-parts/featured-content/post-type' ); ?>

			<?php
			$elite_business_button_text   = elite_business_gtm( 'elite_business_featured_content_button_text' );
			$elite_business_button_link   = elite_business_gtm( 'elite_business_featured_content_button_link' );
			$elite_business_button_target = elite_business_gtm( 'elite_business_featured_content_button_target' ) ? '_blank' : '_self';

			if ( $elite_business_button_text ) : ?>
				<div class="more-wrapper clear-fix">
					<a href="<?php echo esc_url( $elite_business_button_link ); ?>" class="ff-button" target="<?php echo esc_attr( $elite_business_button_target ); ?>"><?php echo esc_html( $elite_business_button_text ); ?></a>
				</div><!-- .more-wrapper -->
			<?php endif; ?>
		</div><!-- .container -->
	</div><!-- .latest-posts-section -->
</div><!-- .section-latest-posts -->

