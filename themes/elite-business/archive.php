<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Business
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="archive-posts-wrapper section-content-wrapper">

				<div id="infinite-post-wrap" class="archive-post-wrap">
					<?php if ( have_posts() ) : ?>

						<?php
						$elite_business_enable = elite_business_gtm( 'elite_business_header_image_visibility' );

						if ( ! elite_business_display_section( $elite_business_enable ) ) : ?>
						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->
						<?php endif; ?>
						<div id="infinite-grid" class="infinite-grid">
							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content/content', get_post_type() );

							endwhile;

							the_posts_navigation();
							?>
						</div>
					<?php
					else :

						get_template_part( 'template-parts/content/content', 'none' );

					endif;
					?>
				</div><!-- .archive-post-wrap -->	
			</div><!-- .archive-posts-wrapper -->	

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
