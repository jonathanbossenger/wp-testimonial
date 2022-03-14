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

define( 'WPT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

add_action('wp_enqueue_scripts', 'wpt_testimonial_shortcode_scripts');
function wpt_testimonial_shortcode_scripts() {
	wp_register_style('wpt-testimonial-style', WPT_PLUGIN_URL . 'css/style.css', array(), '1.0.0');

}

add_shortcode( 'wp-testimonial', 'wpt_testimonial_shortcode' );
function wpt_testimonial_shortcode( $attributes ) {
	wp_enqueue_style('wpt-testimonial-style');
	ob_start();
	?>
		<div class="wp-testimonial-testimonial">
			<p class="client"><?php echo $attributes['client']; ?></p>
			<p><?php echo $attributes['testimonial']; ?></p>
		</div>
	<?php
	return ob_get_clean();
}
