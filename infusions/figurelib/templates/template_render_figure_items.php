<?php
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
require_once "../../maincore.php";
require_once INCLUDES."infusions_include.php";
if (!defined("IN_FUSION")) { die("Access Denied"); }
include INFUSIONS."figurelib/infusion_db.php";

//global $settings, $main_style, $aidlink; $userdata; $locale; add_handler("theme_output");
global $userdata;

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
																	
						// ONE COVER IMAGE PLUS 9 MINI-IMAGES  //////////////////////////////////////////////////////////////
								
						echo "<div class='panel panel-default'>\n";
						//echo "<div class='panel-body'>\n";
						echo "<center><table class='' width='100%'>\n";
								
						echo "<div class='well clearfix'>\n";
						echo "<strong>".$data['figure_title']."</strong><br>";
						echo "</div>\n";
					 
						echo "<tr>\n";				  
						// COVER IMAGE
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
										
// ####### SOCIAL_SHARING   ##################################################		

					echo "<tr><td align='center' class='panel-footer' colspan='4' width=''>\n";						
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
						
// ########  AFFILIATE PANEL  ################################################
				

	// CSS 
		echo "<style type='text/css'>
		<!--
		table {
		  border-collapse: collapse;
		  border: 1px solid #eeeeee;
		}
		-->
		</style>\n";	

echo "<div class='well clearfix'>\n";
echo "<strong>AFFILIATES</strong><br>";
echo "</div>\n";		
			
			echo "<table style='cellspacing:10px; cellpadding:10px;' class='table' width='100%'>\n";
		
			 // FIRST LINE ESHOP (PRIORITY 1)		 
			 if ($data['figure_eshop'] == "") { 
						} else { 
						echo "<tr><td style='text-align:center; vertical-align:middle;' colspan='4'><a href='".$data['figure_eshop']."'</a>".trimlink($data['figure_eshop'],15)."</td></tr>\n"; }	
			 
			// SECOND LINE AFFILIATE (PRIORITY 2)			 
			 if ($data['figure_affiliate_1']  ||  $data['figure_affiliate_2'] ||  $data['figure_affiliate_3'] || $data['figure_affiliate_4'] != "") { 
			 
				 echo "<tr>\n";
				 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
				 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
						if ($data['figure_affiliate_1'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_1']."'</a>".trimlink($data['figure_affiliate_1'],15)."</td>\n"; }		 
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_2'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_2']."'</a>".trimlink($data['figure_affiliate_2'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_3'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_3']."'</a>".trimlink($data['figure_affiliate_3'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_4'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_4']."'</a>".trimlink($data['figure_affiliate_4'],15)."</td>\n"; }	
				 echo "</tr>\n";
			 } else { 
			 }
			 
			// THIRD LINE AFFILIATE (PRIORITY 2)		 
			if ($data['figure_affiliate_5']  ||  $data['figure_affiliate_6'] ||  $data['figure_affiliate_7'] || $data['figure_affiliate_8'] != "") { 
			 
				 echo "<tr>\n";
				 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
				 echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
						if ($data['figure_affiliate_5'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_5']."'</a>".trimlink($data['figure_affiliate_5'],15)."</td>\n"; }		 
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_6'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_6']."'</a>".trimlink($data['figure_affiliate_6'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_7'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_7']."'</a>".trimlink($data['figure_affiliate_7'],15)."</td>\n"; }	
				 echo "<td align='center'>\n";	 
						if ($data['figure_affiliate_8'] == "") { echo "<strike>".$locale['figure_033']."</strike>";
							} else { echo "<a href='".$data['figure_affiliate_8']."'</a>".trimlink($data['figure_affiliate_8'],15)."</td>\n"; }	
				 echo "</tr>\n";
			 } else { 
			 }
			
			// FOURTH LINE AMAZON COM CA UK DE	

						 echo "<tr>\n";
			echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
						
			echo "<td style='text-align:center; vertical-align:middle;'>	\n";	 
					if ($data['figure_amazon_com'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_usa_sw.png"."' alt='".$locale['figure_031a']."' title='".$locale['figure_031a']."'>";
						} else { echo "<a href='".$data['figure_amazon_com']."'><img src='".INFUSIONS."figurelib/images/flags/flag_usa.png"."' alt='".trimlink($data['figure_amazon_com'],50)."' title='".trimlink($data['figure_amazon_com'],100)."'></td>\n"; }		 
			
			echo "<td align='center'>\n";	 
					if ($data['figure_amazon_ca'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_canada_sw.png"."' alt='".$locale['figure_032a']."' title='".$locale['figure_032a']."'>";
						} else { echo "<a href='".$data['figure_amazon_ca']."'><img src='".INFUSIONS."figurelib/images/flags/flag_canada.png"."' alt='".trimlink($data['figure_amazon_ca'],50)."' title='".trimlink($data['figure_amazon_ca'],100)."'></td>\n"; }	
			 			 	 
			echo "<td align='center'>\n";	 
			 		if ($data['figure_amazon_uk'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_great_britain_sw.png"."' alt='".$locale['figure_026a']."' title='".$locale['figure_026a']."'>";
						} else { echo "<a href='".$data['figure_amazon_ca']."'><img src='".INFUSIONS."figurelib/images/flags/flag_great_britain.png"."' alt='".trimlink($data['figure_amazon_ca'],50)."' title='".trimlink($data['figure_amazon_ca'],100)."'></td>\n"; }	
				
			echo "<td align='center'>\n";	 
			 		if ($data['figure_amazon_de'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_germany_sw.png"."' alt='".$locale['figure_025a']."' title='".$locale['figure_025a']."'>";
						} else { echo "<a href='".$data['figure_amazon_de']."'><img src='".INFUSIONS."figurelib/images/flags/flag_germany.png"."' alt='".trimlink($data['figure_amazon_de'],50)."' title='".trimlink($data['figure_amazon_de'],100)."'></td>\n"; }	
			echo "</tr>\n";
			 		 
			 // FIFTH LINE AMAZON JP FR ES IT
			 echo "<tr>\n";
			 echo "<colgroup><col width='25%'><col width='25%'><col width='25%'><col width='25%'></colgroup>\n"; 
			

			echo "<td style='text-align:center; vertical-align:middle;'>	\n";
					if ($data['figure_amazon_jp'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_japan_sw.png"."' alt='".$locale['figure_030a']."' title='".$locale['figure_030a']."'>";
						} else { echo "<a href='".$data['figure_amazon_jp']."'><img src='".INFUSIONS."figurelib/images/flags/flag_japan.png"."' alt='".trimlink($data['figure_amazon_jp'],50)."' title='".trimlink($data['figure_amazon_jp'],100)."'></td>\n"; }		
			
			echo "<td align='center'>\n";
					if ($data['figure_amazon_fr'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_france_sw.png"."' alt='".$locale['figure_027a']."' title='".$locale['figure_027a']."'>";
						} else { echo "<a href='".$data['figure_amazon_fr']."'><img src='".INFUSIONS."figurelib/images/flags/flag_france.png"."' alt='".trimlink($data['figure_amazon_fr'],50)."' title='".trimlink($data['figure_amazon_fr'],100)."'></td>\n"; }	
			 		 
			echo "<td align='center'>\n";
			 		if ($data['figure_amazon_es'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_spain_sw.png"."' alt='".$locale['figure_028a']."' title='".$locale['figure_028a']."'>";
						} else { echo "<a href='".$data['figure_amazon_es']."'><img src='".INFUSIONS."figurelib/images/flags/flag_spain.png"."' alt='".trimlink($data['figure_amazon_es'],50)."' title='".trimlink($data['figure_amazon_es'],100)."'></td>\n"; }	
				
			echo "<td align='center'>\n";
			 		if ($data['figure_amazon_it'] == "") { echo "<img src='".INFUSIONS."figurelib/images/flags/flag_italy_sw.png"."' alt='".$locale['figure_029a']."' title='".$locale['figure_029a']."'>";
						} else { echo "<a href='".$data['figure_amazon_it']."'><img src='".INFUSIONS."figurelib/images/flags/flag_italy.png"."' alt='".trimlink($data['figure_amazon_it'],50)."' title='".trimlink($data['figure_amazon_it'],100)."'></td>\n"; }	
			 echo "</tr>\n";			
			 echo "</table>\n";			
			
// ###########  FIGURE DETAILS   ##############################################################

echo "<div class='well clearfix'>\n";
echo "<strong>FIGURE DATA</strong><br>";
echo "</div>\n";

			//ZEILE 1 - Variant	/ Scale	
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_441'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_variant']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_442'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_scale_name']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";

			//ZEILE 2 - Manufacturer / Weight
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n";			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_417'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_manufacturer_name']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_443'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_weight']."</td>\n";		
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 3 - Sub-Manufacturer (inaktive glöscht) / Height
			echo "<table class='tbl-border' width='100%'>\n";
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>&nbsp;</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>&nbsp;</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_444'].":</b></td>\n";
			
				$height = dbquery("SELECT fm.figure_measurements_id, fm.figure_measurements_inch, f.figure_height
				   FROM ".DB_FIGURE_MEASUREMENTS." fm
				   INNER JOIN ".DB_FIGURE_ITEMS." f ON f.figure_height = fm.figure_measurements_id
				   WHERE figure_id='".$data['figure_id']."'");
				   
				   if(dbrows($height)){
					   while($dataheight = dbarray($height)){	
			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$dataheight['figure_measurements_inch']."</td>\n";
				}
			}				
			echo "<tr>";	
			echo "</table>\n";
		
			//ZEILE 4 - Artists / Width
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_452'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_artists']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_445'].":</b></td>\n";
				
				$width = dbquery("SELECT fm.figure_measurements_id, fm.figure_measurements_inch, f.figure_width
				   FROM ".DB_FIGURE_MEASUREMENTS." fm
				   INNER JOIN ".DB_FIGURE_ITEMS." f ON f.figure_width = fm.figure_measurements_id
				   WHERE figure_id='".$data['figure_id']."'");
				   
				   if(dbrows($width)){
					   while($datawidth = dbarray($width)){	
			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$datawidth['figure_measurements_inch']."</td>\n";	
				}
			}				
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 5 - Country		Depth
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_436'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_country']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_446'].":</b></td>\n";
				
				$depth = dbquery("SELECT fm.figure_measurements_id, fm.figure_measurements_inch, f.figure_depth
				   FROM ".DB_FIGURE_MEASUREMENTS." fm
				   INNER JOIN ".DB_FIGURE_ITEMS." f ON f.figure_depth = fm.figure_measurements_id
				   WHERE figure_id='".$data['figure_id']."'");
				   
				   if(dbrows($depth)){
					   while($datadepth = dbarray($depth)){	
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$datadepth['figure_measurements_inch']."</td>\n";
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
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_brand_name']."</td>\n";		
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_447'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_material_name']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 7 - Series / Articulations Points
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_439'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_series']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_455'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_poa_name']."</td>\n";				
			echo "<tr>";	
			echo "</table>\n";
			
			//ZEILE 8 - Release Date / Packaging
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 			
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_419'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_year']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_448'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_packaging_name']."</td>\n";	
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
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_retailprice']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer' style='width:100px;padding:6px'><b>".$locale['figure_456'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_usedprice']."</td>\n";
			echo "<tr>";	
			echo "</table>\n";	

			//ZEILE 10 - Limited Edition YES/NO / Edition Size
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='30%'><col width='20%'><col width='30%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_450'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_limitation_name']."</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer' style='width:100px;padding:6px'><b>".$locale['figure_451'].":</b></td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".$data['figure_editionsize']."</td>\n";
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
			echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".($data['figure_accessories'] ? $data['figure_accessories'] : "-")."</td>\n";	
			echo "</tr>";		
			echo "</table>\n";
			
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='20%'><col width='80%'></colgroup>\n";				
			//if ($data['figure_description']) {
					echo "<td style='word-break:break-all;word-wrap:break-word' class='panel-footer'><b>".$locale['figure_423'].":</b></td>\n";
					echo "<td style='word-break:break-all;word-wrap:break-word' class='p-l-5'>".nl2br(parseubb(parsesmileys($data['figure_description'])))."</td>";
				//}					
			
			echo "</tr>";	
			echo "</table>\n";	
		
		// LEERZEILE
			echo "<table class='tbl-border' width='100%'>\n";			
			echo "<tr>";	
			echo "<colgroup><col width='50%'><col width='50%'></colgroup>\n"; 
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "<td style='word-break:break-all;word-wrap:break-word' class='tbl2'>&nbsp;</td>\n";
			echo "</tr>";	
			echo "</table>\n";	
// ####### USERFIGURES  ######################################################

if (iMEMBER) {				
				global $userdata;
				$locale['userfigure_001'] ="Add to collection";
				$locale['userfigure_002'] ="Delete from collection";
				$locale['userfigure_003'] ="The following members have this Figure: ";
				$locale['userfigure_004'] ="No members have this Figure - be the first :)";
				$locale['userfigure_005'] ="FIGURE STATS";
				$locale['userfigure_006'] ="Your Collection";
				
				echo "<div class='well clearfix'>\n";
				echo "<strong>".$locale['userfigure_005']."</strong><br>";
				echo "</div>\n";
				
				//Testausgaben um zu schauen was kommt
				//echo "GET figure_id:<b>".$GET['figure_id']."</b><br>";
				//echo "DATA figure_id:<b>".$data['figure_id']."</b><br>";
				//echo "GET user_id:<b>".$GET['user_id']."</b><br>";
				//echo "DATA user_id (Submitter) :<b>".$data['user_id']."</b><br>";
				//echo "USERDATA user_id:<b>".$userdata['user_id']."</b><hr>";
			
			$resultuf = dbquery(
				"SELECT 			
				fu.user_id, 
				fu.user_name, 
				fu.user_status, 
				fu.user_avatar, 
				fuf.figure_userfigures_figure_id,
				fuf.figure_userfigures_user_id			
				FROM ".DB_FIGURE_USERFIGURES." fuf
				LEFT JOIN ".DB_USERS." fu ON fuf.figure_userfigures_user_id=fu.user_id	
				WHERE figure_userfigures_figure_id='".$data['figure_id']."'
				AND user_id='".$userdata['user_id']."'
				");
				
				$rows = dbrows($resultuf);
	
			if ($rows > 0) { // FIGUR VORHANDEN
						
					while ($datauf = dbarray($resultuf)) {
						
							//echo "<div class='well clearfix'>\n";	
							echo "<tr><td align='center' class='panel-footer' colspan='4' width=''>\n";
							//echo "FIGUR VORHANDEN!<br>";					
							//echo "Anzahl:".$rows;
							//echo "figure_id:".$data['figure_id']."</b><br>";
							//echo "user_id:".$userdata['user_id']."</b><br>";
							//echo "userfigures_figure_id:".$datauf['figure_userfigures_figure_id']."</b><br>";
							//echo "userfigures_user_id:".$datauf['figure_userfigures_user_id']."</b>";
							
							// Form posted
						if (isset($_POST['delete_from_collection'])) {
							// Check Fields
							//$criteriaArray = array(
							//$figure_userfigures_figure_id= form_sanitizer($_POST['figure_userfigures_figure_id'], '', 'figure_userfigures_figure_id'),
							//$figure_userfigures_user_id= form_sanitizer($_POST['figure_userfigures_user_id'], '', 'figure_userfigures_user_id'),
							//);
							//if (defender::safe()) {
									//$inputArray = array(
									//	"figure_userfigures_figure_id" => $data['figure_id'],
									//	"figure_userfigures_user_id" => $userdata['user_id'],);
									//dbquery("
									//DELETE FROM ".DB_FIGURE_USERFIGURES." 
									//WHERE ".$data['figure_id']." ==  ".$datauf['figure_userfigures_figure_id']." 
									//AND ".$userdata['user_id']." ==  ".$datauf['figure_userfigures_user_id']."
									//");
									
									dbquery("
									DELETE FROM ".DB_FIGURE_USERFIGURES." 
									WHERE figure_userfigures_figure_id=".$data['figure_id']." 
									AND figure_userfigures_user_id=".$userdata['user_id']." 
									");
									
									redirect(clean_request("", array("delete_from_collection"), FALSE));

							//}
						}
					}
								echo openform('inputform', 'post', FUSION_REQUEST, array("class" => "",));
								echo form_button("delete_from_collection", $locale['userfigure_002'], $locale['userfigure_002'], array("class" => "btn btn-sm btn-primary"));
								echo "  <a href='".INFUSIONS."figurelib/mycollection.php' class='btn btn-sm btn-primary'>".$locale['userfigure_006']."</a>";
								
								echo "  <a href='http://google.com' class='btn btn-sm btn-primary'>".$locale['sale']."</a>";
								echo "</td></tr>";
								echo "<p>";
								echo closeform();
								//echo "</div>\n";
								
			} else { // FIGUR NICHT VORHANDEN
									
							//echo "<div class='well clearfix'>\n";	
							echo "<tr><td align='center' class='panel-footer' colspan='4' width=''>\n";	
							//echo "FIGUR NICHT VORHANDEN!<br>";
							//echo "Anzahl:".$rows;
							//echo "userfigures_figure_id:".$datauf['figure_userfigures_figure_id']."</b><br>";
							//echo "userfigures_user_id:".$datauf['figure_userfigures_user_id']."</b>";
								
							// Form posted
						if (isset($_POST['add_to_collection'])) {
											
							// Standard Values for Fields
							$inputArray = array(
							"figure_userfigures_figure_id" => $data['figure_id'], 
							"figure_userfigures_figure_id" => $userdata['user_id'], 
							);

							// Check Fields
							//$inputArray = array(
							//$figure_userfigures_figure_id= form_sanitizer($_POST['figure_userfigures_figure_id'], '', 'figure_userfigures_figure_id'),
							//$figure_userfigures_user_id= form_sanitizer($_POST['figure_userfigures_figure_id'], '', 'figure_userfigures_user_id'),
							//);

							if (defender::safe()) {
									$inputArray = array(
										"figure_userfigures_figure_id" => $data['figure_id'],
										"figure_userfigures_user_id" => $userdata['user_id'],);
									dbquery_insert(DB_FIGURE_USERFIGURES, $inputArray, "save", array());	
									redirect(clean_request("", array("add_to_collection"), FALSE));									
							}
						}
					
								echo openform('inputform', 'post', FUSION_REQUEST, array("class" => "",));
								echo form_button("add_to_collection", $locale['userfigure_001'], $locale['userfigure_001'], array("class" => "btn btn-sm btn-primary"));
								echo "  <a href='".INFUSIONS."figurelib/mycollection.php' class='btn btn-sm btn-primary'>".$locale['userfigure_006']."</a>";
								
								echo "  <a href='http://google.com' class='btn btn-sm btn-primary'>".$locale['sale']."</a>";
								echo "</td></tr>";
								echo "<p>";
								echo closeform();	
								//echo "</div>\n";															
			}					
	}
// ########### 	folgende User haben die Figure  ##################################				
				
		$resultufc = dbquery(
				"SELECT 			
					fu.user_id, 
					fu.user_name, 
					fu.user_status, 
					fu.user_avatar, 
					fuf.figure_userfigures_figure_id,
					fuf.figure_userfigures_user_id			
				FROM ".DB_FIGURE_USERFIGURES." fuf
				LEFT JOIN ".DB_USERS." fu ON fuf.figure_userfigures_user_id=fu.user_id	
				WHERE figure_userfigures_figure_id='".$data['figure_id']."'
				");		
		
		if (dbrows($resultufc) != 0) {
			
				echo "<hr>";
				echo $locale['userfigure_003'];		
				echo "<p>";	
				
			while ($data = dbarray($resultufc)) {
				
				echo "<tr>\n<td class='side-small' align='left'>".THEME_BULLET."\n";
				echo "<a href='".BASEDIR."profile.php?lookup=".$data['user_id']."' title='".$data['user_name']."' class='side'>\n";
				echo trimlink($data['user_name'], 15)."</a></td>\n</tr>\n";
					
			}

		} else {
				
				echo "<hr>";
				echo $locale['userfigure_004'];	
				echo "<p>";				
		}	
			
// ###########  RELATED FIGURES  ####################################################				

				// SETTINGS HOLEN
				$fil_settings = get_settings("figurelib");
				if ($fil_settings['figure_related']) {
					
					echo "<div class='well clearfix'>\n";
					echo "<strong>RELATED FIGURES</strong><br>";
					echo "</div>\n";
					echo "<div class='panel panel-default'>\n";

					$result3 = dbquery("
						SELECT 
							f.figure_id, 
							f.figure_title, 
							f.figure_datestamp, 
							f.figure_visibility, 
							fc.figure_cat_id, 
							fc.figure_cat_name,
							fm.figure_manufacturer_id,
							fm.figure_manufacturer_name							
						FROM ".DB_FIGURE_ITEMS." f 
						INNER JOIN ".DB_FIGURE_CATS." fc ON f.figure_cat=fc.figure_cat_id
						INNER JOIN ".DB_FIGURE_MANUFACTURERS." fm ON f.figure_manufacturer=fm.figure_manufacturer_id 						
						WHERE MATCH (figure_title) AGAINST ('".$data['figure_title']."' IN BOOLEAN MODE) 
						AND figure_id != ".$data['figure_id']." ".(iSUPERADMIN ? "" : "AND ".groupaccess('figure_visibility'))." 
						ORDER BY RAND() LIMIT 5");
				
					
					if (dbrows($result3)) {
						$i = 0;
						
						
							echo "<table width='100%' cellspacing='1' cellpadding='0' class=''>\n";	
							echo "<tbody><tr>\n";
							echo "<th class='' align='' width='30%'>".$locale['figure_411']."</th>\n";
							echo "<th class='' align='' width='30%'>".$locale['figure_417']."</th>\n";
							echo "<th class='' align='' width='30%'>".$locale['figure_413']."</th>\n";
							echo "<th class='' align='' width='10%'>".$locale['figure_418']."</th>\n";
							echo "</tr>\n";
						
						while ($data3 = dbarray($result3)) {

							$drating = dbarray(dbquery("SELECT SUM(rating_vote) sum_rating, COUNT(rating_item_id) count_votes FROM ".DB_RATINGS." WHERE rating_item_id='".$data3['figure_id']."' AND rating_type='FI'"));
							$num_votes = $drating['count_votes'];
							$rating = ($num_votes > 0 ? str_repeat("<img src='".INFUSIONS."figurelib/images/starsmall.png'>",ceil($drating['sum_rating']/$num_votes)) : "-");
							$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); $i++;
							echo "<tr>\n";
							echo "<td class='$cell_color' width='50%'><a href='figure.php?figure_id=".$data3['figure_id']."' title='".$data3['figure_title']."'>".$data3['figure_title']."</a></td>\n";
							echo "<td class='$cell_color' width='25%' align=''>".trimlink($data3['figure_manufacturer_name'],30)."</td>\n";
							echo "<td class='$cell_color' width='25%' align=''>".$data3['figure_cat_name']."</td>\n";
							echo "<td class='$cell_color' width='25%' align=''>".$rating."</td>\n";
							echo "</tr>\n";
						}
					} else echo "<tr><td class='tbl1' colspan='4' width='33%' align=''>".$locale['figure_426']."</td><br><br></tr>";
					echo "</tbody></table>\n";
					echo "</div>\n";
									
				}				
//++++++++++++++++++++++++++++++++++++++
// RATING UND COMMENTS	
$fil_settings = get_settings("figurelib");	
		
		if ($data['figure_allow_comments']) { 
			echo "<div class='well clearfix'>\n";
			//echo "<strong>COMMENTS</strong><br>";
			echo "</div>\n";
			showcomments("FI", DB_FIGURE_ITEMS, "figure_id", $_GET['figure_id'], INFUSIONS."figurelib/figures.php?figure_id=".$_GET['figure_id']);
		}
		if ($data['figure_allow_ratings']) { 
			echo "<div class='well clearfix'>\n";
			echo "<strong>RATINGS</strong><br>";
			echo "</div>\n";
			showratings("FI", $_GET['figure_id'], INFUSIONS."figurelib/figures.php?figure_id=".$_GET['figure_id']);
		}

// ########################################
				
			}
		}	
	echo "</div>";
	echo "</aside>\n";	
		
//+++++++++++++++++++++++++++++++++++++++
// LINK FÜR ADMINS ZUM BEARBETEN DER FIGUR
if (iADMIN || iSUPERADMIN) {
	global $aidlink;
	global $settings;
			// ['cifg_0005'] = "Edit";
			echo "<a class='btn btn-default btn-sm' href='".INFUSIONS."figurelib/admin.php".$aidlink."&amp;section=figurelib_form&amp;action=edit&amp;figure_id=".$_GET['figure_id']."'>".$locale['cifg_0005a']."</a><p>"; 
}			
//+++++++++++++++++++++++++++++++++++++++
// PRINT BUTTON
//echo "<a title='".$locale['news_0002']."' href='".$info['print_link']."'><i class='entypo print'></i></a>";
//echo "<a class='m-r-10' title='".$locale['news_0002']."' href='".$info['print_link']."'><i class='entypo print'></i></a>";
//echo "<a class='m-r-10' title='".$locale['news_0002']."' href='".BASEDIR."print.php?type=F&amp;item_id=".$data['figure_id']."'><i class='entypo print'></i></a>";
//+++++++++++++++++++++++++++++++++++++++
		


	}
}	

