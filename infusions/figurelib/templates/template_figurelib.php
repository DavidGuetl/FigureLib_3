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

// SETTINGS HOLEN
$fil_settings = get_settings("figurelib");


if (!function_exists('render_figure_item')) {
	function render_figure_item($info) {
		global $locale, $userdata;
		opentable($locale['450']);
				
		echo render_breadcrumbs();
		//echo "<!--pre_figure-->";
	if ($info['figure_rows']) {
		foreach($info['item'] as $figure_id => $data) {	
				
	
	// AB HIER ANSISCHT GALLERIE ODER TABELLEN FORM //
			$fil_settings = get_settings("figurelib"); 
			if ($fil_settings['figure_display']) {	
							
	// GALLERIEANSICHT   
			
	echo "<table style='text-align:center;' cellpadding='0' cellspacing='1' width='100%'>\n<tr>\n";
	if ($i != 0 && ($i % $asettings['figure_per_line'] == 0)) { echo "</tr>\n<tr>\n"; }
	
	echo "<td style='text-align:center;' class=''>\n";

	echo "<a href='".$data['figure']['link']."'><img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:100px;max-width:100px' />";	
	echo "<br />\n";						
	
	// ['figure_453'] = "["; //  ['figure_454'] = "] ";
	echo "<strong>".$locale['figure_453']."".trimlink($data['figure']['manufacturer'],15)."".$locale['figure_454']."</strong><br />\n";	
	echo "<strong>".trimlink($data['figure']['name'],15)."</strong></a><br />\n";	
	
	echo "<span class='small'><strong>".$locale['figure_414'].":</strong> ".showdate("shortdate", $data['figure_datestamp'])."</span><br>\n";
	
	echo "<span class='small'><strong>Views: </strong>".$data['figure']['views']."</span><br>\n";
			echo "<span class='small'><strong>User Count: </strong>Variable  hier einbauen</span><br>\n";
			
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
	

	echo "</td>\n";
	echo "</tr>\n</table>\n";



	
	/* NO FUNCTIONARY SHOW RIGHT INAGE FROM DB FIGURE_IMAGES
		
		$result2 = dbquery("SELECT
					figure_images_image_id,
					figure_images_image,
					figure_images_thumb 
					FROM ".DB_FIGURE_IMAGES." 
					WHERE figure_images_figure_id='".$data['figure_id']."' LIMIT 0,1");
		
		while($data2 = dbarray($result2)){

		// WENN KEIN BILD VORHANDEN DANN ZEIGE PLATZHALTER BILD
			if ($data2['figure_images_thumb']) {
				echo "<a href='".$data['figure']['link']."'><img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:100px;max-width:100px' /></a>";
			} else {  
 
				echo "<a href='".$data['figure']['link']."'>\n<img src='".($data2['figure_images_thumb'] ? THUMBS_FIGURES.$data2['figure_images_thumb'] : INFUSIONS.$inf_folder."/images/default.png")."' alt='".trimlink($data['figure_title'],100)."' title='".trimlink($data['figure_title'],50)."' style='border:0px;max-height:100px;max-width:100px' /></a>";
			}
		}			

	*/
	
		} else {
			
		echo "<div class='panel panel-default'>\n";
			
			echo "<div class='panel-heading'>\n";
			echo "<a href='".$data['figure']['link']."'>".$data['figure']['name']."</a>\n";
			echo "</div>\n";
	   
		echo "<div class='list-group-item m-b-20'>\n";
		echo "<div class='row'>\n";
				
		
	/* TABELLENANSICHT
		--------------------------------------------------------|
		| VARIANTE                     POSTED BY                |
		| MANUFACTURER                 POST DATE                |
		| BRAND                        VIEWS (clickcount)       |
		| SERIE                        USER HABEN DIESE FIGUR   |		
		| SCALE                        COMMENTS                 |
		| YEAR	                       RATING                   |                 
		-------------------------------------------------------*/
		
		// AB HIER GENERIEREN DER RECHTEN SEITE
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
	
			// AB HIER GENERIEREN DER LINKEN SEITE
		
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

		echo "</div>\n";
		
		
		echo "<div class='clearfix'>\n";
		echo "<div class='btn-group pull-right m-t-20'>\n";
		echo isset($data['nav']['first']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['first']['link']."' title='".$data['nav']['first']['name']."'><i class='entypo to-start'></i></a>\n" : '';
		echo isset($data['nav']['prev']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['prev']['link']."' title='".$data['nav']['prev']['name']."'><i class='entypo left-dir'></i></a>\n" : '';
		echo isset($data['nav']['next']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['next']['link']."' title='".$data['nav']['next']['name']."'><i class='entypo right-dir'></i></a>\n" : '';
		echo isset($data['nav']['last']) ? "<a class='btn btn-default btn-sm' href='".$data['nav']['last']['link']."' title='".$data['nav']['last']['name']."'><i class='entypo to-end'></i></a>\n" : '';
		echo "</div>";
		

		echo "</div>\n";
		echo "</div>\n";
		echo "</div>\n";
		echo "</div>\n";

				}
			}		

} else {
			// ['figc_0012'] = "No figure categories defined";
			
			// SETTINGS HOLEN
			$fil_settings = get_settings("figurelib");			
			
			
/*			// graue Version der Box
			echo "<div class='well text-center'><br />\n".$locale['figc_0012']."<br />\n";
			if (iMEMBER && $fil_settings['figure_submit']) {
			//['figure_521'] = "Submit Figure";
					echo "<p><a href='submit.php?stype=f'>".$locale['figure_521']."</a></p>";
				echo "</div>\n";
			} else {
				echo "</div>\n";
			}
			
*/			
			
			// blaue Version der Box
			echo "<div class='alert alert-info m-b-20 submission-guidelines'><br /><center>\n".$locale['figc_0012']."<br>";
			
			if (iMEMBER && $fil_settings['figure_submit']) {
			//['figure_521'] = "Submit Figure";
					echo "<p><a href='submit.php?stype=f'>".$locale['figure_521']."</a></p>";
				echo "</div>\n";
			} else {
				echo "</div>\n";
			}
					
			
		}

		closetable();
	}
}


// ##################################################################################

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
