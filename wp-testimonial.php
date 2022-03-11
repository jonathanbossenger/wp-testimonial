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

/**
 * Registers a wp-testimonial shortcode
 *
 * Attributes
 * client
 * testimonial
 *
 * @return string
 *
 */
add_shortcode( 'wp-testimonial', 'wpt_testimonial_shortcode' );
function wpt_testimonial_shortcode( $attributes ) {
	ob_start();
	?>
		<p style="font-weight: bold;"><?php echo $attributes['client'];?></p>
		<p><?php echo $attributes['testimonial'];?></p>
	<?php
	return ob_get_clean();
}


