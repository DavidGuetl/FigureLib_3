<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: weblinks_settings.php
| Author: PHP-Fusion Development Team
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
include "infusion_db.php";

if (isset($_POST['savesettings'])) {
	$inputArray = array(		
		"figure_per_page" => form_sanitizer($_POST['figure_per_page'], 0, "figure_per_page"),
		"figure_per_line" => form_sanitizer($_POST['figure_per_line'], 0, "figure_per_line"),
		"figure_display" => isset($_POST['figure_display']) ? 1 : 0,
		"figure_submit" => isset($_POST['figure_submit']) ? 1 : 0,
		"figure_related" => isset($_POST['figure_related']) ? 1 : 0,
		"figure_social_sharing" => isset($_POST['figure_social_sharing']) ? 1 : 0,	
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

echo openform('settingsform', 'post', FUSION_REQUEST, array('class' => "m-t-20"));
echo "<div class='well'>".$locale['filt_0006']."</div>"; // ['filt_0006'] = "Configuration page for Figures";
echo "<div class='row'><div class='col-xs-12 col-sm-12 col-md-6'>\n";

openside("");

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

	// ['figure_358'] = "Figure photo max size";
	echo form_text('figure_photo_max_b', $locale['figure_358'], $fil_settings['figure_photo_max_b'], array(
		'inline' => 1,
		'required' => 1,
		'error_text' => $locale['error_value'],
		'type' => 'number',
		'width' => '250px'
	));
	
		// ['figure_359'] = "Figure photo max width:";
		echo form_text('figure_photo_max_w', $locale['figure_359'], $fil_settings['figure_photo_max_w'], array(
		'inline' => 1,
		'required' => 1,
		'error_text' => $locale['error_value'],
		'type' => 'number',
		'width' => '250px'
	));
	
		// ['figure_360'] = "Figure photo max heigh:";
		echo form_text('figure_photo_max_h', $locale['figure_360'], $fil_settings['figure_photo_max_h'], array(
		'inline' => 1,
		'required' => 1,
		'error_text' => $locale['error_value'],
		'type' => 'number',
		'width' => '250px'
	));

closeside();
	
	echo "</div>\n<div class='col-xs-12 col-sm-12 col-md-6'>\n";


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
	// ['figure_339'] = "Gallery Mode on";
		echo form_checkbox('figure_display', $locale['figure_339'], $fil_settings['figure_display']);

closeside();

echo "</div>\n</div>\n";
// ['figure_345'] = "Save Settings";
echo form_button('savesettings', $locale['figure_345'], $locale['figure_345'], array('class' => 'btn-success'));
echo closeform();