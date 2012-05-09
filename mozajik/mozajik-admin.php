<?php
/**
 * This file registers the admin interface for Mozajik Loader.
 **/

function mozajik_menu() {
	add_options_page( 'Mozajik Loader Settings', 'Mozajik Loader', 'manage_options', 'mozajik-loader-settings', 'mozajik_menu_settings' );
}
add_action('admin_menu', 'mozajik_menu' );
function mozajik_menu_settings() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Mozajik Loader settings</h2>
			Here you can set up the connection to your Mozajik installation.
			<form action="options.php" method="post">
			<?php settings_fields('mozajik_options'); ?>
			<?php do_settings_sections(__FILE__); ?>
			<p class="submit">
				<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
			</p>
			</form>
		</div>
	<?php
}
function mozajik_setting_section_callback_function() {
	//echo '<p>Basic settings for Mozajik.</p>';
}

/**
 * Register my options
 **/
function mozajik_options_init(){
	register_setting('mozajik_options', 'mozajik_options', 'mozajik_mozajik_options_validate' );
	add_settings_section('main_section', 'Basic Settings', 'mozajik_setting_section_callback_function', __FILE__);
	add_settings_field('install_path', 'Installation path', 'mozajik_setting_install_path', __FILE__, 'main_section');
	add_settings_field('base_url', 'Base URL', 'mozajik_setting_base_url', __FILE__, 'main_section');
	add_settings_field('init_controller', 'Init controller', 'mozajik_setting_init_controller', __FILE__, 'main_section');
}
add_action('admin_init', 'mozajik_options_init' );

/**
 * My option fields.
 **/
function mozajik_setting_install_path() {
	$options = get_option('mozajik_options');
	echo "<input id='plugin_text_string' name='mozajik_options[install_path]' size='40' type='text' value='{$options['install_path']}' />";
}
function mozajik_setting_base_url() {
	$options = get_option('mozajik_options');
	echo "<input id='plugin_text_string' name='mozajik_options[base_url]' size='40' type='text' value='{$options['base_url']}' />";
}
function mozajik_setting_init_controller() {
	$options = get_option('mozajik_options');
	echo "<input id='plugin_text_string' name='mozajik_options[init_controller]' size='40' type='text' value='{$options['init_controller']}' />";
}

/**
 * My options validation.
 **/
function mozajik_mozajik_options_validate($input) {
	// Validate options here
		// Do something here!
	// Return validated input
	return $input;
}

?>