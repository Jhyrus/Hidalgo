<?php

/**
 * Import setting from json file.
 *
 * @since wpkube 1.2
 */

function wpkube_import_setting(){

	if ( isset($_POST['submit_import']) && isset($_FILES['import'])){
		$getsomething = false;
		if ( ($import =  wp_remote_get($_FILES['import']['tmp_name'] )) !== false ){
			$import = json_decode( $import, true ) ;
			if ( isset($import['background_color'] ) ) { set_theme_mod('background_color', $import['background_color'] ); $getsomething = true; }
			if ( isset($import['background_image'] ) ) { set_theme_mod('background_image', $import['background_image'] ); $getsomething = true; }
			if ( isset($import['background_repeat'] ) ) { set_theme_mod('background_repeat', $import['background_repeat'] ); $getsomething = true; }
			if ( isset($import['background_position_x'] ) ) { set_theme_mod('background_position_x', $import['background_position_x'] ); $getsomething = true; }
			if ( isset($import['background_atachment'] ) ) { set_theme_mod('background_atachment', $import['background_atachment'] ); $getsomething = true; }
			if ( isset($import['general_options'] ) ) { update_option('upright_option', $import['general_options'] ); $getsomething = true; }

			if ($getsomething){
				$msg = __('Import setting success', 'palmas');
			}else{
				$msg = __('Nothing imported', 'palmas');
			}
		}else{
			$msg = __('Nothing imported', 'palmas');
		}
	}
	
	return $msg;

}

/**
 * Export the current setting into a json file.
 *
 * @since wpkube 1.2
 */
function wpkube_export_setting(){
	if ( isset($_POST['submit_export']) ){
		$theme_option = get_option('upright_option');
		
		$export = Array(
			'background_color'=> get_theme_mod('background_color'),
			'background_image'=> get_theme_mod('background_image'),
			'background_repeat'=>get_theme_mod('background_repeat'),
			'background_position_x'=>get_theme_mod('background_position_x'),
			'background_attachment'=>get_theme_mod('background_attachment'),
			'general_options'=> $theme_option,
			);
		$filename = 'setting_' . date( 'Y-m-d' ) .'_export.json';
		header( 'Content-Description: File Transfer' );
		header( 'Content-Disposition: attachment; filename=' . $filename );
		header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ), true );
			
		echo json_encode($export);
		
		die();
	}
}

add_action('admin_menu', 'wpkube_retister_export_import_setting');
function wpkube_retister_export_import_setting(){
	add_theme_page('Export & Import Preset', 'Export & Import Theme Preset', 'manage_options', 'export-import-setting', 'wpkube_export_import_interface');
}

wpkube_export_setting();

/**
 * Output the interface for Setting Export and Import tools.
 *
 * @since wpkube 1.2
 */
function wpkube_export_import_interface(){

?>

<?php if ( isset($_POST['submit_import']) ) : ?>
<div id="message" class="updated"><?php echo wpkube_import_setting(); ?></div>
<?php endif; ?>

<div class="wrap export-import">
	<h2><?php _e('Export and Import Setting', 'palmas'); ?></h2>
	<form enctype="multipart/form-data" method="post">
    	<!--<h3>Reset Setting to Default</h3>
        <p><input name="submit_reset" id="submit" class="button" value="<?php _e('Reset setting to default', 'palmas'); ?>" type="submit"></p>
        <p class="description"><?php _e('This operation will reset all the setting to the default state. Please note that once you reset there is no undo, it would be better if you backup your current setting first by exporting it.','palmas'); ?></p>
        <br />-->
		<h3>Import Setting</h3>
    	<p><?php _e('Upload a valid .json file and we will import the theme settings into this theme', 'palmas'); ?></p>
        <p><?php _e('Choose a .json file to upload, then click Upload file and import.', 'palmas'); ?></p>
        <p><input id="upload" name="import" size="25" type="file"></p>
        <p><input name="submit_import" id="submit" class="button" value="<?php _e('Upload file and import', 'palmas'); ?>" type="submit"></p>
        <p class="description"><?php _e('This operation will replace the current setting to the uploaded one. Please note that once you import there is no undo, it would be better if you backup your current setting first by exporting it.','palmas'); ?></p>
        <br />
        <h3>Export Current Setting</h3>
        <p><input name="submit_export" id="submit_export" class="button" value="<?php _e('Export current setting','palmas'); ?>" type="submit"></p>
        <p><?php _e('This will download the setting in JSON format', 'palmas'); ?></p>
    </form>

</div>



<?php
}

?>