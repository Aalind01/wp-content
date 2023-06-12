<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Business
 */

$elite_business_args = elite_business_get_section_args( 'testimonial' );
$elite_business_loop = new WP_Query( $elite_business_args );

if ( $elite_business_loop->have_posts() ) :

	$elite_business_carousel = elite_business_gtm( 'elite_business_testimonial_enable_slider' );
	?>
	<div class="testimonial-content-wrapper swiper-carousel-enabled">
		<div class="swiper-wrapper">
		<?php

		while ( $elite_business_loop->have_posts() ) :
			$elite_business_loop->the_post();
			?>
			<div class="testimonial-item swiper-slide">
				<div class="testimonial-wrapper clear-fix">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="testimonial-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'elite-business-portfolio', array( 'class' => 'pull-left' ) ); ?>
						</a>
					</div>
					<?php endif; ?>
					<div class="testimonial-summary pull-right">
						<div class="clinet-info">
							<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>
						</div>
						<!-- .clinet-info -->

						<?php elite_business_display_content( 'testimonial' ); ?>
					</div>
				</div><!-- .testimonial-wrapper -->
			</div><!-- .testimonial-item -->
		<?php
		endwhile;
		?>
		</div><!-- .swiper-wrapper -->

		<div class="swiper-pagination"></div>
	</div><!-- .testimonial-content-wrapper -->
<?php
endif;

wp_reset_postdata();
