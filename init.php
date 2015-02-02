<?php
/*
Plugin Name: YITH WooCommerce Advanced Reviews
Plugin URI: http://yithemes.com/themes/plugins/yith-woocommerce-advanced-reviews/
Description: With this extension you will allow the user to write a review in an innovative and efficient way, giving the right space to whoever is satisfied by a purchase on your shop.
Author: Yithemes
Text Domain: ywar
Version: 1.0.4
Author URI: http://yithemes.com/
*/

//region    ****    Check if prerequisites are satisfied before enabling and using current plugin

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! function_exists( 'WC' ) ) {
	function yith_ywar_install_woocommerce_admin_notice() {
		?>
		<div class="error">
			<p><?php _e( 'YITH WooCommerce Advanced Reviews is enabled but not effective. It requires Woocommerce in order to work.', 'ywar' ); ?></p>
		</div>
	<?php
	}

	add_action( 'admin_notices', 'yith_ywar_install_woocommerce_admin_notice' );

	return;
}

if ( defined( 'YITH_YWAR_PREMIUM' ) ) {
	function yith_ywar_install_free_admin_notice() {
		?>
		<div class="error">
			<p><?php _e( 'You can\'t activate the free version of YITH WooCommerce Advanced Reviews while you are using the premium one.', 'ywar' ); ?></p>
		</div>
	<?php
	}

	add_action( 'admin_notices', 'yith_ywar_install_free_admin_notice' );

	deactivate_plugins( plugin_basename( __FILE__ ) );

	return;
}

//  Stop activation if the premium version of the same plugin is still active
if ( defined( 'YITH_YWAR_VERSION' ) ) {
	return;
}
//endregion

//region    ****    Define constants
if ( ! defined( 'YITH_YWAR_FREE_INIT' ) ) {
	define( 'YITH_YWAR_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_YWAR_VERSION' ) ) {
	define( 'YITH_YWAR_VERSION', '1.0.4' );
}

if ( ! defined( 'YITH_YWAR_FILE' ) ) {
	define( 'YITH_YWAR_FILE', __FILE__ );
}

if ( ! defined( 'YITH_YWAR_DIR' ) ) {
	define( 'YITH_YWAR_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YITH_YWAR_URL' ) ) {
	define( 'YITH_YWAR_URL', plugins_url( '/', __FILE__ ) );
}

if ( ! defined( 'YITH_YWAR_ASSETS_URL' ) ) {
	define( 'YITH_YWAR_ASSETS_URL', YITH_YWAR_URL . 'assets' );
}

if ( ! defined( 'YITH_YWAR_TEMPLATE_PATH' ) ) {
	define( 'YITH_YWAR_TEMPLATE_PATH', YITH_YWAR_DIR . 'templates' );
}

if ( ! defined( 'YITH_YWAR_ASSETS_IMAGES_URL' ) ) {
	define( 'YITH_YWAR_ASSETS_IMAGES_URL', YITH_YWAR_ASSETS_URL . '/images/' );
}
//endregion

/**
 * Load text domain and start plugin
 */
load_plugin_textdomain( 'ywar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * Init default plugin settings
 */
if ( !function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

require_once( YITH_YWAR_DIR . 'class.yith-woocommerce-advanced-reviews.php' );

global $YWAR_AdvancedReview;
$YWAR_AdvancedReview = new YITH_WooCommerce_Advanced_Reviews();