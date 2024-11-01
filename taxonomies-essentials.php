<?php
/**
 * Plugin Name: WP Required Taxonomies – Categories and Tags Mandatory | Default Selected
 * Description: Before saving any post, taxonomies are required or by default selected when editing a post.
 * Plugin URI:        https://wordpress.org/plugins/taxonomies-essentials/
 * Author:            chiragrathod103
 * Author URI:        https://profiles.wordpress.org/chiragrathod103/
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Version:           1.2
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Text Domain:       taxonomies-essentials
 *
 * @package taxonomies-essentials
 */

define( 'TX_VALID_VERSION', '1.2' );
define( 'TX_VALID_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'TX_VALID_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

require_once TX_VALID_PATH . '/inc/helpers/autoloader.php';

/**
 * To load plugin manifest class.
 *
 * @return void
 */
function taxonomies_essentials_plugin_loader() {
	\Taxonomies_Essentials\Inc\Plugin::get_instance();
}
taxonomies_essentials_plugin_loader();

/**
 * Redirects to the plugin settings page after activation.
 *
 * @return void
 */
function taxonomies_essentials_activate_redirect() {
    // Redirect to the plugin settings page
    if (get_transient('taxonomies_essentials_activate_redirect')) {
        delete_transient('taxonomies_essentials_activate_redirect');
        wp_redirect(admin_url('tools.php?page=taxonomies-essentials'));
        exit;
    }
}
register_activation_hook(__FILE__, function () {
    set_transient('taxonomies_essentials_activate_redirect', true);
});
add_action('admin_init', 'taxonomies_essentials_activate_redirect');