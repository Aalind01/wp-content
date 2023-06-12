<?php
/**
 * Header two Style Template
 *
 * @package Elite Business
 */
$elite_business_header_top_text = elite_business_gtm( 'elite_business_header_top_text' );
$elite_business_phone      = elite_business_gtm( 'elite_business_header_phone' );
$elite_business_email      = elite_business_gtm( 'elite_business_header_email' );
$elite_business_address    = elite_business_gtm( 'elite_business_header_address' );
$elite_business_open_hours = elite_business_gtm( 'elite_business_header_open_hours' );

$elite_business_button_text   = elite_business_gtm( 'elite_business_header_button_text' );
$elite_business_button_link   = elite_business_gtm( 'elite_business_header_button_link' );
$elite_business_button_target = elite_business_gtm( 'elite_business_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper<?php echo ! $elite_business_button_text ? ' button-disabled' : ''; ?>">
	<?php if ( $elite_business_phone || $elite_business_email || $elite_business_address || $elite_business_open_hours || has_nav_menu( 'social' ) ) : ?>
	<div id="top-header" class="main-top-header-two dark-top-header">
		<div class="site-top-header-mobile">
			<div class="container">
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i><span class="menu-label"> <?php esc_html_e( 'Top Bar', 'elite-business-dark' ); ?></span>
				</button><!-- #header-top-toggle -->
				<?php if ( $elite_business_header_top_text ) : ?>
				<div id="quick-info" class="text-aligncenter">
                	<p><?php echo esc_html( $elite_business_header_top_text ); ?></p>
				</div>
				<?php endif; ?>
				<div id="site-top-header-mobile-container">
					<?php if ( $elite_business_phone || $elite_business_email || $elite_business_address || $elite_business_open_hours ) : ?>
						<div id="quick-contact">
							<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
						</div>
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ): ?>
						<div id="top-social">
							<div class="social-nav no-border circle-icon">
								<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'elite-business-dark' ); ?>">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'social',
											'menu_class'     => 'social-links-menu',
											'depth'          => 1,
											'link_before'    => '<span class="screen-reader-text">',
										) );
									?>
								</nav><!-- .social-navigation -->
							</div>
						</div><!-- #top-social -->
					<?php endif; ?>
				</div><!-- #site-top-header-mobile-container-->

			</div><!-- .container -->
		</div><!-- .site-top-header-mobile -->

		<div class="site-top-header">
			<div class="container">
				<?php if ( $elite_business_header_top_text ) : ?>
				<div id="quick-info" class="mobile-off pull-left">
                	<p><?php echo esc_html( $elite_business_header_top_text ); ?></p>
				</div>
				<?php endif; ?>
				<?php if ( $elite_business_phone || $elite_business_email || $elite_business_address || $elite_business_open_hours ) : ?>
				<div id="quick-contact" class="pull-left">
					<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
				</div>
				<?php endif; ?>

				<div class="top-head-right pull-right">
					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social" class="pull-left">
						<div class="social-nav no-border brand-bg">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'elite-business-dark' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
								?>
							</nav><!-- .social-navigation -->
						</div>
					</div><!-- #top-social -->
					<?php endif; ?>
				</div>
			</div><!-- .container -->
		</div><!-- .site-top-header -->
	</div><!-- #top-header -->
	<?php endif; ?>

	<header id="masthead" class="site-header main-header-two clear-fix<?php echo elite_business_gtm( 'elite_business_header_sticky' ) ? ' sticky-enabled' : ''; ?>">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding pull-left">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->


				<div class="right-head pull-right">
					<div id="main-nav" class="pull-left">
						<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
					</div><!-- .main-nav -->
					<div class="right-search-cart-button pull-right">
					<div class="head-search-cart-wrap pull-left">
						<div class="header-search pull-right">
							<?php get_template_part( 'template-parts/header/header-search' ); ?>
						</div><!-- .header-search -->
					</div><!-- .head-search-cart-wrap -->
					<?php if ( function_exists( 'elite_business_woocommerce_header_cart' ) ) : ?>
					<div class="cart-contents pull-left">
						<?php elite_business_woocommerce_header_cart(); ?>
					</div>
					<?php endif; ?>
					<?php if ( $elite_business_button_text ) : ?>
					<a target="<?php echo esc_attr( $elite_business_button_target );?>" href="<?php echo esc_url( $elite_business_button_link );?>" class="ff-button header-button pull-right"><?php echo esc_html( $elite_business_button_text );?></a>
					<?php endif; ?>
				</div>
				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->
</div><!-- .header-wrapper -->
