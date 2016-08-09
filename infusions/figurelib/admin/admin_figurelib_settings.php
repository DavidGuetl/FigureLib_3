<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: settings_figurelib.php based on settings_news.php
| Author: Starefossen
| Modification: Catzenjaeger
| URL: www.aliencollectors.com
| E-Mail: admin@aliencollectors.com
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }
pageAccess("FI");
require_once THEMES. "templates/admin_header.php";

$locale = fusion_get_locale();

// SETTINGS HOLEN
$fil_settings = get_settings("figurelib");

if (isset($_POST['savesettings'])) {
	$error = 0;
	$inputArray = array(	
		"figure_per_page" => form_sanitizer($_POST['figure_per_page'], 0, "figure_per_page"),
		"figure_per_line" => form_sanitizer($_POST['figure_per_line'], 0, "figure_per_line"),
		"figure_allow_comments" => isset($_POST['figure_allow_comments']) ? 1 : 0,
		"figure_allow_ratings" => isset($_POST['figure_allow_ratings']) ? 1 : 0,
		"figure_display" => isset($_POST['figure_display']) ? 1 : 0,
		"figure_submit" => isset($_POST['figure_submit']) ? 1 : 0,
		"figure_related" => isset($_POST['figure_related']) ? 1 : 0,
		"figure_social_sharing" => isset($_POST['figure_social_sharing']) ? 1 : 0,	
		"figure_thumb_w" => form_sanitizer($_POST['figure_thumb_w'], 300, 'figure_thumb_w'),
		"figure_thumb_h" => form_sanitizer($_POST['figure_thumb_h'], 150, 'figure_thumb_h'),
		"figure_photo_w" => form_sanitizer($_POST['figure_photo_w'], 400, 'figure_photo_w'),
		"figure_photo_h" => form_sanitizer($_POST['figure_photo_h'], 300, 'figure_photo_h'),
		"figure_photo_max_w" => form_sanitizer($_POST['figure_photo_max_w'], 1800, 'figure_photo_max_w'),
		"figure_photo_max_h" => form_sanitizer($_POST['figure_photo_max_h'], 1600, 'figure_photo_max_h'),
		"figure_photo_max_b" => form_sanitizer($_POST['calc_b'], 150, 'calc_b')*form_sanitizer($_POST['calc_c'], 100000, 'calc_c'),

	);
	if (defender::safe()) {
		foreach ($inputArray as $settings_name => $settings_value) {
			$inputSettings = array(
				"settings_name" => $settings_name, 
				"settings_value" => $settings_value, 
				"settings_inf" => "figurelib",
			);
			dbquery_insert(DB_SETTINGS_INF, $inputSettings, "update", array("primary_key" => "settings_name"));
		}
		addNotice("success", $locale['900']);
		redirect(FUSION_REQUEST);
	} else {
		addNotice('danger', $locale['901']);
	}
}

opentable($locale['figure_settings']);

echo openform('settingsform', 'post', FUSION_REQUEST, array('class' => "m-t-20"));
echo "<div class='well'>".$locale['filt_0006']."</div>"; // ['filt_0006'] = "Configuration page for Figures";
echo "<div class='row'>\n<div class='col-xs-12 col-sm-8'>\n";

openside("");
//$locale['admin_figurelib_settings.php_001'] = "Original";
//$locale['admin_figurelib_settings.php_002'] = "Square";
$thumb_opts = array(
'0' => $locale['admin_figurelib_settings.php_001'], 
'1' => $locale['admin_figurelib_settings.php_002']);

$calc_opts = array(
'1' => 'Bytes (bytes)', 
'1000' => 'KB (Kilobytes)', 
'1000000' => 'MB (Megabytes)');
$calc_c = calculate_byte($asettings['figure_photo_max_b']);
$calc_b = $asettings['figure_photo_max_b']/$calc_c;

	// ['figure_334'] = "Figures per page:";
	// ['figure_361'] = "Only values 1-500 allowed!";
	echo form_text('figure_per_page', $locale['figure_334'], $fil_settings['figure_per_page'], array(
		'inline' => 1,
		'required' => 1,
		'error_text' => $locale['figure_361'],
		'type' => 'number',
		'min' => 1,
		'max' => 500,
		'width' => '250px'
	));

	// ['figure_357'] = "Figures per line:";
	// ['figure_362'] = "Only values 1-10 allowed!";
	echo form_text('figure_per_line', $locale['figure_357'], $fil_settings['figure_per_line'], array(
		'inline' => 1,
		'required' => 1,
		'error_text' => $locale['figure_362'],
		'number' => 1,
		'min' => 1,
		'max' => 10,
		'type' => 'number',
		'width' => '250px'
	));	
	
// $locale['admin_figurelib_settings.php_003'] = "Thumb size:";
// $locale['admin_figurelib_settings.php_004'] = "Photo size:";
// $locale['admin_figurelib_settings.php_005'] = "Maximum photo size:";
// $locale['admin_figurelib_settings.php_006'] = "Width x Height";
// $locale['admin_figurelib_settings.php_007'] = "Maximum file size (bytes):";		
echo "
<div class='row'>
	<div class='col-xs-12 col-sm-3'>
		<label for='figure_thumb_w'>".$locale['admin_figurelib_settings.php_003']."</label>
	</div>
	<div class='col-xs-12 col-sm-9'>
	".form_text(
	'figure_thumb_w', '', $fil_settings['figure_thumb_w'], array(
		'class' => 'pull-left', 'max_length' => 4, 'number' => 1, 'width' => '150px'
	))."
	<i class='entypo icancel pull-left m-r-10 m-l-0 m-t-10'></i>
	".form_text('figure_thumb_h', '', $fil_settings['figure_thumb_h'], array(
		'class' => 'pull-left', 'max_length' => 4, 'number' => 1, 'width' => '150px'
	))."
	<small class='m-l-10 mid-opacity text-uppercase pull-left m-t-10'>( ".$locale['admin_figurelib_settings.php_006']." )</small>
	</div>
</div>";
echo "
<div class='row'>
	<div class='col-xs-12 col-sm-3'>
		<label for='figure_photo_w'>".$locale['admin_figurelib_settings.php_004']."</label>
	</div>
	<div class='col-xs-12 col-sm-9'>
	".form_text('figure_photo_w', '', $fil_settings['figure_photo_w'], array(
		'class' => 'pull-left', 'max_length' => 4, 'number' => 1, 'width' => '150px'
	))."
	<i class='entypo icancel pull-left m-r-10 m-l-0 m-t-10'></i>
	".form_text('figure_photo_h', '', $fil_settings['figure_photo_h'], array(
		'class' => 'pull-left', 'max_length' => 4, 'number' => 1, 'width' => '150px'
	))."
	<small class='m-l-10 mid-opacity text-uppercase pull-left m-t-10'>( ".$locale['admin_figurelib_settings.php_006']." )</small>
	</div>
</div>";
echo "
<div class='row'>
	<div class='col-xs-12 col-sm-3'>
		<label for='blog_thumb_w'>".$locale['admin_figurelib_settings.php_005']."</label>
	</div>
	<div class='col-xs-12 col-sm-9'>
	".form_text('figure_photo_max_w', '', $fil_settings['figure_photo_max_w'], array(
		'class' => 'pull-left', 'max_length' => 4, 'number' => 1, 'width' => '150px'
	))."
	<i class='entypo icancel pull-left m-r-10 m-l-0 m-t-10'></i>
	".form_text('figure_photo_max_h', '', $fil_settings['figure_photo_max_h'], array(
		'class' => 'pull-left', 'max_length' => 4, 'number' => 1, 'width' => '150px'
	))."
	<small class='m-l-10 mid-opacity text-uppercase pull-left m-t-10'>( ".$locale['admin_figurelib_settings.php_006']." )</small>
	</div>
</div>";

echo "
<div class='row'>
	<div class='col-xs-12 col-sm-3'>
		<label for='calc_b'>".$locale['admin_figurelib_settings.php_007']."</label>
	</div>
	<div class='col-xs-12 col-sm-9'>
	".form_text('calc_b', '', $calc_b, array(
		'required' => 1, 'number' => 1, 'error_text' => $locale['error_rate'], 'width' => '100px', 'max_length' => 4,
		'class' => 'pull-left m-r-10'
	))."
	".form_select('calc_c', '', $calc_c, array(
		'options' => $calc_opts, 'placeholder' => $locale['choose'], 'class' => 'pull-left', 'width' => '180px'
	))."
	</div>
</div>
";
	
closeside();
	
echo "</div>\n";
echo "<div class='col-xs-12 col-sm-4'>\n";

openside("");

	// ['figure_335'] = "Allow users to submit figures:";
	// ALS CHECKBOX
		echo form_checkbox('figure_submit', $locale['figure_335'], $fil_settings['figure_submit']);
/*	
	// ALS DROPDOWN 	
		echo form_select("figure_submit", $locale['figure_335'], $fil_settings['figure_submit'], array(
			"inline" => TRUE, 
			"options" => array($locale['disable'], $locale['enable'])
		));
*/
	// ['figure_344'] = "Allow Social Sharing:";	
	// ALS CHECKBOX
		 echo form_checkbox('figure_social_sharing', $locale['figure_344'], $fil_settings['figure_social_sharing']);
/*
	// ALS DROPDOWN
		echo form_select("figure_social_sharing", $locale['figure_344'], $fil_settings['figure_social_sharing'], array(
			"inline" => TRUE, 
			"options" => array($locale['disable'], $locale['enable'])
		));
*/
	// ['figure_348'] = "Show related figures:";
	// ALS CHECKBOX
		 echo form_checkbox('figure_related', $locale['figure_348'], $fil_settings['figure_related']);
/*	
	// ALS DROPDOWN
	echo form_select("figure_related", $locale['figure_348'], $fil_settings['figure_related'], array(
			"inline" => TRUE, 
			"options" => array($locale['disable'], $locale['enable'])
		));
*/	

	// ['figure_363'] = "Allow Comments:";
	// ALS CHECKBOX
		echo form_checkbox('figure_allow_comments', $locale['figure_363'], $fil_settings['figure_allow_comments']);
		
	// ['figure_364'] = "Allow Ratings:";
	// ALS CHECKBOX
		echo form_checkbox('figure_allow_ratings', $locale['figure_364'], $fil_settings['figure_allow_ratings']);


	// ['figure_339'] = "Gallery Mode on";
		echo form_checkbox('figure_display', $locale['figure_339'], $fil_settings['figure_display']);
		
		
	// ['admin_figurelib_settings.php_008'] = "Thumb ratio:";	
		echo form_select('figure_thumb_ratio', $locale['admin_figurelib_settings.php_008'], $fil_settings['figure_thumb_ratio'], array("options" => $thumb_opts));

closeside();


echo "</div>\n</div>\n";
// ['figure_345'] = "Save Settings";
echo form_button('savesettings', $locale['figure_345'], $locale['figure_345'], array('class' => 'btn-success'));
echo closeform();
closetable();
function calculate_byte($total_bit) {
	$calc_opts = array(1 => 'Bytes (bytes)', 1000 => 'KB (Kilobytes)', 1000000 => 'MB (Megabytes)');
	foreach ($calc_opts as $byte => $val) {
		if ($total_bit/$byte <= 999) {
			return (int)$byte;
		}
	}
	return 1000000;
}
