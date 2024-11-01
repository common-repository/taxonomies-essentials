<?php
/**
 * Plugin manifest class.
 *
 * @package wp-menu-custom-fields
 */

namespace Taxonomies_Essentials\Inc;

use \Taxonomies_Essentials\Inc\Traits\Singleton;

/**
 * Class Plugin
 */
class Plugin {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		// Load plugin classes.
		Assets::get_instance();
		Taxonomies_Essentials::get_instance();

	}

}
