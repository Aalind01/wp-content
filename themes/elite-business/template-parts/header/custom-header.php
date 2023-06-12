<?php
/**
 * Displays header site branding
 *
 * @package Elite_Business
 */

// Check metabox option.
$meta_option = get_post_meta( get_the_ID(), 'elite-business-header-image', true );

if ( empty( $meta_option ) ) {
	$meta_option = 'default';
}

// Bail if header image is removed via metabox option.
if ( 'disable' === $meta_option ) {
	return;
}

$elite_business_enable = elite_business_gtm( 'elite_business_header_image_visibility' );

if ( elite_business_display_section( $elite_business_enable ) ) : ?>
<div id="custom-header">
	<?php is_header_video_active() && has_header_video() ? the_custom_header_markup() : ''; ?>

	<div class="custom-header-content">
		<div class="container">
			<?php elite_business_header_title(); ?>
		</div> <!-- .container -->
	</div>  <!-- .custom-header-content -->
</div>
<?php
endif;
