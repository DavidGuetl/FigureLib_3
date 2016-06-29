<?php

	//error_reporting(E_ALL);
	//echo "<br>";
	// Formularinhalte prüfen
	//print_r ($_POST);
	//echo "<br>";
	// GET-Parameter prüfen
	//print_r ($_GET);
	// Sessions prüfen
	//echo "<br>";
	//print_r ($_SESSION);

/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: template/template_render_figure_items.php based on template/weblinks.php
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
// FIGURE
// ******************************************************************************************
if (!function_exists('render_figure_items')) {
	function render_figure_items($info) {
		global $locale;
		echo render_breadcrumbs();
	
$result = dbquery(
			"SELECT 
			f.*,
			fc.figure_cat_id, 
			fc.figure_cat_name, 		
			fu.user_id, 
			fu.user_name, 
			fu.user_status, 
			fu.user_avatar, 
			fman.figure_manufacturer_id,
			fman.figure_manufacturer_name, 
			fb.figure_brand_name, 
			fy.figure_year_id, 
			fy.figure_year, 
			fs.figure_scale_id, 
			fs.figure_scale_name, 
			fl.figure_limitation_id, 
			fl.figure_limitation_name,
			fpoa.figure_poa_id,
			fpoa.figure_poa_name,
			fpack.figure_packaging_id,
			fpack.figure_packaging_name,
			fmat.figure_material_id,
			fmat.figure_material_name				
			FROM ".DB_FIGURE_ITEMS." f
			LEFT JOIN ".DB_USERS." fu ON f.figure_submitter=fu.user_id
			INNER JOIN ".DB_FIGURE_CATS." fc ON f.figure_cat=fc.figure_cat_id
			INNER JOIN ".DB_FIGURE_MANUFACTURERS." fman ON fman.figure_manufacturer_id = f.figure_manufacturer
			INNER JOIN ".DB_FIGURE_BRANDS." fb ON fb.figure_brand_id = f.figure_brand
			INNER JOIN ".DB_FIGURE_SCALES." fs ON fs.figure_scale_id = f.figure_scale
			INNER JOIN ".DB_FIGURE_YEARS." fy ON fy.figure_year_id = f.figure_pubdate
			INNER JOIN ".DB_FIGURE_LIMITATIONS." fl ON fl.figure_limitation_id = f.figure_limitation
			INNER JOIN ".DB_FIGURE_POAS." fpoa ON fpoa.figure_poa_id = f.figure_poa
			INNER JOIN ".DB_FIGURE_PACKAGINGS." fpack ON fpack.figure_packaging_id = f.figure_packaging
			INNER JOIN ".DB_FIGURE_MATERIALS." fmat ON fmat.figure_material_id = f.figure_material
			".(multilang_table("FI") ? "WHERE figure_language='".LANGUAGE."' AND" : "WHERE")." f.figure_freigabe='1'  
			AND figure_id='".$_GET['figure_id']."'
			");
			
			if (dbrows($result) != 0) {
				while ($data = dbarray($result)) {
					
// TITLE + KATEGORIE					

 echo "<aside class='list-group-item m-b-20'>\n";
					
			
			echo "<div class='panel panel-default'>\n";
			echo "<div class='panel-heading'>\n";
			
					echo "<b>".$data['figure_title']."</b></td>\n";
				
			echo "</div>";	
			echo "</div>";			
					
								
// 9 MINIBILDER A 3 X 3 BILDER  //////////////////////////////////////////////////////////////
		
		echo "<div class='panel panel-default'>\n";
		//echo "<div class='panel-body'>\n";
		echo "<center><table class='tbl-border' width='100%'>\n";
					 
						echo "<tr>\n";				  
						// COVERBILD
						//echo "<td align='center' class='tbl-border tbl1' rowspan='3'><a href='".($data['figure_image_cover'] ? IMAGES_FIGURE.$data['figure_image_cover'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image_cover'] ? IMAGES_FIGURE.$data['figure_image_cover'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='400px' alt='".$data['figure_title']."' />COVER</a>\n";					
						echo "<td align='center' class='tbl-border tbl1' rowspan='3'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:100%;max-width:180px' /></td>";
						
						// THUMB 1
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 1</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
						
						// THUMB 2
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 2</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
						
						// THUMB 3
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 3</td>\n";	
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
					  
					  echo "</tr>\n";
					  echo "<tr>\n";
					  
						// THUMB 4
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 4</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
						
						// THUMB 5
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 5</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
						
						// THUMB 6
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 6</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
					  
					  echo "</tr>\n";
					  echo "<tr>\n";
					  
						// THUMB 7
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 7</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
						
						// THUMB 8
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 8</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
						
						// THUMB 9
						//echo "<td align='center' class='tbl-border tbl1'><a href='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='100%' alt='".$data['figure_title']."'><img src='".($data['figure_image'] ? IMAGES_FIGURE.$data['figure_image'] : INFUSIONS.$inf_folder."/images/default.png")."'  height='100%' width='50px' alt='".$data['figure_title']."' /></a>THUMB 9</td>\n";
						echo "<td class='side-small'><a href='".INFUSIONS."figurelib/figures.php?figure_id=".$data['figure_id']."' class=''>\n<img src='".INFUSIONS."figurelib/images/default.png"."' alt='".trimlink($data['figure_title'],50)."' title='".trimlink($data['figure_title'],100)."' style='border:0px;max-height:60px;max-width:60px' /></td>";
					 
					 echo "</tr>\n";
				 
			// ZEILE FÜR I'M LOOKING FOR THIS FIGURE | I HAVE THIS FIGURE | I SELL THIS FIGURE | BUY THIS FIGURE		 
			echo "<tr><td align='center' class='panel-footer' colspan='4' width='100%'>\n";		 
			echo "<a href='x' target='_blank'>I'M LOOKING FOR THIS FIGURE</a> | <a href='x' target='_blank'>I HAVE THIS FIGURE</a> | <a href='x' target='_blank'>I SELL THIS FIGURE</a> | <a href='x' target='_blank'>BUY THIS FIGURE</a>";			
			
			echo "</td></tr>\n";
				
			//ZEILE SOCIALMEDIA BUTTONS SHARING BUTTONS - über komplette Breite der Tabelle						
			echo "<tr><td class='panel-footer' colspan='4' width='100%'>\n";
			
			
						
						// SETTINGS HOLEN
						global $settings;
						$fil_settings = get_settings("figurelib"); 

						if ($fil_settings['figure_social_sharing']) {
							echo "<div style='text-align:center'>\n";
							$link = $settings['siteurl'].str_replace("../","",INFUSIONS)."figurelib/figure.php?figure_id=".$_GET['figure_id'];
							echo "<a href='http://www.facebook.com/share.php?u=".$link."' target='_blank'><img alt='Facebook' src='".INFUSIONS."figurelib/images/facebook.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://twitter.com/share?url=".$link."' target='_blank'><img alt='Twitter' src='".INFUSIONS."figurelib/images/twitter.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://digg.com/submit?url=".$link."' target='_blank'><img alt='Digg' src='".INFUSIONS."figurelib/images/digg.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://reddit.com/submit?url=".$link."' target='_blank'><img alt='Reddit' src='".INFUSIONS."figurelib/images/reddit.png' border='0'></a>&nbsp;\n";
							echo "<a href='http://del.icio.us/post?url=".$link."' target='_blank'><img alt='Del.icio.us' src='".INFUSIONS."figurelib/images/delicious.png' border='0'></a>&nbsp;\n";
							echo "</div>\n";
						}
					echo "</td></tr>\n";
			echo "</table>";	

// AFFILIATE PANEL  ///////////////////////////////////////////
				

	// CSS 
		echo "<style type='text/css'>
		<!--
		table {
		  border-collapse: collapse;
		  border: 1px solid #eeeeee;
		}
		-->
		</style>\n";			
			
			echo "<table style='cellspacing:10px; cellpadding:10px;' class='table' width='100%'>\n";
		
			 // ERSTE ZEILE ESHOP (PRIORITÄT 1)		 
			 if ($data['figure_eshop'] == "") { 
						} else { 
						echo "<tr><td style='text-align:center; vertical-align:middle;' colspan='4'><a href='".$data['figure_eshop']."'</a>".trimlink($data['figure_eshop'],15)."</td></tr>\n"; }	
			 
			// ZWEITE ZEILE AFFILIATE (PRIORITÄT 2)			 
			 if ($data['figure_affiliate_1']  ||  $data['figure_affiliate_2'] ||  $data['figure_affiliate_3'] || $data['figure_affiliate_4'] != "") { 
			 
				 echo "<tr>\n";
				 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
				 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
						if ($data['figure_affiliate_1'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_1']."'</a>".trimlink($data['figure_affiliate_1'],15)."</td>\n"; }		 
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_2'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_2']."'</a>".trimlink($data['figure_affiliate_2'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_3'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_3']."'</a>".trimlink($data['figure_affiliate_3'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_4'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_4']."'</a>".trimlink($data['figure_affiliate_4'],15)."</td>\n"; }	
				 echo "</tr>\n";
			 } else { 
			 }
			 
			// DRIITE ZEILE AFFILIATE (PRIORITÄT 2)		 
			if ($data['figure_affiliate_5']  ||  $data['figure_affiliate_6'] ||  $data['figure_affiliate_7'] || $data['figure_affiliate_8'] != "") { 
			 
				 echo "<tr>\n";
				 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
				 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
						if ($data['figure_affiliate_5'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_5']."'</a>".trimlink($data['figure_affiliate_5'],15)."</td>\n"; }		 
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_6'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_6']."'</a>".trimlink($data['figure_affiliate_6'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_7'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_7']."'</a>".trimlink($data['figure_affiliate_7'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_8'] == "") { echo "".$locale['figure_033']."";
							} else { echo "<a href='".$data['figure_affiliate_8']."'</a>".trimlink($data['figure_affiliate_8'],15)."</td>\n"; }	
				 echo "</tr>\n";
			 } else { 
			 }
			
			// VIERTE ZEILE AMAZON COM CA UK DE		
			 echo "<tr>\n";
			 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
			 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
					if ($data['figure_amazon_com'] == "") { echo "".$locale['figure_031a']."";
						} else { echo "<a href='".$data['figure_amazon_com']."'</a>".trimlink($data['figure_amazon_com'],15)."</td>\n"; }		 
			 echo "<td align='center'>\n";	 
					if ($data['figure_amazon_ca'] == "") { echo "".$locale['figure_032a']."";
						} else { echo "<a href='".$data['figure_amazon_ca']."'</a>".trimlink($data['figure_amazon_ca'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";	 
			 		if ($data['figure_amazon_uk'] == "") { echo "".$locale['figure_026a']."";
						} else { echo "<a href='".$data['figure_amazon_uk']."'</a>".trimlink($data['figure_amazon_uk'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";	 
			 		if ($data['figure_amazon_de'] == "") { echo "".$locale['figure_025a']."";
						} else { echo "<a href='".$data['figure_amazon_de']."'</a>".trimlink($data['figure_amazon_de'],15)."</td>\n"; }	
			 echo "</tr>\n";
			 	 		 
			 // FÜNFTE ZEILE AMAZON JP FR ES IT
			 echo "<tr>\n";
			 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
			 echo "<td style='text-align:center; vertical-align:middle;'>	\n";
					if ($data['figure_amazon_jp'] == "") { echo "".$locale['figure_030a']."";
						} else { echo "<a href='".$data['figure_amazon_jp']."'</a>".trimlink($data['figure_amazon_jp'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";
					if ($data['figure_amazon_fr'] == "") { echo "".$locale['figure_027a']."";
						} else { echo "<a href='".$data['figure_amazon_fr']."'</a>".trimlink($data['figure_amazon_fr'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";
			 		if ($data['figure_amazon_es'] == "") { echo "".$locale['figure_028a']."";
						} else { echo "<a href='".$data['figure_amazon_es']."'</a>".trimlink($data['figure_amazon_es'],15)."</td>\n"; }	
			 echo "<td align='center'>\n";
			 		if ($data['figure_amazon_it'] == "") { echo "".$locale['figure_029a']."";
						} else { echo "<a href='".$data['figure_amazon_it']."'</a>".trimlink($data['figure_amazon_it'],15)."</td>\n"; }	
			 echo "</tr>\n";			
			 echo "</table>\n";			
			
// AB HIER DETAILS  ////////////////////////////////////////////////////////////////



		// LEERZEILE
			//echo "<table class='tbl-border' width='100%'>\n";			
			//echo "<tr>";	
			//echo "<colgroup><col width='50%'><col width='50%'></colgroup>\n"; 
			//echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			//echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			//echo "<tr>";	
			//echo "</table>\n";
			
			// AB HIER DIE FIGUREN DATEN / ZEILEN
			//ZEILE 1 - Variant	/ Scale	
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_441'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_variant']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_442'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_scale_name']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";

			//ZEILE 2 - Manufacturer / Weight
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n";			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_417'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_manufacturer_name']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_443'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_weight']."</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 3 - Sub-Manufacturer (inaktive glöscht) / Height
			
			
		
			echo "<table class='tbl-border' width='100%'>\n";
		
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>&nbsp;</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_444'].":</b></td>\n";
			
				$height = dbquery("SELECT fm.figure_measurements_id, fm.figure_measurements_inch, f.figure_height
				   FROM ".DB_FIGURE_MEASUREMENTS." fm
				   INNER JOIN ".DB_FIGURE_ITEMS." f ON f.figure_height = fm.figure_measurements_id
				   WHERE figure_id='".$data['figure_id']."'");
				   
				   if(dbrows($height)){
					   while($dataheight = dbarray($height)){	
			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$dataheight['figure_measurements_inch']."</td>\n";
				}
			}				
			echo "<tr>";	
			echo "</table>\n";
		
			//ZEILE 4 - Artists / Width
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_452'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_artists']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_445'].":</b></td>\n";
				
				$width = dbquery("SELECT fm.figure_measurements_id, fm.figure_measurements_inch, f.figure_width
				   FROM ".DB_FIGURE_MEASUREMENTS." fm
				   INNER JOIN ".DB_FIGURE_ITEMS." f ON f.figure_width = fm.figure_measurements_id
				   WHERE figure_id='".$data['figure_id']."'");
				   
				   if(dbrows($width)){
					   while($datawidth = dbarray($width)){	
			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datawidth['figure_measurements_inch']."</td>\n";	
				}
			}				
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 5 - Country		Depth
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_436'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_country']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_446'].":</b></td>\n";
				
				$depth = dbquery("SELECT fm.figure_measurements_id, fm.figure_measurements_inch, f.figure_depth
				   FROM ".DB_FIGURE_MEASUREMENTS." fm
				   INNER JOIN ".DB_FIGURE_ITEMS." f ON f.figure_depth = fm.figure_measurements_id
				   WHERE figure_id='".$data['figure_id']."'");
				   
				   if(dbrows($depth)){
					   while($datadepth = dbarray($depth)){	
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$datadepth['figure_measurements_inch']."</td>\n";
							}
			}	
			echo "<tr>";	
			echo "</table>\n";
			
			//LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 6 - Brand / Material	
			
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_438'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_brand_name']."</td>\n";		
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_447'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_material_name']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 7 - Series / Articulations Points
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_439'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_series']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_455'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_poa_name']."</td>\n";				
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 8 - Release Date / Packaging
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_419'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_year']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_448'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_packaging_name']."</td>\n";	
			echo "<tr>";	
			echo "</table>\n";
			
			//LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 9 - MSRP (Price by Release)	/ Used Price	
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer' style='width:100px;padding:6px'><b>".$locale['figure_449'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_retailprice']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer' style='width:100px;padding:6px'><b>".$locale['figure_456'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_usedprice']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";	

			//ZEILE 10 - Limited Edition YES/NO / Edition Size
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_450'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_limitation_name']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer' style='width:100px;padding:6px'><b>".$locale['figure_451'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".$data['figure_editionsize']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";	
			
			//LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";
			echo "<td class='tbl2'>&nbsp;</td>\n";		
			echo "<tr>";	
			echo "</table>\n";

			//ZEILE 11 - Accessories / 
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='80%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_457'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".($data['figure_accessories'] ? $data['figure_accessories'] : "-")."</td>\n";	
			echo "</tr>";		
			echo "<tr>";		
			
			//if ($data['figure_description']) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_423'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl3'>".nl2br(parseubb(parsesmileys($data['figure_description'])))."</td>";
				//}					
			
			echo "</tr>";	
			echo "</table>\n";	
		
		// LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='50%'><col width='50%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "<tr>";	
			echo "</table>\n";		

// RELATED FIGURES  ///////////////////////////////////////////
	///////////////////////////////////////////////////////////////	
				// SETTINGS HOLEN
				$fil_settings = get_settings("figurelib");
				if ($fil_settings['figure_related']) {

					$result3 = dbquery("
						SELECT 
							f.figure_id, 
							f.figure_title, 
							f.figure_datestamp, 
							f.figure_visibility, 
							fc.figure_cat_id, 
							fc.figure_cat_name 
						FROM ".DB_FIGURE_ITEMS." f 
						INNER JOIN ".DB_FIGURE_CATS." fc ON f.figure_cat=fc.figure_cat_id 
						WHERE MATCH (figure_title) AGAINST ('".$data['figure_title']."' IN BOOLEAN MODE) 
						AND figure_id != ".$data['figure_id']." ".(iSUPERADMIN ? "" : "AND ".groupaccess('figure_visibility'))." 
						ORDER BY RAND() LIMIT 5");
				
					echo "<table width='100%' cellspacing='1' cellpadding='0' class='tbl-border'>\n";
					echo "<tbody><tr>\n";
					echo "<th class='tbl2' align='' width='50%'>".$locale['figure_411']."</th>\n";
					echo "<th class='tbl2' align='' width='25%'>".$locale['figure_413']."</th>\n";
					echo "<th class='tbl2' align='' width='25%'>".$locale['figure_418']."</th>\n";
					echo "</tr>\n";
					if (dbrows($result3)) {
						$i = 0;
						while ($data3 = dbarray($result3)) {
							$drating = dbarray(dbquery("SELECT SUM(rating_vote) sum_rating, COUNT(rating_item_id) count_votes FROM ".DB_RATINGS." WHERE rating_item_id='".$data3['figure_id']."' AND rating_type='FI'"));
							$num_votes = $drating['count_votes'];
							$rating = ($num_votes > 0 ? str_repeat("<img src='".INFUSIONS."figurelib/images/star.png'>",ceil($drating['sum_rating']/$num_votes)) : "-");
							$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); $i++;
							echo "<tr>\n";
							echo "<td class='$cell_color' width='50%'><a href='figure.php?figure_id=".$data3['figure_id']."' title='".$data3['figure_title']."'>".$data3['figure_title']."</a></td>\n";
	
							echo "<td class='$cell_color' width='25%' align=''>".$data3['figure_cat_name']."</td>\n";
							echo "<td class='$cell_color' width='25%' align=''>".$rating."</td>\n";
							echo "</tr>\n";
						}
					} else echo "<tr><td class='tbl1' colspan='4' width='33%' align=''>".$locale['figure_426']."</td></tr>";
					echo "</tbody></table>\n";			
				}				
//++++++++++++++++++++++++++++++++++++++
// RATING UND COMMENTS				
		if ($data['figure_allow_comments']) { 
			showcomments("FI", DB_FIGURE_ITEMS, "figure_id", $_GET['figure_id'], INFUSIONS."figurelib/figures.php?figure_id=".$_GET['figure_id']);
		}
		if ($data['figure_allow_ratings']) { 
			showratings("FI", $_GET['figure_id'], INFUSIONS."figurelib/figures.php?figure_id=".$_GET['figure_id']);
		}

//+++++++++++++++++++++++++++++++++++++++
// LINK FÜR ADMINS ZUM BEARBETEN DER FIGUR
if (iADMIN || iSUPERADMIN) {
global $aidlink;
	// ['cifg_0005'] = "Edit";
			echo "<a class='btn btn-default btn-sm' href='".INFUSIONS."figurelib/admin.php".$aidlink."&amp;section=figurelib_form&amp;action=edit&amp;figure_id=".$data['figure_id']."'>".$locale['cifg_0005']."</a>"; 
}			
//+++++++++++++++++++++++++++++++++++++++
// PRINT BUTTON
//echo "<a title='".$locale['news_0002']."' href='".$info['print_link']."'><i class='entypo print'></i></a>";
//echo "<a class='m-r-10' title='".$locale['news_0002']."' href='".$info['print_link']."'><i class='entypo print'></i></a>";
//echo "<a class='m-r-10' title='".$locale['news_0002']."' href='".BASEDIR."print.php?type=F&amp;item_id=".$data['figure_id']."'><i class='entypo print'></i></a>";
//+++++++++++++++++++++++++++++++++++++++
		
				
			}
		}	
	echo "</div>";
	
echo "</aside>\n";	
//closeside();

	}
}	

