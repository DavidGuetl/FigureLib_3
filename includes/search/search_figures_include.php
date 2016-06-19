<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename:  search_figure_include.php based on search_books_include.php
| Author: Robert Gaudyn (Wooya)
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

include INFUSIONS."figurelib/infusion_db.php";
include LOCALE.LOCALESET."search/books.php";

if ($_GET['stype'] == "figurelib" || $_GET['stype'] == "all") {
	if ($_GET['sort'] == "datestamp") {
		$sortby = "figure_datestamp";
	} else if ($_GET['sort'] == "subject") {
		$sortby = "figure_title";
	} else {
		$sortby = "figure_datestamp";
	}
	$ssubject = search_querylike("figure_title");
	$smessage = search_querylike("figure_description");
	if ($_GET['fields'] == 0) {
		$fieldsvar = search_fieldsvar($ssubject);
	} else if ($_GET['fields'] == 1) {
		$fieldsvar = search_fieldsvar($smessage);
	} else if ($_GET['fields'] == 2) {
		$fieldsvar = search_fieldsvar($ssubject, $smessage);
	} else {
		$fieldsvar = "";
	}
	if ($fieldsvar) {
		$result = dbquery(
			"SELECT td.*,tdc.* FROM ".DB_FIGURE_ITEMS." td
			INNER JOIN ".DB_FIGURE_CATS." tdc ON td.figure_cat=tdc.figure_cat_id
			WHERE ".$fieldsvar."
			".($_GET['datelimit'] != 0 ? " AND figure_datestamp>=".(time() - $_GET['datelimit']):"")
		);
		$rows = dbrows($result);
	} else {
		$rows = 0;
	}
	if ($rows != 0) {
		$items_count .= THEME_BULLET."&nbsp;<a href='".FUSION_SELF."?stype=figurelib&amp;stext=".$_GET['stext']."&amp;".$composevars."'>".$locale['b401'].$rows."</a><br />\n";
		$result = dbquery(
			"SELECT td.*,tdc.* FROM ".DB_FIGURE_ITEMS." td
			INNER JOIN ".DB_FIGURE_CATS." tdc ON td.figure_cat=tdc.figure_cat_id
			WHERE ".$fieldsvar."
			".($_GET['datelimit'] != 0 ? " AND figure_datestamp>=".(time() - $_GET['datelimit']):"")."
			ORDER BY ".$sortby." ".($_GET['order'] == 1 ? "ASC" : "DESC").($_GET['stype'] != "all" ? " LIMIT ".$_GET['rowstart'].",10" : "")
		);
		while ($data = dbarray($result)) {
			$search_result = "";
			if ($data['figure_datestamp']+604800 > time()+($settings['timeoffset']*3600)) {
				$new = " <span class='small'>".$locale['b403']."</span>";
			} else {
				$new = "";
			}
			$text_all = $data['figure_description'];
			$text_all = search_striphtmlbbcodes($text_all);
			$text_frag = search_textfrag($text_all);
			$subj_c = search_stringscount($data['figure_title']);
			$text_c = search_stringscount($data['figure_description']);
			$text_frag = highlight_words($swords, $text_frag);
			$search_result .= "[".$data['figure_cat_name']."] <a href='".INFUSIONS.$inf_folder."/figurelib.php?figure_id=".$data['figure_id']."' target='_blank'>".highlight_words($swords, $data['figure_title'])."</a> $new"."<br /><br />\n";
			if ($text_frag != "") $search_result .= "<div class='quote' style='width:auto;height:auto;overflow:auto'>".$text_frag."</div><br />";
			$search_result .= "<span class='small'><span class='alt'>".$locale['b404']."</span> ".($data['figure_submitter'] ? $data['figure_submitter'] : "");
			$searchfiguresult .= ($data['figure_manufacturer'] ? " |\n<span class='alt'>".$locale['b405']."</span> ".$data['figure_manufacturer'] : "");
			$search_result .= ($data['figure_pubdate'] ? " |\n<span class='alt'>".$locale['b406']."</span> ".$data['figure_pubdate'] : "")."<br />\n";
			$search_result .= "<span class='alt'>".$locale['b407']."</span> ".showdate("%d.%m.%y", $data['figure_datestamp'])." |\n";
			$search_result .= "<span class='alt'>".$locale['b408']."</span> ".$data['figure_clickcount']."</span><br /><br />\n";
			search_globalarray($search_result);
		}
	} else {
		$items_count .= THEME_BULLET."&nbsp;".$locale['b402']."<br />\n";
	}
	$navigation_result = search_navigation($rows);
}
?>