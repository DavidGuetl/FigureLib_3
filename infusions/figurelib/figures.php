<?php

	//error_reporting(E_ALL);
	// Formularinhalte prüfen
	//echo "Formularinhalte prüfen:";
	//print_r ($_POST);
	//echo "<br>";
	// GET-Parameter prüfen
	//echo "GET-Parameter prüfen:";
	//print_r ($_GET);
	// Sessions prüfen
	//print_r ($_SESSION);
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: figures.php based on gallery.php
| Author: PHP-Fusion Development Team
| Co-Author: PHP-Fusion Development Team
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
require_once file_exists('maincore.php') ? 'maincore.php' : __DIR__."/../../maincore.php";
include INFUSIONS."figurelib/infusion_db.php";
require_once THEMES."templates/header.php";
require_once INCLUDES."infusions_include.php";
if (!db_exists(DB_FIGURE_ITEMS)) { redirect(BASEDIR."error.php?code=404"); }

// GET GLOBAL VARIABLES
global $aidlink;
global $settings;

// LANGUAGE
if (file_exists(INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php")) {
    include INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php";
} else {
    include INFUSIONS."figurelib/locale/English/locale_figurelib.php";
}

include INFUSIONS."figurelib/templates/template_render_figure.php"; // TEMPLATE FOR FIGURE OVERVIEW PER CATEGORY
include INFUSIONS."figurelib/templates/template_render_figure_cats.php"; // TEMPLATE FOR CATEGORIES OVERVIEW
include INFUSIONS."figurelib/templates/template_render_figure_items.php"; // TEMPLATE FOR DETAILS OF A FIGURE

// Get Settings
$fil_settings = get_settings("figurelib");

// Figure Cat Index
$figure_cat_index = dbquery_tree(DB_FIGURE_CATS, 'figure_cat_id', 'figure_cat_parent');

// Add Breadcrumb
add_breadcrumb(["link" => INFUSIONS."figurelib/figures.php", "title" => \PHPFusion\SiteLinks::get_current_SiteLinks("", "link_name")]);

// Display a Figure
if (
	isset($_GET['figure_id']) && 
	isnum($_GET['figure_id']) &&
	dbcount("(figure_id)", DB_FIGURE_ITEMS, "figure_id='".intval($_GET['figure_id'])."' AND figure_freigabe='1' AND ".groupaccess("figure_visibility")."")
) {
	
	// Comments and Ratings
	include INCLUDES."comments_include.php";
	include INCLUDES."ratings_include.php";

	// Update Counter
	dbquery("UPDATE ".DB_FIGURE_ITEMS." SET figure_clickcount=figure_clickcount+1 WHERE figure_id='".intval($_GET['figure_id'])."'");
	
	// Get Figure Title and Category ID
	@list(
		$_GET['figure_cat_id'],
		$figureTitle
	) = dbarraynum(dbquery("
		SELECT figure_cat, figure_title FROM ".DB_FIGURE_ITEMS." WHERE figure_id='".intval($_GET['figure_id'])."' AND figure_freigabe='1' AND ".groupaccess("figure_visibility")."
	"));
	
	// Add Sitetitle
	add_to_title($locale['INF_TITLE']);
	
	// Add Breadcrumbs
	figure_cat_breadcrumbs($figure_cat_index);
	add_breadcrumb(["link" => INFUSIONS."figurelib/figures.php?figure_id=".$_GET['figure_id'], "title" => trimlink($figureTitle, 20)]);
	
	// Add Sitetitle
	add_to_title(": ".$figureTitle);
    
	// Display Figure
	$info = array();
	$info['item'] = array();
	render_figure_items($info);	


// Display a Category
} elseif (
	isset($_GET['figure_cat_id']) && 
	isnum($_GET['figure_cat_id']) &&
	dbcount("(figure_cat_id)", DB_FIGURE_CATS, "figure_cat_id='".intval($_GET['figure_cat_id'])."'")
) {
	
	// Set Empty Arrays
	$info = array("figure_rows" => 0, "page_nav" => false);
	$info['item'] = array();

	// Get Figure Category Datas
	$cdata = dbarray(dbquery("
		SELECT
			figure_cat_id,
			figure_cat_name,
			figure_cat_sorting 
		FROM ".DB_FIGURE_CATS."
		WHERE figure_cat_id='".intval($_GET['figure_cat_id'])."'
	"));	

	// Merge Info Array with Category Data Array
	$info = array_merge($info, $cdata);
	
	// Add Sitetitle And Meta Description
	add_to_meta("description", $info['figure_cat_name']);
	add_to_title($locale['INF_TITLE']);
	
	// Add Breadcrumbs
	figure_cat_breadcrumbs($figure_cat_index);
	
	// Count all Figures
	$max_rows = dbcount("(figure_id)", DB_FIGURE_ITEMS, "figure_cat='".$info['figure_cat_id']."' AND figure_freigabe='1' AND ".groupaccess('figure_visibility'));
	
	// Check Rowstart
	$_GET['rowstart'] = isset($_GET['rowstart']) && isnum($_GET['rowstart']) && $_GET['rowstart'] <= $max_rows ? $_GET['rowstart'] : 0;
	
	// If there are Items, handle it.
	if ($max_rows) {
		
		// Get Figure Datas
		$result = dbquery("
			SELECT figure_id, 
				f.figure_title, 
				f.figure_freigabe,
				f.figure_description, 
				f.figure_datestamp, 
				f.figure_clickcount,
				f.figure_manufacturer,
				f.figure_submitter,
				f.figure_brand,
				f.figure_scale,
				f.figure_pubdate,
				f.figure_variant,
				f.figure_series,
				fm.figure_manufacturer_id,
				fm.figure_manufacturer_name,
				fb.figure_brand_id,
				fb.figure_brand_name,
				fs.figure_scale_id,
				fs.figure_scale_name,
				fy.figure_year_id,
				fy.figure_year,
				fu.user_id,
				fu.user_name,
				fu.user_status
			FROM ".DB_FIGURE_ITEMS." f
			INNER JOIN ".DB_USERS." fu ON f.figure_submitter=fu.user_id
			INNER JOIN ".DB_FIGURE_MANUFACTURERS." fm ON fm.figure_manufacturer_id = f.figure_manufacturer
			INNER JOIN ".DB_FIGURE_BRANDS." fb ON fb.figure_brand_id = f.figure_brand
			INNER JOIN ".DB_FIGURE_SCALES." fs ON fs.figure_scale_id = f.figure_scale
			INNER JOIN ".DB_FIGURE_YEARS." fy ON fy.figure_year_id = f.figure_pubdate	
			WHERE ".groupaccess('figure_visibility')." 
			AND figure_cat='".intval($_GET['figure_cat_id'])."' 
			AND figure_freigabe = '1'
			ORDER BY ".$cdata['figure_cat_sorting']." 
			LIMIT ".$_GET['rowstart'].",".$fil_settings['figure_per_page']
		);	
		
		// Count Items
		$info['figure_rows'] = dbrows($result);
		
		// Pagenav
		$info['page_nav'] = $max_rows > $fil_settings['figure_per_page'] ? makepagenav($_GET['rowstart'], $fil_settings['figure_per_page'], $max_rows, 3, INFUSIONS."figurelib/figures.php?figure_cat_id=".$info['figure_cat_id']."&amp;") : false;
		
		// Add Figure Informations into Array
		while ($data = dbarray($result)) {
			$data['new'] = ($data['figure_datestamp']+604800 > time()+($settings['timeoffset']*3600)) ? 1 : 0;
			$data['figure'] = array(
				'link' => INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id'],
				'name' => $data['figure_title'],
				'manufacturer' => $data['figure_manufacturer_name'],
				'scale' => $data['figure_scale_name'],
				'year' => $data['figure_year'],
				'brand' => $data['figure_brand_name'],
				'series' => $data['figure_series'],
				'variant' => $data['figure_variant'],
				'submitter' => $data['figure_submitter'],
				'views' => $data['figure_clickcount'],
				'userid' => $data['user_id'],
				'username' => $data['user_name'],
				'userstatus' => $data['user_status']				
			);
			$info['item'][$data['figure_id']] = $data;
		}
	}
		
	
	// Display
	render_figure($info);

	
// Display Index 
} else {
	
	// Add Sitetitle
	add_to_title($locale['INF_TITLE']);

	// Set empty Array
	$info['item'] = array();

	// Get Category Datas
    $result = dbquery("
		SELECT 
			f.figure_cat,
			f.figure_visibility,
			fc.figure_cat_id, 
			fc.figure_cat_name, 
			fc.figure_cat_description, 
			count(f.figure_id) 'figure_anzahl'
		FROM ".DB_FIGURE_CATS." fc
		LEFT JOIN ".DB_FIGURE_ITEMS." f on f.figure_cat = fc.figure_cat_id and ".groupaccess("figure_visibility")." AND figure_freigabe = '1'
		".(multilang_table("FI") ? "WHERE fc.figure_cat_language='".LANGUAGE."'" : "")."
		GROUP BY figure_cat_id
		ORDER BY figure_cat_name
	");

	// Add Rows to Array
    $info['figure_cat_rows'] = dbrows($result);

	// Add Categories to Array
    if ($info['figure_cat_rows']) {
		while ($data = dbarray($result)) {
			$data['figure_item'] = array(
				'link' => INFUSIONS."figurelib/figures.php?figure_cat_id=".$data['figure_cat_id'],
				'name' => $data['figure_cat_name']
			);
			$info['item'][$data['figure_cat_id']] = $data;
		}
	}
	
	// Display
	render_figure_cats($info);
	
}


require_once THEMES."templates/footer.php";

/**
 * FigureLib Category Breadcrumbs Generator
 * @param $forum_index
 */
function figure_cat_breadcrumbs($figure_cat_index) {
	global $locale;
	/* Make an infinity traverse */
	function breadcrumb_arrays($index, $id) {
		$crumb = & $crumb;
		if (isset($index[get_parent($index, $id)])) {
			$_name = dbarray(dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_parent FROM ".DB_FIGURE_CATS." WHERE figure_cat_id='".$id."'"));
			$crumb = array(
				'link' => INFUSIONS."figurelib/figures.php?figure_cat_id=".$_name['figure_cat_id'],
				'title' => $_name['figure_cat_name']
			);
			if (isset($index[get_parent($index, $id)])) {
				if (get_parent($index, $id) == 0) {
					return $crumb;
				}
				$crumb_1 = breadcrumb_arrays($index, get_parent($index, $id));
				$crumb = array_merge_recursive($crumb, $crumb_1); // convert so can comply to Fusion Tab API.
			}
		}
		return $crumb;
	}
	

	

	// then we make a infinity recursive function to loop/break it out.
	$crumb = breadcrumb_arrays($figure_cat_index, $_GET['figure_cat_id']);
	// then we sort in reverse.
	if (count($crumb['title']) > 1) {
		krsort($crumb['title']);
		krsort($crumb['link']);
	}
	if (count($crumb['title']) > 1) {
		foreach ($crumb['title'] as $i => $value) {
			add_breadcrumb(array('link' => $crumb['link'][$i], 'title' => $value));
			if ($i == count($crumb['title'])-1) {
				add_to_title($locale['global_201'].$value);
			}
		}
	} elseif (isset($crumb['title'])) {
		add_to_title($locale['global_201'].$crumb['title']);
		add_breadcrumb(array('link' => $crumb['link'], 'title' => $crumb['title']));
	}
}

