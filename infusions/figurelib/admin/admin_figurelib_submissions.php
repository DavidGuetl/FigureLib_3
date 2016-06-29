<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: figurelib_submissions,php based on weblinks_submissions.php
| Author: PHP-Fusion Development Team
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
	//error_reporting(E_ALL);
	//Formularinhalte prüfen
	//print_r ($_POST);
	//GET-Parameter prüfen
	//print_r ($_GET);
/*--------------------------------------------------------*/
if (fusion_get_settings("tinymce_enabled")) {
	echo "<script language='javascript' type='text/javascript'>advanced();</script>\n";
}
pageAccess("FI");
			
if (isset($_GET['submit_id']) && isnum($_GET['submit_id'])) {
	if (isset($_POST['publish'])) {
		$result = dbquery("SELECT ts.*, tu.user_id, tu.user_name FROM ".DB_SUBMISSIONS." ts
			LEFT JOIN ".DB_USERS." tu ON ts.submit_user=tu.user_id
			WHERE submit_id='".intval($_GET['submit_id'])."'");
		if (dbrows($result)) {
			$data = dbarray($result);
			$data = array(			
			'figure_datestamp'    => form_sanitizer($_POST['figure_datestamp'],time(), 'figure_datestamp'),			
			'figure_freigabe'     => form_sanitizer($_POST['figure_freigabe'],     0,  'figure_freigabe'),
			'figure_title'        => form_sanitizer($_POST['figure_title'],        '', 'figure_title'),
			'figure_variant'      => form_sanitizer($_POST['figure_variant'],      '', 'figure_variant'),
			'figure_manufacturer' => form_sanitizer($_POST['figure_manufacturer'], '', 'figure_manufacturer'),
			'figure_artists'      => form_sanitizer($_POST['figure_artists'],      '', 'figure_artists'),
			'figure_country'      => form_sanitizer($_POST['figure_country'],      '', 'figure_country'),
			'figure_brand'        => form_sanitizer($_POST['figure_brand'],        '', 'figure_brand'),
			'figure_series'       => form_sanitizer($_POST['figure_series'],       '', 'figure_series'),
			'figure_scale'        => form_sanitizer($_POST['figure_scale'],        '', 'figure_scale'),
			'figure_weight'       => form_sanitizer($_POST['figure_weight'],       '', 'figure_weight'),
			'figure_height'       => form_sanitizer($_POST['figure_height'],       '', 'figure_height'),
			'figure_width'        => form_sanitizer($_POST['figure_width'],        '', 'figure_width'),
			'figure_depth'        => form_sanitizer($_POST['figure_depth'],        '', 'figure_depth'),
			'figure_material'     => form_sanitizer($_POST['figure_material'],     '', 'figure_material'),
			'figure_poa'          => form_sanitizer($_POST['figure_poa'],          '', 'figure_poa'),
			'figure_packaging'    => form_sanitizer($_POST['figure_packaging'],    '', 'figure_packaging'),
			'figure_retailprice'  => form_sanitizer($_POST['figure_retailprice'],  '', 'figure_retailprice'),
			'figure_usedprice'    => form_sanitizer($_POST['figure_usedprice'],    '', 'figure_usedprice'),
			'figure_limitation'   => form_sanitizer($_POST['figure_limitation'],   '', 'figure_limitation'),
			'figure_cat'          => form_sanitizer($_POST['figure_cat'],          '', 'figure_cat'),
			'figure_editionsize'  => form_sanitizer($_POST['figure_editionsize'],  '', 'figure_editionsize'),
			'figure_pubdate'      => form_sanitizer($_POST['figure_pubdate'],      '', 'figure_pubdate'),
			'figure_agb'          => form_sanitizer($_POST['figure_agb'],          '', 'figure_agb'),
			'figure_submitter'    => form_sanitizer($_POST['figure_submitter'],    '', 'figure_submitter'), 
			'figure_visibility'   => form_sanitizer($_POST['figure_visibility'],   0,  'figure_visibility'), 
			'figure_description'  => form_sanitizer($_POST['figure_description'], "",  "figure_description"),
			'figure_accessories'  => form_sanitizer($_POST['figure_accessories'], "",  "figure_accessories"),
			
			'figure_forum_url'    => form_sanitizer($_POST['figure_forum_url'],    '', 'figure_forum_url'), 
			'figure_affiliate_1'  => form_sanitizer($_POST['figure_affiliate_1'],  '', 'figure_affiliate_1'),
			'figure_affiliate_2'  => form_sanitizer($_POST['figure_affiliate_2'],  '', 'figure_affiliate_2'),
			'figure_affiliate_3'  => form_sanitizer($_POST['figure_affiliate_3'],  '', 'figure_affiliate_3'),
			'figure_affiliate_4'  => form_sanitizer($_POST['figure_affiliate_4'],  '', 'figure_affiliate_4'),
			'figure_affiliate_5'  => form_sanitizer($_POST['figure_affiliate_5'],  '', 'figure_affiliate_5'),
			'figure_affiliate_6'  => form_sanitizer($_POST['figure_affiliate_6'],  '', 'figure_affiliate_6'),
			'figure_affiliate_7'  => form_sanitizer($_POST['figure_affiliate_7'],  '', 'figure_affiliate_7'),
			'figure_affiliate_8'  => form_sanitizer($_POST['figure_affiliate_8'],  '', 'figure_affiliate_8'),
			'figure_affiliate_9'  => form_sanitizer($_POST['figure_affiliate_9'],  '', 'figure_affiliate_9'),
			'figure_affiliate_10' => form_sanitizer($_POST['figure_affiliate_10'], '', 'figure_affiliate_10'),
			'figure_eshop'        => form_sanitizer($_POST['figure_eshop'],        '', 'figure_eshop'),
			'figure_amazon_de'    => form_sanitizer($_POST['figure_amazon_de'],    '', 'figure_amazon_de'),
			'figure_amazon_uk'    => form_sanitizer($_POST['figure_amazon_uk'],    '', 'figure_amazon_uk'),
			'figure_amazon_fr'    => form_sanitizer($_POST['figure_amazon_fr'],    '', 'figure_amazon_fr'),
			'figure_amazon_es'    => form_sanitizer($_POST['figure_amazon_es'],    '', 'figure_amazon_es'),
			'figure_amazon_it'    => form_sanitizer($_POST['figure_amazon_it'],    '', 'figure_amazon_it'),
			'figure_amazon_jp'    => form_sanitizer($_POST['figure_amazon_jp'],    '', 'figure_amazon_jp'),
			'figure_amazon_com'   => form_sanitizer($_POST['figure_amazon_com'],   '', 'figure_amazon_com'),
			'figure_amazon_ca'    => form_sanitizer($_POST['figure_amazon_ca'],    '', 'figure_amazon_ca'),	
		
			);
			
			
/*
			/////////////// eingefügt BILD
			if (isset($_FILES['figure_image'])) { // when files is uploaded.
				$upload = form_sanitizer($_FILES['figure_image'], '', 'figure_image');
				if (!empty($upload) && !$upload['error']) {
					$data['figure_images_image'] = $upload['image_name'];
	
				}
			} else { // when image not uploaded. but there should be exist check.
				$data['figure_image'] = (isset($_POST['figure_image']) ? $_POST['figure_image'] : "");
				
			}
			
			if (isset($_POST['del_image'])) {
				if (!empty($data['figure_image']) && file_exists(IMAGES_B.$data['figure_image'])) {
					unlink(IMAGES_B.$data['figure_image']);
				}		
				
				$data['figure_image'] = "";

			}
			/////////////// eingefügt BILD ende
*/			
			if (defender::safe()) {
				dbquery_insert(DB_FIGURE_ITEMS, $data, "save");
				
				
				$figureID = dblastid();

				// Image Upload
				$upload = form_sanitizer($_FILES['figure_image'], "", "figure_image");
				if (!empty($upload)) {
					$totalFiles = count($upload);
					for ($i = 0; $i < $totalFiles; $i++) {
						$currentUpload = $upload[$i];
						if ($currentUpload['error'] == 0) {
							$imageArray = array();
							$imageArray = array(
								"figure_images_figure_id" => $figureID,
								"figure_images_image" => $currentUpload['image_name'],
								"figure_images_thumb" => $currentUpload['thumb_name']
							);
							dbquery_insert(DB_FIGURE_IMAGES, $imageArray, "save");
						} else {
							echo $currentUpload['error'];
						}
					}
				}	
					
				
				// ALTE SUBMISSION DATEN LÖSCHEN
				$result = dbquery("DELETE FROM ".DB_SUBMISSIONS." WHERE submit_id='".intval($_GET['submit_id'])."'");
	
				// ['figs_0003'] = "Figures Submissions has been published";
				addNotice("success", $locale['figs_0003']);
				redirect(clean_request("", array("submit_id"), FALSE));
			}
	
			
		} else {
			redirect(clean_request("", array("submit_id"), FALSE));
		}
	}
		else if (isset($_POST['delete']) && (isset($_GET['submit_id']) && isnum($_GET['submit_id']))) {
		$result = dbquery("
			SELECT
			ts.submit_id, ts.submit_datestamp, ts.submit_criteria
			FROM ".DB_SUBMISSIONS." ts
			WHERE submit_type='f' and submit_id='".intval($_GET['submit_id'])."'
		");
		if (dbrows($result) > 0) {
			$data = dbarray($result);
			$result = dbquery("DELETE FROM ".DB_SUBMISSIONS." WHERE submit_id='".intval($data['submit_id'])."'");
			
			// ['figs_0004'] = "Figure Submission has been deleted";
			addNotice("success", $locale['figs_0004']);
		}
		redirect(clean_request("", array("submit_id"), FALSE));
	} else {
		$result = dbquery("SELECT
			ts.submit_datestamp, ts.submit_criteria, tu.user_id, tu.user_name, tu.user_avatar, tu.user_status
			FROM ".DB_SUBMISSIONS." ts
			LEFT JOIN ".DB_USERS." tu ON ts.submit_user=tu.user_id
			WHERE submit_id='".intval($_GET['submit_id'])."' order by submit_datestamp desc");
		if (dbrows($result) > 0) {
			$data = dbarray($result);
			$submit_criteria = unserialize($data['submit_criteria']);
			$callback_data = array(
				"figure_id" 		  => $submit_criteria['figure_datestamp'],			
				"figure_freigabe"     => $submit_criteria['figure_freigabe'],
				"figure_title"        => $submit_criteria['figure_title'],
				"figure_variant"      => $submit_criteria['figure_variant'],
				"figure_manufacturer" => $submit_criteria['figure_manufacturer'],
				"figure_artists"      => $submit_criteria['figure_artists'],
				"figure_country"      => $submit_criteria['figure_country'],
				"figure_brand"        => $submit_criteria['figure_brand'],
				"figure_series"       => $submit_criteria['figure_series'],
				"figure_scale"        => $submit_criteria['figure_scale'],
				"figure_weight"       => $submit_criteria['figure_weight'],
				"figure_height"       => $submit_criteria['figure_height'],
				"figure_width"        => $submit_criteria['figure_width'],
				"figure_depth"        => $submit_criteria['figure_depth'],
				"figure_material"     => $submit_criteria['figure_material'],
				"figure_poa"          => $submit_criteria['figure_poa'],
				"figure_packaging"    => $submit_criteria['figure_packaging'],
				"figure_retailprice"  => $submit_criteria['figure_retailprice'],
				"figure_usedprice"    => $submit_criteria['figure_usedprice'],
				"figure_limitation"   => $submit_criteria['figure_limitation'],
				"figure_cat"          => $submit_criteria['figure_cat'],
				"figure_editionsize"  => $submit_criteria['figure_editionsize'],
				"figure_pubdate"      => $submit_criteria['figure_pubdate'],
				"figure_agb"          => $submit_criteria['figure_agb'],
				"figure_submitter"    => $submit_criteria['figure_submitter'],
				"figure_visibility"   => 0,
				"figure_description"  => parse_textarea($submit_criteria['figure_description']),
				"figure_accessories"  => parse_textarea($submit_criteria['figure_accessories']),
				"figure_datestamp" 	  => $data['submit_datestamp'],	

				"figure_forum_url"    => $submit_criteria['figure_forum_url'],
				"figure_affiliate_1"  => $submit_criteria['figure_affiliate_1'],
				"figure_affiliate_2"  => $submit_criteria['figure_affiliate_2'],
				"figure_affiliate_3"  => $submit_criteria['figure_affiliate_3'],
				"figure_affiliate_4"  => $submit_criteria['figure_affiliate_4'],
				"figure_affiliate_5"  => $submit_criteria['figure_affiliate_5'],
				"figure_affiliate_6"  => $submit_criteria['figure_affiliate_6'],
				"figure_affiliate_7"  => $submit_criteria['figure_affiliate_7'],
				"figure_affiliate_8"  => $submit_criteria['figure_affiliate_8'],
				"figure_affiliate_9"  => $submit_criteria['figure_affiliate_9'],
				"figure_affiliate_10" => $submit_criteria['figure_affiliate_10'],
				"figure_eshop"        => $submit_criteria['figure_eshop'],
				"figure_amazon_de"    => $submit_criteria['figure_amazon_de'],
				"figure_amazon_uk"    => $submit_criteria['figure_amazon_uk'],
				"figure_amazon_fr"    => $submit_criteria['figure_amazon_fr'],
				"figure_amazon_es"    => $submit_criteria['figure_amazon_es'],
				"figure_amazon_it"    => $submit_criteria['figure_amazon_it'],
				"figure_amazon_jp"    => $submit_criteria['figure_amazon_jp'],
				"figure_amazon_com"   => $submit_criteria['figure_amazon_com'],
				"figure_amazon_ca"    => $submit_criteria['figure_amazon_ca'],

		
			);
			
			echo openform("publish_figure", "post", FUSION_REQUEST);
			
			
			
			echo "<div class='well clearfix'>\n";
			echo "<div class='pull-left'>\n";
			echo display_avatar($data, "30px", "", "", "");
			echo "</div>\n";
			echo "<div class='overflow-hide'>\n";
			
			// ['figs_0005'] = "Posted by ";
			echo $locale['figs_0005'].profile_link($data['user_id'], $data['user_name'], $data['user_status'])." (User ID/Submitter ID: ".$callback_data['figure_submitter'].")<br/>  \n";
			
			// ['figs_0006'] = "The above Figure was submitted by ";
			echo $locale['figs_0006'].timer($data['submit_datestamp'])." - ".showdate("shortdate", $data['submit_datestamp']);
			echo "</div>\n";
			echo "</div>\n";
			echo "<div class='row'>\n";
			echo "<div class='col-xs-12 col-sm-8'>\n";
			echo form_hidden('figure_datestamp', '', $callback_data['figure_datestamp']);
			echo form_hidden('figure_submitter', '', $callback_data['figure_submitter']);
			
// Checkbox "Figure Freigabe" ///////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_069'] = "Figure release on page";
	echo form_checkbox("figure_freigabe", $locale['figurelib/admin/figurelib.php_069'], $callback_data['figure_freigabe'], array(
									"inline" => TRUE,
									"width" => "520px",
									"required" => FALSE
								));	
// Select Field "Visibillity"  ////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_009'] = "Visibility:";
	echo form_select('figure_visibility', $locale['figurelib/admin/figurelib.php_009'], $callback_data['figure_visibility'], array(
									"inline" => TRUE,
									"width" => "520px",
									'options' => fusion_get_groups()
								));
// Form "Space" ////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";								
// FIGUREN NAME (TITLE) ////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_004'] = "Figure title";
									// ['figurelib/admin/figurelib.php_005'] = "Figure name";
									// ['figurelib/admin/figurelib.php_006'] = "Please enter a figure name";
	echo form_text('figure_title', $locale['figurelib/admin/figurelib.php_004'], $callback_data['figure_title'], array(
									 "placeholder" => $locale['figurelib/admin/figurelib.php_005'],
									 "error_text" => $locale['figurelib/admin/figurelib.php_006'],
									 "inline" => TRUE,
									 "width" => "520px",
									 'required' => TRUE
								 ));			
// Select Field "Kategorie" /////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_007'] = "Category:";	
									// ['figurelib/admin/figurelib.php_008'] = "Select a Category";
	echo form_select_tree("figure_cat", $locale['figurelib/admin/figurelib.php_007'], $callback_data['figure_cat'], array(
									"inline" => TRUE,
									"no_root" => 1,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_008'],
									"query" => (multilang_table("FI") ? "WHERE figure_cat_language='".LANGUAGE."'" : "")
								), DB_FIGURE_CATS, "figure_cat_name", "figure_cat_id", "figure_cat_parent");														
// Text Field "Variant" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_010'] = "Variant";
									// ['figurelib/admin/figurelib.php_011'] = "Variant of this figure (e.g. --> black Version)";
	echo form_text("figure_variant", $locale['figurelib/admin/figurelib.php_010'], $callback_data['figure_variant'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_011']
								));
// Select Field "Manufacturer" ///////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_012'] = "Manufacturer";
									// ['figurelib/admin/figurelib.php_013'] = "Select a Manufacturer";
									// ['figurelib/admin/figurelib.php_014'] = "You must choose a Manufacturer.";
	echo form_select_tree("figure_manufacturer", $locale['figurelib/admin/figurelib.php_012'], $callback_data['figure_manufacturer'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_013'],
									"error_text" => $locale['figurelib/admin/figurelib.php_014'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_manufacturer_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								),DB_FIGURE_MANUFACTURERS, "figure_manufacturer_name", "figure_manufacturer_id", "figure_manufacturer_parent");
// Text Field "Artists" //////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_015'] = "Artists";	
									// ['figurelib/admin/figurelib.php_016'] = "Artist and/or sculper of this figure";			
	echo form_text("figure_artists", $locale['figurelib/admin/figurelib.php_015'], $callback_data['figure_artists'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_016']
								));
// Text Field "Country" ////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_017'] = "Country";
									// ['figurelib/admin/figurelib.php_018'] = "Country (e.g. --> USA / Japan / Unknown)";
	echo form_text("figure_country", $locale['figurelib/admin/figurelib.php_017'], $callback_data['figure_country'], array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_018']
								));	
// Select Field "Brand"  ////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_019'] = "Brand";
									// ['figurelib/admin/figurelib.php_020'] = "Select a Brand";
									// ['figurelib/admin/figurelib.php_021'] = "You must choose a Brand.";
	echo form_select_tree("figure_brand", $locale['figurelib/admin/figurelib.php_019'], $callback_data['figure_brand'],	array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_020'],
									"error_text" => $locale['figurelib/admin/figurelib.php_021'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_brand_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								),DB_FIGURE_BRANDS, "figure_brand_name", "figure_brand_id", "figure_brand_parent");	
// Text Field "Series" ///////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_022'] = "Series";
									// ['figurelib/admin/figurelib.php_023'] = "Serie of this figure (e.g. --> NECA Series 7)";
	echo form_text("figure_series", $locale['figure_439'], $callback_data['figure_series'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_023']
								));	
// Form "Space" /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";	
// Select Field "Scale" /////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_024'] = "Scale";
									// ['figurelib/admin/figurelib.php_025'] = "Select a Scale";
									// ['figurelib/admin/figurelib.php_026'] = "You must choose a Scale.";
	echo form_select_tree("figure_scale", $locale['figurelib/admin/figurelib.php_024'], $callback_data['figure_scale'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_025'],
									"error_text" => $locale['figurelib/admin/figurelib.php_026'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_scale_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								), DB_FIGURE_SCALES, "figure_scale_name", "figure_scale_id", "figure_scale_parent");	
// Text Field "Weight" //////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_027'] = "Weight";
									// ['figurelib/admin/figurelib.php_028'] = "Weight of figure in Gramm or Kilogramm.";
		echo form_text("figure_weight", $locale['figurelib/admin/figurelib.php_027'], $callback_data['figure_weight'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_028']
								));	
// Select Field "Height" ////////////////////////////////////////////////////////////////////////////////////////////////////////
									//['figurelib/admin/figurelib.php_029'] = "Height";
									//['figurelib/admin/figurelib.php_030'] = "Select Height";
									//['figurelib/admin/figurelib.php_031'] = "You must choose a Height.";
		echo form_select_tree("figure_height", $locale['figurelib/admin/figurelib.php_029'], $callback_data['figure_height'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_030'],
									"error_text" => $locale['figurelib/admin/figurelib.php_031'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_measurements_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								), DB_FIGURE_MEASUREMENTS, "figure_measurements_inch", "figure_measurements_id", "figure_measurements_parent");
// Select Field "Width"  ////////////////////////////////////////////////////////////////////////////////////////////////////////
									//['figurelib/admin/figurelib.php_032'] = "Width";
									//['figurelib/admin/figurelib.php_033'] = "Select Width";
									//['figurelib/admin/figurelib.php_034'] = "You must choose a Width.";
		echo form_select_tree("figure_width", $locale['figurelib/admin/figurelib.php_032'], $callback_data['figure_width'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_033'],
									"error_text" => $locale['figurelib/admin/figurelib.php_034'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_measurements_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								), DB_FIGURE_MEASUREMENTS, "figure_measurements_inch", "figure_measurements_id", "figure_measurements_parent");
// Select Field "Depth" //////////////////////////////////////////////////////////////////////////////////////////////////////////
									//['figurelib/admin/figurelib.php_035'] = "Depth";
									//['figurelib/admin/figurelib.php_036'] = "Select Depth";
									//['figurelib/admin/figurelib.php_037'] = "You must choose a Depth.";
		echo form_select_tree("figure_depth", $locale['figurelib/admin/figurelib.php_035'], $callback_data['figure_depth'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_036'],
									"error_text" => $locale['figurelib/admin/figurelib.php_037'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_measurements_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								), DB_FIGURE_MEASUREMENTS, "figure_measurements_inch", "figure_measurements_id", "figure_measurements_parent");
// Select Field "Material" ///////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_038'] = "Material";
									// ['figurelib/admin/figurelib.php_039'] = "Select a Material";
									// ['figurelib/admin/figurelib.php_040'] = "You must choose a Material.";
		echo form_select_tree("figure_material", $locale['figurelib/admin/figurelib.php_038'], $callback_data['figure_material'], 	array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_039'],
									"error_text" => $locale['figurelib/admin/figurelib.php_040'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_material_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								), DB_FIGURE_MATERIALS, "figure_material_name", "figure_material_id", "figure_material_parent");
// Select Field "POA" //////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_041'] = "Articulation Pts.";
									// ['figurelib/admin/figurelib.php_042'] = "Select a Articulation Pts";
									// ['figurelib/admin/figurelib.php_043'] = "You must choose a Articulation Pts.";	
		echo form_select_tree("figure_poa", $locale['figurelib/admin/figurelib.php_041'], $callback_data['figure_poa'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_042'],
									"error_text" => $locale['figurelib/admin/figurelib.php_043'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_poa_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								),	DB_FIGURE_POAS, "figure_poa_name", "figure_poa_id", "figure_poa_parent");	
// Select Field "Packaging" //////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_044'] = "Packaging";
									// ['figurelib/admin/figurelib.php_045'] = "Select a Packaging";
									// ['figurelib/admin/figurelib.php_046'] = "You must choose a Packaging.";
		echo form_select_tree("figure_packaging", $locale['figurelib/admin/figurelib.php_044'], $callback_data['figure_packaging'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_045'],
									"error_text" => $locale['figurelib/admin/figurelib.php_046'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_packaging_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								),	DB_FIGURE_PACKAGINGS, "figure_packaging_name", "figure_packaging_id", "figure_packaging_parent");
// Form "Space" ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";
// Select Field "Pub Date" ////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_047'] = "Release Date";
									// ['figurelib/admin/figurelib.php_048'] = "Select a Year";
									// ['figurelib/admin/figurelib.php_049'] = "You must choose a Release Date.";
		echo form_select_tree("figure_pubdate", $locale['figurelib/admin/figurelib.php_047'], $callback_data['figure_pubdate'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_048'],
									"error_text" => $locale['figurelib/admin/figurelib.php_049'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_year_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								),	DB_FIGURE_YEARS, "figure_year", "figure_year_id", "figure_year_parent");	
// Text Field "Retail Price" ///////////////////////////////////////////////////////////////////////////////////////////////////////
								// ['figurelib/admin/figurelib.php_050'] = "Retail Price ($)";
								// ['figurelib/admin/figurelib.php_051'] = "Retail price in US$ (only numeric input possible)";					
		echo form_text("figure_retailprice", $locale['figurelib/admin/figurelib.php_050'], $callback_data['figure_retailprice'], array(
									"inline" => TRUE,
									"width" => "520px",
									"min" => "0",
									"required" => FALSE,
									"placeholder" => $locale['figurelib/admin/figurelib.php_051'],
									"error_text" => $locale['figure_1814'],
									"type" => "number"
								));	
// Text Field "Used Price" /////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_052'] = "Used Price ($)";
									// ['figurelib/admin/figurelib.php_053'] = "Used price in US$ (only numeric input possible)";
		echo form_text("figure_usedprice", $locale['figurelib/admin/figurelib.php_052'], $callback_data['figure_usedprice'], array(
									"inline" => TRUE,
									"width" => "520px",
									"min" => "0",
									"required" => FALSE,
									"placeholder" => $locale['figurelib/admin/figurelib.php_053'],
									"error_text" => $locale['figure_1815'],
									"type" => "number"
								));	
// Select Field "Limited Edition" //////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_054'] = "Limited Edition";
									// ['figurelib/admin/figurelib.php_055'] = "Select Limited Editon";
									// ['figurelib/admin/figurelib.php_056'] = "You must choose a Limited Edition.";		
		echo form_select_tree("figure_limitation", $locale['figurelib/admin/figurelib.php_054'], $callback_data['figure_limitation'], 	array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_055'],
									"error_text" => $locale['figurelib/admin/figurelib.php_056'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_limitation_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								), DB_FIGURE_LIMITATIONS, "figure_limitation_name", "figure_limitation_id", "figure_limitation_parent");	
// Text Field "Editions Size" //////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_057'] = "Edition Size";
									// ['figurelib/admin/figurelib.php_058'] = "Number of pieces (only numeric input possible)";
		echo form_text("figure_editionsize", $locale['figurelib/admin/figurelib.php_057'], $callback_data['figure_editionsize'],array(
									"inline" => TRUE,
									"width" => "520px",
									"min" => "1",
									"required" => FALSE,
									"placeholder" => $locale['figurelib/admin/figurelib.php_058'],
									"error_text" => $locale['figure_1816'],
									"type" => "number"
								));	
// Form "Space"  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";;	
// File Field "Images" /////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
				if ($figure_image != "") {
				echo "<td width='80' class='tbl' valign='top'>".$locale['book_588']."</td>\n<td class='tbl' valign='top'>\n";
				echo "<label><img src='".IMAGES_FIGURES.$figure_image."' alt='' /><br />\n";
				echo "<input type='checkbox' name='del_image' value='y' /> ".$locale['book_131']."</label>\n";
				echo "</td>\n</tr>\n<tr>\n";
			}
*/

									// ['figurelib/admin/figurelib.php_059'] = "Upload Image:";
		echo form_fileinput("figure_image[]", $locale['figurelib/admin/figurelib.php_059'], "", array(
									"inline" => TRUE,
									"template" => "modern",
									"multiple" => TRUE,
									"upload_path" => INFUSIONS."figurelib/figures/images/",
									"thumbnail_folder" => INFUSIONS."figurelib/figures/thumbs/",
									"thumbnail" => TRUE,
									"required" => FALSE,
									"max_byte" => $asettings['figure_photo_max_b'],
									"max_count" => 10
								));	
// Form "Space" /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";
// Text Area "Accessories" //////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_060'] = "Accessories";
		echo form_textarea("figure_accessories", $locale['figurelib/admin/figurelib.php_060'], $callback_data['figure_accessories'], array(
									"type" => fusion_get_settings("tinymce_enabled") ? "tinymce" : "html",
									"tinymce" => fusion_get_settings("tinymce_enabled") && iADMIN ? "advanced" : "simple",
									"autosize" => TRUE,
									"required" => FALSE,
									"form_name" => "submit_form",
								));	
// Text Area "Description" //////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_061'] = "Description";
		echo form_textarea("figure_description", $locale['figurelib/admin/figurelib.php_061'], $callback_data['figure_description'], array(
									"type" => fusion_get_settings("tinymce_enabled") ? "tinymce" : "html",
									"tinymce" => fusion_get_settings("tinymce_enabled") && iADMIN ? "advanced" : "simple",
									"autosize" => TRUE,
									"required" => FALSE,
									"form_name" => "submit_form",
								));
// Form "Space" /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<p>&nbsp;</p>\n";
									echo "</div>\n";
// Checkbox "Terms"  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_062'] = "I have read and agree to the terms and conditions.";
									// ['figurelib/admin/figurelib.php_063'] = "You must agree our terms and conditions.";
		echo form_checkbox("figure_agb", $locale['figurelib/admin/figurelib.php_062'], $callback_data['figure_agb'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"error_text" => $locale['figurelib/admin/figurelib.php_063']
								));
								
												
// ###################################################################################							
// ####### AB HIER ZUSÄTZLICHE EINTRÄGE NUR FÜR ADMINS ###############################	
// ###################################################################################	

	
echo "<div class='well clearfix'>\n";
echo "<strong>EXTENDET ADMIN AREA</strong><br>";
echo "</div>\n";

									
// Text URL figure_forum_url" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// $locale['figure_460'] = "Link to Forum";
	echo form_text("figure_forum_url", $locale['figure_460'], $submit_criteria['figure_forum_url'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"type" => "url",
									"placeholder" => ""
								));								
								
// Text URL Figure E-Shop Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_024'] = "Figure E-Shop Link";
	echo form_text("figure_eshop", $locale['figure_024'], $submit_criteria['figure_eshop'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Form "Space" /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";									
// Text  Amazon DE Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_025'] = "Amazon DE";
	echo form_text("figure_amazon_de", $locale['figure_025'], $submit_criteria['figure_amazon_de'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));									
// Text  Amazon UK Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_026'] = "Amazon UK";
	echo form_text("figure_amazon_uk", $locale['figure_026'], $submit_criteria['figure_amazon_uk'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));										
// Text  Amazon FR Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_027'] = "Amazon FR";
	echo form_text("figure_amazon_fr", $locale['figure_027'], $submit_criteria['figure_amazon_fr'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon ES Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_028'] = "Amazon ES";
	echo form_text("figure_amazon_es", $locale['figure_028'], $submit_criteria['figure_amazon_es'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon IT Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_029'] = "Amazon IT";
	echo form_text("figure_amazon_it", $locale['figure_029'], $submit_criteria['figure_amazon_it'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon JP Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_030'] = "Amazon JP";
	echo form_text("figure_amazon_jp", $locale['figure_030'], $submit_criteria['figure_amazon_jp'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon COM Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_031'] = "Amazon COM";
	echo form_text("figure_amazon_com", $locale['figure_031'], $submit_criteria['figure_amazon_com'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon CA Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_032'] = "Amazon CA";
	echo form_text("figure_amazon_ca", $locale['figure_032'], $submit_criteria['figure_amazon_ca'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));									
// Form "Space" /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";									
// Text Figure Affiliate Link 1" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_1", $locale['figure_023_1'], $submit_criteria['figure_affiliate_1'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 2" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_2", $locale['figure_023_2'], $submit_criteria['figure_affiliate_2'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 3" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_3", $locale['figure_023_3'], $submit_criteria['figure_affiliate_3'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 4" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_4", $locale['figure_023_4'], $submit_criteria['figure_affiliate_4'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 5" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_5", $locale['figure_023_5'], $submit_criteria['figure_affiliate_5'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 6" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_6", $locale['figure_023_6'], $submit_criteria['figure_affiliate_6'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));
// Text Figure Affiliate Link 7" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_7", $locale['figure_023_7'], $submit_criteria['figure_affiliate_7'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));									
// Text Figure Affiliate Link 8" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_8", $locale['figure_023_8'], $submit_criteria['figure_affiliate_8'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 9" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_9", $locale['figure_023_9'], $submit_criteria['figure_affiliate_9'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 10" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_10", $locale['figure_023_10'], $submit_criteria['figure_affiliate_10'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));									

// ###################################################################################							
// ####### ENDE ZUSÄTZLICHE EINTRÄGE NUR FÜR ADMINS ##################################	
// ###################################################################################							
	
			echo "</div>\n";
			echo "<div class='col-xs-12 col-sm-4'>\n";
			
			// ['figs_0008'] = "Update Publication Date";
			if ($figure_edit) echo form_checkbox("update_datestamp", $locale['figs_0008'], "");
					

			echo "</div>\n</div>\n";
			
			// ['figs_0011'] = "Publish Figure";
			echo form_button('publish', $locale['figs_0011'], $locale['figs_0011'], array("class"=>"btn-primary m-t-10 m-r-10"));
			
			// ['figs_0012'] = "Delete Submission";
			echo form_button("delete", $locale['figs_0012'], $locale['figs_0012'], array("class"=>"btn-default m-t-10"));
			
			echo closeform();
		}
	}
} else {
	$result = dbquery("SELECT
			ts.submit_id, ts.submit_datestamp, ts.submit_criteria, tu.user_id, tu.user_name, tu.user_avatar, tu.user_status
			FROM ".DB_SUBMISSIONS." ts
			LEFT JOIN ".DB_USERS." tu ON ts.submit_user=tu.user_id
			WHERE submit_type='f' order by submit_datestamp desc
			");
	$rows = dbrows($result);
	if ($rows > 0) {
		// ['figs_0021'] = "There are currently %s pending for your review.";
		echo "<div class='well'>".sprintf($locale['figs_0021'], format_word($rows, $locale['fmt_submission']))."</div>\n";
		echo "<table class='table table-striped'>\n";
		echo "<tr>\n";
		
		// ['figs_0013'] = "Submission Subject for Review";
		// ['cifg_0010'] = "Manufacturer";  --> NICHT AKTIV DA NICHT IM KLARTEXT
		// ['figs_0014'] = "Submission Author";
		// ['figs_0015'] = "Submission Time";
        // ['figs_0016'] = "Submission Id";
		
		echo "<th>".$locale['figs_0013']."</th>";
		//echo "<th>".$locale['cifg_0010']."</th>";
		echo "<th>".$locale['figs_0014']."</th>";
		echo "<th>".$locale['figs_0015']."</th>";
		echo "<th>".$locale['figs_0016']."</th>";
			
		echo "</tr>\n";
		echo "<tbody>\n";
		while ($data = dbarray($result)) {
			$submit_criteria = unserialize($data['submit_criteria']);
			
			
// ########################################################################################################	
/*
	// FOLDERS
if (!defined("FIGURES")) {
	define("FIGURES", INFUSIONS.$inf_folder."/figures/");
}
if (!defined("IMAGES_FIGURES")) {
	define("IMAGES_FIGURES", INFUSIONS.$inf_folder."/figures/images/");
}
if (!defined("THUMBS_FIGURES")) {
	define("THUMBS_FIGURES", INFUSIONS.$inf_folder."/figures/images/thumbs/");
}

		
			if (isset($_POST['del_image'])) {
				if (!empty($data['figure_image']) && file_exists(IMAGES_FIGURES.$data['figure_image'])) { unlink(IMAGES_FIGURES.$data['figure_image']); }
				$figure_image = "";
			} else {
				$figure_image = $data['figure_image'];
			}
// ########################################################################################################			
*/			
			echo "<tr>\n";
			echo "<td><a href='".clean_request("submit_id=".$data['submit_id'], array(
					"section",
					"aid"
				), TRUE)."'>".$submit_criteria['figure_title']."</a></td>\n";
								
			//echo "<td>".$submit_criteria['figure_manufacturer']."</td>\n";
			echo "<td>".profile_link($data['user_id'], $data['user_name'], $data['user_status'])."</td>\n";
			echo "<td>".timer($data['submit_datestamp'])."</td>\n";
			echo "<td>".$data['submit_id']."</td>\n";
			echo "</tr>\n";
		}
		echo "</tbody>\n</table>\n";
	} else {
		
		// ['figs_0017'] = "There are currently no Figure submisisons";
		echo "<div class='well text-center m-t-20'>".$locale['figs_0017']."</div>\n";
	}
}
