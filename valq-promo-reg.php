<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://visualbi.com
 * @since             1.0.0
 * @package           Valq_Promo_Reg
 *
 * @wordpress-plugin
 * Plugin Name:       ValQ Promotional Registration
 * Plugin URI:        https://github.com/vbiweb/ValQ-Promo-Reg
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            K Gopal Krishna
 * Author URI:        https://visualbi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       valq-promo-reg
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VALQ_PROMO_REG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-valq-promo-reg-activator.php
 */
function activate_valq_promo_reg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-valq-promo-reg-activator.php';
	Valq_Promo_Reg_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-valq-promo-reg-deactivator.php
 */
function deactivate_valq_promo_reg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-valq-promo-reg-deactivator.php';
	Valq_Promo_Reg_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_valq_promo_reg' );
register_deactivation_hook( __FILE__, 'deactivate_valq_promo_reg' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-valq-promo-reg.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_valq_promo_reg() {

	$plugin = new Valq_Promo_Reg();
	$plugin->run();

}
run_valq_promo_reg();
