<?php
/*
	error_reporting(E_ALL);
	// Formularinhalte prüfen
	print_r ($_POST);
	// GET-Parameter prüfen
	print_r ($_GET);
	// Sessions prüfen
	print_r ($_SESSION);
*/
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: figures.php based on weblinks.php
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
require_once file_exists('maincore.php') ? 'maincore.php' : __DIR__."/../../maincore.php";
include INFUSIONS."figurelib/infusion_db.php";
require_once THEMES."templates/header.php";
require_once INCLUDES."infusions_include.php";
if (!db_exists(DB_FIGURE_ITEMS)) { redirect(BASEDIR."error.php?code=404"); }

// LANGUAGE
if (file_exists(INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php")) {
    include INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php";
} else {
    include INFUSIONS."figurelib/locale/English/locale_figurelib.php";
}

include INFUSIONS."figurelib/templates/template_clickcounter.php"; // COUNTER FOR HOW MANY TIMES A FIGURE CLICKED
include INFUSIONS."figurelib/templates/template_render_figure.php"; // TEMPLATE FOR FIGURE OVERVIEW PER CATEGORY
include INFUSIONS."figurelib/templates/template_render_figure_cats.php"; // TEMPLATE FOR CATEGORIES OVERVIEW
include INFUSIONS."figurelib/templates/template_render_figure_items.php"; // TEMPLATE FOR DETAILS OF A FIGURE

// SETTINGS HOLEN
$fil_settings = get_settings("figurelib");


$figure_cat_index = dbquery_tree(DB_FIGURE_CATS, 'figure_cat_id', 'figure_cat_parent');
add_breadcrumb(array('link' => INFUSIONS.'figurelib/figures.php', 'title' => \PHPFusion\SiteLinks::get_current_SiteLinks("", "link_name")));



if (!isset($_GET['figure_id']) || !isset($_GET['figure_cat_id'])) {
	set_title($locale['INF_TITLE']);
}
		


		
if (isset($_GET['figure_id']) && isnum($_GET['figure_id'])) {
	$res = 0;
		$data = dbarray(dbquery("SELECT * ".DB_FIGURE_ITEMS." WHERE figure_id='".intval($_GET['figure_id'])."'"));
	if (checkgroup($data['figure_visibility'])) {
	$res = 1;
		dbquery("UPDATE ".DB_FIGURE_ITEMS." SET figure_clickcount=figure_clickcount+1 WHERE figure_id='".intval($_GET['figure_id'])."'");
		
//+++++++++++++++++++

$result = dbquery(
			"SELECT tb.figure_id, tb.figure_submitter, tb.figure_clickcount, tb.figure_freigabe, tb.figure_pubdate, tb.figure_scale, tb.figure_title, tb.figure_manufacturer, tb.figure_brand, tb.figure_datestamp, tb.figure_cat, tbc.figure_cat_id, tbc.figure_cat_name, tbu.user_id, tbu.user_name, tbu.user_status, tbu.user_avatar, tbm.figure_manufacturer_name, tbb.figure_brand_name, tby.figure_year_id, tby.figure_year, tbs.figure_scale_id, tbs.figure_scale_name FROM ".DB_FIGURE_ITEMS." tb
			LEFT JOIN ".DB_USERS." tbu ON tb.figure_submitter=tbu.user_id
			INNER JOIN ".DB_FIGURE_CATS." tbc ON tb.figure_cat=tbc.figure_cat_id
			INNER JOIN ".DB_FIGURE_MANUFACTURERS." tbm ON tbm.figure_manufacturer_id = tb.figure_manufacturer
			INNER JOIN ".DB_FIGURE_BRANDS." tbb ON tbb.figure_brand_id = tb.figure_brand
			INNER JOIN ".DB_FIGURE_SCALES." tbs ON tbs.figure_scale_id = tb.figure_scale
			INNER JOIN ".DB_FIGURE_YEARS." tby ON tby.figure_year_id = tb.figure_pubdate
			".(multilang_table("FI") ? "WHERE figure_language='".LANGUAGE."' AND" : "WHERE")." tb.figure_freigabe='1' ORDER BY figure_id ASC");	
			
			if (dbrows($result) != 0) {
				while($data = dbarray($result)){
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
						'views' => $data['figure_clickcount']
					);
					$info['item'][$data['figure_id']] = $data;
				}
			}

        render_figure_items($info);
	} else {
		redirect(FUSION_SELF);
	}
//+++++++++++++++++++		
		

	
} elseif (isset($_GET['cat_id']) && isnum($_GET['cat_id'])) {	
	$info = array();
	$info['item'] = array();

	$result = dbquery("
		SELECT 
			figure_cat_id,
			figure_cat_name, 
			figure_cat_sorting 
		FROM ".DB_FIGURE_CATS." ".(multilang_table("FI") ? "WHERE figure_cat_language='".LANGUAGE."' AND" : "WHERE")." figure_cat_id='".intval($_GET['cat_id'])."'
	");

	if (dbrows($result) != 0) {
		$cdata = dbarray($result);
		$info = $cdata;
		add_to_title($locale['global_201'].$cdata['figure_cat_name']);
		figure_cat_breadcrumbs($figure_cat_index);
		add_to_meta("description", $cdata['figure_cat_name']);
		$max_rows = dbcount("(figure_id)", DB_FIGURE_ITEMS, "figure_cat='".$_GET['cat_id']."' AND ".groupaccess('figure_visibility'));
		$_GET['rowstart'] = isset($_GET['rowstart']) && isnum($_GET['rowstart']) && $_GET['rowstart'] <= $max_rows ? $_GET['rowstart'] : 0;		
		if ($max_rows != 0) {
				
				$result = dbquery(
					"SELECT tb.figure_id, 
							tb.figure_submitter, 
							tb.figure_freigabe, 
							tb.figure_pubdate, 
							tb.figure_scale, 
							tb.figure_title, 
							tb.figure_variant, 
							tb.figure_series, 
							tb.figure_manufacturer, 
							tb.figure_brand, 
							tb.figure_datestamp, 
							tb.figure_clickcount,
							tb.figure_cat, 
							tbc.figure_cat_id, 
							tbc.figure_cat_name, 
							tbu.user_id, 
							tbu.user_name, 
							tbu.user_status, 
							tbu.user_avatar, 
							tbm.figure_manufacturer_name, 
							tbb.figure_brand_name, 
							tby.figure_year_id, 
							tby.figure_year, 
							tbs.figure_scale_id, 
							tbs.figure_scale_name 
						FROM ".DB_FIGURE_ITEMS." tb
						LEFT JOIN ".DB_USERS." tbu ON tb.figure_submitter=tbu.user_id
						INNER JOIN ".DB_FIGURE_CATS." tbc ON tb.figure_cat=tbc.figure_cat_id
						INNER JOIN ".DB_FIGURE_MANUFACTURERS." tbm ON tbm.figure_manufacturer_id = tb.figure_manufacturer
						INNER JOIN ".DB_FIGURE_BRANDS." tbb ON tbb.figure_brand_id = tb.figure_brand
						INNER JOIN ".DB_FIGURE_SCALES." tbs ON tbs.figure_scale_id = tb.figure_scale
						INNER JOIN ".DB_FIGURE_YEARS." tby ON tby.figure_year_id = tb.figure_pubdate
					WHERE figure_freigabe = '1' 
					AND figure_cat='".intval($_GET['cat_id'])."' 
					ORDER BY ".$cdata['figure_cat_sorting']." 
					LIMIT ".$_GET['rowstart'].",".$fil_settings['figure_per_page']
				);	

			
			$numrows = dbrows($result);
			$info['figure_rows'] = $numrows;
			$info['page_nav'] = $max_rows > $fil_settings['figure_per_page'] ? makepagenav($_GET['rowstart'], $fil_settings['figure_per_page'], $max_rows, 3, INFUSIONS."figurelib/figures.php?cat_id=".$_GET['cat_id']."&amp;") : 0;
			
			if (dbrows($result) > 0) {
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
						'views' => $data['figure_clickcount']
					);
					$info['item'][$data['figure_id']] = $data;
				}
			}
		}
        render_figure($info);
	} else {
		redirect(FUSION_SELF);
	}
} else {

			//////////////////////////////////////////////////////////////////////
			//////////  ÜBERSICHT ALLER KATEGORIEN  //////////////////////////////
			//////////////////////////////////////////////////////////////////////

	$info['item'] = array();

    $result = dbquery("
		SELECT 
			fc.figure_cat_id, 
			fc.figure_cat_name, 
			fc.figure_cat_description, 
		count(f.figure_id) 'figure_clickcount'
		FROM ".DB_FIGURE_CATS." fc
		LEFT JOIN ".DB_FIGURE_ITEMS." f on f.figure_cat = fc.figure_cat_id and figure_freigabe = '1'
		".(multilang_table("FI") ? "WHERE fc.figure_cat_language='".LANGUAGE."'" : "")."
		GROUP BY fc.figure_cat_id
		ORDER BY figure_cat_name
	");

    $rows = dbrows($result);

    $info['figure_cat_rows'] = $rows;

    if ($rows != 0) {
		while ($data = dbarray($result)) {
			$data['figure_item'] = array(
				'link' => INFUSIONS."figurelib/figures.php?cat_id=".$data['figure_cat_id'],
				'name' => $data['figure_cat_name']
			);
			$info['item'][$data['figure_cat_id']] = $data;
		}
	}
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
			$_name = dbarray(dbquery("
				SELECT 
					figure_cat_id, 
					figure_cat_name, 
					figure_cat_parent 
				FROM ".DB_FIGURE_CATS." 
				WHERE figure_cat_id='".$id."'
			"));
			
			$crumb = array(
				'link' => INFUSIONS."figurelib/figures.php?cat_id=".$_name['figure_cat_id'],
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
	$crumb = breadcrumb_arrays($figure_cat_index, $_GET['cat_id']);
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


