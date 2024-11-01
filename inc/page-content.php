<?php 
/**
 * Template used for the taxonomies essentials page settings.
 */
?>
<div class="tx_valid_main">
	<h1 id="settings_tx_valid_title"><?php esc_html_e('WP Required Taxonomies'); ?></h1>
	<form action="options.php" method="post">
		<?php
		// output security fields for the registered setting "wporg"
		settings_fields( 'tx_valid_setting_group' );
		do_settings_sections( 'tx_valid_setting_group' );
		submit_button( 'Save Settings' );
		?>
	</form>
</div>
