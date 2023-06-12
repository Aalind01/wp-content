<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Elite_Business
 */

$page_id = elite_business_gtm( 'elite_business_hero_content_page' );

// If $elite_business_args is empty return false
if ( ! $page_id ) {
	return;
}

$elite_business_args = array(
	'page_id' => absint( $page_id ),
);

$elite_business_args['posts_per_page'] = 1;

$elite_business_loop = new WP_Query( $elite_business_args );

while ( $elite_business_loop->have_posts() ) :
	$elite_business_loop->the_post();
	?>

	<div id="hero-content-section" class="hero-content-section section content-position-right default">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="ff-grid-6 featured-page-thumb">
						<?php the_post_thumbnail( 'elite-business-hero', array( 'class' => 'alignnone' ) );?>
					</div>
					<?php endif; ?>

					<!-- .ff-grid-6 -->
					<div class="ff-grid-6 featured-page-content">
						<div class="featured-page-section">
							<div class="section-title-wrap">
								<?php 
								$elite_business_subtitle = elite_business_gtm( 'elite_business_hero_content_custom_subtitle' );
								
								if ( $elite_business_subtitle ) : ?>
								<p class="section-top-subtitle"><?php echo esc_html( $elite_business_subtitle ); ?></p>
								<?php endif; ?>

								<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

								<span class="divider"></span>
							</div>

							<?php elite_business_display_content( 'hero_content' ); ?>
						</div><!-- .featured-page-section -->
					</div><!-- .ff-grid-6 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
