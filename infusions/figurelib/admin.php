<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: figurelib_admin based on weblinks_admin.php
| Author: PHP-Fusion Developer Team
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
require_once "../../maincore.php";
pageAccess("FI");
require_once THEMES."templates/admin_header.php";
require_once INCLUDES."html_buttons_include.php";
require_once INCLUDES."infusions_include.php";
include INFUSIONS."figurelib/infusion_db.php";

// LANGUAGE
if (file_exists(INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php")) {
	include INFUSIONS."figurelib/locale/".LOCALESET."locale_figurelib.php";
} else {
	include INFUSIONS."figurelib/locale/English/locale_figurelib.php";
}

if (file_exists(LOCALE.LOCALESET."admin/settings.php")) {
	include LOCALE.LOCALESET."admin/settings.php";
} else {
	include LOCALE."English/admin/settings.php";
}

add_breadcrumb(array(
				   'link' => INFUSIONS.'figurelib/admin.php'.$aidlink.'&amp;section=figurelib',
				   'title' => 'FigureLib Admin Area'
			   ));

// SETTINGS HOLEN
$fil_settings = get_settings("figurelib");

$allowed_pages = array(
	"figurelib_form",
	"figurelib_categories",
	"figurelib_manufacturers",
	"figurelib_brands",
	//"figurelib_materials",
	//"figurelib_scales",
	//"figurelib_poas",
	//"figurelib_packagings",
	//"figurelib_limitations",
	//"figurelib_measurements",
	//"figurelib_userfigures",
	//"figurelib_images",
	"figurelib_submissions",
	"figurelib_settings"		
);

$_GET['section'] = isset($_GET['section']) && in_array($_GET['section'], $allowed_pages) ? $_GET['section'] : 'figurelib';

$figure_edit = isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['figure_id']) && isnum($_GET['figure_id']) ? TRUE : FALSE;
$figureCat_edit = isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['cat_id']) && isnum($_GET['cat_id']) ? TRUE : FALSE;
$figureMan_edit = isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['man_id']) && isnum($_GET['man_id']) ? TRUE : FALSE;
$figureBrand_edit = isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['brand_id']) && isnum($_GET['brand_id']) ? TRUE : FALSE;

// TAB MENÜ OBERPUNKTE
		// ['filt_0003'] = "Current Figures";
		$master_title['title'][] = $locale['filt_0003']; 
		$master_title['id'][] = 'figurelib';
		$master_title['icon'] = '';

		// ['filt_0002'] = "Edit Figures";
		// ['filt_0001'] = "Add Figures";
		$master_title['title'][] = $figure_edit ? $locale['filt_0002'] : $locale['filt_0001']; 
		$master_title['id'][] = 'figurelib_form';
		$master_title['icon'] = '';

		// ['filt_0005'] = "Edit Figures Category";
		// ['filt_0004'] = "Figures Categories";
		$master_title['title'][] = $figureCat_edit ? $locale['filt_0005'] : $locale['filt_0004']; 
		$master_title['id'][] = 'figurelib_categories';
		$master_title['icon'] = '';
		
		// ['filt_0013'] = "Edit Figures Manufacturer";
		// ['filt_0014'] = "Figures Manufacturer";
		$master_title['title'][] = $figureMan_edit ? $locale['filt_0013'] : $locale['filt_0014']; 
		$master_title['id'][] = 'figurelib_manufacturers';
		$master_title['icon'] = '';
		
		// ['filt_0015'] = "Edit Figures Brand";
		// ['filt_0016'] = "Figure Brand";
		$master_title['title'][] = $figureBrand_edit ? $locale['filt_0015'] : $locale['filt_0016']; 
		$master_title['id'][] = 'figurelib_brands';
		$master_title['icon'] = '';

		// ['filt_0009'] = "Figure Submissions";
		$master_title['title'][] = $locale['filt_0009']; 
		$master_title['id'][] = 'figurelib_submissions';
		$master_title['icon'] = '';

		// ['filt_0010'] = "Settings";
		$master_title['title'][] = $locale['filt_0010']; 
		$master_title['id'][] = 'figurelib_settings';
		$master_title['icon'] = '';

$tab_active = $_GET['section'];

// ['filt_0011'] = "FigureLib Admin Area";
opentable($locale['filt_0011']); 

echo opentab($master_title, $tab_active, "figurelib_admin", 1);

switch ($_GET['section']) {
	
	case "figurelib_form":
		add_breadcrumb(array('link'=>"", 'title'=>$master_title['title'][1]));
		include "admin/admin_figurelib.php";
		break;
	case "figurelib_categories":
		add_breadcrumb(array('link'=>"", 'title'=>$master_title['title'][2]));
		include "admin/admin_figurelib_categories.php";
		break;	
	case "figurelib_manufacturers":
		add_breadcrumb(array('link'=>"", 'title'=>$locale['filt_0014'])); // ['filt_0014'] = "Figures Manufacturer";
		include "admin/admin_figurelib_manufacturers.php";
		break;		
	case "figurelib_brands":
		add_breadcrumb(array('link'=>"", 'title'=>$locale['filt_0016'])); // ['filt_0016'] = "Figure Brand";
		include "admin/admin_figurelib_brands.php";
		break;		
	case "figurelib_settings":
		add_breadcrumb(array('link'=>"", 'title'=>$locale['filt_0010'])); // ['filt_0010'] = "Settings";
		include "admin/admin_figurelib_settings.php";
		break;
	case "figurelib_submissions":
		add_breadcrumb(array('link'=>"", 'title'=>$locale['filt_0009'])); // ['filt_0009'] = "Figure Submissions";
		include "admin/admin_figurelib_submissions.php";
		break;
	default:
		figurelib_listing();
}

echo closetab();
closetable();
require_once THEMES."templates/footer.php";
/**
 * Figurelib Directory Listing
 */
function figurelib_listing() {
	global $aidlink, $locale;
	// do a filter here
	$limit = 15;
	$total_rows = dbcount("(figure_id)", DB_FIGURE_ITEMS);
	$rowstart = isset($_GET['rowstart']) && ($_GET['rowstart'] <= $total_rows) ? $_GET['rowstart'] : 0;
	// add a filter browser
	$catOpts = array(
		"all" => $locale['filt_0012'],
	); // ['filt_0012'] = "All Figures Entries";
	
	
	//////////////////////////////////
	$categories = dbquery("
			SELECT 
				figure_cat_id, 
				figure_cat_name 
			FROM ".DB_FIGURE_CATS." ".(multilang_table("FI") ? "
			WHERE figure_cat_language='".LANGUAGE."'" : "
		"));
	
	if (dbrows($categories) > 0) {
		while ($cat_data = dbarray($categories)) {
			$catOpts[$cat_data['figure_cat_id']] = $cat_data['figure_cat_name'];
		}
	}
	/////////////////////////////////////
	

	// prevent xss
	$catFilter = "";
	if (isset($_GET['filter_cid']) && isnum($_GET['filter_cid']) && isset($catOpts[$_GET['filter_cid']])) {
		if ($_GET['filter_cid'] > 0) {
			$catFilter = "WHERE ".(multilang_table("FI") ? "cat.figure_cat_language='".LANGUAGE."' and " : "")." figure_cat='".intval($_GET['filter_cid'])."'";
		}
	}	
	

$result = dbquery("
	SELECT f.*, 
			cat.figure_cat_id, 
			cat.figure_cat_name, 
			man.figure_manufacturer_name, 
			man.figure_manufacturer_id,  
			sca.figure_scale_name, 
			sca.figure_scale_id
	FROM ".DB_FIGURE_ITEMS." f
	LEFT JOIN ".DB_FIGURE_CATS." cat on cat.figure_cat_id = f.figure_cat
	INNER JOIN ".DB_FIGURE_MANUFACTURERS." man on man.figure_manufacturer_id = f.figure_manufacturer
	INNER JOIN ".DB_FIGURE_SCALES." sca on sca.figure_scale_id = f.figure_scale
	".$catFilter."
	ORDER by figure_title asc, figure_datestamp desc 
	LIMIT $rowstart, $limit
	");
	
	$rows = dbrows($result);

	if ($rows > 0) {
		echo "<div class='clearfix m-b-20'>\n";
		// ['figs_0002'] = "Currently displaying %d of %d total figure/s entries";
		echo "<span class='pull-right m-t-10'>".sprintf($locale['figs_0002'], $rows, $total_rows)."</span>\n";
		if (!empty($catOpts) > 0 && $total_rows > 0) {
			echo "<div class='pull-left m-t-10 m-r-10'>".$locale['cifg_0009']."</div>\n"; // ['cifg_0009'] = "Filter by:";
			echo "<div class='dropdown pull-left m-t-5 m-r-10' style='position:relative'>\n";
			echo "<a class='dropdown-toggle btn btn-default btn-sm' style='width: 200px;' data-toggle='dropdown'>\n<strong>\n";
			if (isset($_GET['filter_cid']) && isset($catOpts[$_GET['filter_cid']])) {
				echo $catOpts[$_GET['filter_cid']];
			} else {
				echo $locale['figf_0002']; // $locale['figf_0002'] = "Filter show category by";
			}
			echo " <span class='caret'></span></strong>\n</a>\n";
			echo "<ul class='dropdown-menu' style='max-height:180px; width:200px; overflow-y: auto'>\n";
			foreach ($catOpts as $catID => $catName) {
				$active = isset($_GET['filter_cid']) && $_GET['filter_cid'] == $catID ? TRUE : FALSE;
				echo "<li".($active ? " class='active'" : "").">\n<a class='text-smaller' href='".clean_request("filter_cid=".$catID, array(
						"section",
						"rowstart",
						"aid"
					), TRUE)."'>\n";
				echo $catName;
				echo "</a>\n</li>\n";
			}
			echo "</ul>\n";
			echo "</div>\n";
		}
		if ($total_rows > $rows) {
			echo makepagenav($rowstart, $limit, $total_rows, $limit, clean_request("", array(
										  "aid",
										  "section"
									  ), TRUE)."&amp;");
		}
		echo "</div>\n";

		echo "<table class='table table-responsive center'>\n<thead>\n";
		echo "<tr>\n";
		echo "<th class='col-xs-4'>".$locale['cifg_0000']."</th>\n"; 	// ['cifg_0000'] = "Figure Name/Title";
		echo "<th>".$locale['cifg_0004']."</th>\n";						// ['cifg_0004'] = "Figure Id";
		echo "<th>".$locale['cifg_0001']."</th>\n"; 					// ['cifg_0001'] = "Category";
		echo "<th>".$locale['cifg_0010']."</th>\n"; 					// ['cifg_0010'] = "Manufacturer";
		echo "<th>".$locale['cifg_0011']."</th>\n"; 					// ['cifg_0011'] = "Scale";
		echo "<th>".$locale['cifg_0008']."</th>\n"; 					// ['cifg_0008'] = "Figure Actions";
		echo "</tr>\n</thead>\n<tbody>\n";
		
		while ($data = dbarray($result)) {
			echo "<tr>\n";
			echo "<td>".$data['figure_title']."</td>\n"; 
			echo "<td>".$data['figure_id']."</td>\n";
			echo "<td>".$data['figure_cat_name']."</td>\n";
			echo "<td>".$data['figure_manufacturer_name']."</td>\n";
			echo "<td>".$data['figure_scale_name']."</td>\n";
		 		
			echo "<td>\n";
			echo "<div class='btn-group'>\n";
				
				// ['cifg_0005'] = "Edit";
			echo "<a class='btn btn-default btn-sm' href='".FUSION_SELF.$aidlink."&amp;section=figurelib_form&amp;action=edit&amp;figure_id=".$data['figure_id']."'>".$locale['cifg_0005']."</a>"; // // 
			
				
				// ['film_0004'] = "Delete this Figure?";
				// ['cifg_0006'] = "Delete";
			echo "<a class='btn btn-default btn-sm'  href='".FUSION_SELF.$aidlink."&amp;section=figurelib_form&amp;action=delete&amp;figure_id=".$data['figure_id']."&amp;figure_id=".$data['figure_id']."' onclick=\"return confirm('".$locale['film_0004']."');\">".$locale['cifg_0006']."</a>
			</div>\n</td>\n"; 
			echo "</tr>\n";
			
			
		}
		echo "</tbody>\n</table>\n";
	} else {
		// ['cifg_0007'] = "There are no figures defined";
		echo "<div class='well m-t-20 text-center'>\n".$locale['cifg_0007']."<br />"; 
	}
}