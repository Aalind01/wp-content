<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Business
 */

$elite_business_enable_wwd = elite_business_gtm( 'elite_business_wwd_visibility' );

if ( ! elite_business_display_section( $elite_business_enable_wwd ) ) {
	return;
}

$elite_business_top_subtitle = elite_business_gtm( 'elite_business_wwd_section_top_subtitle' );
$elite_business_title        = elite_business_gtm( 'elite_business_wwd_section_title' );
$elite_business_subtitle     = elite_business_gtm( 'elite_business_wwd_section_subtitle' );
?>

<div id="wwd-section" class="section  wwd-section style-one">
	<div class="section-wwd wwd-layout-1">
		<div class="container">
			<?php if ( $elite_business_top_subtitle || $elite_business_title || $elite_business_subtitle ) : ?>
			<div class="section-title-wrap">
				<?php if ( $elite_business_top_subtitle ) : ?>
				<p class="section-top-subtitle"><?php echo esc_html( $elite_business_top_subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $elite_business_title ) : ?>
				<h2 class="section-title"><?php echo esc_html( $elite_business_title ); ?></h2>
				<?php endif; ?>

				<span class="divider"></span>
				<?php if ( $elite_business_subtitle ) : ?>
				<p class="section-subtitle"><?php echo esc_html( $elite_business_subtitle ); ?></p>
				<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/wwd/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
