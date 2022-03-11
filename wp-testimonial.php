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
	<div class="wpt-testimonial">
		<p style="font-weight: bold;"><?php echo $attributes['client']; ?></p>
		<p><?php echo $attributes['testimonial']; ?></p>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function wpt_testimonial_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'wpt_testimonial_block_init' );
