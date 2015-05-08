<?php
$msg = "";

$cmd = isset ( $_POST ["cmd"] ) ? $_POST ["cmd"] : '';
$value = "";

if ($cmd == "generate") {
	$current_options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	$value = json_encode ( $current_options );
	$msg = "Backup of your current settings is generated. Copy generated configuration string and save it on your computer. You can use it to restore settings or transfer them to other site.";
}
if ($cmd == "restore") {
	$options = isset ( $_POST ["essb_options"] ) ? $_POST ["essb_options"] : "";
	
	if ($options == "") {
		$msg = __("Configuration string is not provided.", ESSB_TEXT_DOMAIN);
	}
	$options = htmlspecialchars_decode ( $options );
	$options = stripslashes ( $options );
	// print $options;
	if ($options != '') {
		// print "decoding";
		// $opt = json_decode($options);
		$imported_options = json_decode ( $options, true );
		if (is_array ( $imported_options )) {
			update_option ( EasySocialShareButtons::$plugin_settings_name, $imported_options );
			$msg = __("Settings are restored!", ESSB_TEXT_DOMAIN);
		} else {
			$msg = __("Error loading configuration string!", ESSB_TEXT_DOMAIN);
		}
	}
}

?>

<div class="wrap">
	<?php
	
	if ($msg != "") {
		echo '<div class="updated optionsframework_setup_nag" style="padding: 10px;">' . $msg . '</div>';
	}
	
	?>
	
<div class="essb-options">
		<div class="essb-options-header" id="essb-options-header" style="padding-bottom: 40px;">
			<div class="essb-options-title" >
				<?php _e('Import/Export Configuration', ESSB_TEXT_DOMAIN); ?><br /> <span class="label"
					style="font-weight: 400;"><a
					href="http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref=appscreo"
					target="_blank" style="text-decoration: none;">Easy Social Share Buttons for WordPress version <?php echo ESSB_VERSION; ?></a></span>
			</div>
					<?php echo '<a href="http://support.creoworx.com" target="_blank" text="' . __ ( 'Need Help? Click here to visit our support center', ESSB_TEXT_DOMAIN ) . '" class="button">' . __ ( 'Need Help? Click here to visit our support center', ESSB_TEXT_DOMAIN ) . '</a>'; ?>
			
			<form name="general_form" method="post"
				action="admin.php?page=essb_settings&tab=backup"
				style="position: relative; float:right;">
				<input type="hidden" id="cmd" name="cmd" value="generate" /><?php echo '<input type="Submit" name="backup" value="' . __ ( 'Backup', ESSB_TEXT_DOMAIN ) . '" class="button-primary" />'; ?></form>
			&nbsp;
			<form name="general_form" method="post"
				action="admin.php?page=essb_settings&tab=backup"
				style="position: relative; float:right; margin-right: 5px;">
				<input type="hidden" id="cmd" name="cmd" value="restore" /><?php echo '<input type="Submit" name="restore" value="' . __ ( 'Restore', ESSB_TEXT_DOMAIN ) . '" class="button-secondary" />'; ?>
		
		</div>
		<div class="essb-options-sidebar">
			<ul class="essb-options-group-menu">
				<li id="essb-menu-1" class="essb-menu-item active"><a href="#"
					onclick="essb_option_activate('1'); return false;"><?php _e('Import/Export Configuration', ESSB_TEXT_DOMAIN);?></a></li>
			</ul>
		</div>
		<div class="essb-options-container">
			<div id="essb-container-1" class="essb-data-container">
				<table border="0" cellpadding="5" cellspacing="0" width="100%">
					<col width="25%" />
					<col width="75%" />
					<tr class="table-border-bottom">
						<td colspan="2" class="sub"><?php _e('Import/Export Configuration', ESSB_TEXT_DOMAIN); ?><div
								style="position: relative; float: right; margin-top: -5px;"></div></td>
					</tr>
					<tr class="even table-border-bottom">
						<td class="bold" valign="top" colspan="2"><?php _e('Configuration String:', ESSB_TEXT_DOMAIN);?> <br />
							<span class="label" style="font-weight: 400;"><?php _e('WARNING! Importing
								configuration will overwrite all existing option values, please
								proceed with caution!', ESSB_TEXT_DOMAIN); ?></span></td>
					</tr>
					<tr class="odd table-border-bottom">
						<td class="essb_general_option" colspan="2"><textarea
								name="essb_options" id="essb_options"
								class="input-element stretched" rows="10"
								style="font-size: 12px;"><?php echo $value; ?></textarea></td>
					</tr>
				</table>
				</form>
			</div>
		</div>

	</div>
</div>

<?php

if ($cmd == "generate") {
	?>
<script type="text/javascript">

jQuery(document).ready(function(){
    jQuery('#essb_options').select();
});
</script>

<?php } ?>
