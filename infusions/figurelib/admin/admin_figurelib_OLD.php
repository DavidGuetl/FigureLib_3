<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: admin_figurelib.php based on admin/weblink.php
| Author: PHP-Fusion Development Team
|
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

// LANGUAGE
include INFUSIONS."figurelib/infusion_db.php";
include FIGURELIB_LOCALE;

if (file_exists(LOCALE.LOCALESET."admin/settings.php")) {
	include LOCALE.LOCALESET."admin/settings.php";
} else {
	include LOCALE."English/admin/settings.php";
}

$result = dbcount("(figure_cat_id)", DB_FIGURE_CATS);
if (!empty($result)) {
	$data = array(
			"figure_id" => 0,
			"figure_freigabe" => 0, 
			"figure_title" => "", 
			"figure_variant" => "", 
			"figure_manufacturer" => "",
			"figure_artists" => "", 
			"figure_country" => "", 
			"figure_brand" => "", 
			"figure_series" => "", 
			"figure_scale" => "",
			"figure_weight" => "", 
			"figure_height" => "", 
			"figure_width" => "", 
			"figure_depth" => "", 
			"figure_material" => "", 
			"figure_poa" => "", 
			"figure_packaging" => "", 
			"figure_retailprice" => "", 
			"figure_usedprice" => "", 
			"figure_limitation" => "",
			"figure_cat" => 0,
			"figure_editionsize" => "", 
			"figure_accessories" => "", 
			"figure_description" => "", 
			"figure_pubdate" => "", 
			"figure_agb" => "",
			"figure_datestamp" => time(),
			"figure_visibility" => iGUEST,
			"figure_submitter" => "",
			"figure_forum_url" => "",
			"figure_affiliate_1" => "",
			"figure_affiliate_2" => "",
			"figure_affiliate_3" => "",
			"figure_affiliate_4" => "",
			"figure_affiliate_5" => "",
			"figure_affiliate_6" => "",
			"figure_affiliate_7" => "",
			"figure_affiliate_8" => "",
			"figure_affiliate_9" => "",
			"figure_affiliate_10" => "",
			"figure_eshop" => "",
			"figure_amazon_de" => "",
			"figure_amazon_uk" => "",
			"figure_amazon_fr" => "",
			"figure_amazon_es" => "",
			"figure_amazon_it" => "",
			"figure_amazon_jp" => "",
			"figure_amazon_com" => "",
			"figure_amazon_ca" => "",
	);

	
	if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['figure_id']) && isnum($_GET['figure_id']))) {

        $result = dbquery("DELETE FROM ".DB_FIGURE_ITEMS." WHERE figure_id='".$_GET['figure_id']."'");
		
		// ['figurelib/admin/figurelib.php_001'] = "Figure deleted";
		addNotice("success", $locale['figurelib/admin/figurelib.php_001']);
		redirect(FUSION_SELF.$aidlink);
	}

	if (isset($_POST['save_figure'])) {
		$data = array(
			"figure_id" 		  => form_sanitizer($_POST['figure_id'],           0,  "figure_id"),
			"figure_datestamp"    => form_sanitizer($_POST['figure_datestamp'],    "", "figure_datestamp"),			
			"figure_freigabe"     => form_sanitizer($_POST['figure_freigabe'],     0,  "figure_freigabe"),
			"figure_title"        => form_sanitizer($_POST['figure_title'],        "", "figure_title"),
			"figure_variant"      => form_sanitizer($_POST['figure_variant'],      "", "figure_variant"),
			"figure_manufacturer" => form_sanitizer($_POST['figure_manufacturer'], "", "figure_manufacturer"),
			"figure_artists"      => form_sanitizer($_POST['figure_artists'],      "", "figure_artists"),
			"figure_country"      => form_sanitizer($_POST['figure_country'],      "", "figure_country"),
			"figure_brand"        => form_sanitizer($_POST['figure_brand'],        "", "figure_brand"),
			"figure_series"       => form_sanitizer($_POST['figure_series'],       "", "figure_series"),
			"figure_scale"        => form_sanitizer($_POST['figure_scale'],        "", "figure_scale"),
			"figure_weight"       => form_sanitizer($_POST['figure_weight'],       "", "figure_weight"),
			"figure_height"       => form_sanitizer($_POST['figure_height'],       "", "figure_height"),
			"figure_width"        => form_sanitizer($_POST['figure_width'],        "", "figure_width"),
			"figure_depth"        => form_sanitizer($_POST['figure_depth'],        "", "figure_depth"),
			"figure_material"     => form_sanitizer($_POST['figure_material'],     "", "figure_material"),
			"figure_poa"          => form_sanitizer($_POST['figure_poa'],          "", "figure_poa"),
			"figure_packaging"    => form_sanitizer($_POST['figure_packaging'],    "", "figure_packaging"),
			"figure_retailprice"  => form_sanitizer($_POST['figure_retailprice'],  "", "figure_retailprice"),
			"figure_usedprice"     => form_sanitizer($_POST['figure_usedprice'],    0, "figure_usedprice"),
			"figure_limitation"   => form_sanitizer($_POST['figure_limitation'],   "", "figure_limitation"),
			"figure_cat"          => form_sanitizer($_POST['figure_cat'],          "", "figure_cat"),
			"figure_editionsize"  => form_sanitizer($_POST['figure_editionsize'],  "", "figure_editionsize"),
			"figure_pubdate"      => form_sanitizer($_POST['figure_pubdate'],      "", "figure_pubdate"),
			"figure_agb"          => form_sanitizer($_POST['figure_agb'],          "",  "figure_agb"),
			"figure_submitter"    => form_sanitizer($_POST['figure_submitter'],    "",  "figure_submitter"), 
			"figure_visibility"   => form_sanitizer($_POST['figure_visibility'],   0,  "figure_visibility"), 
			"figure_forum_url"    => form_sanitizer($_POST['figure_forum_url'],    "", "figure_forum_url"), 
			"figure_affiliate_1"  => form_sanitizer($_POST['figure_affiliate_1'],  "", "figure_affiliate_1"),
			"figure_affiliate_2"  => form_sanitizer($_POST['figure_affiliate_2'],  "", "figure_affiliate_2"),
			"figure_affiliate_3"  => form_sanitizer($_POST['figure_affiliate_3'],  "", "figure_affiliate_3"),
			"figure_affiliate_4"  => form_sanitizer($_POST['figure_affiliate_4'],  "", "figure_affiliate_4"),
			"figure_affiliate_5"  => form_sanitizer($_POST['figure_affiliate_5'],  "", "figure_affiliate_5"),
			"figure_affiliate_6"  => form_sanitizer($_POST['figure_affiliate_6'],  "", "figure_affiliate_6"),
			"figure_affiliate_7"  => form_sanitizer($_POST['figure_affiliate_7'],  "", "figure_affiliate_7"),
			"figure_affiliate_8"  => form_sanitizer($_POST['figure_affiliate_8'],  "", "figure_affiliate_8"),
			"figure_affiliate_9"  => form_sanitizer($_POST['figure_affiliate_9'],  "", "figure_affiliate_9"),
			"figure_affiliate_10" => form_sanitizer($_POST['figure_affiliate_10'], "", "figure_affiliate_10"),
			"figure_eshop"        => form_sanitizer($_POST['figure_eshop'],        "", "figure_eshop"),
			"figure_amazon_de"    => form_sanitizer($_POST['figure_amazon_de'],    "", "figure_amazon_de"),
			"figure_amazon_uk"    => form_sanitizer($_POST['figure_amazon_uk'],    "", "figure_amazon_uk"),
			"figure_amazon_fr"    => form_sanitizer($_POST['figure_amazon_fr'],    "", "figure_amazon_fr"),
			"figure_amazon_es"    => form_sanitizer($_POST['figure_amazon_es'],    "", "figure_amazon_es"),
			"figure_amazon_it"    => form_sanitizer($_POST['figure_amazon_it'],    "", "figure_amazon_it"),
			"figure_amazon_jp"    => form_sanitizer($_POST['figure_amazon_jp'],    "", "figure_amazon_jp"),
			"figure_amazon_com"   => form_sanitizer($_POST['figure_amazon_com'],   "", "figure_amazon_com"),
			"figure_amazon_ca"    => form_sanitizer($_POST['figure_amazon_ca'],    "", "figure_amazon_ca"),				
			"figure_description"  => addslash(nl2br(parseubb(stripinput($_POST['figure_description'])))),
			"figure_accessories"  => addslash(nl2br(parseubb(stripinput($_POST['figure_accessories']))))
		);

        // upload your image here
        if (!empty($_FILES['figure_image']) && defender::safe()) {
            // To pair with the image into the database.
            $image_data = (array) form_sanitizer($_FILES['figure_image'], "", "figure_image");
            if (!empty($image_data)) {
                foreach($image_data as $image) {
                    $i_data = array(
                        "figure_images_image_id" => 0,
                        "figure_images_figure_id" => dblastid(),
                        "figure_images_image" => $image['image_name'],
                        "figure_images_thumb" => $image['thumb1_name'],
                        "figure_images_sorting" => "",
                        "figure_images_language" => LANGUAGE,
                    );
                    // Then insert the data.
                    dbquery_insert(DB_FIGURE_IMAGES, $i_data, "save");
                }
            }
        }

		if (defender::safe()) {
			if (dbcount("(figure_id)", DB_FIGURE_ITEMS, "figure_id='".intval($data['figure_id'])."'")) {
				$data['figure_datestamp'] = isset($_POST['update_datestamp']) ? time() : $data['figure_datestamp'];
				dbquery_insert(DB_FIGURE_ITEMS, $data, "update");
				// ['figurelib/admin/figurelib.php_002'] = "Figure updated";
				addNotice("success", $locale['figurelib/admin/figurelib.php_002']);
			} else {
				dbquery_insert(DB_FIGURE_ITEMS, $data, "save");
				// ['figurelib/admin/figurelib.php_003'] = "Figure added";
				addNotice("success", $locale['figurelib/admin/figurelib.php_002']);
			}

            //redirect(FUSION_SELF.$aidlink);
		}
	}
	if ($figure_edit) {
		$result = dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." WHERE figure_id='".intval($_GET['figure_id'])."'");
		if (dbrows($result)) {
			$data = dbarray($result);
		} else {
			redirect(FUSION_SELF.$aidlink);
		}
	}
	echo openform('inputform', 'post', FUSION_REQUEST, array("class" => "m-t-20", "enctype"=>true));
	echo "<div class='row'>\n";
	echo "<div class='col-xs-12 col-sm-8'>\n";

	echo form_hidden("figure_datestamp", "", $data['figure_datestamp']);
	echo form_hidden("figure_id", "", $data['figure_id']);
	echo form_hidden("figure_freigabe", "", $data['figure_freigabe']);
	echo form_hidden("figure_submitter", "", $userdata['user_id']);



// Select Field "Visibillity"  ////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_009'] = "Visibility:";
	echo form_select('figure_visibility', $locale['figurelib/admin/figurelib.php_009'], $data['figure_visibility'], array(
									"inline" => TRUE,
									"width" => "520px",
									'options' => fusion_get_groups()
								));								
// Checkbox "Figure Freigabe"  /////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_069'] = "Figure release on page";
		echo form_checkbox("figure_freigabe", $locale['figurelib/admin/figurelib.php_069'], $data['figure_freigabe'], array(
									"inline" => TRUE,
									"width" => "520px",
									"required" => FALSE
								));	
/*	alternative to checkbox .. here a select form							
								// ['figurelib/admin/figurelib.php_071'] = "HIDE this figure on page & panels.";
								// ['figurelib/admin/figurelib.php_072'] = "SHOW this figure on page & panels.";
		echo form_select('figure_freigabe', $locale['figurelib/admin/figurelib.php_069'], $data['figure_freigabe'], array(
									"inline" => TRUE, 
									"width" => "520px",
									"options" => array($locale['figurelib/admin/figurelib.php_071'], $locale['figurelib/admin/figurelib.php_072'])
								));
*/								
// Form "Space" ////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";			
// FIGUREN NAME (TITLE)////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_004'] = "Figure title";
									// ['figurelib/admin/figurelib.php_005'] = "Figure name";
									// ['figurelib/admin/figurelib.php_006'] = "Please enter a figure name";
	echo form_text('figure_title', $locale['figurelib/admin/figurelib.php_004'], $data['figure_title'], array(
									 "placeholder" => $locale['figurelib/admin/figurelib.php_005'],
									 "error_text" => $locale['figurelib/admin/figurelib.php_006'],
									 "inline" => TRUE,
									 "width" => "520px",
									 'required' => TRUE
								 ));
// Select Field "Kategorie" //////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_007'] = "Category:";	
									// ['figurelib/admin/figurelib.php_008'] = "Select a Category";
									// ['figurelib/admin/figurelib.php_070'] = "You must choose a Category.";
	echo form_select_tree("figure_cat", $locale['figurelib/admin/figurelib.php_007'], $data['figure_cat'], array(
									"inline" => TRUE,
									"required" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_008'],
									"error_text" => $locale['figurelib/admin/figurelib.php_070'],
									"no_root" => 1,
									"query" => (multilang_table("FI") ? "WHERE figure_cat_language='".LANGUAGE."'" : ""),
									"maxselect" => 1,
									"allowclear" => TRUE,
								), DB_FIGURE_CATS, "figure_cat_name", "figure_cat_id", "figure_cat_parent");																
// Text Field "Variant" //////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_010'] = "Variant";
									// ['figurelib/admin/figurelib.php_011'] = "Variant of this figure (e.g. --> black Version)";
	echo form_text("figure_variant", $locale['figurelib/admin/figurelib.php_010'], $data['figure_variant'],	array(
									"inline" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_011']
								));
// Select Field "Manufacturer" /////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_013'] = "Select a Manufacturer";
									// ['figurelib/admin/figurelib.php_014'] = "You must choose a Manufacturer.";
	echo form_select_tree("figure_manufacturer", $locale['figurelib/admin/figurelib.php_012'], $data['figure_manufacturer'], array(
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
	echo form_text("figure_artists", $locale['figurelib/admin/figurelib.php_015'], $data['figure_artists'],	array(
									"inline" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_016']
								));
// Text Field "Country" ///////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_017'] = "Country";
									// ['figurelib/admin/figurelib.php_018'] = "Country (e.g. --> USA / Japan / Unknown)";
	echo form_text("figure_country", $locale['figurelib/admin/figurelib.php_017'], $data['figure_country'], array(
									"inline" => TRUE,
									"width" => "520px",
									"placeholder" => $locale['figurelib/admin/figurelib.php_018']
								));	
// Select Field "Brand"  //////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_019'] = "Brand";
									// ['figurelib/admin/figurelib.php_020'] = "Select a Brand";
									// ['figurelib/admin/figurelib.php_021'] = "You must choose a Brand.";
	echo form_select_tree("figure_brand", $locale['figurelib/admin/figurelib.php_019'], $data['figure_brand'],	array(
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
// Text Field "Series" /////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_022'] = "Series";
									// ['figurelib/admin/figurelib.php_023'] = "Serie of this figure (e.g. --> NECA Series 7)";
	echo form_text("figure_series", $locale['figure_439'], $data['figure_series'],	array(
									"inline" => TRUE,
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
	echo form_select_tree("figure_scale", $locale['figurelib/admin/figurelib.php_024'], $data['figure_scale'], array(
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
// Text Field "Weight" ///////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_027'] = "Weight";
									// ['figurelib/admin/figurelib.php_028'] = "Weight of figure in Gramm or Kilogramm.";
		echo form_text("figure_weight", $locale['figurelib/admin/figurelib.php_027'], $data['figure_weight'],	array(
									"inline" => TRUE,
									"width" => "520px",
                                    "type" => "number",
									"placeholder" => $locale['figurelib/admin/figurelib.php_028']
								));	
// Select Field "Height" /////////////////////////////////////////////////////////////////////////////////////////////////////////
									//['figurelib/admin/figurelib.php_029'] = "Height";
									//['figurelib/admin/figurelib.php_030'] = "Select Height";
									//['figurelib/admin/figurelib.php_031'] = "You must choose a Height.";
		echo form_select_tree("figure_height", $locale['figurelib/admin/figurelib.php_029'], $data['figure_height'], array(
									"inline" => TRUE,
									"width" => "520px",
									"required" => TRUE,
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
		echo form_select_tree("figure_width", $locale['figurelib/admin/figurelib.php_032'], $data['figure_width'], array(
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
// Select Field "Depth" ////////////////////////////////////////////////////////////////////////////////////////////////////////
									//['figurelib/admin/figurelib.php_035'] = "Depth";
									//['figurelib/admin/figurelib.php_036'] = "Select Depth";
									//['figurelib/admin/figurelib.php_037'] = "You must choose a Depth.";
		echo form_select_tree("figure_depth", $locale['figurelib/admin/figurelib.php_035'], $data['figure_depth'], array(
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
// Select Field "Material" //////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_038'] = "Material";
									// ['figurelib/admin/figurelib.php_039'] = "Select a Material";
									// ['figurelib/admin/figurelib.php_040'] = "You must choose a Material.";
		echo form_select_tree("figure_material", $locale['figurelib/admin/figurelib.php_038'], $data['figure_material'], 	array(
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
// Select Field "POA" ///////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_041'] = "Articulation Pts.";
									// ['figurelib/admin/figurelib.php_042'] = "Select a Articulation Pts";
									// ['figurelib/admin/figurelib.php_043'] = "You must choose a Articulation Pts.";	
		echo form_select_tree("figure_poa", $locale['figurelib/admin/figurelib.php_041'], $data['figure_poa'], array(
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
		echo form_select_tree("figure_packaging", $locale['figurelib/admin/figurelib.php_044'], $data['figure_packaging'], array(
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
// Select Field "Pub Date" /////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_047'] = "Release Date";
									// ['figurelib/admin/figurelib.php_048'] = "Select a Year";
									// ['figurelib/admin/figurelib.php_049'] = "You must choose a Release Date.";
		echo form_select_tree("figure_pubdate", $locale['figurelib/admin/figurelib.php_047'], $data['figure_pubdate'], array(
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
// Text Field "Retail Price" ////////////////////////////////////////////////////////////////////////////////////////////////////////
								// ['figurelib/admin/figurelib.php_050'] = "Retail Price ($)";
								// ['figurelib/admin/figurelib.php_051'] = "Retail price in US$ (only numeric input possible)";					
		echo form_text("figure_retailprice", $locale['figurelib/admin/figurelib.php_050'], $data['figure_retailprice'], array(
									"inline" => TRUE,
									"width" => "520px",
									"min" => "0",
									"placeholder" => $locale['figurelib/admin/figurelib.php_051'],
									"type" => "number"
								));
// Text Field "Used Price" ///////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_052'] = "Used Price ($)";
									// ['figurelib/admin/figurelib.php_053'] = "Used price in US$ (only numeric input possible)";
		echo form_text("figure_usedprice", $locale['figurelib/admin/figurelib.php_052'], $data['figure_usedprice'],array(
									"inline" => TRUE,
									"width" => "520px",
									"min" => "0",
									"placeholder" => $locale['figurelib/admin/figurelib.php_053'],
									"type" => "number"
								));	
// Select Field "Limited Edition" //////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_054'] = "Limited Edition";
									// ['figurelib/admin/figurelib.php_055'] = "Select Limited Editon";
									// ['figurelib/admin/figurelib.php_056'] = "You must choose a Limited Edition.";		
		echo form_select_tree("figure_limitation", $locale['figurelib/admin/figurelib.php_054'], $data['figure_limitation'], 	array(
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
// Text Field "Editions Size" ////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_057'] = "Edition Size";
									// ['figurelib/admin/figurelib.php_058'] = "Number of pieces (only numeric input possible)";
		echo form_text("figure_editionsize", $locale['figurelib/admin/figurelib.php_057'], $data['figure_editionsize'],array(
									"inline" => TRUE,
									"width" => "520px",
									"min" => "1",
									"placeholder" => $locale['figurelib/admin/figurelib.php_058'],
									"type" => "number"
								));	
// Form "Space"  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";		
	
// File Field "Images" /////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_059'] = "Upload Image:";
		echo form_fileinput("figure_image[]", $locale['figurelib/admin/figurelib.php_059'], "", array(
									"inline" => TRUE,
									"template" => "modern",
									"multiple" => TRUE,
									"upload_path" => INFUSIONS."figurelib/figures/images/",
									"thumbnail_folder" => "thumbs/",
									"thumbnail" => TRUE,
									"required" => FALSE,
									"max_byte" => $asettings['figure_photo_max_b'],
									"max_count" => 10
								));
// Form "Space" //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						
								echo "<div class='tbl1'>\n";
										echo "<hr>\n";
									echo "</div>\n";	
// Text Area "Accessories" /////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_060'] = "Accessories";
		echo form_textarea("figure_accessories", $locale['figurelib/admin/figurelib.php_060'], $data['figure_accessories'], array(
									"type" => fusion_get_settings("tinymce_enabled") ? "tinymce" : "html",
									"tinymce" => fusion_get_settings("tinymce_enabled") && iADMIN ? "advanced" : "simple",
									"autosize" => TRUE,
									"required" => FALSE,
									"form_name" => "submit_form",
								));	
// Text Area "Description" //////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_061'] = "Description";
		echo form_textarea("figure_description", $locale['figurelib/admin/figurelib.php_061'], $data['figure_description'], array(
									"type" => fusion_get_settings("tinymce_enabled") ? "tinymce" : "html",
									"tinymce" => fusion_get_settings("tinymce_enabled") && iADMIN ? "advanced" : "simple",
									"autosize" => TRUE,
									"required" => FALSE,
									"form_name" => "submit_form",
								));
// Form "Space" /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<div class='tbl1'>\n";
										echo "<p>&nbsp;</p>\n";
									echo "</div>\n";
// Checkbox "Terms"  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figurelib/admin/figurelib.php_062'] = "I have read and agree to the terms and conditions.";
									// ['figurelib/admin/figurelib.php_063'] = "You must agree our terms and conditions.";
		echo form_checkbox("figure_agb", $locale['figurelib/admin/figurelib.php_062'], $data['figure_agb'], array(
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
	echo form_text("figure_forum_url", $locale['figure_460'], $data['figure_forum_url'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"type" => "url",
									"placeholder" => ""
								));								
								
// Text URL Figure E-Shop Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_024'] = "Figure E-Shop Link";
	echo form_text("figure_eshop", $locale['figure_024'], $data['figure_eshop'],	array(
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
	echo form_text("figure_amazon_de", $locale['figure_025'], $data['figure_amazon_de'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));									
// Text  Amazon UK Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_026'] = "Amazon UK";
	echo form_text("figure_amazon_uk", $locale['figure_026'], $data['figure_amazon_uk'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));										
// Text  Amazon FR Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_027'] = "Amazon FR";
	echo form_text("figure_amazon_fr", $locale['figure_027'], $data['figure_amazon_fr'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon ES Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_028'] = "Amazon ES";
	echo form_text("figure_amazon_es", $locale['figure_028'], $data['figure_amazon_es'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon IT Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_029'] = "Amazon IT";
	echo form_text("figure_amazon_it", $locale['figure_029'], $data['figure_amazon_it'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon JP Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_030'] = "Amazon JP";
	echo form_text("figure_amazon_jp", $locale['figure_030'], $data['figure_amazon_jp'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon COM Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_031'] = "Amazon COM";
	echo form_text("figure_amazon_com", $locale['figure_031'], $data['figure_amazon_com'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text  Amazon CA Link" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_032'] = "Amazon CA";
	echo form_text("figure_amazon_ca", $locale['figure_032'], $data['figure_amazon_ca'],	array(
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
	echo form_text("figure_affiliate_1", $locale['figure_023_1'], $data['figure_affiliate_1'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 2" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_2", $locale['figure_023_2'], $data['figure_affiliate_2'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 3" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_3", $locale['figure_023_3'], $data['figure_affiliate_3'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 4" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_4", $locale['figure_023_4'], $data['figure_affiliate_4'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 5" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_5", $locale['figure_023_5'], $data['figure_affiliate_5'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 6" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_6", $locale['figure_023_6'], $data['figure_affiliate_6'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));
// Text Figure Affiliate Link 7" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_7", $locale['figure_023_7'], $data['figure_affiliate_7'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));									
// Text Figure Affiliate Link 8" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_8", $locale['figure_023_8'], $data['figure_affiliate_8'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 9" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_9", $locale['figure_023_9'], $data['figure_affiliate_9'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));	
// Text Figure Affiliate Link 10" /////////////////////////////////////////////////////////////////////////////////////////////////////
									// ['figure_023'] = "Figure Affiliate Link";
	echo form_text("figure_affiliate_10", $locale['figure_023_10'], $data['figure_affiliate_10'],	array(
									"inline" => TRUE,
									"required" => FALSE,
									"width" => "520px",
									"placeholder" => ""
								));									

// ###################################################################################							
// ####### ENDE ZUSÄTZLICHE EINTRÄGE NUR FÜR ADMINS ##################################	
// ###################################################################################	
echo "</div>\n</div>\n";								

// Form Button  
// ['figurelib/admin/figurelib.php_064'] = "Save Figure";
echo form_button('save_figure', $locale['figurelib/admin/figurelib.php_064'], $locale['figurelib/admin/figurelib.php_064'], array('class' => 'btn-primary m-t-10'));
	
	echo closeform();
	
} else {
// ['figurelib/admin/figurelib.php_065'] = "There are no figure categories defined";
// ['figurelib/admin/figurelib.php_066'] = "You must define at least one category before you can add any figure";
	echo "<div class='text-center'>\n".$locale['figurelib/admin/figurelib.php_065']."<br />\n".$locale['figurelib/admin/figurelib.php_066']."<br />\n<br />\n";
	
	// ['figurelib/admin/figurelib.php_067'] = "Click here";
	// ['figurelib/admin/figurelib.php_068'] = " to go to Figures Categories";
	echo "<a href='".INFUSIONS."figurelib/admin.php".$aidlink."&amp;section=figurelib_categories'>".$locale['figurelib/admin/figurelib.php_067']."</a>".$locale['figurelib/admin/figurelib.php_068']."</div>\n";
}