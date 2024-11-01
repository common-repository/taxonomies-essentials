<?php
/**
 * Assets class.
 *
 * @package wp-menu-custom-fields
 */

namespace Taxonomies_Essentials\Inc;

use Taxonomies_Essentials\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Assets {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * To setup action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Action
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

	}


	/**
	 * To enqueue scripts and styles. in admin.
	 *
	 * @param string $hook_suffix Admin page name.
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts( $hook_suffix ) {

		global $pagenow;
		if ( (isset( $_GET['page'] ) && $_GET['page'] == 'taxonomies-essentials') || 
			( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && (get_post_type() != 'page')) ) {

			// Style CSS

			$file_path = TX_VALID_PATH . '/assets/css/jquery-ui.min.css';
			$time      = time();
			if ( file_exists( $file_path ) ) {
				$time = filemtime( $file_path );
			}
			wp_enqueue_style( 'jquery-ui-tx-valid-essentials', TX_VALID_URL . '/assets/css/jquery-ui.min.css', array(), $time );
			
			$file_path = TX_VALID_PATH . '/assets/css/admin.css';
			$time      = time();
			if ( file_exists( $file_path ) ) {
				$time = filemtime( $file_path );
			}

			wp_enqueue_style( 'tx-valid-essentials-admin-style', TX_VALID_URL . '/assets/css/admin.css', array(), $time );
			wp_enqueue_style( 'dashicons' );

			

			// JS script

			$file_path = TX_VALID_PATH . '/assets/js/admin.js';
			$time      = time();
			if ( file_exists( $file_path ) ) {
				$time = filemtime( $file_path );
			}

			wp_enqueue_script('jquery-ui-tabs',array( 'jquery' ), TX_VALID_VERSION, false);
			wp_enqueue_script('jquery-ui-accordion',array( 'jquery' ), TX_VALID_VERSION, false);
			wp_enqueue_script( 'tx-valid-essentials-admin', TX_VALID_URL . '/assets/js/admin.js', array('jquery'), $time, true );
			$tx_valid_options = get_option( 'tx_valid_options', [] );

			// taxonomy name in options array we will add if rest_base slug is different.
			foreach ($tx_valid_options as $key => $data) {
				if( !is_array($data) )
					continue;
				foreach ($data as $ptype => $taxonomies) {
					foreach ($taxonomies as $taxonomy => $terms) { 
						foreach ($terms as $k => $id) {
							$term = get_term( $id , $taxonomy );
							if( isset($term->name) )
							$tx_valid_options[$id] = $term->name;
						}
					}
					$taxonomies = get_object_taxonomies($ptype, 'objects');
					foreach ($taxonomies as $taxonomy => $t_obj) {
						if( $t_obj->rest_base ) {
							$tx_valid_options[$taxonomy] = $t_obj->rest_base;
						}
						$tx_valid_options[$taxonomy.'-label'] = $t_obj->label;
					}
				}
			}
			$tx_valid_options['ptype'] = get_post_type();
			wp_localize_script( 'tx-valid-essentials-admin', 'tx_valid_options', $tx_valid_options );

		}
	}

}
