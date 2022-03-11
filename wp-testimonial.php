<?php
/**
 * Plugin Name:     WP Testimonial
 * Description:     Using a shortcode, render a testimonial anywhere on your site
 * Version:         1.0.0
 * Text Domain:     wp-testimonial
 * License:         GPLv2 or later
 *
 * @package         WP_Testimonial
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_shortcode( 'wp-testimonial', 'wpt_testimonial_shortcode' );
function wpt_testimonial_shortcode( $attributes ) {
	ob_start();
	?>
	<div class="wpt-testimonial">
		<p style="font-weight: bold;"><?php echo $attributes['client']; ?></p>
		<p><?php echo $attributes['testimonial']; ?></p>
	</div>
	<?php
	return ob_get_clean();
}
