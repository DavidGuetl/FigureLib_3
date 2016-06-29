<?php

	//error_reporting(E_ALL);
	// Formularinhalte prüfen
	echo "Formularinhalte prüfen:";
	print_r ($_POST);
	echo "<br>";
	// GET-Parameter prüfen
	echo "GET-Parameter prüfen:";
	print_r ($_GET);
	// Sessions prüfen
	//print_r ($_SESSION);
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: gallery.php
| Author: PHP-Fusion Development Team
| Co-Author: PHP-Fusion Development Team
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

//include INFUSIONS."figurelib/templates/template_clickcounter.php"; // COUNTER FOR HOW MANY TIMES A FIGURE CLICKED
include INFUSIONS."figurelib/templates/template_render_figure.php"; // TEMPLATE FOR FIGURE OVERVIEW PER CATEGORY
include INFUSIONS."figurelib/templates/template_render_figure_cats.php"; // TEMPLATE FOR CATEGORIES OVERVIEW
include INFUSIONS."figurelib/templates/template_render_figure_items.php"; // TEMPLATE FOR DETAILS OF A FIGURE

// SETTINGS HOLEN
$fil_settings = get_settings("figurelib");

$figure_cat_index = dbquery_tree(DB_FIGURE_CATS, 'figure_cat_id', 'figure_cat_parent');
add_breadcrumb(array(
	'link' => INFUSIONS.'figurelib/figures.php', 
	'title' => \PHPFusion\SiteLinks::get_current_SiteLinks("", "link_name")));


if (!isset($_GET['figure_id']) || !isset($_GET['figure_cat_id'])) {
	set_title($locale['INF_TITLE']);
}

/* VIEW FIGURE */
if (isset($_GET['figure_id']) && isnum($_GET['figure_id'])) {
	include INCLUDES."comments_include.php";
	include INCLUDES."ratings_include.php";
	
	$res = 0;
	$data = dbarray(dbquery("SELECT * FROM ".DB_FIGURE_ITEMS." WHERE figure_id='".intval($_GET['figure_id'])."'"));

	if (checkgroup($data['figure_visibility'])) {
		$res = 1;

		dbquery("UPDATE ".DB_FIGURE_ITEMS." SET figure_clickcount=figure_clickcount+1 WHERE figure_id='".intval($_GET['figure_id'])."'");
 figure_cat_breadcrumbs($figure_cat_index);
		// alle Daten zur einzelnen Figur werden im template geholt - nicht hier !!!
       
	$info = array();
	$info['item'] = array();
	   render_figure_items($info);	

	} else {
        redirect(FUSION_SELF);
    }

/* ALLE FIGURES FROM A CATEGORY	*/
} else if (isset($_GET['cat_id']) && isnum($_GET['cat_id'])) {
	
	$info = array();
	$info['item'] = array();

	$result = dbquery("SELECT figure_cat_name, figure_cat_sorting FROM
	".DB_FIGURE_CATS." ".(multilang_table("FI") ? "WHERE figure_cat_language='".LANGUAGE."' AND" : "WHERE")." figure_cat_id='".intval($_GET['cat_id'])."'");

	if (dbrows($result) != 0) {
		$cdata = dbarray($result);
		$info = $cdata;
		add_to_title($locale['global_201'].$cdata['figure_cat_name']);
		figure_cat_breadcrumbs($figure_cat_index);
		add_to_meta("description", $cdata['figure_cat_name']);
		$max_rows = dbcount("(figure_id)", DB_FIGURE_ITEMS, "figure_cat='".$_GET['cat_id']."' AND ".groupaccess('figure_visibility'));
		$_GET['rowstart'] = isset($_GET['rowstart']) && isnum($_GET['rowstart']) && $_GET['rowstart'] <= $max_rows ? $_GET['rowstart'] : 0;
		if ($max_rows != 0) {

		$fil_settings = get_settings("figurelib");
		
		$result = dbquery("
				SELECT figure_id, 
					f.figure_title, 
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
				AND figure_cat='".intval($_GET['cat_id'])."' 
				ORDER BY ".$cdata['figure_cat_sorting']." 
				LIMIT ".$_GET['rowstart'].",".$fil_settings['figure_per_page']
				);	
		
			$numrows = dbrows($result);
			$info['figure_rows'] = $numrows;
			$fil_settings = get_settings("figurelib");
			$info['page_nav'] = $max_rows > $fil_settings['figure_per_page'] ? makepagenav($_GET['rowstart'], $fil_settings['figure_per_page'], $max_rows, 3, INFUSIONS."figurelib/figures.php?cat_id=".$_GET['cat_id']."&amp;") : 0;
			if (dbrows($result) > 0) {
				while ($data = dbarray($result)) {
					$data['new'] = ($data['figure_datestamp']+604800 > time()+($settings['timeoffset']*3600)) ? 1 : 0;
					$data['figure'] = array(
						'link' => INFUSIONS."figurelib/figures.php?cat_id=".$_GET['cat_id']."&amp;figure_id=".$data['figure_id'],
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
		}
        render_figure($info);
	} else {
		redirect(FUSION_SELF);
	}

} else {

/* MAIN INDEX */
	$info['item'] = array();

    $result = dbquery("
			SELECT 
				  fc.figure_cat_id, 
				  fc.figure_cat_name, 
				  fc.figure_cat_description, 
				  count(f.figure_id) 'figure_clickcount'
			FROM ".DB_FIGURE_CATS." fc
			LEFT JOIN ".DB_FIGURE_ITEMS." f on f.figure_cat = fc.figure_cat_id and ".groupaccess("f.figure_visibility")."
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
			$_name = dbarray(dbquery("SELECT figure_cat_id, figure_cat_name, figure_cat_parent FROM ".DB_FIGURE_CATS." WHERE figure_cat_id='".$id."'"));
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

