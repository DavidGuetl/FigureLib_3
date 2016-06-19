<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: templates/figurelib.php based on templates/weblinks.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
include INFUSIONS."figurelib/infusion_db.php";


if (!function_exists('render_figure_item')) {
	function render_figure_item($info) {
		global $locale, $userdata;
		opentable($locale['450']);
				
		echo render_breadcrumbs();
		//echo "<!--pre_figure-->";
	if ($info['figure_rows']) {
		foreach($info['item'] as $figure_id => $data) {	
				
		echo "<div class='panel panel-default'>\n";
			echo "<div class='panel-heading'>\n";
				echo "<a href='".$data['figure']['link']."'>".$data['figure']['name']."</a>\n";
		echo "</div>\n";
				
		//echo "<div class='overflow-hide m-b-20'>\n";
		//echo "<h2 class='figure_title'>".$data['figure_title']."</span>\n</h2>\n";
		//echo "</div>\n";
	   
		echo "<div class='list-group-item m-b-20'>\n";
		echo "<div class='row'>\n";
		
		// ANSICHT
		// VARIANTE  :::::::::::::::::: POSTED BY
		// MANUFACTURER  :::::::::::::: POST DATE
		// BRAND :::::::::::::::::::::: VIEWS (clickcount)
		// SERIE :::::::::::::::::::::: USER HABEN DIESE FIGUR		
		// SCALE :::::::::::::::::::::: COMMENTS
		// YEAR	::::::::::::::::::::::: RATING

		 echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>\n";
	
			if ($data['figure']['variant']) {
				echo "<span class='small'><strong>Variant: </strong>".$data['figure']['variant']."<br/></span>\n";
				} else {
				echo "<span class='small'><strong>Variant: </strong>... missing data ...<br></span>";
				}			
			echo "<span class='small'><strong>Manufacturer: </strong>".$data['figure']['manufacturer']."<br/></span>\n";
			echo "<span class='small'><strong>Brand: </strong>".$data['figure']['brand']."<br/></span>\n";
			echo "<span class='small'><strong>Scale: </strong>".$data['figure']['scale']."<br/></span>\n";
			echo "<span class='small'><strong>Release: </strong>".$data['figure']['year']."<br/></span>\n";
			if ($data['figure']['series']) {
				echo "<span class='small'><strong>Series: </strong>".$data['figure']['series']."<br/></span>\n";
				} else {
				echo "<span class='small'><strong>Series: </strong> ... missing data ...</span>";
				}
	
	echo "</div><div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>\n";
	
		// ANSICHT
		// VARIANTE  :::::::::::::::::: POSTED BY
		// MANUFACTURER  :::::::::::::: POST DATE
		// BRAND :::::::::::::::::::::: VIEWS (clickcount)
		// SERIE :::::::::::::::::::::: USER HABEN DIESE FIGUR		
		// SCALE :::::::::::::::::::::: COMMENTS
		// YEAR	::::::::::::::::::::::: RATING
		
			echo "<span class='small'><strong>Submitted by: </strong>".profile_link($data['user_id'], $data['user_name'], $data['user_status'])."<br/></span>\n";
			echo "<span class='small'><strong>Submitted on: </strong>".timer($data['figure_datestamp'])." - ".showdate("shortdate", $data['figure_datestamp'])."<br/></span>\n";
			echo "<span class='small'><strong>Views: </strong>".$data['figure']['views']."<br/></span>\n";
			echo "<span class='small'><strong>User Count: </strong>Variable  hier einbauen<br/></span>\n";
			
			$comments = dbcount("(comment_id)", DB_COMMENTS, "comment_type='FI' AND comment_item_id='".$data['figure_id']."'");
			echo "<span class='small'><strong>Comments: </strong>".$comments."<br/></span>\n";
			// Bewertung
				$drating = dbarray(dbquery("
					 SELECT 
						SUM(rating_vote) sum_rating, 
							COUNT(rating_item_id) count_votes 
							FROM ".DB_RATINGS." 
							WHERE rating_type='FI' 
							AND  rating_item_id='".$data['figure_id']."'
						")); 
				$rating = ($drating['count_votes'] > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/starsmall.png'>",ceil($drating['sum_rating']/$drating['count_votes'])) : "-");
			echo "<span class='small'><strong>Rating: </strong>".$rating."</span>\n";

		echo "<div class='clearfix'>\n";
		echo "<div class='btn-group pull-right m-t-20'>\n";
		echo isset($data['nav']['first']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['first']['link']."' title='".$data['nav']['first']['name']."'><i class='entypo to-start'></i></a>\n" : '';
		echo isset($data['nav']['prev']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['prev']['link']."' title='".$data['nav']['prev']['name']."'><i class='entypo left-dir'></i></a>\n" : '';
		echo isset($data['nav']['next']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['next']['link']."' title='".$data['nav']['next']['name']."'><i class='entypo right-dir'></i></a>\n" : '';
		echo isset($data['nav']['last']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['last']['link']."' title='".$data['nav']['last']['name']."'><i class='entypo to-end'></i></a>\n" : '';
		echo "</div>\n";		
			
			
		echo "</div>\n</div>\n";
		echo "</div>\n</div>\n";
			echo "</div>\n";
		closetable();
	}
}
}
}



/*
	if (!function_exists('render_figure_item')) {
		function render_figure_item($info) {
		global $locale;
		echo render_breadcrumbs();
		
		//opentable($locale['400'].": ".$info['figure_cat_name']);
/*		
		// SUBMENÜ mit LINK zu Categories 	Submit 	Last Entries 	Admin
				echo "<table cellpadding='0' cellspacing='1' class='breadcrumb' style='text-align:center;width:100%; margin-bottom: 4px;'>";
				echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup><tr>\n";
				// ['LFP_009']= "Categories";
				echo "<td align='center' class='tbl2'><a href='".INFUSIONS."figurelib/figures.php'><strong>".$locale['LFP_009']."</strong></a></td>\n";
				// ['LFP_010']= "Submit";
				echo "<td align='center' class='tbl2'><a href='".INFUSIONS."figurelib/submit.php'><strong>".$locale['LFP_010']."</strong></a></td>\n";
				// ['CLFP_013']= "Last Entries";
				echo "<td align='center' class='tbl2'><a href='".BASEDIR."home.php'><strong>".$locale['CLFP_013']."</strong></a></td>\n";
				// ['LFP_012']= "Admin";
				echo "<td align='center' class='tbl2'><a href='".INFUSIONS.'figurelib/admin.php'.$aidlink."'><strong>".$locale['LFP_012']."</strong></a></td>\n";
				echo "</tr></table>";

		
	if ($info['figure_rows']) {
		foreach($info['item'] as $figure_id => $data) {
				$new = $data['new'] == 1 ? "<span class='label label-success m-r-10' style='padding:3px 10px;'>".$locale['new']."</span>" : '';
				
				echo "<aside class='display-inline-block m-t-20' style='width:100%;'>\n";				

			// AB HIER ANSISCHT GALLERIE ODER TABELLEN FORM //
			$fil_settings = get_settings("figurelib"); 
			if ($fil_settings['figure_display']) {	
			
				
				// GALLERIEANSICHT   

				$counter = 1;
				
				echo "<td>";
				echo "<span class=''><a href='".$data['figure']['link']."' target='_blank'><strong>".$data['figure']['name']."</strong></a></span>";			
				// Manufacturer
				echo "<span class='small'>".$locale['LFP_003'].": ".$data['figure']['manufacturer']."</strong></span>";
				// DATE ADDED 
				echo "<span class='small'>".$locale['figure_414']." : ".showdate("shortdate", $data['figure_datestamp'])."";											
				// RATING
				$drating = dbarray(dbquery("SELECT SUM(rating_vote) sum_rating, COUNT(rating_item_id) count_votes FROM ".DB_RATINGS." WHERE rating_item_id='".$data['figure_id']."' AND rating_type='FI'"));
				$num_votes = $drating['count_votes'];
				$rating = ($num_votes > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/star.png'>",ceil($drating['sum_rating']/$num_votes)) : "-");
				echo $locale['figure_418'].": ".$rating."";				
				// KOMMENTARE
				$comments = dbcount("(comment_id)", DB_COMMENTS, "comment_type='FI' AND comment_item_id='".$data['figure_id']."'");
				echo $locale['figure_420'].": ".$comments."";					
				// KLICKCOUNT = VIEWS
				echo $locale['clickcount'].": ".$data['figure_clickcount']."</span>";

				echo "</td>\n";
				echo ($counter % 2 == 0 ? "&#160;" : "");
				$counter++;
				

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
										
			} else {
				
//TABELLENANSICHT 
					
				// MENÜZEILE GANZ OBEN IN DER ÜBERSICHT ALLER FIGUREN
				//opentable($locale['INF_ADMIN'].": ".$info['figure_cat_name']);
				echo "<table cellpadding='0' cellspacing='1' class='tbl-border' style='text-align:left;width:100%; margin-bottom: 4px;'>";
				echo "<colgroup>";
				echo "<col width='10%'><col width='20%'><col width='20%'><col width='20%'><col width='10%'><col width='10%'><col width='10%'>";
				echo "</colgroup>";
				echo "<tr class='breadcrumb'>";
				echo "<td><strong>Image</strong></td>";					   //               Bild
				echo "<td><strong>".$locale['LFP_002']."</strong></td>";   // ['LFP_002']= "Name";
				echo "<td><strong>".$locale['LFP_003']."</strong></td>";   // ['LFP_003']= "Manufacturer";;
				echo "<td><strong>".$locale['LFP_004']."</strong></td>";   // ['LFP_004']= "Brand";
				echo "<td><strong>".$locale['LFP_005']."</strong></td>";   // ['LFP_005']= "Scale";
				echo "<td><strong>".$locale['LFP_006']."</strong></td>";   // ['LFP_006']= "Year";
				echo "<td><strong>".$locale['LFP_008']."</strong></td>";   // ['LFP_008']= "Rating";
				echo "</tr></table>";	
					
				echo "<table cellpadding='0' cellspacing='1' class='tbl-border' style='text-align:left;width:100%; margin-bottom: 4px;'>";
				echo "<colgroup>";
				echo "<col width='10%'><col width='20%'><col width='20%'><col width='20%'><col width='10%'><col width='10%'><col width='10%'>";
				echo "</colgroup>";
				echo "<tr class='tbl2'>";
				echo "<td class='side-small'>Image</td>";									 			// Bild
				echo "<td class='side-small'>".$data['figure_title']."&nbsp;".$new."</td>";   			// Name
				echo "<td class='side-small'>".trimlink($data['figure_manufacturer_name'],18)."</td>";  // Manufacturer
				echo "<td class='side-small'>".trimlink($data['figure_brand_name'],18)."</td>";   	    // Brand
				echo "<td class='side-small'>".trimlink($data['figure_scale_name'],7)."</td>";   	    // Scale
				echo "<td class='side-small'>".trimlink($data['figure_year'],5)."</td>";   				// Year
				// Bewertung
				$drating = dbarray(dbquery("
				SELECT SUM(rating_vote) sum_rating,	COUNT(rating_item_id) count_votes 
				FROM ".DB_RATINGS." 
							WHERE rating_type='FI' AND  rating_item_id='".$data['figure_id']."'	")); 
				$rating = ($drating['count_votes'] > 0 ? str_repeat("<img src='".INFUSIONS.$inf_folder."/images/starsmall.png'>",ceil($drating['sum_rating']/$drating['count_votes'])) : "-");
				echo "<td><strong>".$rating."</strong></td>";   						 				// Rating";
				echo "</tr></table>";
			}	
//////////////////////////////////////////////////////////////////////////////////////////////////	
							
				echo $new;			
				echo "</aside>\n";
			}			
					
				// ANZEIGE DER NAVIGATION UNTER DEN FIGUREN WENN SEITENUMBRUCH
				echo $info['page_nav'] ? "<div class='text-right' align='center'>".$info['page_nav']."</div>" : '';
					
			} 	else {
				// ['figc_0017'] = "No Figures have been added to this Category";
				echo "<div class='well text-center'>".$locale['figc_0017']."</div>\n";
			}
			closetable();
		}
	}
/////////////FUNKTION ENDE ///////////////////////////////////////////////////////////////////////////



// ALTERNAIVE ZU OBEN GEHT

if (!function_exists('render_figure_item')) {
	function render_figure_item($info) {
		global $locale;
		echo render_breadcrumbs();
		
		// ['cifg_0009'] = "Filter by:";
		opentable($locale['cifg_0009']);
		if ($info['figure_rows'] != 0) {
			$counter = 0;
			$columns = 2;
			echo "<div class='row m-0'>\n";
			if (!empty($info['item'])) {
				foreach($info['item'] as $figure_id => $data) {
					if ($counter != 0 && ($counter%$columns == 0)) {
						echo "</div>\n<div class='row m-0'>\n";
					}
					echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 p-t-20'>\n";

					echo "<div class='media'>\n";
					echo "<div class='pull-left'><i class='entypo folder mid-opacity icon-sm'></i></div>\n";
					echo "<div class='media-body overflow-hide'>\n";
					echo "<div class='media-heading strong'><a href='".$data['figure']['link']."'>".$data['figure']['name']."</a> <span class='small'>".$data['figure_clickcount']."</span></div>\n";
					echo "<br><span class=''><strong>Manufacturer: </strong>".$data['figure']['manufacturer']."</span>\n";
					echo "<br><span class=''><strong>Scale: </strong>".$data['figure']['scale']."</span>\n";
					echo "<br><span class=''><strong>Release: </strong>".$data['figure']['year']."</span>\n";
					
					if ($data['figure_cat_description'] != "") {
						echo "<span>".$data['figure_cat_description']."</span>";
					}
					echo "</div>\n</div>\n";
					echo "</div>\n";
					$counter++;
				}
			}
			echo "</div>\n";
		} else {
			// ['figc_0012'] = "No figure categories defined";
			echo "<div style='text-align:center'><br />\n".$locale['figc_0012']."<br /><br />\n</div>\n";
		}
		closetable();
	}
}
*/




if (!function_exists('render_figure_cat')) {
	function render_figure_cat($info) {
		global $locale;
		echo render_breadcrumbs();
		
		// ['cifg_0009'] = "Filter by:";
		opentable($locale['cifg_0009']);
		if ($info['figure_cat_rows'] != 0) {
			$counter = 0;
			$columns = 2;
			echo "<div class='row m-0'>\n";
			if (!empty($info['item'])) {
				foreach($info['item'] as $figure_cat_id => $data) {
					if ($counter != 0 && ($counter%$columns == 0)) {
						echo "</div>\n<div class='row m-0'>\n";
					}
					echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 p-t-20'>\n";

					echo "<div class='media'>\n";
					echo "<div class='pull-left'><i class='entypo folder mid-opacity icon-sm'></i></div>\n";
					echo "<div class='media-body overflow-hide'>\n";
					echo "<div class='media-heading strong'><a href='".$data['figure_item']['link']."'>".$data['figure_item']['name']."</a> <span class='small'>".$data['figure_clickcount']."</span></div>\n";
					if ($data['figure_cat_description'] != "") {
						echo "<span>".$data['figure_cat_description']."</span>";
					}
					echo "</div>\n</div>\n";
					echo "</div>\n";
					$counter++;
				}
			}
			echo "</div>\n";
		} else {
			// ['figc_0012'] = "No figure categories defined";
			echo "<div style='text-align:center'><br />\n".$locale['figc_0012']."<br /><br />\n</div>\n";
		}
		closetable();
	}
}
