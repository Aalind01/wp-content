<?php
/**
 * Header Search
 *
 * @package Elite_Business
 */

$elite_business_phone      = elite_business_gtm( 'elite_business_header_phone' );
$elite_business_email      = elite_business_gtm( 'elite_business_header_email' );
$elite_business_address    = elite_business_gtm( 'elite_business_header_address' );
$elite_business_open_hours = elite_business_gtm( 'elite_business_header_open_hours' );

if ( $elite_business_phone || $elite_business_email || $elite_business_address || $elite_business_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $elite_business_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'elite-business' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $elite_business_phone ) ); ?>"><?php echo esc_html( $elite_business_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $elite_business_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'elite-business' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $elite_business_email ) ) ); ?>"><?php echo esc_html( antispambot( $elite_business_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $elite_business_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'elite-business' ); ?></span><?php echo esc_html( $elite_business_address ); ?></li>
			<?php endif; ?>

			<?php if ( $elite_business_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'elite-business' ); ?></span><?php echo esc_html( $elite_business_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

