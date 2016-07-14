<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: template/template_render_figure.php based on template/weblinks.php
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
global $aidlink;
global $settings;

// ******************************************************************************************			
// FIGURE OVERVIEW PER CATEGORY
// ******************************************************************************************
	
	// GET SETTING FOR SHOW AS GALLERY OR TABLE
	$fil_settings = get_settings("figurelib"); 
	if ($fil_settings['figure_display']) {	

		
// GALLERY VIEW 

	
			if (!function_exists('render_figure')) {
				function render_figure($info) {
					global $locale;
					echo render_breadcrumbs();
					
					// ['cifg_0009'] = "Filter by:";
					//opentable($locale['cifg_0009']);			
					
					echo "<aside class='list-group-item m-b-20'>\n";
					
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
					echo "<div class='media-body overflow-hide'>\n";
								
//*******

	echo "<td style='text-align:center;' class='small'>\n";

	
	$result2 = dbquery("SELECT							   
						figure_images_image_id, 	
						figure_images_figure_id, 	
						figure_images_image, 	
						figure_images_thumb 	
				FROM ".DB_FIGURE_IMAGES."
				WHERE figure_images_figure_id='".$data['figure_id']."' LIMIT 0,1");
 
			   // Fragen, ob überhaupt ein Ergebnis kommt
	if(dbrows($result2)){
     
				while($data2 = dbarray($result2)){
	
					echo "<center><a href='".$data['figure']['link']."'><img src='".($data2['figure_images_thumb'] ? THUMBS_FIGURES.$data2['figure_images_thumb'] : INFUSIONS.$inf_folder."/images/default.png")."' alt='".trimlink($data['figure_title'],100)."' title='".trimlink($data['figure_title'],50)."' style='border:0px;max-height:120px;max-width:120px' />";
	
				}
	}
	echo "<br />\n";						
	
	// ['figure_453'] = "["; //  ['figure_454'] = "] ";
	echo "<strong>".$locale['figure_453']."".trimlink($data['figure']['manufacturer'],15)."".$locale['figure_454']."</strong><br />\n";	
	echo "<strong>".trimlink($data['figure']['name'],15)."</strong></a><br />\n";	
	
	echo "<span class='small'><strong>".$locale['figure_414'].":</strong> ".showdate("shortdate", $data['figure_datestamp'])."</span><br>\n";
	
	echo "<span class='small'><strong>Views: </strong>".$data['figure']['views']."</span><br>\n";
						
	$count = dbcount("(figure_userfigures_id)", DB_FIGURE_USERFIGURES, "figure_userfigures_figure_id='".$data['figure_id']."'");	
	echo "<span class='small'><strong>User Count: </strong>".$count."</span><br>";						
	
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
				$rating = ($drating['count_votes'] > 0 ? str_repeat("<img src='".INFUSIONS."figurelib/images/starsmall.png'>",ceil($drating['sum_rating']/$drating['count_votes'])) : "-");
			echo "<span class='small'><strong>Rating: </strong>".$rating."</span>\n";
	
	echo "</td>\n";
	echo "</tr>\n</table>\n";

//*******							
					echo "</div>\n</div>\n";
					echo "</div>\n";
					$counter++;
				}
			}
			echo "</div>\n";
//*******			
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
			} else {echo "</div>\n";}
			
*/						
			// blaue Version der Box
			echo "<div class='alert alert-info m-b-20 submission-guidelines'><br /><center>\n".$locale['figc_0012']."<br>";
			if (iMEMBER && $fil_settings['figure_submit']) {
			//['figure_521'] = "Submit Figure";
					echo "<p><a href='submit.php?stype=f'>".$locale['figure_521']."</a></p>";
				echo "</div>\n";
			} else {echo "</div>\n";}
							
		}
		
		echo $info['page_nav'] ? "<div class='text-right'>".$info['page_nav']."</div>" : '';
		closetable();
	}
}	
/******************************************************************************************/	
			
} else {	

/******************************************************************************************		
		|-------------------------------------------------------|
		| VARIANTE                     POSTED BY                |
		| MANUFACTURER                 POST DATE                |
		| BRAND                        VIEWS (clickcount)       |
		| SERIE                        USER HABEN DIESE FIGUR   |		
		| SCALE                        COMMENTS                 |
		| YEAR	                       RATING                   |                 
		--------------------------------------------------------|
******************************************************************************************/			

			if (!function_exists('render_figure')) {
				function render_figure($info) {
					global $locale;
					echo render_breadcrumbs();
					
					// ['cifg_0009'] = "Filter by:";
					//opentable($locale['cifg_0009']);
					openside();
					
					if ($info['figure_rows'] != 0) {
						$counter = 0;
						$columns = 1;
						echo "<div class='row m-0'>\n";
						if (!empty($info['item'])) {
							
							foreach($info['item'] as $figure_id => $data) {
								if ($counter != 0 && ($counter%$columns == 0)) {
									echo "</div>\n<div class='row m-0'>\n";
								}
							
//******								
								
		echo "<div class='panel panel-default'>\n";
			
			echo "<div class='panel-heading'>\n";
			echo "<a href='".$data['figure']['link']."'>".$data['figure']['name']."</a>\n";
			echo "</div>\n";
	   
		echo "<div class='list-group-item m-b-20'>\n";
		echo "<div class='row'>\n";
		
		// RIGHT SITE
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
	
			// LEFT SIDE
			
			echo "<span class='small'><strong>Submitted by: </strong>".profile_link($data['figure']['userid'], $data['figure']['username'], $data['figure']['userstatus'])."<br/></span>\n";
			
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
				$rating = ($drating['count_votes'] > 0 ? str_repeat("<img src='".INFUSIONS."figurelib/images/starsmall.png'>",ceil($drating['sum_rating']/$drating['count_votes'])) : "-");
			echo "<span class='small'><strong>Rating: </strong>".$rating."</span>\n";

		echo "</div>\n";		
		echo "</div>\n";
		echo "</div>\n";
		echo "</div>\n";
							
								
//******								
								
								//echo "</div>\n</div>\n";
								//echo "</div>\n";
								$counter++;
				}
			}
			echo "</div>\n";
			
//******
	
		} else {
			
//******
			
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
		echo $info['page_nav'] ? "<div class='text-right'>".$info['page_nav']."</div>" : '';
		echo "</aside";
	}
}					
						
	
}						
// ******************************************************************************************			
// ******************************************************************************************
